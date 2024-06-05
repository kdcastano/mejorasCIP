<?php
require_once('basedatos.php');

  class referencias extends basedatos {
    private $Ref_Codigo;
    private $Pla_Codigo;
    private $Ref_CentroCostos;
    private $Ref_Material;
    private $Ref_Descripcion;
    private $Ref_Acabado;
    private $Ref_Calidad;
    private $Ref_Familia;
    private $Ref_Formato;
    private $Ref_Marca;
    private $Ref_Pais;
    private $Ref_UsaPunzon;
    private $Ref_PunzonDetalle;
    private $Ref_EstadoSap;
    private $Ref_Color;
    private $Ref_SubMarca;
    private $Ref_FechaHoraCrea;
    private $Ref_UsuarioCrea;
    private $Ref_Estado;

  function __construct($Ref_Codigo = NULL, $Pla_Codigo = NULL, $Ref_CentroCostos = NULL, $Ref_Material = NULL, $Ref_Descripcion = NULL, $Ref_Acabado = NULL, $Ref_Calidad = NULL, $Ref_Familia = NULL, $Ref_Formato = NULL, $Ref_Marca = NULL, $Ref_Pais = NULL, $Ref_UsaPunzon = NULL, $Ref_PunzonDetalle = NULL, $Ref_EstadoSap = NULL, $Ref_Color = NULL, $Ref_SubMarca = NULL, $Ref_FechaHoraCrea = NULL, $Ref_UsuarioCrea = NULL, $Ref_Estado = NULL) {
    $this->Ref_Codigo = $Ref_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Ref_CentroCostos = $Ref_CentroCostos;
    $this->Ref_Material = $Ref_Material;
    $this->Ref_Descripcion = $Ref_Descripcion;
    $this->Ref_Acabado = $Ref_Acabado;
    $this->Ref_Calidad = $Ref_Calidad;
    $this->Ref_Familia = $Ref_Familia;
    $this->Ref_Formato = $Ref_Formato;
    $this->Ref_Marca = $Ref_Marca;
    $this->Ref_Pais = $Ref_Pais;
    $this->Ref_UsaPunzon = $Ref_UsaPunzon;
    $this->Ref_PunzonDetalle = $Ref_PunzonDetalle;
    $this->Ref_EstadoSap = $Ref_EstadoSap;
    $this->Ref_Color = $Ref_Color;
    $this->Ref_SubMarca = $Ref_SubMarca;
    $this->Ref_FechaHoraCrea = $Ref_FechaHoraCrea;
    $this->Ref_UsuarioCrea = $Ref_UsuarioCrea;
    $this->Ref_Estado = $Ref_Estado;
    $this->tabla = "referencias";
  }

  function getRef_Codigo() {
    return $this->Ref_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getRef_CentroCostos() {
    return $this->Ref_CentroCostos;
  }

  function getRef_Material() {
    return $this->Ref_Material;
  }

  function getRef_Descripcion() {
    return $this->Ref_Descripcion;
  }

  function getRef_Acabado() {
    return $this->Ref_Acabado;
  }

  function getRef_Calidad() {
    return $this->Ref_Calidad;
  }

  function getRef_Familia() {
    return $this->Ref_Familia;
  }

  function getRef_Formato() {
    return $this->Ref_Formato;
  }

  function getRef_Marca() {
    return $this->Ref_Marca;
  }

  function getRef_Pais() {
    return $this->Ref_Pais;
  }

  function getRef_UsaPunzon() {
    return $this->Ref_UsaPunzon;
  }

  function getRef_PunzonDetalle() {
    return $this->Ref_PunzonDetalle;
  }

  function getRef_EstadoSap() {
    return $this->Ref_EstadoSap;
  }

  function getRef_Color() {
    return $this->Ref_Color;
  }

  function getRef_SubMarca() {
    return $this->Ref_SubMarca;
  }

  function getRef_FechaHoraCrea() {
    return $this->Ref_FechaHoraCrea;
  }

  function getRef_UsuarioCrea() {
    return $this->Ref_UsuarioCrea;
  }

  function getRef_Estado() {
    return $this->Ref_Estado;
  }

  function setRef_Codigo($Ref_Codigo) {
    $this->Ref_Codigo = $Ref_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setRef_CentroCostos($Ref_CentroCostos) {
    $this->Ref_CentroCostos = $Ref_CentroCostos;
  }

  function setRef_Material($Ref_Material) {
    $this->Ref_Material = $Ref_Material;
  }

  function setRef_Descripcion($Ref_Descripcion) {
    $this->Ref_Descripcion = $Ref_Descripcion;
  }

  function setRef_Acabado($Ref_Acabado) {
    $this->Ref_Acabado = $Ref_Acabado;
  }

  function setRef_Calidad($Ref_Calidad) {
    $this->Ref_Calidad = $Ref_Calidad;
  }

  function setRef_Familia($Ref_Familia) {
    $this->Ref_Familia = $Ref_Familia;
  }

  function setRef_Formato($Ref_Formato) {
    $this->Ref_Formato = $Ref_Formato;
  }

  function setRef_Marca($Ref_Marca) {
    $this->Ref_Marca = $Ref_Marca;
  }

  function setRef_Pais($Ref_Pais) {
    $this->Ref_Pais = $Ref_Pais;
  }

  function setRef_UsaPunzon($Ref_UsaPunzon) {
    $this->Ref_UsaPunzon = $Ref_UsaPunzon;
  }

  function setRef_PunzonDetalle($Ref_PunzonDetalle) {
    $this->Ref_PunzonDetalle = $Ref_PunzonDetalle;
  }

  function setRef_EstadoSap($Ref_EstadoSap) {
    $this->Ref_EstadoSap = $Ref_EstadoSap;
  }

  function setRef_Color($Ref_Color) {
    $this->Ref_Color = $Ref_Color;
  }

  function setRef_SubMarca($Ref_SubMarca) {
    $this->Ref_SubMarca = $Ref_SubMarca;
  }

  function setRef_FechaHoraCrea($Ref_FechaHoraCrea) {
    $this->Ref_FechaHoraCrea = $Ref_FechaHoraCrea;
  }

  function setRef_UsuarioCrea($Ref_UsuarioCrea) {
    $this->Ref_UsuarioCrea = $Ref_UsuarioCrea;
  }

  function setRef_Estado($Ref_Estado) {
    $this->Ref_Estado = $Ref_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "Ref_CentroCostos", "Ref_Material", "Ref_Descripcion", "Ref_Acabado", "Ref_Calidad", "Ref_Familia", "Ref_Formato", "Ref_Marca", "Ref_Pais", "Ref_UsaPunzon", "Ref_PunzonDetalle", "Ref_EstadoSap", "Ref_Color", "Ref_SubMarca", "Ref_FechaHoraCrea", "Ref_UsuarioCrea", "Ref_Estado");
    $valores = array(
    array( 
      $this->Pla_Codigo, 
      $this->Ref_CentroCostos, 
      $this->Ref_Material, 
      $this->Ref_Descripcion, 
      $this->Ref_Acabado, 
      $this->Ref_Calidad, 
      $this->Ref_Familia, 
      $this->Ref_Formato, 
      $this->Ref_Marca, 
      $this->Ref_Pais, 
      $this->Ref_UsaPunzon, 
      $this->Ref_PunzonDetalle, 
      $this->Ref_EstadoSap, 
      $this->Ref_Color, 
      $this->Ref_SubMarca, 
      $this->Ref_FechaHoraCrea, 
      $this->Ref_UsuarioCrea, 
      $this->Ref_Estado
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
    $sql =  "SELECT * FROM referencias WHERE Ref_Codigo = :cod";
    $parametros = array(":cod"=>$this->Ref_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setRef_CentroCostos($res[2]);
      $this->setRef_Material($res[3]);
      $this->setRef_Descripcion($res[4]);
      $this->setRef_Acabado($res[5]);
      $this->setRef_Calidad($res[6]);
      $this->setRef_Familia($res[7]);
      $this->setRef_Formato($res[8]);
      $this->setRef_Marca($res[9]);
      $this->setRef_Pais($res[10]);
      $this->setRef_UsaPunzon($res[11]);
      $this->setRef_PunzonDetalle($res[12]);
      $this->setRef_EstadoSap($res[13]);
      $this->setRef_Color($res[14]);
      $this->setRef_SubMarca($res[15]);
      $this->setRef_FechaHoraCrea($res[16]);
      $this->setRef_UsuarioCrea($res[17]);
      $this->setRef_Estado($res[18]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "Ref_CentroCostos", "Ref_Material", "Ref_Descripcion", "Ref_Acabado", "Ref_Calidad", "Ref_Familia", "Ref_Formato", "Ref_Marca", "Ref_Pais", "Ref_UsaPunzon", "Ref_PunzonDetalle", "Ref_EstadoSap", "Ref_Color", "Ref_SubMarca", "Ref_FechaHoraCrea", "Ref_UsuarioCrea", "Ref_Estado");
    $valores = array($this->getPla_Codigo(), $this->getRef_CentroCostos(), $this->getRef_Material(), $this->getRef_Descripcion(), $this->getRef_Acabado(), $this->getRef_Calidad(), $this->getRef_Familia(), $this->getRef_Formato(), $this->getRef_Marca(), $this->getRef_Pais(), $this->getRef_UsaPunzon(), $this->getRef_PunzonDetalle(), $this->getRef_EstadoSap(), $this->getRef_Color(), $this->getRef_SubMarca(), $this->getRef_FechaHoraCrea(), $this->getRef_UsuarioCrea(), $this->getRef_Estado());
    $llaveprimaria = "Ref_Codigo";
    $valorllaveprimaria = $this->getRef_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM referencias WHERE Ref_Codigo = :cod";
    $parametros = array(":cod"=>$this->Ref_Codigo);
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
  public function listarReferenciasPrinpal($planta, $estado, $usuario){

    $parametros = array(":est"=>$estado);

    $sql = "SELECT Ref_Codigo, Pla_Nombre, Ref_CentroCostos, Ref_Material, Ref_Descripcion, Ref_Acabado, Ref_Calidad, Ref_Familia, Ref_Formato, Ref_Marca, Ref_Pais,
	Ref_UsaPunzon, Ref_PunzonDetalle, Ref_EstadoSap
	FROM referencias
	INNER JOIN plantas ON referencias.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	WHERE Ref_Estado = :est ";
    
    if($planta != ""){ 
      $pri2 = 1; 
      foreach($planta as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " referencias.Pla_Codigo = :pla".$pri2." "; 
        $parametros[':pla'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }else{
      $sql .= " AND referencias.Pla_Codigo = :usu";
      $parametros[':usu'] = $usuario;
    }

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
  public function referenciasExistentesPlantasUsuario($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT Ref_CentroCostos, Ref_Material, Ref_Codigo
	FROM referencias
	INNER JOIN plantas ON referencias.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE Ref_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu";

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
  public function listarReferenciasProgramaProduccion($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT Ref_Codigo, Ref_CentroCostos, Ref_Material
	FROM referencias
	INNER JOIN plantas ON referencias.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	WHERE Ref_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu
	ORDER BY Ref_COdigo DESC";

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
  public function listarFamiliaFormato($planta, $formato){

    $parametros = array(":pla"=>$planta, ":for"=>$formato);

    $sql = "SELECT DISTINCT Ref_Familia 
    FROM referencias 
    WHERE Ref_Estado = 1 AND Pla_Codigo = :pla AND Ref_Formato = :for AND ref_Calidad = 'PRIMERA' AND Ref_Estado = 1 AND Ref_EstadoSap IN ('L0','N0','D3')
    ORDER BY Ref_Familia ASC";

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
  public function buscarColorFamilia( $familia, $planta ) {

    $parametros = array( ":fam" => $familia, ":pla" => $planta );

    $sql = "SELECT DISTINCT Ref_Color 
    FROM referencias
    WHERE Ref_Estado = 1 AND Ref_Familia = :fam AND Pla_Codigo = :pla AND ref_Calidad = 'PRIMERA' AND Ref_Estado = 1 AND Ref_EstadoSap IN ('L0','N0','D3')
    ORDER BY Ref_Color  ASC";

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
  public function buscarPunzonInferior($planta, $familia, $formato, $color){

    $parametros = array(":pla"=>$planta, ":fam"=>$familia, ":for"=>$formato, ":col"=>$color);

    $sql = "SELECT DISTINCT Ref_PunzonDetalle
    FROM referencias
    WHERE Pla_Codigo = :pla AND Ref_Familia = :fam AND Ref_Formato = :for AND Ref_Estado = 1 AND Ref_Color= :col ";

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
  public function obtenerDescripcionReferencia($familia, $formato, $color){

    $parametros = array(":fam"=>$familia, ":for"=>$formato, ":col"=>$color);

    $sql = "SELECT Ref_Descripcion, formatos.For_codigo, formatos.For_Nombre
    FROM referencias
    INNER JOIN formatos ON Ref_Formato = formatos.For_Nombre AND formatos.For_Estado = 1
    WHERE Ref_Calidad = 'PRIMERA' AND Ref_Familia = :fam AND formatos.For_codigo = :for AND Ref_Color = :col AND Ref_Estado = 1 AND Ref_EstadoSap IN ('L0','N0','D3')";

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
  public function buscarReferencia($familia, $formato, $color){

    $parametros = array(":fam"=>$familia, ":for"=>$formato, ":col"=>$color);

    $sql = "SELECT Ref_Codigo, Ref_Descripcion, formatos.For_codigo
    FROM referencias
    INNER JOIN formatos ON Ref_Formato = formatos.For_Nombre AND formatos.For_Estado = 1
    WHERE Ref_Calidad = 'PRIMERA' AND Ref_Familia = :fam AND formatos.For_codigo = :for AND Ref_Color = :col LIMIT 1";

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
  public function filtroReferenciasPanelSupervisor($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Ref_Codigo, Ref_Descripcion, formatos.For_codigo, Ref_Familia, Ref_Color, Ref_Material, formatos.For_Nombre
    FROM referencias
    INNER JOIN formatos ON Ref_Formato = formatos.For_Nombre AND formatos.For_Estado = 1 AND referencias.Pla_Codigo = formatos.Pla_Codigo
    WHERE formatos.Pla_Codigo = :pla AND Ref_Calidad = 'PRIMERA'
    ORDER BY Ref_Descripcion ASC";

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
  public function filtroReferenciasEstadistica($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Ref_Codigo, Ref_Descripcion, formatos.For_codigo, Ref_Familia, Ref_Color
    FROM referencias
    INNER JOIN formatos ON Ref_Formato = formatos.For_Nombre AND formatos.For_Estado = 1
    WHERE referencias.Pla_Codigo = :pla AND Ref_Calidad = 'PRIMERA'
    GROUP BY Ref_Codigo
    ORDER BY Ref_Descripcion ASC";

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
  public function filtroReferenciasHeathCheck($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Ref_Codigo, Ref_Descripcion, formatos.For_codigo, Ref_Familia, Ref_Color
    FROM referencias
    INNER JOIN formatos ON Ref_Formato = formatos.For_Nombre AND formatos.For_Estado = 1
    WHERE referencias.Pla_Codigo = :pla AND Ref_Calidad = 'PRIMERA' AND Ref_Estado = 1 AND Ref_EstadoSap IN ('L0','N0','D3')
    GROUP BY Ref_Codigo
    ORDER BY Ref_Descripcion ASC";

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
  public function HallarCodigoMaterialDescripcion($planta, $descripcion){

    $parametros = array(":pla"=>$planta, ":des"=>$descripcion);

    $sql = "SELECT Ref_Material
FROM referencias
WHERE Ref_Descripcion = :des AND Ref_Estado = 1 AND Pla_Codigo = :pla
ORDER BY Ref_Codigo DESC
LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }

}
?>