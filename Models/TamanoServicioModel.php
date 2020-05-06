<?php

class TamanoServicioModel {

	private $Id;
	private $Nombre;

	function __construct($Id, $Nombre){
		$this->setId($Id);
		$this->setNombre($Nombre);
	}

	public function getId(){
		return $this->Id;
	}

	public function setId($Id){
		$this->Id = $Id;
	}

	public function getNombre(){
		return $this->Nombre;
	}

	public function setNombre($Nombre){ 
		$this->Nombre = $Nombre;
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaTamanoServicio=[];
		$select=$db->query('SELECT * FROM tamano_servicios ORDER BY nombre');
		foreach($select->fetchAll() as $TamanoServicio){
			$listaTamanoServicio[]=new TamanoServicioModel($TamanoServicio['id'],$TamanoServicio['nombre']);
		}
		return $listaTamanoServicio;
	}


	public static function save($tipoUnidades){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO c_tipo_unidades VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdTipoUnidades',$tipoUnidades->getIdTipoUnidades());
		$insert->bindValue('DescTipoUnidad',$tipoUnidades->getDescTipoUnidad());
		$insert->execute();
	}



	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_tipo_unidades WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$tipoUDb=$select->fetch();
		$tipoUnidades = new CTipoUnidadesModel ($tipoUDb['IdTipoUnidades'],$tipoUDb['DescTipoUnidad']);
		//var_dump($c_tipo_unidades);
		//die();
		return $tipoUnidades;
	}

	/*
	jlopezl
	public static function update($tipoUnidades){
		$db=DataBase::getConnect();
	    $update=$db->prepare('UPDATE c_tipo_unidades SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$update->bindValue('IdTipoUnidades',$tipoUnidades->getIdTipoUnidades());
		$update->bindValue('DescTipoUnidad',$tipoUnidades->getDescTipoUnidad());
		$update->execute();
		}
		*/
/*
jlopezl
	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM c_tipo_unidades WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}

*/
}
?>