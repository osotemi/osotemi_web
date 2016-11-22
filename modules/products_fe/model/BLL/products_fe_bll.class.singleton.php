<?php

require (MODEL_PATH . "db.class.singleton.php");
require(DAO_PRODUCTS_FE . "products_fe_dao.class.singleton.php");

class products_fe_bll {

    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = products_fe_dao::getInstance();
        $this->db = db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function list_products_fe_BLL() {
        return $this->dao->list_products_fe_DAO($this->db);
    }

    public function details_products_fe_BLL($id) {
        return $this->dao->details_products_fe_DAO($this->db,$id);
    }

    public function page_products_fe_BLL($arrArgument) {
        return $this->dao->page_products_fe_DAO($this->db,$arrArgument);
    }

    public function total_products_fe_BLL() {
        return $this->dao->total_products_fe_DAO($this->db);
    }

    public function select_column_products_fe_BLL($arrArgument){
        return $this->dao->select_column_products_fe_DAO($this->db,$arrArgument);
    }
    public function select_like_products_fe_BLL($arrArgument){
        return $this->dao->select_like_products_fe_DAO($this->db,$arrArgument);
    }
    public function count_like_products_fe_BLL($arrArgument){
        return $this->dao->count_like_products_fe_DAO($this->db,$arrArgument);
    }
    public function select_like_limit_products_fe_BLL($arrArgument){
        return $this->dao->select_like_limit_products_fe_DAO($this->db,$arrArgument);
    }
}
