<?php

class PreNominaDetallesModel{
    private $idDetallePrenominaExtra;
    private $idPrenominaExtra;
    private $idEmpleado;
    private $idExtraSucursal;
    private $monto;
    private $cantidad;
    private $comentarios;
    private $idSituacionPrenomina;
    private $subtotal;
    private $comentarioMatriz;

  public function __construct($idDetallePrenominaExtra,$idPrenominaExtra,$idEmpleado,$idExtraSucursal,$monto,$cantidad,$comentarios,$idSituacionPrenomina,$comentarioMatriz,$subtotal)
    {
        $this->setidDetallePrenominaExtra($idDetallePrenominaExtra);
        $this->setidPrenominaExtra($idPrenominaExtra);
        $this->setidEmpleado($idEmpleado);
        $this->setidExtraSucursal($idExtraSucursal);
        $this->setMonto($monto);
        $this->setCantidad($cantidad);
        $this->setComentarios($comentarios);
        $this->setIdSituacionPrenomina($idSituacionPrenomina);
        $this->setComentarioMatriz($comentarioMatriz);
        $this->setsubtotal($subtotal);


    }

      public function getsubtotal()
      {
        return $this->subtotal;
      }
      public function setsubtotal($subtotal)
      {
        $this->subtotal = $subtotal;
      }
      public function getComentarioMatriz()
      {
        return $this->ComentarioMatriz;
      }

      public function setComentarioMatriz($comentarioMatriz)
      {
        $this->ComentarioMatriz = $comentarioMatriz;
      }

    public function getidDetallePrenominaExtra()
    {
      return $this->idDetallePrenominaExtra;
    }

    public function setidDetallePrenominaExtra($idDetallePrenominaExtra)
    {
      $this->idDetallePrenominaExtra = $idDetallePrenominaExtra;
    }

    public function getidPrenominaExtra()
    {
      return $this->idPrenominaExtra;
    }
    public function setidPrenominaExtra($idPrenominaExtra)
    {
      $this->idPrenominaExtra = $idPrenominaExtra;
    }
      public function getidEmpleado ()
    {
      return $this->idEmpleado;
    }
    public function setidEmpleado($idEmpleado)
    {
      $this->idEmpleado = $idEmpleado;
    }

    public function getmonto()
    {
      return $this->monto;
    }
    public function setMonto($monto)
    {
      $this->monto = $monto;
    }

    public function getCantidad()
    {
      return $this->cantidad;
    }
    public function setCantidad($cantidad)
    {
      $this->cantidad = $cantidad;
    }

    public function getSituacionPrenomina()
    {
      return $this->idSituacionPrenomina;
    }

    public function setIdSituacionPrenomina($idSituacionPrenomina)
    {
      $this->idSituacionPrenomina = $idSituacionPrenomina;
    }

    public function getComentarios()
    {
      return $this->comentarios;
    }
    public function setComentarios($comentarios)
    {
      $this->comentarios= $comentarios;
    }
    public function setidExtraSucursal($idExtraSucursal)
    {
      $this->$idExtraSucursal = $idExtraSucursal;
    }
    public function getidExtraSucursal()
    {
      return $this->idExtraSucursal;
    }


    //---------------------------------------------------------------------------//

      //--------------------------------------------------------------------------------------------------//
//-------------------------------------------------------------------------------------------------------------------------------------_//
    public static function get_total_all_records()
    {
      $db=DataBase::getConnect();
     $select=$db->query('select * from detalleprenominaextras');
     $select->execute();
     $result = $select->fetchAll();
     return $select->rowCount();
    }
    //--------------------------------------------------------------------------------------------------__-------____________------7//

    public static function searchById($id){
      $db=DataBase::getConnect();
      $select=$db->prepare('SELECT * FROM detalleprenominaextras  WHERE idDetallePrenominaExtras = :id');
      $select->bindValue('id',$id);
      $select->execute();
      $NominaDb=$select->fetch();
      $Nomina = new PreNominaDetallesModel($NominaDb['idDetallePrenominaExtras'],$NominaDb['idPrenominaExtra'],$NominaDb['idEmpleado'],$NominaDb['idExtraSucursal'],
      $NominaDb['monto'],$NominaDb['cantiad'],$NominaDb['comentarios'],$NominaDb['idSituacionPrenomina'],$NominaDb['ComentarioMatriz'],$NominaDb['subtotal']);

      return $Nomina;
    }


    public static function all_json()
    {
      function shorter($text, $chars_limit){
        if (strlen($text) > $chars_limit){
          $new_text = substr($text, 0, $chars_limit);
          $new_text = trim($new_text);
          return '<span data-toggle="tooltip" data-placement="top" title="'.$text.'">'.$new_text . "...".'</span>';
        } else {
          return $text;
        }
      }


      $db=DataBase::getConnect();
  		$output = array();
  #		$filtro_busqueda=$_POST["search"]["value"];	//El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]
  		$query = 'SELECT * FROM detalleprenominaextras det INNER JOIN empleados e ON det.idEmpleado = e.idEmpleado INNER JOIN situacionprenominaextra sit ON det.idSituacionPrenomina = sit.idSituacionPrenominaExtra';
  		$statement = $db->prepare($query);
  #		$statement->bindValue(':busqueda', $filtro_busqueda);	//Al param :busqueda se le asigna el $filtro_busqueda. ref[1],
  		$statement->execute();
  		$result = $statement->fetchAll();
  		$statement->closeCursor();
  		$data = array();
  		$filtered_rows = $statement->rowCount();
  		foreach($result as $row){
  			//$direccion = 'a';
  			//if($row["estatus"]=='1'){ $situacion = 'ACTIVO'; } else { $situacion = 'INACTIVO'; }
  			$image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
  			$sub_array = array();
  			$sub_array[] = $row["idPrenominaExtra"];
  			$sub_array[] = $row["NombreEmpleado"]." ".$row["ApellidoPat"]." ".$row["Apellidomat"];
  			$sub_array[] = $row["monto"];
      	$sub_array[] = $row["cantiad"];
        $sub_array[] = $row["subtotal"];
        $sub_array[] = $row["comentarios"];
  			$sub_array[] = $row["DesSituacionPrenominaExtra"];

        //$sub_array[] = shorter($row['Calle'], 10);//SucursalesModel::getOnlyName($row["IdSucursal"]);
            if(isset($_SESSION["id_role"])){
              $id_role = $_SESSION["id_role"];
              if($id_role == '3'){ //Solo para auxiliares
                  $sub_array[] = '<button type="button" name="view" id="'.$row["idDetallePrenominaExtras"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["idDetallePrenominaExtras"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';
              } else {	//Administradores: General y de sucursal
                  $sub_array[] = '<button type="button" name="view" id="'.$row["idDetallePrenominaExtras"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["idDetallePrenominaExtras"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["idDetallePrenominaExtras"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
              }
            }

        $data[] = $sub_array;
      }

      $draw = '';
      if(isset($_POST["draw"])){
        $draw = $_POST["draw"];
      }

      $output = array(
        "draw"    => intval($draw),
        "recordsTotal"  =>  $filtered_rows,
        "recordsFiltered" => self::get_total_all_records(),
        "data"    => $data
      );

      function utf8ize($d) {	//Me ayuda con los tildes/acentos
        if (is_array($d)) {
          foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
          }
        } else if (is_string ($d)) {
          return utf8_encode($d);
        }
        return $d;
      }

      echo json_encode(utf8ize($output));
    }

//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//metodo update
  public static function update($PreNominaDetalles)
  {
    $db=DataBase::getConnect();
    $update = $db->prepare('UPDATE detalleprenominaextras(idDetallePrenominaExtras,idPrenominaExtra,idEmpleado,idExtraSucursal,monto,cantiad,comentarios,idSituacionPrenomina,subtotal,ComentarioMatriz)
    SET  (idDetallePrenominaExtras = :idDetallePrenominaExtras,idPrenominaExtra = :idPrenominaExtra,idEmpleado = :idEmpleado,idExtraSucursal = :idExtraSucursal,monto = :monto,cantiad = :cantiad,comentarios = :comentarios,idSituacionPrenomina = :idSituacionPrenomina,subtotal = :subtotal,ComentarioMatriz = :ComentarioMatriz)  WHERE idDetallePrenominaExtras = :idDetallePrenominaExtras');


    $update->bindValue('idPrenominaExtra',$PreNominaDetalles->getidDetallePrenominaExtra());
    $update->bindValue('idPrenominaExtra',$PreNominaDetalles->getidPrenominaExtra());
    $update->bindValue('idEmpleado',$PreNominaDetalles->getidEmpleado());
    $update->bindValue('idExtraSucursal',$PreNominaDetalles->getidExtraSucursal());
    $update->bindValue('idExtraSucursal',$PreNominaDetalles->getidExtraSucursal());
    $update->bindValue('monto',$PreNominaDetalles->getMonto());
    $update->bindValue('cantiad',$PreNominaDetalles->getCantidad());
    $update->bindValue('comentarios',$PreNominaDetalles->getComentarios());
    $update->bindValue('idSituacionPrenomina',$PreNominaDetalles->getIdSituacionPrenomina());
    $update->bindValue('subtotal',$PreNominaDetalles->getsubtotal());
    $update->bindValue('ComentarioMatriz',$PreNominaDetalles->getComentarioMatriz());

    $update->execute();
  }

  //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  //metodo de guardado xDXDXDXXDXDXXXDXDDXDXDXXDD

    public static function save($PreNominaDetalles)
  {
    $db=DataBase::getConnect();
    $save= $db->prepare('INSERT INTO detalleprenominaextras (idDetallePrenominaExtras, idPrenominaExtra, idEmpleado, idExtraSucursal, monto, cantiad, comentarios, idSituacionPrenomina, subtotal, ComentarioMatriz) VALUES (:idDetallePrenominaExtras, :idPrenominaExtra, :idEmpleado, :idExtraSucursal, :monto, :cantiad, :comentarios, :idSituacionPrenomina, :subtotal, :ComentarioMatriz)');
     $save->bindValue('idDetallePrenominaExtras',$PrenominaDetalle>getidDetallePrenominaExtra());
     $save->bindValue('idPrenominaExtra',$PrenominaDetalle>getidPrenominaExtra());
     $save->bindValue('idEmpleado',$PrenominaDetalle>getidEmpleado());
     $save->bindValue('idExtraSucursal',$PrenominaDetalle>getidExtraSucursal());
     $save->bindValue('monto',$PrenominaDetalle>getMonto());
     $save->bindValue('cantiad',$PrenominaDetalle>getCantidad());
     $save->bindValue('comentarios',$PrenominaDetalle>getComentarios());
     $save->bindValue('idSituacionPrenomina',$PrenominaDetalle>getIdSituacionPrenomina());
     $save->bindValue('subtotal',$PrenominaDetalle>getsubtotal());
     $save->bindValue('ComentarioMatriz',$PrenominaDetalle>getComentarioMatriz());

     $save->execute();

  }//Cierre de metodo UwU
//-------------------------------------------------------------------------------------------------------------------_//

//---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
  public static function NombreEmpleado($idEmpleado)
  {
    $db=DataBase::getConnect();
    $nombre = $db->prepare('SELECT NombreEmpleado FROM empleados WHERE IdEmpleado = :idEmpleado');
    $nombre->bindValue('idEmpleado',$idEmpleado);
    $nombre->execute();
    $nombreDb= $nombre->fetch();

    $nomen = $nombreDb['NombreEmpleado'];

    return $nomen;

  }


  //--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
  public static function Empleados($idsucursal)
  {
      $db=DataBase::getConnect();
      $empleados = $db->prepare('SELECT idEmpleado FROM empleados WHERE IdSucursal = :id');
      $empleados->bindValue('IdSucursal',$idsucursal);
      $empleados->execute();

      $empleadosDb = $empleados->fetchAll();

      $emp[] = $empleadosDb['idEmpleado'];

      return $emp;

  }

    public static function allids()
    {
      $ListaId=[];
      $db=DataBase::getConnect();
      $empleado = $db->query('SELECT IdEmpleado, NombreEmpleado FROM empleados');
      foreach ($empleado->fetchAll() as $emp) {
        $ListaId[] = new EmpleadosModel($emp['IdEmpleado'],$emp['NombreEmpleado']);
      }
      return $ListaId;
    }




          public static function all()
          {
            $db=DataBase::getConnect();
            $ListaPreNominaDetalles=[];
            $select=$db->query('Select * From detalleprenominaextras');
            foreach ($select->fetchAll() as $PrenominaDetalle){
              $ListaPrenomina[] = new PreNominaDetallesModel($PrenominaDetalle['idDetallePrenominaExtras'],$PrenominaDetalle['idPrenominaExtra'],$PrenominaDetalle['idEmpleado'],$PrenominaDetalle['idExtraSucursal'],
              $PrenominaDetalle['monto'],$PrenominaDetalle['cantiad'],$PrenominaDetalle['comentarios'],$PrenominaDetalle['idSituacionPrenomina'],$PrenominaDetalle['ComentarioMatriz'],$PrenominaDetalle['subtotal']);

          }
          return $PrenominaDetalle;
        }
        //-----------
    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//




}
 ?>
