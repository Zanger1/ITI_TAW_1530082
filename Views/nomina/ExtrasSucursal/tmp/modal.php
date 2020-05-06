<?php
$id = '';
if(isset($_GET["id"])){
	$id = $_GET["id"];
}
$extraSucursal=ExtrasSucursalModel::searchById($id); #Esta linea normalmente va en el controlador pero como no es MVC, puede ir aqui

ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($extraSucursal as $key => $extraSucursal) {
			unset($extraSucursal->$key);
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
	if(isset($_GET["edit"])){
		$editable = $_GET["edit"];
		if($editable=="true"){
			$disabled = "";
		} else if($editable=="false"){
			$disabled = "disabled";
		}
	}

?>
	 <div class="form-row">

	 		<div class="form-group col-md-4">
			  <label for="inputEmail4">ID MATRIZ</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="idExtraSucursal" value="<?php echo $extraSucursal->getIdExtra(); ?>" name="IdExtra" <?php echo $disabled; ?> required>
      </div>
			<div class="form-group col-md-4">
				<label for="inputEmail4">Monto Sugerido</label>
				<input  type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="MontoSugerido"  value="<?php echo $extraSucursal->getMontoSugerido(); ?>" name="MontoSugerido" <?php echo $disabled; ?> required>
			</div>
			<div class="form-group col-md-4">
				<label for="inputEmail4">Sucursal</label>
				<input  type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="IdExtra"  value="<?php echo $extraSucursal->getidSucursal(); ?>" name="idSucursal" <?php echo $disabled; ?> required>
			</div>
			<div class="form-group col-md-4">
				<label for="inputEmail4">Status</label>
				<input  type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="IdExtra"  value="<?php echo $extraSucursal->getStatus(); ?>" name="Status" <?php echo $disabled; ?> required>
			</div>
			<div class="form-group col-md-4">
				<label for="inputEmail4">id en Sucursal</label>
				<input  type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="IdExtra"  value="<?php echo $extraSucursal->getidExtraSucursal(); ?>" name="idExtraSucursal" <?php echo $disabled; ?> required>
			</div>

		  </div>
