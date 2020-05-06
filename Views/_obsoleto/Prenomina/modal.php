	<?php
$id = '';
if(isset($_GET["id"])){
	$id = $_GET["id"];
}
$PreNomina=PreNominaExtraModel::searchById($id); #Esta linea normalmente va en el controlador pero como no es MVC, puede ir aqui

ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($PreNomina as $key => $PreNomina) {
			unset($PreNomina->$key);
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
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<div class="form-row">
  <!--
id Empleado Tabla EMPLEADO
Nombre Empleado   Empleado
NombreExtra       Extras Sucursal
-->

  <div class="form-group col-md-3">
    	<label for="inputNumero">NoSemana</label>
    <input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $PreNomina->getNoSemana(); ?>" name="NoSemana"required>
  </div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

	<div class="form-group col-md-3">
		<label for="inputNumero">Fecha Inicio</label>
		<input type="date" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $PreNomina->getFechaInicio(); ?>" name="FechaInicio" required>
	</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

	<div class="form-group col-md-3">
		<label for="inputNumero">Fecha Termino</label>
		<input type="date" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $PreNomina->getFechaTermino(); ?>" name="FechaTermino" required>
	</div>

	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

		<div class="form-group col-md-3">
			<label for="inputNumero">Situacion</label>
			<input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php
			if ($PreNomina->getidSituacionPrenominaExtra()==0)
			{
				echo "Aceptada";
			}
			else if( $PreNomina->getidSituacionPrenominaExtra()==1){

					echo "Rechazada";
				}
				else {
					echo "Pediente";
				}
			?>" name="Satus"required>
		</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

	<div class="form-group col-md-3">
		<label for="inputNumero">Comentarios</label>
		<textarea type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Comentario General" value="<?php echo $PreNomina->getComentarioGeneral(); ?>" name="Comentario" required>
		</textarea>
	</div>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	<!---->
	<div class="form-group col-md-3" style="display: none" >
		<label for="inputNumero">Empleado Captura</label>
		<input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $_SESSION["id_user"];?>" name="idEmpleado"  required>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

		<label for="inputNumero">Fecha Captura</label>
		<input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo date("yy-m-d");;?>" name="FechaCaptura" required>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <label for="inputNumero">ID PreNomina</label>
    <input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="0<?php echo $PreNomina->getidPrenominaExtra(); ?>" name="idPrenomina"  required>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <label for="inputNumero">Sucursal</label>
    <input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $_SESSION["id_sucursal"]; ?>" name="idSucursal"required>
  </div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


	<div class="form-group col-md-3">
		<?php
		//Guardo el numero de semana para que al momento de abrir la pestaña de prenomia solo muestre los datos de esat semana
		$_SESSION["NoSemana"] = $PreNomina->getNoSemana();
		$_SESSION["idPrenomina"] = $PreNomina->getidPrenominaExtra();
		?>
		<a href="index.php?view=PreNominaDetalles&action=index">

			<button type="button" name="view"  class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button>
		</a>

  </div>

	<script type="text/javascript">





	</script>



</div>
