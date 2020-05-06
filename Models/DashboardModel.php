<?php 
class DashboardModel {
	private static $sql_tabla = "usuarios";
	private $IdUsuario;
	private $IdEmpleado;
	private $usuario;
	private $contrasena;
	private $IdRol;
	private $estatus;

	function __construct($IdUsuario, $IdEmpleado, $usuario, $contrasena, $idRol, $estatus)
	{
		$this->setIdUsuario($idUsuario);
		$this->setIdEmpleado($idEmpleado);
		$this->setUsuario($usuario);
		$this->setContrasena($contrasena);
		$this->setIdRol($IdRol);
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

	public function getEstatus(){
		return $this->estatus;
	}

	public function setEstatus($estatus){
		if (strcmp($estatus, 'on')==0) {
			$this->estatus=1;
		} elseif(strcmp($estatus, '1')==0) {
			$this->estatus='checked';
		}elseif (strcmp($estatus, '0')==0) {
			$this->estatus='off';
		}else {
			$this->estatus=0;
		}
	}
	
	public static function save($admin){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();

		$insert=$db->prepare('INSERT INTO '.self::$sql_tabla.' VALUES (NULL, :nombre, :apellido, :usuario, :email, :password, :estado, :role, :id_sucursal)');
		$insert->bindValue('nombre',$admin->getNombre());
		$insert->bindValue('apellido',$admin->getApellido());
		$insert->bindValue('usuario',$admin->getUsuario());
		$insert->bindValue('email',$admin->getEmail());
		$insert->bindValue('password',md5($_POST["password"])/*$admin->getPassword()*/);
		$insert->bindValue('estado',$admin->getEstado());
		$insert->bindValue('role',$admin->getRole());
		$insert->bindValue('id_sucursal',$admin->getSucursal());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaAdmins=[];

		$select=$db->query('SELECT * FROM '.self::$sql_tabla.' ORDER BY id');

		foreach($select->fetchAll() as $admin){
			$listaAdmins[]=new Usuarios($admin['id'],$admin['nombre'],$admin['apellido'],$admin['usuario'],$admin['email'],$admin['password'],$admin['estado'],NULL,$admin['id_sucursal']);
		}
		return $listaAdmins;
	}
	
	public static function allSelect(){
		$db=DataBase::getConnect();
		$listaAdmins=[];

		$select=$db->query('SELECT * FROM '.self::$sql_tabla.' order by id');

		foreach($select->fetchAll() as $admin){
			$listaAdmins[]=new Usuarios($admin['id'],$admin['nombre'],$admin['apellido'],$admin['usuario'],$admin['email'],$admin['password'],$admin['estado'],$admin['role'], $admin['id_sucursal'] );
		}
		return $listaAdmins;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM '.self::$sql_tabla.' WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$adminDataBase=$select->fetch();


		$admin = new Usuarios($adminDataBase['id'],$adminDataBase['nombre'], $adminDataBase['apellido'], $adminDataBase['usuario'], $adminDataBase['email'], $adminDataBase['password'], $adminDataBase['estado'], $adminDataBase['role'], $adminDataBase['id_sucursal']);
		//var_dump($alumno);
		//die();
		return $admin;

	}


	public static function showSucursal($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT s.id, s.nombre, u.id, u.id_sucursal FROM '.prefix.table_sucursales.' AS s, '.self::$sql_tabla.' AS u WHERE u.id_sucursal=s.id AND u.id_sucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$adminDataBase=$select->fetch();
		$admin = [];#test
		$admin = new Usuarios (NULL,$adminDataBase['nombre'],NULL,NULL,NULL,NULL,NULL,NULL,NULL);
		//return $admin;
		echo $admin->nombre;
	}

	public static function currentPassword($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT password FROM '.self::$sql_tabla.' WHERE id="'.$id.'" ');
		$select->bindValue('id',$id);
		$select->execute();
		$admin=$select->fetch();
		return $admin["password"];
	}
	
	
	public static function update($admin){
		$db=DataBase::getConnect();
		
		if(isset($_POST["password"])){
			$new_pass = md5($_POST["password"]); //(La nueva con md5)
		} if(empty($_POST["password"])) {
			$new_pass = self::currentPassword($admin->getId()); //(La que ya tenia)
		}
		
		#echo '<script>alert("'.$new_pass.'");</script>';
		
		$update=$db->prepare('UPDATE '.self::$sql_tabla.' SET nombre=:nombre, apellido=:apellido, usuario=:usuario, email=:email, password=:password, estado=:estado, role=:role, id_sucursal=:id_sucursal WHERE id=:id');
		$update->bindValue('nombre', $admin->getNombre());
		$update->bindValue('apellido',$admin->getApellido());
		$update->bindValue('usuario',$admin->getUsuario());
		$update->bindValue('email',$admin->getEmail());		
		$update->bindValue('password', $new_pass); //$admin->getPassword()); //(La que ya tenia)
		$update->bindValue('estado',$admin->getEstado());
		$update->bindValue('role',$admin->getRole());
		$update->bindValue('id_sucursal',$admin->getSucursal());
		$update->bindValue('id',$admin->getId());
		$update->execute();
	}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE FROM '.self::$sql_tabla.' WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
	
	public static function sign_in($session){
			$db=DataBase::getConnect();
		if(isset($_POST["username"]) && isset($_POST["password"])){
			echo '<script>alert("PROBANDO");</script>';
			$select=$db->prepare('SELECT * FROM '.self::$sql_tabla.' WHERE usuario=:usuario AND contrasena=:contrasena');
			$select->bindValue('usuario',$_POST["username"]);
			$select->bindValue('contrasena',md5($_POST["password"]));
			$select->execute();
			$session_result = $select->fetchAll();
				if(count($session)>=1){
					foreach($session_result as $session){
						$session[]=new Session($session['idUsuario'], $session['usuario'], $session["IdRol"], $session["estatus"] );
						$_SESSION["id_user"]=$session['idUsuario'];
						$_SESSION["username"]=$session['usuario'];
						$_SESSION["role"]=$session['IdRol'];
						$_SESSION["status"]=$session['estatus'];
						#echo '<script>window.location.href = "./";</script>';
					}
				}
				//Si pongo el mensaje dentro de un else, ECHO no muestra nada
				echo '<script>alert("Los datos no coinciden");window.location.href = "./";</script>';
		}
	}

}

?>