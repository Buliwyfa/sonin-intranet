<?php

namespace humhub\modules\tickreq\models;

use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\tickreq\permissions\ApproveRequest;
use humhub\modules\tickreq\notifications\NewRequest;
use humhub\modules\user\models\Group;
use humhub\modules\user\models\GroupUser;
use humhub\modules\user\models\User;
use Yii;
use humhub\modules\user\models\Profile;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tickreqs".
 *
 * @property integer $id
 * @property string $description
 * @property integer $status
 * @property integer $quantity
 * @property double $cost
 * @property integer $type
 * @property integer $urgency
 * @property integer $createdby
 * @property string $createdate
 * @property integer $checkedby
 * @property string $checkdate
 * @property integer $rejectedby
 * @property string $rejectdate
 * @property integer $approvedby
 * @property string $approvedate
 * @property string $requiredate
 * @property string $requestcode
 * @property string $source
 */
class tickreq extends ContentActiveRecord
{
    /**
     * @inheritdoc
     */
/*    public $streamChannel = null;
    public $wallEntryClass = 'humhub\modules\tickreq\widgets\WallEntry';*/

    public static function tableName()
    {
        return 'tickreqs';
    }

    public function getStatusName(){
        switch($this->status){
            case 1: return 'Open';
                break;
            case 2: return 'Checked';
                break;
            case 3: return 'Rejected';
                break;
            default: return 'Approved';
                break;
        }
    }

    public function canApproveRequest(){
        return Yii::$app->user->can(new ApproveRequest());
    }

    public function  getCreator(){
        $user = Profile::find()
            ->where(['user_id' => $this->createdby])
            ->one();
        return $user->firstname . " " . $user->lastname;
    }

    public function  getUserName($id){
        $user = Profile::find()
            ->where(['user_id' => $id])
            ->one();
        return $user->firstname . " " . $user->lastname;
    }

    public function getTypeName(){
        switch($this->status){
            case 1: return 'Purchase';
                break;
            default: return 'Service';
                break;
        }
    }
    public function getUrgencyName(){
        switch($this->status){
            case 1: return 'Normal';
                break;
            default: return 'Urgent';
                break;
        }
    }

    public function getCheckUser(){
        //$checkgroup = GroupUser::findAll();
        // $checkuser =
        return User::findOne(1);
    }

    public function getSource(){
        $User = User::find()->where(['id' => Yii::$app->user->getId()])->one();
        $Group = $User->getGroups()->where(['>','id','5'])->all();
        return ArrayHelper::map($Group, 'id', 'name');
    }

    public function getAllSource(){
        $group = Group::find('id','name')->where(['id' > 5])->all;
        $groupuser = new GroupUser();
        $groupuser->getGroup();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'status', 'quantity', 'cost', 'type', 'urgency', 'createdby', 'createdate', 'requiredate', 'source'], 'required'],
            [['status', 'quantity', 'type', 'urgency', 'createdby', 'checkedby','rejectedby', 'approvedby','requestcode'], 'integer'],
            [['cost'], 'number'],
            [['createdate', 'checkdate', 'approvedate', 'requiredate','rejectdate'], 'safe'],
            [['requiredate'], 'validateRequireDate'],
            [['description'], 'string', 'max' => 200],
            ['quantity', 'integer', 'min' => 1],
        ];
    }

    public function validateRequireDate($attribute, $params, $validator)
    {
        if(strtotime($this->$attribute) <= strtotime("-1 day")){
            $this->addError($attribute,'Require data must be later or equal to now');
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'status' => 'Status',
            'quantity' => 'Quantity',
            'cost' => 'Cost',
            'type' => 'Type',
            'urgency' => 'Urgency',
            'createdby' => 'Requested by',
            'createdate' => 'Request Date',
            'checkedby' => 'Checked by',
            'checkdate' => 'Check Date',
            'rejectedby' => 'Rejected by',
            'rejectdate' => 'Reject Date',
            'approvedby' => 'Approved By',
            'approvedate' => 'Approve Date',
            'requiredate' => 'Require Date',
            'requestcode' => 'Code',
            'source' => 'Source',
        ];
    }

    public function getRequestManager()
    {
        // GET ALL USER WITH CHECK, APPROVE, REJECT AND VIEW GLOBAL PERMISSION (REQUEST SOURCE EQUAL TO GROUP) AND OWNER OF REQUEST
        $sql = 'SELECT user_id as id, group_id FROM `Group_User` WHERE group_id IN (5,' . $this->source . ')GROUP BY user_id HAVING COUNT(*) = 2 AND ID !=' . $this->createdby;
        return User::findBySql($sql)->all();
    }
    public function getRequestSupervisor()
    {
        $sql = 'SELECT user_id as id, group_id FROM `Group_User` WHERE group_id IN (6,' . $this->source . ')GROUP BY user_id HAVING COUNT(*) = 2 AND ID !=' . $this->createdby;
        return User::findBySql($sql)->all();
    }
    public function afterSave($insert, $changedAttributes)
    {
        if($insert) {
            NewRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->sendBulk($this->getRequestSupervisor());
        }
        else {
            if($this->status == 1){
                if($this->status ==2){
                    // SEND NOTIFICATION TO USERS WITH CHECK PERMISSION AND IS IT SUPPORT
                }
                else {
                    // SEND NOTIFICATION TO USERS WITH CHECK PERMISSION
                    \humhub\modules\tickreq\notifications\UpdateRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->sendBulk(User::find()->where(['id' => $this->createdby])->one());
                    \humhub\modules\tickreq\notifications\UpdateRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->sendBulk($this->getRequestSupervisor());
                }
            }
            elseif($this->status == 2){
                \humhub\modules\tickreq\notifications\CheckRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->send(User::find()->where(['id' => $this->createdby])->one());
                \humhub\modules\tickreq\notifications\CheckRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->sendBulk($this->getRequestSupervisor());
                \humhub\modules\tickreq\notifications\CheckRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->sendBulk($this->getRequestManager());

            }
            elseif($this->status == 3){
                // SEND NOTIFICATION TO USERS WITH CHECK PERMISSION
               \humhub\modules\tickreq\notifications\RejectRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->send(User::find()->where(['id' => $this->createdby])->one());
                \humhub\modules\tickreq\notifications\RejectRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->sendBulk($this->getRequestSupervisor());
                \humhub\modules\tickreq\notifications\RejectRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->sendBulk($this->getRequestManager());
            }
            else{
                // SEND NOTIFICATION TO USERS WITH CHECK PERMISSION
               \humhub\modules\tickreq\notifications\ApproveRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->send(User::find()->where(['id' => $this->createdby])->one());
                \humhub\modules\tickreq\notifications\ApproveRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->sendBulk($this->getRequestSupervisor());
                \humhub\modules\tickreq\notifications\ApproveRequest::instance()->from(Yii::$app->user->getIdentity())->about($this)->sendBulk($this->getRequestManager());
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

}
