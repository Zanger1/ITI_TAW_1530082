<?php
 class SituacionPrenominaExtraModel{

    private $idSituacionPrenominaExtra;
    private $DesSituacionPrenominaExtra;


    function __construct($idSituacionPrenominaExtra,$DesSituacionPrenominaExtra)
    {
      $this->setidSituacionPrenominaExtra($idSituacionPrenominaExtra);
      $this->setDesSituacionPrenominaExtra($DesSituacionPrenominaExtra);
    }


    public function getidSituacionPrenominaExtra()
    {
      return $this->idSituacionPrenominaExtra;
    }
    public function setidSituacionPrenominaExtra($idSituacionPrenominaExtra)
    {
      $this->DesSituacionPrenominaExtra = $idSituacionPrenominaExtra;
    }

    public function getDessituacionPrenominaExtra()
    {
      return $this->DesSituacionPrenominaExtra;
    }
    public function setDesSituacionPrenominaExtra($DesSituacionPrenominaExtra)
    {
      $this->DesSituacionPrenominaExtra = $DesSituacionPrenominaExtra;
    }


    public static function save($SituacionPrenominaExtra)
    {
      $db = DataBase::getConnect();


      $insert = $db->prepare('INSERT INTO situacionprenominaextra VALUES(NULL,:DesSituacionPrenominaExtra)');
      $insert->binValue('DesSituacionPrenominaExtra',$DesSituacionPrenominaExtra->getDessituacionPrenominaExtra());
      $insert->execute();
    }

 }


 ?>
