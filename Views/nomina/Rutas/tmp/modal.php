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

//include_once 'Models/EmpleadosModel.php';

if(isset($_GET["id"])){
	$id = $_GET["id"]; 
}
$rutas=RutasModel::searchById($id); #Esta linea normalmente va en el controlador pero como no es MVC, puede ir aqui

ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($rutas as $key => $empI) {
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
			<div class="form-group col-md-12">
			  	<label for="inputPassword4">Nombre</label>
			  	<input type="text" class="form-control" id="inputPassword4" placeholder="Nombre de ruta" value="<?php echo $rutas->getNombre(); ?>" name="NombreRuta" <?php echo $disabled; ?> required>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
			  <label for="inputPassword4">Empresas</label>
			  <input type="text" class="form-control" min="1" id="inputPassword4" placeholder="Empresas" value="<?php echo $rutas->getEmpresas(); ?>" name="Empresas" <?php echo $disabled; ?>>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
			  <label for="inputPassword4">Comentarios</label>
			  <input type="text" class="form-control" id="inputPassword4" placeholder="Comentarios" value="<?php echo $rutas->getComentarios(); ?>" name="Comentarios" <?php echo $disabled; ?>>
			</div>
		</div>
				<!--campos necesarios, pero invisibles-->
			  	<input type="text" class="form-control" value="<?php echo $id; ?>" name="IdRuta" hidden>
			  	<input type="text" class="form-control" value="<?php echo $_SESSION['id_employe'];?>" name="EmpleadoCaptura" hidden>
			