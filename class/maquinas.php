<?php
require_once('basedatos.php');

  class maquinas extends basedatos {
    private $Maq_Codigo;
    private $Are_Codigo;
    private $AgrM_Codigo;
    private $Maq_Nombre;
    private $Maq_Orden;
    private $Maq_FechaHoraCrea;
    private $Maq_UsuarioCrea;
    private $Maq_Estado;

  function __construct($Maq_Codigo = NULL, $Are_Codigo = NULL, $AgrM_Codigo = NULL, $Maq_Nombre = NULL, $Maq_Orden = NULL, $Maq_FechaHoraCrea = NULL, $Maq_UsuarioCrea = NULL, $Maq_Estado = NULL) {
    $this->Maq_Codigo = $Maq_Codigo;
    $this->Are_Codigo = $Are_Codigo;
    $this->AgrM_Codigo = $AgrM_Codigo;
    $this->Maq_Nombre = $Maq_Nombre;
    $this->Maq_Orden = $Maq_Orden;
    $this->Maq_FechaHoraCrea = $Maq_FechaHoraCrea;
    $this->Maq_UsuarioCrea = $Maq_UsuarioCrea;
    $this->Maq_Estado = $Maq_Estado;
    $this->tabla = "maquinas";
  }

  function getMaq_Codigo() {
    return $this->Maq_Codigo;
  }

  function getAre_Codigo() {
    return $this->Are_Codigo;
  }

  function getAgrM_Codigo() {
    return $this->AgrM_Codigo;
  }

  function getMaq_Nombre() {
    return $this->Maq_Nombre;
  }

  function getMaq_Orden() {
    return $this->Maq_Orden;
  }

  function getMaq_FechaHoraCrea() {
    return $this->Maq_FechaHoraCrea;
  }

  function getMaq_UsuarioCrea() {
    return $this->Maq_UsuarioCrea;
  }

  function getMaq_Estado() {
    return $this->Maq_Estado;
  }

  function setMaq_Codigo($Maq_Codigo) {
    $this->Maq_Codigo = $Maq_Codigo;
  }

  function setAre_Codigo($Are_Codigo) {
    $this->Are_Codigo = $Are_Codigo;
  }

  function setAgrM_Codigo($AgrM_Codigo) {
    $this->AgrM_Codigo = $AgrM_Codigo;
  }

  function setMaq_Nombre($Maq_Nombre) {
    $this->Maq_Nombre = $Maq_Nombre;
  }

  function setMaq_Orden($Maq_Orden) {
    $this->Maq_Orden = $Maq_Orden;
  }

  function setMaq_FechaHoraCrea($Maq_FechaHoraCrea) {
    $this->Maq_FechaHoraCrea = $Maq_FechaHoraCrea;
  }

  function setMaq_UsuarioCrea($Maq_UsuarioCrea) {
    $this->Maq_UsuarioCrea = $Maq_UsuarioCrea;
  }

  function setMaq_Estado($Maq_Estado) {
    $this->Maq_Estado = $Maq_Estado;
  }

  public function insertar(){
    $campos = array("Are_Codigo", "AgrM_Codigo", "Maq_Nombre", "Maq_Orden", "Maq_FechaHoraCrea", "Maq_UsuarioCrea", "Maq_Estado");
    $valores = array(
    array( 
      $this->Are_Codigo, 
      $this->AgrM_Codigo, 
      $this->Maq_Nombre, 
      $this->Maq_Orden, 
      $this->Maq_FechaHoraCrea, 
      $this->Maq_UsuarioCrea, 
      $this->Maq_Estado
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
    $sql =  "SELECT * FROM maquinas WHERE Maq_Codigo = :cod";
    $parametros = array(":cod"=>$this->Maq_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setAre_Codigo($res[1]);
      $this->setAgrM_Codigo($res[2]);
      $this->setMaq_Nombre($res[3]);
      $this->setMaq_Orden($res[4]);
      $this->setMaq_FechaHoraCrea($res[5]);
      $this->setMaq_UsuarioCrea($res[6]);
      $this->setMaq_Estado($res[7]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Are_Codigo", "AgrM_Codigo", "Maq_Nombre", "Maq_Orden", "Maq_FechaHoraCrea", "Maq_UsuarioCrea", "Maq_Estado");
    $valores = array($this->getAre_Codigo(), $this->getAgrM_Codigo(), $this->getMaq_Nombre(), $this->getMaq_Orden(), $this->getMaq_FechaHoraCrea(), $this->getMaq_UsuarioCrea(), $this->getMaq_Estado());
    $llaveprimaria = "Maq_Codigo";
    $valorllaveprimaria = $this->getMaq_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM maquinas WHERE Maq_Codigo = :cod";
    $parametros = array(":cod"=>$this->Maq_Codigo);
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
  public function listarMaquinasFiltro( $planta, $area, $estado, $usuario, $agrupacion) {

    $parametros = array( ":est" => $estado, ":usu" => $usuario );

    $sql = "SELECT maquinas.Maq_Codigo, plantas.Pla_Nombre, areas.Are_Nombre, Maq_Nombre, Maq_Estado,     Maq_Orden, agrupaciones_maquinas.AgrM_Codigo,
      agrupaciones_maquinas.AgrM_Nombre
      FROM maquinas 
      INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1 
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1 
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1 
      LEFT JOIN agrupaciones_maquinas_configft ON maquinas.Maq_Codigo = agrupaciones_maquinas_configft.Maq_Codigo AND AgrMCon_Estado = 1
      LEFT JOIN agrupaciones_maquinas ON agrupaciones_maquinas_configft.AgrM_Codigo = agrupaciones_maquinas.AgrM_Codigo AND AgrM_Estado = 1
      WHERE Maq_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";

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

    if ( $area != "" ) {
      $pri3 = 1;
      foreach ( $area as $registro4 ) {
        if ( $pri3 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " areas.Are_Codigo = :are" . $pri3 . " ";
        $parametros[ ':are' . $pri3 ] = $registro4;
        $pri3++;
      }
      $sql .= " )";
    }
    
    if ( $agrupacion != "" ) {
      $pri4 = 1;
      foreach ( $agrupacion as $registro5 ) {
        if ( $pri4 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " maquinas.AgrM_Codigo = :agr" . $pri4 . " ";
        $parametros[ ':agr' . $pri4 ] = $registro5;
        $pri4++;
      }
      $sql .= " )";
    }


    $sql .= " GROUP BY maquinas.Maq_Codigo ORDER BY Maq_Nombre ASC";

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
  public function filtroMaquinasArea( $area, $usuario ) {

    $parametros = array( ":are" => $area, ":usu" => $usuario );

    $sql = "SELECT maquinas.Maq_Codigo, Maq_Nombre
	FROM maquinas
	INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
	INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE Maq_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND areas.Are_Codigo = :are
	ORDER BY Are_Nombre ASC";

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
  public function filtroMaquinasAreaMultiple( $area, $usuario ) {

    $parametros = array(":usu" => $usuario );

    $sql = "SELECT maquinas.Maq_Codigo, Maq_Nombre
	FROM maquinas
	INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
	INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE Maq_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu ";
    
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
    
    $sql .= " ORDER BY Are_Nombre ASC";

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
  public function listarMaquinasUsuario( $usuario ) {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT Maq_Codigo, Maq_Nombre
      FROM maquinas 
      INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
      INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
      INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      WHERE Maq_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu
      ORDER BY Maq_Nombre ASC";

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
  public function listarMaquinasPorPlanta($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Maq_Codigo, Maq_Nombre
    FROM maquinas 
    INNER JOIN areas ON maquinas.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    WHERE Maq_Estado = 1 AND areas.Pla_Codigo = :pla
    ORDER BY Maq_Nombre ASC";

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
  public function buscarUltimoRegistroCreadoMaquina($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT maquinas.Maq_Codigo
    FROM maquinas
    WHERE Maq_UsuarioCrea = :usu AND Maq_Estado = 1
    ORDER BY maquinas.Maq_Codigo DESC
    LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }   

}
?>
