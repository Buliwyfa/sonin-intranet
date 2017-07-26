<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\tickreq\notifications;

use Yii;
use humhub\modules\notification\components\NotificationCategory;

/**
 * Description of ContentCreatedNotificationCategory
 *
 * @author buddha
 */
class RequestNotificationCategory extends NotificationCategory
{

    /**
     * @inheritdoc
     */
    public $id = "request_notice";

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return Yii::t('ContentModule.notifications_ContentCreatedNotificationCategory', 'Receive Notifications for action related to Request module.');
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return Yii::t('ContentModule.notifications_ContentCreatedNotificationCategory', 'Request Activities');
    }

}
