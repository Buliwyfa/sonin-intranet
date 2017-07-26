<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\tickreq\permissions;
use humhub\libs\BasePermission;


/**
 * CreatePublicSpace Permission
 */
class SoninpropRequest extends BasePermission
{

    /**
     * @inheritdoc
     */
    protected $id = 'soninprop_request';

    /**
     * @inheritdoc
     */
    protected $title = 'SONIN Property View & Create';

    /**
     * @inheritdoc
     */
    protected $description = 'Can request in SONIN Property and see only their own request';

    /**
     * @inheritdoc
     */
    protected $moduleId = 'tickreq';

    /**
     * @inheritdoc
     */

    public function __construct($config = array()) {
        parent::__construct($config);

        $this->title = \Yii::t('TickreqModule.permissions', $this->title);
        $this->description = \Yii::t('TickreqModule.permissions', $this->description);
    }

}
