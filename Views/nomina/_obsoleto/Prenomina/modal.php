<?php
if(isset($_GET["id"])){
	$id = $_GET["id"];
}
$Nomina=PrenominaModel::searchById($id); #Esta linea normalmente va en el controlador pero como no es MVC, puede ir aqui

ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($this as $key => $Nomina) {
			unset($this->$key);
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
  <!--
id Empleado Tabla EMPLEADO
Nombre Empleado   Empleado
NombreExtra       Extras Sucursal
-->
  <div class="form-group col-md-3">
    <label for="inputNumero">idEmpleado</label>
    <input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $Nomina->getidPrenominaExtra(); ?>" name="id" required>
  </div>

  <div class="form-group col-md-3">
    <label for="inputNumero">Nombre Empleado</label>
    <input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $Nomina->getidPrenominaExtra();?>" name="idEmpleado"  required>
  </div>

  <div class="form-group col-md-3">
    <label for="inputNumero">NoSemana</label>
    <input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $Nomina->getidPrenominaExtra();?>" name="idEmpleado"required>
  </div>

	<div class="form-group col-md-3">
		<label for="inputNumero">Fecha Inicio</label>
		<input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $Nomina->getFechaInicio();?>" name="idEmpleado"  required>
	</div>
	<div class="form-group col-md-3">
		<label for="inputNumero">Fecha Termino</label>
		<input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $Nomina->getFechaTermino();?>" name="idEmpleado" required>
	</div>
	<div class="form-group col-md-3">
		<label for="inputNumero">Comentarios</label>
		<input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php $Nomina->getComentarios();?>" name="idEmpleado" required>
	</div>
	<div class="form-group col-md-3">
		<label for="inputNumero">Situacion</label>
		<input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $Nomina->getIdSituacionPrenomina();?>" name="idEmpleado"required>
	</div>
	<div class="form-group col-md-3">
		<label for="inputNumero">Empleado Captura</label>
		<input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $Nomina->getidEmpleadoCaptura();?>" name="idEmpleado"  required>
	</div>
	<div class="form-group col-md-3">
		<label for="inputNumero">Fecha Captura</label>
		<input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $Nomina->getFechaCaptura();?>" name="idEmpleado" required>
	</div>
	

</div>
