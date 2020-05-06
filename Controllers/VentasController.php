<?php 

/* [2019/11/14] Antes TestFrameController */

class VentasController {

	/* Parte 1. Lo que puede ver el usuario en la parte principal del modulo */

	# View: Principal con el plugin DataTable
	function index(){


    
	 

		//$_SESSION["id"] = $clave;
		//$clave = $_SESSION["id"];
		//echo '<script> alert("Que: '.$clave.'");</script>';
		//$_SESSION["id"] = $Clave;
		$for =''; $archivo ='';
		if (isset ($_GET['for']) && isset ($_GET['is_archived'])){
			$for = $_GET['for'];$archivo = $_GET['is_archived'];
			
			require_once('Views/ventas/index.php');
			#require_once('Views/ventas/ventas.php?for='.$for.'&is_archived='.$archivo);
		}
	}

	# Response: respuesta de tipo JSON para DataTable
	function all_json(){
        
      
      //echo '<script> alert("Que: '.$_GET['id'].'");</script>';
		$output = '';
		if(isset($_GET["for"]) && $_GET["for"]=='rentas' && isset($_GET["is_archived"])){
			$output = VentasModel::all_json_rentas();
			echo $output;
		} else if(isset($_GET["for"]) && $_GET["for"]=='servicios') {
			$output = VentasModel::all_json_servicios();
			echo $output;
		}
	}

	# View: Estadisticas de ganancias en pie de DataTable
	function sumatorias_subtotal(){
		#$for; $is_archived = 'false';

		if(isset($_GET["for"])){ $for = $_GET["for"]; } else { $for = ""; }	//la tabla del carrito al cual hara la sumatoria, es importante que en la URL siempre este lleno este segundo parametro
		if(isset($_GET["is_archived"])){ $is_archived = $_GET["is_archived"]; } else { $is_archived = "true"; }

		//Me va a retornar cuanto dinero hay en la caja chica de X sucursal dependiendo el ID que mande la URL
		if(isset($_GET["IdSucursal"])){
			if($_GET["IdSucursal"]>0 ){
				$id=$_GET['IdSucursal'];
                
                //variable de session de la secursal seleccionada del combo sucursal para el admin general.
                //al parecer tiene alcance en ventas al generar cot de rentas y o servicios

				$_SESSION["idsucursal"] =  $id;

				$total=VentasModel::getSumatoriaSubTotalOrdenEn_SucursalActual($id, $for, $is_archived);
				echo $total;
			} else {
				if($is_archived == "true"){
					$total=VentasModel::getSumatoriaSubTotalOrdenEn_TodaSucursal($for, "true");
				} 
				if($is_archived == "false"){
					$total=VentasModel::getSumatoriaSubTotalOrdenEn_TodaSucursal($for, "false");
				}
				echo $total;
			}
			if(empty($total)){
				echo '0.00';
			}
		}
	}
/* Correos */
/*
SE CREO UNA FUNCION PARA OBTENER LOS DATOS DEL CORREO
*/
	function correos(){
		//VERIFICAR SI EL FOR[RENTAS/SERVICIOS] TIENE UN VALOR
		if(isset($_GET["for"])){ 
			$for = $_GET["for"]; 
	    } else { 
			$for = ""; 
		}	
		//VERIFICAR SI EL ARCHIVES[TRUE/FALSE] TIENE UN VALOR
		if(isset($_GET["is_archived"])){ 
			$is_archived = $_GET["is_archived"]; 
		} else { 
			$is_archived = "true"; 
		}
		//VERIFICAR LA CLAVE UNICA DE [RENTAS/SERVICIOS] TIENE UN VALOR POR MEDIO DE UNA VARIABLE DE SESSION
		if(isset($_SESSION["idclaveUnica"])){
		//if(isset($_GET["clave_unica"])){
			$id=$_GET["clave_unica"];
            $_SESSION["idclaveUnica"] =  $id;
			$email_info = VentasModel::getEmailsByUk($_GET["clave_unica"],$_GET["for"]);
			//echo '<script> location.reload(); </script>';	
			//$email_info = DataBase::speed_crud(' SELECT c.CorreoElectronico FROM clientes as c, orden_rentas as q WHERE clave_unica='.$id.' AND c.IdCliente=q.IdCliente');
			echo $email_info[1];
		}


	}


	/* Parte 2. Gestion de cotizaciones */

	# View: Nueva cotizacion
	function new_quotation(){
		$for ='';
		if (isset ($_GET['for'])){
			$for = $_GET['for'];
			$invoice_array = VentasModel::load_info_for_edit_order(null,$for);	//$invoice_array solo debe recibir por parametro la 'clave_unica' cuando se este editando una orden / cotizacion, pero debe tener un parametro por default, en este caso debe ser NULL
			#echo'<script>alert("algo");</script>';
			require_once('Views/ventas/step-wizard.php'); #&for='.$for);

			

		}
	}

	# View: Editar cotizacion
	function edit_quotation(){	//Exactamente lo mismo que nueva_orden
		$for ='';
		if (isset($_GET['for'])){
			if(isset($_GET["clave_unica"])){
				//Devolvemos la informacion de la BD
				$invoice_array = VentasModel::load_info_for_edit_order($_GET["clave_unica"], $_GET["for"]);
			}
			//E incluimos la vista
			$for = $_GET['for'];
			#echo'<script>alert("algo");</script>';
			require_once('Views/ventas/step-wizard.php'); #&for='.$for);
		}
	}
	//////////////////////////////////////
 #by
	#prueba de generar orden de envio
	function generar_orden_envio(){	//Exactamente lo mismo que nueva_orden
		$for ='';
		//if(isset($_GET["IdSucursal"])){
			if (isset($_GET['for'])){
				if(isset($_GET["clave_unica"])){
					//Devolvemos la informacion de la BD
					$invoice_array = VentasModel::load_info_for_generate_orden($_GET["clave_unica"], $_GET["for"], $_GET["IdSucursal"]);
				}
				//E incluimos la vista
				$for = $_GET['for'];
				#echo'<script>alert("algo");</script>';
				require_once('Views/ventas/modal-generate-order.php'); #&for='.$for);
			}
		//}
	}

	////////////////////////////////
	
	# Action: Guardar los datos de la cotizacion en la BD
	function save_quotation(){
		$orden = new VentasModel(
				null,												#01
				$_POST['clave_unica'],								#02
				0, //$_POST['Folio_cotizacion'],					#03	//generada automaticamente
				null, //$_POST['Folio_orden'],						#04	//se genera automaticamente al aprovarse como orden
				null, //$_POST['Folio_factura'],					#05	//es opcional
				1, //$_POST['id_situacion_ubicacion'],				#06	//Por Def: Rentas > 1 (aun no se envia) || Servicios > 4
				1, //$_POST['id_situacion_monetaria'],				#07
				$_POST['IdCliente'],								#08
				$_POST['IdCiudad'],									#09
				$_POST['CodigoPostalEntrega'],						#10
				$_POST['ColoniaEntrega'],							#11
				$_POST['CalleEntrega'],								#12
				$_POST['NombrePersonaEntrega'],						#13
				$_POST['TelefonoPersonaEntrega'],					#14
				$_POST['CorreoPersonaEntrega'],						#15
				0,													#16 La factura se define despues
				0,													#17 El correo se envia despues
				0, 													#18 La orden se aprueba despues
				0, 													#19 Depende de la columna anterior, si no es orden, no puede finalizar
				date("d-m-Y"),										#20	Fecha del servidor
				date("H:i:s"),										#21	Hora del servidor
				$_POST['FechaInicio'],								#22
				$_POST['FechaTermino'],								#23
				$_POST['FechaEntrega'],								#24
				$_POST['HoraEntrega'],								#25
				null,												#26 Fecha del servidor al generar una orden
				null,												#27 Fecha del servidor al generar una orden
				null,												#28 Fecha del servidor al finalizar una orden
				null,												#29 Hora del servidor al finalizar una orden
				$_SESSION["id_sucursal"],							#30
				$_SESSION["id_employe"],							#31 Empleado que registra la cotizacion
				0,													#32 Empleado que genera la orden (se genera despues)
				0													#33 Empleado que finaliza la orden (se genera despues)
		);
		if(isset($_GET["for"])){
			VentasModel::save_quotation($orden,$_GET["for"]);	//El segundo parametro decide en que tabla de orden_... guardar, sin en rentas o si en servicios
		}
		#$this->show();
	}

	# Action: Actualiza los datos de una cotizacion registrada previamente en la BD
	function update_quotation(){		
		#self::clean_cart($_POST['clave_unica']);	//Limpiamos lo que hay de la base de datos para que se guarden los cambios de los nuevos items en el carrito pertenecientes a su "clave_unica"
		$orden = new VentasModel(
				null,												#01
				$_POST['clave_unica'],								#02
				null, 												#03	//YA NO CAMBIA
				null, 												#04	//se genera automaticamente al aprovarse como orden
				null, 												#05	//es opcional
				null, 												#06	//Por Def: Rentas > 1 (aun no se envia) || Servicios > 4
				null, 												#07
				$_POST['IdCliente'],								#08
				$_POST['IdCiudad'],									#09
				$_POST['CodigoPostalEntrega'],						#10
				$_POST['ColoniaEntrega'],							#11
				$_POST['CalleEntrega'],								#12
				$_POST['NombrePersonaEntrega'],						#13
				$_POST['TelefonoPersonaEntrega'],					#14
				$_POST['CorreoPersonaEntrega'],						#15
				0,													#16 La factura se define despues
				0,													#17 El correo se envia despues
				0, 													#18 La orden se aprueba despues
				0, 													#19 Depende de la columna anterior, si no es orden, no puede finalizar
				null,												#20 Fecha de captura YA NO CAMBIA
				null,												#21	Hora de captura YA NO CAMBIA
				$_POST['FechaInicio'],								#22
				$_POST['FechaTermino'],								#23
				$_POST['FechaEntrega'],								#24
				$_POST['HoraEntrega'],								#25
				null,												#26	Fecha del servidor al generar una orden
				null,												#27	Fecha del servidor al generar una orden
				null,												#28 Fecha del servidor al finalizar una orden
				null,												#29 Hora del servidor al finalizar una orden
				null,												#30 La SUCURSAL Ya no cambia
				$_SESSION["id_employe"],							#31 Empleado que actualiza la cotizacion
				0,													#32 Empleado que genera la orden (se genera despues)
				0													#33 Empleado que finaliza la orden (se genera despues)

		);
		if(isset($_GET["for"])){
			VentasModel::update_quotation($orden,$_GET["for"]);
			#$this->show();
		}
	}

	# Action: Elimina la cotizacion de la BD
	function delete_quotation(){
		if(isset($_GET["id"]) && isset($_GET["for"])){
			$id=$_GET['id'];	//Recive clave_unica como si fuera ID
			VentasModel::delete_quotation($id,$_GET["for"]);
		}
	}

	# View: Documento en formato PDF (tanto para cotizaciones como ordenes)
	function updateshow(){	//No es para editar dentro de un modal, editar, eliminar te llevara a la misma vista que "nueva_orden"
		

		if(isset($_GET["for"])){			
			if(isset($_GET["id"])){	//ID representa la col clave_unica

           //echo '<script> alert("updateshow: '.$_GET['id'].'");</script>';
           $_SESSION["idclaveUnica"] = $_GET['id'];
           //echo '<script> alert("idclaveUnica: '.$_SESSION["idclaveUnica"].'");</script>';

//se creo esta variable de session para cargar los correos de cliente y aquien se le van a entregar(contacto) los materiales d ela //renta y o realizar el servicio. 
	    //se va a usar vistas/ventas/index.php  
	    //$_SESSION["idclaveUnica"]
		//$_SESSION["idclaveUnica"] = $_GET['id'];

				//cotizaciones y/u ordenes
				echo '<iframe src="themes/lte/assets/plugins/PDF/invoicr/example/index.php?uk='.$_GET["id"].'&for='.$_GET["for"].'" frameborder="0" style="border:0" width="100%" height="350" allowfullscreen></iframe>';
			} else if(isset($_GET["clave_unica"])){
				//envios y recuperaciones
				echo '<iframe src="themes/lte/assets/plugins/PDF/invoicr/example/envioPDF.php?uk='.$_GET["clave_unica"].'&for='.$_GET["for"].'&info='.$_GET["info"].'" frameborder="0" style="border:0" width="100%" height="350" allowfullscreen></iframe>';
			}
		}
	}

	# View->Action: Accion que indica a AJAX que se ha enviado un correo, en realidad, comienzan los preparativos para el envio
	function mail_button(){
		require_once('Views/ventas/buttons/mail/button.php');
	}
///--------------------------------------------------------
	# Action: Adjunta el documento PDF generado para la cotizacion y la manda al cliente por correo
	function mail_sent(){
              
              //echo '<script> alert("$email_cliente"); </script>';

		if(isset($_GET["for_operation"]) && isset($_GET["clave_unica"])) ///corregir la sentencia de manera correcta
		{			                         
           	if (isset($_GET["email_cliente"]) || isset($_GET["email_contacto"]) || isset($_GET["email_otro"]))
           	{
           		//Continua el proceso para enviar correo
				if(isset($_GET["email_cliente"])){
					$email_cliente = $_GET["email_cliente"];					
				} else{
					$email_cliente=NULL;					
				}

				if(isset($_GET["email_contacto"])  && strlen(trim($_GET["email_contacto"])) > 0)
				{
					$email_contacto = $_GET["email_contacto"];					
				} else 
				{
					$email_contacto= NULL;					
				}


				if(isset($_GET["email_otro"]))
				{
					$email_otro = $_GET["email_otro"];					
				} else
				{
					$email_otro= NULL;					
				}

              //echo '<script>alert("print_order_envio");</script>';
			 //$email_cliente=$_GET["email_cliente"];
			 //$email_contacto=$_GET["email_contacto"];
			//if(isset($_GET["email_otro"])){
				//$email_otro = $_GET["email_otro"];
			//	echo '<script> alert("Que: ");</script>';
			//} else{
				//$email_otro = 'null';
			//	echo '<script> alert("Que: null ");</script>';
			//}

			#0. El Documento ya fue creado con el boton via AJAX,
			#1. Solicitar un nuevo correo a "lista de correos pendientes por enviar". Un CallBack se encargara despues de enviarlo
				$curY = date("Y");
				$curM = date("m");
				$curDT = date("Y-m-d H:i:s");
				$attachment_path = 'storage/docs/'.$curY.'/'.$curM.'/'.$_GET["for_operation"].'-'.$_GET["clave_unica"].'.pdf';	// un punto . cuando se ejecuta via AJAX y 2 puntos cuando es por el controlador, sino no lo encuentra
				////mandar llamar funcion getEmailByUK para usuario y correo
				$email_info = VentasModel::getEmailsByUk($_GET["clave_unica"],$_GET["for_operation"]);	//Segun la clave_unica, obtener el correo y nombre destinatario 

				////separar los datos de usuario y correo a respectivas variables 
				$to_fullname_client = $email_info[0]; ///usuario del cliente
				$to_email_client =    $email_cliente; //$email_info[1];   //correo del cliente
				$to_fullname_receive = $email_info[2];  ///usuario del remitente
				$to_email_receive = $email_contacto;// $email_info[3];  ///correo del remitente
				$to_email_other = $email_otro; 

				$folio = VentasModel::getFolioByClaveUnica($_GET["clave_unica"],$_GET["for_operation"]); ///toma la clave del folio
				
				///el subject pero de acuerdo al $for_operation [rentas/servicios]
				$subject = 'Sanitam - Cotizacion - '.ucfirst($_GET["for_operation"]).' - Folio: '.$folio;
				///el mensaje de la copia de cotizacion de acuerdo al //$for_operation [rentas/servicios]
				$msg = 'Se adjunta una copia de cotizacion de '.$_GET["for_operation"].' con folio: '.$folio;

				//////insertar a la tabla _pending_mail_queue
				DataBase::speed_crud(" INSERT INTO _pending_mail_queue (
					for_operation,
					uk,
					folio,
					from_email,
					from_fullname,
					to_email,
					to_fullname,
					fullname_receive,
					email_receive,
					email_other,
					subject,
					msg,
					attachment_path,
					date_requested,
					sent,
					error
				) VALUES (
					'".$_GET["for_operation"]."',
					'".$_GET["clave_unica"]."',
					'".$folio."',
					'outbox@gmail.com', 
					'Sanitam',
					'".$to_email_client."',
					'".$to_fullname_client."',
					'".$to_fullname_receive."',
					'".$to_email_receive."',
					'".$to_email_other."',
					'".$subject."',
					'".$msg."',
					'".$attachment_path."',
					'".$curDT."',
					'0',
					'0'
				) ");
				
				//if(/*$to_email_receive!=='' || !is_null($to_email_receive) || */ isset($to_email_receive)){
					#1.1. Si la persona que recive no especifico un correo, no se le envia una copia de la cotizacion, y Solamente el Cliente recive una copia por correo.
				/*DataBase::speed_crud(" INSERT INTO _pending_mail_queue (
					for_operation,
					uk,
					folio,
					from_email,
					from_fullname,
					to_email,
					to_fullname,
					subject,
					msg,
					attachment_path,
					date_requested,
					sent,
					error
				) VALUES (
					'".$_GET["for_operation"]."',
					'".$_GET["clave_unica"]."',
					'".$folio."',
					'outbox@gmail.com',
					'Sanitam',
					'".$to_email_receive."',
					'".$to_fullname_receive."',					
					'".$subject."',
					'".$msg."',
					'".$attachment_path."',
					'".$curDT."',
					'0',
					'0'
				) ");
				///////////////////////////////
				////////////////////
				}*/
				PHPMailerModel::callback();
				#2. Indicar a la base de datos que se envio (aunque tardara unos minutos mas)
				require_once('Views/ventas/buttons/mail/sent.php');

			}
			else
			{
				//mostrar mensaje de que se requiere almenos un correo	
				//no es necesario mensaje por que el correo del cliente es obligatorio 
			} 
	  	}
	}

	/* Parte 3. Gestion de ordenes */
	
	# View: Formularios dentro de un Modal: Generar y editar orden
	function manage_order(){
		if(isset($_GET["id"]) && isset($_GET["for"]) && isset($_GET["is_archived"])){
			$id=$_GET["id"];		//Recive clave_unica como si fuera ID
			#by Paulina 
			#documentado por modo de prueba
			$invoice_array = VentasModel::load_info_for_invoice_array($id,$_GET["for"]);
			
			if($_GET["is_archived"]=="false"){
				require_once('Views/ventas/modal-generate-order.php');	//Generar orden
			} else if($_GET["is_archived"]=="true"){
				require_once('Views/ventas/modal-edit-order.php');	//Editar una orden generada previamente
			}
		}
	}
	
	# Action: Convierte una cotizacion en orden
	function generate_order(){
		if(isset($_POST["clave_unica"]) && isset($_POST["for"])){
			VentasModel::generate_order($_POST["clave_unica"], $_POST["for"]);
		}
	}

	# Action: Actualiza la informacion de una orden
	function update_order(){
		//echo $invoice_array[15]='3';
		
		if (isset($_POST['for'])){

			$id_situacion_ubicacion= 0;
           if($invoice_array[15]==3 || $invoice_array[15]==5)
           	{ 
           		$id_situacion_ubicacion=$invoice_array[15];
           	}
           	else
           { 
           		$id_situacion_ubicacion=$_POST["id_situacion_ubicacion"];
           	}

           

			if(isset($_POST["clave_unica"]) || isset($_POST["Folio_factura"]) || isset($_POST["id_situacion_ubicacion"]) || isset($_POST["id_situacion_monetaria"])){
				if(isset($_POST["RequiereFactura"])){ $requiere_factura = 1; } else { $requiere_factura = 0; } 
				if(isset($_POST["finalizado"])){ $finalizado = 1; } else { $finalizado = 0; }
				
		
				VentasModel::update_order($_POST["clave_unica"], $_POST["for"], $_POST["Folio_factura"], $_POST["id_situacion_ubicacion"], $_POST["id_situacion_monetaria"], $requiere_factura, $finalizado);

				if(isset($_POST["id"]) && isset($_POST["recuperar_cantidad_SucOrigen"]) 
				&& isset($_POST["cantRec"]) || isset($_POST["Comentario"])){
			
					/////// PARAMETROS: idInventarioUnidadRenta,idSucursal,cantidadRecuperada,ComentarioRecu,ClaveUnica,[servicio/rentas]
					VentasModel::update_cart_recuperado($_POST["id"],$_POST["recuperar_cantidad_SucOrigen"],
						$_POST["cantRec"],
						$_POST["Comentario"],
						$_GET["clave_unica"],
						$_GET["for"]
					);
				}
			}
		
			
		}
	}

	/* Parte 4. Gestion de el/los carritos de compras */
	/* A partir de aqui; Se hace referencia a los items relacionados a una cotizacion u orden */

	# Action: Guardar los items de una cotizacion u orden en el carrito
	function save_cart(){
		if(isset($_GET['for']) && isset($_POST["id"]) && isset($_POST["qty"]) && isset($_POST["price"]) && isset($_POST["clave_unica"])){
			VentasModel::save_cart($_POST["id"],$_POST["qty"],$_POST["price"],$_POST["clave_unica"], $_GET["for"]);	//For define a cual tabla de carrito enviar, si a rentas o a servicios
		}
	}

	# Action: Actualizar los items de una cotizacion u orden en el carrito
	function update_cart(){	//Vaciar el carrito (borramos todos los productos que pertenezcan a una clave_unica)
		//despues llama al metodo "save_cart" y guarda los nuevos cambios
		if(isset($_GET["clave_unica"]) && $_GET["for"])
		{
			VentasModel::update_cart($_POST["id"],$_POST["qty"],$_POST["price"],$_GET["clave_unica"],$_GET["for"]);
		}
	}
	

   


	#Creado por Paulina:
	# Action: Actualizar los items de una cotizacion u orden en el carrito
	//Es decir, actualizar la cantidad recuperada de cada item de una renta
	function update_cart_recuperado()
	{	//Vaciar el carrito (borramos todos los productos que pertenezcan a una clave_unica)
		//despues llama al metodo "save_cart" y guarda los nuevos cambios
		if(isset($_GET["clave_unica"]) && $_GET["for"])
		{
			/////// PARAMETROS: idInventarioUnidadRenta,idSucursal,cantidadRecuperada,ComentarioRecu,ClaveUnica,[servicio/rentas]
			VentasModel::update_cart_recuperado($_POST["id"],$_POST["recuperar_cantidad_SucOrigen"],
				$_POST["cantRec"],
				$_POST["Comentario"],
				$_GET["clave_unica"],
				$_GET["for"]
			);

			/*VentasModel::update_cart_recuperado($_POST["id"],1,
				1,
				"com",
				$_GET["clave_unica"],
				$_GET["for"]
			);*/
		}
	}

	# Action->Helper: Cuando se actualiza un carrito, se quedan los antiguos registros, esto devuelve todos los items al inventario para que al actualizar el carrito no queden los registros duplicados o la antigua cantidad por item
	function delete_items_on_update_cart(){
		if(isset($_POST["deleted_item"]) && isset($_GET["clave_unica"]) && isset($_GET["for"])){
			VentasModel::delete_items_on_update_cart($_POST["deleted_item"], $_GET["clave_unica"], $_GET["for"]);
		}
	}
	
	# View: Recuperar stock al inventario	//Este solo debe actualizar
	/** actualizar los choferes del envio en ordenes */
	function stock_recovery(){

		if(isset($_POST["actualizar_choferes"]) && $_POST["clave_unica"]){
			if(isset($_POST["string_items"])){
				VentasModel::update_choferes($_POST["string_items"], $_POST["clave_unica"]);
				header('Location: '.$_SERVER['REQUEST_URI']);	//Con esto al refrescar la pagina actual no se envia nuevamente la cabecera (header) $_POST (osea, que evita el duplicado de datos por si alguien presiona F5)
			} else if(empty($_POST["string_items"]) || $_POST["string_items"]==''){
				VentasModel::update_choferes(null, $_POST["clave_unica"]);
				header('Location: '.$_SERVER['REQUEST_URI']);	//Con esto al refrescar la pagina actual no se envia nuevamente la cabecera (header) $_POST (osea, que evita el duplicado de datos por si alguien presiona F5)
			}
		}
		///Modificado por paulina 
		/// en modo de prueba sobre su funcionalidad 
		if(isset($_POST["actualizar_stock"]) && $_POST["clave_unica"]){
			update_stock_invenry_on_recovery();
		}
		//require_once('Views/ventas/generar-recuperacion.php');
		require_once('Views/ventas/stock-recovery.php');
	}
	
	function print_order(){
		$invoice_array = VentasModel::load_info_for_invoice_array($_GET["clave_unica"],$_GET["for"]);
		require_once('Views/ventas/print-order.php');
		echo '<script>print();</script>';
	}
 /////funcion de orden de envio
	function envio(){
		$invoice_array = VentasModel::load_info_for_invoice_array($_GET["clave_unica"],$_GET["for"]);
		///trae el archivo de la vista de generar-envio
		require_once('Views/ventas/generar-envio.php');
		
		//require_once('Views/ventas/generar-orden.php');
	//	echo '<script>print();</script>';
		//echo '<script>alert("print_order_envio");</script>';
        #by
		////editado por paulina en modo de prueba
		//verifica si "actualizar_choferes" del boton que tiene el valor
	/*	if(isset($_POST["actualizar_choferes"]) && $_POST["clave_unica"]){
			if(isset($_POST["string_items"])){
				VentasModel::update_choferes($_POST["string_items"], $_POST["clave_unica"]);
				//header('Location: /');
				header('Location: '.$_SERVER['REQUEST_URI']);
				//Con esto al refrescar la pagina actual no se envia nuevamente la cabecera (header) $_POST (osea, que evita el duplicado de datos por si alguien presiona F5)
				
			} else if(empty($_POST["string_items"]) || $_POST["string_items"]==''){
				VentasModel::update_choferes(null, $_POST["clave_unica"]);
				header('Location: '.$_SERVER['REQUEST_URI']);	//Con esto al refrescar la pagina actual no se envia nuevamente la cabecera (header) $_POST (osea, que evita el duplicado de datos por si alguien presiona F5)
			}
		}
		///Modificado por paulina 
		/// en modo de prueba sobre su funcionalidad 
		if(isset($_POST["actualizar_stock"]) && $_POST["clave_unica"]){
			update_stock_invenry_on_recovery();
			
		}*/
		
		
	}
	
	function recoleccion(){
		$invoice_array = VentasModel::load_info_for_invoice_array($_GET["clave_unica"],$_GET["for"]);
		//require_once('Views/ventas/generar-orden.php');
		//echo '<script>alert("print_recuperacion");</script>';
				
		require_once('Views/ventas/generar-recuperacion.php');
		
	}



}