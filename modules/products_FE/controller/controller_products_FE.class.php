<?php

//include  with absolute route
include $_SERVER['DOCUMENT_ROOT'] . '/paths.php';
include(SITE_ROOT . "/modules/products_FE/utils/utils.inc.php");
include SITE_ROOT . '/classes/Log.class.singleton.php';
include SITE_ROOT . '/utils/common.inc.php';
include SITE_ROOT . '/utils/filters.inc.php';
include SITE_ROOT . '/utils/response_code.inc.php';

$_SESSION['module'] = "products_FE";

/////////////////////////////////////////Atutocomplete
if ((isset($_GET["autocomplete"])) && ($_GET["autocomplete"] === "true")) {
    set_error_handler('ErrorHandler');
    $model_path = SITE_ROOT . '/modules/products_FE/model/model/';
    try {

        $nameProducts = loadModel($model_path, "products_FE_model", "select_column_products_FE", "product_name");

    } catch (Exception $e) {
        //$jsondata["name_product"] = $nameProducts;
        //echo json_encode($jsondata);
        //exit;
        showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }
    restore_error_handler();

    if ($nameProducts) {
        $jsondata["name_product"] = $nameProducts;
        echo json_encode($jsondata);
        exit;
    } else {

        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }
}

if (isset($_GET["name_product"])) {
    //filtrar $_GET["name_product"]

    $result = filter_string($_GET["name_product"]);
    if ($result['resultado']) {
        $criteria = $result['datos'];
    } else {
        $criteria = '';
    }
    $model_path = SITE_ROOT . '/modules/products_FE/model/model/';
    set_error_handler('ErrorHandler');
    try {

        $arrArgument = array(
            "column" => "product_name",
            "like" => $criteria
        );
        $producto = loadModel($model_path, "products_FE_model", "select_like_products_FE", $arrArgument);

        //throw new Exception(); //que entre en el catch
    } catch (Exception $e) {
        showErrorPage(2, "ERROR en name product - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }
    restore_error_handler();

    if ($producto) {
        $jsondata["product_autocomplete"] = $producto;
        //$jsondata["arrArgument"] = $arrArgument;
        echo json_encode($jsondata);
        exit;
    } else {
        //if($producto){{ //que lance error si no existe el producto
        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }
}

if (isset($_GET["count_product"])) {
    //filtrar $_GET["count_product"]
    $result = filter_string($_GET["count_product"]);
    if ($result['resultado']) {
        $criteria = $result['datos'];
    } else {
        $criteria = '';
    }
    $model_path = SITE_ROOT . '/modules/products_FE/model/model/';
    set_error_handler('ErrorHandler');
    try {
        $arrArgument = array(
            "column" => "product_name",
            "like" => $criteria
        );

        $total_rows = loadModel($model_path, "products_FE_model", "count_like_products_FE", $arrArgument);
        //throw new Exception(); //que entre en el catch
    } catch (Exception $e) {
        showErrorPage(2, "ERROR en count- 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }
    restore_error_handler();

    if ($total_rows) {
        $jsondata["num_products"] = $total_rows[0]["total"];
        echo json_encode($jsondata);
        exit;
    } else {
        //if($total_rows){ //que lance error si no existe el producto
        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }
}

/////////////////////////////////////////list_products
//obtain num total pages
if ((isset($_GET["num_pages"])) && ($_GET["num_pages"] === "true")) {
    if (isset($_GET["keyword"])) {
        $result = filter_string($_GET["keyword"]);
        if ($result['resultado']) {
            $criteria = $result['datos'];
        } else {
            $criteria = '';
        }
    } else {
        $criteria = '';
    }

    $item_per_page = 3;
    $path_model = SITE_ROOT . '/modules/products_FE/model/model/';

    //change work error apache
    set_error_handler('ErrorHandler');

    try {
        //loadmodel
        $arrArgument = array(
            "column" => "product_name",
            "like" => $criteria
        );
        //throw new Exception();
        $arrValue = loadModel($path_model, "products_FE_model", "count_like_products_FE", $arrArgument);
        $get_total_rows = $arrValue[0]["total"]; //total records
        $pages = ceil($get_total_rows / $item_per_page); //break total records into pages
    } catch (Exception $e) {
        showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }

    //change to defualt work error apache
    restore_error_handler();

    if ($get_total_rows) {
        $jsondata["pages"] = $pages;
        //$jsondata["total_rows"] = $arrValue;
        echo json_encode($jsondata);
        exit;
    } else {
        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }

}

if ((isset($_GET["view_error"])) && ($_GET["view_error"] === "true")) {
    showErrorPage(0, "ERROR get view- 503 BD Unavailable");
}
if ((isset($_GET["view_error"])) && ($_GET["view_error"] === "false")) {
    showErrorPage(0, "ERROR - 404 NO DATA");
}

////////////////////////details_products
if (isset($_GET["idProduct"])) {
    $arrValue = null;
    //filter if idProduct is a number
    $result = filter_num_int($_GET["idProduct"]);
    if ($result['resultado']) {
        $id = $result['datos'];
    } else {
        $id = 1;
    }

    set_error_handler('ErrorHandler');
    try {
        //throw new Exception();
        $path_model = SITE_ROOT . '/modules/products_FE/model/model/';
        $arrValue = loadModel($path_model, "products_FE_model", "details_products_FE", $id);
    } catch (Exception $e) {
        showErrorPage(2, "ERROR id Product - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
    }
    restore_error_handler();

    if ($arrValue) {
        $jsondata["product"] = $arrValue[0];
	      echo json_encode($jsondata);
        exit;
    } else {
        showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
    }
} else {

    $item_per_page = 3;

    //filter to $_POST["page_num"]
    if (isset($_POST["page_num"])) {
        $result = filter_num_int($_POST["page_num"]);
        if ($result['resultado']) {
            $page_number = $result['datos'];
        }
    } else {
        $page_number = 1;
    }

    if (isset($_GET["keyword"])) {
        $result = filter_string($_GET["keyword"]);
        if ($result['resultado']) {
            $criteria = $result['datos'];
        } else {
            $criteria = '';
        }
    } else {
        $criteria = '';
    }

    if (isset($_POST["keyword"])) {
        $result = filter_string($_POST["keyword"]);
        if ($result['resultado']) {
            $criteria = $result['datos'];
        } else {
            $criteria = '';
        }
    }

    $position = (($page_number - 1) * $item_per_page);
    $path_model = SITE_ROOT . '/modules/products_FE/model/model/';
    $limit = $item_per_page;
    $arrArgument = array(
        "column" => "product_name",
        "like" => $criteria,
        "position" => $position,
        "limit" => $limit
    );
    set_error_handler('ErrorHandler');

    try {

        $arrValue = loadModel($path_model, "products_FE_model", "select_like_limit_products_FE", $arrArgument);
    } catch (Exception $e) {
        showErrorPage(0, "ERROR id prod else- 503 BD Unavailable");
    }
    restore_error_handler();
    if ($arrValue != "") {
        paint_template_products($arrValue);
    } else {
        showErrorPage(0, "ERROR - 404 NO PRODUCTS");
    }
}
