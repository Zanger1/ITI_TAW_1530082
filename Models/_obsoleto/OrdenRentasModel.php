<?php 
class OrdenRentasModel{
	private $IdOredenRenta;
	private $FolioCotizacion;
	private $IdEmpleado;
	private $IdSucursal;
	private $IdStatus;
	private $FechaCaptura;
	private $HoraCaptura;
	private $IdCliente;
	private $SStatus;
	private $FechaInicio;
	private $FechaTermino;
	private $FolioRenta;
	private $CalleEntrega;
	private $ColoniEntrega;
	private $CodigoPostalEntrega;
	private $IdCiudad;
	private $NombrePersonaEntrega;
	private $TelefonoPersonaEntrga;
	private $CorreoPersonaEntrega;
	private $RequiereFactura;
	private $Facturado;
	private $Recuperado;

	function __construct($IdOredenRenta, $FolioCotizacion,$IdEmpleado, $IdSucursal, $IdStatus,$FechaCaptura,
	$HoraCaptura,$IdCliente, $SStatus, $FechaInicio,$FechaTermino, $FolioRenta,$CalleEntrega, $ColoniEntrega,$CodigoPostalEntrega, $IdCiudad,
	$NombrePersonaEntrega, $TelefonoPersonaEntrga, $CorreoPersonaEntrega, $RequiereFactura, $Facturado, $Recuperado)
	{
		$this->setIdOrdenRenata($IdOredenRenta);
		$this->setFolioCotizacion($FolioCotizacion);
		$this->setApellidoPat($IdEmpleado);
		$this->setAIdEmpleado($IdSucursal);
		$this->setIdStatus($IdStatus);
		$this->setFechaCaptura($FechaCaptura);
		$this->setHoraCaptura($HoraCaptura);
		$this->setIdCliente($IdCliente);
		$this->setSStatus($SStatus);
		$this->setFechaInicio($FechaInicio);
		$this->setFechaTermino($FechaTermino);
		$this->setFolioRenta($FolioRenta);
		$this->setCalleEntrega($CalleEntrega);
		$this->setColoniEntrega($ColoniaEntrega);
		$this->setCodigoPostalEntrega($CodigoPostalEntrega);
		$this->setIdCiudad($IdCiudad);
		$this->setNombrePersonaEntrega($NombrePersonaEntrega);
		$this->setTelefonoPersonaEntrga($TelefonoPersonaEntrga);
		$this->setCorreoPersonaEntrega($CorreoPersonaEntrega);
		$this->setRequiereFactura($RequiereFactura);
		$this->setFacturado($Facturado);
		$this->setRecuperado($Recuperado);
	}

	public function getIdOredenRenta(){
		return $this->IdOredenRenta;
	}
	public function setIdOredenRenta($IdOredenRenta){
		$this->IdOredenRenta = $IdOredenRenta;
	}
	public function getFolioCotizacion(){
		return $this->FolioCotizacion;
	}
	public function setFolioCotizacion($FolioCotizacion){ 
		$this->FolioCotizacion = $FolioCotizacion;
	}
	public function getIdEmpleado(){
		return $this->IdEmpleado;
	}
	public function setIdEmpleado($IdEmpleado){
		$this->IdEmpleado = $IdEmpleado;
	}
	public function getIdSucursal(){
		return $this->IdSucursal;
	}
	public function setIdSucursal($IdSucursal){
		$this->IdSucursal = $IdSucursal;
	}
	public function getIdStatus(){
		return $this->IdStatus;
	}
	public function setIdStatus($IdStatus){
		$this->IdStatus = $IdStatus;
	}
	public function getFechaCaptura(){
		return $this->FechaCaptura;
	}
	public function setFechaCapturao($FechaCaptura){
		$this->FechaCaptura = $FechaCaptura;
	}
	public function getHoraCaptura(){
		return $this->HoraCaptura;
	}
	public function setHoraCaptura($HoraCaptura){
		$this->HoraCaptura = $HoraCaptura;
	}
	public function getIdCliente(){
		return $this->IdCliente;
	}
	public function setIdCliente($IdCliente){
		$this->IdCliente = $IdCliente;
	}
	public function getSStatus(){
		return $this->SStatus;
	}
	public function setSStatus($SStatus){
		$this->SStatus = $SStatus;
	}
	public function getFechaInicio(){
		return $this->FechaInicio;
	}
	public function setFechaInicio($FechaInicio){
		$this->FechaInicio= $FechaInicio;
	}
	public function getFechaTermino(){
		return $this->FechaTermino;
	}
	public function setFechaTermino($FechaTermino){
		$this->FechaTermino = $FechaTermino;
	}
	public function getFolioRenta(){
		return $this->FolioRenta;
	}
	public function setFolioRenta($FolioRenta){
		$this->FolioRenta = $FolioRenta;
	}
	public function getCalleEntrega(){
		return $this->CalleEntrega;
	}
	public function setCalleEntrega($CalleEntrega){
		$this->CalleEntrega = $CalleEntrega;
	}
	public function getColoniaEntrega(){
		return $this->ColoniaEntrega;
	}
	public function setColoniaEntrega($ColoniaEntrega){
		$this->ColoniaEntrega = $ColoniaEntrega;
	}
	public function getCodigoPostalEntrega(){
		return $this->CodigoPostalEntrega;
	}
	public function setCodigoPostalEntrega($CodigoPostalEntrega){
		$this->CodigoPostalEntrega = $CodigoPostalEntrega;
	}
	public function getIdCiudad(){
		return $this->IdCiudad;
	}
	public function setIdCiudad($IdCiudad){
		$this->IdCiudad = $IdCiudad;
	}
	public function getNombrePersonaEntrega(){
		return $this->NombrePersonaEntrega;
	}
	public function setNombrePersonaEntrega($NombrePersonaEntrega){
		$this->NombrePersonaEntrega = $NombrePersonaEntrega;
	}
	public function getTelefonoPersonaEntrga(){
		return $this->TelefonoPersonaEntrga;
	}
	public function setTelefonoPersonaEntrga($TelefonoPersonaEntrga){
		$this->TelefonoPersonaEntrga = $TelefonoPersonaEntrga;
	}
	public function getCorreoPersonaEntrega(){
		return $this->CorreoPersonaEntrega;
	}
	public function setCorreoPersonaEntrega($CorreoPersonaEntrega){
		$this->CorreoPersonaEntrega = $CorreoPersonaEntrega;
	}
	public function getRequiereFactura(){
		return $this->RequiereFactura;
	}
	public function setRequiereFactura($RequiereFactura){
		$this->RequiereFactura = $RequiereFactura;
	}
	public function getFacturado(){
		return $this->Facturado;
	}
	public function setFacturado($Facturado){
		$this->Facturado = $Facturado;
	}
	public function getRecuperado(){
		return $this->Recuperado;
	}
	public function setRecuperado($Recuperado){		$this->Recuperado = $Recuperado;
	}
	public static function save($rentas){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO rentas VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdOredenRenta',$rentas->getIdOredenRenta());
		$insert->bindValue('FolioCotizacion',$rentas->getFolioCotizacion());
		$insert->bindValue('IdEmpleado',$rentas->getIdEmpleado());
		$insert->bindValue('IdSucursal',$rentas->getIdSucursal());
		$insert->bindValue('IdStatus',$rentas->getIdStatus());
		$insert->bindValue('FechaCaptura',$rentas->getFechaCaptura());
		$insert->bindValue('HoraCaptura',$rentas->getHoraCaptura());
		$insert->bindValue('IdCliente',$rentas->getIdCliente());
		$insert->bindValue('SStatus',$rentas->getSStatus());
		$insert->bindValue('FechaInicio',$rentas->getFechaInicio());
		$insert->bindValue('FechaTermino',$rentas->getFechaTermino());
		$insert->bindValue('FolioRenta',$rentas->getFolioRenta());
		$insert->bindValue('CalleEntrega',$rentas->getCalleEntrega());
		$insert->bindValue('ColoniEntrega',$rentas->getColoniaEntrega());
		$insert->bindValue('CodigoPostalEntrega',$rentas->getCodigoPostalEntrega());
		$insert->bindValue('IdCiudad',$rentas->getIdCiudad());
		$insert->bindValue('NombrePersonaEntrega',$rentas->getNombrePersonaEntrega());
		$insert->bindValue('TelefonoPersonaEntrga',$rentas->getTelefonoPersonaEntrga());
		$insert->bindValue('CorreoPersonaEntrega',$rentas->getCorreoPersonaEntrega());
		$insert->bindValue('RequiereFactura',$rentas->getRequiereFactura());
		$insert->bindValue('Facturado',$rentas->getFacturado());
		$insert->bindValue('Recuperado',$rentas->getRecuperado());
		$insert->execute();
	}
	public static function all(){
		$db=DataBase::getConnect();
		$listaRentas=[];
		$select=$db->query('SELECT * FROM rentas order by IdOredenRenta');
		foreach($select->fetchAll() as $rentas){
			$listaRentas[]=new OrdenRentasModel($rentas['IdOredenRenta'],$rentas['FolioCotizacion'],$rentas['IdEmpleado'],$rentas['IdSucursal'],
			$rentas['IdStatus'], $rentas['FechaCaptura'], $rentas['HoraCaptura'], $rentas['IdCliente'], $rentas['SStatus'],
			$rentas['FechaInicio'], $rentas['FechaTermino'],$rentas['FolioRenta'],$rentas['CalleEntrega'],$rentas['ColoniEntrega'],$rentas['CodigoPostalEntrega'],
			$rentas['IdCiudad'],$rentas['NombrePersonaEntrega'],$rentas['TelefonoPersonaEntrga'],$rentas['CorreoPersonaEntrega'],$rentas['RequiereFactura'],
			$rentas['Facturado'],$rentas['Recuperado']);
		}
		return $listaRentas;
	}
	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM rentas WHERE IdOredenRenta=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$rentasDb=$select->fetch();
		$renta = new OrdenRentasModel ($rentasDb['IdOredenRenta'],$rentasDb['FolioCotizacion'],$rentasDb['IdEmpleado'],$rentasDb['IdSucursal'],
			$rentasDb['IdStatus'], $rentasDb['FechaCaptura'], $rentasDb['HoraCaptura'], $rentasDb['IdCliente'], $rentasDb['SStatus'],
			$rentasDb['FechaInicio'], $rentasDb['FechaTermino'],$rentasDb['FolioRenta'],$rentasDb['CalleEntrega'],$rentasDb['ColoniEntrega'],$rentasDb['CodigoPostalEntrega'],
			$rentasDb['IdCiudad'],$rentasDb['NombrePersonaEntrega'],$rentasDb['TelefonoPersonaEntrga'],$rentasDb['CorreoPersonaEntrega'],$rentasDb['RequiereFactura'],
			$rentasDb['Facturado'],$rentasDb['Recuperado']);
		//var_dump($alumno);
		//die();
		return $renta;	}	public static function NoRecuperado($id){	//2019/11/14 => Esta clase fue declarada obsoleta, este metodo se ha movido a class TestFrameeModel (class cuyo nombre esta sujeto a cabiar)
		$db=DataBase::getConnect();		//Cuando haces una cotizacion esta tabla es el carrito y si se realiza la orden, debe salir del inventario por lo tanto se resta del stock
#		$select=$db->prepare('SELECT COUNT(IdInventarioUnidadesRenta) As total_no_disponible FROM _cotizaciones_cart WHERE recuperado = 0 AND IdInventarioUnidadesRenta=:id');		$select=$db->prepare('SELECT SUM(cantidad) As total_no_disponible FROM _cotizaciones_cart_rentas WHERE recuperado = 0 AND IdInventarioUnidadesRenta=:id');		$select->bindValue('id',$id);
		$select->execute();
		$result=$select->fetch();
		$recuperado = $result['total_no_disponible'];		if(empty($recuperado)){ $recuperado = 0; }
		return $recuperado;	}
	public static function update($rentas){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdOredenRenta',$rentas->getIdOredenRenta());
		$insert->bindValue('FolioCotizacion',$rentas->getFolioCotizacion());
		$insert->bindValue('IdEmpleado',$rentas->getIdEmpleado());
		$insert->bindValue('IdSucursal',$rentas->getIdSucursal());
		$insert->bindValue('IdStatus',$rentas->getIdStatus());
		$insert->bindValue('FechaCaptura',$rentas->getFechaCaptura());
		$insert->bindValue('HoraCaptura',$rentas->getHoraCaptura());
		$insert->bindValue('IdCliente',$rentas->getIdCliente());
		$insert->bindValue('SStatus',$rentas->getSStatus());
		$insert->bindValue('FechaInicio',$rentas->getFechaInicio());
		$insert->bindValue('FechaTermino',$rentas->getFechaTermino());
		$insert->bindValue('FolioRenta',$rentas->getFolioRenta());
		$insert->bindValue('CalleEntrega',$rentas->getCalleEntrega());
		$insert->bindValue('ColoniEntrega',$rentas->getColoniaEntrega());
		$insert->bindValue('CodigoPostalEntrega',$rentas->getCodigoPostalEntrega());
		$insert->bindValue('IdCiudad',$rentas->getIdCiudad());
		$insert->bindValue('NombrePersonaEntrega',$rentas->getNombrePersonaEntrega());
		$insert->bindValue('TelefonoPersonaEntrga',$rentas->getTelefonoPersonaEntrga());
		$insert->bindValue('CorreoPersonaEntrega',$rentas->getCorreoPersonaEntrega());
		$insert->bindValue('RequiereFactura',$rentas->getRequiereFactura());
		$insert->bindValue('Facturado',$rentas->getFacturado());
		$insert->bindValue('Recuperado',$rentas->getRecuperado());
		$insert->execute();
	}
	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM alumno WHERE IdOredenRenta=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
}
?>