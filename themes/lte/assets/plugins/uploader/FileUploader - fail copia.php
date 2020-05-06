<?php
$target_path='';
$nueva_ruta_completa = '';
$ruta_destino = '';
#if (isset($_POST['submit'])) {
#if (isset($_POST)) {
	global $target_path;
    $j = 0; //Variable for indexing uploaded image 
    
	$max_size = 8000000;
	//Las imagenes se archivan por anio y mes para no saturar el directorio por defecto y los 
	$target_path = "storage/uploads/".date("Y")."/".date("m")."/"; //Declaring Path for uploaded images
	$ruta_destino = $target_path;
	if (!file_exists($target_path)) {
		mkdir($target_path, 0777, true);
	}
	
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array
        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
		
		$target_path = /*$target_path . */ md5(uniqid()) . ".jpg" ;#. $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array
		
		if (($_FILES["file"]["size"][$i] < $max_size) //Approx. 8MB files can be uploaded.
                && in_array($file_extension, $validextensions)) {
			if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $ruta_destino.$target_path)) {//if file moved to uploads folder
                #echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else { //if file was not moved.
                #echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else { //if file size and file type was incorrect.
            #echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }

	#	echo '<img src="'.$target_path.'" />';	//Test
$nueva_ruta_completa = "storage/uploads/".date("Y")."/".date("m")."/".$target_path;
#}
/*
				<form enctype="multipart/form-data" action="" method="post">
					First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 100KB.
					<hr/>
					<div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>
					<input type="button" id="add_more" class="upload" value="Add More Files"/>
					<input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
				</form>
*/
?>

