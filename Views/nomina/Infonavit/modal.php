<?php

include_once 'Models/EmpleadosModel.php';

$id='';
if(isset($_GET["id"])){
	$id = $_GET["id"]; 
}
$empleadoInfonavit=EmpleadoInfonavitModel::searchById($id); #Esta linea normalmente va en el controlador pero como no es MVC, puede ir aqui

ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($empleadoInfonavit as $key => $empI) {
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
	$hidden = "";
	$col_md = "";
	if(isset($_GET["edit"])){
		$editable = $_GET["edit"];
		if($editable=="true"){
			$disabled = "";
			$hidden="hidden";
			$col_md = "col-md-6";	
		} else if($editable=="false"){
			$disabled = "disabled";
			$col_md = "col-md-4";
		}
	}
?>

		  <div class="form-row">
			<div class="form-group col-md-12">
			  <label for="inputEmail4">Buscar empleado</label>
			  <select class="form-control" id="inputPassword4" <?php echo $disabled; ?> name="NameEmpleado" required>
				<option value="">Seleccionar</option>
				<?php
					$ListaEmpleados = EmpleadosModel::allEmpleadosSinInfonavit($empleadoInfonavit->getIdEmpleado(),$_SESSION['id_sucursal']);
					$selected_1 = ''; $es_usuario='';
					foreach($ListaEmpleados as $e){
						if($empleadoInfonavit->getIdEmpleado() == $e->getIdEmpleado()){
							$selected_1 = 'selected'; 
						}else { 
							$selected_1 = ''; 
						}
						//if($e->getEs_usuario()==1){ $es_usuario = 'hidden'; } else { $es_usuario = ''; }
					?>
					<option value="<?php echo $e->getIdEmpleado(); ?>" <?php echo $selected_1.' '.$es_usuario; ?>><?php echo EmpleadosModel::getOnlyName($e->getIdEmpleado());?></option>
				<?php } ?>.
			  </select>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-4">
			  <label for="inputEmail4">Credito Infonavit</label>
			  <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			  	<!--
			  	<input type="number" step="0.01" min="1" class="form-control vf_no_spl_char" id="inputEmail4" placeholder="Credito Infonavit" value="<?php echo $empleadoInfonavit->getMontoCreditoInfonavit(); ?>" name="CreditoInfonavit" <?php echo $disabled; ?> required>
                -->

			  	<input type="text" class="form-control numeric" id="inputEmail4" placeholder="Credito Infonavit" value="<?php echo $empleadoInfonavit->getMontoCreditoInfonavit(); ?>" name="CreditoInfonavit" <?php echo $disabled; ?> required>

			  </div>
			</div>
			<div class="form-group col-md-4">
			  <!-- <label for="inputPassword4">Tel&eacute;fono</label> -->
			  <label for="inputPassword4">Monto Sugerido</label>
			   <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			    <!--
			    <input type="number" step="0.01" min="1" class="form-control vf_only_phone_num" id="inputPassword4" placeholder="Monto Sugerido" value="<?php echo $empleadoInfonavit->getMontoRetener(); ?>" name="MontoSugerido" <?php echo $disabled; ?> required>
                 -->

                 <input type="text" class="form-control numeric" id="inputPassword4" placeholder="Monto Sugerido" value="<?php echo $empleadoInfonavit->getMontoRetener(); ?>" name="MontoSugerido" <?php echo $disabled; ?> required>

			  </div>
			</div>
			<div class="form-group col-md-4">
			  <label for="inputPassword4">Monto Restante</label>
			  <div class="input-group-prepend">
			    <span class="input-group-text">$</span>
			  	<input type="text" class="form-control" id="inputPassword4" placeholder="Monto Restante" value="<?php if($empleadoInfonavit->getIdEmpleadoInfonavit()==''){ echo '0'; }else{ echo $empleadoInfonavit->getMontoRestanteRetener();} ?>" name="Restante" readonly>
			  </div>
			</div>
		</div>
		  <div class="form-row">
			<div class="form-group col-md-12">
			  <label for="inputPassword4">Comentarios</label>
			  <textarea type="textarea" class="form-control" id="inputPassword4" placeholder="Comentarios" name="Comentarios" <?php echo $disabled; ?>><?php echo $empleadoInfonavit->getComentario(); ?></textarea>
		  </div>
				<!--campos necesarios, pero invisibles-->
			  	<input type="text" class="form-control" value="<?php echo $id; ?>" name="IdEmpleadoInfonavit" hidden>
			  	<input type="text" class="form-control" value="<?php echo $empleadoInfonavit->getMontoRestanteRetener();?>" name="MontoRestante" hidden>
			  	<input type="text" class="form-control" value="<?php echo $_SESSION['id_employe'];?>" name="EmpleadoCaptura" hidden>
			