<?php
require_once( 'basedatos.php' );

class usuarios extends basedatos {
  private $Usu_Codigo;
  private $Pla_Codigo;
  private $Usu_Usuario;
  private $Usu_Contrasena;
  private $Usu_Documento;
  private $Usu_Nombres;
  private $Usu_Apellidos;
  private $Usu_Foto;
  private $Usu_Rol;
  private $Usu_Cargo;
  private $Usu_Correo;
  private $Usu_TelMovil;
  private $Usu_UsuarioCrea;
  private $Usu_FechaHoraCrea;
  private $Usu_Estado;

  function __construct( $Usu_Codigo = NULL, $Pla_Codigo = NULL, $Usu_Usuario = NULL, $Usu_Contrasena = NULL, $Usu_Documento = NULL, $Usu_Nombres = NULL, $Usu_Apellidos = NULL, $Usu_Foto = NULL, $Usu_Rol = NULL, $Usu_Cargo = NULL, $Usu_Correo = NULL, $Usu_TelMovil = NULL, $Usu_UsuarioCrea = NULL, $Usu_FechaHoraCrea = NULL, $Usu_Estado = NULL ) {
    $this->Usu_Codigo = $Usu_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Usu_Usuario = $Usu_Usuario;
    $this->Usu_Contrasena = md5( $Usu_Contrasena );
    $this->Usu_Documento = $Usu_Documento;
    $this->Usu_Nombres = $Usu_Nombres;
    $this->Usu_Apellidos = $Usu_Apellidos;
    $this->Usu_Foto = $Usu_Foto;
    $this->Usu_Rol = $Usu_Rol;
    $this->Usu_Cargo = $Usu_Cargo;
    $this->Usu_Correo = $Usu_Correo;
    $this->Usu_TelMovil = $Usu_TelMovil;
    $this->Usu_UsuarioCrea = $Usu_UsuarioCrea;
    $this->Usu_FechaHoraCrea = $Usu_FechaHoraCrea;
    $this->Usu_Estado = $Usu_Estado;
    $this->tabla = "usuarios";
  }

  function getUsu_Codigo() {
    return $this->Usu_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getUsu_Usuario() {
    return $this->Usu_Usuario;
  }

  function getUsu_Contrasena() {
    return $this->Usu_Contrasena;
  }

  function getUsu_Documento() {
    return $this->Usu_Documento;
  }

  function getUsu_Nombres() {
    return $this->Usu_Nombres;
  }

  function getUsu_Apellidos() {
    return $this->Usu_Apellidos;
  }

  function getUsu_Foto() {
    return $this->Usu_Foto;
  }

  function getUsu_Rol() {
    return $this->Usu_Rol;
  }

  function getUsu_Cargo() {
    return $this->Usu_Cargo;
  }

  function getUsu_Correo() {
    return $this->Usu_Correo;
  }

  function getUsu_TelMovil() {
    return $this->Usu_TelMovil;
  }

  function getUsu_UsuarioCrea() {
    return $this->Usu_UsuarioCrea;
  }

  function getUsu_FechaHoraCrea() {
    return $this->Usu_FechaHoraCrea;
  }

  function getUsu_Estado() {
    return $this->Usu_Estado;
  }

  function setUsu_Codigo( $Usu_Codigo ) {
    $this->Usu_Codigo = $Usu_Codigo;
  }

  function setPla_Codigo( $Pla_Codigo ) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setUsu_Usuario( $Usu_Usuario ) {
    $this->Usu_Usuario = $Usu_Usuario;
  }

  function setUsu_Contrasena( $Usu_Contrasena ) {
    $this->Usu_Contrasena = md5( $Usu_Contrasena );
  }

  function setUsu_Documento( $Usu_Documento ) {
    $this->Usu_Documento = $Usu_Documento;
  }

  function setUsu_Nombres( $Usu_Nombres ) {
    $this->Usu_Nombres = $Usu_Nombres;
  }

  function setUsu_Apellidos( $Usu_Apellidos ) {
    $this->Usu_Apellidos = $Usu_Apellidos;
  }

  function setUsu_Foto( $Usu_Foto ) {
    $this->Usu_Foto = $Usu_Foto;
  }

  function setUsu_Rol( $Usu_Rol ) {
    $this->Usu_Rol = $Usu_Rol;
  }

  function setUsu_Cargo( $Usu_Cargo ) {
    $this->Usu_Cargo = $Usu_Cargo;
  }

  function setUsu_Correo( $Usu_Correo ) {
    $this->Usu_Correo = $Usu_Correo;
  }

  function setUsu_TelMovil( $Usu_TelMovil ) {
    $this->Usu_TelMovil = $Usu_TelMovil;
  }

  function setUsu_UsuarioCrea( $Usu_UsuarioCrea ) {
    $this->Usu_UsuarioCrea = $Usu_UsuarioCrea;
  }

  function setUsu_FechaHoraCrea( $Usu_FechaHoraCrea ) {
    $this->Usu_FechaHoraCrea = $Usu_FechaHoraCrea;
  }

  function setUsu_Estado( $Usu_Estado ) {
    $this->Usu_Estado = $Usu_Estado;
  }

  public function insertar() {
    $campos = array( "Pla_Codigo", "Usu_Usuario", "Usu_Contrasena", "Usu_Documento", "Usu_Nombres", "Usu_Apellidos", "Usu_Foto", "Usu_Rol", "Usu_Cargo", "Usu_Correo", "Usu_TelMovil", "Usu_UsuarioCrea", "Usu_FechaHoraCrea", "Usu_Estado" );
    $valores = array(
      array(
        $this->Pla_Codigo,
        $this->Usu_Usuario,
        $this->Usu_Contrasena,
        $this->Usu_Documento,
        $this->Usu_Nombres,
        $this->Usu_Apellidos,
        $this->Usu_Foto,
        $this->Usu_Rol,
        $this->Usu_Cargo,
        $this->Usu_Correo,
        $this->Usu_TelMovil,
        $this->Usu_UsuarioCrea,
        $this->Usu_FechaHoraCrea,
        $this->Usu_Estado
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
    $sql = "SELECT * FROM usuarios WHERE Usu_Codigo = :cod";
    $parametros = array( ":cod" => $this->Usu_Codigo );
    if ( $this->consultaSQL( $sql, $parametros ) ) {
      $res = $this->cargarRegistro();

      $this->setPla_Codigo( $res[ 1 ] );
      $this->setUsu_Usuario( $res[ 2 ] );
      $this->setUsu_Contrasena( $res[ 3 ] );
      $this->setUsu_Documento( $res[ 4 ] );
      $this->setUsu_Nombres( $res[ 5 ] );
      $this->setUsu_Apellidos( $res[ 6 ] );
      $this->setUsu_Foto( $res[ 7 ] );
      $this->setUsu_Rol( $res[ 8 ] );
      $this->setUsu_Cargo( $res[ 9 ] );
      $this->setUsu_Correo( $res[ 10 ] );
      $this->setUsu_TelMovil( $res[ 11 ] );
      $this->setUsu_UsuarioCrea( $res[ 12 ] );
      $this->setUsu_FechaHoraCrea( $res[ 13 ] );
      $this->setUsu_Estado( $res[ 14 ] );

      $this->desconectar();
    }
  }

  public function actualizar() {
    $campos = array( "Pla_Codigo", "Usu_Usuario", "Usu_Documento", "Usu_Nombres", "Usu_Apellidos", "Usu_Foto", "Usu_Rol", "Usu_Cargo", "Usu_Correo", "Usu_TelMovil", "Usu_UsuarioCrea", "Usu_FechaHoraCrea", "Usu_Estado" );
    $valores = array( $this->getPla_Codigo(), $this->getUsu_Usuario(), $this->getUsu_Documento(), $this->getUsu_Nombres(), $this->getUsu_Apellidos(), $this->getUsu_Foto(), $this->getUsu_Rol(), $this->getUsu_Cargo(), $this->getUsu_Correo(), $this->getUsu_TelMovil(), $this->getUsu_UsuarioCrea(), $this->getUsu_FechaHoraCrea(), $this->getUsu_Estado() );
    $llaveprimaria = "Usu_Codigo";
    $valorllaveprimaria = $this->getUsu_Codigo();
    $res = $this->actualizarRegistros( $campos, $valores, $llaveprimaria, $valorllaveprimaria );
    $this->desconectar();
    return $res;
  }

  public function eliminar() {
    $sql = "DELETE FROM usuarios WHERE Usu_Codigo = :cod";
    $parametros = array( ":cod" => $this->Usu_Codigo );
    $res = $this->consultaSQL( $sql, $parametros );
    $this->desconectar();
    return $res;
  }
  /*
    Autor: Dayanna Castaño
    Fecha: 
    Descripción:
    Parámetros:
    */
  public function validar() {
    $sql = "SELECT Usu_Codigo, Usu_Nombres, Usu_Apellidos, Usu_Estado, Usu_Rol FROM usuarios WHERE Usu_Usuario = :usu AND Usu_Contrasena = :cla AND Usu_Estado = 1";
    $parametros = array( ":usu" => $this->Usu_Usuario, ":cla" => $this->Usu_Contrasena );

    if ( $this->consultaSQL( $sql, $parametros ) ) {
      $res = $this->cargarRegistro();

      $this->setUsu_Codigo( $res[ 0 ] );
      $this->setUsu_Nombres( $res[ 1 ] );
      $this->setUsu_Apellidos( $res[ 2 ] );
      $this->setUsu_Estado( $res[ 3 ] );
      $this->setUsu_Rol( $res[ 4 ] );

      $this->desconectar();

      if ( $res == NULL ) {
        return false;
      } else {
        return true;
      }
    }
    $this->desconectar();
    return false;
  }

  /*
  Autor: Natalia Rodríguez
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function listarUsuarios($planta, $usuario) {
    
    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT usuarios.Usu_Codigo, Pla_Nombre, Usu_Usuario, Usu_Documento, CONCAT_WS(' ', Usu_Nombres, Usu_Apellidos) AS Nombre,
      Usu_Rol, parametros.Par_Nombre, Usu_Correo, Usu_TelMovil, usuarios.Pla_Codigo
      FROM usuarios
      INNER JOIN plantas_usuarios ON usuarios.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
      INNER JOIN plantas ON usuarios.Pla_Codigo = plantas.Pla_Codigo
      LEFT JOIN parametros ON usuarios.Usu_Cargo = parametros.Par_Codigo 
      WHERE Usu_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu";
    
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
    
    $sql .= " ORDER BY Pla_Nombre ASC";

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
  public function cambiarClave( $nuevaclave ) {
    $sql = "UPDATE usuarios SET Usu_Contrasena = :cla WHERE Usu_Usuario = :usu";
    $parametros = array( ":cla" => md5( $nuevaclave ), ":usu" => $this->Usu_Usuario );

    $this->consultaSQL( $sql, $parametros );
    $this->desconectar();
  }

  /*
  Autor: Dayanna Castaño
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function restaurarClave( $codigo, $nuevaclave ) {
    $sql = "UPDATE usuarios SET Usu_Contrasena = :cla WHERE Usu_Codigo = :cod";
    $parametros = array( ":cla" => md5( $nuevaclave ), ":cod" => $codigo );

    $this->consultaSQL( $sql, $parametros );
    $this->desconectar();
  }
  
  /*
  Autor: RxDavid
  Fecha: 
  Descripción:
  Parámetros:
  */
  public function hallarCodigoUsuarioCrea($usuario, $cedula){

    $parametros = array(":usu"=>$usuario, ":ced"=>$cedula);

    $sql = "SELECT usuarios.Usu_Codigo
    FROM usuarios
    WHERE Usu_UsuarioCrea = :usu AND Usu_Documento = :ced AND Usu_Estado = 1
    ORDER BY usuarios.Usu_Codigo DESC
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
  public function listarUsuariosBitacora($planta){
    
    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Usu_Codigo, CONCAT_WS(' ', Usu_Nombres, Usu_Apellidos) AS Nombre
    FROM usuarios
    WHERE Usu_Rol = 4 AND Usu_Estado = 1 AND Pla_Codigo = :pla
    ORDER BY Usu_Nombres, Usu_Apellidos ASC";

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
  public function listarSupervisoresHealthCheck($planta){
    
    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Usu_Codigo, CONCAT_WS(' ', Usu_Nombres, Usu_Apellidos) AS Nombre
    FROM usuarios
    WHERE (Usu_Rol = 3 OR Usu_Rol = 4) AND Usu_Estado = 1 AND Pla_Codigo = :pla
    ORDER BY Usu_Nombres, Usu_Apellidos ASC";

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
  public function listarSupervisoresPAC($planta){
    
    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Usu_Codigo, CONCAT_WS(' ', Usu_Nombres, Usu_Apellidos) AS Nombre
    FROM usuarios
    WHERE (Usu_Rol = 3 OR Usu_Rol = 4) AND Usu_Estado = 1 AND Pla_Codigo = :pla
    ORDER BY Usu_Nombres, Usu_Apellidos ASC";

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
  public function listarOperadoresHealthCheck($planta){
    
    $parametros = array(":pla"=>$planta);

    $sql = "SELECT Usu_Codigo, CONCAT_WS(' ', Usu_Nombres, Usu_Apellidos) AS nombre
    FROM usuarios
    WHERE Usu_Estado = 1 AND Usu_Rol IN (1,12) AND Pla_Codigo = :pla
    ORDER BY nombre ASC";

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
  public function listarUsuariosTodos($planta,$usuario){
    
    $parametros = array(":pla"=>$planta,":usu"=>$usuario);

    $sql = "SELECT usuarios.Usu_Codigo, CONCAT_WS(' ', Usu_Nombres, Usu_Apellidos) AS nombre
    FROM usuarios
    INNER JOIN plantas_usuarios ON usuarios.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    INNER JOIN plantas ON usuarios.Pla_Codigo = plantas.Pla_Codigo
    WHERE Usu_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND plantas.Pla_Codigo = :pla
    ORDER BY nombre ASC";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }

}
?>
