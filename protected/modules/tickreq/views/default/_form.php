<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\Expression;
//this script gets the id and email "as name" from hum hub

/* @var $this yii\web\View */
/* @var $model humhub\modules\tickreq\models\Tickreq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tickreq-form">

    <?php

        $status = ['1' => 'Open'];
        $type = ['1' => 'Purchase', '2' => 'IT Service', '3' => 'Other Service'];
        $urgency = ['1' => 'Normal', '2' => 'Urgent'];
        $now = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
    ?>

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <div class="col-md-10 col-xs-12">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'source')->dropDownList($source)?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'status')->dropDownList($status)?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'quantity')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'cost')->textInput() ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'type')->dropDownList($type) ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'urgency')->dropDownList($urgency) ?>
        </div>
            <?= $form->field($model, 'createdby')->hiddenInput(['value' => $uid])->label(false) ?>
            <?= $form->field($model, 'createdate')->hiddenInput(['value'=> $now])->label(false) ?>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'requiredate')->widget(\yii\jui\DatePicker::classname(), [
                //'language' => 'ru',
                'dateFormat' => 'yyyy-MM-dd',
            ]) ?>
        </div>
    </div>
    <div class="col-xs-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
