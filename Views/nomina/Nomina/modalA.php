<?php

$id = '';
if(isset($_GET["id"])){
	$id = $_GET["id"]; 
}
$Nomina=NominaModel::searchById($id); #Esta linea normalmente va en el controlador pero como no es MVC, puede ir aqui

ini_set('display_errors', 1);
	//Si no se retorna el array de datos a partir de un ID via $_GET, entonces
	//Limpiamos el objeto, por lo tanto el atributo value="" queda vacio para agregar datos: "true"
	if(empty($_GET["id"])){
		foreach ($Nomina as $key => $Nomina) {
			unset($Nomina->$key);
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
	$readonlyComentarioSucursal = "";
	$readonlyComentarioMatriz = "";
	if(isset($_GET["edit"])){
		$editable = $_GET["edit"];
		if($editable=="true"){
			$disabled = "";	
			if ($_SESSION['id_role']==1) {
				$readonlyComentarioSucursal = "readonly";
			}else{
				$readonlyComentarioMatriz = "readonly";
			}
		} 
		if($editable=="false"){
			$disabled = "disabled";	
		}
	}
?>
<!------------------------------------->
		  <?php $fecha_actual = date("Y-m-d");
		       $fecha_i= $fecha_actual;
		       $numeroSemana= date("W");
 				 ?>

          <div class="row">
            <div class="col-lg-2 col-md-12">
              <!-- --> 
                    <div class="form-group">
                      <label for="cantidad">Num. Semana</label>
                      <input type="number" class="form-control" name="semana" min="1" max="52" id="semana" id="semana" value="<?php echo $numeroSemana; ?>">
                      <div class="invalid-feedback">
                        Cantidad invalida.
                      </div>
                    </div>
                  </div>
                    <!-- --> 
           <div class="col-lg-5 col-md-12">
              <div class="form-group">
                <label for="fecha_inicio">Fecha inicio</label>
                <input type="date" min="2019-12-09" class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="15-Mayo-2011" 
                value="<?php {echo 

				$fecha_i;}

 				 ?>"  required>


                <div class="invalid-feedback">
                  Ingrese correctamente una fecha.
                </div>
              </div>
            </div>
            
                    
           <div class="col-lg-5 col-md-12">
              <div class="form-group">
                <label for="fecha_termino">Fecha termino</label>
                <input type="date" class="form-control" name="fecha_termino" id="fecha_termino" placeholder="15-Mayo-2011" value="<?php 
				//$fecha_actual = date("Y-m-d");
 				{ 
 					echo date("Y-m-d", strtotime($fecha_i."+ 6 days"));
 				}
				
 				 ?>"  <?php echo $disabled; ?> required>
                <div class="invalid-feedback">
                  Ingrese correctamente una fecha.
                </div>
              </div>
            </div>
          </div>