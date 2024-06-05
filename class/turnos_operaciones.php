<?php
require_once('basedatos.php');

  class turnos_operaciones extends basedatos {
    private $TurO_Codigo;
    private $Are_Codigo;
    private $Tur_Codigo;
    private $TurO_Variable;
    private $TurO_Fecha;
    private $TurO_Observaciones;
    private $TurO_UsuarioCrea;
    private $TurO_FechaHoraCrea;
    private $TurO_Estado;

  function __construct($TurO_Codigo = NULL, $Are_Codigo = NULL, $Tur_Codigo = NULL, $TurO_Variable = NULL, $TurO_Fecha = NULL, $TurO_Observaciones = NULL, $TurO_UsuarioCrea = NULL, $TurO_FechaHoraCrea = NULL, $TurO_Estado = NULL) {
    $this->TurO_Codigo = $TurO_Codigo;
    $this->Are_Codigo = $Are_Codigo;
    $this->Tur_Codigo = $Tur_Codigo;
    $this->TurO_Variable = $TurO_Variable;
    $this->TurO_Fecha = $TurO_Fecha;
    $this->TurO_Observaciones = $TurO_Observaciones;
    $this->TurO_UsuarioCrea = $TurO_UsuarioCrea;
    $this->TurO_FechaHoraCrea = $TurO_FechaHoraCrea;
    $this->TurO_Estado = $TurO_Estado;
    $this->tabla = "turnos_operaciones";
  }

  function getTurO_Codigo() {
    return $this->TurO_Codigo;
  }

  function getAre_Codigo() {
    return $this->Are_Codigo;
  }

  function getTur_Codigo() {
    return $this->Tur_Codigo;
  }

  function getTurO_Variable() {
    return $this->TurO_Variable;
  }

  function getTurO_Fecha() {
    return $this->TurO_Fecha;
  }

  function getTurO_Observaciones() {
    return $this->TurO_Observaciones;
  }

  function getTurO_UsuarioCrea() {
    return $this->TurO_UsuarioCrea;
  }

  function getTurO_FechaHoraCrea() {
    return $this->TurO_FechaHoraCrea;
  }

  function getTurO_Estado() {
    return $this->TurO_Estado;
  }

  function setTurO_Codigo($TurO_Codigo) {
    $this->TurO_Codigo = $TurO_Codigo;
  }

  function setAre_Codigo($Are_Codigo) {
    $this->Are_Codigo = $Are_Codigo;
  }

  function setTur_Codigo($Tur_Codigo) {
    $this->Tur_Codigo = $Tur_Codigo;
  }

  function setTurO_Variable($TurO_Variable) {
    $this->TurO_Variable = $TurO_Variable;
  }

  function setTurO_Fecha($TurO_Fecha) {
    $this->TurO_Fecha = $TurO_Fecha;
  }

  function setTurO_Observaciones($TurO_Observaciones) {
    $this->TurO_Observaciones = $TurO_Observaciones;
  }

  function setTurO_UsuarioCrea($TurO_UsuarioCrea) {
    $this->TurO_UsuarioCrea = $TurO_UsuarioCrea;
  }

  function setTurO_FechaHoraCrea($TurO_FechaHoraCrea) {
    $this->TurO_FechaHoraCrea = $TurO_FechaHoraCrea;
  }

  function setTurO_Estado($TurO_Estado) {
    $this->TurO_Estado = $TurO_Estado;
  }

  public function insertar(){
    $campos = array("Are_Codigo", "Tur_Codigo", "TurO_Variable", "TurO_Fecha", "TurO_Observaciones", "TurO_UsuarioCrea", "TurO_FechaHoraCrea", "TurO_Estado");
    $valores = array(
    array(
      $this->Are_Codigo, 
      $this->Tur_Codigo, 
      $this->TurO_Variable, 
      $this->TurO_Fecha, 
      $this->TurO_Observaciones, 
      $this->TurO_UsuarioCrea, 
      $this->TurO_FechaHoraCrea, 
      $this->TurO_Estado
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
    $sql =  "SELECT * FROM turnos_operaciones WHERE TurO_Codigo = :cod";
    $parametros = array(":cod"=>$this->TurO_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setAre_Codigo($res[1]);
      $this->setTur_Codigo($res[2]);
      $this->setTurO_Variable($res[3]);
      $this->setTurO_Fecha($res[4]);
      $this->setTurO_Observaciones($res[5]);
      $this->setTurO_UsuarioCrea($res[6]);
      $this->setTurO_FechaHoraCrea($res[7]);
      $this->setTurO_Estado($res[8]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Are_Codigo", "Tur_Codigo", "TurO_Variable", "TurO_Fecha", "TurO_Observaciones", "TurO_UsuarioCrea", "TurO_FechaHoraCrea", "TurO_Estado");
    $valores = array($this->getAre_Codigo(), $this->getTur_Codigo(), $this->getTurO_Variable(), $this->getTurO_Fecha(), $this->getTurO_Observaciones(), $this->getTurO_UsuarioCrea(), $this->getTurO_FechaHoraCrea(), $this->getTurO_Estado());
    $llaveprimaria = "TurO_Codigo";
    $valorllaveprimaria = $this->getTurO_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM turnos_operaciones WHERE TurO_Codigo = :cod";
    $parametros = array(":cod"=>$this->TurO_Codigo);
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
  public function listarTurnosOperacionesPrincipal($fechaInicial, $fechaFinal, $turnos, $horaInicial, $horaFinal, $areas){

    $parametros = array(":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal, ":fechorini"=>$fechaInicial." ".$horaInicial, ":fechorfin"=>$fechaFinal." ".$horaFinal);

    $sql = "SELECT TurO_Codigo, turnos_operaciones.Are_Codigo, TurO_Fecha, Tur_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombres, usuarios.Usu_Apellidos) AS UsuCrea, CONCAT_WS(' ', TurO_Fecha, Tur_HoraInicio) AS FecValIni, IF(Tur_HoraInicio > Tur_HoraFin, DATE_ADD(STR_TO_DATE(CONCAT_WS(' ', TurO_Fecha, Tur_HoraFin), '%Y-%m-%d %H:%i:%s'), INTERVAL 1 DAY), CONCAT_WS(' ', TurO_Fecha, Tur_HoraFin)) AS FecValFin
    FROM turnos_operaciones
    INNER JOIN turnos ON turnos_operaciones.Tur_Codigo = turnos.Tur_Codigo
    INNER JOIN usuarios ON turnos_operaciones.TurO_UsuarioCrea = usuarios.Usu_Codigo
    WHERE TurO_Fecha BETWEEN :fecini AND :fecfin
    AND TurO_Estado = 1 ";
    
    if($turnos != ""){ 
      $pri3 = 1; 
      foreach($turnos as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " turnos_operaciones.Tur_Codigo = :tur".$pri3." "; 
        $parametros[':tur'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    if($areas != ""){ 
      $pri4 = 1; 
      foreach($areas as $registro4){ 
        if($pri4 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " turnos_operaciones.Are_Codigo = :are".$pri4." ";
        $parametros[':are'.$pri4] = $registro4;
        $pri4++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " HAVING FecValIni >= :fechorini AND FecValIni <= :fechorfin ORDER BY TurO_Fecha ASC, Tur_Nombre ASC";

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
  public function listarTurnosOperacionesDetalle($fechaInicial, $fechaFinal, $codigoMaquina, $nombreVariable, $turnos, $horaInicial, $horaFinal){

    $parametros = array(":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal, ":codmaq"=>$codigoMaquina, ":nomvar"=>$nombreVariable, ":fechorini"=>$fechaInicial." ".$horaInicial, ":fechorfin"=>$fechaFinal." ".$horaFinal);

    $sql = "SELECT TurO_Codigo, TurO_Fecha, Tur_Nombre, TurO_Observaciones, CONCAT_WS(' ', usuarios.Usu_Nombres, usuarios.Usu_Apellidos) AS UsuCrea, CONCAT_WS(' ', TurO_Fecha, Tur_HoraInicio) AS FecValIni, IF(Tur_HoraInicio > Tur_HoraFin, DATE_ADD(STR_TO_DATE(CONCAT_WS(' ', TurO_Fecha, Tur_HoraFin), '%Y-%m-%d %H:%i:%s'), INTERVAL 1 DAY), CONCAT_WS(' ', TurO_Fecha, Tur_HoraFin)) AS FecValFin
    FROM turnos_operaciones
    INNER JOIN turnos ON turnos_operaciones.Tur_Codigo = turnos.Tur_Codigo
    INNER JOIN usuarios ON turnos_operaciones.TurO_UsuarioCrea = usuarios.Usu_Codigo
    WHERE turnos_operaciones.Maq_Codigo = :codmaq AND TurO_Variable = :nomvar AND TurO_Fecha BETWEEN :fecini AND :fecfin
    AND TurO_Estado = 1 ";
    
    if($turnos != ""){ 
      $pri3 = 1; 
      foreach($turnos as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " turnos_operaciones.Tur_Codigo = :tur".$pri3." "; 
        $parametros[':tur'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " HAVING FecValIni >= :fechorini AND FecValIni <= :fechorfin ORDER BY TurO_Fecha ASC, Tur_Nombre ASC";

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
  public function listarDescuentosTurnosOperacionesCrear($fechaInicial, $fechaFinal, $areas, $turnos, $horaInicial, $horaFinal){

    $parametros = array(":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal, ":fechorini"=>$fechaInicial." ".$horaInicial, ":fechorfin"=>$fechaFinal." ".$horaFinal);

    $sql = "SELECT TurO_Codigo, TurO_Fecha, Tur_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombres, usuarios.Usu_Apellidos) AS UsuCrea, CONCAT_WS(' ', TurO_Fecha, Tur_HoraInicio) AS FecValIni, IF(Tur_HoraInicio > Tur_HoraFin, DATE_ADD(STR_TO_DATE(CONCAT_WS(' ', TurO_Fecha, Tur_HoraFin), '%Y-%m-%d %H:%i:%s'), INTERVAL 1 DAY), CONCAT_WS(' ', TurO_Fecha, Tur_HoraFin)) AS FecValFin
    FROM turnos_operaciones
    INNER JOIN turnos ON turnos_operaciones.Tur_Codigo = turnos.Tur_Codigo
    INNER JOIN usuarios ON turnos_operaciones.TurO_UsuarioCrea = usuarios.Usu_Codigo
    WHERE TurO_Fecha BETWEEN :fecini AND :fecfin
    AND TurO_Estado = 1  ";
    
    if($turnos != ""){ 
      $pri3 = 1; 
      foreach($turnos as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " turnos_operaciones.Tur_Codigo = :tur".$pri3." "; 
        $parametros[':tur'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    if($areas != ""){ 
      $pri4 = 1; 
      foreach($areas as $registro4){ 
        if($pri4 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " turnos_operaciones.Are_Codigo = :are".$pri4." ";
        $parametros[':are'.$pri4] = $registro4;
        $pri4++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " HAVING FecValIni >= :fechorini AND FecValIni <= :fechorfin ORDER BY TurO_Fecha ASC, Tur_Nombre ASC";

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
  public function listarDescuentosTurnosOperacionesListar($fechaInicial, $fechaFinal, $areas, $turnos, $horaInicial, $horaFinal){

    $parametros = array(":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal, ":fechorini"=>$fechaInicial." ".$horaInicial, ":fechorfin"=>$fechaFinal." ".$horaFinal);

    $sql = "SELECT TurO_Codigo, TurO_Fecha, Tur_Nombre, CONCAT_WS(' ', usuarios.Usu_Nombres, usuarios.Usu_Apellidos) AS UsuCrea, CONCAT_WS(' ', TurO_Fecha, Tur_HoraInicio) AS FecValIni, IF(Tur_HoraInicio > Tur_HoraFin, DATE_ADD(STR_TO_DATE(CONCAT_WS(' ', TurO_Fecha, Tur_HoraFin), '%Y-%m-%d %H:%i:%s'), INTERVAL 1 DAY), CONCAT_WS(' ', TurO_Fecha, Tur_HoraFin)) AS FecValFin, turnos_operaciones.Are_Codigo, areas.Are_Nombre, TurO_Observaciones
    FROM turnos_operaciones
    INNER JOIN turnos ON turnos_operaciones.Tur_Codigo = turnos.Tur_Codigo
    INNER JOIN usuarios ON turnos_operaciones.TurO_UsuarioCrea = usuarios.Usu_Codigo
    INNER JOIN areas ON turnos_operaciones.Are_Codigo = areas.Are_Codigo
    WHERE TurO_Fecha BETWEEN :fecini AND :fecfin
    AND TurO_Estado = 1  ";
    
    if($turnos != ""){ 
      $pri3 = 1; 
      foreach($turnos as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " turnos_operaciones.Tur_Codigo = :tur".$pri3." "; 
        $parametros[':tur'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    if($areas != ""){ 
      $pri4 = 1; 
      foreach($areas as $registro4){ 
        if($pri4 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " turnos_operaciones.Are_Codigo = :are".$pri4." ";
        $parametros[':are'.$pri4] = $registro4;
        $pri4++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " HAVING FecValIni >= :fechorini AND FecValIni <= :fechorfin ORDER BY TurO_Fecha ASC, Tur_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
  
}
?>