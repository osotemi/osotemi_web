<?php
require(SITE_ROOT . "/modules/products_FE/model/BLL/products_FE_bll.class.singleton.php");

class products_FE_model {

    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = products_FE_bll::getInstance();
    }


    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function list_products_FE() {
        return $this->bll->list_products_FE_BLL();
    }

    public function details_products_FE($id) {
        return $this->bll->details_products_FE_BLL($id);
    }

    public function page_products_FE($arrArgument) {
        return $this->bll->page_products_FE_BLL($arrArgument);
    }

    public function total_products_FE() {
        return $this->bll->total_products_FE_BLL();
    }

    public function select_column_products_FE($arrArgument){
        return $this->bll->select_column_products_FE_BLL($arrArgument);
    }
    public function select_like_products_FE($arrArgument){
        return $this->bll->select_like_products_FE_BLL($arrArgument);
    }
    public function count_like_products_FE($arrArgument){

        return $this->bll->count_like_products_FE_BLL($arrArgument);
    }
    public function select_like_limit_products_FE($arrArgument){

         return $this->bll->select_like_limit_products_FE_BLL($arrArgument);
    }
}
