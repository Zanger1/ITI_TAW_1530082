<?php
class CTipoUnidadesModel {
	private $IdTipoUnidades;
	private $DescTipoUnidad;
	function __construct($IdTipoUnidades, $DescTipoUnidad){
		$this->setIdTipoUnidades($IdTipoUnidades);
		$this->setDescTipoUnidad($DescTipoUnidad);
	}
	public function getIdTipoUnidades(){
		return $this->IdTipoUnidades;
	}
	public function setIdTipoUnidades($IdTipoUnidades){
		$this->IdTipoUnidades = $IdTipoUnidades;
	}
	public function getDescTipoUnidad(){
		return $this->DescTipoUnidad;
	}
	public function setDescTipoUnidad($DescTipoUnidad){ 
		$this->DescTipoUnidad = $DescTipoUnidad;
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
	public static function all(){
		$db=DataBase::getConnect();
		$listatipoUnidades=[];
		$select=$db->query('SELECT * FROM c_tipo_unidades order by IdTipoUnidades');
		foreach($select->fetchAll() as $tipoUnidades){			$listatipoUnidades[]=new CTipoUnidadesModel($tipoUnidades['IdTipoUnidades'],$tipoUnidades['DescTipoUnidad']);
		}
		return $listatipoUnidades;
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
	public static function update($tipoUnidades){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE c_tipo_unidades SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdTipoUnidades',$tipoUnidades->getIdTipoUnidades());
		$insert->bindValue('DescTipoUnidad',$tipoUnidades->getDescTipoUnidad());
		$insert->execute();
		}
	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM c_tipo_unidades WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
}
?>