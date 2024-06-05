<?php
require_once('basedatos.php');

  class frecuencias extends basedatos {
    private $Fre_Codigo;
    private $Tur_Codigo;
    private $Var_Codigo;
    private $Fre_Hora;
    private $Fre_FechaHoraCrea;
    private $Fre_UsuarioCrea;
    private $Fre_Estado;

  function __construct($Fre_Codigo = NULL, $Tur_Codigo = NULL, $Var_Codigo = NULL, $Fre_Hora = NULL, $Fre_FechaHoraCrea = NULL, $Fre_UsuarioCrea = NULL, $Fre_Estado = NULL) {
    $this->Fre_Codigo = $Fre_Codigo;
    $this->Tur_Codigo = $Tur_Codigo;
    $this->Var_Codigo = $Var_Codigo;
    $this->Fre_Hora = $Fre_Hora;
    $this->Fre_FechaHoraCrea = $Fre_FechaHoraCrea;
    $this->Fre_UsuarioCrea = $Fre_UsuarioCrea;
    $this->Fre_Estado = $Fre_Estado;
    $this->tabla = "frecuencias";
  }

  function getFre_Codigo() {
    return $this->Fre_Codigo;
  }

  function getTur_Codigo() {
    return $this->Tur_Codigo;
  }

  function getVar_Codigo() {
    return $this->Var_Codigo;
  }

  function getFre_Hora() {
    return $this->Fre_Hora;
  }

  function getFre_FechaHoraCrea() {
    return $this->Fre_FechaHoraCrea;
  }

  function getFre_UsuarioCrea() {
    return $this->Fre_UsuarioCrea;
  }

  function getFre_Estado() {
    return $this->Fre_Estado;
  }

  function setFre_Codigo($Fre_Codigo) {
    $this->Fre_Codigo = $Fre_Codigo;
  }

  function setTur_Codigo($Tur_Codigo) {
    $this->Tur_Codigo = $Tur_Codigo;
  }

  function setVar_Codigo($Var_Codigo) {
    $this->Var_Codigo = $Var_Codigo;
  }

  function setFre_Hora($Fre_Hora) {
    $this->Fre_Hora = $Fre_Hora;
  }

  function setFre_FechaHoraCrea($Fre_FechaHoraCrea) {
    $this->Fre_FechaHoraCrea = $Fre_FechaHoraCrea;
  }

  function setFre_UsuarioCrea($Fre_UsuarioCrea) {
    $this->Fre_UsuarioCrea = $Fre_UsuarioCrea;
  }

  function setFre_Estado($Fre_Estado) {
    $this->Fre_Estado = $Fre_Estado;
  }

  public function insertar(){
    $campos = array("Tur_Codigo", "Var_Codigo", "Fre_Hora", "Fre_FechaHoraCrea", "Fre_UsuarioCrea", "Fre_Estado");
    $valores = array(
    array(
      $this->Tur_Codigo, 
      $this->Var_Codigo, 
      $this->Fre_Hora, 
      $this->Fre_FechaHoraCrea, 
      $this->Fre_UsuarioCrea, 
      $this->Fre_Estado
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
    $sql =  "SELECT * FROM frecuencias WHERE Fre_Codigo = :cod";
    $parametros = array(":cod"=>$this->Fre_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setTur_Codigo($res[1]);
      $this->setVar_Codigo($res[2]);
      $this->setFre_Hora($res[3]);
      $this->setFre_FechaHoraCrea($res[4]);
      $this->setFre_UsuarioCrea($res[5]);
      $this->setFre_Estado($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Tur_Codigo", "Var_Codigo", "Fre_Hora", "Fre_FechaHoraCrea", "Fre_UsuarioCrea", "Fre_Estado");
    $valores = array($this->getTur_Codigo(), $this->getVar_Codigo(), $this->getFre_Hora(), $this->getFre_FechaHoraCrea(), $this->getFre_UsuarioCrea(), $this->getFre_Estado());
    $llaveprimaria = "Fre_Codigo";
    $valorllaveprimaria = $this->getFre_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM frecuencias WHERE Fre_Codigo = :cod";
    $parametros = array(":cod"=>$this->Fre_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }
	  
  /*
    Autor: Natalia Rodríguez
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function frecuenciasVariables($codVariable){

    $parametros = array(":cod"=>$codVariable);

    $sql = "SELECT max(fr.Fre_Codigo), fr.Var_Codigo, fr.Tur_Codigo, fr.Fre_Hora, (SELECT fr2.Fre_Estado
    FROM frecuencias fr2
    WHERE max(fr.Fre_Codigo) = fr2.Fre_Codigo) AS estado
    FROM frecuencias fr
    WHERE fr.Var_Codigo = :cod
     group by fr.Var_Codigo, fr.Tur_Codigo, fr.Fre_Hora
    ORDER BY fr.Tur_Codigo,fr.Fre_Codigo desc, fr.Fre_Hora asc";

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
  public function frecuenciasVariablesActivosInactivos($codVariable){

    $parametros = array(":cod"=>$codVariable);

    $sql = "SELECT Fre_Codigo, Var_Codigo, Tur_Codigo, Fre_Hora
    FROM frecuencias
    WHERE Var_Codigo = :cod
    ORDER BY Fre_Hora ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
  
    
//  /*
//    Autor: Kevin Osorio
//    Fecha: 
//    Descripción:
//    Parámetros:
//  */
//  public function frecuenciasVariablesHorasPorAreayMaquina($codigoPlanta){
//      $parametros = array(":plan"=>$codigoPlanta);
//
//    $sql = "SELECT areas.Are_Codigo , Are_Nombre, maquinas.Maq_Codigo, Maq_Nombre,  frecuencias.Var_Codigo, variables.Var_Nombre,
//    frecuencias.Tur_Codigo, turnos.Tur_Nombre ,Fre_Hora
//    FROM frecuencias
//    INNER JOIN variables ON frecuencias.Var_Codigo = variables.Var_Codigo AND Var_Estado = '1'
//    INNER JOIN turnos ON frecuencias.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = '1'
//    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
//    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
//    WHERE Fre_Estado = '1' AND turnos.Pla_Codigo = :plan
//    ORDER BY Var_Codigo ASC";
//
//    $this->consultaSQL($sql, $parametros);
//    $res = $this->cargarTodo();
//    $this->desconectar();
//    return $res;
//  } 
    
  /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
  */
  public function frecuenciasVariablesHorasPorAreayMaquina($codigoPlanta){
      $parametros = array(":plan"=>$codigoPlanta);

    $sql = "SELECT areas.Are_Codigo, areas.Are_Nombre, maquinas.Maq_Codigo, maquinas.Maq_Nombre,  frecuencias.Var_Codigo, variables.Var_Nombre,
    frecuencias.Tur_Codigo, turnos.Tur_Nombre ,Fre_Hora
    FROM variables 
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1 
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1 
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1 
    INNER JOIN frecuencias ON variables.Var_Codigo = frecuencias.Var_Codigo AND Fre_Estado = '1'
    INNER JOIN turnos ON frecuencias.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = '1'
    WHERE Var_Estado = '1' AND plantas.Pla_Codigo = :plan AND Var_Origen = 3 
    ORDER BY variables.Var_Codigo ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  } 
     
//  /*
//    Autor: Kevin Osorio
//    Fecha: 
//    Descripción:
//    Parámetros:
//  */
//  public function frecuenciasVariablesPorAreayMaquina($codigoPlanta){
//      $parametros = array(":plan"=>$codigoPlanta);
//
//    $sql = "SELECT DISTINCT areas.Are_Codigo , Are_Nombre, maquinas.Maq_Codigo, Maq_Nombre, variables.Var_Nombre
//    FROM frecuencias
//    INNER JOIN variables ON frecuencias.Var_Codigo = variables.Var_Codigo AND Var_Estado = '1'
//    INNER JOIN turnos ON frecuencias.Tur_Codigo = turnos.Tur_Codigo AND Tur_Estado = '1'
//    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = '1'
//    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND Are_Estado = '1'
//    WHERE Fre_Estado = '1' AND turnos.Pla_Codigo = :plan
//    ORDER BY variables.Var_Codigo ASC";
//
//    $this->consultaSQL($sql, $parametros);
//    $res = $this->cargarTodo();
//    $this->desconectar();
//    return $res;
//  }   
    
  /*
    Autor: dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
  */
  public function frecuenciasVariablesPorAreayMaquina($codigoPlanta){
      $parametros = array(":plan"=>$codigoPlanta);

    $sql = "SELECT areas.Are_Codigo, areas.Are_Nombre, maquinas.Maq_Codigo, maquinas.Maq_Nombre, Var_Nombre
    FROM variables 
    INNER JOIN maquinas ON variables.Maq_Codigo = maquinas.Maq_Codigo AND maquinas.Maq_Estado = 1 
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1 
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1 
    WHERE Var_Estado = '1' AND plantas.Pla_Codigo = :plan AND Var_Origen = 3 
    ORDER BY variables.Var_Codigo ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  } 
}
?>
