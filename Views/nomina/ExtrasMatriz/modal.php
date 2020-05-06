<?php
$id = '';
if(isset($_GET["id"])){
	$id = $_GET["id"];
}
$ExtrasMatriz=ExtrasMatrizModel::searchById($id); #Esta linea normalmente va en el controlador pero como no es MVC, puede ir aqui

ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($ExtrasMatriz as $key => $ExtrasMatriz) {
			unset($ExtrasMatriz->$key);
		}
	}

	/*
		Como saber si el modal que se abre, es para agregar? el ID que manda es 0. Yo tomo el ID 0 porque en la BD no coincide con ningun registro
		Pero si ese ID es mayor que 0 signfica que la modal abierta es para ver, editar, o por eliminar. Entonces
	*/
	$modal_por_agregar = "false";
	if(isset($_GET["id"]) && $_GET["id"]=='0'){
		$modal_por_agregar = "true";
	}

	//Parametro de la URL "edit" para habilitar o deshabilitar los campos del formulario: "true,false"
	$disabled = "";
  $style = 'style="display:none;"';

	if(isset($_GET["edit"])){
		$editable = $_GET["edit"];
		if($editable=="true"){
			$disabled = "";
			$style = 'style="display:none;"';

		} else {
			$disabled = "disabled";
			$style = "";
		}
	}




?>
	 <div class="form-row">




				<div class="form-group col-md-4">
				  <label >Extra</label>
				  <input id="idExtraSucursal" type="text" class="form-control vf_no_spl_char"  placeholder="Nombre de Extra"  value="<?php echo $ExtrasMatriz->getNomExtra(); ?>" name="NomExtra" <?php echo $disabled; ?> required>
				</div>


				<div class="form-group col-md-5">				  
				  <label >Monto sugerido</label>
 					<div class="input-group-prepend">
				  		<span class="input-group-text">$</span>
				  		<input type="text" class="form-control vf_no_spl_char"  placeholder="Monto Sugerido"  value="<?php echo $ExtrasMatriz->getMontoSugerido(); ?>" name="MontoSugerido" <?php echo $disabled; ?> required>
					</div>
				</div>





         <!-- Id del status-->
				<div class="form-group col-md-3 " style="display:none">
					<input type="text" class="form-control vf_only_phone_num" id="inputPassword4" placeholder="Status" value=" 0<?php echo $ExtrasMatriz->getStatus(); ?>" name="Status" <?php echo $disabled;?>required>
				</div>


				<!-- id del campo xD-->
			 <div class="form-group col-md-4" type="hidden" >
				<input type = "hidden" type="text" class="form-control vf_no_spl_char" id="inputEmail4"  placeholder="idExtra" value=" <?php echo $ExtrasMatriz->getIdExtra(); ?>" name="idExtra" <?php echo $disabled; ?> required>
			</div>
	</div>
