<?php

return array(
    // application data
    'name' => 'BTI',
    'version' => '1.0.1',
    
    // installation settings
    'installationKey' => '0oxsfnxzcv',

    // password keys settings (for database passwords only - don't change it)
    // md5, sha1, sha256, whirlpool, etc.
	'password' => array(
        'encryption' => true,
        'encryptAlgorithm' => 'sha256', 
        'hashKey' => 'apphp_framework',    
    ),
    
    // email settings
	'email' => array(
        'mailer' => 'smtpMailer', /* phpMail | phpMailer | smtpMailer */
        'from'   => 'info@email.me',
        'isHtml' => true,
        'smtp'   => array(
            'secure' => 'ssl',
            'host' => 'smtp.gmail.com',
            'port' => '465',
            'username' => '',
            'password' => '',
        ),
    ),
    
    // validation
   	'validation' => array(
        'csrf' => true
    ),

    // session settings
    'session' => array(
        'cacheLimiter' => '' /* private,must-revalidate */
    ),
    
    // cache settings 
    'cache' => array(
        'enable' => false, 
        'lifetime' => 20,  /* in minutes */
        'path' => 'protected/tmp/cache/'
    ),

    // datetime settings
    'defaultTimeZone' => 'UTC',
    
    // application settings
    'defaultTemplate' => 'default',
	'defaultController' => 'Index',
    'defaultAction' => 'index',
    
    // application modules
    'modules' => array(
        'setup' => array('enable' => true)
    ),

    // url manager
    'urlManager' => array(
        'urlFormat' => 'shortPath',  /* get | path | shortPath */
        'rules' => array(
            //'controller/action/value1/value2' => 'controller/action/param1/value1/param2/value2',
        ),
    ),
    
);