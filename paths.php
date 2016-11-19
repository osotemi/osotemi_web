<?php
  //SITE ROOT
  $path = $_SERVER['DOCUMENT_ROOT'] .'/';
  define('SITE_ROOT', $path);
  //SITE path
  define('SITE_PATH','https://'.$_SERVER['HTTP_HOST']);
  //production
  define('PRODUCTION',true);

  //Includes de 1er nivel
  //model
  define('MODEL_PATH', SITE_ROOT.'model/');
  //modules
  define('MODULES_PATH',SITE_ROOT.'modules/');
  //resources
  define('RESOURCES',SITE_ROOT.'resources/');
  //media
  define('MEDIA_PATH',SITE_ROOT.'media/');
  //utils
  define('UTILS',SITE_ROOT.'utils/');

  //Includes de 2º nivel
  //CSS
	define('CSS_PATH', SITE_PATH . 'view/css/');
  //view
  define('VIEW_PATH_INC',SITE_ROOT.'view/inc/');
  define('VIEW_PATH_INC_ERROR',SITE_ROOT.'view/inc/templates_error/');
  //log
  define('LOG_DIR', SITE_ROOT.'classes/Log.class.singleton.php');
  define('USER_LOG_DIR', SITE_ROOT.'log/user/Site_User_errors.log');
  define('GENERAL_LOG_DIR', SITE_ROOT.'log/general/Site_General_errors.log');

  //model products
  define('UTILS_PRODUCTS',SITE_ROOT.'modules/products/utils/');
  define('PRODUCTS_JS_LIB_PATH', SITE_PATH . 'modules/products/view/lib/');
	define('PRODUCTS_JS_PATH', SITE_PATH . 'modules/products/view/js/');
  define('PRODUCTS_CSS_PATH', SITE_PATH . 'modules/products/view/css/');
  //model list products
  define('FUNCTIONS_PRODUCTS_FE',SITE_ROOT.'modules/products_fe/utils/');
  define('MODEL_PATH_PRODUCTS_FE',SITE_ROOT.'modules/products_fe/model/');
  define('DAO_PRODUCTS_FE',SITE_ROOT.'modules/products_fe/model/DAO/');
  define('BLL_PRODUCTS_FE',SITE_ROOT.'modules/products_fe/model/BLL/');
  define('MODEL_PRODUCTS_FE',SITE_ROOT.'modules/products_fe/model/model/');
  define('USERS_JS_PRODUCTS_FE', SITE_PATH . 'modules/products_fe/view/js/');
	define('USERS_CSS_PRODUCTS_FE', SITE_PATH . 'modules/products_fe/view/css/');
  /*model users
  define('FUNCTIONS_USERS',SITE_ROOT.'modules/users/utils/');
  define('MODEL_PATH_USERS',SITE_ROOT.'modules/users/model/');
  define('DAO_USERS',SITE_ROOT.'modules/users/model/DAO/');
  define('BLL_USERS',SITE_ROOT.'modules/users/model/BLL/');
  define('MODEL_USERS',SITE_ROOT.'modules/users/model/model/');
  define('USERS_JS_PATH', SITE_PATH . 'modules/users/view/js/');
	define('USERS_CSS_PATH', SITE_PATH . 'modules/users/view/css/');
  */
