<?php

namespace humhub\modules\tickreq\controllers;

use humhub\modules\tickreq\permissions\CheckRequest;
use humhub\modules\tickreq\permissions;
use humhub\modules\user\models\Group;
use humhub\modules\user\models\User;
use Yii;
use humhub\modules\tickreq\models\Tickreq;
use humhub\modules\tickreq\models\TickreqSearch;
use humhub\modules\notification\models\Notification;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use humhub\modules\tickreq\permissions\ApproveRequest;

/**
 * TickreqController implements the CRUD actions for Tickreq model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tickreq models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TickreqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $canApprove = Yii::$app->user->can(new ApproveRequest());
        $canCheck = Yii::$app->user->can(new CheckRequest());
        $ITService = Yii::$app->user->can(new permissions\ITServiceRequest());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'canApprove' => $canApprove,
            'canCheck' => $canCheck,
            'ITService' => $ITService,
        ]);
    }

    /**
     * Displays a single Tickreq model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $source = Group::find()->where(['id' => $model->source])->one();
        $user = User::find()->where(['id' => Yii::$app->user->getId()])->one();
        $canApprove = Yii::$app->user->can(new ApproveRequest());
        $canCheck = Yii::$app->user->can(new CheckRequest());
        $ITService = Yii::$app->user->can(new permissions\ITServiceRequest());
        return $this->render('view', [
            'model' => $model,
            'canApprove' => $canApprove,
            'canCheck' => $canCheck,
            'ITService' => $ITService,
            'source' => $source->name,
        ]);
    }

    /**
     * Creates a new Tickreq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

 /*   private function getSource(){
        $source = null;
        if(Yii::$app->user->can(new permissions\AyraRequest())){
            $source[4] = 'AYRA';
        }else{}
        if(Yii::$app->user->can(new permissions\HiaRequest())){
            $source[8] = 'HIA';
        }else{}
        if(Yii::$app->user->can(new permissions\IdeaRequest())){
            $source[9] = 'IDEA';
        }else{}
        if(Yii::$app->user->can(new permissions\RmisppRequest())){
            $source[10] = 'RMISPP';
        }else{}
        if(Yii::$app->user->can(new permissions\SoninRequest())){
            $source[7] = 'SONIN';
        }else{}
        if(Yii::$app->user->can(new permissions\SonineduRequest())){
            $source[11] = 'SONIN EDUCATION';
        }else{}
        if(Yii::$app->user->can(new permissions\SoninpropRequest())){
            $source[12] = 'SONIN PROPERTY';
        }else{}
        if(Yii::$app->user->can(new permissions\TeavRequest())){
            $source[13] = 'TEAV';
        }else{}
        return $source;
    }*/

    public function actionCreate()
    {
        $model = new Tickreq();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'source' => $model->getSource(),
            ]);
        }
    }

    /**
     * Updates an existing Tickreq model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'source' => $model->getSource(),
            ]);
        }
    }

/*    public function actionApprove($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('approve', [
                'model' => $model,
            ]);
        }
    }*/

    public function actionCheck($id)
    {
        $model = $this->findModel($id);
        $model->status = 2;
        $model->checkdate =  Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
        $model->checkedby = Yii::$app->user->identity->getId();
        $model->update();
        return $this->redirect(['index']);
    }
    public function actionReject($id)
    {
        $model = $this->findModel($id);
        $model->status = 3;
        $model->rejectdate =  Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
        $model->rejectedby = Yii::$app->user->identity->getId();
        $model->update();
        return $this->redirect(['index']);
    }
    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $model->status = 4;
        $model->approvedate =  Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
        $model->approvedby = Yii::$app->user->identity->getId();
        $model->update();
        return $this->redirect(['index']);
    }
    /**
     * Deletes an existing Tickreq model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Notification::deleteAll('source_pk = ' . $id);


        return $this->redirect(['index']);
    }

    /**
     * Finds the Tickreq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tickreq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tickreq::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionNotification($rid)
    {
        $notificationModel = Notification::findOne(['id' => Yii::$app->request->get('id'), 'user_id' => Yii::$app->user->id]);

        if ($notificationModel === null) {
            throw new \yii\web\HttpException(404, 'Could not find requested notification!');
        }

        $notification = $notificationModel->getClass();

        $notification->markAsSeen();

        // Redirect to notification URL
        return $this->actionView($rid);
//        $canApprove = Yii::$app->user->can(new ApproveRequest());
//        $canCheck = Yii::$app->user->can(new CheckRequest());
//        return $this->render('view', [
//            'model' => $this->findModel($rid),
//            'canApprove' => $canApprove,
//            'canCheck' => $canCheck,
//        ]);
    }

    public function  actions()
    {
/*        return array(
            'stream' => array(
                'class' => \humhub\modules\tickreq\components\StreamAction::className(),
                'mode' => \humhub\modules\tickreq\components\StreamAction::MODE_NORMAL,
                'contentContainer' => $this->contentContainer
            ),
        );*/
    }
}
