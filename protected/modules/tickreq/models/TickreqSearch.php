<?php

namespace humhub\modules\tickreq\models;

use humhub\modules\tickreq\notifications\CheckRequest;
use humhub\modules\tickreq\permissions;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use humhub\modules\tickreq\models\Tickreq;
use yii\web\Request;


/**
 * TickreqSearch represents the model behind the search form about `humhub\modules\tickreq\models\Tickreq`.
 */
class TickreqSearch extends Tickreq
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'quantity', 'type', 'urgency', 'createdby', 'checkedby', 'rejectedby', 'approvedby','requestcode'], 'integer'],
            [['description', 'createdate', 'checkdate', 'approvedate', 'rejectdate','requiredate'], 'safe'],
            [['cost'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $model = new \humhub\modules\tickreq\models\tickreq();
        $groups = $model->getSource();

        $query = Tickreq::find();
        $query->andFilterWhere(['like', 'description', $this->description]);

        foreach($groups as $key => $value) {
            $query->orWhere(['source' => $key]);
        }


/*        if(Yii::$app->user->can(new permissions\ViewRequest())){
            foreach ($groups as $group){
                $query->orWhere(['source' => $group->id]);
            }
        }
        else{

        }*/

/*        if(Yii::$app->user->can(new permissions\AyraRequest())){
            $query->orWhere(['source' =>14]);
        }else{}
        if(Yii::$app->user->can(new permissions\HiaRequest())){
            $query->orWhere(['source' =>8]);
        }else{}
        if(Yii::$app->user->can(new permissions\IdeaRequest())){
            $query->orWhere(['source' =>9]);
        }else{ }
        if(Yii::$app->user->can(new permissions\RmisppRequest())){
            $query->orWhere(['source' =>10]);
        }else{ }
        if(Yii::$app->user->can(new permissions\SoninRequest())){
            $query->orWhere(['source' =>7]);
        }else{ }
        if(Yii::$app->user->can(new permissions\SonineduRequest())){
            $query->orWhere(['source' =>11]);
        }else{ }
        if(Yii::$app->user->can(new permissions\SoninpropRequest())){
            $query->orWhere(['source' =>12]);
        }else{ }
        if(Yii::$app->user->can(new permissions\TeavRequest())){
            $query->orWhere(['source' =>13]);
        }else{ }*/

        if(Yii::$app->user->can(new permissions\GlobalRequest())){

        }else{$query->andWhere(['createdby' => Yii::$app->user->getIdentity()->getId()]);}

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['requestcode'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'quantity' => $this->quantity,
            'cost' => $this->cost,
            'type' => $this->type,
            'urgency' => $this->urgency,
            'createdby' => $this->createdby,
            'createdate' => $this->createdate,
            'checkedby' => $this->checkedby,
            'checkdate' => $this->checkdate,
            'approvedby' => $this->approvedby,
            'approvedate' => $this->approvedate,
            'rejectedby' => $this->rejectedby,
            'rejectdate' => $this->rejectdate,
            'requiredate' => $this->requiredate,
            'requestcode' => $this->requestcode,
        ]);


        return $dataProvider;
    }
}
