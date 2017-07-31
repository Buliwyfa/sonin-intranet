<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use humhub\modules\like\widgets\LikeLink;
use humhub\modules\comment\widgets\Comments;
use humhub\modules\comment\widgets\CommentLink;
use humhub\modules\tickreq\Assets;

Assets::register($this);

/* @var $this yii\web\View */
/* @var $model humhub\modules\tickreq\models\Tickreq */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tickreqs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading color-blue-grey-500">
        <div class="col-md-12">
            <b>Request Code : <span
                        class="color-orange-500"><?= Html::encode($model->requestcode) . "</span> by <span class='color-blue-400  '>" . $model->getCreator() . '</span> on ' . $model->createdate; ?></span></b>
        </div>
    </div>

        <div class="panel-body">
                <div class="row show-grid">
                    <div class="col-md-7 col-xs-12">
                        <div class="row show-grid bg-light-green-400">
                            <div class="col-md-12 col-xs-12"><h5><b>Description</b></h5></div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-md-12 col-xs-12"><?= $model->description; ?></div>
                        </div>
                    </div>

                    <div class="col-md-5 col-xs-12">
                        <div class="row show-grid  bg-light-green-400">
                            <div class="col-md-12 col-xs-12"><h5><b>Details</b></h5></div>
                        </div>
                        <div class="row show-grid odd">
                            <div class="col-md-6 col-xs-5"><b>Source</b></div>
                            <div class="col-md-6 col-xs-7"><?= $source ?></div>
                        </div>
                        <div class="row show-grid even">
                            <div class="col-md-6 col-xs-5"><b>Status</b></div>
                            <div class="col-md-6 col-xs-7"><?= $model->getStatusName(); ?></div>
                        </div>
                        <div class="row show-grid odd">
                            <div class="col-md-6 col-xs-5"><b>Type</b></div>
                            <div class="col-md-6 col-xs-7"><?= $model->getTypeName(); ?></div>
                        </div>
                        <div class="row show-grid even">
                            <div class="col-md-6 col-xs-5"><b>Urgency</b></div>
                            <div class="col-md-6 col-xs-7"><?= $model->getUrgencyName(); ?></div>
                        </div>
                        <div class="row show-grid odd">
                            <div class="col-md-6 col-xs-5"><b>Require Date</b></div>
                            <div class="col-md-6 col-xs-7"><?= $model->requiredate; ?></div>
                        </div>
                    </div>
                </div>

            <div class="row show-grid">
                <div class="col-md-7 col-xs-12">
                    <div class="row show-grid bg-blue-300">
                        <div class="col-md-12 col-xs-12"><h5><b>Status</b></h5></div>
                    </div>
                    <?php switch ($model->status) {
                        case 1:
                            ?>
                            <?php break;
                        case 2: ?>
                            <div class="row show-grid odd">
                                <div class="col-md-3 col-xs-6"><b>Checked by</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->getUserName($model->checkedby); ?></div>
                                <div class="col-md-3 col-xs-6"><b>Checked date</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->checkdate; ?></div>
                            </div>

                            <?php break;
                        case 3: ?>
                            <div class="row show-grid odd">
                                <div class="col-md-3 col-xs-6 color-indigo-600"><b>Checked by</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->getUserName($model->checkedby); ?></div>
                                <div class="col-md-3 col-xs-6 color-indigo-600"><b>Checked date</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->checkdate; ?></div>
                            </div>
                            <div class="row show-grid even">
                                <div class="col-md-3 col-xs-6 color-red-600"><b>Rejected by</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->getUserName($model->rejectedby); ?></div>
                                <div class="col-md-3 col-xs-6 color-red-600"><b>Reject date</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->rejectdate; ?></div>
                            </div>
                            <?php break;
                        case 4: ?>
                            <div class="row show-grid odd">
                                <div class="col-md-3 col-xs-6 color-indigo-600"><b>Checked by</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->getUserName($model->checkedby); ?></div>
                                <div class="col-md-3 col-xs-6 color-indigo-600"><b>Checked date</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->checkdate; ?></div>
                            </div>
                            <div class="row show-grid even">

                                <div class="col-md-3 col-xs-6 color-light-green-500"><b>Approved by</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->getUserName($model->approvedby); ?></div>
                                <div class="col-md-3 col-xs-6 color-light-green-500"><b>Approve date</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->approvedate; ?></div>
                            </div>
                            <?php break;
                        case 5: ?>
                            <div class="row show-grid odd">
                                <div class="col-md-3 col-xs-6 color-indigo-600"><b>Checked by</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->getUserName($model->checkedby); ?></div>
                                <div class="col-md-3 col-xs-6 color-indigo-600"><b>Checked date</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->checkdate; ?></div>
                            </div>
                            <div class="row show-grid even">

                                <div class="col-md-3 col-xs-6 color-light-green-500"><b>Approved by</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->getUserName($model->approvedby); ?></div>
                                <div class="col-md-3 col-xs-6 color-light-green-500"><b>Approve date</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->approvedate; ?></div>
                            </div>
                            <div class="row show-grid odd">

                                <div class="col-md-3 col-xs-6 color-green-700"><b>Completed by</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->getUserName($model->completedby); ?></div>
                                <div class="col-md-3 col-xs-6 color-green-700"><b>Complete date</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->completedate; ?></div>
                            </div>
                            <?php break;
                        default: ?>
                            <div class="row show-grid odd">
                                <div class="col-md-3 col-xs-6 color-indigo-600"><b>Checked by</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->getUserName($model->checkedby); ?></div>
                                <div class="col-md-3 col-xs-6 color-indigo-600"><b>Checked date</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->checkdate; ?></div>
                            </div>
                            <div class="row show-grid even">

                                <div class="col-md-3 col-xs-6 color-light-green-500"><b>Approved by</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->getUserName($model->approvedby); ?></div>
                                <div class="col-md-3 col-xs-6 color-light-green-500"><b>Approve date</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->approvedate; ?></div>
                            </div>
                            <div class="row show-grid odd">

                                <div class="col-md-3 col-xs-6 color-red-900"><b>Failed by</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->getUserName($model->failedby); ?></div>
                                <div class="col-md-3 col-xs-6 color-red-900"><b>Failed date</b></div>
                                <div class="col-md-3 col-xs-6"><?= $model->faildate; ?></div>
                            </div>
                        <?php } ?>
                </div>

                <div class="col-md-5 col-xs-12">
                    <div class="row show-grid odd  bg-blue-300">
                        <div class="col-md-12 col-xs-12"><h5><b>Cost Detail</b></h5></div>
                    </div>
                    <div class="row show-grid odd">
                        <div class="col-md-6 col-xs-5"><b>Quantity</b></div>
                        <div class="col-md-6 col-xs-7"><?= $model->quantity; ?></div>
                    </div>
                    <div class="row show-grid even">
                        <div class="col-md-6 col-xs-5"><b>Cost per unit</b></div>
                        <div class="col-md-6 col-xs-7"><?= number_format($model->cost, 2) . "$"; ?></div>
                    </div>
                    <div class="row show-grid odd">
                        <div class="col-md-6 col-xs-5"><b>Amount</b></div>
                        <div class="col-md-6 col-xs-7"><?= number_format($model->quantity * $model->cost, 2) . "$"; ?></div>
                    </div>
                </div>
            </div>
            <div>
                <div class="fixed-action-btn toolbar">
                    <a class="btn-floating btn-large red">
                        <i class="large material-icons">mode_edit</i>
                    </a>
                    <ul>
                        <li class="waves-effect waves-light"><?= Html::a('arrow_back', ['index'], ['class' => 'material-icons']) ?></li>
                        <?php if ($model->status <= 2) { ?>
                            <li class="waves-effect waves-light"> <?= $model->status <= 2 ? Html::a('edit', ['update', 'id' => $model->id], ['class' => 'material-icons']) : ''; ?></li>
                            <li class="waves-effect waves-light"><?= Html::a('delete', ['delete', 'id' => $model->id], [
                                    'class' => 'material-icons',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]) ?></li>
                        <?php } else {
                        } ?>
                        <li class="waves-effect waves-light"><?= LikeLink::widget(['object' => $model]); ?></li>
                        <li class="waves-effect waves-light"><?= CommentLink::widget(['object' => $model]); ?></li>
                        <?php if ($model->status == 1 && $canCheck) { ?>
                            <li class="waves-effect waves-light"><?= Html::a('check', ['check', 'id' => $model->id], ['class' => 'material-icons']); ?></li>
                        <?php } elseif($model->status == 2 && $canApprove){?>
                            <li class="waves-effect waves-light"><?= Html::a('do_not_disturb_alt', ['reject', 'id' => $model->id], ['class' => 'material-icons']); ?></li>
                            <li class="waves-effect waves-light"><?= Html::a('check_circle', ['approve', 'id' => $model->id], ['class' => 'material-icons']); ?></li>

                        <?php } else {
                        } ?>
                    </ul>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12 comments">
                    <?= Comments::widget(['object' => $model]); ?>
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
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="<?= $this->theme->getBaseUrl(); ?>/js/materialize.min.js"></script>
