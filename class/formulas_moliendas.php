<?php
require_once('basedatos.php');

  class formulas_moliendas extends basedatos {
    private $ForM_Codigo;
    private $Pla_Codigo;
    private $ForM_Nombre;
    private $ForM_Tipo;
    private $ForM_Archivo;
    private $ForM_FechaHora;
    private $ForM_UsuarioCrea;
    private $ForM_Estado;

  function __construct($ForM_Codigo = NULL, $Pla_Codigo = NULL, $ForM_Nombre = NULL, $ForM_Tipo = NULL, $ForM_Archivo = NULL, $ForM_FechaHora = NULL, $ForM_UsuarioCrea = NULL, $ForM_Estado = NULL) {
    $this->ForM_Codigo = $ForM_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->ForM_Nombre = $ForM_Nombre;
    $this->ForM_Tipo = $ForM_Tipo;
    $this->ForM_Archivo = $ForM_Archivo;
    $this->ForM_FechaHora = $ForM_FechaHora;
    $this->ForM_UsuarioCrea = $ForM_UsuarioCrea;
    $this->ForM_Estado = $ForM_Estado;
    $this->tabla = "formulas_moliendas";
  }

  function getForM_Codigo() {
    return $this->ForM_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getForM_Nombre() {
    return $this->ForM_Nombre;
  }

  function getForM_Tipo() {
    return $this->ForM_Tipo;
  }

  function getForM_Archivo() {
    return $this->ForM_Archivo;
  }

  function getForM_FechaHora() {
    return $this->ForM_FechaHora;
  }

  function getForM_UsuarioCrea() {
    return $this->ForM_UsuarioCrea;
  }

  function getForM_Estado() {
    return $this->ForM_Estado;
  }

  function setForM_Codigo($ForM_Codigo) {
    $this->ForM_Codigo = $ForM_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setForM_Nombre($ForM_Nombre) {
    $this->ForM_Nombre = $ForM_Nombre;
  }

  function setForM_Tipo($ForM_Tipo) {
    $this->ForM_Tipo = $ForM_Tipo;
  }

  function setForM_Archivo($ForM_Archivo) {
    $this->ForM_Archivo = $ForM_Archivo;
  }

  function setForM_FechaHora($ForM_FechaHora) {
    $this->ForM_FechaHora = $ForM_FechaHora;
  }

  function setForM_UsuarioCrea($ForM_UsuarioCrea) {
    $this->ForM_UsuarioCrea = $ForM_UsuarioCrea;
  }

  function setForM_Estado($ForM_Estado) {
    $this->ForM_Estado = $ForM_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "ForM_Nombre", "ForM_Tipo", "ForM_Archivo", "ForM_FechaHora", "ForM_UsuarioCrea", "ForM_Estado");
    $valores = array(
    array(
      $this->Pla_Codigo, 
      $this->ForM_Nombre, 
      $this->ForM_Tipo, 
      $this->ForM_Archivo, 
      $this->ForM_FechaHora, 
      $this->ForM_UsuarioCrea, 
      $this->ForM_Estado
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
    $sql =  "SELECT * FROM formulas_moliendas WHERE ForM_Codigo = :cod";
    $parametros = array(":cod"=>$this->ForM_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setForM_Nombre($res[2]);
      $this->setForM_Tipo($res[3]);
      $this->setForM_Archivo($res[4]);
      $this->setForM_FechaHora($res[5]);
      $this->setForM_UsuarioCrea($res[6]);
      $this->setForM_Estado($res[7]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "ForM_Nombre", "ForM_Tipo", "ForM_Archivo", "ForM_FechaHora", "ForM_UsuarioCrea", "ForM_Estado");
    $valores = array($this->getPla_Codigo(), $this->getForM_Nombre(), $this->getForM_Tipo(), $this->getForM_Archivo(), $this->getForM_FechaHora(), $this->getForM_UsuarioCrea(), $this->getForM_Estado());
    $llaveprimaria = "ForM_Codigo";
    $valorllaveprimaria = $this->getForM_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM formulas_moliendas WHERE ForM_Codigo = :cod";
    $parametros = array(":cod"=>$this->ForM_Codigo);
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
  public function formulasMoliendasListar($estado, $planta, $usuario){

    $parametros = array(":est"=>$estado, ":usu"=>$usuario);

    $sql = "SELECT ForM_Codigo, plantas.Pla_Nombre, ForM_Nombre, ForM_Estado,
	IF(ForM_Tipo = 1, 'Molienda y Atomizado',
	 IF(ForM_Tipo = 2, 'Preparación de esmalte', 'No existe')) as Tipo
	FROM formulas_moliendas
	INNER JOIN plantas ON formulas_moliendas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1 
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1 
	WHERE ForM_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";

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
	$sql .=" ORDER BY ForM_Nombre ASC";
	  
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
  public function filtroFormulasMoliendaOperadorPanel($planta, $tipo){

    $parametros = array(":pla"=>$planta, ":tip"=>$tipo);

    $sql = "SELECT ForM_Codigo, ForM_Nombre
FROM formulas_moliendas
WHERE Pla_Codigo = :pla AND ForM_Tipo = :tip AND ForM_Estado = 1
ORDER BY ForM_Nombre ASC";

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
  public function buscarUltimoId($planta, $usuario){

    $parametros = array(":pla"=>$planta,":usu"=>$usuario);

    $sql = "SELECT MAX(ForM_Codigo)
    FROM formulas_moliendas
    WHERE ForM_Estado = 1 AND Pla_Codigo = :pla AND ForM_UsuarioCrea = :usu";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>
