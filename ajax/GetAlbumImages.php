<?php
	$path_root="../../";
    $path_app="../";
    include_once($path_app."includes/fb-config.php");
	$album_id = $_POST['albumid'];	 
	$photos = $facebook->api("/{$album_id}/photos"); 	
	$images=array();	
	foreach($photos['data'] as $photo)
	{	        
	        $images[]=$photo['source'];
	}
	echo json_encode($images);
?>