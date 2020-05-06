<?php
ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"]))
	{
		foreach ($this as $key => $cc) 
		{
			unset($this->$key);
		}
	}

	//Parametro de la URL "edit" para habilitar o deshabilitar 
	//los campos del formulario: "true,false"
	$disabled = "";
	if(isset($_GET["edit"])){
		$editable = $_GET["edit"];
		if($editable=="true"){
			$disabled = "";	
		} else if($editable=="false"){
			$disabled = "disabled";	
		}
	}

	//Variables de session
	$id_session="";
	if(isset($_SESSION["id_user"])){
		$id_session = $_SESSION["id_user"];
	}

	$id_sucursal="";
	if(isset($_SESSION["id_sucursal"])){
		$id_sucursal = $_SESSION["id_sucursal"];
	} 

	/*	#Update: Ya no se calcula via PHP, ahora ajax determina
	//Cuanto dinero hay actualmente en la caja de la sucursal */
	$total_caja_actualmente = SucursalesModel::getTotalEnCajaActual($id_sucursal);
?>

	<div class="form-row">
		<div class="row col-md-7">
			<div class="form-group col-md-4">
			  <label for="inputEmail4">Tipo</label>
			  <select id="tipoMovimiento" class="form-control" required name="IdTipoMovimiento" <?php echo $disabled; ?>>
				<option value="">Seleccionar</option>
					<?php
					$ListaTipos = CTipoMovimientoModel::all();
					$selected_1 = '';
					foreach($ListaTipos as $t)
					{
						#Comprobar si se esta seleccionando desde el registro de la BD
						if($cc->getIdTipoMovimiento() == $t->getIdTipoMovimiento())
							{ 
								$selected_1 = 'selected'; 
							} 
							else 
							{ 
								$selected_1 = ''; 
							}
						
						#Si no hay dinero en la sucursal no se puede retirar
						$no_retirar = '';
						if($t->getIdTipoMovimiento() == 2)
						{
							if($total_caja_actualmente <= 0)
							{ 
									$no_retirar = 'disabled'; 
							}
						}
					?>
					<option value="<?php echo $t->getIdTipoMovimiento(); ?>" <?php echo $selected_1.' '.$no_retirar; ?>><?php echo $t->getDesTipoMovimiento(); ?></option>
					<?php } ?>
			  </select>
			</div>

			<div class="form-group col-md-5">
			  <label for="inputPassword4">Fecha</label>
			  <input type="date" required class="form-control" id="inputEmail4" name="Fecha" placeholder="Fecha" <?php
					if(isset($_GET["id"]) && $_GET["id"]<1)
					{
						//Si esta agregando se le sugiere una fecha pero se puede editar antes de enviar
						echo 'value="'.date("Y-m-d").'" ';
					} 
					else 
					{
						//Si esta viendo / eliminando / editando ENTONCES trae la fecha de la BD y el campo es desactivado
						echo 'value="'.$cc->getFecha(). '" disabled';
					}
					 ?>> <!-- cierra input type="date" name="Fecha"-->
			</div>

			<div class="form-group col-md-4">
		

			  <label for="registrar-monto">Cantidad</label>
			  <div class="input-group-prepend">
				<span class="input-group-text">$</span>
			  <input type="text" required class="form-control numeric" id="registrar-monto" placeholder="cantidad" value="<?php echo $cc->getMonto(); ?>" name="Monto" <?php echo $disabled; ?>>
			  </div>  
			</div>

			<div class="form-group col-md-6">
			  <label for="inputPassword4">Sucursal</label>
			  <select class="form-control" id="SucursalCaja" <?php echo $disabled; ?> name="IdSucursal" required <?php echo UsuariosModel::permission_combobox(); ?>>
				<option value="">Seleccionar</option>
				<?php
/*					$ListaSucursales = SucursalesModel::all();
					$selected_3 = '';
					foreach($ListaSucursales as $s){
						if($cc->getIdSucursal() == $s->getIdSucursal()){ $selected_3 = 'selected'; } else { $selected_3 = ''; }
*/
					$ListaSucursales = SucursalesModel::all();
					$selected_3 = '';
					foreach($ListaSucursales as $s)
					{		
						//PONER AQUI EL GET = 0 (SABER SI AGREGA)
						//Este es para distinguir de los roles, 
						//ej, el combobox sugiere tu session id_sucursal para registrar en esa sucursal

						if(isset($_GET["id"]) && $_GET["id"]==0 && isset($_SESSION["id_sucursal"]) && $_SESSION["id_sucursal"]==$s->getIdSucursal())
						{
							//Si la sucursal == a alguna de la lista
							$selected_3 = 'selected';
						} 
						else
						//Pero aqui al momento de editar muestra tus datos de la BD, y te indica la opcion seleccionada la primera vez que se guardo el registro
						if($_GET["id"]>0 && $cc->getIdSucursal() == $s->getIdSucursal()){ 
							$selected_3 = 'selected';
						} else {
							$selected_3 = '';
						}
				?>
					<option value="<?php echo $s->getIdSucursal(); ?>" <?php echo $selected_3; ?>><?php echo $s->getNombre(); ?></option>
				<?php 
			    } 
			    ?>
			  </select>
			</div>
			<div class="form-group col-md-6">
			  <label for="inputPassword4">Empleado</label>
			  <input type="text" class="form-control" value="<?php
					if(isset($_GET["id"]) && $_GET["id"]==0)
					{
						//Si el ID de la url es 0, es porque el modal que abrio el usuario es para AGREGAR
						//POR LO TANTO se muestra la session ACTIVA del navegador
						if(isset($_SESSION["id_employe"]))
						{
							echo EmpleadosModel::getOnlyName($_SESSION["id_employe"]);							
						}
						#echo $nombre_encargado;
					} else 
					{
						//CASO CONTRARIO lo que devuelta la BD
						echo EmpleadosModel::getOnlyName($cc->getIdEmpleado());
					} ?> " disabled><!--  Siempre deshabilitado -->
			</div>
		</div>

		<div class="row col-md-4">
			<div class="form-group col-md-12">
			  <label for="inputPassword4">Detalles</label>
			  <textarea class="form-control vf_no_spl_char" id="inputEmail4" style="height:125px;" placeholder="Detalles" name="Descripcion" <?php echo $disabled; ?>><?php echo $cc->getDescripcion(); ?></textarea>
			</div>
		</div>

				<input type="text" class="form-control" value="<?php echo $cc->getIdCajaChica(); ?>" name="IdCajaChica" hidden>
				<!-- <input type="text" class="form-control" value="<?php 
				if(isset($_GET["id"]) && $_GET["id"]==0)
				{ 
					echo $id_sucursal; 
				} else 
				{ 
					echo $cc->getIdSucursal(); 
				} ?>" name="IdSucursal" hidden> -->
				<input type="text" class="form-control" value="<?php echo $id_session; ?>" name="IdEmpleado" hidden>
				
				<?php #if(isset($_GET["id"]) && $_GET["id"]>1){ ?>
				 <input type="text" value="" id="CantidadTotalCajaSucursal" hidden>
				<?php #} ?>
	</div>
