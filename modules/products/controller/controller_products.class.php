<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/osotemi_web/modules/products/utils/functions_product.inc.php");
include ($_SERVER['DOCUMENT_ROOT'] . "/osotemi_web/utils/upload.php");
session_start();

///////////////////////////////////

if ((isset($_POST['discharge_products_json']))) {
  	discharge_products();
}

function discharge_products() {
  	$jsondata = array();
  	$productsJSON = json_decode($_POST["discharge_products_json"], true);
  	
	$result = validate_product($productsJSON);
	
    if (empty($_SESSION['result_avatar'])) {
        $_SESSION['result_avatar'] = array('resultado' => true, 'error' => "", 'data' => 'media/default-avatar.png');
    }

    $result_avatar = $_SESSION['result_avatar'];
	
	//if(($result['resultado']) && ($result_avatar['resultado'])){
	$arrArgument = array(
        'product_name' => ucfirst($result['data']['product_name']),
        
        'avatar' => $result_avatar['data']
    );

    $mensaje = "User has been successfully registered";

    //redirigir a controlador de vista con los datos de $arrArgument y $mensaje
    $_SESSION['product'] = $arrArgument;
    $_SESSION['msje'] = $mensaje;
    $callback = "index.php?module=products&view=result_products";

    $jsondata["success"] = true;
    $jsondata["redirect"] = $callback;
    echo json_encode($jsondata);//go to product.js -> function validate products -> function(response)
    exit;	
}

//////////////////////////
if (isset($_GET["delete"]) && $_GET["delete"] == true) {
	$_SESSION['result_avatar'] = array();
	$result = remove_files();
	if ($result === true) {
        echo json_encode(array("res" => true));
    } else {
        echo json_encode(array("res" => false));
    }
	//echo json_encode($result);
	//exit;
}


////////////////////////////
if ((isset($_GET["upload"])) && ($_GET["upload"] == true)) {
	$result_avatar = upload_files();
	$_SESSION['result_avatar'] = $result_avatar;
}

///////////////////////////
if (isset($_GET["load"]) && $_GET["load"] == true) {//call by list_products -> load_products_ajax
    $jsondata = array();
    if (isset($_SESSION['product'])) {
        //echo debug($_SESSION['product']);
        $jsondata["product"] = $_SESSION['product'];
    }
    if (isset($_SESSION['msje'])) {
        //echo $_SESSION['msje'];
        $jsondata["msje"] = $_SESSION['msje'];
    }
    close_session();
    echo json_encode($jsondata);//go to list_products -> load_products_ajax
    exit;
}
	
function close_session() {
    unset($_SESSION['product']);
    unset($_SESSION['msje']);
    $_SESSION = array(); // Destruye todas las variables de la sesión
    session_destroy(); // Destruye la sesión
}