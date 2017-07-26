<?php

namespace humhub\modules\tickreq;

use Yii;
use yii\helpers\Url;

class Events extends \yii\base\Object
{

    /**
     * Defines what to do when the top menu is initialized.
     *
     * @param $event
     */
    public static function onTopMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => "Request",
            'icon' => '<i class="fa fa-cube"></i>',
            'url' => Url::to(['/tickreq/default']),
            'sortOrder' => 99999,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'tickreq' && Yii::$app->controller->id == 'default'),
        ));
    }


    /**
     * Defines what to do if admin menu is initialized.
     *
     * @param $event
     */
    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => "Tickreq",
            'url' => Url::to(['/tickreq/admin']),
            'group' => 'manage',
            'icon' => '<i class="fa fa-certificate" style="color: #6fdbe8;"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'tickreq' && Yii::$app->controller->id == 'admin'),
            'sortOrder' => 99999,
        ));
    }

}

