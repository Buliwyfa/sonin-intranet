<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model humhub\modules\tickreq\models\Tickreq */

$this->title = 'Update Tickreq: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tickreqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><h1><?= Html::encode($this->title) ?></h1></div>
        <div class="panel-body">
                <?= $this->render('_approve', [
                    'model' => $model,
                ]) ?>
        </div>
    </div>
</div>
