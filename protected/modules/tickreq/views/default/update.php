<?php

use yii\helpers\Html;
use humhub\modules\tickreq\Assets;

Assets::register($this);
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
                <?= $this->render('_form', [
                    'model' => $model,
                    'source' => $source,
                    'uid' => $model->createdby,
                ]) ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="<?= $this->theme->getBaseUrl(); ?>/js/materialize.min.js"></script>
<script>
    $(document).ready(function () {
        $('select').material_select();
    });
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        format: 'yyyy-mm-dd',
        closeOnSelect: false // Close upon selecting a date,
    });
    $(function () {
        Materialize.updateTextFields();
    });
</script>