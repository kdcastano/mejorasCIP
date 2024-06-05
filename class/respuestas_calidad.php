<?php
require_once('basedatos.php');

  class respuestas_calidad extends basedatos {
    private $ResC_Codigo;
    private $Cal_Codigo;
    private $Usu_Codigo;
    private $EstU_Codigo;
    private $For_Codigo;
    private $ResC_Familia;
    private $ResC_Color;
    private $ResC_Hora;
    private $ResC_Fecha;
    private $ResC_ValorControl;
    private $ResC_Observacion;
    private $ResC_Vacio;
    private $ResC_VacioObservacion;
    private $ResC_FechaHoraCrea;
    private $ResC_UsuarioCrea;
    private $ResC_Estado;

  function __construct($ResC_Codigo = NULL, $Cal_Codigo = NULL, $Usu_Codigo = NULL, $EstU_Codigo = NULL, $For_Codigo = NULL, $ResC_Familia = NULL, $ResC_Color = NULL, $ResC_Hora = NULL, $ResC_Fecha = NULL, $ResC_ValorControl = NULL, $ResC_Observacion = NULL, $ResC_Vacio = NULL, $ResC_VacioObservacion = NULL, $ResC_FechaHoraCrea = NULL, $ResC_UsuarioCrea = NULL, $ResC_Estado = NULL) {
    $this->ResC_Codigo = $ResC_Codigo;
    $this->Cal_Codigo = $Cal_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->EstU_Codigo = $EstU_Codigo;
    $this->For_Codigo = $For_Codigo;
    $this->ResC_Familia = $ResC_Familia;
    $this->ResC_Color = $ResC_Color;
    $this->ResC_Hora = $ResC_Hora;
    $this->ResC_Fecha = $ResC_Fecha;
    $this->ResC_ValorControl = $ResC_ValorControl;
    $this->ResC_Observacion = $ResC_Observacion;
    $this->ResC_Vacio = $ResC_Vacio;
    $this->ResC_VacioObservacion = $ResC_VacioObservacion;
    $this->ResC_FechaHoraCrea = $ResC_FechaHoraCrea;
    $this->ResC_UsuarioCrea = $ResC_UsuarioCrea;
    $this->ResC_Estado = $ResC_Estado;
    $this->tabla = "respuestas_calidad";
  }

  function getResC_Codigo() {
    return $this->ResC_Codigo;
  }

  function getCal_Codigo() {
    return $this->Cal_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getEstU_Codigo() {
    return $this->EstU_Codigo;
  }

  function getFor_Codigo() {
    return $this->For_Codigo;
  }

  function getResC_Familia() {
    return $this->ResC_Familia;
  }

  function getResC_Color() {
    return $this->ResC_Color;
  }

  function getResC_Hora() {
    return $this->ResC_Hora;
  }

  function getResC_Fecha() {
    return $this->ResC_Fecha;
  }

  function getResC_ValorControl() {
    return $this->ResC_ValorControl;
  }

  function getResC_Observacion() {
    return $this->ResC_Observacion;
  }

  function getResC_Vacio() {
    return $this->ResC_Vacio;
  }

  function getResC_VacioObservacion() {
    return $this->ResC_VacioObservacion;
  }

  function getResC_FechaHoraCrea() {
    return $this->ResC_FechaHoraCrea;
  }

  function getResC_UsuarioCrea() {
    return $this->ResC_UsuarioCrea;
  }

  function getResC_Estado() {
    return $this->ResC_Estado;
  }

  function setResC_Codigo($ResC_Codigo) {
    $this->ResC_Codigo = $ResC_Codigo;
  }

  function setCal_Codigo($Cal_Codigo) {
    $this->Cal_Codigo = $Cal_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setEstU_Codigo($EstU_Codigo) {
    $this->EstU_Codigo = $EstU_Codigo;
  }

  function setFor_Codigo($For_Codigo) {
    $this->For_Codigo = $For_Codigo;
  }

  function setResC_Familia($ResC_Familia) {
    $this->ResC_Familia = $ResC_Familia;
  }

  function setResC_Color($ResC_Color) {
    $this->ResC_Color = $ResC_Color;
  }

  function setResC_Hora($ResC_Hora) {
    $this->ResC_Hora = $ResC_Hora;
  }

  function setResC_Fecha($ResC_Fecha) {
    $this->ResC_Fecha = $ResC_Fecha;
  }

  function setResC_ValorControl($ResC_ValorControl) {
    $this->ResC_ValorControl = $ResC_ValorControl;
  }

  function setResC_Observacion($ResC_Observacion) {
    $this->ResC_Observacion = $ResC_Observacion;
  }

  function setResC_Vacio($ResC_Vacio) {
    $this->ResC_Vacio = $ResC_Vacio;
  }

  function setResC_VacioObservacion($ResC_VacioObservacion) {
    $this->ResC_VacioObservacion = $ResC_VacioObservacion;
  }

  function setResC_FechaHoraCrea($ResC_FechaHoraCrea) {
    $this->ResC_FechaHoraCrea = $ResC_FechaHoraCrea;
  }

  function setResC_UsuarioCrea($ResC_UsuarioCrea) {
    $this->ResC_UsuarioCrea = $ResC_UsuarioCrea;
  }

  function setResC_Estado($ResC_Estado) {
    $this->ResC_Estado = $ResC_Estado;
  }

  public function insertar(){
    $campos = array("Cal_Codigo", "Usu_Codigo", "EstU_Codigo", "For_Codigo", "ResC_Familia", "ResC_Color", "ResC_Hora", "ResC_Fecha", "ResC_ValorControl", "ResC_Observacion", "ResC_Vacio", "ResC_VacioObservacion", "ResC_FechaHoraCrea", "ResC_UsuarioCrea", "ResC_Estado");
    $valores = array(
    array(
      $this->Cal_Codigo, 
      $this->Usu_Codigo, 
      $this->EstU_Codigo, 
      $this->For_Codigo, 
      $this->ResC_Familia, 
      $this->ResC_Color, 
      $this->ResC_Hora, 
      $this->ResC_Fecha, 
      $this->ResC_ValorControl, 
      $this->ResC_Observacion, 
      $this->ResC_Vacio, 
      $this->ResC_VacioObservacion, 
      $this->ResC_FechaHoraCrea, 
      $this->ResC_UsuarioCrea, 
      $this->ResC_Estado
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
    $sql =  "SELECT * FROM respuestas_calidad WHERE ResC_Codigo = :cod";
    $parametros = array(":cod"=>$this->ResC_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setCal_Codigo($res[1]);
      $this->setUsu_Codigo($res[2]);
      $this->setEstU_Codigo($res[3]);
      $this->setFor_Codigo($res[4]);
      $this->setResC_Familia($res[5]);
      $this->setResC_Color($res[6]);
      $this->setResC_Hora($res[7]);
      $this->setResC_Fecha($res[8]);
      $this->setResC_ValorControl($res[9]);
      $this->setResC_Observacion($res[10]);
      $this->setResC_Vacio($res[11]);
      $this->setResC_VacioObservacion($res[12]);
      $this->setResC_FechaHoraCrea($res[13]);
      $this->setResC_UsuarioCrea($res[14]);
      $this->setResC_Estado($res[15]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Cal_Codigo", "Usu_Codigo", "EstU_Codigo", "For_Codigo", "ResC_Familia", "ResC_Color", "ResC_Hora", "ResC_Fecha", "ResC_ValorControl", "ResC_Observacion", "ResC_Vacio", "ResC_VacioObservacion", "ResC_FechaHoraCrea", "ResC_UsuarioCrea", "ResC_Estado");
    $valores = array($this->getCal_Codigo(), $this->getUsu_Codigo(), $this->getEstU_Codigo(), $this->getFor_Codigo(), $this->getResC_Familia(), $this->getResC_Color(), $this->getResC_Hora(), $this->getResC_Fecha(), $this->getResC_ValorControl(), $this->getResC_Observacion(), $this->getResC_Vacio(), $this->getResC_VacioObservacion(), $this->getResC_FechaHoraCrea(), $this->getResC_UsuarioCrea(), $this->getResC_Estado());
    $llaveprimaria = "ResC_Codigo";
    $valorllaveprimaria = $this->getResC_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM respuestas_calidad WHERE ResC_Codigo = :cod";
    $parametros = array(":cod"=>$this->ResC_Codigo);
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
  public function listarRespuestasCalidad($formato, $familia, $color, $hora, $area,$fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha){
    
    $parametros = array(":for"=>$formato, ":fam"=>$familia,":col"=>$color, ":hor"=>$hora, ":are"=>$area );

    $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, For_Codigo, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl,
    ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo, ResC_Vacio
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    WHERE ResC_Estado = 1 AND For_Codigo = :for AND ResC_Familia = :fam AND ResC_Color = :col AND ResC_Hora = :hor AND calidad.Are_Codigo = :are ";
    
    if($valFecha == "0"){
      $sql .= " AND ResC_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
    }else{
      $sql .= " AND ((ResC_Fecha = :fecini
      AND ResC_Hora BETWEEN :horini AND :horfin) OR (ResC_Fecha = :fecfin
      AND ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    $sql .= " ORDER BY ResC_Hora ASC";

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
    public function listarRespuestasCalidadTodasHoras($formato, $familia, $color, $area, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha){

      $parametros = array(":for"=>$formato, ":fam"=>$familia,":col"=>$color,":are"=>$area );

      $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, For_Codigo, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl,
      ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo, calidad.Cal_AgrupadorSuma, ResC_Fecha, ResC_Hora, Cal_TomaDefectos, respuestas_calidad.ResC_Vacio
      FROM respuestas_calidad
      INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
      WHERE ResC_Estado = 1 AND For_Codigo = :for AND ResC_Familia = :fam AND ResC_Color = :col AND calidad.Are_Codigo = :are ";
      
      if($valFecha == "0"){
        $sql .= " AND ResC_Fecha = :fec ";
        $parametros[':fec'] = $fecha;
      }else{
        $sql .= " AND ((ResC_Fecha = :fecini
        AND ResC_Hora BETWEEN :horini AND :horfin) OR (ResC_Fecha = :fecfin
        AND ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
        $parametros[':fecini'] = $fecha;
        $parametros[':fecfin'] = $fechaFinal;
        $parametros[':horini'] = $horaInicial;
        $parametros[':horfin'] = $horaFinal;
        $parametros[':horini2'] = $horaInicial2;
        $parametros[':horfin2'] = $horaFinal2;
      }
      
      $sql .= " ORDER BY ResC_Hora ASC";
      
//      if($_SESSION['CP_Usuario'] == "6"){
//    echo "---listarRespuestasCalidadTodasHoras---"."<br>".$sql;
//    var_dump($parametros);
//    echo "<br>";
//  }
      
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
    public function listarRespuestasCalidadTodasHorasTS($formato, $familia, $color, $area, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $areaAgrupacion){

      $parametros = array(":for"=>$formato, ":fam"=>$familia,":col"=>$color,":areAgr"=>$areaAgrupacion );

      $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, respuestas_calidad.For_Codigo, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl,
      ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo, calidad.Cal_AgrupadorSuma, ResC_Fecha, ResC_Hora, Cal_TomaDefectos, ResC_Vacio
      FROM respuestas_calidad
      INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
      INNER JOIN estaciones_usuarios ON respuestas_calidad.EstU_Codigo = estaciones_usuarios.EstU_Codigo
      INNER JOIN programa_produccion ON estaciones_usuarios.ProP_Codigo = programa_produccion.ProP_Codigo
      WHERE ResC_Estado = 1 AND respuestas_calidad.For_Codigo = :for AND ResC_Familia = :fam AND ResC_Color = :col AND programa_produccion.Are_Codigo = :areAgr ";
      
      if($valFecha == "0"){
        $sql .= " AND ResC_Fecha = :fec ";
        $parametros[':fec'] = $fecha;
      }else{
        $sql .= " AND ((ResC_Fecha = :fecini
        AND ResC_Hora BETWEEN :horini AND :horfin) OR (ResC_Fecha = :fecfin
        AND ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
        $parametros[':fecini'] = $fecha;
        $parametros[':fecfin'] = $fechaFinal;
        $parametros[':horini'] = $horaInicial;
        $parametros[':horfin'] = $horaFinal;
        $parametros[':horini2'] = $horaInicial2;
        $parametros[':horfin2'] = $horaFinal2;
      }
      
      if($area != null){
        $sql .= " AND calidad.Are_Codigo = :are ";
        $parametros[':are'] = $area;
      }
      
      $sql .= " ORDER BY ResC_Hora ASC";
      
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
    public function listarRespuestasCalidadTodasHorasTSInforme($referenciaConsulta, $formato, $familia, $color, $area, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha,$horaTurnoIni,$horaTurnoFin){

      $parametros = array();

      $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, For_Codigo, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl,
      ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo, calidad.Cal_AgrupadorSuma, ResC_Fecha, ResC_Hora, Cal_TomaDefectos
      FROM respuestas_calidad
      INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
      WHERE ResC_Estado = 1 ";
      
      if($referenciaConsulta != ""){ 
       
      foreach($referenciaConsulta as $registro8){ 

        if($registro8 == "0"){ 
          $sql .= " AND (";  
        }else{
         $sql .= " OR ";
       }
        
        $sql .= " (For_Codigo = :for".$registro8." "; 
        $parametros[':for'.$registro8] = $formato[$registro8]; 
      
        $sql .= " AND ResC_Familia = :fam".$registro8." "; 
        $parametros[':fam'.$registro8] = $familia[$registro8]; 
        
        $sql .= " AND ResC_Color = :col".$registro8." ".")"; 
        $parametros[':col'.$registro8] = $color[$registro8]; 
      }
      $sql .= " ) "; 
    }
      
      if($valFecha == "0"){
//        $sql .= " AND ResC_Fecha = :fec ";
//        $parametros[':fec'] = $fecha;
        
        $sql .= " AND ((ResC_Fecha = :fecini
        AND ResC_Hora BETWEEN :horini AND :horfin) OR (ResC_Fecha = :fecfin
        AND ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
        $parametros[':fecini'] = $fecha;
        $parametros[':fecfin'] = date( "Y-m-d", strtotime( $fecha . " + 1 days" ) );
        $parametros[':horini'] = $horaTurnoIni;
        $parametros[':horfin'] = "23:59:00";
        $parametros[':horini2'] = "00:00:00";
        $parametros[':horfin2'] = date( "H:i:s", strtotime( $horaTurnoFin . " - 1 minute" ) );
        
      }else{
        $sql .= " AND ((ResC_Fecha = :fecini
        AND ResC_Hora BETWEEN :horini AND :horfin) OR (ResC_Fecha = :fecfin
        AND ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
        $parametros[':fecini'] = $fecha;
        $parametros[':fecfin'] = $fechaFinal;
        $parametros[':horini'] = $horaInicial;
        $parametros[':horfin'] = $horaFinal;
        $parametros[':horini2'] = $horaInicial2;
        $parametros[':horfin2'] = $horaFinal2;
      }
      
      if($area != null){
        $sql .= " AND calidad.Are_Codigo = :are ";
        $parametros[':are'] = $area;
      }
      
      $sql .= " ORDER BY ResC_Hora ASC";
      
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
  public function listarSegundaVisual($formato, $familia, $color,$fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $area){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":are"=>$area);

    $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl,
    ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col AND Cal_TomaDefectos = '2' AND calidad.Are_Codigo = :are ";
    
    if($valFecha == "0"){
      $sql .= " AND ResC_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
    }else{
      $sql .= " AND ((ResC_Fecha = :fecini
      AND ResC_Hora BETWEEN :horini AND :horfin) OR (ResC_Fecha = :fecfin
      AND ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
//    if($area != "-1"){
//       $sql .= " AND Are_Codigo = :are"; 
//      $parametros[':are'] = $area; 
//    }
    
    $sql .= " ORDER BY ResC_Hora ASC";

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
  public function listarSegundaVisualPanelSupervisor($formato, $familia, $color, $fechaInicial, $fechaFinal){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl,
    ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo, ResC_Fecha
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col AND Cal_TomaDefectos = '2' AND ResC_Fecha BETWEEN :fecini AND :fecfin ORDER BY ResC_Hora ASC";

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
  public function listarPrimeraVisual($formato, $familia, $color, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $area){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":are"=>$area);

    $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl, ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo, Cal_ValorCritico, Cal_Tolerancia, Cal_Operador
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col AND Cal_TomaDefectos = '1' AND calidad.Are_Codigo = :are ";
    
    if($valFecha == "0"){
      $sql .= " AND ResC_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
    }else{
      $sql .= " AND ((ResC_Fecha = :fecini
      AND ResC_Hora BETWEEN :horini AND :horfin) OR (ResC_Fecha = :fecfin
      AND ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
//    if($area != "-1"){
//       $sql .= " AND Are_Codigo = :are"; 
//      $parametros[':are'] = $area; 
//    }
    
    $sql .= " ORDER BY ResC_Hora ASC";
    
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
  public function listarPrimeraVisualPanelSupervisor($formato, $familia, $color, $fechaInicial, $fechaFinal){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl, ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo, Cal_ValorCritico, Cal_Tolerancia, Cal_Operador, ResC_Fecha
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col AND Cal_TomaDefectos = '1' AND ResC_Fecha BETWEEN :fecini AND :fecfin ORDER BY ResC_Hora ASC";

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
  public function listarSegundaVisualRetal($formato, $familia, $color, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $area){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":are"=>$area);

    $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl,
    ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo, Cal_Operador, Cal_ValorCritico, Cal_Tolerancia
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col AND Cal_TomaDefectos = '3' AND calidad.Are_Codigo = :are ";
    
    if($valFecha == "0"){
      $sql .= " AND ResC_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
    }else{
      $sql .= " AND ((ResC_Fecha = :fecini
      AND ResC_Hora BETWEEN :horini AND :horfin) OR (ResC_Fecha = :fecfin
      AND ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
//    if($area != "-1"){
//       $sql .= " AND Are_Codigo = :are"; 
//      $parametros[':are'] = $area; 
//    }
    
    $sql .= " ORDER BY ResC_Hora ASC";

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
  public function listarSegundaVisualRetalPanelSupervisor($formato, $familia, $color, $fechaInicial, $fechaFinal){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl,
    ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo, Cal_Operador, Cal_ValorCritico, Cal_Tolerancia,ResC_Fecha
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col AND Cal_TomaDefectos = '3' AND ResC_Fecha BETWEEN :fecini AND :fecfin ORDER BY ResC_Hora ASC";

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
  public function listarLinerPlanar($formato, $familia, $color, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $area){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":are"=>$area);

    $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl,
    ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo, Cal_TomaDefectos,ResC_Fecha
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col
    AND Cal_TomaDefectos != '1' AND Cal_TomaDefectos != '2' AND Cal_TomaDefectos != '3' AND calidad.Are_Codigo = :are";
    
    if($valFecha == "0"){
      $sql .= " AND ResC_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
    }else{
      $sql .= " AND ((ResC_Fecha = :fecini
      AND ResC_Hora BETWEEN :horini AND :horfin) OR (ResC_Fecha = :fecfin
      AND ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
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
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
  */
  public function listarLinerPlanarPanelSupervisor($formato, $familia, $color, $fechaInicial, $fechaFinal){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl,
    ResC_Observacion, calidad.Cal_TomaDefectos, calidad.Are_Codigo, Cal_TomaDefectos,ResC_Fecha
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col
    AND Cal_TomaDefectos != '1' AND Cal_TomaDefectos != '2' AND Cal_TomaDefectos != '3' AND ResC_Fecha BETWEEN :fecini AND :fecfin";

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
  public function codigoCalidadValorControlCenterLinePanelSupervisor($formato, $familia, $color,$fechaInicial,$fechaFinal, $defecto, $programaProduccion){

      $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":fecI"=>$fechaInicial,":fecF"=>$fechaFinal,":def"=>$defecto,":prop"=>$programaProduccion);

      $sql = "SELECT DISTINCT respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, Cal_ValorCritico, Cal_Tolerancia, Cal_Operador,
      (SELECT MIN(Porc_PorcentajePrimera)
      FROM porcentajes_calidad
      WHERE ProP_Codigo = :prop AND Porc_PorcentajePrimera != 0 AND Porc_Fecha BETWEEN :fecI AND :fecF) AS MinValCont
      FROM respuestas_calidad
      INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
      INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
      WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col
  AND ResC_Fecha BETWEEN :fecI AND :fecF AND Cal_TomaDefectos = :def";

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
public function codigoCalidadValorControlCenterLinePanelSupervisorOperador($formato, $familia, $color,$fechaIni,$fechaFin, $defecto, $programaProduccion){ 
 
    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":fecI"=>$fechaIni,":fecF"=>$fechaFin,":def"=>$defecto,":prop"=>$programaProduccion); 
 
    $sql = "SELECT DISTINCT respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, Cal_ValorCritico, Cal_Tolerancia, Cal_Operador, 
    (SELECT MIN(Porc_PorcentajePrimera) 
    FROM porcentajes_calidad 
    WHERE ProP_Codigo = :prop AND Porc_PorcentajePrimera != 0 AND Porc_Fecha BETWEEN :fecI AND :fecF) AS MinValCont 
    FROM respuestas_calidad 
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1 
    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col 
    AND ResC_Fecha BETWEEN :fecI AND :fecF AND Cal_TomaDefectos = :def"; 
     
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
 public function codigoCalidadValorControlCenterLinePanelSupervisorRotura($formato, $familia, $color,$fechaInicial,$fechaFinal, $defecto, $programaProduccion){

      $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":fecI"=>$fechaInicial,":fecF"=>$fechaFinal,":def"=>$defecto,":prop"=>$programaProduccion);

      $sql = "SELECT DISTINCT respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, Cal_ValorCritico, Cal_Tolerancia, Cal_Operador,
  (SELECT MIN(Porc_PorcentajeRotura)
  FROM porcentajes_calidad
  WHERE ProP_Codigo = :prop AND Porc_PorcentajeRotura != 0 AND Porc_Fecha BETWEEN :fecI AND :fecF) AS MinValCont,(SELECT MAX(Porc_PorcentajeRotura)
  FROM porcentajes_calidad
  WHERE ProP_Codigo = :prop AND Porc_PorcentajeRotura != 0 AND Porc_Fecha BETWEEN :fecI AND :fecF) AS MaxValCont
      FROM respuestas_calidad
      INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
      INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
      WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col
  AND ResC_Fecha BETWEEN :fecI AND :fecF AND Cal_TomaDefectos = :def";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }  
    
/*  Autor: Dayanna Castaño
  Fecha:   Descripción:
  Parámetros:  */
  public function codigoCalidadValorControlCenterLinePanelSupervisorRoturaOperador($formato, $familia, $color,$fechaInicial,$fechaFinal, $defecto, $programaProduccion){
    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":fecI"=>$fechaInicial,":fecF"=>$fechaFinal,":def"=>$defecto,":prop"=>$programaProduccion);
    $sql = "SELECT DISTINCT respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, Cal_ValorCritico, Cal_Tolerancia, Cal_Operador,(SELECT MIN(Porc_PorcentajeRotura)
FROM porcentajes_calidad WHERE ProP_Codigo = :prop AND Porc_PorcentajeRotura != 0 AND Porc_Fecha BETWEEN :fecI AND :fecF) AS MinValCont,(SELECT MAX(Porc_PorcentajeRotura)
FROM porcentajes_calidad WHERE ProP_Codigo = :prop AND Porc_PorcentajeRotura != 0 AND Porc_Fecha BETWEEN :fecI AND :fecF) AS MaxValCont
    FROM respuestas_calidad    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col
AND ResC_Fecha BETWEEN :fecI AND :fecF AND Cal_TomaDefectos = :def";    
  
    $this->consultaSQL($sql, $parametros);    $res = $this->cargarRegistro();
    $this->desconectar();    return $res;
  }
    
  /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarConsultaEstadisticaCalidadPrinpal($referenciaConsulta, $formato, $familia, $color,$horaInicial3, $horaFinal3, $usuario, $area, $turno, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha,$horaTurnoIni,$horaTurnoFin){

    $sql = "SELECT ResC_Codigo, EstU_Codigo, Cal_Nombre, calidad.Are_Codigo, ResC_ValorControl, usuarios.Usu_Codigo, CONCAT_WS(' ',usuarios.Usu_Nombres,usuarios.Usu_Apellidos) AS nombres,
    ResC_Fecha, areas.Are_Nombre, respuestas_calidad.For_Codigo, respuestas_calidad.ResC_Familia, respuestas_calidad.ResC_Color, formatos.For_Nombre, Cal_TomaDefectos, ResC_Hora
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo
    INNER JOIN usuarios ON respuestas_calidad.Usu_Codigo = usuarios.Usu_Codigo
    INNER JOIN formatos ON  respuestas_calidad.For_Codigo = formatos.For_Codigo 
    WHERE For_Estado = 1 AND ResC_Estado = 1 ";
    
    if($usuario != ""){ 
      $pri = 1; 
      foreach($usuario as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " usuarios.Usu_Codigo = :usu".$pri." "; 
        $parametros[':usu'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    if($area != ""){ 
      $pri = 1; 
      foreach($area as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " areas.Are_Codigo = :are".$pri." "; 
        $parametros[':are'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
     if($valFecha == "0"){
      
      if($turno != "-1"){
        $sql .= " AND respuestas_calidad.Resc_Fecha BETWEEN :fecini AND :fecfin ";
        $parametros[':fecini'] = $fecha;
        $parametros[':fecfin'] = $fechaFinal;
        
        $sql .= " AND respuestas_calidad.ResC_Hora BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }else{
        if($fecha == $fechaFinal){
          $sql .= " AND ((respuestas_calidad.Resc_Fecha = :fecini
          AND respuestas_calidad.ResC_Hora BETWEEN :horini AND :horfin) OR (respuestas_calidad.Resc_Fecha = :fecfin
          AND respuestas_calidad.ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
          $parametros[':fecini'] = $fecha;
          $parametros[':fecfin'] = date( "Y-m-d", strtotime( $fecha . " + 1 days" ) );
          $parametros[':horini'] = $horaTurnoIni;
          $parametros[':horfin'] = "23:59:00";
          $parametros[':horini2'] = "00:00:00";
          $parametros[':horfin2'] = date( "H:i:s", strtotime( $horaTurnoFin . " - 1 minute" ) );
        }else{
          $sql .= " AND CONCAT_WS(' ', respuestas_calidad.Resc_Fecha, respuestas_calidad.ResC_Hora) BETWEEN :fecini AND :fecfin ";
          $parametros[':fecini'] = $fecha." ".$horaTurnoIni;
          $parametros[':fecfin'] = $fechaFinal." ".date( "H:i:s", strtotime( $horaTurnoFin . " - 1 minute" ) );
        }
      }
      
    }else{
      $sql .= " AND ((respuestas_calidad.Resc_Fecha = :fecini
      AND respuestas_calidad.ResC_Hora BETWEEN :horini AND :horfin) OR (respuestas_calidad.Resc_Fecha = :fecfin
      AND respuestas_calidad.ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = date( "Y-m-d", strtotime( $fecha . " + 1 days" ) );
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    if($referenciaConsulta != ""){ 
       
      foreach($referenciaConsulta as $registro8){ 

        if($registro8 == "0"){ 
          $sql .= " AND (";  
        }else{
         $sql .= " OR ";
       }
        
        $sql .= " (respuestas_calidad.For_Codigo = :for".$registro8." "; 
        $parametros[':for'.$registro8] = $formato[$registro8]; 
      
        $sql .= " AND respuestas_calidad.ResC_Familia = :fam".$registro8." "; 
        $parametros[':fam'.$registro8] = $familia[$registro8]; 
        
        $sql .= " AND respuestas_calidad.ResC_Color = :col".$registro8." ".")"; 
        $parametros[':col'.$registro8] = $color[$registro8]; 
      }
      $sql .= " ) "; 
    }
    
    $sql .= " ORDER BY calidad.Cal_TomaDefectos ASC, usuarios.Usu_Codigo ASC";
    
//    if($_SESSION['CP_Usuario'] == "1"){
//        echo "---listarConsultaEstadisticaCalidadPrinpal---"."<br>".$sql;
//        var_dump($parametros);
//        echo "<br>";
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
  public function listarConsultaEstadisticaCalidadPrinpalDetalle($formato, $familia, $color,$horaInicial3, $horaFinal3, $usuario, $area, $turno, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha){
    
     $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color);

    $sql = "SELECT ResC_Codigo, EstU_Codigo, Cal_Nombre, calidad.Are_Codigo, ResC_ValorControl, usuarios.Usu_Codigo, CONCAT_WS(' ',usuarios.Usu_Nombres,usuarios.Usu_Apellidos) AS nombres,
    ResC_Fecha, areas.Are_Nombre, respuestas_calidad.For_Codigo, respuestas_calidad.ResC_Familia, respuestas_calidad.ResC_Color, formatos.For_Nombre, Cal_TomaDefectos, ResC_Hora
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo
    INNER JOIN usuarios ON respuestas_calidad.Usu_Codigo = usuarios.Usu_Codigo
    INNER JOIN formatos ON  respuestas_calidad.For_Codigo = formatos.For_Codigo 
    WHERE For_Estado = 1 AND ResC_Estado = 1 AND respuestas_calidad.For_Codigo = :for AND respuestas_calidad.ResC_Familia = :fam AND respuestas_calidad.ResC_Color = :col ";
    
    if($usuario != "" && $usuario != null){ 
      $pri = 1; 
      foreach($usuario as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " usuarios.Usu_Codigo = :usu".$pri." "; 
        $parametros[':usu'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
//    if($area != "" && $area != null){ 
//      $pri = 1; 
//      foreach($area as $registro){ 
//        if($pri == "1"){ 
//          $sql .= " AND (";  
//        }else{ 
//          $sql .= " OR "; 
//        } 
//        $sql .= " areas.Are_Codigo = :are".$pri." "; 
//        $parametros[':are'.$pri] = $registro; 
//        $pri++; 
//      } 
//      $sql .= " entro2)"; 
//    }
    
     if($valFecha == "0"){
      $sql .= " AND respuestas_calidad.Resc_Fecha BETWEEN :fecini AND :fecfin ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      
      if($turno != "-1"){
        $sql .= " AND respuestas_calidad.ResC_Hora BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }
      
    }else{
      $sql .= " AND ((respuestas_calidad.Resc_Fecha = :fecini
      AND respuestas_calidad.ResC_Hora BETWEEN :horini AND :horfin) OR (respuestas_calidad.Resc_Fecha = :fecfin
      AND respuestas_calidad.ResC_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    $sql .= " ORDER BY calidad.Cal_TomaDefectos ASC, usuarios.Usu_Codigo ASC";

    
//    echo "---principal---"."<br>".$sql;
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
  public function usuariosRegistroRespuestaCalidad(){

    $sql = "SELECT DISTINCT ResC_UsuarioCrea, CONCAT_WS(' ', usuarios.Usu_Nombres, usuarios.Usu_Apellidos) AS nombre
    FROM respuestas_calidad
    INNER JOIN usuarios ON respuestas_calidad.ResC_UsuarioCrea  = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE ResC_Estado = 1
    ORDER BY nombre ASC";

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
  public function listarRespuestasCalidadUsuLogueados($formato, $familia, $color, $fecha, $horaInicial, $horaFinal){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":fec"=>$fecha,":horI"=>$horaInicial,":horF"=>$horaFinal);

    $sql = "SELECT estaciones_usuarios.Usu_Codigo, PueT_Nombre, formatos.For_Nombre, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl, calidad.Cal_TomaDefectos,
    calidad.Are_Codigo, Cal_ValorCritico, Cal_Tolerancia, Cal_Operador, Are_Tipo
    FROM respuestas_calidad 
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1 
    INNER JOIN estaciones_usuarios ON respuestas_calidad.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN usuarios ON respuestas_calidad.ResC_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1 
    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col 
    AND ResC_Fecha = :fec AND ResC_Hora BETWEEN :horI AND :horF
    ORDER BY ResC_Hora ASC";

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
  public function listarInfoRespuestasMaPePSFiltroCalidad($formato, $familia, $color, $fecha, $horaInicial, $horaFinal, $agrupacion){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":fec"=>$fecha,":horI"=>$horaInicial,":horF"=>$horaFinal,":agr"=>$agrupacion);

    $sql = "SELECT estaciones_usuarios.Usu_Codigo, PueT_Nombre, formatos.For_Nombre, ResC_Familia, ResC_Color, ResC_Hora, ResC_ValorControl, calidad.Cal_TomaDefectos,
    calidad.Are_Codigo, Cal_ValorCritico, Cal_Tolerancia, Cal_Operador, Are_Tipo
    FROM respuestas_calidad 
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN agrupaciones_areas ON areas.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1 
    INNER JOIN estaciones_usuarios ON respuestas_calidad.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN usuarios ON respuestas_calidad.ResC_UsuarioCrea = usuarios.Usu_Codigo AND Usu_Estado = 1 
    WHERE ResC_Estado = 1 AND formatos.For_Nombre = :for AND ResC_Familia = :fam AND ResC_Color = :col 
    AND ResC_Fecha = :fec AND ResC_Hora BETWEEN :horI AND :horF AND agrupaciones.Agr_Codigo = :agr
    ORDER BY ResC_Hora ASC";

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
  public function listarPorcentajesDefectologiaSegunda($agrupacion, $fecha, $fechaSiguiente, $horaFinal, $horaInicial){

    $parametros = array(":agr"=>$agrupacion,":fec"=>$fecha,":fecS"=>$fechaSiguiente,":horF"=>$horaFinal,":horI"=>$horaInicial);

    $sql = "SELECT AVG(ALL ResC_ValorControl), For_Codigo, ResC_Familia, ResC_Color, MAX(ResC_Hora), ResC_Fecha, t.Tur_Codigo, t.Tur_Nombre 
    FROM respuestas_calidad r 
    INNER JOIN estaciones_usuarios e ON r.EstU_Codigo = e.EstU_Codigo AND e.EstU_Estado = 1 
    INNER JOIN turnos t ON e.Tur_Codigo = t.Tur_Codigo AND t.Tur_estado = 1 
    INNER JOIN calidad c ON r.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1  
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1  
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo AND agrupaciones_areas.AgrA_Estado = 1 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND agrupaciones.Agr_Estado = 1 
    WHERE ((ResC_Fecha = :fec AND ( ResC_Hora >= :horI)) OR (ResC_Fecha = :fecS AND ( ResC_Hora BETWEEN '00:00:00' AND :horF) ) ) AND agrupaciones.Agr_Codigo = :agr AND Cal_TomaDefectos = '2'
    GROUP BY For_Codigo, ResC_Familia, ResC_Color, ResC_Fecha, t.Tur_Codigo";

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
  public function listarPorcentajesDefectologiaPrimera($agrupacion, $fecha, $fechaSiguiente, $horaFinal, $horaInicial){

    $parametros = array(":agr"=>$agrupacion,":fec"=>$fecha,":fecS"=>$fechaSiguiente,":horF"=>$horaFinal,":horI"=>$horaInicial);

    $sql = "SELECT AVG(ALL ResC_ValorControl), For_Codigo, ResC_Familia, ResC_Color, MAX(ResC_Hora), ResC_Fecha, t.Tur_Codigo, t.Tur_Nombre 
    FROM respuestas_calidad r 
    INNER JOIN estaciones_usuarios e ON r.EstU_Codigo = e.EstU_Codigo AND e.EstU_Estado = 1 
    INNER JOIN turnos t ON e.Tur_Codigo = t.Tur_Codigo AND t.Tur_estado = 1 
    INNER JOIN calidad c ON r.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1  
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1  
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo AND agrupaciones_areas.AgrA_Estado = 1 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND agrupaciones.Agr_Estado = 1 
    WHERE ((ResC_Fecha = :fec AND ( ResC_Hora >= :horI)) OR (ResC_Fecha = :fecS AND ( ResC_Hora BETWEEN '00:00:00' AND :horF) ) ) AND agrupaciones.Agr_Codigo = :agr AND Cal_TomaDefectos = '1'
    GROUP BY For_Codigo, ResC_Familia, ResC_Color, ResC_Fecha, t.Tur_Codigo";

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
  public function listarPorcentajesDefectologiaRotura($agrupacion, $fecha, $fechaSiguiente, $horaFinal, $horaInicial){

    $parametros = array(":agr"=>$agrupacion,":fec"=>$fecha,":fecS"=>$fechaSiguiente,":horF"=>$horaFinal,":horI"=>$horaInicial);

    $sql = "SELECT AVG(ALL ResC_ValorControl), For_Codigo, ResC_Familia, ResC_Color, MAX(ResC_Hora), ResC_Fecha, t.Tur_Codigo, t.Tur_Nombre 
    FROM respuestas_calidad r 
    INNER JOIN estaciones_usuarios e ON r.EstU_Codigo = e.EstU_Codigo AND e.EstU_Estado = 1 
    INNER JOIN turnos t ON e.Tur_Codigo = t.Tur_Codigo AND t.Tur_estado = 1 
    INNER JOIN calidad c ON r.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1  
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1  
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo AND agrupaciones_areas.AgrA_Estado = 1 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND agrupaciones.Agr_Estado = 1 
    WHERE ((ResC_Fecha = :fec AND ( ResC_Hora >= :horI)) OR (ResC_Fecha = :fecS AND ( ResC_Hora BETWEEN '00:00:00' AND :horF) ) ) AND agrupaciones.Agr_Codigo = :agr AND Cal_TomaDefectos = '3'
    GROUP BY For_Codigo, ResC_Familia, ResC_Color, ResC_Fecha, t.Tur_Codigo";

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
  public function listarInfoPlanarLinerInforme($agrupacion, $fecha, $fechaSiguiente, $horaFinal, $horaInicial){

    $parametros = array(":agr"=>$agrupacion,":fec"=>$fecha,":fecS"=>$fechaSiguiente,":horF"=>$horaFinal,":horI"=>$horaInicial);

    $sql = "SELECT ResC_Codigo, respuestas_calidad.Cal_Codigo, calidad.cal_Nombre, t.Tur_Nombre,formatos.For_Codigo, formatos.For_Nombre, ResC_Familia,
    ResC_Color, AVG(ResC_ValorControl),
    calidad.Cal_TomaDefectos,ResC_Fecha, t.Tur_Codigo
    FROM respuestas_calidad
    INNER JOIN calidad ON respuestas_calidad.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1 
    INNER JOIN agrupaciones_areas ON areas.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo 
    INNER JOIN formatos ON respuestas_calidad.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN estaciones_usuarios ON respuestas_calidad.EstU_Codigo = estaciones_usuarios.EstU_Codigo
    INNER JOIN turnos t ON estaciones_usuarios.Tur_Codigo = t.Tur_Codigo AND t.Tur_estado = 1 
    WHERE ResC_Estado = 1 AND Cal_TomaDefectos != '1' AND Cal_TomaDefectos != '2' AND Cal_TomaDefectos != '3' 
    AND ((ResC_Fecha = :fec AND ( ResC_Hora >= :horI)) OR 
    (ResC_Fecha = :fecS AND ( ResC_Hora BETWEEN '00:00:00' AND :horF) ) ) AND agrupaciones.Agr_Codigo = :agr
    GROUP BY respuestas_calidad.Cal_Codigo, formatos.For_Nombre, ResC_Familia, ResC_Color, calidad.Cal_TomaDefectos, calidad.Are_Codigo,
    Cal_TomaDefectos,ResC_Fecha, t.Tur_Nombre
    ORDER BY ResC_Familia, ResC_Fecha, t.Tur_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
