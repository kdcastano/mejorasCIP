<?php
require_once('basedatos.php');

  class plantas extends basedatos {
    private $Pla_Codigo;
    private $Pla_CentroCostos;
    private $Pla_Nombre;
    private $Pla_Grupo;
    private $Pla_Distribucion;
    private $Pla_Marca;
    private $Pla_VerMarcaSubMarca;
    private $Pla_FormatoSAP;
    private $Pla_Tolerancia;
    private $Pla_ZonaHoraria;
    private $Pla_CantidadAprobador;
    private $Pla_FechaHoraCrea;
    private $Pla_UsuarioCrea;
    private $Pla_Estado;

  function __construct($Pla_Codigo = NULL, $Pla_CentroCostos = NULL, $Pla_Nombre = NULL, $Pla_Grupo = NULL, $Pla_Distribucion = NULL, $Pla_Marca = NULL, $Pla_VerMarcaSubMarca = NULL, $Pla_FormatoSAP = NULL, $Pla_Tolerancia = NULL, $Pla_ZonaHoraria = NULL, $Pla_CantidadAprobador = NULL, $Pla_FechaHoraCrea = NULL, $Pla_UsuarioCrea = NULL, $Pla_Estado = NULL) {
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Pla_CentroCostos = $Pla_CentroCostos;
    $this->Pla_Nombre = $Pla_Nombre;
    $this->Pla_Grupo = $Pla_Grupo;
    $this->Pla_Distribucion = $Pla_Distribucion;
    $this->Pla_Marca = $Pla_Marca;
    $this->Pla_VerMarcaSubMarca = $Pla_VerMarcaSubMarca;
    $this->Pla_FormatoSAP = $Pla_FormatoSAP;
    $this->Pla_Tolerancia = $Pla_Tolerancia;
    $this->Pla_ZonaHoraria = $Pla_ZonaHoraria;
    $this->Pla_CantidadAprobador = $Pla_CantidadAprobador;
    $this->Pla_FechaHoraCrea = $Pla_FechaHoraCrea;
    $this->Pla_UsuarioCrea = $Pla_UsuarioCrea;
    $this->Pla_Estado = $Pla_Estado;
    $this->tabla = "plantas";
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getPla_CentroCostos() {
    return $this->Pla_CentroCostos;
  }

  function getPla_Nombre() {
    return $this->Pla_Nombre;
  }

  function getPla_Grupo() {
    return $this->Pla_Grupo;
  }

  function getPla_Distribucion() {
    return $this->Pla_Distribucion;
  }

  function getPla_Marca() {
    return $this->Pla_Marca;
  }

  function getPla_VerMarcaSubMarca() {
    return $this->Pla_VerMarcaSubMarca;
  }

  function getPla_FormatoSAP() {
    return $this->Pla_FormatoSAP;
  }

  function getPla_Tolerancia() {
    return $this->Pla_Tolerancia;
  }

  function getPla_ZonaHoraria() {
    return $this->Pla_ZonaHoraria;
  }

  function getPla_CantidadAprobador() {
    return $this->Pla_CantidadAprobador;
  }

  function getPla_FechaHoraCrea() {
    return $this->Pla_FechaHoraCrea;
  }

  function getPla_UsuarioCrea() {
    return $this->Pla_UsuarioCrea;
  }

  function getPla_Estado() {
    return $this->Pla_Estado;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setPla_CentroCostos($Pla_CentroCostos) {
    $this->Pla_CentroCostos = $Pla_CentroCostos;
  }

  function setPla_Nombre($Pla_Nombre) {
    $this->Pla_Nombre = $Pla_Nombre;
  }

  function setPla_Grupo($Pla_Grupo) {
    $this->Pla_Grupo = $Pla_Grupo;
  }

  function setPla_Distribucion($Pla_Distribucion) {
    $this->Pla_Distribucion = $Pla_Distribucion;
  }

  function setPla_Marca($Pla_Marca) {
    $this->Pla_Marca = $Pla_Marca;
  }

  function setPla_VerMarcaSubMarca($Pla_VerMarcaSubMarca) {
    $this->Pla_VerMarcaSubMarca = $Pla_VerMarcaSubMarca;
  }

  function setPla_FormatoSAP($Pla_FormatoSAP) {
    $this->Pla_FormatoSAP = $Pla_FormatoSAP;
  }

  function setPla_Tolerancia($Pla_Tolerancia) {
    $this->Pla_Tolerancia = $Pla_Tolerancia;
  }

  function setPla_ZonaHoraria($Pla_ZonaHoraria) {
    $this->Pla_ZonaHoraria = $Pla_ZonaHoraria;
  }

  function setPla_CantidadAprobador($Pla_CantidadAprobador) {
    $this->Pla_CantidadAprobador = $Pla_CantidadAprobador;
  }

  function setPla_FechaHoraCrea($Pla_FechaHoraCrea) {
    $this->Pla_FechaHoraCrea = $Pla_FechaHoraCrea;
  }

  function setPla_UsuarioCrea($Pla_UsuarioCrea) {
    $this->Pla_UsuarioCrea = $Pla_UsuarioCrea;
  }

  function setPla_Estado($Pla_Estado) {
    $this->Pla_Estado = $Pla_Estado;
  }

  public function insertar(){
    $campos = array("Pla_CentroCostos", "Pla_Nombre", "Pla_Grupo", "Pla_Distribucion", "Pla_Marca", "Pla_VerMarcaSubMarca", "Pla_FormatoSAP", "Pla_Tolerancia", "Pla_ZonaHoraria", "Pla_CantidadAprobador", "Pla_FechaHoraCrea", "Pla_UsuarioCrea", "Pla_Estado");
    $valores = array(
    array( 
      $this->Pla_CentroCostos, 
      $this->Pla_Nombre, 
      $this->Pla_Grupo, 
      $this->Pla_Distribucion, 
      $this->Pla_Marca, 
      $this->Pla_VerMarcaSubMarca, 
      $this->Pla_FormatoSAP, 
      $this->Pla_Tolerancia, 
      $this->Pla_ZonaHoraria, 
      $this->Pla_CantidadAprobador, 
      $this->Pla_FechaHoraCrea, 
      $this->Pla_UsuarioCrea, 
      $this->Pla_Estado
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
    $sql =  "SELECT * FROM plantas WHERE Pla_Codigo = :cod";
    $parametros = array(":cod"=>$this->Pla_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_CentroCostos($res[1]);
      $this->setPla_Nombre($res[2]);
      $this->setPla_Grupo($res[3]);
      $this->setPla_Distribucion($res[4]);
      $this->setPla_Marca($res[5]);
      $this->setPla_VerMarcaSubMarca($res[6]);
      $this->setPla_FormatoSAP($res[7]);
      $this->setPla_Tolerancia($res[8]);
      $this->setPla_ZonaHoraria($res[9]);
      $this->setPla_CantidadAprobador($res[10]);
      $this->setPla_FechaHoraCrea($res[11]);
      $this->setPla_UsuarioCrea($res[12]);
      $this->setPla_Estado($res[13]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_CentroCostos", "Pla_Nombre", "Pla_Grupo", "Pla_Distribucion", "Pla_Marca", "Pla_VerMarcaSubMarca", "Pla_FormatoSAP", "Pla_Tolerancia", "Pla_ZonaHoraria", "Pla_CantidadAprobador", "Pla_FechaHoraCrea", "Pla_UsuarioCrea", "Pla_Estado");
    $valores = array($this->getPla_CentroCostos(), $this->getPla_Nombre(), $this->getPla_Grupo(), $this->getPla_Distribucion(), $this->getPla_Marca(), $this->getPla_VerMarcaSubMarca(), $this->getPla_FormatoSAP(), $this->getPla_Tolerancia(), $this->getPla_ZonaHoraria(), $this->getPla_CantidadAprobador(), $this->getPla_FechaHoraCrea(), $this->getPla_UsuarioCrea(), $this->getPla_Estado());
    $llaveprimaria = "Pla_Codigo";
    $valorllaveprimaria = $this->getPla_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM plantas WHERE Pla_Codigo = :cod";
    $parametros = array(":cod"=>$this->Pla_Codigo);
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
  public function filtroPlantasUsuario( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT plantas.Pla_Codigo, Pla_Nombre, Pla_CentroCostos
    FROM plantas
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    AND plantas_usuarios.PlaU_Estado = 1
    WHERE Pla_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu
    ORDER BY Pla_Nombre ASC";

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
  public function filtroPlantasUsuarioReferencia( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT plantas.Pla_Codigo, Pla_Nombre, Pla_CentroCostos, Pla_FormatoSAP 
    FROM plantas
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    AND plantas_usuarios.PlaU_Estado = 1
    WHERE Pla_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu
    ORDER BY Pla_Nombre ASC LIMIT 1";

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
  public function filtroPlantasUsuariosTODASAdmin( ) {

    $sql = "SELECT plantas.Pla_Codigo, Pla_Nombre, Pla_CentroCostos
    FROM plantas
    WHERE Pla_Estado = 1
    ORDER BY Pla_Nombre ASC";

    $this->consultaSQL( $sql );
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
  public function listarInfoPlantas(){
	  
    $sql = "SELECT plantas.Pla_Codigo, Pla_CentroCostos, Pla_Nombre, grupo.Par_Nombre, grupo.Par_Codigo, distribucion.Par_Nombre, distribucion.Par_Codigo, marca.Par_Nombre, marca.Par_Codigo, Pla_Estado, Pla_FormatoSAP, Pla_Tolerancia, Pla_CantidadAprobador
    FROM plantas
    LEFT JOIN parametros grupo ON plantas.Pla_Grupo = grupo.Par_Codigo AND grupo.Par_Estado = 1 AND grupo.Par_Tipo = 3 AND plantas.Pla_Codigo = grupo.Pla_Codigo
    LEFT JOIN parametros distribucion ON plantas.Pla_Distribucion = distribucion.Par_Codigo AND distribucion.Par_Estado = 1 AND distribucion.Par_Tipo = 4 AND plantas.Pla_Codigo = distribucion.Pla_Codigo
    LEFT JOIN parametros marca ON plantas.Pla_Marca = marca.Par_Codigo AND marca.Par_Estado = 1 AND marca.Par_Tipo = 5 AND plantas.Pla_Codigo = marca.Pla_Codigo
    WHERE Pla_Estado = 1 
    ORDER BY Pla_Nombre ASC";

    $this->consultaSQL($sql);
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
  public function listarGrupoSelect($planta){
	  
	$parametros = array( ":pla" => $planta );
		 
    $sql = "SELECT grupo.Par_Nombre, grupo.Par_Codigo
    FROM plantas
    LEFT JOIN parametros grupo ON plantas.Pla_Codigo = grupo.Pla_Codigo AND grupo.Par_Estado = 1 AND grupo.Par_Tipo = 3 
    WHERE Pla_Estado = 1 AND plantas.Pla_Codigo = :pla
    ORDER BY Pla_Nombre ASC";

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
	public function listarDistribucionSelect($planta){
	  
	$parametros = array( ":pla" => $planta );
		 
    $sql = "SELECT distribucion.Par_Nombre, distribucion.Par_Codigo
    FROM plantas
    INNER JOIN parametros distribucion ON plantas.Pla_Codigo = distribucion.Pla_Codigo AND distribucion.Par_Estado = 1 AND distribucion.Par_Tipo = 4 
 	AND plantas.Pla_Codigo = distribucion.Pla_Codigo
    WHERE Pla_Estado = 1 AND plantas.Pla_Codigo = :pla
    ORDER BY Pla_Nombre ASC";

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
  public function listarMarcaSelect($planta){
	  
	$parametros = array( ":pla" => $planta );
		 
    $sql = "SELECT marca.Par_Nombre, marca.Par_Codigo
    FROM plantas
    INNER JOIN parametros marca ON plantas.Pla_Codigo = marca.Pla_Codigo AND marca.Par_Estado = 1 AND marca.Par_Tipo = 5 
 	AND plantas.Pla_Codigo = marca.Pla_Codigo
    WHERE Pla_Estado = 1 AND plantas.Pla_Codigo = :pla
    ORDER BY Pla_Nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
