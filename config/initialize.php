<?php
// core paths definition
session_start();

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT')   ? null : define('SITE_ROOT', 'C:'.DS.'laragon'.DS.'www'.DS.'exmsl');
defined('HELP_PATH')   ? null : define('HELP_PATH', SITE_ROOT.DS.'helpers');
defined('CONFIG_PATH') ? null : define('CONFIG_PATH', SITE_ROOT.DS.'config');
defined('MODEL_PATH')  ? null : define('MODEL_PATH', SITE_ROOT.DS.'model');
defined('LANG_PATH')   ? null : define('LANG_PATH', SITE_ROOT.DS.'view'.DS.'lang');
defined('VIEWP')       ? null : define('VIEWP', SITE_ROOT.DS.'view'.DS.'public');

// load config file first
require_once(CONFIG_PATH.DS.'config.php');

// load functions
require_once(HELP_PATH.DS.'app.php');
require_once(HELP_PATH.DS.'database.php');
require_once(HELP_PATH.DS.'databaseObject.php');
require_once(HELP_PATH.DS.'form.php');
require_once(HELP_PATH.DS.'authentification.php');

// load models
require_once(MODEL_PATH.DS.'faq.php');
require_once(MODEL_PATH.DS.'support.php');
require_once(MODEL_PATH.DS.'login.php');
require_once(MODEL_PATH.DS.'adminsupport.php');
require_once(MODEL_PATH.DS.'adminfaq.php');
require_once(MODEL_PATH.DS.'admin.php');

// load language class
require_once(MODEL_PATH.DS.'language.php');