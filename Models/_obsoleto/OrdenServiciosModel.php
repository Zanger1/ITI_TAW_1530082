<?php 
class OrdenServiciosModel
{
	private $IdOrdenServicio;
	private $FolioCotizacion;
	private $FolioServicio;
	private $IdEmpleado;
	private $FechaCaptura;
	private $HoraCaptura;
	private $IdCliente;
	private $FechaComienzoServicio;
	private $FechaTerminoServicio;
	private $SStatus;
	private $CalleEntrega;
	private $ColoniaEntrega;
	private $CodigoPostalEntrega;
	private $IdCiudad;
	private $NombrePersonaEntrega;
	private $TelefonoPersonEntrega;
	private $CorreoPersonaEntrega;
	private $RequiereFactura;
	private $Factura;
	private $IdStatus;
	
	function __construct($IdOrdenServicio,$FolioCotizacion,$FolioServicio,$IdEmpleado,$FechaCaptura, $HoraCaptura,
	$IdCliente,$FechaComienzoServicio, $FechaTerminoServicio, $SStatus, $CalleEntrega,$ColoniaEntrega,  $CodigoPostalEntrega, $IdCiudad,
	$NombrePersonaEntrega,$TelefonoPersonEntrega, $CorreoPersonaEntrega, $RequiereFactura,$Factura, $IdStatus)
	{
		$this->setIdOrdenServicio($IdOrdenServicio);
		$this->setFolioCotizacion($FolioCotizacion);
		$this->setFolioServicio($FolioServicio);
		$this->setIdEmpleado($IdEmpleado);
		$this->setFechaCaptura($FechaCaptura);
		$this->setHoraCaptursa($HoraCaptura);
		$this->setIdCliente($IdCliente);
		$this->setFechaComienzoServicio($FechaComienzoServicio);
		$this->setFechaTerminoServicio($FechaTerminoServicio);
		$this->setSStatus($SStatus);
		$this->setCalleEntrega($CalleEntrega);
		$this->setColoniaEntrega($ColoniaEntrega);
		$this->setCodigoPostalEntrega($CodigoPostalEntrega);
		$this->setIdCiudad($IdCiudad);
		$this->setNombrePersonaEntrega($NombrePersonaEntrega);
		$this->setTelefonoPersonEntrega($TelefonoPersonEntrega);
		$this->setCorreoPersonaEntrega($CorreoPersonaEntrega);
		$this->setRequiereFactura($RequiereFactura);
		$this->setFactura($Factura);
		$this->setIdStatus($IdStatus);
	}
	public function getIdOrdenServicio(){
		return $this->IdOrdenServicio;
	}
	public function setIdOrdenServicio($IdOrdenServicio){
		$this->IdOrdenServicio = $IdOrdenServicio;
	}
	//--------------------------------------
	public function getFolioCotizacion(){
		return $this->FolioCotizacion;
	}
	public function setFolioCotizacion($FolioCotizacion){ 
		$this->FolioCotizacion = $FolioCotizacion;
	}
	//-------------------------------------------------
	public function getFolioServicio(){
		return $this->FolioServicio;
	}
	public function setFolioServicio($FolioServicio){
		$this->FolioServicio = $FolioServicio;
	}
	//-------------------------------------------------
	public function getIdEmpleado(){
		return $this->IdEmpleado;
	}
	public function setIdEmpleado($IdEmpleado){
		$this->IdEmpleado = $IdEmpleado;
	}
//-------------------------------------------
	public function getFechaCaptura(){
		return $this->FechaCaptura;
	}
	public function setFechaCaptura($FechaCaptura){
		$this->FechaCaptura = $FechaCaptura;
	}
//----------------------------------------------------
	public function getHoraCaptura(){
		return $this->HoraCaptura;
	}
	public function setHoraCaptura($HoraCaptura){
		$this->HoraCaptura = $HoraCaptura;
	}
//------------------------------------------------
	public function getIdCliente(){
		return $this->IdCliente;
	}
	public function setIdCliente($IdCliente){
		$this->IdCliente = $IdCliente;
	}
//---------------------------------------------------
	public function getFechaComienzoServicio(){
		return $this->FechaComienzoServicio;
	}
	public function setFechaComienzoServicio($FechaComienzoServicio){
		$this->FechaComienzoServicio = $FechaComienzoServicio;
	}
//----------------------------------------------------
	public function getFechaTerminoServicio(){
		return $this->FechaTerminoServicio;
	}
	public function setFechaTerminoServicio($FechaTerminoServicio){
		$this->FechaTerminoServicio = $FechaTerminoServicio;
	}
//--------------------------------------------------------
	public function getSStatus(){
		return $this->SStatus;
	}
	public function setSStatus($SStatus){
		$this->SStatus = $SStatus;
	}
//----------------------------------------------
	public function getCalleEntrega(){
		return $this->CalleEntrega;
	}
	public function setCalleEntrega($CalleEntrega){
		$this->CalleEntrega= $CalleEntrega;
	}
//-----------------------------------------
	public function getColoniaEntrega(){
		return $this->ColoniaEntrega;
	}
	public function setColoniaEntrega($ColoniaEntrega){
		$this->ColoniaEntrega = $ColoniaEntrega;
	}
//------------------------------------------------
	public function getCodigoPostalEntrega(){
		return $this->CodigoPostalEntrega;
	}
	public function setCodigoPostalEntrega($CodigoPostalEntrega){
		$this->CodigoPostalEntrega= $CodigoPostalEntrega;
	}
//------------------------------------------------
	public function getIdCiudad(){
		return $this->IdCiudad;
	}
	public function setIdCiudad($IdCiudad){
		$this->IdCiudad = $IdCiudad;
	}
//----------------------------------------------------
	public function getNombrePersonaEntrega(){
		return $this->NombrePersonaEntrega;
	}
	public function setNombrePersonaEntrega($NombrePersonaEntrega){
		$this->NombrePersonaEntrega= $NombrePersonaEntrega;
	}
//---------------------------------------------------------------
	public function getTelefonoPersonaEntrega(){
		return $this->TelefonoPersonEntrega;
	}
	public function setTelefonoPersonEntrega($TelefonoPersonEntrega){
		$this->TelefonoPersonEntrega = $TelefonoPersonEntrega;
	}
//---------------------------------------------------------
	public function getCorreoPersonaEntrega(){
		return $this->CorreoPersonaEntrega;
	}
	public function setCorreoPersonaEntrega($CorreoPersonaEntrega){
		$this->CorreoPersonaEntrega = $CorreoPersonaEntrega;
	}
//-----------------------------------------------
    public function getRequiereFcatura(){
		return $this->RequiereFactura;
	}
	public function setRequiereFactura($RequiereFactura){
		$this->RequiereFactura = $RequiereFactura;
	}
//-----------------------------------------------
    public function getFcatura(){
		return $this->Factura;
	}
	public function setFactura($Factura){
		$this->Factura = Factura;
	}
//-----------------------------------------------
    public function getIdStatuas(){
		return $this->IdStatus;
	}
	public function setIdStatus($IdStatus){
		$this->IdStatus = $IdStatus;
	}

	public static function save($servicios){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		

		$insert=$db->prepare('INSERT INTO orde_servicios VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdOrdenServicio',$servicios->getIdOrdenServicio());
		$insert->bindValue('FolioCotizacion',$servicios->getFolioCotizacion());
		$insert->bindValue('FolioServicio',$servicios->getFolioServicio());
		$insert->bindValue('IdEmpleado',$servicios->getIdEmpleado());
		$insert->bindValue('FechaCaptura',$servicios->getFechaCaptura());
		$insert->bindValue('HoraCaptura',$servicios->getHoraCaptura());
		$insert->bindValue('IdCliente',$servicios->getIdCliente());
		$insert->bindValue('FechaComienzoServicio',$servicios->getFechaComienzoServicio());
		$insert->bindValue('FechaTerminoServicio',$servicios->getFechaTerminoServicio());
		$insert->bindValue('SStatus',$servicios->getSStatus());
		$insert->bindValue('CalleEntrega',$servicios->getCalleEntrega());
		$insert->bindValue('ColoniaEntrega',$servicios->getColoniaEntrega());
		$insert->bindValue('CodigoPostalEntrega',$servicios->getCodigoPostalEntrega());
		$insert->bindValue('IdCiudad',$servicios->getIdCiudad());
		$insert->bindValue('NombrePersonaEntrega',$servicios->getNombrePersonaEntrega());
		$insert->bindValue('TelefonoPersonEntrega',$servicios->getTelefonoPersonaEntrega());
		$insert->bindValue('CorreoPersonaEntrega',$servicios->getCorreoPersonaEntrega());
		$insert->bindValue('RequiereFactura',$servicios->getRequiereFcatura());
		$insert->bindValue('Factura',$servicios->getFcatura());
		$insert->bindValue('IdStatus',$servicios->getIdStatuas());
		$insert->execute();
	}

	public static function all(){
		$db=DataBase::getConnect();
		$listaServicios=[];

		$select=$db->query('SELECT * FROM orde_servicios order by IdOrdenServicio');

		foreach($select->fetchAll() as $servicios){
			$listaServicios[]=new OrdenServiciosModel($servicios['IdOrdenServicio'],$servicios['FolioCotizacion'],$servicios['FolioServicio'],$servicios['IdEmpleado'],
			$servicios['FechaCaptura'], $servicios['HoraCaptura'], $servicios['IdCliente'], $servicios['FechaComienzoServicio'], $servicios['FechaTerminoServicio'],
			$servicios['SStatus'], $servicios['CalleEntrega'],$servicios['CodigoPostalEntrega'],$servicios['IdCiudad'],$servicios['NombrePersonaEntrega'],
			$servicios['TelefonoPersonEntrega'],$servicios['CorreoPersonaEntrega'],$servicios['RequiereFactura'] ,$servicios['Factura'],$servicios['IdStatus']);
		}
		return $listaServicios;
	}

	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM orde_servicios WHERE IdOrdenServicio=:id');
		$select->bindValue('id',$id);
		$select->execute();

		$serviciosDb=$select->fetch();


		$servicio = new OrdenServiciosModel ($serviciosDb['IdOrdenServicio'],$serviciosDb['FolioCotizacion'],$serviciosDb['FolioServicio'],$serviciosDb['IdEmpleado'],
			$serviciosDb['FechaCaptura'], $serviciosDb['HoraCaptura'], $serviciosDb['IdCliente'], $serviciosDb['FechaComienzoServicio'], $serviciosDb['FechaTerminoServicio'],
			$serviciosDb['SStatus'], $serviciosDb['CalleEntrega'],$serviciosDb['CodigoPostalEntrega'],$serviciosDb['IdCiudad'],$serviciosDb['NombrePersonaEntrega'],
			$serviciosDb['TelefonoPersonEntrega'],$serviciosDb['CorreoPersonaEntrega'],$serviciosDb['RequiereFactura'] ,$serviciosDb['Factura'],$serviciosDb['IdStatus']);
		//var_dump($alumno);
		//die();
		return $servicio;

	}

	public static function update($servicios){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert=$db->prepare('INSERT INTO servicios VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdOrdenServicio',$servicios->getIdOrdenServicio());
		$insert->bindValue('FolioCotizacion',$servicios->getFolioCotizacion());
		$insert->bindValue('FolioServicio',$servicios->getFolioServicio());
		$insert->bindValue('IdEmpleado',$servicios->getIdEmpleado());
		$insert->bindValue('FechaCaptura',$servicios->getFechaCaptura());
		$insert->bindValue('HoraCaptura',$servicios->getHoraCaptura());
		$insert->bindValue('IdCliente',$servicios->getIdCliente());
		$insert->bindValue('FechaComienzoServicio',$servicios->getFechaComienzoServicio());
		$insert->bindValue('FechaTerminoServicio',$servicios->getFechaTerminoServicio());
		$insert->bindValue('SStatus',$servicios->getSStatus());
		$insert->bindValue('CalleEntrega',$servicios->getCalleEntrega());
		$insert->bindValue('ColoniaEntrega',$servicios->getColoniaEntrega());
		$insert->bindValue('CodigoPostalEntrega',$servicios->getCodigoPostalEntrega());
		$insert->bindValue('IdCiudad',$servicios->getIdCiudad());
		$insert->bindValue('NombrePersonaEntrega',$servicios->getNombrePersonaEntrega());
		$insert->bindValue('TelefonoPersonEntrega',$servicios->getTelefonoPersonaEntrega());
		$insert->bindValue('CorreoPersonaEntrega',$servicios->getCorreoPersonaEntrega());
		$insert->bindValue('RequiereFactura',$servicios->getRequiereFcatura());
		$insert->bindValue('Factura',$servicios->getFcatura());
		$insert->bindValue('IdStatus',$servicios->getIdStatuas());
		$insert->execute();
		}

	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM orde_servicios WHERE IdOrdenServicio=:id');
		$delete->bindValue('id',$id);
		$delete->execute();		
	}
}

?>