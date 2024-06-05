<?php
require_once('basedatos.php');

  class programa_produccion extends basedatos {
    private $ProP_Codigo;
    private $Pla_Codigo;
    private $For_Codigo;
    private $Are_Codigo;
    private $ProP_CentroCostos;
    private $ProP_Semana;
    private $ProP_Fecha;
    private $ProP_Familia;
    private $ProP_Color;
    private $ProP_Cantidad;
    private $ProP_CantEP;
    private $ProP_CantEXPO;
    private $ProP_CantMP;
    private $ProP_Prioridad;
    private $ProP_Objetivo;
    private $ProP_LimInf;
    private $ProP_LimSup;
    private $ProP_MetrosEP;
    private $ProP_HoraInicio;
    private $ProP_MetrosEXPO;
    private $ProP_Descripcion;
    private $ProP_CodigoMaterial;
    private $ProP_Tipo;
    private $ProP_HoraConfirmada;
    private $ProP_FechaConfirmada;
    private $ProP_ObservacionEstado;
    private $ProP_FechaHoraCrea;
    private $ProP_UsuarioCrea;
    private $ProP_Estado;

  function __construct($ProP_Codigo = NULL, $Pla_Codigo = NULL, $For_Codigo = NULL, $Are_Codigo = NULL, $ProP_CentroCostos = NULL, $ProP_Semana = NULL, $ProP_Fecha = NULL, $ProP_Familia = NULL, $ProP_Color = NULL, $ProP_Cantidad = NULL, $ProP_CantEP = NULL, $ProP_CantEXPO = NULL, $ProP_CantMP = NULL, $ProP_Prioridad = NULL, $ProP_Objetivo = NULL, $ProP_LimInf = NULL, $ProP_LimSup = NULL, $ProP_MetrosEP = NULL, $ProP_HoraInicio = NULL, $ProP_MetrosEXPO = NULL, $ProP_Descripcion = NULL, $ProP_CodigoMaterial = NULL, $ProP_Tipo = NULL, $ProP_HoraConfirmada = NULL, $ProP_FechaConfirmada = NULL, $ProP_ObservacionEstado = NULL, $ProP_FechaHoraCrea = NULL, $ProP_UsuarioCrea = NULL, $ProP_Estado = NULL) {
    $this->ProP_Codigo = $ProP_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->For_Codigo = $For_Codigo;
    $this->Are_Codigo = $Are_Codigo;
    $this->ProP_CentroCostos = $ProP_CentroCostos;
    $this->ProP_Semana = $ProP_Semana;
    $this->ProP_Fecha = $ProP_Fecha;
    $this->ProP_Familia = $ProP_Familia;
    $this->ProP_Color = $ProP_Color;
    $this->ProP_Cantidad = $ProP_Cantidad;
    $this->ProP_CantEP = $ProP_CantEP;
    $this->ProP_CantEXPO = $ProP_CantEXPO;
    $this->ProP_CantMP = $ProP_CantMP;
    $this->ProP_Prioridad = $ProP_Prioridad;
    $this->ProP_Objetivo = $ProP_Objetivo;
    $this->ProP_LimInf = $ProP_LimInf;
    $this->ProP_LimSup = $ProP_LimSup;
    $this->ProP_MetrosEP = $ProP_MetrosEP;
    $this->ProP_HoraInicio = $ProP_HoraInicio;
    $this->ProP_MetrosEXPO = $ProP_MetrosEXPO;
    $this->ProP_Descripcion = $ProP_Descripcion;
    $this->ProP_CodigoMaterial = $ProP_CodigoMaterial;
    $this->ProP_Tipo = $ProP_Tipo;
    $this->ProP_HoraConfirmada = $ProP_HoraConfirmada;
    $this->ProP_FechaConfirmada = $ProP_FechaConfirmada;
    $this->ProP_ObservacionEstado = $ProP_ObservacionEstado;
    $this->ProP_FechaHoraCrea = $ProP_FechaHoraCrea;
    $this->ProP_UsuarioCrea = $ProP_UsuarioCrea;
    $this->ProP_Estado = $ProP_Estado;
    $this->tabla = "programa_produccion";
  }

  function getProP_Codigo() {
    return $this->ProP_Codigo;
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

  function getProP_CentroCostos() {
    return $this->ProP_CentroCostos;
  }

  function getProP_Semana() {
    return $this->ProP_Semana;
  }

  function getProP_Fecha() {
    return $this->ProP_Fecha;
  }

  function getProP_Familia() {
    return $this->ProP_Familia;
  }

  function getProP_Color() {
    return $this->ProP_Color;
  }

  function getProP_Cantidad() {
    return $this->ProP_Cantidad;
  }

  function getProP_CantEP() {
    return $this->ProP_CantEP;
  }

  function getProP_CantEXPO() {
    return $this->ProP_CantEXPO;
  }

  function getProP_CantMP() {
    return $this->ProP_CantMP;
  }

  function getProP_Prioridad() {
    return $this->ProP_Prioridad;
  }

  function getProP_Objetivo() {
    return $this->ProP_Objetivo;
  }

  function getProP_LimInf() {
    return $this->ProP_LimInf;
  }

  function getProP_LimSup() {
    return $this->ProP_LimSup;
  }

  function getProP_MetrosEP() {
    return $this->ProP_MetrosEP;
  }

  function getProP_HoraInicio() {
    return $this->ProP_HoraInicio;
  }

  function getProP_MetrosEXPO() {
    return $this->ProP_MetrosEXPO;
  }

  function getProP_Descripcion() {
    return $this->ProP_Descripcion;
  }

  function getProP_CodigoMaterial() {
    return $this->ProP_CodigoMaterial;
  }

  function getProP_Tipo() {
    return $this->ProP_Tipo;
  }

  function getProP_HoraConfirmada() {
    return $this->ProP_HoraConfirmada;
  }

  function getProP_FechaConfirmada() {
    return $this->ProP_FechaConfirmada;
  }

  function getProP_ObservacionEstado() {
    return $this->ProP_ObservacionEstado;
  }

  function getProP_FechaHoraCrea() {
    return $this->ProP_FechaHoraCrea;
  }

  function getProP_UsuarioCrea() {
    return $this->ProP_UsuarioCrea;
  }

  function getProP_Estado() {
    return $this->ProP_Estado;
  }

  function setProP_Codigo($ProP_Codigo) {
    $this->ProP_Codigo = $ProP_Codigo;
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

  function setProP_CentroCostos($ProP_CentroCostos) {
    $this->ProP_CentroCostos = $ProP_CentroCostos;
  }

  function setProP_Semana($ProP_Semana) {
    $this->ProP_Semana = $ProP_Semana;
  }

  function setProP_Fecha($ProP_Fecha) {
    $this->ProP_Fecha = $ProP_Fecha;
  }

  function setProP_Familia($ProP_Familia) {
    $this->ProP_Familia = $ProP_Familia;
  }

  function setProP_Color($ProP_Color) {
    $this->ProP_Color = $ProP_Color;
  }

  function setProP_Cantidad($ProP_Cantidad) {
    $this->ProP_Cantidad = $ProP_Cantidad;
  }

  function setProP_CantEP($ProP_CantEP) {
    $this->ProP_CantEP = $ProP_CantEP;
  }

  function setProP_CantEXPO($ProP_CantEXPO) {
    $this->ProP_CantEXPO = $ProP_CantEXPO;
  }

  function setProP_CantMP($ProP_CantMP) {
    $this->ProP_CantMP = $ProP_CantMP;
  }

  function setProP_Prioridad($ProP_Prioridad) {
    $this->ProP_Prioridad = $ProP_Prioridad;
  }

  function setProP_Objetivo($ProP_Objetivo) {
    $this->ProP_Objetivo = $ProP_Objetivo;
  }

  function setProP_LimInf($ProP_LimInf) {
    $this->ProP_LimInf = $ProP_LimInf;
  }

  function setProP_LimSup($ProP_LimSup) {
    $this->ProP_LimSup = $ProP_LimSup;
  }

  function setProP_MetrosEP($ProP_MetrosEP) {
    $this->ProP_MetrosEP = $ProP_MetrosEP;
  }

  function setProP_HoraInicio($ProP_HoraInicio) {
    $this->ProP_HoraInicio = $ProP_HoraInicio;
  }

  function setProP_MetrosEXPO($ProP_MetrosEXPO) {
    $this->ProP_MetrosEXPO = $ProP_MetrosEXPO;
  }

  function setProP_Descripcion($ProP_Descripcion) {
    $this->ProP_Descripcion = $ProP_Descripcion;
  }

  function setProP_CodigoMaterial($ProP_CodigoMaterial) {
    $this->ProP_CodigoMaterial = $ProP_CodigoMaterial;
  }

  function setProP_Tipo($ProP_Tipo) {
    $this->ProP_Tipo = $ProP_Tipo;
  }

  function setProP_HoraConfirmada($ProP_HoraConfirmada) {
    $this->ProP_HoraConfirmada = $ProP_HoraConfirmada;
  }

  function setProP_FechaConfirmada($ProP_FechaConfirmada) {
    $this->ProP_FechaConfirmada = $ProP_FechaConfirmada;
  }

  function setProP_ObservacionEstado($ProP_ObservacionEstado) {
    $this->ProP_ObservacionEstado = $ProP_ObservacionEstado;
  }

  function setProP_FechaHoraCrea($ProP_FechaHoraCrea) {
    $this->ProP_FechaHoraCrea = $ProP_FechaHoraCrea;
  }

  function setProP_UsuarioCrea($ProP_UsuarioCrea) {
    $this->ProP_UsuarioCrea = $ProP_UsuarioCrea;
  }

  function setProP_Estado($ProP_Estado) {
    $this->ProP_Estado = $ProP_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "For_Codigo", "Are_Codigo", "ProP_CentroCostos", "ProP_Semana", "ProP_Fecha", "ProP_Familia", "ProP_Color", "ProP_Cantidad", "ProP_CantEP", "ProP_CantEXPO", "ProP_CantMP", "ProP_Prioridad", "ProP_Objetivo", "ProP_LimInf", "ProP_LimSup", "ProP_MetrosEP", "ProP_HoraInicio", "ProP_MetrosEXPO", "ProP_Descripcion", "ProP_CodigoMaterial", "ProP_Tipo", "ProP_HoraConfirmada", "ProP_FechaConfirmada", "ProP_ObservacionEstado", "ProP_FechaHoraCrea", "ProP_UsuarioCrea", "ProP_Estado");
    $valores = array(
    array( 
      $this->Pla_Codigo, 
      $this->For_Codigo, 
      $this->Are_Codigo, 
      $this->ProP_CentroCostos, 
      $this->ProP_Semana, 
      $this->ProP_Fecha, 
      $this->ProP_Familia, 
      $this->ProP_Color, 
      $this->ProP_Cantidad, 
      $this->ProP_CantEP, 
      $this->ProP_CantEXPO, 
      $this->ProP_CantMP, 
      $this->ProP_Prioridad, 
      $this->ProP_Objetivo, 
      $this->ProP_LimInf, 
      $this->ProP_LimSup, 
      $this->ProP_MetrosEP, 
      $this->ProP_HoraInicio, 
      $this->ProP_MetrosEXPO, 
      $this->ProP_Descripcion, 
      $this->ProP_CodigoMaterial, 
      $this->ProP_Tipo, 
      $this->ProP_HoraConfirmada, 
      $this->ProP_FechaConfirmada, 
      $this->ProP_ObservacionEstado, 
      $this->ProP_FechaHoraCrea, 
      $this->ProP_UsuarioCrea, 
      $this->ProP_Estado
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
    $sql =  "SELECT * FROM programa_produccion WHERE ProP_Codigo = :cod";
    $parametros = array(":cod"=>$this->ProP_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setFor_Codigo($res[2]);
      $this->setAre_Codigo($res[3]);
      $this->setProP_CentroCostos($res[4]);
      $this->setProP_Semana($res[5]);
      $this->setProP_Fecha($res[6]);
      $this->setProP_Familia($res[7]);
      $this->setProP_Color($res[8]);
      $this->setProP_Cantidad($res[9]);
      $this->setProP_CantEP($res[10]);
      $this->setProP_CantEXPO($res[11]);
      $this->setProP_CantMP($res[12]);
      $this->setProP_Prioridad($res[13]);
      $this->setProP_Objetivo($res[14]);
      $this->setProP_LimInf($res[15]);
      $this->setProP_LimSup($res[16]);
      $this->setProP_MetrosEP($res[17]);
      $this->setProP_HoraInicio($res[18]);
      $this->setProP_MetrosEXPO($res[19]);
      $this->setProP_Descripcion($res[20]);
      $this->setProP_CodigoMaterial($res[21]);
      $this->setProP_Tipo($res[22]);
      $this->setProP_HoraConfirmada($res[23]);
      $this->setProP_FechaConfirmada($res[24]);
      $this->setProP_ObservacionEstado($res[25]);
      $this->setProP_FechaHoraCrea($res[26]);
      $this->setProP_UsuarioCrea($res[27]);
      $this->setProP_Estado($res[28]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "For_Codigo", "Are_Codigo", "ProP_CentroCostos", "ProP_Semana", "ProP_Fecha", "ProP_Familia", "ProP_Color", "ProP_Cantidad", "ProP_CantEP", "ProP_CantEXPO", "ProP_CantMP", "ProP_Prioridad", "ProP_Objetivo", "ProP_LimInf", "ProP_LimSup", "ProP_MetrosEP", "ProP_HoraInicio", "ProP_MetrosEXPO", "ProP_Descripcion", "ProP_CodigoMaterial", "ProP_Tipo", "ProP_HoraConfirmada", "ProP_FechaConfirmada", "ProP_ObservacionEstado", "ProP_FechaHoraCrea", "ProP_UsuarioCrea", "ProP_Estado");
    $valores = array($this->getPla_Codigo(), $this->getFor_Codigo(), $this->getAre_Codigo(), $this->getProP_CentroCostos(), $this->getProP_Semana(), $this->getProP_Fecha(), $this->getProP_Familia(), $this->getProP_Color(), $this->getProP_Cantidad(), $this->getProP_CantEP(), $this->getProP_CantEXPO(), $this->getProP_CantMP(), $this->getProP_Prioridad(), $this->getProP_Objetivo(), $this->getProP_LimInf(), $this->getProP_LimSup(), $this->getProP_MetrosEP(), $this->getProP_HoraInicio(), $this->getProP_MetrosEXPO(), $this->getProP_Descripcion(), $this->getProP_CodigoMaterial(), $this->getProP_Tipo(), $this->getProP_HoraConfirmada(), $this->getProP_FechaConfirmada(), $this->getProP_ObservacionEstado(), $this->getProP_FechaHoraCrea(), $this->getProP_UsuarioCrea(), $this->getProP_Estado());
    $llaveprimaria = "ProP_Codigo";
    $valorllaveprimaria = $this->getProP_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM programa_produccion WHERE ProP_Codigo = :cod";
    $parametros = array(":cod"=>$this->ProP_Codigo);
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
  public function hallarCodigoProgrmaProduccionCreado( $planta, $area, $formato, $fecha, $usuario ) {

    $parametros = array( ":pla" => $planta, ":are" => $area, ":for" => $formato, ":fec" => $fecha, ":usu" => $usuario );

    $sql = "SELECT ProP_Codigo
	FROM programa_produccion
	WHERE Pla_Codigo = :pla AND Are_Codigo = :are AND For_Codigo = :for AND ProP_Fecha = :fec AND ProP_UsuarioCrea = :usu AND ProP_Estado = 1
	ORDER BY ProP_Codigo DESC
	LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarProgramaProduccionReal( $semana, $area, $planta, $estado, $usuario, $formato ) {

    $parametros = array( ":sem" => $semana, ":usu" => $usuario, ":are" => $area);

    $sql = "SELECT ProP_Codigo, ProP_Fecha, For_Nombre, ProP_Familia, ProP_Color, Are_Nombre, ProP_Cantidad, ProP_CantEP, ProP_CantEXPO, ProP_Prioridad, programa_produccion.Are_Codigo, 
    (SELECT EProP_EstadoActual FROM estados_programa_produccion
    WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est, ProP_MetrosEP, ProP_MetrosEXPO, ProP_HoraInicio, ProP_Tipo, ProP_Descripcion,
    (SELECT AVG(UniE_Metros) FROM unidades_empaque WHERE unidades_empaque.For_Codigo = formatos.For_Codigo
    AND unidades_empaque.UniE_Estado = 1 AND UniE_Tipo = 1 ) AS MEuro, (SELECT AVG(UniE_Metros) FROM unidades_empaque WHERE unidades_empaque.For_Codigo = formatos.For_Codigo
    AND unidades_empaque.UniE_Estado = 1 AND UniE_Tipo = 2 ) AS MExpor, ProP_Semana,
    (SELECT FicT_PDF
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, ficha_tecnica.FicT_fechaHoraCrea DESC
    LIMIT 1) AS PDFFT,
    (SELECT FicT_FecEmision
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, ficha_tecnica.FicT_fechaHoraCrea DESC
    LIMIT 1) AS fecha_Registro, ProP_ObservacionEstado
    FROM programa_produccion
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON programa_produccion.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE ProP_Semana = :sem AND plantas_usuarios.Usu_Codigo = :usu AND programa_produccion.Are_Codigo = :are AND ProP_Estado = 1 ";

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
    
    if ( $formato != "" ) {
      $pri1 = 1;
      foreach ( $formato as $registro1 ) {
        if ( $pri1 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " programa_produccion.For_Codigo = :for" . $pri1 . " ";
        $parametros[ ':for' . $pri1 ] = $registro1;
        $pri1++;
      }
      $sql .= " )";
    }
    
    if($estado != "-1"){
      $sql .= " HAVING (Est = :est) ";
      $parametros[':est'] = $estado; 
    }

    $sql .= " ORDER BY ProP_Fecha ASC, ProP_Prioridad ASC";
  
    
    $this->consultaSQL( $sql, $parametros );
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
  public function listarProgramaProduccionRealSinSemana($area, $planta, $estado, $usuario, $formato ) {

    $parametros = array(":usu" => $usuario, ":are" => $area);

    $sql = "SELECT ProP_Codigo, ProP_Fecha, For_Nombre, ProP_Familia, ProP_Color, Are_Nombre, ProP_Cantidad, ProP_CantEP, ProP_CantEXPO, ProP_Prioridad, programa_produccion.Are_Codigo, 
    (SELECT EProP_EstadoActual FROM estados_programa_produccion
    WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est, ProP_MetrosEP, ProP_MetrosEXPO, ProP_HoraInicio, ProP_Tipo, ProP_Descripcion,
    (SELECT AVG(UniE_Metros) FROM unidades_empaque WHERE unidades_empaque.For_Codigo = formatos.For_Codigo
    AND unidades_empaque.UniE_Estado = 1 AND UniE_Tipo = 1 ) AS MEuro, (SELECT AVG(UniE_Metros) FROM unidades_empaque WHERE unidades_empaque.For_Codigo = formatos.For_Codigo
    AND unidades_empaque.UniE_Estado = 1 AND UniE_Tipo = 2 ) AS MExpor, ProP_Semana,
    (SELECT FicT_PDF
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, ficha_tecnica.FicT_fechaHoraCrea DESC
    LIMIT 1) AS PDFFT,
    (SELECT FicT_FecEmision
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, ficha_tecnica.FicT_fechaHoraCrea DESC
    LIMIT 1) AS fecha_Registro, ProP_ObservacionEstado
    FROM programa_produccion
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON programa_produccion.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE plantas_usuarios.Usu_Codigo = :usu AND programa_produccion.Are_Codigo = :are AND ProP_Estado = 1 ";

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
    
    if ( $formato != "" ) {
      $pri1 = 1;
      foreach ( $formato as $registro1 ) {
        if ( $pri1 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " programa_produccion.For_Codigo = :for" . $pri1 . " ";
        $parametros[ ':for' . $pri1 ] = $registro1;
        $pri1++;
      }
      $sql .= " )";
    }
    
    if($estado != "-1"){
      $sql .= " HAVING (Est = :est) ";
      $parametros[':est'] = $estado; 
    }

    $sql .= " HAVING Est = 'Producción' ORDER BY ProP_Fecha ASC, ProP_Prioridad ASC";
    
    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  } 
    
  /*
  Autor: dayanna Castaño
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarProgramaProduccionRealConSemana($planta, $usuario, $fechaInicial, $fechaFinal) {

    $parametros = array(":usu" => $usuario,":pla" => $planta,":fecI" => $fechaInicial,":fecF" => $fechaFinal);

    $sql = "SELECT ProP_Codigo, ProP_Fecha, For_Nombre, ProP_Familia, ProP_Color, Are_Nombre, ProP_Cantidad, ProP_CantEP, ProP_CantEXPO, ProP_Prioridad, programa_produccion.Are_Codigo, 
    (SELECT EProP_EstadoActual FROM estados_programa_produccion
    WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est, ProP_MetrosEP, ProP_MetrosEXPO, ProP_HoraInicio, ProP_Tipo, ProP_Descripcion,
    (SELECT AVG(UniE_Metros) FROM unidades_empaque WHERE unidades_empaque.For_Codigo = formatos.For_Codigo
    AND unidades_empaque.UniE_Estado = 1 AND UniE_Tipo = 1 ) AS MEuro, (SELECT AVG(UniE_Metros) FROM unidades_empaque WHERE unidades_empaque.For_Codigo = formatos.For_Codigo
    AND unidades_empaque.UniE_Estado = 1 AND UniE_Tipo = 2 ) AS MExpor, ProP_Semana,
    (SELECT FicT_PDF
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, ficha_tecnica.FicT_fechaHoraCrea DESC
    LIMIT 1) AS PDFFT,
    (SELECT FicT_FecEmision
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, ficha_tecnica.FicT_fechaHoraCrea DESC
    LIMIT 1) AS fecha_Registro, ProP_ObservacionEstado
    FROM programa_produccion
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON programa_produccion.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE plantas_usuarios.Usu_Codigo = :usu AND ProP_Estado = 1 AND plantas.Pla_Codigo = :pla AND ProP_Fecha BETWEEN :fecI AND :fecF";

    $sql .= " HAVING Est = 'Producción' ORDER BY ProP_Fecha ASC, ProP_Prioridad ASC";
    
    $this->consultaSQL( $sql, $parametros );
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
  public function referenciaEnProduccionCanalesListarOperarios( $fecha, $canal, $usuario ) {

    $parametros = array( ":fec" => $fecha, ":can" => $canal, ":usu" => $usuario );

    $sql = "SELECT ProP_Codigo, ProP_Fecha, For_Nombre, ProP_Familia, ProP_Color, Are_Nombre, ProP_Cantidad, ProP_CantEP, ProP_CantEXPO, ProP_Prioridad, programa_produccion.Are_Codigo, 
	(SELECT EProP_EstadoActual FROM estados_programa_produccion
	WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est
	FROM programa_produccion
	INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
	INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
	INNER JOIN canales ON areas.Can_Codigo = canales.Can_Codigo
	INNER JOIN plantas ON programa_produccion.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE ProP_Fecha = :fec AND canales.Can_Codigo = :can AND plantas_usuarios.Usu_Codigo = :usu
	HAVING Est = 'Producción'
	ORDER BY ProP_Prioridad DESC
	LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
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
  public function referenciaAnteriorEnProduccionCanalesListarOperarios( $fecha, $canal, $usuario ) {

    $parametros = array( ":fec" => $fecha, ":can" => $canal, ":usu" => $usuario );

    $sql = "SELECT ProP_Codigo, ProP_Fecha, For_Nombre, ProP_Familia, ProP_Color, Are_Nombre, ProP_Cantidad, ProP_CantEP, ProP_CantEXPO, ProP_Prioridad, programa_produccion.Are_Codigo, 
	(SELECT EProP_EstadoActual FROM estados_programa_produccion
	WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est
	FROM programa_produccion
	INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
	INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
	INNER JOIN canales ON areas.Can_Codigo = canales.Can_Codigo AND canales.Can_Estado = 1
	INNER JOIN plantas ON programa_produccion.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE ProP_Fecha = :fec AND canales.Can_Codigo = :can AND plantas_usuarios.Usu_Codigo = :usu AND ProP_Prioridad < 2
	HAVING Est = 'Finalizado'
	ORDER BY ProP_Prioridad DESC
	LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
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
  public function referenciaEnProduccionCanalesListarOperariosEnCurso( $programaProduccion ) {

    $parametros = array( ":cod" => $programaProduccion );

    $sql = "SELECT ProP_Codigo, ProP_Fecha, For_Nombre, ProP_Familia, ProP_Color, Are_Nombre, ProP_Cantidad, ProP_CantEP, ProP_CantEXPO, ProP_Prioridad, programa_produccion.Are_Codigo, 
	(SELECT EProP_EstadoActual FROM estados_programa_produccion
	WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est
	FROM programa_produccion
	INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
	INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
	INNER JOIN canales ON areas.Can_Codigo = canales.Can_Codigo
	INNER JOIN plantas ON programa_produccion.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE ProP_Codigo = :cod
	ORDER BY ProP_Prioridad DESC
	LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarPrioridadInsertProgramaProduccion( $area, $fecha ) {

    $parametros = array( ":are" => $area, ":fec" => $fecha );

    $sql = "SELECT MAX(ProP_Prioridad) AS Prio
	FROM programa_produccion
	WHERE Are_Codigo = :are AND ProP_Fecha = :fec AND ProP_Fecha = :fec
	LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarProgramaProduccionIniciaPrensaArea( $area, $fecha ) {

    $parametros = array( ":are" => $area, ":fec" => $fecha );

    $sql = "SELECT ProP_Codigo, (SELECT EProP_EstadoActual FROM estados_programa_produccion
	WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est
	FROM programa_produccion
	WHERE Are_Codigo = :are AND ProP_Fecha = :fec AND ProP_Fecha = :fec
	HAVING Est = 'Producción'
	ORDER BY ProP_Prioridad DESC
	LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarProgramaProduccionIniciaPrensaAreaAnteriosSupervisor( $area, $fecha ) {

    $parametros = array( ":are" => $area, ":fec" => $fecha );

    $sql = "SELECT ProP_Codigo, (SELECT EProP_EstadoActual FROM estados_programa_produccion
	WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est
	FROM programa_produccion
	WHERE Are_Codigo = :are AND ProP_Fecha = :fec AND ProP_Fecha = :fec
	HAVING Est = 'Finalizado'
	ORDER BY ProP_Prioridad DESC
	LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarProgramaProduccionIniciaPrensaAreaOtra( $area, $fecha ) {

    $parametros = array( ":are" => $area, ":fec" => $fecha );

    $sql = "SELECT DISTINCT estaciones_usuarios.ProP_Codigo,
(SELECT EProP_EstadoActual FROM estados_programa_produccion WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo
	ORDER BY EProP_Codigo DESC LIMIT 1) AS Est
	FROM estaciones_usuarios
	INNER JOIN puestos_trabajos ON estaciones_usuarios.PueT_Codigo = puestos_trabajos.PueT_Codigo AND puestos_trabajos.PueT_Estado = 1
	INNER JOIN estaciones_areas ON puestos_trabajos.EstA_Codigo = estaciones_areas.EstA_Codigo AND estaciones_areas.EstA_Estado = 1
INNER JOIN programa_produccion ON estaciones_usuarios.ProP_Codigo = programa_produccion.ProP_Codigo
	WHERE estaciones_areas.Are_Codigo = :are AND EstU_Fecha = :fec AND EstU_Estado = 1
  HAVING Est = 'Producción'
	ORDER BY estaciones_usuarios.ProP_Codigo DESC
	LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarProgramaProduccionActivoManual($semana, $semanaAnt, $planta, $fecha, $area) {

    $parametros = array(":pla" => $planta );

    $sql = "SELECT ProP_Codigo, areas.Are_Nombre, formatos.For_Nombre, programa_produccion.ProP_Familia, programa_produccion.ProP_Color,
    (SELECT EProP_EstadoActual FROM estados_programa_produccion WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo
    ORDER BY EProP_Codigo DESC LIMIT 1) AS Est, ProP_Descripcion, ProP_Cantidad, ProP_CantEP, ProP_MetrosEP, ProP_CantEXPO, ProP_MetrosEXPO, ProP_Fecha,
    (SELECT FicT_PDF
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, FicT_fechaHoraCrea DESC
    LIMIT 1) AS PDFFT,
    (SELECT FicT_FecEmision
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, FicT_fechaHoraCrea DESC
    LIMIT 1) AS fecha_Registro, ProP_Tipo, ProP_HoraConfirmada
    FROM programa_produccion
    INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.FOr_Estado = 1
    WHERE programa_produccion.ProP_Estado = 1 AND programa_produccion.Pla_Codigo = :pla ";
    
    if($fecha == "-1"){
      $sql .= " AND ProP_Semana = :sem ";
      $parametros[':sem'] = $semana; 
    }
    
    if($fecha == "-2"){
      $sql .= " AND ProP_Semana = :semant ";
      $parametros[':semant'] = $semanaAnt; 
    }
    
    if($fecha != "-1" && $fecha != "-2"){
      $sql .= " AND ProP_Semana BETWEEN :semant AND :sem AND ProP_Fecha = :fec ";
      $parametros[':sem'] = $semana; 
      $parametros[':semant'] = $semanaAnt; 
      $parametros[':fec'] = $fecha; 
    }
    
    if($area != "-1"){
      $sql .= " AND areas.Are_Codigo = :are ";
      $parametros[':are'] = $area; 
    }
    
    $sql .= " ORDER BY Are_Nombre ASC, ProP_Fecha ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarProgramaProduccionActivoManualSinFecha($planta, $area) {

    $parametros = array(":pla" => $planta );

    $sql = "SELECT ProP_Codigo, areas.Are_Nombre, formatos.For_Nombre, programa_produccion.ProP_Familia, programa_produccion.ProP_Color,
    (SELECT EProP_EstadoActual FROM estados_programa_produccion WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo
    ORDER BY EProP_Codigo DESC LIMIT 1) AS Est, ProP_Descripcion, ProP_Cantidad, ProP_CantEP, ProP_MetrosEP, ProP_CantEXPO, ProP_MetrosEXPO, ProP_Fecha,
    (SELECT FicT_PDF
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, FicT_fechaHoraCrea DESC
    LIMIT 1) AS PDFFT,
    (SELECT FicT_FecEmision
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, FicT_fechaHoraCrea DESC
    LIMIT 1) AS fecha_Registro, ProP_Tipo, ProP_HoraConfirmada
    FROM programa_produccion
    INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.FOr_Estado = 1
    WHERE programa_produccion.ProP_Estado = 1 AND programa_produccion.Pla_Codigo = :pla";
    
    if($area != "-1"){
      $sql .= " AND areas.Are_Codigo = :are ";
      $parametros[':are'] = $area; 
    }
    
    $sql .= " HAVING Est = 'Producción' ORDER BY Are_Nombre ASC, ProP_Fecha ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarProgramaProduccionRealSupervisor( $semana, $area, $planta, $fecha ) {

    $parametros = array( ":sem" => $semana, ":are" => $area, ":pla" => $planta );

    $sql = "SELECT ProP_Codigo, ProP_Fecha, For_Nombre, ProP_Familia, ProP_Color, Are_Nombre, ProP_Cantidad, ProP_CantEP, ProP_CantEXPO,
    ProP_Prioridad, programa_produccion.Are_Codigo, 
	  (SELECT EProP_EstadoActual FROM estados_programa_produccion
    WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est,
    ProP_MetrosEP, ProP_MetrosEXPO, ProP_HoraInicio, ProP_Tipo, ProP_Descripcion, ProP_Semana,
    (SELECT FicT_PDF
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, FicT_fechaHoraCrea DESC
    LIMIT 1) AS PDFFT,
    (SELECT FicT_FecEmision
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, FicT_fechaHoraCrea DESC
    LIMIT 1) AS fecha_Registro, ProP_HoraConfirmada, ProP_FechaConfirmada
    FROM programa_produccion
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    WHERE ProP_Semana = :sem AND programa_produccion.Pla_Codigo = :pla AND programa_produccion.Are_Codigo = :are AND ProP_Estado = 1 ";
    
    if($fecha != "-1"){ 
    $sql .= " AND ( ProP_Fecha = :fec ) ";
    $parametros[':fec'] = $fecha;
    }
    
    $sql .= " ORDER BY ProP_Fecha ASC, ProP_Prioridad ASC";
    
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
  public function listarProgramaProduccionRealSupervisorSinSemana( $area, $planta, $fecha ) {

    $parametros = array(":are" => $area, ":pla" => $planta );

    $sql = "SELECT ProP_Codigo, ProP_Fecha, For_Nombre, ProP_Familia, ProP_Color, Are_Nombre, ProP_Cantidad, ProP_CantEP, ProP_CantEXPO,
    ProP_Prioridad, programa_produccion.Are_Codigo, 
	  (SELECT EProP_EstadoActual FROM estados_programa_produccion
    WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est,
    ProP_MetrosEP, ProP_MetrosEXPO, ProP_HoraInicio, ProP_Tipo, ProP_Descripcion, ProP_Semana,
    (SELECT FicT_PDF
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, FicT_fechaHoraCrea DESC
    LIMIT 1) AS PDFFT,
    (SELECT FicT_FecEmision
    FROM historial_ficha_tecnica 
    INNER JOIN ficha_tecnica ON historial_ficha_tecnica.FicT_Codigo = ficha_tecnica.FicT_Codigo AND FicT_Estado = 1
    INNER JOIN formatos f1 ON ficha_tecnica.For_Codigo = f1.For_Codigo
    WHERE FicT_Familia = programa_produccion.ProP_Familia AND FicT_Color = programa_produccion.ProP_Color
    AND f1.For_Nombre = formatos.For_Nombre AND HisFT_Estado = 1
    ORDER BY HisFT_Version DESC, FicT_fechaHoraCrea DESC
    LIMIT 1) AS fecha_Registro, ProP_HoraConfirmada, ProP_FechaConfirmada
    FROM programa_produccion
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN areas ON programa_produccion.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    WHERE programa_produccion.Pla_Codigo = :pla AND programa_produccion.Are_Codigo = :are AND ProP_Estado = 1 ";
    
    if($fecha != "-1"){ 
    $sql .= " AND ( ProP_Fecha = :fec ) ";
    $parametros[':fec'] = $fecha;
    }
    
    $sql .= " HAVING Est = 'Producción' ORDER BY ProP_Fecha ASC, ProP_Prioridad ASC";
    
    $this->consultaSQL( $sql, $parametros );
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
  public function listarFechaProgramaProduccion($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT DISTINCT ProP_Fecha
    FROM programa_produccion 
    INNER JOIN plantas ON programa_produccion.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE ProP_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu";

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
    public function listarfechasEstadoReferenciaPM($semana, $semanaAnt, $planta){

    $parametros = array(":sem"=>$semana, ":semant"=>$semanaAnt, ":pla"=>$planta);

    $sql = "SELECT DISTINCT ProP_Fecha
    FROM programa_produccion
    WHERE ProP_Estado = 1 AND ProP_Semana BETWEEN :semant AND :sem AND Pla_Codigo = :pla
    ORDER BY ProP_Fecha DESC";

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
  public function validacionCantidadReferenciasEnProduccionPrensasProgProd($area){

    $parametros = array(":are"=>$area);

    $sql = "SELECT COUNT(ProP_Codigo) AS cant,
(SELECT EProP_EstadoActual FROM estados_programa_produccion WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo
	ORDER BY EProP_Codigo DESC LIMIT 1) AS Est
	FROM programa_produccion
	WHERE Are_Codigo = :are AND ProP_Estado = 1
GROUP BY Est
  HAVING Est = 'Producción'
ORDER BY ProP_Codigo DESC";

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
  public function validarReferenciasProduccion(){

    $sql = "SELECT ProP_Codigo, ProP_Familia,programa_produccion.For_Codigo,ProP_Color,
    (SELECT EProP_EstadoActual FROM estados_programa_produccion 
    WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo
    ORDER BY EProP_Codigo DESC LIMIT 1) AS Est,
    (SELECT HisFT_Fecha 
    FROM historial_ficha_tecnica  
    INNER JOIN ficha_tecnica f2 ON historial_ficha_tecnica.FicT_Codigo = f2.FicT_Codigo AND FicT_Estado = 1 
    INNER JOIN formatos fr1 ON f2.For_Codigo = fr1.For_Codigo 
    WHERE f2.FicT_Familia = ProP_Familia AND FicT_Color = ProP_Color
    AND fr1.For_Nombre = fr3.For_Nombre AND HisFT_Estado = 1 
    ORDER BY HisFT_Version DESC, f2.FicT_fechaHoraCrea DESC 
    LIMIT 1) AS fecEmi,
    (SELECT HisFT_Version 
    FROM historial_ficha_tecnica  
    INNER JOIN ficha_tecnica f2 ON historial_ficha_tecnica.FicT_Codigo = f2.FicT_Codigo AND FicT_Estado = 1 
    INNER JOIN formatos fr1 ON f2.For_Codigo = fr1.For_Codigo 
    WHERE f2.FicT_Familia = ProP_Familia AND FicT_Color = ProP_Color 
    AND fr1.For_Nombre = fr3.For_Nombre  AND HisFT_Estado = 1 AND FicT_FecEmision = fecEmi
    ORDER BY HisFT_Version DESC, f2.FicT_fechaHoraCrea DESC 
    LIMIT 1) AS vers
    FROM programa_produccion
    INNER JOIN formatos fr3 ON programa_produccion.For_Codigo = fr3.For_Codigo
    WHERE ProP_Estado = 1
    HAVING Est = 'Producción'
    ORDER BY ProP_Codigo DESC";

    $this->consultaSQL($sql);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
  // Programa Producción Sin Fecha Nuevo Cambio
    /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarProgramaProduccionIniciaPrensaAreaNuevo( $area ) {

    $parametros = array( ":are" => $area );

    $sql = "SELECT ProP_Codigo, (SELECT EProP_EstadoActual FROM estados_programa_produccion
	WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est
	FROM programa_produccion
	WHERE Are_Codigo = :are AND ProP_Estado = 1
	HAVING Est = 'Producción'
	ORDER BY ProP_Prioridad DESC
LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarProgramaProduccionIniciaPrensaAreaAnteriosSupervisorNuevo( $area ) {

    $parametros = array( ":are" => $area);

    $sql = "SELECT ProP_Codigo, (SELECT EProP_EstadoActual FROM estados_programa_produccion
	WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS Est,
(SELECT EProP_FechaHoraCrea FROM estados_programa_produccion
	WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo ORDER BY EProP_Codigo DESC LIMIT 1) AS EstFec
	FROM programa_produccion
	WHERE Are_Codigo = :are
	HAVING (Est = 'Finalizado' OR Est = 'Suspendido')
	ORDER BY EstFec DESC
	LIMIT 1";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarFiltroPanelSupervisorReferenciasFecha($fecha, $area){

    $parametros = array(":fec"=>"%".$fecha."%", ":are"=>$area);

    $sql = "SELECT Ref_Codigo, Ref_Descripcion, ProP_Codigo, (SELECT EProP_EstadoActual FROM estados_programa_produccion
	WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo AND EProP_EstadoActual = 'Producción' ORDER BY EProP_Codigo DESC LIMIT 1) AS Est,
(SELECT EProP_FechaHoraCrea FROM estados_programa_produccion
	WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo AND EProP_EstadoActual = 'Producción' ORDER BY EProP_Codigo DESC LIMIT 1) AS EstFec,
formatos.For_Nombre, programa_produccion.ProP_Familia, programa_produccion.ProP_Color, ProP_CodigoMaterial
	FROM programa_produccion
        INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
INNER JOIN referencias ON programa_produccion.ProP_Familia = referencias.Ref_Familia AND formatos.For_Nombre = referencias.Ref_Formato
AND programa_produccion.ProP_Color = referencias.Ref_Color AND programa_produccion.ProP_Descripcion = referencias.Ref_Descripcion AND referencias.Ref_Estado = 1
	WHERE Are_Codigo = :are AND ProP_Estado = 1
	HAVING  EstFec LIKE :fec
	ORDER BY EstFec DESC";

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
 public function listarFiltroPanelSupervisorReferenciasFechas($fechaInicial, $fechaFinal, $planta){
    $parametros = array(":fecI"=>$fechaInicial,":fecF"=>$fechaFinal,":pla"=>$planta);
    $sql = "SELECT Ref_Codigo, Ref_Descripcion, ProP_Codigo,    
    (SELECT EProP_FechaHoraCrea FROM estados_programa_produccion
    WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo AND EProP_EstadoActual = 'Producción' 
    ORDER BY EProP_Codigo DESC LIMIT 1) AS EstFec, Ref_Formato, Ref_Familia, Ref_Color   
    FROM programa_produccion
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1    
    INNER JOIN referencias ON programa_produccion.ProP_Familia = referencias.Ref_Familia AND formatos.For_Nombre = referencias.Ref_Formato AND referencias.Pla_Codigo = :pla
    AND programa_produccion.ProP_Color = referencias.Ref_Color AND programa_produccion.ProP_Descripcion = referencias.Ref_Descripcion AND referencias.Ref_Estado = 1 WHERE ProP_Estado = 1 HAVING EstFec BETWEEN :fecI AND :fecF ORDER BY Ref_Formato, Ref_Familia, Ref_Color DESC";        
    $this->consultaSQL($sql, $parametros);    
    $res = $this->cargarTodo();
    $this->desconectar();    return $res;
  }
    
    /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarPanelSupervisorListaFechasReferencia($area, $formato, $familia, $color){

    $parametros = array(":are"=>$area, ":for"=>$formato, ":fam"=>$familia, ":col"=>$color);

    $sql = "SELECT Ref_Codigo, Ref_Descripcion, ProP_Codigo, (SELECT EProP_EstadoActual FROM estados_programa_produccion WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo AND EProP_EstadoActual = 'Producción' ORDER BY EProP_Codigo DESC LIMIT 1) AS Est,
    (SELECT EProP_FechaHoraCrea FROM estados_programa_produccion WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo AND EProP_EstadoActual = 'Producción' ORDER BY EProP_Codigo DESC LIMIT 1) AS EstFec,
    formatos.For_Nombre, programa_produccion.ProP_Familia, programa_produccion.ProP_Color FROM programa_produccion
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1 
    INNER JOIN referencias ON programa_produccion.ProP_Familia = referencias.Ref_Familia AND formatos.For_Nombre = referencias.Ref_Formato
    AND programa_produccion.ProP_Color = referencias.Ref_Color AND REPLACE(REPLACE(programa_produccion.ProP_Descripcion, ' EX ', ' SL '),' EP ',' ') = REPLACE(REPLACE(referencias.Ref_Descripcion, ' EX ', ' SL '),' EP ',' ') AND referencias.Ref_Estado = 1 
    WHERE Are_Codigo = :are AND ProP_Estado = 1 AND programa_produccion.ProP_Familia = :fam AND programa_produccion.ProP_Color = :col
    AND referencias.Ref_Formato = :for GROUP BY ProP_Codigo ORDER BY EstFec DESC ";

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
  public function buscarProgramaProduccionReferencia($formato, $familia, $color){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color);

    $sql = "SELECT Ref_Codigo, Ref_Descripcion, ProP_Codigo, 
    (SELECT EProP_EstadoActual FROM estados_programa_produccion WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo 
    AND EProP_EstadoActual = 'Producción' ORDER BY EProP_Codigo DESC LIMIT 1) AS Est,(SELECT EProP_FechaHoraCrea 
    FROM estados_programa_produccion 
    WHERE estados_programa_produccion.ProP_Codigo = programa_produccion.ProP_Codigo AND EProP_EstadoActual = 'Producción' ORDER BY EProP_Codigo DESC LIMIT 1) AS EstFec,
    formatos.For_Nombre, programa_produccion.ProP_Familia, programa_produccion.ProP_Color 
    FROM programa_produccion        
    INNER JOIN formatos ON programa_produccion.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN referencias ON programa_produccion.ProP_Familia = referencias.Ref_Familia 
    AND formatos.For_Nombre = referencias.Ref_Formato AND programa_produccion.ProP_Color = referencias.Ref_Color 
    AND programa_produccion.ProP_Descripcion = referencias.Ref_Descripcion AND referencias.Ref_Estado = 1 
    WHERE ProP_Familia = :fam AND ProP_Color = :col AND programa_produccion.For_Codigo = :for 
    AND ProP_Estado = 1 ORDER BY EstFec DESC LIMIT 1";

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
 public function buscarProgramaProduccionSemana($formato, $familia, $color, $semana,$area){ 
 
    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":sem"=>$semana,":are"=>$area); 
 
    $sql = "SELECT ProP_Codigo, ProP_Semana, ProP_Fecha 
    FROM programa_produccion 
    WHERE ProP_Familia = :fam AND For_Codigo = :for AND ProP_Color = :col  AND ProP_Estado = '1' AND ProP_Semana = :sem AND Are_Codigo = :are 
    ORDER BY ProP_Fecha ASC"; 
 
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
  public function buscarProgramaProduccionSemanaTodos($formato, $familia, $color){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color);

    $sql = "SELECT ProP_Codigo, ProP_Semana, ProP_Fecha
    FROM programa_produccion
    WHERE ProP_Familia = :fam AND For_Codigo = :for AND ProP_Color = :col  AND ProP_Estado = '1'
    ORDER BY ProP_Fecha ASC";
    
//    if($_SESSION['CP_Usuario'] == "1"){
//    echo "---Todos---"."<br>".$sql;
//    var_dump($parametros);
//    echo "<br>";
//  }

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
