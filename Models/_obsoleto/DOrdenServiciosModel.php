<?php 
class DOrdenServiciosModel
{
	private $IdDetalleOrdenServicio;
	private $IdOrdenServicio;
	private $IdServicio;
	private $Precio;
	private $Cantidad;

	function __construct($IdDetalleOrdenServicio, $IdOrdenServicio,$IdServicio, $Precio, $Cantidad)
	{
		$this->setidEmpleado($IdDetalleOrdenServicio);
		$this->setNombreEmpleado($IdOrdenServicio);
		$this->setApellidoPat($IdServicio);
		$this->setApellidomat($Precio);
		$this->setRFC($Cantidad);
		
	}

	public function getIdDetalleOrdenServicio(){
		return $this->IdDetalleOrdenServicio;
	}
	public function setIdDetalleOrdenServicio($IdDetalleOrdenServicio){
		$this->IdDetalleOrdenServicio = $IdDetalleOrdenServicio;
	}

	public function getIdOrdenServicio(){
		return $this->IdOrdenServicio;
	}
	public function setIdOrdenServicio($IdOrdenServicio){ 
		$this->IdOrdenServicio = $IdOrdenServicio;
	}

	public function getIdServicio(){
		return $this->IdServicio;
	}
	public function setIdServicio($IdServicio){
		$this->IdServicio = $IdServicio;
	}

	public function getPrecio(){
		return $this->Precio;
	}
	public function setPrecio($Precio){
		$this->Precio = $Precio;
	}

	public function getCantidad(){
		return $this->Cantidad;
	}
	public function setCantidad($Cantidad){
		$this->Cantidad = $Cantidad;
	}

	public static function save($OrdenServicios){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO detalle_orden_servicio VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdDetalleOrdenServicio',$OrdenServicios->getIdDetalleOrdenServicio());
		$insert->bindValue('IdOrdenServicio',$OrdenServicios->getIdOrdenServicio());
		$insert->bindValue('IdServicio',$OrdenServicios->getIdServicio());
		$insert->bindValue('Precio',$OrdenServicios->getPrecio());
		$insert->bindValue('Cantidad',$OrdenServicios->getCantidad());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaOrdenServicios=[];

		$select=$db->query('SELECT * FROM detalle_orden_servicio order by IdDetalleOrdenServicio');

		foreach($select->fetchAll() as $OrdenServicios){
			$listaOrdenServicios[]=new DOrdenServiciosModel($OrdenServicios['IdDetalleOrdenServicio'],$OrdenServicios['IdOrdenServicio'],
			$OrdenServicios['IdServicio'],$OrdenServicios['Precio'],$OrdenServicios['Cantidad']);
		}
		return $listaOrdenServicios;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM detalle_orden_servicio WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$OrdenServiciosDb=$select->fetch();


		$OrdenServicios = new EmpleadosModel ($OrdenServiciosDb['IdDetalleOrdenServicio'],$OrdenServiciosDb['IdOrdenServicio'], 
		$OrdenServiciosDb['IdServicio'],$OrdenServiciosDb['Precio'],$OrdenServiciosDb['Cantidad']);
		//var_dump($alumno);
		//die();
		return $OrdenServicios;

	}

	public static function update($OrdenServicios){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdDetalleOrdenServicio',$OrdenServicios->getIdDetalleOrdenServicio());
		$insert->bindValue('IdOrdenServicio',$OrdenServicios->getIdOrdenServicio());
		$insert->bindValue('IdServicio',$OrdenServicios->getIdServicio());
		$insert->bindValue('Precio',$OrdenServicios->getPrecio());
		$insert->bindValue('Cantidad',$OrdenServicios->getCantidad());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM detalle_orden_servicio WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>