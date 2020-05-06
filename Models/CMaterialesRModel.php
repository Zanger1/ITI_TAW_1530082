<?php
class CMaterialesRModel
{
	private $IdMaterialesRenta;
	private $NomMaterial;
	private $PrecioMaterial;
	private $UnidadMaterial;

	
	function __construct($IdMaterialesRenta, $NomMaterial, $PrecioMaterial, $UnidadMaterial)
	{
		$this->setIdMaterialesRenta($IdMaterialesRenta);
		$this->setNomMaterial($NomMaterial);
		$this->setPrecioMaterial($PrecioMaterial);
		$this->setUnidadMaterial($UnidadMaterial);
	}

	public function getIdMaterialesRenta(){
		return $this->IdMaterialesRenta;
	}
	public function setIdMaterialesRenta($IdMaterialesRenta){
		$this->IdMaterialesRenta = $IdMaterialesRenta;
	}

	public function getNomMaterial(){
		return $this->NomMaterial;
	}
	public function setNomMaterial($NomMaterial){ 
		$this->NomMaterial = $NomMaterial;
	}

	public function getPrecioMaterial(){
		return $this->PrecioMaterial;
	}
	public function setPrecioMaterial($PrecioMaterial){
		$this->PrecioMaterial = $PrecioMaterial;
	}

	public function getUnidadMaterial(){
		return $this->UnidadMaterial;
	}
	public function setUnidadMaterial($UnidadMaterial){
		$this->UnidadMaterial = $UnidadMaterial;
	}

	public static function save($Rentas){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO c_materiales_servicios VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdMaterialesRenta',$Rentas->getIdMaterialesRenta());
		$insert->bindValue('NomMaterial',$Rentas->getNomMaterial());
		$insert->bindValue('PrecioMaterial',$Rentas->getPrecioMaterial());
		$insert->bindValue('UnidadMaterial',$Rentas->getUnidadMaterial());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaRentas=[];

		$select=$db->query('SELECT * FROM c_materiales_servicios order by IdMaterialesRenta');

		foreach($select->fetchAll() as $Rentas){$listaRentas[]=new CMaterialesSModel($Rentas['IdMaterialesRenta'],$Rentas['NomMaterial'],$Rentas['PrecioMaterial'],$Rentas['UnidadMaterial'] );
		}
		return $listaRentas;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_materiales_servicios WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$RentasDb=$select->fetch();


		$Rentas = new CMaterialesSModel ($RentasDb['IdMaterialesRenta'],$RentasDb['NomMaterial'],$RentasDb['PrecioMaterial'],$RentasDb['UnidadMaterial']);
		//var_dump($alumno);
		//die();
		return $Rentas;

	}

	public static function update($Rentas){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE c_materiales_servicios SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdMaterialesRenta',$Rentas->getIdMaterialesRenta());
		$insert->bindValue('NomMaterial',$Rentas->getNomMaterial());
		$insert->bindValue('PrecioMaterial',$Rentas->getPrecioMaterial());
		$insert->bindValue('UnidadMaterial',$Rentas->getUnidadMaterial());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM c_materiales_servicios WHERE id=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>