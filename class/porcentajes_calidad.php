<?php
require_once('basedatos.php');

  class porcentajes_calidad extends basedatos {
    private $PorC_Codigo;
    private $ProP_Codigo;
    private $Usu_Codigo;
    private $Porc_Fecha;
    private $Porc_Hora;
    private $Porc_Formato;
    private $Porc_Familia;
    private $Porc_Color;
    private $Porc_PorcentajePrimera;
    private $Porc_PorcentajeSegunda;
    private $Porc_PorcentajeRotura;
    private $Porc_Volumen;
    private $Porc_UsuarioCrea;
    private $Porc_FechaHora;
    private $Porc_Estado;

  function __construct($PorC_Codigo = NULL, $ProP_Codigo = NULL, $Usu_Codigo = NULL, $Porc_Fecha = NULL, $Porc_Hora = NULL, $Porc_Formato = NULL, $Porc_Familia = NULL, $Porc_Color = NULL, $Porc_PorcentajePrimera = NULL, $Porc_PorcentajeSegunda = NULL, $Porc_PorcentajeRotura = NULL, $Porc_Volumen = NULL, $Porc_UsuarioCrea = NULL, $Porc_FechaHora = NULL, $Porc_Estado = NULL) {
    $this->PorC_Codigo = $PorC_Codigo;
    $this->ProP_Codigo = $ProP_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->Porc_Fecha = $Porc_Fecha;
    $this->Porc_Hora = $Porc_Hora;
    $this->Porc_Formato = $Porc_Formato;
    $this->Porc_Familia = $Porc_Familia;
    $this->Porc_Color = $Porc_Color;
    $this->Porc_PorcentajePrimera = $Porc_PorcentajePrimera;
    $this->Porc_PorcentajeSegunda = $Porc_PorcentajeSegunda;
    $this->Porc_PorcentajeRotura = $Porc_PorcentajeRotura;
    $this->Porc_Volumen = $Porc_Volumen;
    $this->Porc_UsuarioCrea = $Porc_UsuarioCrea;
    $this->Porc_FechaHora = $Porc_FechaHora;
    $this->Porc_Estado = $Porc_Estado;
    $this->tabla = "porcentajes_calidad";
  }

  function getPorC_Codigo() {
    return $this->PorC_Codigo;
  }

  function getProP_Codigo() {
    return $this->ProP_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getPorc_Fecha() {
    return $this->Porc_Fecha;
  }

  function getPorc_Hora() {
    return $this->Porc_Hora;
  }

  function getPorc_Formato() {
    return $this->Porc_Formato;
  }

  function getPorc_Familia() {
    return $this->Porc_Familia;
  }

  function getPorc_Color() {
    return $this->Porc_Color;
  }

  function getPorc_PorcentajePrimera() {
    return $this->Porc_PorcentajePrimera;
  }

  function getPorc_PorcentajeSegunda() {
    return $this->Porc_PorcentajeSegunda;
  }

  function getPorc_PorcentajeRotura() {
    return $this->Porc_PorcentajeRotura;
  }

  function getPorc_Volumen() {
    return $this->Porc_Volumen;
  }

  function getPorc_UsuarioCrea() {
    return $this->Porc_UsuarioCrea;
  }

  function getPorc_FechaHora() {
    return $this->Porc_FechaHora;
  }

  function getPorc_Estado() {
    return $this->Porc_Estado;
  }

  function setPorC_Codigo($PorC_Codigo) {
    $this->PorC_Codigo = $PorC_Codigo;
  }

  function setProP_Codigo($ProP_Codigo) {
    $this->ProP_Codigo = $ProP_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setPorc_Fecha($Porc_Fecha) {
    $this->Porc_Fecha = $Porc_Fecha;
  }

  function setPorc_Hora($Porc_Hora) {
    $this->Porc_Hora = $Porc_Hora;
  }

  function setPorc_Formato($Porc_Formato) {
    $this->Porc_Formato = $Porc_Formato;
  }

  function setPorc_Familia($Porc_Familia) {
    $this->Porc_Familia = $Porc_Familia;
  }

  function setPorc_Color($Porc_Color) {
    $this->Porc_Color = $Porc_Color;
  }

  function setPorc_PorcentajePrimera($Porc_PorcentajePrimera) {
    $this->Porc_PorcentajePrimera = $Porc_PorcentajePrimera;
  }

  function setPorc_PorcentajeSegunda($Porc_PorcentajeSegunda) {
    $this->Porc_PorcentajeSegunda = $Porc_PorcentajeSegunda;
  }

  function setPorc_PorcentajeRotura($Porc_PorcentajeRotura) {
    $this->Porc_PorcentajeRotura = $Porc_PorcentajeRotura;
  }

  function setPorc_Volumen($Porc_Volumen) {
    $this->Porc_Volumen = $Porc_Volumen;
  }

  function setPorc_UsuarioCrea($Porc_UsuarioCrea) {
    $this->Porc_UsuarioCrea = $Porc_UsuarioCrea;
  }

  function setPorc_FechaHora($Porc_FechaHora) {
    $this->Porc_FechaHora = $Porc_FechaHora;
  }

  function setPorc_Estado($Porc_Estado) {
    $this->Porc_Estado = $Porc_Estado;
  }

  public function insertar(){
    $campos = array("ProP_Codigo", "Usu_Codigo", "Porc_Fecha", "Porc_Hora", "Porc_Formato", "Porc_Familia", "Porc_Color", "Porc_PorcentajePrimera", "Porc_PorcentajeSegunda", "Porc_PorcentajeRotura", "Porc_Volumen", "Porc_UsuarioCrea", "Porc_FechaHora", "Porc_Estado");
    $valores = array(
    array(
      $this->ProP_Codigo, 
      $this->Usu_Codigo, 
      $this->Porc_Fecha, 
      $this->Porc_Hora, 
      $this->Porc_Formato, 
      $this->Porc_Familia, 
      $this->Porc_Color, 
      $this->Porc_PorcentajePrimera, 
      $this->Porc_PorcentajeSegunda, 
      $this->Porc_PorcentajeRotura, 
      $this->Porc_Volumen, 
      $this->Porc_UsuarioCrea, 
      $this->Porc_FechaHora, 
      $this->Porc_Estado
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
    $sql =  "SELECT * FROM porcentajes_calidad WHERE PorC_Codigo = :cod";
    $parametros = array(":cod"=>$this->PorC_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setProP_Codigo($res[1]);
      $this->setUsu_Codigo($res[2]);
      $this->setPorc_Fecha($res[3]);
      $this->setPorc_Hora($res[4]);
      $this->setPorc_Formato($res[5]);
      $this->setPorc_Familia($res[6]);
      $this->setPorc_Color($res[7]);
      $this->setPorc_PorcentajePrimera($res[8]);
      $this->setPorc_PorcentajeSegunda($res[9]);
      $this->setPorc_PorcentajeRotura($res[10]);
      $this->setPorc_Volumen($res[11]);
      $this->setPorc_UsuarioCrea($res[12]);
      $this->setPorc_FechaHora($res[13]);
      $this->setPorc_Estado($res[14]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("ProP_Codigo", "Usu_Codigo", "Porc_Fecha", "Porc_Hora", "Porc_Formato", "Porc_Familia", "Porc_Color", "Porc_PorcentajePrimera", "Porc_PorcentajeSegunda", "Porc_PorcentajeRotura", "Porc_Volumen", "Porc_UsuarioCrea", "Porc_FechaHora", "Porc_Estado");
    $valores = array($this->getProP_Codigo(), $this->getUsu_Codigo(), $this->getPorc_Fecha(), $this->getPorc_Hora(), $this->getPorc_Formato(), $this->getPorc_Familia(), $this->getPorc_Color(), $this->getPorc_PorcentajePrimera(), $this->getPorc_PorcentajeSegunda(), $this->getPorc_PorcentajeRotura(), $this->getPorc_Volumen(), $this->getPorc_UsuarioCrea(), $this->getPorc_FechaHora(), $this->getPorc_Estado());
    $llaveprimaria = "PorC_Codigo";
    $valorllaveprimaria = $this->getPorC_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM porcentajes_calidad WHERE PorC_Codigo = :cod";
    $parametros = array(":cod"=>$this->PorC_Codigo);
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
  public function listarPorcentajesCalidadSupervisor($progProdu, $FechaInicialRes, $FechaFinalRes){

    $parametros = array(":pro"=>$progProdu,":fecI"=>$FechaInicialRes,":fecF"=>$FechaFinalRes);

    $sql = "SELECT PorC_Codigo, Porc_Fecha, Porc_Hora, Porc_PorcentajePrimera, Porc_PorcentajeSegunda, Porc_PorcentajeRotura, Porc_Volumen
    FROM porcentajes_calidad
    WHERE ProP_Codigo = :pro AND Porc_Estado = '1' AND Porc_Fecha BETWEEN :fecI AND :fecF ";

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
  public function listarPorcentajesCalidadSupervisorAct($FechaInicialRes, $FechaFinalRes, $ProgProdArea, $formato, $familia, $color){
    $parametros = array(":fecI"=>$FechaInicialRes,":fecF"=>$FechaFinalRes,":are"=>$ProgProdArea, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);
    $sql = "SELECT PorC_Codigo, Porc_Fecha, Porc_Hora, Porc_PorcentajePrimera, Porc_PorcentajeSegunda, Porc_PorcentajeRotura, Porc_Volumen    FROM porcentajes_calidad
    INNER JOIN programa_produccion ON porcentajes_calidad.ProP_Codigo = programa_produccion.ProP_Codigo    
    WHERE Porc_Estado = '1' AND Porc_Fecha BETWEEN :fecI AND :fecF AND programa_produccion.Are_Codigo = :are AND For_Codigo = :for AND ProP_Familia = :fam AND ProP_Color = :col";  
    
    if($_SESSION['CP_Usuario'] == "1"){
    echo "------"."<br>".$sql;
    var_dump($parametros);
    echo "<br>";
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
  public function listarPorcentajesCalidadSupervisorInforme($referenciaConsulta, $formato, $familia, $color,$horaInicial3, $horaFinal3, $turno, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha,$horaTurnoIni,$horaTurnoFin){

    $parametros = array();

    $sql = "SELECT PorC_Codigo, Porc_Fecha, Porc_Hora, Porc_PorcentajePrimera, Porc_PorcentajeSegunda, Porc_PorcentajeRotura, Porc_Volumen
    FROM porcentajes_calidad
    WHERE Porc_Estado = '1' ";
    
     if($valFecha == "0"){
    //  $sql .= " AND Porc_Fecha BETWEEN :fecini AND :fecfin ";
//      $parametros[':fecini'] = $fecha;
//      $parametros[':fecfin'] = $fechaFinal;
      
      if($turno != "-1"){
        $sql .= " AND Porc_Hora BETWEEN :horini AND :horfin ";
        $parametros[':horini'] = $horaInicial3;
        $parametros[':horfin'] = $horaFinal3;
      }
      else{
        $sql .= " AND ((Porc_Fecha = :fecini
      AND Porc_Hora BETWEEN :horini AND :horfin) OR (Porc_Fecha = :fecfin
      AND Porc_Hora BETWEEN :horini2 AND :horfin2)) ";
        $parametros[':fecini'] = $fecha;
        $parametros[':fecfin'] = date( "Y-m-d", strtotime( $fecha . " + 1 days" ) );
        $parametros[':horini'] = $horaTurnoIni;
        $parametros[':horfin'] = "23:59:00";
        $parametros[':horini2'] = "00:00:00";
        $parametros[':horfin2'] = date( "H:i:s", strtotime( $horaTurnoFin . " - 1 minute" ) );
      }
      
    }else{
      $sql .= " AND ((Porc_Fecha = :fecini
      AND Porc_Hora BETWEEN :horini AND :horfin) OR (Porc_Fecha = :fecfin
      AND Porc_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
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
        
        $sql .= " ( Porc_Formato = :for".$registro8." "; 
        $parametros[':for'.$registro8] = $formato[$registro8]; 
      
        $sql .= " AND Porc_Familia = :fam".$registro8." "; 
        $parametros[':fam'.$registro8] = $familia[$registro8]; 
        
        $sql .= " AND Porc_Color = :col".$registro8." ".")"; 
        $parametros[':col'.$registro8] = $color[$registro8]; 
      }
      $sql .= " ) "; 
    }
    
//    if($_SESSION['CP_Usuario'] == "1"){
//    echo "---listarPorcentajesCalidadSupervisorInforme---"."<br>".$sql;
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
  public function listarPorcentajesCalidad($progProdu, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha){

    $parametros = array(":pro"=>$progProdu);

    $sql = "SELECT PorC_Codigo, Porc_Fecha, Porc_Hora, Porc_PorcentajePrimera, Porc_PorcentajeSegunda, Porc_PorcentajeRotura, Porc_Volumen
    FROM porcentajes_calidad
    WHERE ProP_Codigo = :pro AND Porc_Estado = '1' ";
    
    
      if($valFecha == "0"){
        $sql .= " AND Porc_Fecha = :fec ";
        $parametros[':fec'] = $fecha;
      }else{
      $sql .= " AND ((Porc_Fecha = :fecini
      AND Porc_Hora BETWEEN :horini AND :horfin) OR (Porc_Fecha = :fecfin
      AND Porc_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
//    if($_SESSION['CP_Usuario'] == "6"){
//    echo "---listarPorcentajesCalidad---"."<br>".$sql;
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
  /* 
  public function listarPorcentajesCalidadArea($progProdu, $fecha, $fechaFinal, $horaInicial, $horaFinal, $horaInicial2, $horaFinal2, $valFecha, $area){

    $parametros = array(":pro"=>$progProdu, ":are"=>$area);

    $sql = "SELECT PorC_Codigo, Porc_Fecha, Porc_Hora, Porc_PorcentajePrimera, Porc_PorcentajeSegunda, Porc_PorcentajeRotura, Porc_Volumen
    FROM porcentajes_calidad
    INNER JOIN programa_produccion ON programa_produccion.ProP_Codigo = porcentajes_calidad.ProP_Codigo AND ProP_Estado = '1'
    WHERE porcentajes_calidad.ProP_Codigo = :pro AND Porc_Estado = '1' AND Are_Codigo = :are ";
    
    
      if($valFecha == "0"){
        $sql .= " AND Porc_Fecha = :fec ";
        $parametros[':fec'] = $fecha;
      }else{
      $sql .= " AND ((Porc_Fecha = :fecini
      AND Porc_Hora BETWEEN :horini AND :horfin) OR (Porc_Fecha = :fecfin
      AND Porc_Hora BETWEEN :horini2 AND :horfin2)) ";
      $parametros[':fecini'] = $fecha;
      $parametros[':fecfin'] = $fechaFinal;
      $parametros[':horini'] = $horaInicial;
      $parametros[':horfin'] = $horaFinal;
      $parametros[':horini2'] = $horaInicial2;
      $parametros[':horfin2'] = $horaFinal2;
    }
    
    echo $sql;
    var_dump($parametros);
  
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }*/
}
?>
