<?php

class RutasModel{
  	private $IdRuta;
  	private $Nombre;
  	private $Empresas;
  	private $Comentarios;
  	private $IdSucursal;
  	private $IdEmpleadoCaptura;
  	private $FechaCaptura;
  	private $IdEmpleadoCierre;
  	private $FechaCierre;
  	private $Status;

	function __construct($IdRuta, $Nombre, $Empresas, $Comentarios, $IdSucursal, $IdEmpleadoCaptura, $FechaCaptura, $IdEmpleadoCierre, $FechaCierre, $Status){
		$this->setIdRuta($IdRuta);
		$this->setNombre($Nombre);
		$this->setEmpresas($Empresas);
		$this->setComentarios($Comentarios);
		$this->setIdSucursal($IdSucursal);
		$this->setIdEmpleadoCaptura($IdEmpleadoCaptura);
		$this->setFechaCaptura($FechaCaptura);
		$this->setIdEmpleadoCierre($IdEmpleadoCierre);
		$this->setFechaCierre($FechaCierre);
		$this->setStatus($Status);
	}

	public function getIdRuta(){
		return $this->IdRuta;
	}

	public function setIdRuta($IdRuta){
		$this->IdRuta=$IdRuta;
	}

	public function getNombre(){
		return $this->Nombre;
	}

	public function setNombre($Nombre){
		$this->Nombre=$Nombre;
	}

	public function getEmpresas(){
		return $this->Empresas;
	}

	public function setEmpresas($Empresas){
		$this->Empresas=$Empresas;
	}

	public function getComentarios(){
		return $this->Comentarios;
	}

	public function setComentarios($Comentarios){
		$this->Comentarios=$Comentarios;
	}

	public function getIdSucursal(){
		return $this->IdSucursal;
	}

	public function setIdSucursal($IdSucursal){
		$this->IdSucursal=$IdSucursal;
	}

	public function getIdEmpleadoCaptura(){
		return $this->IdEmpleadoCaptura;
	}

	public function setIdEmpleadoCaptura($IdEmpleadoCaptura){
		$this->IdEmpleadoCaptura=$IdEmpleadoCaptura;
	}

	public function getFechaCaptura(){
		return $this->FechaCaptura;
	}

	public function setFechaCaptura($FechaCaptura){
		$this->FechaCaptura=$FechaCaptura;
	}

	public function getIdEmpleadoCierre(){
		return $this->IdEmpleadoCierre;
	}

	public function setIdEmpleadoCierre($IdEmpleadoCierre){
		$this->IdEmpleadoCierre=$IdEmpleadoCierre;
	}

	public function getFechaCierre(){
		return $this->FechaCierre;
	}

	public function setFechaCierre($FechaCierre){
		$this->FechaCierre=$FechaCierre;
	}

	public function getStatus(){
		return $this->Status;
	}

	public function setStatus($Status){
		$this->Status=$Status;
	}

	public static function save($Rutas){
		$db=Database::getConnect();

		$fecha = date("Y-m-d H:i");

		$insert = $db->prepare('INSERT INTO rutas VALUES (NULL,:Nombre,:Empresas,:Comentarios,:IdSucursal,:IdEmpleadoCaptura,:FechaCaptura,NULL, NULL, :Status)');
		#Hacer procedimientos almacenados
		$insert->bindvalue('Nombre', $Rutas->getNombre());
		$insert->bindvalue('Empresas', $Rutas->getEmpresas());
		$insert->bindvalue('Comentarios', $Rutas->getComentarios());
		$insert->bindValue('IdSucursal', $Rutas->getIdSucursal());
		$insert->bindvalue('IdEmpleadoCaptura', $Rutas->getIdEmpleadoCaptura());
		$insert->bindValue('FechaCaptura', $fecha);
		$insert->bindvalue('Status', $Rutas->getStatus());

		$insert->execute();#Validar antes de ejecutar
	}

	public static function update($rutas){
		$db=Database::getConnect();

		$fecha = date("Y-m-d H:i");

		$update=$db->prepare('UPDATE rutas SET Nombre=:Nombre, Empresas=:Empresas, Comentarios=:Comentarios WHERE IdRuta=:IdRuta');
		#Hacer procedimientos almacenados
		$update->bindValue('IdRuta', $rutas->getIdRuta());
		$update->bindvalue('Nombre', $rutas->getNombre());
		$update->bindvalue('Empresas', $rutas->getEmpresas());
		$update->bindvalue('Comentarios', $rutas->getComentarios());

		$update->execute();#Validar antes de ejecutar
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaRutas=[];
		#$select=$db->query('CALL get_clientes("")');
		$select=$db->query('SELECT * FROM rutas');
		foreach($select->fetchAll() as $Rutas){$listaRutas[]=new RutasModel($Rutas['IdRuta'],$Rutas['Nombre'],$Rutas['Empresas'],$Rutas['Comentarios'],$Rutas['IdSucursal'],$Rutas['IdEmpleadoCaptura'], 
			$Rutas['FechaCaptura'],$Rutas['IdEmpleadoCierre'], $Rutas['FechaCierre'], $Rutas['Status']);
		}
		return $listaRutas;
	}

	public static function get_total_all_records(){
		$db=DataBase::getConnect();
		#$select=$db->prepare('CALL get_clientes("")');
		$select=$db->prepare('SELECT * FROM rutas WHERE IdSucursal=:IdSucursal AND Status=0');
		$select->bindValue('IdSucursal', $_SESSION['id_sucursal']);
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
		
		$db=DataBase::getConnect();
		$output = array();
#		$filtro_busqueda=$_POST["search"]["value"];	//El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]
		if(isset($_GET["IdSucursal"])) { $filtro_sucursal = $_GET["IdSucursal"]; } else { $filtro_sucursal = $_SESSION["id_sucursal"]; /*"";*/ }
		$query = '';
		$search_filter='';
		if (isset($_POST['start']) || isset($_POST['length']) || isset($_POST['search']) || isset($_POST['order']) || isset($_POST['column']) || isset($_POST['columns']) ) {
			$row = $_POST['start'];
			$rowperpage = $_POST['length'];
			$search_filter = $_POST['search']['value'];
		}else{
			$search_filter = '';
			$row = '';
			$rowperpage = '';
		}

		//$query = "select * from rutas";
		$query .= 'SELECT * FROM rutas WHERE  Status=0';
		if (isset($search_filter) || isset($row) || isset($rowperpage)) {
			$query .= ' AND (Nombre LIKE "%'.$search_filter.'%" OR Empresas LIKE "%'.$search_filter.'%")' ;


			//Filtro de sucursal
			if($filtro_sucursal>0){
				$query .= 'AND IdSucursal = '.$filtro_sucursal.' ';
			}

			$query_for_counter = $query;

			if ((isset($row) || isset($rowperpage)) && ($row>0 || $rowperpage>0)) {
				$query .= ' limit '.$row.','.$rowperpage.' ';
			}
		}

		$statement = $db->prepare($query);
#		$statement->bindValue(':busqueda', $filtro_busqueda);	//Al param :busqueda se le asigna el $filtro_busqueda. ref[1],
		$statement->bindValue('IdSucursal', $_SESSION['id_sucursal']);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row){
			$direccion = 'a';
			//if($row["estatus"]=='1'){ $situacion = 'ACTIVO'; } else { $situacion = 'INACTIVO'; }
			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
			$sub_array = array();
			$sub_array[] = $row["IdRuta"];//SucursalesModel::getOnlyName($row["IdSucursal"]);
			$sub_array[] = shorter($row["Nombre"],30);
			$sub_array[] = shorter($row["Empresas"],30);
			$sub_array[] = shorter($row['Comentarios'], 30);
			//$sub_array[] = $row["Comentarios"];//CRolesModel::getOnlyName($row["IdRol"]);
					if(isset($_SESSION["id_role"])){
						$id_role = $_SESSION["id_role"];
						if($id_role == '3'){ //Solo para auxiliares
								$sub_array[] = '<button type="button" name="view" id="'.$row["IdRuta"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdRuta"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';
						} else {	//Administradores: General y de sucursal
								$sub_array[] = '<button type="button" name="view" id="'.$row["IdRuta"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdRuta"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdRuta"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
						}
					}

			$data[] = $sub_array;
		}
		
		$draw = '';
		if(isset($_POST["draw"])){
			$draw = $_POST["draw"];
		}
		
		$output = array(
			"draw"    => intval($draw),
			"recordsTotal"  =>  $filtered_rows,
			"recordsFiltered" => self::get_total_all_records(),
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
	
	public static function searchById($id){
		$db=DataBase::getConnect();
		#$select=$db->prepare('CALL get_cliente_id(:id)');
		$select=$db->prepare('SELECT * FROM rutas WHERE IdRuta = :id');
		$select->bindValue('id',$id);
		$select->execute();
		$rutasDb=$select->fetch();
		$rutas = new RutasModel ($rutasDb['IdRuta'],$rutasDb['Nombre'],$rutasDb['Empresas'],$rutasDb['Comentarios'],$rutasDb['IdSucursal'],$rutasDb['IdEmpleadoCaptura'],$rutasDb['FechaCaptura'],$rutasDb['IdEmpleadoCierre'],$rutasDb['FechaCierre'],$rutasDb['Status']);
		//var_dump($alumno);
		//die();
		return $rutas;
	}

	/*public static function delete($id){
		$db=DataBase::getConnect();
		//$delete=$db->prepare('CALL delete_clientes(:id)');
		$delete=$db->prepare('DELETE FROM rutas WHERE IdRuta=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
		$delete=$db->prepare('UPDATE rutas SET Status=0 WHERE IdRuta=:id');
		$delete->bindValue('id', $id);
		$delete->execute();
	}*/

	public static function delete($id, $idEC, $Status){
		$db=Database::getConnect();

		$fecha = date("Y-m-d H:i");

		$delete=$db->prepare('UPDATE rutas SET IdEmpleadoCierre=:IdEmpleadoCierre, FechaCierre=:FechaCierre, Status=:Status WHERE IdRuta=:IdRuta');
		#Hacer procedimientos almacenados
		$delete->bindValue('IdRuta', $id);
		$delete->bindvalue('IdEmpleadoCierre', $idEC);
		$delete->bindValue('FechaCierre', $fecha);
		$delete->bindvalue('Status', $Status);

		$delete->execute();#Validar antes de ejecutar
	}

}

?>