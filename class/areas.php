<?php
require_once( 'basedatos.php' );

class areas extends basedatos {
  private $Are_Codigo;
  private $Pla_Codigo;
  private $Are_Nombre;
  private $Are_Secuencia;
  private $Are_Tipo;
  private $Are_Anterior;
  private $Are_Siguiente;
  private $Are_FechaHoraCrea;
  private $Are_UsuarioCrea;
  private $Are_Estado;

  function __construct( $Are_Codigo = NULL, $Pla_Codigo = NULL, $Are_Nombre = NULL, $Are_Secuencia = NULL, $Are_Tipo = NULL, $Are_Anterior = NULL, $Are_Siguiente = NULL, $Are_FechaHoraCrea = NULL, $Are_UsuarioCrea = NULL, $Are_Estado = NULL ) {
    $this->Are_Codigo = $Are_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Are_Nombre = $Are_Nombre;
    $this->Are_Secuencia = $Are_Secuencia;
    $this->Are_Tipo = $Are_Tipo;
    $this->Are_Anterior = $Are_Anterior;
    $this->Are_Siguiente = $Are_Siguiente;
    $this->Are_FechaHoraCrea = $Are_FechaHoraCrea;
    $this->Are_UsuarioCrea = $Are_UsuarioCrea;
    $this->Are_Estado = $Are_Estado;
    $this->tabla = "areas";
  }

  function getAre_Codigo() {
    return $this->Are_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getAre_Nombre() {
    return $this->Are_Nombre;
  }

  function getAre_Secuencia() {
    return $this->Are_Secuencia;
  }

  function getAre_Tipo() {
    return $this->Are_Tipo;
  }

  function getAre_Anterior() {
    return $this->Are_Anterior;
  }

  function getAre_Siguiente() {
    return $this->Are_Siguiente;
  }

  function getAre_FechaHoraCrea() {
    return $this->Are_FechaHoraCrea;
  }

  function getAre_UsuarioCrea() {
    return $this->Are_UsuarioCrea;
  }

  function getAre_Estado() {
    return $this->Are_Estado;
  }

  function setAre_Codigo( $Are_Codigo ) {
    $this->Are_Codigo = $Are_Codigo;
  }

  function setPla_Codigo( $Pla_Codigo ) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setAre_Nombre( $Are_Nombre ) {
    $this->Are_Nombre = $Are_Nombre;
  }

  function setAre_Secuencia( $Are_Secuencia ) {
    $this->Are_Secuencia = $Are_Secuencia;
  }

  function setAre_Tipo( $Are_Tipo ) {
    $this->Are_Tipo = $Are_Tipo;
  }

  function setAre_Anterior( $Are_Anterior ) {
    $this->Are_Anterior = $Are_Anterior;
  }

  function setAre_Siguiente( $Are_Siguiente ) {
    $this->Are_Siguiente = $Are_Siguiente;
  }

  function setAre_FechaHoraCrea( $Are_FechaHoraCrea ) {
    $this->Are_FechaHoraCrea = $Are_FechaHoraCrea;
  }

  function setAre_UsuarioCrea( $Are_UsuarioCrea ) {
    $this->Are_UsuarioCrea = $Are_UsuarioCrea;
  }

  function setAre_Estado( $Are_Estado ) {
    $this->Are_Estado = $Are_Estado;
  }

  public function insertar() {
    $campos = array( "Pla_Codigo", "Are_Nombre", "Are_Secuencia", "Are_Tipo", "Are_Anterior", "Are_Siguiente", "Are_FechaHoraCrea", "Are_UsuarioCrea", "Are_Estado" );
    $valores = array(
      array(
        $this->Pla_Codigo,
        $this->Are_Nombre,
        $this->Are_Secuencia,
        $this->Are_Tipo,
        $this->Are_Anterior,
        $this->Are_Siguiente,
        $this->Are_FechaHoraCrea,
        $this->Are_UsuarioCrea,
        $this->Are_Estado
      )
    );

    $resultado = $this->insertarRegistros( $campos, $valores );
    $this->desconectar();

    if ( $resultado[ 0 ] == "OK" ) {
      return true;
    } else {
      return false;
    }
  }

  public function consultar() {
    $sql = "SELECT * FROM areas WHERE Are_Codigo = :cod";
    $parametros = array( ":cod" => $this->Are_Codigo );
    if ( $this->consultaSQL( $sql, $parametros ) ) {
      $res = $this->cargarRegistro();

      $this->setPla_Codigo( $res[ 1 ] );
      $this->setAre_Nombre( $res[ 2 ] );
      $this->setAre_Secuencia( $res[ 3 ] );
      $this->setAre_Tipo( $res[ 4 ] );
      $this->setAre_Anterior( $res[ 5 ] );
      $this->setAre_Siguiente( $res[ 6 ] );
      $this->setAre_FechaHoraCrea( $res[ 7 ] );
      $this->setAre_UsuarioCrea( $res[ 8 ] );
      $this->setAre_Estado( $res[ 9 ] );

      $this->desconectar();
    }
  }

  public function actualizar() {
    $campos = array( "Pla_Codigo", "Are_Nombre", "Are_Secuencia", "Are_Tipo", "Are_Anterior", "Are_Siguiente", "Are_FechaHoraCrea", "Are_UsuarioCrea", "Are_Estado" );
    $valores = array( $this->getPla_Codigo(), $this->getAre_Nombre(), $this->getAre_Secuencia(), $this->getAre_Tipo(), $this->getAre_Anterior(), $this->getAre_Siguiente(), $this->getAre_FechaHoraCrea(), $this->getAre_UsuarioCrea(), $this->getAre_Estado() );
    $llaveprimaria = "Are_Codigo";
    $valorllaveprimaria = $this->getAre_Codigo();
    $res = $this->actualizarRegistros( $campos, $valores, $llaveprimaria, $valorllaveprimaria );
    $this->desconectar();
    return $res;
  }

  public function eliminar() {
    $sql = "DELETE FROM areas WHERE Are_Codigo = :cod";
    $parametros = array( ":cod" => $this->Are_Codigo );
    $res = $this->consultaSQL( $sql, $parametros );
    $this->desconectar();
    return $res;
  }

  /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarAreas( $planta, $estado, $usuario ) {

    $parametros = array( ":est" => $estado, ":usu" => $usuario );

    $sql = "SELECT a.Are_Codigo, plantas.Pla_Nombre, a.Are_Nombre, a.Are_Secuencia, a.Are_Tipo, b.Are_Nombre, c.Are_Nombre, a.Are_Estado
      FROM areas a
      INNER JOIN plantas ON a.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      LEFT JOIN areas b ON a.Are_Anterior = b.Are_Codigo 
      LEFT JOIN areas c ON a.Are_Siguiente = c.Are_Codigo
      WHERE a.Are_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu ";

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

    $sql .= " ORDER BY a.Are_Secuencia ASC, a.Are_Nombre ASC";
    
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
  public function listarAreasOrdenadas( $usuario, $planta ) {

    $parametros = array( ":usu" => $usuario, ":pla" => $planta );

    $sql = "SELECT areas.Are_Codigo, Are_Nombre
      FROM areas
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND plantas.Pla_Codigo = :pla
      ORDER BY Are_Secuencia ASC ";

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
  public function filtroAreasCanal( $canal, $usuario ) {

    $parametros = array( ":can" => $canal, ":usu" => $usuario );

    $sql = "SELECT areas.Are_Codigo, Are_Nombre
      FROM areas
      INNER JOIN canales ON areas.Can_Codigo = canales.Can_Codigo AND canales.Can_Estado = 1
      INNER JOIN fases ON canales.Fas_Codigo = fases.Fas_Codigo AND fases.Fas_Estado = 1
      INNER JOIN plantas ON fases.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND canales.Can_Codigo = :can
      ORDER BY Are_Nombre ASC";

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
  public function lisarAreasCanalOrdenado( $canal, $usuario ) {

    $parametros = array( ":can" => $canal, ":usu" => $usuario );

    $sql = "SELECT areas.Are_Codigo, Are_Nombre
      FROM areas
      INNER JOIN canales ON areas.Can_Codigo = canales.Can_Codigo AND canales.Can_Estado = 1
      INNER JOIN fases ON canales.Fas_Codigo = fases.Fas_Codigo AND fases.Fas_Estado = 1
      INNER JOIN plantas ON fases.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND canales.Can_Codigo = :can
      ORDER BY Are_Secuencia ASC";

    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }


  /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción: NO MODIFICAR
    Parámetros:
    */
  public function listarAreasTodas( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT Are_Codigo, Are_Nombre
      FROM areas
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = 1 AND Pla_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu
      ORDER BY Are_Nombre ASC";

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
  public function estacionesUsuariosAreasOperador( $tipo ) {

    $parametros = array( ":tip" => $tipo );

    $sql = "SELECT areas.Are_Codigo, areas.Are_Nombre
		FROM areas
		WHERE Are_Estado = 1 AND Are_Tipo = :tip
		ORDER BY Are_Secuencia ASC";

    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }

  /*
    Autor: RxDavid
    Fecha: 
    Descripción: NO MODIFICAR
    Parámetros:
    */
  public function listarAreasUsuarioSoloHornos( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT Are_Codigo, Are_Nombre
      FROM areas
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND Are_Tipo = 2 ORDER BY Are_Nombre ASC";

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
  public function listarAreasUsuarioSoloCalidad( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT Are_Codigo, Are_Nombre
      FROM areas
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND Are_Tipo = 6 ORDER BY Are_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }


  /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción: NO MODIFICAR
    Parámetros:
    */
  public function listarAreasPlanta( $planta, $estado, $usuario ) {

    $parametros = array( ":est" => $estado, ":usu" => $usuario, ":pla" => $planta );

    $sql = "SELECT Are_Codigo, Are_Nombre, Are_Secuencia, Are_Tipo
      FROM areas 
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu AND plantas.Pla_Codigo = :pla ORDER BY Are_Secuencia ASC";

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
  public function listarAreasPlantaTipo( $planta, $estado, $usuario, $tipo ) {

    $parametros = array( ":est" => $estado, ":usu" => $usuario, ":pla" => $planta, ":tip" => $tipo );

    $sql = "SELECT Are_Codigo, Are_Nombre, Are_Secuencia, Are_Tipo
      FROM areas 
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu AND plantas.Pla_Codigo = :pla AND Are_Tipo = :tip ORDER BY areas.Are_Secuencia ASC, areas.Are_Nombre ASC";

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
  public function prensasAnalisisProgramaProduccion($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT Are_Codigo, Are_Nombre
	FROM areas
	INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE Are_Estado = 1 AND Are_Tipo = 2 AND plantas_usuarios.Usu_Codigo = :usu
	ORDER BY Are_Nombre ASC";

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
  public function listarVariablesTipoFT($tipoArea, $usuario, $planta, $formato){

    $parametros = array(":tipAre"=>$tipoArea, ":usu"=>$usuario, ":pla"=>$planta, ":for"=>$formato);

    $sql = "SELECT DISTINCT configuracion_ficha_tecnica.AgrC_Codigo, agrupaciones_configft.AgrC_Nombre
      FROM configuracion_ficha_tecnica
      INNER JOIN agrupaciones_configft ON configuracion_ficha_tecnica.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado =1
      INNER JOIN maquinas ON configuracion_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
      INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
      INNER JOIN plantas ON configuracion_ficha_tecnica.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1 
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1 
      INNER JOIN formatos_areas ON areas.Are_Codigo = formatos_areas.Are_Codigo AND ForA_Estado = 1
      WHERE ConFT_Estado = 1 AND Are_Tipo = :tipAre AND plantas_usuarios.Usu_Codigo = :usu  AND configuracion_ficha_tecnica.Pla_Codigo = :pla AND formatos_areas.For_Codigo = :for
      GROUP BY agrupaciones_configft.AgrC_Nombre
      ORDER BY ConFT_Ordenamiento ASC";

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
  public function listarVariablesTipoFTAreasLineas($tipoArea, $usuario, $planta, $zona){

    $parametros = array(":tipAre"=>$tipoArea, ":usu"=>$usuario, ":pla"=>$planta, ":zon"=>$zona);

    $sql = "SELECT DISTINCT configuracion_ficha_tecnica.AgrC_Codigo, agrupaciones_configft.AgrC_Nombre, AgrM_Codigo, maquinas.Maq_Codigo
      FROM configuracion_ficha_tecnica
      INNER JOIN agrupaciones_configft ON configuracion_ficha_tecnica.AgrC_Codigo = agrupaciones_configft.AgrC_Codigo AND AgrC_Estado =1
      INNER JOIN maquinas ON configuracion_ficha_tecnica.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
      INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
      INNER JOIN plantas ON configuracion_ficha_tecnica.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1 
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1 
      WHERE ConFT_Estado = 1 AND Are_Tipo = :tipAre AND plantas_usuarios.Usu_Codigo = :usu  AND configuracion_ficha_tecnica.Pla_Codigo = :pla AND ConFT_Agrupacion = :zon
      ORDER BY AgrC_Codigo ASC";

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
public function listarAreasTipoFT($tipoArea, $usuario, $planta, $formato){
		
  $parametros = array(":tipAre"=>$tipoArea, ":usu"=>$usuario, ":pla"=>$planta, ":for"=>$formato);
		
  $sql = "SELECT formatos_areas.Are_Codigo, areas.Are_Nombre
    FROM areas 
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1 
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1 
    INNER JOIN formatos_areas ON areas.Are_Codigo = formatos_areas.Are_Codigo AND ForA_Estado = 1
    WHERE Are_Tipo = :tipAre AND areas.Are_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu  AND areas.Pla_Codigo = :pla AND formatos_areas.For_Codigo = :for
    ORDER BY Are_Nombre ASC";
		
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
public function listarAreasTipoFTN($tipoArea, $usuario, $planta, $formato){
		
  $parametros = array(":tipAre"=>$tipoArea, ":usu"=>$usuario, ":pla"=>$planta, ":for"=>$formato);
		
  $sql = "SELECT formatos_areas.Are_Codigo, areas.Are_Nombre
    FROM areas 
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1 
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1 
    INNER JOIN formatos_areas ON areas.Are_Codigo = formatos_areas.Are_Codigo AND ForA_Estado = 1
    WHERE Are_Tipo = :tipAre AND areas.Are_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu  AND areas.Pla_Codigo = :pla AND formatos_areas.For_Codigo = :for
    ORDER BY Are_Nombre ASC";
		
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
  public function buscarAgrupacionCodigo($area){

    $parametros = array(":are"=>$area);

    $sql = "SELECT Agr_Codigo 
    FROM areas 
    INNER JOIN agrupaciones_areas ON areas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1
    WHERE Are_Estado = 1 AND agrupaciones_areas.Are_Codigo = :are";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }

    /*
    Autor: Natalia Rodríguez
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function listarAreasUsuarioSoloHornosHeathCheck( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT Are_Codigo, Are_Nombre
      FROM areas
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND Are_Tipo = 5 ORDER BY Are_Nombre ASC";

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
  public function buscarAreasSegunCanal($usuario, $agrupacion){

    $parametros = array(":usu"=>$usuario,":agr"=>$agrupacion);

    $sql = "SELECT areas.Are_Codigo, areas.Are_Nombre
    FROM areas
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN agrupaciones_areas ON areas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = 1
    WHERE Are_Estado = 1 AND Pla_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND agrupaciones.Agr_Codigo = :agr
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
  public function buscarAreasSegunCanalMultiple($usuario, $agrupacion){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT areas.Are_Codigo, areas.Are_Nombre
    FROM areas
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN agrupaciones_areas ON areas.Are_Codigo = agrupaciones_areas.Are_Codigo AND AgrA_Estado = 1
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND Agr_Estado = 1
    WHERE Are_Estado = 1 AND Pla_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu ";
    
    if($agrupacion != ""){ 
      $pri = 1; 
      foreach($agrupacion as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " agrupaciones.Agr_Codigo = :agr".$pri." "; 
        $parametros[':agr'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY areas.Are_Secuencia ASC";

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
  public function listarAreasPlantaTipoFT( $planta, $usuario, $tipo ) {

    $parametros = array(":usu" => $usuario, ":pla" => $planta, ":tip" => $tipo );

    $sql = "SELECT Are_Codigo, Are_Nombre, Are_Secuencia, Are_Tipo
      FROM areas 
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = '1' AND plantas_usuarios.Usu_Codigo = :usu AND plantas.Pla_Codigo = :pla AND Are_Tipo = :tip ORDER BY areas.Are_Secuencia ASC";

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
  public function listarAreasPlantaTipoFiltroOrdenadoNombre($planta, $usuario, $tipo) {

    $parametros = array(":pla"=>$planta, ":usu"=>$usuario, ":tip"=>$tipo);

    $sql = "SELECT Are_Codigo, Are_Nombre, Are_Secuencia, Are_Tipo
      FROM areas 
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = '1' AND plantas_usuarios.Usu_Codigo = :usu AND plantas.Pla_Codigo = :pla AND Are_Tipo = :tip ORDER BY areas.Are_Nombre ASC";

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
  public function listarAreasPlantaTipoFiltroDescuentosTurnosOperacionesOrdenadoNombre($planta, $usuario, $tipo) {

    $parametros = array(":pla"=>$planta, ":usu"=>$usuario);

    $sql = "SELECT Are_Codigo, Are_Nombre, Are_Secuencia, Are_Tipo
      FROM areas 
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Are_Estado = '1' AND plantas_usuarios.Usu_Codigo = :usu AND plantas.Pla_Codigo = :pla ";
    
    if($tipo != ""){ 
      $pri = 1; 
      foreach($tipo as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Are_Tipo = :tip".$pri." "; 
        $parametros[':tip'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY areas.Are_Nombre ASC";
    

    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
