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
            <?= $form->field($model, 'description', ['options' => ['class' => ' input-field ']])->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'source', ['options' => ['class' => ' input-field fly-label']])->dropDownList($source) ?>
        </div>

    </div>
    <div class="form-group">
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'status', ['options' => ['class' => ' input-field fly-label']])->dropDownList($status) ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'quantity', ['options' => ['class' => ' input-field ']])->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'cost', ['options' => ['class' => ' input-field ']])->textInput() ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'type', ['options' => ['class' => ' input-field fly-label']])->dropDownList($type) ?>
        </div>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'urgency', ['options' => ['class' => ' input-field fly-label']])->dropDownList($urgency) ?>
        </div>
            <?= $form->field($model, 'createdby')->hiddenInput(['value' => $uid])->label(false) ?>
            <?= $form->field($model, 'createdate')->hiddenInput(['value'=> $now])->label(false) ?>
        <div class="col-md-2 col-xs-12">
            <?= $form->field($model, 'requiredate', ['options' => ['class' => ' input-field ']])->widget(\yii\jui\DatePicker::classname(), [
                'dateFormat' => 'yyyy-MM-dd',
                'options' => ['class' => 'datepicker']
            ]) ?>
        </div>
    </div>
    <div class="col-xs-12">

        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
