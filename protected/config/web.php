<?php
return [
    // ...
    'modules' => [
        // ...
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1'],
            'generators' => [
                'module' => [
                    'class' => 'humhub\modules\devtools\Generator',
                    'templates' => [
                        'humhub' => '@app/modules/devtools/default',
                    ]
                ]
            ],
        ],
    ]
];
?>
?>