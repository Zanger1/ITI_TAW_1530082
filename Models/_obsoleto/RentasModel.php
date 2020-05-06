<?php
class RentasModel
{
	private $IdUnidadRenta;
	private $DesUnidad;
	function __construct($IdUnidadRenta, $DesUnidad){
		$this->setIdUnidadRenta($IdUnidadRenta);
		$this->setIdUnidadRenta($IdUnidadRenta);
	}
	/*------------------------*/
	public function getIdUnidadRenta(){
		return $this->IdUnidadRenta;
	}
	public function setIdUnidadRenta($IdUnidadRenta){
		$this->IdUnidadRenta = $IdUnidadRenta;
	}
	/*------------------------------------*/
	public function getDesUnidad(){
		return $this->DesUnidad;
	}
	public function setDesUnidad($DesUnidad){ 
		$this->DesUnidad = $DesUnidad;
	}
/*-----------------------------------------*/
	public static function save($rentas){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO  VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdUnidadRenta',$rentas->getIdUnidadRenta());
		$insert->bindValue('DesUnidad',$rentas->getDesUnidad());
		$insert->execute();
	}
	public static function all(){
		$db=DataBase::getConnect();
		$listaRentas=[];
		$select=$db->query('SELECT * FROM unidades_renta order by idEmpleado');
		foreach($select->fetchAll() as $rentas){
			$listaRentas[]=new RentasModel($rentas['IdUnidadRenta'],$rentas['DesUnidad']);
		}
		return $listaRentas;
	}
	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM unidades_renta WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$rentasDb=$select->fetch();
		$rentas = new RentasModel ($rentasDb['IdUnidadRenta'],$rentasDb['DesUnidad']);
		//var_dump($alumno);
		//die();
		return $rentas;
	}
	public static function update($rentas){		$db=DataBase::getConnect();		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdUnidadRenta',$rentas->getIdUnidadRenta());
		$insert->bindValue('DesUnidad',$rentas->getDesUnidad());
		$insert->execute();
	}
	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM unidades_renta WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
}
?>