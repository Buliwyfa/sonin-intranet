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
class SoninRequest extends BasePermission
{

    /**
     * @inheritdoc
     */
    protected $id = 'sonin_request';

    /**
     * @inheritdoc
     */
    protected $title = 'SONIN Corp Business & Investment View & Create';

    /**
     * @inheritdoc
     */
    protected $description = 'Can request in SONIN Corp and see only their own request';

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
