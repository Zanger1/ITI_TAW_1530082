<?php
class ClientesModel {
	private $IdCliente;
	private $Nombre;
	private $RFC;
	private $Calle;
	private $Colonia;
	private $CodigoPostal;
	private $Num;
	private $IdCiudad;
	private $CorreoElectronico;
	private $Telefono;
	function __construct($IdCliente, $Nombre, $RFC, $Calle,$Colonia,$CodigoPostal,$Num, $IdCiudad,$CorreoElectronico, $Telefono){
		$this->setIdCliente($IdCliente);
		$this->setNombre($Nombre);
		$this->setRFC($RFC);
		$this->setCalle($Calle);
		$this->setColonia($Colonia);
		$this->setCodigoPostal($CodigoPostal);
		$this->setNum($Num);
		$this->setIdCiudad($IdCiudad);
		$this->setCorreElctronico($CorreoElectronico);
		$this->setTelefono($Telefono);
	}
	public function getIdCliente(){
		return $this->IdCliente;
	}
	public function setIdCliente($IdCliente){
		$this->IdCliente = $IdCliente;
	}
	public function getNombre(){
		return $this->Nombre;
	}
	public function setNombre($Nombre){
		$this->Nombre = $Nombre;
	}
	public function getRFC(){
		return $this->RFC;
	}
	public function setRFC($RFC){
		$this->RFC = $RFC;
	}
	public function getCalle(){
		return $this->Calle;
	}
	public function setCalle($Calle){
		$this->Calle = $Calle;
	}
	public function getColonia(){
		return $this->Colonia;
	}
	public function setColonia($Colonia){
		$this->Colonia = $Colonia;
	}
	public function getCodigoPostal(){
		return $this->CodigoPostal;
	}
	public function setCodigoPostal($CodigoPostal){
		$this->CodigoPostal = $CodigoPostal;
	}
	public function getNum(){
		return $this->Num;
	}
	public function setNum($Num){
		$this->Num = $Num;
	}
	public function getIdCiudad(){
		return $this->IdCiudad;
	}
	public function setIdCiudad($IdCiudad){
		$this->IdCiudad= $IdCiudad;
	}
	public function getCorreoElectronico(){
		return $this->CorreoElectronico;
	}
	public function setCorreElctronico($CorreoElectronico){
		$this->CorreoElectronico = $CorreoElectronico;
	}
	public function getTelefono(){
		return $this->Telefono;
	}
	public function setTelefono($Telefono){
		$this->Telefono= $Telefono;
	}
	/*public function getEstado(){
		return $this->estado;
	}
	public function setEstado($estado){
		if (strcmp($estado, 'on')==0) {
			$this->estado=1;
		} elseif(strcmp($estado, '1')==0) {
			$this->estado='checked';
		}elseif (strcmp($estado, '0')==0) {
			$this->estado='of';
		}else {
			$this->estado=0;
		}
	}
	*/
	public static function save($clientes){
		$db=DataBase::getConnect();
		//var_dump($alumno);
		//die();
	#		$insert=$db->prepare('INSERT INTO clientes VALUES (NULL,:Nombre,:RFC,:Calle,:Colonia,:CodigoPostal,:Num,:IdCiudad,:CorreoElectronico,:Telefono)');
			$insert=$db->prepare('CALL add_clientes(:Nombre,:RFC,:Calle,:Colonia,:CodigoPostal,:Num,:IdCiudad,:CorreoElectronico,:Telefono)');
			#$insert->bindValue('IdCliente',$clientes->getIdCliente());
			$insert->bindValue('Nombre',$clientes->getNombre());
			$insert->bindValue('RFC',$clientes->getRFC());
			$insert->bindValue('Calle',$clientes->getCalle());
			$insert->bindValue('Colonia',$clientes->getColonia());
			$insert->bindValue('CodigoPostal',$clientes->getCodigoPostal());
			$insert->bindValue('Num',$clientes->getNum());
			$insert->bindValue('IdCiudad',$clientes->getIdCiudad());
			$insert->bindValue('CorreoElectronico',$clientes->getCorreoElectronico());
			$insert->bindValue('Telefono',$clientes->getTelefono());
#			$insert->execute();
	}
	public static function all(){
		$db=DataBase::getConnect();
		$listaClientes=[];
		$select=$db->query('CALL get_clientes("")');	//'CALL get_clientes("")'
		foreach($select->fetchAll() as $clientes){$listaClientes[]=new ClientesModel($clientes['IdCliente'],$clientes['Nombre'],$clientes['RFC'],$clientes['Calle'],$clientes['Colonia'], 
			$clientes['CodigoPostal'],$clientes['Num'],$clientes['IdCiudad'], $clientes['CorreoElectronico'],$clientes['Telefono'] );
		}
		return $listaClientes;
	}
	public static function searchById($id){
		$db=DataBase::getConnect();
		$select=$db->prepare('CALL get_cliente_id(:id)');
		$select->bindValue('id',$id);
		$select->execute();
		$clientesDb=$select->fetch();
		$clientes = new ClientesModel ($clientesDb['IdCliente'],$clientesDb['Nombre'],$clientesDb['RFC'],$clientesDb['Calle'],$clientesDb['Colonia'],
		$clientesDb['CodigoPostal'],$clientesDb['Num'],$clientesDb['IdCiudad'],$clientesDb['CorreoElectronico'],$clientesDb['Telefono']);
		//var_dump($alumno);
		//die();
		return $clientes;
	}
	public static function update($clientes){
		$db=DataBase::getConnect();
#		$update=$db->prepare('UPDATE clientes SET Nombre=:Nombre,    RFC=:RFC, Calle=:Calle, Colonia=:Colonia, CodigoPostal=:CodigoPostal, Num=:Num, IdCiudad=:IdCiudad, CorreoElectronico=:CorreoElectronico, Telefono=:Telefono WHERE IdCliente=:IdCliente');
	}
	public static function delete($id){
		$db=DataBase::getConnect();
		$delete=$db->prepare('CALL delete_clientes(:id)');
		$delete->bindValue('id',$id);
		$delete->execute();
	}
}
?>