<?php
ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($this as $key => $cliente) {
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
			<div class="form-group col-md-6">
			  <label for="inputEmail4">Nombre(s) </label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Nombre" value="<?php echo $cliente->getNombre(); ?>" name="Nombre" <?php echo $disabled; ?> required>
			</div>
			
			<!--<div class="form-group col-md-6">
			  <label for="inputEmail4">Apellidos</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Apellidos" value="<?php echo $cliente->getApellidos(); ?>" name="Apellidos" <?php echo $disabled; ?> required>
			</div>-->
			
			<div class="form-group col-md-5">
			  <label for="inputEmail4">RFC</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Registro Federal de Contribuyente" value="<?php echo $cliente->getRFC(); ?>" name="RFC" minlength="12" maxlength="13" <?php echo $disabled; ?> required>
			</div>
			<div class="form-group col-md-3">
			  <label for="inputPassword4">Tel&eacute;fono</label>
			  <input type="text" class="form-control vf_only_phone_num" id="inputPassword4" placeholder="Tel&eacute;fono" value="<?php echo $cliente->getTelefono(); ?>" name="Telefono" <?php echo $disabled; ?> required>
			</div>
		  </div>
		  <div class="form-row">
			<div class="form-group col-md-4">
			  <label for="inputPassword4">E-mail</label>
			  <input type="email" class="form-control" id="inputPassword4" placeholder="E-mail" value="<?php echo $cliente->getCorreoElectronico(); ?>" name="CorreoElectronico" <?php echo $disabled; ?> required>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputState">Estado</label>
			  
			  
				<select id="<?php if($modal_por_agregar == "false"){ /* ver, editar, eliminar */ ?>select-estado_ViewEditDelete<?php } else { ?>select-estado_Add<?php } ?>" class="form-control select2" name="IdEstado" <?php echo $disabled; ?> required>
					<option value="">Seleccionar</option>
					<?php
					global $id_estado_actual;
					
					$ListaEstados = EstadosModel::all();
					$selected_1 = '';
					foreach($ListaEstados as $e){
						/* pasos para retornar info de la DB para ver, editar o eliminar */
						#paso 1. Consultar el ID de ciudad que aparece en la info del cliente ya registrado
						#paso 2. Buscar el ID de estado al que pertenece el Id de Ciduad
						$id_estado_actual = CiudadesModel::getEstadoByCiudadRef($cliente->getIdCiudad());
						#paso 3. Ver si coincide el id de estado, de ser asi marcar como seleccionado
						if($id_estado_actual==$e->getIdEstado()){ $selected_1 = 'selected'; } else { $selected_1 = ''; };
					?>
					<option value="<?php echo $e->getIdEstado(); ?>" <?php echo $selected_1; ?>><?php echo string_encoder($e->getEstado()); ?></option>
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
						if($cliente->getIdCiudad() == $c->getId_ciudad()){ $selected_2 = 'selected'; } else { $selected_2 = ''; }
					?>
					<option value="<?php echo $c->getId_ciudad(); ?>" id="<?php echo $c->getId_ciudad(); ?>"  <?php echo $selected_2; ?>><?php echo string_encoder($c->getCiudad()); ?></option>
					<?php } ?>
				</select>
<?php } else {  /* Modal abierto: agregar  */ ?>
				<div id="response-for-select-ciudad"></div>
<?php } ?>


			</div>
		  </div>
		  <div class="form-row">
			<div class="form-group col-md-2">
			  <label for="inputZip">C&oacute;digo postal</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputZip" value="<?php echo $cliente->getCodigoPostal(); ?>" placeholder="C&oacute;digo postal" name="CodigoPostal" <?php echo $disabled; ?> required>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputZip">Colonia</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputZip" value="<?php echo $cliente->getColonia(); ?>" placeholder="Colonia" name="Colonia" <?php echo $disabled; ?> required>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputZip">Calle</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputZip" value="<?php echo $cliente->getCalle(); ?>" placeholder="Calle" name="Calle" <?php echo $disabled; ?> required>
			</div>
			<div class="form-group col-md-2">
			  <label for="inputZip">N&uacute;m de casa</label>
			  <input type="text" class="form-control vf_no_spl_char" id="inputZip" value="<?php echo $cliente->getNum(); ?>" placeholder="N&uacute;m de casa" name="Num" <?php echo $disabled; ?> required>
			</div>
		  </div>
				<input type="text" class="form-control" value="<?php echo $cliente->getIdcliente(); ?>" name="IdCliente" hidden>