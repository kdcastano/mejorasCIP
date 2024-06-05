<?php
require_once('basedatos.php');

  class detalle_ficha_tecnica extends basedatos {
    private $DetFT_Codigo;
    private $FicT_Codigo;
    private $Maq_Codigo;
    private $AgrVCon_Codigo;
    private $AgrMCon_Codigo;
    private $DetFT_Tipo;
    private $DetFT_UnidadMedida;
    private $DetFT_ValorControl;
    private $DetFT_ValorControlTexto;
    private $DetFT_ValorTolerancia;
    private $DetFT_Operador;
    private $DetFT_TomaVariable;
    private $DetFT_FechaHoraCrea;
    private $DetFT_UsuarioCrea;
    private $DetFT_Estado;

  function __construct($DetFT_Codigo = NULL, $FicT_Codigo = NULL, $Maq_Codigo = NULL, $AgrVCon_Codigo = NULL, $AgrMCon_Codigo = NULL, $DetFT_Tipo = NULL, $DetFT_UnidadMedida = NULL, $DetFT_ValorControl = NULL, $DetFT_ValorControlTexto = NULL, $DetFT_ValorTolerancia = NULL, $DetFT_Operador = NULL, $DetFT_TomaVariable = NULL, $DetFT_FechaHoraCrea = NULL, $DetFT_UsuarioCrea = NULL, $DetFT_Estado = NULL) {
    $this->DetFT_Codigo = $DetFT_Codigo;
    $this->FicT_Codigo = $FicT_Codigo;
    $this->Maq_Codigo = $Maq_Codigo;
    $this->AgrVCon_Codigo = $AgrVCon_Codigo;
    $this->AgrMCon_Codigo = $AgrMCon_Codigo;
    $this->DetFT_Tipo = $DetFT_Tipo;
    $this->DetFT_UnidadMedida = $DetFT_UnidadMedida;
    $this->DetFT_ValorControl = $DetFT_ValorControl;
    $this->DetFT_ValorControlTexto = $DetFT_ValorControlTexto;
    $this->DetFT_ValorTolerancia = $DetFT_ValorTolerancia;
    $this->DetFT_Operador = $DetFT_Operador;
    $this->DetFT_TomaVariable = $DetFT_TomaVariable;
    $this->DetFT_FechaHoraCrea = $DetFT_FechaHoraCrea;
    $this->DetFT_UsuarioCrea = $DetFT_UsuarioCrea;
    $this->DetFT_Estado = $DetFT_Estado;
    $this->tabla = "detalle_ficha_tecnica";
  }

  function getDetFT_Codigo() {
    return $this->DetFT_Codigo;
  }

  function getFicT_Codigo() {
    return $this->FicT_Codigo;
  }

  function getMaq_Codigo() {
    return $this->Maq_Codigo;
  }

  function getAgrVCon_Codigo() {
    return $this->AgrVCon_Codigo;
  }

  function getAgrMCon_Codigo() {
    return $this->AgrMCon_Codigo;
  }

  function getDetFT_Tipo() {
    return $this->DetFT_Tipo;
  }

  function getDetFT_UnidadMedida() {
    return $this->DetFT_UnidadMedida;
  }

  function getDetFT_ValorControl() {
    return $this->DetFT_ValorControl;
  }

  function getDetFT_ValorControlTexto() {
    return $this->DetFT_ValorControlTexto;
  }

  function getDetFT_ValorTolerancia() {
    return $this->DetFT_ValorTolerancia;
  }

  function getDetFT_Operador() {
    return $this->DetFT_Operador;
  }

  function getDetFT_TomaVariable() {
    return $this->DetFT_TomaVariable;
  }

  function getDetFT_FechaHoraCrea() {
    return $this->DetFT_FechaHoraCrea;
  }

  function getDetFT_UsuarioCrea() {
    return $this->DetFT_UsuarioCrea;
  }

  function getDetFT_Estado() {
    return $this->DetFT_Estado;
  }

  function setDetFT_Codigo($DetFT_Codigo) {
    $this->DetFT_Codigo = $DetFT_Codigo;
  }

  function setFicT_Codigo($FicT_Codigo) {
    $this->FicT_Codigo = $FicT_Codigo;
  }

  function setMaq_Codigo($Maq_Codigo) {
    $this->Maq_Codigo = $Maq_Codigo;
  }

  function setAgrVCon_Codigo($AgrVCon_Codigo) {
    $this->AgrVCon_Codigo = $AgrVCon_Codigo;
  }

  function setAgrMCon_Codigo($AgrMCon_Codigo) {
    $this->AgrMCon_Codigo = $AgrMCon_Codigo;
  }

  function setDetFT_Tipo($DetFT_Tipo) {
    $this->DetFT_Tipo = $DetFT_Tipo;
  }

  function setDetFT_UnidadMedida($DetFT_UnidadMedida) {
    $this->DetFT_UnidadMedida = $DetFT_UnidadMedida;
  }

  function setDetFT_ValorControl($DetFT_ValorControl) {
    $this->DetFT_ValorControl = $DetFT_ValorControl;
  }

  function setDetFT_ValorControlTexto($DetFT_ValorControlTexto) {
    $this->DetFT_ValorControlTexto = $DetFT_ValorControlTexto;
  }

  function setDetFT_ValorTolerancia($DetFT_ValorTolerancia) {
    $this->DetFT_ValorTolerancia = $DetFT_ValorTolerancia;
  }

  function setDetFT_Operador($DetFT_Operador) {
    $this->DetFT_Operador = $DetFT_Operador;

  }

  function setDetFT_TomaVariable($DetFT_TomaVariable) {
    $this->DetFT_TomaVariable = $DetFT_TomaVariable;
  }

  function setDetFT_FechaHoraCrea($DetFT_FechaHoraCrea) {
    $this->DetFT_FechaHoraCrea = $DetFT_FechaHoraCrea;
  }

  function setDetFT_UsuarioCrea($DetFT_UsuarioCrea) {
    $this->DetFT_UsuarioCrea = $DetFT_UsuarioCrea;
  }

  function setDetFT_Estado($DetFT_Estado) {
    $this->DetFT_Estado = $DetFT_Estado;
  }

  public function insertar(){
    $campos = array("FicT_Codigo", "Maq_Codigo", "AgrVCon_Codigo", "AgrMCon_Codigo", "DetFT_Tipo", "DetFT_UnidadMedida", "DetFT_ValorControl", "DetFT_ValorControlTexto", "DetFT_ValorTolerancia", "DetFT_Operador", "DetFT_TomaVariable", "DetFT_FechaHoraCrea", "DetFT_UsuarioCrea", "DetFT_Estado");
    $valores = array(
    array( 
      $this->FicT_Codigo, 
      $this->Maq_Codigo, 
      $this->AgrVCon_Codigo, 
      $this->AgrMCon_Codigo, 
      $this->DetFT_Tipo, 
      $this->DetFT_UnidadMedida, 
      $this->DetFT_ValorControl, 
      $this->DetFT_ValorControlTexto, 
      $this->DetFT_ValorTolerancia, 
      $this->DetFT_Operador, 
      $this->DetFT_TomaVariable, 
      $this->DetFT_FechaHoraCrea, 
      $this->DetFT_UsuarioCrea, 
      $this->DetFT_Estado
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
    $sql =  "SELECT * FROM detalle_ficha_tecnica WHERE DetFT_Codigo = :cod";
    $parametros = array(":cod"=>$this->DetFT_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setFicT_Codigo($res[1]);
      $this->setMaq_Codigo($res[2]);
      $this->setAgrVCon_Codigo($res[3]);
      $this->setAgrMCon_Codigo($res[4]);
      $this->setDetFT_Tipo($res[5]);
      $this->setDetFT_UnidadMedida($res[6]);
      $this->setDetFT_ValorControl($res[7]);
      $this->setDetFT_ValorControlTexto($res[8]);
      $this->setDetFT_ValorTolerancia($res[9]);
      $this->setDetFT_Operador($res[10]);
      $this->setDetFT_TomaVariable($res[11]);
      $this->setDetFT_FechaHoraCrea($res[12]);
      $this->setDetFT_UsuarioCrea($res[13]);
      $this->setDetFT_Estado($res[14]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("FicT_Codigo", "Maq_Codigo", "AgrVCon_Codigo", "AgrMCon_Codigo", "DetFT_Tipo", "DetFT_UnidadMedida", "DetFT_ValorControl", "DetFT_ValorControlTexto", "DetFT_ValorTolerancia", "DetFT_Operador", "DetFT_TomaVariable", "DetFT_FechaHoraCrea", "DetFT_UsuarioCrea", "DetFT_Estado");
    $valores = array($this->getFicT_Codigo(), $this->getMaq_Codigo(), $this->getAgrVCon_Codigo(), $this->getAgrMCon_Codigo(), $this->getDetFT_Tipo(), $this->getDetFT_UnidadMedida(), $this->getDetFT_ValorControl(), $this->getDetFT_ValorControlTexto(), $this->getDetFT_ValorTolerancia(), $this->getDetFT_Operador(), $this->getDetFT_TomaVariable(), $this->getDetFT_FechaHoraCrea(), $this->getDetFT_UsuarioCrea(), $this->getDetFT_Estado());
    $llaveprimaria = "DetFT_Codigo";
    $valorllaveprimaria = $this->getDetFT_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM detalle_ficha_tecnica WHERE DetFT_Codigo = :cod";
    $parametros = array(":cod"=>$this->DetFT_Codigo);
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
  public function cantRegistrosDFT($codigoFT){

    $parametros = array(":cod"=>$codigoFT);

    $sql = "SELECT COUNT(DetFT_Codigo) AS cantidad
    FROM detalle_ficha_tecnica
    WHERE FicT_Codigo = :cod AND DetFT_Estado = 1";

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
  public function listarDetalleFT($codigoFT){
    
    $parametros = array(":cod"=>$codigoFT);

    $sql = "SELECT maquinas.Are_Codigo, c.ConFT_Variable,  DetFT_ValorControl, DetFT_ValorControlTexto,
    IF(DetFT_Operador = 1, '>=', 
     IF(DetFT_Operador = 2, '<=',
      IF(DetFT_Operador = 3, '+-', ''
      )
     )
    ) AS operador, DetFT_ValorTolerancia, DetFT_Codigo, DetFT_Tipo, AgrM_Codigo, maquinas.Maq_Codigo, Par_Nombre
    FROM detalle_ficha_tecnica
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo 
    INNER JOIN configuracion_ficha_tecnica c ON detalle_ficha_tecnica.ConFT_Codigo = c.ConFT_Codigo
    LEFT JOIN parametros ON detalle_ficha_tecnica.DetFT_UnidadMedida = parametros.Par_Codigo
    WHERE DetFT_Estado = 1 AND Maq_Estado = 1 AND ConFT_Estado = 1 AND FicT_Codigo = :cod";

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
  public function listarDTFTodos($codigoFT){

    $parametros = array(":cod"=>$codigoFT);

    $sql = "SELECT DetFT_Codigo, FicT_Codigo, detalle_ficha_tecnica.ConFT_Codigo, detalle_ficha_tecnica.Maq_Codigo, DetFT_Tipo,
    DetFT_UnidadMedida, DetFT_ValorControl, DetFT_ValorControlTexto, DetFT_ValorTolerancia, DetFT_Operador, DetFT_TomaVariable
    FROM detalle_ficha_tecnica
    INNER JOIN configuracion_ficha_tecnica CFT ON detalle_ficha_tecnica.ConFT_Codigo = CFT.ConFT_Codigo AND ConFT_Estado = 1
    INNER JOIN agrupaciones_configft ON CFT.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado = 1
    WHERE DetFT_Estado = 1 AND FicT_Codigo = :cod";

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
  public function listarDTFTodosN($codigoFT){

    $parametros = array(":cod"=>$codigoFT);

    $sql = "SELECT DetFT_Codigo, FicT_Codigo, Maq_Codigo, AgrVCon_Codigo, AgrMCon_Codigo, DetFT_Tipo,
    DetFT_UnidadMedida, DetFT_ValorControl, DetFT_ValorControlTexto, DetFT_ValorTolerancia, DetFT_Operador, DetFT_TomaVariable
    FROM detalle_ficha_tecnica
    WHERE DetFT_Estado = 1 AND FicT_Codigo = :cod";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
   /*    Autor: RxDavid
    Fecha:     Descripción:
    Parámetros:    */
  public function listarDTFTodosNClonarSoloMaquinasActivas($codigoFT){
    $parametros = array(":cod"=>$codigoFT);
    $sql = "SELECT DetFT_Codigo, FicT_Codigo, detalle_ficha_tecnica.Maq_Codigo, AgrVCon_Codigo, AgrMCon_Codigo, DetFT_Tipo,    DetFT_UnidadMedida, DetFT_ValorControl, DetFT_ValorControlTexto, DetFT_ValorTolerancia, DetFT_Operador, DetFT_TomaVariable
    FROM detalle_ficha_tecnica    
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo
    WHERE DetFT_Estado = 1 AND FicT_Codigo = :cod AND maquinas.Maq_Estado = 1";
    $this->consultaSQL($sql, $parametros);    $res = $this->cargarTodo();
    $this->desconectar();    return $res;
  } 
    
    
  /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarDFTIngresoVariable($codigoFT){

    $parametros = array(":cod"=>$codigoFT);

    $sql = "SELECT DFT.Maq_Codigo, FT.For_Codigo,DFT.DetFT_Codigo, FT.FicT_Familia, FT.FicT_Color, 
    CFT.ConFT_Variable, FicT_Foto, DFT.DetFT_Tipo, parametros.Par_Nombre, DFT.DetFT_ValorControl,
    DFT.DetFT_ValorControlTexto, DFT.DetFT_ValorTolerancia,DFT.DetFT_Operador
    FROM detalle_ficha_tecnica DFT
    INNER JOIN ficha_tecnica FT ON DFT.FicT_Codigo = FT.FicT_Codigo AND FT.FicT_Estado = 1
    INNER JOIN configuracion_ficha_tecnica CFT ON DFT.ConFT_Codigo = CFT.ConFT_Codigo AND ConFT_Estado = 1
    LEFT JOIN parametros ON DFT.DetFT_UnidadMedida = parametros.Par_Codigo AND Par_Estado = 1
    WHERE DFT.DetFT_Estado = 1 AND DFT.FicT_Codigo = :cod";

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
  public function listarDFTIngresoVariableN($codigoFT){

    $parametros = array(":cod"=>$codigoFT);

    $sql = "SELECT DFT.Maq_Codigo, FT.For_Codigo,DFT.DetFT_Codigo, FT.FicT_Familia, FT.FicT_Color, 
    agrCFT.AgrC_Nombre, FicT_Foto, DFT.DetFT_Tipo, parametros.Par_Nombre, DFT.DetFT_ValorControl,
    DFT.DetFT_ValorControlTexto, DFT.DetFT_ValorTolerancia,DFT.DetFT_Operador, AgrC_Ordenamiento, AgrC_PuntoControl, AgrC_TipoVariable
    FROM detalle_ficha_tecnica DFT
    INNER JOIN ficha_tecnica FT ON DFT.FicT_Codigo = FT.FicT_Codigo AND FT.FicT_Estado = 1
    INNER JOIN agrupaciones_variables_configft agrVCFT ON DFT.AgrVCon_Codigo = agrVCFT.AgrVCon_Codigo AND AgrVCon_Estado = '1'
    INNER JOIN agrupaciones_configft agrCFT ON agrVCFT.AgrC_Codigo = agrCFT.AgrC_Codigo AND AgrC_Estado = '1'
    INNER JOIN agrupaciones_maquinas ON agrVCFT.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1' 
    LEFT JOIN parametros ON DFT.DetFT_UnidadMedida = parametros.Par_Codigo AND Par_Estado = 1
    WHERE DFT.DetFT_Estado = 1 AND DFT.FicT_Codigo = :cod";

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
  public function listarInfoPdfVariables($fichatecnica, $tipo){

    $parametros = array(":cod"=>$fichatecnica, ":tip"=>$tipo);

    $sql = "SELECT maquinas.Are_Codigo, c.ConFT_Variable,  DetFT_ValorControl, DetFT_ValorControlTexto,
      IF(DetFT_Operador = 1, '>=', 
       IF(DetFT_Operador = 2, '<=',
        IF(DetFT_Operador = 3, '+-', ''
        )
       )
      ) AS operador, DetFT_ValorTolerancia, DetFT_Tipo, parametros.Par_Nombre,DetFT_Operador
      FROM detalle_ficha_tecnica
      INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo 
      INNER JOIN configuracion_ficha_tecnica c ON detalle_ficha_tecnica.ConFT_Codigo = c.ConFT_Codigo
      LEFT JOIN parametros ON detalle_ficha_tecnica.DetFT_UnidadMedida = parametros.Par_Codigo
      INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
      WHERE DetFT_Estado = 1 AND Maq_Estado = 1 AND ConFT_Estado = 1 AND FicT_Codigo = :cod AND Are_Tipo = :tip";

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
  public function listarInfoPdfVariablesUnicas($fichatecnica, $tipo){

    $parametros = array(":cod"=>$fichatecnica, ":tip"=>$tipo);

    $sql = "SELECT DISTINCT c.ConFT_Variable
      FROM detalle_ficha_tecnica
      INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo 
      INNER JOIN configuracion_ficha_tecnica c ON detalle_ficha_tecnica.ConFT_Codigo = c.ConFT_Codigo
      INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
      WHERE DetFT_Estado = 1 AND Maq_Estado = 1 AND ConFT_Estado = 1 AND FicT_Codigo = :cod AND Are_Tipo = :tip";

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
  public function listarInfoPdfZonas($fichaTecnica, $tipo, $zona ){

    $parametros = array(":cod"=>$fichaTecnica, ":tip"=>$tipo, ":zon"=>$zona);

    $sql = "SELECT maquinas.Maq_Nombre, areas.Are_Codigo, configuracion_ficha_tecnica.ConFT_Variable, parametros.Par_Nombre, DetFT_ValorControl, DetFT_ValorControlTexto,
     DetFT_ValorTolerancia, 
     IF(DetFT_Operador = 1, '>=', 
       IF(DetFT_Operador = 2, '<=',
        IF(DetFT_Operador = 3, '+-', ''
        )
       )
      ) AS operador, DetFT_Tipo
    FROM detalle_ficha_tecnica
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN configuracion_ficha_tecnica ON detalle_ficha_tecnica.ConFT_Codigo = configuracion_ficha_tecnica.ConFT_Codigo AND ConFT_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    LEFT JOIN parametros ON detalle_ficha_tecnica.DetFT_UnidadMedida = parametros.Par_Codigo
    WHERE DetFT_Estado = 1 AND Maq_Estado = 1 AND ConFT_Estado = 1 AND FicT_Codigo = :cod AND Are_Tipo = :tip AND ConFT_Agrupacion = :zon ORDER BY Maq_Orden ASC";

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
  public function listarVariablesMaquinasInfo($maquina, $area, $FT){

    $parametros = array(":maq"=>$maquina,":are"=>$area,":FT"=>$FT);

    $sql = "SELECT DetFT_Codigo
    FROM detalle_ficha_tecnica
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    WHERE DetFT_Estado = 1 AND detalle_ficha_tecnica.Maq_Codigo = :maq AND maquinas.Are_Codigo = :are AND FicT_Codigo = :FT";

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
  public function buscarAgrMCreados($fichaTecncia, $tipo){

    $parametros = array(":fic"=>$fichaTecncia);

    $sql = "SELECT DISTINCT agrupaciones_maquinas_configft.AgrM_Codigo
    FROM detalle_ficha_tecnica
    INNER JOIN agrupaciones_maquinas_configft ON detalle_ficha_tecnica.AgrMCon_Codigo = agrupaciones_maquinas_configft.AgrMCon_Codigo 
    AND AgrMCon_Estado = '1' 
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    WHERE FicT_Codigo = :fic AND DetFT_Estado = 1 ";
    
    if($tipo == "2"){
      $sql .= " AND agrupaciones_maquinas.AgrM_Tipo IN (2,3)";
    }else{
      $sql .= " AND agrupaciones_maquinas.AgrM_Tipo = :tip ";
      $parametros[':tip'] = $tipo;
    }

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
  public function validarInfoCreada($fichaTecnica){

    $parametros = array(":fic"=>$fichaTecnica);

    $sql = "SELECT agrupaciones_maquinas_configft.AgrM_Codigo, agrupaciones_maquinas.AgrM_Nombre, agrupaciones_configft.AgrC_Nombre, FicT_Codigo, detalle_ficha_tecnica.AgrVCon_Codigo,DetFT_Tipo, DetFT_ValorControl, DetFT_ValorTolerancia , DetFT_Operador, DetFT_ValorControlTexto
    FROM detalle_ficha_tecnica
    INNER JOIN agrupaciones_maquinas_configft ON detalle_ficha_tecnica.AgrMCon_Codigo = agrupaciones_maquinas_configft.AgrMCon_Codigo 
    AND AgrMCon_Estado = '1' 
    INNER JOIN agrupaciones_variables_configft ON detalle_ficha_tecnica.AgrVCon_Codigo = agrupaciones_variables_configft.AgrVCon_Codigo 
    AND AgrVCon_Estado = '1'
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado = '1'
    WHERE DetFT_Estado = '1' AND FicT_Codigo = :fic
    GROUP BY agrupaciones_maquinas_configft.AgrM_Codigo, agrupaciones_maquinas.AgrM_Nombre, agrupaciones_configft.AgrC_Nombre, FicT_Codigo, detalle_ficha_tecnica.AgrVCon_Codigo,DetFT_Tipo, DetFT_ValorControl, DetFT_ValorTolerancia, DetFT_Operador, DetFT_ValorControlTexto";

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
  public function buscarMaquinasCreadasSelect($fichaTecnica){

    $parametros = array(":ft"=>$fichaTecnica);

    $sql = "SELECT agrupaciones_maquinas_configft.AgrM_Codigo, AgrVCon_Codigo, detalle_ficha_tecnica.Maq_Codigo, areas.Are_Nombre, DetFT_Codigo, DetFT_ValorControl, DetFT_ValorControlTexto, DetFT_ValorTolerancia, DetFT_Operador, Maq_Nombre
    FROM detalle_ficha_tecnica
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    INNER JOIN agrupaciones_maquinas_configft ON detalle_ficha_tecnica.AgrMCon_Codigo = agrupaciones_maquinas_configft.AgrMCon_Codigo 
    AND AgrMCon_Estado = '1' 
    WHERE DetFT_Estado = '1' AND FicT_Codigo = :ft";

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
  public function actualizarInformaciónVariable($fichaTecnica, $codVariable){

    $parametros = array(":ft"=>$fichaTecnica,":var"=>$codVariable);

    $sql = "SELECT DetFT_Codigo, agrupaciones_maquinas_configft.AgrM_Codigo, agrupaciones_maquinas.AgrM_Nombre, agrupaciones_configft.AgrC_Codigo,agrupaciones_configft.AgrC_Nombre,FicT_Codigo, detalle_ficha_tecnica.Maq_Codigo, areas.Are_Nombre, detalle_ficha_tecnica.AgrVCon_Codigo, 
    detalle_ficha_tecnica.AgrMCon_Codigo, DetFT_Tipo, DetFT_UnidadMedida, parametros.Par_Nombre, DetFT_ValorControl, DetFT_ValorControlTexto, 
    DetFT_ValorTolerancia , DetFT_Operador, DetFT_TomaVariable, maquinas.Maq_Nombre
    FROM detalle_ficha_tecnica
    INNER JOIN agrupaciones_maquinas_configft ON detalle_ficha_tecnica.AgrMCon_Codigo = agrupaciones_maquinas_configft.AgrMCon_Codigo 
    AND AgrMCon_Estado = '1' 
    INNER JOIN agrupaciones_variables_configft ON detalle_ficha_tecnica.AgrVCon_Codigo = agrupaciones_variables_configft.AgrVCon_Codigo 
    AND AgrVCon_Estado = '1'
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado = '1'
    INNER JOIN parametros ON agrupaciones_configft.AgrC_UnidadMedida = parametros.Par_Codigo AND Par_Estado = 1 WHERE DetFT_Estado = '1' AND FicT_Codigo = :ft AND agrupaciones_configft.AgrC_Codigo = :var ORDER BY agrupaciones_configft.AgrC_Ordenamiento, agrupaciones_variables_configft.AgrM_Codigo ASC";

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
  public function listarInfoCreadaPDF($codigoFT){

    $parametros = array(":cod"=>$codigoFT);

    $sql = "SELECT AgrM_Tipo,maquinas.Maq_Nombre, maquinas.Are_Codigo,agrupaciones_configft.AgrC_Nombre,agrupaciones_maquinas.AgrM_Nombre,
    DetFT_Tipo,parametros.Par_Nombre,DetFT_ValorControl,DetFT_ValorControlTexto,DetFT_ValorTolerancia,DetFT_Operador	
    FROM detalle_ficha_tecnica
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN agrupaciones_variables_configft ON detalle_ficha_tecnica.AgrVCon_Codigo = agrupaciones_variables_configft.AgrVCon_Codigo 
    AND AgrVCon_Estado = '1'
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado = 1
    INNER JOIN agrupaciones_maquinas_configft ON detalle_ficha_tecnica.AgrMCon_Codigo = agrupaciones_maquinas_configft.AgrMCon_Codigo AND AgrMCon_Estado = '1'
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    INNER JOIN parametros ON agrupaciones_configft.AgrC_UnidadMedida = parametros.Par_Codigo AND Par_Estado = 1
    WHERE DetFT_Estado = '1' AND FicT_Codigo = :cod
    ORDER BY maquinas.Maq_Orden, agrupaciones_configft.AgrC_Ordenamiento ASC";

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
  public function listarMaquinasCreadasFT($codigoFT){

    $parametros = array(":cod"=>$codigoFT);

    $sql = "SELECT DISTINCT maquinas.Maq_Nombre, maquinas.Are_Codigo, Are_Tipo
    FROM detalle_ficha_tecnica
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE DetFT_Estado = '1' AND FicT_Codigo = :cod
    ORDER BY maquinas.Maq_Orden ASC";

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
  public function listarInformacionFTPlantas($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT AgrM_Nombre,AgrC_Nombre,DetFT_Tipo,Par_Nombre,DetFT_ValorControl,
    DetFT_ValorControlTexto,
    DetFT_ValorTolerancia,DetFT_Operador,DetFT_TomaVariable, AgrM_Tipo, DetFT_Codigo
    FROM detalle_ficha_tecnica
    INNER JOIN agrupaciones_variables_configft ON detalle_ficha_tecnica.AgrVCon_Codigo = agrupaciones_variables_configft.AgrVCon_Codigo 
    AND AgrVCon_Estado = 1
    INNER JOIN agrupaciones_maquinas ON agrupaciones_variables_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado = '1'
    LEFT JOIN parametros ON detalle_ficha_tecnica.DetFT_UnidadMedida = parametros.Par_Codigo AND Par_Estado = '1'
    WHERE FicT_Codigo = :pla AND DetFT_Estado = '1'
    GROUP BY AgrM_Nombre,AgrC_Nombre,DetFT_Tipo,Par_Nombre,DetFT_ValorControl,DetFT_ValorControlTexto,DetFT_ValorTolerancia,
    DetFT_Operador,DetFT_TomaVariable ORDER BY agrupaciones_maquinas.AgrM_Codigo, agrupaciones_configft.AgrC_Ordenamiento, agrupaciones_variables_configft.AgrM_Codigo, detalle_ficha_tecnica.DetFT_Codigo ASC";

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
  public function listarInfoCreadaPDFCantidad($fichaTecnica){

    $parametros = array(":fic"=>$fichaTecnica);

    $sql = "SELECT AgrM_Tipo,maquinas.Maq_Nombre, maquinas.Are_Codigo,agrupaciones_configft.AgrC_Nombre
    FROM detalle_ficha_tecnica 
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1' 
    INNER JOIN agrupaciones_variables_configft ON detalle_ficha_tecnica.AgrVCon_Codigo = agrupaciones_variables_configft.AgrVCon_Codigo 
    AND AgrVCon_Estado = '1' 
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo 
    AND AgrC_Estado = 1 
    INNER JOIN agrupaciones_maquinas_configft ON detalle_ficha_tecnica.AgrMCon_Codigo = agrupaciones_maquinas_configft.AgrMCon_Codigo 
    AND AgrMCon_Estado = '1' 
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo 
    AND AgrM_Estado = '1' 
    WHERE DetFT_Estado = '1' AND FicT_Codigo = :fic
    GROUP BY AgrC_Nombre, AgrM_Nombre
    ORDER BY maquinas.Maq_Orden, agrupaciones_configft.AgrC_Ordenamiento ASC
    ";

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
  public function listarAreasTipoFTNCreados($fichaTecnica, $tipo){

    $parametros = array(":fic"=>$fichaTecnica,":tip"=>$tipo);

    $sql = "SELECT maquinas.Are_Codigo , are_Nombre, are_Tipo
    FROM detalle_ficha_tecnica
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = '1'
    WHERE DetFT_Estado = '1' AND FicT_Codigo = :fic AND are_Tipo = :tip
    GROUP BY maquinas.Are_Codigo
    ORDER BY maquinas.Maq_Orden ASC";

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
  public function listarVariablesGenerales($fichaTecnica, $agrupacion){

    $parametros = array(":fic"=>$fichaTecnica,":agr"=>$agrupacion);

    $sql = "SELECT AgrM_Nombre,AgrC_Nombre,DetFT_ValorControlTexto,AgrM_Tipo
    FROM detalle_ficha_tecnica
    INNER JOIN agrupaciones_variables_configft ON detalle_ficha_tecnica.AgrVCon_Codigo = agrupaciones_variables_configft.AgrVCon_Codigo 
    AND AgrVCon_Estado = 1
    INNER JOIN agrupaciones_maquinas ON agrupaciones_variables_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado = '1'
    LEFT JOIN parametros ON detalle_ficha_tecnica.DetFT_UnidadMedida = parametros.Par_Codigo AND Par_Estado = '1'
    WHERE FicT_Codigo = :fic AND DetFT_Estado = '1' AND DetFT_Tipo = '1' AND AgrM_Tipo = :agr
    GROUP BY AgrM_Nombre,AgrC_Nombre,DetFT_Tipo,Par_Nombre,DetFT_ValorControl,DetFT_ValorControlTexto,DetFT_ValorTolerancia,
    DetFT_Operador,DetFT_TomaVariable ORDER BY AgrM_Orden, AgrC_Ordenamiento ASC";

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
  public function buscarVariablesCreadasTipoTexto($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT DISTINCT AgrC_Nombre,AgrC_Tipo
    FROM detalle_ficha_tecnica
    INNER JOIN agrupaciones_variables_configft ON detalle_ficha_tecnica.AgrVCon_Codigo = agrupaciones_variables_configft.AgrVCon_Codigo 
    AND AgrVCon_Estado = 1
    INNER JOIN agrupaciones_maquinas ON agrupaciones_variables_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado = '1'
    WHERE DetFT_Estado = '1' AND agrupaciones_configft.Pla_Codigo = :pla AND AgrC_Tipo = '1'";

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
  public function buscarVariablesCreadasTipoTextoEspecifica($variable,$planta){

    $parametros = array(":pla"=>$planta,":var"=>$variable);

    $sql = "SELECT DISTINCT AgrC_Nombre,AgrC_Tipo
    FROM detalle_ficha_tecnica
    INNER JOIN agrupaciones_variables_configft ON detalle_ficha_tecnica.AgrVCon_Codigo = agrupaciones_variables_configft.AgrVCon_Codigo 
    AND AgrVCon_Estado = 1
    INNER JOIN agrupaciones_maquinas ON agrupaciones_variables_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado = '1'
    WHERE DetFT_Estado = '1' AND agrupaciones_configft.Pla_Codigo = :pla AND AgrC_Tipo = '1' AND AgrC_Nombre = :var";

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
  public function listarInformacionFTPlantasSopo($planta){
 
    $parametros = array(":pla"=>$planta);
 
    $sql = "SELECT AgrM_Nombre,AgrC_Nombre,DetFT_Tipo,Par_Nombre,DetFT_ValorControl,
    DetFT_ValorControlTexto,
    DetFT_ValorTolerancia,DetFT_Operador,DetFT_TomaVariable, AgrM_Tipo, DetFT_Codigo, Maq_Nombre, Are_Nombre
    FROM detalle_ficha_tecnica
    INNER JOIN agrupaciones_variables_configft ON detalle_ficha_tecnica.AgrVCon_Codigo = agrupaciones_variables_configft.AgrVCon_Codigo 
    AND AgrVCon_Estado = 1
    INNER JOIN agrupaciones_maquinas ON agrupaciones_variables_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado = '1'
    LEFT JOIN parametros ON detalle_ficha_tecnica.DetFT_UnidadMedida = parametros.Par_Codigo AND Par_Estado = '1'
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1' 
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    WHERE FicT_Codigo = :pla AND DetFT_Estado = '1'
    GROUP BY AgrM_Nombre,AgrC_Nombre,DetFT_Tipo,Par_Nombre,DetFT_ValorControl,DetFT_ValorControlTexto,DetFT_ValorTolerancia, Maq_Nombre, Are_Nombre
    ORDER BY agrupaciones_maquinas.AgrM_Codigo ASC, Maq_Nombre ASC, agrupaciones_configft.AgrC_Ordenamiento, agrupaciones_variables_configft.AgrM_Codigo ASC, detalle_ficha_tecnica.DetFT_Codigo ASC";
 
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
  public function listarInfoCreadaPDFCantidadSopo($fichaTecnica){
 
    $parametros = array(":fic"=>$fichaTecnica);
 
    $sql = "SELECT AgrM_Tipo,maquinas.Maq_Nombre, maquinas.Are_Codigo,agrupaciones_configft.AgrC_Nombre
    FROM detalle_ficha_tecnica 
    INNER JOIN maquinas ON detalle_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1' 
    INNER JOIN agrupaciones_variables_configft ON detalle_ficha_tecnica.AgrVCon_Codigo = agrupaciones_variables_configft.AgrVCon_Codigo 
    AND AgrVCon_Estado = '1' 
    INNER JOIN agrupaciones_configft ON agrupaciones_variables_configft.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo 
    AND AgrC_Estado = 1 
    INNER JOIN agrupaciones_maquinas_configft ON detalle_ficha_tecnica.AgrMCon_Codigo = agrupaciones_maquinas_configft.AgrMCon_Codigo 
    AND AgrMCon_Estado = '1' 
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo 
    AND AgrM_Estado = '1' 
    WHERE DetFT_Estado = '1' AND FicT_Codigo = :fic
    GROUP BY AgrC_Nombre, AgrM_Nombre, maquinas.Maq_Nombre, maquinas.Are_Codigo
    ORDER BY maquinas.Maq_Orden, agrupaciones_configft.AgrC_Ordenamiento ASC";
 
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
}
?>
