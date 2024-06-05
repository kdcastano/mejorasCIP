<?php
require_once('basedatos.php');

  class semanas extends basedatos {
    private $Sem_Codigo;
    private $Sem_Semana;
    private $Sem_FechaInicial;
    private $Sem_FechaFinal;
    private $Sem_FechaHoraCrea;
    private $Sem_UsuarioCrea;
    private $Sem_Estado;

  function __construct($Sem_Codigo = NULL, $Sem_Semana = NULL, $Sem_FechaInicial = NULL, $Sem_FechaFinal = NULL, $Sem_FechaHoraCrea = NULL, $Sem_UsuarioCrea = NULL, $Sem_Estado = NULL) {
    $this->Sem_Codigo = $Sem_Codigo;
    $this->Sem_Semana = $Sem_Semana;
    $this->Sem_FechaInicial = $Sem_FechaInicial;
    $this->Sem_FechaFinal = $Sem_FechaFinal;
    $this->Sem_FechaHoraCrea = $Sem_FechaHoraCrea;
    $this->Sem_UsuarioCrea = $Sem_UsuarioCrea;
    $this->Sem_Estado = $Sem_Estado;
    $this->tabla = "semanas";
  }

  function getSem_Codigo() {
    return $this->Sem_Codigo;
  }

  function getSem_Semana() {
    return $this->Sem_Semana;
  }

  function getSem_FechaInicial() {
    return $this->Sem_FechaInicial;
  }

  function getSem_FechaFinal() {
    return $this->Sem_FechaFinal;
  }

  function getSem_FechaHoraCrea() {
    return $this->Sem_FechaHoraCrea;
  }

  function getSem_UsuarioCrea() {
    return $this->Sem_UsuarioCrea;
  }

  function getSem_Estado() {
    return $this->Sem_Estado;
  }

  function setSem_Codigo($Sem_Codigo) {
    $this->Sem_Codigo = $Sem_Codigo;
  }

  function setSem_Semana($Sem_Semana) {
    $this->Sem_Semana = $Sem_Semana;
  }

  function setSem_FechaInicial($Sem_FechaInicial) {
    $this->Sem_FechaInicial = $Sem_FechaInicial;
  }

  function setSem_FechaFinal($Sem_FechaFinal) {
    $this->Sem_FechaFinal = $Sem_FechaFinal;
  }

  function setSem_FechaHoraCrea($Sem_FechaHoraCrea) {
    $this->Sem_FechaHoraCrea = $Sem_FechaHoraCrea;
  }

  function setSem_UsuarioCrea($Sem_UsuarioCrea) {
    $this->Sem_UsuarioCrea = $Sem_UsuarioCrea;
  }

  function setSem_Estado($Sem_Estado) {
    $this->Sem_Estado = $Sem_Estado;
  }

  public function insertar(){
    $campos = array("Sem_Semana", "Sem_FechaInicial", "Sem_FechaFinal", "Sem_FechaHoraCrea", "Sem_UsuarioCrea", "Sem_Estado");
    $valores = array(
    array(
      $this->Sem_Semana, 
      $this->Sem_FechaInicial, 
      $this->Sem_FechaFinal, 
      $this->Sem_FechaHoraCrea, 
      $this->Sem_UsuarioCrea, 
      $this->Sem_Estado
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
    $sql =  "SELECT * FROM semanas WHERE Sem_Codigo = :cod";
    $parametros = array(":cod"=>$this->Sem_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setSem_Semana($res[1]);
      $this->setSem_FechaInicial($res[2]);
      $this->setSem_FechaFinal($res[3]);
      $this->setSem_FechaHoraCrea($res[4]);
      $this->setSem_UsuarioCrea($res[5]);
      $this->setSem_Estado($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Sem_Semana", "Sem_FechaInicial", "Sem_FechaFinal", "Sem_FechaHoraCrea", "Sem_UsuarioCrea", "Sem_Estado");
    $valores = array($this->getSem_Semana(), $this->getSem_FechaInicial(), $this->getSem_FechaFinal(), $this->getSem_FechaHoraCrea(), $this->getSem_UsuarioCrea(), $this->getSem_Estado());
    $llaveprimaria = "Sem_Codigo";
    $valorllaveprimaria = $this->getSem_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM semanas WHERE Sem_Codigo = :cod";
    $parametros = array(":cod"=>$this->Sem_Codigo);
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
  public function hallarSemanaFecha($fecha){

    $parametros = array(":fec"=>$fecha);

    $sql = "SELECT Sem_Semana
    FROM semanas
    WHERE Sem_Estado = 1 AND :fec >= Sem_FechaInicial AND :fec <= Sem_FechaFinal
    LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
    
  /*
  Autor: Natalia Rodríguez
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function semanasListarPrincipal($estado){
		
    $parametros = array(":est"=>$estado);

    $sql = "SELECT Sem_Codigo, Sem_Semana, Sem_FechaInicial, Sem_FechaFinal, Sem_Estado
    FROM semanas 
    WHERE Sem_Estado = :est";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
    /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarSemanasFiltro(){

    $sql = "SELECT DISTINCT Sem_Semana
FROM semanas
WHERE Sem_Estado = 1
ORDER BY Sem_Semana ASC";

    $this->consultaSQL($sql);
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
  public function buscarSemanaFecha($fecha){

    $parametros = array(":fec"=>$fecha);

    $sql = "SELECT Sem_Semana, Sem_FechaInicial, Sem_FechaFinal
    FROM semanas
    WHERE Sem_FechaInicial = :fec AND Sem_Estado = '1'
    LIMIT 1";
    
//    if($_SESSION['CP_Usuario'] == "1"){
//    echo "---buscarsemanaFecha---"."<br>".$sql;
//    var_dump($parametros);
//    echo "<br>";
//  }

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>