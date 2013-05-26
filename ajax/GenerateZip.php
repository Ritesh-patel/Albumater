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
	$files = $images;
	//print_r($files);
	$zipname = $path_app.'downloads/YourAlbum.zip';
	$zip = new ZipArchive;
	$zip->open($zipname, ZipArchive::OVERWRITE);
	foreach ($files as $file) 
	{
	  	$file1=file_get_contents($file);
	  	$zip->addFromString(basename($file),$file1);
	}
	$zip->close();
	echo "1";
?>