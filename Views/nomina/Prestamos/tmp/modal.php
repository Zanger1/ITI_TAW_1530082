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

include_once 'Models/EmpleadosModel.php';

if(isset($_GET["id"])){
	$id = $_GET["id"]; 
}
$empleadoPrestamo=PrestamosModel::searchById($id); #Esta linea normalmente va en el controlador pero como no es MVC, puede ir aqui

ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($empleadoPrestamo as $key => $empI) {
			unset($empI->$key);
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
			<div class="form-group col-md-8">
			  <label for="inputEmail4">Buscar empleado</label>
			  <select class="form-control select2" id="inputPassword4" <?php echo $disabled; ?> name="NameEmpleado" required>
				<option value="">Seleccionar</option>
				<?php
					$ListaEmpleados = EmpleadosModel::all();
					$selected_1 = ''; $es_usuario='';
					foreach($ListaEmpleados as $e){
						if($empleadoPrestamo->getIdEmpleado() == $e->getIdEmpleado()){ $selected_1 = 'selected'; } else { $selected_1 = ''; }
						//if($e->getEs_usuario()==1){ $es_usuario = 'hidden'; } else { $es_usuario = ''; }
					?>
					<option value="<?php echo $e->getIdEmpleado(); ?>" <?php echo $selected_1.' '.$es_usuario; ?>><?php echo EmpleadosModel::getOnlyName($e->getIdEmpleado());?></option>
				<?php } ?>.
			  </select>
			</div>
			<div class="form-group col-md-4">
			  	<label for="inputPassword4">Fecha del prestamo</label>
			  	<input type="date" class="form-control" id="inputPassword4" placeholder="Fecha del prestamo" value="<?php echo $empleadoPrestamo->getFechaInicio(); ?>" name="FechaPrestamo" <?php echo $disabled; ?>>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-4">
			  <label for="inputPassword4">Monto Prestamo</label>
			   <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			    <input type="text" class="form-control vf_only_phone_num" id="inputPassword4" placeholder="Monto prestamo" value="<?php echo $empleadoPrestamo->getMontoPrestamo(); ?>" name="MontoPrestamo" <?php echo $disabled; ?> required>
			  </div>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputPassword4">Semanas para pagar</label>
			  <input type="number" class="form-control" min="1" id="inputPassword4" placeholder="Numero de semanas" value="<?php echo $empleadoPrestamo->getNoSemanasAPagar(); ?>" name="NoSemanas" <?php echo $disabled; ?>>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputPassword4">Abono Semanal</label>
			   <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			    <input type="text" class="form-control" id="inputPassword4" placeholder="Abono Semanal" value="<?php echo $empleadoPrestamo->getAbonoBase(); ?>" name="AbonoSemana" <?php echo $disabled; ?>>
			  </div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
			  <label for="inputPassword4">Comentarios</label>
			  <input type="text" class="form-control" id="inputPassword4" placeholder="Comentarios" value="<?php echo $empleadoPrestamo->getComentarios(); ?>" name="Comentarios" <?php echo $disabled; ?>>
			</div>
		</div>
				<!--campos necesarios, pero invisibles-->
				<input type="text" class="form-control" value="<?php echo $empleadoPrestamo->getMontoRestante(); ?>" name="MontoRestante" hidden>
			  	<input type="text" class="form-control" value="<?php echo $id; ?>" name="IdEmpleadoPrestamo" hidden>
			  	<input type="text" class="form-control" value="<?php echo $_SESSION['id_employe'];?>" name="EmpleadoCaptura" hidden>
			