<?php
  class PreNominaExtraModel {

    private $idPrenominaExtra;
    private $idSucursal;
    private $NoSemana;
    private $FechaInicio;
    private $FechaTermino;
    private $ComentarioGeneral;
    private $idSituacionPrenominaExtra;
    private $idEmpleadoCaptura;
    private $FechaCaptura;




    function __construct($idPrenominaExtra,$idSucursal,$NoSemana,$FechaInicio,$FechaTermino,
    $ComentarioGeneral,$idSituacionPrenominaExtra,$idEmpleadoCaptura,$FechaCaptura)    {
     $this->setidPrenominaExtra($idPrenominaExtra);
     $this->setidSucursal($idSucursal);
     $this->setNoSemana($NoSemana);
     $this->setFechaInicio($FechaInicio);
     $this->setFecaTermino($FechaTermino);
     $this->setComentarioGeneral($ComentarioGeneral);
     $this->setidSituacionPrenominaExtra($idSituacionPrenominaExtra);
     $this->setidEmpleadoCaptura($idEmpleadoCaptura);
     $this->setFechaCaptura($FechaCaptura);
    }


//--------------------------------------------------------------//
    public function getidPrenominaExtra()
    {
      return $this->idPrenominaExtra;
    }
//--------------------------------------------------------------//
    public function setidPrenominaExtra($idPrenominaExtra)
    {
      $this->idPrenominaExtra = $idPrenominaExtra;
    }
//--------------------------------------------------------------//
    public function getidSucursal()
    {
      return $this->idSucursal;
    }
    public function setidSucursal($idSucursal)
    {
      $this->idSucursal = $idSucursal;
    }
//--------------------------------------------------------------//
    public function getNoSemana()
    {
      return $this->NoSemana;
    }

    public function setNoSemana($NoSemana)
    {
      $this->NoSemana = $NoSemana;
    }
//--------------------------------------------------------------//
    public function getFechaInicio()
    {
      return $this->FechaInicio;
    }

    public function setFechaInicio($FechaInicio)
    {
      $this->FechaInicio = $FechaInicio;
    }
//--------------------------------------------------------------//
    public function getFechaTermino()
    {
      return $this->FechaTermino;
    }
//--------------------------------------------------------------//
    public function setFecaTermino($FechaTermino)
    {
      $this->FechaTermino = $FechaTermino;
    }
//--------------------------------------------------------------//
    public function getComentarioGeneral(){
        return $this->ComentarioGeneral;
    }
    public function setComentarioGeneral($ComentarioGeneral)
    {
      $this->ComentarioGeneral = $ComentarioGeneral;
    }
//--------------------------------------------------------------//
    public function getidSituacionPrenominaExtra()
    {
      return $this->idSituacionPrenominaExtra;
    }
    public function setidSituacionPrenominaExtra($idSituacionPrenominaExtra)
    {
      $this->idSituacionPrenominaExtra = $idSituacionPrenominaExtra;
    }
//--------------------------------------------------------------//
    public function getidEmpleadoCaptura()
    {
      return $this->idEmpleadoCaptura;
    }

    public function setidEmpleadoCaptura($idEmpleadoCaptura)
    {
      $this->idEmpleadoCaptura = $idEmpleadoCaptura;
    }
//--------------------------------------------------------------//
    public function getFechaCaptura()
    {
      return  $this->FechaCaptura;
    }

    public function setFechaCaptura($FechaCaptura)
    {
      $this->FechaCaptura = $FechaCaptura;
    }

  //------------------------------------------------------------------------------------------------------------------//
  public static function all(){
  		$db=DataBase::getConnect();
  		$ListaPrenomina=[];
  		$select=$db->query('select* from prenominaextra');
  		foreach($select->fetchAll() as $Nomina){$ListaPrenomina[]=new PreNominaExtraModel($Nomina['idPrenominaExtraPrimaria'],$Nomina[' idSucursalÍndice '],$Nomina['NoSemana'],$Nomina['FechaInicio'],$Nomina['FechaTermino'],
  			$Nomina['ComentarioGenral'],$Nomina['idSituacionPrenominaExtra'],$Nomina['idEmpleadoCaptura'], $Nomina['FechaCaptura']);
  		}
  		return $ListaPrenomina;
  	}
    //------------------------------------------------------------------------------------------------------------------//
    public static function get_total_all_records(){
  		$db=DataBase::getConnect();
  		$select=$db->query('select * from prenominaextra');
  		$select->execute();
  		$result = $select->fetchAll();
  		return $select->rowCount();
  	}
    //------------------------------------------------------------------------------------------------------------------//
    public static function searchById($id){
      $db=DataBase::getConnect();
      $select=$db->prepare('SELECT * FROM prenominaextra  WHERE idPrenominaExtra = :id');
      $select->bindValue('id',$id);
      $select->execute();
      $NominaDb=$select->fetch();
      $Nomina = new PreNominaExtraModel($NominaDb['idPrenominaExtra'],$NominaDb['idSucursal'],$NominaDb['NoSemana'],$NominaDb['FechaInicio'],$NominaDb['FechaTermino'],$NominaDb['ComentarioGenral'],$NominaDb['idSituacionPrenominaExtra'],$NominaDb['idEmpleadoCaptura'], $NominaDb['FechaCaptura']);

      return $Nomina;
    }
//----------------------------------------------------------------------------------------------------------------------_//
//Metodo para saber la fecha de hoy xd






//------------------------------------------------------------------------------------------------------------------//
public static function all_json(){

		//Acortar texto
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
		$query = "select * from prenominaextra";
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
			$sub_array[] = $row["idSucursal"];
			$sub_array[] = $row["NoSemana"];//CRolesModel::getOnlyName($row["IdRol"]);
			$sub_array[] = $row["FechaInicio"];
			$sub_array[] = $row["FechaTermino"];
			$sub_array[] = $row["ComentarioGenral"];
			 if ($row["idSituacionPrenominaExtra"] == 0)
      {
      $sub_array[] = "Aceptada";
      }
      else if ($row["idSituacionPrenominaExtra"] == 1)
      {
        $sub_array[] = "Rechazada";
      }
      else {
        $sub_array[] = "Propuesta";
      }
			$sub_array[] = $row["idEmpleadoCaptura"];
			$sub_array[] = $row["FechaCaptura"];


			//$sub_array[] = shorter($row['Calle'], 10);//SucursalesModel::getOnlyName($row["IdSucursal"]);
					if(isset($_SESSION["id_role"])){
						$id_role = $_SESSION["id_role"];
						if($id_role == '3'){ //Solo para auxiliares
								$sub_array[] = '<button type="button" name="view" id="'.$row["idPrenominaExtra"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["idPrenominaExtra"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';
						} else {	//Administradores: General y de sucursal
								$sub_array[] = '<button type="button" name="view" id="'.$row["idPrenominaExtra"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["idPrenominaExtra"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["idPrenominaExtra"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
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
  //------------------------------------------------------------------------------------------------------------------//
   public static function update($preNominaExtra)
   {
     $db=DataBase::getConnect();

     $update = $db->prepare('UPDATE detalleprenominaextras (idPrenominaExtra, idSucursal, NoSemana, FechaInicio, FechaTermino, ComentarioGenral, idSituacionPrenominaExtra, idEmpleadoCaptura, FechaCaptura, ComentarioMatriz, Total) SET (idPrenominaExtra = :idPrenominaExtra, idSucursal = :idSucursal , NoSemana = :NoSemana, FechaInicio = :FechaInicio, FechaTermino = :FechaTermino, ComentarioGenral = :ComentarioGenral, idSituacionPrenominaExtra = :idSituacionPrenominaExtra, idEmpleadoCaptura = :idEmpleadoCaptura, FechaCaptura = :FechaCaptura, ComentarioMatriz = :ComentarioMatriz, Total = :Total)  ');

    $update->bindValue('idPrenominaExtra',$idPrenominaExtra->getidPrenominaExtra());
    $update->bindValue('idEmpleado',$idEmpleado->getidEmpleado());
    $update->bindValue('idExtraSucursal',$idExtraSucursal->getidExtraSucursal());
    $update->bindValue('monto',$monto->getmonto());
    $update->binValue('cantiad',$cantidad->getCantidad());
    $update->binValue('comentarios',$comentarios->getComentarios());
    $update->binValue('idSituacionPrenomina',$idSituacionPrenomina->getIdSituacionPrenomina());

    $update->execute();
   }

   public static function save($preNominaExtra)
   {
   $db=DataBase::getConnect();

   $save = $db->prepare('INSERT INTO prenominaextra(idPrenominaExtra, idSucursal, NoSemana, FechaInicio, FechaTermino, ComentarioGenral, idSituacionPrenominaExtra, idEmpleadoCaptura, FechaCaptura, ComentarioMatriz, Total) VALUES (:idPrenominaExtra, :idSucursal, :NoSemana, :FechaInicio, :FechaTermino, :ComentarioGenral, :idSituacionPrenominaExtra, :idEmpleadoCaptura, :FechaCaptura, :ComentarioMatriz, :Total) ');
   $save->bindValue('idPrenominaExtra',$preNominaExtra->getidPrenominaExtra());
   $save->bindValue('idSucursal',$preNominaExtra->getidSucursal());
   $save->bindValue('NoSemana',$preNominaExtra->NoSemana());
   $save->bindValue('FechaInicio',$preNominaExtra->getFechaInicio());
   $save->bindValue('FechaTermino',$preNominaExtra->getFechaTermino());
   $save->bindValue('ComentarioGenral',$preNominaExtra->getComentarioGeneral());
   $save->bindValue('idSituacionPrenominaExtra',$preNominaExtra->getidSituacionPrenominaExtra());
   $save->bindValue('idEmpleadoCaptura',$preNominaExtra->idEmpleadoCaptura());
   $save->bindValue('FechaCaptura',$preNominaExtra->getFechaCaptura());
   $save->bindValue('ComentarioMatriz',$preNominaExtra->getComentariosMatriz());
   $save->bindValue('Total',$preNominaExtra->getTotal());

   $save->execute();


  }
}//Cierre de clase
  //------------------------------------------------------------------------------------------------------------------//


 ?>
