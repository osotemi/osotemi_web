<?php
class controller_products_fe {

		public function __construct() {

			$_SESSION['module'] = "products_fe";
   	}

 		public function list_products() {
      require_once(VIEW_PATH_INC."header.html");
			require_once(VIEW_PATH_INC."menu.php");
      loadView( PRODUCTS_FE_VIEW, 'list_products.php');
      require_once(VIEW_PATH_INC."footer.html");
    }
		/////////////////////////////////////////Atutocomplete
		public function autocomplete_products(){
			if ((isset($_POST["autocomplete"])) && ($_POST["autocomplete"] === "true")) {
			    set_error_handler('ErrorHandler');

			    try {
			        $nameProducts = loadModel(MODEL_PRODUCTS_FE, "products_fe_model", "select_column_products_fe", "product_name");

			    } catch (Exception $e) {
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
		}

		function name_product(){
			if (isset($_POST["name_product"])) {
			    //filtrar $_GET["name_product"]

			    $result = filter_string($_POST["name_product"]);
			    if ($result['resultado']) {
			        $criteria = $result['datos'];
			    } else {
			        $criteria = '';
			    }
			    set_error_handler('ErrorHandler');
			    try {
			        $arrArgument = array(
			            "column" => "product_name",
			            "like" => $criteria
			        );
			        $producto = loadModel(MODEL_PRODUCTS_FE, "products_fe_model", "select_like_products_fe", $arrArgument);

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
		}

		function count_product(){
			if (isset($_POST["count_product"])) {
			    //filtrar $_GET["count_product"]
			    $result = filter_string($_POST["count_product"]);
			    if ($result['resultado']) {
			        $criteria = $result['datos'];
			    } else {
			        $criteria = '';
			    }

			    set_error_handler('ErrorHandler');
			    try {
			        $arrArgument = array(
			            "column" => "product_name",
			            "like" => $criteria
			        );

			        $total_rows = loadModel(MODEL_PRODUCTS_FE, "products_fe_model", "count_like_products_fe", $arrArgument);
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
		}
		/////////////////////////////////////////list_products

		function num_pages_products(){
			//obtain num total pages
			if ((isset($_POST["num_pages"])) && ($_POST["num_pages"] === "true")) {
			    if (isset($_POST["keyword"])) {
			        $result = filter_string($_POST["keyword"]);
			        if ($result['resultado']) {
			            $criteria = $result['datos'];
			        } else {
			            $criteria = '';
			        }
			    } else {
			        $criteria = '';
			    }

			    $item_per_page = 3;
			    //change work error apache
			    set_error_handler('ErrorHandler');

			    try {
			        //loadmodel
			        $arrArgument = array(
			            "column" => "product_name",
			            "like" => $criteria
			        );
			        //throw new Exception();
			        $arrValue = loadModel(MODEL_PRODUCTS_FE, "products_fe_model", "count_like_products_fe", $arrArgument);
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
		}

		function view_error_true() {
			if ((isset($_POST["view_error"])) && ($_POST["view_error"] === "true")) {
					showErrorPage(0, "ERROR get view- 503 BD Unavailable");
			}
    }

    function view_error_false() {
				if ((isset($_POST["view_error"])) && ($_POST["view_error"] === "false")) {
						//showErrorPage(0, "ERROR - 404 NO DATA");
						showErrorPage(3, "RESULTS NOT FOUND");
				}
    }

		function idProduct() {
				////////////////////////details_products
				if (isset($_POST["idProduct"]) && ($_POST["idProduct"] !== "")) {
				    $arrValue = null;
				    //filter if idProduct is a number
				    $result = filter_num_int($_POST["idProduct"]);
				    if ($result['resultado']) {
				        $id = $result['datos'];
				    } else {
				        $id = 1;
				    }

				    set_error_handler('ErrorHandler');
				    try {
				        //throw new Exception();
				        $arrValue = loadModel(MODEL_PRODUCTS_FE, "products_fe_model", "details_products_fe", $id);
								echo json_encode($arrValue);
				        exit;
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
				}
			}

			function obtain_products(){
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

			    if (isset($_POST["keyword"])) {
			        $result = filter_string($_POST["keyword"]);
			        if ($result['resultado']) {
			            $criteria = $result['datos'];
			        } else {
			            $criteria = '';
			        }
			    } else {
			        $criteria = '';
			    }

			    $position = (($page_number - 1) * $item_per_page);
			    $limit = $item_per_page;
			    $arrArgument = array(
			        "column" => "product_name",
			        "like" => $criteria,
			        "position" => $position,
			        "limit" => $limit
			    );
			    set_error_handler('ErrorHandler');

			    try {
			        $arrValue = loadModel(MODEL_PRODUCTS_FE, "products_fe_model", "select_like_limit_products_fe", $arrArgument);

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
}
