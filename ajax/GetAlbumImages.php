<?php
	$path_root="../../";	// define path to root
    $path_app="../";		// define path to app
    include_once($path_app."lib/fb-config.php");	// include facebook config file
	$album_id = $_POST['albumid'];		// get album id
	$total_images=$_POST['total_images'];		//get totatl images in the album
	$photos = $facebook->api("/{$album_id}/photos?limit=$total_images&offset=0"); 
	//build array to get source of album images.	
	$images=array();	
	foreach($photos['data'] as $photo)
	{	        
	        $images[]=$photo['source'];
	}	
	// convert php array in to json data.
	echo json_encode($images);
?>