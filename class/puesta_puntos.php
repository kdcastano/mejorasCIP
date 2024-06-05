<?php
require_once('basedatos.php');

  class puesta_puntos extends basedatos {
    private $PueP_Codigo;
    private $Var_Codigo;
    private $ProP_Codigo;
    private $Usu_Codigo;
    private $PueP_Fecha;
    private $PueP_Hora;
    private $PueP_UnidadMedida;
    private $PueP_ValorControl;
    private $PueP_ValorTolerancia;
    private $PueP_Operador;
    private $PueP_TipoVariable;
    private $PueP_MotivoCambio;
    private $PueP_Supervisor;
    private $PueP_ObservacionSupervisor;
    private $PueP_HoraEstado;
    private $PueP_FechaHoraSupervisor;
    private $PueP_Estado;
    private $PueP_FechaHoraUsuarioCrea;

  function __construct($PueP_Codigo = NULL, $Var_Codigo = NULL, $ProP_Codigo = NULL, $Usu_Codigo = NULL, $PueP_Fecha = NULL, $PueP_Hora = NULL, $PueP_UnidadMedida = NULL, $PueP_ValorControl = NULL, $PueP_ValorTolerancia = NULL, $PueP_Operador = NULL, $PueP_TipoVariable = NULL, $PueP_MotivoCambio = NULL, $PueP_Supervisor = NULL, $PueP_ObservacionSupervisor = NULL, $PueP_HoraEstado = NULL, $PueP_FechaHoraSupervisor = NULL, $PueP_Estado = NULL, $PueP_FechaHoraUsuarioCrea = NULL) {
    $this->PueP_Codigo = $PueP_Codigo;
    $this->Var_Codigo = $Var_Codigo;
    $this->ProP_Codigo = $ProP_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->PueP_Fecha = $PueP_Fecha;
    $this->PueP_Hora = $PueP_Hora;
    $this->PueP_UnidadMedida = $PueP_UnidadMedida;
    $this->PueP_ValorControl = $PueP_ValorControl;
    $this->PueP_ValorTolerancia = $PueP_ValorTolerancia;
    $this->PueP_Operador = $PueP_Operador;
    $this->PueP_TipoVariable = $PueP_TipoVariable;
    $this->PueP_MotivoCambio = $PueP_MotivoCambio;
    $this->PueP_Supervisor = $PueP_Supervisor;
    $this->PueP_ObservacionSupervisor = $PueP_ObservacionSupervisor;
    $this->PueP_HoraEstado = $PueP_HoraEstado;
    $this->PueP_FechaHoraSupervisor = $PueP_FechaHoraSupervisor;
    $this->PueP_Estado = $PueP_Estado;
    $this->PueP_FechaHoraUsuarioCrea = $PueP_FechaHoraUsuarioCrea;
    $this->tabla = "puesta_puntos";
  }

  function getPueP_Codigo() {
    return $this->PueP_Codigo;
  }

  function getVar_Codigo() {
    return $this->Var_Codigo;
  }

  function getProP_Codigo() {
    return $this->ProP_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getPueP_Fecha() {
    return $this->PueP_Fecha;
  }

  function getPueP_Hora() {
    return $this->PueP_Hora;
  }

  function getPueP_UnidadMedida() {
    return $this->PueP_UnidadMedida;
  }

  function getPueP_ValorControl() {
    return $this->PueP_ValorControl;
  }

  function getPueP_ValorTolerancia() {
    return $this->PueP_ValorTolerancia;
  }

  function getPueP_Operador() {
    return $this->PueP_Operador;
  }

  function getPueP_TipoVariable() {
    return $this->PueP_TipoVariable;
  }

  function getPueP_MotivoCambio() {
    return $this->PueP_MotivoCambio;
  }

  function getPueP_Supervisor() {
    return $this->PueP_Supervisor;
  }

  function getPueP_ObservacionSupervisor() {
    return $this->PueP_ObservacionSupervisor;
  }

  function getPueP_HoraEstado() {
    return $this->PueP_HoraEstado;
  }

  function getPueP_FechaHoraSupervisor() {
    return $this->PueP_FechaHoraSupervisor;
  }

  function getPueP_Estado() {
    return $this->PueP_Estado;
  }

  function getPueP_FechaHoraUsuarioCrea() {
    return $this->PueP_FechaHoraUsuarioCrea;
  }

  function setPueP_Codigo($PueP_Codigo) {
    $this->PueP_Codigo = $PueP_Codigo;
  }

  function setVar_Codigo($Var_Codigo) {
    $this->Var_Codigo = $Var_Codigo;
  }

  function setProP_Codigo($ProP_Codigo) {
    $this->ProP_Codigo = $ProP_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setPueP_Fecha($PueP_Fecha) {
    $this->PueP_Fecha = $PueP_Fecha;
  }

  function setPueP_Hora($PueP_Hora) {
    $this->PueP_Hora = $PueP_Hora;
  }

  function setPueP_UnidadMedida($PueP_UnidadMedida) {
    $this->PueP_UnidadMedida = $PueP_UnidadMedida;
  }

  function setPueP_ValorControl($PueP_ValorControl) {
    $this->PueP_ValorControl = $PueP_ValorControl;
  }

  function setPueP_ValorTolerancia($PueP_ValorTolerancia) {
    $this->PueP_ValorTolerancia = $PueP_ValorTolerancia;
  }

  function setPueP_Operador($PueP_Operador) {
    $this->PueP_Operador = $PueP_Operador;
  }

  function setPueP_TipoVariable($PueP_TipoVariable) {
    $this->PueP_TipoVariable = $PueP_TipoVariable;
  }

  function setPueP_MotivoCambio($PueP_MotivoCambio) {
    $this->PueP_MotivoCambio = $PueP_MotivoCambio;
  }

  function setPueP_Supervisor($PueP_Supervisor) {
    $this->PueP_Supervisor = $PueP_Supervisor;
  }

  function setPueP_ObservacionSupervisor($PueP_ObservacionSupervisor) {
    $this->PueP_ObservacionSupervisor = $PueP_ObservacionSupervisor;
  }

  function setPueP_HoraEstado($PueP_HoraEstado) {
    $this->PueP_HoraEstado = $PueP_HoraEstado;
  }

  function setPueP_FechaHoraSupervisor($PueP_FechaHoraSupervisor) {
    $this->PueP_FechaHoraSupervisor = $PueP_FechaHoraSupervisor;
  }

  function setPueP_Estado($PueP_Estado) {
    $this->PueP_Estado = $PueP_Estado;
  }

  function setPueP_FechaHoraUsuarioCrea($PueP_FechaHoraUsuarioCrea) {
    $this->PueP_FechaHoraUsuarioCrea = $PueP_FechaHoraUsuarioCrea;
  }

  public function insertar(){
    $campos = array("Var_Codigo", "ProP_Codigo", "Usu_Codigo", "PueP_Fecha", "PueP_Hora", "PueP_UnidadMedida", "PueP_ValorControl", "PueP_ValorTolerancia", "PueP_Operador", "PueP_TipoVariable", "PueP_MotivoCambio", "PueP_Supervisor", "PueP_ObservacionSupervisor", "PueP_HoraEstado", "PueP_FechaHoraSupervisor", "PueP_Estado", "PueP_FechaHoraUsuarioCrea");
    $valores = array(
    array(
      $this->Var_Codigo, 
      $this->ProP_Codigo, 
      $this->Usu_Codigo, 
      $this->PueP_Fecha, 
      $this->PueP_Hora, 
      $this->PueP_UnidadMedida, 
      $this->PueP_ValorControl, 
      $this->PueP_ValorTolerancia, 
      $this->PueP_Operador, 
      $this->PueP_TipoVariable, 
      $this->PueP_MotivoCambio, 
      $this->PueP_Supervisor, 
      $this->PueP_ObservacionSupervisor, 
      $this->PueP_HoraEstado, 
      $this->PueP_FechaHoraSupervisor, 
      $this->PueP_Estado, 
      $this->PueP_FechaHoraUsuarioCrea
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
    $sql =  "SELECT * FROM puesta_puntos WHERE PueP_Codigo = :cod";
    $parametros = array(":cod"=>$this->PueP_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setVar_Codigo($res[1]);
      $this->setProP_Codigo($res[2]);
      $this->setUsu_Codigo($res[3]);
      $this->setPueP_Fecha($res[4]);
      $this->setPueP_Hora($res[5]);
      $this->setPueP_UnidadMedida($res[6]);
      $this->setPueP_ValorControl($res[7]);
      $this->setPueP_ValorTolerancia($res[8]);
      $this->setPueP_Operador($res[9]);
      $this->setPueP_TipoVariable($res[10]);
      $this->setPueP_MotivoCambio($res[11]);
      $this->setPueP_Supervisor($res[12]);
      $this->setPueP_ObservacionSupervisor($res[13]);
      $this->setPueP_HoraEstado($res[14]);
      $this->setPueP_FechaHoraSupervisor($res[15]);
      $this->setPueP_Estado($res[16]);
      $this->setPueP_FechaHoraUsuarioCrea($res[17]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Var_Codigo", "ProP_Codigo", "Usu_Codigo", "PueP_Fecha", "PueP_Hora", "PueP_UnidadMedida", "PueP_ValorControl", "PueP_ValorTolerancia", "PueP_Operador", "PueP_TipoVariable", "PueP_MotivoCambio", "PueP_Supervisor", "PueP_ObservacionSupervisor", "PueP_HoraEstado", "PueP_FechaHoraSupervisor", "PueP_Estado", "PueP_FechaHoraUsuarioCrea");
    $valores = array($this->getVar_Codigo(), $this->getProP_Codigo(), $this->getUsu_Codigo(), $this->getPueP_Fecha(), $this->getPueP_Hora(), $this->getPueP_UnidadMedida(), $this->getPueP_ValorControl(), $this->getPueP_ValorTolerancia(), $this->getPueP_Operador(), $this->getPueP_TipoVariable(), $this->getPueP_MotivoCambio(), $this->getPueP_Supervisor(), $this->getPueP_ObservacionSupervisor(), $this->getPueP_HoraEstado(), $this->getPueP_FechaHoraSupervisor(), $this->getPueP_Estado(), $this->getPueP_FechaHoraUsuarioCrea());
    $llaveprimaria = "PueP_Codigo";
    $valorllaveprimaria = $this->getPueP_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM puesta_puntos WHERE PueP_Codigo = :cod";
    $parametros = array(":cod"=>$this->PueP_Codigo);
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
  public function listarPuestaPuntosCreados($fechaInicial, $fechaFinal,$formato, $familia, $color){

    $parametros = array(":fecI"=>$fechaInicial, ":fecF"=>$fechaFinal, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT PueP_Codigo, puesta_puntos.Var_Codigo, PueP_Estado, ProP_Codigo
    FROM puesta_puntos
    INNER JOIN variables ON puesta_puntos.Var_Codigo = variables.Var_Codigo AND Var_Estado = '1'
    WHERE PueP_Fecha BETWEEN :fecI AND :fecF AND For_Codigo = :for 
    AND Var_Familia = :fam AND Var_Color = :col AND PueP_Estado != '0'
    UNION ALL
    SELECT PueP_Codigo, puesta_puntos.Var_Codigo, PueP_Estado, ProP_Codigo
    FROM puesta_puntos 
    INNER JOIN variables ON puesta_puntos.Var_Codigo = variables.Var_Codigo AND Var_Estado = '1' 
    WHERE PueP_Fecha BETWEEN :fecI AND :fecF
    AND PueP_Estado != '0'";

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
  public function consultarVariablesCambioAprobado($programaProduccion, $fechaInicial, $fechaFinal){

    $parametros = array(":pro"=>$programaProduccion,":fecI"=>$fechaInicial,":fecF"=>$fechaFinal);

    $sql = "SELECT Var_Codigo, PueP_ValorControl, PueP_Operador, PueP_ValorTolerancia, PueP_UnidadMedida, PueP_Hora, PueP_Fecha
    FROM puesta_puntos
    WHERE ProP_Codigo = :pro AND PueP_Fecha BETWEEN :fecI AND :fecF AND PueP_Estado = '2'";

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
  public function consultarVariablesCambioAprobadoTodos($programaProduccion, $fechaInicial, $fechaFinal){

    $parametros = array(":pro"=>$programaProduccion,":fecI"=>$fechaInicial,":fecF"=>$fechaFinal);

    $sql = "SELECT Var_Codigo, PueP_Estado
    FROM puesta_puntos
    WHERE ProP_Codigo = :pro AND PueP_Fecha BETWEEN :fecI AND :fecF AND PueP_Estado != 0";

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
  public function listarInformacionPuestaPunto($fechaInicial, $fechaFinal, $estado, $canal, $area, $referencia, $planta){

    $parametros = array(":fecI"=>$fechaInicial,":fecF"=>$fechaFinal,":pla"=>$planta);

    $sql = "SELECT ProP_Semana, variables.Var_Nombre, For_Nombre, Var_Familia, Var_Color, PueP_Fecha, PueP_ValorControl, PueP_Operador, PueP_ValorTolerancia, PueP_UnidadMedida, PueP_MotivoCambio, PueP_ObservacionSupervisor, PueP_Estado,     Var_ValorControl, Var_Operador, Var_ValorTolerancia, Var_UnidadMedida, areas.Are_Nombre, Agr_Nombre, maquinas.Maq_Nombre,
     (SELECT Tur_Nombre    FROM estaciones_usuarios 
    INNER JOIN turnos ON estaciones_usuarios.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = '1'     
    WHERE EstU_Fecha <= PueP_Fecha AND Usu_Codigo = puesta_puntos.Usu_Codigo
    ORDER BY EstU_Fecha DESC    LIMIT 1) AS turno, CONCAT_WS(' ',aprobador.Usu_Nombres,aprobador.Usu_Apellidos) AS aprobador, CONCAT_WS(' ',solicitante.Usu_Nombres,solicitante.Usu_Apellidos) AS solicitante, PueP_Codigo
    FROM puesta_puntos     
    INNER JOIN variables ON puesta_puntos.Var_Codigo = variables.Var_Codigo AND Var_Estado = '1' 
    INNER JOIN programa_produccion ON puesta_puntos.ProP_Codigo = programa_produccion.ProP_Codigo AND ProP_Estado = '1'     
    INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1' 
    INNER JOIN agrupaciones_areas ON programa_produccion.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = '1'     
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = '1' 
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND For_Estado = '1'     
    INNER JOIN maquinas on variables.Maq_Codigo = maquinas.Maq_Codigo AND Var_Estado = '1'
    LEFT JOIN usuarios aprobador ON puesta_puntos.PueP_Supervisor = aprobador.Usu_Codigo    
    LEFT JOIN usuarios solicitante ON puesta_puntos.Usu_Codigo = solicitante.Usu_Codigo 
    WHERE PueP_Fecha BETWEEN :fecI AND :fecF AND PueP_Estado != '0' AND programa_produccion.Pla_Codigo = :pla ";
    
    if($estado != "-1"){
      $sql .= " AND PueP_Estado = :est ";
      $parametros[':est'] = $estado;
    } 
    
    if($canal != "-1"){
      $sql .= " AND agrupaciones.Agr_Codigo = :can ";
      $parametros[':can'] = $canal;
    } 
    
    if($area != "-1"){
      $sql .= " AND areas.Are_Codigo = :are ";
      $parametros[':are'] = $area;
    } 
    
    if($referencia != "-1"){
      $sql .= " AND programa_produccion.ProP_Descripcion = :ref ";
      $parametros[':ref'] = $referencia;
    }
    
    $sql .= " ORDER BY ProP_Semana DESC";

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
  public function filtroCanalPuestaPunto($fechaInicial, $fechaFinal, $planta){

    $parametros = array(":fecI"=>$fechaInicial,":fecF"=>$fechaFinal,":pla"=>$planta);

    $sql = "SELECT DISTINCT agrupaciones.Agr_Codigo, agrupaciones.Agr_Nombre
    FROM puesta_puntos
    INNER JOIN variables ON puesta_puntos.Var_Codigo = variables.Var_Codigo AND Var_Estado = '1'
    INNER JOIN programa_produccion ON puesta_puntos.ProP_Codigo = programa_produccion.ProP_Codigo AND ProP_Estado = '1'
    INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    INNER JOIN agrupaciones_areas ON programa_produccion.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = '1'
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = '1'
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND For_Estado = '1'
    WHERE PueP_Fecha BETWEEN :fecI AND :fecF AND PueP_Estado != '0' AND programa_produccion.Pla_Codigo = :pla ORDER BY ProP_Semana DESC";

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
  public function filtroAreaPuestaPunto($fechaInicial, $fechaFinal, $planta){

    $parametros = array(":fecI"=>$fechaInicial,":fecF"=>$fechaFinal,":pla"=>$planta);

    $sql = "SELECT DISTINCT areas.Are_Codigo, areas.Are_Nombre
    FROM puesta_puntos
    INNER JOIN variables ON puesta_puntos.Var_Codigo = variables.Var_Codigo AND Var_Estado = '1'
    INNER JOIN programa_produccion ON puesta_puntos.ProP_Codigo = programa_produccion.ProP_Codigo AND ProP_Estado = '1'
    INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    INNER JOIN agrupaciones_areas ON programa_produccion.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = '1'
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = '1'
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND For_Estado = '1'
    WHERE PueP_Fecha BETWEEN :fecI AND :fecF AND PueP_Estado != '0' AND programa_produccion.Pla_Codigo = :pla ORDER BY ProP_Semana DESC";

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
  public function filtroReferenciaPuestaPunto($fechaInicial, $fechaFinal, $planta){

    $parametros = array(":fecI"=>$fechaInicial,":fecF"=>$fechaFinal,":pla"=>$planta);

    $sql = "SELECT DISTINCT programa_produccion.ProP_Descripcion
    FROM puesta_puntos
    INNER JOIN variables ON puesta_puntos.Var_Codigo = variables.Var_Codigo AND Var_Estado = '1'
    INNER JOIN programa_produccion ON puesta_puntos.ProP_Codigo = programa_produccion.ProP_Codigo AND ProP_Estado = '1'
    INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
    INNER JOIN agrupaciones_areas ON programa_produccion.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = '1'
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = '1'
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND For_Estado = '1'
    WHERE PueP_Fecha BETWEEN :fecI AND :fecF AND PueP_Estado != '0' AND programa_produccion.Pla_Codigo = :pla ORDER BY ProP_Semana DESC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
