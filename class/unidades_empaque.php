<?php
require_once( 'basedatos.php' );

class unidades_empaque extends basedatos {
  private $UniE_Codigo;
  private $Pla_Codigo;
  private $For_Codigo;
  private $UniE_Tipo;
  private $UniE_Metros;
  private $UniE_FechaHoraCrea;
  private $UniE_UsuarioCrea;
  private $UniE_Estado;

  function __construct( $UniE_Codigo = NULL, $Pla_Codigo = NULL, $For_Codigo = NULL, $UniE_Tipo = NULL, $UniE_Metros = NULL, $UniE_FechaHoraCrea = NULL, $UniE_UsuarioCrea = NULL, $UniE_Estado = NULL ) {
    $this->UniE_Codigo = $UniE_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->For_Codigo = $For_Codigo;
    $this->UniE_Tipo = $UniE_Tipo;
    $this->UniE_Metros = $UniE_Metros;
    $this->UniE_FechaHoraCrea = $UniE_FechaHoraCrea;
    $this->UniE_UsuarioCrea = $UniE_UsuarioCrea;
    $this->UniE_Estado = $UniE_Estado;
    $this->tabla = "unidades_empaque";
  }

  function getUniE_Codigo() {
    return $this->UniE_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getFor_Codigo() {
    return $this->For_Codigo;
  }

  function getUniE_Tipo() {
    return $this->UniE_Tipo;
  }

  function getUniE_Metros() {
    return $this->UniE_Metros;
  }

  function getUniE_FechaHoraCrea() {
    return $this->UniE_FechaHoraCrea;
  }

  function getUniE_UsuarioCrea() {
    return $this->UniE_UsuarioCrea;
  }

  function getUniE_Estado() {
    return $this->UniE_Estado;
  }

  function setUniE_Codigo( $UniE_Codigo ) {
    $this->UniE_Codigo = $UniE_Codigo;
  }

  function setPla_Codigo( $Pla_Codigo ) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setFor_Codigo( $For_Codigo ) {
    $this->For_Codigo = $For_Codigo;
  }

  function setUniE_Tipo( $UniE_Tipo ) {
    $this->UniE_Tipo = $UniE_Tipo;
  }

  function setUniE_Metros( $UniE_Metros ) {
    $this->UniE_Metros = $UniE_Metros;
  }

  function setUniE_FechaHoraCrea( $UniE_FechaHoraCrea ) {
    $this->UniE_FechaHoraCrea = $UniE_FechaHoraCrea;
  }

  function setUniE_UsuarioCrea( $UniE_UsuarioCrea ) {
    $this->UniE_UsuarioCrea = $UniE_UsuarioCrea;
  }

  function setUniE_Estado( $UniE_Estado ) {
    $this->UniE_Estado = $UniE_Estado;
  }

  public function insertar() {
    $campos = array( "Pla_Codigo", "For_Codigo", "UniE_Tipo", "UniE_Metros", "UniE_FechaHoraCrea", "UniE_UsuarioCrea", "UniE_Estado" );
    $valores = array(
      array(
        $this->Pla_Codigo,
        $this->For_Codigo,
        $this->UniE_Tipo,
        $this->UniE_Metros,
        $this->UniE_FechaHoraCrea,
        $this->UniE_UsuarioCrea,
        $this->UniE_Estado
      )
    );

    $resultado = $this->insertarRegistros( $campos, $valores );
    $this->desconectar();

    if ( $resultado[ 0 ] == "OK" ) {
      return true;
    } else {
      return false;
    }
  }

  public function consultar() {
    $sql = "SELECT * FROM unidades_empaque WHERE UniE_Codigo = :cod";
    $parametros = array( ":cod" => $this->UniE_Codigo );
    if ( $this->consultaSQL( $sql, $parametros ) ) {
      $res = $this->cargarRegistro();

      $this->setPla_Codigo( $res[ 1 ] );
      $this->setFor_Codigo( $res[ 2 ] );
      $this->setUniE_Tipo( $res[ 3 ] );
      $this->setUniE_Metros( $res[ 4 ] );
      $this->setUniE_FechaHoraCrea( $res[ 5 ] );
      $this->setUniE_UsuarioCrea( $res[ 6 ] );
      $this->setUniE_Estado( $res[ 7 ] );

      $this->desconectar();
    }
  }

  public function actualizar() {
    $campos = array( "Pla_Codigo", "For_Codigo", "UniE_Tipo", "UniE_Metros", "UniE_FechaHoraCrea", "UniE_UsuarioCrea", "UniE_Estado" );
    $valores = array( $this->getPla_Codigo(), $this->getFor_Codigo(), $this->getUniE_Tipo(), $this->getUniE_Metros(), $this->getUniE_FechaHoraCrea(), $this->getUniE_UsuarioCrea(), $this->getUniE_Estado() );
    $llaveprimaria = "UniE_Codigo";
    $valorllaveprimaria = $this->getUniE_Codigo();
    $res = $this->actualizarRegistros( $campos, $valores, $llaveprimaria, $valorllaveprimaria );
    $this->desconectar();
    return $res;
  }

  public function eliminar() {
    $sql = "DELETE FROM unidades_empaque WHERE UniE_Codigo = :cod";
    $parametros = array( ":cod" => $this->UniE_Codigo );
    $res = $this->consultaSQL( $sql, $parametros );
    $this->desconectar();
    return $res;
  }

  /*
   Autor: Natalia Rodríguez
   Fecha: 
   Descripción:
   Parámetros:
   */
  public function listarUnidadesEmpaque( $planta, $formato, $estado, $usuario ) {

    $parametros = array( ":est" => $estado, ":usu"=>$usuario );

    $sql = "SELECT UniE_Codigo, plantas.Pla_Nombre, formatos.For_Nombre, 
 	IF(UniE_Tipo = 1, 'EUROPALLET', 
      IF(UniE_Tipo = 2, 'EXPORTACIÓN', 
        IF(UniE_Tipo = 3, 'NACIONAL', 'No existe tipo'
        )
      )
    ) as Tipo, UniE_Metros, UniE_Estado
    FROM unidades_empaque
    INNER JOIN formatos ON unidades_empaque.For_Codigo = formatos.For_Codigo AND formatos.For_Estado = 1
    INNER JOIN plantas ON unidades_empaque.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN usuarios ON unidades_empaque.UniE_UsuarioCrea = usuarios.Usu_Codigo AND usuarios.Usu_Estado = 1
	INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE UniE_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";

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

    if ( $formato != "" ) {
      $pri1 = 1;
      foreach ( $formato as $registro2 ) {
        if ( $pri1 == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= "formatos.For_Codigo = :for" . $pri1 . " ";
        $parametros[ ':for' . $pri1 ] = $registro2;
        $pri1++;
      }
      $sql .= " )";
    }

    $sql .= " ORDER BY plantas.Pla_Nombre ASC";

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
  public function listarUnidadesEmpaquesAnalisisProgramaProduccion($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT unidades_empaque.Pla_Codigo, For_Codigo, UniE_Metros, UniE_Tipo
FROM unidades_empaque
INNER JOIN plantas ON unidades_empaque.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
WHERE UniE_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu
ORDER BY For_Codigo ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
