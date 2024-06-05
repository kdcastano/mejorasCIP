<?php
require_once('basedatos.php');

  class programa_produccion_observaciones extends basedatos {
    private $ProPO_Codigo;
    private $Are_Codigo;
    private $ProPO_Semana;
    private $ProPO_Observacion;
    private $ProPO_UsuarioCrea;
    private $ProPO_FechaHoraCrea;
    private $ProPO_Estado;

  function __construct($ProPO_Codigo = NULL, $Are_Codigo = NULL, $ProPO_Semana = NULL, $ProPO_Observacion = NULL, $ProPO_UsuarioCrea = NULL, $ProPO_FechaHoraCrea = NULL, $ProPO_Estado = NULL) {
    $this->ProPO_Codigo = $ProPO_Codigo;
    $this->Are_Codigo = $Are_Codigo;
    $this->ProPO_Semana = $ProPO_Semana;
    $this->ProPO_Observacion = $ProPO_Observacion;
    $this->ProPO_UsuarioCrea = $ProPO_UsuarioCrea;
    $this->ProPO_FechaHoraCrea = $ProPO_FechaHoraCrea;
    $this->ProPO_Estado = $ProPO_Estado;
    $this->tabla = "programa_produccion_observaciones";
  }

  function getProPO_Codigo() {
    return $this->ProPO_Codigo;
  }

  function getAre_Codigo() {
    return $this->Are_Codigo;
  }

  function getProPO_Semana() {
    return $this->ProPO_Semana;
  }

  function getProPO_Observacion() {
    return $this->ProPO_Observacion;
  }

  function getProPO_UsuarioCrea() {
    return $this->ProPO_UsuarioCrea;
  }

  function getProPO_FechaHoraCrea() {
    return $this->ProPO_FechaHoraCrea;
  }

  function getProPO_Estado() {
    return $this->ProPO_Estado;
  }

  function setProPO_Codigo($ProPO_Codigo) {
    $this->ProPO_Codigo = $ProPO_Codigo;
  }

  function setAre_Codigo($Are_Codigo) {
    $this->Are_Codigo = $Are_Codigo;
  }

  function setProPO_Semana($ProPO_Semana) {
    $this->ProPO_Semana = $ProPO_Semana;
  }

  function setProPO_Observacion($ProPO_Observacion) {
    $this->ProPO_Observacion = $ProPO_Observacion;
  }

  function setProPO_UsuarioCrea($ProPO_UsuarioCrea) {
    $this->ProPO_UsuarioCrea = $ProPO_UsuarioCrea;
  }

  function setProPO_FechaHoraCrea($ProPO_FechaHoraCrea) {
    $this->ProPO_FechaHoraCrea = $ProPO_FechaHoraCrea;
  }

  function setProPO_Estado($ProPO_Estado) {
    $this->ProPO_Estado = $ProPO_Estado;
  }

  public function insertar(){
    $campos = array("Are_Codigo", "ProPO_Semana", "ProPO_Observacion", "ProPO_UsuarioCrea", "ProPO_FechaHoraCrea", "ProPO_Estado");
    $valores = array(
    array(
      $this->Are_Codigo, 
      $this->ProPO_Semana, 
      $this->ProPO_Observacion, 
      $this->ProPO_UsuarioCrea, 
      $this->ProPO_FechaHoraCrea, 
      $this->ProPO_Estado
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
    $sql =  "SELECT * FROM programa_produccion_observaciones WHERE ProPO_Codigo = :cod";
    $parametros = array(":cod"=>$this->ProPO_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setAre_Codigo($res[1]);
      $this->setProPO_Semana($res[2]);
      $this->setProPO_Observacion($res[3]);
      $this->setProPO_UsuarioCrea($res[4]);
      $this->setProPO_FechaHoraCrea($res[5]);
      $this->setProPO_Estado($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Are_Codigo", "ProPO_Semana", "ProPO_Observacion", "ProPO_UsuarioCrea", "ProPO_FechaHoraCrea", "ProPO_Estado");
    $valores = array($this->getAre_Codigo(), $this->getProPO_Semana(), $this->getProPO_Observacion(), $this->getProPO_UsuarioCrea(), $this->getProPO_FechaHoraCrea(), $this->getProPO_Estado());
    $llaveprimaria = "ProPO_Codigo";
    $valorllaveprimaria = $this->getProPO_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM programa_produccion_observaciones WHERE ProPO_Codigo = :cod";
    $parametros = array(":cod"=>$this->ProPO_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
    
  
  /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarObservacionesPPReal($area, $semana, $planta){

    $parametros = array(":are"=>$area, ":sem"=>$semana);

    $sql = "SELECT ProPO_Codigo, ProPO_Observacion, CONCAT_WS(' ',Usu_Nombres,Usu_Apellidos) AS nombre, ProPO_UsuarioCrea, DATE(ProPO_FechaHoraCrea) AS fecha
    FROM programa_produccion_observaciones
    INNER JOIN usuarios ON programa_produccion_observaciones.ProPO_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE ProPO_Estado = 1 AND Are_Codigo = :are AND ProPO_Semana = :sem";
    
     if ( $planta != "" ) {
      $pri = 1;
      foreach ( $planta as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " Pla_Codigo = :pla" . $pri . " ";
        $parametros[ ':pla' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    } 
    
    $sql .= " ORDER BY ProPO_FechaHoraCrea DESC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
    /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarObservacionesPPRealSupervisor($area, $semana, $planta){

    $parametros = array(":are"=>$area, ":sem"=>$semana, ":pla"=>$planta);

    $sql = "SELECT ProPO_Codigo, ProPO_Observacion, CONCAT_WS(' ',Usu_Nombres,Usu_Apellidos) AS nombre, ProPO_UsuarioCrea, DATE(ProPO_FechaHoraCrea) AS fecha
    FROM programa_produccion_observaciones
    INNER JOIN usuarios ON programa_produccion_observaciones.ProPO_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE ProPO_Estado = 1 AND Are_Codigo = :are AND ProPO_Semana = :sem AND Pla_Codigo = :pla ORDER BY ProPO_FechaHoraCrea DESC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
