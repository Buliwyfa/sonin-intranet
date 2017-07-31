<?php

use yii\helpers\Html;
use yii\grid\GridView;
use humhub\modules\tickreq\models\tickreq;

use yii\bootstrap\ButtonDropdown;
use humhub\modules\tickreq\Assets;

Assets::register($this);

/* @var $this yii\web\View */
/* @var $searchModel humhub\modules\tickreq\models\TickreqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Request Information';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->user->setReturnUrl(Yii::$app->request->url);
?>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body  bg-blue-grey-700" style="padding:0;border-radius: 5px;">
                <div class="col-lg-2  color-light-text-primary" style="padding:10px; border-radius: 5px 0 0 5px;">
                    <div><h1 class="color-indigo-50">Search Request</h1></div>
                    <?php echo $this->render('_search', ['model' => $searchModel]); ?></div>
                <div class="col-lg-10 bg-light-text-primary" style="padding: 10px;border-radius:0 5px 5px 0;">
                    <div><h1><?= Html::encode($this->title) ?></h1></div>
                    <div class="table-responsive">
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            //        'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'requestcode',
                                'description',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        switch ($model->status) {
                                            case 1:
                                                return 'Open';
                                                break;
                                            case 2:
                                                return 'Checked';
                                                break;
                                            case 3:
                                                return 'Rejected';
                                                break;
                                            case 4:
                                                return 'Approved';
                                            case 5:
                                                return 'Completed';
                                            default:
                                                return 'Failed';
                                                break;
                                        }
                                    },
                                    'contentOptions' => function ($model, $key, $index, $column) {
                                        switch ($model->status) {
                                            case 1:
                                                return ['style' => 'color: #3F51B5;font-weight:bold;width:100px;'];
                                                break;
                                            case 2:
                                                return ['style' => 'color: #FFA726;font-weight:bold;width:100px;'];
                                            case 3:
                                                return ['style' => 'color: #f44336;font-weight:bold;width:100px;'];
                                                break;
                                            case 4:
                                                return ['style' => 'color: #89CC5E;font-weight:bold;width:100px;'];
                                                break;
                                            case 5:
                                                return ['style' => 'color: #2E7D32;font-weight:bold;width:100px;'];
                                                break;
                                            default:
                                                return ['style' => 'color: #b71c1c;font-weight:bold;width:100px;'];
                                                break;
                                        }
                                    },
                                ],
                                ['attribute' => 'quantity',
                                    'label' => 'Quantity',
                                    'contentOptions' => ['style' => 'width:80px;  min-width:60px;  '],
                                ],
                                ['attribute' => 'cost',
                                    'label' => 'Cost',
                                    'contentOptions' => ['style' => 'width:100px;  min-width:80px;  '],
                                    'value' => function ($model) {
                                        return number_format($model->cost, 2) . '$';
                                    }
                                ],
                                // 'type',
                                // 'urgency',
                                [
                                    'attribute' => 'createdby',
                                    'value' => function ($model) {
                                        $user = new tickreq();
                                        return $user->getUserName($model->createdby);
                                    },
                                ],
                                // 'createdate',
                                // 'checkedby',
                                // 'checkdate',
                                // 'approvedby',
                                // 'approvedate',
                                // 'requiredate',

                                ['class' => 'yii\grid\ActionColumn',
                                    'template' => '{Option}',
                                    'options' => ['class' => 'waves-effect waves-light'],
                                    //NORMAL BUTTON VIEW
//                                'template' => '{view} {update} {delete} {check} {reject} {approve}',
                                    /*'buttons'=>[
                                        'view' => function ($url, $model, $key) {
                                            return Html::a('<span class="fa fa-eye padding-5 bg-primary bg-light-text-primary"></span>', $url, [
                                                    'title' => Yii::t('app', 'View request'),
                                                ]);
                                        },
                                        'update' => function ($url, $model, $key) {
                                        return $model->status > 2 ?
                                            Html::label('<span class="fa fa-pencil crosshair bg-dark-text-disabled color-light-text-primary padding-5"></span>', '')
                                            : Html::a('<span class="fa fa-pencil padding-5 bg-primary color-light-text-primary"></span>', $url, [
                                                'title' => Yii::t('app', 'Update your request'),
                                            ]);
                                        },
                                        'delete' => function ($url, $model, $key) {
                                            return $model->status > 2 ?
                                                Html::label('<span class="fa fa-trash crosshair bg-dark-text-disabled color-light-text-primary padding-5"></span>', '')
                                                :  Html::a('<span class="fa fa-trash padding-5 bg-primary color-light-text-primary"></span>', $url, [
                                                    'title' => Yii::t('yii', 'Delete'),
                                                    'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                                    'data-method' => 'post',
                                                ]);
                                        },
                                        'check' => function ($url, $model, $key) use ($canCheck) {
                                            return !$canCheck ? '' : ($model->status >= 2 ?
                                                Html::label('<span class="fa fa-check-square-o crosshair bg-dark-text-disabled  color-light-text-primary padding-5"></span>', '')
                                                :  Html::a('<span class="fa fa-check-square-o bg-indigo-600 color-light-text-primary padding-5"></span>', $url, [
                                                    'title' => Yii::t('app', 'Set request status as checked'),
                                                    'data-confirm' => Yii::t('yii', 'Are you sure to mark this as checked?'),
                                                    'data-method' => 'post',
                                                ]));
                                        },
                                        'reject' => function ($url, $model, $key) use ($canApprove) {
                                            return !$canApprove ? '': ($model->status >= 3 || $model->status <= 1 ?
                                                Html::label('<span class="fa fa-times crosshair bg-dark-text-disabled  color-light-text-primary padding-5"></span>', '')
                                                :  Html::a('<span class="fa fa-times bg-red-600  color-light-text-primary padding-5"></span>', $url, [
                                                    'title' => Yii::t('app', 'Set request status as checked'),
                                                ]));
                                        },
                                        'approve' => function ($url, $model, $key) use ($canApprove){
                                                return !$canApprove ? '' : ($model->status >= 3 || $model->status <= 1 ?
                                                Html::label('<span class="fa fa-thumbs-up crosshair bg-dark-text-disabled  color-light-text-primary padding-5"></span>', '')
                                                :  Html::a('<span class="fa fa-thumbs-up bg-light-green-600  color-light-text-primary padding-5"></span>', $url, [
                                                    'title' => Yii::t('app', 'Set request status as checked'),
                                                ]));
                                        },
                                        ]*/
                                    //DROP DOWN BUTTON VIEW
                                    'buttons' => [
                                        'Option' => function ($url, $model, $key) use ($canCheck, $canApprove, $canComplete) {
                                            return ButtonDropdown::widget([
                                                'encodeLabel' => false, // if you're going to use html on the button label
                                                'label' => 'Option',
                                                'class' => 'touch',
                                                'dropdown' => [
                                                    'encodeLabels' => false, // if you're going to use html on the items' labels
                                                    'items' => [
                                                        [
                                                            'label' => \Yii::t('yii', 'View'),
                                                            'url' => ['view', 'id' => $key],

                                                        ],
                                                        [

                                                            'label' => \Yii::t('yii', 'Update'),
                                                            'url' => ['update', 'id' => $key],
                                                            'visible' => $model->status > 2 ? false : true,  // if you want to hide an item based on a condition, use this
                                                        ],
                                                        [
                                                            'label' => \Yii::t('yii', 'Delete'),
                                                            'linkOptions' => [
                                                                'data' => [
                                                                    'method' => 'post',
                                                                    'confirm' => \Yii::t('yii', 'Are you sure you want to delete this item?'),
                                                                ],
                                                            ],
                                                            'url' => ['delete', 'id' => $key],
                                                            'visible' => $model->status > 2 ? false : true,   // same as above
                                                        ],
                                                        [
                                                            'label' => \Yii::t('yii', 'Check'),
                                                            'linkOptions' => [
                                                                'data' => [
                                                                    'method' => 'post',
                                                                    'confirm' => \Yii::t('yii', 'Are you sure you want to check this item?'),
                                                                ],
                                                            ],
                                                            'url' => ['check', 'id' => $key],
                                                            'visible' => !$canApprove ? false : ($model->status < 2 ? true : false),   // same as above
                                                        ],
                                                        [
                                                            'label' => \Yii::t('yii', 'Reject'),
                                                            'linkOptions' => [
                                                                'data' => [
                                                                    'method' => 'post',
                                                                    'confirm' => \Yii::t('yii', 'Are you sure you want to reject this request?'),
                                                                ],
                                                            ],
                                                            'url' => ['reject', 'id' => $key],
                                                            'visible' => !$canApprove ? false : ($model->status == 2 ? true : false),   // same as above
                                                        ],
                                                        [
                                                            'label' => \Yii::t('yii', 'Approve'),
                                                            'linkOptions' => [
                                                                'data' => [
                                                                    'method' => 'post',
                                                                    'confirm' => \Yii::t('yii', 'Are you sure you want to approve this request?'),
                                                                ],
                                                            ],
                                                            'url' => ['approve', 'id' => $key],
                                                            'visible' => !$canApprove ? false : ($model->status == 2 ? true : false),   // same as above
                                                        ],
                                                        [
                                                            'label' => \Yii::t('yii', 'Complete'),
                                                            'linkOptions' => [
                                                                'data' => [
                                                                    'method' => 'post',
                                                                    'confirm' => \Yii::t('yii', 'Are you sure you want to complete this request?'),
                                                                ],
                                                            ],
                                                            'url' => ['complete', 'id' => $key],
                                                            'visible' => !$canComplete ? false : ($model->status == 4 ? true : false),   // same as above
                                                        ],
                                                        [
                                                            'label' => \Yii::t('yii', 'Fail'),
                                                            'linkOptions' => [
                                                                'data' => [
                                                                    'method' => 'post',
                                                                    'confirm' => \Yii::t('yii', 'Are you sure you want to fail this request?'),
                                                                ],
                                                            ],
                                                            'url' => ['fail', 'id' => $key],
                                                            'visible' => !$canComplete ? false : ($model->status == 4 ? true : false),   // same as above
                                                        ],
                                                    ],
                                                    'options' => [
                                                        'class' => 'dropdown-menu-right', // right dropdown
                                                    ],
                                                ],
                                                'options' => [
                                                    'class' => 'btn-default',   // btn-success, btn-info, et cetera
                                                ],
                                                'split' => false,    // if you want a split button
                                            ]);
                                        },
                                    ],
                                ],
                            ],
                        ]); ?>
                    </div>
                    <!--<div style="margin-top:10px;float:none;"><? /*= Html::a('<i class="fa fa-plus-circle icon-left"></i>Request', ['create'], ['class' => 'btn btn-success']) */ ?></div>-->
                </div>


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
<?php

?>