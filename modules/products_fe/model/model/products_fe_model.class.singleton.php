<?php
require(BLL_PRODUCTS_FE . "products_fe_bll.class.singleton.php");

class products_fe_model {

    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = products_fe_bll::getInstance();
    }


    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function list_products_fe() {
        return $this->bll->list_products_fe_BLL();
    }

    public function details_products_fe($id) {
        return $this->bll->details_products_fe_BLL($id);
    }

    public function page_products_fe($arrArgument) {
        return $this->bll->page_products_fe_BLL($arrArgument);
    }

    public function total_products_fe() {
        return $this->bll->total_products_fe_BLL();
    }

    public function select_column_products_fe($arrArgument){
        return $this->bll->select_column_products_fe_BLL($arrArgument);
    }
    public function select_like_products_fe($arrArgument){
        return $this->bll->select_like_products_fe_BLL($arrArgument);
    }
    public function count_like_products_fe($arrArgument){

        return $this->bll->count_like_products_fe_BLL($arrArgument);
    }
    public function select_like_limit_products_fe($arrArgument){

         return $this->bll->select_like_limit_products_fe_BLL($arrArgument);
    }
}
