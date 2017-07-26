<?php

namespace humhub\modules\tickreq;
use humhub\modules\user\models\User;

class Module extends \humhub\components\Module
{
    public function getPermissions($contentContainer = null)
    {

        if ($contentContainer instanceof models\Space) {
            return [];
        } elseif ($contentContainer instanceof User) {
            return [];
        }

        return [
            new permissions\ApproveRequest(),
            new permissions\CheckRequest(),
            new permissions\AyraRequest(),
            new permissions\HiaRequest(),
            new permissions\IdeaRequest(),
            new permissions\RmisppRequest(),
            new permissions\SoninRequest(),
            new permissions\SonineduRequest(),
            new permissions\SoninpropRequest(),
            new permissions\TeavRequest(),
            new permissions\GlobalRequest(),
        ];

    }
}