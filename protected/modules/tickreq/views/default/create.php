<?php

use yii\helpers\Html;
use humhub\modules\tickreq\Assets;

Assets::register($this);

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
</script>
