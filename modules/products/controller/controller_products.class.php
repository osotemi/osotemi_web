<?php
	include 'modules/products/utils/functions_product.inc.php';


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
	/////////////////////////////////////////
	if ($_POST) {

		$result = validate_product();

		if ($result['result']){

			$arrArgument = array(
				'product_name' => ucfirst($result['data']['product_name']),
				'description' => $result['data']['description'],
				'discharge_date' => $result['data']['discharge_date'],
				'expiry_date' => $result['data']['expiry_date'],
				'provider_email' => $result['data']['provider_email'],
				'provider_phone' => $result['data']['provider_phone'],
				'season' => $result['data']['season'],
				'category' => $result['data']['category'],
				'discount_percent' => $result['data']['discount_percent'],
			);
			$message = "Product has been successfully registered";

			debugPHP($arrArgument);

			$_SESSION['product'] = $arrArgument;
			$_SESSION['message'] = $message;

			$callback="index.php?module=products&view=result_products";
			//die('<script>window.location.href="'.$callback .'";</script>');
			redirect($callback);
		} else {
			$error = $result['error'];
		}


	}
	include 'modules/products/view/create_products.php';
