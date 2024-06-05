<?php
require_once('basedatos.php');

  class formularios_defectos extends basedatos {
    private $ForD_Codigo;
    private $Cal_Codigo;
    private $EstU_Codigo;
    private $For_Codigo;
    private $ForD_Familia;
    private $ForD_Color;
    private $ForD_Defecto;
    private $ForD_Estampo;
    private $ForD_Lado;
    private $ForD_NumeroPiezas;
    private $ForD_Hora;
    private $ForD_Fecha;
    private $ForD_FechaHoraCrea;
    private $ForD_UsuarioCrea;
    private $ForD_Estado;

  function __construct($ForD_Codigo = NULL, $Cal_Codigo = NULL, $EstU_Codigo = NULL, $For_Codigo = NULL, $ForD_Familia = NULL, $ForD_Color = NULL, $ForD_Defecto = NULL, $ForD_Estampo = NULL, $ForD_Lado = NULL, $ForD_NumeroPiezas = NULL, $ForD_Hora = NULL, $ForD_Fecha = NULL, $ForD_FechaHoraCrea = NULL, $ForD_UsuarioCrea = NULL, $ForD_Estado = NULL) {
    $this->ForD_Codigo = $ForD_Codigo;
    $this->Cal_Codigo = $Cal_Codigo;
    $this->EstU_Codigo = $EstU_Codigo;
    $this->For_Codigo = $For_Codigo;
    $this->ForD_Familia = $ForD_Familia;
    $this->ForD_Color = $ForD_Color;
    $this->ForD_Defecto = $ForD_Defecto;
    $this->ForD_Estampo = $ForD_Estampo;
    $this->ForD_Lado = $ForD_Lado;
    $this->ForD_NumeroPiezas = $ForD_NumeroPiezas;
    $this->ForD_Hora = $ForD_Hora;
    $this->ForD_Fecha = $ForD_Fecha;
    $this->ForD_FechaHoraCrea = $ForD_FechaHoraCrea;
    $this->ForD_UsuarioCrea = $ForD_UsuarioCrea;
    $this->ForD_Estado = $ForD_Estado;
    $this->tabla = "formularios_defectos";
  }

  function getForD_Codigo() {
    return $this->ForD_Codigo;
  }

  function getCal_Codigo() {
    return $this->Cal_Codigo;
  }

  function getEstU_Codigo() {
    return $this->EstU_Codigo;
  }

  function getFor_Codigo() {
    return $this->For_Codigo;
  }

  function getForD_Familia() {
    return $this->ForD_Familia;
  }

  function getForD_Color() {
    return $this->ForD_Color;
  }

  function getForD_Defecto() {
    return $this->ForD_Defecto;
  }

  function getForD_Estampo() {
    return $this->ForD_Estampo;
  }

  function getForD_Lado() {
    return $this->ForD_Lado;
  }

  function getForD_NumeroPiezas() {
    return $this->ForD_NumeroPiezas;
  }

  function getForD_Hora() {
    return $this->ForD_Hora;
  }

  function getForD_Fecha() {
    return $this->ForD_Fecha;
  }

  function getForD_FechaHoraCrea() {
    return $this->ForD_FechaHoraCrea;
  }

  function getForD_UsuarioCrea() {
    return $this->ForD_UsuarioCrea;
  }

  function getForD_Estado() {
    return $this->ForD_Estado;
  }

  function setForD_Codigo($ForD_Codigo) {
    $this->ForD_Codigo = $ForD_Codigo;
  }

  function setCal_Codigo($Cal_Codigo) {
    $this->Cal_Codigo = $Cal_Codigo;
  }

  function setEstU_Codigo($EstU_Codigo) {
    $this->EstU_Codigo = $EstU_Codigo;
  }

  function setFor_Codigo($For_Codigo) {
    $this->For_Codigo = $For_Codigo;
  }

  function setForD_Familia($ForD_Familia) {
    $this->ForD_Familia = $ForD_Familia;
  }

  function setForD_Color($ForD_Color) {
    $this->ForD_Color = $ForD_Color;
  }

  function setForD_Defecto($ForD_Defecto) {
    $this->ForD_Defecto = $ForD_Defecto;
  }

  function setForD_Estampo($ForD_Estampo) {
    $this->ForD_Estampo = $ForD_Estampo;
  }

  function setForD_Lado($ForD_Lado) {
    $this->ForD_Lado = $ForD_Lado;
  }

  function setForD_NumeroPiezas($ForD_NumeroPiezas) {
    $this->ForD_NumeroPiezas = $ForD_NumeroPiezas;
  }

  function setForD_Hora($ForD_Hora) {
    $this->ForD_Hora = $ForD_Hora;
  }

  function setForD_Fecha($ForD_Fecha) {
    $this->ForD_Fecha = $ForD_Fecha;
  }

  function setForD_FechaHoraCrea($ForD_FechaHoraCrea) {
    $this->ForD_FechaHoraCrea = $ForD_FechaHoraCrea;
  }

  function setForD_UsuarioCrea($ForD_UsuarioCrea) {
    $this->ForD_UsuarioCrea = $ForD_UsuarioCrea;
  }

  function setForD_Estado($ForD_Estado) {
    $this->ForD_Estado = $ForD_Estado;
  }

  public function insertar(){
    $campos = array("Cal_Codigo", "EstU_Codigo", "For_Codigo", "ForD_Familia", "ForD_Color", "ForD_Defecto", "ForD_Estampo", "ForD_Lado", "ForD_NumeroPiezas", "ForD_Hora", "ForD_Fecha", "ForD_FechaHoraCrea", "ForD_UsuarioCrea", "ForD_Estado");
    $valores = array(
    array(
      $this->Cal_Codigo, 
      $this->EstU_Codigo, 
      $this->For_Codigo, 
      $this->ForD_Familia, 
      $this->ForD_Color, 
      $this->ForD_Defecto, 
      $this->ForD_Estampo, 
      $this->ForD_Lado, 
      $this->ForD_NumeroPiezas, 
      $this->ForD_Hora, 
      $this->ForD_Fecha, 
      $this->ForD_FechaHoraCrea, 
      $this->ForD_UsuarioCrea, 
      $this->ForD_Estado
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
    $sql =  "SELECT * FROM formularios_defectos WHERE ForD_Codigo = :cod";
    $parametros = array(":cod"=>$this->ForD_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setCal_Codigo($res[1]);
      $this->setEstU_Codigo($res[2]);
      $this->setFor_Codigo($res[3]);
      $this->setForD_Familia($res[4]);
      $this->setForD_Color($res[5]);
      $this->setForD_Defecto($res[6]);
      $this->setForD_Estampo($res[7]);
      $this->setForD_Lado($res[8]);
      $this->setForD_NumeroPiezas($res[9]);
      $this->setForD_Hora($res[10]);
      $this->setForD_Fecha($res[11]);
      $this->setForD_FechaHoraCrea($res[12]);
      $this->setForD_UsuarioCrea($res[13]);
      $this->setForD_Estado($res[14]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Cal_Codigo", "EstU_Codigo", "For_Codigo", "ForD_Familia", "ForD_Color", "ForD_Defecto", "ForD_Estampo", "ForD_Lado", "ForD_NumeroPiezas", "ForD_Hora", "ForD_Fecha", "ForD_FechaHoraCrea", "ForD_UsuarioCrea", "ForD_Estado");
    $valores = array($this->getCal_Codigo(), $this->getEstU_Codigo(), $this->getFor_Codigo(), $this->getForD_Familia(), $this->getForD_Color(), $this->getForD_Defecto(), $this->getForD_Estampo(), $this->getForD_Lado(), $this->getForD_NumeroPiezas(), $this->getForD_Hora(), $this->getForD_Fecha(), $this->getForD_FechaHoraCrea(), $this->getForD_UsuarioCrea(), $this->getForD_Estado());
    $llaveprimaria = "ForD_Codigo";
    $valorllaveprimaria = $this->getForD_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM formularios_defectos WHERE ForD_Codigo = :cod";
    $parametros = array(":cod"=>$this->ForD_Codigo);
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
  public function listardefectos($tomaDefectos, $hora, $fecha, $formato, $familia, $color, $codPueTr){

    $parametros = array(":def"=>$tomaDefectos,":hor"=>$hora,":fec"=>$fecha,":for"=>$formato,":fam"=>$familia,":col"=>$color,":cod"=>$codPueTr);

    $sql = "SELECT 	ForD_Codigo, p1.Par_Nombre, p2.Par_Nombre, p3.Par_Nombre, ForD_NumeroPiezas, p1.Par_Codigo, p2.Par_Codigo, p3.Par_Codigo
    FROM formularios_defectos 
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 AND p1.Par_Tipo = 11
    INNER JOIN parametros p2 ON formularios_defectos.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1 AND p2.Par_Tipo = 14
    INNER JOIN parametros p3 ON formularios_defectos.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1 AND p3.Par_Tipo = 13
    INNER JOIN estaciones_usuarios ON formularios_defectos.EstU_Codigo = estaciones_usuarios.EstU_Codigo 
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = :def AND ForD_Hora = :hor AND ForD_Fecha = :fec
    AND For_Codigo = :for AND ForD_Familia = :fam AND ForD_Color = :col AND estaciones_usuarios.PueT_Codigo = :cod ORDER BY p1.Par_Nombre ASC";

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
    public function listardefectosTodosTS($formato, $familia, $color, $area, $agrupacion, $fechaInicial, $fechaFinal){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":agr"=>$agrupacion, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT DISTINCT ForD_Defecto, p1.Par_Nombre AS defecto, p2.Par_Nombre AS estampo, p3.Par_Nombre AS lado, ForD_NumeroPiezas,
    formatos.For_Nombre, ForD_Familia, ForD_Color, calidad.Are_Codigo, ForD_Hora,ForD_Fecha
    FROM formularios_defectos 
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 
    INNER JOIN parametros p2 ON formularios_defectos.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1 
    INNER JOIN parametros p3 ON formularios_defectos.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1 
    INNER JOIN formatos ON formularios_defectos.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN agrupaciones_areas ON calidad.Are_Codigo = agrupaciones_areas.Are_Codigo
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 2 AND formatos.For_Nombre = :for 
    AND ForD_Familia = :fam AND ForD_Color = :col AND agrupaciones_areas.Agr_Codigo = :agr AND ForD_Fecha BETWEEN :fecini AND :fecfin ";
    
    if($area != "-1"){
       $sql .= " AND (calidad.Are_Codigo = :are) "; 
      $parametros[':are'] = $area; 
    }
    
    $sql .= " ORDER BY defecto ASC";
      
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
  public function listardefectosRotura($tomaDefectos, $hora, $fecha, $formato, $familia, $color, $codPueTr){

    $parametros = array(":def"=>$tomaDefectos,":hor"=>$hora,":fec"=>$fecha,":for"=>$formato,":fam"=>$familia,":col"=>$color,":cod"=>$codPueTr);

    $sql = "SELECT 	ForD_Codigo, p1.Par_Nombre, p2.Par_Nombre, p3.Par_Nombre, ForD_NumeroPiezas, p1.Par_Codigo, p2.Par_Codigo, p3.Par_Codigo
    FROM formularios_defectos 
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 AND p1.Par_Tipo = 12
    INNER JOIN parametros p2 ON formularios_defectos.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1 AND p2.Par_Tipo = 14
    INNER JOIN parametros p3 ON formularios_defectos.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1 AND p3.Par_Tipo = 13
    INNER JOIN estaciones_usuarios ON formularios_defectos.EstU_Codigo = estaciones_usuarios.EstU_Codigo 
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = :def AND ForD_Hora = :hor AND ForD_Fecha = :fec
    AND For_Codigo = :for AND ForD_Familia = :fam AND ForD_Color = :col AND estaciones_usuarios.PueT_Codigo = :cod ORDER BY p1.Par_Nombre ASC";

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
  public function listardefectosSinPuestoTra($tomaDefectos, $hora, $fecha, $formato, $familia, $color, $codPueTr){

    $parametros = array(":def"=>$tomaDefectos,":hor"=>$hora,":fec"=>$fecha,":for"=>$formato,":fam"=>$familia,":col"=>$color);

    $sql = "SELECT 	ForD_Codigo, p1.Par_Nombre, p2.Par_Nombre, p3.Par_Nombre, ForD_NumeroPiezas
    FROM formularios_defectos 
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1
    INNER JOIN parametros p2 ON formularios_defectos.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1
    INNER JOIN parametros p3 ON formularios_defectos.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1 
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = :def AND ForD_Hora = :hor AND ForD_Fecha = :fec
    AND For_Codigo = :for AND ForD_Familia = :fam AND ForD_Color = :col ORDER BY p1.Par_Nombre ASC";

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
  public function listarderfectosUnicos($formato, $familia, $color, $area, $agrupacion, $horaInicial3, $horaFinal3, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $turno){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":agr"=>$agrupacion);

    $sql = "SELECT DISTINCT FD2.ForD_Defecto, p1.Par_Nombre AS defecto,
    (SELECT p4.Par_Nombre 
    FROM formularios_defectos FD1
    INNER JOIN calidad c2 ON FD1.Cal_Codigo = c2.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p4 ON FD1.ForD_Estampo = p4.Par_Codigo AND p4.Par_Estado = 1
    INNER JOIN formatos f1 ON FD1.For_Codigo = f1.For_Codigo AND f1.For_Estado = 1 
    INNER JOIN agrupaciones_areas aa1 ON c2.Are_Codigo = aa1.Are_Codigo
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 2 AND ForD_Fecha = FD2.ForD_Fecha
    AND f1.For_Nombre = f2.For_Nombre AND ForD_Familia = FD2.ForD_Familia
    AND ForD_Color = FD2.ForD_Color AND aa1.Agr_Codigo = aa2.Agr_Codigo and ForD_Defecto = FD2.ForD_Defecto
    ORDER BY ForD_FechaHoraCrea DESC
    LIMIT 1) AS estampo, 
    (SELECT p5.Par_Nombre
    FROM formularios_defectos FD3
    INNER JOIN calidad ON FD3.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p5 ON FD3.ForD_Lado = p5.Par_Codigo AND p5.Par_Estado = 1
    INNER JOIN formatos f3 ON FD3.For_Codigo = f3.For_Codigo AND f3.For_Estado = 1 
    INNER JOIN agrupaciones_areas aa3 ON calidad.Are_Codigo = aa3.Are_Codigo
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 2 AND ForD_Fecha = FD2.ForD_Fecha
    AND f3.For_Nombre = f2.For_Nombre AND ForD_Familia = FD2.ForD_Familia
    AND ForD_Color = FD2.ForD_Color AND aa3.Agr_Codigo = aa2.Agr_Codigo and ForD_Defecto = FD2.ForD_Defecto
    ORDER BY ForD_FechaHoraCrea DESC
    LIMIT 1) AS lado,
    ForD_NumeroPiezas, f2.For_Nombre, ForD_Familia, ForD_Color, c1.Are_Codigo, FD2.ForD_Estampo,FD2.ForD_Fecha, c1.Cal_Codigo, FD2.ForD_Codigo, FD2.EstU_Codigo, FD2.ForD_Defecto
    FROM formularios_defectos FD2
    INNER JOIN calidad c1 ON FD2.Cal_Codigo = c1.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON FD2.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1
    INNER JOIN parametros p2 ON FD2.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1
    INNER JOIN parametros p3 ON FD2.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1
    INNER JOIN formatos f2 ON FD2.For_Codigo = f2.For_Codigo AND f2.For_Estado = 1 
    INNER JOIN agrupaciones_areas aa2 ON c1.Are_Codigo = aa2.Are_Codigo
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 2
    AND f2.For_Nombre = :for AND FD2.ForD_Familia = :fam
    AND FD2.ForD_Color = :col AND aa2.Agr_Codigo = :agr  ";
    
    if($area != "-1"){
       $sql .= " AND (c1.Are_Codigo = :are)"; 
      $parametros[':are'] = $area; 
    }
    
    if($valFecha == "0"){
      
      if($turno != "-1"){
        $sql .= " AND FD2.ForD_Fecha = :fec ";
        $parametros[':fec'] = $fecha;
        
        $sql .= " AND ForD_Hora BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }else{
        $sql .= "AND ((FD2.ForD_Fecha = :fec AND ( ForD_Hora >= :horini)) OR (FD2.ForD_Fecha = :fecfin AND ( ForD_Hora BETWEEN '00:00:00' AND :horfin) ) ) ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
        $parametros[':fec'] = $fecha;
        $parametros[':fecfin'] = $fechaFinal;
        
//        $sql .= " AND ForD_Hora >= :horini ";
//        $parametros[':horini'] = $horaInicial3;
      }
      
    }else{
      $sql .= " AND ((FD2.ForD_Fecha = :fecini
      AND ForD_Hora BETWEEN :horini AND :horfin) OR (FD2.ForD_Fecha = :fecfin
      AND ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    
    $sql .= " GROUP BY ForD_Defecto ORDER BY defecto ASC";

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
  public function listarderfectosUnicosOperador($formato, $familia, $color, $area, $turno, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $horIni, $horFin){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color);

    $sql = "SELECT DISTINCT FD2.ForD_Defecto, p1.Par_Nombre AS defecto,
    (SELECT p4.Par_Nombre 
    FROM formularios_defectos FD1
    INNER JOIN calidad c2 ON FD1.Cal_Codigo = c2.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p4 ON FD1.ForD_Estampo = p4.Par_Codigo AND p4.Par_Estado = 1
    INNER JOIN formatos f1 ON FD1.For_Codigo = f1.For_Codigo AND f1.For_Estado = 1 
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 2 AND ForD_Fecha = FD2.ForD_Fecha
    AND f1.For_Nombre = f2.For_Nombre AND ForD_Familia = FD2.ForD_Familia
    AND ForD_Color = FD2.ForD_Color and ForD_Defecto = FD2.ForD_Defecto
    ORDER BY ForD_FechaHoraCrea DESC
    LIMIT 1) AS estampo, 
    (SELECT p5.Par_Nombre
    FROM formularios_defectos FD3
    INNER JOIN calidad ON FD3.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p5 ON FD3.ForD_Lado = p5.Par_Codigo AND p5.Par_Estado = 1
    INNER JOIN formatos f3 ON FD3.For_Codigo = f3.For_Codigo AND f3.For_Estado = 1 
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 2 AND ForD_Fecha = FD2.ForD_Fecha
    AND f3.For_Nombre = f2.For_Nombre AND ForD_Familia = FD2.ForD_Familia
    AND ForD_Color = FD2.ForD_Color and ForD_Defecto = FD2.ForD_Defecto
    ORDER BY ForD_FechaHoraCrea DESC
    LIMIT 1) AS lado,
    ForD_NumeroPiezas, f2.For_Nombre, ForD_Familia, ForD_Color, c1.Are_Codigo, FD2.ForD_Estampo,FD2.ForD_Fecha 
    FROM formularios_defectos FD2
    INNER JOIN calidad c1 ON FD2.Cal_Codigo = c1.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON FD2.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1
    INNER JOIN parametros p2 ON FD2.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1
    INNER JOIN parametros p3 ON FD2.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1
    INNER JOIN formatos f2 ON FD2.For_Codigo = f2.For_Codigo AND f2.For_Estado = 1 
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 2
    AND f2.For_Nombre = :for AND FD2.ForD_Familia = :fam
    AND FD2.ForD_Color = :col ";
    
    if($area != "-1"){
       $sql .= " AND (c1.Are_Codigo = :are)"; 
      $parametros[':are'] = $area; 
    }
    
     if($valFecha == "0"){
      $sql .= " AND FD2.ForD_Fecha = :fec AND FD2.ForD_Hora BETWEEN :horIni2 AND :horFin3  ";
      $parametros[':fec'] = $fecha;
      $parametros[':horIni2'] = $horIni;
      $parametros[':horFin3'] = $horFin;
    }else{
      $sql .= " AND ((FD2.ForD_Fecha = :fecini
      AND ForD_Hora BETWEEN :horini AND :horfin) OR (FD2.ForD_Fecha = :fecfin
      AND ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
//    if($turno != "-1"){
//       $sql .= " AND (ForD_Hora BETWEEN :horI AND :horF)"; 
//      $parametros[':horI'] = $horainicial; 
//      $parametros[':horF'] = $horaFinal; 
//    }
    
    $sql .= " GROUP BY ForD_Defecto ORDER BY defecto ASC";

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
    public function listarderfectosTodos($formato, $familia, $color, $area, $agrupacion, $fechaInicial, $fechaFinal){
    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":agr"=>$agrupacion, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);
    $sql = "SELECT ForD_Defecto, p1.Par_Nombre AS defecto, p2.Par_Nombre AS estampo, p3.Par_Nombre AS lado, ForD_NumeroPiezas,    formatos.For_Nombre, ForD_Familia, ForD_Color, calidad.Are_Codigo, ForD_Hora,ForD_Fecha
    FROM formularios_defectos     
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1  INNER JOIN parametros p2 ON formularios_defectos.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1 
    INNER JOIN parametros p3 ON formularios_defectos.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1    INNER JOIN formatos ON formularios_defectos.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN agrupaciones_areas ON calidad.Are_Codigo = agrupaciones_areas.Are_Codigo    
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 2 AND formatos.For_Nombre = :for 
    AND ForD_Familia = :fam AND ForD_Color = :col AND agrupaciones_areas.Agr_Codigo = :agr AND ForD_Fecha BETWEEN :fecini AND :fecfin ";    
    if($area != "-1"){       $sql .= " AND (calidad.Are_Codigo = :are) "; 
      $parametros[':are'] = $area;     }
        $sql .= " ORDER BY defecto ASC";
          $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();    $this->desconectar();
    return $res;  }  
    
  /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
    */
    public function listarderfectosTodosOperador($formato, $familia, $color, $area, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color);

    $sql = "SELECT ForD_Defecto, p1.Par_Nombre AS defecto, p2.Par_Nombre AS estampo, p3.Par_Nombre AS lado, ForD_NumeroPiezas,
    formatos.For_Nombre, ForD_Familia, ForD_Color, calidad.Are_Codigo, ForD_Hora
    FROM formularios_defectos 
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 
    INNER JOIN parametros p2 ON formularios_defectos.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1 
    INNER JOIN parametros p3 ON formularios_defectos.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1 
    INNER JOIN formatos ON formularios_defectos.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 2 AND formatos.For_Nombre = :for 
    AND ForD_Familia = :fam AND ForD_Color = :col ";
      
    if($valFecha == "0"){
      $sql .= " AND ForD_Fecha = :fec  ";
      $parametros[':fec'] = $fecha;
      
    }else{
      $sql .= " AND ((ForD_Fecha = :fecini
      AND ForD_Hora BETWEEN :horini AND :horfin) OR (ForD_Fecha = :fecfin
      AND ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    if($area != "-1"){
       $sql .= " AND (calidad.Are_Codigo = :are) "; 
      $parametros[':are'] = $area; 
    }
    
    $sql .= " ORDER BY defecto ASC";

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
  public function listarderfectosUnicosRetal($formato, $familia, $color, $area, $agrupacion, $horaInicial3, $horaFinal3, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $turno){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color, ":agr"=>$agrupacion);

    $sql = "SELECT DISTINCT FD2.ForD_Defecto, p1.Par_Nombre AS defecto,
    p8.Par_Nombre, p9.Par_Nombre,
    ForD_NumeroPiezas, f2.For_Nombre, ForD_Familia, ForD_Color, c1.Are_Codigo, FD2.ForD_Estampo, FD2.ForD_Fecha, c1.Cal_Codigo, FD2.ForD_Codigo, FD2.EstU_Codigo, FD2.ForD_Defecto
    FROM formularios_defectos FD2
    INNER JOIN calidad c1 ON FD2.Cal_Codigo = c1.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON FD2.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1
    INNER JOIN parametros p2 ON FD2.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1
    INNER JOIN parametros p3 ON FD2.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1
    INNER JOIN parametros p8 ON FD2.ForD_Lado = p8.Par_Codigo AND p8.Par_Estado = 1
    INNER JOIN parametros p9 ON FD2.ForD_Lado = p9.Par_Codigo AND p9.Par_Estado = 1
    INNER JOIN formatos f2 ON FD2.For_Codigo = f2.For_Codigo AND f2.For_Estado = 1 
    INNER JOIN agrupaciones_areas aa2 ON c1.Are_Codigo = aa2.Are_Codigo
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 3
    AND f2.For_Nombre = :for AND FD2.ForD_Familia = :fam
    AND FD2.ForD_Color = :col AND aa2.Agr_Codigo = :agr ";
    
    if($area != "-1"){
       $sql .= " AND (c1.Are_Codigo = :are)"; 
      $parametros[':are'] = $area; 
    }
    
    if($valFecha == "0"){
      
      if($turno != "-1"){
        $sql .= " AND FD2.ForD_Fecha = :fec ";
        $parametros[':fec'] = $fecha;
        
        $sql .= " AND FD2.ForD_Hora BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }else{
        $sql .= "AND ((FD2.ForD_Fecha = :fec AND ( FD2.ForD_Hora >= :horini)) OR (FD2.ForD_Fecha = :fecfin AND ( FD2.ForD_Hora BETWEEN '00:00:00' AND :horfin) ) ) ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
        $parametros[':fec'] = $fecha;
        $parametros[':fecfin'] = $fechaFinal;
      }
      
    }else{
      $sql .= " AND ((FD2.ForD_Fecha = :fecini
      AND FD2.ForD_Hora BETWEEN :horini AND :horfin) OR (FD2.ForD_Fecha = :fecfin
      AND FD2.ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    $sql .= " GROUP BY ForD_Defecto ORDER BY defecto ASC";

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
  public function listarderfectosUnicosRetalOperador($formato, $familia, $color, $area, $horaInicial3, $horaFinal3, $turno, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color);

    $sql = "SELECT DISTINCT FD2.ForD_Defecto, p1.Par_Nombre AS defecto,
    p8.Par_Nombre, p9.Par_Nombre,
    ForD_NumeroPiezas, f2.For_Nombre, ForD_Familia, ForD_Color, c1.Are_Codigo, FD2.ForD_Estampo, FD2.ForD_Fecha, c1.Cal_Codigo, FD2.ForD_Codigo, FD2.EstU_Codigo, FD2.ForD_Defecto
    FROM formularios_defectos FD2
    INNER JOIN calidad c1 ON FD2.Cal_Codigo = c1.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON FD2.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1
    INNER JOIN parametros p2 ON FD2.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1
    INNER JOIN parametros p3 ON FD2.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1
    INNER JOIN parametros p8 ON FD2.ForD_Lado = p8.Par_Codigo AND p8.Par_Estado = 1
    INNER JOIN parametros p9 ON FD2.ForD_Lado = p9.Par_Codigo AND p9.Par_Estado = 1
    INNER JOIN formatos f2 ON FD2.For_Codigo = f2.For_Codigo AND f2.For_Estado = 1 
    INNER JOIN agrupaciones_areas aa2 ON c1.Are_Codigo = aa2.Are_Codigo
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 3
    AND f2.For_Nombre = :for AND FD2.ForD_Familia = :fam
    AND FD2.ForD_Color = :col ";
    
    if($area != "-1"){
       $sql .= " AND (c1.Are_Codigo = :are)"; 
      $parametros[':are'] = $area; 
    }
    
    if($valFecha == "0"){
      $sql .= " AND FD2.ForD_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
      
      if($turno != "-1"){
        $sql .= " AND (ForD_Hora BETWEEN :horI AND :horF)"; 
        $parametros[':horI'] = $horaInicial3; 
        $parametros[':horF'] = $horaFinal3; 
      }else{
        $sql .= " AND ForD_Hora >= :horI ";
        $parametros[':horI'] = $horaInicial3;
      }
      
    }else{
      $sql .= " AND ((FD2.ForD_Fecha = :fecini
      AND ForD_Hora BETWEEN :horini AND :horfin) OR (FD2.ForD_Fecha = :fecfin
      AND ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    $sql .= " GROUP BY ForD_Defecto ORDER BY defecto ASC";

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
    public function listarderfectosTodosRetal($formato, $familia, $color, $area, $agrupacion, $fechaInicial, $fechaFinal){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":agr"=>$agrupacion, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT ForD_Defecto, p1.Par_Nombre AS defecto, p2.Par_Nombre AS estampo, p3.Par_Nombre AS lado, ForD_NumeroPiezas,
    formatos.For_Nombre, ForD_Familia, ForD_Color, calidad.Are_Codigo, ForD_Hora,ForD_Fecha
    FROM formularios_defectos 
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 
    INNER JOIN parametros p2 ON formularios_defectos.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1 
    INNER JOIN parametros p3 ON formularios_defectos.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1 
    INNER JOIN formatos ON formularios_defectos.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN agrupaciones_areas ON calidad.Are_Codigo = agrupaciones_areas.Are_Codigo
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 3 AND formatos.For_Nombre = :for 
    AND ForD_Familia = :fam AND ForD_Color = :col AND agrupaciones_areas.Agr_Codigo = :agr AND ForD_Fecha BETWEEN :fecini AND :fecfin ";
    
    if($area != "-1"){
       $sql .= " AND (calidad.Are_Codigo = :are)"; 
      $parametros[':are'] = $area; 
    }
    
    $sql .= " GROUP BY defecto, estampo, lado, ForD_NumeroPiezas,formatos.For_Nombre, ForD_Familia, ForD_Color,ForD_Hora, calidad.Are_Codigo ORDER BY defecto ASC";

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
    public function listarderfectosTodosRetalOperador($formato, $familia, $color, $area, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $horaInicial3, $horaFinal3, $turno){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color);

    $sql = "SELECT ForD_Defecto, p1.Par_Nombre AS defecto, p2.Par_Nombre AS estampo, p3.Par_Nombre AS lado, ForD_NumeroPiezas,
    formatos.For_Nombre, ForD_Familia, ForD_Color, calidad.Are_Codigo, ForD_Hora
    FROM formularios_defectos 
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 
    INNER JOIN parametros p2 ON formularios_defectos.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1 
    INNER JOIN parametros p3 ON formularios_defectos.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1 
    INNER JOIN formatos ON formularios_defectos.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = 3 AND formatos.For_Nombre = :for 
    AND ForD_Familia = :fam AND ForD_Color = :col ";
    
    if($area != "-1"){
       $sql .= " AND (calidad.Are_Codigo = :are)"; 
      $parametros[':are'] = $area; 
    }
      
   if($valFecha == "0"){
      $sql .= " AND ForD_Fecha = :fec ";
      $parametros[':fec'] = $fecha;
      
      if($turno != "-1"){
        $sql .= " AND ForD_Hora BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }
      
    }else{
      $sql .= " AND ((ForD_Fecha = :fecini
      AND ForD_Hora BETWEEN :horini AND :horfin) OR (ForD_Fecha = :fecfin
      AND ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    $sql .= " GROUP BY defecto, estampo, lado, ForD_NumeroPiezas,formatos.For_Nombre, ForD_Familia, ForD_Color,ForD_Hora, calidad.Are_Codigo ORDER BY defecto ASC";

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
  public function listardefectosEstadistica($referenciaConsulta, $formato, $familia, $color, $horaInicial3, $horaFinal3, $defecto, $turno, $area, $usuario, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha,$horaTurnoIni,$horaTurnoFin, $fechas){
 
    $parametros = array(":def"=>$defecto);
 
    $sql = "SELECT p1.Par_Nombre as defecto, SUM(ForD_NumeroPiezas) AS CantDef, For_Codigo, ForD_Familia, ForD_Color, EstU_Codigo
    FROM formularios_defectos   
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1   
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1  
    INNER JOIN parametros p2 ON formularios_defectos.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1  
    INNER JOIN parametros p3 ON formularios_defectos.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1   
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = :def "; 
//    if($valFecha == "0"){
////      $sql .= " AND ForD_Fecha BETWEEN :fecini AND :fecfin ";
////      $parametros[':fecini'] = $fecha;
////      $parametros[':fecfin'] = $fechaFinal;
//      
//      if($turno != "-1"){
//        $sql .= " AND (ForD_Hora BETWEEN :horini AND :horfin) ";
//        $parametros[':horini'] = $horaInicial3;
//        $parametros[':horfin'] = $horaFinal3;
//      }else{
//       if($fecha == $fechaFinal){
//          $sql .= " AND ((ForD_Fecha = :fecini
//          AND ForD_Hora BETWEEN :horini AND :horfin) OR (ForD_Fecha = :fecfin
//          AND ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
//          $parametros[':fecini'] = $fecha;
//          $parametros[':fecfin'] = date( "Y-m-d", strtotime( $fecha . " + 1 days" ) );
//          $parametros[':horini'] = $horaTurnoIni;
//          $parametros[':horfin'] = "23:59:00";
//          $parametros[':horini2'] = "00:00:00";
//          $parametros[':horfin2'] = date( "H:i:s", strtotime( $horaTurnoFin . " - 1 minute" ) );
//        }else{         
////          $sql .= " AND ((ForD_Fecha = :fecini
////          AND ForD_Hora BETWEEN :horini AND :horfin) OR (ForD_Fecha = :fecfin
////          AND ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
////          $parametros[':fecini'] = $fecha;
////          $parametros[':fecfin'] = $fechaFinal;
////          $parametros[':horini'] = $$horaTurnoIni;
////          $parametros[':horfin'] = $horaFinal;
////          $parametros[':horini2'] = $horaInicial2;
////          $parametros[':horfin2'] = $horaFinal2;
//         
//          $sql .= " AND ForD_Fecha BETWEEN :fecini AND :fecfin ";
//          $parametros[':fecini'] = $fecha." ".$horaTurnoIni;
//          $parametros[':fecfin'] = $fechaFinal." ".date( "H:i:s", strtotime( $horaTurnoFin . " - 1 minute" ) );
//        }
//      }
//      
//    }else{
//      $sql .= " AND ((ForD_Fecha = :fecini
//      AND ForD_Hora BETWEEN :horini AND :horfin) OR (ForD_Fecha = :fecfin
//      AND ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
//      $parametros[':fecini'] = $fecha;
//      $parametros[':fecfin'] = $fechaFinal;
//      $parametros[':horini'] = $horaInicial;
//      $parametros[':horfin'] = $horaFinal;
//      $parametros[':horini2'] = $horaInicial2;
//      $parametros[':horfin2'] = $horaFinal2;
//    }
    if($valFecha == "0"){
      if($turno != "-1"){ 
        if($fechas != ""){  
          $pri6 = 1;  
          foreach($fechas as $registro6){  
            if($pri6 == "1"){  
              $sql .= " AND (";   
            }else{  
              $sql .= " OR ";  
            }  
            $sql .= " ((ForD_Fecha = :fec".$pri6." AND ( ForD_Hora BETWEEN :horiniT".$pri6." AND :horfinT".$pri6.")) )";  
            $parametros[':fec'.$pri6] = $registro6;
            $parametros[':horiniT'.$pri6] = $horaInicial3;
            $parametros[':horfinT'.$pri6] = $horaFinal3;  
            $pri6++;  
          }  
          $sql .= " )";  
        }  
      }else{ 
        $sql .= "AND ((ForD_Fecha = :fec AND ( ForD_Hora >= :horini)) OR (ForD_Fecha = :fecfin AND ( ForD_Hora BETWEEN '00:00:00' AND :horfin) ) ) ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
        $parametros[':fec'] = $fecha;
        $parametros[':fecfin'] = $fechaFinal;
      }
    }else{ 
      if($fechas != ""){  
        $pri6 = 1;  
        foreach($fechas as $registro6){  
          if($pri6 == "1"){  
            $sql .= " AND (";   
          }else{  
            $sql .= " OR ";  
          }
          if($pri6==1){
            $sql .= " ((ForD_Fecha = :fec".$pri6." AND ( ForD_Hora BETWEEN :horini".$pri6." AND :horfin".$pri6.")) )";  
            $parametros[':fec'.$pri6] = $registro6;
            $parametros[':horini'.$pri6] = $horaInicial;
            $parametros[':horfin'.$pri6] = $horaFinal;
          }else{
            if($pri6==count($fechas)){
              $sql .= " ((ForD_Fecha = :fec".$pri6." AND ( ForD_Hora BETWEEN :horini2".$pri6." AND :horfin2".$pri6.")) )";  
              $parametros[':fec'.$pri6] = $registro6;
              $parametros[':horini2'.$pri6] = $horaInicial2;
              $parametros[':horfin2'.$pri6] = $horaFinal2;
            }else{
              $sql .= " ((ForD_Fecha = :fec".$pri6." AND ( ForD_Hora BETWEEN :horini1".$pri6." AND :horfin1".$pri6.")) )";  
              $parametros[':fec'.$pri6] = $registro6;
              $parametros[':horini1'.$pri6] = $horaInicial2;
              $parametros[':horfin1'.$pri6] = $horaFinal;
            }
          }
          $pri6++;  
        }  
        $sql .= " )";  
      }
    }
    if($area != ""){ 
      $pri = 1; 
      foreach($area as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " calidad.Are_Codigo = :are".$pri." "; 
        $parametros[':are'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    if($usuario != ""){ 
      $pri2 = 1; 
      foreach($usuario as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " ForD_UsuarioCrea = :usu".$pri2." "; 
        $parametros[':usu'.$pri2] = $registro2; 
        $pri2++; 
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
        $sql .= " (For_Codigo = :for".$registro8." "; 
        $parametros[':for'.$registro8] = $formato[$registro8]; 
        $sql .= " AND ForD_Familia = :fam".$registro8." "; 
        $parametros[':fam'.$registro8] = $familia[$registro8]; 
        $sql .= " AND ForD_Color = :col".$registro8." ".")"; 
        $parametros[':col'.$registro8] = $color[$registro8]; 
      }
      $sql .= " ) "; 
    }
    $sql .= " GROUP BY defecto ORDER BY CantDef DESC";
//    
//    if($_SESSION['CP_Usuario'] == "1"){
//        echo $sql;
//        echo "<br>";
//        var_dump($parametros);
//    }
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
  public function listardefectosEstadisticaTodos($referenciaConsulta, $formato, $familia, $color, $horaInicial3, $horaFinal3, $defecto, $turno, $area, $usuario, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $horaTurnoIni, $horaTurnoFin, $fechas){
 
    $parametros = array(":def"=>$defecto);
 
    $sql = "SELECT p1.Par_Nombre as defecto, ForD_NumeroPiezas, For_Codigo, ForD_Familia, ForD_Color, EstU_Codigo, ForD_Hora, ForD_Fecha
    FROM formularios_defectos   
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1   
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1  
    INNER JOIN parametros p2 ON formularios_defectos.ForD_Estampo = p2.Par_Codigo AND p2.Par_Estado = 1  
    INNER JOIN parametros p3 ON formularios_defectos.ForD_Lado = p3.Par_Codigo AND p3.Par_Estado = 1   
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = :def ";     
    if($valFecha == "0"){
      if($turno != "-1"){ 
        if($fechas != ""){  
          $pri6 = 1;  
          foreach($fechas as $registro6){  
            if($pri6 == "1"){  
              $sql .= " AND (";   
            }else{  
              $sql .= " OR ";  
            }  
            $sql .= " ((ForD_Fecha = :fec".$pri6." AND ( ForD_Hora BETWEEN :horiniT".$pri6." AND :horfinT".$pri6.")) )";  
            $parametros[':fec'.$pri6] = $registro6;
            $parametros[':horiniT'.$pri6] = $horaInicial3;
            $parametros[':horfinT'.$pri6] = $horaFinal3;  
            $pri6++;  
          }  
          $sql .= " )";  
        }  
      }else{ 
        $sql .= "AND ((ForD_Fecha = :fec AND ( ForD_Hora >= :horini)) OR (ForD_Fecha = :fecfin AND ( ForD_Hora BETWEEN '00:00:00' AND :horfin) ) ) ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
        $parametros[':fec'] = $fecha;
        $parametros[':fecfin'] = $fechaFinal;
      }
    }else{ 
      if($fechas != ""){  
        $pri6 = 1;  
        foreach($fechas as $registro6){  
          if($pri6 == "1"){  
            $sql .= " AND (";   
          }else{  
            $sql .= " OR ";  
          }
          if($pri6==1){
            $sql .= " ((ForD_Fecha = :fec".$pri6." AND ( ForD_Hora BETWEEN :horini".$pri6." AND :horfin".$pri6.")) )";  
            $parametros[':fec'.$pri6] = $registro6;
            $parametros[':horini'.$pri6] = $horaInicial;
            $parametros[':horfin'.$pri6] = $horaFinal;
          }else{
            if($pri6==count($fechas)){
              $sql .= " ((ForD_Fecha = :fec".$pri6." AND ( ForD_Hora BETWEEN :horini2".$pri6." AND :horfin2".$pri6.")) )";  
              $parametros[':fec'.$pri6] = $registro6;
              $parametros[':horini2'.$pri6] = $horaInicial2;
              $parametros[':horfin2'.$pri6] = $horaFinal2;
            }else{
              $sql .= " ((ForD_Fecha = :fec".$pri6." AND ( ForD_Hora BETWEEN :horini1".$pri6." AND :horfin1".$pri6.")) )";  
              $parametros[':fec'.$pri6] = $registro6;
              $parametros[':horini1'.$pri6] = $horaInicial2;
              $parametros[':horfin1'.$pri6] = $horaFinal;
            }
          }
          $pri6++;  
        }  
        $sql .= " )";  
      }
    }
 
//    if($valFecha == "0"){
////      $sql .= " AND ForD_Fecha BETWEEN :fecini AND :fecfin ";
////      $parametros[':fecini'] = $fecha;
////      $parametros[':fecfin'] = $fechaFinal;
//      
//      if($turno != "-1"){
//        $sql .= " AND (ForD_Hora BETWEEN :horini AND :horfin) ";
//        $parametros[':horini'] = $horaInicial3;
//        $parametros[':horfin'] = $horaFinal3;
//      }else{
//         if($fecha == $fechaFinal){
//          $sql .= " AND ((ForD_Fecha = :fecini
//          AND ForD_Hora BETWEEN :horini AND :horfin) OR (ForD_Fecha = :fecfin
//          AND ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
//          $parametros[':fecini'] = $fecha;
//          $parametros[':fecfin'] = date( "Y-m-d", strtotime( $fecha . " + 1 days" ) );
//          $parametros[':horini'] = $horaTurnoIni;
//          $parametros[':horfin'] = "23:59:00";
//          $parametros[':horini2'] = "00:00:00";
//          $parametros[':horfin2'] = date( "H:i:s", strtotime( $horaTurnoFin . " - 1 minute" ) );
//        }else{
//          $sql .= " AND ForD_Fecha BETWEEN :fecini AND :fecfin ";
//          $parametros[':fecini'] = $fecha." ".$horaTurnoIni;
//          $parametros[':fecfin'] = $fechaFinal." ".date( "H:i:s", strtotime( $horaTurnoFin . " - 1 minute" ) );
//        }
//      }
//      
//    }else{
//      $sql .= " AND ((ForD_Fecha = :fecini
//      AND ForD_Hora BETWEEN :horini AND :horfin) OR (ForD_Fecha = :fecfin
//      AND ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
//      $parametros[':fecini'] = $fecha;
//      $parametros[':fecfin'] = $fechaFinal;
//      $parametros[':horini'] = $horaInicial;
//      $parametros[':horfin'] = $horaFinal;
//      $parametros[':horini2'] = $horaInicial2;
//      $parametros[':horfin2'] = $horaFinal2;
//    }
    if($area != ""){ 
      $pri = 1; 
      foreach($area as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " calidad.Are_Codigo = :are".$pri." "; 
        $parametros[':are'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    if($usuario != ""){ 
      $pri2 = 1; 
      foreach($usuario as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " ForD_UsuarioCrea = :usu".$pri2." "; 
        $parametros[':usu'.$pri2] = $registro2; 
        $pri2++; 
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
        $sql .= " (For_Codigo = :for".$registro8." "; 
        $parametros[':for'.$registro8] = $formato[$registro8]; 
        $sql .= " AND ForD_Familia = :fam".$registro8." "; 
        $parametros[':fam'.$registro8] = $familia[$registro8]; 
        $sql .= " AND ForD_Color = :col".$registro8." ".")"; 
        $parametros[':col'.$registro8] = $color[$registro8]; 
      }
      $sql .= " ) "; 
    }
//    if($_SESSION['CP_Usuario'] == "1"){
//      echo "---Todos---"."<br>".$sql;
//      var_dump($parametros);
//      echo "<br>";
//    }
 
    
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
  public function listardefectosDiaAnterior($defecto,$fechaAyer,$puestoTrabajo, $fechaHoy){

    $parametros = array(":def"=>$defecto,":fecA"=>$fechaAyer,":pue"=>$puestoTrabajo,":fecH"=>$fechaHoy);

    $sql = "SELECT DISTINCT ForD_Codigo, ForD_Defecto, p1.Par_Nombre
    FROM formularios_defectos 
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 AND p1.Par_Tipo = 11
    INNER JOIN estaciones_usuarios ON formularios_defectos.EstU_Codigo = estaciones_usuarios.EstU_Codigo 
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = :def AND ForD_Fecha BETWEEN :fecA AND :fecH
    AND estaciones_usuarios.PueT_Codigo = :pue
    GROUP BY ForD_Defecto, p1.Par_Nombre ORDER BY p1.Par_Nombre ASC";

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
  public function listardefectosDiaAnteriorRotura($defecto,$fechaAyer,$puestoTrabajo, $fechaHoy){

    $parametros = array(":def"=>$defecto,":fecA"=>$fechaAyer,":pue"=>$puestoTrabajo,":fecH"=>$fechaHoy);

    $sql = "SELECT DISTINCT ForD_Codigo, ForD_Defecto, p1.Par_Nombre
    FROM formularios_defectos 
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1 
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 AND p1.Par_Tipo = 12
    INNER JOIN estaciones_usuarios ON formularios_defectos.EstU_Codigo = estaciones_usuarios.EstU_Codigo 
    WHERE ForD_Estado = 1 AND Cal_TomaDefectos = :def AND ForD_Fecha BETWEEN :fecA AND :fecH
    AND estaciones_usuarios.PueT_Codigo = :pue
    GROUP BY ForD_Defecto, p1.Par_Nombre ORDER BY p1.Par_Nombre ASC";

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
  public function listardefectosPAC($formato, $familia, $color, $defecto,$calidad, $horaInicial3, $horaFinal3, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $turno){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":def"=>$defecto,":cal"=>$calidad);

    $sql = "SELECT ForD_Fecha, ForD_Hora, calidad.Cal_Nombre, p1.Par_Nombre, ForD_Codigo
    FROM formularios_defectos
    INNER JOIN calidad ON formularios_defectos.Cal_Codigo = calidad.Cal_Codigo AND Cal_Estado = 1
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1
    WHERE For_Codigo = :for AND ForD_Familia = :fam AND ForD_Color = :col 
    AND ForD_Defecto = :def AND formularios_defectos.Cal_Codigo = :cal
    AND ForD_Estado = 1 ";
    
    if($valFecha == "0"){
      
      if($turno != "-1"){
        $sql .= " AND ForD_Fecha = :fec ";
        $parametros[':fec'] = $fecha;
        
        $sql .= " AND ForD_Hora BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }else{
        $sql .= "AND ((ForD_Fecha = :fec AND ( ForD_Hora >= :horini)) OR (ForD_Fecha = :fecfin AND ( ForD_Hora BETWEEN '00:00:00' AND :horfin) ) ) ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
        $parametros[':fec'] = $fecha;
        $parametros[':fecfin'] = $fechaFinal;
      }
      
    }else{
      $sql .= " AND ((ForD_Fecha = :fecini
      AND ForD_Hora BETWEEN :horini AND :horfin) OR (ForD_Fecha = :fecfin
      AND ForD_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    $sql .= " ORDER BY ForD_Fecha ASC, ForD_Hora ASC";

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
  public function listarCierresCalidad($agrupacion, $horaInicio, $HoraFin, $fecha){

    $parametros = array(":agr"=>$agrupacion,":horI"=>$horaInicio,":horF"=>$HoraFin,":fec"=>$fecha);

    $sql = "SELECT a.Are_Nombre, p1.Par_Nombre, p2.Par_Nombre, p3.Par_Nombre, ForD_NumeroPiezas, ForD_Hora, ForD_Fecha, For_Codigo, ForD_Familia, ForD_Color, 
    ForD_FechaHoraCrea, p1.Par_Tipo, ForD_Defecto
    FROM formularios_defectos d
    INNER JOIN calidad c ON d.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo
    INNER JOIN parametros p1 ON ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1
    INNER JOIN parametros p2 ON ForD_Lado= p2.Par_Codigo AND p2.Par_Estado = 1
    INNER JOIN parametros p3 ON ForD_Estampo= p3.Par_Codigo AND p3.Par_Estado = 1
    WHERE ForD_Estado = 1 AND ForD_Fecha = :fec AND ForD_Hora BETWEEN :horI AND :horF
    AND agrupaciones.Agr_Codigo = :agr
    ORDER BY p1.Par_Tipo, ForD_FechaHoraCrea ASC";
    
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
  public function listarDefectosCierresCalidad($agrupacion, $fecha, $fechaSiguiente, $horaFinal, $horaInicial){

    $parametros = array(":agr"=>$agrupacion,":fec"=>$fecha,":fecS"=>$fechaSiguiente,":horF"=>$horaFinal,":horI"=>$horaInicial);

    $sql = "SELECT a.Are_Nombre, p1.Par_Nombre as defecto, p2.Par_Nombre as lado, p3.Par_Nombre as estampo, SUM(ForD_NumeroPiezas) AS CantDef, ForD_Fecha, For_Codigo, ForD_Familia, ForD_Color, p1.Par_Tipo, ForD_Defecto, Cal_AgrupadorSuma, e.Tur_Codigo, t.Tur_Nombre
    FROM formularios_defectos d
    INNER JOIN calidad c ON d.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo
    INNER JOIN parametros p1 ON ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1
    INNER JOIN parametros p2 ON ForD_Lado= p2.Par_Codigo AND p2.Par_Estado = 1
    INNER JOIN parametros p3 ON ForD_Estampo= p3.Par_Codigo AND p3.Par_Estado = 1
    INNER JOIN estaciones_usuarios e ON d.EstU_Codigo = e.EstU_Codigo AND e.EstU_Estado = 1
    INNER JOIN turnos t ON e.Tur_Codigo = t.Tur_Codigo AND t.Tur_estado = 1
    WHERE ForD_Estado = 1 AND ((d.ForD_Fecha = :fec AND ( ForD_Hora >= :horI)) OR (d.ForD_Fecha = :fecS AND ( d.ForD_Hora BETWEEN '00:00:00' AND :horF) ) )
    AND agrupaciones.Agr_Codigo = :agr AND c.Cal_AgrupadorSuma = 1
    GROUP BY p1.Par_Nombre, p1.Par_Tipo, ForD_Familia, Cal_AgrupadorSuma, e.Tur_Codigo, t.Tur_Nombre
    ORDER BY p1.Par_Nombre, For_Codigo, ForD_Familia, ForD_Color, p1.Par_Tipo ASC";
    
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
  public function listarDefectosCierresCalidadRotura($agrupacion, $fecha, $fechaSiguiente, $horaFinal, $horaInicial){

    $parametros = array(":agr"=>$agrupacion,":fec"=>$fecha,":fecS"=>$fechaSiguiente,":horF"=>$horaFinal,":horI"=>$horaInicial);

    $sql = "SELECT a.Are_Nombre, p1.Par_Nombre as defecto, p2.Par_Nombre as lado, p3.Par_Nombre as estampo, SUM(ForD_NumeroPiezas) AS CantDef, ForD_Fecha, For_Codigo, ForD_Familia, ForD_Color, p1.Par_Tipo, ForD_Defecto, Cal_AgrupadorSuma, e.Tur_Codigo, t.Tur_Nombre
    FROM formularios_defectos d
    INNER JOIN calidad c ON d.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo
    INNER JOIN parametros p1 ON ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1
    INNER JOIN parametros p2 ON ForD_Lado= p2.Par_Codigo AND p2.Par_Estado = 1
    INNER JOIN parametros p3 ON ForD_Estampo= p3.Par_Codigo AND p3.Par_Estado = 1
    INNER JOIN estaciones_usuarios e ON d.EstU_Codigo = e.EstU_Codigo AND e.EstU_Estado = 1
    INNER JOIN turnos t ON e.Tur_Codigo = t.Tur_Codigo AND t.Tur_estado = 1
    WHERE ForD_Estado = 1 AND ((d.ForD_Fecha = :fec AND ( ForD_Hora >= :horI)) OR (d.ForD_Fecha = :fecS AND ( d.ForD_Hora BETWEEN '00:00:00' AND :horF) ) )
    AND agrupaciones.Agr_Codigo = :agr AND c.Cal_AgrupadorSuma = 2
    GROUP BY p1.Par_Nombre, p1.Par_Tipo, ForD_Familia, Cal_AgrupadorSuma, e.Tur_Codigo, t.Tur_Nombre
    ORDER BY p1.Par_Nombre, For_Codigo, ForD_Familia, ForD_Color, p1.Par_Tipo ASC";
    
//    echo $sql;
//    var_dump($parametros);
    
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
  public function listarReferenciasCierreReferenciasTurno($agrupacion, $fecha, $fechaSiguiente, $horaFinal, $horaInicial){

    $parametros = array(":agr"=>$agrupacion,":fec"=>$fecha,":fecS"=>$fechaSiguiente,":horF"=>$horaFinal,":horI"=>$horaInicial);

    $sql = "SELECT DISTINCT For_Codigo, ForD_Familia, ForD_Color
FROM formularios_defectos d 
INNER JOIN calidad c ON d.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1 
INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1 
INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo 
INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo 
INNER JOIN parametros p1 ON ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 
INNER JOIN estaciones_usuarios e ON d.EstU_Codigo = e.EstU_Codigo AND e.EstU_Estado = 1
INNER JOIN turnos t ON e.Tur_Codigo = t.Tur_Codigo AND t.Tur_estado = 1
WHERE ForD_Estado = 1 AND ((d.ForD_Fecha = :fec AND ( ForD_Hora >= :horI)) OR (d.ForD_Fecha = :fecS AND ( d.ForD_Hora BETWEEN '00:00:00' AND :horF) ) ) AND agrupaciones.Agr_Codigo = :agr 
AND Cal_AgrupadorSuma = 2
GROUP BY For_Codigo, ForD_Familia, ForD_Color
HAVING MAX(ForD_FechaHoraCrea)
ORDER BY t.Tur_Codigo ASC, ForD_FechaHoraCrea ASC";
    
//    echo $sql;
//    var_dump($parametros);
    
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
  public function referenciasCierresCalidadSegunda($agrupacion, $horaInicio, $HoraFin, $fecha){

    $parametros = array(":agr"=>$agrupacion,":horI"=>$horaInicio,":horF"=>$HoraFin,":fec"=>$fecha);

    $sql = "SELECT DISTINCT For_Codigo, ForD_Familia, ForD_Color, MAX(ForD_FechaHoraCrea), MAX(ForD_Hora), Par_Tipo, Cal_AgrupadorSuma
    FROM formularios_defectos d 
    INNER JOIN calidad c ON d.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1 
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1 
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo 
    INNER JOIN parametros p1 ON ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 
    WHERE ForD_Estado = 1 AND ForD_Fecha = :fec AND agrupaciones.Agr_Codigo = :agr 
    AND ForD_Hora BETWEEN :horI AND :horF AND Cal_AgrupadorSuma = 1
    GROUP BY For_Codigo, ForD_Familia, ForD_Color, Par_Tipo, Cal_AgrupadorSuma
    ORDER BY Par_Tipo ASC, ForD_FechaHoraCrea ASC";
    
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
  public function referenciasCierresCalidadRotura($agrupacion, $horaInicio, $HoraFin, $fecha){

    $parametros = array(":agr"=>$agrupacion,":horI"=>$horaInicio,":horF"=>$HoraFin,":fec"=>$fecha);

    $sql = "SELECT DISTINCT For_Codigo, ForD_Familia, ForD_Color, MAX(ForD_FechaHoraCrea), MAX(ForD_Hora), Par_Tipo, Cal_AgrupadorSuma
    FROM formularios_defectos d 
    INNER JOIN calidad c ON d.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1 
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1 
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo 
    INNER JOIN parametros p1 ON ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 
    WHERE ForD_Estado = 1 AND ForD_Fecha = :fec AND agrupaciones.Agr_Codigo = :agr 
    AND ForD_Hora BETWEEN :horI AND :horF AND Cal_AgrupadorSuma = 2
    GROUP BY For_Codigo, ForD_Familia, ForD_Color, Par_Tipo, Cal_AgrupadorSuma
    ORDER BY Par_Tipo ASC, ForD_FechaHoraCrea ASC";
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
