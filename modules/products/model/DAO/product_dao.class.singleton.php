<?php
class productDAO {

    static $_instance;

    private function __construct() {

    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function create_product_DAO($db, $arrArgument) {
        $product_name = $arrArgument['product_name'];
        $price = $arrArgument['price'];
        $description = $arrArgument['description'];
        $discharge_date = $arrArgument['discharge_date'];
        $expiry_date = $arrArgument['expiry_date'];
        $provider_email = $arrArgument['provider_email'];
        $provider_phone = $arrArgument['provider_phone'];
        $country = $arrArgument['country'];
        $province = $arrArgument['province'];
        $city = $arrArgument['city'];

        $season = $arrArgument['season'];
        $avatar = $arrArgument['avatar'];

        $category = $arrArgument['category'];
        $str_category = "";

        foreach ($category as $indice) {
            $str_category .= $indice . ":";
        }

        $sql = "INSERT INTO products(`product_name`, `price`, `description`, `discharge_date`, `expiry_date`,"
                . " `provider_email`, `provider_phone`,`country`,`province`,`city`, `season`, `categorie`, `avatar` )"
                . " VALUES ('$product_name', '$price', '$description',"
                . " '$discharge_date', '$expiry_date', '$provider_email', '$provider_phone',"
                . " '$country','$province','$city','$season', '$str_category', '$avatar')";

        return $db->ejecutar($sql);
    }

    public function list_products_DAO($db) {
        $sql = "SELECT * FROM products";
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);

    }

    public function details_products_DAO($db,$id) {
        $sql = "SELECT * FROM products WHERE id=".$id;
        $stmt = $db->ejecutar($sql);
        return $db->listar($stmt);

    }

    public function obtain_countries_DAO($url) {
        //ini_set('display_errors', 1);
        $ch = curl_init();
        //echo json_encode($ch);
        //exit;
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $file_contents = curl_exec($ch);

        $httpcode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

        curl_close($ch);

        $accepted_response = array( 200, 301, 302 );
        if(!in_array( $httpcode, $accepted_response )){
          return FALSE;
        }
        else{
          return ($file_contents) ? $file_contents : FALSE;
        }
    }

    public function obtain_provinces_DAO() {
        $json = array();
        $tmp = array();

      	$provinces = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] . "/resources/provincesandcityes.xml");
      	$result = $provinces->xpath("/lista/provincia/nombre | /lista/provincia/@id");

      	for ($i=0; $i<count($result); $i+=2) {
      		$e=$i+1;
      		$provinces=$result[$e];

      		$tmp = array(
      			'id' => (string) $result[$i], 'nombre' => (string) $provinces
      		);
      		array_push($json, $tmp);
      	}
        return $json;
    }

    public function obtain_cities_DAO($arrArgument) {
        $json = array();
        $tmp = array();

        $filter = (string)$arrArgument;
        $xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] . '/resources/provincesandcityes.xml');
        $result = $xml->xpath("/lista/provincia[@id='$filter']/localidades");

      	for ($i=0; $i<count($result[0]); $i++) {
      		$tmp = array(
      			'poblacion' => (string) $result[0]->localidad[$i]
      		);
      		array_push($json, $tmp);
      	}
        return $json;
    }
  }
