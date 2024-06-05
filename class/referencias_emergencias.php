<?php
require_once('basedatos.php');

  class referencias_emergencias extends basedatos {
    private $RefE_Codigo;
    private $Pla_Codigo;
    private $For_Codigo;
    private $Are_Codigo;
    private $RefE_Tipo;
    private $RefE_CentroCostos;
    private $RefE_Familia;
    private $RefE_Color;
    private $RefE_Descripcion;
    private $RefE_Estado;
    private $RefE_FechaHoraCrea;
    private $RefE_UsuarioCrea;

  function __construct($RefE_Codigo = NULL, $Pla_Codigo = NULL, $For_Codigo = NULL, $Are_Codigo = NULL, $RefE_Tipo = NULL, $RefE_CentroCostos = NULL, $RefE_Familia = NULL, $RefE_Color = NULL, $RefE_Descripcion = NULL, $RefE_Estado = NULL, $RefE_FechaHoraCrea = NULL, $RefE_UsuarioCrea = NULL) {
    $this->RefE_Codigo = $RefE_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->For_Codigo = $For_Codigo;
    $this->Are_Codigo = $Are_Codigo;
    $this->RefE_Tipo = $RefE_Tipo;
    $this->RefE_CentroCostos = $RefE_CentroCostos;
    $this->RefE_Familia = $RefE_Familia;
    $this->RefE_Color = $RefE_Color;
    $this->RefE_Descripcion = $RefE_Descripcion;
    $this->RefE_Estado = $RefE_Estado;
    $this->RefE_FechaHoraCrea = $RefE_FechaHoraCrea;
    $this->RefE_UsuarioCrea = $RefE_UsuarioCrea;
    $this->tabla = "referencias_emergencias";
  }

  function getRefE_Codigo() {
    return $this->RefE_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getFor_Codigo() {
    return $this->For_Codigo;
  }

  function getAre_Codigo() {
    return $this->Are_Codigo;
  }

  function getRefE_Tipo() {
    return $this->RefE_Tipo;
  }

  function getRefE_CentroCostos() {
    return $this->RefE_CentroCostos;
  }

  function getRefE_Familia() {
    return $this->RefE_Familia;
  }

  function getRefE_Color() {
    return $this->RefE_Color;
  }

  function getRefE_Descripcion() {
    return $this->RefE_Descripcion;
  }

  function getRefE_Estado() {
    return $this->RefE_Estado;
  }

  function getRefE_FechaHoraCrea() {
    return $this->RefE_FechaHoraCrea;
  }

  function getRefE_UsuarioCrea() {
    return $this->RefE_UsuarioCrea;
  }

  function setRefE_Codigo($RefE_Codigo) {
    $this->RefE_Codigo = $RefE_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setFor_Codigo($For_Codigo) {
    $this->For_Codigo = $For_Codigo;
  }

  function setAre_Codigo($Are_Codigo) {
    $this->Are_Codigo = $Are_Codigo;
  }

  function setRefE_Tipo($RefE_Tipo) {
    $this->RefE_Tipo = $RefE_Tipo;
  }

  function setRefE_CentroCostos($RefE_CentroCostos) {
    $this->RefE_CentroCostos = $RefE_CentroCostos;
  }

  function setRefE_Familia($RefE_Familia) {
    $this->RefE_Familia = $RefE_Familia;
  }

  function setRefE_Color($RefE_Color) {
    $this->RefE_Color = $RefE_Color;
  }

  function setRefE_Descripcion($RefE_Descripcion) {
    $this->RefE_Descripcion = $RefE_Descripcion;
  }

  function setRefE_Estado($RefE_Estado) {
    $this->RefE_Estado = $RefE_Estado;
  }

  function setRefE_FechaHoraCrea($RefE_FechaHoraCrea) {
    $this->RefE_FechaHoraCrea = $RefE_FechaHoraCrea;
  }

  function setRefE_UsuarioCrea($RefE_UsuarioCrea) {
    $this->RefE_UsuarioCrea = $RefE_UsuarioCrea;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "For_Codigo", "Are_Codigo", "RefE_Tipo", "RefE_CentroCostos", "RefE_Familia", "RefE_Color", "RefE_Descripcion", "RefE_Estado", "RefE_FechaHoraCrea", "RefE_UsuarioCrea");
    $valores = array(
    array(
      $this->Pla_Codigo, 
      $this->For_Codigo, 
      $this->Are_Codigo, 
      $this->RefE_Tipo, 
      $this->RefE_CentroCostos, 
      $this->RefE_Familia, 
      $this->RefE_Color, 
      $this->RefE_Descripcion, 
      $this->RefE_Estado, 
      $this->RefE_FechaHoraCrea, 
      $this->RefE_UsuarioCrea
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
    $sql =  "SELECT * FROM referencias_emergencias WHERE RefE_Codigo = :cod";
    $parametros = array(":cod"=>$this->RefE_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setFor_Codigo($res[2]);
      $this->setAre_Codigo($res[3]);
      $this->setRefE_Tipo($res[4]);
      $this->setRefE_CentroCostos($res[5]);
      $this->setRefE_Familia($res[6]);
      $this->setRefE_Color($res[7]);
      $this->setRefE_Descripcion($res[8]);
      $this->setRefE_Estado($res[9]);
      $this->setRefE_FechaHoraCrea($res[10]);
      $this->setRefE_UsuarioCrea($res[11]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "For_Codigo", "Are_Codigo", "RefE_Tipo", "RefE_CentroCostos", "RefE_Familia", "RefE_Color", "RefE_Descripcion", "RefE_Estado", "RefE_FechaHoraCrea", "RefE_UsuarioCrea");
    $valores = array($this->getPla_Codigo(), $this->getFor_Codigo(), $this->getAre_Codigo(), $this->getRefE_Tipo(), $this->getRefE_CentroCostos(), $this->getRefE_Familia(), $this->getRefE_Color(), $this->getRefE_Descripcion(), $this->getRefE_Estado(), $this->getRefE_FechaHoraCrea(), $this->getRefE_UsuarioCrea());
    $llaveprimaria = "RefE_Codigo";
    $valorllaveprimaria = $this->getRefE_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM referencias_emergencias WHERE RefE_Codigo = :cod";
    $parametros = array(":cod"=>$this->RefE_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
    
  /*
  Autor: Natalia Rodríguez
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function referenciasEmergenciaListarPrincipal($planta, $area, $estado){
		
  $parametros = array(":est"=>$estado);
		
  $sql = "SELECT RefE_Codigo, Pla_Nombre, For_Nombre, Are_Nombre, 
  IF(RefE_Tipo = 1, 'Paradas programadas de mantenimiento', 
   IF(RefE_Tipo = 2, 'Pruebas programadas', 
    IF(RefE_Tipo = 3, 'Referencias manuales', 'No existe el tipo'
    )
   )
  ) as tipo, 
  RefE_CentroCostos, RefE_Familia, RefE_Color, RefE_Estado, RefE_Descripcion
  FROM referencias_emergencias r
  INNER JOIN plantas p ON p.Pla_Codigo = r.Pla_Codigo AND p.Pla_Estado = 1
  INNER JOIN formatos f ON f.For_Codigo = r.For_Codigo AND f.For_Estado = 1
  INNER JOIN areas a ON a.Are_Codigo = r.Are_Codigo AND a.Are_Estado = 1
  WHERE r.RefE_Estado = :est";
  
  if ( $planta != "" ) {
      $pri = 1;
      foreach ( $planta as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " p.Pla_Codigo = :pla" . $pri . " ";
        $parametros[ ':pla' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }

    if ( $area != "" ) {
      $pri3 = 1;
      foreach ( $area as $registro4 ) {
        if ( $pri3 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " a.Are_Codigo = :are" . $pri3 . " ";
        $parametros[ ':are' . $pri3 ] = $registro4;
        $pri3++;
      }
      $sql .= " )";
    }
    $sql .= " ORDER BY a.Are_Codigo ASC";
		
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
  public function listarReferenciasEmergencia($prensa){

    $parametros = array(":pre"=>$prensa);

    $sql = "SELECT RefE_Codigo, referencias_emergencias.Pla_Codigo, referencias_emergencias.For_Codigo, referencias_emergencias.Are_Codigo,
    IF(RefE_Tipo = 1, 'Paradas programadas de mantenimiento',
     IF(RefE_Tipo = 2, 'Pruebas programadas',
      IF(RefE_Tipo = 3, 'Referencias manuales', 'no existe')
     )
    ) AS Tipo , RefE_CentroCostos, RefE_Familia, RefE_Color, plantas.Pla_Nombre, formatos.For_Nombre, areas.Are_Nombre, RefE_Descripcion,
    (SELECT AVG(UniE_Metros) FROM unidades_empaque WHERE unidades_empaque.For_Codigo = referencias_emergencias.For_Codigo 
    AND unidades_empaque.UniE_Estado = 1 AND UniE_Tipo = 2 ) AS MExpor,
    (SELECT AVG(UniE_Metros) FROM unidades_empaque WHERE unidades_empaque.For_Codigo = referencias_emergencias.For_Codigo  
    AND unidades_empaque.UniE_Estado = 1 AND UniE_Tipo = 1 ) AS MEuro
    FROM referencias_emergencias
    INNER JOIN plantas ON referencias_emergencias.Pla_Codigo = plantas.Pla_Codigo AND Pla_Estado = 1
    INNER JOIN formatos ON referencias_emergencias.For_Codigo = formatos.For_Codigo AND For_Estado = 1
    INNER JOIN areas ON referencias_emergencias.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    WHERE RefE_Estado = 1 AND referencias_emergencias.Are_Codigo = :pre";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  } 

}
?>
