<?php
ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($this as $key => $empleado) {
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
		  <div class="form-row">
			<div class="form-group col-md-4">
			  <label for="inputEmail4">Nombre(s)</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Nombre(s)" <?php echo $disabled; ?> value="<?php echo $empleado->getNombreEmpleado(); ?>" name="NombreEmpleado" required>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputPassword4">Apellido paterno</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Apellido paterno" <?php echo $disabled; ?> value="<?php echo $empleado->getApellidoPat(); ?>" name="ApellidoPat" required>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputPassword4">Apellido materno</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Apellido paterno" <?php echo $disabled; ?> value="<?php echo $empleado->getApellidomat(); ?>" name="Apellidomat" required>
			</div>
		  </div>
		  <div class="form-row">
			<div class="form-group col-md-3">
			  <label for="inputZip">Sexo</label>
			  <select class="form-control" id="inputZip" <?php echo $disabled; ?> name="Sexo" required>
				<option value="">Seleccionar</option><!-- Ponle un if a cada uno, ej.. -->
				<option value="M" <?php if($empleado->getSexo()=="M"){ echo "selected"; } else { }  ?>>Hombre</option><!-- Male:Masculino:Hombre --> <!-- if(Lo que viene de la BD == M) { selected } -->
				<option value="F" <?php if($empleado->getSexo()=="F"){ echo "selected"; } else { }  ?>>Mujer</option><!-- FeMale:Femenino:Mujer --> <!-- if(Lo que viene de la BD == F) { selected } -->
			  </select>
			</div>
			<div class="form-group col-md-3">
			  <label for="inputEmail4">RFC</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="RFC" <?php echo $disabled; ?> value="<?php echo $empleado->getRFC(); ?>" name="RFC" minlength="12" maxlength="13" required>
			</div>
			<div class="form-group col-md-3">
			  <label for="inputEmail4">NSS</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="NSS" <?php echo $disabled; ?> value="<?php echo $empleado->getNSS(); ?>" name="NSS" minlength="12" maxlength="16" required>
			</div>
			<div class="form-group col-md-3">
			  <label for="inputPassword4">Tel&eacute;fono</label>
			  <input type="text" class="form-control vf_only_phone_num" id="inputPassword4" placeholder="Tel&eacute;fono" <?php echo $disabled; ?> value="<?php echo $empleado->getTelefono(); ?>" name="Telefono" required>
			</div>
		  </div>
		  <div class="form-row">
			<div class="form-group col-md-5">
			  <label for="inputPassword4">E-mail</label>
			  <input type="email" class="form-control" id="inputPassword4" placeholder="E-mail" <?php echo $disabled; ?> value="<?php echo $empleado->getCorreoElectronico(); ?>" name="CorreoElectronico" required>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputZip">Sucursal</label>
			  <select id="inputState" class="form-control" <?php echo $disabled; ?> name="IdSucursal" required <?php echo UsuariosModel::permission_combobox(); ?>>
				<option value="">Seleccionar</option>
				<?php
				$ListaSucursales = SucursalesModel::all();
				$selected_1 = '';
				foreach($ListaSucursales as $s){
					//Este es para distinguir de los roles, ej, el combobox sugiere tu session id_sucursal para registrar en esa sucursal
					if(isset($_SESSION["id_sucursal"]) && $_SESSION["id_sucursal"]==$s->getIdSucursal()){
							//Si la sucursal == a alguna de la lista
							$selected_1 = 'selected';
					} else //Pero aqui al momento de editar muestra tus datos de la BD, y te indica la opcion seleccionada la primera vez que se guardo el registro

					if($empleado->getIdSucursal() == $s->getIdSucursal()){ $selected_1 = 'selected'; } else { $selected_1 = ''; }
				?>
				<option value="<?php echo $s->getIdSucursal(); ?>"<?php echo $selected_1; ?>><?php echo $s->getNombre(); ?></option>
				<?php } ?>
			  </select>
			</div>
			<div class="form-group col-md-3">
			  <label for="inputZip">Fecha de ingreso</label>
			  <input type="date" class="form-control" id="inputZip" <?php echo $disabled; ?> value="<?php echo $empleado->getFecha_ingreso(); ?>" name="Fecha_ingreso" required>
			</div>
		  </div>
		  <div class="form-row">
			<div class="form-group col-md-4">
			  <label for="inputZip">Tipo de empleado</label>
			  <select id="inputState" class="form-control" <?php echo $disabled; ?> name="IdCategoriaEmpleado" required>
				<option value="">Seleccionar</option>
				<?php
				$ListaCategorias = CCategoriaEmpleadoModel::all();
				$selected_2 = '';
				foreach($ListaCategorias as $c){
					if($empleado->getIdCategoriaEmpleado() == $c->getIdCategoriaEmpleado()){ $selected_2 = 'selected'; } else { $selected_2 = ''; }
				?>
				<option value="<?php echo $c->getIdCategoriaEmpleado(); ?>"<?php echo $selected_2; ?>><?php echo $c->getDesCategoriaEmpleado(); ?></option>
				<?php } ?>
			  </select>
			</div>
			<div class="form-group col-md-3">
			  <label for="inputZip">Situaci&oacute;n</label>
			  <select id="inputState" class="form-control" <?php echo $disabled; ?> name="IdSituacionEmpleado" required>
				<option value="">Seleccionar</option>
				<?php
				$ListaSituacion = SituacionEmpleadoModel::all();
				$selected_3 = '';
				foreach($ListaSituacion as $s){
					if($empleado->getIdSituacionEmpleado() == $s->getIdSituacionEmpleado()){ $selected_3 = 'selected'; } else { $selected_3 = ''; }
				?>
				<option value="<?php echo $s->getIdSituacionEmpleado(); ?>"<?php echo $selected_3; ?>><?php echo $s->getDescSitEmpleado(); ?></option>
				<?php } ?>
			  </select>
			</div>
			<div class="form-group col-md-2">
				
			  	
			  		<label for="inputZip">Sueldo base</label>
			  		<input type="text" style="text-align:right;" class="form-control vf_no_spl_char" id="inputZip" placeholder="Sueldo base" <?php echo $disabled; ?> value="<?php echo $empleado->getSalarioDiario(); ?>" name="SalarioDiario" required>
				
			</div>
			<div class="form-group col-md-3">
			  <label for="inputZip">% de compensaci&oacute;n</label>
			  <input type="text" style="text-align:right;" class="form-control vf_no_spl_char" id="inputZip" placeholder="Porcentaje de compensaci&oacute;n" <?php echo $disabled; ?> value="<?php echo $empleado->getPorcentajeCompensacion(); ?>" name="PorcentajeCompensacion" required>
			</div>
		  </div>
			  <input type="text" class="form-control" value="<?php echo $empleado->getIdEmpleado(); ?>" name="IdEmpleado" hidden>