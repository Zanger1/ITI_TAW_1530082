<?php
ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($this as $key => $inventario) {
			unset($this->$key);
		}
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

<div class="row">
	<div class="col-md-12">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputZip">Sucursal</label>
				<select id="IdSucursal" class="form-control" name="IdSucursal" <?php echo $disabled; ?> 					
					<?php echo UsuariosModel::permission_combobox(); ?> required>
					<option value="">Seleccionar</option>
					<?php 									
						$listaSucursales = SucursalesModel::all();
						$selected_1 = '';
						foreach($listaSucursales as $s){
							//Este es para distinguir de los roles, ej, el combobox sugiere tu session id_sucursal para registrar en esa sucursal
							if(isset($_SESSION["id_sucursal"]) && $_SESSION["id_sucursal"]==$s->getIdSucursal()){
									//Si la sucursal == a alguna de la lista
									$selected_1 = 'selected';
							} else //Pero aqui al momento de editar muestra tus datos de la BD, y te indica la opcion seleccionada la primera vez que se guardo el registro
                           /*
							if($inventario->getIdSucursal() == $s->getIdSucursal()){ $selected_1 = 'selected'; } else { $selected_1 = ''; }
                           */
							if($sucursalS->getIdSucursal() == $s->getIdSucursal()){ $selected_1 = 'selected'; } else { $selected_1 = ''; }
					?>
						<option value="<?php echo $s->getIdSucursal(); ?>"<?php echo $selected_1; ?>><?php echo $s->getNombre(); ?></option>
						<?php } ?>
				</select>
			</div>

			<div class="form-group col-md-6">
				<label for="inputZip">Servicio</label>
				<select id="inputState" class="form-control" <?php echo $disabled; ?> name="IdServicio" required>
					<option value="">Seleccionar</option>
					<?php
						//$listaSucursalS = UnidadesRentaModel::all();
						$lista =ServiciosModel::all();
						$selected_2 = '';
						foreach($lista as $u){
							if($sucursalS->getIdServicio() == $u->getIdServicio()){ $selected_2 = 'selected'; } else { $selected_2 = ''; }
					?>
						<option value="<?php echo $u->getIdServicio(); ?>"<?php echo $selected_2; ?>><?php echo $u->getNombreServicio(); ?></option>
					<?php } ?>
				</select>
			</div>
        </div>
         <div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputZip">Tamaño</label>
				<select id="IdTamano" class="form-control" name="IdTamano" <?php echo $disabled; ?> required>
					<option value="">Seleccionar</option>
					<?php
						$listaTamanoServicio = TamanoServicioModel::all();
						$selected_3 = '';
						foreach($listaTamanoServicio as $l){
							if($sucursalS->getIdServicio() == $l->getId()){ $selected_3 = 'selected'; } else { $selected_3 = ''; }
					?>
					<option value="<?php echo $l->getId(); ?>"<?php echo $selected_3; ?>><?php echo $l->getNombre(); ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="inputZip">Precio</label>
				<!-- jlopezl -->
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<input type="text" id="inputState" class="form-control numeric" <?php echo $disabled; ?> name="precio" placeholder="Precio" value="<?php echo $sucursalS->getPrecio(); ?>" required>
				</div>
			</div>		
		</div>

		<div class="form-row">	
			<div class="form-group col-md-6">
				<label for="inputZip">Inclye</label>
			<textarea class="form-control" id="inputZip" placeholder="Incluye" rows="4" <?php echo $disabled; ?> name="incluye"><?php echo $sucursalS->getIncluye(); ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="inputZip">Descripci&oacute;n</label>
				<textarea class="form-control" id="inputZip" placeholder="Descripci&oacute;n" rows="4" <?php echo $disabled; ?> name="descripcion"><?php echo $sucursalS->getDescripcion(); ?></textarea>
			</div>
	     </div>
 


	</div>
</div>
			  <input type="text" class="form-control" value="<?php echo $sucursalS->getIdSucursalServicio(); ?>" name="IdSucursalServicio" hidden>
