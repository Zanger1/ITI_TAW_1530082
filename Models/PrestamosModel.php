<?php

class PrestamosModel{
	
	private $IdEmpleadoPrestamo;
	private $IdEmpleado;
	private $MontoPrestamo;
	private $NoSemanasAPagar;
	private $AbonoBase;
	private $MontoRestante;
	private $FechaInicio;
	private $IdEmpleadoCaptura;
	private $FechaCaptura;
	private $IdEmpleadoElimina;
	private $FechaElimina;
	private $Liquido;
	private $Comentarios;
	private $Status;

	function __construct($IdEmpleadoPrestamo, $IdEmpleado, $MontoPrestamo, $NoSemanasAPagar, $AbonoBase,$MontoRestante, $FechaInicio, $IdEmpleadoCaptura, $FechaCaptura, $IdEmpleadoElimina, $FechaElimina, $Liquido, $Comentarios, $Status){
		$this->setIdEmpleadoPrestamo($IdEmpleadoPrestamo);
		$this->setIdEmpleado($IdEmpleado);
		$this->setMontoPrestamo($MontoPrestamo);
		$this->setNoSemanasAPagar($NoSemanasAPagar);
		$this->setAbonoBase($AbonoBase);
		$this->setMontoRestante($MontoRestante);
		$this->setFechaInicio($FechaInicio);
		$this->setIdEmpleadoCaptura($IdEmpleadoCaptura);
		$this->setFechaCaptura($FechaCaptura);
		$this->setIdEmpleadoElimina($IdEmpleadoElimina);
		$this->setFechaElimina($FechaElimina);
		$this->setLiquido($Liquido);
		$this->setComentarios($Comentarios);
		$this->setStatus($Status);
	}

	public function getIdEmpleadoPrestamo(){
		return $this->IdEmpleadoPrestamo;
	}

	public function setIdEmpleadoPrestamo($IdEmpleadoPrestamo){
		$this->IdEmpleadoPrestamo = $IdEmpleadoPrestamo;
	}

	public function getIdEmpleado(){
		return $this->IdEmpleado;
	}

	public function setIdEmpleado($IdEmpleado){
		$this->IdEmpleado = $IdEmpleado;
	}

	public function getMontoPrestamo(){
		return $this->MontoPrestamo;
	}

	public function setMontoPrestamo($MontoPrestamo){
		$this->MontoPrestamo = $MontoPrestamo;
	}

	public function getNoSemanasAPagar(){
		return $this->NoSemanasAPagar;
	}

	public function setNoSemanasAPagar($NoSemanasAPagar){
		$this->NoSemanasAPagar = $NoSemanasAPagar;
	}

	public function getAbonoBase(){
		return $this->AbonoBase;
	}

	public function setAbonoBase($AbonoBase){
		$this->AbonoBase = $AbonoBase;
	}

	public function getMontoRestante(){
		return $this->MontoRestante;
	}

	public function setMontoRestante($MontoRestante){
		$this->MontoRestante = $MontoRestante;
	}

	public function getFechaInicio(){
		return $this->FechaInicio;
	}

	public function setFechaInicio($FechaInicio){
		$this->FechaInicio = $FechaInicio;
	}

	public function getIdEmpleadoCaptura(){
		return $this->IdEmpleadoCaptura;
	}

	public function setIdEmpleadoCaptura($IdEmpleadoCaptura){
		$this->IdEmpleadoCaptura = $IdEmpleadoCaptura;
	}

	public function getFechaCaptura(){
		return $this->FechaCaptura;
	}

	public function setFechaCaptura($FechaCaptura){
		$this->FechaCaptura = $FechaCaptura;
	}

	public function getIdEmpleadoElimina(){
		return $this->IdEmpleadoElimina;
	}

	public function setIdEmpleadoElimina($IdEmpleadoElimina){
		$this->IdEmpleadoElimina = $IdEmpleadoElimina;
	}

	public function getFechaElimina(){
		return $this->FechaElimina;
	}

	public function setFechaElimina($FechaElimina){
		$this->FechaElimina = $FechaElimina;
	}

	public function getLiquido(){
		return $this->Liquido;
	}

	public function setLiquido($Liquido){
		$this->Liquido = $Liquido;
	}

	public function getComentarios(){
		return $this->Comentarios;
	}

	public function setComentarios($Comentarios){
		$this->Comentarios = $Comentarios;
	}

	public function getStatus(){
		return $this->Status;
	}

	public function setStatus($Status){
		$this->Status = $Status;
	}

	public static function getNombreEmpleado($IdEmpleado){
		$db=Database::getConnect();

		$empleado = $db->prepare('SELECT CONCAT(NombreEmpleado, " ", ApellidoPat," ",Apellidomat) NombreCompleto FROM empleados WHERE IdEmpleado=:idEmp');
		#Hacer procedimiento almacenados
		$empleado->bindvalue('idEmp', $IdEmpleado);
		$empleado->execute();
		$result = $empleado->fetch();
		return $result['NombreCompleto'];
	}

	public static function save($Prestamos){
		$db = Database::getConnect();

		$fecha = date("Y-m-d H:i");

		$insert = $db->prepare('INSERT INTO empleadoprestamo VALUES (NULL,:IdEmpleado,:MontoPrestamo,:NoSemanasAPagar,:AbonoBase,:MontoRestante,:FechaInicio,:IdEmpleadoCaptura, :FechaCaptura, null, null,:Liquido, :Comentarios, :Status)');
		$insert->bindvalue('IdEmpleado', $Prestamos->getIdEmpleado());
		$insert->bindvalue('MontoPrestamo', $Prestamos->getMontoPrestamo());
		$insert->bindvalue('NoSemanasAPagar', $Prestamos->getNoSemanasAPagar());
		$insert->bindvalue('AbonoBase', $Prestamos->getAbonoBase());
		$insert->bindvalue('MontoRestante', $Prestamos->getMontoRestante());
		$insert->bindvalue('FechaInicio', $Prestamos->getFechaInicio());
		$insert->bindvalue('IdEmpleadoCaptura', $Prestamos->getIdEmpleadoCaptura());
		$insert->bindvalue('FechaCaptura', $fecha);
		$insert->bindvalue('Liquido', $Prestamos->getLiquido());
		$insert->bindvalue('Comentarios', $Prestamos->getComentarios());
		$insert->bindvalue('Status', $Prestamos->getStatus());

		$insert->execute();#Validar antes de ejecutar
	}

	public static function update($Prestamos){
		$db=Database::getConnect();

		$update=$db->prepare('UPDATE empleadoprestamo SET IdEmpleado=:IdEmpleado, MontoPrestamo=:MontoPrestamo, NoSemanasAPagar=:NoSemanasAPagar, AbonoBase=:AbonoBase, MontoRestante=:MontoRestante, FechaInicio=:FechaInicio, Liquido=:Liquido, Comentarios=:Comentarios, Status=:Status WHERE IdEmpleadoPrestamo=:IdEmpleadoPrestamo');
		#Hacer procedimientos almacenados
		$update->bindvalue('IdEmpleadoPrestamo', $Prestamos->getIdEmpleadoPrestamo());
		$update->bindvalue('IdEmpleado', $Prestamos->getIdEmpleado());
		$update->bindvalue('MontoPrestamo', $Prestamos->getMontoPrestamo());
		$update->bindvalue('NoSemanasAPagar', $Prestamos->getNoSemanasAPagar());
		$update->bindvalue('AbonoBase', $Prestamos->getAbonoBase());
		$update->bindvalue('MontoRestante', $Prestamos->getMontoRestante());
		$update->bindvalue('FechaInicio', $Prestamos->getFechaInicio());
		$update->bindvalue('Liquido', $Prestamos->getLiquido());
		$update->bindvalue('Comentarios', $Prestamos->getComentarios());
		$update->bindvalue('Status', $Prestamos->getStatus());

		$update->execute();#Validar antes de ejecutar
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaPrestamos=[];
		#$select=$db->query('CALL get_clientes("")');
		$select=$db->query('SELECT * FROM empleadoprestamo');
		foreach($select->fetchAll() as $prestamos){$listaPrestamos[]=new PrestamosModel($prestamos['IdEmpleadoPrestamo'],$prestamos['IdEmpleado'],$prestamos['MontoPrestamo'],$prestamos['NoSemanasAPagar'],$prestamos['AbonoBase'],$prestamos['MontoRestante'],$prestamos['FechaInicio'],$prestamos['IdEmpleadoCaptura'],$prestamos['FechaCaptura'],$prestamos['IdEmpleadoElimina'],$prestamos['FechaElimina'],$prestamos['Liquido'],$prestamos['Comentarios'],$prestamos['Status']);
		}
		return $listaPrestamos;
	}

	public static function get_total_all_records(/*$query_for_counter*/){
		#return $query_for_counter;
		$db=DataBase::getConnect();
		#$select=$db->prepare('CALL get_clientes("")');
		$select=$db->prepare('SELECT e.*, ep.* FROM empleadoprestamo AS ep, empleados AS e WHERE e.IdEmpleado = ep.IdEmpleado AND e.IdSucursal=:IdSucursal AND Liquido=0 AND Status=0');
		$select->bindValue('IdSucursal', $_SESSION['id_sucursal']);
		#$select=$db->prepare($query_for_counter);
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

		//$query = "select * from empleadoprestamo";
		/*
		$query .= 'SELECT e.*, ep.* FROM empleadoprestamo AS ep, empleados AS e WHERE e.IdEmpleado = ep.IdEmpleado AND e.IdSucursal=:IdSucursal AND Liquido=0 AND Status=0';
		*/

		$query .= 'SELECT e.*, ep.* FROM empleadoprestamo AS ep, empleados AS e WHERE e.IdEmpleado = ep.IdEmpleado AND Liquido=0 AND Status=0';

		if (isset($search_filter) || isset($row) || isset($rowperpage)) {
			$query .= ' AND CONCAT(e.NombreEmpleado," ",e.ApellidoPat," ",e.Apellidomat) LIKE "%'.$search_filter.'%"';

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
			$sub_array[] = self::getNombreEmpleado($row['IdEmpleado']);
			$sub_array[] = '$'. $row["MontoPrestamo"];
			$sub_array[] = $row["NoSemanasAPagar"];//CRolesModel::getOnlyName($row["IdRol"]);
			$sub_array[] = '$'. $row["AbonoBase"];
			$sub_array[] = '$'. $row["MontoRestante"];
			//$sub_array[] = shorter($direccion,10);//SucursalesModel::getOnlyName($row["IdSucursal"]);
					if(isset($_SESSION["id_role"])){
						$id_role = $_SESSION["id_role"];
						if($id_role == '3'){ //Solo para auxiliares
								$sub_array[] = '<button type="button" name="view" id="'.$row["IdEmpleadoPrestamo"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdEmpleadoPrestamo"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';
						} else {	//Administradores: General y de sucursal
								$sub_array[] = '<button type="button" name="view" id="'.$row["IdEmpleadoPrestamo"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdEmpleadoPrestamo"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdEmpleadoPrestamo"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
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
		//$select=$db->prepare('CALL get_cliente_id(:id)');
		$select=$db->prepare('SELECT * FROM empleadoprestamo WHERE IdEmpleadoPrestamo = :id');
		$select->bindValue('id',$id);
		$select->execute();
		$prestamosDb=$select->fetch();
		$prestamos = new PrestamosModel ($prestamosDb['IdEmpleadoPrestamo'],$prestamosDb['IdEmpleado'],$prestamosDb['MontoPrestamo'],$prestamosDb['NoSemanasAPagar'],$prestamosDb['AbonoBase'],$prestamosDb['MontoRestante'],$prestamosDb['FechaInicio'],$prestamosDb['IdEmpleadoCaptura'],$prestamosDb['FechaCaptura'],$prestamosDb['IdEmpleadoElimina'],$prestamosDb['FechaElimina'],$prestamosDb['Liquido'],$prestamosDb['Comentarios'],$prestamosDb['Status']);
		//var_dump($alumno);
		//die();
		return $prestamos;
	}

	public static function delete($id, $idEE){
		$db=DataBase::getConnect();

		$fecha = date("Y-m-d H:i");
		$Status = 1;
		//$delete=$db->prepare('CALL delete_clientes(:id)');
		//$delete=$db->prepare('DELETE FROM empleadoprestamo WHERE IdEmpleadoPrestamo=:id');
		$delete=$db->prepare('UPDATE empleadoprestamo SET IdEmpleadoElimina=:IdEmpleadoElimina, FechaElimina=:FechaElimina, Status=:Status WHERE IdEmpleadoPrestamo=:id');
		$delete->bindValue('IdEmpleadoElimina', $idEE);
		$delete->bindValue('FechaElimina', $fecha);
		$delete->bindValue('Status', $Status);
		$delete->bindValue('id',$id);
		$delete->execute();
	}

}

?>