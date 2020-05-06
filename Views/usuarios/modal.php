<?php
ini_set('display_errors', 1);

	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"]))
	{
		foreach ($this as $key => $usuario)
		{
			unset($this->$key);
		}
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

		  <div class="form-row">
			<div class="form-group col-md-4">
			  <label for="inputPassword4">Sucursal</label>
			  <select class="form-control" id="inputPassword4" <?php echo $disabled; ?> name="IdSucursal" required <?php echo UsuariosModel::permission_combobox(); ?>>
				<!--<option value="">Seleccionar</option> ...Ya no se muestra-->
				<?php
					$ListaSucursales = SucursalesModel::all();
					$selected_3 = '';
					foreach($ListaSucursales as $s){						
						//Este es para distinguir de los roles, ej, el combobox sugiere tu session id_sucursal para registrar en esa sucursal

						//jlopezl
						//al parecer este codigo de condicion estaba de mas
						//if(isset($_SESSION["id_sucursal"]) && $_SESSION["id_sucursal"]==$s->getIdSucursal())
						//{
							//Si la sucursal == a alguna de la lista
						//	$selected_3 = 'selected';
						//} 
						//else
						//Pero aqui al momento de editar muestra tus datos de la BD, y te indica la opcion seleccionada la primera vez que se guardo el registro
						//jlopezl
						//hasta aqui 	codigo de mas

						if($usuario->getIdSucursal() == $s->getIdSucursal()){ 
							$selected_3 = 'selected';
						} 
						else 
						{
							$selected_3 = '';
						}
				?>
					<option value="<?php echo $s->getIdSucursal(); ?>" <?php echo $selected_3; ?>><?php echo $s->getNombre(); ?></option>
				<?php } ?>
			  </select>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputEmail4">Buscar empleado</label>
			  <select class="form-control select2" id="inputPassword4" <?php echo $disabled; ?> name="IdEmpleado" required>
				<option value="">Seleccionar</option>
				<?php
					$ListaEmpleados = EmpleadosModel::all();
					$selected_1 = ''; $es_usuario='';
					foreach($ListaEmpleados as $e){
						if($usuario->getIdEmpleado() == $e->getIdEmpleado()){ $selected_1 = 'selected'; } else { $selected_1 = ''; }
						if($e->getEs_usuario()==1){ $es_usuario = 'hidden'; } else { $es_usuario = ''; }
						
					?>
					<option value="<?php echo $e->getIdEmpleado(); ?>" <?php echo $selected_1.' '.$es_usuario; ?>><?php echo EmpleadosModel::getOnlyName($e->getIdEmpleado()); ?></option>
				<?php } ?>.
			  </select>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputPassword4">Rol</label>
			  <select class="form-control" id="inputPassword4" <?php echo $disabled; ?> name="IdRol" required>
				<option value="">Seleccionar</option>
				<?php
					$ListaRoles = CRolesModel::all();
					$selected_2 = '';
					foreach($ListaRoles as $r){
						if($usuario->getIdRol()==$r->getIdRol()){ $selected_2 = 'selected'; } else { $selected_2 = ''; }

						/* Deshabilitacion de acciones Por rango de roles - Inicio */
						$hiddenByRol = '';
						if(isset($_SESSION["id_role"])){
							if($_SESSION["id_role"]==3 && $r->getIdRol()<3){	//Auxiliar de adm de sucursal
								$hiddenByRol = 'hidden';
							}
							if($_SESSION["id_role"]==2 && $r->getIdRol()==1){	//adm sucursal
								$hiddenByRol = 'hidden';
							}
							if($_SESSION["id_role"]==1){	//adm gral
								$hiddenByRol = '';
							}
						} /* Deshabilitacion de acciones Por rango de roles - Fin [Podras encontrar un bloque de codigo igual en el modelo del mismo modulo, metodo: all_json] */

					#if(isset($_SESSION["id_role"]) && $_SESSION["id_role"]=='1'){ echo 'tu si'; } else if($_SESSION["id_role"]=='2') { echo 'tu no'; } else if ($_SESSION["id_role"]=='3'){echo 'tu no';}
					?>
					<option value="<?php echo $r->getIdRol(); ?>" <?php echo $selected_2.' '.$hiddenByRol; ?>><?php echo CRolesModel::getOnlyName($r->getIdRol()); ?></option>
				<?php } ?>
			  </select>
			</div>			
			
		  </div>
		  <div class="form-row">
		  <!--
			<div class="form-group col-md-6">
			  <label for="inputEmail4">Contrase&ntilde;a</label>
			  <input type="password" class="form-control" id="inputEmail4" placeholder="Contrase&ntilde;a" <?php echo $disabled; ?> name="contrasena">
			</div> -->
			<div class="form-group col-md-4">
			  <label for="inputPassword4">Nombre de usuario</label>
			  <input type="text" class="form-control vf_username" id="username" value="<?php echo $usuario->getUsuario(); ?>" placeholder="Nombre de usuario" <?php echo $disabled; ?> name="usuario" autocomplete="off" required>
			  <span id="user-result"></span>
			</div>
			<div class="form-group col-md-6">
			  <label for="inputPassword4">Contrase&ntilde;a</label>
			  <input type="password" class="form-control" id="inputEmail4" placeholder="Contrase&ntilde;a" <?php echo $disabled; ?> name="contrasena"  autocomplete="off" >
			</div>
		  </div>
		  <div class="form-group form-check">
			<input type="checkbox" class="form-check-input" id="exampleCheck1" <?php echo $disabled; ?> name="estatus" <?php if($usuario->getEstatus()=="1"){ echo 'checked'; } else { } ?>>
			<label class="form-check-label" for="exampleCheck1">Usuario activo</label>
		  </div>
			<input type="text" class="form-control" value="<?php echo $usuario->getIdUsuario(); ?>" name="IdUsuario" hidden>
