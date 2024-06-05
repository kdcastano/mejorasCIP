<?php
require_once('basedatos.php');

  class configuracion_ficha_tecnica extends basedatos {
    private $ConFT_Codigo;
    private $Pla_Codigo;
    private $Maq_Codigo;
    private $AgrC_Codigo;
    private $ConFT_Agrupacion;
    private $ConFT_Variable;
    private $ConFT_Ordenamiento;
    private $ConFT_TomaVariable;
    private $ConFT_FechaHoraCrea;
    private $ConFT_UsuarioCrea;
    private $ConFT_Estado;

  function __construct($ConFT_Codigo = NULL, $Pla_Codigo = NULL, $Maq_Codigo = NULL, $AgrC_Codigo = NULL, $ConFT_Agrupacion = NULL, $ConFT_Variable = NULL, $ConFT_Ordenamiento = NULL, $ConFT_TomaVariable = NULL, $ConFT_FechaHoraCrea = NULL, $ConFT_UsuarioCrea = NULL, $ConFT_Estado = NULL) {
    $this->ConFT_Codigo = $ConFT_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Maq_Codigo = $Maq_Codigo;
    $this->AgrC_Codigo = $AgrC_Codigo;
    $this->ConFT_Agrupacion = $ConFT_Agrupacion;
    $this->ConFT_Variable = $ConFT_Variable;
    $this->ConFT_Ordenamiento = $ConFT_Ordenamiento;
    $this->ConFT_TomaVariable = $ConFT_TomaVariable;
    $this->ConFT_FechaHoraCrea = $ConFT_FechaHoraCrea;
    $this->ConFT_UsuarioCrea = $ConFT_UsuarioCrea;
    $this->ConFT_Estado = $ConFT_Estado;
    $this->tabla = "configuracion_ficha_tecnica";
  }

  function getConFT_Codigo() {
    return $this->ConFT_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getMaq_Codigo() {
    return $this->Maq_Codigo;
  }

  function getAgrC_Codigo() {
    return $this->AgrC_Codigo;
  }

  function getConFT_Agrupacion() {
    return $this->ConFT_Agrupacion;
  }

  function getConFT_Variable() {
    return $this->ConFT_Variable;
  }

  function getConFT_Ordenamiento() {
    return $this->ConFT_Ordenamiento;
  }

  function getConFT_TomaVariable() {
    return $this->ConFT_TomaVariable;
  }

  function getConFT_FechaHoraCrea() {
    return $this->ConFT_FechaHoraCrea;
  }

  function getConFT_UsuarioCrea() {
    return $this->ConFT_UsuarioCrea;
  }

  function getConFT_Estado() {
    return $this->ConFT_Estado;
  }

  function setConFT_Codigo($ConFT_Codigo) {
    $this->ConFT_Codigo = $ConFT_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setMaq_Codigo($Maq_Codigo) {
    $this->Maq_Codigo = $Maq_Codigo;
  }

  function setAgrC_Codigo($AgrC_Codigo) {
    $this->AgrC_Codigo = $AgrC_Codigo;
  }

  function setConFT_Agrupacion($ConFT_Agrupacion) {
    $this->ConFT_Agrupacion = $ConFT_Agrupacion;
  }

  function setConFT_Variable($ConFT_Variable) {
    $this->ConFT_Variable = $ConFT_Variable;
  }

  function setConFT_Ordenamiento($ConFT_Ordenamiento) {
    $this->ConFT_Ordenamiento = $ConFT_Ordenamiento;
  }

  function setConFT_TomaVariable($ConFT_TomaVariable) {
    $this->ConFT_TomaVariable = $ConFT_TomaVariable;
  }

  function setConFT_FechaHoraCrea($ConFT_FechaHoraCrea) {
    $this->ConFT_FechaHoraCrea = $ConFT_FechaHoraCrea;
  }

  function setConFT_UsuarioCrea($ConFT_UsuarioCrea) {
    $this->ConFT_UsuarioCrea = $ConFT_UsuarioCrea;
  }

  function setConFT_Estado($ConFT_Estado) {
    $this->ConFT_Estado = $ConFT_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "Maq_Codigo", "AgrC_Codigo", "ConFT_Agrupacion", "ConFT_Variable", "ConFT_Ordenamiento", "ConFT_TomaVariable", "ConFT_FechaHoraCrea", "ConFT_UsuarioCrea", "ConFT_Estado");
    $valores = array(
    array( 
      $this->Pla_Codigo, 
      $this->Maq_Codigo, 
      $this->AgrC_Codigo, 
      $this->ConFT_Agrupacion, 
      $this->ConFT_Variable, 
      $this->ConFT_Ordenamiento, 
      $this->ConFT_TomaVariable, 
      $this->ConFT_FechaHoraCrea, 
      $this->ConFT_UsuarioCrea, 
      $this->ConFT_Estado
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
    $sql =  "SELECT * FROM configuracion_ficha_tecnica WHERE ConFT_Codigo = :cod";
    $parametros = array(":cod"=>$this->ConFT_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setMaq_Codigo($res[2]);
      $this->setAgrC_Codigo($res[3]);
      $this->setConFT_Agrupacion($res[4]);
      $this->setConFT_Variable($res[5]);
      $this->setConFT_Ordenamiento($res[6]);
      $this->setConFT_TomaVariable($res[7]);
      $this->setConFT_FechaHoraCrea($res[8]);
      $this->setConFT_UsuarioCrea($res[9]);
      $this->setConFT_Estado($res[10]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "Maq_Codigo", "AgrC_Codigo", "ConFT_Agrupacion", "ConFT_Variable", "ConFT_Ordenamiento", "ConFT_TomaVariable", "ConFT_FechaHoraCrea", "ConFT_UsuarioCrea", "ConFT_Estado");
    $valores = array($this->getPla_Codigo(), $this->getMaq_Codigo(), $this->getAgrC_Codigo(), $this->getConFT_Agrupacion(), $this->getConFT_Variable(), $this->getConFT_Ordenamiento(), $this->getConFT_TomaVariable(), $this->getConFT_FechaHoraCrea(), $this->getConFT_UsuarioCrea(), $this->getConFT_Estado());
    $llaveprimaria = "ConFT_Codigo";
    $valorllaveprimaria = $this->getConFT_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM configuracion_ficha_tecnica WHERE ConFT_Codigo = :cod";
    $parametros = array(":cod"=>$this->ConFT_Codigo);
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
  public function configFTFiltroUsuario( $usuario, $planta, $area, $estado, $maquina ) {

    $parametros = array( ":usu" => $usuario, ":est" => $estado );

    $sql = "SELECT ConFT_Codigo, plantas.Pla_Nombre, areas.Are_Nombre, ConFT_Variable, ConFT_Ordenamiento,Maq_Nombre, ConFT_Agrupacion, ConFT_Estado
    FROM configuracion_ficha_tecnica
    INNER JOIN maquinas ON configuracion_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON configuracion_ficha_tecnica.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE ConFT_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu ";

    if ( $planta != "" ) {
      $pri = 1;
      foreach ( $planta as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " plantas.Pla_Codigo = :pla" . $pri . " ";
        $parametros[ ':pla' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }

    if ( $area != "" ) {
      $pri4 = 1;
      foreach ( $area as $registro4 ) {
        if ( $pri4 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " areas.Are_Codigo = :are" . $pri4 . " ";
        $parametros[ ':are' . $pri4 ] = $registro4;
        $pri4++;
      }
      $sql .= " )";
    }    
    
    if ( $maquina != "" ) {
      $pri5 = 1;
      foreach ( $maquina as $registro5 ) {
        if ( $pri5 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " maquinas.Maq_Codigo = :maq" . $pri5 . " ";
        $parametros[ ':maq' . $pri5 ] = $registro5;
        $pri5++;
      }
      $sql .= " )";
    }

    $sql .= " ORDER BY plantas.Pla_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarMaquinasAgrupacion( $planta, $agrupacion, $area ) {

    $parametros = array( ":pla" => $planta, ":agr" => $agrupacion, ":are" => $area );

    $sql = "SELECT DISTINCT configuracion_ficha_tecnica.Maq_Codigo, maquinas.maq_Nombre, configuracion_ficha_tecnica.Are_Codigo
    FROM configuracion_ficha_tecnica
    INNER JOIN maquinas ON configuracion_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo
    WHERE ConFT_Estado = 1 AND Pla_Codigo = :pla AND ConFT_Agrupacion = :agr
    AND configuracion_ficha_tecnica.Are_Codigo = :are
    ORDER BY Maq_Codigo ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarVariablesAgrupacion( $planta, $agrupacion, $area, $maquina ) {

    $parametros = array( ":pla" => $planta, ":agr" => $agrupacion, ":are" => $area, ":maq" => $maquina );

    $sql = "SELECT configuracion_ficha_tecnica.Maq_Codigo, maquinas.maq_Nombre, configuracion_ficha_tecnica.ConFT_Variable, ConFT_TomaVariable
    FROM configuracion_ficha_tecnica
    INNER JOIN maquinas ON configuracion_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo
    WHERE ConFT_Estado = 1 AND Pla_Codigo = :pla AND ConFT_Agrupacion = :agr
    AND configuracion_ficha_tecnica.Are_Codigo = :are AND maquinas.Maq_Codigo = :maq
    ORDER BY ConFT_Ordenamiento ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarVariables($tipo, $formato){

    $parametros = array(":tip"=>$tipo, ":for"=>$formato );

    $sql = "SELECT AgrC_Codigo, ConFT_Variable, areas.Are_Codigo, ConFT_Codigo, maquinas.Maq_Codigo
    FROM configuracion_ficha_tecnica
    INNER JOIN maquinas ON configuracion_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND ConFT_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN formatos_areas ON areas.Are_Codigo = formatos_areas.Are_Codigo AND ForA_Estado = 1
    WHERE ConFT_Estado = 1 AND Are_Tipo = :tip AND formatos_areas.For_Codigo = :for
    ORDER BY ConFT_Variable ASC";

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
  public function listarVariablesAreasLinea($tipo, $zona){

    $parametros = array(":tip"=>$tipo, ":zon"=>$zona);

    $sql = "SELECT AgrC_Codigo, ConFT_Variable, areas.Are_Codigo, ConFT_Codigo, AgrM_Codigo, maquinas.Maq_Codigo
    FROM configuracion_ficha_tecnica
    INNER JOIN maquinas ON configuracion_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND ConFT_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    WHERE ConFT_Estado = 1 AND Are_Tipo = :tip AND ConFT_Agrupacion = :zon
    ORDER BY ConFT_Variable ASC";

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
  public function listarUltimoRegistroUsuario($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT ConFT_Codigo 
    FROM configuracion_ficha_tecnica
    WHERE ConFT_Estado = 1 AND ConFT_UsuarioCrea = :usu
    ORDER BY ConFT_Codigo DESC
    LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
    
  
    /*
      Autor: Dayanna Castaño
      Fecha: 
      Descripción:
      Parámetros:
      */
    public function listarMaquinasZonasLinea($usuario, $zona, $planta){

      $parametros = array(":usu"=>$usuario, ":zon"=>$zona, ":pla"=>$planta);

      $sql = "SELECT configuracion_ficha_tecnica.Maq_Codigo, maquinas.Maq_Nombre, AgrC_Codigo
      FROM configuracion_ficha_tecnica
      INNER JOIN maquinas ON configuracion_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo
      INNER JOIN plantas ON configuracion_ficha_tecnica.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE ConFT_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND ConFT_Agrupacion = :zon AND plantas.Pla_Codigo = :pla
      ORDER BY maquinas.Maq_Codigo ASC";

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
  public function listarMaquinasFichaTecnicaLinea($tipo, $usuario, $planta, $zona, $formato){

    $parametros = array(":tip"=>$tipo, ":usu"=>$usuario, ":zon"=>$zona, ":pla"=>$planta, ":for"=>$formato);
    $sql = "SELECT DISTINCT maquinas.AgrM_Codigo, AgrM_Nombre, maquinas.Maq_Nombre, maquinas.Maq_Codigo 
    FROM configuracion_ficha_tecnica
    INNER JOIN agrupaciones_configft ON configuracion_ficha_tecnica.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado =1
    INNER JOIN maquinas ON configuracion_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN agrupaciones_maquinas ON maquinas.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN formatos_areas ON areas.Are_Codigo = formatos_areas.Are_Codigo AND ForA_Estado = 1
    INNER JOIN plantas ON configuracion_ficha_tecnica.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1 
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1 
    WHERE ConFT_Estado = 1 AND Are_Tipo = :tip AND plantas_usuarios.Usu_Codigo = :usu AND configuracion_ficha_tecnica.Pla_Codigo = :pla
    AND ConFT_Agrupacion = :zon AND For_Codigo = :for
    ORDER BY Maq_Orden ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
}
?>
