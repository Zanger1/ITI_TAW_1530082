<?php 

class UsuariosModel {

	private static $sql_tabla = "usuarios";
	private $IdUsuario;
	private $IdEmpleado;
	private $usuario;
	private $contrasena;
	private $IdRol;
	private $IdSucursal;
	private $estatus;

	function __construct($IdUsuario, $IdEmpleado, $usuario, $contrasena, $IdRol, $IdSucursal, $estatus){
		$this->setIdUsuario($IdUsuario);
		$this->setIdEmpleado($IdEmpleado);
		$this->setUsuario($usuario);
		$this->setContrasena($contrasena);
		$this->setIdRol($IdRol);
		$this->setIdSucursal($IdSucursal);
		$this->setEstatus($estatus);
	}

	public function getIdUsuario(){
		return $this->IdUsuario;
	}

	public function setIdUsuario($IdUsuario){
		$this->IdUsuario = $IdUsuario;
	}

	public function getIdEmpleado(){
		return $this->IdEmpleado;
	}

	public function setIdEmpleado($IdEmpleado){
		$this->IdEmpleado = $IdEmpleado;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	public function getContrasena(){
		return $this->contrasena;
	}

	public function setContrasena($contrasena){
		$this->contrasena = $contrasena;
	}

	public function getIdRol(){
		return $this->IdRol;
	}

	public function setIdRol($IdRol){
		$this->IdRol = $IdRol;
	}

	public function getIdSucursal(){
		return $this->IdSucursal;
	}

	public function setIdSucursal($IdSucursal){
		$this->IdSucursal = $IdSucursal;
	}

	public function getEstatus(){
		return $this->estatus;
	}

	public function setEstatus($estatus){
/*		if (strcmp($estatus, 'on')==0) {
			$this->estatus=1;
		} elseif(strcmp($estatus, '1')==0) {
			$this->estatus='checked';
		}elseif (strcmp($estatus, '0')==0) {
			$this->estatus='off';
		}else {
			$this->estatus=0;
		} */
		$this->estatus = $estatus;
	}

	public static function save($admin){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		
		$estatus = '';
		if(isset($_POST["estatus"])){
			$estatus = 1;
		} else {
			$estatus = 0;
		}
		
		//Primero vemos la disponibildad del nombre de usuario
		$check_avaliable = DataBase::check_repeated_row("usuarios", "usuario", $admin->getUsuario());
		if($check_avaliable==0){
			//Disponible
			
			//Procede a insertar datos
			$insert=$db->prepare('CALL add_usuarios(:IdEmpleado, :usuario, :contrasena, :IdRol, :IdSucursal, :estatus)');
			$insert->bindValue('IdEmpleado',$admin->getIdEmpleado());
			$insert->bindValue('usuario',$admin->getUsuario());
			$insert->bindValue('contrasena',md5($_POST["contrasena"])	/*$admin->getPassword()*/);
			$insert->bindValue('IdRol',$admin->getIdRol());
			$insert->bindValue('IdSucursal',$admin->getIdSucursal());
			$insert->bindValue('estatus',$estatus);
	//		$insert->bindValue('IdUsuario',$admin->getIdUsuario());
			$insert->execute();
			
			//Un empleado se vuelve user
			EmpleadosModel::switch_user($admin->getIdEmpleado(),1);

		} else if($check_avaliable==1){
			//No Disponible
			//Mandar error via AJAX
			
				$response_array['status'] = 'error'; 
				header('Content-type: application/json');
				echo json_encode($response_array);
			
		}
		
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaAdmins=[];
		$select=$db->query("get_usuarios('','')");
		foreach($select->fetchAll() as $admin){
			$listaAdmins[]=new UsuariosModel($admin['IdUsuario'],$admin['IdEmpleado'],$admin['usuario'],null,$admin['IdRol'],$admin['IdSucursal'],$admin['estatus']);
		}
		return $listaAdmins;
	}

	public static function get_total_all_records($query_for_counter){
		/*
			$filtro_sucursal = '';
			if(isset($_GET["IdSucursal"])){
				$filtro_sucursal = $_GET["IdSucursal"];
			} else {
				$filtro_sucursal = $_SESSION["id_sucursal"];
			}
		*/
		$db=DataBase::getConnect();
		#$select=$db->prepare('CALL get_usuarios("","'.$filtro_sucursal.'")');
		$select=$db->prepare($query_for_counter);
		$select->execute();
		$result = $select->fetchAll();
		return $select->rowCount();
	}

	public static function all_json(){
		if(isset($_POST['start']) || isset($_POST['length']) || isset($_POST['search']) || isset($_POST['order']) || isset($_POST['column']) || isset($_POST['columns']) ){
			$row = $_POST['start'];
			$rowperpage = $_POST['length'];
			$search_filter = $_POST["search"]["value"];
		} else {
			$search_filter = '';
			$row=''; $rowperpage =''; //Para que el paginador funcione	-- Bug corregido
		}
		if(isset($_GET["IdSucursal"])) 
			{ 
				$filtro_sucursal = $_GET["IdSucursal"]; 
			} 
			else 
			{ 
				$filtro_sucursal = $_SESSION['id_sucursal']; 
			}

		$db=DataBase::getConnect();
		$output = array();
#		$filtro_busqueda=$_POST["search"]["value"];	//El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]
#		$filtro_sucursal = "";
#		if(isset($_GET["IdSucursal"])) { $filtro_sucursal = $_GET["IdSucursal"]; } else { $filtro_sucursal = $_SESSION["id_sucursal"]; }
#		$query = 'CALL get_usuarios(:busqueda,:sucursal)';
		#$query = "SELECT * FROM usuarios ";
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


		$query = "SELECT * FROM usuarios ";
####
		if( isset($search_filter) || isset($row) || isset($rowperpage) ){
			$query .= 'WHERE  usuario LIKE "%'.$search_filter.'%"  ';	//AND eliminado=0

			//Filtro de sucursal
			if($filtro_sucursal>0){
				$query .= 'AND IdSucursal = '.$filtro_sucursal.' ';
			}

			$query_for_counter = $query; //hasta aqui se le envia al contador total, sin limitar registros por pagina con el bloque if posterior

			if( isset($row) ||  isset($rowperpage) AND $row>0  || $rowperpage>0){
				//Si se executa desde el navegador marca error, porque la paginacion se recive via $_POST 
				$query .= ' limit '.$row.','.$rowperpage.' ';	//Limitar cantidad de resultados por pagina dentro de la tabla
			}
		}
####

		$statement = $db->prepare($query);		
#		$statement->bindValue(':busqueda', $filtro_busqueda);	//Al param :busqueda se le asigna el $filtro_busqueda. ref[1],
#		$statement->bindValue(':sucursal', $filtro_sucursal);	//Al param :busqueda se le asigna el $filtro_sucursal. 
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


						/* Deshabilitacion de acciones Por rango de roles - Inicio */
						$hiddenByRol = '';	//No los esconde, solo los deshabilita
						if(isset($_SESSION["id_role"])){
							if($_SESSION["id_role"]==3 && $row["IdRol"]<3){	//Auxiliar de adm de sucursal
								$hiddenByRol = 'disabled';
							}
							if($_SESSION["id_role"]==2 && $row["IdRol"]==1){	//adm sucursal
								$hiddenByRol = 'disabled';
							}
							if($_SESSION["id_role"]==1){	//adm gral
								$hiddenByRol = '';
							}
						} /* Deshabilitacion de acciones Por rango de roles - Fin [Podras encontrar un bloque de codigo igual en el modelo del mismo modulo, metodo: all_json] */
			
$disabled = ''; if($_SESSION["id_user"] == $row["IdUsuario"]){ $disabled='disabled'; } else { $disabled = '';}

if(isset($_SESSION["id_role"])){
	$id_role = $_SESSION["id_role"];
	if($id_role == '3'){ //Solo para auxiliares
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdUsuario"].'" '.$hiddenByRol.' class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdUsuario"].'" '.$hiddenByRol.' class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button>';
	} else {	//Administradores: General y de sucursal
			$sub_array[] = '<button type="button" name="view" id="'.$row["IdUsuario"].'" '.$hiddenByRol.' class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdUsuario"].'" '.$hiddenByRol.' class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdUsuario"].'" '.$hiddenByRol.' class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar" '.$disabled.'><i class="fa fa-trash"></i></button>';
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

	public static function allSelect(){
		$db=DataBase::getConnect();
		$listaAdmins=[];
		$select=$db->query('SELECT * FROM '.self::$sql_tabla.' order by id');
		foreach($select->fetchAll() as $admin){
			$listaAdmins[]=new UsuariosModel($admin['IdUsuario'],$admin['IdEmpleado'], $admin['usuario'], $admin['contrasena'], $admin['IdRol'], $admin['IdSucursal'], $admin['estatus']);
		}
		return $listaAdmins;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
#		$select=$db->prepare('SELECT * FROM usuarios WHERE IdUsuario=:id');
		$select=$db->prepare('CALL get_usuario_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$adminDataBase=$select->fetch();
		$admin = new UsuariosModel($adminDataBase['IdUsuario'],$adminDataBase['IdEmpleado'], $adminDataBase['usuario'], $adminDataBase['contrasena'], $adminDataBase['IdRol'], $adminDataBase['IdSucursal'], $adminDataBase['estatus']);
		//var_dump($alumno);
		//die();
		return $admin;
	}
	



	public static function getEmployeByUserRef($id){	//Recibe por Referencia el ID de usuario y devuelve el ID de empleado
		$db=DataBase::getConnect();
#		$select=$db->prepare('SELECT * FROM usuarios WHERE IdUsuario=:id');
		$select=$db->prepare('CALL get_usuario_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$adminDataBase=$select->fetch();
		return $adminDataBase['IdEmpleado'];
	}

	public static function showSucursal($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT s.id, s.nombre, u.id, u.id_sucursal FROM '.prefix.table_sucursales.' AS s, '.self::$sql_tabla.' AS u WHERE u.id_sucursal=s.id AND u.id_sucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$adminDataBase=$select->fetch();
		$admin = [];#test
		$admin = new UsuariosModel(NULL,$adminDataBase['nombre'],NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		//return $admin;
		echo $admin->nombre;
	}

	public static function currentPassword($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT contrasena FROM '.self::$sql_tabla.' WHERE idUsuario="'.$id.'" ');
		$select->bindValue('id',$id);
		$select->execute();
		$admin=$select->fetch();
		return $admin["contrasena"];
	}

	public static function check_username($usuario){
		//For AJAX
		#if(isset($_POST["usuario"])){
			$db=DataBase::getConnect();
			$select=$db->prepare('SELECT usuario FROM usuarios WHERE usuario=:usuario');
			$select->bindValue('usuario',$usuario);
			$select->execute();
			#$admin=$select->fetch();
			$select->fetch();
			$preview = $select->fetch();
			if($select->rowCount() > 0){
				return '<img src="themes/lte/assets/dist/img/not-available.png" /> el usuario "<b>'.$usuario.'</b>" no est&aacute; disponible';
			} else {
				if($usuario==""){
					return '<img src="themes/lte/assets/dist/img/not-available.png" /> Escriba algo';
				} else {
					return '<img src="themes/lte/assets/dist/img/available.png" /> el usuario "<b>'.$usuario.'</b>" est&aacute; disponible';
				}
			}
			#return $admin["usuario"];
		#}
	}
	
	public static function update($admin){
		$db=DataBase::getConnect();
		if(isset($_POST["contrasena"])){
			$new_pass = md5($_POST["contrasena"]); //(La nueva con md5)
		} if(empty($_POST["contrasena"])) {
			$new_pass = self::currentPassword($admin->getIdUsuario()); //(La que ya tenia)
		}
		$estatus = '';
		if(isset($_POST["estatus"])){
			$estatus = 1;
		} else {
			$estatus = 0;
		}
		
		//Primero vemos la disponibildad del nombre de usuario
		$current_value = DataBase::check_current_value("usuarios", "usuario", "IdUsuario", $admin->getIdUsuario());
		$check_avaliable = DataBase::check_repeated_row("usuarios", "usuario", $admin->getUsuario());
		if($check_avaliable==0 || $current_value == $admin->getUsuario()){	//Si el usuario esta disponible y si el usuario actual es el mismo que se esta mandando

			//Disponible
			#echo '<script>alert("'.$new_pass.'");</script>';
			$update=$db->prepare('CALL edit_usuarios(:IdUsuario, :IdEmpleado, :usuario, :contrasena, :IdRol, :IdSucursal, :estatus)  ');
			$update->bindValue('IdUsuario',$admin->getIdUsuario());
			$update->bindValue('IdEmpleado',$admin->getIdEmpleado());
			$update->bindValue('usuario',$admin->getUsuario());
			$update->bindValue('contrasena',$new_pass	/*$admin->getPassword()*/);
			$update->bindValue('IdRol',$admin->getIdRol());
			$update->bindValue('IdSucursal',$admin->getIdSucursal());
			$update->bindValue('estatus',$estatus);
			$update->execute();
		
		} else if($check_avaliable==1){
			//No Disponible
			//Mandar error via AJAX
			
				$response_array['status'] = 'error'; 
				header('Content-type: application/json');
				echo json_encode($response_array);
			
		}
		
	}

	public static function delete($id){
		$db=DataBase::getConnect();

		//Un empleado deja de ser usuario:
		$id_empleado = self::getEmployeByUserRef($id);
		EmpleadosModel::switch_user($id_empleado,0);

		//Y posteriormente el usuario es borrado
		$delete=$db->prepare('CALL delete_usuarios(:id)');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
	
	public static function permission_combobox(){
		//A ver si no me da error por poner esta linea aqui, pero al parecer se acaba la session, 
		//entonces provoca que el combobox se deshabilite en cortos periodos de tiempo
		#if(isset($_GET["action"]) && $_GET["action"]=='index'){ session_start(); }
		/* if(empty($_SESSION["id_empleado"]) || empty($_SESSION["id_role"])){ 
			session_start();
		} */
		if(isset($_SESSION["id_role"])){
			$id_role = $_SESSION["id_role"];
			if($id_role !== '1'){
				return 'disabled';
			} else {
				
			}
		}
	}



	public static function sign_in($session){
		if(isset($_POST["username"]) && isset($_POST["password"]))
		{
			$db=DataBase::getConnect();
			#echo '<script>alert("PROBANDO");</script>';
#			$select=$db->prepare('SELECT * FROM '.self::$sql_tabla.' WHERE usuario=:usuario AND contrasena=:contrasena');
			$select=$db->prepare('CALL sign_in(:usuario,:contrasena)');
			$select->bindValue('usuario',$_POST["username"]);
			$select->bindValue('contrasena',md5($_POST["password"]));
			$select->execute();
			$session_result = $select->fetchAll();
			$select->closeCursor();
				if(count($session_result)>=1)
				{
					foreach($session_result as $session)
					{
						if($session['estatus']=="1")
						{
							//Sessiones
							$session[]=new UsuariosModel($session['IdUsuario'], $session['IdEmpleado'], $session['usuario'], NULL, $session["IdRol"], $session["IdSucursal"], $session["estatus"] );
							$_SESSION["id_user"]=$session['IdUsuario'];
							$_SESSION["id_employe"]=$session['IdEmpleado'];
							$_SESSION["fullname"]=EmpleadosModel::getOnlyName($session['IdEmpleado']);
							$_SESSION["username"]=$session['usuario'];
							$_SESSION["id_role"]=$session['IdRol'];
							$_SESSION["role"]=CRolesModel::getOnlyName($session['IdRol']);
							$_SESSION["id_sucursal"]=$session['IdSucursal'];
							$_SESSION["sucursal"]=SucursalesModel::getOnlyName($session['IdSucursal']);
							$_SESSION["status"]=$session['estatus'];
							//Cookies
							#...
							#echo '<script>alert("Bienvenido");window.location.href = "./";</script>';
							//lo redirecciona al index principal del sitio
							echo '<script>window.location.href = "./";</script>';
						} 
						else if($session['estatus']=="0") 
						{
							echo '<script>alert("Esta cuenta de usuario se encuentra inactiva. Solicita a un administrador la re-activación de tu cuenta");window.location.href = "./";</script>';
						}
							
					}
				} 
				else 
				{
					//echo '<script>alert("Los datos no coinciden");window.location.href = "./";</script>';

					//echo '<span>El usuario y/o clave son incorrectas, vuelva a intentarlo.</span>' ;

					//echo '<script> document.getElementById("error").innerHTML = "El usuario y/o clave son incorrectas, vuelva a intentarlo.";</script>';

					echo '<script> document.getElementById("error").innerHTML = `El usuario y/o clave son incorrectas, vuelva a intentarlo.`; </script>';
				}
		}
	}
}


?>