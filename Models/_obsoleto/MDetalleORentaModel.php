<?php
class MDetalleORentaModel
{
	private $IdMaterialesDetalleOrdenRentas;
	private $IdDetalleOrdenRentas;
	private $IdMaterialesRentas;
	private $Cantidad;
	private $Precio;

	
	function __construct($IdMaterialesDetalleOrdenRentas, $IdDetalleOrdenRentas, $IdMaterialesRentas, $Cantidad,$Precio)
	{
		$this->setIdMaterialesDetalleOrdenRentas($IdMaterialesDetalleOrdenRentas);
		$this->setIdDetalleOrdenRentas($IdDetalleOrdenRentas);
		$this->setIdMaterialesRentas($IdMaterialesRentas);
		$this->setCantidad($Cantidad);
		$this->setPrecio($Precio);
	}

	public function getIdMaterialesDetalleOrdenRentas(){
		return $this->IdMaterialesDetalleOrdenRentas;
	}
	public function setIdMaterialesDetalleOrdenRentas($IdMaterialesDetalleOrdenRentas){
		$this->IdMaterialesDetalleOrdenRentas = $IdMaterialesDetalleOrdenRentas;
	}

	public function getIdDetalleOrdenRentas(){
		return $this->IdDetalleOrdenRentas;
	}
	public function setIdDetalleOrdenRentas($IdDetalleOrdenRentas){ 
		$this->IdDetalleOrdenRentas = $IdDetalleOrdenRentas;
	}

	public function getIdMaterialesRentas(){
		return $this->IdMaterialesRentas;
	}
	public function setIdMaterialesRentas($IdMaterialesRentas){
		$this->IdMaterialesRentas = $IdMaterialesRentas;
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
		$insert->bindValue('IdMaterialesDetalleOrdenRentas',$MDetalleO->getIdMaterialesDetalleServicio());
		$insert->bindValue('IdDetalleOrdenRentas',$MDetalleO->getIdDetalleOrdenServicio());
		$insert->bindValue('IdMaterialesRentas',$MDetalleO->getIdMaterialesServicio());
		$insert->bindValue('Cantidad',$MDetalleO->getCantidad());
		$insert->bindValue('Precio',$MDetalleO->getPrecio());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaMDetalleO=[];

		$select=$db->query('SELECT * FROM materiales_detalle_orden_servicio order by IdMaterialesDetalleOrdenRentas');

		foreach($select->fetchAll() as $MDetalleO){$listaMDetalleO[]=new MDetalleORentaModel($MDetalleO['IdMaterialesDetalleOrdenRentas'],
		$MDetalleO['IdDetalleOrdenRentas'],$MDetalleO['IdMaterialesRentas'],$MDetalleO['Cantidad'],$MDetalleO['Precio']  );
		}
		return $listaMDetalleO;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM alumno WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$MDetalleDb=$select->fetch();


		$MDetalleO = new MDetalleORentaModel ($MDetalleDb['IdMaterialesDetalleOrdenRentas'],$MDetalleDb['IdDetalleOrdenRentas'],$MDetalleDb['IdMaterialesRentas'],
		$MDetalleDb['Cantidad'],$MDetalleDb['Precio']
		);
		//var_dump($alumno);
		//die();
		return $MDetalleO;

	}

	public static function update($MDetalleO){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE materiales_detalle_orden_servicio SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdMaterialesDetalleOrdenRentas',$MDetalleO->getIdMaterialesDetalleServicio());
		$insert->bindValue('IdDetalleOrdenRentas',$MDetalleO->getIdDetalleOrdenServicio());
		$insert->bindValue('IdMaterialesRentas',$MDetalleO->getIdMaterialesServicio());
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