<?php 

class CiudadesModel {

	private $Id_ciudad;
	private $Ciudad;
	private $IdEstado;
	
	function __construct($Id_ciudad, $Ciudad, $IdEstado){
		$this->setId_ciudad($Id_ciudad);
		$this->setCiudad($Ciudad);
		$this->setIdEstado($IdEstado);
	}

	public function getId_ciudad(){
		return $this->Id_ciudad;
	}

	public function setId_ciudad($Id_ciudad){ 
		$this->Id_ciudad = $Id_ciudad;
	}

	public function getCiudad(){
		return $this->Ciudad;
	}

	public function setCiudad($Ciudad){ 
		$this->Ciudad = $Ciudad;
	}
	
	public function getIdEstado(){
		return $this->IdEstado;
	}

	public function setIdEstado($IdEstado){
		$this->IdEstado = $IdEstado;
	}

	public static function save($roles){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO c_ciudades VALUES (NULL, :Ciudad, IdEstado)');
		$insert->bindValue('Ciudad',$roles->getRol());
		$insert->bindValue('IdEstado',$roles->getRol());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaCiudades=[];
		#$select=$db->query('SELECT * FROM c_ciudades order by Id_ciudad');
		$select=$db->query('SELECT * FROM municipio');
		foreach($select->fetchAll() as $roles){
			#$listaCiudades[]=new CiudadesModel($roles['Id_ciudad'],$roles['Ciudad'],$roles['IdEstado']);
			$listaCiudades[]=new CiudadesModel($roles['idm'],$roles['nom_mun'],$roles['cve_ent']);
		}
		return $listaCiudades;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_ciudades WHERE Id_ciudad=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$rolesDb=$select->fetch();
		$rol = new CiudadesModel ($rolesDb['Id_ciudad'],$rolesDb['Ciudad'],$rolesDb['IdEstado']);
		return $rol;
	}

	public static function searchByIdEstado($id){
		//Este metodo es llamado via AJAX para mostrar los municipios que pertenecen a una entidad
		$db=DataBase::getConnect();
		$listaEstados=[];
		#$select=$db->query('SELECT * FROM c_estados order by IdEstado');
		$select=$db->prepare('SELECT * FROM municipio WHERE cve_ent=:id');
		$select->bindValue('id',$id);
		#$select->fetchAll();
		$select->execute();
		foreach($select->fetchAll() as $e){
			$listaEstados[]=new CiudadesModel($e['idm'],$e['nom_mun'],$e['cve_ent']);
		}
		return $listaEstados;
	}

	public static function getEstadoByCiudadRef($id){
		//Quiero saber a que ID de estado pertenece una ciudad, si ya conozco el ID de ciudad como Referencia en parametro
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM municipio WHERE idm=:id');//id del municipio 
		$select->bindValue('id',$id);
		$select->execute();
		$entidad=$select->fetch();
		return $entidad['cve_ent'];
	}
	
	public static function getOnlyName($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM municipio WHERE idm=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$rolesDb=$select->fetch();
		#$rol = new CiudadesModel ($rolesDb['Id_ciudad'],$rolesDb['Ciudad'],$rolesDb['IdEstado']);
		return $rolesDb['nom_mun'];
	}

	public static function update($roles){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE c_ciudades SET Estado=:Ciudad, IdEstado=:IdEstado WHERE IdEstado=:Id_ciudad');
		$insert->bindValue('Ciudad',$roles->getCiudad());
		$insert->bindValue('IdEstado',$roles->getIdEstado());
		$insert->bindValue('Id_ciudad',$roles->getId_ciudad());
		$insert->execute();
	}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE FROM c_ciudades WHERE Id_ciudad=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}

}

?>