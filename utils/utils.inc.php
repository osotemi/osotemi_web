<?php
    function debugPHP($array){
        echo "<pre>";
        print_r($array);
        echo "</pre><br>";
    }
    
    function debugChrome($array){
        include 'libs/chromephp-master/ChromePhp.php';
        ChromePhp::warm($array);
    }
    
    function redirect($url){
        die('<script>top.location.href="'.$url .'";</script>');
    }