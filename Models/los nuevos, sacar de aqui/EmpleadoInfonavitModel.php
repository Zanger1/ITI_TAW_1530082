<?php
/*
	ESTE ESTA CAUSANDO PROBLEMAS A TODO EL PROYECTO
*/
class EmpleadoInfonavitModel{

	private $IdEmpleadoInfonavit;
	private $IdEmpleado;
	private $MontoCreditoInfonavit;
	private $MontoRetener;
	private $MontoRestanteRetener;
	private $FechaCaptura;
	private $IdEmpleadoCaptura;
	private $Liquido;
	private $Comentario;
	private $Status;

	function __construct($IdEmpleadoInfonavit, $IdEmpleado, $MontoCreditoInfonavit, $MontoRetener, $MontoRestanteRetener, $FechaCaptura, $IdEmpleadoCaptura, $Liquido, $Comentario, $Status){
		$this->setIdEmpleadoInfonavit($IdEmpleadoInfonavit);
		$this->setIdEmpleado($IdEmpleado);
		$this->setMontoCreditoInfonavit($MontoCreditoInfonavit);
		$this->setMontoRetener($MontoRetener);
		$this->setMontoRestanteRetener($MontoRestanteRetener);
		$this->setFechaCaptura($FechaCaptura);
		$this->setIdEmpleadoCaptura($IdEmpleadoCaptura);
		$this->setLiquido($Liquido);
		$this->setComentario($Comentario);
		$this->setStatus($Status);
	}

	public function getIdEmpleadoInfonavit(){
		return $this->IdEmpleadoInfonavit;
	}

	public function setIdEmpleadoInfonavit($IdEmpleadoInfonavit){
		$this->IdEmpleadoInfonavit = $IdEmpleadoInfonavit;
	}

	public function getIdEmpleado(){
		return $this->IdEmpleado;
	}

	public function setIdEmpleado($IdEmpleado){
		$this->IdEmpleado = $IdEmpleado;
	}
/*
	public static function getNombreEmpleado($NombreEmpleado){
		return $this->NombreEmpleado;
		/*$db=Database::getConnect();

		$empleado = $db->prepare('SELECT CONCAT(NombreEmpleado, " ", ApellidoPat," ",Apellidomat) NombreCompleto FROM empleados WHERE IdEmpleado=:idEmp');
		#Hacer procedimiento almacenados
		$empleado->bindvalue('idEmp', $IdEmpleado);
		$empleado->execute();
		$result = $empleado->fetch();
		return $result['NombreCompleto']; 
	} */

	public function getMontoCreditoInfonavit(){
		return $this->MontoCreditoInfonavit;
	}

	public function setMontoCreditoInfonavit($MontoCreditoInfonavit){
		$this->MontoCreditoInfonavit = $MontoCreditoInfonavit;
	}
	
	public function getMontoRetener(){
		return $this->MontoRetener;
	}

	public function setMontoRetener($MontoRetener){
		$this->MontoRetener = $MontoRetener;
	}
	
	public function getMontoRestanteRetener(){
		return $this->MontoRestanteRetener;
	}

	public function setMontoRestanteRetener($MontoRestanteRetener){
		$this->MontoRestanteRetener = $MontoRestanteRetener;
	}
	
	public function getFechaCaptura(){
		return $this->FechaCaptura;
	}

	public function setFechaCaptura($FechaCaptura){
		$this->FechaCaptura = $FechaCaptura;
	}
	
	public function getIdEmpleadoCaptura(){
		return $this->IdEmpleadoCaptura;
	}

	public function setIdEmpleadoCaptura($IdEmpleadoCaptura){
		$this->IdEmpleadoCaptura = $IdEmpleadoCaptura;
	}
	
	public function getLiquido(){
		return $this->Liquido;
	}

	public function setLiquido($Liquido){
		$this->Liquido = $Liquido;
	}
	
	public function getComentario(){
		return $this->Comentario;
	}

	public function setComentario($Comentario){
		$this->Comentario = $Comentario;
	}

	public function getStatus(){
		return $this->Status;
	}

	public function setStatus($Status){
		$this->Status = $Status;
	}

	public static function save($EmpleadoInfonavit){
		$db=Database::getConnect();

		$insert = $db->prepare('INSERT INTO empleadoinfonavit VALUES (NULL,:IdEmpleado,:MontoCreditoInfonavit,:MontoRetener,:MontoRestanteRetener,CURRENT_TIMESTAMP(),:IdEmpleadoCaptura,:Liquido, :Comentario, :Status)');
		#Hacer procedimientos almacenados
		$insert->bindvalue('IdEmpleado', $EmpleadoInfonavit->getIdEmpleado());
		$insert->bindvalue('MontoCreditoInfonavit', $EmpleadoInfonavit->getMontoCreditoInfonavit());
		$insert->bindvalue('MontoRetener', $EmpleadoInfonavit->getMontoRetener());
		$insert->bindvalue('MontoRestanteRetener', $EmpleadoInfonavit->getMontoCreditoInfonavit());
		$insert->bindvalue('IdEmpleadoCaptura', $EmpleadoInfonavit->getIdEmpleadoCaptura());
		$insert->bindvalue('Liquido', $EmpleadoInfonavit->getLiquido());
		$insert->bindvalue('Comentario', $EmpleadoInfonavit->getComentario());
		$insert->bindvalue('Status', $EmpleadoInfonavit->getStatus());
		$insert->execute();#Validar antes de ejecutar
	}

	public static function update($EmpleadoInfonavit){
		$db=Database::getConnect();

		$update=$db->prepare('UPDATE empleadoinfonavit SET IdEmpleado=:IdEmpleado, MontoCreditoInfonavit=:MontoCreditoInfonavit, MontoRetener=:MontoRetener, MontoRestanteRetener=:MontoRestanteRetener, IdEmpleadoCaptura=:IdEmpleadoCaptura, Liquido=:Liquido, Comentario=:Comentario WHERE IdEmpleadoInfonavit=:IdEmpleadoInfonavit');
		#Hacer procedimientos almacenados
		$update->bindValue('IdEmpleadoInfonavit', $EmpleadoInfonavit->getIdEmpleadoInfonavit());
		$update->bindvalue('IdEmpleado', $EmpleadoInfonavit->getIdEmpleado());
		$update->bindvalue('MontoCreditoInfonavit', $EmpleadoInfonavit->getMontoCreditoInfonavit());
		$update->bindvalue('MontoRetener', $EmpleadoInfonavit->getMontoRetener());
		$update->bindvalue('MontoRestanteRetener', $EmpleadoInfonavit->getMontoRestanteRetener());
		$update->bindvalue('IdEmpleadoCaptura', $EmpleadoInfonavit->getIdEmpleadoCaptura());
		$update->bindvalue('Liquido', $EmpleadoInfonavit->getLiquido());
		$update->bindvalue('Comentario', $EmpleadoInfonavit->getComentario());
		//$update->bindvalue('Status', $EmpleadoInfonavit->getStatus());

		$update->execute();#Validar antes de ejecutar
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaEmpleadoInfonavit=[];
		#$select=$db->query('CALL get_clientes("")');
		$select=$db->query('SELECT * FROM empleadoinfonavit');
		foreach($select->fetchAll() as $EmpleadoInfonavit){$listaEmpleadoInfonavit[]=new EmpleadoInfonavitModel($EmpleadoInfonavit['IdEmpleadoInfonavit'],$EmpleadoInfonavit['IdEmpleado'],$EmpleadoInfonavit['MontoCreditoInfonavit'],$EmpleadoInfonavit['MontoRetener'],$EmpleadoInfonavit['MontoRestanteRetener'], 
			$EmpleadoInfonavit['FechaCaptura'],$EmpleadoInfonavit['IdEmpleadoCaptura'], $EmpleadoInfonavit['Liquido'], $EmpleadoInfonavit['Comentario'], $EmpleadoInfonavit['Status']);
		}
		return $listaEmpleadoInfonavit;
	}

	public static function get_total_all_records(){
		$db=DataBase::getConnect();
		#$select=$db->prepare('CALL get_clientes("")');
		$select=$db->prepare('SELECT * FROM empleadoinfonavit');
		$select->execute();
		$result = $select->fetchAll();
		return $select->rowCount();
	}
	
	#aquí va la función all_json
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

		//$query = 'SELECT * FROM empleadoinfonavit';
		$query .= 'SELECT e.*, ei.* FROM empleadoinfonavit AS ei, empleados AS e WHERE e.IdEmpleado = ei.IdEmpleado';
		if (isset($search_filter) || isset($row) || isset($rowperpage)) {
			$query .= ' AND CONCAT(e.NombreEmpleado," ",e.ApellidoPat," ",e.Apellidomat) LIKE "%'.$search_filter.'%"';

			$query_for_counter = $query;

			if ((isset($row) || isset($rowperpage)) && ($row>0 || $rowperpage>0)) {
				$query .= ' limit '.$row.','.$rowperpage.' ';
			}
		}
		$statement = $db->prepare($query);
#		$statement->bindValue(':busqueda', $filtro_busqueda);	//Al param :busqueda se le asigna el $filtro_busqueda. ref[1],
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
			$sub_array[] = EmpleadosModel::getonlyName($row['IdEmpleado']);	#self::getNombreEmpleado($row['IdEmpleado']);
			//$sub_array[] = $row['IdEmpleado'];
			$sub_array[] = $row["MontoCreditoInfonavit"];
			$sub_array[] = $row["MontoRetener"];//CRolesModel::getOnlyName($row["IdRol"]);
			$sub_array[] = $row["MontoRestanteRetener"];
			#$sub_array[] = shorter($direccion,10);//SucursalesModel::getOnlyName($row["IdSucursal"]);
					if(isset($_SESSION["id_role"])){
						$id_role = $_SESSION["id_role"];
						if($id_role == '3'){ //Solo para auxiliares
								$sub_array[] = '<button type="button" name="view" id="'.$row["IdEmpleadoInfonavit"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdEmpleadoInfonavit"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';
						} else {	//Administradores: General y de sucursal
								$sub_array[] = '<button type="button" name="view" id="'.$row["IdEmpleadoInfonavit"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdEmpleadoInfonavit"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdEmpleadoInfonavit"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
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
		$select=$db->prepare('SELECT * FROM empleadoinfonavit WHERE IdEmpleadoInfonavit = :id');
		$select->bindValue('id',$id);
		$select->execute();
		$empleadosInfonavitDb=$select->fetch();
		$empleadosInfonavit = new EmpleadoInfonavitModel ($empleadosInfonavitDb['IdEmpleadoInfonavit'],$empleadosInfonavitDb['IdEmpleado'],$empleadosInfonavitDb['MontoCreditoInfonavit'],$empleadosInfonavitDb['MontoRetener'],$empleadosInfonavitDb['MontoRestanteRetener'],
		$empleadosInfonavitDb['FechaCaptura'],$empleadosInfonavitDb['IdEmpleadoCaptura'],$empleadosInfonavitDb['Liquido'],$empleadosInfonavitDb['Comentario'],$empleadosInfonavitDb['Status']);
		//var_dump($alumno);
		//die();
		return $empleadosInfonavit;
	}

	public static function delete($id){
		$db=DataBase::getConnect();
		//$delete=$db->prepare('CALL delete_clientes(:id)');
		$delete=$db->prepare('DELETE FROM empleadoinfonavit WHERE IdEmpleadoInfonavit=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}

}

?>