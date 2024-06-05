<?php
require_once('basedatos.php');

  class sap_programa_produccion extends basedatos {
    private $SapPP_Codigo;
    private $Pla_Codigo;
    private $Ref_Codigo;
    private $SapPP_CentroCostos;
    private $SapPP_Semana;
    private $SapPP_FechaPlan;
    private $SapPP_Orden;
    private $SapPP_Status;
    private $SapPP_CantOrdenada;
    private $SapPP_CantProd1ra;
    private $SapPP_CantProd2da;
    private $SapPP_CantidadRechazada;
    private $SapPP_CantEntAlm1ra;
    private $SapPP_CantEntAlm2da;
    private $SapPP_FechaHoraCrea;
    private $SapPP_UsuarioCrea;
    private $SapPP_Estado;

  function __construct($SapPP_Codigo = NULL, $Pla_Codigo = NULL, $Ref_Codigo = NULL, $SapPP_CentroCostos = NULL, $SapPP_Semana = NULL, $SapPP_FechaPlan = NULL, $SapPP_Orden = NULL, $SapPP_Status = NULL, $SapPP_CantOrdenada = NULL, $SapPP_CantProd1ra = NULL, $SapPP_CantProd2da = NULL, $SapPP_CantidadRechazada = NULL, $SapPP_CantEntAlm1ra = NULL, $SapPP_CantEntAlm2da = NULL, $SapPP_FechaHoraCrea = NULL, $SapPP_UsuarioCrea = NULL, $SapPP_Estado = NULL) {
    $this->SapPP_Codigo = $SapPP_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Ref_Codigo = $Ref_Codigo;
    $this->SapPP_CentroCostos = $SapPP_CentroCostos;
    $this->SapPP_Semana = $SapPP_Semana;
    $this->SapPP_FechaPlan = $SapPP_FechaPlan;
    $this->SapPP_Orden = $SapPP_Orden;
    $this->SapPP_Status = $SapPP_Status;
    $this->SapPP_CantOrdenada = $SapPP_CantOrdenada;
    $this->SapPP_CantProd1ra = $SapPP_CantProd1ra;
    $this->SapPP_CantProd2da = $SapPP_CantProd2da;
    $this->SapPP_CantidadRechazada = $SapPP_CantidadRechazada;
    $this->SapPP_CantEntAlm1ra = $SapPP_CantEntAlm1ra;
    $this->SapPP_CantEntAlm2da = $SapPP_CantEntAlm2da;
    $this->SapPP_FechaHoraCrea = $SapPP_FechaHoraCrea;
    $this->SapPP_UsuarioCrea = $SapPP_UsuarioCrea;
    $this->SapPP_Estado = $SapPP_Estado;
    $this->tabla = "sap_programa_produccion";
  }

  function getSapPP_Codigo() {
    return $this->SapPP_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getRef_Codigo() {
    return $this->Ref_Codigo;
  }

  function getSapPP_CentroCostos() {
    return $this->SapPP_CentroCostos;
  }

  function getSapPP_Semana() {
    return $this->SapPP_Semana;
  }

  function getSapPP_FechaPlan() {
    return $this->SapPP_FechaPlan;
  }

  function getSapPP_Orden() {
    return $this->SapPP_Orden;
  }

  function getSapPP_Status() {
    return $this->SapPP_Status;
  }

  function getSapPP_CantOrdenada() {
    return $this->SapPP_CantOrdenada;
  }

  function getSapPP_CantProd1ra() {
    return $this->SapPP_CantProd1ra;
  }

  function getSapPP_CantProd2da() {
    return $this->SapPP_CantProd2da;
  }

  function getSapPP_CantidadRechazada() {
    return $this->SapPP_CantidadRechazada;
  }

  function getSapPP_CantEntAlm1ra() {
    return $this->SapPP_CantEntAlm1ra;
  }

  function getSapPP_CantEntAlm2da() {
    return $this->SapPP_CantEntAlm2da;
  }

  function getSapPP_FechaHoraCrea() {
    return $this->SapPP_FechaHoraCrea;
  }

  function getSapPP_UsuarioCrea() {
    return $this->SapPP_UsuarioCrea;
  }

  function getSapPP_Estado() {
    return $this->SapPP_Estado;
  }

  function setSapPP_Codigo($SapPP_Codigo) {
    $this->SapPP_Codigo = $SapPP_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setRef_Codigo($Ref_Codigo) {
    $this->Ref_Codigo = $Ref_Codigo;
  }

  function setSapPP_CentroCostos($SapPP_CentroCostos) {
    $this->SapPP_CentroCostos = $SapPP_CentroCostos;
  }

  function setSapPP_Semana($SapPP_Semana) {
    $this->SapPP_Semana = $SapPP_Semana;
  }

  function setSapPP_FechaPlan($SapPP_FechaPlan) {
    $this->SapPP_FechaPlan = $SapPP_FechaPlan;
  }

  function setSapPP_Orden($SapPP_Orden) {
    $this->SapPP_Orden = $SapPP_Orden;
  }

  function setSapPP_Status($SapPP_Status) {
    $this->SapPP_Status = $SapPP_Status;
  }

  function setSapPP_CantOrdenada($SapPP_CantOrdenada) {
    $this->SapPP_CantOrdenada = $SapPP_CantOrdenada;
  }

  function setSapPP_CantProd1ra($SapPP_CantProd1ra) {
    $this->SapPP_CantProd1ra = $SapPP_CantProd1ra;
  }

  function setSapPP_CantProd2da($SapPP_CantProd2da) {
    $this->SapPP_CantProd2da = $SapPP_CantProd2da;
  }

  function setSapPP_CantidadRechazada($SapPP_CantidadRechazada) {
    $this->SapPP_CantidadRechazada = $SapPP_CantidadRechazada;
  }

  function setSapPP_CantEntAlm1ra($SapPP_CantEntAlm1ra) {
    $this->SapPP_CantEntAlm1ra = $SapPP_CantEntAlm1ra;
  }

  function setSapPP_CantEntAlm2da($SapPP_CantEntAlm2da) {
    $this->SapPP_CantEntAlm2da = $SapPP_CantEntAlm2da;
  }

  function setSapPP_FechaHoraCrea($SapPP_FechaHoraCrea) {
    $this->SapPP_FechaHoraCrea = $SapPP_FechaHoraCrea;
  }

  function setSapPP_UsuarioCrea($SapPP_UsuarioCrea) {
    $this->SapPP_UsuarioCrea = $SapPP_UsuarioCrea;
  }

  function setSapPP_Estado($SapPP_Estado) {
    $this->SapPP_Estado = $SapPP_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "Ref_Codigo", "SapPP_CentroCostos", "SapPP_Semana", "SapPP_FechaPlan", "SapPP_Orden", "SapPP_Status", "SapPP_CantOrdenada", "SapPP_CantProd1ra", "SapPP_CantProd2da", "SapPP_CantidadRechazada", "SapPP_CantEntAlm1ra", "SapPP_CantEntAlm2da", "SapPP_FechaHoraCrea", "SapPP_UsuarioCrea", "SapPP_Estado");
    $valores = array(
    array(
      $this->Pla_Codigo, 
      $this->Ref_Codigo, 
      $this->SapPP_CentroCostos, 
      $this->SapPP_Semana, 
      $this->SapPP_FechaPlan, 
      $this->SapPP_Orden, 
      $this->SapPP_Status, 
      $this->SapPP_CantOrdenada, 
      $this->SapPP_CantProd1ra, 
      $this->SapPP_CantProd2da, 
      $this->SapPP_CantidadRechazada, 
      $this->SapPP_CantEntAlm1ra, 
      $this->SapPP_CantEntAlm2da, 
      $this->SapPP_FechaHoraCrea, 
      $this->SapPP_UsuarioCrea, 
      $this->SapPP_Estado
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
    $sql =  "SELECT * FROM sap_programa_produccion WHERE SapPP_Codigo = :cod";
    $parametros = array(":cod"=>$this->SapPP_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setRef_Codigo($res[2]);
      $this->setSapPP_CentroCostos($res[3]);
      $this->setSapPP_Semana($res[4]);
      $this->setSapPP_FechaPlan($res[5]);
      $this->setSapPP_Orden($res[6]);
      $this->setSapPP_Status($res[7]);
      $this->setSapPP_CantOrdenada($res[8]);
      $this->setSapPP_CantProd1ra($res[9]);
      $this->setSapPP_CantProd2da($res[10]);
      $this->setSapPP_CantidadRechazada($res[11]);
      $this->setSapPP_CantEntAlm1ra($res[12]);
      $this->setSapPP_CantEntAlm2da($res[13]);
      $this->setSapPP_FechaHoraCrea($res[14]);
      $this->setSapPP_UsuarioCrea($res[15]);
      $this->setSapPP_Estado($res[16]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "Ref_Codigo", "SapPP_CentroCostos", "SapPP_Semana", "SapPP_FechaPlan", "SapPP_Orden", "SapPP_Status", "SapPP_CantOrdenada", "SapPP_CantProd1ra", "SapPP_CantProd2da", "SapPP_CantidadRechazada", "SapPP_CantEntAlm1ra", "SapPP_CantEntAlm2da", "SapPP_FechaHoraCrea", "SapPP_UsuarioCrea", "SapPP_Estado");
    $valores = array($this->getPla_Codigo(), $this->getRef_Codigo(), $this->getSapPP_CentroCostos(), $this->getSapPP_Semana(), $this->getSapPP_FechaPlan(), $this->getSapPP_Orden(), $this->getSapPP_Status(), $this->getSapPP_CantOrdenada(), $this->getSapPP_CantProd1ra(), $this->getSapPP_CantProd2da(), $this->getSapPP_CantidadRechazada(), $this->getSapPP_CantEntAlm1ra(), $this->getSapPP_CantEntAlm2da(), $this->getSapPP_FechaHoraCrea(), $this->getSapPP_UsuarioCrea(), $this->getSapPP_Estado());
    $llaveprimaria = "SapPP_Codigo";
    $valorllaveprimaria = $this->getSapPP_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM sap_programa_produccion WHERE SapPP_Codigo = :cod";
    $parametros = array(":cod"=>$this->SapPP_Codigo);
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
  public function ordenesProgramaProduccionExistente($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT SapPP_Codigo, SapPP_Orden
    FROM sap_programa_produccion
    INNER JOIN plantas ON sap_programa_produccion.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE SapPP_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu
    ORDER BY SapPP_Orden ASC";

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
  public function listarProgramaProduccionPrinpal($planta, $estado, $usuario, $fechaInicial, $fechaFinal){

    $parametros = array(":est"=>$estado, ":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal, ":usu"=>$usuario);

    $sql = "SELECT SapPP_Codigo, Pla_Nombre, Ref_Descripcion, SapPP_CentroCostos, SapPP_Semana, SapPP_FechaPlan, SapPP_Orden, SapPP_Status, SapPP_CantOrdenada, SapPP_CantProd1ra, SapPP_CantProd2da,
    SapPP_CantidadRechazada, SapPP_CantEntAlm1ra, SapPP_CantEntAlm2da
    FROM sap_programa_produccion
    INNER JOIN plantas ON sap_programa_produccion.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN referencias ON sap_programa_produccion.Ref_Codigo = referencias.Ref_Codigo AND referencias.Ref_Estado = 1
    WHERE SapPP_Estado = :est AND SapPP_FechaPlan BETWEEN :fecini AND :fecfin AND plantas_usuarios.Usu_Codigo = :usu ";
    
    if($planta != ""){ 
      $pri = 1; 
      foreach($planta as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " plantas.Pla_Codigo = :pla".$pri." "; 
        $parametros[':pla'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
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
  public function listarAnalisisProgramaProduccion($semana, $planta, $usuario, $formato){

    $parametros = array(":sem"=>$semana, ":usu"=>$usuario);

    $sql = "SELECT a.SapPP_Semana, a.SapPP_FechaPlan, r.Ref_Formato, r.Ref_Familia, r.Ref_Color, (SELECT SUM(c.SapPP_CantOrdenada) FROM sap_programa_produccion c
    INNER JOIN referencias e ON c.Ref_Codigo = e.Ref_Codigo
    INNER JOIN plantas f ON c.Pla_Codigo = f.Pla_Codigo AND f.Pla_Estado = 1
    INNER JOIN plantas_usuarios pu ON f.Pla_Codigo = pu.Pla_Codigo AND pu.PlaU_Estado = 1
    WHERE e.Ref_Formato = r.Ref_Formato AND e.Ref_Familia = r.Ref_Familia AND e.Ref_Color = r.Ref_Color
    AND c.SapPP_Semana = a.SapPP_Semana and c.SapPP_FechaPlan = a.SapPP_FechaPlan AND pu.Usu_Codigo = :usu AND e.Ref_Calidad = 'PRIMERA' AND c.SapPP_Estado = 1 AND e.Ref_Estado = 1 AND e.Ref_EstadoSap IN ('L0','N0','D3')) AS CantOrd,
    (SELECT SUM(b.SapPP_CantOrdenada) FROM sap_programa_produccion b
    INNER JOIN referencias e ON b.Ref_Codigo = e.Ref_Codigo
    INNER JOIN submarcas ON e.Ref_SubMarca = submarcas.Sub_Nombre AND submarcas.Sub_Estado = 1
    INNER JOIN tipo_mercado ON submarcas.Sub_Codigo = tipo_mercado.Sub_Codigo AND tipo_mercado.TipM_Estado = 1
    INNER JOIN plantas f ON b.Pla_Codigo = f.Pla_Codigo AND f.Pla_Estado = 1
    INNER JOIN plantas_usuarios pu ON f.Pla_Codigo = pu.Pla_Codigo AND pu.PlaU_Estado = 1
    WHERE e.Ref_Formato = r.Ref_Formato AND e.Ref_Familia = r.Ref_Familia AND e.Ref_Color = r.Ref_Color
    AND b.SapPP_Semana = a.SapPP_Semana and b.SapPP_FechaPlan = a.SapPP_FechaPlan AND pu.Usu_Codigo = :usu AND TipM_Tipo = 1 AND e.Ref_Calidad = 'PRIMERA' AND b.SapPP_Estado = 1 AND e.Ref_Estado = 1 AND e.Ref_EstadoSap IN ('L0','N0','D3')) AS EuroPalet,
    (SELECT SUM(b.SapPP_CantOrdenada) FROM sap_programa_produccion b
    INNER JOIN referencias rn ON b.Ref_Codigo = rn.Ref_Codigo
    INNER JOIN submarcas ON rn.Ref_SubMarca = submarcas.Sub_Nombre AND submarcas.Sub_Estado = 1
    INNER JOIN tipo_mercado ON submarcas.Sub_Codigo = tipo_mercado.Sub_Codigo AND tipo_mercado.TipM_Estado = 1
    INNER JOIN plantas f ON b.Pla_Codigo = f.Pla_Codigo AND f.Pla_Estado = 1
    INNER JOIN plantas_usuarios pu ON f.Pla_Codigo = pu.Pla_Codigo AND pu.PlaU_Estado = 1
    WHERE rn.Ref_Formato = r.Ref_Formato AND rn.Ref_Familia = r.Ref_Familia AND rn.Ref_Color = r.Ref_Color
    AND b.SapPP_Semana= a.SapPP_Semana and b.SapPP_FechaPlan = a.SapPP_FechaPlan AND pu.Usu_Codigo = :usu AND TipM_Tipo = 2 AND rn.Ref_Calidad = 'PRIMERA' AND b.SapPP_Estado = 1 AND rn.Ref_Estado = 1 AND rn.Ref_EstadoSap IN ('L0','N0','D3')) AS ExporTa, p.Pla_Codigo, ff.For_Codigo,
    a.SapPP_CentroCostos, a.SapPP_Orden, r.Ref_Descripcion, r.Ref_Material
    FROM sap_programa_produccion a
    INNER JOIN referencias r ON a.Ref_Codigo = r.Ref_Codigo AND r.Ref_Estado = 1
    INNER JOIN plantas p ON a.Pla_Codigo = p.Pla_Codigo AND p.Pla_Estado = 1
    INNER JOIN plantas_usuarios puu ON p.Pla_Codigo = puu.Pla_Codigo AND puu.PlaU_Estado = 1
    INNER JOIN formatos ff ON r.Ref_Formato = ff.For_Nombre AND ff.Pla_Codigo = p.Pla_Codigo AND ff.For_Estado = 1
    WHERE a.SapPP_Estado = 1 AND a.SapPP_Semana = :sem AND puu.Usu_Codigo = :usu AND r.Ref_Calidad = 'PRIMERA' AND r.Ref_Estado = 1 AND r.Ref_EstadoSap IN ('L0','N0','D3')";
    
    if($planta != ""){ 
      $pri = 1; 
      foreach($planta as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " p.Pla_Codigo = :pla".$pri." "; 
        $parametros[':pla'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    if($formato != ""){ 
      $pri2 = 1; 
      foreach($formato as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " ff.For_Codigo = :for".$pri2." "; 
        $parametros[':for'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " GROUP BY a.SapPP_Semana, r.Ref_Formato, r.Ref_Familia, r.Ref_Color, a.SapPP_FechaPlan
    ORDER BY a.SapPP_Semana ASC, a.SapPP_FechaPlan ASC";

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
  public function updateSAPProgramaProduccionProgramado($referencia, $fechaPlan, $familia, $color, $planta, $usuario){

    $parametros = array(":ref"=>$referencia, ":fecpla"=>$fechaPlan, ":fam"=>$familia, ":col"=>$color, ":pla"=>$planta, ":usu"=>$usuario);

    $sql = "UPDATE sap_programa_produccion a
    INNER JOIN referencias r ON a.Ref_Codigo = r.Ref_Codigo
    INNER JOIN plantas p ON a.Pla_Codigo = p.Pla_Codigo AND p.Pla_Estado = 1
    INNER JOIN plantas_usuarios puu ON p.Pla_Codigo = puu.Pla_Codigo AND puu.PlaU_Estado = 1
    INNER JOIN formatos ff ON r.Ref_Formato = ff.For_Nombre AND ff.Pla_Codigo = p.Pla_Codigo
    SET a.SapPP_Estado = 2
    WHERE a.SapPP_FechaPlan = :fecpla AND puu.Usu_Codigo = :usu AND r.Ref_Familia = :fam AND r.Ref_Color = :col AND p.Pla_Codigo = :pla AND ff.For_Codigo = :ref";

    $this->consultaSQL($sql, $parametros);
    $this->desconectar();
  }
    
  /*
  Autor: Natalia Rodríguez
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function updateActivarReferenciasSap($formato, $familia, $color, $semana){

    $parametros = array(":for"=>$formato, ":fam"=>$familia, ":col"=>$color, ":sem"=>$semana);

    $sql = "UPDATE sap_programa_produccion sap 
    INNER JOIN referencias ref ON sap.Ref_Codigo = ref.Ref_Codigo AND ref.Ref_Estado = 1
    SET SapPP_Estado = 1
    WHERE ref.Ref_Familia = :fam AND ref.Ref_Color = :col AND ref.Ref_Formato = :for AND SapPP_Semana = :sem AND SapPP_Estado = 2";

    $this->consultaSQL($sql, $parametros);
    $this->desconectar();
  }
    
  /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function DeleteSAPCargueNuevoArchivo($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "DELETE FROM sap_programa_produccion WHERE SapPP_Estado = 1 AND Pla_Codigo = :pla";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
    
}
?>