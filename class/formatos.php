<?php
require_once('basedatos.php');

  class formatos extends basedatos {
    private $For_Codigo;
    private $Pla_Codigo;
    private $For_Nombre;
    private $For_FactorConversion;
    private $For_UsuarioCrea;
    private $For_FechaHoraCrea;
    private $For_Estado;

  function __construct($For_Codigo = NULL, $Pla_Codigo = NULL, $For_Nombre = NULL, $For_FactorConversion = NULL, $For_UsuarioCrea = NULL, $For_FechaHoraCrea = NULL, $For_Estado = NULL) {
    $this->For_Codigo = $For_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->For_Nombre = $For_Nombre;
    $this->For_FactorConversion = $For_FactorConversion;
    $this->For_UsuarioCrea = $For_UsuarioCrea;
    $this->For_FechaHoraCrea = $For_FechaHoraCrea;
    $this->For_Estado = $For_Estado;
    $this->tabla = "formatos";
  }

  function getFor_Codigo() {
    return $this->For_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getFor_Nombre() {
    return $this->For_Nombre;
  }

  function getFor_FactorConversion() {
    return $this->For_FactorConversion;
  }

  function getFor_UsuarioCrea() {
    return $this->For_UsuarioCrea;
  }

  function getFor_FechaHoraCrea() {
    return $this->For_FechaHoraCrea;
  }

  function getFor_Estado() {
    return $this->For_Estado;
  }

  function setFor_Codigo($For_Codigo) {
    $this->For_Codigo = $For_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setFor_Nombre($For_Nombre) {
    $this->For_Nombre = $For_Nombre;
  }

  function setFor_FactorConversion($For_FactorConversion) {
    $this->For_FactorConversion = $For_FactorConversion;
  }

  function setFor_UsuarioCrea($For_UsuarioCrea) {
    $this->For_UsuarioCrea = $For_UsuarioCrea;
  }

  function setFor_FechaHoraCrea($For_FechaHoraCrea) {
    $this->For_FechaHoraCrea = $For_FechaHoraCrea;
  }

  function setFor_Estado($For_Estado) {
    $this->For_Estado = $For_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "For_Nombre", "For_FactorConversion", "For_UsuarioCrea", "For_FechaHoraCrea", "For_Estado");
    $valores = array(
    array( 
      $this->Pla_Codigo, 
      $this->For_Nombre, 
      $this->For_FactorConversion, 
      $this->For_UsuarioCrea, 
      $this->For_FechaHoraCrea, 
      $this->For_Estado
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
    $sql =  "SELECT * FROM formatos WHERE For_Codigo = :cod";
    $parametros = array(":cod"=>$this->For_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setFor_Nombre($res[2]);
      $this->setFor_FactorConversion($res[3]);
      $this->setFor_UsuarioCrea($res[4]);
      $this->setFor_FechaHoraCrea($res[5]);
      $this->setFor_Estado($res[6]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "For_Nombre", "For_FactorConversion", "For_UsuarioCrea", "For_FechaHoraCrea", "For_Estado");
    $valores = array($this->getPla_Codigo(), $this->getFor_Nombre(), $this->getFor_FactorConversion(), $this->getFor_UsuarioCrea(), $this->getFor_FechaHoraCrea(), $this->getFor_Estado());
    $llaveprimaria = "For_Codigo";
    $valorllaveprimaria = $this->getFor_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM formatos WHERE For_Codigo = :cod";
    $parametros = array(":cod"=>$this->For_Codigo);
    $res = $this->consultaSQL($sql,$parametros);
    $this->desconectar();
    return $res;
  }

  /*
    Autor: Natalia Rodriguez
    Fecha: 
    Descripción:
    Parámetros:
   */
  public function listarFormatosPrincipal( $planta, $estado, $usuario ) {

    $parametros = array( ":est" => $estado, ":usu" => $usuario );

    $sql = "SELECT For_Codigo, Pla_Nombre, For_Nombre, For_Estado, For_FactorConversion
	 FROM formatos
	 INNER JOIN plantas ON formatos.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	 INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	 WHERE For_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";

    if ( $planta != "" ) {
      $pri = 1;
      foreach ( $planta as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " formatos.Pla_Codigo = :pla" . $pri . " ";
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
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarFormatosProgramaProduccionHorno( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT For_Nombre, Are_Nombre, formatos_hornos.Are_Codigo
	FROM formatos
	INNER JOIN formatos_hornos ON formatos.For_Codigo = formatos_hornos.For_Codigo AND formatos_hornos.ForH_Estado = 1
	INNER JOIN areas ON formatos_hornos.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
	INNER JOIN plantas ON formatos.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE For_Estado = 1 AND ForH_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu
	ORDER BY For_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }

  /*
   Autor: Natalia Rodriguez
   Fecha: 
   Descripción: NO MODIFICAR
   Parámetros:
  */
  public function listarFormatos( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT DISTINCT For_Nombre , For_Codigo, plantas.Pla_Codigo
     FROM formatos
     INNER JOIN plantas ON formatos.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
     INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado=1
     WHERE For_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu
     GROUP BY For_Nombre 
     ORDER BY For_Nombre ASC";

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
  public function listarFormatosUsuario( $planta, $usuario ) {

    $parametros = array( ":pla" => $planta, ":usu" => $usuario );

    $sql = "SELECT For_Codigo, For_Nombre
      FROM formatos
      INNER JOIN plantas ON formatos.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE formatos.Pla_Codigo = :pla AND plantas_usuarios.Usu_Codigo = :usu AND For_Estado = 1
      ORDER BY For_Nombre ASC";

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
  public function buscarPlanta( $formato ) {

    $parametros = array( ":for" => $formato );

    $sql = "SELECT plantas.Pla_Codigo
     FROM formatos
     INNER JOIN plantas ON formatos.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
     WHERE For_Estado = 1 AND formatos.For_Codigo = :for";

    $this->consultaSQL( $sql, $parametros );
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
  public function obtenerCodigo($codigo){

    $parametros = array(":cod"=>$codigo);

    $sql = "SELECT For_Nombre
    FROM formatos 
    WHERE For_Codigo = :cod";

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
  public function obtenerCodigoFormatoNombre($formato, $planta){

    $parametros = array(":for"=>$formato, ":pla"=>$planta);

    $sql = "SELECT For_Codigo, For_FactorConversion
    FROM formatos 
    WHERE For_Nombre = :for AND Pla_Codigo = :pla AND For_Estado = '1' LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>
