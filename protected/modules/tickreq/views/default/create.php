<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model humhub\modules\tickreq\models\Tickreq */

$this->title = 'Create Request';
$this->params['breadcrumbs'][] = ['label' => 'Request', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><h1><?= Html::encode($this->title) ?></h1></div>

        <div class="panel-body">
            <?= $source = null ? 'You can not use Request Module, please contact Administrator' :
             $this->render('_form', [
                'model' => $model,
                 'source' => $source,
                 'uid' => Yii::$app->user->identity->getId(),
            ]) ?>
	    </div>
    </div>
</div>
