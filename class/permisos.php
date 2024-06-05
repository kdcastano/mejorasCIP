<?php
require_once( 'basedatos.php' );

class permisos extends basedatos {
  private $Per_Codigo;
  private $Per_Modulo;
  private $Per_Tipo;
  private $Per_Descripcion;
  private $Per_Estado;

  function __construct( $Per_Codigo = NULL, $Per_Modulo = NULL, $Per_Tipo = NULL, $Per_Descripcion = NULL, $Per_Estado = NULL ) {
    $this->Per_Codigo = $Per_Codigo;
    $this->Per_Modulo = $Per_Modulo;
    $this->Per_Tipo = $Per_Tipo;
    $this->Per_Descripcion = $Per_Descripcion;
    $this->Per_Estado = $Per_Estado;
    $this->tabla = "permisos";
  }

  function getPer_Codigo() {
    return $this->Per_Codigo;
  }

  function getPer_Modulo() {
    return $this->Per_Modulo;
  }

  function getPer_Tipo() {
    return $this->Per_Tipo;
  }

  function getPer_Descripcion() {
    return $this->Per_Descripcion;
  }

  function getPer_Estado() {
    return $this->Per_Estado;
  }

  function setPer_Codigo( $Per_Codigo ) {
    $this->Per_Codigo = $Per_Codigo;
  }

  function setPer_Modulo( $Per_Modulo ) {
    $this->Per_Modulo = $Per_Modulo;
  }

  function setPer_Tipo( $Per_Tipo ) {
    $this->Per_Tipo = $Per_Tipo;
  }

  function setPer_Descripcion( $Per_Descripcion ) {
    $this->Per_Descripcion = $Per_Descripcion;
  }

  function setPer_Estado( $Per_Estado ) {
    $this->Per_Estado = $Per_Estado;
  }

  public function insertar() {
    $campos = array( "Per_Modulo", "Per_Tipo", "Per_Descripcion", "Per_Estado" );
    $valores = array(
      array(
        $this->Per_Modulo,
        $this->Per_Tipo,
        $this->Per_Descripcion,
        $this->Per_Estado
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
    $sql = "SELECT * FROM permisos WHERE Per_Codigo = :cod";
    $parametros = array( ":cod" => $this->Per_Codigo );
    if ( $this->consultaSQL( $sql, $parametros ) ) {
      $res = $this->cargarRegistro();

      $this->setPer_Modulo( $res[ 1 ] );
      $this->setPer_Tipo( $res[ 2 ] );
      $this->setPer_Descripcion( $res[ 3 ] );
      $this->setPer_Estado( $res[ 4 ] );

      $this->desconectar();
    }
  }

  public function actualizar() {
    $campos = array( "Per_Modulo", "Per_Tipo", "Per_Descripcion", "Per_Estado" );
    $valores = array( $this->getPer_Modulo(), $this->getPer_Tipo(), $this->getPer_Descripcion(), $this->getPer_Estado() );
    $llaveprimaria = "Per_Codigo";
    $valorllaveprimaria = $this->getPer_Codigo();
    $res = $this->actualizarRegistros( $campos, $valores, $llaveprimaria, $valorllaveprimaria );
    $this->desconectar();
    return $res;
  }

  public function eliminar() {
    $sql = "DELETE FROM permisos WHERE Per_Codigo = :cod";
    $parametros = array( ":cod" => $this->Per_Codigo );
    $res = $this->consultaSQL( $sql, $parametros );
    $this->desconectar();
    return $res;
  }

  public function filtroTipos() {

    $sql = "SELECT DISTINCT Per_Tipo
    FROM permisos
    ORDER BY Per_Tipo ASC";

    $this->consultaSQL( $sql );
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
  public function listarPermisosPrincipal( $tipo, $estado ) {

    $parametros = array( ":est" => $estado );

    $sql = "SELECT Per_Codigo, Per_Modulo, Per_Tipo, Per_Descripcion
			FROM permisos
			WHERE Per_Estado = :est";

    if ( $tipo != "" ) {
      $pri = 1;
      foreach ( $tipo as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " Per_tipo = :tip" . $pri . " ";
        $parametros[ ':tip' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }
    
    $sql .=" ORDER BY Per_Modulo ASC";

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
  public function listarPermisosSelect( $codigo ) {

    $parametros = array( ':usu' => $codigo );

    $sql = "SELECT p.Per_Codigo, Per_Modulo, up.UsuP_Ver, up.UsuP_Crear, up.UsuP_Modificar, up.UsuP_Eliminar, up.UsuP_Codigo 
    FROM permisos p 
    left join usuarios_permisos up on p.Per_Codigo = up.Per_Codigo AND up.UsuP_Estado = '1'
    WHERE up.Usu_Codigo = :usu AND Per_Estado = 1
    ORDER BY p.Per_Codigo ASC, p.Per_Modulo ASC";

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
  public function listarPermisosTodos() {

    $sql = "SELECT Per_Codigo, Per_Modulo 
      FROM permisos
      WHERE Per_Estado = 1";

    $this->consultaSQL( $sql );
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }

}
?>
