<?php 
class SucursalesModel {
	private $IdSucursal;
	private $Nombre;
	private $NombreContacto;
	private $CorreoContacto;
	private $IdCiudad;
	private $Direccion;
	private $Telefono;
	private $IdTipoSucursal;
	private $LetraFolio;
	function __construct($IdSucursal, $Nombre, $NombreContacto, $CorreoContacto,$IdCiudad,
	$Direccion,$Telefono, $IdTipoSucursal, $LetraFolio, $TotalEnCaja){
		$this->setIdSucursal($IdSucursal);
		$this->setNombre($Nombre);
		$this->setNombreContacto($NombreContacto);
		$this->setNombreContacto($CorreoContacto);
		$this->setIdCiudad($IdCiudad);
		$this->setDireccion($Direccion);
		$this->setTelefono($Telefono);
		$this->setIdTipoSucursal($IdTipoSucursal);
		$this->setLetraFolio($LetraFolio);
		$this->setTotalEnCaja($TotalEnCaja);
	}
	public function getIdSucursal(){
		return $this->IdSucursal;
	}
	public function setIdSucursal($IdSucursal){
		$this->IdSucursal = $IdSucursal;
	}
	public function getNombre(){
		return $this->Nombre;
	}
	public function setNombre($Nombre){ 
		$this->Nombre = $Nombre;
	}
	public function getNombreContacto(){
		return $this->NombreContacto;
	}
	public function setNombreContacto($NombreContacto){
		$this->NombreContacto = $NombreContacto;
	}
	public function getCorreoContacto(){
		return $this->CorreoContacto;
	}
	public function setCorreoContacto($CorreoContacto){
		$this->CorreoContacto = $CorreoContacto;
	}
	public function getIdCiudad(){
		return $this->IdCiudad;
	}
	public function setIdCiudad($IdCiudad){
		$this->IdCiudad = $IdCiudad;
	}
	public function getDireccion(){
		return $this->Direccion;
	}
	public function setDireccion($Direccion){
		$this->Direccion = $Direccion;
	}
	public function getTelefono(){
		return $this->Telefono;
	}
	public function setTelefono($Telefono){
		$this->Telefono = $Telefono;
	}
	public function getIdTipoSucursal(){
		return $this->IdTipoSucursal;
	}
	public function setIdTipoSucursal($IdTipoSucursal){
		$this->IdTipoSucursal = $IdTipoSucursal;
	}
	public function getLetraFolio(){
		return $this->LetraFolio;
	}
	public function setLetraFolio($LetraFolio){
		$this->LetraFolio= $LetraFolio;
	}
		return $this->TotalEnCaja;
	}
	public function setTotalEnCaja($TotalEnCaja){
		$this->TotalEnCaja= $TotalEnCaja;
	}
	public static function save($sucursales){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
		$insert=$db->prepare('INSERT INTO sucursales VALUES (NULL, :nombres,:apellidos,:estado)');
		$insert->bindValue('IdSucursal',$sucursales->getIdSucursal());
		$insert->bindValue('Nombre',$sucursales->getNombre());
		$insert->bindValue('NombreContacto',$sucursales->getNombreContacto());
		$insert->bindValue('CorreoContacto',$sucursales->getCorreoContacto());
		$insert->bindValue('IdCiudad',$sucursales->getIdCiudad());
		$insert->bindValue('Direccion',$sucursales->getDireccion());
		$insert->bindValue('Telefono',$sucursales->getTelefono());
		$insert->bindValue('IdTipoSucursal',$sucursales->getIdTipoSucursal());
		$insert->bindValue('LetraFolio',$sucursales->getLetraFolio());
		$insert->execute();
	}
	public static function all(){
		$db=DataBase::getConnect();
		$listaSucursales=[];
		$select=$db->query('SELECT * FROM sucursales order by IdSucursal');
		foreach($select->fetchAll() as $sucursales){
			$listaSucursales[]=new SucursalesModel($sucursales['IdSucursal'],$sucursales['Nombre'],$sucursales['NombreContacto'],
			$sucursales['CorreoContacto'], $sucursales['IdCiudad'], $sucursales['Direccion'], $sucursales['Telefono'], $sucursales['IdTipoSucursal'],
			$sucursales['LetraFolio'],$sucursales['TotalEnCaja']);
		}
		return $listaSucursales;
	}
	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM sucursales WHERE IdSucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$sucursalesDB=$select->fetch();
		$sucursal = new SucursalesModel ($sucursalesDB['IdSucursal'],$sucursalesDB['Nombre'], $sucursalesDB['NombreContacto'],
		$sucursalesDB['CorreoContacto'],$sucursalesDB['IdCiudad'],$sucursalesDB['Direccion'],$sucursalesDB['Telefono'],$sucursalesDB['IdTipoSucursal'],
		$sucursalesDB['LetraFolio'],$sucursalesDB['TotalEnCaja']);
		//var_dump($alumno);
		//die();
		return $sucursal;	//Para mostrar en empleados, no se si se ocupe uno igual para
	}
	public static function getOnlyName($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM sucursales WHERE IdSucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$sucursalesDB=$select->fetch();
		$sucursal = new SucursalesModel ($sucursalesDB['IdSucursal'],$sucursalesDB['Nombre'], $sucursalesDB['NombreContacto'],
		$sucursalesDB['CorreoContacto'],$sucursalesDB['IdCiudad'],$sucursalesDB['Direccion'],$sucursalesDB['Telefono'],$sucursalesDB['IdTipoSucursal'],
		$sucursalesDB['LetraFolio'],$sucursalesDB['TotalEnCaja']);
		//var_dump($alumno);
		//die();
		return $sucursalesDB["Nombre"];	//Para mostrar en empleados, no se si se ocupe uno igual para
	}
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT * FROM sucursales WHERE IdSucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$sucursalesDB=$select->fetch();
		//var_dump($alumno);
		//die();
		return $sucursalesDB['LetraFolio'];	//Para mostrar en empleados, no se si se ocupe uno igual para
	}
	public static function getTotalEnCajaActual($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT TotalEnCaja FROM sucursales WHERE IdSucursal=:id');
		$select->bindValue('id',$id);
		$select->execute();
		$sucursalesDB=$select->fetch();
		return $sucursalesDB["TotalEnCaja"];
	}
		$db=DataBase::getConnect();
		$select=$db->prepare('SELECT SUM(TotalEnCaja) AS temp_total FROM sucursales');
		$select->execute();
		$sucursalesDB=$select->fetch();
		return $sucursalesDB["temp_total"];
	}
	public static function update($sucursales){
		$db=DataBase::getConnect();
		// $update=$db->prepare('UPDATE alumno SET nombres=:nombres, apellidos=:apellidos, estado=:estado WHERE id=:id');
		$insert->bindValue('IdSucursal',$sucursales->getIdSucursal());
		$insert->bindValue('Nombre',$sucursales->getNombre());
		$insert->bindValue('NombreContacto',$sucursales->getNombreContacto());
		$insert->bindValue('CorreoContacto',$sucursales->getCorreoContacto());
		$insert->bindValue('IdCiudad',$sucursales->getIdCiudad());
		$insert->bindValue('Direccion',$sucursales->getDireccion());
		$insert->bindValue('Telefono',$sucursales->getTelefono());
		$insert->bindValue('IdTipoSucursal',$sucursales->getIdTipoSucursal());
		$insert->bindValue('LetraFolio',$sucursales->getLetraFolio());
		$insert->execute();
	}
		$db=DataBase::getConnect();
		$update=$db->prepare('UPDATE sucursales SET TotalEnCaja=:TotalEnCaja WHERE IdSucursal=:IdSucursal');
		$update->bindValue('IdSucursal',$IdSucursal);
		$update->bindValue('TotalEnCaja',$TotalEnCaja);
		$update->execute();
	}
		$db=DataBase::getConnect();
		$update=$db->prepare('UPDATE sucursales SET TotalEnCaja=:TotalEnCaja WHERE IdSucursal=:IdSucursal');
		$update->bindValue('IdSucursal',$IdSucursal);
		$update->bindValue('TotalEnCaja',$Monto);
		$update->execute();
	}
	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('DELETE  FROM alumno WHERE IdSucursal=:id');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
}
?>