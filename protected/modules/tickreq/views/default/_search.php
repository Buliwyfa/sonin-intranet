<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model humhub\modules\tickreq\models\TickreqSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tickreq-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);
    $status = [null => 'None','1' => 'Open', '2' => 'Checked', '3' => 'Rejected','4' => 'Approved'];
    ?>

    <?= $form->field($model, 'requestcode') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'status')->dropDownList($status) ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'urgency') ?>

    <?php // echo $form->field($model, 'createdby') ?>

    <?php // echo $form->field($model, 'createdate') ?>

    <?php // echo $form->field($model, 'checkedby') ?>

    <?php // echo $form->field($model, 'checkdate') ?>

    <?php // echo $form->field($model, 'approvedby') ?>

    <?php // echo $form->field($model, 'approvedate') ?>

    <?php // echo $form->field($model, 'requiredate') ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<i class="fa fa-refresh"></i>', ['class' => 'btn btn-default']) ?>
        <?= Html::a('<i class="fa fa-plus-circle"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
