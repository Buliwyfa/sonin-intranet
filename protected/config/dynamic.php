<?php return array (
  'components' => 
  array (
    'db' => 
    array (
      'class' => 'yii\\db\\Connection',
      'dsn' => 'mysql:host=localhost;dbname=intranet',
      'username' => 'root',
      'password' => '',
      'charset' => 'utf8',
    ),
    'user' => 
    array (
    ),
    'mailer' => 
    array (
      'transport' => 
      array (
        'class' => 'Swift_MailTransport',
      ),
      'view' => 
      array (
        'theme' => 
        array (
          'name' => 'Sonin',
          'basePath' => 'C:/wamp64/www/intranet/themes\\Sonin',
          'publishResources' => false,
        ),
      ),
    ),
    'cache' => 
    array (
      'class' => 'yii\\caching\\DummyCache',
      'keyPrefix' => 'humhub',
    ),
    'view' => 
    array (
      'theme' => 
      array (
        'name' => 'Sonin',
        'basePath' => 'C:/wamp64/www/intranet/themes\\Sonin',
        'publishResources' => false,
      ),
    ),
    'formatter' => 
    array (
      'defaultTimeZone' => 'Asia/Phnom_Penh',
    ),
    'formatterApp' => 
    array (
      'defaultTimeZone' => 'Asia/Phnom_Penh',
      'timeZone' => 'Asia/Phnom_Penh',
    ),
  ),
  'params' => 
  array (
    'installer' => 
    array (
      'db' => 
      array (
        'installer_hostname' => 'localhost',
        'installer_database' => 'intranet',
      ),
    ),
    'config_created_at' => 1500343416,
    'horImageScrollOnMobile' => '1',
    'databaseInstalled' => true,
    'installed' => true,
  ),
  'name' => 'SONIN Intranet',
  'language' => 'en',
  'timeZone' => 'Asia/Phnom_Penh',
); ?>