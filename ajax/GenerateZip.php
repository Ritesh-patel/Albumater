<?php
	$path_root="../../";	// define path to root
    $path_app="../";		// define path to app
    include_once($path_app."lib/fb-config.php");	// include facebook config file
	$album_id = $_POST['albumid'];	 	// get album id
	$total_images=$_POST['total_images'];	 	//get totatl images in the album
	$photos = $facebook->api("/{$album_id}/photos?limit=$total_images&offset=0");	
	//build array to get source of album images.
	$images=array();	
	foreach($photos['data'] as $photo)
	{
		$images[]=$photo['source'];
	}
	$files = $images;

	ini_set('max_execution_time', 0);	// set max_execution_time to make zip file even for large number of files.
	//print_r($files);
	$zipname = $path_app.'downloads/YourAlbum.zip';		
	$zip = new ZipArchive;		//create object of ZipArchive
	$zip->open($zipname, ZipArchive::OVERWRITE);	
	foreach ($files as $file) 		//build zip
	{	  	
	  	$file1=file_get_contents($file);
	  	$zip->addFromString(basename($file),$file1);	  	
	}
	$zip->close();
	echo "1";
?>