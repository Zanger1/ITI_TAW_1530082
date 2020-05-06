<?php

function rand_key($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} ?>

<?php
ini_set('display_errors', 1);

//echo $_GET['IdSucursal'];

//echo "SESSION idsucursal __";
//echo $_SESSION["idsucursal"];

$for='';
if(isset ($_GET['for'])){
	$for = $_GET['for'];
	#echo $for;
}
$operacion= "";
$form_action = "";	//Indicamos al formulario del paso 2, la accion que va a tomar, segun sea: editar un registro existente o guardar nuevo
$clave_unica = null;
if(isset($_GET["action"]))
{
	if ($_GET["action"] == "edit_quotation") 
	{
    	$operacion = "Editar";
    }
	else if ($_GET["action"] == "new_quotation") 
	{
    	$operacion = "Agregar";
    }

	if($_GET["action"]=='new_quotation'){
		$form_action = 'save_quotation';
	} else if($_GET["action"]=='edit_quotation' ){
		if(isset($_GET["clave_unica"])){
			$form_action = 'update_quotation&clave_unica='.$_GET["clave_unica"];	//Adicionalemte
			$clave_unica = $_GET["clave_unica"];
		}
		#by
	////editado por Paulina 
	////Modo de prueba 
	}/*else if($_GET["action"]=='generar_orden_envio'){
		if(isset($_GET["clave_unica"])){
			$form_action = 'edit_quotation';
		}
	}*/
}

//Parametro de la URL "edit" para habilitar o deshabilitar los campos del formulario: "true,false"
$disabled = ""; $editable="";
if(isset($_GET["edit"])){
	$editable = $_GET["edit"];
	if($editable=="true"){
		$disabled = "";	
	} else if($editable=="false"){
		$disabled = "disabled";	
	}
}

$allow_edit_quotation = 0;	//En este bloque no permitiremos que edite una vez que se convierta en orden
if(isset($_GET["clave_unica"])){
	#$db=DataBase::getConnect();

	$is_order = VentasModel::check_if_is_order($clave_unica);
	if($is_order == 1){
		$allow_edit_quotation = 1; // 'Esta cotizacion no existe, ahora es orden';
	} else {
		$allow_edit_quotation = 0; //echo 'ok'; }
	#PD una vez que se convierte en orden no podra convertirse en cotizacion, el stock no regresaria por si solo al inventario
	}
}

if($allow_edit_quotation == 0){ 
?>

<!--modal-->
<div class="modal fade modal-agregar-unidades" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		<div class="modal-header">
			<!--<h5 class="modal-title">Buscar</h5>-->
		<?php if ($for=="servicios") {?>	
			<h5 class="modal-title">Agregar servicio(s)</h5>
		<?php  } else if ($for=="rentas") {?>	
			<h5 class="modal-title">Agregar unidad(es)</h5>
	     <?php }?>	
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
		<blockquote>
			<!--Busca uno o m&aacute; articulos para agregar a la lista y preciona el boton "aceptar"-->


		<?php if ($for=="servicios") {?>	
						Seleccionar un servicio o m&aacute;s  para agregar a la cotizaci&oacute;n y presionar el bot&oacute;n "Continuar".

		<?php  } else if ($for=="rentas") {?>	
					Seleccionar una o m&aacute;s unidad(es) para agregar a la cotizaci&oacute;n y presionar el bot&oacute;n "Continuar".
	     <?php }?>	



		</blockquote>
		<form id="inventory">
			<select class="select2" multiple="multiple" name="string_items[]" id="string_items" data-placeholder="Selecciona un o mas articulos de la lista">
				<?php
				function get_inventory_rentas(){
					$db=DataBase::getConnect();
					$listaEmpleados=[];
					$ouput = array();
					
					//Para rentas
					if ($_SESSION["idsucursal"]>0)
					{
					//si el administrador general selecciona una sucursal del combobox
					//entonces la orden pertenece a dicha sucursal y no a la que pertenece el administrador general
						$select=$db->prepare('SELECT * FROM inventario_unidades_renta as inventario, unidades_renta as unidades, c_tipo_unidades as tipos WHERE inventario.IdSucursal="'.$_SESSION["idsucursal"].'" AND inventario.IdUnidadRenta = unidades.IdUnidadRenta AND inventario.IdTipoUnidades = tipos.IdTipoUnidades AND inventario.eliminado=0 ');

					}
					else
					{
			    		//De lo eontrario se guarda la session del administrador general
						$select=$db->prepare('SELECT * FROM inventario_unidades_renta as inventario, unidades_renta as unidades, c_tipo_unidades as tipos WHERE inventario.IdSucursal="'.$_SESSION["id_sucursal"].'" AND inventario.IdUnidadRenta = unidades.IdUnidadRenta AND inventario.IdTipoUnidades = tipos.IdTipoUnidades AND inventario.eliminado=0 ');	
					}
			

					//Para rentas
                    /*
					$select=$db->prepare('SELECT * FROM inventario_unidades_renta as inventario, unidades_renta as unidades, c_tipo_unidades as tipos WHERE inventario.IdSucursal="'.$_SESSION["id_sucursal"].'" AND inventario.IdUnidadRenta = unidades.IdUnidadRenta AND inventario.IdTipoUnidades = tipos.IdTipoUnidades AND inventario.eliminado=0 ');
					*/
					$select->execute();
					foreach($select->fetchAll() as $item){
						#value="'.$item['IdInventarioUnidadesRenta'].'"
						
						$total_no_disponible = VentasModel::NoRecuperado($item["IdInventarioUnidadesRenta"]);
						$total_si_disponible = $item["cantidad"]; # - $total_no_disponible;
						
						if($total_si_disponible>0){	//Debe haber en "stock" (cantidad disponible) al menos 1 para poder aparecer en esta lista
							echo '<option value="'.$item['IdInventarioUnidadesRenta'].'" data-price="'.$item['Precio'].'" data-max-stock="'.$total_si_disponible.'">'.$item['DesUnidad'].' - '.$item['Descripcion'].' - '.$item['Incluye'].'</option>';
						}
					}
				}

				#Se agrego la columna eliminado en la tabla del inventario de rentas pero como el de servicios no tiene CRUD como el de ventas, ese ni siquiera se puede 
				
				function get_inventory_servicios(){
					$db=DataBase::getConnect();
					$listaEmpleados=[];
					$ouput = array();
					

					//Para servicios
					if ($_SESSION["idsucursal"]>0)
					{
					//si el administrador general selecciona una sucursal del combobox
					//entonces la orden pertenece a dicha sucursal y no a la que pertenece el administrador general
						$select=$db->prepare('SELECT * FROM sucursal_servicio, c_servicios, tamano_servicios, sucursales WHERE c_servicios.IdServicio = sucursal_servicio.IdServicio AND sucursales.IdSucursal = sucursal_servicio.IdSucursal AND tamano_servicios.id=sucursal_servicio.IdTamano
					AND sucursal_servicio.IdSucursal = "'.$_SESSION["idsucursal"].'"
					');
					}
					else
					{
			    		//De lo eontrario se guarda la session del administrador general
											$select=$db->prepare('SELECT * FROM sucursal_servicio, c_servicios, tamano_servicios, sucursales WHERE c_servicios.IdServicio = sucursal_servicio.IdServicio AND sucursales.IdSucursal = sucursal_servicio.IdSucursal AND tamano_servicios.id=sucursal_servicio.IdTamano
					AND sucursal_servicio.IdSucursal = "'.$_SESSION["id_sucursal"].'"
					');	
					}

					//Para servicios
					/*
					$select=$db->prepare('SELECT * FROM sucursal_servicio, c_servicios, tamano_servicios, sucursales WHERE c_servicios.IdServicio = sucursal_servicio.IdServicio AND sucursales.IdSucursal = sucursal_servicio.IdSucursal AND tamano_servicios.id=sucursal_servicio.IdTamano
					AND sucursal_servicio.IdSucursal = "'.$_SESSION["id_sucursal"].'"
					');
*/
					$select->execute();
					foreach($select->fetchAll() as $item)
					{
						echo '<option value="'.$item['IdSucursalServicio'].'" data-price="'.$item['precio'].'" data-max-stock="99999999999999999">'.$item['NombreServicio'].' - '.$item['descripcion'].' - '.$item['incluye'].'</option>';
					}
				}
				
				if($for == 'rentas'){
					echo get_inventory_rentas();
				} else if($for == 'servicios'){
					echo get_inventory_servicios();
				}

				?>	
			</select></form><br>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" id="add-items-to-shopcart" >Continuar</button>
			<!--#by
				Dar funcionalidad el boton de cancelar para regresar al inicio de la plantilla 
				mostrando la tabla de inicio de las rentas.
			 -->
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		</div>
    </div>
  </div>
</div>
<!--/modal-->

<div class="card">
<!-- /.card-header -->
	<div class="card-header">
	  <small class="float-left">
	  	<h3 class="card-title">Cotizaci&oacute;n de <?php echo $for; ?> > <span style="color: #007bff;"> <?php echo $operacion; ?></span></h3>
	  </small>
	</div>
	<div class="card-body">
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-body no-padding">
							<!-- SmartWizard html -->
							<div id="smartwizard">
								<ul>
									<li><a href="#step-1">Paso 1<br /><small>Datos del cliente</small></a></li>
									<li><a href="#step-2">Paso 2<br /><small>Datos del contacto</small></a></li>
									<li><a href="#step-3">Paso 3<br /><small>Unidades</small></a></li>
									<!--<li><a href="#step-4">Paso 4<br /><small>Vista previa</small></a></li>-->
								</ul>
								<div>
									<div id="step-1" class="">
					<!--	<form method="post" action="index.php?view=Ventas&action=save">	-->
										<h2>Datos del cliente</h2>
										<!--
										<p>BUG: Resulta que como este campo es requerido, solo por eso no actua cualquier boton como si hubiera finalizado, supong que que rellenas este combo box y entonces cualquier boton que presiones es como si ya finalizaras la coitizacion, aunque no sea asi</p>
										-->																			 
										 <select  class="select2" id="IdCliente" required>
											<!--<option value="">Seleccionar</option>-->
											<option value="" disabled selected>Seleccionar</option>
											<?php
												$ListaClientes = ClientesModel::all();
												$selected_2 = '';
												foreach($ListaClientes as $c){
													if($invoice_array->getIdCliente() == $c->getIdCliente()){ $selected_c = 'selected'; } else { $selected_c = ''; }
											?>
											<option value="<?php echo $c->getIdCliente(); ?>" id="<?php echo $c->getIdCliente(); ?>" <?php echo $selected_c; ?>><?php echo $c->getNombre(); ?></option>
											<?php } ?>
										</select>
										
										<div class="col-md-3">
											<div id="ajax-content-clientInformation"></div>
										</div>
										
									</div>
									<div id="step-2" class="">
										<h2>Datos del contacto</h2>
										<form method="post" action="index.php?view=Ventas&action=<?php echo $form_action; ?>&for=<?php echo $for; ?>" class="allforms" autocomplete="off">
											<div class="form-row">
												<div class="form-group col-md-4">
													<label for="inputEmail4">Nombre completo</label>
													<input type="text" class="form-control vf_no_spl_char" placeholder="Nombre completo" name="NombrePersonaEntrega" value="<?php echo $invoice_array->getNombrePersonaEntrega(); ?>" required>
													<input id="copyIdCliente" name="IdCliente" value="<?php echo $invoice_array->getIdCliente(); ?>" placeholder="IdCliente seleccionado en paso 1" hidden><!-- IdCliente que selecciono el user en el paso #1 -->
													<input id="unique_key_order" value="<?php if(empty($_GET["clave_unica"])) { echo rand_key(); } else { echo $_GET["clave_unica"]; } ?>" name="clave_unica" placeholder="Clave unica de orden" hidden>
													<input id="for_operation" value="<?php if(isset($_GET["for"])){ echo $_GET["for"]; } ?>" placeholder="Para rentas o servicios" hidden>
													<?php
													$def_situacion_ubicacion = 0;
														if(isset($_GET["for"])){
															if($_GET["for"]=='rentas'){
																#$_POST['id_situacion_ubicacion']
																$def_situacion_ubicacion = 1;
															} else if($_GET["for"]=='servicios'){
																$def_situacion_ubicacion = 4;
															}
														}
													?>
													<input type="text" value="<?php echo $def_situacion_ubicacion; ?>" name="id_situacion_ubicacion" hidden>
												</div>
												<div class="form-group col-md-4">
													<label for="inputPassword4">E-mail</label>
													<input type="email" class="form-control" placeholder="E-mail" name="CorreoPersonaEntrega" value="<?php echo $invoice_array->getCorreoPersonaEntrega(); ?>" required>
												</div>
												<div class="form-group col-md-4">
													<label for="inputPassword4">Tel&eacute;fono</label>
													<input type="text" class="form-control vf_only_phone_num" placeholder="Tel&eacute;fono" name="TelefonoPersonaEntrega" value="<?php echo $invoice_array->getTelefonoPersonaEntrega(); ?>" required>
												</div>
											</div>
											<div class="form-row">
												<div class="form-group col-md-3">
												  <label for="inputState">Estado</label>
													<select id="select-estado_Add" class="form-control select2" name="IdEstado" <?php echo $disabled; ?> value="" required>
														<option value="">Seleccionar</option>
														<?php
														global $id_estado_actual;
														
														$ListaEstados = EstadosModel::all();
														$selected_1 = '';
														foreach($ListaEstados as $e){
														$id_estado_actual = CiudadesModel::getEstadoByCiudadRef($invoice_array->getIdCiudad());
															/* pasos para retornar info de la DB para ver, editar o eliminar */
															#paso 1. Consultar el ID de ciudad que aparece en la info del cliente ya registrado
															#paso 2. Buscar el ID de estado al que pertenece el Id de Ciduad
															//$id_estado_actual = CiudadesModel::getEstadoByCiudadRef($cliente->getIdCiudad());
															#paso 3. Ver si coincide el id de estado, de ser asi marcar como seleccionado
															if($id_estado_actual==$e->getIdEstado()){ $selected_1 = 'selected'; } else { $selected_1 = ''; };
														?>
														<option value="<?php echo $e->getIdEstado(); ?>" <?php echo $selected_1; ?>><?php echo string_encoder($e->getEstado()); ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="form-group col-md-3">
													<label for="inputCity">Ciudad</label>
													<?php if(isset($_GET["action"]) && $_GET["action"]=='new_quotation'){ ?>
													<div id="response-for-select-ciudad"></div>
													<?php } else if($_GET["action"]=="edit_quotation"){ ?>

														<select id="select-ciudad" class="form-control" name="IdCiudad" required>
															<option value="">Seleccionar</option>
															<?php
															$ListaCiudades = CiudadesModel::searchByIdEstado($id_estado_actual); //all();
															#$selected_2 = '';
															foreach($ListaCiudades as $c){
																if($invoice_array->getIdCiudad() == $c->getId_ciudad()){ $selected_2 = 'selected'; } else { $selected_2 = ''; }
															?>
															<option value="<?php echo $c->getId_ciudad(); ?>" <?php echo $selected_2; ?>><?php echo $c->getCiudad(); ?></option>
															<?php } ?>
														</select>

													<?php } ?>
												</div>
												<div class="form-group col-md-3">
													<label for="inputCity">Codigo Postal</label>
													<input type="text" class="form-control vf_no_spl_char" name="CodigoPostalEntrega" value="<?php echo $invoice_array->getCodigoPostalEntrega(); ?>" placeholder="Codigo postal" required>
												</div>
											  <div class="form-group col-md-3">
												<label for="inputAddress">Colonia</label>
												<input type="text" class="form-control vf_no_spl_char" name="ColoniaEntrega" value="<?php echo $invoice_array->getColoniaEntrega(); ?>" placeholder="Colonia" required>
											  </div>
											</div>
											<div class="form-row">
											  <div class="form-group col-md-4">
												<label for="inputAddress">Calle</label>
												<input type="text" class="form-control vf_no_spl_char" name="CalleEntrega" value="<?php echo $invoice_array->getCalleEntrega(); ?>" placeholder="Calle" required>
											  </div>
											  <div class="form-group col-md-2">
												<label for="inputAddress">Fecha inicial</label>												
												
												
	

 												<!-- Se remplaza por este -->
												<input type="date" class="form-control" id="inputPassword4" placeholder="Fecha del prestamo" value="<?php if($invoice_array->getFechaInicio()==''){ echo date("Y-m-d");}else{ echo $invoice_array->getFechaInicio();} ?>" name="FechaInicio" required>


											  </div>
											  <div class="form-group col-md-2">
												<label for="inputAddress">Fecha final</label>
												
 												
 												<!-- Se remplaza por este -->
												<input type="date" class="form-control" id="inputPassword4" placeholder="Fecha del prestamo" value="<?php if($invoice_array->getFechaTermino()==''){ echo date("Y-m-d");}else{ echo $invoice_array->getFechaTermino();} ?>" name="FechaTermino" required>
												
											  </div>
											  <div class="form-group col-md-2">
												<label for="inputAddress">Fecha de entrega</label>
																			

                                                <!-- Se remplaza por este -->
												<input type="date" class="form-control" id="inputPassword4" placeholder="Fecha del prestamo" value="<?php if($invoice_array->getFechaEntrega()==''){ echo date("Y-m-d");}else{ echo $invoice_array->getFechaEntrega();} ?>" name="FechaEntrega" required>



											  </div>
											  <div class="form-group col-md-2">
												<label for="inputAddress">Hora de entrega</label>
												<input type="time" class="form-control vf_no_spl_char" name="HoraEntrega" value="<?php echo $invoice_array->getHoraEntrega(); ?>" required>
											  </div>
											  <!-- <input type="submit" class="form-control" value="POST"> -->
											</div>
										</form>
<!--	</form> -->
									</div>
									<div id="step-3" class="">
										<button class="btn btn-primary" data-toggle="modal" data-target=".modal-agregar-unidades">+ Agregar</button>
										<h2>Unidad(es)</h2>
										<div class="panel panel-default">
											<div class="shopping-cart">
											  <div class="column-labels">
												<label class="product-image">&nbsp;&nbsp;&nbsp;&nbsp;</label>
												<label class="product-details">Producto</label>
												<label class="product-price">Precio unitario</label>
												<label class="product-quantity">Cantidad</label>
												<label class="product-removal">Remove</label>
												<label class="product-line-price">Total</label>
											  </div>

											<?php
											$subtotal = 0;
											if(isset($_GET["action"]) && isset($_GET["clave_unica"]) && $_GET["action"]=='edit_quotation' && $_GET["for"])
											{
												$ListaPorClave = VentasModel::getItemsByCart($_GET["clave_unica"], $_GET["for"]);
												foreach($ListaPorClave as $i)
													{ ?>

											  <div class="product">
											  	<!-- Comentar imagen -->
											  	
												<div class="product-image">
													<!--
												  <img src="themes/lte/assets/dist/img/no-photo.jpg">
												  -->
												  &nbsp;&nbsp;&nbsp;&nbsp;
												</div>
											
												<div class="product-details">
												  <div class="product-title"><?php echo $i[0].' - '.$i[1]; ?></div>
												</div>
												<?php $precio_unitario = trim($i[3],'$'); ?>
												<div class="product-price"><?php echo $precio_unitario; ?></div>
												<div class="product-quantity">
												<form method="post" class="allforms" action="./?view=Ventas&action=update_cart&with_modal=opened&clave_unica=<?php echo $_GET["clave_unica"]; ?>&for=<?php echo $_GET["for"]; ?>">
												  <input type="text" name="id" value="<?php echo $i[5]; ?>" placeholder="ID" hidden>
												  <input type="number" name="qty" value="<?php echo $i[2]; ?>" min="1" onkeydown="return false">
												  <input type="text" name="price" value="<?php echo $precio_unitario; ?>" placeholder="precio" hidden>
												  <input type="submit" name="send_item_btn" hidden>
												</form>
												</div>
												<div class="product-removal">
												  <button class="remove-product" data-deleted_item="<?php echo $i[5]; ?>">
													Remover
												  </button>
												</div>
												<div class="product-line-price"><?php $precio_por_cantidad = $precio_unitario * $i[2]; echo $precio_por_cantidad; ?></div>
											  </div>
												<?php  $subtotal += $precio_por_cantidad;  }
											} ?>
											  
											  
											
											<div id="total-items-on-cart">
											  
<!--											  <div class="product">
												<div class="product-image">
												  <img src="images/nike.jpg">
												</div>
												<div class="product-details">
												  <div class="product-title">WC Sencillo </div>
												  <p class="product-description"> Es un WC color amarillo, tipo sencillo</p>
												</div>
												<div class="product-price">12.99</div>
												<div class="product-quantity">
												  <input type="number" value="2" min="1">
												</div>
												<div class="product-removal">
												  <button class="remove-product">
													Remover
												  </button>
												</div>
												<div class="product-line-price">25.98</div>
											  </div>

											  <div class="product">
												<div class="product-image">
												  <img src="images/adidas.jpg">
												</div>
												<div class="product-details">
												  <div class="product-title">WC Sencillo</div>
												  <p class="product-description">Es un WC color amarillo, tipo sencillo</p>
												</div>
												<div class="product-price">45.99</div>
												<div class="product-quantity">
												  <input type="number" value="1" min="1">
												</div>
												<div class="product-removal">
												  <button class="remove-product">
													Remover
												  </button>
												</div>
												<div class="product-line-price">45.99</div>
											  </div> -->

<!--											  <div class="product">
												<div class="product-image">
												  <img src="images/adidas.jpg">
												</div>
												<div class="product-details">
												  <div class="product-title">WC Sencillo</div>
												  <p class="product-description">Es un WC color amarillo, tipo sencillo</p>
												</div>
												<div class="product-price">45.99</div>
												<div class="product-quantity">
												  <input type="number" value="1" min="1">
												</div>
												<div class="product-removal">
												  <button class="remove-product">
													Remover
												  </button>
												</div>
												<div class="product-line-price">45.99</div>
											  </div> -->
											  
											</div>


<!--
											  <div class="totals">
												<div class="totals-item">
												  <label>Subtotal</label>
												  <div class="totals-value" id="cart-subtotal">71.97</div>
												</div>
												<div class="totals-item">
												  <label>IVA (16%)</label>
												  <div class="totals-value" id="cart-tax">3.60</div>
												</div>
											<!--    <div class="totals-item">
												  <label>Shipping</label>
												  <div class="totals-value" id="cart-shipping">15.00</div>
												</div> -->
<!--												<div class="totals-item totals-item-total">
												  <label>Total</label>
												  <div class="totals-value" id="cart-total">90.57</div>
												</div>
											  </div>
											</div> -->

											
											  <div class="totals">
												<div class="totals-item">
												  <label>Subtotal</label>
												  <div class="totals-value" id="cart-subtotal"><?php echo $subtotal; ?></div>
												</div>
												<div class="totals-item">
												  <label>IVA (16%)</label>
												  <div class="totals-value" id="cart-tax"><?php $impuestos = $subtotal * 0.16; echo $impuestos; ?></div>
												</div>
												<div class="totals-item totals-item-total">
												  <label>Total</label>
												  <div class="totals-value" id="cart-total"><?php echo $subtotal + $impuestos; ?></div>
												</div>
											  </div>
											</div>

											
											<?php 
											if(isset($_GET["action"]) && $_GET["action"]=="edit_quotation")
												{ ?>
													<!-- La lista de items que seran borrados al actualizar datos de cotizacion (solo si se 	presiona el boton de remover) -->
													<div id="deleted_items"></div>
											<?php } ?>				
											
										</div>
									</div>
								<!--<div id="step-4" class="">
										<h2>Vista previa</h2>
										<div class="panel panel-default">
											<div class="panel-heading">&nbsp;</div>
											
											<p>BUG: Para esta vista previa, habra que renombrar los nombres de clases, porque los que tenga aqui, lo calcula con los totales en el paso 3</p>
													
													<div class="row">
														<div class="shopping-cart" style="margin-top: 0px; width: 100%;">
															<div class="column-labels">
																<label class="product-image">Imagen</label>
																<label class="product-details">Producto</label>
																<label class="product-price">Precio unitario</label>
																<label class="product-quantity">Cantidad</label>
																<label class="product-line-price">Total</label>
															</div>
															<div class="product">
																<div class="product-image">
																	<img src="themes/lte/assets/dist/img/no-photo.jpg">
																</div>
																<div class="product-details">
																	<div class="product-title">LIMPIEZA DE TUBERIA A ALTA PRESION</div>
																	<p class="product-description"> INCLUYE: 100 ML EQUIPO DE ALTA PRESION SONDEO.</p>
																</div>
																<div class="product-price">0</div>
																<div class="product-quantity"> 2</div>
																<div class="product-line-price">0</div>
															</div>
															<div class="product">
																<div class="product-image">
																	<img src="themes/lte/assets/dist/img/no-photo.jpg">
																</div>
																<div class="product-details">
																	<div class="product-title">LIMPIEZA DE TUBERIA A ALTA PRESION</div>
																	<p class="product-description"> INCLUYE: 100 ML EQUIPO DE ALTA PRESION SONDEO.</p>
																</div>
																<div class="product-price">0</div>
																<div class="product-quantity"> 2</div>
																<div class="product-line-price">0</div>
															</div>
															<!--<div class="totals">
																<div class="totals-item">
																	<label>Subtotal</label>
																	<div class="totals-value" id="cart-subtotal">71.97</div>
																</div>
																<div class="totals-item">
																	<label>IVA (16%)</label>
																	<div class="totals-value" id="cart-tax">3.60</div>
																</div>
																<div class="totals-item totals-item-total">
																	<label>Total</label>
																	<div class="totals-value" id="cart-total">90.57</div>
																</div>
															</div>-->
														<!--</div>
													</div>
										</div>
									</div> -->
								</div>
																	<!-- <button id="allsubmit" class="btn btn-info">Test - Finalizar todos FORMs</button> -->
							</div>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /. box -->
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	</div>
</div>

<?php 
} 
else if($allow_edit_quotation == 1) 
{ 
	echo '<div class="card">No permitido</div>'; 
} 
?>