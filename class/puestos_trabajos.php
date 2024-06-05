<?php
require_once('basedatos.php');

  class puestos_trabajos extends basedatos {
    private $PueT_Codigo;
    private $EstA_Codigo;
    private $PueT_Nombre;
    private $PueT_FechaHoraCrea;
    private $PueT_UsuarioCrea;
    private $PueT_Estado;

  function __construct($PueT_Codigo = NULL, $EstA_Codigo = NULL, $PueT_Nombre = NULL, $PueT_FechaHoraCrea = NULL, $PueT_UsuarioCrea = NULL, $PueT_Estado = NULL) {
    $this->PueT_Codigo = $PueT_Codigo;
    $this->EstA_Codigo = $EstA_Codigo;
    $this->PueT_Nombre = $PueT_Nombre;
    $this->PueT_FechaHoraCrea = $PueT_FechaHoraCrea;
    $this->PueT_UsuarioCrea = $PueT_UsuarioCrea;
    $this->PueT_Estado = $PueT_Estado;
    $this->tabla = "puestos_trabajos";
  }

  function getPueT_Codigo() {
    return $this->PueT_Codigo;
  }

  function getEstA_Codigo() {
    return $this->EstA_Codigo;
  }

  function getPueT_Nombre() {
    return $this->PueT_Nombre;
  }

  function getPueT_FechaHoraCrea() {
    return $this->PueT_FechaHoraCrea;
  }

  function getPueT_UsuarioCrea() {
    return $this->PueT_UsuarioCrea;
  }

  function getPueT_Estado() {
    return $this->PueT_Estado;
  }

  function setPueT_Codigo($PueT_Codigo) {
    $this->PueT_Codigo = $PueT_Codigo;
  }

  function setEstA_Codigo($EstA_Codigo) {
    $this->EstA_Codigo = $EstA_Codigo;
  }

  function setPueT_Nombre($PueT_Nombre) {
    $this->PueT_Nombre = $PueT_Nombre;
  }

  function setPueT_FechaHoraCrea($PueT_FechaHoraCrea) {
    $this->PueT_FechaHoraCrea = $PueT_FechaHoraCrea;
  }

  function setPueT_UsuarioCrea($PueT_UsuarioCrea) {
    $this->PueT_UsuarioCrea = $PueT_UsuarioCrea;
  }

  function setPueT_Estado($PueT_Estado) {
    $this->PueT_Estado = $PueT_Estado;
  }

  public function insertar(){
    $campos = array("EstA_Codigo", "PueT_Nombre", "PueT_FechaHoraCrea", "PueT_UsuarioCrea", "PueT_Estado");
    $valores = array(
    array( 
      $this->EstA_Codigo, 
      $this->PueT_Nombre, 
      $this->PueT_FechaHoraCrea, 
      $this->PueT_UsuarioCrea, 
      $this->PueT_Estado
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
    $sql =  "SELECT * FROM puestos_trabajos WHERE PueT_Codigo = :cod";
    $parametros = array(":cod"=>$this->PueT_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setEstA_Codigo($res[1]);
      $this->setPueT_Nombre($res[2]);
      $this->setPueT_FechaHoraCrea($res[3]);
      $this->setPueT_UsuarioCrea($res[4]);
      $this->setPueT_Estado($res[5]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("EstA_Codigo", "PueT_Nombre", "PueT_FechaHoraCrea", "PueT_UsuarioCrea", "PueT_Estado");
    $valores = array($this->getEstA_Codigo(), $this->getPueT_Nombre(), $this->getPueT_FechaHoraCrea(), $this->getPueT_UsuarioCrea(), $this->getPueT_Estado());
    $llaveprimaria = "PueT_Codigo";
    $valorllaveprimaria = $this->getPueT_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM puestos_trabajos WHERE PueT_Codigo = :cod";
    $parametros = array(":cod"=>$this->PueT_Codigo);
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
  public function listarEstacionesPuestosTrabajo($estacion, $usuario){

    $parametros = array(":est"=>$estacion, ":usu"=>$usuario);

    $sql = "SELECT PueT_Codigo, PueT_Nombre
FROM puestos_trabajos
INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND estaciones_areas.EstA_Estado = 1
INNER JOIN estaciones ON estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND estaciones.Est_Estado = 1
INNER JOIN plantas ON estaciones.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
WHERE PueT_Estado = 1 AND estaciones_areas.Est_Codigo = :est AND plantas_usuarios.Usu_Codigo = :usu
ORDER BY PueT_Nombre ASC";

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
  public function estacionesUsuariosPuestosTrabajosInicio($tipo, $usuario){

    $parametros = array(":tip"=>$tipo, ":usu"=>$usuario);

    $sql = "SELECT PueT_Codigo, estaciones.Est_Codigo, areas.Are_Codigo, Est_Nombre, PueT_Nombre
FROM puestos_trabajos
INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND EstA_Estado = 1
INNER JOIN areas ON estaciones_areas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
INNER JOIN estaciones ON estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND estaciones.Est_Estado = 1
INNER JOIN plantas ON estaciones.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
WHERE PueT_Estado = 1 AND areas.Are_Tipo = :tip AND plantas_usuarios.Usu_Codigo = :usu
ORDER BY PueT_Nombre ASC";

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
  public function estacionesUsuariosPuestosTrabajosInicioEjeCum($tipo, $usuario, $planta){

    $parametros = array(":tip"=>$tipo, ":usu"=>$usuario, ":pla"=>$planta);

    $sql = "SELECT PueT_Codigo, estaciones.Est_Codigo, areas.Are_Codigo, Est_Nombre, PueT_Nombre
FROM puestos_trabajos
INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND EstA_Estado = 1
INNER JOIN areas ON estaciones_areas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
INNER JOIN estaciones ON estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND estaciones.Est_Estado = 1
INNER JOIN plantas ON estaciones.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
WHERE PueT_Estado = 1 AND areas.Are_Tipo = :tip AND plantas_usuarios.Usu_Codigo = :usu AND plantas.Pla_Codigo = :pla
ORDER BY PueT_Nombre ASC";

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
  public function estacionesUsuariosPuestosTrabajosInicioYaExiste($usuario, $fecha, $turno){

    $parametros = array(":usu"=>$usuario, ":fec"=>$fecha, ":tur"=>$turno);

    $sql = "SELECT PueT_Codigo
FROM estaciones_usuarios
WHERE EstU_Estado = 1 AND EstU_Fecha = :fec AND Usu_Codigo = :usu AND Tur_Codigo = :tur";

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
  public function listarPuestosTrabajo(){

    $sql = "SELECT PueT_Codigo, puestos_trabajos.EstA_Codigo, PueT_Nombre
    FROM puestos_trabajos
    INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND estaciones_areas.EstA_Estado = 1
    INNER JOIN estaciones ON estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND Est_Estado = 1
    WHERE PueT_Estado = 1
    ORDER BY PueT_Nombre ASC";

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
  public function listarPuestosTrabajoFiltros($usuario){
    
    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT PueT_Codigo, PueT_Nombre
    FROM puestos_trabajos p
    INNER JOIN estaciones_areas ON p.EstA_Codigo = estaciones_areas.EstA_Codigo AND estaciones_areas.EstA_Estado = 1
    INNER JOIN estaciones ON estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND Est_Estado = 1
    LEFT JOIN areas a ON estaciones_areas.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1
    LEFT JOIN usuarios u ON a.Pla_Codigo = u.Pla_Codigo AND u.Usu_Estado = 1
    WHERE PueT_Estado = 1 AND u.Usu_Codigo = :usu 
    ORDER BY PueT_Nombre ASC";

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
  public function listarPuestosTrabajoHCAgrupacion($usuario,$agrupacion){
    
    $parametros = array(":usu"=>$usuario,":agr"=>$agrupacion);

    $sql = "SELECT PueT_Codigo, PueT_Nombre
    FROM puestos_trabajos p
    INNER JOIN estaciones_areas ON p.EstA_Codigo = estaciones_areas.EstA_Codigo AND estaciones_areas.EstA_Estado = 1
    INNER JOIN estaciones ON estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND Est_Estado = 1
    LEFT JOIN areas a ON estaciones_areas.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = 1
    LEFT JOIN usuarios u ON a.Pla_Codigo = u.Pla_Codigo AND u.Usu_Estado = 1
    WHERE PueT_Estado = 1 AND u.Usu_Codigo = :usu AND agrupaciones.Agr_Codigo = :agr
    ORDER BY a.Are_Secuencia ASC";

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
  public function puestosTrabajoCierresCalidadAdmin($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT PueT_Codigo, estaciones.Est_Codigo, areas.Are_Codigo, Est_Nombre, PueT_Nombre, agrupaciones.Agr_Codigo
    FROM puestos_trabajos
    INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND EstA_Estado = 1
    INNER JOIN areas ON estaciones_areas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN estaciones ON estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND estaciones.Est_Estado = 1
    INNER JOIN plantas ON estaciones.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN agrupaciones_areas ON areas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = 1
    WHERE PueT_Estado = 1 AND areas.Are_Tipo = 6 AND plantas_usuarios.Usu_Codigo = :usu
    ORDER BY PueT_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
