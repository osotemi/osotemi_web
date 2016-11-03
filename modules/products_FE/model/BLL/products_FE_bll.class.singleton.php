<?php
define('MODEL_PATH', SITE_ROOT . '/model/');
require (MODEL_PATH . "Db.class.singleton.php");
require(SITE_ROOT . "/modules/products_FE/model/DAO/products_FE_dao.class.singleton.php");

class products_FE_bll {

    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = products_FE_dao::getInstance();
        $this->db = Db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function list_products_FE_BLL() {
        return $this->dao->list_products_FE_DAO($this->db);
    }

    public function details_products_FE_BLL($id) {
        return $this->dao->details_products_FE_DAO($this->db,$id);
    }

    public function page_products_FE_BLL($arrArgument) {
        return $this->dao->page_products_FE_DAO($this->db,$arrArgument);
    }

    public function total_products_FE_BLL() {
        return $this->dao->total_products_FE_DAO($this->db);
    }

    public function select_column_products_FE_BLL($arrArgument){
        return $this->dao->select_column_products_FE_DAO($this->db,$arrArgument);
    }
    public function select_like_products_FE_BLL($arrArgument){
        return $this->dao->select_like_products_FE_DAO($this->db,$arrArgument);
    }
    public function count_like_products_FE_BLL($arrArgument){
        return $this->dao->count_like_products_FE_DAO($this->db,$arrArgument);
    }
    public function select_like_limit_products_FE_BLL($arrArgument){
        return $this->dao->select_like_limit_products_FE_DAO($this->db,$arrArgument);
    }
}
