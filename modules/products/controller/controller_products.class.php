<?php
$path = $_SERVER['DOCUMENT_ROOT'];
define('SITE_ROOT', $path);

include (SITE_ROOT . "/modules/products/utils/functions_product.inc.php");
include (SITE_ROOT . "/utils/upload.php");
include (SITE_ROOT . "/utils/common.inc.php");
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
    /*
    $jsondata["success"] = true;
    $jsondata['resultado']= $result;
    $jsondata['result_avatar']= $result_avatar['resultado'];
    echo json_encode($jsondata);
    exit;
    */
	if(($result['result']) && ($result_avatar['resultado'])){

    	$arrArgument = array(
            'product_name' => ucfirst($result['data']['product_name']),
            'price' => $result['data']['price'],
            'description' => $result['data']['description'],
            'discharge_date' => $result['data']['discharge_date'],
            'expiry_date' => $result['data']['expiry_date'],
            'provider_email' => $result['data']['provider_email'],
            'provider_phone' => $result['data']['provider_phone'],
            'country' => $result['data']['country'],
            'province' => $result['data']['province'],
            'city' => $result['data']['city'],
            'season' => $result['data']['season'],
            'category' => $result['data']['category'],

            'avatar' => $result_avatar['data']
        );

        /////////////////insert into BD////////////////////////
        $arrValue = false;
        $path_model = SITE_ROOT . '/modules/products/model/model/';
        $arrValue = loadModel($path_model, "product_model", "create_product", $arrArgument);
        //$jsondata["success"] = true;
        //$jsondata['resultado']= $arrValue;
        //echo json_encode($jsondata);
        //exit;

        if ($arrValue)
            $mensaje = "Su registro se ha efectuado correctamente, para finalizar compruebe que ha recibido un correo de validacion y siga sus instrucciones";
        else
            $mensaje = "No se ha podido realizar su alta. Intentelo mas tarde";

        //redirigir a controlador de vista con los datos de $arrArgument y $mensaje
        $_SESSION['product'] = $arrArgument;
        $_SESSION['msje'] = $mensaje;
        $callback = "index.php?module=products&view=result_products";

        $jsondata["success"] = true;
        $jsondata["redirect"] = $callback;
        echo json_encode($jsondata);//go to product.js -> function validate products -> function(response)

        exit;
    }
    else{

        $jsondata["success"] = false;
        $jsondata["error"] = $result['error'];
        $jsondata["error_avatar"] = $result_avatar['error'];

        $jsondata["success1"] = false;
        if ($result_avatar['resultado']) {
            $jsondata["success1"] = true;
            $jsondata["img_avatar"] = $result_avatar['data'];
        }
        header('HTTP/1.0 400 Bad error', true, 404);
        echo json_encode($jsondata);
    }
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

}


////////////////////////////
if ((isset($_GET["upload"])) && ($_GET["upload"] == true)) {
	$result_avatar = upload_files();
	$_SESSION['result_avatar'] = $result_avatar;
  //echo debug($_SESSION['result_avatar']); //se mostraría en alert(response); de dropzone.js
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
/////////////////////////////////////////////////// load_data
if ((isset($_GET["load_data"])) && ($_GET["load_data"] == true)) {
    $jsondata = array();

    if (isset($_SESSION['product'])) {
        $jsondata["product"] = $_SESSION['product'];
        echo json_encode($jsondata);
        exit;
    } else {
        $jsondata["product"] = "";
        echo json_encode($jsondata);
        exit;
    }
}
/////////////////////////////////////////////////// load_pais
if(  (isset($_GET["load_countries"])) && ($_GET["load_countries"] == true)  ){
	$json = array();

  $url = 'http://www.oorsprong.org/websamples.countryinfo/CountryInfoService.wso/ListOfCountryNamesByName/JSON';

	$path_model=SITE_ROOT.'/modules/products/model/model/';

	$json = loadModel($path_model, "product_model", "obtain_countries", $url);



	if($json){

		echo $json;
		exit;
	}else{
		$json = "error";
		echo $json;
		exit;
	}
}
/////////////////////////////////////////////////// load_provincias

if(  (isset($_GET["load_provinces"])) && ($_GET["load_provinces"] == true)  ){
	$jsondata = array();
      $json = array();

	$path_model=SITE_ROOT.'/modules/products/model/model/';
  $json = loadModel($path_model, "product_model", "obtain_provinces");

	if($json){
		$jsondata["provinces"] = $json;
		echo json_encode($jsondata);
		exit;
	}else{
		$jsondata["provinces"] = "error";
		echo json_encode($jsondata);
		exit;
	}
}

/////////////////////////////////////////////////// load_poblaciones

if(  isset($_POST['idCity']) ){

  $jsondata = array();
  $json = array();

	$path_model=SITE_ROOT.'/modules/products/model/model/';
	$json = loadModel($path_model, "product_model", "obtain_cities", $_POST['idCity']);

	if($json){
		$jsondata["cities"] = $json;
		echo json_encode($jsondata);
		exit;
	}else{
		$jsondata["cities"] = "error";
		echo json_encode($jsondata);
		exit;
	}
}

///////////////////////////////////////////destroy data
function close_session() {
    unset($_SESSION['product']);
    unset($_SESSION['msje']);
    $_SESSION = array(); // Destruye todas las variables de la sesión
    session_destroy(); // Destruye la sesión
}
