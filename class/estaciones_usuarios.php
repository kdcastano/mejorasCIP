<?php
require_once('basedatos.php');

  class estaciones_usuarios extends basedatos {
    private $EstU_Codigo;
    private $Usu_Codigo;
    private $PueT_Codigo;
    private $Tur_Codigo;
    private $ProP_Codigo;
    private $ForM_Codigo;
    private $EstU_Fecha;
    private $EstU_FechaHoraCrea;
    private $EstU_UsuarioCrea;
    private $EstU_Estado;

  function __construct($EstU_Codigo = NULL, $Usu_Codigo = NULL, $PueT_Codigo = NULL, $Tur_Codigo = NULL, $ProP_Codigo = NULL, $ForM_Codigo = NULL, $EstU_Fecha = NULL, $EstU_FechaHoraCrea = NULL, $EstU_UsuarioCrea = NULL, $EstU_Estado = NULL) {
    $this->EstU_Codigo = $EstU_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->PueT_Codigo = $PueT_Codigo;
    $this->Tur_Codigo = $Tur_Codigo;
    $this->ProP_Codigo = $ProP_Codigo;
    $this->ForM_Codigo = $ForM_Codigo;
    $this->EstU_Fecha = $EstU_Fecha;
    $this->EstU_FechaHoraCrea = $EstU_FechaHoraCrea;
    $this->EstU_UsuarioCrea = $EstU_UsuarioCrea;
    $this->EstU_Estado = $EstU_Estado;
    $this->tabla = "estaciones_usuarios";
  }

  function getEstU_Codigo() {
    return $this->EstU_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getPueT_Codigo() {
    return $this->PueT_Codigo;
  }

  function getTur_Codigo() {
    return $this->Tur_Codigo;
  }
    
  function getProP_Codigo() {
    return $this->ProP_Codigo;
  }

  function getForM_Codigo() {
    return $this->ForM_Codigo;
  }  
    
  function getEstU_Fecha() {
    return $this->EstU_Fecha;
  }

  function getEstU_FechaHoraCrea() {
    return $this->EstU_FechaHoraCrea;
  }

  function getEstU_UsuarioCrea() {
    return $this->EstU_UsuarioCrea;
  }

  function getEstU_Estado() {
    return $this->EstU_Estado;
  }

  function setEstU_Codigo($EstU_Codigo) {
    $this->EstU_Codigo = $EstU_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setPueT_Codigo($PueT_Codigo) {
    $this->PueT_Codigo = $PueT_Codigo;
  }

  function setTur_Codigo($Tur_Codigo) {
    $this->Tur_Codigo = $Tur_Codigo;
  }
   
  function setProP_Codigo($ProP_Codigo) {
    $this->ProP_Codigo = $ProP_Codigo;
  }
   
  function setForM_Codigo($ForM_Codigo) {
    $this->ForM_Codigo = $ForM_Codigo;
  }

  function setEstU_Fecha($EstU_Fecha) {
    $this->EstU_Fecha = $EstU_Fecha;
  }

  function setEstU_FechaHoraCrea($EstU_FechaHoraCrea) {
    $this->EstU_FechaHoraCrea = $EstU_FechaHoraCrea;
  }

  function setEstU_UsuarioCrea($EstU_UsuarioCrea) {
    $this->EstU_UsuarioCrea = $EstU_UsuarioCrea;
  }

  function setEstU_Estado($EstU_Estado) {
    $this->EstU_Estado = $EstU_Estado;
  }

  public function insertar(){
    $campos = array("Usu_Codigo", "PueT_Codigo", "Tur_Codigo", "ProP_Codigo", "ForM_Codigo", "EstU_Fecha", "EstU_FechaHoraCrea", "EstU_UsuarioCrea", "EstU_Estado");
    $valores = array(
    array(
      $this->Usu_Codigo, 
      $this->PueT_Codigo, 
      $this->Tur_Codigo, 
      $this->ProP_Codigo, 
      $this->ForM_Codigo, 
      $this->EstU_Fecha, 
      $this->EstU_FechaHoraCrea, 
      $this->EstU_UsuarioCrea, 
      $this->EstU_Estado
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
    $sql =  "SELECT * FROM estaciones_usuarios WHERE EstU_Codigo = :cod";
    $parametros = array(":cod"=>$this->EstU_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setUsu_Codigo($res[1]);
      $this->setPueT_Codigo($res[2]);
      $this->setTur_Codigo($res[3]);
      $this->setProP_Codigo($res[4]);
      $this->setForM_Codigo($res[5]);
      $this->setEstU_Fecha($res[6]);
      $this->setEstU_FechaHoraCrea($res[7]);
      $this->setEstU_UsuarioCrea($res[8]);
      $this->setEstU_Estado($res[9]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Usu_Codigo", "PueT_Codigo", "Tur_Codigo", "ProP_Codigo", "ForM_Codigo", "EstU_Fecha", "EstU_FechaHoraCrea", "EstU_UsuarioCrea", "EstU_Estado");
    $valores = array($this->getUsu_Codigo(), $this->getPueT_Codigo(), $this->getTur_Codigo(), $this->getProP_Codigo(), $this->getForM_Codigo(), $this->getEstU_Fecha(), $this->getEstU_FechaHoraCrea(), $this->getEstU_UsuarioCrea(), $this->getEstU_Estado());
    $llaveprimaria = "EstU_Codigo";
    $valorllaveprimaria = $this->getEstU_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM estaciones_usuarios WHERE EstU_Codigo = :cod";
    $parametros = array(":cod"=>$this->EstU_Codigo);
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
  public function validarRegistroDiarioUsuariosEstaciones($fecha, $usuario){

    $parametros = array(":fec"=>$fecha, ":usu"=>$usuario);

    $sql = "SELECT COUNT(EstU_Codigo) AS Cant
    FROM estaciones_usuarios
    WHERE EstU_Estado = 1 AND EstU_Fecha = :fec AND Usu_Codigo = :usu";
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
   
  /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function validarRegistroDiarioUsuariosEstacionesTurno($fecha, $usuario){

    $parametros = array(":fec"=>$fecha, ":usu"=>$usuario);

    $sql = "SELECT DISTINCT Tur_Codigo
    FROM estaciones_usuarios
    WHERE EstU_Estado = 1 AND EstU_Fecha = :fec AND Usu_Codigo = :usu
    LIMIT 1";
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
    
  /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function hallarCodigoEstacionUsuarioCrear($puesto, $turno, $fecha, $usuario){

    $parametros = array(":pue"=>$puesto, ":tur"=>$turno, ":fec"=>$fecha, ":usu"=>$usuario);

    $sql = "SELECT EstU_Codigo
    FROM estaciones_usuarios
    WHERE EstU_Estado = 1 AND PueT_Codigo = :pue AND Tur_Codigo = :tur AND EstU_Fecha = :fec AND Usu_Codigo = :usu
    ORDER BY EstU_Codigo DESC
    LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
    
  /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function hallarEstacionUsuarioLogueoOperador($fecha, $usuario){

    $parametros = array(":fec"=>$fecha, ":usu"=>$usuario);

    $sql = "SELECT EstU_Codigo, Est_Codigo
    FROM estaciones_usuarios
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND puestos_trabajos.PueT_Estado = 1
    INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND estaciones_areas.EstA_Estado = 1
    WHERE EstU_Estado = 1 AND EstU_Fecha = :fec AND Usu_Codigo = :usu
    LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
    
    /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarPuestosTrabajoLoginUsuarioContinuar($fecha, $estacion){

    $parametros = array(":fec"=>$fecha, ":est"=>$estacion);

    $sql = "SELECT EstU_Codigo, usuarios.Usu_Codigo, estaciones.Est_Codigo, PueT_Nombre,
    CONCAT_WS(' ', usuarios.Usu_Nombres, usuarios.Usu_Apellidos) AS Usua, usuarios.Usu_Foto
    FROM estaciones_usuarios
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo
    INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND estaciones_areas.EstA_Estado = 1
    INNER JOIN estaciones ON estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND estaciones.Est_Estado = 1
    INNER JOIN usuarios ON estaciones_usuarios.Usu_Codigo = usuarios.Usu_Codigo
    WHERE EstU_Estado = 1 AND EstU_Fecha = :fec AND estaciones.Est_Codigo = :est ORDER BY PueT_Nombre ASC, Usua ASC";

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
  public function listarVariablesMaquinasOperadorPanel($estacionUsuario, $formato, $familia, $color, $planta){

    $parametros = array(":estu"=>$estacionUsuario, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":pla"=>$planta);

    $sql = "SELECT maquinas.Maq_Codigo, maquinas.Maq_Nombre, Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
    Var_Operador, maquinas.Are_Codigo, AgrC_Ordenamiento, AgrM_Nombre, AgrM_Orden, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23, Var_Orden, IF(Var_PuntoControl IS NOT NULL, Var_PuntoControl, 'NA') AS PC,
IF(Var_TipoVariable IS NOT NULL, Var_TipoVariable, 'NA') AS TV, maquinas.Maq_Orden
    FROM estaciones_usuarios 
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo 
    AND PueTEM_Estado = 1 
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo 
    AND EstM_Estado = 1 
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1 
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1 
    LEFT JOIN agrupaciones_configft ON variables.Var_Nombre = agrupaciones_configft.AgrC_Nombre AND AgrC_Estado = '1' 
    AND agrupaciones_configft.Pla_Codigo = :pla
    LEFT JOIN agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = '1'
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    WHERE estaciones_usuarios.EstU_Codigo = :estu 
    AND EstU_Estado = 1 AND Var_Estado = 1 AND Var_Familia = :fam AND (Var_Tipo = 2 OR Var_Tipo = 3) 
    AND Var_Color = :col AND For_Codigo = :for 
    UNION ALL
    SELECT maquinas.Maq_Codigo, maquinas.Maq_Nombre, Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
     Var_Operador, maquinas.Are_Codigo, AgrC_Ordenamiento, AgrM_Nombre, AgrM_Orden, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23, Var_Orden, IF(Var_PuntoControl IS NOT NULL, Var_PuntoControl, 'NA') AS PC,
IF(Var_TipoVariable IS NOT NULL, Var_TipoVariable, 'NA') AS TV, maquinas.Maq_Orden
    FROM estaciones_usuarios 
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo 
    AND PueTEM_Estado = 1 
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo 
    AND EstM_Estado = 1 
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1 
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    LEFT JOIN agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = '1'
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    LEFT JOIN agrupaciones_configft ON variables.Var_Nombre = agrupaciones_configft.AgrC_Nombre AND AgrC_Estado = '1' AND agrupaciones_configft.Pla_Codigo = :pla
     WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3) 
    AND Var_Origen = '3'
    ORDER BY PC ASC, TV ASC, Maq_Orden ASC, Maq_Nombre ASC, AgrC_Ordenamiento ASC, Var_Orden ASC";
    
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
  public function listarVariablesMaquinasOperadorPanelPokayoke($estacionUsuario, $formato, $familia, $color){

    $parametros = array(":estu"=>$estacionUsuario, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT maquinas.Maq_Codigo, maquinas.Maq_Nombre, Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
    Var_Operador, Maq_Orden, AgrM_Orden, AgrM_Nombre, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23
    FROM estaciones_usuarios 
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo 
    AND PueTEM_Estado = 1 
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo 
    AND EstM_Estado = 1 
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1 
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1 
    LEFT JOIN agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = '1'
    LEFT JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 
    AND Var_Familia = :fam AND Var_Tipo = 4 AND Var_Color = :col AND For_Codigo = :for
    UNION ALL
    SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, var_ValorTolerancia,
     Var_Operador, Maq_Orden, AgrM_Orden, AgrM_Nombre, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23
    FROM estaciones_usuarios 
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo 
    AND PueTEM_Estado = 1 
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo 
    AND EstM_Estado = 1 
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1 
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    LEFT JOIN agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = '1'
    LEFT JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 AND Var_Tipo = 4
    AND Var_Origen = '3'
    ORDER BY AgrM_Orden, Maq_Orden, Maq_Nombre, Var_Nombre ASC";

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
  public function listarFrecuenciasVariablesMaquinasOperadorPanel($estacionUsuario, $formato, $familia, $color){

    $parametros = array(":estu"=>$estacionUsuario, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT variables.Var_Codigo, Var_Nombre, Fre_Hora, Maq_Orden
    FROM estaciones_usuarios 
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo 
    AND PueTEM_Estado = 1 
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo 
    AND EstM_Estado = 1 
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1 
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1 
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo AND Fre_Estado = 1 
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 
    AND Var_Familia = :fam AND Var_Color = :col AND For_Codigo = :for AND Fre_Estado = 1 
    UNION ALL
    SELECT variables.Var_Codigo, Var_Nombre, Fre_Hora, Maq_Orden
    FROM estaciones_usuarios 
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo 
    AND PueTEM_Estado = 1 
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo 
    AND EstM_Estado = 1 
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1 
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo AND Fre_Estado = 1 
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1
    AND Var_Origen = '3'
    ORDER BY Maq_Orden ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
  //Toma Variables
     /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
   public function listarVariablesMaquinasOperadorPanelToma($estacionUsuario, $formato, $familia, $color, $planta){

    $parametros = array(":estu"=>$estacionUsuario, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":pla"=>$planta);

    $sql = "SELECT maquinas.Maq_Codigo, maquinas.Maq_Nombre, Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
    Var_Operador, Var_Tipo, AgrM_Nombre, AgrM_Orden, AgrC_Ordenamiento, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23, Var_Orden, IF(Var_PuntoControl IS NOT NULL, Var_PuntoControl, 'NA') AS PC,
    IF(Var_TipoVariable IS NOT NULL, Var_TipoVariable, 'NA') AS TV, maquinas.Maq_Orden
    FROM estaciones_usuarios
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo AND PueTEM_Estado = 1
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo AND EstM_Estado = 1
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    LEFT JOIN agrupaciones_configft ON variables.Var_Nombre = agrupaciones_configft.AgrC_Nombre AND AgrC_Estado = '1' 
    AND agrupaciones_configft.Pla_Codigo = :pla
    LEFT JOIN agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = '1' 
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 AND Var_Familia = :fam AND (Var_Tipo = 2 OR Var_Tipo = 3)
    AND Var_Color = :col AND For_Codigo = :for
    UNION ALL
    SELECT maquinas.Maq_Codigo, maquinas.Maq_Nombre, Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
     Var_Operador, Var_Tipo, AgrM_Nombre, AgrM_Orden, AgrC_Ordenamiento, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23, Var_Orden, IF(Var_PuntoControl IS NOT NULL, Var_PuntoControl, 'NA') AS PC,
     IF(Var_TipoVariable IS NOT NULL, Var_TipoVariable, 'NA') AS TV, maquinas.Maq_Orden
    FROM estaciones_usuarios 
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo 
    AND PueTEM_Estado = 1 
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo 
    AND EstM_Estado = 1 
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1 
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    LEFT JOIN agrupaciones_configft ON variables.Var_Nombre = agrupaciones_configft.AgrC_Nombre AND AgrC_Estado = '1' 
    AND agrupaciones_configft.Pla_Codigo = :pla
    LEFT JOIN agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = '1' 
    INNER JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
     WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3) 
    AND Var_Origen = '3'
    ORDER BY PC ASC, TV ASC, Maq_Orden ASC, Maq_Nombre ASC, AgrC_Ordenamiento ASC, Var_Orden ASC";

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
  public function listarFrecuenciasVariablesMaquinasOperadorPanelToma($estacionUsuario, $formato, $familia, $color, $hora){

    $parametros = array(":estu"=>$estacionUsuario, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":hor"=>$hora.":00");

    $sql = "SELECT variables.Var_Codigo, Var_Nombre, Fre_Hora, Maq_Nombre
    FROM estaciones_usuarios
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo AND PueTEM_Estado = 1
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo AND EstM_Estado = 1
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo AND Fre_Estado = 1
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 AND Var_Familia = :fam
    AND Var_Color = :col AND For_Codigo = :for AND Fre_Estado = 1 AND Fre_Hora = :hor
    UNION ALL
    SELECT variables.Var_Codigo, Var_Nombre, Fre_Hora, Maq_Nombre
    FROM estaciones_usuarios 
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo 
    AND PueTEM_Estado = 1 
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo 
    AND EstM_Estado = 1 
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1 
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo AND Fre_Estado = 1 
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1
    AND Var_Origen = '3' AND Fre_Hora = :hor
    ORDER BY Maq_Nombre ASC";

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
  public function listarPuestosTrabajoLoginUsuarioInicioFoto($fecha){

    $parametros = array(":fec"=>$fecha);

    $sql = "SELECT DISTINCT usuarios.Usu_Codigo, CONCAT_WS(' ', usuarios.Usu_Nombres, usuarios.Usu_Apellidos) AS Usua, usuarios.Usu_Foto, estaciones_usuarios.Tur_Codigo,
turnos.Tur_Nombre, turnos.Tur_HoraInicio, turnos.Tur_HoraFin
    FROM estaciones_usuarios
    INNER JOIN usuarios ON estaciones_usuarios.Usu_Codigo = usuarios.Usu_Codigo
    INNER JOIN turnos ON estaciones_usuarios.Tur_Codigo = turnos.Tur_Codigo
    WHERE EstU_Estado = 1 AND EstU_Fecha = :fec ORDER BY Usua ASC";

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
  public function listarPuestosTrabajosUsuarioLoginOpciones($usuario, $fecha, $turno){

    $parametros = array(":fec"=>$fecha, ":usu"=>$usuario, ":tur"=>$turno);

    $sql = "SELECT EstU_Codigo, usuarios.Usu_Codigo, estaciones.Est_Codigo, PueT_Nombre, areas.Are_Nombre, areas.Are_Nombre, areas.Are_Codigo, areas.Are_Tipo, usuarios.Pla_Codigo
    FROM estaciones_usuarios
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND estaciones_areas.EstA_Estado = 1
    INNER JOIN areas ON estaciones_areas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN estaciones ON estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND estaciones.Est_Estado = 1
    INNER JOIN usuarios ON estaciones_usuarios.Usu_Codigo = usuarios.Usu_Codigo
    WHERE EstU_Estado = 1 AND EstU_Fecha = :fec AND estaciones_usuarios.Usu_Codigo = :usu AND estaciones_usuarios.Tur_Codigo = :tur
    ORDER BY Are_Secuencia ASC, PueT_Nombre ASC";

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
 public function listarVariablesMaquinasOperadorPanelSinProgramaProduccion($estacionUsuario){

    $parametros = array(":estu"=>$estacionUsuario);

    $sql = "SELECT maquinas.Maq_Codigo, maquinas.Maq_Nombre, Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
    Var_Operador, Var_Tipo, maquinas.Are_Codigo, AgrM_Nombre, AgrM_Orden, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23, Var_Orden, IF(Var_PuntoControl IS NOT NULL, Var_PuntoControl, 'NA') AS PC,
    IF(Var_TipoVariable IS NOT NULL, Var_TipoVariable, 'NA') AS TV 
    FROM estaciones_usuarios
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo AND PueTEM_Estado = 1
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo AND EstM_Estado = 1
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    LEFT JOIN agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = '1' 
    LEFT JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3)
    ORDER BY PC ASC, TV ASC, AgrM_Orden, maquinas.Maq_Orden, Var_Orden ASC";

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
  public function listarVariablesMaquinasOperadorPanelSinProgramaProduccionMolienda($estacionUsuario){

    $parametros = array(":estu"=>$estacionUsuario);

    $sql = "SELECT maquinas.Maq_Codigo, maquinas.Maq_Nombre, Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
    Var_Operador, Var_Tipo, AgrM_Nombre, AgrM_Orden, maquinas.Are_Codigo, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23, Var_Orden, IF(Var_PuntoControl IS NOT NULL, Var_PuntoControl, 'NA') AS PC,
    IF(Var_TipoVariable IS NOT NULL, Var_TipoVariable, 'NA') AS TV, maquinas.Maq_Orden
    FROM estaciones_usuarios
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo AND PueTEM_Estado = 1
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo AND EstM_Estado = 1
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    LEFT JOIN agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = '1' 
    LEFT JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3)
    ORDER BY PC ASC, TV ASC, Maq_Orden ASC, Maq_Nombre ASC, Var_Orden ASC";

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
  public function listarVariablesMaquinasOperadorPanelSinProgramaProduccionPokayoke($estacionUsuario){

    $parametros = array(":estu"=>$estacionUsuario);

    $sql = "SELECT maquinas.Maq_Codigo, maquinas.Maq_Nombre, Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
    Var_Operador, AgrM_Nombre, AgrM_Orden, AgrM_Nombre, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23
    FROM estaciones_usuarios
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo AND PueTEM_Estado = 1
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo AND EstM_Estado = 1
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    LEFT JOIN agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = '1' 
    LEFT JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = '1'
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 AND Var_Tipo = 4
    ORDER BY AgrM_Orden, maquinas.Maq_Orden ASC, Var_Nombre ASC";

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
  public function listarFrecuenciasVariablesMaquinasOperadorPanelSinProgramaProduccion($estacionUsuario){

    $parametros = array(":estu"=>$estacionUsuario);

    $sql = "SELECT variables.Var_Codigo, Var_Nombre, Fre_Hora
    FROM estaciones_usuarios
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo AND PueTEM_Estado = 1
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo AND EstM_Estado = 1
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo AND Fre_Estado = 1
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 AND Fre_Estado = 1
    ORDER BY maquinas.Maq_Orden ASC";

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
  public function listarFrecuenciasVariablesMaquinasOperadorPanelTomaSinProgramaProduccion($estacionUsuario, $hora){

    $parametros = array(":estu"=>$estacionUsuario, ":hor"=>$hora.":00");

    $sql = "SELECT variables.Var_Codigo, Var_Nombre, Fre_Hora
    FROM estaciones_usuarios
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo AND PueTEM_Estado = 1
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo AND EstM_Estado = 1
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN variables ON maquinas.Maq_Codigo = variables.Maq_Codigo AND Var_Estado = 1
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo
    WHERE estaciones_usuarios.EstU_Codigo = :estu AND EstU_Estado = 1 AND Var_Estado = 1 AND Fre_Estado = 1 AND Fre_Hora = :hor
    ORDER BY maquinas.Maq_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
  /*
  Autor: Natalia Rodríguez
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarUsuariosLogeados($fecha){

    $parametros = array(":fec"=>$fecha);

    $sql = "SELECT DISTINCT u.Usu_Codigo, u.Usu_Documento, CONCAT_WS(' ', u.Usu_Nombres, u.Usu_Apellidos) AS Nombre, IF(Usu_Rol = 1, 'OPERARIO', 
           IF(u.Usu_Rol = 2, 'AUDITOR CALIDAD', 
            IF(u.Usu_Rol = 3, 'SUPERVISOR TURNO',
             IF(u.Usu_Rol = 4, 'SUPERVISOR ÁREA', 
              IF(u.Usu_Rol = 5, 'JEFE', 
               IF(u.Usu_Rol = 6, 'GERENTE', 
                IF(u.Usu_Rol = 7, 'COORDINADOR', 
                 IF(u.Usu_Rol = 8, 'GERENTE MEJORA CONTINUA', 
                  IF(u.Usu_Rol = 9, 'GERENTE TÉCNICO REGIONAL', 
                   IF(u.Usu_Rol = 10, 'DIRECTOR INDUSTRIAL',
                    IF(u.Usu_Rol = 11, 'ADMINISTRADOR',
                      IF(u.Usu_Rol = 12, 'ENCARGADO', 'No existe rol'
                      )
                    )
                   )
                  )
                 )
                )
               )
              )
             )
            )
           )
          ) as rol, p.Par_Nombre,
     u.Usu_Correo, u.Usu_TelMovil, EstU_Fecha, pla.Pla_Nombre
    FROM estaciones_usuarios e
    INNER JOIN usuarios u ON e.Usu_Codigo = u.Usu_Codigo AND u.Usu_Estado = 1
    INNER JOIN plantas pla ON u.Pla_Codigo = pla.Pla_Codigo
    LEFT JOIN parametros p ON u.Usu_Cargo = p.Par_Codigo
    WHERE EstU_Fecha = :fec
    ORDER BY Nombre ASC";

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
  public function updateInactivarEstacionUsuarioPrinpal($fecha, $usuario, $turno){

    $parametros = array(":fec"=>$fecha, ":usu"=>$usuario, ":tur"=>$turno);

    $sql = "UPDATE estaciones_usuarios SET EstU_Estado = 0 WHERE EstU_Estado = 1 AND EstU_Fecha = :fec AND estaciones_usuarios.Usu_Codigo = :usu
AND estaciones_usuarios.Tur_Codigo = :tur";

    $this->consultaSQL($sql, $parametros);
    $this->desconectar();
  }
    
  
  /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarUsuariosLogueados($planta, $agrupacion, $usuario, $fecha, $turno, $area){

    $parametros = array(":pla"=>$planta,":agr"=>$agrupacion,":usu"=>$usuario,":fec"=>$fecha);

    $sql = "SELECT EstU_Fecha, Tur_Nombre, CONCAT_WS(' ', Usu_Nombres,Usu_Apellidos) AS nombre, PueT_Nombre
    FROM estaciones_usuarios
    INNER JOIN usuarios ON 	estaciones_usuarios.Usu_Codigo = usuarios.Usu_Codigo AND Usu_Estado = 1
    INNER JOIN turnos ON estaciones_usuarios.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = 1
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN plantas ON usuarios.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND EstA_Estado = 1
    INNER JOIN agrupaciones_areas ON estaciones_areas.Are_Codigo = agrupaciones_areas.Are_Codigo
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND agrupaciones_areas.AgrA_Estado = 1
    INNER JOIN areas ON estaciones_areas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    WHERE EstU_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND plantas.Pla_Codigo = :pla AND agrupaciones.Agr_Codigo = :agr AND EstU_Fecha = :fec ";
    
    if($area != "-1"){
      $sql .= " AND (estaciones_areas.Are_Codigo = :are)";
      $parametros[':are'] = $area; 
    }
    
    if($turno != "-1"){
      $sql .= " AND (estaciones_usuarios.Tur_Codigo = :tur)";
      $parametros[':tur'] = $turno; 
    }
    
    $sql .= " GROUP BY EstU_Fecha, Tur_Nombre, nombre, PueT_Nombre
    ORDER BY EstU_Fecha DESC, Tur_Nombre ASC, areas.Are_Secuencia ASC";

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
  public function listarUsuariosLogueadosUnicos($planta, $agrupacion, $fecha, $turno, $area){

    $parametros = array(":pla"=>$planta,":agr"=>$agrupacion,":fec"=>$fecha);

    $sql = "SELECT EstU_Fecha, CONCAT_WS(' ', Usu_Nombres,Usu_Apellidos) AS nombre, PueT_Nombre, estaciones_usuarios.Tur_Codigo,
    usuarios.Usu_Codigo, For_Codigo, ProP_Familia, ProP_Color, turnos.Tur_Nombre
    FROM puestos_trabajos 
    INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND estaciones_areas.EstA_Estado = 1 
    INNER JOIN estaciones ON estaciones_areas.Est_Codigo = estaciones.Est_Codigo AND Est_Estado = '1'
    INNER JOIN agrupaciones_areas ON estaciones_areas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo 
    INNER JOIN areas ON estaciones_areas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1 
    LEFT JOIN estaciones_usuarios ON puestos_trabajos.PueT_Codigo = estaciones_usuarios.PueT_Codigo 
    AND estaciones_usuarios.EstU_Estado = 1 AND EstU_Fecha = :fec ";
    
    if($turno != "-1"){
      $sql .= " AND (estaciones_usuarios.Tur_Codigo = :tur) ";
      $parametros[':tur'] = $turno; 
    }
    
    $sql .= " LEFT JOIN programa_produccion ON estaciones_usuarios.ProP_Codigo = programa_produccion.ProP_Codigo
    LEFT JOIN usuarios ON estaciones_usuarios.Usu_Codigo = usuarios.Usu_Codigo AND Usu_Estado = 1
    LEFT JOIN turnos ON estaciones_usuarios.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = 1
    WHERE PueT_Estado = 1 AND areas.Pla_Codigo = :pla AND agrupaciones.Agr_Codigo = :agr ";
    
    if($area != "-1"){
      $sql .= " AND (estaciones_areas.Are_Codigo = :are) ";
      $parametros[':are'] = $area; 
    }

    $sql .= " ORDER BY areas.Are_Secuencia ASC, turnos.Tur_Nombre ASC ";

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
  public function listarUsuarioLoguadosRespuesta($planta, $turno, $area, $formato, $familia, $color, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $horaInicial3, $horaFinal3){

    $parametros = array(":pla"=>$planta,":for"=>$formato,":fam"=>$familia,":col"=>$color);
    
    $sql = "SELECT EstU_Fecha, CONCAT_WS(' ', Usu_Nombres,Usu_Apellidos) AS nombre, puet1.PueT_Nombre, estaciones_usuarios.Tur_Codigo, usuarios.Usu_Codigo, 
 
      ( 
      SELECT COUNT(respuestas.Res_Codigo) AS CantrESP1 
      FROM respuestas 
      INNER JOIN estaciones_usuarios estu1 ON respuestas.EstU_Codigo = estu1.EstU_Codigo 
      INNER JOIN puestos_trabajos puet2 ON estu1.PueT_Codigo = puet2.PueT_Codigo AND puet2.PueT_Estado = 1 
      INNER JOIN estaciones_areas est2 ON puet2.EstA_Codigo = est2.EstA_Codigo AND est2.EstA_Estado = 1 
      INNER JOIN estaciones estac2 ON est2.Est_Codigo = estac2.Est_Codigo AND estac2.Est_Estado = 1 
      INNER JOIN variables var2 ON respuestas.Var_Codigo = var2.Var_Codigo AND Var_Estado = 1 
      INNER JOIN maquinas maq2 ON var2.Maq_Codigo = maq2.Maq_Codigo 

      WHERE Res_Estado = 1 ";
    
    if($valFecha == "0"){
      $sql .= " AND respuestas.Res_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
      
      if($turno != "-1"){
        $sql .= " AND respuestas.Res_HoraSugerida BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }else{
        $sql .= " AND respuestas.Res_HoraSugerida >= :horini ";
        $parametros[':horini'] = $horaInicial3;
      }
      
    }else{
      $sql .= " AND ((respuestas.Res_Fecha = :fecini
      AND respuestas.Res_HoraSugerida BETWEEN :horini AND :horfin) OR (respuestas.Res_Fecha = :fecfin
      AND respuestas.Res_HoraSugerida BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    $sql .= " AND Res_HoraSugerida = fre1.Fre_Hora AND estu1.PueT_Codigo = puet1.PueT_Codigo AND 
      (var2.Var_Tipo = 2 OR var2.Var_Tipo = 3 OR var2.Var_Tipo = 4) AND maq2.Maq_Estado = 1 AND ( (var2.For_Codigo = :for AND var2.Var_Familia = :fam AND var2.Var_Color = :col) OR (var2.Var_Origen = '3') ) 

      ) AS CantResp, 

      estaciones_usuarios.EstU_Codigo, fre1.Fre_Hora, COUNT(var1.Var_Codigo) AS CantVar1 

      FROM variables var1 
      INNER JOIN maquinas maq1 ON var1.Maq_Codigo = maq1.Maq_Codigo  
      INNER JOIN frecuencias fre1 ON var1.Var_Codigo = fre1.Var_Codigo AND fre1.Fre_Estado = 1  
      INNER JOIN areas a1 ON maq1.Are_Codigo = a1.Are_Codigo AND Are_Estado = 1 AND a1.Pla_Codigo = :pla 
      INNER JOIN estaciones_areas est1 ON a1.Are_Codigo = est1.Are_Codigo AND est1.EstA_Estado = 1 
      INNER JOIN puestos_trabajos puet1 ON est1.EstA_Codigo = puet1.EstA_Codigo AND puet1.PueT_Estado = 1 
      INNER JOIN estaciones estac1 ON est1.Est_Codigo = estac1.Est_Codigo AND estac1.Est_Estado = 1 
      INNER JOIN puestos_trabajos_estaciones_maquinas ptem1 ON puet1.PueT_Codigo = ptem1.PueT_Codigo AND PueTEM_Estado = 1 
      INNER JOIN estaciones_maquinas estm1 ON ptem1.EstM_Codigo = estm1.EstM_Codigo AND EstM_estado = 1 AND maq1.Maq_Codigo = estm1.Maq_Codigo 

      LEFT JOIN estaciones_usuarios ON puet1.PueT_Codigo = estaciones_usuarios.PueT_Codigo AND estaciones_usuarios.EstU_Estado = 1 ";
    
      if($valFecha == "0"){
        $sql .= " AND estaciones_usuarios.EstU_Fecha = :fec ";
        $parametros[':fec'] = $fecha;

      }else{
        $sql .= " AND estaciones_usuarios.EstU_Fecha BETWEEN :fecini AND :fecfin ";
        $parametros[':fecini'] = $fecha;
        $parametros[':fecfin'] = $fechaFinal;
      }
    
      if($turno != "-1"){
        $sql .= " AND (estaciones_usuarios.Tur_Codigo = :tur) ";
        $parametros[':tur'] = $turno; 
      }
    
    
    $sql .=  "INNER JOIN usuarios ON estaciones_usuarios.Usu_Codigo = usuarios.Usu_Codigo AND Usu_Estado = 1 WHERE var1.Var_Estado = 1 AND (var1.Var_Tipo = 2 OR var1.Var_Tipo = 3 OR var1.Var_Tipo = 4) AND maq1.Maq_Estado = 1 AND ( (var1.For_Codigo = :for AND var1.Var_Familia = :fam AND var1.Var_Color = :col) 
      OR (var1.Var_Origen = '3') ) ";
    
    if($area != "-1"){
      $sql .= " AND (est1.Are_Codigo = :are)";
      $parametros[':are'] = $area; 
    }

    $sql .= " GROUP BY EstU_Fecha, fre1.Fre_Hora, a1.Are_Nombre, puet1.PueT_Nombre, estaciones_usuarios.Tur_Codigo, nombre ORDER BY Are_Nombre ASC";

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
  public function listarUsuarioLoguadosRespuestaNuevoRegNot($planta, $turno, $area, $formato, $familia, $color, $listaHoras, $cantidadHoras, $fecha, $fecha2){

    $parametros = array(":pla"=>$planta,":for"=>$formato,":fam"=>$familia,":col"=>$color,":fec"=>$fecha,":fec2"=>$fecha2);
    
    $sql = "SELECT EstU_Fecha, CONCAT_WS(' ', Usu_Nombres,Usu_Apellidos) AS nombre, puet1.PueT_Nombre, estaciones_usuarios.Tur_Codigo, usuarios.Usu_Codigo,
    estaciones_usuarios.EstU_Codigo, COUNT(var1.Var_Codigo) AS CantVar1,";
    
    $max = $cantidadHoras - 1;
    for($a = 0; $a < $cantidadHoras; $a++){
      $sql .= " SUM(IF(var1.Var_Hora".$listaHoras[$a]." IS NOT NULL, 1, 0)) AS H_".$listaHoras[$a];
      $sql2 .= " IF(var1.Var_Hora".$listaHoras[$a]." IS NOT NULL, 1, 0) ";
      
      if($a < $max){
        $sql .= ", ";
        $sql2 .= " + ";
      }
    }
    
    
    $sql .= " , SUM(".$sql2.") AS Total
    FROM variables var1
    INNER JOIN maquinas maq1 ON var1.Maq_Codigo = maq1.Maq_Codigo AND maq1.Maq_Estado = 1
    INNER JOIN areas a1 ON maq1.Are_Codigo = a1.Are_Codigo AND Are_Estado = 1 AND a1.Pla_Codigo = :pla
    INNER JOIN estaciones_areas est1 ON a1.Are_Codigo = est1.Are_Codigo AND est1.EstA_Estado = 1
    INNER JOIN puestos_trabajos puet1 ON est1.EstA_Codigo = puet1.EstA_Codigo AND puet1.PueT_Estado = 1
    INNER JOIN estaciones estac1 ON est1.Est_Codigo = estac1.Est_Codigo AND estac1.Est_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ptem1 ON puet1.PueT_Codigo = ptem1.PueT_Codigo AND PueTEM_Estado = 1
    INNER JOIN estaciones_maquinas estm1 ON ptem1.EstM_Codigo = estm1.EstM_Codigo AND EstM_estado = 1 AND maq1.Maq_Codigo = estm1.Maq_Codigo
    LEFT JOIN estaciones_usuarios ON puet1.PueT_Codigo = estaciones_usuarios.PueT_Codigo AND estaciones_usuarios.EstU_Estado = 1 AND estaciones_usuarios.EstU_Fecha = :fec2 ";
    
    if($turno != "-1"){
      $sql .= " AND (estaciones_usuarios.Tur_Codigo = :tur) ";
      $parametros[':tur'] = $turno;
    }
    
    $sql .= " INNER JOIN usuarios ON estaciones_usuarios.Usu_Codigo = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE var1.Var_FechaHoraCrea = :fec
    AND var1.For_Codigo = :for AND var1.Var_Familia = :fam AND var1.Var_Color = :col ";
    
    if($area != "-1"){
      $sql .= " AND (est1.Are_Codigo = :are)";
      $parametros[':are'] = $area; 
    }

    $sql .= " GROUP BY EstU_Fecha, a1.Are_Nombre, puet1.PueT_Nombre, estaciones_usuarios.Tur_Codigo, nombre
    ORDER BY Are_Nombre ASC";
    
//    echo "-- listarUsuarioLoguadosRespuestaNuevoRegNot --"."<br>".$sql;
//    var_dump($parametros);
//    echo "<br>";
    
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
  public function listarUsuarioLoguadosRespuestaNuevoRegNotRespuestas($planta, $formato, $familia, $color, $horaInicio, $horaFin){

    $parametros = array(":pla"=>$planta,":for"=>$formato,":fam"=>$familia,":col"=>$color,":horI"=>$horaInicio,":horF"=>$horaFin);
    
    $sql = "SELECT estu1.PueT_Codigo, puet2.PueT_Nombre, Res_HoraSugerida, COUNT(respuestas.Res_Codigo) AS CantrESP1, estu1.Usu_Codigo
    FROM respuestas
    INNER JOIN estaciones_usuarios estu1 ON respuestas.EstU_Codigo = estu1.EstU_Codigo
    INNER JOIN puestos_trabajos puet2 ON estu1.PueT_Codigo = puet2.PueT_Codigo AND puet2.PueT_Estado = 1
    INNER JOIN estaciones_areas est2 ON puet2.EstA_Codigo = est2.EstA_Codigo AND est2.EstA_Estado = 1
    INNER JOIN estaciones estac2 ON est2.Est_Codigo = estac2.Est_Codigo AND estac2.Est_Estado = 1
    INNER JOIN variables var2 ON respuestas.Var_Codigo = var2.Var_Codigo
    INNER JOIN maquinas maq2 ON var2.Maq_Codigo = maq2.Maq_Codigo AND maq2.Maq_Estado = 1
    INNER JOIN areas a1 ON maq2.Are_Codigo = a1.Are_Codigo AND a1.Are_Estado = 1 AND a1.Pla_Codigo = :pla
    WHERE Res_Estado = 1 AND CONCAT_WS(' ', respuestas.Res_Fecha, respuestas.Res_HoraSugerida) BETWEEN :horI AND :horF
    AND var2.For_Codigo = :for AND var2.Var_Familia = :fam AND var2.Var_Color = :col
    GROUP BY estu1.PueT_Codigo, puet2.PueT_Nombre, Res_HoraSugerida, estu1.Usu_Codigo
    ";
    
//    echo "-- listarUsuarioLoguadosRespuestaNuevoRegNotRespuestas --"."<br>".$sql;
//    var_dump($parametros);
//    echo "<br>";
    
    
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
   public function listarUsuarioLoguadosRespuestaMaPe($planta, $agrupacion, $turno, $area, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $horaInicial3, $horaFinal3){

    $parametros = array(":pla"=>$planta,":agr"=>$agrupacion);

    $sql = "SELECT EstU_Fecha, CONCAT_WS(' ', Usu_Nombres,Usu_Apellidos) AS nombre, pt2.PueT_Nombre, estaciones_usuarios.Tur_Codigo, 
    usuarios.Usu_Codigo, COUNT( DISTINCT Res_Codigo) AS CantResp, estaciones_usuarios.EstU_Codigo, Res_HoraSugerida, 
    (SELECT COUNT(DISTINCT variables.Var_Codigo)
    FROM variables
    INNER JOIN maquinas maq1 ON variables.Maq_Codigo = maq1.Maq_Codigo
    INNER JOIN frecuencias f1 ON variables.Var_Codigo = f1.Var_Codigo AND Fre_Estado = 1
    INNER JOIN respuestas res1 ON variables.Var_Codigo = res1.Var_Codigo AND Var_Estado = 1
    INNER JOIN areas a1 ON maq1.Are_Codigo = a1.Are_Codigo AND Are_Estado = 1
    INNER JOIN estaciones_usuarios estU1 ON res1.EstU_Codigo = estU1.EstU_Codigo
    INNER JOIN puestos_trabajos pt1 ON estU1.PueT_Codigo = pt1.PueT_Codigo AND PueT_Estado = 1
    WHERE  Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)
    AND Maq_Estado = 1
    AND Fre_Estado = 1 AND Var_Estado = 1 
    AND pt1.PueT_Nombre = pt2.PueT_Nombre 
    AND Fre_Hora = res2.Res_HoraSugerida
    ORDER BY maq1.Maq_Nombre ASC, Var_Nombre ASC
    LIMIT 1) as cantVariTotal
    FROM puestos_trabajos pt2
    INNER JOIN estaciones_areas ON pt2.EstA_Codigo = estaciones_areas.EstA_Codigo AND estaciones_areas.EstA_Estado = 1 
    INNER JOIN agrupaciones_areas ON estaciones_areas.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo 
    INNER JOIN areas ON estaciones_areas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1 
    INNER JOIN estaciones_usuarios ON pt2.PueT_Codigo = estaciones_usuarios.PueT_Codigo 
    AND estaciones_usuarios.EstU_Estado = 1 ";
    
    if($turno != "-1"){
      $sql .= " AND (estaciones_usuarios.Tur_Codigo = :tur) ";
      $parametros[':tur'] = $turno; 
    }
    
    $sql .= " INNER JOIN usuarios ON estaciones_usuarios.Usu_Codigo = usuarios.Usu_Codigo AND Usu_Estado = 1 
    INNER JOIN respuestas res2 ON estaciones_usuarios.EstU_Codigo = res2.EstU_Codigo 
    INNER JOIN variables var ON res2.Var_Codigo = var.Var_Codigo AND Var_Estado = 1
    WHERE PueT_Estado = 1 AND areas.Pla_Codigo = :pla AND agrupaciones.Agr_Codigo = :agr AND res2.Res_Estado = 1 ";
    
    if($valFecha == "0"){
      $sql .= " AND res2.Res_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
      
      if($turno != "-1"){
        $sql .= " AND res2.Res_HoraSugerida BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }else{
        $sql .= " AND res2.Res_HoraSugerida >= :horini ";
        $parametros[':horini'] = $horaInicial3;
      }
      
    }else{
      $sql .= " AND ((res2.Res_Fecha = :fecini
      AND res2.Res_HoraSugerida BETWEEN :horini AND :horfin) OR (res2.Res_Fecha = :fecfin
      AND res2.Res_HoraSugerida BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    if($area != "-1"){
      $sql .= " AND (estaciones_areas.Are_Codigo = :are)";
      $parametros[':are'] = $area; 
    }
    
    $sql .= " GROUP BY EstU_Fecha, nombre, PueT_Nombre, estaciones_usuarios.Tur_Codigo, usuarios.Usu_Codigo, estaciones_usuarios.EstU_Codigo, Res_HoraSugerida 
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
  public function listarUsuarioLoguadosRespuestaCalidadNuevo($planta, $turno, $area, $formato, $familia, $color, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $horaInicial3, $horaFinal3, $agrupacion){

    $parametros = array(":pla"=>$planta,":for"=>$formato,":fam"=>$familia,":col"=>$color, ":agr"=>$agrupacion);
    
    $sql = "SELECT EstU_Fecha, CONCAT_WS(' ', Usu_Nombres,Usu_Apellidos) AS nombre, puet1.PueT_Nombre, estaciones_usuarios.Tur_Codigo, usuarios.Usu_Codigo, 
    
    (
    SELECT COUNT(respuestas_calidad.ResC_Codigo) AS CantResCal 
    FROM respuestas_calidad 
    INNER JOIN estaciones_usuarios estu1 ON respuestas_calidad.EstU_Codigo = estu1.EstU_Codigo  
    INNER JOIN puestos_trabajos puet2 ON estu1.PueT_Codigo = puet2.PueT_Codigo AND puet2.PueT_Estado = 1  
    INNER JOIN estaciones_areas est2 ON puet2.EstA_Codigo = est2.EstA_Codigo AND est2.EstA_Estado = 1  
    INNER JOIN estaciones estac2 ON est2.Est_Codigo = estac2.Est_Codigo AND estac2.Est_Estado = 1  
    INNER JOIN calidad c1 ON respuestas_calidad.Cal_Codigo = c1.Cal_Codigo AND Cal_Estado = 1  

    INNER JOIN areas are2 ON c1.Are_Codigo = are2.Are_Codigo  

    WHERE ResC_Estado = 1 ";
    
    if($valFecha == "0"){
      $sql .= " AND respuestas_calidad.ResC_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
      
      if($turno != "-1"){
        $sql .= " AND respuestas_calidad.ResC_Hora BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }else{
        $sql .= " AND respuestas_calidad.ResC_Hora >= :horini ";
        $parametros[':horini'] = $horaInicial3;
      }
      
    }else{
      $sql .= " AND ((respuestas_calidad.ResC_Fecha = :fecini
      AND respuestas_calidad.ResC_Hora BETWEEN :horini AND :horfin) OR (respuestas_calidad.ResC_Fecha = :fecfin
      AND respuestas_calidad.ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    $sql .= " AND ResC_Hora = fre1.FreC_Hora AND estu1.PueT_Codigo = puet1.PueT_Codigo AND are2.Are_Estado = 1
      AND ( (respuestas_calidad.For_Codigo = :for AND respuestas_calidad.ResC_Familia = :fam AND respuestas_calidad.ResC_Color = :col) )  
      ) AS RespCal,

    estaciones_usuarios.EstU_Codigo, fre1.FreC_Hora, COUNT(cal1.Cal_Codigo) AS CantCal
    

      FROM calidad cal1
      INNER JOIN frecuencias_calidad fre1 ON cal1.Cal_Codigo = fre1.Cal_Codigo AND fre1.FreC_Estado = 1   
      INNER JOIN areas a1 ON cal1.Are_Codigo = a1.Are_Codigo AND a1.Are_Estado = 1 AND a1.Pla_Codigo = :pla  
      INNER JOIN estaciones_areas est1 ON a1.Are_Codigo = est1.Are_Codigo AND est1.EstA_Estado = 1  
      INNER JOIN puestos_trabajos puet1 ON est1.EstA_Codigo = puet1.EstA_Codigo AND puet1.PueT_Estado = 1  
      INNER JOIN estaciones estac1 ON est1.Est_Codigo = estac1.Est_Codigo AND estac1.Est_Estado = 1  
      INNER JOIN puestos_trabajos_estaciones_maquinas ptem1 ON puet1.PueT_Codigo = ptem1.PueT_Codigo AND PueTEM_Estado = 1  
      INNER JOIN agrupaciones_areas agrA1 ON a1.Are_Codigo = agrA1.Are_Codigo AND agrA1.AgrA_Estado = 1 
      INNER JOIN agrupaciones agr1 ON agrA1.Agr_Codigo = agr1.Agr_Codigo AND agr1.Agr_Estado = 1
      LEFT JOIN estaciones_usuarios ON puet1.PueT_Codigo = estaciones_usuarios.PueT_Codigo AND estaciones_usuarios.EstU_Estado = 1 ";
    
      if($valFecha == "0"){
        $sql .= " AND estaciones_usuarios.EstU_Fecha = :fec ";
        $parametros[':fec'] = $fecha;

      }else{
        $sql .= " AND estaciones_usuarios.EstU_Fecha BETWEEN :fecini AND :fecfin ";
        $parametros[':fecini'] = $fecha;
        $parametros[':fecfin'] = $fechaFinal;
      }
    
      if($turno != "-1"){
        $sql .= " AND (estaciones_usuarios.Tur_Codigo = :tur) ";
        $parametros[':tur'] = $turno; 
      }
    
    
    $sql .=  "INNER JOIN usuarios ON estaciones_usuarios.Usu_Codigo = usuarios.Usu_Codigo AND Usu_Estado = 1 


      WHERE agr1.Agr_Codigo = :agr AND cal1.Cal_Estado = 1 ";
    
    if($area != "-1"){
      $sql .= " AND (est1.Are_Codigo = :are)";
      $parametros[':are'] = $area; 
    }

    $sql .= " GROUP BY EstU_Fecha, fre1.FreC_Hora, puet1.PueT_Nombre, estaciones_usuarios.Tur_Codigo, nombre ORDER BY Are_Nombre ASC, FreC_Hora ASC, estaciones_usuarios.Tur_Codigo ASC";
    
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
  public function listarUsuarioLoguadosRespuestaCalidad($planta, $agrupacion, $fecha, $turno, $area){

    $parametros = array(":pla"=>$planta,":agr"=>$agrupacion,":fec"=>$fecha);

    $sql = "SELECT EstU_Fecha, CONCAT_WS(' ', Usu_Nombres,Usu_Apellidos) AS nombre, PueT_Nombre, estaciones_usuarios.Tur_Codigo,
    usuarios.Usu_Codigo, COUNT(ResC_Codigo) AS CantResp, 
    estaciones_usuarios.EstU_Codigo, ResC_Hora,
    (SELECT COUNT(c1.Cal_Codigo) AS Cant
    FROM calidad c1
    INNER JOIN areas a1 ON c1.Are_Codigo = a1.Are_Codigo AND Are_Estado = 1  
    INNER JOIN agrupaciones_areas agrA1 ON a1.Are_Codigo = agrA1.Are_Codigo AND agrA1.AgrA_Estado = 1 
    INNER JOIN agrupaciones agr1 ON agrA1.Agr_Codigo = agr1.Agr_Codigo AND agr1.Agr_Estado = 1 
    INNER JOIN frecuencias_calidad ON c1.Cal_Codigo = frecuencias_calidad.Cal_Codigo 
    WHERE agr1.Agr_Codigo = :agr AND Cal_Estado = 1 AND frecuencias_calidad.FreC_Estado = 1 AND FreC_Hora = ResC_Hora
    GROUP BY FreC_Hora LIMIT 1) AS CantFrecuencia
    FROM puestos_trabajos   
    INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND estaciones_areas.EstA_Estado = 1   
    INNER JOIN agrupaciones_areas ON estaciones_areas.Are_Codigo = agrupaciones_areas.Are_Codigo  
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo   
    INNER JOIN areas ON estaciones_areas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1   
    INNER JOIN estaciones_usuarios ON puestos_trabajos.PueT_Codigo = estaciones_usuarios.PueT_Codigo 
    AND estaciones_usuarios.EstU_Estado = 1   
    AND EstU_Fecha = :fec ";
    
    if($turno != "-1"){
      $sql .= " AND (estaciones_usuarios.Tur_Codigo = :tur) ";
      $parametros[':tur'] = $turno; 
    }
    
    $sql .= " INNER JOIN usuarios ON estaciones_usuarios.Usu_Codigo = usuarios.Usu_Codigo AND Usu_Estado = 1 
    INNER JOIN respuestas_calidad ON estaciones_usuarios.EstU_Codigo = respuestas_calidad.EstU_Codigo 
    WHERE PueT_Estado = 1 AND areas.Pla_Codigo = :pla AND agrupaciones.Agr_Codigo = :agr AND respuestas_calidad.ResC_Estado = 1 AND ResC_Fecha = :fec ";
    
    if($area != "-1"){
      $sql .= " AND (estaciones_areas.Are_Codigo = :are)";
      $parametros[':are'] = $area; 
    }
    
    $sql .= " GROUP BY EstU_Fecha, nombre, PueT_Nombre, estaciones_usuarios.Tur_Codigo, usuarios.Usu_Codigo, estaciones_usuarios.EstU_Codigo, ResC_Hora  
    ORDER BY areas.Are_Secuencia ASC";
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
      /*
  Autor: Natalia Rodríguez
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function buscarArchivoAgruCFTOperadorPanel($planta, $formato, $familia, $color){

    $parametros = array(":pla"=>$planta, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT DISTINCT AgrC_Nombre, AgrC_Archivo, v.Var_Codigo 
    FROM estaciones_usuarios 
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON puestos_trabajos.PueT_Codigo = puestos_trabajos_estaciones_maquinas.PueT_Codigo 
    AND PueTEM_Estado = 1 
    INNER JOIN estaciones_maquinas ON puestos_trabajos_estaciones_maquinas.EstM_Codigo = estaciones_maquinas.EstM_Codigo AND EstM_Estado = 1 
    INNER JOIN maquinas ON estaciones_maquinas.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1 
    INNER JOIN variables v ON maquinas.Maq_Codigo = v.Maq_Codigo AND Var_Estado = 1 
    LEFT JOIN detalle_ficha_tecnica dft ON v.DetFT_Codigo = dft.DetFT_Codigo AND DetFT_Estado = 1 
    LEFT JOIN agrupaciones_variables_configft avc ON dft.AgrVCon_Codigo = avc.AgrVCon_Codigo AND AgrVCon_Estado = 1 
    LEFT JOIN agrupaciones_configft acft ON avc.AgrC_Codigo = acft.AgrC_Codigo AND AgrC_Estado = 1 
    WHERE AgrC_Estado = 1 AND 
    AgrC_Archivo IS NOT NULL AND acft.Pla_Codigo = :pla AND Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3) 
    AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col";
    

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
  public function listarCodigosEliminarPT($usuario,$puestoTrabajo,$turno, $fechaHoy, $fechaManana, $fechaHoraCrea){

    $parametros = array(":usu"=>$usuario,":pue"=>$puestoTrabajo,":tur"=>$turno,":fecH"=>$fechaHoy,":fecM"=>$fechaManana,":fecC"=>$fechaHoraCrea);

    $sql = "SELECT EstU_Codigo
    FROM estaciones_usuarios
    WHERE Usu_Codigo = :usu AND PueT_Codigo = :pue AND Tur_Codigo = :tur AND EstU_Fecha BETWEEN :fecH AND :fecM AND EstU_Estado= '1' AND EstU_FechaHoraCrea = :fecC";

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
  public function buscarEstUsuHealthCheck($puestoTrabajo, $fecha, $turno){

    $parametros = array(":pue"=>$puestoTrabajo,":fec"=>$fecha,":tur"=>$turno);

    $sql = "SELECT EstU_Codigo
    FROM estaciones_usuarios
    WHERE EstU_Estado = 1 AND PueT_Codigo = :pue AND Tur_Codigo = :tur AND EstU_Fecha = :fec
    ORDER BY EstU_Codigo DESC
    LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>
