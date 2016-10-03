<?php
	//include ("modules/products/utils/functions_product.inc.php");
	include ($_SERVER['DOCUMENT_ROOT'] . "/osotemi_web/utils/upload.php");
	session_start();

///////////////////////////////////

	if ((isset($_POST['discharge_products_json']))) {
	  	discharge_products();
	}

	function discharge_products() {
	  	$jsondata = array();
	  	$productsJSON = json_decode($_POST["discharge_products_json"], true);

		//$result = validate_user($usersJSON);
	
	    if (empty($_SESSION['result_avatar'])) {
	        $_SESSION['result_avatar'] = array('resultado' => true, 'error' => "", 'datos' => 'media/default-avatar.png');
	    }
	
	    $result_avatar = $_SESSION['result_avatar'];
		
		//if(($result['resultado']) && ($result_avatar['resultado'])){
		$arrArgument = array(
            'product_name' => ucfirst($result['datos']['product_name']),
            
            'avatar' => $result_avatar['datos']
        );

        $mensaje = "User has been successfully registered";

        //redirigir a otra p�gina con los datos de $arrArgument y $mensaje
        $_SESSION['user'] = $arrArgument;
        $_SESSION['msje'] = $mensaje;
        $callback = "index.php?module=products&view=result_products";

        $jsondata["success"] = true;
        $jsondata["redirect"] = $callback;
        echo json_encode($jsondata);
        exit;	
			
		//}
		/*
	    $jsondata["success"] = true;
		$jsondata["product_name"] = $productsJSON['product_name'];
		$jsondata["avatar"] = $result_avatar['datos'];
		$jsondata["redirect2"] = "asignando correctamente!!";
	    echo json_encode($jsondata);
	    exit;
		*/
	}

	//////////////////////////
	if (isset($_GET["delete"]) && $_GET["delete"] == true) {
		$_SESSION['result_avatar'] = array();
		$result = remove_files();
		//echo json_encode($result);
		//exit;
		if ($result === true) {
	        echo json_encode(array("res" => true));
	    } else {
	        echo json_encode(array("res" => false));
	    }
		//echo json_encode($result);
		exit;
	}
	
	
	////////////////////////////
	if ((isset($_GET["upload"])) && ($_GET["upload"] == true)) {
		$result_avatar = upload_files();
		$_SESSION['result_avatar'] = $result_avatar;
	}
	
	///////////////////////////
	if (isset($_GET["load"]) && $_GET["load"] == true) {
	    $jsondata = array();
	    if (isset($_SESSION['user'])) {
	        //echo debug($_SESSION['user']);
	        $jsondata["user"] = $_SESSION['user'];
	    }
	    if (isset($_SESSION['msje'])) {
	        //echo $_SESSION['msje'];
	        $jsondata["msje"] = $_SESSION['msje'];
	    }
	    close_session();
	    echo json_encode($jsondata);
	    exit;
	}