<?php
class OrdenSalidaRModel
{
	private $IdOrdenSalidaRenta;
	private $IdOredenRenta;
	private $Fecha;
	private $Hora;
	private $IdEmpleado;
	
	function __construct($IdOrdenSalidaRenta, $IdOredenRenta, $Fecha, $Hora,$IdEmpleado)
	{
		$this->setIdCliente($IdOrdenSalidaRenta);
		$this->setNombre($IdOredenRenta);
		$this->setRFC($Fecha);
		$this->setCalle($Hora);
		$this->setColonia($IdEmpleado);
	}

	public function getIdOrdenSalidaRenta(){
		return $this->IdOrdenSalidaRenta;
	}
	public function setIdOrdenSalidaRenta($IdOrdenSalidaRenta){
		$this->IdOrdenSalidaRenta = $IdOrdenSalidaRenta;
	}

	public function getIdOredenRenta(){
		return $this->IdOredenRenta;
	}
	public function setIdOredenRenta($IdOredenRenta){ 
		$this->IdOredenRenta = $IdOredenRenta;
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

	public function getIdEmpleado(){
		return $this->IdEmpleado;
	}
	public function setIdEmpleado($IdEmpleado){
		$this->IdEmpleado = $IdEmpleado;
	}


	public static function save($OrdenS){
		$db=DataBase::getConnect();
		$insert=$db->prepare('INSERT INTO orden_salida_renta VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdOrdenSalidaRenta',$OrdenS->getIdOrdenSalidaRenta());
		$insert->bindValue('IdOredenRenta',$OrdenS->getIdOredenRenta());
		$insert->bindValue('Fecha',$OrdenS->getFecha());
		$insert->bindValue('Hora',$OrdenS->getHora());
		$insert->bindValue('IdEmpleado',$OrdenS->getIdEmpleado());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaOrden=[];
		$select=$db->query('SELECT * FROM orden_salida_renta order by IdOrdenSalidaRenta');
		foreach($select->fetchAll() as $OrdenS){$listaOrden[]=new OrdenSalidaRModel($OrdenS['IdOrdenSalidaRenta'],$OrdenS['IdOredenRenta'],$OrdenS['Fecha'],$OrdenS['Hora'],$OrdenS['IdEmpleado']);
		}
		return $listaOrden;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM orden_salida_renta WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$OrdenDb=$select->fetch();
		$OrdenS = new OrdenSalidaRModel ($OrdenDb['IdOrdenSalidaRenta'],$OrdenDb['IdOredenRenta'],$OrdenDb['Fecha'],$OrdenDb['Hora'],$OrdenDb['IdEmpleado']);
		//var_dump($alumno);
		//die();
		return $OrdenS;

	}

	public static function update($OrdenS){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdOrdenSalidaRenta',$OrdenS->getIdOrdenSalidaRenta());
		$insert->bindValue('IdOredenRenta',$OrdenS->getIdOredenRenta());
		$insert->bindValue('Fecha',$OrdenS->getFecha());
		$insert->bindValue('Hora',$OrdenS->getHora());
		$insert->bindValue('IdEmpleado',$OrdenS->getIdEmpleado());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM orden_salida_renta WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>