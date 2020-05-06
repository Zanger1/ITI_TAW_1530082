<?php
class ExtrasMatrizModel
{

  private $IdExtra;
  private $NomExtra;
  private $MontoSugerido;
  private $Status;
  private $total;


  function __construct($IdExtra,$NomExtra,$MontoSugerido,$Status){
  $this->setIdExtra($IdExtra);
  $this->setNomExtra($NomExtra);
  $this->setMontoSugerido($MontoSugerido);
  $this->setStatus($Status);
  //$this->setTotal($total);

  }

  public function setTotal($total)
  {
    $this->total = $total;
  }
  public function setIdExtra($IdExtra)
  {
    $this->IdExtra = $IdExtra;
  }
  public function setNomExtra($NomExtra)
  {
    $this->NomExtra = $NomExtra;
  }
  public function setMontoSugerido($MontoSugerido)
  {
    $this->MontoSugerido = $MontoSugerido;
  }
  public function setStatus($Status)
  {
    $this->Status = $Status;
  }

  public function getIdExtra()
  {
    return $this->IdExtra;
  }
  public function getNomExtra()
  {
    return  $this->NomExtra;
  }
  public function getMontoSugerido(){
    return $this->MontoSugerido;
  }
  public function getStatus(){
    return $this->Status;
  }





  public static function get_total_all_records(){
    $db=DataBase::getConnect();
    //$select=$db->prepare('CALL get_clientes("")');
    $select=$db->prepare('SELECT * FROM extras');
    $select->execute();
    $result = $select->fetchAll();
    return $select->rowCount();
  }

//------------------------------------------------------------------------------------____//
  public static function ExtrasNomb(){
    $db=DataBase::getConnect();
    $listaNom=[];
    $select=$db->prepare('SELECT * FROM extras WHERE Status =  0');

    $select->execute();
    foreach ($select->fetchAll() as $nombres) {
      $listaNom[] = new ExtrasMatrizModel($nombres['IdExtra'],$nombres['NomExtra'],$nombres['MontoSugerido'],$nombres['Status']);
    }

    return $listaNom;
  }

//------------------------------------------------------------------------------------------------------

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
#   $filtro_busqueda=$_POST["search"]["value"]; //El $filtro de busqueda es el valor que el usuario escriba en el input. ref[1]
    $query = "select * from extras where Status = 0";
    $statement = $db->prepare($query);
#   $statement->bindValue(':busqueda', $filtro_busqueda); //Al param :busqueda se le asigna el $filtro_busqueda. ref[1],
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();
    $data = array();
    $filtered_rows = $statement->rowCount();
    foreach($result as $row){
      $direccion = 'a';
      //if($row["estatus"]=='1'){ $situacion = 'ACTIVO'; } else { $situacion = 'INACTIVO'; }
      $image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
      $sub_array = array();
      $sub_array[] = $row["IdExtra"];
      $sub_array[] = $row["NomExtra"];
      $sub_array[] = "$".$row["MontoSugerido"];
      $sub_array[] = "        "; //$row["Status"];//CRolesModel::getOnlyName($row["IdRol"]);

          if(isset($_SESSION["id_role"])){
            $id_role = $_SESSION["id_role"];
            if($id_role == '3'){ //Solo para auxiliares
                $sub_array[] = '<button type="button" name="view" id="'.$row["IdExtra"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdExtra"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';
            } else {  //Administradores: General y de sucursal
                $sub_array[] = '<button type="button" name="view" id="'.$row["IdExtra"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["IdExtra"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> <button type="button" name="delete" id="'.$row["IdExtra"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>';
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

    function utf8ize($d) {  //Me ayuda con los tildes/acentos
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


    public static function searchById($id){
    $db=DataBase::getConnect();
    //$select=$db->prepare('CALL get_cliente_id(:id)');
    $select=$db->prepare('SELECT * FROM extras WHERE idExtra = :id AND Status = 0');
    $select->bindValue('id',$id);
    $select->execute();
    $extrasDb=$select->fetch();
    $extras = new ExtrasMatrizModel ($extrasDb['IdExtra'],$extrasDb['NomExtra'],$extrasDb['MontoSugerido'],$extrasDb['Status']);
    //var_dump($alumno);
    //die();
    return $extras;
  }




//metodo para actualizar XD

    public static function update($extras){
    $db=DataBase::getConnect();
    $update=$db->prepare('UPDATE extras SET NomExtra=:NomExtra, MontoSugerido=:MontoSugerido, Status=:Status WHERE IdExtra = :IdExtra');

      #$update=$db->prepare('CALL edit_clientes(:IdCliente,:Nombre,:RFC,:Calle,:Colonia,:CodigoPostal,:Num,:IdCiudad,:CorreoElectronico,:Telefono)');

      $update->bindValue('IdExtra',$extras->getIdExtra());
      $update->bindValue('NomExtra',$extras->getNomExtra());
      $update->bindValue('MontoSugerido',$extras->getMontoSugerido());
      $update->bindValue('Status',$extras->getStatus());

      $update->execute();

  }
//Metodo para eliminar
  public static function delete($idExtra)
  {
    $db=DataBase::getConnect();
    $delete=$db->prepare('UPDATE  extras SET Status = 1 WHERE idExtra = :idExtra');
    $delete->bindValue('idExtra',$idExtra);
    $delete->execute();
  }

  //----------------------------------------------------------
  //Agregar inserción de Datos, Por Proceso Almacenado PApu XD
  public static function save($NomExtra,$MontoSugerido){
   $db=DataBase::getConnect();
    $insert=$db->prepare('CALL PROC_ADD_EXTRAS(:NomExtra,:MontoSugerido)');

    $insert->bindValue('NomExtra',$NomExtra);
    $insert->bindValue('MontoSugerido',$MontoSugerido);


    $insert->execute();


  }

}//Cierre de clase
?>
