<?php
require_once( 'basedatos.php' );

class turnos extends basedatos {
  private $Tur_Codigo;
  private $Pla_Codigo;
  private $Tur_Nombre;
  private $Tur_HoraInicio;
  private $Tur_HoraFin;
  private $Tur_FechaHoraCrea;
  private $Tur_UsuarioCrea;
  private $Tur_Estado;

  function __construct( $Tur_Codigo = NULL, $Pla_Codigo = NULL, $Tur_Nombre = NULL, $Tur_HoraInicio = NULL, $Tur_HoraFin = NULL, $Tur_FechaHoraCrea = NULL, $Tur_UsuarioCrea = NULL, $Tur_Estado = NULL ) {
    $this->Tur_Codigo = $Tur_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Tur_Nombre = $Tur_Nombre;
    $this->Tur_HoraInicio = $Tur_HoraInicio;
    $this->Tur_HoraFin = $Tur_HoraFin;
    $this->Tur_FechaHoraCrea = $Tur_FechaHoraCrea;
    $this->Tur_UsuarioCrea = $Tur_UsuarioCrea;
    $this->Tur_Estado = $Tur_Estado;
    $this->tabla = "turnos";
  }

  function getTur_Codigo() {
    return $this->Tur_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getTur_Nombre() {
    return $this->Tur_Nombre;
  }

  function getTur_HoraInicio() {
    return $this->Tur_HoraInicio;
  }

  function getTur_HoraFin() {
    return $this->Tur_HoraFin;
  }

  function getTur_FechaHoraCrea() {
    return $this->Tur_FechaHoraCrea;
  }

  function getTur_UsuarioCrea() {
    return $this->Tur_UsuarioCrea;
  }

  function getTur_Estado() {
    return $this->Tur_Estado;
  }

  function setTur_Codigo( $Tur_Codigo ) {
    $this->Tur_Codigo = $Tur_Codigo;
  }

  function setPla_Codigo( $Pla_Codigo ) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setTur_Nombre( $Tur_Nombre ) {
    $this->Tur_Nombre = $Tur_Nombre;
  }

  function setTur_HoraInicio( $Tur_HoraInicio ) {
    $this->Tur_HoraInicio = $Tur_HoraInicio;
  }

  function setTur_HoraFin( $Tur_HoraFin ) {
    $this->Tur_HoraFin = $Tur_HoraFin;
  }

  function setTur_FechaHoraCrea( $Tur_FechaHoraCrea ) {
    $this->Tur_FechaHoraCrea = $Tur_FechaHoraCrea;
  }

  function setTur_UsuarioCrea( $Tur_UsuarioCrea ) {
    $this->Tur_UsuarioCrea = $Tur_UsuarioCrea;
  }

  function setTur_Estado( $Tur_Estado ) {
    $this->Tur_Estado = $Tur_Estado;
  }

  public function insertar() {
    $campos = array( "Pla_Codigo", "Tur_Nombre", "Tur_HoraInicio", "Tur_HoraFin", "Tur_FechaHoraCrea", "Tur_UsuarioCrea", "Tur_Estado" );
    $valores = array(
      array(
        $this->Pla_Codigo,
        $this->Tur_Nombre,
        $this->Tur_HoraInicio,
        $this->Tur_HoraFin,
        $this->Tur_FechaHoraCrea,
        $this->Tur_UsuarioCrea,
        $this->Tur_Estado
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
    $sql = "SELECT * FROM turnos WHERE Tur_Codigo = :cod";
    $parametros = array( ":cod" => $this->Tur_Codigo );
    if ( $this->consultaSQL( $sql, $parametros ) ) {
      $res = $this->cargarRegistro();

      $this->setPla_Codigo( $res[ 1 ] );
      $this->setTur_Nombre( $res[ 2 ] );
      $this->setTur_HoraInicio( $res[ 3 ] );
      $this->setTur_HoraFin( $res[ 4 ] );
      $this->setTur_FechaHoraCrea( $res[ 5 ] );
      $this->setTur_UsuarioCrea( $res[ 6 ] );
      $this->setTur_Estado( $res[ 7 ] );

      $this->desconectar();
    }
  }

  public function actualizar() {
    $campos = array( "Pla_Codigo", "Tur_Nombre", "Tur_HoraInicio", "Tur_HoraFin", "Tur_FechaHoraCrea", "Tur_UsuarioCrea", "Tur_Estado" );
    $valores = array( $this->getPla_Codigo(), $this->getTur_Nombre(), $this->getTur_HoraInicio(), $this->getTur_HoraFin(), $this->getTur_FechaHoraCrea(), $this->getTur_UsuarioCrea(), $this->getTur_Estado() );
    $llaveprimaria = "Tur_Codigo";
    $valorllaveprimaria = $this->getTur_Codigo();
    $res = $this->actualizarRegistros( $campos, $valores, $llaveprimaria, $valorllaveprimaria );
    $this->desconectar();
    return $res;
  }

  public function eliminar() {
    $sql = "DELETE FROM turnos WHERE Tur_Codigo = :cod";
    $parametros = array( ":cod" => $this->Tur_Codigo );
    $res = $this->consultaSQL( $sql, $parametros );
    $this->desconectar();
    return $res;
  }

  /*
    Autor: Natalia Rodriguez
    Fecha: 
    Descripción:
    Parámetros:
   */
  public function listarTurnosPrincipal($planta, $estado, $usuario) {

    $parametros = array( ":est" => $estado, ":usu"=>$usuario );

    $sql = "SELECT Tur_Codigo, Pla_Nombre, Tur_Nombre, Tur_HoraInicio, Tur_HoraFin, turnos.Pla_Codigo, Tur_Estado
    FROM turnos
    INNER JOIN plantas ON turnos.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE Tur_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";

    if ( $planta != "" ) {
      $pri = 1;
      foreach ( $planta as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " turnos.Pla_Codigo = :pla" . $pri . " ";
        $parametros[ ':pla' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    } 

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
  public function listarTurnosPrincipalPlanta($planta, $estado, $usuario) {

    $parametros = array( ":est" => $estado, ":usu"=>$usuario, ":pla"=>$planta );

    $sql = "SELECT Tur_Codigo, Pla_Nombre, Tur_Nombre, Tur_HoraInicio, Tur_HoraFin, turnos.Pla_Codigo
    FROM turnos
    INNER JOIN plantas ON turnos.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE Tur_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu AND turnos.Pla_Codigo = :pla ORDER BY Tur_Nombre ASC";
    
    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }

	/*
    Autor: Natalia Rodriguez
    Fecha: 
    Descripción:
    Parámetros:
   */
  public function listarTurnos() {

    $sql = "SELECT DISTINCT Tur_Nombre , Tur_Codigo
    FROM turnos
    WHERE Tur_Estado = 1
    GROUP BY Tur_Nombre 
    ORDER BY Tur_Nombre ASC";

    $this->consultaSQL( $sql );
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
  public function filtroTurnosOperador($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Tur_Codigo, Tur_Nombre
	FROM turnos
	WHERE Tur_Estado = 1 AND Pla_Codigo = :pla 
  ORDER BY Tur_Nombre ASC ";

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
  public function filtroTurnosOperadorCalCierres($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Tur_Codigo, Tur_Nombre, Tur_HoraInicio, Tur_HoraFin
	FROM turnos
	WHERE Tur_Estado = 1 AND Pla_Codigo = :pla 
  ORDER BY Tur_Nombre, Tur_HoraInicio ASC ";

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
  public function hallarTurnoSegunHora($planta, $hora){

    $parametros = array(":pla"=>$planta, ":hor"=>$hora);

    $sql = "SELECT Tur_Codigo
    FROM turnos
    WHERE Tur_Estado = 1 AND Pla_Codigo = :pla AND :hor >= Tur_HoraInicio AND :hor <= Tur_HoraFin
    LIMIT 1";

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
  public function listarUltimaReferenciaCierreTurno($planta, $agrupacion, $fecha){

    $parametros = array(":pla"=>$planta, ":agr"=>$agrupacion, ":fec"=>$fecha);

    $sql = "SELECT t2.Tur_Codigo, t2.Tur_Nombre,
    (SELECT For_Codigo
    FROM formularios_defectos d 
    INNER JOIN calidad c ON d.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1 
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1 
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo 
    INNER JOIN parametros p1 ON ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 
    INNER JOIN estaciones_usuarios e ON d.EstU_Codigo = e.EstU_Codigo AND e.EstU_Estado = 1
    INNER JOIN turnos t ON e.Tur_Codigo = t.Tur_Codigo AND t.Tur_estado = 1
    WHERE ForD_Estado = 1 AND ForD_Fecha = :fec AND agrupaciones.Agr_Codigo = :agr AND t.Tur_Codigo = t2.Tur_Codigo
    GROUP BY For_Codigo, ForD_Familia, ForD_Color, t.Tur_Codigo
    ORDER BY ForD_FechaHoraCrea DESC
    LIMIT 1) AS Formato,
    (SELECT ForD_Familia
    FROM formularios_defectos d 
    INNER JOIN calidad c ON d.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1 
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1 
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo 
    INNER JOIN parametros p1 ON ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 
    INNER JOIN estaciones_usuarios e ON d.EstU_Codigo = e.EstU_Codigo AND e.EstU_Estado = 1
    INNER JOIN turnos t ON e.Tur_Codigo = t.Tur_Codigo AND t.Tur_estado = 1
    WHERE ForD_Estado = 1 AND ForD_Fecha = :fec AND agrupaciones.Agr_Codigo = :agr AND t.Tur_Codigo = t2.Tur_Codigo
    GROUP BY For_Codigo, ForD_Familia, ForD_Color, t.Tur_Codigo
    ORDER BY ForD_FechaHoraCrea DESC
    LIMIT 1) AS Familia,
    (SELECT ForD_Color
    FROM formularios_defectos d 
    INNER JOIN calidad c ON d.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1 
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1 
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo 
    INNER JOIN parametros p1 ON ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 
    INNER JOIN estaciones_usuarios e ON d.EstU_Codigo = e.EstU_Codigo AND e.EstU_Estado = 1
    INNER JOIN turnos t ON e.Tur_Codigo = t.Tur_Codigo AND t.Tur_estado = 1
    WHERE ForD_Estado = 1 AND ForD_Fecha = :fec AND agrupaciones.Agr_Codigo = :agr AND t.Tur_Codigo = t2.Tur_Codigo
    GROUP BY For_Codigo, ForD_Familia, ForD_Color, t.Tur_Codigo
    ORDER BY ForD_FechaHoraCrea DESC
    LIMIT 1) AS Color,
    (SELECT SUM(ForD_NumeroPiezas)
    FROM formularios_defectos d 
    INNER JOIN calidad c ON d.Cal_Codigo = c.Cal_Codigo AND c.Cal_Estado = 1 
    INNER JOIN areas a ON c.Are_Codigo = a.Are_Codigo AND a.Are_Estado = 1 
    INNER JOIN agrupaciones_areas ON a.Are_Codigo = agrupaciones_areas.Are_Codigo 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo 
    INNER JOIN parametros p1 ON ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1 
    INNER JOIN estaciones_usuarios e ON d.EstU_Codigo = e.EstU_Codigo AND e.EstU_Estado = 1
    INNER JOIN turnos t ON e.Tur_Codigo = t.Tur_Codigo AND t.Tur_estado = 1
    WHERE ForD_Estado = 1 AND ForD_Fecha = :fec AND agrupaciones.Agr_Codigo = :agr AND t.Tur_Codigo = t2.Tur_Codigo
    GROUP BY For_Codigo, ForD_Familia, ForD_Color, t.Tur_Codigo
    ORDER BY ForD_FechaHoraCrea DESC
    LIMIT 1) AS CantDef
    FROM turnos t2
    WHERE t2.Tur_Estado = 1 AND Pla_Codigo = :pla
    ORDER BY t2.Tur_Nombre ASC";

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
  public function buscarHoraTurnoPlanta($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT MIN(Tur_HoraInicio), MIN(Tur_HoraFin)
    FROM turnos
    WHERE Pla_Codigo = :pla AND Tur_Estado = '1'";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
  
  /*
  Autor: RxDavid
  Fecha: 
  Descripción: Para validación de registro de notificaciones
  Parámetros:
  */
  public function horasTurnoRegistroNotPanelSupervisor($planta, $turno){

    $parametros = array(":pla"=>$planta, ":tur"=>$turno);

    $sql = "SELECT Tur_HoraInicio, Tur_HoraFin
    FROM turnos
    WHERE Pla_Codigo = :pla AND Tur_Estado = '1' AND Tur_Codigo = :tur LIMIT 1";

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
  public function hallarPrimerTurnoPlanta($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Tur_Codigo, Tur_HoraInicio, Tur_HoraFin
    FROM turnos
    WHERE Tur_Estado = 1 AND Pla_Codigo = :pla
    ORDER BY Tur_Codigo ASC
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
  public function filtroTurnosOperadorAutomatico($planta, $horaActual){

    $parametros = array(":pla"=>$planta,":hor"=>$horaActual);

    $sql = "SELECT Tur_Codigo, Tur_Nombre, Tur_HoraInicio, Tur_HoraFin FROM turnos
    WHERE Pla_Codigo = :pla AND Tur_Estado = 1 AND
    IF(
        Tur_HoraInicio <= Tur_HoraFin,
        :hor BETWEEN Tur_HoraInicio AND Tur_HoraFin,
        :hor >= Tur_HoraInicio OR :hor <= Tur_HoraFin
    );";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
