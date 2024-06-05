<?php
require_once('basedatos.php');

  class bitacoras extends basedatos {
    private $Bit_Codigo;
    private $Pla_Codigo;
    private $Usu_Codigo;
    private $PueT_Codigo;
    private $Bit_Fecha;
    private $Bit_Descripcion;
    private $Bit_Accion;
    private $Bit_Requerimiento;
    private $Bit_SAP;
    private $Bit_SAM;
    private $Bit_FechaProgramada;
    private $Bit_FechaReal;
    private $Bit_UsuarioCrea;
    private $Bit_FechaHoraCrea;
    private $Bit_Estado;

  function __construct($Bit_Codigo = NULL, $Pla_Codigo = NULL, $Usu_Codigo = NULL, $PueT_Codigo = NULL, $Bit_Fecha = NULL, $Bit_Descripcion = NULL, $Bit_Accion = NULL, $Bit_Requerimiento = NULL, $Bit_SAP = NULL, $Bit_SAM = NULL, $Bit_FechaProgramada = NULL, $Bit_FechaReal = NULL, $Bit_UsuarioCrea = NULL, $Bit_FechaHoraCrea = NULL, $Bit_Estado = NULL) {
    $this->Bit_Codigo = $Bit_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Usu_Codigo = $Usu_Codigo;
    $this->PueT_Codigo = $PueT_Codigo;
    $this->Bit_Fecha = $Bit_Fecha;
    $this->Bit_Descripcion = $Bit_Descripcion;
    $this->Bit_Accion = $Bit_Accion;
    $this->Bit_Requerimiento = $Bit_Requerimiento;
    $this->Bit_SAP = $Bit_SAP;
    $this->Bit_SAM = $Bit_SAM;
    $this->Bit_FechaProgramada = $Bit_FechaProgramada;
    $this->Bit_FechaReal = $Bit_FechaReal;
    $this->Bit_UsuarioCrea = $Bit_UsuarioCrea;
    $this->Bit_FechaHoraCrea = $Bit_FechaHoraCrea;
    $this->Bit_Estado = $Bit_Estado;
    $this->tabla = "bitacoras";
  }

  function getBit_Codigo() {
    return $this->Bit_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getPueT_Codigo() {
    return $this->PueT_Codigo;
  }

  function getBit_Fecha() {
    return $this->Bit_Fecha;
  }

  function getBit_Descripcion() {
    return $this->Bit_Descripcion;
  }

  function getBit_Accion() {
    return $this->Bit_Accion;
  }

  function getBit_Requerimiento() {
    return $this->Bit_Requerimiento;
  }

  function getBit_SAP() {
    return $this->Bit_SAP;
  }

  function getBit_SAM() {
    return $this->Bit_SAM;
  }

  function getBit_FechaProgramada() {
    return $this->Bit_FechaProgramada;
  }

  function getBit_FechaReal() {
    return $this->Bit_FechaReal;
  }

  function getBit_UsuarioCrea() {
    return $this->Bit_UsuarioCrea;
  }

  function getBit_FechaHoraCrea() {
    return $this->Bit_FechaHoraCrea;
  }

  function getBit_Estado() {
    return $this->Bit_Estado;
  }

  function setBit_Codigo($Bit_Codigo) {
    $this->Bit_Codigo = $Bit_Codigo;
  }

  function setPla_Codigo($Pla_Codigo) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setUsu_Codigo($Usu_Codigo) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setPueT_Codigo($PueT_Codigo) {
    $this->PueT_Codigo = $PueT_Codigo;
  }

  function setBit_Fecha($Bit_Fecha) {
    $this->Bit_Fecha = $Bit_Fecha;
  }

  function setBit_Descripcion($Bit_Descripcion) {
    $this->Bit_Descripcion = $Bit_Descripcion;
  }

  function setBit_Accion($Bit_Accion) {
    $this->Bit_Accion = $Bit_Accion;
  }

  function setBit_Requerimiento($Bit_Requerimiento) {
    $this->Bit_Requerimiento = $Bit_Requerimiento;
  }

  function setBit_SAP($Bit_SAP) {
    $this->Bit_SAP = $Bit_SAP;
  }

  function setBit_SAM($Bit_SAM) {
    $this->Bit_SAM = $Bit_SAM;
  }

  function setBit_FechaProgramada($Bit_FechaProgramada) {
    $this->Bit_FechaProgramada = $Bit_FechaProgramada;
  }

  function setBit_FechaReal($Bit_FechaReal) {
    $this->Bit_FechaReal = $Bit_FechaReal;
  }

  function setBit_UsuarioCrea($Bit_UsuarioCrea) {
    $this->Bit_UsuarioCrea = $Bit_UsuarioCrea;
  }

  function setBit_FechaHoraCrea($Bit_FechaHoraCrea) {
    $this->Bit_FechaHoraCrea = $Bit_FechaHoraCrea;
  }

  function setBit_Estado($Bit_Estado) {
    $this->Bit_Estado = $Bit_Estado;
  }

  public function insertar(){
    $campos = array("Pla_Codigo", "Usu_Codigo", "PueT_Codigo", "Bit_Fecha", "Bit_Descripcion", "Bit_Accion", "Bit_Requerimiento", "Bit_SAP", "Bit_SAM", "Bit_FechaProgramada", "Bit_FechaReal", "Bit_UsuarioCrea", "Bit_FechaHoraCrea", "Bit_Estado");
    $valores = array(
    array( 
      $this->Pla_Codigo, 
      $this->Usu_Codigo, 
      $this->PueT_Codigo, 
      $this->Bit_Fecha, 
      $this->Bit_Descripcion, 
      $this->Bit_Accion, 
      $this->Bit_Requerimiento, 
      $this->Bit_SAP, 
      $this->Bit_SAM, 
      $this->Bit_FechaProgramada, 
      $this->Bit_FechaReal, 
      $this->Bit_UsuarioCrea, 
      $this->Bit_FechaHoraCrea, 
      $this->Bit_Estado
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
    $sql =  "SELECT * FROM bitacoras WHERE Bit_Codigo = :cod";
    $parametros = array(":cod"=>$this->Bit_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setPla_Codigo($res[1]);
      $this->setUsu_Codigo($res[2]);
      $this->setPueT_Codigo($res[3]);
      $this->setBit_Fecha($res[4]);
      $this->setBit_Descripcion($res[5]);
      $this->setBit_Accion($res[6]);
      $this->setBit_Requerimiento($res[7]);
      $this->setBit_SAP($res[8]);
      $this->setBit_SAM($res[9]);
      $this->setBit_FechaProgramada($res[10]);
      $this->setBit_FechaReal($res[11]);
      $this->setBit_UsuarioCrea($res[12]);
      $this->setBit_FechaHoraCrea($res[13]);
      $this->setBit_Estado($res[14]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Pla_Codigo", "Usu_Codigo", "PueT_Codigo", "Bit_Fecha", "Bit_Descripcion", "Bit_Accion", "Bit_Requerimiento", "Bit_SAP", "Bit_SAM", "Bit_FechaProgramada", "Bit_FechaReal", "Bit_UsuarioCrea", "Bit_FechaHoraCrea", "Bit_Estado");
    $valores = array($this->getPla_Codigo(), $this->getUsu_Codigo(), $this->getPueT_Codigo(), $this->getBit_Fecha(), $this->getBit_Descripcion(), $this->getBit_Accion(), $this->getBit_Requerimiento(), $this->getBit_SAP(), $this->getBit_SAM(), $this->getBit_FechaProgramada(), $this->getBit_FechaReal(), $this->getBit_UsuarioCrea(), $this->getBit_FechaHoraCrea(), $this->getBit_Estado());
    $llaveprimaria = "Bit_Codigo";
    $valorllaveprimaria = $this->getBit_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM bitacoras WHERE Bit_Codigo = :cod";
    $parametros = array(":cod"=>$this->Bit_Codigo);
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
  public function bitacorasListarPrincipal($puesto, $fechaI, $fechaF, $usuarioFiltro, $sapsam,$requerimientos, $planta ){

    $parametros = array(":fecI"=>$fechaI, ":fecF"=>$fechaF, ":pla"=>$planta);

    $sql = "SELECT DISTINCT Bit_Codigo, pla.Pla_Nombre, p.PueT_Nombre, CONCAT_WS(' ', u1.Usu_Nombres, u1.Usu_Apellidos) AS Nombre, 
    Bit_Descripcion, Bit_Accion, Bit_Requerimiento, CONCAT_WS(' ', u2.Usu_Nombres, u2.Usu_Apellidos) AS SAP,
    CONCAT_WS(' ', u3.Usu_Nombres, u3.Usu_Apellidos) AS SAM, Bit_Fecha, Bit_Estado, b.Usu_Codigo, pla.Pla_Codigo, p.PueT_Codigo, u2.Usu_Codigo, u3.Usu_Codigo, u1.Usu_Codigo, Bit_FechaProgramada, Bit_FechaReal 
    FROM bitacoras b
    INNER JOIN puestos_trabajos p ON b.PueT_Codigo = p.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN plantas pla ON b.Pla_Codigo = pla.Pla_Codigo AND Pla_Estado = 1
    INNER JOIN usuarios u ON b.Pla_Codigo = u.Pla_Codigo AND u.Usu_Estado = 1
    INNER JOIN usuarios u1 ON b.Usu_Codigo = u1.Usu_Codigo AND u1.Usu_Estado = 1 
    LEFT JOIN usuarios u2 ON b.Bit_SAP = u2.Usu_Codigo AND u2.Usu_Estado = 1
    LEFT JOIN usuarios u3 ON b.Bit_SAM = u3.Usu_Codigo AND u3.Usu_Estado = 1
    WHERE Bit_Estado = 1 AND Bit_Fecha BETWEEN :fecI AND :fecF AND pla.Pla_Codigo = :pla";
    
    if ( $puesto != "" ) {
      $pri1 = 1;
      foreach ( $puesto as $registro1 ) {
        if ( $pri1 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " b.PueT_Codigo = :pue" . $pri1 . " ";
        $parametros[ ':pue' . $pri1 ] = $registro1;
        $pri1++;
      }
      $sql .= " )";
    }
    
    if($usuarioFiltro != ""){ 
      $pri2 = 1; 
      foreach($usuarioFiltro as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " u1.Usu_Codigo = :usuF".$pri2." "; 
        $parametros[':usuF'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    if($sapsam != ""){ 
      $pri3 = 1; 
      foreach($sapsam as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Bit_SAP = :samsap".$pri3." "; 
        $parametros[':samsap'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    if($requerimientos != ""){ 
      $pri4 = 1; 
      foreach($requerimientos as $registro4){ 
        if($pri4 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Bit_Requerimiento = :req".$pri4." "; 
        $parametros[':req'.$pri4] = $registro4; 
        $pri4++; 
      } 
      $sql .= " )"; 
    }
    
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
  public function bitacorasListarPrincipalExcel($puesto, $fechaI, $fechaF, $usuario, $usuarioFiltro, $sapsam,$requerimientos ){

    $parametros = array(":fecI"=>$fechaI, ":fecF"=>$fechaF, ":usu"=>$usuario);

    $sql = "SELECT DISTINCT Bit_Codigo, pla.Pla_Nombre, p.PueT_Nombre, CONCAT_WS(' ', u1.Usu_Nombres, u1.Usu_Apellidos) AS Nombre, 
    Bit_Descripcion, Bit_Accion, Bit_Requerimiento, CONCAT_WS(' ', u2.Usu_Nombres, u2.Usu_Apellidos) AS SAP,
    CONCAT_WS(' ', u3.Usu_Nombres, u3.Usu_Apellidos) AS SAM, Bit_Fecha, Bit_Estado, b.Usu_Codigo, pla.Pla_Codigo, p.PueT_Codigo, u2.Usu_Codigo, u3.Usu_Codigo, u1.Usu_Codigo
    FROM bitacoras b
    INNER JOIN puestos_trabajos p ON b.PueT_Codigo = p.PueT_Codigo AND PueT_Estado = 1
    INNER JOIN plantas pla ON b.Pla_Codigo = pla.Pla_Codigo AND Pla_Estado = 1
    INNER JOIN usuarios u ON b.Pla_Codigo = u.Pla_Codigo AND u.Usu_Estado = 1
    INNER JOIN usuarios u1 ON b.Usu_Codigo = u1.Usu_Codigo AND u1.Usu_Estado = 1 
    LEFT JOIN usuarios u2 ON b.Bit_SAP = u2.Usu_Codigo AND u2.Usu_Estado = 1
    LEFT JOIN usuarios u3 ON b.Bit_SAM = u3.Usu_Codigo AND u3.Usu_Estado = 1
    WHERE Bit_Estado = 1 AND Bit_Fecha BETWEEN :fecI AND :fecF AND u.Usu_Codigo = :usu";
    
    if ($puesto[0] != "") { 
      $pri1 = 1;
      foreach ( $puesto as $registro1 ) {
        if ( $pri1 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " b.PueT_Codigo = :pue" . $pri1 . " ";
        $parametros[ ':pue' . $pri1 ] = $registro1;
        $pri1++;
      }
      $sql .= " )";
    }
    
    if($usuarioFiltro != ""){ 
      $pri2 = 1; 
      foreach($usuarioFiltro as $registro2){ 
        if($pri2 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " u1.Usu_Codigo = :usuF".$pri2." "; 
        $parametros[':usuF'.$pri2] = $registro2; 
        $pri2++; 
      } 
      $sql .= " )"; 
    }
    
    if($sapsam != ""){ 
      $pri3 = 1; 
      foreach($sapsam as $registro3){ 
        if($pri3 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Bit_SAP = :samsap".$pri3." "; 
        $parametros[':samsap'.$pri3] = $registro3; 
        $pri3++; 
      } 
      $sql .= " )"; 
    }
    
    if($requerimientos != ""){ 
      $pri4 = 1; 
      foreach($requerimientos as $registro4){ 
        if($pri4 == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " Bit_Requerimiento = :req".$pri4." "; 
        $parametros[':req'.$pri4] = $registro4; 
        $pri4++; 
      } 
      $sql .= " )"; 
    }
    
    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
