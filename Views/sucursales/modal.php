<?php
ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($this as $key => $sucursal) {
			unset($this->$key);
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
			<div class="form-group col-md-4">
			 <label for="inputEmail4">Nombre de la sucursal</label>
			  <input type="text" class="form-control vf_no_spl_char" id="Nombre" placeholder="Nombre de la sucursal" value="<?php echo  $sucursal->getNombre(); ?>" name="Nombre" <?php echo $disabled; ?> required>
			</div>
			<div class="form-group col-md-5">
			  <label for="inputEmail4">Nombre Contacto</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Nombre Contacto" value="<?php echo $sucursal->getNombreContacto(); ?>" name="NombreContacto" minlength="0" maxlength="50" <?php echo $disabled; ?>>
			</div>
			<div class="form-group col-md-3">
			  <label for="inputPassword4">Correo Contacto</label>
			  <input type="email" class="form-control" id="inputPassword4" placeholder="Correo Contacto" value="<?php echo $sucursal->getCorreoContacto(); ?>" name="CorreoContacto" <?php echo $disabled; ?>>
			</div>
		  </div>

 		<div class="form-row">
			<div class="form-group col-md-4">
			  <label for="inputState">Estado</label>
				<select id="<?php if($modal_por_agregar == "false"){ /* ver, editar, eliminar */ ?>select-estado_ViewEditDelete<?php } else { ?>select-estado_Add<?php } ?>" class="form-control select2" name="IdEstado" <?php echo $disabled; ?> equired>
					<option value="">Seleccionar</option>
					<?php
					global $id_estado_actual;
					
					$ListaEstados = EstadosModel::all();
					$selected_1 = '';
					foreach($ListaEstados as $e){
						/* pasos para retornar info de la DB para ver, editar o eliminar */
						#paso 1. Consultar el ID de ciudad que aparece en la info del cliente ya registrado
						#paso 2. Buscar el ID de estado al que pertenece el Id de Ciduad
						$id_estado_actual = CiudadesModel::getEstadoByCiudadRef($sucursal->getIdCiudad());
						#paso 3. Ver si coincide el id de estado, de ser asi marcar como seleccionado
						if($id_estado_actual==$e->getIdEstado()){ $selected_1 = 'selected'; } else { $selected_1 = ''; };
					?>
					<option value="<?php echo $e->getIdEstado(); ?>" <?php echo $selected_1; ?>><?php echo $e->getEstado(); ?></option>
					<?php } ?>
				</select>
				
				
			</div>
			<div class="form-group col-md-4">
			  <label for="inputCity">Ciudad</label>
			  
			<?php
			/*
			 * $modal_por_agregar = True; (Agregar)
 			* $modal_por_agregar = False; (Ver, Editar, Eliminar)
 			*/
			#Modal abierto: ver, editar, eliminar
			if($modal_por_agregar == "false"){ ?>
				<select id="select-ciudad" class="form-control select2" name="IdCiudad" <?php echo $disabled; ?> required>
					<option value="">Seleccionar</option>
					<?php
					$ListaCiudades = CiudadesModel::searchByIdEstado($id_estado_actual); //all();
					$selected_2 = '';
					foreach($ListaCiudades as $c){
						if($sucursal->getIdCiudad() == $c->getId_ciudad()){ $selected_2 = 'selected'; } else { $selected_2 = ''; }
					?>
					<option value="<?php echo $c->getId_ciudad(); ?>" id="<?php echo $c->getId_ciudad(); ?>"  <?php echo $selected_2; ?>><?php echo $c->getCiudad(); ?></option>
					<?php } ?>
				</select>
			<?php } else {  /* Modal abierto: agregar  */ ?>
				<div id="response-for-select-ciudad"></div>
			<?php } ?>


			</div>
			<div class="form-group col-md-4">
			  <label for="inputState">Direcci&oacuten</label>
			   <input type="text" class="form-control vf_only_phone_num" id="inputPassword4" placeholder="Direccion" value="<?php echo $sucursal->getDireccion(); ?>" name="Direccion" <?php echo $disabled; ?>>
            </div>
  		</div>

		<div class="form-row">

			<div class="form-group col-md-4">
			  <label for="inputPassword4">Letra folio</label>
			   <input type="text" class="form-control vf_only_phone_num" id="inputPassword4" maxlength="1" required placeholder="Letra Folio" value="<?php echo $sucursal->getLetraFolio(); ?>" name="LetraFolio" <?php echo $disabled; ?> >
			</div>

			<div class="form-group col-md-4">
			  <label for="inputPassword4">Tel&eacute;fono</label>
			  <input type="Tel" class="form-control vf_only_phone_num" id="inputPassword4" placeholder="Tel&eacute;fono" pattern="[0-9]{10}" value="<?php echo $sucursal->getTelefono(); ?>" name="Telefono" <?php echo $disabled; ?>>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputPassword4">Tipo sucursal</label>

			<select id="inputPassword4" class="form-control" <?php echo $disabled; ?> name="IdTipoSucursal">
				<option value="">Seleccionar</option>
				<?php				
				$listatipoSucursal = CTipoSucursalModel::all();
				$selected_2 = '';
				foreach($listatipoSucursal as $c){
					if($sucursal->getIdTipoSucursal() == $c->getIdTipoSucursal()){ $selected_2 = 'selected'; } else { $selected_2 = ''; }
				?>
				<option value="<?php echo $c->getIdTipoSucursal(); ?>"<?php echo $selected_2; ?>><?php echo $c->getTipoSucursal(); ?></option>
				<?php } ?>
			  </select>
			</div>
		</div>


		 
		 <input type="text" class="form-control" value="<?php echo $sucursal->getIdSucursal(); ?>" name="IdSucursal" hidden>