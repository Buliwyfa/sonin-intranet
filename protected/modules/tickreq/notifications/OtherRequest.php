<?php

namespace humhub\modules\tickreq\notifications;

use humhub\modules\user\models\Profile;
use humhub\modules\user\models\User;
use Yii;
use humhub\libs\Html;
use humhub\modules\notification\components\BaseNotification;
use yii\helpers\Url;

class OtherRequest extends BaseNotification
{
    /**
     * @inheritdoc
     */
    public $moduleId = 'tickreq';
    public $viewName = 'requestnotice';
    public $markAsSeenOnClick = true;

    public function html()
    {
            if($this->source->status == 1){
                return Yii::t('TickreqModule.views_notifications_newupdaterequest', '{username} has update the request {code}.', [
                '{username}' => Html::tag('strong', Html::encode($this->originator->displayName)),
                '{code}' => Html::tag('strong', Html::encode($this->source->requestcode)),
                    ]);
            }
            elseif($this->source->status == 2){
                return Yii::t('TickreqModule.views_notifications_newupdaterequest', '{username} has checked the request {code}.', [
                    '{username}' => Html::tag('strong', Html::encode($this->originator->displayName)),
                    '{code}' => Html::tag('strong', Html::encode($this->source->requestcode)),
                ]);
            }
            elseif($this->source->status == 3){
                $checku = $this->source->getUserName($this->source->checkedby);
                return Yii::t('TickreqModule.views_notifications_newupdaterequest', '{username} has rejected the request {code} which was
                checked by {checkedby}', [
                    '{username}' => Html::tag('strong', Html::encode($this->originator->displayName)),
                    '{code}' => Html::tag('strong', Html::encode($this->source->requestcode)),
                    '{checkedby}' => Html::tag('strong',Html::encode($checku)),
                ]);
            }
            else{
                return Yii::t('TickreqModule.views_notifications_newupdaterequest', '{username} has approved  the request {code}.', [
                    '{username}' => Html::tag('strong', Html::encode($this->originator->displayName)),
                    '{code}' => Html::tag('strong', Html::encode($this->source->requestcode)),
                ]);
            }
    }
    public function getViewParams($params = [])
    {
        $result = [
            'url' => Url::to(['/notification/entry', 'id' => $this->record->id], true),
        ];
        return \yii\helpers\ArrayHelper::merge(parent::getViewParams($result), $params);
    }
}

?>
