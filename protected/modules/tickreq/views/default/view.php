<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model humhub\modules\tickreq\models\Tickreq */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tickreqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading color-blue-grey-500"><b>Request Code : <span class="color-orange-500"><?= Html::encode($model->requestcode) . "</span> by <span class='color-blue-400  '>" . $model->getCreator() . '</span> on ' . $model->createdate;?></span></b>
        </div>

        <div class="panel-body">
                <div class="row show-grid">
                    <div class="col-md-10 col-xs-7"><h5><b>Description</b></h5></div>
                    <div class="col-md-2 col-xs-5"><h5><b>Source</b></h5></div>
                    <div class="col-md-10 col-xs-7"><?= $model->description;?></div>
                    <div class="col-md-2 col-xs-5"><?= $source?></div>
                </div>
                <div class="row show-grid">
                    <div class="col-md-12 text-primary"><h5><b>Details</b></h5></div>
                    <div class="col-md-1 col-xs-7"><b>Status</b></div>
                    <div class="col-md-1 col-xs-5"><?= $model->getStatusName();?></div>
                    <div class="col-md-1 col-xs-7"><b>Type</b></div>
                    <div class="col-md-1 col-xs-5"><?= $model->getTypeName();?></div>
                    <div class="col-md-1 col-xs-7"><b>Urgency</b></div>
                    <div class="col-md-1 col-xs-5"><?= $model->getUrgencyName();?></div>
                    <div class="col-md-2 col-xs-7"><b>Require Date</b></div>
                    <div class="col-md-2 col-xs-5"><?= $model->requiredate;?></div>
                </div>
                <div class="row show-grid">
                    <div class="col-md-12 text-primary"><h5><b>Status</b></h5></div>
                    <?php switch ($model->status){
                    case 1:?>
                    <?php break; case 2:?>
                            <div class="col-md-2 col-xs-7"><b>Checked by</b></div>
                            <div class="col-md-3 col-xs-5"><?= $model->getUserName($model->checkedby);?></div>
                            <div class="col-md-2 col-xs-7"><b>Checked date</b></div>
                            <div class="col-md-5 col-xs-5"><?= $model->checkdate;?></div>
                    <?php break; case 3:?>
                            <div class="col-md-2 col-xs-7 color-indigo-600"><b>Checked by</b></div>
                            <div class="col-md-3 col-xs-5"><?= $model->getUserName($model->checkedby);?></div>
                            <div class="col-md-2 col-xs-7 color-indigo-600"><b>Checked date</b></div>
                            <div class="col-md-5 col-xs-5"><?= $model->checkdate;?></div>

                            <div class="col-md-2 col-xs-7 color-red-600"><b>Rejected by</b></div>
                            <div class="col-md-3 col-xs-5"><?= $model->getUserName($model->rejectedby);?></div>
                            <div class="col-md-2 col-xs-7 color-red-600"><b>Reject date</b></div>
                            <div class="col-md-5 col-xs-5"><?= $model->rejectdate;?></div>
                    <?php break; default:?>
                            <div class="col-md-2 col-xs-7 color-indigo-600"><b>Checked by</b></div>
                            <div class="col-md-3 col-xs-5"><?= $model->getUserName($model->checkedby);?></div>
                            <div class="col-md-2 col-xs-7 color-indigo-600"><b>Checked date</b></div>
                            <div class="col-md-5 col-xs-5"><?= $model->checkdate;?></div>

                            <div class="col-md-2 col-xs-7 color-light-green-500"><b>Approved by</b></div>
                            <div class="col-md-3 col-xs-5"><?= $model->getUserName($model->approvedby);?></div>
                            <div class="col-md-2 col-xs-7 color-light-green-500"><b>Approve date</b></div>
                            <div class="col-md-5 col-xs-5"><?= $model->approvedate;?></div>
                    <?php }?>
                </div>
                <div class="row show-grid ">
                    <div class="col-md-12 text-primary"><h5><b>Cost detail</b></h5></div>
                    <div class="col-md-1 col-xs-7"><b>Quantity</b></div>
                    <div class="col-md-1 col-xs-5"><?= $model->quantity;?></div>
                    <div class="col-md-1 col-xs-7"><b>Cost</b></div>
                    <div class="col-md-1 col-xs-5"><?= number_format($model->cost,2) . "$";?></div>
                    <div class="col-md-1 col-xs-7"><b>Amount</b></div>
                    <div class="col-md-1 col-xs-5"><?= number_format($model->quantity * $model->cost, 2) . "$";?></div>
                </div>
            <div>
                <div class="col-lg-8 col-xs-7">
                    <?= $model->status <= 2 ? Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : ''; ?>
                    <?= Html::a('Back', ['index'], ['class' => 'btn btn-primary bg-primary']) ?>
                    <?php if($model->status < 2) {?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?php } else{}?>
                </div>
                <div class="col-lg-4 col-xs-5">
                    <?php if($model->status == 1 && $canCheck) {?>
                        <?= Html::a('Check', ['check', 'id' => $model->id], ['class' => 'btn btn-primary bg-indigo-300']);?>
                        <?php } elseif($model->status == 2 && $canApprove){?>
                    <?= Html::a('Reject', ['reject', 'id' => $model->id], ['class' => 'btn btn-primary bg-red-500']);?>
                    <?= Html::a('Approve', ['approve', 'id' => $model->id], ['class' => 'btn btn-primary bg-light-green-700']);?>
                    <?php }
                    else {
                    echo 'You cannot modify this request status';
                    }?>
                </div>

            </div>
<!--                <?/*= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'description',
                    'status',
                    'quantity',
                    'cost',
                    'type',
                    'urgency',
                    'createdby',
                    'createdate',
                    'checkedby',
                    'checkdate',
                    'approvedby',
                    'approvedate',
                    'requiredate',
                ],
            ]) */?>-->
            </div>
    </div>
</div>
