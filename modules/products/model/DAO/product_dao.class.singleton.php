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
        $season = $arrArgument['season'];

        $avatar = $arrArgument['avatar'];

        $category = $arrArgument['category'];
        $str_category = "";

        foreach ($category as $indice) {
            $str_category .= $indice . ":";
        }

        $sql = "INSERT INTO products(`product_name`, `price`, `description`, `discharge_date`, `expiry_date`, `provider_email`, `provider_phone`, `season`, `categorie`, `avatar` )"
                . " VALUES ('$product_name', '$price', '$description',"
                . " '$discharge_date', '$expiry_date', '$provider_email', '$provider_phone', '$season', '$str_category', '$avatar')";

        return $db->ejecutar($sql);
    }

}
