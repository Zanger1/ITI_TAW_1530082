<?php
class OrdenCierreRentaModel
{
	private $IdOrdenCierreRenta;
	private $IdOrdenRenta;
	private $Fecha;
	private $Hora;
	private $IdEmpleadoCaptura;
	private $IdSucursalEntrega;
	
	function __construct($IdOrdenCierreRenta, $IdOrdenRenta, $Fecha, $Hora,$IdEmpleadoCaptura,$IdSucursalEntrega)
	{
		$this->setOrdenCierreRenta($IdOrdenCierreRenta);
		$this->setOrdenRenta($IdOrdenRenta);
		$this->setFecha($Fecha);
		$this->setHora($Hora);
		$this->setIdEmpleadoCaptura($IdEmpleadoCaptura);
		$this->setIdSucursalEntrega($IdSucursalEntrega);
	}

	public function getIdOrdenCierreRenta(){
		return $this->IdOrdenCierreRenta;
	}
	public function setOrdenCierreRenta($IdOrdenCierreRenta){
		$this->IdOrdenCierreRenta = $IdOrdenCierreRenta;
	}

	public function getIdOrdenRenta(){
		return $this->IdOrdenRenta;
	}
	public function setOrdenRenta($IdOrdenRenta){ 
		$this->IdOrdenRenta = $IdOrdenRenta;
	}

	public function getFecha(){
		return $this->Fecha;
	}
	public function setFecha($Fecha){
		$this->Fecha = $Fecha;
	}

	public function getHora(){
		return $this->Hora;
	}
	public function setHora($Hora){
		$this->Hora = $Hora;
	}

	public function getIdEmpleadoCaptura(){
		return $this->IdEmpleadoCaptura;
	}
	public function setIdEmpleadoCaptura($IdEmpleadoCaptura){
		$this->IdEmpleadoCaptura = $IdEmpleadoCaptura;
	}

	public function getIdSucursalEntrega(){
		return $this->IdSucursalEntrega;
	}
	public function setIdSucursalEntrega($IdSucursalEntrega){
		$this->IdSucursalEntrega = $IdSucursalEntrega;
	}

	public static function save($ordenc){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO orden_cierre_renta VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdOrdenCierreRenta',$ordenc->getIdOrdenCierreRenta());
		$insert->bindValue('IdOrdenRenta',$ordenc->getIdOrdenRenta());
		$insert->bindValue('Fecha',$ordenc->getFecha());
		$insert->bindValue('Hora',$ordenc->getHora());
		$insert->bindValue('IdEmpleadoCaptura',$ordenc->getIdEmpleadoCaptura());
		$insert->bindValue('IdSucursalEntrega',$ordenc->getIdSucursalEntrega());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaOrdenCierreR=[];

		$select=$db->query('SELECT * FROM ordenc order by IdOrdenCierreRenta');

		foreach($select->fetchAll() as $ordenc){$listaOrdenCierreR[]=new OrdenCierreRentaModel($ordenc['IdOrdenCierreRenta'],$ordenc['IdOrdenRenta'],
		$ordenc['Fecha'],$ordenc['Hora'],$ordenc['IdEmpleadoCaptura'], $ordenc['IdSucursalEntrega']);
		}
		return $listaOrdenCierreR;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM orden_cierre_renta WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$ordencDb=$select->fetch();


		$ordenc = new OrdenCierreRentaModel ($ordencDb['IdOrdenCierreRenta'],$ordencDb['IdOrdenRenta'],
		$ordencDb['Fecha'],$ordencDb['Hora'],$ordencDb['IdEmpleadoCaptura'],$ordencDb['IdSucursalEntrega']);
		//var_dump($alumno);
		//die();
		return $ordenc;

	}

	public static function update($ordenc){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE orden_cierre_renta SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdOrdenCierreRenta',$ordenc->getIdOrdenCierreRenta());
		$insert->bindValue('IdOrdenRenta',$ordenc->getIdOrdenRenta());
		$insert->bindValue('Fecha',$ordenc->getFecha());
		$insert->bindValue('Hora',$ordenc->getHora());
		$insert->bindValue('IdEmpleadoCaptura',$ordenc->getIdEmpleadoCaptura());
		$insert->bindValue('IdSucursalEntrega',$ordenc->getIdSucursalEntrega());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM orden_cierre_renta WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>