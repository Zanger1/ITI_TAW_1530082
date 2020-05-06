<?php
class RentasMaterialesModel
{
	private $IdRentasMateriales;
	private $IdUnidadRenta;
	private $IdMaterialeasRentas;
	private $Cantidad;

	function __construct($IdRentasMateriales, $IdUnidadRenta, $IdMaterialeasRentas, $Cantidad)
	{
		$this->setIdRentasMateriales($IdRentasMateriales);
		$this->setIdUnidadRenta($IdUnidadRenta);
		$this->setIdMaterialesRenta($IdMaterialeasRentas);
		$this->setCantidad($Cantidad);
	}
	public function getIdRentasMateriales(){
		return $this->IdRentasMateriales;
	}
	public function setIdCliente($IdRentasMateriales){
		$this->IdRentasMateriales = $IdRentasMateriales;
	}

	public function getIdUnidadRenta(){
		return $this->IdUnidadRenta;
	}
	public function setNombre($IdUnidadRenta){ 
		$this->IdUnidadRenta = $IdUnidadRenta;
	}

	public function getIdMaterialeasRentas(){
		return $this->IdMaterialeasRentas;
	}
	public function setRFC($IdMaterialeasRentas){
		$this->IdMaterialeasRentas = $IdMaterialeasRentas;
	}

	public function getCantidad(){
		return $this->Cantidad;
	}
	public function setCalle($Cantidad){
		$this->Cantidad = $Cantidad;
	}
	
	public static function save($materiales){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO rentas_materiales VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdRentasMateriales',$materiales->getIdRentasMateriales());
		$insert->bindValue('IdUnidadRenta',$materiales->getIdUnidadRenta());
		$insert->bindValue('IdMaterialeasRentas',$materiales->getIdMaterialeasRentas());
		$insert->bindValue('Cantidad',$materiales->getCantidad());
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaMateriales=[];

		$select=$db->query('SELECT * FROM rentas_materiales by IdRentasMateriales');

		foreach($select->fetchAll() as $materiales){$listaMateriales[]=new RentasMaterialesModel($materiales['IdRentasMateriales'],$materiales['IdUnidadRenta'],
		$materiales['IdMaterialeasRentas'],$materiales['Cantidad']);	}
		return $listaMateriales;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM rentas_materiales WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$materialesDb=$select->fetch();


		$materiales = new RentasMaterialesModel ($materialesDb['IdRentasMateriales'],$materialesDb['IdUnidadRenta'],$materialesDb['IdMaterialeasRentas'],$materialesDb['Cantidad']);
		//var_dump($alumno);
		//die();
		return $materiales;

	}

	public static function update($materiales){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdRentasMateriales',$materiales->getIdRentasMateriales());
		$insert->bindValue('IdUnidadRenta',$materiales->getIdUnidadRenta());
		$insert->bindValue('IdMaterialeasRentas',$materiales->getIdMaterialeasRentas());
		$insert->bindValue('Cantidad',$materiales->getCantidad());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM alumno WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>