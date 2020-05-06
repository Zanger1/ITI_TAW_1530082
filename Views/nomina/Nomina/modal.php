<?php

$id = '';
if(isset($_GET["id"])){
	$id = $_GET["id"]; 
}
$Nomina=NominaModel::searchById($id); #Esta linea normalmente va en el controlador pero como no es MVC, puede ir aqui

ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($Nomina as $key => $Nomina) {
			unset($Nomina->$key);
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
	$readonlyCampo = "readonly"; 
	$readonlyComentarioSucursal = "";
	$readonlyComentarioMatriz = "";
	if(isset($_GET["edit"])){
		$editable = $_GET["edit"];
		if($editable=="true"){
			$disabled = "";	
			if ($_SESSION['id_role']==1) {
				$readonlyComentarioSucursal = "readonly";
			}else{
				$readonlyComentarioMatriz = "readonly";
			}
		} 
		if($editable=="false"){
			$disabled = "disabled";	
		}
	}
?>
<!------------------------------------->
		  <div class="form-row">
<!------------------------------------->
<!------------------------------------->
			<div class="form-group col-md-6">
			  <label for="inputEmail4">Empleado</label>
			  <input type="text" class="form-control vf_no_spl_char" id="empleado" placeholder="NameEmpleado" value="<?php echo $Nomina->getNombreEmpleado($Nomina->getidEmpleado()); ?>" name="NameEmpleado" readonly required>
			</div>
<!------------------------------------->

			<div class="form-group col-md-6">
			  <label for="inputEmail4">Puesto</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="CategoriaEmpleado" value="<?php echo $Nomina->getPuesto($Nomina->getidCategoriaEmpleado()); ?>" 
			  name="idCategoriaEmpleado" readonly required>
			</div>
			</div>
<!------------------------------------->
		  <div class="form-row">
			<div class="form-group col-md-3">
			   <label for="inputEmail4">Días</label> 
			  <input type="number" min="0" max="6" class="form-control vf_no_spl_char" id="dias" onchange onkeyup placeholder="NoDiasTrabajados" value="<?php echo $Nomina->getNoDiasTrabajados(); ?>" 
			  name="NoDiasTrabajados" <?php echo $disabled; ?> required>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			 <label for="inputEmail4"> Séptimo día  </label> <div class="input-group-prepend">
			  <span class="input-group-text">$</span>
			  <input type="number" class="form-control vf_no_spl_char" id="dia_7" onchange placeholder="SeptimoDia" value="<?php echo $Nomina->getSeptimoDia(); ?>" name="Septimo_Dia" <?php echo $disabled; ?> readonly required>
			</div>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			 <label for="inputEmail4">Sueldo Base</label>
			  <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			  <input type="number" class="form-control vf_no_spl_char" id="sueldoBase" onchange placeholder="SueldoBase" value="<?php echo $Nomina->getSueldoBase(); ?>" 
			  name="SueldoBase" <?php echo $disabled; ?> readonly required>
			</div>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			  <label for="inputEmail4">Sueldo</label>
			  <div class="input-group-prepend">
			  	  <span class="input-group-text">$</span>
			  <input type="number" class="form-control vf_no_spl_char" id="sueldo" onchange placeholder="Sueldo" value="<?php echo $Nomina->getSueldo(); ?>" 
			  name="Sueldo" <?php echo $disabled; ?> readonly required>
			</div>
			</div>
<!------------------------------------->
  			</div>

  			  <div class="form-row">
			<div class="form-group col-md-3">
			   <label for="inputEmail4">Total Extras</label>
			  <div class="input-group-prepend">
			  	  <span class="input-group-text">$</span>
			  <input type="text" class="form-control vf_no_spl_char" id="extras" onchange placeholder="TotalExtras" value="<?php echo $Nomina->getTotalExtras(); ?>" 
			  name="TotalExtras" <?php echo $disabled; ?> readonly>
			</div>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			    <label for="inputEmail4">Infonavit</label>
			  <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			  <input type="number" min="0" step="0.01" class="form-control vf_no_spl_char" id="infonavit" onchange onkeyup placeholder="Infonavit" value="<?php echo $Nomina->getInfonavit(); ?>" name="Infonavit" <?php echo $disabled; if(is_null($Nomina->getInfonavit())){echo $readonlyCampo;} ?>>
			</div>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			  <label for="inputEmail4">Prestamo</label>
			    <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			  <input type="text" class="form-control vf_no_spl_char" id="prestamo" placeholder="Prestamo" value="<?php echo $Nomina->getPrestamo(); ?>" name="Prestamo" <?php echo $disabled; ?> readonly>
			</div>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			 <label for="inputEmail4">Saldo Anterior</label>
			  <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			  <input type="text" class="form-control vf_no_spl_char" id="saldoAnterior" placeholder="SaldoAnterior" value="<?php echo $Nomina->getSaldoAnterior(); ?>" name="SaldoAnterior" <?php echo $disabled; ?> readonly>
			</div>
			</div>
<!------------------------------------->
  			</div>

  			 <div class="form-row">
			<div class="form-group col-md-3">
			   <label for="inputEmail4">Abono</label>
			  <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			  <input type="number" step="0.01" min="0" max="<?php echo $Nomina->getSaldoAnterior(); ?>" class="form-control vf_no_spl_char" id="abonoNomina" onchange onkeyup placeholder="Abono" value="<?php echo $Nomina->getAbono(); ?>" name="Abono" <?php echo $disabled; if(is_null($Nomina->getAbono())){echo $readonlyCampo;} ?>>
			</div>
			</div>
<!------------------------------------->
		<div class="form-group col-md-3">
			  <label for="inputEmail4">Saldo Actual</label>
			  <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			  <input type="text" class="form-control vf_no_spl_char" id="saldoActual" onchange placeholder="SueldoActual" value="<?php echo $Nomina->getSueldoActual(); ?>" 
			  name="SueldoActual" <?php echo $disabled; ?> readonly>
			</div>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			  <label for="inputEmail4">Sueldo Neto</label>
			   <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			  <input type="number" min="0" class="form-control vf_no_spl_char" id="sueldoNeto" placeholder="SueldoNeto" value="<?php echo $Nomina->getSueldoNeto(); ?>" name="SueldoNeto" <?php echo $disabled; ?> readonly required>
			</div>
			</div>
<!-----------------Sólo se habilitará para la matriz-------------------->
			<div class="form-group col-md-6">
			 <label for="inputEmail4">Comentarios Sucursal</label>
			  <textarea type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Comentarios" name="ComentariosSucursal" <?php echo $disabled; echo $readonlyComentarioSucursal; ?>><?php echo $Nomina->getComentariosSucursal(); ?></textarea>
			</div>
<!-----------------Sólo se habilitará para la matriz-------------------->
			<div class="form-group col-md-6">
			   <label for="inputEmail4">Comentarios Matriz</label>
			  <textarea type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Comentarios" name="ComentariosMatriz" <?php echo $disabled; echo $readonlyComentarioMatriz; ?>><?php echo $Nomina->getComentariosMatriz(); ?></textarea>
			</div>
<!------------------------------------->

  			</div>
<!------------------idDetalleNominaSucursal llave primaria de la tabla------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getidDetalleNominaSucursal(); ?>"
  		    name="idDetalleNominaSucursal"hidden>
<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getidNominaSucursal(); ?>"
  		    name="idNominaSucursal"hidden>
<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getidEmpleado(); ?>"
  		    name="idEmpleado"hidden>
<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getidCategoriaEmpleado(); ?>"
  		    name="idCategoriaEmpleado"hidden>
<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $_SESSION['id_role'] ?>"
  		    name="rol" hidden>