<?php

namespace humhub\modules\tickreq\notifications;


use Yii;
use humhub\libs\Html;
use humhub\modules\notification\components\BaseNotification;
use yii\helpers\Url;

class CheckRequest extends BaseNotification
{
    /**
     * @inheritdoc
     */
    public $moduleId = 'tickreq';
    public $viewName = 'requestnotice';
    public $markAsSeenOnClick = true;

    public function category()
    {
        return new RequestNotificationCategory();
    }

    public function html()
    {
                return Yii::t('TickreqModule.views_notifications_newupdaterequest', '{username} has <span class="color-indigo-a200"><b>checked</b></span> the request {code}.', [
                    '{username}' => Html::tag('strong', Html::encode($this->originator->displayName)),
                    '{code}' => Html::tag('strong', Html::encode($this->source->requestcode)),
                ]);

    }
    public function getViewParams($params = [])
    {
        $result = [
            'url' => Url::to(['/tickreq/default/notification', 'id' =>$this->record->id, 'rid' =>$this->source->id], true),
        ];
        return \yii\helpers\ArrayHelper::merge(parent::getViewParams($result), $params);
    }
}

?>
