<?php
class MDetalleOServicioModel
{
	private $IdMaterialesDetalleServicio;
	private $IdDetalleOrdenServicio;
	private $IdMaterialesServicio;
	private $Cantidad;
	private $Precio;

	
	function __construct($IdMaterialesDetalleServicio, $IdDetalleOrdenServicio, $IdMaterialesServicio, $Cantidad,$Precio)
	{
		$this->setIdMaterialesDetalleServicio($IdMaterialesDetalleServicio);
		$this->setIdDetalleOrdenServicio($IdDetalleOrdenServicio);
		$this->setIdMaterialesServicio($IdMaterialesServicio);
		$this->setCantidad($Cantidad);
		$this->setPrecio($Precio);
	}

	public function getIdMaterialesDetalleServicio(){
		return $this->IdMaterialesDetalleServicio;
	}
	public function setIdMaterialesDetalleServicio($IdMaterialesDetalleServicio){
		$this->IdMaterialesDetalleServicio = $IdMaterialesDetalleServicio;
	}

	public function getIdDetalleOrdenServicio(){
		return $this->IdDetalleOrdenServicio;
	}
	public function setIdDetalleOrdenServicio($IdDetalleOrdenServicio){ 
		$this->IdDetalleOrdenServicio = $IdDetalleOrdenServicio;
	}

	public function getIdMaterialesServicio(){
		return $this->IdMaterialesServicio;
	}
	public function setIdMaterialesServicio($IdMaterialesServicio){
		$this->IdMaterialesServicio = $IdMaterialesServicio;
	}

	public function getCantidad(){
		return $this->Cantidad;
	}
	public function setCantidad($Cantidad){
		$this->Cantidad = $Cantidad;
	}

	public function getPrecio(){
		return $this->Precio;
	}
	public function setPrecio($Precio){
		$this->Precio = $Precio;
	}


	public static function save($MDetalleO){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO materiales_detalle_orden_servicio VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdMaterialesDetalleServicio',$MDetalleO->getIdMaterialesDetalleServicio());
		$insert->bindValue('IdDetalleOrdenServicio',$MDetalleO->getIdDetalleOrdenServicio());
		$insert->bindValue('IdMaterialesServicio',$MDetalleO->getIdMaterialesServicio());
		$insert->bindValue('Cantidad',$MDetalleO->getCantidad());
		$insert->bindValue('Precio',$MDetalleO->getPrecio());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaMDetalleO=[];

		$select=$db->query('SELECT * FROM materiales_detalle_orden_servicio order by IdMaterialesDetalleServicio');

		foreach($select->fetchAll() as $MDetalleO){$listaMDetalleO[]=new MDetalleOServicioModel($MDetalleO['IdMaterialesDetalleServicio'],
		$MDetalleO['IdDetalleOrdenServicio'],$MDetalleO['IdMaterialesServicio'],$MDetalleO['Cantidad'],$MDetalleO['Precio']  );
		}
		return $listaMDetalleO;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM alumno WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$MDetalleDb=$select->fetch();


		$MDetalleO = new MDetalleOServicioModel ($MDetalleDb['IdMaterialesDetalleServicio'],$MDetalleDb['IdDetalleOrdenServicio'],$MDetalleDb['IdMaterialesServicio'],
		$MDetalleDb['Cantidad'],$MDetalleDb['Precio']
		);
		//var_dump($alumno);
		//die();
		return $MDetalleO;

	}

	public static function update($MDetalleO){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE materiales_detalle_orden_servicio SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdMaterialesDetalleServicio',$MDetalleO->getIdMaterialesDetalleServicio());
		$insert->bindValue('IdDetalleOrdenServicio',$MDetalleO->getIdDetalleOrdenServicio());
		$insert->bindValue('IdMaterialesServicio',$MDetalleO->getIdMaterialesServicio());
		$insert->bindValue('Cantidad',$MDetalleO->getCantidad());
		$insert->bindValue('Precio',$MDetalleO->getPrecio());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM materiales_detalle_orden_servicio WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>