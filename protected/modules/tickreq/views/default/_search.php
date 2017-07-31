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

    <?= $form->field($model, 'status', ['options' => ['class' => ' input-field fly-label']])->dropDownList($status) ?>

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
        <?= Html::submitButton('<i class="material-icons">search</i>', ['class' => 'bg-blue-300 waves-effect waves-light btn']) ?>
        <?= Html::resetButton('<i class="material-icons">clear</i>', ['class' => 'bg-blue-300 waves-effect waves-light btn']) ?>


        <div class="fixed-action-btn">
            <?= Html::a('<i class="large material-icons">add</i>', ['create'], ['class' => 'btn-floating btn-large red waves-effect waves-light']) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
