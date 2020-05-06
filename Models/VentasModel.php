<?php
/* [2019/11/14] Antes VentasModel */
#http://localhost/sanitam/?view=Ventas&action=cotizaciones&tipo=rentas&is_archived=true	:Before
#http://localhost/sanitam/?view=Ventas&action=index&tipo=rentas&is_archived=true	:Now
//Este modelo no hace nada, sirve de pruebas para el controlador homonimo

class VentasModel{

	private $IdOrden;					#1
	private $clave_unica;				#2
	private $Folio_cotizacion;			#3
	private $Folio_orden;				#4
	private $Folio_factura;				#5
	private $id_situacion_ubicacion;	#6
	private $id_situacion_monetaria;	#7
	private $IdCliente;					#8
	private $IdCiudad;					#9
	private $CodigoPostalEntrega;		#10
	private $ColoniaEntrega;			#11
	private $CalleEntrega;				#12
	private $NombrePersonaEntrega;		#13
	private $TelefonoPersonaEntrega;	#14
	private $CorreoPersonaEntrega;		#15
	private $RequiereFactura;			#16
	private	$correo_enviado;			#17
	private $es_orden;					#18
	private $finalizado;				#19
	private $FechaCaptura;				#20
	private $HoraCaptura;				#21
	private $FechaInicio;				#22
	private $FechaTermino;				#23
	private $FechaEntrega;				#24
	private $HoraEntrega;				#25
	private $FechaOrden;				#26
	private $HoraOrden;					#27
	private $FechaFinalizacion;			#28
	private $HoraFinalizacion;			#29
	private $IdSucursal;				#30
	private $IdEmpleado_cotizacion;		#31
	private $IdEmpleado_orden;			#32
	private $IdEmpleado_finalizacion;	#33

	function __construct(
							$IdOrden, $clave_unica, $Folio_cotizacion, $Folio_orden, $Folio_factura, $id_situacion_ubicacion,
							$id_situacion_monetaria, $IdCliente, $IdCiudad, $CodigoPostalEntrega, $ColoniaEntrega, $CalleEntrega,
							$NombrePersonaEntrega, $TelefonoPersonaEntrega, $CorreoPersonaEntrega, $RequiereFactura, $correo_enviado, $es_orden,
							$finalizado, $FechaCaptura, $HoraCaptura, $FechaInicio, $FechaTermino, $FechaEntrega, $HoraEntrega, $FechaOrden, $HoraOrden,
							$FechaFinalizacion, $HoraFinalizacion, $IdSucursal, $IdEmpleado_cotizacion, $IdEmpleado_orden,
							$IdEmpleado_finalizacion
						){

		$this->setIdOrden($IdOrden);
		$this->setClaveUnica($clave_unica);
		$this->setFolio_cotizacion($Folio_cotizacion);
		$this->setFolio_orden($Folio_orden);
		$this->setFolio_factura($Folio_factura);
		$this->setId_situacion_ubicacion($id_situacion_ubicacion);
		$this->setId_situacion_monetaria($id_situacion_monetaria);
		$this->setIdCliente($IdCliente);
		$this->setIdCiudad($IdCiudad);
		$this->setCodigoPostalEntrega($CodigoPostalEntrega);
		$this->setColoniaEntrega($ColoniaEntrega);
		$this->setCalleEntrega($CalleEntrega);
		$this->setNombrePersonaEntrega($NombrePersonaEntrega);
		$this->setTelefonoPersonaEntrega($TelefonoPersonaEntrega); 
		$this->setCorreoPersonaEntrega($CorreoPersonaEntrega);
		$this->setRequiereFactura($RequiereFactura);
		$this->setCorreoEnviado($correo_enviado);
		$this->setEsOrden($es_orden);
		$this->setFinalizado($finalizado);
		$this->setFechaCaptura($FechaCaptura);
		$this->setHoraCaptura($HoraCaptura);
		$this->setFechaInicio($FechaInicio);
		$this->setFechaTermino($FechaTermino);
		$this->setFechaEntrega($FechaEntrega);
		$this->setHoraEntrega($HoraEntrega);
		$this->setFechaOrden($FechaOrden);
		$this->setHoraOrden($HoraOrden);
		$this->setFechaFinalizacion($FechaFinalizacion);
		$this->setHoraFinalizacion($HoraFinalizacion);
		$this->setIdSucursal($IdSucursal);
		$this->setIdEmpleado_cotizacion($IdEmpleado_cotizacion);
		$this->setIdEmpleado_orden($IdEmpleado_orden);
		$this->setIdEmpleado_finalizacion($IdEmpleado_finalizacion);
	}
	
	/* incio de setters & getters */
	
	public function getIdOrden(){ return $this->IdOrden; } public function setIdOrden($IdOrden){ $this->IdOrden = $IdOrden; }
	public function getClaveUnica(){ return $this->clave_unica; } public function setClaveUnica($clave_unica){ $this->clave_unica = $clave_unica; }
	public function getFolio_cotizacion(){ return $this->Folio_cotizacion; } public function setFolio_cotizacion($Folio_cotizacion){ $this->Folio_cotizacion = $Folio_cotizacion; }
	public function getFolio_orden(){ return $this->Folio_orden; } public function setFolio_orden($Folio_orden){ $this->Folio_orden = $Folio_orden; }
	public function getFolio_factura(){ return $this->Folio_factura; } public function setFolio_factura($Folio_factura){ $this->Folio_factura = $Folio_factura; }
	public function getId_situacion_ubicacion(){ return $this->Id_situacion_ubicacion; } public function setId_situacion_ubicacion($Id_situacion_ubicacion){ $this->Id_situacion_ubicacion = $Id_situacion_ubicacion; }
	public function getId_situacion_monetaria(){ return $this->Id_situacion_monetaria; } public function setId_situacion_monetaria($Id_situacion_monetaria){ $this->Id_situacion_monetaria = $Id_situacion_monetaria; }
	public function getIdCliente(){ return $this->IdCliente; } public function setIdCliente($IdCliente){ $this->IdCliente = $IdCliente; }
	public function getIdCiudad(){ return $this->IdCiudad; } public function setIdCiudad($IdCiudad){ $this->IdCiudad = $IdCiudad; }
	public function getCodigoPostalEntrega(){ return $this->CodigoPostalEntrega; } public function setCodigoPostalEntrega($CodigoPostalEntrega){ $this->CodigoPostalEntrega = $CodigoPostalEntrega; }
	public function getColoniaEntrega(){ return $this->ColoniaEntrega; } public function setColoniaEntrega($ColoniaEntrega){ $this->ColoniaEntrega = $ColoniaEntrega; }
	public function getCalleEntrega(){ return $this->CalleEntrega; } public function setCalleEntrega($CalleEntrega){ $this->CalleEntrega = $CalleEntrega; }
	public function getNombrePersonaEntrega(){ return $this->NombrePersonaEntrega; } public function setNombrePersonaEntrega($NombrePersonaEntrega){ $this->NombrePersonaEntrega = $NombrePersonaEntrega; }
	public function getTelefonoPersonaEntrega(){ return $this->TelefonoPersonaEntrega; } public function setTelefonoPersonaEntrega($TelefonoPersonaEntrega){ $this->TelefonoPersonaEntrega = $TelefonoPersonaEntrega; }
	public function getCorreoPersonaEntrega(){ return $this->CorreoPersonaEntrega; } public function setCorreoPersonaEntrega($CorreoPersonaEntrega){ $this->CorreoPersonaEntrega = $CorreoPersonaEntrega; }
	public function getRequiereFactura(){ return $this->RequiereFactura; } public function setRequiereFactura($RequiereFactura){ $this->RequiereFactura = $RequiereFactura; }
	public function getCorreoEnviado(){ return $this->correo_enviado; } public function setCorreoEnviado($correo_enviado){ $this->correo_enviado = $correo_enviado; }
	public function getEsOrden(){ return $this->es_orden; } public function setEsOrden($es_orden){ $this->es_orden = $es_orden; }
	public function getFinalizado(){ return $this->finalizado; } public function setFinalizado($finalizado){ $this->finalizado = $finalizado; }
	public function getFechaCaptura(){ return $this->FechaCaptura; } public function setFechaCaptura($FechaCaptura){ $this->FechaCaptura = $FechaCaptura; }
	public function getHoraCaptura(){ return $this->HoraCaptura; } public function setHoraCaptura($HoraCaptura){ $this->HoraCaptura = $HoraCaptura; }
	public function getFechaInicio(){ return $this->FechaInicio; } public function setFechaInicio($FechaInicio){ $this->FechaInicio = $FechaInicio; }
	public function getFechaTermino(){ return $this->FechaTermino; } public function setFechaTermino($FechaTermino){ $this->FechaTermino = $FechaTermino; }
	public function getFechaEntrega(){ return $this->FechaEntrega; } public function setFechaEntrega($FechaEntrega){ $this->FechaEntrega = $FechaEntrega; }
	public function getHoraEntrega(){ return $this->HoraEntrega; } public function setHoraEntrega($HoraEntrega){ $this->HoraEntrega = $HoraEntrega; }
	public function getFechaOrden(){ return $this->FechaOrden; } public function setFechaOrden($FechaOrden){ $this->FechaOrden = $FechaOrden; }
	public function getHoraOrden(){ return $this->HoraOrden; } public function setHoraOrden($HoraOrden){ $this->HoraOrden = $HoraOrden; }
	public function getFechaFinalizacion(){ return $this->FechaFinalizacion; } public function setFechaFinalizacion($FechaFinalizacion){ $this->FechaFinalizacion = $FechaFinalizacion; }
	public function getHoraFinalizacion(){ return $this->HoraFinalizacion; } public function setHoraFinalizacion($HoraFinalizacion){ $this->HoraFinalizacion = $HoraFinalizacion; }
	public function getIdSucursal(){ return $this->IdSucursal; } public function setIdSucursal($IdSucursal){ $this->IdSucursal = $IdSucursal; }
	public function getIdEmpleado_cotizacion(){ return $this->IdEmpleado_cotizacion; } public function setIdEmpleado_cotizacion($IdEmpleado_cotizacion){ $this->IdEmpleado_cotizacion = $IdEmpleado_cotizacion; }
	public function getIdEmpleado_orden(){ return $this->IdEmpleado_orden; } public function setIdEmpleado_orden($IdEmpleado_orden){ $this->IdEmpleado_orden = $IdEmpleado_orden; }
	public function getIdEmpleado_finalizacion(){ return $this->IdEmpleado_finalizacion; } public function setIdEmpleado_finalizacion($IdEmpleado_finalizacion){ $this->IdEmpleado_finalizacion = $IdEmpleado_finalizacion; }
	
	/* fin de setters & getters */

//======================================================================
// Section: JSON RESPONSE
//======================================================================

	public static function get_total_all_records($query_for_counter){
		$db=DataBase::getConnect();
		$select=$db->prepare($query_for_counter);	//Lo recive por parametro, entonces lo que ejecute all_json, aqui tambien es ejecutado
		$select->execute();
		$result = $select->fetchAll();
		return $select->rowCount();
	}

	public static function all_json_rentas(){
		$db=DataBase::getConnect();
		$output = array();

		$filtro_sucursal=''; $filtro_fecha_inicial=''; $filtro_fecha_final='';
		if(isset($_GET["IdSucursal"])) 
			{ 
				$filtro_sucursal = $_GET["IdSucursal"]; 
			} 
			else 
			{ 
				$filtro_sucursal = $_SESSION['id_sucursal']; 
			}
			if(isset($_GET["id_situacion_ubicacion"])) { $filtro_situacion_ubicacion = $_GET["id_situacion_ubicacion"]; } else { $filtro_situacion_ubicacion = ''; }
			if(isset($_GET["id_situacion_monetaria"])) { $filtro_situacion_monetaria = $_GET["id_situacion_monetaria"]; } else { $filtro_situacion_monetaria = ''; }
		if(isset($_GET["for"])){ $for = $_GET["for"]; } else { $for = ""; }	//saber la tabla del carrito
		if(isset($_GET["is_archived"])){
			if($_GET["is_archived"]=='true'){
				#$archived = ' AND id_situacion_ubicacion = "3" ';
				$archived = ' AND es_orden = "1" ';
				$decidir_folio_a_mostrar = 'Folio_orden';
				$decidir_folio_a_buscar = ' Folio_orden ';
			} else if($_GET["is_archived"]=='false'){
				#$archived = ' AND id_situacion_ubicacion < "3"'; //= "1" OR id_situacion_ubicacion = "2" ';
				$archived = ' AND es_orden = "0" ';
				$decidir_folio_a_mostrar = 'Folio_cotizacion';
				$decidir_folio_a_buscar = ' Folio_cotizacion ';
			}
		} else {
			$archived = '';
			$decidir_folio_a_mostrar = 'Folio_factura';
			$decidir_folio_a_buscar = ' Folio_factura ';
		}

		if(isset($_POST['start']) || isset($_POST['length']) || isset($_POST['search']) || isset($_POST['order']) || isset($_POST['column']) || isset($_POST['columns']) ){
			$row = $_POST['start'];
			$rowperpage = $_POST['length'];
			$search_filter = $_POST["search"]["value"];
		} else {
			$search_filter = '';
			$row=''; $rowperpage =''; //Para que el paginador funcione	-- Bug corregido
		}

		$db=DataBase::getConnect();
		$output = array();
		$query = '';
		$query .= ' SELECT * FROM orden_rentas ';
		if( isset($search_filter) || isset($filtro_sucursal)){
			$query .= ' WHERE eliminado=0 AND '.$decidir_folio_a_buscar.' LIKE "%'.$search_filter.'%" ';

					if(isset($_GET["is_archived"]) && $_GET["is_archived"]=='true'){	//Solo para las ordenes tanto de rentas como de servicios
						//Filtro de situacion
						if($filtro_situacion_ubicacion !=='' && $filtro_situacion_monetaria =='' ){	//Solo ubicacion
							$query .= ' AND id_situacion_ubicacion="'.$filtro_situacion_ubicacion.'"  ';
						} else if($filtro_situacion_ubicacion =='' && $filtro_situacion_monetaria !=='' ) {	//Solo pagos
							$query .= ' AND id_situacion_monetaria="'.$filtro_situacion_monetaria.'" ';
						} else  if($filtro_situacion_ubicacion !=='' && $filtro_situacion_monetaria !=='' ){	//Ambos
							$query .= ' AND id_situacion_ubicacion="'.$filtro_situacion_ubicacion.'" AND id_situacion_monetaria="'.$filtro_situacion_monetaria.'" ';
						} else {  } 
					}

			if($filtro_sucursal>0){
				$query .= ' AND IdSucursal = "'.$filtro_sucursal.'" ';	//Filtro de sucursal + archivo para determinar si se trata de la lista de cotizaciones u ordenes 
			}
			
			# $query .= ' ORDER BY IdOrden DESC ';

			$query.= $archived;
			$query_for_counter = $query; //hasta aqui se le envia al contador total, sin limitar registros por pagina con el bloque if posterior

			if( isset($row) ||  isset($rowperpage) AND $row>0  || $rowperpage>0){
				//Si se executa desde el navegador marca error, porque la paginacion se recive via $_POST 
				$query .= ' limit '.$row.','.$rowperpage.' ';	//Limitar cantidad de resultados por pagina dentro de la tabla
			}
		}

		 #return $query;	//test
		# return $query_for_counter;	//test
		
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		#$statement->closeCursor();	//Se cierra el cursor para limpiar la sentencia y pueda ser ejecutada
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row)
		{
			$total_de_orden = self::getSubTotalByOrderUniqueKey($row["clave_unica"], $for);
			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
			$sub_array = array();
			$sub_array[] = $row[$decidir_folio_a_mostrar];		//SI LA URL dice: archivado=TRUE { mostrar Folio_orden } sino { Folio_cotizacion }
			$sub_array[] = ClientesModel::getOnlyName($row["IdCliente"]);
			$sub_array[] = '$'.$total_de_orden;

			//$sub_array[] = $row["FechaInicio"];
			//$sub_array[] = $row["FechaTermino"];
			$sub_array[] = date ('d-m-Y', strtotime ($row["FechaInicio"]));
			$sub_array[] = date ('d-m-Y', strtotime ($row["FechaTermino"]));

			//si es orden se ponen la situacion ubicacion y la situacion monetaria
			if($_GET["is_archived"]=='true') 					
			{ 
				$sub_array[] = self::__situacion_string('rentas', 'ubicacion', $row["id_situacion_ubicacion"]).', '.self::__situacion_string('rentas', 'monetaria', $row["id_situacion_monetaria"]); #$row["id_situacion_ubicacion"];
			}
			else
			{
				//si es cotizacion no se ocupa situacion ubicacion ni la situacion monetaria
				$sub_array[] = " ";
			}	

			if(isset($_GET["is_archived"]))
			{
				//// sentencia para verificar el "archivo" o "Modulo" a seleccionar y si es true son ORDENES 
				if($_GET["is_archived"]=='true') 					
				{ 
					////ordenes de rentas
					////modificado por paulina ---by 16012020
					//ver
					$acciones =" ";
					//por entregar
                    if ($row["id_situacion_ubicacion"]==1)
                    {
                    	$acciones = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 
                     
						<button type="button" name="status" id="'.$row["clave_unica"].'" class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> 

						<a href="index.php?view=Ventas&action=envio&for=rentas&clave_unica='.$row["clave_unica"].'" name="recovery" class="btn btn-primary btn-sm recovery" data-toggle="tooltip" data-placement="top" title="Generar envio"><i class="fa fa-truck"></i></a>';
					}
					//entregado
					if ($row["id_situacion_ubicacion"]==2)
                    {

						$acciones = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 
                     
						<button type="button" name="status" id="'.$row["clave_unica"].'" class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> 						

						<a href="index.php?view=Ventas&action=recoleccion&for=rentas&clave_unica='.$row["clave_unica"].'" name="recovery" class="btn btn-secondary btn-sm recovery" data-toggle="tooltip" data-placement="top" title="Generar recolecci&oacute;n"><i class="fa fa-truck fa-flip-horizontal"></i></a>';

					}
					//Recuperado
					if ($row["id_situacion_ubicacion"]==3)
                    {
						$acciones = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 
                     
						<button type="button" name="status" id="'.$row["clave_unica"].'" class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';
					}
					////Finalizado
					if($row["finalizado"]==1){
						$acciones = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button>';
					}

                   $sub_array[] =$acciones; 


                    /*
					$sub_array[] = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 
                     
					<button type="button" name="status" id="'.$row["clave_unica"].'" class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> 

					<a href="index.php?view=Ventas&action=print_order_envio&for=rentas&clave_unica='.$row["clave_unica"].'" name="recovery" class="btn btn-primary btn-sm recovery" data-toggle="tooltip" data-placement="top" title="Generar envio"><i class="fa fa-truck"></i></a> 

					<a href="index.php?view=Ventas&action=print_recuperacion&for=rentas&clave_unica='.$row["clave_unica"].'" name="recovery" class="btn btn-secondary btn-sm recovery" data-toggle="tooltip" data-placement="top" title="Generar recuperaci&oacute;
					n"><i class="fa fa-truck fa-flip-horizontal"></i></a>';
					*/
					/*stock_recovery*/

				} 
				//// sentencia para verificar el "archivo" o "Modulo" a seleccionar y si es false son COTIZACIONES.
				else if($_GET["is_archived"]=='false')
				{
					///Verificando el id_rol del usuario por medio del tipo de empleado. 					
					if(isset($_SESSION["id_role"]))
					{
						////Si el id_rol es igual a 3, no puede eliminar ningun dato 
						/////que se ha almacenado en la parte de COTIZACIONES.
						$id_role = $_SESSION["id_role"];
						if($id_role == '3')
						{ //Solo para auxiliares
							$sub_array[] = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 

							<a href="index.php?view=Ventas&action=edit_quotation&for=rentas&clave_unica='.$row["clave_unica"].'" name="update" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a> 
							
							<button type="button" name="status" id="'.$row["clave_unica"].'" class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Generar orden"><i class="fa fa-cog"></i></button>';
						} else 
						{	//Administradores: General y de sucursal
							////cotizaciones de rentas
							$sub_array[] = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 
							
							<a href="index.php?view=Ventas&action=edit_quotation&for=rentas&clave_unica='.$row["clave_unica"].'" name="update" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a> 
							
							<button type="button" name="delete" id="'.$row["clave_unica"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>
							
							<button type="button" name="status" id="'.$row["clave_unica"].'" class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Generar orden"><i class="fa fa-cog"></i></button>';
						}
					}
				}
			}
			$data[] = $sub_array;
		}

		if(isset($_POST["draw"])){ $draw = $_POST["draw"]; } else { $draw = ''; }
		
		$output = array(
			"draw"    => intval($draw),
			"recordsTotal"  =>  $filtered_rows,
			"recordsFiltered" => self::get_total_all_records($query_for_counter),	//Le enviamos query y ese metodo lo recive para ejecutarlo directamente
			"data"    => $data
		);

		function utf8ize($d) {	//Me ayuda con los tildes/acentos
			if (is_array($d)) {
				foreach ($d as $k => $v) {
					$d[$k] = utf8ize($v);
				}
			} else if (is_string ($d)) {
				return utf8_encode($d);
			}
			return $d;
		}
		echo json_encode(utf8ize($output));
	}

	public static function all_json_servicios()
	{
		$db=DataBase::getConnect();
		$output = array();

		$filtro_sucursal=''; $filtro_fecha_inicial=''; $filtro_fecha_final='';
		if(isset($_GET["IdSucursal"])) 
			{ 
				$filtro_sucursal = $_GET["IdSucursal"]; 
			} 
		else 
			{ 
				$filtro_sucursal = $_SESSION['id_sucursal']; 
			}
		if(isset($_GET["id_situacion_ubicacion"])) 
			{ 
				$filtro_situacion_ubicacion = $_GET["id_situacion_ubicacion"]; 
			} 
		else 
			{ 
				$filtro_situacion_ubicacion = ''; 
	        }
		if(isset($_GET["id_situacion_monetaria"])) 
			{ 
				$filtro_situacion_monetaria = $_GET["id_situacion_monetaria"]; 
			} 
			else 
			{ 
				$filtro_situacion_monetaria = ''; 
			}
		//saber la tabla del carrito
		if(isset($_GET["for"]))
		{ 
			$for = $_GET["for"]; 
		} 
		else 
		{ 
			$for = ""; 
		}	
         
		if(isset($_GET["is_archived"]))
		{
			
			if($_GET["is_archived"]=='true')  //cuando son ordenes de servicios
			{
				#$archived = ' AND id_situacion_ubicacion = "5" ';
				$archived = ' AND es_orden = "1" ';
				$decidir_folio_a_mostrar = 'Folio_orden';
				$decidir_folio_a_buscar = ' Folio_orden ';	//La col de la tabla que usara la clausula LIKE para buscar
			} 
			else if($_GET["is_archived"]=='false') //cuando son cotizaciones de servicios
			{
				#$archived = ' AND id_situacion_ubicacion = "4" ';
				$archived = ' AND es_orden = "0" ';
				$decidir_folio_a_mostrar = 'Folio_cotizacion';
				$decidir_folio_a_buscar = ' Folio_cotizacion ';
			}
		} //if(isset($_GET["is_archived"]))
		else 
		{
			$archived = '';
			$decidir_folio_a_mostrar = 'Folio_factura';
			$decidir_folio_a_buscar = ' Folio_factura ';
		} //else

		if(isset($_POST['start']) || isset($_POST['length']) || isset($_POST['search']) || isset($_POST['order']) || isset($_POST['column']) || isset($_POST['columns']) )
		{
			$row = $_POST['start'];
			$rowperpage = $_POST['length'];
			$search_filter = $_POST["search"]["value"];
		} 
		else 
		{
			$search_filter = '';
			$row=''; $rowperpage =''; //Para que el paginador funcione	-- Bug corregido
		}

		$db=DataBase::getConnect();
		$output = array();
		$query = '';
		$query .= ' SELECT * FROM orden_servicios ';
		if( isset($search_filter) || isset($filtro_sucursal))
		{
			$query .= ' WHERE eliminado=0 AND '.$decidir_folio_a_buscar.' LIKE "%'.$search_filter.'%" ';

			if(isset($_GET["is_archived"]) && $_GET["is_archived"]=='true')
			{	//Solo para las ordenes
				//Filtro de situacion
				if($filtro_situacion_ubicacion !=='' && $filtro_situacion_monetaria =='' )
				{	//Solo ubicacion
					$query .= ' AND id_situacion_ubicacion="'.$filtro_situacion_ubicacion.'"  ';
				} else if($filtro_situacion_ubicacion =='' && $filtro_situacion_monetaria !=='' ) {	//Solo pagos
					$query .= ' AND id_situacion_monetaria="'.$filtro_situacion_monetaria.'" ';
				} else  if($filtro_situacion_ubicacion !=='' && $filtro_situacion_monetaria !=='' ){	//Ambos
					$query .= ' AND id_situacion_ubicacion="'.$filtro_situacion_ubicacion.'" AND id_situacion_monetaria="'.$filtro_situacion_monetaria.'" ';
				} else {  } 
			}

			if($filtro_sucursal>0){
				$query .= ' AND IdSucursal = "'.$filtro_sucursal.'" ';	//Filtro de sucursal + archivo para determinar si se trata de la lista de cotizaciones u ordenes 
			}
			# $query .= ' ORDER BY IdOrden DESC ';
			$query .= $archived;
			$query_for_counter = $query; //hasta aqui se le envia al contador total, sin limitar registros por pagina con el bloque if posterior
			
			if(isset($row) || isset($rowperpage) AND $row>0 || $rowperpage>0){
				//Si se executa desde el navegador marca error, porque la paginacion se recive via $_POST 
				$query .= ' limit '.$row.','.$rowperpage.' ';	//Limitar cantidad de resultados por pagina dentro de la tabla
			}
		}

		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		#$statement->closeCursor();	//Se cierra el cursor para limpiar la sentencia y pueda ser ejecutada
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row){
			$total_de_orden = self::getSubTotalByOrderUniqueKey($row["clave_unica"], $for);
			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
			$sub_array = array();
			$sub_array[] = $row[$decidir_folio_a_mostrar];		//SI LA URL dice: archivado=TRUE { mostrar Folio_orden } sino { Folio_cotizacion }
			$sub_array[] = ClientesModel::getOnlyName($row["IdCliente"]);
			$sub_array[] = '$'.$total_de_orden;
			//$sub_array[] = $row["FechaInicio"];
			//$sub_array[] = $row["FechaTermino"];

			$sub_array[] = date ('d-m-Y', strtotime ($row["FechaInicio"]));
			$sub_array[] = date ('d-m-Y', strtotime ($row["FechaTermino"]));


            //jlopezl
			//revisar por que tiene error
			//si es orden se ponen la situacion ubicacion y la situacion monetaria
			if($_GET["is_archived"]=='true') 					
			{ 
				$sub_array[] = self::__situacion_string('servicios', 'ubicacion', $row["id_situacion_ubicacion"]).', '.self::__situacion_string('servicios', 'monetaria', $row["id_situacion_monetaria"]); #$row["id_situacion_ubicacion"];
			}
			else
			{
				//si es cotizacion no se ocupa situacion ubicacion ni la situacion monetaria
				$sub_array[] = " ";
			}	

            //jlopezl
            //se comento esta linea y se puso el if de arriba
			//$sub_array[] = $row["id_situacion_ubicacion"];
			if(isset($_GET["is_archived"])){
				if($_GET["is_archived"]=='true'){ 
		 ////orden de servicios

					$acciones="";
					///Por seleccionar opcion 
					///por que si no la validamos no se mostrara los botones 
					if($row["id_situacion_ubicacion"]==0 || $row["id_situacion_ubicacion"]==1){
						$acciones = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 

						<button type="button" name="status" id="'.$row["clave_unica"].'"  class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Editar orden"><i class="fa fa-edit"></i></button>';
					}
					////Por realizar
					if($row["id_situacion_ubicacion"]==4 ){
						$acciones = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 

						<button type="button" name="status" id="'.$row["clave_unica"].'"  class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Editar orden"><i class="fa fa-edit"></i></button> 
	
						<a href="index.php?view=Ventas&action=envio&for=servicios&clave_unica='.$row["clave_unica"].'" name="recovery" class="btn btn-primary btn-sm recovery" data-toggle="tooltip" data-placement="top" title="Env&iacute;os"><i class="fa fa-truck"></i></a> ';
					}

					///Entregado
					if($row["id_situacion_ubicacion"]==5){
						$acciones = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 

						<button type="button" name="status" id="'.$row["clave_unica"].'"  class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Editar orden"><i class="fa fa-edit"></i></button>';
					}	
					////Finalizado
					if($row["finalizado"]==1){
						$acciones = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button>';
					}

					$sub_array[] = $acciones;
					/*
					$sub_array[] = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 

					<button type="button" name="status" id="'.$row["clave_unica"].'"  class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Editar orden"><i class="fa fa-edit"></i></button> 

					<a href="index.php?view=Ventas&action=print_order_envio&for=servicios&clave_unica='.$row["clave_unica"].'" name="recovery" class="btn btn-primary btn-sm recovery" data-toggle="tooltip" data-placement="top" title="Env&iacute;os"><i class="fa fa-truck"></i></a> ';
					///print_order_envio*/
				} else if($_GET["is_archived"]=='false'){
					if(isset($_SESSION["id_role"])){
						$id_role = $_SESSION["id_role"];
						if($id_role == '3'){ //Solo para auxiliares
							$sub_array[] = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 

							<a href="index.php?view=Ventas&action=edit_quotation&for=servicios&clave_unica='.$row["clave_unica"].'" name="update"  class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a> 
							
							<button type="button" name="status" id="'.$row["clave_unica"].'" class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Generar orden"><i class="fa fa-cog"></i></button>';
						} else {	//Administradores: General y de sucursal
		   ////cotizaciones de servicios
							$sub_array[] = '<button type="button" name="view" id="'.$row["clave_unica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> 
							
							<a href="index.php?view=Ventas&action=edit_quotation&for=servicios&clave_unica='.$row["clave_unica"].'" name="update" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a> 
							
							<button type="button" name="delete" id="'.$row["clave_unica"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button> 
							
							<button type="button" name="status" id="'.$row["clave_unica"].'" class="btn btn-warning btn-sm status" data-toggle="tooltip" data-placement="top" title="Generar orden"><i class="fa fa-cog"></i></button>';
						}
					}
				}
			}
			$data[] = $sub_array;
		}

		if(isset($_POST["draw"])){ $draw = $_POST["draw"]; } else { $draw = ''; }

		$output = array(
			"draw"    => intval($draw),
			"recordsTotal"  =>  $filtered_rows,
			"recordsFiltered" => self::get_total_all_records($query_for_counter),
			"data"    => $data
		);

		function utf8ize($d) {	//Me ayuda con los tildes/acentos
			if (is_array($d)) {
				foreach ($d as $k => $v) {
					$d[$k] = utf8ize($v);
				}
			} else if (is_string ($d)) {
				return utf8_encode($d);
			}
			return $d;
		}
		echo json_encode(utf8ize($output));
	}
	
	public static function getSubTotalByOrderUniqueKey($unique_key, $for){
		$cart_table = '_cotizaciones_cart_';	//Si se concatena marca error para data table pero sino, el error sera para el PDF, entonces que hago?
		//Subtotal INDIVIDUAL de una COTIZACION
		$db=DataBase::getConnect();

		$query = 'SELECT SUM(precio*cantidad) as subtotal_orden FROM '.$cart_table.$for.' WHERE clave_unica = :unique_key ';	//Para Invoicr PDF
		# $query = 'SELECT SUM(precio*cantidad) as subtotal_orden FROM '.$for.'  WHERE clave_unica = :unique_key ';	//Para DataTable

		$select=$db->prepare($query);
		$select->bindValue('unique_key',$unique_key);
		#$select->bindValue('for_table',$for);
		$select->execute();
		$sub_total=$select->fetch();
		//var_dump($alumno);
		//die();
		return $sub_total['subtotal_orden'];

		//Variante de con el carrito de servicios	:for_table
		//Este solo se manda a llamar mediante "all_json_..." al momento de imprimir
	}
/***********/
	public static function getSumatoriaSubTotalOrdenEn_SucursalActual($id, $for, $is_archived){
		
		$cart_table = '_cotizaciones_cart_';
		//Las siguientes 21 lineas definen si sumar a partir de si se estan viendo cotizaciones u ordenes, al mismo tiempo varia si es para rentas o servicios
		$archived = '';
		if(isset($is_archived)){
			if($is_archived=='true'){
				$archived = ' AND ordenes.es_orden = "1" ';
			} else if($is_archived=='false'){
				$archived = ' AND ordenes.es_orden = "0" ';
			}
			$archived .= ' AND eliminado=0 ';
		}

		#$query = 'SELECT SUM(precio*cantidad) as subtotal_orden FROM '.$for.' as carrito, orden_rentas as ordenes WHERE carrito.clave_unica=ordenes.clave_unica AND ordenes.IdSucursal=:id';
		$query = 'SELECT SUM(precio*cantidad) as subtotal_orden FROM '.$cart_table.$for.' as carrito, orden_'.$for.' as ordenes  WHERE ordenes.IdSucursal=:id '.$archived.' AND carrito.clave_unica=ordenes.clave_unica  ';

		# return $query;
		// Sumatoria de todos los subtotales de una sucursal
		$db=DataBase::getConnect();
		$select=$db->prepare($query);
		$select->bindValue('id',$id);
		#$select->bindValue('for_table',$for);
		$select->execute();
		$result=$select->fetch();
		return $result["subtotal_orden"];
		//Variante de con el carrito de servicios	:for_table

	}

	public static function getSumatoriaSubTotalOrdenEn_TodaSucursal($for, $is_archived){
		$cart_table = '_cotizaciones_cart_';
		
		//Las siguientes 21 lineas definen si sumar a partir de si se estan viendo cotizaciones u ordenes, al mismo tiempo varia si es para rentas o servicios
		$archived = '';
		if(isset($is_archived)){
			if($is_archived=='true'){
				$archived = ' WHERE ordenes.es_orden = "1" ';
			} else if($is_archived=='false'){
				$archived = ' WHERE ordenes.es_orden = "0" ';
			}
			$archived .= ' AND eliminado=0 ';
		}

		$query = 'SELECT SUM(carrito.precio*carrito.cantidad) as subtotal_orden, ordenes.id_situacion_ubicacion  FROM '.$cart_table.$for.' as carrito, orden_'.$for.' as ordenes '.$archived.' AND carrito.clave_unica=ordenes.clave_unica ';

		#return $query;	//Imprimir solo cuando no se encunetre un error en fase de pruebas
		//Sumatoria de todos los subtotales de todas las sucursales
		$db=DataBase::getConnect();
		$select=$db->prepare($query);	//:for_table
		#$select->bindValue('for_table',$for);
		$select->execute();
		$result=$select->fetch();
		return $result["subtotal_orden"];
		
		//Variante de con el carrito de servicios	:for_table
	}

//======================================================================
// Section: QUOTATION se refiere a Cotizaciones DE RENTAS O SERVICIOS
// 
//======================================================================

	public static function save_quotation($orden, $for){
		
   		$db=DataBase::getConnect();
		$sql = '';
		//Inserta como cotizacion en la tabla de orden-rentas u orden_servicios segun sea el caso
		//Ambas tablas del Query son identicas porque son las mismas columnas, solo difieren en el nombre de la tabla
    
		$sql= 'INSERT INTO orden_'.$for.' VALUES(null, :clave_unica, :Folio_cotizacion, null, null, 
				null, null, :IdCliente, :IdCiudad, 
				:CodigoPostalEntrega, :ColoniaEntrega, :CalleEntrega, :NombrePersonaEntrega, 
				:TelefonoPersonaEntrega, :CorreoPersonaEntrega, null, 0,
				0, 0, :FechaCaptura, :HoraCaptura, :FechaInicio, :FechaTermino, 
				:FechaEntrega, :HoraEntrega, null, null, null, null, :IdSucursal, 
				:IdEmpleado_cotizacion, null, null,0)';
		
            /*
       		$sql= 'INSERT INTO orden_'.$for.' VALUES(null, :clave_unica, :Folio_cotizacion, null, null, 
				1, 1, :IdCliente, :IdCiudad, 
				:CodigoPostalEntrega, :ColoniaEntrega, :CalleEntrega, :NombrePersonaEntrega, 
				:TelefonoPersonaEntrega, :CorreoPersonaEntrega, null, 0,
				0, 0, :FechaCaptura, :HoraCaptura, :FechaInicio, :FechaTermino, 
				:FechaEntrega, :HoraEntrega, null, null, null, null, :IdSucursal, 
				:IdEmpleado_cotizacion, null, null,0)';
            */


		$insert=$db->prepare($sql);
		
		$asignar_folio = self::asignar_folio($for,0); //params: [rentas/servicios] , [0=cotizacion; 1=orden;]
		$fecha_captura = date("Y-m-d");
		$hora_captura = date("Y-m-d H:i:s");

		#$insert->bindValue('IdOrden', $orden->getIdOrden());
		$insert->bindValue('clave_unica', $orden->getClaveUnica());
		$insert->bindValue('Folio_cotizacion', $asignar_folio);//$orden->getFolio_cotizacion());
		#$insert->bindValue('Folio_orden', $orden->getFolio_orden());
		#$insert->bindValue('Folio_factura', $orden->getFolio_factura());
		#$insert->bindValue('Id_situacion_ubicacion', $orden->getId_situacion_ubicacion());	//1
		//$insert->bindValue('id_situacion_ubicacion', $Id_situacion_ubicacion);	//valor de 1 para si es renta y 4 para si es servicio
		#$insert->bindValue('Id_situacion_monetaria', $orden->getId_situacion_monetaria());	//1
		$insert->bindValue('IdCliente', $orden->getIdCliente());
		$insert->bindValue('IdCiudad', $orden->getIdCiudad());
		$insert->bindValue('CodigoPostalEntrega', $orden->getCodigoPostalEntrega());
		$insert->bindValue('ColoniaEntrega', $orden->getColoniaEntrega());
		$insert->bindValue('CalleEntrega', $orden->getCalleEntrega());
		$insert->bindValue('NombrePersonaEntrega', $orden->getNombrePersonaEntrega());
		$insert->bindValue('TelefonoPersonaEntrega', $orden->getTelefonoPersonaEntrega()); 
		$insert->bindValue('CorreoPersonaEntrega', $orden->getCorreoPersonaEntrega());
		#$insert->bindValue('RequiereFactura', $orden->getRequiereFactura());
		#$insert->bindValue('CorreoEnviado', $orden->getCorreoEnviado());
		#$inse$_GET["IdSucursal"]rt->bindValue('EsOrden', $orden->getEsOrden());
		#$insert->bindValue('Finalizado', $orden->getFinalizado());
		$insert->bindValue('FechaCaptura', $fecha_captura);//$orden->getFechaCaptura());
		$insert->bindValue('HoraCaptura', $hora_captura); //$orden->getHoraCaptura());
		$insert->bindValue('FechaInicio', $orden->getFechaInicio());
		$insert->bindValue('FechaTermino', $orden->getFechaTermino()); 
		$insert->bindValue('FechaEntrega', $orden->getFechaEntrega());
		$insert->bindValue('HoraEntrega', $orden->getHoraEntrega());
		#$insert->bindValue('FechaOrden', $orden->getFechaOrden());
		#$insert->bindValue('HoraOrden', $orden->getHoraOrden());
		#$insert->bindValue('FechaFinalizacion', $orden->getFechaFinalizacion());
		#$insert->bindValue('HoraFinalizacion', $orden->getHoraFinalizacion());
		
		//si el administrador general selecciona una sucursal del combobox
		//entonces la orden pertenece a dicha sucursal y no a la que pertenece el administrador general
		//$_SESSION["idsucursal" se crea en  VentasController.php en la function sumatorias_subtotal()
		//ya que se actualiza cada vez que se refresca la vista index de las cotizaciones/ordenes. 
		if ($_SESSION["idsucursal"]>0)
		{
			$insert->bindValue('IdSucursal', $_SESSION["idsucursal"]);
           //se limpia para que no corrompa alguna otra operacion
           $_SESSION["idsucursal"] = 0;
		}
		else
		{
			    //De lo eontrario se guarda la session del administrador general
				$insert->bindValue('IdSucursal', $orden->getIdSucursal());	
		}

		//$insert->bindValue('IdSucursal', $orden->getIdSucursal());
		$insert->bindValue('IdEmpleado_cotizacion', $orden->getIdEmpleado_cotizacion());
#		$insert->bindValue('IdEmpleado_orden', $orden->getIdEmpleado_orden());
#		$insert->bindValue('IdEmpleado_finalizacion', $orden->getIdEmpleado_finalizacion());
		$insert->execute();
		
	}

	public static function update_quotation($orden, $for){	//Esta solo modifica los datos de entrega, para modificar el carrito de compra, el metodo esta ubicado mas arriba llamado update_cart




		if(isset($for)){
			$db=DataBase::getConnect();
			$insert=$db->prepare('UPDATE orden_'.$for.' SET IdCliente=:IdCliente, IdCiudad=:IdCiudad, CodigoPostalEntrega=:CodigoPostalEntrega, ColoniaEntrega=:ColoniaEntrega, CalleEntrega=:CalleEntrega, NombrePersonaEntrega=:NombrePersonaEntrega, TelefonoPersonaEntrega=:TelefonoPersonaEntrega, CorreoPersonaEntrega=:CorreoPersonaEntrega, correo_enviado=0, FechaInicio=:FechaInicio, FechaTermino=:FechaTermino, FechaEntrega=:FechaEntrega, HoraEntrega=:HoraEntrega, IdEmpleado_cotizacion=:IdEmpleado_cotizacion  WHERE clave_unica=:clave_unica ');
			$insert->bindValue('IdCliente', $orden->getIdCliente());
			$insert->bindValue('IdCiudad', $orden->getIdCiudad());
			$insert->bindValue('CodigoPostalEntrega', $orden->getCodigoPostalEntrega());
			$insert->bindValue('ColoniaEntrega', $orden->getColoniaEntrega());
			$insert->bindValue('CalleEntrega', $orden->getCalleEntrega());
			$insert->bindValue('NombrePersonaEntrega', $orden->getNombrePersonaEntrega());
			$insert->bindValue('TelefonoPersonaEntrega', $orden->getTelefonoPersonaEntrega()); 
			$insert->bindValue('CorreoPersonaEntrega', $orden->getCorreoPersonaEntrega());
			$insert->bindValue('FechaInicio', $orden->getFechaInicio());
			$insert->bindValue('FechaTermino', $orden->getFechaTermino()); 
			$insert->bindValue('FechaEntrega', $orden->getFechaEntrega());
			$insert->bindValue('HoraEntrega', $orden->getHoraEntrega());
			$insert->bindValue('IdEmpleado_cotizacion', $orden->getIdEmpleado_cotizacion());
			$insert->bindValue('clave_unica', $orden->getClaveUnica());
			$insert->execute();
		}
	}

	public static function delete_quotation($id,$for){	//$id es en realidad clave_unica
		$db=DataBase::getConnect();
		
		if(isset($for))
		{

			$delete=$db->prepare('UPDATE orden_'.$for.' SET eliminado=1 WHERE clave_unica=:id');
			$delete->bindValue('id',$id);
			$delete->execute();

			//NO ES NECESARIO ELIMINAR FISICAMENTE DE _cotizaciones_cart_rentas
			//PUESTO QUE SE MARCA LA ORDEN COMO ELIMINADO = 1
			// ES IMPORTANTE QUE QUEDE EN EL HISTORICO.
			/*
			if($for=='rentas')
			{
				//IMPORTANTE!!!  =>	 HACER UN METODO SIMILAR PARA CUANDO FINALIZE LA RENTA				
				#1. 
				$select=$db->prepare('SELECT * FROM _cotizaciones_cart_rentas WHERE clave_unica = :id');
				$select->bindValue('id',$id);
				$select->execute();
				foreach($select->fetchAll() as $item_cart){
					#1.1. Devolver Stock a inventario (item by item)
					#InventarioModel::return_stock($item_cart["IdInventarioUnidadesRenta"], $item_cart["cantidad"]);	//YA NO SE RESTAM CUANDO ES COTIZACION
					
					//Eliminar del carrito
					#1.2. Borrar de manera individual un item del carrito que pertenezcan a una clave unica
					$delete=$db->prepare('DELETE FROM _cotizaciones_cart_rentas WHERE IdInventarioUnidadesRenta=:idItemInventario');
					$delete->bindValue('idItemInventario',$item_cart["IdInventarioUnidadesRenta"]);
					$delete->execute();
				}
			}*/

			#2. Borrar la cotizacion
				//Hasta ahora todo lo que he hecho es para "orden_rentas"... como servicios no tiene inventario, no sera tan complicado de adaptar para servicios
				//PD: hace falta hacer otra tabla de tipo "carrito" para "servicios" porque "cotizar" de moemento solo es compatible con "rentas"
				//Entonces agregar un nuevo @param para determinar cual tabla de carrito se va a utilizar (con un IF), pero por mientras el Default es rentas
			#$delete=$db->prepare('DELETE FROM orden_'.$for.' WHERE clave_unica=:id');

		}
	}

//======================================================================
// Section: INVOICES
//======================================================================

	public static function load_info_for_invoice_array($id, $for){
		if(isset($for) && $for=='rentas' || $for=='servicios'){
			//este metodo es para PDF.. existe un metodo similar en ClientesModel pero son muy distintos
			$db=DataBase::getConnect();
			$info_array=[];
			$select=$db->prepare('SELECT * FROM 
					orden_'.$for.' as ordenes,
					municipio, entidad, 
					clientes 
				WHERE 
					municipio.idm=ordenes.IdCiudad AND municipio.cve_ent = entidad.cve_ent  AND
					ordenes.IdCliente = clientes.IdCliente
					AND ordenes.clave_unica=:id');
			

			$select->bindValue('id',$id);
			//$select->bindValue('cart',$cart);
			$select->execute();
			$clientesDb=$select->fetch();
			$info_array=array(

			### Aqui no importa el orden dentro del array porque no se estan pasando los parametros al constructor, pero si con el tiempo se requieren agregar mas params, respetar la posicion de los parametros actuales o causara errores en el PDF y al modal que genera la orden
			$clientesDb['Nombre'],
			$clientesDb['Telefono'],
			$clientesDb['CorreoElectronico'],
			
			$clientesDb['NombrePersonaEntrega'],
			$clientesDb['nom_ent'],$clientesDb['nom_mun'],
			$clientesDb['CodigoPostalEntrega'],$clientesDb['ColoniaEntrega'],$clientesDb['CalleEntrega'],	
			//...Solo hasta aqui aparecen en el PDF, los de abajo se usan en otras vistas respetando la posicion dentro del array comenzando desde el zero, ej $array[0];
			
			//Contacto de persona que recive
			$clientesDb['TelefonoPersonaEntrega'],
			$clientesDb['CorreoPersonaEntrega'],
			
			//Fecha y hora de entrega
			$clientesDb['FechaEntrega'],
			$clientesDb['HoraEntrega'],
			
			$clientesDb['clave_unica']	//posicion 13
			
			//modal editar orden (ya generada)	- posiciones 14 a 18
			,$clientesDb['Folio_factura'], $clientesDb['id_situacion_ubicacion'], $clientesDb['id_situacion_monetaria'], $clientesDb['RequiereFactura'], $clientesDb['finalizado'],
			
			///19
			$clientesDb['IdSucursal'],
			///$clientesDb['clave']
			//$clientesDb['recuperado']

			);
			return $info_array;
		}
	}

////////load-info-Datos de la empresa
public static function info_empresa_array($idSuc){
//	if(isset($_GET["info"])){
		//este metodo es para PDF.. existe un metodo similar en ClientesModel pero son muy distintos
		$db=DataBase::getConnect();
		$info_array=[];
		$select=$db->prepare('SELECT *
							FROM sucursales suc 
							INNER JOIN municipio cd ON suc.IdCiudad=idm
							INNER JOIN entidad est ON cd.cve_ent=est.cve_ent
							WHERE suc.IdSucursal=:idSuc');

		$select->bindValue('idSuc',$idSuc);
		//$select->bindValue('cart',$cart);
		$select->execute();
		$empresaDb=$select->fetch();
		$info_array=array(
			### Aqui no importa el orden dentro del array porque no se estan pasando los parametros al constructor, pero si con el tiempo se requieren agregar mas params, respetar la posicion de los parametros actuales o causara errores en el PDF y al modal que genera la orden
			$empresaDb['Nombre'],
			$empresaDb['Direccion'],
			$empresaDb['nom_mun'],
			$empresaDb['nom_ent'],
			$empresaDb['Telefono'],
			$empresaDb['CorreoContacto']	

		);
		return $info_array;
//	}
}


/////creado por paulina para modo de prueba
#by
/***** inicio de prueba */
/*public static function load_info_for_invoice_array_ordenes($id, $for){
	if(isset($for) && $for=='rentas' || $for=='servicios'){
		//este metodo es para PDF.. existe un metodo similar en ClientesModel pero son muy distintos
		$db=DataBase::getConnect();
		$info_array=[];
		$select=$db->prepare('SELECT * FROM 
				orden_'.$for.' as ordenes,
				municipio, entidad, 
				clientes 
			WHERE 
				municipio.idm=ordenes.IdCiudad AND municipio.cve_ent = entidad.cve_ent  AND
				ordenes.IdCliente = clientes.IdCliente
				AND ordenes.clave_unica=:id AND ordenes.es_orden ="1"');
		$select->bindValue('id',$id);
		$select->execute();
		$clientesDb=$select->fetch();
		$info_array=array(

		### Aqui no importa el orden dentro del array porque no se estan pasando los parametros al constructor, pero si con el tiempo se requieren agregar mas params, respetar la posicion de los parametros actuales o causara errores en el PDF y al modal que genera la orden
		$clientesDb['Nombre'],
		$clientesDb['Telefono'],
		$clientesDb['CorreoElectronico'],
		
		$clientesDb['NombrePersonaEntrega'],
		$clientesDb['nom_ent'],$clientesDb['nom_mun'],
		$clientesDb['CodigoPostalEntrega'],$clientesDb['ColoniaEntrega'],$clientesDb['CalleEntrega'],	
		//...Solo hasta aqui aparecen en el PDF, los de abajo se usan en otras vistas respetando la posicion dentro del array comenzando desde el zero, ej $array[0];

		//Contacto de persona que recive
		$clientesDb['TelefonoPersonaEntrega'],
		$clientesDb['CorreoPersonaEntrega'],
		
		//Fecha y hora de entrega
		$clientesDb['FechaEntrega'],
		$clientesDb['HoraEntrega'],
		
		$clientesDb['clave_unica']	//posicion 13
		
		//modal editar orden (ya generada)	- posiciones 14 a 18
		,$clientesDb['Folio_factura'], $clientesDb['id_situacion_ubicacion'], $clientesDb['id_situacion_monetaria'], $clientesDb['RequiereFactura'], $clientesDb['finalizado']

		);
		return $info_array;
	}
}
*/
/******* fin de prueba */



	public static function load_info_for_edit_order($id, $for){		// ...edit_quotation
		//muestra la info actual de una orden antes de ser actualizada

		if(isset($for) && $for=='rentas' || $for=='servicios'){
			$db=DataBase::getConnect();
			# $select=$db->prepare('SELECT * FROM empleados WHERE IdEmpleado=:id');
			$select=$db->prepare('SELECT * FROM orden_'.$for.' WHERE clave_unica=:id');
			$select->bindValue('id',$id);	//ID en realidad es clave_unica
			$select->execute();
			$info=$select->fetch();
			$data = new VentasModel(
				$info['IdOrden'], $info['clave_unica'], $info['Folio_cotizacion'], $info['Folio_orden'], $info['Folio_factura'],
				$info['id_situacion_ubicacion'], $info['id_situacion_monetaria'], $info['IdCliente'], $info['IdCiudad'], 
				$info['CodigoPostalEntrega'], $info['ColoniaEntrega'], $info['CalleEntrega'], $info['NombrePersonaEntrega'], 
				$info['TelefonoPersonaEntrega'], $info['CorreoPersonaEntrega'], $info['RequiereFactura'], $info['correo_enviado'],
				$info['es_orden'], $info['finalizado'], $info['FechaCaptura'], $info['HoraCaptura'], $info['FechaInicio'], $info['FechaTermino'], 
				$info['FechaEntrega'], $info['HoraEntrega'], $info['FechaOrden'], $info['HoraOrden'], $info['FechaFinalizacion'], $info['HoraFinalizacion'], $info['IdSucursal'], 
				$info['IdEmpleado_cotizacion'], $info['IdEmpleado_orden'], $info['IdEmpleado_finalizacion']
			);
			return $data;			
		}
	}
/////////////////////////////////////////
	#by
	/////MODIFICADO POR PAULINA
	///MODO DE PRUEBA PARA TRAER LOS DATOS DE ORDEN
/*	public static function load_info_for_generate_orden($id, $for){		// ...edit_quotation
		//muestra la info actual de una orden antes de ser actualizada

		if(isset($for) && $for=='rentas' || $for=='servicios'){
			$db=DataBase::getConnect();
			# $select=$db->prepare('SELECT * FROM empleados WHERE IdEmpleado=:id');
			$select=$db->prepare('SELECT * FROM orden_'.$for.' WHERE clave_unica=:id AND es_orden="1"');
			$select->bindValue('id',$id);	//ID en realidad es clave_unica
			$select->execute();
			$info=$select->fetch();
			$data = new VentasModel(
				$info['IdOrden'], $info['clave_unica'], $info['Folio_cotizacion'], $info['Folio_orden'], $info['Folio_factura'],
				$info['id_situacion_ubicacion'], $info['id_situacion_monetaria'], $info['IdCliente'], $info['IdCiudad'], 
				$info['CodigoPostalEntrega'], $info['ColoniaEntrega'], $info['CalleEntrega'], $info['NombrePersonaEntrega'], 
				$info['TelefonoPersonaEntrega'], $info['CorreoPersonaEntrega'], $info['RequiereFactura'], $info['correo_enviado'],
				$info['es_orden'], $info['finalizado'], $info['FechaCaptura'], $info['HoraCaptura'], $info['FechaInicio'], $info['FechaTermino'], 
				$info['FechaEntrega'], $info['HoraEntrega'], $info['FechaOrden'], $info['HoraOrden'], $info['FechaFinalizacion'], $info['HoraFinalizacion'], $info['IdSucursal'], 
				$info['IdEmpleado_cotizacion'], $info['IdEmpleado_orden'], $info['IdEmpleado_finalizacion']
			);
			return $data;			
		}
	}*/
	/////////////////////////////

	
	public static function getItemsByCart($id, $for){	//Donde el ID es en realidad la clave_unica
		//Metodo que me permite saber que items pertenecen a una orden
		//Este metodo retorna del carrito los items en la lista para el PDF, y al momento de intentar editar la cotizacion pues muestra los items que tenias desde la primera vez que se guardo

		if(isset($for) && $for=='rentas' || $for=='servicios'){
			include_once("InventarioModel.php");
			include_once("SucursalServicioModel.php");
			$db=DataBase::getConnect();
			$items_list=[];
			////modificado por paulina en modo de prueba
			//$select=$db->prepare('SELECT * FROM _cotizaciones_cart_'.$for.' as carrito, orden_'.$for.' AS ordenes WHERE carrito.clave_unica=ordenes.clave_unica AND ordenes.clave_unica=:id');
			$select=$db->prepare('SELECT * FROM _cotizaciones_cart_'.$for.' as carrito, orden_'.$for.' AS ordenes WHERE carrito.clave_unica=ordenes.clave_unica AND ordenes.clave_unica=:id');

			$select->bindValue('id',$id);
			$select->execute();
			$itemDB=$select->fetchAll();
			
			if($for=='rentas'){
				#rentas
				foreach($itemDB as $item)
				{
					$line_1=InventarioModel::getOnlyBasicInfoForInvoice_line1($item["IdInventarioUnidadesRenta"]);
					$line_2=InventarioModel::getOnlyBasicInfoForInvoice_line2($item["IdInventarioUnidadesRenta"]);
					$items_list[] = array(string_encoder($line_1),string_encoder($line_2),$item["cantidad"],'$'.$item["precio"],'$'.$item["cantidad"]*$item["precio"],$item["IdInventarioUnidadesRenta"],
					/////posicion 6 hasta 8
					//$item["recuperar_cantidad_SucOrigen"],
					//$item["ComentariodeUnidadRecuperada"],
					//$item["id"]
				
					);
					#el ultimo param: $item["IdInventarioUnidadesRenta"] lo agregue para el form del carrito al momento de actualizar
				}
			}
			if($for=='servicios'){
				#servicios
				foreach($itemDB as $item){
				$line_1=SucursalServicioModel::getOnlyBasicInfoForInvoice_line1($item["IdSucursalServicio"]);
				$line_2=SucursalServicioModel::getOnlyBasicInfoForInvoice_line2($item["IdSucursalServicio"]);
					$items_list[] = array(string_encoder($line_1),string_encoder($line_2),$item["cantidad"],'$'.$item["precio"],'$'.$item["cantidad"]*$item["precio"],$item["IdSucursalServicio"]);
							#el ultimo param: $item["IdSucursalServicio"] lo agregue para el form del carrito al momento de actualizar
				}				
			}
			#$items = $items_list;
			return $items_list;
		}
		//ESTE METODO COMBINA VARIAS TABLAS 
	}

	


	///funcion para tomar datos del correo//
	////
	public static function getEmailsByUk($clave_unica, $for){
		//A partir de la clave unica, busco en la tabla de ordenes rentas o servicios
		//Y retorno el los correos y nombres de las personas: Clientes y Persona que recive
		if(isset($for) && $for=='rentas' || $for=='servicios'){
			$db=DataBase::getConnect();
			$info_array=[];
			$select=$db->prepare('SELECT c.IdCliente, c.Nombre, c.CorreoElectronico, q.IdCliente, q.NombrePersonaEntrega, q.CorreoPersonaEntrega FROM clientes as c, orden_'.$for.' as q WHERE clave_unica=:clave_unica AND c.IdCliente=q.IdCliente');
			$select->bindValue('clave_unica',$clave_unica);
			$select->execute();
			$DB=$select->fetch();
			///array de los datos de usuarios y correos
			/// que se enviara el archivo pdf del sistema por un correo
			$info_array = array($DB["Nombre"],$DB["CorreoElectronico"],$DB["NombrePersonaEntrega"],$DB["CorreoPersonaEntrega"],);
			////retorna la variable con los datos
			return $info_array;
		}
	}

//	public static function ge


//======================================================================
// Section: ORDERS
//======================================================================
	public static function generate_order($clave_unica, $for)
	{	
         //covierte a orden (rentas/servicios) la cotizacion insertada en el metodo save_quotation($orden, $for) 	
		if(isset($for))
		{
			
			$db=DataBase::getConnect();

			//SIMILAR A LINEA 547 metodo delete_quotation
			//SE MOVIO A EL METODO UPDATEORDER DEBIDO A QUE SE DISMINUYE DEL INVENTARIOUNIDADESRENTA
			// HASYA QUE SE MARCA LA ORDEN COMO ENTREGADA (ORDENES/RENTAS/EDITAR).	
			
			/*
			if($for=='rentas')
			{
				//IMPORTANTE!!!  =>	 HACER UN METODO SIMILAR PARA CUANDO FINALIZE LA RENTA
				$select=$db->prepare('SELECT * FROM _cotizaciones_cart_rentas WHERE clave_unica = :clave_unica');
				$select->bindValue('clave_unica',$clave_unica);
				$select->execute();
				foreach($select->fetchAll() as $item_cart)
				{
					#1.1. Devolver Stock a inventario (item by item)
					//se actualiza en el updateorde al marcar la orden como etregada
					//InventarioModel::actualizar_stock_por_carrito($item_cart["IdInventarioUnidadesRenta"], $item_cart["cantidad"]);	//AQUI SI SE RESTA CADA ELEMENTO DEL CARRITO AL INVENTARIO CUANDO ES ORDEN
							$discount=$db->prepare("UPDATE _cotizaciones_cart_rentas SET es_orden=1 WHERE clave_unica=:clave_unica ");
							$discount->bindValue('clave_unica', $clave_unica);
							$discount->execute();
							#echo 'ok';
							#Explicacion: cuando se guarda una cotizacion se guarda todo en la tabla del carrito, pero cuando se genera la orden: el rastreador del items se fija por esos productos donde 'es_orden'=1
				}
			}
			*/
			$fecha_orden = date("Y-m-d");
			$hora_orden = date("H:i:s");		
			if(isset($_SESSION["id_employe"]))
			{ 
				$session_employe = $_SESSION["id_employe"]; 
			} 
			else 
			{ 
				$session_employe = null; 
			}

	    	$Id_situacion_ubicacion =0; 
	    	$id_situacion_monetaria = 1; //para ambos casos inicia en 1 es decir, por cobrar  
        	//El valor para este campo al generar la orden  diferente para cuando es orden o es servicio
        	if ($for == "rentas")
        	{	
        		$Id_situacion_ubicacion = 1;
        	}
        	else if ($for == "servicios")
        	{
        		$Id_situacion_ubicacion = 4;
        	}            

			$insert=$db->prepare('UPDATE orden_'.$for.' SET Folio_orden=:Folio_orden, Id_situacion_ubicacion=:Id_situacion_ubicacion, id_situacion_monetaria=:id_situacion_monetaria, es_orden=:es_orden, FechaOrden=:FechaOrden, HoraOrden=:HoraOrden, IdEmpleado_orden=:IdEmpleado_orden WHERE clave_unica=:clave_unica ');				
			$insert->bindValue('Folio_orden', self::asignar_folio($for, 1));	//params: [rentas/servicios] , [0=cotizacion; 1=orden;]
			
			$insert->bindValue('Id_situacion_ubicacion', $Id_situacion_ubicacion);
			$insert->bindValue('id_situacion_monetaria', $id_situacion_monetaria);
			
			$insert->bindValue('es_orden', 1);
			$insert->bindValue('FechaOrden', $fecha_orden);
			$insert->bindValue('HoraOrden', $hora_orden);
			$insert->bindValue('IdEmpleado_orden', $session_employe);
			$insert->bindValue('clave_unica', $clave_unica);
			$insert->execute();
		}
	}

	public static function update_order($clave_unica, $for, $p1,$p2,$p3,$p4,$p5){
		if(isset($for)){
			$db=DataBase::getConnect();
			$insert=$db->prepare('UPDATE orden_'.$for.' SET 
				Folio_factura=:Folio_factura, 
				id_situacion_ubicacion=:id_situacion_ubicacion, 
				id_situacion_monetaria=:id_situacion_monetaria, 
				RequiereFactura=:RequiereFactura, 
				finalizado=:finalizado, 
				FechaFinalizacion=:FechaFinalizacion, 
				HoraFinalizacion=:HoraFinalizacion,
				IdEmpleado_finalizacion=:IdEmpleado_finalizacion
			WHERE clave_unica=:clave_unica ');

			if($p5==1){ //Finalizado
				$fecha_finalizacion = date("Y-m-d");
				$hora_finalizacion = date("H:i:s");
				if(isset($_SESSION["id_employe"])){ $session_employe = $_SESSION["id_employe"]; } else { $session_employe = null; }
			} else {
				$fecha_finalizacion = null;
				$hora_finalizacion = null;
				$session_employe = null;
			}

			$insert->bindValue('Folio_factura', $p1);
			$insert->bindValue('id_situacion_ubicacion', $p2);
			$insert->bindValue('id_situacion_monetaria', $p3);
			$insert->bindValue('RequiereFactura', $p4);
			$insert->bindValue('finalizado', $p5);
			$insert->bindValue('FechaFinalizacion', $fecha_finalizacion);
			$insert->bindValue('HoraFinalizacion', $hora_finalizacion);
			$insert->bindValue('IdEmpleado_finalizacion', $session_employe);	//Por entregar un servicio
			$insert->bindValue('clave_unica', $clave_unica);
			$insert->execute();
		

			if ($p2!=3) //CUANDO ESTA RECUPERADO Y SE MUEVE A POR ENTREGAR(1) O ENTREGADO(2)
			{

				if ($p2==2) //cuando se entrega
				{
				//se disminuye del iventarioUnidadesRenta y se  marca 
				$sql = "UPDATE _cotizaciones_cart_rentas JOIN inventario_unidades_renta ON _cotizaciones_cart_rentas.IdInventarioUnidadesRenta = inventario_unidades_renta.IdInventarioUnidadesRenta SET _cotizaciones_cart_rentas.es_orden = 1, _cotizaciones_cart_rentas.recuperado = 0, Inventario_unidades_renta.cantIdad = Inventario_unidades_renta.cantIdad - _cotizaciones_cart_rentas.cantidad  WHERE  /*_cotizaciones_cart_rentas.recuperado =0 AND*/ _cotizaciones_cart_rentas.clave_unica =:clave_unica";
				$updatex=$db->prepare($sql);
				$updatex->bindValue('clave_unica', $clave_unica);
            	$updatex->execute();
				} 
                /*
				if($for=='rentas')
				{

					//IMPORTANTE!!!  =>	 HACER UN METODO SIMILAR PARA CUANDO FINALIZE LA RENTA
					$select=$db->prepare('SELECT * FROM _cotizaciones_cart_rentas WHERE clave_unica = :clave_unica');
					$select->bindValue('clave_unica',$clave_unica);
					$select->execute();
					foreach($select->fetchAll() as $item_cart)
					{
						#1.1. Devolver Stock a inventario (item by item)
						InventarioModel::actualizar_stock_por_carrito($item_cart["IdInventarioUnidadesRenta"], $item_cart["cantidad"]);	//AQUI SI SE RESTA CADA ELEMENTO DEL CARRITO AL INVENTARIO CUANDO ES ORDEN
							$discount=$db->prepare("UPDATE _cotizaciones_cart_rentas SET es_orden=1 WHERE clave_unica=:clave_unica ");
							$discount->bindValue('clave_unica', $clave_unica);
							$discount->execute();
							#echo 'ok';
							#Explicacion: cuando se guarda una cotizacion se guarda todo en la tabla del carrito, pero cuando se genera la orden: el rastreador del items se fija por esos productos donde 'es_orden'=1
					}//foreach($select->fetchAll() as $item_cart)
				}//$for=='rentas'
				*/
            else
			{ // else if ($p2==2)  

				$sql = "UPDATE _cotizaciones_cart_rentas JOIN inventario_unidades_renta ON _cotizaciones_cart_rentas.IdInventarioUnidadesRenta = inventario_unidades_renta.IdInventarioUnidadesRenta SET _cotizaciones_cart_rentas.es_orden = 0, _cotizaciones_cart_rentas.recuperado = 0, Inventario_unidades_renta.cantIdad = Inventario_unidades_renta.cantIdad + _cotizaciones_cart_rentas.cantidad  WHERE /*_cotizaciones_cart_rentas.recuperado =1 AND */_cotizaciones_cart_rentas.clave_unica =:clave_unica";
				$updatex=$db->prepare($sql);
				$updatex->bindValue('clave_unica', $clave_unica);
            	$updatex->execute();


			} 
	      }                 
		else if ($p2==3) //CUANDO SE RECUPERA
		{

				$sql = "UPDATE _cotizaciones_cart_rentas JOIN inventario_unidades_renta ON _cotizaciones_cart_rentas.IdInventarioUnidadesRenta = inventario_unidades_renta.IdInventarioUnidadesRenta SET _cotizaciones_cart_rentas.recuperado = 1, Inventario_unidades_renta.cantIdad = Inventario_unidades_renta.cantIdad + _cotizaciones_cart_rentas.cantidad  WHERE _cotizaciones_cart_rentas.recuperado =0 AND _cotizaciones_cart_rentas.clave_unica =:clave_unica";
				$updatex=$db->prepare($sql);
				$updatex->bindValue('clave_unica', $clave_unica);
            	$updatex->execute();

				    
			}
		}


	}
	
	/* situacion: monetaria y ubicacion */
	public static function __situacion($tipo_actividad, $tipo_situacion){	#params: ({rentas/servicios}, {ubicacion/monetaria})
		$db=DataBase::getConnect();
		$listaSituaciones=[];
		#$select=$db->query('SELECT * FROM c_ciudades order by Id_ciudad');
		
		$monetaria = 'SELECT * FROM c_situacion_monetaria';
		$ubicacion = 'SELECT * FROM c_situacion_ubicacion_actividades as act, c_situacion_ubicacion as u WHERE act.id_c_situacion_ubicacion_actividades = u.id_c_situacion_ubicacion_actividades AND act.tipo_actividad LIKE "%'.$tipo_actividad.'%" ';

		if($tipo_situacion == 'monetaria'){
			$sql_situacion = $monetaria;
		}
		if($tipo_situacion == 'ubicacion'){
			$sql_situacion = $ubicacion;
		}

		$select=$db->query($sql_situacion);
		foreach($select->fetchAll() as $s){
			#$listaCiudades[]=new CiudadesModel($roles['Id_ciudad'],$roles['Ciudad'],$roles['IdEstado']);
			$listaSituaciones[]= array($s['id_situacion_'.$tipo_situacion], $s['Descripcion']);
		}
		return $listaSituaciones;
	}
	
	public static function __situacion_string($tipo_actividad, $tipo_situacion, $id){
		#similar al metodo de arriba pero este concatena en forma de cadena para mostrar en datatables, mientras que el de arriba es un array para desplegar los combobox
		$db=DataBase::getConnect();


		$monetaria = 'SELECT * FROM c_situacion_monetaria WHERE id_situacion_'.$tipo_situacion.'= "'.$id.'"';
		$ubicacion = 'SELECT * FROM c_situacion_ubicacion_actividades as act, c_situacion_ubicacion as u WHERE act.id_c_situacion_ubicacion_actividades = u.id_c_situacion_ubicacion_actividades AND act.tipo_actividad LIKE "%'.$tipo_actividad.'%" AND id_situacion_'.$tipo_situacion.'= "'.$id.'"';

		if($tipo_situacion == 'monetaria'){
			$sql_situacion = $monetaria;
		}
		if($tipo_situacion == 'ubicacion'){
			$sql_situacion = $ubicacion;
		}
		$select=$db->prepare($sql_situacion);
		$select->execute();
		$result=$select->fetch();
		return $result['Descripcion'];
	}


//======================================================================
// Section: FOLIOS
//======================================================================

public static function get_IdOrden_cotizacion_ByDateAndSuc($date, $id_suc, $col, $for_operation, $estatus){ 
    //$for_operation [rentas/servicios]
	//$estatus  [0=Cotizacion / 1=orden]

	//fecha, id_suc, columna, estatus
		$db=DataBase::getConnect();


#		$select=$db->prepare('CALL get_IdOrden_cotizacion_ByDateAndSuc(:date,:id_suc,:for_operation,:estatus)');
#el procedimiento esta mal, ...corregir, mientras el equivalente del procedure es el siguiente:
$sql_prepare = '';
	if($for_operation=='rentas'){
		/// estatus: cero es cotizacion y uno es orden
		//Cotizaciones
		if($estatus==0){
			$sql_prepare = 'SELECT max(IdOrden) as IdOrden, Folio_cotizacion, FechaCaptura, IdSucursal FROM orden_rentas WHERE FechaCaptura = :date AND IdSucursal=:IdSucursal GROUP BY Folio_cotizacion ORDER BY IdOrden DESC';
		}
		//ordenes 
		if($estatus==1){
			#$sql_prepare = 'SELECT max(IdOrden) as IdOrden, Folio_orden, FechaOrden, IdSucursal FROM orden_rentas WHERE FechaOrden = :date AND IdSucursal=:IdSucursal AND Folio_orden!="" GROUP BY Folio_orden';
			$sql_prepare = 'SELECT * FROM ( SELECT IdOrden, Folio_orden, FechaOrden, IdSucursal FROM orden_rentas WHERE FechaOrden = :date AND IdSucursal=:IdSucursal AND Folio_orden!="" ORDER BY IdOrden DESC LIMIT 1) AS tabla GROUP BY Folio_orden';
		}
	}

	if($for_operation=='servicios'){
		//cotizacion de servicios
		if($estatus==0)
		{
			/*
			$sql_prepare = 'SELECT max(IdOrden) as IdOrden, Folio_cotizacion, FechaCaptura, IdSucursal FROM orden_servicios WHERE FechaCaptura =:date AND IdSucursal=:IdSucursal GROUP BY Folio_orden ORDER BY IdOrden DESC';
			*/

			$sql_prepare = 'SELECT max(IdOrden) as IdOrden, Folio_cotizacion, FechaCaptura, IdSucursal FROM orden_servicios WHERE FechaCaptura =:date AND IdSucursal=:IdSucursal GROUP BY Folio_cotizacion ORDER BY IdOrden DESC';

		}
		//orden de servicios
		if($estatus==1){
			#$sql_prepare = 'SELECT max(IdOrden) as IdOrden, Folio_cotizacion, FechaOrden, IdSucursal FROM orden_servicios WHERE FechaOrden =:date AND IdSucursal=:IdSucursal AND Folio_orden!="" GROUP BY Folio_orden';
			$sql_prepare = 'SELECT * FROM ( SELECT IdOrden, Folio_orden, FechaOrden, IdSucursal FROM orden_servicios WHERE FechaOrden = :date AND IdSucursal=:IdSucursal AND Folio_orden!="" ORDER BY IdOrden DESC LIMIT 1) AS tabla GROUP BY Folio_orden';
		}
	}

		$select=$db->prepare($sql_prepare);
		$select->bindValue('date',$date);
		$select->bindValue('IdSucursal',$id_suc);
#		$select->bindValue('for_operation',$for_operation);
#		$select->bindValue('estatus',$estatus);
		$select->execute();
		$sucursalesDB=$select->fetch();

		if($estatus==0){
			//valor de la col que necesitamos
			if(isset($col)){
				return $sucursalesDB[$col];
			} else if (is_null($col)){	//Por Default retorna una cadena;
				return $sucursalesDB['IdOrden'].' - '.$sucursalesDB['Folio_cotizacion'].' - '.$sucursalesDB['FechaCaptura'].' - '.$sucursalesDB['IdSucursal'];	//Para mostrar en empleados, no se si se ocupe uno igual para
			}
		} 
		if($estatus==1){
			//valor de la col que necesitamos
			if(isset($col))
			{
				return $sucursalesDB[$col];
			} else if (is_null($col)){	//Por Default retorna una cadena;
				return $sucursalesDB['IdOrden'].' - '.$sucursalesDB['Folio_orden'].' - '.$sucursalesDB['FechaOrden'].' - '.$sucursalesDB['IdSucursal'];	//Para mostrar en empleados, no se si se ocupe uno igual para
			}
		}
	}
	
	public static function asignar_folio($for_operation, $estatus){
		//params: [rentas/servicios] , [0=cotizacion; 1=orden;]
		$curdate = date("Y-m-d");
		$id_suc = "";
		if(isset($_SESSION["id_sucursal"])){ $id_suc = $_SESSION["id_sucursal"]; }
		$id_orden = self::get_IdOrden_cotizacion_ByDateAndSuc($curdate, $id_suc, 'IdOrden', 			$for_operation, $estatus);
		#$folio_cotizacion	= self::get_IdOrden_cotizacion_ByDateAndSuc($curdate, $id_suc, 'Folio_cotizacion', 	$for_operation, $estatus);
		#$folio_orden		= self::get_IdOrden_cotizacion_ByDateAndSuc($curdate, $id_suc, 'Folio_orden',		$for_operation, $estatus);
		
		$which_folio = '';
		//si es cotizacion
		if($estatus==0){ 
			$which_folio = self::get_IdOrden_cotizacion_ByDateAndSuc($curdate, $id_suc, 'Folio_cotizacion', 	$for_operation, $estatus);
			#$folio_cotizacion; 
		//si es una orden
		} if($estatus==1){ 
			$which_folio = self::get_IdOrden_cotizacion_ByDateAndSuc($curdate, $id_suc, 'Folio_orden',		$for_operation, $estatus);
			#$folio_orden; 
		}

		$ai = '';
		if(empty($id_orden)){
			$ai = 1;	//SI este dia no hay folio, el auto incremento comienza en 1.
			$ai = str_pad($ai, 3, "0", STR_PAD_LEFT);	//Rellenar con ZEROs a la izquierda. (Forzozamente son 3 digitos)
		} else //si ya existe un folio
			{            
				$ai = substr($which_folio, -3);	//antes: folio_cotizacion.. ahora deja que decida segun $estatus (cotizacion u orden)			
				$ai = $ai + 1;
				//echo 'se hace folio'.$ai;			
				$ai = str_pad($ai, 3, "0", STR_PAD_LEFT);	//Rellenar con ZEROs a la izquierda
		}
		
		$l = '';
		//si es cotizacion
		if($estatus==0)
			{ 
				$l .= 'C'; 
			} 
			//si es una orden
			else if($estatus==1)
			{ 
				$l .= 'O'; 
			}

		if($for_operation=='rentas')
			{ $l .= 'R'; } 
		else if($for_operation=='servicios')
		{ 
			$l .= 'S'; 
		}

		//Estructura del folio
		$folio  = "";
		//Se obtiene la letra de la sucursal y se concatena a al tipo de cotizacion 
		$folio .= SucursalesModel::getLetraSucursalParaFolio($id_suc).$l."_";
		$folio .= date("dmY");
		//se concatenan los ultimos tres digitos
		$folio .= "_".$ai;

		return $folio;
	}
	
	public static function getFolioByClaveUnica($clave_unica, $for){
		//A partir de la clave unica, busco en la tabla de ordenes rentas o servicios
		//Y retorno el folio
		if(isset($for) && $for=='rentas' || $for=='servicios'){
			//este metodo es para PDF.. existe un metodo similar en ClientesModel pero son muy distintos
			$db=DataBase::getConnect();
			$info_array=[];
			$select=$db->prepare('SELECT Folio_cotizacion, Folio_orden, Folio_factura FROM orden_'.$for.' WHERE clave_unica=:clave_unica ');
			$select->bindValue('clave_unica',$clave_unica);
			$select->execute();
			$FolioDB=$select->fetch();
			if(isset($FolioDB["Folio_orden"])){
				return $FolioDB["Folio_orden"];
			} else if(empty($_["Folio_orden"])){
				return $FolioDB["Folio_cotizacion"];				
			}
		}
	}

	public static function getFolioByClaveUnicaForInvoice($clave_unica, $for){
		#La unica diferencia con el metodo de arriba, es que este es para el PDF, y trae un texto extra que indica si es para cotizacion o para orden
		#Y el de arriba es para mostrar el folio en el array de all_json para datatables
		if(isset($for) && $for=='rentas' || $for=='servicios'){
			//este metodo es para PDF.. existe un metodo similar en ClientesModel pero son muy distintos
			$db=DataBase::getConnect();
			$info_array=[];
			$select=$db->prepare('SELECT Folio_cotizacion, Folio_orden, Folio_factura FROM orden_'.$for.' WHERE clave_unica=:clave_unica ');
			$select->bindValue('clave_unica',$clave_unica);
			$select->execute();
			$FolioDB=$select->fetch();
			if(isset($FolioDB["Folio_orden"])){
				return "<b>Folio orden: </b>".$FolioDB["Folio_orden"];
			} else if(empty($_["Folio_orden"])){
				return "<b>Folio cotizaci&oacute;n: </b>".$FolioDB["Folio_cotizacion"];				
			}
		}
	}

//======================================================================
// Section: CART
//Es el detalle de la orden_servicio o de la orden_Renta
//======================================================================

	public static function save_cart($id, $qty, $price, $clave_unica, $for){
		$db=DataBase::getConnect();

		#1. Guardamos los productos de la cotizacion (los datos de cotizacion fueron guardados con el metodo "save" de arriba)
		$query = '';
		if($for == "rentas"){
			
			#2. Restamos el stock del inventario, solo aplica en rentas, porque servicios no cuenta con inventario (los stocks de servicios son "infinitos" )
			#InventarioModel::actualizar_stock_por_carrito($id, $qty);	//SI ES COTIZACION NO SE RESTA, HASTA QUE SE CONVIERTA EN ORDEN

			$query = 'INSERT INTO _cotizaciones_cart_rentas (IdInventarioUnidadesRenta, cantidad, precio, clave_unica) VALUES(:IdInventarioUnidadesRenta, :cantidad, :precio, :clave_unica)';
		} else if($for == "servicios"){
			$query = 'INSERT INTO _cotizaciones_cart_servicios (IdSucursalServicio, cantidad, precio, clave_unica) VALUES(:IdInventarioUnidadesRenta, :cantidad, :precio, :clave_unica)';
		}

		$insert=$db->prepare($query);
		# $insert->bindValue('IdOrden',1);	//ID de la cotizacion/orden...	#Obsoleta, remplazada por "clave_unica"
		$insert->bindValue('IdInventarioUnidadesRenta',$id);	//ID del articulo en el carrito
		$insert->bindValue('cantidad',$qty);
		$insert->bindValue('precio',$price);
		$insert->bindValue('clave_unica',$clave_unica);	//Remplaza al ID de Orden, porque La Orden debe tener la misma llave y debe coincidir para que una orden sepa que items le corresponden
		$insert->execute();
	}

	public static function if_item_on_cart($clave_unica, $id_inventario){
		$db=DataBase::getConnect();
		$select=$db->prepare("SELECT cantidad FROM _cotizaciones_cart_rentas WHERE clave_unica=:clave_unica AND IdInventarioUnidadesRenta=:id_inventario");
		$select->bindValue('clave_unica',$clave_unica);
		$select->bindValue('id_inventario',$id_inventario);
		$select->execute();
		$total=$select->fetch();
		return $total["cantidad"];
	}
	
	public static function update_cart($id, $qty, $price, $clave_unica, $for){
		
		/* 
			SI LOS PARAMETROS ESTAN VACIOS, ES PORQUE SE ELIMINARON DEL CARRITO
			entonces haces un delete de todo lo que tenga la clave_unica
		*/
		
		
		if($for=='rentas'){
			#1. Revisa la clave unica y ve si el $id (del inventario) esta en el carrito
			#$stock_on_cart = self::if_item_on_cart($clave_unica, $id);	//Se necesita la clave unica por si el mismo item del inventario esta en 2 o mas cotizaciones diferentes
			
			#2. Si hay items del inventario...
			if($stock_on_cart > 0){
				#2.1 Devolver al inventario
				#InventarioModel::return_stock($id, $stock_on_cart);	//YA NO SE RESTA porque es cotizacion
			} else {
				#No hacer nada
			}

			#2.2 Hasta este momento el inventario recupero lo que tenia, Entonces...
			#3. En el inventario: le retiramos la nueva cantidad "corregida"
			//Aqui hacemos un PDO tipo UPDATE SET
			//Y $tipo_actualizacion en realidad no se ocupa
			
			#InventarioModel::actualizar_stock_por_carrito($id, $qty);	//SI ES COTIZACION NO SE RESTA, HASTA QUE SE CONVIERTA EN ORDEN
			#LLAMARE EL METODO (Linea anterior hasta que se convieta en orden)
			
			
			#4. En el carrito: Actualizamos la nueva cantidad
			$db=DataBase::getConnect();
			$update=$db->prepare('UPDATE _cotizaciones_cart_rentas SET cantidad = :qty WHERE IdInventarioUnidadesRenta = :IdInventarioUnidadesRenta AND clave_unica = :clave_unica ');
			#$update->bindValue('cantidad',$inventario->getCantidad());
			$update->bindValue('qty',$qty);
			$update->bindValue('IdInventarioUnidadesRenta',$id);
			$update->bindValue('clave_unica',$clave_unica);
			$update->execute();
			
			#LISTO!
			
			//BUG!! => "Al actualizar el carrito, no reconoce cuales items fueron borraron",
			//Debo poner un form con input invisible que separando por commas me diga cuales IDs se han quitado de la lista
			//Y para cada uno de esos IDs llamar a un metodo (por crear "delete_item_on_update_cart") para borrar... [Verificar si esto fue corregido, si es asi borrar estas 3 lineas de comentarios]
		}
		
		if($for=='servicios'){
			$db=DataBase::getConnect();
			$update=$db->prepare('UPDATE _cotizaciones_cart_servicios SET cantidad = :qty WHERE IdSucursalServicio = :IdInventarioUnidadesRenta AND clave_unica = :clave_unica ');
			#$update->bindValue('cantidad',$inventario->getCantidad());
			$update->bindValue('qty',$qty);
			$update->bindValue('IdInventarioUnidadesRenta',$id);
			$update->bindValue('clave_unica',$clave_unica);
			$update->execute();
		}
	}

	#REALIZADO POR PAULINA:
	/////FUNCION PARA ACTUALIZAR LOS DATOS DEL ORDEN PARA LA RECUPERACION EN EL CARRITO 
	/////// PARAMETROS: idInventarioUnidadRenta,idSucursal,cantidadRecuperada,ComentarioRecu,ClaveUnica,[servicio/rentas]
	public static function update_cart_recuperado($id,$recSucursal, $cantRec, $comentario, $clave_unica, $for){
		
		/* 
			SI LOS PARAMETROS ESTAN VACIOS, ES PORQUE SE ELIMINARON DEL CARRITO
			entonces haces un delete de todo lo que tenga la clave_unica
		*/	
		//if($for=='rentas')
		//{
			#1. Revisa la clave unica y ve si el $id (del inventario) esta en el carrito
			#$stock_on_cart = self::if_item_on_cart($clave_unica, $id);	//Se necesita la clave unica por si el mismo item del inventario esta en 2 o mas cotizaciones diferentes
			
			#2. Si hay items del inventario...
			//if($stock_on_cart > 0)
			//{
				#2.1 Devolver al inventario
				#InventarioModel::return_stock($id, $stock_on_cart);	//YA NO SE RESTA porque es cotizacion
			//} else 
			//{
				#No hacer nada
			//}

			#2.2 Hasta este momento el inventario recupero lo que tenia, Entonces...
			#3. En el inventario: le retiramos la nueva cantidad "corregida"
			//Aqui hacemos un PDO tipo UPDATE SET
			//Y $tipo_actualizacion en realidad no se ocupa
			
			#InventarioModel::actualizar_stock_por_carrito($id, $qty);	//SI ES COTIZACION NO SE RESTA, HASTA QUE SE CONVIERTA EN ORDEN
			#LLAMARE EL METODO (Linea anterior hasta que se convieta en orden)
			
			
			#4. En el carrito: Actualizamos la nueva cantidad
			$db=DataBase::getConnect();
			$update=$db->prepare("UPDATE _cotizaciones_cart_rentas SET recuperado = 1, recuperar_cantidad_SucOrigen = :recuperar_cantidad_SucOrigen,
			    recuperar_restante_a_IdSucursal = :recuperar_restante_a_IdSucursal,
			     ComentariodeUnidadRecuperada = :ComentariodeUnidadRecuperada WHERE  /*clave_unica = :clave_unica AND*/ id=:id");
			#$update->bindValue('cantidad',$inventario->getCantidad());
			$update->bindValue('id',$id);///id de la tabla _cotizacion_cart_rentas
			$update->bindValue('recuperar_cantidad_SucOrigen',$cantRec);
			$update->bindValue('recuperar_restante_a_IdSucursal', $recSucursal);
			$update->bindValue('ComentariodeUnidadRecuperada', $comentario);
			//$update->bindValue('IdInventarioUnidadesRenta',$id);
			//$update->bindValue('clave_unica',$clave_unica);
			$update->execute();


			/////REGRESAR LOS DATOS AL STOCK CUANDO SE RECUPERE LA CANTIDAD DEL ORDEN 
			/*$select=$db->prepare('SELECT * FROM _cotizaciones_cart_rentas WHERE clave_unica = :clave_unica');
				$select->bindValue('clave_unica',$clave_unica);
				$select->execute();
			foreach($select->fetchAll() as $item_cart){
				#1.1. Devolver Stock a inventario (item by item)
				InventarioModel::actualizar_stock_por_carrito_Recuperado($item_cart["IdInventarioUnidadesRenta"], $item_cart["recuperar_cantidad_SucOrigen"]);	//AQUI SI SE RESTA CADA ELEMENTO DEL CARRITO AL INVENTARIO CUANDO ES RECUPERADO

					
			}*/
			#LISTO!
			
			//BUG!! => "Al actualizar el carrito, no reconoce cuales items fueron borraron",
			//Debo poner un form con input invisible que separando por commas me diga cuales IDs se han quitado de la lista
			//Y para cada uno de esos IDs llamar a un metodo (por crear "delete_item_on_update_cart") para borrar... [Verificar si esto fue corregido, si es asi borrar estas 3 lineas de comentarios]
		//}
		
	}

	public static function update_situacion($clave_unica, $for){
					
			#4. En el carrito: Actualizamos la nueva cantidad
		if($for=='rentas'){	
			$db=DataBase::getConnect();
			$update=$db->prepare("UPDATE _cotizaciones_cart_'.$for.' SET recuperado = 1 WHERE  clave_unica = :clave_unica");
			#$update->bindValue('cantidad',$inventario->getCantidad());
			//$update->bindValue('id',$id);///id de la tabla _cotizacion_cart_rentas
			#$update->bindValue('recuperar_cantidad_SucOrigen',$cantRec);
			#$update->bindValue('recuperar_restante_a_IdSucursal', $recSucursal);
			#$update->bindValue('ComentariodeUnidadRecuperada', $comentario);
			//$update->bindValue('IdInventarioUnidadesRenta',$id);
			$update->bindValue('clave_unica',$clave_unica);
			$update->execute();
		}

			/////REGRESAR LOS DATOS AL STOCK CUANDO SE RECUPERE LA CANTIDAD DEL ORDEN 
			/*$select=$db->prepare('SELECT * FROM _cotizaciones_cart_rentas WHERE clave_unica = :clave_unica');
				$select->bindValue('clave_unica',$clave_unica);
				$select->execute();
			foreach($select->fetchAll() as $item_cart){
				#1.1. Devolver Stock a inventario (item by item)
				InventarioModel::actualizar_stock_por_carrito_Recuperado($item_cart["IdInventarioUnidadesRenta"], $item_cart["recuperar_cantidad_SucOrigen"]);	//AQUI SI SE RESTA CADA ELEMENTO DEL CARRITO AL INVENTARIO CUANDO ES RECUPERADO

					
			}*/	
			#LISTO!
			
			//BUG!! => "Al actualizar el carrito, no reconoce cuales items fueron borraron",
			//Debo poner un form con input invisible que separando por commas me diga cuales IDs se han quitado de la lista
			//Y para cada uno de esos IDs llamar a un metodo (por crear "delete_item_on_update_cart") para borrar... [Verificar si esto fue corregido, si es asi borrar estas 3 lineas de comentarios]
		//}
		
	}

	public static function delete_items_on_update_cart($item_id, $clave_unica, $for){
		$db=DataBase::getConnect();
		if($for=='rentas'){
			$sql = 'DELETE FROM _cotizaciones_cart_rentas WHERE clave_unica="'.$clave_unica.'" AND IdInventarioUnidadesRenta="'.$item_id.'"';
		}
		if($for=='servicios'){
			$sql = 'DELETE FROM _cotizaciones_cart_servicios WHERE clave_unica="'.$clave_unica.'" AND IdSucursalServicio="'.$item_id.'"';
		}
		$update=$db->prepare($sql);
		$update->execute();
	}

	public static function NoRecuperado($id){
		$db=DataBase::getConnect();
		//Cuando haces una cotizacion esta tabla es el carrito y si se realiza la orden, debe salir del inventario por lo tanto se resta del stock
#		$select=$db->prepare('SELECT COUNT(IdInventarioUnidadesRenta) As total_no_disponible FROM _cotizaciones_cart WHERE recuperado = 0 AND IdInventarioUnidadesRenta=:id');
		$select=$db->prepare('SELECT SUM(cantidad) AS total_no_disponible FROM _cotizaciones_cart_rentas WHERE recuperado = 0 AND IdInventarioUnidadesRenta=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$result=$select->fetch();
		$recuperado = $result['total_no_disponible'];
		if(empty($recuperado)){ $recuperado = 0; }
		return $recuperado;
	}

	public static function Cotizado($id){ //Recive IdInventarioUnidadesRenta\ ...quiza no sea el nombre apropiado para este metodo, pero me ayuda con el inventario
		#si el campo es_orden = 1 ya esta en renta por lo tanto si se cuenta en el rastreador del inventario para saber si se ha rentado pero si esta en 0 es porque no se ha rentado pero esta en el carrito porque solo se ha cotizado
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT SUM(cantidad) AS total_no_es_orden FROM _cotizaciones_cart_rentas WHERE es_orden = 1 AND recuperado=0 AND IdInventarioUnidadesRenta=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$result=$select->fetch();
		$cotizado = $result['total_no_es_orden'];
		if(empty($cotizado) || is_null($cotizado)){ $cotizado = 0; } else if($cotizado==1) { $cotizado = 1; }
		return $cotizado;
	}
	
	public static function check_if_is_order($clave_unica){	//recibe clave_unica
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT es_orden FROM orden_rentas WHERE clave_unica=:clave_unica');
		$select->bindValue('clave_unica',$clave_unica);
		$select->execute();
		$result=$select->fetch();
		return $result['es_orden'];
	}

//======================================================================
// Section: STOCK RECOVERY
//======================================================================
	/***-------by */
	public static function choferes_asignados($clave_unica){
		$db=DataBase::getConnect();

		$array = [];
		#Este metodo solo sirve para ver los choferes que ya han sido asignado a una clave unica 
		$select=$db->prepare('SELECT * FROM choferes_entregan WHERE clave_unica=:clave_unica');
		$select->bindValue('clave_unica',$clave_unica);
		$select->execute();
		foreach($select->fetchAll() as $i){
			$array[]= $i['id_chofer']; /* array(array("id"=>$i['id'],"uk"=>$i['clave_unica'],"id_chofer"=>$i['id_chofer'])); */
		}
		return $array;
	}
	#by
////Funcion creado por paulina 
	public static function choferes_asig_recuperan($clave_unica){
		$db=DataBase::getConnect();

		$array = [];
		#Este metodo solo sirve para ver los choferes que ya han sido asignado a una clave unica 
		$select=$db->prepare('SELECT * FROM choferes_recuperan WHERE clave_unica=:clave_unica');
		$select->bindValue('clave_unica',$clave_unica);
		$select->execute();
		foreach($select->fetchAll() as $i){
			$array[]= $i['id_chofer']; /* array(array("id"=>$i['id'],"uk"=>$i['clave_unica'],"id_chofer"=>$i['id_chofer'])); */
		}
		return $array;
	}




	public static function update_choferes($array_operativo, $clave_unica){	//Este metodo es casi igual al de actualizar los items de un shop cart, solo que este trabaja con un array
		$db=DataBase::getConnect();

		#AQUI NO IMPORTA CONONCER SI ES PARA UNA RENTA O PARA UN SERVICIO, pues, SI LA CLAVE UNICA COINCIDE, OK, sino,... no afecta!!!

		if(is_null($array_operativo)){
			//si el array que contiene los IDs de todos los empleados, viene VACIA (debido a que eliminaron, obviamente), entonces borramos todos
			$clean=$db->prepare('DELETE FROM choferes_entregan WHERE clave_unica=:clave_unica');
			$clean->bindValue('clave_unica',$clave_unica);
			$clean->execute();
		} else { 
			#1. Primero Borramos todos los choferes que correspondan a esa entrega, esto debido a cada vez que se actualice la lista referidos por clave_unica
			$clean=$db->prepare('DELETE FROM choferes_entregan WHERE clave_unica=:clave_unica');
			$clean->bindValue('clave_unica',$clave_unica);
			$clean->execute();

			#2. Asignamos los choferes
			foreach($array_operativo as $id_chofer){	//del array con la lista de choferes, inserta a persona por persona
				$sql3 = "INSERT INTO choferes_entregan (clave_unica, id_chofer) VALUES ('".$_GET['clave_unica']."', '".$id_chofer."')";
				$stmt3 = $db->prepare($sql3);
				$stmt3->execute();
			}
		}
	}

/////funcion creado por paulina 
/////// para la asignacion de choferes por recuperar
public static function update_choferes_recuperan($array_operativo, $clave_unica){	//Este metodo es casi igual al de actualizar los items de un shop cart, solo que este trabaja con un array
	$db=DataBase::getConnect();

	#AQUI NO IMPORTA CONONCER SI ES PARA UNA RENTA O PARA UN SERVICIO, pues, SI LA CLAVE UNICA COINCIDE, OK, sino,... no afecta!!!

	if(is_null($array_operativo)){
		//si el array que contiene los IDs de todos los empleados, viene VACIA (debido a que eliminaron, obviamente), entonces borramos todos
		$clean=$db->prepare('DELETE FROM choferes_recuperan WHERE clave_unica=:clave_unica');
		$clean->bindValue('clave_unica',$clave_unica);
		$clean->execute();
	} else { 
		#1. Primero Borramos todos los choferes que correspondan a esa entrega, esto debido a cada vez que se actualice la lista referidos por clave_unica
		$clean=$db->prepare('DELETE FROM choferes_recuperan WHERE clave_unica=:clave_unica');
		$clean->bindValue('clave_unica',$clave_unica);
		$clean->execute();

		#2. Asignamos los choferes
		foreach($array_operativo as $id_chofer){	//del array con la lista de choferes, inserta a persona por persona
			$sql3 = "INSERT INTO choferes_recuperan (clave_unica, id_chofer) VALUES ('".$_GET['clave_unica']."', '".$id_chofer."')";
			$stmt3 = $db->prepare($sql3);
			$stmt3->execute();
		}
	}
}


	public static function update_stock_inventory_on_recovery(){
		//AQUI SI IMPORTA SABER SI ES PARA UNA RENTA O UN SERVICIO
		//Aqui actualizamos los carritos segun sea rentas o servicios para indicar que se ha recuperado el item a X sucursal (donde recuperado=1)
		//posteriormente llamamaos a un metodo del modelo del inventario y le devolvemos el stock a dicho item
	}
	
}
?>