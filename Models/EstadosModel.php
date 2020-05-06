<?php 

class EstadosModel {
	
	/*
	 * se ha remplazado la tabla 'estados' por 'entidad'. cve_ent sera el nuevo ID, nom_ent sera el nuevo nombre
	 */

	private $IdEstado;
	private $Estado;
	
	function __construct($IdEstado, $Estado){
		$this->setIdEstado($IdEstado);
		$this->setEstado($Estado);
	}

	public function getIdEstado(){
		return $this->IdEstado;
	}

	public function setIdEstado($IdEstado){
		$this->IdEstado = $IdEstado;
	}

	public function getEstado(){
		return $this->Estado;
	}

	public function setEstado($Estado){ 
		$this->Estado = $Estado;
	}


	public static function save($roles)
	{
		/*
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO c_estados VALUES (NULL, :Estado)');
		$insert->bindValue('Estado',$roles->getEstado());
		$insert->execute();
		*/
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaEstados=[];
		#$select=$db->query('SELECT * FROM c_estados order by IdEstado');
		$select=$db->prepare('SELECT * FROM entidad order by cve_ent');
		#$select->fetchAll();
		$select->execute();
		/*foreach($select->fetchAll() as $roles){
			$listaEstados[]=new EstadosModel($roles['IdEstado'],$roles['Estado']);
		}*/
		foreach($select->fetchAll() as $e){
			$listaEstados[]=new EstadosModel($e['cve_ent'],$e['nom_ent']);
		}
		return $listaEstados;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
#		$select=$db->prepare('SELECT * FROM c_estados WHERE IdEstado=:id');
#		$select=$db->prepare('SELECT * FROM entidad WHERE cve_ent=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$rolesDb=$select->fetch();
		$rol = new EmpleadosModel ($rolesDb['cve_ent'],$rolesDb['nom_ent']);
		return $rol;
	}

	public static function getOnlyName($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM entidad WHERE cve_ent=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$rolesDb=$select->fetch();
		#$rol = new EstadosModel($rolesDb['IdEstado'],$rolesDb['Estado']);
		return $rolesDb['nom_ent'];
	}

	public static function update($roles)
	{
		/*
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE c_estados SET Estado=:Estado WHERE IdEstado=:id');
		$insert->bindValue('IdEstado',$roles->getIdRol());
		$insert->bindValue('Estado',$roles->getRol());
		$insert->execute();
		*/
	}

	public static function delete($id)
	{/*
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE FROM c_estados WHERE IdEstado=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
		*/
	}

}

?>