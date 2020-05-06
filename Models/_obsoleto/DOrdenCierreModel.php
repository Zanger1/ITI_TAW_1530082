<?php 
class DOrdenCierreModel
{
	private $IdDetalleOrdenCierre;
	private $IdOrdenCierreRenta;
	private $IdEmpleado;


	
	function __construct($IdDetalleOrdenCierre, $IdOrdenCierreRenta,$IdEmpleado)
	{
		$this->setIdDetalleOrdenCierre($IdDetalleOrdenCierre);
		$this->setIdOrdenCierreRenta($IdOrdenCierreRenta);
		$this->setIdEmpleado($IdEmpleado);
		
	}

	public function getIdDetalleOrdenCierre(){
		return $this->setIdDetalleOrdenCierre;
	}
	public function setIdDetalleOrdenCierre($IdDetalleOrdenCierre){
		$this->IdDetalleOrdenCierre = $IdDetalleOrdenCierre;
	}

	public function getIdOrdenCierreRenta(){
		return $this->IdOrdenCierreRenta;
	}
	public function setIdOrdenCierreRenta($IdOrdenCierreRenta){ 
		$this->IdOrdenCierreRenta = $IdOrdenCierreRenta;
	}

	public function getIdEmpleado(){
		return $this->IdEmpleado;
	}
	public function setIdEmpleado($IdEmpleado){
		$this->IdEmpleado = $IdEmpleado;
	}

	public static function save($cierre){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO detalle_orden_cierre VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdDetalleOrdenCierre',$cierre->getIdDetalleOrdenCierre());
		$insert->bindValue('IdOrdenCierreRenta',$cierre->getIdOrdenCierreRenta());
		$insert->bindValue('IdEmpleado',$cierre->getIdEmpleado());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaCierre=[];

		$select=$db->query('SELECT * FROM detalle_orden_cierre order by idEmpleado');

		foreach($select->fetchAll() as $cierre){
			$listaCierre[]=new DOrdenCierreModel($cierre['IdDetalleOrdenCierre'],$cierre['IdOrdenCierreRenta'],$cierre['IdEmpleado'] );
		}
		return $listaCierre;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM detalle_orden_cierre WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$cierreDb=$select->fetch();


		$cierre = new DOrdenCierreModel ($cierreDb['IdDetalleOrdenCierre'],$cierreDb['IdOrdenCierreRenta'], $cierreDb['IdEmpleado']);
		//var_dump($alumno);
		//die();
		return $cierre;

	}

	public static function update($cierre){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdDetalleOrdenCierre',$cierre->getIdDetalleOrdenCierre());
		$insert->bindValue('IdOrdenCierreRenta',$cierre->getIdOrdenCierreRenta());
		$insert->bindValue('IdEmpleado',$cierre->getIdEmpleado());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM detalle_orden_cierre WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>