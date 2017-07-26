<?php

use yii\helpers\Html;
use yii\grid\GridView;
use humhub\modules\tickreq\models\tickreq;

use yii\bootstrap\ButtonDropdown;

/* @var $this yii\web\View */
/* @var $searchModel humhub\modules\tickreq\models\TickreqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Request Information';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->user->setReturnUrl(Yii::$app->request->url);
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-body" style="padding:0;">
                <div class="col-lg-2 bg-blue-grey-700 color-light-text-primary" style="padding:10px; border-radius: 5px 0 0 5px;">
                    <div><h1 class="color-indigo-50">Search Request</h1></div>
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?></div>
                <div class="col-lg-10" style="padding: 10px;">
                    <div><h1><?= Html::encode($this->title) ?></h1></div>
                    <div class="table-responsive">
                        <?php foreach ($dataProvider->models as $model) {}
                        ?>
                    </div>
                </div>
        </div>
    </div>
</div>