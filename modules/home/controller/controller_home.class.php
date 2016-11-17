<?php
    class controller_home {

        public function __construct() {
            include(UTILS . "common.inc.php");
        }

        public function init() {
            require_once(VIEW_PATH_INC."header.html");
			      require_once(VIEW_PATH_INC."menu.php");

            loadView('modules/home/view/', 'home.php');

            require_once(VIEW_PATH_INC."footer.html");
        }
    }
