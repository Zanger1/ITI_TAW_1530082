	<?php
$id = '';
if(isset($_GET["id"])){
	$id = $_GET["id"];
}
$PreNomina=PreNominaModel::searchById($id); #Esta linea normalmente va en el controlador pero como no es MVC, puede ir aqui

ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"]))
	{
		foreach ($PreNomina as $key => $PreNomina) 
		{
			unset($PreNomina->$key);
		}
	}

	/*
		Como saber si el modal que se abre, es para agregar? el ID que manda es 0. Yo tomo el ID 0 porque en la BD no coincide con ningun registro
		Pero si ese ID es mayor que 0 signfica que la modal abierta es para ver, editar, o por eliminar. Entonces
	*/
	$modal_por_agregar = "false";
	if(isset($_GET["id"]) && $_GET["id"]=='0')
	{
		$modal_por_agregar = "true";
	}

	//Parametro de la URL "edit" para habilitar o deshabilitar los campos del formulario: "true,false"
	$disabled = "";
	if(isset($_GET["edit"]))
	{
		$editable = $_GET["edit"];
		if($editable=="true")
		{
			$disabled = "";
		} else if($editable=="false")
		{
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
<?php



		$_SESSION["NoSemana"] = $PreNomina->getNoSemana();
		$_SESSION["idPrenomina"] = $PreNomina->getidPrenominaExtra();

		//echo $PreNomina->getNoSemana(); 
		//echo "<br>";
		//echo $PreNomina->getidPrenominaExtra(); 
		//echo "<br>";
		/*
		echo $_SESSION["NoSemana"]; 
		echo "<br>";
		echo $_SESSION["idPrenomina"]; 
*/


?>
  <div class="form-group col-md-3">
    	<label for="inputNumero">NoSemana</label>
    <input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $PreNomina->getNoSemana(); ?>" <?php echo $disabled; ?> name="NoSemana"required>
  </div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

	<div class="form-group col-md-3">
		<label for="inputNumero">Fecha Inicio</label>
		<input type="date" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $PreNomina->getFechaInicio(); ?>" <?php echo $disabled; ?>  name="FechaInicio" required>
	</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

	<div class="form-group col-md-3">
		<label for="inputNumero">Fecha Termino</label>
		<input type="date" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $PreNomina->getFechaTermino(); ?>" <?php echo $disabled; ?> name="FechaTermino" required>
	</div>

	<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

		<div class="form-group col-md-3">
			<label for="inputNumero">Situacion</label>
			<!--input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Situacion" value="<?php
			//cambiar a combobox y llenarlo con los datos de la tabla c_situacion_nominas`
			//null o 2 = Propuesta,  0=Aceptado y 1 Rechazado
			/*if (is_null($PreNomina->getidSituacionPrenominaExtra()) || 2)
			{
					echo "Propuesta";
			}
			else if ($PreNomina->getidSituacionPrenominaExtra()==0)
			{
				echo "Aceptada";
			}
			else if( $PreNomina->getidSituacionPrenominaExtra()==1)
			{
					echo "Rechazada";
			}*/
			
			?>" <?php //echo $disabled; ?> name="Status" required-->
			<select id="inputState1" class="form-control" name="c_situacion_nominas" 
				<?php 
					if($_SESSION["id_role"] == 1 || $_SESSION["id_role"] == 5){
							echo 'enabled';
					} else {
							echo 'disabled';
					}
				?> >
				<option value="">Seleccionar</option>
				<?php
							
					$ListaSituacion = c_situacion_nominasModel::all();
					$selected_3 = '';
					foreach($ListaSituacion as $s){
						//if($empleado->getIdSituacionEmpleado() == $s->getIdSituacionEmpleado()){ $selected_3 = 'selected'; } else { $selected_3 = ''; }
						if($modal_por_agregar == "true" && $s->getIdSituacion_nomina() == 3){?>
							<option value="<?php echo $s->getidSituacion_nomina(); ?>" selected> <?php echo $s->getDesSituacionNomina(); ?></option>
				<?php	} else{ ?>
							<option value="<?php echo $s->getidSituacion_nomina(); ?>"><?php echo $s->getDesSituacionNomina(); ?></option>
					<?php 	
						}
					?>
					<!--<option value="<?php// echo $s->getidSituacion_nomina(); ?>"<?php //echo $selected_3; ?>><?php// echo $s->getDesSituacionNomina(); ?></option>-->
				<?php } ?>	
			</select>


		</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

	<div class="form-group col-md-3">
		<label for="inputNumero">Comentarios</label>
		<textarea type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Comentario Sucursal"  <?php echo $disabled; ?> name="ComentarioSucursal" required>
			<?php echo trim($PreNomina->getComentarioSucursal()); ?>
		</textarea>
	</div>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
	<!----> 
	<div class="form-group col-md-3" style="display: none">
		<label for="inputNumero">Empleado Captura</label>
		<input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $_SESSION["id_user"];?>" name="idEmpleado"  required>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

		<label for="inputNumero">Fecha Captura</label>
		<input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo date("yy-m-d");?>" name="FechaCaptura" required>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <label for="inputNumero">ID PreNomina</label>
    <input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="0<?php echo $_SESSION["idPrenomina"]; ?>" name="idPrenomina"  required>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

    <label for="inputNumero">Sucursal</label>
    <input type="text" class="form-control vf_no_spl_char" id="inputNumero" placeholder="Numero" value="<?php echo $_SESSION["id_sucursal"]; ?>" name="idSucursal"required>
  </div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


	<div class="form-group col-md-3">
		<?php
		//Guardo el numero de semana para que al momento de abrir la pestaña de prenomia solo muestre los datos de esat semana
		//$_SESSION["NoSemana"] = $PreNomina->getNoSemana();
		//$_SESSION["idPrenomina"] = $PreNomina->getidPrenominaExtra();

        $NoSemana =  $_SESSION['NoSemana'];
        $IdPrenominaExtra = $PreNomina->getidPrenominaExtra();
		?>
	 		<!--<a href="index.php?view=PrenominaDetalles&action=index">
			<button type="button" name="view"  class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button>
		</a>-->
		<?php
		/*echo "<a href='index.php?view=PrenominaDetalles&action=index&NoSemana=$NoSemana&IdPrenominaExtra=$IdPrenominaExtra'>
			<button type='button' name='view2'  class='btn btn-success btn-sm view' data-toggle='tooltip' data-placement='top' title='Ver'><i class='fa fa-eye'></i></button>
		</a>";*/
	?>
  </div>

	<script type="text/javascript">





	</script>



</div>
