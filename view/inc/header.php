<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="osotemi" content="">
    <title>osotemiWeb|<?php if($_GET['module']){ echo $_GET['module'];}else{ echo "Homepage";} ?></title>
    <link href="view/css/bootstrap.min.css" rel="stylesheet">
    <link href="view/css/font-awesome.min.css" rel="stylesheet">
    <link href="view/css/prettyPhoto.css" rel="stylesheet">
    <link href="view/css/animate.css" rel="stylesheet">
    <link href="view/css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    
    <!--form_user-->
    <script src='//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js'></script>
    
    <!-- Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(
            $(function (){
            	$("#discharge_date").datepicker({
            		dateFormat: 'dd/mm/yy', 
            		changeMonth: true, 
            		changeYear: true, 
            		yearRange: '1915:2016',
            		
            	});
            	
            	$("#expiry_date").datepicker({
            		dateFormat: 'dd/mm/yy', 
            		changeMonth: true, 
            		changeYear: true, 
            		yearRange: '1915:2016',
            		
            	});
            })     
        );
    </script>
    
    
    <!-- Datepicker 
    <link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    -->
    
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="img/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
    <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">