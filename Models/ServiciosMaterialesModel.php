<?php 
class ServicioMaterialesModel
{
	private $IdServicioMateriales;
	private $IdServicio;
	private $IdMaterialesServicio;
	private $Catidad;
	
	function __construct($IdServicioMateriales, $IdServicio,$IdMaterialesServicio, $Catidad)
	{
		$this->setIdServicioMateriales($IdServicioMateriales);
		$this->setIdServicio($IdServicio);
		$this->setIdMaterialesServicio($IdMaterialesServicio);
		$this->setCatidad($Catidad);
		
	}

	public function getIdServicioMateriales(){
		return $this->IdServicioMateriales;
	}
	public function setIdServicioMateriales($IdServicioMateriales){
		$this->IdServicioMateriales = $IdServicioMateriales;
	}
//------------------------------------------------------------
	public function getIdServicio(){
		return $this->IdServicio;
	}
	public function setIdServicio($IdServicio){ 
		$this->IdServicio = $IdServicio;
	}
//------------------------------------------------------------------
	public function getIdMaterialesServicio(){
		return $this->IdMaterialesServicio;
	}
	public function setIdMaterialesServicio($IdMaterialesServicio){
		$this->IdMaterialesServicio = $IdMaterialesServicio;
	}
//-----------------------------------------------------------
	public function getCatidad(){
		return $this->Catidad;
	}
	public function setCatidad($Catidad){
		$this->Catidad = $Catidad;
	}

	public static function save($servicioM){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO servicios_materiales VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdServicioMateriales',$servicioM->getIdServicioMateriales());
		$insert->bindValue('IdServicio',$servicioM->getIdServicio());
		$insert->bindValue('IdMaterialesServicio',$servicioM->setIdMaterialesServicio());
		$insert->bindValue('Catidad',$servicioM->getCatidad());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaServiciosM=[];
		$select=$db->query('SELECT * FROM servicios_materiales order by IdServicioMateriales');

		foreach($select->fetchAll() as $servicioM){
			$listaServiciosM[]=new EmpleadosModel($servicioM['IdServicioMateriales'],$servicioM['IdServicio'],$servicioM['IdMaterialesServicio'],$servicioM['Catidad']);
		}
		return $listaServiciosM;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM servicios_materiales WHERE IdServicioMateriales=:id');
		$select->bindValue('id',$id);
		$select->execute();
		
		$servicioMDb=$select->fetch();
		$servicio = new EmpleadosModel ($servicioMDb['IdServicioMateriales'],$servicioMDb['IdServicio'], $servicioMDb['IdMaterialesServicio'], $servicioMDb['Catidad']);
		//var_dump($alumno);
		//die();
		return $servicio;
	}

	public static function update($servicioM){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdServicioMateriales',$servicioM->getIdServicioMateriales());
		$insert->bindValue('IdServicio',$servicioM->getIdServicio());
		$insert->bindValue('IdMaterialesServicio',$servicioM->setIdMaterialesServicio());
		$insert->bindValue('Catidad',$servicioM->getCatidad());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM servicios_materiales WHERE IdServicioMateriales=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>