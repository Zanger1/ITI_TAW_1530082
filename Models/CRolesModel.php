<?php 

class CRolesModel

{

	private $IdRol;
	private $Rol;
	
	function __construct($IdRol, $Rol)

	{

		$this->setIdRol($IdRol);

		$this->setRol($Rol);

	}



	public function getIdRol(){
		return $this->IdRol;
	}

	public function setIdRol($IdRol){
		$this->IdRol = $IdRol;
	}

	public function getRol(){
		return $this->Rol;
	}

	public function setRol($Rol){ 
		$this->Rol = $Rol;
	}

	public static function save($roles){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO roles VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdRol',$roles->getIdRol());
		$insert->bindValue('Rol',$roles->getRol());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaRol=[];
		$select=$db->query('SELECT * FROM c_roles order by IdRol');
		foreach($select->fetchAll() as $roles){
			$listaRol[]=new CRolesModel($roles['IdRol'],$roles['Rol']);
		}
		return $listaRol;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_roles WHERE IdRol=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$rolesDb=$select->fetch();
		$rol = new EmpleadosModel ($rolesDb['IdRol'],$rolesDb['Rol']);
		return $rol;
	}

	public static function getOnlyName($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_roles WHERE IdRol=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$rolesDb=$select->fetch();
		$rol = new CRolesModel ($rolesDb['IdRol'],$rolesDb['Rol']);
		return $rolesDb['Rol'];
	}

	public static function update($roles){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdRol',$roles->getIdRol());
		$insert->bindValue('Rol',$roles->getRol());
		$insert->execute();
	}

	public static function delete($id){
		/*$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM alumno WHERE IdRol=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
		*/
	}

}

?>