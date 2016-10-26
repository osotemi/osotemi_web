<?php

//include  with absolute route
$path = $_SERVER['DOCUMENT_ROOT'];

include($path . "/modules/products/utils/utils.inc.php");
define('SITE_ROOT', $path);

include $path . '/paths.php';
include $path . '/classes/Log.class.singleton.php';

include $path . '/utils/common.inc.php';
include $path . '/utils/filters.inc.php';
include $path . '/utils/response_code.inc.php';

$_SESSION['module'] = "products";

/////////////////////////////////////////list_products

if (isset($_GET["idProduct"])) {
    $id = $_GET["idProduct"];
    $path_model = SITE_ROOT . '/modules/products/model/model/';
    $arrValue = loadModel($path_model, "product_model", "details_products",$id);

    if ($arrValue[0]) {
        loadView('modules/products/view/', 'details_products.php', $arrValue[0]);
    } else {
        $message = "NOT FOUND PRODUCT";
        loadView('view/inc/', '404.php', $message);
    }
}
else{
    $path_model = SITE_ROOT . '/modules/products/model/model/';
    $arrValue = loadModel($path_model, "product_model", "list_products");

    if ($arrValue) {
        loadView('modules/products/view/', 'list_products.php', $arrValue);
    } else {
        $message = "NOT PRODUCTS";
        loadView('view/inc/', '404.php', $message);
    }
}
