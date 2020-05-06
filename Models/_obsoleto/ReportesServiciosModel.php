<?php 
class ReporteServiciosModel
{
	private $IdReoprteServicio;
	private $IdSucursalServicio;
	private $Folio;
	private $Documento;
	private $Fecha_Creacion;
	
	function __construct($IdReoprteServicio, $IdSucursalServicio,$Folio, $Documento, $Fecha_Creacion)
	{
		$this->setIdReoprteServicio($IdReoprteServicio);
		$this->setIdSucursalServicio($IdSucursalServicio);
		$this->setFolio($Folio);
		$this->setDocumento($Documento);
		$this->setFecha_Creacion($Fecha_Creacion);
	}

	public function getIdReporteServicio(){
		return $this->IdReoprteServicio;
	}
	public function setIdReoprteServicio($IdReoprteServicio){
		$this->IdReoprteServicio = $IdReoprteServicio;
	}

	public function getIdSucursalServicio(){
		return $this->IdSucursalServicio;
	}
	public function setIdSucursalServicio($IdSucursalServicio){ 
		$this->IdSucursalServicio = $IdSucursalServicio;
	}

	public function getFolio(){
		return $this->Folio;
	}
	public function setFolio($Folio){
		$this->Folio = $Folio;
	}

	public function getDocumento(){
		return $this->Documento;
	}
	public function setDocumento($Documento){
		$this->Documento = $Documento;
	}

	public function getFecha_Creacion(){
		return $this->Fecha_Creacion;
	}
	public function setFecha_Creacion($Fecha_Creacion){
		$this->Fecha_Creacion = $Fecha_Creacion;
	}

	public static function save($reportes){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO reportes_servicios VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdReoprteServicio',$reportes->getIdReporteServicio());
		$insert->bindValue('IdSucursalServicio',$reportes->getIdSucursalServicio());
		$insert->bindValue('Folio',$reportes->getFolio());
		$insert->bindValue('Documento',$reportes->getDocumento());
		$insert->bindValue('Fecha_Creacion',$reportes->getFecha_Creacion());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaReportes=[];

		$select=$db->query('SELECT * FROM reportes_servicios order by IdReoprteServicio');

		foreach($select->fetchAll() as $reportes){
		$listaReportes[]=new ReporteServiciosModel($reportes['IdReoprteServicio'],$reportes['IdSucursalServicio'],$reportes['Folio'],$reportes['Documento'],
		$reportes['Fecha_Creacion']);
		}
		return $listaReportes;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM reportes_servicios WHERE IdReoprteServicio=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$reportesDb=$select->fetch();


		$reporte = new ReporteServiciosModel ($reportesDb['IdReoprteServicio'],$reportesDb['IdSucursalServicio'], $reportesDb['Folio'], $reportesDb['Documento'],
		$reportesDb['Fecha_Creacion']);
		//var_dump($alumno);
		//die();
		return $reporte;

	}

	public static function update($reportes){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdReoprteServicio',$reportes->getIdReporteServicio());
		$insert->bindValue('IdSucursalServicio',$reportes->getIdSucursalServicio());
		$insert->bindValue('Folio',$reportes->getFolio());
		$insert->bindValue('Documento',$reportes->getDocumento());
		$insert->bindValue('Fecha_Creacion',$reportes->getFecha_Creacion());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM reportes_servicios WHERE IdReoprteServicio=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>