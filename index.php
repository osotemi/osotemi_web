<?php 
	require_once("view/inc/header.html"); 
	require_once("view/inc/menu.php");
	
	include ("utils/utils.inc.php");
	
	session_start();

	if (!isset($_GET['module'])) {
		require_once("modules/main/controller/controller_main.class.php");
	} else	if ( (isset($_GET['module'])) && (!isset($_GET['view'])) ){
		require_once("modules/".$_GET['module']."/controller/controller_".$_GET['module'].".class.php");
	} else if ( (isset($_GET['module'])) && (isset($_GET['view'])) ) {
		require_once("modules/".$_GET['module']."/view/".$_GET['view'].".php");
	} else {
		require_once("view/page/error404.php");
	}
	require_once("view/inc/bottom.html");	
	require_once("view/inc/footer.html");