<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\tickreq\permissions;
use humhub\modules\admin\components\BaseAdminPermission;


/**
 * CreatePublicSpace Permission
 */
class ApproveRequest extends BaseAdminPermission
{

    /**
     * @inheritdoc
     */
    protected $id = 'approve_request';

    /**
     * @inheritdoc
     */
    protected $title = 'Approve & Reject';

    /**
     * @inheritdoc
     */
    protected $description = 'Can check, approve, reject and has a global view permission';

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
