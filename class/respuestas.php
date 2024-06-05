<?php
require_once('basedatos.php');

  class respuestas extends basedatos {
    private $Res_Codigo;
    private $Var_Codigo;
    private $EstU_Codigo;
    private $Res_ValorTexto;
    private $Res_ValorNum;
    private $Res_Fecha;
    private $Res_HoraReal;
    private $Res_HoraSugerida;
    private $Res_ColorEspecificacionFichaTecnica;
    private $Res_ColorEspecificacionPuestaPunto;
    private $Res_Tipo;
    private $Res_Vacio;
    private $Res_UsuarioCrea;
    private $Res_Estado;
    private $Res_Alerta;
    private $Res_PuestaPunto;
    private $Res_OperacionControl;
    private $Res_FechaReal;

  function __construct($Res_Codigo = NULL, $Var_Codigo = NULL, $EstU_Codigo = NULL, $Res_ValorTexto = NULL, $Res_ValorNum = NULL, $Res_Fecha = NULL, $Res_HoraReal = NULL, $Res_HoraSugerida = NULL, $Res_ColorEspecificacionFichaTecnica = NULL, $Res_ColorEspecificacionPuestaPunto = NULL, $Res_Tipo = NULL, $Res_Vacio = NULL, $Res_UsuarioCrea = NULL, $Res_Estado = NULL, $Res_Alerta = NULL, $Res_PuestaPunto = NULL, $Res_OperacionControl = NULL, $Res_FechaReal = NULL) {
    $this->Res_Codigo = $Res_Codigo;
    $this->Var_Codigo = $Var_Codigo;
    $this->EstU_Codigo = $EstU_Codigo;
    $this->Res_ValorTexto = $Res_ValorTexto;
    $this->Res_ValorNum = $Res_ValorNum;
    $this->Res_Fecha = $Res_Fecha;
    $this->Res_HoraReal = $Res_HoraReal;
    $this->Res_HoraSugerida = $Res_HoraSugerida;
    $this->Res_ColorEspecificacionFichaTecnica = $Res_ColorEspecificacionFichaTecnica;
    $this->Res_ColorEspecificacionPuestaPunto = $Res_ColorEspecificacionPuestaPunto;
    $this->Res_Tipo = $Res_Tipo;
    $this->Res_Vacio = $Res_Vacio;
    $this->Res_UsuarioCrea = $Res_UsuarioCrea;
    $this->Res_Estado = $Res_Estado;
    $this->Res_Alerta = $Res_Alerta;
    $this->Res_PuestaPunto = $Res_PuestaPunto;
    $this->Res_OperacionControl = $Res_OperacionControl;
    $this->Res_FechaReal = $Res_FechaReal;
    $this->tabla = "respuestas";
  }

  function getRes_Codigo() {
    return $this->Res_Codigo;
  }

  function getVar_Codigo() {
    return $this->Var_Codigo;
  }

  function getEstU_Codigo() {
    return $this->EstU_Codigo;
  }

  function getRes_ValorTexto() {
    return $this->Res_ValorTexto;
  }

  function getRes_ValorNum() {
    return $this->Res_ValorNum;
  }

  function getRes_Fecha() {
    return $this->Res_Fecha;
  }

  function getRes_HoraReal() {
    return $this->Res_HoraReal;
  }

  function getRes_HoraSugerida() {
    return $this->Res_HoraSugerida;
  }

  function getRes_ColorEspecificacionFichaTecnica() {
    return $this->Res_ColorEspecificacionFichaTecnica;
  }

  function getRes_ColorEspecificacionPuestaPunto() {
    return $this->Res_ColorEspecificacionPuestaPunto;
  }

  function getRes_Tipo() {
    return $this->Res_Tipo;
  }

  function getRes_Vacio() {
    return $this->Res_Vacio;
  }

  function getRes_UsuarioCrea() {
    return $this->Res_UsuarioCrea;
  }

  function getRes_Estado() {
    return $this->Res_Estado;
  }

  function getRes_Alerta() {
    return $this->Res_Alerta;
  }

  function getRes_PuestaPunto() {
    return $this->Res_PuestaPunto;
  }

  function getRes_OperacionControl() {
    return $this->Res_OperacionControl;
  }

  function getRes_FechaReal() {
    return $this->Res_FechaReal;
  }

  function setRes_Codigo($Res_Codigo) {
    $this->Res_Codigo = $Res_Codigo;
  }

  function setVar_Codigo($Var_Codigo) {
    $this->Var_Codigo = $Var_Codigo;
  }

  function setEstU_Codigo($EstU_Codigo) {
    $this->EstU_Codigo = $EstU_Codigo;
  }

  function setRes_ValorTexto($Res_ValorTexto) {
    $this->Res_ValorTexto = $Res_ValorTexto;
  }

  function setRes_ValorNum($Res_ValorNum) {
    $this->Res_ValorNum = $Res_ValorNum;
  }

  function setRes_Fecha($Res_Fecha) {
    $this->Res_Fecha = $Res_Fecha;
  }

  function setRes_HoraReal($Res_HoraReal) {
    $this->Res_HoraReal = $Res_HoraReal;
  }

  function setRes_HoraSugerida($Res_HoraSugerida) {
    $this->Res_HoraSugerida = $Res_HoraSugerida;
  }

  function setRes_ColorEspecificacionFichaTecnica($Res_ColorEspecificacionFichaTecnica) {
    $this->Res_ColorEspecificacionFichaTecnica = $Res_ColorEspecificacionFichaTecnica;
  }

  function setRes_ColorEspecificacionPuestaPunto($Res_ColorEspecificacionPuestaPunto) {
    $this->Res_ColorEspecificacionPuestaPunto = $Res_ColorEspecificacionPuestaPunto;
  }

  function setRes_Tipo($Res_Tipo) {
    $this->Res_Tipo = $Res_Tipo;
  }

  function setRes_Vacio($Res_Vacio) {
    $this->Res_Vacio = $Res_Vacio;
  }

  function setRes_UsuarioCrea($Res_UsuarioCrea) {
    $this->Res_UsuarioCrea = $Res_UsuarioCrea;
  }

  function setRes_Estado($Res_Estado) {
    $this->Res_Estado = $Res_Estado;
  }

  function setRes_Alerta($Res_Alerta) {
    $this->Res_Alerta = $Res_Alerta;
  }

  function setRes_PuestaPunto($Res_PuestaPunto) {
    $this->Res_PuestaPunto = $Res_PuestaPunto;
  }

  function setRes_OperacionControl($Res_OperacionControl) {
    $this->Res_OperacionControl = $Res_OperacionControl;
  }

  function setRes_FechaReal($Res_FechaReal) {
    $this->Res_FechaReal = $Res_FechaReal;
  }

  public function insertar(){
    $campos = array("Var_Codigo", "EstU_Codigo", "Res_ValorTexto", "Res_ValorNum", "Res_Fecha", "Res_HoraReal", "Res_HoraSugerida", "Res_ColorEspecificacionFichaTecnica", "Res_ColorEspecificacionPuestaPunto", "Res_Tipo", "Res_Vacio", "Res_UsuarioCrea", "Res_Estado", "Res_Alerta", "Res_PuestaPunto", "Res_OperacionControl", "Res_FechaReal");
    $valores = array(
    array( 
      $this->Var_Codigo, 
      $this->EstU_Codigo, 
      $this->Res_ValorTexto, 
      $this->Res_ValorNum, 
      $this->Res_Fecha, 
      $this->Res_HoraReal, 
      $this->Res_HoraSugerida, 
      $this->Res_ColorEspecificacionFichaTecnica, 
      $this->Res_ColorEspecificacionPuestaPunto, 
      $this->Res_Tipo, 
      $this->Res_Vacio, 
      $this->Res_UsuarioCrea, 
      $this->Res_Estado, 
      $this->Res_Alerta, 
      $this->Res_PuestaPunto, 
      $this->Res_OperacionControl, 
      $this->Res_FechaReal
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
    $sql =  "SELECT * FROM respuestas WHERE Res_Codigo = :cod";
    $parametros = array(":cod"=>$this->Res_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setVar_Codigo($res[1]);
      $this->setEstU_Codigo($res[2]);
      $this->setRes_ValorTexto($res[3]);
      $this->setRes_ValorNum($res[4]);
      $this->setRes_Fecha($res[5]);
      $this->setRes_HoraReal($res[6]);
      $this->setRes_HoraSugerida($res[7]);
      $this->setRes_ColorEspecificacionFichaTecnica($res[8]);
      $this->setRes_ColorEspecificacionPuestaPunto($res[9]);
      $this->setRes_Tipo($res[10]);
      $this->setRes_Vacio($res[11]);
      $this->setRes_UsuarioCrea($res[12]);
      $this->setRes_Estado($res[13]);
      $this->setRes_Alerta($res[14]);
      $this->setRes_PuestaPunto($res[15]);
      $this->setRes_OperacionControl($res[16]);
      $this->setRes_FechaReal($res[17]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Var_Codigo", "EstU_Codigo", "Res_ValorTexto", "Res_ValorNum", "Res_Fecha", "Res_HoraReal", "Res_HoraSugerida", "Res_ColorEspecificacionFichaTecnica", "Res_ColorEspecificacionPuestaPunto", "Res_Tipo", "Res_Vacio", "Res_UsuarioCrea", "Res_Estado", "Res_Alerta", "Res_PuestaPunto", "Res_OperacionControl", "Res_FechaReal");
    $valores = array( $this->getVar_Codigo(), $this->getEstU_Codigo(), $this->getRes_ValorTexto(), $this->getRes_ValorNum(), $this->getRes_Fecha(), $this->getRes_HoraReal(), $this->getRes_HoraSugerida(), $this->getRes_ColorEspecificacionFichaTecnica(), $this->getRes_ColorEspecificacionPuestaPunto(), $this->getRes_Tipo(), $this->getRes_Vacio(), $this->getRes_UsuarioCrea(), $this->getRes_Estado(), $this->getRes_Alerta(), $this->getRes_PuestaPunto(), $this->getRes_OperacionControl(), $this->getRes_FechaReal());
    $llaveprimaria = "Res_Codigo";
    $valorllaveprimaria = $this->getRes_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM respuestas WHERE Res_Codigo = :cod";
    $parametros = array(":cod"=>$this->Res_Codigo);
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
  public function respuestasVariablesEstacionesUsuarios($puestoTrabajo, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha){

    $parametros = array(":pueT"=>$puestoTrabajo);

    $sql = "SELECT respuestas.Res_Codigo, respuestas.EstU_Codigo, Var_Codigo, Res_HoraSugerida, Res_ValorNum, PlaA_Codigo, PlaA_ObservacionesOperario, Res_Alerta, PlaA_Mantenimiento, PlaA_Mant_TarjetaRoja, PlaA_Mant_AvisoSAP, PlaA_Mant_Observaciones, PlaA_Mant_Fecha, PlaA_Mant_usuarioSAP, Res_ColorEspecificacionFichaTecnica, Res_ColorEspecificacionPuestaPunto, Res_Vacio
    FROM respuestas
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo
    LEFT JOIN planes_acciones ON respuestas.Res_Codigo = planes_acciones.Res_Codigo AND PlaA_Estado = 1
    WHERE Res_Estado = 1 AND estaciones_usuarios.PueT_Codigo = :pueT ";
    
    if($valFecha == "0"){
      $sql .= " AND Res_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
    }else{
      $sql .= " AND ((Res_Fecha = :fecini
      AND Res_HoraSugerida BETWEEN :horini AND :horfin) OR (Res_Fecha = :fecfin
      AND Res_HoraSugerida BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
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
  public function respuestasVariablesEstacionesUsuariosExiste($puestoTrabajo, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $usuario){

    $parametros = array(":pueT"=>$puestoTrabajo, ":usu"=>$usuario);

    $sql = "SELECT COUNT(Res_Codigo) AS CantRes
    FROM respuestas
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo
    WHERE Res_Estado = 1 AND estaciones_usuarios.PueT_Codigo = :pueT AND estaciones_usuarios.Usu_Codigo = :usu ";
    
    if($valFecha == "0"){
      $sql .= " AND Res_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
    }else{
      $sql .= " AND ((Res_Fecha = :fecini
      AND Res_HoraSugerida BETWEEN :horini AND :horfin) OR (Res_Fecha = :fecfin
      AND Res_HoraSugerida BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }

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
  public function hallarCodigoRespuestaTomaVariablesOperador($variable, $estacion, $usuario){

    $parametros = array(":var"=>$variable, ":estu"=>$estacion, ":usu"=>$usuario);

    $sql = "SELECT Res_Codigo
    FROM respuestas
    WHERE Var_Codigo = :var AND EstU_Codigo = :estu AND Res_UsuarioCrea = :usu
    ORDER BY Res_Codigo DESC
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
//    , $turHoraInicio, $turHoraFin
  public function listarVariablesCriticas($fechaInicial, $fechaFinal, $area, $operario, $alerta, $planta, $turno, $turHoraInicio, $turHoraFin, $sino, $fechaHoraInicial, $fechaHoraFinal){

    $parametros = array(":fecI"=>$fechaInicial, ":fecF"=>$fechaFinal,":fecHI"=>$fechaHoraInicial, ":fecHF"=>$fechaHoraFinal);

    $sql = "SELECT respuestas.Res_Codigo, f.For_Nombre, v.Var_Familia, v.Var_Color, Res_Fecha, Res_HoraSugerida, Res_HoraReal,
    CONCAT_WS(' ', u.Usu_Nombres, u.Usu_Apellidos) AS nombre, v.Var_Nombre, v.Var_ValorControl,
    IF(v.Var_Operador = 1, '>=', 
           IF(v.Var_Operador = 2, '<=',
            IF(v.Var_Operador = 3, '+-', ''
            )
           )
          ) AS operador, 
    v.Var_ValorTolerancia, Res_ValorNum, pa.PlaA_ObservacionesOperario,  PlaA_ObservacionesSupervisor, pa.PlaA_Codigo,
    Par_Nombre, v.Var_Operador, a.Are_Nombre,Res_Alerta, CONCAT_WS(' ', u1.Usu_Nombres, u1.Usu_Apellidos) AS supervisor, v.Var_Tipo, maq.Maq_Nombre, Res_Vacio, respuestas.EstU_Codigo, v.Maq_Codigo, estaciones_usuarios.ProP_Codigo, CONCAT_WS(' ', Res_Fecha, Res_HoraSugerida) AS FecComp
    FROM respuestas
    LEFT JOIN variables v ON respuestas.Var_Codigo = v.Var_Codigo 
    LEFT JOIN formatos f ON v.For_Codigo = f.For_Codigo AND f.For_Estado = 1
    LEFT JOIN usuarios u ON Res_UsuarioCrea = u.Usu_Codigo AND u.Usu_Estado = 1
    LEFT JOIN planes_acciones pa ON respuestas.Res_Codigo = pa.Res_Codigo AND pa.PlaA_Estado = 1
    LEFT JOIN usuarios u1 ON pa.PlaA_Supervisor = u1.Usu_Codigo AND u1.Usu_Estado = 1
    LEFT JOIN parametros par ON pa.PlaA_Prioridad = par.Par_Codigo AND Par_Estado = 1
    INNER JOIN maquinas maq ON v.Maq_Codigo = maq.Maq_Codigo
    INNER JOIN areas a ON maq.Are_Codigo = a.Are_Codigo
    INNER JOIN plantas ON a.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = '1'
    WHERE (Res_Estado = 1 OR Res_Estado = 9) AND Res_Fecha BETWEEN :fecI AND :fecF AND
(Res_ValorNum IS NOT NULL OR (Res_ValorNum IS NULL AND Res_Vacio = 1) ) ";
    
    if($operario != ""){ 
      $pri2 = 1; 
      foreach($operario as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Res_UsuarioCrea = :res".$pri2." "; 
        $parametros[':res'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
   if($alerta != "-1"){ 
      $sql .= " AND ( Res_Alerta = :ale ) ";
      $parametros[':ale'] = $alerta; 
    }
    
    if($planta != ""){ 
      $sql .= " AND ( plantas.Pla_Codigo = :pla ) ";
      $parametros[':pla'] = $planta; 
    }
    
    if ( $area != "" ) {
      $pri = 1;
      foreach ( $area as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " a.Are_Codigo = :are".$pri." ";
        $parametros[ ':are' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }
    
    if($turno != "-1"){ 
      $sql .= " AND ( Res_HoraReal BETWEEN :ini AND :fin ) ";
      $parametros[':ini'] = $turHoraInicio; 
      $parametros[':fin'] = $turHoraFin; 
    }
    
    if($sino != "-1"){ 
      $sql .= " AND v.Var_Tipo = 4 AND Res_ValorNum = :sino ";
      $parametros[':sino'] = $sino;  
    }

    $sql .= "HAVING FecComp BETWEEN :fecHI AND :fecHF
    ORDER BY FecComp ASC, par.Par_Codigo ASC";
   
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
  public function usuariosRegistroRespuesta(){

    $sql = "SELECT DISTINCT Res_UsuarioCrea, CONCAT_WS(' ', usuarios.Usu_Nombres, usuarios.Usu_Apellidos) AS nombre
    FROM respuestas
    INNER JOIN usuarios ON respuestas.Res_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE Res_Estado = 1
    ORDER BY nombre ASC";

    $this->consultaSQL($sql);
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
  public function listarVariablesMaquinasPanelSupervisor($areas, $cantAreas, $formato, $familia, $color, $puesto, $planta, $fecha){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":pue"=>$puesto, ":pla"=>$planta, ":fec"=>$fecha);

    $sql = "SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, variables.Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl,
    Var_ValorTolerancia, Var_Operador, Are_Codigo, For_Codigo, Var_Familia, Var_Color, PueT_Codigo, maquinas.Are_Codigo,maquinas.Maq_Orden, AgrC_Ordenamiento 
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo 
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND EstM_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo 
    AND puestos_trabajos_estaciones_maquinas.PueTEM_Estado = 1 
    LEFT JOIN agrupaciones_configft ON variables.Var_Nombre = agrupaciones_configft.AgrC_Nombre AND AgrC_Estado = '1' AND agrupaciones_configft.Pla_Codigo = :pla
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 1) AND For_Codigo = :for 
    AND Var_Familia = :fam AND Var_Color = :col AND PueT_Codigo = :pue AND Var_FechaHoraCrea = :fec ";
    
     if($cantAreas != "0"){ 
      $pri2 = 1; 
       $sql .= " AND maquinas.Are_Codigo IN (";
      for($i = 0; $i<$cantAreas; $i++){
        $sql .= " :are".$pri2."a"." "; 
        if($pri2 < $cantAreas){
          $sql .= ",";
        }
        $parametros[':are'.$pri2."a"] = $areas[$i]; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " UNION ALL
    SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, variables.Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl,
     Var_ValorTolerancia, Var_Operador, Are_Codigo, For_Codigo, Var_Familia, Var_Color, PueT_Codigo, maquinas.Are_Codigo,maquinas.Maq_Orden,
     AgrC_Ordenamiento 
    FROM variables 
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo 
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo 
    LEFT JOIN agrupaciones_configft ON variables.Var_Nombre = agrupaciones_configft.AgrC_Nombre AND AgrC_Estado = '1' AND agrupaciones_configft.Pla_Codigo = :pla
    WHERE Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 1) AND Maq_Estado = 1 
    AND PueT_Codigo = :pue AND Var_Estado = 1
    AND Var_Origen = '3' ";
    
    if($cantAreas != "0"){ 
      $pri2 = 1; 
       $sql .= " AND maquinas.Are_Codigo IN (";
      for($i = 0; $i<$cantAreas; $i++){
        $sql .= " :are".$pri2." "; 
         if($pri2 < $cantAreas){
          $sql .= ",";
        }
        $parametros[':are'.$pri2] = $areas[$i]; 
        $pri2++; 
      } 
      $sql .= " )"; 
    } 
    
    
    $sql .= " ORDER BY Maq_Orden ASC, Maq_Nombre ASC, AgrC_Ordenamiento ASC, Var_Nombre ASC";
    
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
  public function listarVariablesMaquinasPanelSupervisorConNuevasFrecuencias($areas, $cantAreas, $formato, $familia, $color, $puesto, $planta, $fecha){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":pue"=>$puesto, ":pla"=>$planta, ":fec"=>$fecha);

    $sql = "SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, variables.Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl,
    Var_ValorTolerancia, Var_Operador, Are_Codigo, For_Codigo, Var_Familia, Var_Color, PueT_Codigo, maquinas.Are_Codigo, maquinas.Maq_Orden, AgrC_Ordenamiento, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23, Var_Orden, IF(Var_PuntoControl IS NOT NULL, Var_PuntoControl, 'NA') AS PC,
    IF(Var_TipoVariable IS NOT NULL, Var_TipoVariable, 'NA') AS TV, Var_Origen, Var_FechaHoraCrea 
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo 
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND EstM_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo 
    AND puestos_trabajos_estaciones_maquinas.PueTEM_Estado = 1 
    LEFT JOIN agrupaciones_configft ON variables.Var_Nombre = agrupaciones_configft.AgrC_Nombre AND AgrC_Estado = '1' AND agrupaciones_configft.Pla_Codigo = :pla
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 1) AND For_Codigo = :for 
    AND Var_Familia = :fam AND Var_Color = :col AND PueT_Codigo = :pue AND Var_FechaHoraCrea = :fec ";
    
     if($cantAreas != "0"){ 
      $pri2 = 1; 
       $sql .= " AND maquinas.Are_Codigo IN (";
      for($i = 0; $i<$cantAreas; $i++){
        $sql .= " :are".$pri2."a"." "; 
        if($pri2 < $cantAreas){
          $sql .= ",";
        }
        $parametros[':are'.$pri2."a"] = $areas[$i]; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " UNION ALL
    SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, variables.Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl,
     Var_ValorTolerancia, Var_Operador, Are_Codigo, For_Codigo, Var_Familia, Var_Color, PueT_Codigo, maquinas.Are_Codigo,maquinas.Maq_Orden,
     AgrC_Ordenamiento, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23, Var_Orden, IF(Var_PuntoControl IS NOT NULL, Var_PuntoControl, 'NA') AS PC,
    IF(Var_TipoVariable IS NOT NULL, Var_TipoVariable, 'NA') AS TV, Var_Origen, Var_FechaHoraCrea
    FROM variables 
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo 
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo 
    LEFT JOIN agrupaciones_configft ON variables.Var_Nombre = agrupaciones_configft.AgrC_Nombre AND AgrC_Estado = '1' AND agrupaciones_configft.Pla_Codigo = :pla
    WHERE Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 1) AND Maq_Estado = 1 
    AND PueT_Codigo = :pue AND Var_Estado = 1
    AND Var_Origen = '3' ";
    
    if($cantAreas != "0"){ 
      $pri2 = 1; 
       $sql .= " AND maquinas.Are_Codigo IN (";
      for($i = 0; $i<$cantAreas; $i++){
        $sql .= " :are".$pri2." "; 
         if($pri2 < $cantAreas){
          $sql .= ",";
        }
        $parametros[':are'.$pri2] = $areas[$i]; 
        $pri2++; 
      } 
      $sql .= " )"; 
    } 
    
    
    $sql .= " ORDER BY PC ASC, TV ASC, Maq_Orden ASC, Maq_Nombre ASC, AgrC_Ordenamiento ASC, Var_Orden ASC";
    
//    if($_SESSION['CP_Usuario'] == "1"){
//      echo "------"."<br>".$sql;
//      var_dump($parametros);
//      echo "<br>";
//    }
    
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
  public function hallarFechaConfiguracionVariables($areas, $cantAreas, $formato, $familia, $color, $puesto, $planta, $fecha){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":pue"=>$puesto, ":pla"=>$planta, ":fec"=>$fecha." 23:59:59");

    $sql = "SELECT DISTINCT Var_FechaHoraCrea
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND EstM_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo AND puestos_trabajos_estaciones_maquinas.PueTEM_Estado = 1
    LEFT JOIN agrupaciones_configft ON variables.Var_Nombre = agrupaciones_configft.AgrC_Nombre AND AgrC_Estado = '1' AND agrupaciones_configft.Pla_Codigo = :pla
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4) AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND PueT_Codigo = :pue AND Var_FechaHoraCrea <= :fec ";
    
     if($cantAreas != "0"){ 
      $pri2 = 1; 
       $sql .= " AND maquinas.Are_Codigo IN (";
      for($i = 0; $i<$cantAreas; $i++){
        $sql .= " :are".$pri2."a"." "; 
        if($pri2 < $cantAreas){
          $sql .= ",";
        }
        $parametros[':are'.$pri2."a"] = $areas[$i]; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY Var_FechaHoraCrea DESC LIMIT 1";
    
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
  public function listarVariablesMaquinasPanelSupervisorMaPe($area, $puesto){

    $parametros = array(":are"=>$area, ":pue"=>$puesto);

    $sql = "SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, variables.Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
    Var_Operador, Are_Codigo, For_Codigo, Var_Familia, Var_Color, PueT_Codigo, maquinas.Are_Codigo
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo
    WHERE maquinas.Are_Codigo = :are AND Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3)
    AND Maq_Estado = 1 AND PueT_Codigo = :pue AND Var_Origen = '3'
    ORDER BY PueT_Codigo ASC, maquinas.Maq_Nombre ASC, Var_Nombre ASC";
    
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
  public function respuestasVariablesPanelSupervisor($area, $formato, $familia, $color, $fecha){

    $parametros = array(":are"=>$area, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":fec"=>$fecha);

    $sql = "SELECT respuestas.Res_Codigo, respuestas.EstU_Codigo, variables.Var_Codigo, Res_HoraSugerida, Res_ValorNum, PlaA_Codigo, PlaA_ObservacionesOperario, Res_Alerta
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo AND Var_Estado = 1
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    LEFT JOIN planes_acciones ON respuestas.Res_Codigo = planes_acciones.Res_Codigo AND PlaA_Estado = 1
    WHERE maquinas.Are_Codigo = :are AND Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3)
    AND Maq_Estado = 1 AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND Res_Estado = 1
    AND Res_Fecha = :fec";

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
  public function respuestasVariablesPanelSupervisorTodasVariables($areas, $cantAreas, $formato, $familia, $color, $fechaInicial, $fechaFinal, $puesto){ 
 
    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal, ":pue"=>$puesto); 
 
    $sql = "SELECT respuestas.Res_Codigo, respuestas.EstU_Codigo, variables.Var_Codigo, Res_HoraSugerida, Res_ValorNum, PlaA_Codigo, PlaA_ObservacionesOperario, Res_Alerta, Res_Fecha, Res_Vacio 
    FROM respuestas 
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo 
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo 
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND EstM_Estado = 1  
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo  
    AND puestos_trabajos_estaciones_maquinas.PueTEM_Estado = 1 
    LEFT JOIN planes_acciones ON respuestas.Res_Codigo = planes_acciones.Res_Codigo AND PlaA_Estado = 1 
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4) 
    AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND Res_Estado = 1 
    AND Res_Fecha BETWEEN :fecini AND :fecfin AND PueT_Codigo = :pue "; 
     
//    if($cantAreas != "0"){  
//      $pri2 = 1;  
//       $sql .= " AND maquinas.Are_Codigo IN ("; 
//      for($i = 0; $i<$cantAreas; $i++){ 
//        $sql .= " :are".$pri2."a"." ";  
//        if($pri2 < $cantAreas){ 
//          $sql .= ","; 
//        } 
//        $parametros[':are'.$pri2."a"] = $areas[$i];  
//        $pri2++;  
//      }  
//      $sql .= " )";  
//    } 
       
    $sql .= " UNION ALL 
    SELECT respuestas.Res_Codigo, respuestas.EstU_Codigo, variables.Var_Codigo, Res_HoraSugerida, Res_ValorNum, PlaA_Codigo,  
    PlaA_ObservacionesOperario, Res_Alerta, Res_Fecha, Res_Vacio  
    FROM respuestas  
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo  
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo 
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND EstM_Estado = 1  
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo  
    AND puestos_trabajos_estaciones_maquinas.PueTEM_Estado = 1 
    LEFT JOIN planes_acciones ON respuestas.Res_Codigo = planes_acciones.Res_Codigo AND PlaA_Estado = 1  
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4) AND Var_Origen = '3' 
    AND Res_Estado = 1 AND Res_Fecha BETWEEN :fecini AND :fecfin AND PueT_Codigo = :pue "; 
     
//    if($cantAreas != "0"){  
//      $pri2 = 1;  
//       $sql .= " AND maquinas.Are_Codigo IN ("; 
//      for($i = 0; $i<$cantAreas; $i++){ 
//        $sql .= " :are".$pri2." ";  
//         if($pri2 < $cantAreas){ 
//          $sql .= ","; 
//        } 
//        $parametros[':are'.$pri2] = $areas[$i];  
//        $pri2++;  
//      }  
//      $sql .= " )";  
//    } 
    
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
  public function respuestasVariablesPanelSupervisorTodasVariablesTS($areas, $cantAreas, $formato, $familia, $color, $fechaInicial, $fechaFinal, $puesto){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal, ":pue"=>$puesto);

    $sql = "SELECT respuestas.Res_Codigo, respuestas.EstU_Codigo, variables.Var_Codigo, Res_HoraSugerida, Res_ValorNum, PlaA_Codigo, PlaA_ObservacionesOperario, Res_Alerta, Res_Fecha, Res_Vacio
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND estaciones_maquinas.EstM_Estado = 1    
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo AND PueTEM_Estado = 1
    LEFT JOIN planes_acciones ON respuestas.Res_Codigo = planes_acciones.Res_Codigo AND PlaA_Estado = 1
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)
    AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND Res_Estado = 1
    AND Res_Fecha BETWEEN :fecini AND :fecfin AND PueT_Codigo = :pue";
    
//    if($cantAreas != "0"){ 
//      $pri2 = 1; 
//       $sql .= " AND maquinas.Are_Codigo IN (";
//      for($i = 0; $i<$cantAreas; $i++){
//        $sql .= " :are".$pri2."a"." "; 
//        if($pri2 < $cantAreas){
//          $sql .= ",";
//        }
//        $parametros[':are'.$pri2."a"] = $areas[$i]; 
//        $pri2++; 
//      } 
//      $sql .= " )"; 
//    }
      
    $sql .= " UNION ALL
    SELECT respuestas.Res_Codigo, respuestas.EstU_Codigo, variables.Var_Codigo, Res_HoraSugerida, Res_ValorNum, PlaA_Codigo, 
    PlaA_ObservacionesOperario, Res_Alerta, Res_Fecha, Res_Vacio 
    FROM respuestas 
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo 
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo 
    LEFT JOIN planes_acciones ON respuestas.Res_Codigo = planes_acciones.Res_Codigo AND PlaA_Estado = 1 
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4) AND Var_Origen = '3'
    AND Res_Estado = 1 AND Res_Fecha BETWEEN :fecini AND :fecfin";
    
//    if($cantAreas != "0"){ 
//      $pri2 = 1; 
//       $sql .= " AND maquinas.Are_Codigo IN (";
//      for($i = 0; $i<$cantAreas; $i++){
//        $sql .= " :are".$pri2." "; 
//         if($pri2 < $cantAreas){
//          $sql .= ",";
//        }
//        $parametros[':are'.$pri2] = $areas[$i]; 
//        $pri2++; 
//      } 
//      $sql .= " )"; 
//    }

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
  public function hallarFechaConfiguracionVariablesRegistroNotificacionesPS($areas, $cantAreas, $formato, $familia, $color, $planta, $fecha){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":pla"=>$planta, ":fec"=>$fecha." 23:59:59");

    $sql = "SELECT DISTINCT Var_FechaHoraCrea
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND EstM_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo AND puestos_trabajos_estaciones_maquinas.PueTEM_Estado = 1
    LEFT JOIN agrupaciones_configft ON variables.Var_Nombre = agrupaciones_configft.AgrC_Nombre AND AgrC_Estado = '1' AND agrupaciones_configft.Pla_Codigo = :pla
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4) AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND Var_FechaHoraCrea <= :fec ";
    
     if($cantAreas != "0"){ 
      $pri2 = 1; 
       $sql .= " AND maquinas.Are_Codigo IN (";
      for($i = 0; $i<$cantAreas; $i++){
        $sql .= " :are".$pri2."a"." "; 
        if($pri2 < $cantAreas){
          $sql .= ",";
        }
        $parametros[':are'.$pri2."a"] = $areas[$i]; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY Var_FechaHoraCrea DESC LIMIT 1";
    
//    echo "-- hallarFechaConfiguracionVariablesCambioNuevo --"."<br>".$sql;
//    var_dump($parametros);
//    echo "<br>";
    
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
  public function respuestasVariablesPanelSupervisorTodasVariablesMaPe($area, $fechaInicial, $fechaFinal){

    $parametros = array(":are"=>$area, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT respuestas.Res_Codigo, respuestas.EstU_Codigo, variables.Var_Codigo, Res_HoraSugerida, Res_ValorNum, PlaA_Codigo, PlaA_ObservacionesOperario, Res_Alerta, Res_Fecha, Res_Vacio
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    LEFT JOIN planes_acciones ON respuestas.Res_Codigo = planes_acciones.Res_Codigo AND PlaA_Estado = 1
    WHERE maquinas.Are_Codigo = :are AND (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)
    AND Maq_Estado = 1 AND Res_Estado = 1 AND Var_Origen = '3'
    AND Res_Fecha BETWEEN :fecini AND :fecfin";

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
  public function listarFrecuenciasVariablesMaquinasPanelSupervisor($area, $formato, $familia, $color){

    $parametros = array(":are"=>$area, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT variables.Var_Codigo, Var_Nombre, Fre_Hora
   FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo AND Var_Estado = 1
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo AND Fre_Estado = 1
    WHERE maquinas.Are_Codigo = :are AND Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3)
    AND Maq_Estado = 1 AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND Fre_Estado = 1
    ORDER BY maquinas.Maq_Nombre ASC, Var_Nombre ASC";

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
  public function listarFrecuenciasVariablesMaquinasPanelSupervisorTodasVariables($area, $formato, $familia, $color){

    $parametros = array(":are"=>$area, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT variables.Var_Codigo, Var_Nombre, Fre_Hora
   FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo AND Var_Estado = 1
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo AND Fre_Estado = 1
    WHERE maquinas.Are_Codigo = :are AND Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)
    AND Maq_Estado = 1 AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND Fre_Estado = 1
    ORDER BY maquinas.Maq_Nombre ASC, Var_Nombre ASC";

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
  public function listarFrecuenciasVariablesMaquinasPanelSupervisorTodasVariablesNuevoSupe($areas, $cantAreas, $formato, $familia, $color, $puesto, $fecha){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":pue"=>$puesto, ":fec"=>$fecha);

    $sql = "SELECT variables.Var_Codigo, Var_Nombre, Fre_Hora, Maq_Nombre 
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND EstM_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo AND puestos_trabajos_estaciones_maquinas.PueTEM_Estado = 1 
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)
    AND Maq_Estado = 1 AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND puestos_trabajos_estaciones_maquinas.PueT_Codigo = :pue AND Var_FechaHoraCrea = :fec ";
      
//    if($cantAreas != "0"){ 
//      $pri2 = 1; 
//       $sql .= " AND maquinas.Are_Codigo IN (";
//      for($i = 0; $i<$cantAreas; $i++){
//        $sql .= " :are".$pri2."a"." "; 
//        if($pri2 < $cantAreas){
//          $sql .= ",";
//        }
//        $parametros[':are'.$pri2."a"] = $areas[$i]; 
//        $pri2++; 
//      } 
//      $sql .= " )"; 
//    }
    
    $sql .= " UNION ALL
    SELECT variables.Var_Codigo, Var_Nombre, Fre_Hora, Maq_Nombre
    FROM variables 
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo 
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND EstM_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo AND puestos_trabajos_estaciones_maquinas.PueTEM_Estado = 1 
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo
    WHERE (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)
    AND Var_Origen = '3' AND puestos_trabajos_estaciones_maquinas.PueT_Codigo = :pue AND Var_Estado = 1 ";
    
//    if($cantAreas != "0"){ 
//      $pri2 = 1; 
//       $sql .= " AND maquinas.Are_Codigo IN (";
//      for($i = 0; $i<$cantAreas; $i++){
//        $sql .= " :are".$pri2." "; 
//         if($pri2 < $cantAreas){
//          $sql .= ",";
//        }
//        $parametros[':are'.$pri2] = $areas[$i]; 
//        $pri2++; 
//      } 
//      $sql .= " )"; 
//    }
    
    $sql .= " ORDER BY Maq_Nombre ASC, Var_Nombre ASC";

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
  public function listarFrecuenciasVariablesMaquinasPanelSupervisorTodasVariablesNuevoSupeMaPe($area){

    $parametros = array(":are"=>$area);

    $sql = "SELECT variables.Var_Codigo, Var_Nombre, Fre_Hora
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo AND Fre_Estado = 1
    WHERE maquinas.Are_Codigo = :are AND Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)
    AND Maq_Estado = 1 AND Fre_Estado = 1 AND Var_Estado = 1 AND Var_Origen = '3'
    ORDER BY maquinas.Maq_Nombre ASC, Var_Nombre ASC";

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
  public function listarVariablesPokayokeMaquinasPanelSupervisor($area, $formato, $familia, $color){

    $parametros = array(":are"=>$area, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, variables.Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
    Var_Operador, Are_Codigo
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo AND Var_Estado = 1
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    WHERE maquinas.Are_Codigo = :are AND Var_Estado = 1 AND Var_Tipo = 4
    AND Maq_Estado = 1 AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND Res_Estado = 1
    ORDER BY maquinas.Maq_Nombre ASC, Var_Nombre ASC";

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
  public function listarVariablesPokayokeMaquinasPanelSupervisorPuesto($areas, $cantAreas, $formato, $familia, $color, $puesto, $fecha){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":pue"=>$puesto, ":fec"=>$fecha);

    $sql = "SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, variables.Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
    Var_Operador, Are_Codigo, For_Codigo, Var_Familia, Var_Color, PueT_Codigo
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND estaciones_maquinas.EstM_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo AND PueTEM_Estado = 1
    WHERE Var_Tipo = 4
    AND Maq_Estado = 1 AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND PueT_Codigo = :pue AND Var_FechaHoraCrea = :fec ";
    
    if($cantAreas != "0"){ 
      $pri2 = 1; 
       $sql .= " AND maquinas.Are_Codigo IN (";
      for($i = 0; $i<$cantAreas; $i++){
        $sql .= " :are".$pri2."a"." "; 
        if($pri2 < $cantAreas){
          $sql .= ",";
        }
        $parametros[':are'.$pri2."a"] = $areas[$i]; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .=" UNION ALL
    SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, variables.Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl,
    Var_ValorTolerancia, Var_Operador, Are_Codigo, For_Codigo, Var_Familia, Var_Color, PueT_Codigo 
    FROM variables 
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1 
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND estaciones_maquinas.EstM_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo
    AND PueTEM_Estado = 1 WHERE Var_Tipo = 4 AND Maq_Estado = 1 AND PueT_Codigo = :pue
    AND Var_Origen = '3' AND Var_Estado = 1 ";
    
    if($cantAreas != "0"){ 
      $pri2 = 1; 
       $sql .= " AND maquinas.Are_Codigo IN (";
      for($i = 0; $i<$cantAreas; $i++){
        $sql .= " :are".$pri2." "; 
         if($pri2 < $cantAreas){
          $sql .= ",";
        }
        $parametros[':are'.$pri2] = $areas[$i]; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY Maq_Nombre ASC, Var_Nombre ASC";

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
  public function listarVariablesPokayokeMaquinasPanelSupervisorPuestoMaPe($area, $puesto){

    $parametros = array(":are"=>$area, ":pue"=>$puesto);

    $sql = "SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, variables.Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
    Var_Operador, Are_Codigo, For_Codigo, Var_Familia, Var_Color, PueT_Codigo
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND estaciones_maquinas.EstM_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo AND PueTEM_Estado = 1
    WHERE maquinas.Are_Codigo = :are AND Var_Estado = 1 AND Var_Tipo = 4
    AND Maq_Estado = 1 AND PueT_Codigo = :pue AND Var_Origen = '3'
    ORDER BY maquinas.Maq_Nombre ASC, Var_Nombre ASC";

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
  public function listarVariablesCriticasDiasPUnicas($planta, $area, $fechaIni, $fechaFina, $familia, $agrupacion){

    $parametros = array(":pla"=>$planta,":ini"=>$fechaIni,":fin"=>$fechaFina,":agr"=>$agrupacion);

    $sql = "SELECT v.Var_Nombre , v.Maq_Codigo, a.Are_Codigo, Var_Familia, Var_Color
    FROM respuestas
    LEFT JOIN variables v ON respuestas.Var_Codigo = v.Var_Codigo
    INNER JOIN maquinas maq ON v.Maq_Codigo = maq.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN areas a ON maq.Are_Codigo = a.Are_Codigo AND Are_Estado = 1
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo
    INNER JOIN plantas ON a.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    WHERE Res_Estado = 1 AND Res_Fecha BETWEEN :ini AND :fin
    AND plantas.Pla_Codigo = :pla AND agrupaciones.Agr_Codigo = :agr ";
    
    if($area != ""){ 
      $pri = 1; 
      foreach($area as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " a.Are_Codigo = :are".$pri." "; 
        $parametros[':are'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
//    if($familia != ""){ 
//      $sql .= " AND ( v.Var_Familia = :fam ) ";
//      $parametros[':fam'] = $familia; 
//    }
    
    if($familia != ""){ 
      $pri2 = 1; 
      foreach($familia as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " v.Var_Familia = :fam".$pri2." "; 
        $parametros[':fam'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " GROUP BY v.Var_Nombre , v.Maq_Codigo, Var_Familia, Var_Color ORDER BY Res_Fecha ASC, Res_HoraSugerida ASC,a.Are_Nombre  ASC, Var_Tipo ASC, maq.Maq_Nombre ASC";
    
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
  public function listarVariablesCriticasDiasP($planta, $area, $fechaIni, $fechaFina, $familia, $agrupacion){

    $parametros = array(":pla"=>$planta,":ini"=>$fechaIni,":fin"=>$fechaFina,":agr"=>$agrupacion);

    $sql = "SELECT v.Var_Nombre, Res_ValorNum, Res_HoraSugerida, Res_Fecha, v.Var_Operador, Var_ValorControl, Var_ValorTolerancia, Var_Tipo, v.Maq_Codigo, maq.Maq_Nombre, maq.Are_Codigo, a.Are_Nombre, Var_Familia, Var_Color
    FROM respuestas
    LEFT JOIN variables v ON respuestas.Var_Codigo = v.Var_Codigo
    INNER JOIN maquinas maq ON v.Maq_Codigo = maq.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN areas a ON maq.Are_Codigo = a.Are_Codigo AND Are_Estado = 1
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo
    INNER JOIN plantas ON a.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    WHERE Res_Estado = 1 AND Res_Fecha BETWEEN :ini AND :fin 
    AND plantas.Pla_Codigo = :pla AND agrupaciones.Agr_Codigo = :agr ";
    
    if($area != ""){ 
      $pri = 1; 
      foreach($area as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " a.Are_Codigo = :are".$pri." "; 
        $parametros[':are'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
//    if($familia != ""){ 
//      $sql .= " AND ( v.Var_Familia = :fam ) ";
//      $parametros[':fam'] = $familia; 
//    }
    
     if($familia != ""){ 
      $pri2 = 1; 
      foreach($familia as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " v.Var_Familia = :fam".$pri2." "; 
        $parametros[':fam'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY Res_Fecha ASC, Res_HoraSugerida ASC,a.Are_Nombre  ASC, Var_Tipo ASC, maq.Maq_Nombre ASC";
    
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
  public function listarValoresMaximosMinimos($area, $formato, $familia, $color, $fecha, $horaInicial, $horaFinal, $variable, $turno){

    $parametros = array(":are"=>$area, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":fec"=>$fecha, ":cod"=>$variable);

    $sql = "SELECT DISTINCT variables.Var_Codigo, MIN(Res_ValorNum) AS minVal, MAX(Res_ValorNum) AS maxVal
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    LEFT JOIN planes_acciones ON respuestas.Res_Codigo = planes_acciones.Res_Codigo AND PlaA_Estado = 1
    WHERE maquinas.Are_Codigo = :are AND (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)
    AND Maq_Estado = 1 AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND Res_Estado = 1
     AND respuestas.Var_Codigo = :cod AND Res_Fecha = :fec ";
    
    if($turno != "-1"){
      $sql .= " AND (Res_HoraSugerida BETWEEN :ini AND :fin) "; 
      $parametros[':ini'] = $horaInicial;
      $parametros[':fin'] = $horaFinal;
    }
    
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
  public function listarValoresMaximosMinimosPanelSupervisor($area, $formato, $familia, $color, $variable, $fechaInicial, $fechaFinal){

    $parametros = array(":are"=>$area, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":cod"=>$variable, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT DISTINCT variables.Var_Codigo, MIN(Res_ValorNum) AS minVal, MAX(Res_ValorNum) AS maxVal    
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo    
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    LEFT JOIN planes_acciones ON respuestas.Res_Codigo = planes_acciones.Res_Codigo AND PlaA_Estado = 1    
    WHERE maquinas.Are_Codigo = :are AND (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)
    AND Maq_Estado = 1 AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND Res_Estado = 1 AND respuestas.Var_Codigo = :cod AND Res_Fecha BETWEEN :fecini AND :fecfin HAVING minVal IS NOT NULL UNION ALL
    SELECT DISTINCT variables.Var_Codigo, MIN(Res_ValorNum) AS minVal, MAX(Res_ValorNum) AS maxVal     
    FROM respuestas 
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo     
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo 
    LEFT JOIN planes_acciones ON respuestas.Res_Codigo = planes_acciones.Res_Codigo AND PlaA_Estado = 1     
    WHERE maquinas.Are_Codigo = :are AND (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4) AND Maq_Estado = 1     
    AND Res_Estado = 1 AND variables.Var_Origen = '3'
    AND respuestas.Var_Codigo = :cod AND Res_Fecha BETWEEN :fecini AND :fecfin HAVING minVal IS NOT NULL ";
    
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
  public function listarValoresMaximosMinimosPanelSupervisorMaPe($area, $variable, $fechaInicial, $fechaFinal){

    $parametros = array(":are"=>$area, ":cod"=>$variable, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT DISTINCT variables.Var_Codigo, MIN(Res_ValorNum) AS minVal, MAX(Res_ValorNum) AS maxVal
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    LEFT JOIN planes_acciones ON respuestas.Res_Codigo = planes_acciones.Res_Codigo AND PlaA_Estado = 1
    WHERE maquinas.Are_Codigo = :are AND (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4)
    AND Maq_Estado = 1 AND Res_Estado = 1 AND Var_Origen = '3'
     AND respuestas.Var_Codigo = :cod AND Res_Fecha BETWEEN :fecini AND :fecfin ";
    
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
  public function listarGestionVariables($referenciaConsulta, $formato, $familia, $color, $horaInicial3, $horaFinal3, $usuario, $turno, $area, $maquina, $puestoT,$fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha){

    $sql = "SELECT Res_Codigo, respuestas.EstU_Codigo, Var_Nombre, variables.Maq_Codigo, maquinas.Are_Codigo, Res_ValorNum, Res_HoraSugerida,
    Are_Nombre, estaciones_usuarios.Usu_Codigo,
    Var_ValorControl, Var_ValorTolerancia, Var_Operador, CONCAT_WS(' ',usuarios.Usu_Nombres,usuarios.Usu_Apellidos) AS nombres, Res_Fecha, maquinas.Maq_Nombre, PueT_Nombre, variables.For_Codigo, variables.Var_Familia, variables.Var_Color, formatos.For_Nombre
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN usuarios ON respuestas.Res_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1
    INNER JOIN formatos ON  variables.For_Codigo = formatos.For_Codigo
    WHERE For_Estado = 1 ";
    
    if($usuario != ""){ 
      $pri = 1; 
      foreach($usuario as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " estaciones_usuarios.Usu_Codigo = :usu".$pri." "; 
        $parametros[':usu'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    if($valFecha == "0"){
      $sql .= " AND respuestas.Res_Fecha BETWEEN :fecini AND :fecfin ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      
      if($turno != "-1"){
        $sql .= " AND Res_HoraSugerida BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }
      
    }else{
      $sql .= " AND ((respuestas.Res_Fecha = :fecini
      AND Res_HoraSugerida BETWEEN :horini AND :horfin) OR (respuestas.Res_Fecha = :fecfin
      AND Res_HoraSugerida BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    if($area != ""){ 
      $pri2 = 1; 
      foreach($area as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " areas.Are_Codigo = :are".$pri2." "; 
        $parametros[':are'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    if($maquina != ""){ 
      $pri3 = 1; 
      foreach($maquina as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " variables.Maq_Codigo = :maq".$pri3." "; 
        $parametros[':maq'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    if($puestoT != ""){ 
      $pri4 = 1; 
      foreach($puestoT as $registro4){ 
        if($pri4 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " puestos_trabajos.PueT_Codigo = :pue".$pri4." "; 
        $parametros[':pue'.$pri4] = $registro4; 
        $pri4++; 
      } 
      $sql .= " )"; 
    }
    
     if($referenciaConsulta != ""){ 
       
      foreach($referenciaConsulta as $registro8){ 

        if($registro8 == "0"){ 
          $sql .= " AND (";  
        }else{
         $sql .= " OR ";
       }
        
        $sql .= " (variables.For_Codigo = :for".$registro8." "; 
        $parametros[':for'.$registro8] = $formato[$registro8]; 
      
        $sql .= " AND variables.Var_Familia = :fam".$registro8." "; 
        $parametros[':fam'.$registro8] = $familia[$registro8]; 
        
        $sql .= " AND variables.Var_Color = :col".$registro8." ".")"; 
        $parametros[':col'.$registro8] = $color[$registro8]; 
      }
      $sql .= " ) "; 
    }
    
    $sql .= " ORDER BY maquinas.Maq_Nombre ASC, Res_HoraSugerida ASC";

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
  public function cantidadReferenciaProduccion($referenciaConsulta, $formato, $familia, $color, $horaInicial3, $horaFinal3, $usuario, $turno, $area, $maquina, $puestoT,$fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha){

    $sql = "SELECT COUNT( DISTINCT Res_Fecha) AS cant, variables.For_Codigo, variables.Var_Familia,variables.Var_Color
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN usuarios ON respuestas.Res_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1
    INNER JOIN formatos ON  variables.For_Codigo = formatos.For_Codigo
    WHERE For_Estado = 1 ";
    
    if($usuario != ""){ 
      $pri = 1; 
      foreach($usuario as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " estaciones_usuarios.Usu_Codigo = :usu".$pri." "; 
        $parametros[':usu'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    if($valFecha == "0"){
      $sql .= " AND respuestas.Res_Fecha BETWEEN :fecini AND :fecfin ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      
      if($turno != "-1"){
        $sql .= " AND Res_HoraSugerida BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }
      
    }else{
      $sql .= " AND ((respuestas.Res_Fecha = :fecini
      AND Res_HoraSugerida BETWEEN :horini AND :horfin) OR (respuestas.Res_Fecha = :fecfin
      AND Res_HoraSugerida BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    if($area != ""){ 
      $pri2 = 1; 
      foreach($area as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " areas.Are_Codigo = :are".$pri2." "; 
        $parametros[':are'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    if($maquina != ""){ 
      $pri3 = 1; 
      foreach($maquina as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " variables.Maq_Codigo = :maq".$pri3." "; 
        $parametros[':maq'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    if($puestoT != ""){ 
      $pri4 = 1; 
      foreach($puestoT as $registro4){ 
        if($pri4 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " puestos_trabajos.PueT_Codigo = :pue".$pri4." "; 
        $parametros[':pue'.$pri4] = $registro4; 
        $pri4++; 
      } 
      $sql .= " )"; 
    }
    
     if($referenciaConsulta != ""){ 
       
      foreach($referenciaConsulta as $registro8){ 

        if($registro8 == "0"){ 
          $sql .= " AND (";  
        }else{
         $sql .= " OR ";
       }
        
        $sql .= " (variables.For_Codigo = :for".$registro8." "; 
        $parametros[':for'.$registro8] = $formato[$registro8]; 
      
        $sql .= " AND variables.Var_Familia = :fam".$registro8." "; 
        $parametros[':fam'.$registro8] = $familia[$registro8]; 
        
        $sql .= " AND variables.Var_Color = :col".$registro8." ".")"; 
        $parametros[':col'.$registro8] = $color[$registro8]; 
      }
      $sql .= " ) "; 
    }
    
    $sql .= " GROUP BY variables.For_Codigo, variables.Var_Familia,variables.Var_Color ORDER BY maquinas.Maq_Nombre ASC, Res_HoraSugerida ASC";

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
  public function listarVariablesPokayokeMaquinasPanelSupervisorPuestoConNuevasFrecuencias($areas, $cantAreas, $formato, $familia, $color, $puesto, $fecha){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":pue"=>$puesto, ":fec"=>$fecha);

    $sql = "SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, variables.Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl, Var_ValorTolerancia,
    Var_Operador, Are_Codigo, For_Codigo, Var_Familia, Var_Color, PueT_Codigo, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23, Var_Orden, Maq_Orden
    FROM variables
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND estaciones_maquinas.EstM_Estado = 1
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo AND PueTEM_Estado = 1
    WHERE Var_Tipo = 4
    AND Maq_Estado = 1 AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col AND PueT_Codigo = :pue AND Var_FechaHoraCrea = :fec ";
    
    if($cantAreas != "0"){ 
      $pri2 = 1; 
       $sql .= " AND maquinas.Are_Codigo IN (";
      for($i = 0; $i<$cantAreas; $i++){
        $sql .= " :are".$pri2."a"." "; 
        if($pri2 < $cantAreas){
          $sql .= ",";
        }
        $parametros[':are'.$pri2."a"] = $areas[$i]; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .=" UNION ALL
    SELECT DISTINCT maquinas.Maq_Codigo, maquinas.Maq_Nombre, variables.Var_Codigo, Var_Nombre, Var_UnidadMedida, Var_ValorControl,
    Var_ValorTolerancia, Var_Operador, Are_Codigo, For_Codigo, Var_Familia, Var_Color, PueT_Codigo, Var_Hora00, Var_Hora01, Var_Hora02, Var_Hora03, Var_Hora04, Var_Hora05, Var_Hora06, Var_Hora07, Var_Hora08, Var_Hora09, Var_Hora10, Var_Hora11, Var_Hora12, Var_Hora13, Var_Hora14, Var_Hora15, Var_Hora16, Var_Hora17, Var_Hora18, Var_Hora19, Var_Hora20, Var_Hora21, Var_Hora22, Var_Hora23, Var_Orden, Maq_Orden 
    FROM variables 
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1 
    INNER JOIN estaciones_maquinas ON maquinas.Maq_Codigo = estaciones_maquinas.Maq_Codigo AND estaciones_maquinas.EstM_Estado = 1 
    INNER JOIN puestos_trabajos_estaciones_maquinas ON estaciones_maquinas.EstM_Codigo = puestos_trabajos_estaciones_maquinas.EstM_Codigo
    AND PueTEM_Estado = 1 WHERE Var_Tipo = 4 AND Maq_Estado = 1 AND PueT_Codigo = :pue
    AND Var_Origen = '3' AND Var_Estado = 1 ";
    
    if($cantAreas != "0"){ 
      $pri2 = 1; 
       $sql .= " AND maquinas.Are_Codigo IN (";
      for($i = 0; $i<$cantAreas; $i++){
        $sql .= " :are".$pri2." "; 
         if($pri2 < $cantAreas){
          $sql .= ",";
        }
        $parametros[':are'.$pri2] = $areas[$i]; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY Maq_Orden ASC, Var_Orden ASC";

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
  public function listarInfoRespuestas($fecha, $formato, $familia, $color, $horaInicio, $horaFinal, $area, $turno){

    $parametros = array(":fec"=>$fecha,":for"=>$formato,":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT DISTINCT estaciones_usuarios.Usu_Codigo, PueT_Nombre, Res_HoraSugerida,
    Var_ValorControl, Var_ValorTolerancia, Var_Operador, Res_ValorNum, maquinas.Are_Codigo, variables.Var_Tipo, respuestas.Var_Codigo
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    AND estaciones_usuarios.EstU_Estado = 1
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN usuarios ON respuestas.Res_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE variables.For_Codigo = :for AND variables.Var_Familia = :fam AND variables.Var_Color = :col
    AND respuestas.Res_Fecha = :fec ";
    
    if($turno != "-1"){
       $sql .= " AND (respuestas.Res_HoraSugerida BETWEEN :horI AND :horF)"; 
      $parametros[':horI'] = $horaInicio; 
      $parametros[':horF'] = $horaFinal; 
    }
    
    if($area != "-1"){
      $sql .= " AND (areas.Are_Codigo = :are)";
      $parametros[':are'] = $area; 
    }
    
    $sql .= " ORDER BY estaciones_usuarios.Usu_Codigo ASC, PueT_Nombre ASC, Res_HoraSugerida ASC";

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
  public function listarInfoRespuestasMaPe($fecha, $horaInicio, $horaFinal, $area, $turno){

    $parametros = array(":fec"=>$fecha);

    $sql = "SELECT DISTINCT estaciones_usuarios.Usu_Codigo, PueT_Nombre, Res_HoraSugerida,
    Var_ValorControl, Var_ValorTolerancia, Var_Operador, Res_ValorNum, maquinas.Are_Codigo, variables.Var_Tipo, respuestas.Var_Codigo
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    AND estaciones_usuarios.EstU_Estado = 1
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN usuarios ON respuestas.Res_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE respuestas.Res_Fecha = :fec ";
    
    if($turno != "-1"){
       $sql .= " AND (respuestas.Res_HoraSugerida BETWEEN :horI AND :horF)"; 
      $parametros[':horI'] = $horaInicio; 
      $parametros[':horF'] = $horaFinal; 
    }
    
    if($area != "-1"){
      $sql .= " AND (areas.Are_Codigo = :are)";
      $parametros[':are'] = $area; 
    }
    
    $sql .= " ORDER BY estaciones_usuarios.Usu_Codigo ASC, PueT_Nombre ASC, Res_HoraSugerida ASC";

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
  public function listarInfoRespuestasMaPePSFiltro($fecha, $horaInicio, $horaFinal, $turno,$agrupacion){

    $parametros = array(":fec"=>$fecha,":agr"=>$agrupacion);

    $sql = "SELECT DISTINCT estaciones_usuarios.Usu_Codigo, PueT_Nombre, Res_HoraSugerida,
    Var_ValorControl, Var_ValorTolerancia, Var_Operador, Res_ValorNum, maquinas.Are_Codigo, variables.Var_Tipo, respuestas.Var_Codigo
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN agrupaciones_areas ON maquinas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    AND estaciones_usuarios.EstU_Estado = 1
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN usuarios ON respuestas.Res_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE respuestas.Res_Fecha = :fec AND agrupaciones.Agr_Codigo = :agr";
    
    if($turno != "-1"){
       $sql .= " AND (respuestas.Res_HoraSugerida BETWEEN :horI AND :horF)"; 
      $parametros[':horI'] = $horaInicio; 
      $parametros[':horF'] = $horaFinal; 
    }
    
    $sql .= " ORDER BY estaciones_usuarios.Usu_Codigo ASC, PueT_Nombre ASC, Res_HoraSugerida ASC";

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
  public function listarInfoRespuestasMaPePSFiltro1($fecha, $horaInicio, $horaFinal, $turno,$agrupacion, $formato, $familia, $color){

    $parametros = array(":fec"=>$fecha,":agr"=>$agrupacion,":for"=>$formato,":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT DISTINCT estaciones_usuarios.Usu_Codigo, PueT_Nombre, Res_HoraSugerida,
    Var_ValorControl, Var_ValorTolerancia, Var_Operador, Res_ValorNum, maquinas.Are_Codigo, variables.Var_Tipo, respuestas.Var_Codigo
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo AND variables.Var_Estado = 1
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN agrupaciones_areas ON maquinas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    AND estaciones_usuarios.EstU_Estado = 1
    INNER JOIN formatos ON variables.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN usuarios ON respuestas.Res_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE respuestas.Res_Fecha = :fec AND agrupaciones.Agr_Codigo = :agr AND formatos.For_Codigo = :for AND variables.Var_Familia = :fam AND variables.Var_Color = :col ";
    
    if($turno != "-1"){
       $sql .= " AND (respuestas.Res_HoraSugerida BETWEEN :horI AND :horF)"; 
      $parametros[':horI'] = $horaInicio; 
      $parametros[':horF'] = $horaFinal; 
    }
    
    $sql .= " ORDER BY estaciones_usuarios.Usu_Codigo ASC, PueT_Nombre ASC, Res_HoraSugerida ASC";

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
  public function listarInfoRespuestasMaPePSFiltroNot($horaInicio3, $horaFinal3, $turno,$agrupacion, $formato, $familia, $color, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha){

    $parametros = array(":agr"=>$agrupacion,":for"=>$formato,":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT DISTINCT estaciones_usuarios.Usu_Codigo, PueT_Nombre, Res_HoraSugerida,
    Var_ValorControl, Var_ValorTolerancia, Var_Operador, Res_ValorNum, maquinas.Are_Codigo, variables.Var_Tipo, respuestas.Var_Codigo
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo AND variables.Var_Estado = 1
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    INNER JOIN agrupaciones_areas ON maquinas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    AND estaciones_usuarios.EstU_Estado = 1
    INNER JOIN formatos ON variables.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN usuarios ON respuestas.Res_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE agrupaciones.Agr_Codigo = :agr AND formatos.For_Codigo = :for AND variables.Var_Familia = :fam AND variables.Var_Color = :col ";
    
    if($valFecha == "0"){
      $sql .= " AND respuestas.Res_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
      
      if($turno != "-1"){
        $sql .= " AND respuestas.Res_HoraSugerida BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicio3;
        $parametros[':horfin'] = $horaFinal3;
      }else{
        $sql .= " AND respuestas.Res_HoraSugerida >= :horini ";
        $parametros[':horini'] = $horaInicio3;
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
    
    
    $sql .= " ORDER BY estaciones_usuarios.Usu_Codigo ASC, PueT_Nombre ASC, Res_HoraSugerida ASC";

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
  public function listarFiltroPanelSupervisorReferenciasFechasRespuestas($fechaInicial,$fechaFinal, $planta){

    $parametros = array(":fecI"=>$fechaInicial,":fecF"=>$fechaFinal,":pla"=>$planta);

    $sql = "SELECT DISTINCT Ref_Codigo, Ref_Descripcion, Ref_Formato, Ref_Familia, Ref_Color 
    FROM referencias 
    INNER JOIN formatos ON Ref_Formato = formatos.For_Nombre AND formatos.Pla_Codigo = :pla AND For_Estado = 1 
    INNER JOIN variables ON referencias.Ref_Familia = variables.Var_Familia AND referencias.Ref_Color = variables.Var_Color AND formatos.For_Codigo = variables.For_Codigo AND (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4) 
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo 
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1 
    INNER JOIN respuestas ON variables.Var_Codigo = respuestas.Var_Codigo AND respuestas.Res_Estado = 1 
    WHERE Ref_Calidad = 'PRIMERA' AND referencias.Pla_Codigo = :pla AND areas.Pla_Codigo = :pla AND CONCAT_WS(' ', Res_Fecha, Res_HoraSugerida) BETWEEN :fecI AND :fecF  
    GROUP BY Ref_Formato, Ref_Familia, Ref_Color";

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
  public function buscarArchivoAgruCFTTableroSupervisor($planta, $formato, $familia, $color){

    $parametros = array(":pla"=>$planta, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT DISTINCT AgrC_Nombre, AgrC_Archivo, v.Var_Codigo
    FROM respuestas re
    INNER JOIN variables v ON re.Var_Codigo = v.Var_Codigo AND v.Var_Estado = 1
    LEFT JOIN detalle_ficha_tecnica dft ON v.DetFT_Codigo = dft.DetFT_Codigo AND DetFT_Estado = 1
    LEFT JOIN configuracion_ficha_tecnica cft ON dft.ConFT_Codigo = cft.ConFT_Codigo AND ConFT_Estado = 1
    LEFT JOIN agrupaciones_configft acft ON cft.AgrC_Codigo = acft.AgrC_Codigo AND AgrC_Estado = 1
    WHERE AgrC_Estado = 1 AND AgrC_Archivo IS NOT NULL AND acft.Pla_Codigo = :pla AND Var_Estado = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3) AND For_Codigo = :for AND Var_Familia = :fam AND Var_Color = :col";
    

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
  public function buscarArchivoParametrosVariablesTableroSupervisor($planta, $formato, $familia, $color){

    $parametros = array(":pla"=>$planta, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT DISTINCT v.Var_Nombre, ParV_Archivo, v.Var_Codigo
    FROM variables v
    INNER JOIN maquinas ON v.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    LEFT JOIN parametros_variables ON v.For_Codigo = parametros_variables.For_Codigo AND ParV_Estado = 1 
    AND parametros_variables.ParV_Nombre = v.Var_Nombre AND v.Maq_Codigo = parametros_variables.Maq_Codigo
    WHERE Var_Estado = 1  
    AND (Var_Tipo = 2 OR Var_Tipo = 3) AND v.For_Codigo = :for AND v.Var_Familia = :fam AND v.Var_Color = :col 
    AND plantas.Pla_Codigo = :pla AND parametros_variables.ParV_Archivo IS NOT NULL AND parametros_variables.ParV_Archivo != '' ";
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
    
  /*    Autor: Dayanna Castaño
    Fecha:     Descripción:
    Parámetros:    */
  public function listarFiltroPanelSupervisorReferenciasFechaRespuestas($fecha, $agrupacion, $planta){
    $parametros = array(":fec"=>$fecha,":agr"=>$agrupacion);
    $sql = "SELECT DISTINCT Ref_Codigo, Ref_Descripcion, Ref_Material, formatos.For_Nombre, variables.Var_Familia, variables.Var_Color      FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN agrupaciones_areas ON maquinas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = 1
    INNER JOIN formatos ON variables.For_Codigo = formatos.For_Codigo AND For_Estado = 1    INNER JOIN referencias ON variables.Var_Familia = referencias.Ref_Familia AND formatos.For_Nombre = referencias.Ref_Formato
    AND variables.Var_Color = referencias.Ref_Color    WHERE  (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4) 
    AND Maq_Estado = 1 AND Res_Estado = 1 AND Res_Fecha = :fec AND agrupaciones.Agr_Codigo = :agr AND Ref_Calidad = 'PRIMERA' ";    
    if($planta == "13"){       $sql .= " AND Var_Origen = 1";   
    }
  
    $this->consultaSQL($sql, $parametros);    $res = $this->cargarTodo();
    $this->desconectar();    return $res;
  }
    
   /*    Autor: Dayanna Castaño
    Fecha:     Descripción:
    Parámetros:    */
    public function listarFiltroPanelSupervisorReferenciasFechaHoraRespuestas($fecha, $agrupacion, $planta, $fechaFinT, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2){
    
    $parametros = array(":fec"=>$fecha,":agr"=>$agrupacion,":fecF"=>$fechaFinT,":horI"=>$HoraInicialRespT,":horF"=>$HoraFinalRespT,":horI2"=>$HoraInicialRespT2,":horF2"=>$HoraFinalRespT2);
    
    $sql = "SELECT DISTINCT Ref_Codigo, Ref_Descripcion, Ref_Material, formatos.For_Nombre, variables.Var_Familia, variables.Var_Color      FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN agrupaciones_areas ON maquinas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = 1
    INNER JOIN formatos ON variables.For_Codigo = formatos.For_Codigo AND For_Estado = 1    INNER JOIN referencias ON variables.Var_Familia = referencias.Ref_Familia AND formatos.For_Nombre = referencias.Ref_Formato
    AND variables.Var_Color = referencias.Ref_Color    WHERE  (Var_Tipo = 2 OR Var_Tipo = 3 OR Var_Tipo = 4) 
    AND Maq_Estado = 1 AND Res_Estado = 1 AND ((Res_Fecha = :fec
      AND Res_HoraSugerida BETWEEN :horI AND :horF) OR (Res_Fecha = :fecF
      AND Res_HoraSugerida BETWEEN :horI2 AND :horF2)) AND agrupaciones.Agr_Codigo = :agr AND Ref_Calidad = 'PRIMERA' "; 
      
    if($planta == "13"){
      $sql .= " AND Var_Origen = 1";   
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
  public function buscarVariableRespuesta($variable, $cantidad){

    $parametros = array();

    $sql = "SELECT DISTINCT Var_Codigo
    FROM respuestas
    WHERE ";
    
    if($cantidad != "0"){ 
      $pri2 = 1; 
       $sql .= " Var_Codigo IN (";
      for($i = 0; $i<$cantidad; $i++){
        $sql .= " :var".$pri2."a"." "; 
        if($pri2 < $cantidad){
          $sql .= ",";
        }
        $parametros[':var'.$pri2."a"] = $variable[$i]; 
        $pri2++; 
      } 
      $sql .= " )"; 
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
  public function buscarVariableRespuestaUnica($variable, $maquina){

    $parametros = array(":var"=>$variable,":maq"=>$maquina);

    $sql = "SELECT DISTINCT respuestas.Var_Codigo, Maq_Codigo
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo
    WHERE respuestas.Var_Codigo = :var AND Maq_Codigo = :maq";

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
  public function listarInformeEjecucionCumplimiento($fechaCompletaInicial, $fechaCompletaFinal, $fechaInicial, $fechaFinal, $areas, $listaHoras, $cantidadHoras, $puestos, $turnos){

    $parametros = array(":fecinic"=>$fechaCompletaInicial, ":fecfinc"=>$fechaCompletaFinal, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT DISTINCT Res_Fecha, Res_HoraSugerida, v.Var_Nombre, v.Var_ValorControl,
    IF(v.Var_Operador = 1, '>=', 
           IF(v.Var_Operador = 2, '<=',
            IF(v.Var_Operador = 3, '+-', ''
            )
           )
          ) AS operador, 
    v.Var_ValorTolerancia, Res_ValorNum, v.Var_Operador,
    a.Are_Nombre, v.Var_Tipo, maq.Maq_Nombre,
    Res_Vacio, respuestas.EstU_Codigo, v.Maq_Codigo, CONCAT_WS(' ', Res_Fecha, Res_HoraSugerida) AS FecComp ";
    
    
    $max = $cantidadHoras - 1;
    for($a = 0; $a < $cantidadHoras; $a++){
      $sql2 .= " IF(v.Var_Hora".$listaHoras[$a]." IS NOT NULL, 1, 0) ";
      
      if($a < $max){
        $sql2 .= " + ";
      }
    }
    
    $sql .= ", (".$sql2.") AS TotalFre, IF(Res_PuestaPunto = 1, Res_ColorEspecificacionPuestaPunto, Res_ColorEspecificacionFichaTecnica) AS ColorEsp, a.Are_Codigo FROM respuestas
    LEFT JOIN variables v ON respuestas.Var_Codigo = v.Var_Codigo 
    LEFT JOIN formatos f ON v.For_Codigo = f.For_Codigo AND f.For_Estado = 1
    INNER JOIN maquinas maq ON v.Maq_Codigo = maq.Maq_Codigo
    INNER JOIN areas a ON maq.Are_Codigo = a.Are_Codigo
    INNER JOIN plantas ON a.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = '1'
    WHERE Res_Estado = 1 AND Res_Fecha BETWEEN :fecini AND :fecfin AND
    (Res_ValorNum IS NOT NULL OR (Res_ValorNum IS NULL AND Res_Vacio = 1) ) AND v.Var_PuntoControl = 1 AND v.Var_TipoVariable = 1 AND (Var_Tipo = 2 OR Var_Tipo = 3) ";
    
    if($areas != ""){ 
      $pri2 = 1; 
      foreach($areas as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " a.Are_Codigo = :are".$pri2." "; 
        $parametros[':are'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    if($puestos != ""){ 
      $pri3 = 1; 
      foreach($puestos as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " puestos_trabajos.PueT_Codigo = :pue".$pri3." "; 
        $parametros[':pue'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    if($turnos != ""){ 
      $pri3 = 1; 
      foreach($turnos as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " estaciones_usuarios.Tur_Codigo = :tur".$pri3." "; 
        $parametros[':tur'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " GROUP BY Res_Fecha, Res_HoraSugerida, v.Var_Nombre, v.Var_ValorControl, operador,
    v.Var_ValorTolerancia, Res_ValorNum, v.Var_Operador, a.Are_Nombre, v.Var_Tipo, maq.Maq_Nombre, Res_Vacio, respuestas.EstU_Codigo, v.Maq_Codigo,
    FecComp HAVING FecComp BETWEEN :fecinic AND :fecfinc ORDER BY Are_Nombre ASC, Maq_Nombre ASC, Var_Orden ASC";
    
//    echo "-- listarInformeEjecucionCumplimiento --"."<br>".$sql;
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
  public function listarInformeEjecucionCumplimientoCriticidad($fechaCompletaInicial, $fechaCompletaFinal, $fechaInicial, $fechaFinal, $areas, $listaHoras, $cantidadHoras, $puestos, $tipoVariable, $criticidad, $turnos){

    $parametros = array(":fecinic"=>$fechaCompletaInicial, ":fecfinc"=>$fechaCompletaFinal, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT DISTINCT Res_Fecha, Res_HoraSugerida, v.Var_Nombre, v.Var_ValorControl,
    IF(v.Var_Operador = 1, '>=', 
           IF(v.Var_Operador = 2, '<=',
            IF(v.Var_Operador = 3, '+-', ''
            )
           )
          ) AS operador, 
    v.Var_ValorTolerancia, Res_ValorNum, v.Var_Operador,
    a.Are_Nombre, v.Var_Tipo, maq.Maq_Nombre,
    Res_Vacio, respuestas.EstU_Codigo, v.Maq_Codigo, CONCAT_WS(' ', Res_Fecha, Res_HoraSugerida) AS FecComp ";
    
    
    $max = $cantidadHoras - 1;
    for($a = 0; $a < $cantidadHoras; $a++){
      $sql2 .= " IF(v.Var_Hora".$listaHoras[$a]." IS NOT NULL, 1, 0) ";
      
      if($a < $max){
        $sql2 .= " + ";
      }
    }
    
    $sql .= ", (".$sql2.") AS TotalFre, IF(Res_PuestaPunto = 1, Res_ColorEspecificacionPuestaPunto, Res_ColorEspecificacionFichaTecnica) AS ColorEsp, a.Are_Codigo FROM respuestas
    LEFT JOIN variables v ON respuestas.Var_Codigo = v.Var_Codigo 
    LEFT JOIN formatos f ON v.For_Codigo = f.For_Codigo AND f.For_Estado = 1
    INNER JOIN maquinas maq ON v.Maq_Codigo = maq.Maq_Codigo
    INNER JOIN areas a ON maq.Are_Codigo = a.Are_Codigo
    INNER JOIN plantas ON a.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN estaciones_usuarios ON respuestas.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = '1'
    WHERE Res_Estado = 1 AND Res_Fecha BETWEEN :fecini AND :fecfin AND
    (Res_ValorNum IS NOT NULL OR (Res_ValorNum IS NULL AND Res_Vacio = 1) ) AND (Var_Tipo = 2 OR Var_Tipo = 3) ";
    
    if($tipoVariable != "-1"){
      $sql .= " AND v.Var_PuntoControl = :tipvar ";
      $parametros[':tipvar'] = $tipoVariable;
    }
    
    if($criticidad != "-1"){
      $sql .= " AND v.Var_TipoVariable = :cri ";
      $parametros[':cri'] = $criticidad;
    }
    
    if($areas != ""){ 
      $pri2 = 1; 
      foreach($areas as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " a.Are_Codigo = :are".$pri2." "; 
        $parametros[':are'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    if($puestos != ""){ 
      $pri3 = 1; 
      foreach($puestos as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " puestos_trabajos.PueT_Codigo = :pue".$pri3." "; 
        $parametros[':pue'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    if($turnos != ""){ 
      $pri3 = 1; 
      foreach($turnos as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " estaciones_usuarios.Tur_Codigo = :tur".$pri3." "; 
        $parametros[':tur'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " GROUP BY Res_Fecha, Res_HoraSugerida, v.Var_Nombre, v.Var_ValorControl, operador,
    v.Var_ValorTolerancia, Res_ValorNum, v.Var_Operador, a.Are_Nombre, v.Var_Tipo, maq.Maq_Nombre, Res_Vacio, respuestas.EstU_Codigo, v.Maq_Codigo,
    FecComp, a.Are_Codigo HAVING FecComp BETWEEN :fecinic AND :fecfinc ORDER BY Are_Nombre ASC, Maq_Nombre ASC, Var_Orden ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }  
    
  public function listarVariablesCriticasPaginado($fechaInicial, $fechaFinal, $area, $operario, $alerta, $planta, $turno, $turHoraInicio, $turHoraFin, $sino, $fechaHoraInicial, $fechaHoraFinal, $pagina) {
    $tamanoLote = 82500; // Puedes ajustar este valor según sea necesario
    $offset = ($pagina - 1) * $tamanoLote;
 
    $parametros = array(":fecI" => $fechaInicial, ":fecF" => $fechaFinal, ":fecHI" => $fechaHoraInicial, ":fecHF" => $fechaHoraFinal, ":pla"=>$planta);
 
    $sql .= "SELECT DISTINCT respuestas.Res_Codigo, CONCAT_WS(' ', Res_Fecha, Res_HoraSugerida) AS FecComp, par.Par_Nombre, Res_Alerta, f.For_Nombre, v.Var_Familia, v.Var_Color, Res_Fecha, Res_HoraSugerida, Res_HoraReal, maq.Maq_Nombre, v.Var_Nombre, v.Var_ValorControl, IF(v.Var_Operador = 1, '>=', IF(v.Var_Operador = 2, '<=', IF(v.Var_Operador = 3, '+-', '' ) ) ) AS operador,
    v.Var_ValorTolerancia, 
    Res_ValorNum, pa.PlaA_ObservacionesOperario,
    CONCAT_WS(' ', u.Usu_Nombres, u.Usu_Apellidos) AS nombre, PlaA_ObservacionesSupervisor, CONCAT_WS(' ', u1.Usu_Nombres, u1.Usu_Apellidos) AS supervisor, v.Var_Tipo, Res_Vacio 
    FROM respuestas
    LEFT JOIN variables v ON respuestas.Var_Codigo = v.Var_Codigo
    LEFT JOIN formatos f ON v.For_Codigo = f.For_Codigo AND f.For_Estado = 1 AND f.Pla_Codigo = :pla
    LEFT JOIN usuarios u ON Res_UsuarioCrea = u.Usu_Codigo AND u.Usu_Estado = 1 AND u.Pla_Codigo = :pla
    LEFT JOIN planes_acciones pa ON respuestas.Res_Codigo = pa.Res_Codigo AND pa.PlaA_Estado = 1
    LEFT JOIN usuarios u1 ON pa.PlaA_Supervisor = u1.Usu_Codigo AND u1.Usu_Estado = 1
    LEFT JOIN parametros par ON pa.PlaA_Prioridad = par.Par_Codigo AND Par_Estado = 1
    INNER JOIN maquinas maq ON v.Maq_Codigo = maq.Maq_Codigo
    INNER JOIN areas a ON maq.Are_Codigo = a.Are_Codigo AND a.Pla_Codigo = :pla
    INNER JOIN plantas ON a.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    WHERE Res_Estado = 1 AND Res_Fecha BETWEEN :fecI  AND :fecF AND (Res_ValorNum IS NOT NULL OR (Res_ValorNum IS NULL AND Res_Vacio = 1) ) AND (v.Var_Tipo = 2 OR v.Var_Tipo = 3 )
    AND ( plantas.Pla_Codigo = :pla) ";
 
    if($operario != ""){ 
      $pri2 = 1; 
      foreach($operario as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Res_UsuarioCrea = :res".$pri2." "; 
        $parametros[':res'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
   if($alerta != "-1"){ 
      $sql .= " AND ( Res_Alerta = :ale ) ";
      $parametros[':ale'] = $alerta; 
    }
    if ( $area != "" ) {
      $pri = 1;
      foreach ( $area as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " a.Are_Codigo = :are".$pri." ";
        $parametros[ ':are' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }
    if($turno != "-1"){ 
      $sql .= " AND ( Res_HoraReal BETWEEN :ini AND :fin ) ";
      $parametros[':ini'] = $turHoraInicio; 
      $parametros[':fin'] = $turHoraFin; 
    }
    if($sino != "-1"){ 
      $sql .= " AND v.Var_Tipo = 4 AND Res_ValorNum = :sino ";
      $parametros[':sino'] = $sino;  
    }
 
    $sql .= "HAVING FecComp BETWEEN :fecHI AND :fecHF ORDER BY FecComp ASC, par.Par_Codigo ASC LIMIT $offset, $tamanoLote";
 
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
  public function listadoRespuestasActualizarDescuentosTurnosOperacion($horaInicial, $horaFinal, $fechaInicial, $fechaFinal, $planta, $area){

    $parametros = array(":are"=>$area, ":pla"=>$planta, ":fecini"=>$fechaInicial." ".$horaInicial, ":fecfin"=>$fechaFinal." ".$horaFinal);

    $sql = "SELECT Res_Codigo, respuestas.Var_Codigo, Res_Fecha, Res_HoraSugerida
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo AND (Var_Tipo = 2 OR Var_Tipo = 3)
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo
    WHERE areas.Pla_Codigo = :pla AND (CONCAT_WS(' ', Res_Fecha, Res_HoraSugerida) >= :fecini AND CONCAT_WS(' ', Res_Fecha, Res_HoraSugerida) < :fecfin) AND Res_Estado = 1 AND (Res_ValorNum IS NOT NULL OR (Res_ValorNum IS NULL AND Res_Vacio = 1) ) AND areas.Are_Codigo = :are ";
    

//    echo "-- listadoRespuestasActualizarDescuentosTurnosOperacion --"."<br>".$sql;
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
  public function listadoRespuestasActualizarDescuentosTurnosOperacionEliminar($horaInicial, $horaFinal, $fechaInicial, $fechaFinal, $planta, $area){

    $parametros = array(":are"=>$area, ":pla"=>$planta, ":fecini"=>$fechaInicial." ".$horaInicial, ":fecfin"=>$fechaFinal." ".$horaFinal);

    $sql = "SELECT Res_Codigo, respuestas.Var_Codigo, Res_Fecha, Res_HoraSugerida
    FROM respuestas
    INNER JOIN variables ON respuestas.Var_Codigo = variables.Var_Codigo AND (Var_Tipo = 2 OR Var_Tipo = 3)
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo
    WHERE areas.Pla_Codigo = :pla AND (CONCAT_WS(' ', Res_Fecha, Res_HoraSugerida) >= :fecini AND CONCAT_WS(' ', Res_Fecha, Res_HoraSugerida) < :fecfin) AND Res_Estado = 9 AND (Res_ValorNum IS NOT NULL OR (Res_ValorNum IS NULL AND Res_Vacio = 1) ) AND areas.Are_Codigo = :are ";
    

//    echo "-- listadoRespuestasActualizarDescuentosTurnosOperacion --"."<br>".$sql;
//    var_dump($parametros);
//    echo "<br>";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }

}
?>
