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
class GlobalRequest extends BasePermission
{

    /**
     * @inheritdoc
     */
    protected $id = 'global_request';

    /**
     * @inheritdoc
     */
    protected $title = 'Global View';

    /**
     * @inheritdoc
     */
    protected $description = 'Can see other people requests (useless without division permission)';

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
