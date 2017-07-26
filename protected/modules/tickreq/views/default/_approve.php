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

    <?php if($model->isNewRecord) {
        $uid = Yii::$app->user->identity->getId();
        $status = ['1' => 'Open'];
        $type = ['1' => 'Purchase', '2' => 'Service'];
        $urgency = ['1' => 'Normal', '2' => 'Urgent'];
        $now = Yii::$app->formatter->asDate('now', 'yyyy-MM-dd');
    }
    else{
        $uid = Yii::$app->user->identity->getId();
        $status = ['1' => 'Open', '2' => 'Checked', '3' => 'Rejected','4' => 'Approved'];
        $type = ['1' => 'Purchase', '2' => 'Service'];
        $urgency = ['1' => 'Normal', '2' => 'Urgent'];
        $now = Yii::$app->formatter->asTimestamp('now');
    }
    ?>

    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
    <div class="col-xs-2">
    <?= $form->field($model, 'status')->dropDownList($status) ?>
    </div>
    <?= $form->field($model, 'checkedby')->hiddenInput(['value' => $uid])->label(false) ?>

    <?= $form->field($model, 'checkdate')->hiddenInput(['value'=> $now])->label(false) ?>
    </div>
    <div class="col-xs-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
