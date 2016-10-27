<?php

//include  with absolute route
include $_SERVER['DOCUMENT_ROOT'] . '/paths.php';
include SITE_ROOT . '/classes/Log.class.singleton.php';

include SITE_ROOT . '/utils/common.inc.php';
include SITE_ROOT . '/utils/filters.inc.php';
include SITE_ROOT . '/utils/response_code.inc.php';

$_SESSION['module'] = "products_FE";

/////////////////////////////////////////list_products
//obtain num total pages
if ((isset($_GET["num_pages"])) && ($_GET["num_pages"] === "true")) {
    $item_per_page = 3;
    $path_model = SITE_ROOT . '/modules/products_FE/model/model/';

    //change work error apache
    set_error_handler('ErrorHandler');

    try {
        //throw new Exception();
        $arrValue = loadModel($path_model, "products_FE_model", "total_products");
        $get_total_rows = $arrValue[0]["total"]; //total records
        $pages = ceil($get_total_rows / $item_per_page); //break total records into pages
    } catch (Exception $e) {
        showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }

    //change to defualt work error apache
    restore_error_handler();

    if ($get_total_rows) {
        $jsondata["pages"] = $pages;
        echo json_encode($jsondata);
        exit;
    } else {
        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }

}


if ((isset($_GET["view_error"])) && ($_GET["view_error"] === "true")) {
    showErrorPage(0, "ERROR - 503 BD Unavailable");
}
if ((isset($_GET["view_error"])) && ($_GET["view_error"] === "false")) {
    showErrorPage(0, "ERROR - 404 NO DATA");
}

////////////////////////details_products
/*
if (isset($_GET["idProduct"])) {
    $id = $_GET["idProduct"];
    $path_model = SITE_ROOT . '/modules/products_FE/model/model/';
    $arrValue = loadModel($path_model, "product_FE_model", "details_products",$id);

    if ($arrValue[0]) {
        loadView('modules/products_FE/view/', 'details_products.php', $arrValue[0]);
    } else {
        $message = "NOT FOUND PRODUCT";
        loadView('view/inc/templates_error/', 'error.php', $message);
    }
}
else{
    $path_model = SITE_ROOT . '/modules/products_FE/model/model/';
    $arrValue = loadModel($path_model, "product_FE_model", "list_products");

    if ($arrValue) {
        loadView('modules/products_FE/view/', 'list_products.php', $arrValue);
    } else {
        $message = "NOT PRODUCTS";
        loadView('view/inc/templates_error/', 'error.php', $message);
    }
}
*/
