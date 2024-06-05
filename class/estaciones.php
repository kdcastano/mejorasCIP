<?php
require_once('basedatos.php');

  class estaciones extends basedatos {
    private $Est_Codigo;
    private $Pla_Codigo;
    private $Est_Nombre;
    private $Est_FechaHoraCrea;
    private $Est_UsuarioCrea;
    private $Est_Estado;

  function __construct($Est_Codigo = NULL, $Pla_Codigo = NULL, $Est_Nombre = NULL, $Est_FechaHoraCrea = NULL, $Est_UsuarioCrea = NULL, $Est_Estado = NULL) {
    $this->Est_Codigo = $Est_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Est_Nombre = $Est_Nombre;
    $this->Est_FechaHoraCrea = $Est_FechaHoraCrea;
    $this->Est_UsuarioCrea = $Est_UsuarioCrea;
    $this->Est_Estado = $Est_Estado;
    $this->tabla = "estaciones";
  }

  function getEst_Codigo() {
    return $this->Est_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getEst_Nombre() {
    return $this->Est_Nombre;
  }

  function getEst_FechaHoraCrea() {
    return $this->Est_FechaHoraCrea;
  }

  function getEst_UsuarioCrea() {
    return $this->Est_UsuarioCrea;
  }

  function getEst_Estado() {
    return $this->Est_Estado;
  }

  function setEst_Codigo($Est_Codigo) {
    $this->Est_Codigo = $Est_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setEst_Nombre($Est_Nombre) {
    $this->Est_Nombre = $Est_Nombre;
  }

  function setEst_FechaHoraCrea($Est_FechaHoraCrea) {
    $this->Est_FechaHoraCrea = $Est_FechaHoraCrea;
  }

  function setEst_UsuarioCrea($Est_UsuarioCrea) {
    $this->Est_UsuarioCrea = $Est_UsuarioCrea;
  }

  function setEst_Estado($Est_Estado) {
    $this->Est_Estado = $Est_Estado;
  }

  public function insertar(){
    $campos = array( "Pla_Codigo", "Est_Nombre", "Est_FechaHoraCrea", "Est_UsuarioCrea", "Est_Estado");
    $valores = array(
    array(
      $this->Pla_Codigo, 
      $this->Est_Nombre, 
      $this->Est_FechaHoraCrea, 
      $this->Est_UsuarioCrea, 
      $this->Est_Estado
      )
    );

    $resultado = $this->insertarRegistros($campos, $valores);
    $this->desconectar();

    if($resultado[0] == "OK"){
      return true;
    }else{
      return false;
    }
  }

  public function consultar(){
    $sql =  "SELECT * FROM estaciones WHERE Est_Codigo = :cod";
    $parametros = array(":cod"=>$this->Est_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setEst_Nombre($res[2]);
      $this->setEst_FechaHoraCrea($res[3]);
      $this->setEst_UsuarioCrea($res[4]);
      $this->setEst_Estado($res[5]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "Est_Nombre", "Est_FechaHoraCrea", "Est_UsuarioCrea", "Est_Estado");
    $valores = array($this->getPla_Codigo(), $this->getEst_Nombre(), $this->getEst_FechaHoraCrea(), $this->getEst_UsuarioCrea(), $this->getEst_Estado());
    $llaveprimaria = "Est_Codigo";
    $valorllaveprimaria = $this->getEst_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM estaciones WHERE Est_Codigo = :cod";
    $parametros = array(":cod"=>$this->Est_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
    
    /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarEstacionesPrinpal($planta, $estado, $usuario){

    $parametros = array(":usu"=>$usuario, ":est"=>$estado);

    $sql = "SELECT Est_Codigo, Pla_Nombre, Est_Nombre,
(SELECT COUNT(PueT_Codigo) FROM puestos_trabajos
INNER JOIN estaciones_areas ON estaciones_areas.EstA_Codigo = puestos_trabajos.EstA_Codigo AND EstA_Estado = 1
WHERE estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND PueT_Estado = 1) AS Ptra, Est_Estado
	FROM estaciones
	INNER JOIN plantas ON estaciones.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE Est_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu ";
    
    if($planta != ""){ 
      $pri = 1; 
      foreach($planta as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " plantas.Pla_Codigo = :pla".$pri." "; 
        $parametros[':pla'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY Pla_Nombre ASC, Est_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>