<?php
require_once('basedatos.php');

  class agrupaciones extends basedatos {
    private $Agr_Codigo;
    private $Pla_Codigo;
    private $Agr_Nombre;
    private $Agr_Secuencia;
    private $Agr_Tipo;
    private $Agr_UsuarioCrea;
    private $Agr_FechaHoraCrea;
    private $Agr_Estado;

  function __construct($Agr_Codigo = NULL, $Pla_Codigo = NULL, $Agr_Nombre = NULL, $Agr_Secuencia = NULL, $Agr_Tipo = NULL, $Agr_UsuarioCrea = NULL, $Agr_FechaHoraCrea = NULL, $Agr_Estado = NULL) {
    $this->Agr_Codigo = $Agr_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Agr_Nombre = $Agr_Nombre;
    $this->Agr_Secuencia = $Agr_Secuencia;
    $this->Agr_Tipo = $Agr_Tipo;
    $this->Agr_UsuarioCrea = $Agr_UsuarioCrea;
    $this->Agr_FechaHoraCrea = $Agr_FechaHoraCrea;
    $this->Agr_Estado = $Agr_Estado;
    $this->tabla = "agrupaciones";
  }

  function getAgr_Codigo() {
    return $this->Agr_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getAgr_Nombre() {
    return $this->Agr_Nombre;
  }

  function getAgr_Secuencia() {
    return $this->Agr_Secuencia;
  }

  function getAgr_Tipo() {
    return $this->Agr_Tipo;
  }

  function getAgr_UsuarioCrea() {
    return $this->Agr_UsuarioCrea;
  }

  function getAgr_FechaHoraCrea() {
    return $this->Agr_FechaHoraCrea;
  }

  function getAgr_Estado() {
    return $this->Agr_Estado;
  }

  function setAgr_Codigo($Agr_Codigo) {
    $this->Agr_Codigo = $Agr_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setAgr_Nombre($Agr_Nombre) {
    $this->Agr_Nombre = $Agr_Nombre;
  }

  function setAgr_Secuencia($Agr_Secuencia) {
    $this->Agr_Secuencia = $Agr_Secuencia;
  }

  function setAgr_Tipo($Agr_Tipo) {
    $this->Agr_Tipo = $Agr_Tipo;
  }

  function setAgr_UsuarioCrea($Agr_UsuarioCrea) {
    $this->Agr_UsuarioCrea = $Agr_UsuarioCrea;
  }

  function setAgr_FechaHoraCrea($Agr_FechaHoraCrea) {
    $this->Agr_FechaHoraCrea = $Agr_FechaHoraCrea;
  }

  function setAgr_Estado($Agr_Estado) {
    $this->Agr_Estado = $Agr_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "Agr_Nombre", "Agr_Secuencia", "Agr_Tipo", "Agr_UsuarioCrea", "Agr_FechaHoraCrea", "Agr_Estado");
    $valores = array(
    array( 
      $this->Pla_Codigo, 
      $this->Agr_Nombre, 
      $this->Agr_Secuencia, 
      $this->Agr_Tipo, 
      $this->Agr_UsuarioCrea, 
      $this->Agr_FechaHoraCrea, 
      $this->Agr_Estado
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
    $sql =  "SELECT * FROM agrupaciones WHERE Agr_Codigo = :cod";
    $parametros = array(":cod"=>$this->Agr_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setAgr_Nombre($res[2]);
      $this->setAgr_Secuencia($res[3]);
      $this->setAgr_Tipo($res[4]);
      $this->setAgr_UsuarioCrea($res[5]);
      $this->setAgr_FechaHoraCrea($res[6]);
      $this->setAgr_Estado($res[7]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "Agr_Nombre", "Agr_Secuencia", "Agr_Tipo", "Agr_UsuarioCrea", "Agr_FechaHoraCrea", "Agr_Estado");
    $valores = array($this->getPla_Codigo(), $this->getAgr_Nombre(), $this->getAgr_Secuencia(), $this->getAgr_Tipo(), $this->getAgr_UsuarioCrea(), $this->getAgr_FechaHoraCrea(), $this->getAgr_Estado());
    $llaveprimaria = "Agr_Codigo";
    $valorllaveprimaria = $this->getAgr_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM agrupaciones WHERE Agr_Codigo = :cod";
    $parametros = array(":cod"=>$this->Agr_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }

  /*
    Autor: Natalia Rodriguez
    Fecha: 
    Descripción:
    Parámetros:
   */
  public function listarAgrupacionesPrincipal( $planta, $estado, $usuario, $area ) {

    $parametros = array( ":est" => $estado, ":usu" => $usuario );

    $sql = "SELECT DISTINCT agrupaciones.Agr_Codigo, Pla_Nombre, Agr_Nombre, agrupaciones.Pla_Codigo, Agr_Estado, Agr_Secuencia, 
    IF(Agr_Tipo = 1, 'Programa de Producción',
      IF (Agr_Tipo = 2, 'Fórmula', 'No existe el tipo')) as Tipo
     FROM agrupaciones
     INNER JOIN plantas ON agrupaciones.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
     INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
     LEFT JOIN agrupaciones_areas are ON are.Agr_Codigo = agrupaciones.Agr_Codigo AND are.AgrA_Estado = 1
     WHERE Agr_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";

    if ( $planta != "" ) {
      $pri = 1;
      foreach ( $planta as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " agrupaciones.Pla_Codigo = :pla" . $pri . " ";
        $parametros[ ':pla' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }
    
    if ( $area != "" ) {
      $pri2 = 1;
      foreach ( $area as $registro2 ) {
        if ( $pri2 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " are.Are_Codigo = :are" . $pri2 . " ";
        $parametros[ ':are' . $pri2 ] = $registro2;
        $pri2++;
      }
      $sql .= " )";
    }
    $sql .=" ORDER BY Agr_Secuencia ASC";
    $this->consultaSQL( $sql, $parametros );
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
  public function listarAgrupacionesSupervisor($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT agrupaciones.Agr_Codigo, agrupaciones.Agr_Nombre, Agr_Tipo
    FROM agrupaciones
    WHERE agrupaciones.Pla_Codigo = :pla AND Agr_Estado = 1
    ORDER BY agrupaciones.Agr_Secuencia ASC";

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
  public function listarAgrupacionesFiltroPanelSupervisorDatosPuestos($planta, $agrupacion, $area){

    $parametros = array(":pla"=>$planta, ":agr"=>$agrupacion);

    $sql = "SELECT PueT_Codigo, PueT_Nombre, areas.Are_Codigo, areas.Are_Nombre, Are_Tipo
    FROM puestos_trabajos
    INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND EstA_Estado = 1
    INNER JOIN estaciones ON estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND Est_Estado = 1
    INNER JOIN agrupaciones_areas ON estaciones_areas.Are_Codigo = agrupaciones_areas.Are_Codigo
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo
    INNER JOIN areas ON agrupaciones_areas.Are_Codigo = areas.Are_Codigo
    WHERE agrupaciones.Pla_Codigo = :pla AND Agr_Estado = 1 AND agrupaciones.Agr_Codigo = :agr AND puestos_trabajos.PueT_Estado = 1 AND AgrA_Estado = 1 ";
    
    if($area != "-1"){
      $sql .= " AND areas.Are_Codigo = :are ";
      $parametros[':are'] = $area;
    }
    
    $sql .= " ORDER BY Are_Secuencia ASC, PueT_Codigo ASC";

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
  public function listarAgrupacionesFiltroPanelSupervisorDatos($planta, $agrupacion, $area){

    $parametros = array(":pla"=>$planta, ":agr"=>$agrupacion);

    $sql = "SELECT agrupaciones.Agr_Codigo, agrupaciones.Agr_Nombre, areas.Are_Codigo, Are_Nombre, Are_Tipo
    FROM agrupaciones
    INNER JOIN agrupaciones_areas ON agrupaciones.Agr_Codigo = agrupaciones_areas.Agr_Codigo AND agrupaciones_areas.AgrA_Estado = 1
    INNER JOIN areas ON agrupaciones_areas.Are_Codigo = areas.Are_Codigo
    WHERE agrupaciones.Pla_Codigo = :pla AND Agr_Estado = 1 AND agrupaciones.Agr_Codigo = :agr ";
    
    if($area != "-1"){
      $sql .= " AND areas.Are_Codigo = :are ";
      $parametros[':are'] = $area;
    }
    
    $sql .= " ORDER BY areas.Are_Secuencia ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
  
}
?>
