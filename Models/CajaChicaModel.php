<?php 

class CajaChicaModel {

	private $IdCajaChica;
	private $IdSucursal;
	private $IdTipoMovimiento;
	private $Descripcion;
	private $Monto;
	private $IdEmpleado;
	private $Fecha;
	private $Folio;

	function __construct($IdCajaChica, $IdSucursal,$IdTipoMovimiento,$Descripcion,$Monto,$IdEmpleado,$Fecha,$Folio){
		$this->setIdCajaChica($IdCajaChica);
		$this->setIdSucursal($IdSucursal);
		$this->setIdTipoMovimiento($IdTipoMovimiento);
		$this->setDescripcion($Descripcion);
		$this->setMonto($Monto);
		$this->setIdEmpleado($IdEmpleado);
		$this->setFecha($Fecha);
		$this->setFolio($Folio);
	}

	public function getIdCajaChica(){
		return $this->IdCajaChica;
	}

	public function setIdCajaChica($IdCajaChica){
		$this->IdCajaChica = $IdCajaChica;
	}

	public function getIdSucursal(){
		return $this->IdSucursal;
	}

	public function setIdSucursal($IdSucursal){
		$this->IdSucursal = $IdSucursal;
	}

	public function getIdTipoMovimiento(){
		return $this->IdTipoMovimiento;
	}

	public function setIdTipoMovimiento($IdTipoMovimiento){
		$this->IdTipoMovimiento = $IdTipoMovimiento;
	}

	public function getDescripcion(){
		return $this->Descripcion;
	}

	public function setDescripcion($Descripcion){
		$this->Descripcion = $Descripcion;
	}

	public function getMonto(){
		return $this->Monto;
	}

	public function setMonto($Monto){
		$this->Monto = $Monto;
	}

	public function getIdEmpleado(){
		return $this->IdEmpleado;
	}

	public function setIdEmpleado($IdEmpleado){
		$this->IdEmpleado = $IdEmpleado;
	}

	public function getFecha(){
		return $this->Fecha;
	}

	public function setFecha($Fecha){
		$this-> Fecha = $Fecha;
	}

   public function getFolio(){
		return $this->Folio;
	}

	public function setFolio($Folio){
		$this-> Folio = $Folio;
	}


//======================================================================
// Section: FOLIOS
//======================================================================
public static function get_IdOrden_cotizacion_ByDateAndSuc($date, $id_suc)
{ 
       //jlopezl
	  //Caja chica
		$db=DataBase::getConnect();
		$sql_prepare = '';
	  	$sql_prepare = 'SELECT max(IdCajaChica) as IdCajaChica, Folio, Fecha, IdSucursal 
	  	FROM caja_chica WHERE Fecha = :date AND IdSucursal=:IdSucursal GROUP BY Folio ORDER BY IdCajaChica DESC';
// WHERE FechaCaptura = :date AND IdSucursal=:IdSucursal
		$select=$db->prepare($sql_prepare);
		$select->bindValue('date',$date);
		$select->bindValue('IdSucursal',$id_suc);
		$select->execute();
		$sucursalesDB=$select->fetch();
        //return $sucursalesDB['IdCajaChica'].' - '.$sucursalesDB['Folio'].' - '.$sucursalesDB['Fecha'].' - '.$sucursalesDB['IdSucursal'];
		return $sucursalesDB['Folio'];

}

/* inicia lo de generar folio*/
public static function asignar_folio($IdTipoMovimiento, $id_suc){
		//params: [rentas/servicios] , [0=cotizacion; 1=orden;]
		$curdate = date("Y-m-d");
		//$id_suc = "";

		/*
		if(isset($_SESSION["id_sucursal"]))
		{ 
			$id_suc = $_SESSION["id_sucursal"]; 
		}
		*/

		$IdCajaChica = self::get_IdOrden_cotizacion_ByDateAndSuc($curdate, $id_suc);		
		
		$which_folio = '';
		$which_folio = self::get_IdOrden_cotizacion_ByDateAndSuc($curdate, $id_suc);

		$ai = '';
		if(empty($IdCajaChica))
		{
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


		//Tipodemovimiento
		//1 DEPOSITO
		//2 RETIRO
       if($IdTipoMovimiento==1)
		{ 
			$l .= 'D'; 
		} 
       else if($IdTipoMovimiento==2)
		{ 
			$l .= 'R'; 
		}

		//Estructura del folio
		$folio  = "";
		//Se obtiene la letra de la sucursal y se concatena a al tipo de movimiento 
		$folio .= SucursalesModel::getLetraSucursalParaFolio($id_suc).$l."_";
		$folio .= date("dmY");
		//se concatenan los ultimos tres digitos
		$folio .= "_".$ai;

		return $folio;
		//return $IdCajaChica;		
	}
/* termina lo de generar folio*/


	public static function save($caja){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		
		$cantidad = number_format($caja->getMonto(), 2, '.', '');        
		$asignar_folio = self::asignar_folio($caja->getIdTipoMovimiento(), $caja->getIdSucursal()); 

		$insert=$db->prepare('CALL add_cajachica(:IdSucursal,:IdTipoMovimiento,:Descripcion,:Monto,:IdEmpleado,:Fecha,:Folio)');
//		$insert->bindValue('IdCajaChica',$caja->getIdCajaChica());
		$insert->bindValue('IdSucursal',$caja->getIdSucursal());
		$insert->bindValue('IdTipoMovimiento',$caja->getIdTipoMovimiento());
		$insert->bindValue('Descripcion',$caja->getDescripcion());
		$insert->bindValue('Monto', $cantidad);
		$insert->bindValue('IdEmpleado', $caja->getIdEmpleado());	//session temporal
		$insert->bindValue('Fecha',$caja->getFecha());
		$insert->bindValue('Folio',$asignar_folio);

		$total_caja_actualmente = SucursalesModel::getTotalEnCajaActual($caja->getIdSucursal());
		$no_negativos = $total_caja_actualmente - $cantidad;
		if($caja->getIdTipoMovimiento()=='1')
		{	//Deposito
			$insert->execute();
			SucursalesModel::updateMontoOnSave($caja->getIdSucursal(), $caja->getIdTipoMovimiento(), $cantidad);
		} else if($caja->getIdTipoMovimiento()=='2')
		{	//Retiro
			if($no_negativos < 0)
			{
				#error
				$response_array['status'] = 'error'; 
				header('Content-type: application/json');
				echo json_encode($response_array);
			} else if ($no_negativos >= 0)
			{
				$insert->execute();
				SucursalesModel::updateMontoOnSave($caja->getIdSucursal(), $caja->getIdTipoMovimiento(), $cantidad);
			}
		}
		

	}

	public static function all()
	{
		$db=DataBase::getConnect();
		$listaCaja=[];
		$select=$db->query('CALL get_cajachica("","","","")');
		foreach($select->fetchAll() as $caja)
			{
				$listaCaja[]=new CajaChicaModel($caja['IdCajaChica'],
					$caja['IdSucursal'],
					$caja['IdTipoMovimiento'],
					$caja['Descripcion'],
					$caja['Monto'], 
					$caja['IdEmpleado'],
					$caja['Fecha'], 
					$caja['Folio']);
		}
		return $listaCaja;
	}

	public static function get_total_all_records($query_for_counter){
		/*
			$filtro_sucursal = '';
			if(isset($_GET["IdSucursal"])){
				$filtro_sucursal = $_GET["IdSucursal"];
			} else {
				$filtro_sucursal = ''; #$_SESSION["id_sucursal"];
			}
			
		if(isset($_POST["search"]["value"])){$filtro_busqueda=$_POST["search"]["value"];	}//El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]
		if(isset($_GET["fecha_inicial"])) { $filtro_fecha_inicial = $_GET["fecha_inicial"]; } else { $filtro_fecha_inicial = ""; }
		if(isset($_GET["fecha_final"])) { $filtro_fecha_final = $_GET["fecha_final"]; } else { $filtro_fecha_final = ""; }

			*/
		$db=DataBase::getConnect();	
#		$select=$db->prepare('CALL get_cajachica("'.$filtro_busqueda.'","'.$filtro_sucursal.'","'.$filtro_fecha_inicial.'","'.$filtro_fecha_final.'")');	//4 params vacios por Default
		$select=$db->prepare($query_for_counter);	//4 params vacios por Default
		$select->execute();
		$result = $select->fetchAll();
		return $select->rowCount();
	}

	public static function all_json(){
		
		//Acortar texto
		function shorter($text, $chars_limit){
			if (strlen($text) > $chars_limit){
				$new_text = substr($text, 0, $chars_limit);
				$new_text = trim($new_text);
				return '<span data-toggle="tooltip" data-placement="top" title="'.$text.'">'.$new_text . "...".'</span>';
			} else {
				return $text;
			}
		}

		$filtro_sucursal=''; $filtro_fecha_inicial=''; $filtro_fecha_final='';
		if(isset($_GET["IdSucursal"])) { $filtro_sucursal = $_GET["IdSucursal"]; } else { $filtro_sucursal = $_SESSION["id_sucursal"];/*""; */}
		if(isset($_GET["fecha_inicial"])) { $filtro_fecha_inicial = $_GET["fecha_inicial"]; } else { $filtro_fecha_inicial = ""; }
		if(isset($_GET["fecha_final"])) { $filtro_fecha_final = $_GET["fecha_final"]; } else { $filtro_fecha_final = ""; }


if(isset($_POST['start']) || isset($_POST['length']) || isset($_POST['search']) || isset($_POST['order']) || isset($_POST['column']) || isset($_POST['columns']) ){
	$row = $_POST['start'];
	$rowperpage = $_POST['length'];
	$search_filter = $_POST["search"]["value"];

#$columnIndex = $_POST['order'][0]['column']; // Column index
#$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
#$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc

} else {
	$search_filter = "";
#	$columnIndex =''; $columnName=''; $columnSortOrder=''; 
	$row=''; $rowperpage =''; //Para que el paginador funcione	-- Bug corregido
}

		$db=DataBase::getConnect();
		$output = array();
		$query='';
		$query .= "SELECT * FROM caja_chica ";
		if( isset($search_filter) || isset($filtro_sucursal) || isset($filtro_fecha_inicial) || isset($filtro_fecha_final) || isset($filtro_fecha_inicial) && isset($filtro_fecha_final) || isset($row) || isset($rowperpage) ){
			$query .= 'WHERE Descripcion LIKE "%'.$search_filter.'%" ';

			//Filtro de sucursal
			if($filtro_sucursal>0){
				$query .= 'AND IdSucursal = '.$filtro_sucursal.' ';
			}

			//Filtro de fechas
			if($filtro_fecha_inicial !=='' && $filtro_fecha_final =='' ){	//Solo fecha_inicial
				$query .= 'AND Fecha >= "'.$filtro_fecha_inicial.'" ';
			} else if($filtro_fecha_inicial =='' && $filtro_fecha_final !=='' ) {	//Solo fecha_final
				$query .= 'AND Fecha <= "'.$filtro_fecha_final.'" ';
			} else  if($filtro_fecha_inicial !=='' && $filtro_fecha_final !=='' ){	//Ambos
				$query .= 'AND Fecha BETWEEN "'.$filtro_fecha_inicial.'" AND "'.$filtro_fecha_final.'" ';
			} else {  }

						$query_for_counter = $query; //hasta aqui se le envia al contador total, sin limitar registros por pagina con el bloque if posterior
						
				#$query .=' order by '.$columnName.' '.$columnSortOrder.' limit '.$row.','.$rowperpage;	//revisar linea #166
				#$query .=' limit '.$row.','.$rowperpage;
			if( isset($row) ||  isset($rowperpage) AND $row>0  || $rowperpage>0){
				//Si se executa desde el navegador marca error, porque la paginacion se recive via $_POST 
				$query .= ' ORDER BY IdCajaChica DESC limit '.$row.','.$rowperpage.' ';	//Limitar cantidad de resultados por pagina dentro de la tabla
			}
		}

		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		#$statement->closeCursor();	//Se cierra el cursor para limpiar la sentencia y pueda ser ejecutada
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row)
		{
			$descripcion = $row["Descripcion"];;
			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
			$sub_array = array();
			$sub_array[] = $row["Folio"];
			$sub_array[] = CTipoMovimientoModel::getOnlyName($row["IdTipoMovimiento"]); //SucursalesModel::getOnlyName($row["IdSucursal"]);
			$sub_array[] = shorter($descripcion,10);
			$sub_array[] = "$".$row["Monto"];
			$sub_array[] = EmpleadosModel::getOnlyName($row["IdEmpleado"]);
			//$sub_array[] = $row["Fecha"]; //$filtro_sucursal.' '.$filtro_fecha_inicial.' '.$filtro_fecha_final; //$row["Fecha"];
			$sub_array[] = date ('d-m-Y', strtotime ($row["Fecha"]));

				if(isset($_SESSION["id_role"])){
					$id_role = $_SESSION["id_role"];
					if($id_role == '3'){ //Solo para auxiliares
							$sub_array[] = '<button type="button" name="view" id="'.$row["IdCajaChica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdCajaChica"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button>';
					} else {	//Administradores: General y de sucursal
							$sub_array[] = '<button type="button" name="view" id="'.$row["IdCajaChica"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdCajaChica"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdCajaChica"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
											//<span type="button" class="button-open-modal-view" data-id-persona="'.$row["IdEmpleado"].'" data-toggle="tooltip" data-placement="top" title="Ver"><button type="button" class="btn btn-success btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></button></span><span class="button-open-modal-edit" data-id-persona="'.$row["getIdEmpleado"].'" data-toggle="tooltip" data-placement="top" title="Editar"><button type="button"  class="btn btn-info btn-sm" data-toggle="modal"><i class="fa fa-edit"></i></button></span><span class="button-open-modal-delete" data-id-persona="'.$row["getIdEmpleado"].'" data-toggle="tooltip" data-placement="top" title="Eliminar"><button type="button"  class="btn btn-danger btn-sm" data-toggle="modal"><i class="fa fa-trash"></i></button></span>';
					}
				}

			$data[] = $sub_array;
		}
		
				if(isset($_POST["draw"])){ $draw = $_POST["draw"]; } else { $draw = ''; }

		$output = array(
			"draw"    => intval($draw),
			"recordsTotal"  =>  self::get_total_all_records($query_for_counter),
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
		#return $query;	//test
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
//		$select=$db->prepare('SELECT * FROM caja_chica WHERE IdCajaChica=:id');
		$select=$db->prepare('CALL get_cajachica_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$cajaDb=$select->fetch();
		$caja = new CajaChicaModel ($cajaDb['IdCajaChica'],$cajaDb['IdSucursal'],$cajaDb['IdTipoMovimiento'],$cajaDb['Descripcion'],
		$cajaDb['Monto'],$cajaDb['IdEmpleado'],$cajaDb['Fecha'],$cajaDb['Folio']);
		//var_dump($alumno);
		//die();
		return $caja;
	}

	public static function getMontoPorTransaccion($id){
		$db=DataBase::getConnect();
//		$select=$db->prepare('SELECT * FROM caja_chica WHERE IdCajaChica=:id');
		$select=$db->prepare('SELECT Monto FROM caja_chica WHERE IdCajaChica=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$cajaDb=$select->fetch();
		return $cajaDb['Monto'];
	}

	public static function getIdTipoMovimientoPorTransaccion($id){
		$db=DataBase::getConnect();
//		$select=$db->prepare('SELECT * FROM caja_chica WHERE IdCajaChica=:id');
		$select=$db->prepare('SELECT IdTipoMovimiento FROM caja_chica WHERE IdCajaChica=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$cajaDb=$select->fetch();
		return $cajaDb['IdTipoMovimiento'];
	}
	
	public static function getIdSucursalPorTransaccion($id){
		$db=DataBase::getConnect();
//		$select=$db->prepare('SELECT * FROM caja_chica WHERE IdCajaChica=:id');
		$select=$db->prepare('SELECT IdSucursal FROM caja_chica WHERE IdCajaChica=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$cajaDb=$select->fetch();
		return $cajaDb['IdSucursal'];
	}

	public static function update($caja){
		#0 Formatear en decimal, lo que el constructor mande directo del formulario
		$cantidad = number_format($caja->getMonto(), 2, '.', '');

		/* Para actualizar el total de caja en la sucursal */

		#1 Obtener el monto que ya estaba registrado
		$monto_por_actualizar = self::getMontoPorTransaccion($caja->getIdCajaChica());	//Recibe el Id De Transaccion
		
		#2 Obtener el total que hay en caja de la sucursal
		$monto_total_actual_en_caja = SucursalesModel::getTotalEnCajaActual($caja->getIdSucursal());

		#3 Obtener el tipo de movimiento registrado
		$tipo = $caja->getIdTipoMovimiento();

		#4 El ID que se esta editando es como si no se hubiera registrado antes (lo devolvemos. NO en la DB sino en una variable temporal)
		#4.1 A esa devolucion, se le suma o resta (segun sea el caso) el nuevo monto solicitado al editar

		$devolucion = '';
		switch ($tipo) {
			case 1:	#Deposito
				$devolucion = $monto_total_actual_en_caja - $monto_por_actualizar;
				#4.1 Ya se devolvio
				$nuevo_monto = $devolucion + $cantidad;	# $cantidad en Linea 211
			break;
			case 2:	#Retiro
				$devolucion = $monto_total_actual_en_caja + $monto_por_actualizar;
				#4.1 Ya se devolvio
				$nuevo_monto = $devolucion - $cantidad;	# $cantidad en Linea 211

				/*	Ejemplo de funcionamiento de logica
				echo 'la vieja cantidad es : '.$monto_por_actualizar.'<br>';
				echo 'la nueva cantidad es : '.$cantidad.'<br>';
				echo 'Se devuelve : '.$devolucion.'<br>';
				echo 'Se intenta corregir con : '.$cantidad.'<br>';
				echo 'se devuelve + correcion = '.$nuevo_monto.'<br>';
				*/
			break;
		}
		
		#5 Actualizar el total de dicha sucursal
		SucursalesModel::updateMontoOnUpdate($caja->getIdSucursal(), $caja->getIdTipoMovimiento(), $nuevo_monto);


/* Actualizar caja_chica (historial) */

		$db=DataBase::getConnect();
		#Ya no se modifican > IdSucursal=:IdSucursal, IdEmpleado=:IdEmpleado,
		#$update=$db->prepare('UPDATE caja_chica SET IdTipoMovimiento=:IdTipoMovimiento, Descripcion=:Descripcion, Monto=:Monto WHERE IdCajaChica=:IdCajaChica');
		$update=$db->prepare('CALL edit_cajachica(:IdCajaChica, :IdSucursal, :IdTipoMovimiento, :Descripcion, :Monto)');
		$update->bindValue('IdCajaChica',$caja->getIdCajaChica());
		$update->bindValue('IdSucursal',$caja->getIdSucursal());
		$update->bindValue('IdTipoMovimiento',$caja->getIdTipoMovimiento());
		$update->bindValue('Descripcion',$caja->getDescripcion());
		$update->bindValue('Monto',$cantidad);
#		$update->bindValue('IdEmpleado',$caja->getIdEmpleado());
#		$update->bindValue('Fecha',$caja->getFecha());
		$update->execute();

	}

	public static function delete($id){
		
		#1 Calcular el dinero de una transaccion por borrar para devolverselo a la Sucursal correpondiente (suponiendo que dicha transaccion sea deposito o retiro jamas se realizo)
		$sucursal				= self::getIdSucursalPorTransaccion($id);
		$tipo_movimiento		= self::getIdTipoMovimientoPorTransaccion($id);
		$monto_total_actual_en_caja = SucursalesModel::getTotalEnCajaActual($sucursal);
		$monto_por_recuperar	= self::getMontoPorTransaccion($id);	//monto actual que esta por borrarse del historial 'caja_chica'

		$devolucion = '';
		switch ($tipo_movimiento) {
			case 1:	#Deposito
				$devolucion = $monto_total_actual_en_caja - $monto_por_recuperar;
			break;
			case 2:	#Retiro
				$devolucion = $monto_total_actual_en_caja + $monto_por_recuperar;
			break;
		}
		
		SucursalesModel::updateMontoOnUpdate($sucursal, $tipo_movimiento, $devolucion);
		
		$db=DataBase::getConnect();
#		$delete=$db->prepare('DELETE FROM caja_chica WHERE IdCajaChica=:id');
		$delete=$db->prepare('CALL delete_cajachica(:id)');
		$delete->bindValue('id',$id);
		$delete->execute();
	}

}
?>