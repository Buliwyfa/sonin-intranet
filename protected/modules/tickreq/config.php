<?php
return [
	'id' => 'tickreq',
	'class' => 'humhub\modules\tickreq\Module',
	'namespace' => 'humhub\modules\tickreq',
	'events' => [
		[
			'class' => \humhub\widgets\TopMenu::className(),
			'event' => \humhub\widgets\TopMenu::EVENT_INIT,
			'callback' => ['humhub\modules\tickreq\Events', 'onTopMenuInit'],
		],
		[
			'class' => humhub\modules\admin\widgets\AdminMenu::className(),
			'event' => humhub\modules\admin\widgets\AdminMenu::EVENT_INIT,
			'callback' => ['humhub\modules\tickreq\Events', 'onAdminMenuInit']
		],
	],
];
?>

