<?php
class ExtrasSucursalModel{

    private $idExtraSucursal;
    private $idExtra;
    private $idSucursal;
    private $MontoSugerido;
    private $Status;
    private $NomExtra;

    function __construct($idExtraSucursal,$idExtra,$idSucursal,$MontoSugerido,$Status, $NomExtra)
    {
       $this->setidExtraSucursal($idExtraSucursal);
       $this->setIdExtra($idExtra);
       $this->setidSucursal($idSucursal);
       $this->setMontoSugerido($MontoSugerido);
       $this->setStatus($Status);
       $this->setNomExtra($NomExtra); 
    }

    //--------------------------------------------------------------//
    public function getidExtraSucursal()
    {
      return $this->idExtraSucursal;
    }
    public function setidExtraSucursal($idExtraSucursal)
    {
      $this->idExtraSucursal = $idExtraSucursal;
    }

    //--------------------------------------------------------------//
    public function getIdExtra()
    {
      return $this->idExtra;
    }

    public function setIdExtra($idExtra)
    {
      $this->idExtra = $idExtra;
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
    public function getMontoSugerido()
    {
      return $this->MontoSugerido;
    }
    public function setMontoSugerido($MontoSugerido){
       $this->MontoSugerido = $MontoSugerido;
    }
    //--------------------------------------------------------------//
    public function getStatus(){
      return $this->Status;
    }
    public function setStatus($Status)
    {
      $this->Status = $Status;
    }

   public function getNomExtra(){
      return $this->NomExtra;
    }
    public function setNomExtra($NomExtra)
    {
      $this->NomExtra = $NomExtra;
    }

    //--------------------------------------------------------------//

    //-----------------------------------------------------------------------------------------------------------------
    public static function get_total_all_records(){
      $db=DataBase::getConnect();
      //$select=$db->prepare('CALL get_clientes("")');
      $select=$db->prepare('SELECT * FROM extrasucursal where Status = 0');
      $select->execute();
      $result = $select->fetchAll();
      return $select->rowCount();
    }
//--------------------------------------------------------------------------------------------------------------------------------------
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
       /* $query = "SELECT e.NomExtra, s.Nombre , es.MontoSugerido, es.Status, es.idExtraSucursal, es.idSucursal FROM extrasucursal es INNER JOIN extras e on e.IdExtra = es.idExtra inner JOIN sucursales s on es.idSucursal = s.IdSucursal  WHERE es.Status = 0"; */
      $statement = $db->prepare("SELECT e.NomExtra, s.Nombre , es.MontoSugerido, es.Status, es.idExtraSucursal, es.idSucursal FROM extrasucursal es INNER JOIN extras e on e.IdExtra = es.idExtra inner JOIN sucursales s on es.idSucursal = s.IdSucursal  WHERE es.Status = 0 AND es.idSucursal = :idSuc");
  #   $statement->bindValue(':busqueda', $filtro_busqueda); //Al param :busqueda se le asigna el $filtro_busqueda. ref[1],
      $statement->bindValue("idSuc",$_SESSION['id_sucursal']);
      $statement->execute();
      $result = $statement->fetchAll();
      $statement->closeCursor();
      $data = array();
      $filtered_rows = $statement->rowCount();
      ////////////////////////////////////
      foreach($result as $row){
        $direccion = 'a';
        //if($row["estatus"]=='1'){ $situacion = 'ACTIVO'; } else { $situacion = 'INACTIVO'; }
        $image = ''; #if($row["image"] != ''){ $image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />'; }  else { $image = ''; }
        $sub_array = array();
        $sub_array[] = $row["idExtraSucursal"];
        $sub_array[] = $row["NomExtra"];
        $sub_array[] = $row["Nombre"];
        $sub_array[] = "$" .$row["MontoSugerido"];


            if(isset($_SESSION["id_role"])){
              $id_role = $_SESSION["id_role"];
              if($id_role == '3'){ //Solo para auxiliares
                  $sub_array[] = '<button type="button" name="view" id="'.$row["idExtraSucursal"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["idExtraSucursal"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> ';
              } else {  //Administradores: General y de sucursal
                  $sub_array[] = '<button type="button" name="view" id="'.$row["idExtraSucursal"].'" class="btn btn-success btn-sm view" data-toggle="tooltip" data-placement="top" title="Ver"><i class="fa fa-eye"></i></button> <button type="button" name="update" id="'.$row["idExtraSucursal"].'" class="btn btn-info btn-sm update" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></button> 
                   ';
                   /* Boton Eliminar
                   button type="button" name="delete" id="'.$row["idExtraSucursal"].'" class="btn btn-danger btn-sm delete" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>


                   */
              }
            }
      //    $sub_array[] = $row["Status"];//CRolesModel::getOnlyName($row["IdRol"]);

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
      //$select=$db->prepare('SELECT * FROM extrasucursal WHERE idExtraSucursal = :id');
      $select=$db->prepare('SELECT es.*,e.* FROM extrasucursal es INNER JOIN extras e ON e.IdExtra = es.idExtra WHERE idExtraSucursal = :id');
      $select->bindValue('id',$id);
      $select->execute();
      $extrasDb=$select->fetch();
      $extras = new ExtrasSucursalModel ($extrasDb['idExtraSucursal'],
        $extrasDb['idExtra'],
        $extrasDb['idSucursal'],
        $extrasDb['MontoSugerido'],
        $extrasDb['Status'],
        $extrasDb['NomExtra']
      );
      //$idExtraSucursal,$idExtra,$idSucursal,$MontoSugerido,$Status//var_dump($alumno);
      //die();
      return $extras;
    }
     //_-------------------------------------------------------------------------------------------------------//

         public static function update($extrasSucursal){
         $db=DataBase::getConnect();
         $update=$db->prepare('UPDATE extrasucursal SET MontoSugerido = :MontoSugerido,Status = :Status WHERE idExtraSucursal = :IdExtra ');  //AND idSucursal = :idSucursal

           #$update=$db->prepare('CALL edit_clientes(:IdCliente,:Nombre,:RFC,:Calle,:Colonia,:CodigoPostal,:Num,:IdCiudad,:CorreoElectronico,:Telefono)');

           $update->bindValue('IdExtra',$extrasSucursal->getidExtraSucursal());
           $update->bindValue('MontoSugerido',$extrasSucursal->getMontoSugerido());
           $update->bindValue('Status',$extrasSucursal->getStatus());
           #$update->bindValue('idSucursal',$extrasSucursal->getidSucursal());

           $update->execute();

       }

       public static function delete($extrasSucursal,$idSucursal)
       {
         $db=DataBase::getConnect();
         $delete=$db->prepare('UPDATE  extrasucursal SET Status = 1 WHERE  idExtraSucursal = :idExtraSucursal AND idSucursal = :idSucursal');


         $delete->bindValue('idExtraSucursal',$extrasSucursal);
         $delete->bindValue('idSucursal',$idSucursal);
         $delete->execute();
       }

//--------------------------------------------------------------------------------------------------------------------------------------------------------//
  //----------------------------------------------------------------------------------------------------------------------------------------------------//
       public static function save($extrasSucursal)
       {
         $db=DataBase::getConnect();
         $save=$db->prepare('INSERT INTO extrasucursal(idExtraSucursal,idExtra,idSucursal,MontoSugerido,Status) VALUES (NULL,:idExtra,:idSucursal,:MontoSugerido,:Status)');


         $save->bindValue('idExtra',$extrasSucursal->getIdExtra());
         $save->bindValue('idSucursal',$extrasSucursal->getidSucursal());
         $save->bindValue('MontoSugerido',$extrasSucursal->getMontoSugerido());
         $save->bindValue('Status',0);
         $save->execute();
       }

       //_------------------------------------------------------------------------------------------
       public static function ExtrasNomb($idSucursal){
         $db=DataBase::getConnect();
         $listaNom=[];
         
         //$select=$db->prepare('SELECT * FROM extrasucursal WHERE Status =  0 AND idSucursal = :idsuc ');
          $select=$db->prepare('SELECT es.*, e.NomExtra FROM extrasucursal es INNER JOIN extras e ON es.idExtra = e.IdExtra WHERE es.Status =  0 AND es.idSucursal = :idsuc');
         $select->bindValue('idsuc',$idSucursal);
         $select->execute();
         foreach ($select->fetchAll() as $nombres) {
           $listaNom[] = new ExtrasSucursalModel($nombres['idExtraSucursal'],
            $nombres['idExtra'],
            $nombres['idSucursal'],
            $nombres['MontoSugerido'],
            $nombres['Status'],
            $nombres['NomExtra']);
         }
         return $listaNom;
       }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      


}//Cierre de clase
 ?>
