<?php
require_once('basedatos.php');

  class parametros_variables extends basedatos {
    private $ParV_Codigo;
    private $Maq_Codigo;
    private $For_Codigo;
    private $ParV_Nombre;
    private $ParV_UnidadMedida;
    private $ParV_ValorControl;
    private $ParV_ValorTolerancia;
    private $ParV_Operador;
    private $ParV_Tipo;
    private $ParV_TipoVariable;
    private $ParV_PuntoControl;
    private $ParV_Foto;
    private $ParV_Archivo;
    private $ParV_Orden;
    private $ParV_UsuarioCrea;
    private $ParV_FechaHoraCrea;
    private $ParV_Estado;

  function __construct($ParV_Codigo = NULL, $Maq_Codigo = NULL, $For_Codigo = NULL, $ParV_Nombre = NULL, $ParV_UnidadMedida = NULL, $ParV_ValorControl = NULL, $ParV_ValorTolerancia = NULL, $ParV_Operador = NULL, $ParV_Tipo = NULL, $ParV_TipoVariable = NULL, $ParV_PuntoControl = NULL, $ParV_Foto = NULL, $ParV_Archivo = NULL, $ParV_Orden = NULL, $ParV_UsuarioCrea = NULL, $ParV_FechaHoraCrea = NULL, $ParV_Estado = NULL) {
    $this->ParV_Codigo = $ParV_Codigo;
    $this->Maq_Codigo = $Maq_Codigo;
    $this->For_Codigo = $For_Codigo;
    $this->ParV_Nombre = $ParV_Nombre;
    $this->ParV_UnidadMedida = $ParV_UnidadMedida;
    $this->ParV_ValorControl = $ParV_ValorControl;
    $this->ParV_ValorTolerancia = $ParV_ValorTolerancia;
    $this->ParV_Operador = $ParV_Operador;
    $this->ParV_Tipo = $ParV_Tipo;
    $this->ParV_TipoVariable = $ParV_TipoVariable;
    $this->ParV_PuntoControl = $ParV_PuntoControl;
    $this->ParV_Foto = $ParV_Foto;
    $this->ParV_Archivo = $ParV_Archivo;
    $this->ParV_Orden = $ParV_Orden;
    $this->ParV_UsuarioCrea = $ParV_UsuarioCrea;
    $this->ParV_FechaHoraCrea = $ParV_FechaHoraCrea;
    $this->ParV_Estado = $ParV_Estado;
    $this->tabla = "parametros_variables";
  }

  function getParV_Codigo() {
    return $this->ParV_Codigo;
  }

  function getMaq_Codigo() {
    return $this->Maq_Codigo;
  }

  function getFor_Codigo() {
    return $this->For_Codigo;
  }

  function getParV_Nombre() {
    return $this->ParV_Nombre;
  }

  function getParV_UnidadMedida() {
    return $this->ParV_UnidadMedida;
  }

  function getParV_ValorControl() {
    return $this->ParV_ValorControl;
  }

  function getParV_ValorTolerancia() {
    return $this->ParV_ValorTolerancia;
  }

  function getParV_Operador() {
    return $this->ParV_Operador;
  }

  function getParV_Tipo() {
    return $this->ParV_Tipo;
  }

  function getParV_TipoVariable() {
    return $this->ParV_TipoVariable;
  }

  function getParV_PuntoControl() {
    return $this->ParV_PuntoControl;
  }

  function getParV_Foto() {
    return $this->ParV_Foto;
  }

  function getParV_Archivo() {
    return $this->ParV_Archivo;
  }

  function getParV_Orden() {
    return $this->ParV_Orden;
  }

  function getParV_UsuarioCrea() {
    return $this->ParV_UsuarioCrea;
  }

  function getParV_FechaHoraCrea() {
    return $this->ParV_FechaHoraCrea;
  }

  function getParV_Estado() {
    return $this->ParV_Estado;
  }

  function setParV_Codigo($ParV_Codigo) {
    $this->ParV_Codigo = $ParV_Codigo;
  }

  function setMaq_Codigo($Maq_Codigo) {
    $this->Maq_Codigo = $Maq_Codigo;
  }

  function setFor_Codigo($For_Codigo) {
    $this->For_Codigo = $For_Codigo;
  }

  function setParV_Nombre($ParV_Nombre) {
    $this->ParV_Nombre = $ParV_Nombre;
  }

  function setParV_UnidadMedida($ParV_UnidadMedida) {
    $this->ParV_UnidadMedida = $ParV_UnidadMedida;
  }

  function setParV_ValorControl($ParV_ValorControl) {
    $this->ParV_ValorControl = $ParV_ValorControl;
  }

  function setParV_ValorTolerancia($ParV_ValorTolerancia) {
    $this->ParV_ValorTolerancia = $ParV_ValorTolerancia;
  }

  function setParV_Operador($ParV_Operador) {
    $this->ParV_Operador = $ParV_Operador;
  }

  function setParV_Tipo($ParV_Tipo) {
    $this->ParV_Tipo = $ParV_Tipo;
  }

  function setParV_TipoVariable($ParV_TipoVariable) {
    $this->ParV_TipoVariable = $ParV_TipoVariable;
  }

  function setParV_PuntoControl($ParV_PuntoControl) {
    $this->ParV_PuntoControl = $ParV_PuntoControl;
  }

  function setParV_Foto($ParV_Foto) {
    $this->ParV_Foto = $ParV_Foto;
  }

  function setParV_Archivo($ParV_Archivo) {
    $this->ParV_Archivo = $ParV_Archivo;
  }

  function setParV_Orden($ParV_Orden) {
    $this->ParV_Orden = $ParV_Orden;
  }

  function setParV_UsuarioCrea($ParV_UsuarioCrea) {
    $this->ParV_UsuarioCrea = $ParV_UsuarioCrea;
  }

  function setParV_FechaHoraCrea($ParV_FechaHoraCrea) {
    $this->ParV_FechaHoraCrea = $ParV_FechaHoraCrea;
  }

  function setParV_Estado($ParV_Estado) {
    $this->ParV_Estado = $ParV_Estado;
  }

  public function insertar(){
    $campos = array("Maq_Codigo", "For_Codigo", "ParV_Nombre", "ParV_UnidadMedida", "ParV_ValorControl", "ParV_ValorTolerancia", "ParV_Operador", "ParV_Tipo", "ParV_TipoVariable", "ParV_PuntoControl", "ParV_Foto", "ParV_Archivo", "ParV_Orden", "ParV_UsuarioCrea", "ParV_FechaHoraCrea", "ParV_Estado");
    $valores = array(
    array( 
      $this->Maq_Codigo, 
      $this->For_Codigo, 
      $this->ParV_Nombre, 
      $this->ParV_UnidadMedida, 
      $this->ParV_ValorControl, 
      $this->ParV_ValorTolerancia, 
      $this->ParV_Operador, 
      $this->ParV_Tipo, 
      $this->ParV_TipoVariable, 
      $this->ParV_PuntoControl, 
      $this->ParV_Foto, 
      $this->ParV_Archivo, 
      $this->ParV_Orden, 
      $this->ParV_UsuarioCrea, 
      $this->ParV_FechaHoraCrea, 
      $this->ParV_Estado
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
    $sql =  "SELECT * FROM parametros_variables WHERE ParV_Codigo = :cod";
    $parametros = array(":cod"=>$this->ParV_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setMaq_Codigo($res[1]);
      $this->setFor_Codigo($res[2]);
      $this->setParV_Nombre($res[3]);
      $this->setParV_UnidadMedida($res[4]);
      $this->setParV_ValorControl($res[5]);
      $this->setParV_ValorTolerancia($res[6]);
      $this->setParV_Operador($res[7]);
      $this->setParV_Tipo($res[8]);
      $this->setParV_TipoVariable($res[9]);
      $this->setParV_PuntoControl($res[10]);
      $this->setParV_Foto($res[11]);
      $this->setParV_Archivo($res[12]);
      $this->setParV_Orden($res[13]);
      $this->setParV_UsuarioCrea($res[14]);
      $this->setParV_FechaHoraCrea($res[15]);
      $this->setParV_Estado($res[16]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Maq_Codigo", "For_Codigo", "ParV_Nombre", "ParV_UnidadMedida", "ParV_ValorControl", "ParV_ValorTolerancia", "ParV_Operador", "ParV_Tipo", "ParV_TipoVariable", "ParV_PuntoControl", "ParV_Foto", "ParV_Archivo", "ParV_Orden", "ParV_UsuarioCrea", "ParV_FechaHoraCrea", "ParV_Estado");
    $valores = array($this->getMaq_Codigo(), $this->getFor_Codigo(), $this->getParV_Nombre(), $this->getParV_UnidadMedida(), $this->getParV_ValorControl(), $this->getParV_ValorTolerancia(), $this->getParV_Operador(), $this->getParV_Tipo(), $this->getParV_TipoVariable(), $this->getParV_PuntoControl(), $this->getParV_Foto(), $this->getParV_Archivo(), $this->getParV_Orden(), $this->getParV_UsuarioCrea(), $this->getParV_FechaHoraCrea(), $this->getParV_Estado());
    $llaveprimaria = "ParV_Codigo";
    $valorllaveprimaria = $this->getParV_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM parametros_variables WHERE ParV_Codigo = :cod";
    $parametros = array(":cod"=>$this->ParV_Codigo);
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
  public function parametrosVListarUsuario( $usuario, $planta, $area, $maquina, $estado ) {

    $parametros = array( ":usu" => $usuario, ":est" => $estado );

    $sql = "SELECT ParV_Codigo, plantas.Pla_Nombre, areas.Are_Nombre, maquinas.Maq_Nombre, ParV_Nombre,
    unidadMedida.Par_Nombre, ParV_ValorControl, ParV_ValorTolerancia, ParV_Operador, ParV_Tipo, ParV_Estado, For_Nombre,
    IF( ParV_TipoVariable = 1, 'Variable crítica', 
      IF( ParV_TipoVariable = 2, 'Variable mayor', 
       IF( ParV_TipoVariable = 3, 'Variable menor', 'Sin clasificación' 
       ))) as TipoVariable,
       IF( ParV_PuntoControl = 1, 'Tipo Control', 
        IF( ParV_PuntoControl = 2, 'Tipo Verificación', 'No existe el tipo' 
         )) as puntoControl, ParV_Orden, maquinas.Maq_Codigo, parametros_variables.For_Codigo
    FROM parametros_variables
	INNER JOIN maquinas ON parametros_variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
	INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
	INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
        INNER JOIN formatos ON parametros_variables.For_Codigo = formatos.For_Codigo
    LEFT JOIN parametros unidadMedida ON parametros_variables.ParV_UnidadMedida = unidadMedida.Par_Codigo AND unidadMedida.Par_Estado = 1 AND unidadMedida.Par_Tipo = 1
    WHERE ParV_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu ";

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
      $pri3 = 1;
      foreach ( $area as $registro4 ) {
        if ( $pri3 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " areas.Are_Codigo = :are" . $pri3 . " ";
        $parametros[ ':are' . $pri3 ] = $registro4;
        $pri3++;
      }
      $sql .= " )";
    }

    if ( $maquina != "" ) {
      $pri4 = 1;
      foreach ( $maquina as $registro5 ) {
        if ( $pri4 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " maquinas.Maq_Codigo = :maq" . $pri4 . " ";
        $parametros[ ':maq' . $pri4 ] = $registro5;
        $pri4++;
      }
      $sql .= " )";
    }

    $sql .= " ORDER BY For_Nombre, areas.Are_Nombre ASC";

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
  public function listarUltimoRegistroUsuarioParam( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT ParV_Codigo
    FROM parametros_variables
    WHERE ParV_Estado = 1 AND ParV_UsuarioCrea = :usu
    ORDER BY ParV_Codigo DESC
    LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarInfoFormato($formato){

    $parametros = array(":for"=>$formato);

    $sql = "SELECT parametros_variables.Maq_Codigo, maquinas.Maq_Nombre, areas.Are_Nombre , ParV_Nombre, ParV_UnidadMedida, Par_Nombre, ParV_ValorControl, ParV_ValorTolerancia, ParV_Operador, ParV_Tipo, areas.Are_Tipo
    FROM parametros_variables
    INNER JOIN maquinas ON parametros_variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    LEFT JOIN parametros ON parametros_variables.ParV_UnidadMedida = parametros.Par_Codigo AND Par_Estado = '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND 	Are_Estado = '1'
    WHERE For_Codigo = :for AND ParV_Estado = '1'";

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
  public function listarInfoFormatoOtrasPlantas($formato){

    $parametros = array(":for"=>$formato);

    $sql = "SELECT parametros_variables.Maq_Codigo, maquinas.Maq_Nombre, areas.Are_Nombre , ParV_Nombre, ParV_UnidadMedida, Par_Nombre, ParV_ValorControl, ParV_ValorTolerancia, ParV_Operador, ParV_Tipo, areas.Are_Tipo
    FROM parametros_variables
    INNER JOIN maquinas ON parametros_variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    LEFT JOIN parametros ON parametros_variables.ParV_UnidadMedida = parametros.Par_Codigo AND Par_Estado = '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND 	Are_Estado = '1'
    WHERE For_Codigo = :for AND ParV_Estado = '1' GROUP BY  maquinas.Maq_Nombre, areas.Are_Nombre , ParV_Nombre";

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
  public function listarInfoFormatoAreas($formato){

    $parametros = array(":for"=>$formato);

    $sql = "SELECT DISTINCT areas.Are_Codigo, Are_Nombre, AgrM_Nombre, maquinas.maq_Nombre, Are_Tipo
    FROM parametros_variables
    INNER JOIN maquinas ON parametros_variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN  agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = '1'
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado= '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE For_Codigo = :for AND ParV_Estado = '1'
    ORDER BY areas.Are_Secuencia ASC";

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
  public function listarInfoFormatoAreasFT($formato){

    $parametros = array(":for"=>$formato);

    $sql = "SELECT DISTINCT areas.Are_Codigo, Are_Nombre, AgrM_Nombre, maquinas.maq_Nombre, Are_Tipo
    FROM parametros_variables
    INNER JOIN maquinas ON parametros_variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN  agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = '1'
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado= '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE For_Codigo = :for AND ParV_Estado = '1'
    ORDER BY areas.Are_Secuencia ASC, Are_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
