<?php
	//include ("modules/products/utils/functions_product.inc.php");
	include ($_SERVER['DOCUMENT_ROOT'] . "/des.osotemiweb/utils/upload.php");
	session_start();

///////////////////////////////////

	if ((isset($_POST['discharge_products_json']))) {
	  	discharge_products();
	}

	function discharge_products() {
	  	$jsondata = array();
	  	$productsJSON = json_decode($_POST["discharge_products_json"], true);

	    $jsondata["success"] = true;
		$jsondata["product_name"] = $productsJSON['product_name'];
		$jsondata["redirect2"] = "asignando correctamente!!";
	    echo json_encode($jsondata);
	    exit;

	}

//////////////////////////
if (isset($_GET["delete"]) && $_GET["delete"] == true) {
	$result = remove_files();
	echo json_encode($result);
	exit;
}


////////////////////////////
if ((isset($_GET["upload"])) && ($_GET["upload"] == true)) {
		$result_avatar = upload_files();
		echo json_encode($result_avatar);
		exit;
}
