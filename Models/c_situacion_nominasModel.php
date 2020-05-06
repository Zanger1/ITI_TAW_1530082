<?php 

class c_situacion_nominasModel

{

	private $idSituacion_nomina;
	private $DesSituacionNomina;
	
	function __construct($idSituacion_nomina, $DesSituacionNomina)

	{
		$this->setidSituacion_nomina($idSituacion_nomina);
		$this->setDesSituacionNomina($DesSituacionNomina);
	}



	public function getidSituacion_nomina(){
		return $this->idSituacion_nomina;
	}

	public function setidSituacion_nomina($idSituacion_nomina){
		$this->idSituacion_nomina = $idSituacion_nomina;
	}

	public function getDesSituacionNomina(){
		return $this->DesSituacionNomina;
	}

	public function setDesSituacionNomina($DesSituacionNomina){ 
		$this->DesSituacionNomina= $DesSituacionNomina;
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaRol=[];
		$select=$db->query('SELECT * FROM c_situacion_nominas ORDER BY idSituacion_nomina');
		foreach($select->fetchAll() as $roles){
			$listaRol[]=new c_situacion_nominasModel($roles['idSituacion_nomina'],$roles['DesSituacionNomina']);
		}
		return $listaRol;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_situacion_nominas WHERE idSituacion_nomina=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$rolesDb=$select->fetch();
		$rol = new c_situacion_nominasModel($rolesDb['idSituacion_nomina'],$rolesDb['DesSituacionNomina']);
		return $rol;
	}

	public static function getOnlyName($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_situacion_nominas WHERE idSituacion_nomina=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$rolesDb=$select->fetch();
		$rol = new c_situacion_nominasModel($rolesDb['idSituacion_nomina'],$rolesDb['DesSituacionNomina']);
		return $rolesDb['Rol'];
	}
}

?>