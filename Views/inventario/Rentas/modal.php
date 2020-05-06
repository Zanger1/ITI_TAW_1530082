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
			<div class="form-group col-md-4">
				<label for="inputZip">Sucursal</label>
				<select id="inputState" class="form-control" name="IdSucursal" <?php echo $disabled; ?> <?php echo UsuariosModel::permission_combobox(); ?> required>
					<option value="">Seleccionar</option>
					<?php /*
						$ListaSucursales = SucursalesModel::all();
						$selected_1 = '';
						foreach($ListaSucursales as $su){
							#if()
								if(isset($_SESSION["id_sucursal"]) && $_SESSION["id_sucursal"]==$su->getIdSucursal() ){ $selected_1 = 'selected'; } else { $selected_1 = ''; }
							#if($inventario->getIdSucursal() == $su->getIdSucursal()){ $selected_1 = 'selected'; } else { $selected_1 = ''; }
				*/
						$ListaSucursales = SucursalesModel::all();
						$selected_1 = '';
						foreach($ListaSucursales as $s){
							//Este es para distinguir de los roles, ej, el combobox sugiere tu session id_sucursal para registrar en esa sucursal
							if(isset($_SESSION["id_sucursal"]) && $_SESSION["id_sucursal"]==$s->getIdSucursal()){
									//Si la sucursal == a alguna de la lista
									$selected_1 = 'selected';
							} else //Pero aqui al momento de editar muestra tus datos de la BD, y te indica la opcion seleccionada la primera vez que se guardo el registro

							if($inventario->getIdSucursal() == $s->getIdSucursal()){ $selected_1 = 'selected'; } else { $selected_1 = ''; }
					?>
						<option value="<?php echo $s->getIdSucursal(); ?>"<?php echo $selected_1; ?>><?php echo $s->getNombre(); ?></option>
						<?php } ?>
				</select>
<!--				<select id="inputState" class="form-control" name="IdSucursal" hidden>
					<option value="">Seleccionar</option>
					<?php
						$ListaSucursales = SucursalesModel::all();
						$selected_1 = '';
						foreach($ListaSucursales as $su){
							#if()
								if(isset($_SESSION["id_sucursal"]) && $_SESSION["id_sucursal"]==$su->getIdSucursal() ){ $selected_1 = 'selected'; } else { $selected_1 = ''; }
							#if($inventario->getIdSucursal() == $su->getIdSucursal()){ $selected_1 = 'selected'; } else { $selected_1 = ''; }
					?>
						<option value="<?php echo $su->getIdSucursal(); ?>"<?php echo $selected_1; ?>><?php echo $su->getNombre(); ?></option>
					<?php } ?>
				</select>-->
			</div>
			<div class="form-group col-md-4">
				<label for="inputZip">Unidad</label>
				<select id="inputState" class="form-control" <?php echo $disabled; ?> name="IdUnidadRenta" required>
					<option value="">Seleccionar</option>
					<?php
						$ListaUnidades = UnidadesRentaModel::all();
						$selected_2 = '';
						foreach($ListaUnidades as $u){
							if($inventario->getIdUnidadRenta() == $u->getIdUnidadRenta()){ $selected_2 = 'selected'; } else { $selected_2 = ''; }
					?>
						<option value="<?php echo $u->getIdUnidadRenta(); ?>"<?php echo $selected_2; ?>><?php echo $u->getDesUnidad(); ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-4">
				<label for="inputZip">Tipo</label>
				<select id="inputState" class="form-control" <?php echo $disabled; ?> name="IdTipoUnidades" required>
					<option value="">Seleccionar</option>
					<?php
						$ListaTipos = CTipoUnidadesModel::all();
						$selected_3 = '';
						foreach($ListaTipos as $l){
							if($inventario->getIdTipoUnidades() == $l->getIdTipoUnidades()){ $selected_3 = 'selected'; } else { $selected_3 = ''; }
					?>
					<option value="<?php echo $l->getIdTipoUnidades(); ?>"<?php echo $selected_3; ?>><?php echo $l->getDescTipoUnidad(); ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputZip">Incluye</label>
				<textarea class="form-control" id="inputZip" placeholder="Incluye" rows="4" <?php echo $disabled; ?> name="Incluye"><?php echo $inventario->getIncluye(); ?></textarea>
			</div>
			<div class="form-group col-md-6">
				<label for="inputZip">Descripci&oacute;n</label>
				<textarea class="form-control" id="inputZip" placeholder="Descripci&oacute;n" rows="4" <?php echo $disabled; ?> name="Descripcion"><?php echo $inventario->getDescripcion(); ?></textarea>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="inputZip">Precio unitario</label>
				<!-- jlopezl -->
				<div class="input-group">
					<span class="input-group-addon">$</span>
					<input type="text" id="inputState" class="form-control numeric" <?php echo $disabled; ?> name="Precio" placeholder="Precio" value="<?php echo $inventario->getPrecio(); ?>" required>
				</div>
			</div>
			<div class="form-group col-md-4">
				<label for="inputZip">Cantidad</label>
				<input type="number" id="inputState" class="form-control" <?php echo $disabled; ?> name="cantidad" min="1" value="<?php echo $inventario->getCantidad(); ?>" required>
			</div>
		</div>
	</div>
</div>
			  <input type="text" class="form-control" value="<?php echo $inventario->getIdInventarioUnidadesRenta(); ?>" name="IdInventarioUnidadesRenta" hidden>