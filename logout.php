<?php
	$path_root="../";
    $path_app="";
    include_once($path_app."includes/fb-config.php");
  	$facebook->destroySession();
  	setcookie('fbs_'.$facebook->getAppId(), '', time()-100, '/', $_SERVER['HTTP_HOST']."/rt-challenge/albumater");
  	session_destroy();  	
  	header("location:".$path_app."index.php");
?>