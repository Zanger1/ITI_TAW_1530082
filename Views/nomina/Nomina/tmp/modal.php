<?php

#### SESSION ESTATICA DE PRUEBA
$_SESSION["id_user"]=1;	//Admin general
$_SESSION["id_employe"]= 1; //Empleado con ese ID 
$_SESSION["fullname"]= "Nombre empleado";
$_SESSION["username"]= "admin";
$_SESSION["id_role"]= 1;	//1 = Admin general, 2 = Admin de sucursal, 3 = Auxiliar de sucursal
$_SESSION["role"]= "Administrador general";	//Nombre que corresponde al ID anterior
$_SESSION["id_sucursal"]= 1;	//Ciudad Victoria
$_SESSION["sucursal"]= "Victoria";
$_SESSION["status"]=1;	//Creo que era 0 y 1 (inactivo y activo)... verificar con las tablas "usuarios, empleados, sucursales"

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
	$disabledCom = "";
	if(isset($_GET["edit"])){
		$editable = $_GET["edit"];
		if($editable=="true" && $_SESSION['id_role']!=1){
			$disabled = "";	
			$disabledCom = "disabled";
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
			<div class="form-group col-md-3">
			  <label for="inputEmail4">EMPLEADO</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="idEmpleado" value="<?php echo $Nomina->getNombreEmpleado($Nomina->getidEmpleado()); ?>" name="NameEmpleado" disabled required>
			</div>
<!------------------------------------->

			<div class="form-group col-md-3">
			  <label for="inputEmail4">PUESTO</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="idCategoriaEmpleado" value="<?php echo $Nomina->getPuesto($Nomina->getidCategoriaEmpleado()); ?>" 
			  name="idCategoriaEmpleado" disabled required>
			</div>
			</div>
<!------------------------------------->
		  <div class="form-row">
			<div class="form-group col-md-3">
			  <label for="inputEmail4">DIAS</label>
			  <input type="number" min="0" max="6" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="NoDiasTrabajados" value="<?php echo $Nomina->getNoDiasTrabajados(); ?>" 
			  name="NoDiasTrabajados" <?php echo $disabled; ?> required>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			  <label for="inputEmail4">7DIA</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="SeptimoDia" value="<?php echo $Nomina->getSeptimoDia(); ?>" 
			  name="Septimo_Dia" disabled required>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			  <label for="inputEmail4">SUELDO BASE</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="SueldoBase" value="<?php echo $Nomina->getSueldoBase(); ?>" 
			  name="SueldoBase" disabled required>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			  <label for="inputEmail4">SUELDO</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Sueldo" value="<?php echo $Nomina->getSueldo(); ?>" 
			  name="Sueldo" disabled required>
			</div>
<!------------------------------------->
  			</div>

  			  <div class="form-row">
			<div class="form-group col-md-3">
			  <label for="inputEmail4">TOTAL EXTRAS</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="TotalExtras" value="<?php echo $Nomina->getTotalExtras(); ?>" 
			  name="TotalExtras" disabled required>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			  <label for="inputEmail4">INFONAVIT</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Infonavit" value="<?php echo $Nomina->getInfonavit(); ?>" 
			  name="Infonavit" disabled required>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			  <label for="inputEmail4">PRESTAMO</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Prestamo" value="<?php echo $Nomina->getPrestamo(); ?>" 
			  name="Prestamo" disabled required>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			  <label for="inputEmail4">SALDO ANTERIOR</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="SaldoAnterior" value="<?php echo $Nomina->getSaldoAnterior(); ?>" 
			  name="SaldoAnterior" disabled required>
			</div>
<!------------------------------------->
  			</div>

  			 <div class="form-row">
			<div class="form-group col-md-3">
			  <label for="inputEmail4">ABONO</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Abono" value="<?php echo $Nomina->getAbono(); ?>" 
			  name="Abono" <?php echo $disabled; ?> required>
			</div>
<!------------------------------------->
		<div class="form-group col-md-3">
			  <label for="inputEmail4">SUELDO ACTUAL</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="SueldoActual" value="<?php echo $Nomina->getSueldoActual(); ?>" 
			  name="SueldoActual"  disabled required>
			</div>
<!------------------------------------->
			<div class="form-group col-md-3">
			  <label for="inputEmail4">SUELDO NETO</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="SueldoNeto" value="<?php echo $Nomina->getSueldoNeto(); ?>" 
			  name="SueldoNeto" disabled required>
			</div>
<!-----------------Sólo se habilitará para la matriz-------------------->
			<div class="form-group col-md-3">
			  <label for="inputEmail4">COMENTARIOS</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Comentarios" value="<?php echo $Nomina->getComentarios(); ?>" name="Comentarios" <?php echo $disabled; echo $disabledCom; ?> >
			</div>
<!------------------------------------->

  			</div>
<!------------------------------------->    
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getidEmpleado(); ?>"
  		    name="idEmpleado"hidden>
<!------------------idDetalleNominaSucursal llave primaria de la tabla------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getidDetalleNominaSucursal(); ?>"
  		    name="idDetalleNominaSucursal"hidden>
<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getidNominaSucursal(); ?>"
  		    name="idNominaSucursal"hidden>
<!------------------------------------->    
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getidCategoriaEmpleado(); ?>"
  		    name="idCategoriaEmpleado"hidden>
<!------------------idDetalleNominaSucursal llave primaria de la tabla------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getSeptimoDia(); ?>"
  		    name="SeptimoDia"hidden>
<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getSueldoBase(); ?>"
  		    name="SueldoBase"hidden>


<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getSueldo(); ?>"
  		    name="Sueldo"hidden>

<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getTotalExtras(); ?>"
  		    name="TotalExtras"hidden>

<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getInfonavit(); ?>"
  		    name="Infonavit"hidden>

<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getPrestamo(); ?>"
  		    name="Prestamo"hidden>

<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getSaldoAnterior(); ?>"
  		    name="SaldoAnterior"hidden>
<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getSueldoActual(); ?>"
  		    name="SueldoActual"hidden>
<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getSueldoNeto(); ?>"
  		    name="SueldoNeto"hidden>
<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $Nomina->getComentarios(); ?>"
  		    name="ComentariosSucursal" hidden>
<!------------------------------------->
  		    <input type="text" class="form-control" value= "<?php echo $_SESSION['id_role'] ?>"
  		    name="rol" hidden>