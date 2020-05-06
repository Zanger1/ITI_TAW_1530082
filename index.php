<?php
/*
	//Pendiente para caja_chica
	# SELECT SUM(Monto) AS monto_total FROM caja_chica WHERE IdSucursal=1
	
	#Es hoy el ultimo dia del mes?
	http://www.thisprogrammingthing.com/2013/determine-if-today-is-the-last-day-of-the-month-in-php/
*/

	ob_start();
	ini_set('display_errors', 1);
	require_once('connection.php');
	require_once('themes/lte/layout.php');
	foreach(glob("Controllers/*.php") as $filename){
		require_once $filename;
	}
	foreach(glob("Models/*.php") as $filename){
		require_once $filename;
	}

	function router(){

		$views = array(
			//Asociamos las vistas que tiene cada accion (controlador)
			//La primer parte es el nombre de los Modelos
			'Layout'=>['index','error','403','404','500','sql','estados','ciudades'],
			'Dashboard'=>['index','error','bienvenido'],
			'Usuarios'=>['index','register','save','updateshow','update','delete','search','error','all_json','sign_in','sign_out','check_username'],
			'Clientes'=>['index','register','save','showSelect','updateshow','update','delete','search','error', 'profile','all_json','load_info_for_invoice'],
            'Empleados'=>['index','register','save','updateshow','update','delete','search','error','all_json'],
			'CajaChica'=>['index','register','save','updateshow','update','delete','search','error','all_json','total_caja'],
			'UnidadesRenta'=>['index','register','save','showSelect','updateshow','update','delete','search','error', 'profile','all_json','load_info_for_invoice'],
			'Servicios'=>['index','register','save','showSelect','updateshow','update','delete','search','error', 'profile','all_json','load_info_for_invoice'],
			'Sucursales'=>['index','register','save','showSelect','updateshow','update','delete','search','error', 'profile','all_json','load_info_for_invoice'],
			'Inventario'=>['index','register','save','updateshow','update','delete','search','error','all_json', 'track'],
			'SucursalServicio'=>['index','register','save','updateshow','update','delete','search','error','all_json', 'track'],
			'Ventas'=>[	//Antes: TestFrame
				'index', 'all_json', 'sumatorias_subtotal', 'correos',
				'new_quotation','edit_quotation','save_quotation','update_quotation','delete_quotation','updateshow', 'mail_button', 'mail_sent', 
				'manage_order','generate_order','update_order',
				'save_cart','update_cart','update_cart_recuperado','delete_items_on_update_cart','stock_recovery','print_order','envio', 'recoleccion'
			],
			/* Los siguientes tienen que ver con Nomina */
			'Rutas'=>['index','save','updateshow','update','delete','all_json'],
			'Prestamos'=>['index','save','updateshow','update','delete','all_json'],
			'ExtrasSucursal'=>['index','save','updateshow','update','delete','all_json'], //ismael
			'ExtrasMatriz'=>['index','save','updateshow','update','delete','all_json'],
			'EmpleadoInfonavit'=>['index','save','updateshow','update','delete','all_json'],
			'Historial'=>['index','updateshow','all_json'],	//Sospechoso, posible obsoleto
			'Prenomina'=>['index','save','updateshow','update','delete','all_json'],	//Ni siquiera se si este se 
			
			'PrenominaDetalles'=>['index','save','updateshow','update','delete','all_json'],	//Ni siquiera se si este se 
			'Nomina'=>['index','save','updateshow', 'addshow','update','delete','all_json']
		);

		$view = "";
		$accion = "";

		function call($view, $action){
			require_once('Controllers/'.$view.'Controller.php');
			require_once('Models/'.$view.'Model.php');
			#require_once('Views/'.$view.'/'.$action.'.php');
			$temp_ctrl_var = $view.'Controller';
			$view = new $temp_ctrl_var;
			$view->{$action}();
		}

		
		
		if(isset($_GET["view"]) && isset($_GET["action"])){
			$view = $_GET["view"];
			$action = $_GET["action"];
			if(empty($view) && empty($action)){
				#Default				
				//$view = "Dashboard";
				//$action = "index";

				//se cambio a:
				$view = "Inventario";
				$action = "index";
			} else {
				$view = $view;
				$action = $action;
			}
		}# else {
			if (array_key_exists($view, $views)) {
				if (in_array($action, $views[$view])) {
					call($view, $action);
				} else {
			#		call('Dashboard','index');
				}		
			} else {
				//call('Dashboard','index');	//Por Default
				call('Inventario','index');
			}
		#}
	}

	#session_start();	//Movido a connection.php

	if(isset($_GET["with_modal"]) && $_GET["with_modal"]=='opened' || isset($_GET["action"]) && $_GET["action"]=="all_json"){
		router();
	} else {
		//Layout general cuando no se esta dentro de una modal
		view_head();
		if(empty($_SESSION["id_user"])){	//Cambiar a empty cuando se termine el login y han roles
			$view_login = new UsuariosController;
			echo $view_login -> sign_in();
			view_login();
		} else {
			view_main();
		}
		view_foot();
		//Fin de layout genereal
	}
?>