<?php
$id = '';
if(isset($_GET["id"])){
	$id = $_GET["id"];
}
$extraSucursal=ExtrasSucursalModel::searchById($id); #Esta linea normalmente va en el controlador pero como no es MVC, puede ir aqui

ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($extraSucursal as $key => $extraSucursal) {
			unset($extraSucursal->$key);
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





			<div>
				<label for="inputEmail4">Extra</label>
				<select name="IdExtra" disabled id="comboxNombre" class="form-control select2" onchange="ActualizarMontoSugerido();">
           <?php

					 //Creo los objetos de extrasmatriz que solo esten activos para poder cargarlos al combobox xd xd xd
					 $resultados = ExtrasMatrizModel::ExtrasNomb();
					 foreach ($resultados as $e) {


						?>
							<option   value="<?php echo $e->getIdExtra(); ?>"><?php echo $e->getNomExtra();?></option>


						<?php } //Cierre del foreach ?>
			</select>

		</div><!-- Div de combo box -->




	<!-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
					<div class="form-group col-md-4">
						<label >Monto Sugerido</label>
						<div class="input-group-prepend">
			            	<span class="input-group-text">$</span>
					    	<input  type="text" class="form-control vf_no_spl_char"  placeholder="MontoSugerido"  value="<?php echo $extraSucursal->getMontoSugerido(); ?>" name="MontoSugerido" <?php echo $disabled; ?> required>
						</div>
				</div>






<!--BASURA---INVISIBLE------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Los guardo por que necesito los campos al momento de eliminar/modificar o agregar
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
				<!-- style="display: none"  -->
			<div class="form-group col-md-4" style="display: none" >
				<label for="inputEmail4">Sucursal</label>
				<input  type="text" class="form-control vf_no_spl_char"     value="<?php echo $_SESSION['id_sucursal']; ?>"
				 name="idSucursal"  required>


			</div>
<!------------------------------------------------------------------------------------------------------------------------------------>
			<div class="form-group col-md-4" style="display: none" >
				<label for="inputEmail4">id en Sucursal</label>
				<input  id= "IdSucursal" type="text" class="form-control vf_no_spl_char"  value="<?php if ($extraSucursal->getidExtraSucursal()== null)
				{
					echo 0;
				}
				else {

						echo $extraSucursal->getidExtraSucursal();
				} ?>"  name="idExtraSucursal"  required>
			</div>
<!------------------------------------------------------------------------------------------------------------------------------------->
			<div class="form-group col-md-4"  style="display: none" >
				<label for="inputEmail4">Status</label>
				<input  type="text" class="form-control vf_no_spl_char" id="Status"  value="<?php echo $extraSucursal->getStatus(); ?>" name="Status"  required>
			</div>
<!-- ----------------------------------------------------------------------------------------------------->
			<div class="form-group col-md-4" style="display: none" >
				<label for="inputEmail4">ID Producto MATRIZ</label>
				<input type="text" class="form-control vf_no_spl_char"  id="IdExtraMatriz" value="<?php echo $extraSucursal->getIdExtra(); ?>" name="IdExtra" required>
			</div>

			<div class="form-group col-md-4" style=" display: none"   >
				<!--IDEXtraSucursal-style=-->
				<input type="text" class="form-control vf_no_spl_char"  id="IdExtraMatriz" value="<?php echo $extraSucursal->getidExtraSucursal(); ?>" name="IdExtraBn" required>
			</div>

		  </div>
<!---------------------------------------------------------------------------------------------------------------------------------------------->
<!--    SCRIPT PARA ACTUALIZAR INPUTS XD -->
			<script type="text/javascript">
			var idExtra = document.getElementById('IdExtraMatriz').value;

			if (idExtra != null)
			{


				 	console.log(idExtra);
					document.getElementById("comboxNombre").value = idExtra;


			}




			function ActualizarMontoSugerido()
			{
				var id = document.getElementById("comboxNombre").value;

				document.getElementById("IdExtraMatriz").setAttribute("value",id);
				document.getElementById("Status").setAttribute("value",0);


			}





			</script>
