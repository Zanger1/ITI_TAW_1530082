<?php 

class SucursalesModel {
	private $IdSucursal;
	private $Nombre;
	private $NombreContacto;
	private $CorreoContacto;
	private $IdCiudad;
	private $Direccion;
	private $Telefono;
	private $IdTipoSucursal;
	private $LetraFolio;
	private $TotalEnCaja;

	function __construct($IdSucursal, $Nombre, $NombreContacto, $CorreoContacto,$IdCiudad,
	$Direccion,$Telefono, $IdTipoSucursal, $LetraFolio, $TotalEnCaja){
		$this->setIdSucursal($IdSucursal);
		$this->setNombre($Nombre);
		$this->setNombreContacto($NombreContacto);
		$this->setCorreoContacto($CorreoContacto);
		$this->setIdCiudad($IdCiudad);
		$this->setDireccion($Direccion);
		$this->setTelefono($Telefono);
		$this->setIdTipoSucursal($IdTipoSucursal);
		$this->setLetraFolio($LetraFolio);
		$this->setTotalEnCaja($TotalEnCaja);
	}

	public function getIdSucursal(){
		return $this->IdSucursal;
	}

	public function setIdSucursal($IdSucursal){
		$this->IdSucursal = $IdSucursal;
	}

	public function getNombre(){
		return $this->Nombre;
	}

	public function setNombre($Nombre){ 
		$this->Nombre = $Nombre;
	}

	public function getNombreContacto(){
		return $this->NombreContacto;
	}

	public function setNombreContacto($NombreContacto){
		$this->NombreContacto = $NombreContacto;
	}

	public function getCorreoContacto(){
		return $this->CorreoContacto;
	}

	public function setCorreoContacto($CorreoContacto){
		$this->CorreoContacto = $CorreoContacto;
	}

	public function getIdCiudad(){
		return $this->IdCiudad;
	}
	
	public function setIdCiudad($IdCiudad){
		$this->IdCiudad = $IdCiudad;
	}

	public function getDireccion(){
		return $this->Direccion;
	}

	public function setDireccion($Direccion){
		$this->Direccion = $Direccion;
	}

	public function getTelefono(){
		return $this->Telefono;
	}

	public function setTelefono($Telefono){
		$this->Telefono = $Telefono;
	}

	public function getIdTipoSucursal(){
		return $this->IdTipoSucursal;
	}

	public function setIdTipoSucursal($IdTipoSucursal){
		$this->IdTipoSucursal = $IdTipoSucursal;
	}

	public function getLetraFolio(){
		return $this->LetraFolio;
	}

	public function setLetraFolio($LetraFolio){
		$this->LetraFolio= $LetraFolio;
	}

	public function getTotalEnCaja(){
		return $this->TotalEnCaja;
	}

	public function setTotalEnCaja($TotalEnCaja){
		$this->TotalEnCaja= $TotalEnCaja;
	}

	public static function save($sucursales){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		//$insert=$db->prepare('INSERT INTO sucursales VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert=$db->prepare('INSERT INTO sucursales VALUES (NULL, :Nombre, :NombreContacto, :CorreoContacto, :IdCiudad, :Direccion, :Telefono, :IdTipoSucursal,:LetraFolio, 0, 0)');
		//$insert->bindValue('IdSucursal',$sucursales->getIdSucursal());
		$insert->bindValue('Nombre',$sucursales->getNombre());
		$insert->bindValue('NombreContacto',$sucursales->getNombreContacto());
		$insert->bindValue('CorreoContacto',$sucursales->getCorreoContacto());
		$insert->bindValue('IdCiudad',$sucursales->getIdCiudad());
		$insert->bindValue('Direccion',$sucursales->getDireccion());
		$insert->bindValue('Telefono',$sucursales->getTelefono());
		$insert->bindValue('IdTipoSucursal',$sucursales->getIdTipoSucursal());
		$insert->bindValue('LetraFolio',$sucursales->getLetraFolio());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaSucursales=[];
		//$select=$db->query('SELECT * FROM sucursales order by IdSucursal');
		$select=$db->query('SELECT * FROM sucursales order by nombre');
		foreach($select->fetchAll() as $sucursales){
			$listaSucursales[]=new SucursalesModel($sucursales['IdSucursal'],$sucursales['Nombre'],$sucursales['NombreContacto'],
			$sucursales['CorreoContacto'], $sucursales['IdCiudad'], $sucursales['Direccion'], $sucursales['Telefono'], $sucursales['IdTipoSucursal'],
			$sucursales['LetraFolio'],$sucursales['TotalEnCaja']);
		}
		return $listaSucursales;
	}


   public static function get_total_all_records($query_for_counter){
		$db=DataBase::getConnect();
		$select=$db->prepare($query_for_counter);
		$select->execute();
		$result = $select->fetchAll();
		return $select->rowCount();
	}


//jlopezl remplazo la funcion all_json() por esta

	public static function all_json(){
	
		//Acortar texto
		function shorter($text, $chars_limit){
			if (strlen($text) > $chars_limit){
				$new_text = substr($text, 0, $chars_limit);
				$new_text = trim($new_text);
				return '<span data-toggle="tooltip" data-placement="top" title="'.$text.'">'.$new_text . "...".'</span>';
			} else 
			{
				return $text;
			}
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
#		$filtro_busqueda=$_POST["search"]["value"];	//El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]
		#$query = "CALL get_clientes(:busqueda)";
		$query = "SELECT * FROM sucursales ";
####
		if( isset($search_filter) || isset($row) || isset($rowperpage) ){
			$query .= 'WHERE  Nombre LIKE "%'.$search_filter.'%" AND eliminado=0 ';

			$query_for_counter = $query; //hasta aqui se le envia al contador total, sin limitar registros por pagina con el bloque if posterior

			if( isset($row) ||  isset($rowperpage) AND $row>0  || $rowperpage>0){
				//Si se executa desde el navegador marca error, porque la paginacion se recive via $_POST 
				$query .= ' limit '.$row.','.$rowperpage.' ';	//Limitar cantidad de resultados por pagina dentro de la tabla
			}
		}
####


		$statement = $db->prepare($query);
#		$statement->bindValue(':busqueda', $filtro_busqueda);	//Al param :busqueda se le asigna el $filtro_busqueda. ref[1],
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$data = array();
		$filtered_rows = $statement->rowCount();


		foreach($result as $row){
			/* jlopezl  cancele esto que no se ocupa
			$direccion = EstadosModel::getOnlyName(CiudadesModel::getEstadoByCiudadRef($row["IdCiudad"])).', '.CiudadesModel::getOnlyName($row["IdCiudad"]).', '.$row["CodigoPostal"].' '.$row["Colonia"].' '.$row["Calle"].' '.$row["Num"];
            */

			//if($row["estatus"]=='1'){ $situacion = 'ACTIVO'; } else { $situacion = 'INACTIVO'; }
			//jlopezl cancele tbn esta de imagen que ya no se ocupa
			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
			$sub_array = array();
			$sub_array[] = $row["Nombre"];
			$sub_array[] = null;
			$sub_array[] = null;
			$sub_array[] = null;

			/* jlopezl cancelo
			$sub_array[] = $row["Telefono"];
			$sub_array[] = $row["CorreoElectronico"];//CRolesModel::getOnlyName($row["IdRol"]);
			$sub_array[] = shorter($direccion,10);  *///SucursalesModel::getOnlyName($row["IdSucursal"]);

if(isset($_SESSION["id_role"])){
	$id_role = $_SESSION["id_role"];
	if($id_role == '3'){ //Solo para auxiliares
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdSucursal"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdSucursal"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';
	} else {	//Administradores: General y de sucursal
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdSucursal"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdSucursal"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdSucursal"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
	}
}
			$data[] = $sub_array;
		}
		
		if(isset($_POST["draw"])){ $draw = $_POST["draw"]; } else { $draw = ''; }

		$output = array(
			"draw"    => intval($draw),
			"recordsTotal"  =>  self::get_total_all_records($query_for_counter), //$filtered_rows,	#Cualquiera de las 2 no marca error
			"recordsFiltered" => self::get_total_all_records($query_for_counter), //self::get_total_all_records(),
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
//remplazada hasta qui






	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM sucursales WHERE IdSucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$sucursalesDB=$select->fetch();
		$sucursal = new SucursalesModel ($sucursalesDB['IdSucursal'],$sucursalesDB['Nombre'], $sucursalesDB['NombreContacto'],
		$sucursalesDB['CorreoContacto'],$sucursalesDB['IdCiudad'],$sucursalesDB['Direccion'],$sucursalesDB['Telefono'],$sucursalesDB['IdTipoSucursal'],
		$sucursalesDB['LetraFolio'],$sucursalesDB['TotalEnCaja']);
		//var_dump($alumno);
		//die();
		return $sucursal;	//Para mostrar en empleados, no se si se ocupe uno igual para
	}







	public static function getOnlyName($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM sucursales WHERE IdSucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$sucursalesDB=$select->fetch();
		$sucursal = new SucursalesModel ($sucursalesDB['IdSucursal'],$sucursalesDB['Nombre'], $sucursalesDB['NombreContacto'],
		$sucursalesDB['CorreoContacto'],$sucursalesDB['IdCiudad'],$sucursalesDB['Direccion'],$sucursalesDB['Telefono'],$sucursalesDB['IdTipoSucursal'],
		$sucursalesDB['LetraFolio'],$sucursalesDB['TotalEnCaja']);
		//var_dump($alumno);
		//die();
		return $sucursalesDB["Nombre"];	//Para mostrar en empleados, no se si se ocupe uno igual para
	}

	public static function getLetraSucursalParaFolio($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM sucursales WHERE IdSucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$sucursalesDB=$select->fetch();
		//var_dump($alumno);
		//die();
		return $sucursalesDB['LetraFolio'];	//Para mostrar en empleados, no se si se ocupe uno igual para
	}

	public static function getTotalEnCajaActual($id){
		/* La diferencia entre este y el getter de la linea 101, es que este te da el total actual y el getter solo sirve para obtener la posicion del _Constructor */
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT TotalEnCaja FROM sucursales WHERE IdSucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$sucursalesDB=$select->fetch();
		return $sucursalesDB["TotalEnCaja"];
	}

	public static function getTotalEnTodaLasCajas(){
		#este a diferencia del anterior suma el total que hay en todas las sucursales
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT SUM(TotalEnCaja) AS temp_total FROM sucursales');
		$select->execute();
		$sucursalesDB=$select->fetch();
		return $sucursalesDB["temp_total"];
	}

	public static function update($sucursales){
		$db=DataBase::getConnect();
		$update=$db->prepare('UPDATE sucursales SET Nombre=:Nombre, NombreContacto=:NombreContacto, CorreoContacto=:CorreoContacto, IdCiudad=:IdCiudad, Direccion=:Direccion, Telefono=:Telefono, IdTipoSucursal=:IdTipoSucursal, LetraFolio=:LetraFolio  WHERE IdSucursal=:IdSucursal');
		
		$update->bindValue('Nombre',$sucursales->getNombre());
		$update->bindValue('NombreContacto',$sucursales->getNombreContacto());
		$update->bindValue('CorreoContacto',$sucursales->getCorreoContacto());
		$update->bindValue('IdCiudad',$sucursales->getIdCiudad());
		$update->bindValue('Direccion',$sucursales->getDireccion());
		$update->bindValue('Telefono',$sucursales->getTelefono());
		$update->bindValue('IdTipoSucursal',$sucursales->getIdTipoSucursal());
		$update->bindValue('LetraFolio',$sucursales->getLetraFolio());
		$update->bindValue('IdSucursal',$sucursales->getIdSucursal());
		$update->execute();
	}

	public static function updateMontoOnSave($IdSucursal, $IdTipoMovimiento, $Monto){
		/*
		 @params: IdSucursal, IdTipoMovimiento, Cantidad
		*/
		
		$tipo = $IdTipoMovimiento;
		$TotalEnCaja = "";	//Declaracion vacia
		$cantidad_actual = self::getTotalEnCajaActual($IdSucursal);	//Obtenemos la cantidad actual que hay en la sucursal
		switch ($tipo) {
			case 1:	#Deposito
				$TotalEnCaja = $cantidad_actual + $Monto;
			break;
			case 2:	#Retiro
				$TotalEnCaja = $cantidad_actual - $Monto;
			break;
		}
		
		#NOTA: Linea 195: Usar ese metodo para revisar si el total == 0, si es asi desactivar la <option value="?" disabled>Retiro</option>
		#Sugerencia 1: Notificaciones en el top <nav> : Notificar si la caja llego a 0
		#Sugerencia 2: Hacer una tabla de reportes EXTRA para saber con que cantidad de dinero termina el mes, la tabla actual 'caja_chica' puedes obtener eso pero lo consultas manualmente con filtros sin embargo al final de mes te puede generar eta info en un reporte extra

		$db=DataBase::getConnect();
		$update=$db->prepare('UPDATE sucursales SET TotalEnCaja=:TotalEnCaja WHERE IdSucursal=:IdSucursal');
		$update->bindValue('IdSucursal',$IdSucursal);
		$update->bindValue('TotalEnCaja',$TotalEnCaja);
		$update->execute();
	}

	public static function updateMontoOnUpdate($IdSucursal, $IdTipoMovimiento, $Monto){
		/*
		 @params: IdSucursal, IdTipoMovimiento, Cantidad
		*/

		$db=DataBase::getConnect();
		$update=$db->prepare('UPDATE sucursales SET TotalEnCaja=:TotalEnCaja WHERE IdSucursal=:IdSucursal');
		$update->bindValue('IdSucursal',$IdSucursal);
		$update->bindValue('TotalEnCaja',$Monto);
		$update->execute();
	}

	public static function delete($IdSucursal){
		$db=DataBase::getConnect();
		//Actualizar el campo eliminado en lugar de eliminar fisicamente.
		//$delete=$db->prepare('DELETE  FROM alumno WHERE IdSucursal=:id');
       /*
		$delete=$db->prepare('UPDATE sucursales SET eliminado = 1 where IdSucursal=:$id')
		$delete->bindValue('id',$id);
		$delete->execute();
		*/

		$delete=$db->prepare('CALL delete_sucursal(:IdSucursal)');
		$delete->bindValue('IdSucursal',$IdSucursal);
		$delete->execute();


	}
	
	public static function combobox_lista(){
		//Compatible solamente con filtros para DataTable - no usar en modales.
		$ListaSucursales = SucursalesModel::all();
			$current_selected = "";
			foreach($ListaSucursales as $s){
				if(isset($_SESSION["id_sucursal"])){
					if($s->getIdSucursal()==$_SESSION["id_sucursal"]){
						$current_selected = 'selected';
					} else {
						$current_selected = '';
					}
				}
				echo '<option value="'.$s->getIdSucursal().'" '.$current_selected.'>'.$s->getNombre().'</option>';
		}
	}

	public static function sucursal(){
		//Compatible solamente con filtros para DataTable - no usar en modales.
		$ListaSucursales = SucursalesModel::all();
			$current_selected = "";
			foreach($ListaSucursales as $s){
				if(isset($_SESSION["id_sucursal"])){
					if($s->getIdSucursal()==$_SESSION["id_sucursal"]){
						echo $s->getNombre();
					} else {
						$current_selected = '';
					}
				}
				
		}
	}

}
?>