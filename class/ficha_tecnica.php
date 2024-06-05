<?php
require_once('basedatos.php');

  class ficha_tecnica extends basedatos {
    private $FicT_Codigo;
    private $Pla_Codigo;
    private $For_Codigo;
    private $FicT_Familia;
    private $FicT_Color;
    private $FicT_FecEmision;
    private $FicT_CicloHorno;
    private $FicT_NombreArchivo;
    private $FicT_Foto;
    private $FicT_FotoDos;
    private $FicT_fechaHoraCrea;
    private $FicT_UsuarioCrea;
    private $FicT_Estado;
    private $FicT_PDF;

  function __construct($FicT_Codigo = NULL, $Pla_Codigo = NULL, $For_Codigo = NULL, $FicT_Familia = NULL, $FicT_Color = NULL, $FicT_FecEmision = NULL, $FicT_CicloHorno = NULL, $FicT_NombreArchivo = NULL, $FicT_Foto = NULL, $FicT_FotoDos = NULL, $FicT_fechaHoraCrea = NULL, $FicT_UsuarioCrea = NULL, $FicT_Estado = NULL, $FicT_PDF = NULL) {
    $this->FicT_Codigo = $FicT_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->For_Codigo = $For_Codigo;
    $this->FicT_Familia = $FicT_Familia;
    $this->FicT_Color = $FicT_Color;
    $this->FicT_FecEmision = $FicT_FecEmision;
    $this->FicT_CicloHorno = $FicT_CicloHorno;
    $this->FicT_NombreArchivo = $FicT_NombreArchivo;
    $this->FicT_Foto = $FicT_Foto;
    $this->FicT_FotoDos = $FicT_FotoDos;
    $this->FicT_fechaHoraCrea = $FicT_fechaHoraCrea;
    $this->FicT_UsuarioCrea = $FicT_UsuarioCrea;
    $this->FicT_Estado = $FicT_Estado;
    $this->FicT_PDF = $FicT_PDF;
    $this->tabla = "ficha_tecnica";
  }

  function getFicT_Codigo() {
    return $this->FicT_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getFor_Codigo() {
    return $this->For_Codigo;
  }

  function getFicT_Familia() {
    return $this->FicT_Familia;
  }

  function getFicT_Color() {
    return $this->FicT_Color;
  }

  function getFicT_FecEmision() {
    return $this->FicT_FecEmision;
  }

  function getFicT_CicloHorno() {
    return $this->FicT_CicloHorno;
  }

  function getFicT_NombreArchivo() {
    return $this->FicT_NombreArchivo;
  }

  function getFicT_Foto() {
    return $this->FicT_Foto;
  }

  function getFicT_FotoDos() {
    return $this->FicT_FotoDos;
  }

  function getFicT_fechaHoraCrea() {
    return $this->FicT_fechaHoraCrea;
  }

  function getFicT_UsuarioCrea() {
    return $this->FicT_UsuarioCrea;
  }

  function getFicT_Estado() {
    return $this->FicT_Estado;
  }
   
  function getFicT_PDF() {
    return $this->FicT_PDF;
  }

  function setFicT_Codigo($FicT_Codigo) {
    $this->FicT_Codigo = $FicT_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setFor_Codigo($For_Codigo) {
    $this->For_Codigo = $For_Codigo;
  }

  function setFicT_Familia($FicT_Familia) {
    $this->FicT_Familia = $FicT_Familia;
  }

  function setFicT_Color($FicT_Color) {
    $this->FicT_Color = $FicT_Color;
  }

  function setFicT_FecEmision($FicT_FecEmision) {
    $this->FicT_FecEmision = $FicT_FecEmision;
  }

  function setFicT_CicloHorno($FicT_CicloHorno) {
    $this->FicT_CicloHorno = $FicT_CicloHorno;
  }

  function setFicT_NombreArchivo($FicT_NombreArchivo) {
    $this->FicT_NombreArchivo = $FicT_NombreArchivo;
  }

  function setFicT_Foto($FicT_Foto) {
    $this->FicT_Foto = $FicT_Foto;
  }

  function setFicT_FotoDos($FicT_FotoDos) {
    $this->FicT_FotoDos = $FicT_FotoDos;
  }

  function setFicT_fechaHoraCrea($FicT_fechaHoraCrea) {
    $this->FicT_fechaHoraCrea = $FicT_fechaHoraCrea;
  }

  function setFicT_UsuarioCrea($FicT_UsuarioCrea) {
    $this->FicT_UsuarioCrea = $FicT_UsuarioCrea;
  }

  function setFicT_Estado($FicT_Estado) {
    $this->FicT_Estado = $FicT_Estado;
  }
   
  function setFicT_PDF($FicT_PDF) {
    $this->FicT_PDF = $FicT_PDF;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "For_Codigo", "FicT_Familia", "FicT_Color", "FicT_FecEmision", "FicT_CicloHorno", "FicT_NombreArchivo", "FicT_Foto", "FicT_FotoDos", "FicT_fechaHoraCrea", "FicT_UsuarioCrea", "FicT_Estado", "FicT_PDF");
    $valores = array(
    array(
      $this->Pla_Codigo, 
      $this->For_Codigo, 
      $this->FicT_Familia, 
      $this->FicT_Color, 
      $this->FicT_FecEmision,
      $this->FicT_CicloHorno, 
      $this->FicT_NombreArchivo, 
      $this->FicT_Foto, 
      $this->FicT_FotoDos, 
      $this->FicT_fechaHoraCrea, 
      $this->FicT_UsuarioCrea, 
      $this->FicT_Estado,
      $this->FicT_PDF
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
    $sql =  "SELECT * FROM ficha_tecnica WHERE FicT_Codigo = :cod";
    $parametros = array(":cod"=>$this->FicT_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setFor_Codigo($res[2]);
      $this->setFicT_Familia($res[3]);
      $this->setFicT_Color($res[4]);
      $this->setFicT_FecEmision($res[5]);
      $this->setFicT_CicloHorno($res[6]);
      $this->setFicT_NombreArchivo($res[7]);
      $this->setFicT_Foto($res[8]);
      $this->setFicT_FotoDos($res[9]);
      $this->setFicT_fechaHoraCrea($res[10]);
      $this->setFicT_UsuarioCrea($res[11]);
      $this->setFicT_Estado($res[12]);
      $this->setFicT_PDF($res[13]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "For_Codigo", "FicT_Familia", "FicT_Color", "FicT_FecEmision", "FicT_CicloHorno", "FicT_NombreArchivo", "FicT_Foto", "FicT_FotoDos", "FicT_fechaHoraCrea", "FicT_UsuarioCrea", "FicT_Estado", "FicT_PDF");
    $valores = array($this->getPla_Codigo(), $this->getFor_Codigo(), $this->getFicT_Familia(), $this->getFicT_Color(), $this->getFicT_FecEmision(), $this->getFicT_CicloHorno(), $this->getFicT_NombreArchivo(), $this->getFicT_Foto(), $this->getFicT_FotoDos(), $this->getFicT_fechaHoraCrea(), $this->getFicT_UsuarioCrea(), $this->getFicT_Estado(), $this->getFicT_PDF());
    $llaveprimaria = "FicT_Codigo";
    $valorllaveprimaria = $this->getFicT_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM ficha_tecnica WHERE FicT_Codigo = :cod";
    $parametros = array(":cod"=>$this->FicT_Codigo);
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
  public function listarFichaTecnicaUsuario($usuario, $planta, $formatos, $estado, $familia, $fecha, $version){

    $parametros = array(":usu"=>$usuario, ":est"=>$estado);

    $sql = "SELECT f1.FicT_Codigo, plantas.Pla_Nombre, fr2.For_Nombre, f1.FicT_Familia, f1.FicT_Color, 
    f1.FicT_FecEmision, f1.FicT_CicloHorno, f1.FicT_NombreArchivo, plantas.Pla_Codigo, fr2.For_Codigo,
    (SELECT HisFT_Version 
    FROM historial_ficha_tecnica  
    INNER JOIN ficha_tecnica f2 ON historial_ficha_tecnica.FicT_Codigo = f2.FicT_Codigo  
    INNER JOIN formatos fr1 ON f2.For_Codigo = fr1.For_Codigo 
    WHERE f2.FicT_Familia = f1.FicT_Familia AND FicT_Color = f1.FicT_Color 
    AND fr1.For_Nombre = fr2.For_Nombre AND HisFT_Estado = 1 AND FicT_FecEmision = f1.FicT_FecEmision
    AND historial_ficha_tecnica.FicT_Codigo = f1.FicT_Codigo AND f2.Pla_Codigo = plantas.Pla_Codigo
    ORDER BY HisFT_Version DESC, f2.FicT_fechaHoraCrea DESC 
    LIMIT 1) AS vers,
    (SELECT HisFT_Fecha 
    FROM historial_ficha_tecnica  
    INNER JOIN ficha_tecnica f2 ON historial_ficha_tecnica.FicT_Codigo = f2.FicT_Codigo AND FicT_Estado = 1 
    INNER JOIN formatos fr1 ON f2.For_Codigo = fr1.For_Codigo 
    WHERE f2.FicT_Familia = f1.FicT_Familia AND FicT_Color = f1.FicT_Color 
    AND fr1.For_Nombre = fr2.For_Nombre AND HisFT_Estado = 1 
    AND historial_ficha_tecnica.FicT_Codigo = f1.FicT_Codigo AND f2.Pla_Codigo = plantas.Pla_Codigo
    ORDER BY HisFT_Version DESC, f2.FicT_fechaHoraCrea DESC 
    LIMIT 1) AS fecEmi,
    (SELECT Ref_Descripcion
    FROM referencias
    WHERE Ref_Familia = f1.FicT_Familia AND Ref_Formato = fr2.For_Nombre AND Ref_Color = f1.FicT_Color 
    AND Ref_Calidad = 'PRIMERA' AND Ref_Estado = 1 AND Pla_Codigo = plantas.Pla_Codigo AND Ref_EstadoSap IN ('L0','N0','D3') LIMIT 1) AS descripcion
    FROM ficha_tecnica f1
    INNER JOIN plantas ON f1.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN formatos fr2 ON f1.For_Codigo = fr2.For_Codigo
    WHERE FicT_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";
    
    if($planta != ""){ 
      $pri = 1; 
      foreach($planta as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " f1.Pla_Codigo = :pla".$pri." "; 
        $parametros[':pla'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    if($formatos != ""){ 
      $pri2 = 1; 
      foreach($formatos as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " fr2.For_Codigo = :for".$pri2." "; 
        $parametros[':for'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }    
    
    if($familia != ""){ 
      $pri3 = 1; 
      foreach($familia as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " f1.FicT_Familia = :fam".$pri3." "; 
        $parametros[':fam'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    if($fecha != "-1"){ 
        $sql .= " AND ( FicT_FecEmision = :fec ) ";
        $parametros[':fec'] = $fecha; 
    }    
        
    if($version != "-1"){         
        $sql .= " HAVING ( vers = :ver )"; 
        $parametros[':ver'] = $version; 
    }
    
    $sql .= " ORDER BY FicT_FecEmision DESC, fr2.For_Nombre ASC,f1.FicT_Familia ASC, f1.FicT_Color ASC ";

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
  public function listarConfFT($planta, $area){
    
    $parametros = array(":pla"=>$planta);

    $sql = "SELECT ConFT_Agrupacion, ConFT_Variable, ConFT_Ordenamiento, Are_Codigo, ConFT_Codigo, Maq_Codigo, ConFT_TomaVariable
    FROM configuracion_ficha_tecnica
    WHERE ConFT_Estado = 1 AND Pla_Codigo = :pla ";
    
      if($area != ""){ 
      $pri = 1; 
      foreach($area as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Are_Codigo = :are".$pri." "; 
        $parametros[':are'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY ConFT_Agrupacion ASC";

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
  public function listarAgrupacion($planta, $area){
    
    $parametros = array(":pla"=>$planta);

    $sql = "SELECT DISTINCT ConFT_Agrupacion, Are_Codigo
    FROM configuracion_ficha_tecnica
    WHERE ConFT_Estado = 1 AND Pla_Codigo = :pla ";
    
    if($area != ""){ 
      $pri = 1; 
      foreach($area as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Are_Codigo = :are".$pri." "; 
        $parametros[':are'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY ConFT_Agrupacion ASC";

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
  public function listarParametrosVIngresoVariable($codigoFT){

    $parametros = array(":cod"=>$codigoFT);

    $sql = "SELECT PV.Maq_Codigo, FT.For_Codigo, FT.FicT_Familia, FT.FicT_Color, 
    PV.ParV_Nombre , PV.ParV_Tipo, parametros.Par_Nombre, PV.ParV_ValorControl,
    PV.ParV_ValorTolerancia, PV.ParV_Operador, PV.ParV_Orden, PV.ParV_PuntoControl, PV.ParV_TipoVariable
    FROM ficha_tecnica FT
    INNER JOIN parametros_variables PV ON FT.For_Codigo = PV.For_Codigo AND ParV_Estado = 1
    INNER JOIN parametros ON PV.ParV_UnidadMedida = parametros.Par_Codigo AND Par_Estado = 1
    WHERE FT.FicT_Estado = 1 AND FT.FicT_Codigo = :cod ORDER BY PV.Maq_Codigo ASC";

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
  public function listarParametrosVariablesFrecuenciasFichaTecnicaLlenado($fichaTecnica){

    $parametros = array(":fic"=>$fichaTecnica);

    $sql = "SELECT PV.Maq_Codigo, FT.For_Codigo, FT.FicT_Familia, FT.FicT_Color,  
    PV.ParV_Nombre, FicT_UsuarioCrea, FPV.Tur_Codigo, FPV.FrePV_Hora, max(FrePV_Codigo) as codigofrecuencia,
   (SELECT fp2.FrePV_Estado
    FROM frecuencias_parametros_variables fp2
    WHERE max(FPV.FrePV_Codigo) = fp2.FrePV_Codigo) AS estado
    FROM ficha_tecnica FT 
    INNER JOIN parametros_variables PV ON FT.For_Codigo = PV.For_Codigo AND ParV_Estado = 1 
    INNER JOIN parametros ON PV.ParV_UnidadMedida = parametros.Par_Codigo AND Par_Estado = 1 
    INNER JOIN frecuencias_parametros_variables FPV ON PV.ParV_Codigo = FPV.ParV_Codigo AND FrePV_Estado = '1' 
    WHERE FT.FicT_Estado = 1 AND FT.FicT_Codigo = :fic 
    GROUP BY PV.Maq_Codigo, FT.For_Codigo, FT.FicT_Familia, FT.FicT_Color,  
    PV.ParV_Nombre, FicT_UsuarioCrea, FPV.Tur_Codigo, FPV.FrePV_Hora";

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
  public function listarFrecuenciasCFT($fichaTecnica){

    $parametros = array(":cod"=>$fichaTecnica);

    $sql = "SELECT detalle_ficha_tecnica.Maq_Codigo, ficha_tecnica.For_Codigo, ficha_tecnica.FicT_Familia, ficha_tecnica.FicT_Color,  
    ConFT_Variable, FicT_UsuarioCrea, frecuencias_configuracion_ficha_tecnica.Tur_Codigo, FreCFT_Hora
    FROM ficha_tecnica
    INNER JOIN detalle_ficha_tecnica ON ficha_tecnica.FicT_Codigo = detalle_ficha_tecnica.FicT_Codigo AND DetFT_Estado = 1
    INNER JOIN configuracion_ficha_tecnica ON detalle_ficha_tecnica.ConFT_Codigo = configuracion_ficha_tecnica.ConFT_Codigo AND ConFT_Estado = 1
    INNER JOIN frecuencias_configuracion_ficha_tecnica ON detalle_ficha_tecnica.ConFT_Codigo = frecuencias_configuracion_ficha_tecnica.ConFT_Codigo AND FreCFT_Estado = 1
    WHERE ficha_tecnica.FicT_Codigo = :cod AND ficha_tecnica.FicT_Estado = 1";

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
  public function listarFrecuenciasCFTN($fichaTecnica){

    $parametros = array(":cod"=>$fichaTecnica);

    $sql = "SELECT detalle_ficha_tecnica.Maq_Codigo, ficha_tecnica.For_Codigo, ficha_tecnica.FicT_Familia, ficha_tecnica.FicT_Color,  
    agrCFT.AgrC_Nombre, FicT_UsuarioCrea, frecuencias_agrupaciones_configft.Tur_Codigo, FreACFT_Hora
    FROM ficha_tecnica
    INNER JOIN detalle_ficha_tecnica ON ficha_tecnica.FicT_Codigo = detalle_ficha_tecnica.FicT_Codigo AND DetFT_Estado = 1
    INNER JOIN agrupaciones_variables_configft agrVCFT ON detalle_ficha_tecnica.AgrVCon_Codigo = agrVCFT.AgrVCon_Codigo AND AgrVCon_Estado = '1'
    INNER JOIN agrupaciones_configft agrCFT ON agrVCFT.AgrC_Codigo = agrCFT.AgrC_Codigo AND AgrC_Estado = '1'
    INNER JOIN frecuencias_agrupaciones_configft ON agrCFT.AgrC_Codigo = frecuencias_agrupaciones_configft.AgrC_Codigo AND FreACFT_Estado = '1'
    WHERE ficha_tecnica.FicT_Codigo = :cod AND ficha_tecnica.FicT_Estado = 1";

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
  public function listarfamiliaFT($usuario){
    
    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT DISTINCT FicT_Familia
    FROM ficha_tecnica
    INNER JOIN plantas ON ficha_tecnica.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN formatos ON ficha_tecnica.For_Codigo = formatos.For_Codigo
    WHERE FicT_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu ORDER BY FicT_Familia ASC";

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
  public function listarFichaTecnicaHistorialClonar($formato){

    $parametros = array(":for"=>$formato);
    
    $sql = "SELECT MAX(h1.HisFT_Version), MAX(FT.FicT_FecEmision), For_Nombre, 
    FT.FicT_Familia, FT.FicT_Color, FT.For_Codigo, (SELECT DISTINCT h2.FicT_Codigo FROM historial_ficha_tecnica h2
    INNER JOIN  ficha_tecnica FT2 ON h2.FicT_Codigo = FT2.FicT_Codigo AND FT2.FicT_Estado = 1
    WHERE h2.HisFT_Version =  MAX(h1.HisFT_Version) AND FT2.FicT_FecEmision = MAX(FT.FicT_FecEmision)
    AND FT2.For_Codigo = FT.For_Codigo
    AND FT2.FicT_Familia = FT.FicT_Familia AND FT2.FicT_Color = FT.FicT_Color AND h2.HisFT_Estado = 1 LIMIT 1) AS CONFT
    FROM historial_ficha_tecnica h1
    INNER JOIN  ficha_tecnica FT ON h1.FicT_Codigo = FT.FicT_Codigo AND FT.FicT_Estado = 1
    INNER JOIN formatos ON FT.For_Codigo = formatos.For_Codigo AND For_Estado = 1
    WHERE h1.HisFT_Estado = 1 AND formatos.For_Codigo = :for
    GROUP BY For_Nombre, 
    FT.FicT_Familia, FT.FicT_Color";

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
  public function listarUltimoIdFT($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT FicT_Codigo
    FROM ficha_tecnica
    WHERE FicT_Estado = 1 AND FicT_UsuarioCrea = :usu
    ORDER BY FicT_Codigo DESC
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
  public function listarUltimoIdFTN($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT FicT_Codigo
    FROM ficha_tecnica
    WHERE FicT_Estado = 1 AND FicT_UsuarioCrea = :usu
    ORDER BY FicT_Codigo DESC
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
  public function versionesFiltro(){

    $sql = "SELECT DISTINCT h.HisFT_Version
    FROM ficha_tecnica f
    INNER JOIN historial_ficha_tecnica h ON h.FicT_Codigo = f.FicT_Codigo AND h.HisFT_Estado = 1";

    $this->consultaSQL($sql);
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
  public function listarFechaEmisionFT($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT DISTINCT FicT_FecEmision
    FROM ficha_tecnica 
    INNER JOIN plantas ON ficha_tecnica.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE FicT_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
