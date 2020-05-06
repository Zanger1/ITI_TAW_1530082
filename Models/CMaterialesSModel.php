<?php
class CMaterialesSModel
{
	private $IdMaterialesServicio;
	private $NomMaterial;
	private $PrecioMaterial;
	private $UnidadMaterial;

	
	function __construct($IdMaterialesServicio, $NomMaterial, $PrecioMaterial, $UnidadMaterial)
	{
		$this->setIdMaterialesServicio($IdMaterialesServicio);
		$this->setNomMaterial($NomMaterial);
		$this->setPrecioMaterial($PrecioMaterial);
		$this->setUnidadMaterial($UnidadMaterial);
	}

	public function getIdMaterialesServicio(){
		return $this->IdMaterialesServicio;
	}
	public function setIdCliente($IdMaterialesServicio){
		$this->IdMaterialesServicio = $IdMaterialesServicio;
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

	public static function save($Materiales){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO c_materiales_servicios VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdMaterialesServicio',$Materiales->getIdMaterialesServicio());
		$insert->bindValue('NomMaterial',$Materiales->getNomMaterial());
		$insert->bindValue('PrecioMaterial',$Materiales->getPrecioMaterial());
		$insert->bindValue('UnidadMaterial',$Materiales->getUnidadMaterial());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaClientes=[];

		$select=$db->query('SELECT * FROM c_materiales_servicios order by IdMaterialesServicio');

		foreach($select->fetchAll() as $Materiales){$listaClientes[]=new CMaterialesSModel($Materiales['IdMaterialesServicio'],$Materiales['NomMaterial'],$Materiales['PrecioMaterial'],$Materiales['UnidadMaterial'] );
		}
		return $listaClientes;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM c_materiales_servicios WHERE id=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$MaterialesDb=$select->fetch();


		$Materiales = new CMaterialesSModel ($MaterialesDb['IdMaterialesServicio'],$MaterialesDb['NomMaterial'],$MaterialesDb['PrecioMaterial'],$MaterialesDb['UnidadMaterial']);
		//var_dump($alumno);
		//die();
		return $Materiales;

	}

	public static function update($Materiales){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE c_materiales_servicios SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdMaterialesServicio',$Materiales->getIdMaterialesServicio());
		$insert->bindValue('NomMaterial',$Materiales->getNomMaterial());
		$insert->bindValue('PrecioMaterial',$Materiales->getPrecioMaterial());
		$insert->bindValue('UnidadMaterial',$Materiales->getUnidadMaterial());
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