<?php
require_once('basedatos.php');

  class pacs extends basedatos {
    private $Pac_Codigo;
    private $ForD_Codigo;
    private $Cal_Codigo;
    private $For_Codigo;
    private $Maq_Codigo;
    private $Pac_Familia;
    private $Pac_Color;
    private $Pac_Fecha;
    private $Pac_Hora;
    private $Pac_Origen;
    private $Pac_VariablesFC;
    private $Pac_VariablesFCOtro;
    private $Pac_AccionOperador;
    private $Pac_AccionSupervisor;
    private $Pac_HoraAjuste;
    private $Pac_RequerimientoSAP;
    private $Pac_Supervisor;
    private $Pac_ObservacionJefes;
    private $Pac_FechaProgramada;
    private $Pac_FechaReal;
    private $Pac_Porcentaje;
    private $Pac_FechaHoraCrea;
    private $Pac_UsuarioCrea;
    private $Pac_Estado;

  function __construct($Pac_Codigo = NULL, $ForD_Codigo = NULL, $Cal_Codigo = NULL, $For_Codigo = NULL, $Maq_Codigo = NULL, $Pac_Familia = NULL, $Pac_Color = NULL, $Pac_Fecha = NULL, $Pac_Hora = NULL, $Pac_Origen = NULL, $Pac_VariablesFC = NULL, $Pac_VariablesFCOtro = NULL, $Pac_AccionOperador = NULL, $Pac_AccionSupervisor = NULL, $Pac_HoraAjuste = NULL, $Pac_RequerimientoSAP = NULL, $Pac_Supervisor = NULL, $Pac_ObservacionJefes = NULL, $Pac_FechaProgramada = NULL, $Pac_FechaReal = NULL, $Pac_Porcentaje = NULL, $Pac_FechaHoraCrea = NULL, $Pac_UsuarioCrea = NULL, $Pac_Estado = NULL) {
    $this->Pac_Codigo = $Pac_Codigo;
    $this->ForD_Codigo = $ForD_Codigo;
    $this->Cal_Codigo = $Cal_Codigo;
    $this->For_Codigo = $For_Codigo;
    $this->Maq_Codigo = $Maq_Codigo;
    $this->Pac_Familia = $Pac_Familia;
    $this->Pac_Color = $Pac_Color;
    $this->Pac_Fecha = $Pac_Fecha;
    $this->Pac_Hora = $Pac_Hora;
    $this->Pac_Origen = $Pac_Origen;
    $this->Pac_VariablesFC = $Pac_VariablesFC;
    $this->Pac_VariablesFCOtro = $Pac_VariablesFCOtro;
    $this->Pac_AccionOperador = $Pac_AccionOperador;
    $this->Pac_AccionSupervisor = $Pac_AccionSupervisor;
    $this->Pac_HoraAjuste = $Pac_HoraAjuste;
    $this->Pac_RequerimientoSAP = $Pac_RequerimientoSAP;
    $this->Pac_Supervisor = $Pac_Supervisor;
    $this->Pac_ObservacionJefes = $Pac_ObservacionJefes;
    $this->Pac_FechaProgramada = $Pac_FechaProgramada;
    $this->Pac_FechaReal = $Pac_FechaReal;
    $this->Pac_Porcentaje = $Pac_Porcentaje;
    $this->Pac_FechaHoraCrea = $Pac_FechaHoraCrea;
    $this->Pac_UsuarioCrea = $Pac_UsuarioCrea;
    $this->Pac_Estado = $Pac_Estado;
    $this->tabla = "pacs";
  }

  function getPac_Codigo() {
    return $this->Pac_Codigo;
  }

  function getForD_Codigo() {
    return $this->ForD_Codigo;
  }

  function getCal_Codigo() {
    return $this->Cal_Codigo;
  }

  function getFor_Codigo() {
    return $this->For_Codigo;
  }

  function getMaq_Codigo() {
    return $this->Maq_Codigo;
  }

  function getPac_Familia() {
    return $this->Pac_Familia;
  }

  function getPac_Color() {
    return $this->Pac_Color;
  }

  function getPac_Fecha() {
    return $this->Pac_Fecha;
  }

  function getPac_Hora() {
    return $this->Pac_Hora;
  }

  function getPac_Origen() {
    return $this->Pac_Origen;
  }

  function getPac_VariablesFC() {
    return $this->Pac_VariablesFC;
  }

  function getPac_VariablesFCOtro() {
    return $this->Pac_VariablesFCOtro;
  }

  function getPac_AccionOperador() {
    return $this->Pac_AccionOperador;
  }

  function getPac_AccionSupervisor() {
    return $this->Pac_AccionSupervisor;
  }

  function getPac_HoraAjuste() {
    return $this->Pac_HoraAjuste;
  }

  function getPac_RequerimientoSAP() {
    return $this->Pac_RequerimientoSAP;
  }

  function getPac_Supervisor() {
    return $this->Pac_Supervisor;
  }

  function getPac_ObservacionJefes() {
    return $this->Pac_ObservacionJefes;
  }

  function getPac_FechaProgramada() {
    return $this->Pac_FechaProgramada;
  }

  function getPac_FechaReal() {
    return $this->Pac_FechaReal;
  }

  function getPac_Porcentaje() {
    return $this->Pac_Porcentaje;
  }

  function getPac_FechaHoraCrea() {
    return $this->Pac_FechaHoraCrea;
  }

  function getPac_UsuarioCrea() {
    return $this->Pac_UsuarioCrea;
  }

  function getPac_Estado() {
    return $this->Pac_Estado;
  }

  function setPac_Codigo($Pac_Codigo) {
    $this->Pac_Codigo = $Pac_Codigo;
  }

  function setForD_Codigo($ForD_Codigo) {
    $this->ForD_Codigo = $ForD_Codigo;
  }

  function setCal_Codigo($Cal_Codigo) {
    $this->Cal_Codigo = $Cal_Codigo;
  }

  function setFor_Codigo($For_Codigo) {
    $this->For_Codigo = $For_Codigo;
  }

  function setMaq_Codigo($Maq_Codigo) {
    $this->Maq_Codigo = $Maq_Codigo;
  }

  function setPac_Familia($Pac_Familia) {
    $this->Pac_Familia = $Pac_Familia;
  }

  function setPac_Color($Pac_Color) {
    $this->Pac_Color = $Pac_Color;
  }

  function setPac_Fecha($Pac_Fecha) {
    $this->Pac_Fecha = $Pac_Fecha;
  }

  function setPac_Hora($Pac_Hora) {
    $this->Pac_Hora = $Pac_Hora;
  }

  function setPac_Origen($Pac_Origen) {
    $this->Pac_Origen = $Pac_Origen;
  }

  function setPac_VariablesFC($Pac_VariablesFC) {
    $this->Pac_VariablesFC = $Pac_VariablesFC;
  }

  function setPac_VariablesFCOtro($Pac_VariablesFCOtro) {
    $this->Pac_VariablesFCOtro = $Pac_VariablesFCOtro;
  }

  function setPac_AccionOperador($Pac_AccionOperador) {
    $this->Pac_AccionOperador = $Pac_AccionOperador;
  }

  function setPac_AccionSupervisor($Pac_AccionSupervisor) {
    $this->Pac_AccionSupervisor = $Pac_AccionSupervisor;
  }

  function setPac_HoraAjuste($Pac_HoraAjuste) {
    $this->Pac_HoraAjuste = $Pac_HoraAjuste;
  }

  function setPac_RequerimientoSAP($Pac_RequerimientoSAP) {
    $this->Pac_RequerimientoSAP = $Pac_RequerimientoSAP;
  }

  function setPac_Supervisor($Pac_Supervisor) {
    $this->Pac_Supervisor = $Pac_Supervisor;
  }

  function setPac_ObservacionJefes($Pac_ObservacionJefes) {
    $this->Pac_ObservacionJefes = $Pac_ObservacionJefes;
  }

  function setPac_FechaProgramada($Pac_FechaProgramada) {
    $this->Pac_FechaProgramada = $Pac_FechaProgramada;
  }

  function setPac_FechaReal($Pac_FechaReal) {
    $this->Pac_FechaReal = $Pac_FechaReal;
  }

  function setPac_Porcentaje($Pac_Porcentaje) {
    $this->Pac_Porcentaje = $Pac_Porcentaje;
  }

  function setPac_FechaHoraCrea($Pac_FechaHoraCrea) {
    $this->Pac_FechaHoraCrea = $Pac_FechaHoraCrea;
  }

  function setPac_UsuarioCrea($Pac_UsuarioCrea) {
    $this->Pac_UsuarioCrea = $Pac_UsuarioCrea;
  }

  function setPac_Estado($Pac_Estado) {
    $this->Pac_Estado = $Pac_Estado;
  }

  public function insertar(){
    $campos = array("ForD_Codigo", "Cal_Codigo", "For_Codigo", "Maq_Codigo", "Pac_Familia", "Pac_Color", "Pac_Fecha", "Pac_Hora", "Pac_Origen", "Pac_VariablesFC", "Pac_VariablesFCOtro", "Pac_AccionOperador", "Pac_AccionSupervisor", "Pac_HoraAjuste", "Pac_RequerimientoSAP", "Pac_Supervisor", "Pac_ObservacionJefes", "Pac_FechaProgramada", "Pac_FechaReal", "Pac_Porcentaje", "Pac_FechaHoraCrea", "Pac_UsuarioCrea", "Pac_Estado");
    $valores = array(
    array(
      $this->ForD_Codigo, 
      $this->Cal_Codigo, 
      $this->For_Codigo, 
      $this->Maq_Codigo, 
      $this->Pac_Familia, 
      $this->Pac_Color, 
      $this->Pac_Fecha, 
      $this->Pac_Hora, 
      $this->Pac_Origen, 
      $this->Pac_VariablesFC, 
      $this->Pac_VariablesFCOtro, 
      $this->Pac_AccionOperador, 
      $this->Pac_AccionSupervisor, 
      $this->Pac_HoraAjuste, 
      $this->Pac_RequerimientoSAP, 
      $this->Pac_Supervisor, 
      $this->Pac_ObservacionJefes, 
      $this->Pac_FechaProgramada, 
      $this->Pac_FechaReal, 
      $this->Pac_Porcentaje, 
      $this->Pac_FechaHoraCrea, 
      $this->Pac_UsuarioCrea, 
      $this->Pac_Estado
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
    $sql =  "SELECT * FROM pacs WHERE Pac_Codigo = :cod";
    $parametros = array(":cod"=>$this->Pac_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setForD_Codigo($res[1]);
      $this->setCal_Codigo($res[2]);
      $this->setFor_Codigo($res[3]);
      $this->setMaq_Codigo($res[4]);
      $this->setPac_Familia($res[5]);
      $this->setPac_Color($res[6]);
      $this->setPac_Fecha($res[7]);
      $this->setPac_Hora($res[8]);
      $this->setPac_Origen($res[9]);
      $this->setPac_VariablesFC($res[10]);
      $this->setPac_VariablesFCOtro($res[11]);
      $this->setPac_AccionOperador($res[12]);
      $this->setPac_AccionSupervisor($res[13]);
      $this->setPac_HoraAjuste($res[14]);
      $this->setPac_RequerimientoSAP($res[15]);
      $this->setPac_Supervisor($res[16]);
      $this->setPac_ObservacionJefes($res[17]);
      $this->setPac_FechaProgramada($res[18]);
      $this->setPac_FechaReal($res[19]);
      $this->setPac_Porcentaje($res[20]);
      $this->setPac_FechaHoraCrea($res[21]);
      $this->setPac_UsuarioCrea($res[22]);
      $this->setPac_Estado($res[23]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("ForD_Codigo", "Cal_Codigo", "For_Codigo", "Maq_Codigo", "Pac_Familia", "Pac_Color", "Pac_Fecha", "Pac_Hora", "Pac_Origen", "Pac_VariablesFC", "Pac_VariablesFCOtro", "Pac_AccionOperador", "Pac_AccionSupervisor", "Pac_HoraAjuste", "Pac_RequerimientoSAP", "Pac_Supervisor", "Pac_ObservacionJefes", "Pac_FechaProgramada", "Pac_FechaReal", "Pac_Porcentaje", "Pac_FechaHoraCrea", "Pac_UsuarioCrea", "Pac_Estado");
    $valores = array($this->getForD_Codigo(), $this->getCal_Codigo(), $this->getFor_Codigo(), $this->getMaq_Codigo(), $this->getPac_Familia(), $this->getPac_Color(), $this->getPac_Fecha(), $this->getPac_Hora(), $this->getPac_Origen(), $this->getPac_VariablesFC(), $this->getPac_VariablesFCOtro(), $this->getPac_AccionOperador(), $this->getPac_AccionSupervisor(), $this->getPac_HoraAjuste(), $this->getPac_RequerimientoSAP(), $this->getPac_Supervisor(), $this->getPac_ObservacionJefes(), $this->getPac_FechaProgramada(), $this->getPac_FechaReal(), $this->getPac_Porcentaje(), $this->getPac_FechaHoraCrea(), $this->getPac_UsuarioCrea(), $this->getPac_Estado());
    $llaveprimaria = "Pac_Codigo";
    $valorllaveprimaria = $this->getPac_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM pacs WHERE Pac_Codigo = :cod";
    $parametros = array(":cod"=>$this->Pac_Codigo);
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
  public function listarInfoPAC($formato, $familia, $color, $calidad, $fechaInicial, $fechaFinal){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":cal"=>$calidad,":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT Pac_Codigo, Pac_Fecha, Pac_Hora, formularios_defectos.Cal_Codigo, pacs.ForD_Codigo, formularios_defectos.ForD_Defecto, Pac_Origen, pacs.Maq_Codigo, 
    Pac_VariablesFC, Pac_AccionOperador, Pac_AccionSupervisor, Pac_HoraAjuste, Pac_RequerimientoSAP, Pac_Supervisor, Pac_VariablesFCOtro, Pac_ObservacionJefes, Pac_FechaProgramada, Pac_FechaReal
    FROM pacs
    INNER JOIN formularios_defectos ON pacs.ForD_Codigo = formularios_defectos.ForD_Codigo AND ForD_Estado = 1
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1
    WHERE Pac_Estado = 1 AND pacs.For_Codigo = :for AND Pac_Familia = :fam AND Pac_Color = :col AND Pac_Fecha BETWEEN :fecini AND :fecfin AND formularios_defectos.Cal_Codigo = :cal";

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
  public function listarInfoPACTodo($formato, $familia, $color, $fechaInicial, $fechaFinal){

    $parametros = array(":for"=>$formato,":fam"=>$familia,":col"=>$color,":fecini"=>$fechaInicial, ":fecfin"=>$fechaFinal);

    $sql = "SELECT Pac_Codigo, Pac_Fecha, Pac_Hora, formularios_defectos.Cal_Codigo, pacs.ForD_Codigo, formularios_defectos.ForD_Defecto, Pac_Origen, pacs.Maq_Codigo, 
    Pac_VariablesFC, Pac_AccionOperador, Pac_AccionSupervisor, Pac_HoraAjuste, Pac_RequerimientoSAP, Pac_Supervisor, Pac_VariablesFCOtro, formularios_defectos.ForD_Codigo
    FROM pacs
    INNER JOIN formularios_defectos ON pacs.ForD_Codigo = formularios_defectos.ForD_Codigo AND ForD_Estado = 1
    INNER JOIN parametros p1 ON formularios_defectos.ForD_Defecto = p1.Par_Codigo AND p1.Par_Estado = 1
    WHERE Pac_Estado = 1 AND pacs.For_Codigo = :for AND Pac_Familia = :fam AND Pac_Color = :col AND Pac_Fecha BETWEEN :fecini AND :fecfin";

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
  public function listarSupervisoresFiltroPAC($planta){

    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Usu_Codigo, CONCAT_WS(' ',Usu_Nombres,Usu_Apellidos) AS nombres
    FROM pacs
    INNER JOIN usuarios ON pacs.Pac_Supervisor = usuarios.Usu_Codigo AND Usu_Estado = 1
    WHERE Pac_Estado = 1 AND usuarios.Pla_Codigo = :pla
    GROUP BY nombres
    ORDER BY nombres";

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
  public function listarInfoConsolidadoPAC($referenciaConsulta, $formato, $familia, $color, $fechaInicial, $fechaFinal, $defecto, $origen, $maquina, $variables, $supervisor, $planta){

    $parametros = array(":fecI"=>$fechaInicial,":fecF"=>$fechaFinal,":pla"=>$planta);

    $sql = "SELECT  Pac_Fecha, Pac_Hora, calidad.Cal_Nombre, parametros.Par_Nombre, Pac_Porcentaje, areas.Are_Nombre,
    maquinas.Maq_Nombre, Var_Nombre, Pac_VariablesFCOtro,Pac_AccionOperador, Pac_AccionSupervisor, Pac_ObservacionJefes,
    Pac_HoraAjuste, Pac_RequerimientoSAP, CONCAT_WS(' ',Usu_Nombres,Usu_Apellidos) AS nombres, Pac_FechaProgramada, Pac_FechaReal, Pac_VariablesFC, formatos.For_Nombre, Pac_Familia, Pac_Color 
    FROM pacs
    LEFT JOIN usuarios ON pacs.Pac_Supervisor = usuarios.Usu_Codigo AND Usu_Estado = 1
    INNER JOIN calidad ON pacs.Cal_Codigo = calidad.Cal_Codigo AND  Cal_Estado = 1
    INNER JOIN formularios_defectos ON pacs.ForD_Codigo = formularios_defectos.ForD_Codigo AND ForD_Estado = 1
    INNER JOIN parametros ON formularios_defectos.ForD_Defecto = parametros.Par_Codigo AND Par_Estado = 1
    INNER JOIN areas ON pacs.Pac_Origen = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    LEFT JOIN maquinas ON pacs.Maq_Codigo = maquinas.Maq_Codigo AND Maq_Estado = 1
    LEFT JOIN variables ON pacs.Pac_VariablesFC = variables.Var_Codigo AND Pac_Estado = 1 
    INNER JOIN formatos ON pacs.For_Codigo = formatos.For_Codigo AND formatos.For_EStado = 1
    WHERE Pac_Estado = 1 AND plantas.Pla_Codigo = :pla AND Pac_Fecha BETWEEN :fecI AND :fecF ";
    
    if($defecto != ""){ 
      $pri = 1; 
      foreach($defecto as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " parametros.Par_Codigo = :def".$pri." "; 
        $parametros[':def'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    if($Pac_Origen != ""){ 
      $pri2 = 1; 
      foreach($Pac_Origen as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Pac_Origen = :ori".$pri2." "; 
        $parametros[':ori'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    if($maquina != ""){ 
      $pri3 = 1; 
      foreach($maquina as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " pacs.Maq_Codigo = :maq".$pri3." "; 
        $parametros[':maq'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    if($variables != ""){ 
      $pri4 = 1; 
      foreach($variables as $registro4){ 
        if($pri4 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Pac_VariablesFC = :var".$pri4." "; 
        $parametros[':var'.$pri4] = $registro4; 
        $pri4++; 
      } 
      $sql .= " )"; 
    }
    
    if($supervisor != ""){ 
      $pri5 = 1; 
      foreach($supervisor as $registro5){ 
        if($pri5 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Pac_Supervisor = :sup".$pri5." "; 
        $parametros[':sup'.$pri5] = $registro5; 
        $pri5++; 
      } 
      $sql .= " )"; 
    }
    
    if($referenciaConsulta != ""){ 
       
      foreach($referenciaConsulta as $registro8){ 

        if($registro8 == "0"){ 
          $sql .= " AND (";  
        }else{
         $sql .= " OR ";
       }
        
        $sql .= " (pacs.For_Codigo = :for".$registro8." "; 
        $parametros[':for'.$registro8] = $formato[$registro8]; 
      
        $sql .= " AND pacs.Pac_Familia = :fam".$registro8." "; 
        $parametros[':fam'.$registro8] = $familia[$registro8]; 
        
        $sql .= " AND pacs.Pac_Color = :col".$registro8." ".")"; 
        $parametros[':col'.$registro8] = $color[$registro8]; 
      }
      $sql .= " ) "; 
    }
    
    $sql .= " ORDER BY Pac_Fecha, Pac_Hora, formatos.For_Nombre, Pac_Familia, Pac_Color ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
