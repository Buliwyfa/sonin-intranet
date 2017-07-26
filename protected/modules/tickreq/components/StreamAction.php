<?php

namespace humhub\modules\tickreq\components;

use Yii;
use humhub\modules\stream\actions\ContentContainerStream;
use humhub\modules\tickreq\models\tickreq;

class StreamAction extends ContentContainerStream
{

    /**
     * Setup additional filters
     */
    public function setupFilters()
    {
        // Limit output to specific content type
        $this->activeQuery->andWhere(['content.object_model' => tickreq::className()]);
    }

}

?>