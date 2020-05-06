<?php 
class UnidadesRentaModel {	private $IdUnidadRenta;
	private $DesUnidad;
	function __construct($IdUnidadRenta, $DesUnidad){
		$this->setIdUnidadRenta($IdUnidadRenta);
		$this->setDesUnidad($DesUnidad);
	}
	public function getIdUnidadRenta(){
		return $this->IdUnidadRenta;
	}
	public function setIdUnidadRenta($IdUnidadRenta){
		$this->IdUnidadRenta = $IdUnidadRenta;
	}	public function getDesUnidad(){
		return $this->DesUnidad;
	}
	public function setDesUnidad($DesUnidad){
		$this->DesUnidad = $DesUnidad;
	}
	public static function save($unidad){
		$db=DataBase::getConnect();
		$insert=$db->prepare('CALL add_usuarios(:IdEmpleado, :usuario, :contrasena, :IdRol, :IdSucursal, :estatus)');
		$insert->bindValue('IdEmpleado',$admin->getIdEmpleado());
		$insert->bindValue('usuario',$admin->getUsuario());
		$insert->execute();				//Un empleado se vuelve user		EmpleadosModel::switch_user($admin->getIdEmpleado(),1);
	}
	public static function get_total_all_records(){
		$db=DataBase::getConnect();
		$select=$db->prepare('CALL get_usuarios("","")');
		$select->execute();
		$result = $select->fetchAll();
		return $select->rowCount();
	}
	public static function all_json(){
		$db=DataBase::getConnect();
		$output = array();		$filtro_busqueda=$_POST["search"]["value"];	//El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]		$filtro_sucursal = "";		if(isset($_GET["IdSucursal"])) { $filtro_sucursal = $_GET["IdSucursal"]; } else { $filtro_sucursal = ""; }
		$query = 'CALL get_usuarios(:busqueda,:sucursal)';		#$query = "SELECT * FROM usuarios ";
/*		$query .= "SELECT * FROM usuarios ";
		if(isset($_POST["search"]["value"])){
			$query .= 'WHERE usuario LIKE "%'.$_POST["search"]["value"].'%" ';
		}
		if(isset($_POST["order"])){
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		} else {
			$query .= 'ORDER BY IdUsuario DESC ';
		}
		if($_POST["length"] != -1){
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		} */		
		$statement = $db->prepare($query);				$statement->bindValue(':busqueda', $filtro_busqueda);	//Al param :busqueda se le asigna el $filtro_busqueda. ref[1],		$statement->bindValue(':sucursal', $filtro_sucursal);	//Al param :busqueda se le asigna el $filtro_sucursal. 
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row){
			$situacion = '';
			if($row["estatus"]=='1'){ $situacion = 'ACTIVO'; } else { $situacion = 'INACTIVO'; }
			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
			$sub_array = array();
			$sub_array[] = EmpleadosModel::getOnlyName($row["IdEmpleado"]);
			$sub_array[] = $row["usuario"];
			$sub_array[] = CRolesModel::getOnlyName($row["IdRol"]);
			$sub_array[] = SucursalesModel::getOnlyName($row["IdSucursal"]);
			$sub_array[] = $situacion;
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdUsuario"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdUsuario"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdUsuario"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
			$data[] = $sub_array;
		}
		$output = array(
			"draw"    => intval($_POST["draw"]),
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
	public static function all(){
		$db=DataBase::getConnect();
		$lista=[];
		$select=$db->query('SELECT * FROM unidades_renta');
		foreach($select->fetchAll() as $item){
			$lista[]=new UnidadesRentaModel($item['IdUnidadRenta'],$item['DesUnidad']);
		}
		return $lista;
	}
	public static function searchById($id){
		$db=DataBase::getConnect();
#		$select=$db->prepare('SELECT * FROM usuarios WHERE IdUsuario=:id');
		$select=$db->prepare('CALL get_usuario_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$adminDataBase=$select->fetch();
		return $adminDataBase['IdUsuario'];
	}
	public static function update($admin){
		$db=DataBase::getConnect();
		if(isset($_POST["contrasena"])){
			$new_pass = md5($_POST["contrasena"]); //(La nueva con md5)
		} if(empty($_POST["contrasena"])) {
			$new_pass = self::currentPassword($admin->getIdUsuario()); //(La que ya tenia)
		}		$estatus = '';		if(isset($_POST["estatus"])){			$estatus = 1;		} else {			$estatus = 0;		}
		#echo '<script>alert("'.$new_pass.'");</script>';
		$update=$db->prepare('CALL edit_usuarios(:IdUsuario, :IdEmpleado, :usuario, :contrasena, :IdRol, :IdSucursal, :estatus)  ');
		$update->bindValue('IdUsuario',$admin->getIdUsuario());
		$update->bindValue('IdEmpleado',$admin->getIdEmpleado());		$update->bindValue('usuario',$admin->getUsuario());		$update->bindValue('contrasena',$new_pass	/*$admin->getPassword()*/);		$update->bindValue('IdRol',$admin->getIdRol());		$update->bindValue('IdSucursal',$admin->getIdSucursal());		$update->bindValue('estatus',$estatus);		$update->execute();
	}
	public static function delete($id){
		$db=DataBase::getConnect();
		//Un empleado deja de ser empleado:		$id_empleado = self::getEmployeByUserRef($id);		EmpleadosModel::switch_user($id_empleado,0);		//Y posteriormente el usuario es borrado
		$delete=$db->prepare('CALL delete_usuarios(:id)');
		$delete->bindValue('id',$id);
		$delete->execute();	}}
?>