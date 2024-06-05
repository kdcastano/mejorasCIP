<?php
require_once('basedatos.php');

  class puestos_trabajos_estaciones_maquinas extends basedatos {
    private $PueTEM_Codigo;
    private $PueT_Codigo;
    private $EstM_Codigo;
    private $PueTEM_FechaHoraCrea;
    private $PueTEM_UsuarioCrea;
    private $PueTEM_Estado;

  function __construct($PueTEM_Codigo = NULL, $PueT_Codigo = NULL, $EstM_Codigo = NULL, $PueTEM_FechaHoraCrea = NULL, $PueTEM_UsuarioCrea = NULL, $PueTEM_Estado = NULL) {
    $this->PueTEM_Codigo = $PueTEM_Codigo;
    $this->PueT_Codigo = $PueT_Codigo;
    $this->EstM_Codigo = $EstM_Codigo;
    $this->PueTEM_FechaHoraCrea = $PueTEM_FechaHoraCrea;
    $this->PueTEM_UsuarioCrea = $PueTEM_UsuarioCrea;
    $this->PueTEM_Estado = $PueTEM_Estado;
    $this->tabla = "puestos_trabajos_estaciones_maquinas";
  }

  function getPueTEM_Codigo() {
    return $this->PueTEM_Codigo;
  }

  function getPueT_Codigo() {
    return $this->PueT_Codigo;
  }

  function getEstM_Codigo() {
    return $this->EstM_Codigo;
  }

  function getPueTEM_FechaHoraCrea() {
    return $this->PueTEM_FechaHoraCrea;
  }

  function getPueTEM_UsuarioCrea() {
    return $this->PueTEM_UsuarioCrea;
  }

  function getPueTEM_Estado() {
    return $this->PueTEM_Estado;
  }

  function setPueTEM_Codigo($PueTEM_Codigo) {
    $this->PueTEM_Codigo = $PueTEM_Codigo;
  }

  function setPueT_Codigo($PueT_Codigo) {
    $this->PueT_Codigo = $PueT_Codigo;
  }

  function setEstM_Codigo($EstM_Codigo) {
    $this->EstM_Codigo = $EstM_Codigo;
  }

  function setPueTEM_FechaHoraCrea($PueTEM_FechaHoraCrea) {
    $this->PueTEM_FechaHoraCrea = $PueTEM_FechaHoraCrea;
  }

  function setPueTEM_UsuarioCrea($PueTEM_UsuarioCrea) {
    $this->PueTEM_UsuarioCrea = $PueTEM_UsuarioCrea;
  }

  function setPueTEM_Estado($PueTEM_Estado) {
    $this->PueTEM_Estado = $PueTEM_Estado;
  }

  public function insertar(){
    $campos = array("PueT_Codigo", "EstM_Codigo", "PueTEM_FechaHoraCrea", "PueTEM_UsuarioCrea", "PueTEM_Estado");
    $valores = array(
    array(
      $this->PueT_Codigo, 
      $this->EstM_Codigo, 
      $this->PueTEM_FechaHoraCrea, 
      $this->PueTEM_UsuarioCrea, 
      $this->PueTEM_Estado
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
    $sql =  "SELECT * FROM puestos_trabajos_estaciones_maquinas WHERE PueTEM_Codigo = :cod";
    $parametros = array(":cod"=>$this->PueTEM_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPueT_Codigo($res[1]);
      $this->setEstM_Codigo($res[2]);
      $this->setPueTEM_FechaHoraCrea($res[3]);
      $this->setPueTEM_UsuarioCrea($res[4]);
      $this->setPueTEM_Estado($res[5]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("PueT_Codigo", "EstM_Codigo", "PueTEM_FechaHoraCrea", "PueTEM_UsuarioCrea", "PueTEM_Estado");
    $valores = array($this->getPueT_Codigo(), $this->getEstM_Codigo(), $this->getPueTEM_FechaHoraCrea(), $this->getPueTEM_UsuarioCrea(), $this->getPueTEM_Estado());
    $llaveprimaria = "PueTEM_Codigo";
    $valorllaveprimaria = $this->getPueTEM_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM puestos_trabajos_estaciones_maquinas WHERE PueTEM_Codigo = :cod";
    $parametros = array(":cod"=>$this->PueTEM_Codigo);
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
  public function listarPuestrosTrabajosEstacionesMaquinasAsignadas($estacion, $usuario, $puesto){

    $parametros = array(":est"=>$estacion, ":usu"=>$usuario, ":pue"=>$puesto);

    $sql = "SELECT puestos_trabajos_estaciones_maquinas.PueTEM_Codigo, puestos_trabajos.PueT_Codigo, Pla_Nombre, Are_Nombre, Maq_Nombre
	FROM puestos_trabajos_estaciones_maquinas
	INNER JOIN puestos_trabajos ON puestos_trabajos_estaciones_maquinas.PueT_Codigo = puestos_trabajos.PueT_Codigo 
	AND puestos_trabajos.PueT_Estado = 1
	INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo
	AND estaciones_maquinas.EstM_Estado = 1
	INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo
	AND maquinas.Maq_Estado = 1
	INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo
	AND areas.Are_Estado = 1
	INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo
	AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo
	AND plantas_usuarios.PlaU_Estado = 1
	WHERE EstM_Estado = 1 AND estaciones_maquinas.Est_Codigo = :est AND plantas_usuarios.Usu_Codigo = :usu AND puestos_trabajos.PueT_Codigo = :pue AND PueTEM_Estado = 1
	ORDER BY Maq_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>