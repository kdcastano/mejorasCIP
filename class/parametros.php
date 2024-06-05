<?php
require_once( 'basedatos.php' );

class parametros extends basedatos {
  private $Par_Codigo;
  private $Pla_Codigo;
  private $Par_Nombre;
  private $Par_Tipo;
  private $Par_RelacionFT;
  private $Par_FechaHoraCrea;
  private $Par_UsuarioCrea;
  private $Par_Estado;

  function __construct( $Par_Codigo = NULL, $Pla_Codigo = NULL, $Par_Nombre = NULL, $Par_Tipo = NULL, $Par_RelacionFT = NULL, $Par_FechaHoraCrea = NULL, $Par_UsuarioCrea = NULL, $Par_Estado = NULL ) {
    $this->Par_Codigo = $Par_Codigo;
    $this->Pla_Codigo = $Pla_Codigo;
    $this->Par_Nombre = $Par_Nombre;
    $this->Par_Tipo = $Par_Tipo;
    $this->Par_RelacionFT = $Par_RelacionFT;
    $this->Par_FechaHoraCrea = $Par_FechaHoraCrea;
    $this->Par_UsuarioCrea = $Par_UsuarioCrea;
    $this->Par_Estado = $Par_Estado;
    $this->tabla = "parametros";
  }

  function getPar_Codigo() {
    return $this->Par_Codigo;
  }

  function getPla_Codigo() {
    return $this->Pla_Codigo;
  }

  function getPar_Nombre() {
    return $this->Par_Nombre;
  }

  function getPar_Tipo() {
    return $this->Par_Tipo;
  }

  function getPar_RelacionFT() {
    return $this->Par_RelacionFT;
  }

  function getPar_FechaHoraCrea() {
    return $this->Par_FechaHoraCrea;
  }

  function getPar_UsuarioCrea() {
    return $this->Par_UsuarioCrea;
  }

  function getPar_Estado() {
    return $this->Par_Estado;
  }

  function setPar_Codigo( $Par_Codigo ) {
    $this->Par_Codigo = $Par_Codigo;
  }

  function setPla_Codigo( $Pla_Codigo ) {
    $this->Pla_Codigo = $Pla_Codigo;
  }

  function setPar_Nombre( $Par_Nombre ) {
    $this->Par_Nombre = $Par_Nombre;
  }

  function setPar_Tipo( $Par_Tipo ) {
    $this->Par_Tipo = $Par_Tipo;
  }

  function setPar_RelacionFT( $Par_RelacionFT ) {
    $this->Par_RelacionFT = $Par_RelacionFT;
  }

  function setPar_FechaHoraCrea( $Par_FechaHoraCrea ) {
    $this->Par_FechaHoraCrea = $Par_FechaHoraCrea;
  }

  function setPar_UsuarioCrea( $Par_UsuarioCrea ) {
    $this->Par_UsuarioCrea = $Par_UsuarioCrea;
  }

  function setPar_Estado( $Par_Estado ) {
    $this->Par_Estado = $Par_Estado;
  }

  public function insertar() {
    $campos = array( "Pla_Codigo", "Par_Nombre", "Par_Tipo", "Par_RelacionFT", "Par_FechaHoraCrea", "Par_UsuarioCrea", "Par_Estado" );
    $valores = array(
      array(
        $this->Pla_Codigo,
        $this->Par_Nombre,
        $this->Par_Tipo,
        $this->Par_RelacionFT,
        $this->Par_FechaHoraCrea,
        $this->Par_UsuarioCrea,
        $this->Par_Estado
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
    $sql = "SELECT * FROM parametros WHERE Par_Codigo = :cod";
    $parametros = array( ":cod" => $this->Par_Codigo );
    if ( $this->consultaSQL( $sql, $parametros ) ) {
      $res = $this->cargarRegistro();

      $this->setPla_Codigo( $res[ 1 ] );
      $this->setPar_Nombre( $res[ 2 ] );
      $this->setPar_Tipo( $res[ 3 ] );
      $this->setPar_RelacionFT( $res[ 4 ] );
      $this->setPar_FechaHoraCrea( $res[ 5 ] );
      $this->setPar_UsuarioCrea( $res[ 6 ] );
      $this->setPar_Estado( $res[ 7 ] );

      $this->desconectar();
    }
  }

  public function actualizar() {
    $campos = array( "Pla_Codigo", "Par_Nombre", "Par_Tipo", "Par_RelacionFT", "Par_FechaHoraCrea", "Par_UsuarioCrea", "Par_Estado" );
    $valores = array( $this->getPla_Codigo(), $this->getPar_Nombre(), $this->getPar_Tipo(), $this->getPar_RelacionFT(), $this->getPar_FechaHoraCrea(), $this->getPar_UsuarioCrea(), $this->getPar_Estado() );
    $llaveprimaria = "Par_Codigo";
    $valorllaveprimaria = $this->getPar_Codigo();
    $res = $this->actualizarRegistros( $campos, $valores, $llaveprimaria, $valorllaveprimaria );
    $this->desconectar();
    return $res;
  }

  public function eliminar() {
    $sql = "DELETE FROM parametros WHERE Par_Codigo = :cod";
    $parametros = array( ":cod" => $this->Par_Codigo );
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
  public function listarParametrosPrincipal( $planta, $estado, $usuario, $tipo ) {

    $parametros = array( ":est" => $estado, ":usu" => $usuario );

    $sql = "SELECT Par_Codigo, Pla_Nombre, Par_Nombre, 
      IF( Par_Tipo = 1, 'Unidades de Medida',
		    IF( Par_Tipo = 7, 'Efectos FT',
		      IF( Par_Tipo = 2, 'Estados Programacion',
			     IF( Par_Tipo = 3, 'Grupo',
			       IF( Par_Tipo = 8, 'Insumo',
				      IF( Par_Tipo = 4, 'Distribución',
				        IF( Par_Tipo = 5, 'Marca',
					       IF( Par_Tipo = 6, 'Cargo', 
          	       IF( Par_Tipo = 9, 'Tipo Defecto ( Plan de acción)', 
                    IF( Par_Tipo = 10, 'Prioridad ( Plan de acción)',  
                      IF( Par_Tipo = 11, 'Defectos de segunda',  
                        IF( Par_Tipo = 12, 'Defectos de rotura', 
                          IF( Par_Tipo = 13, 'Lados',
                            IF( Par_Tipo = 14, 'Estampos / punzón', 'No existe tipo' 
                            )
                          )
                        )
                      )
                    )
                  )
                )
              )
				    )
			     )
			   )
		    )
		  )
	  ) as Tipo, Par_Estado
	 FROM parametros
	 INNER JOIN plantas ON parametros.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
	 INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
	 WHERE Par_Estado = :est AND plantas_usuarios.Usu_Codigo = :usu";

    if ( $planta != "" ) {
      $pri = 1;
      foreach ( $planta as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " parametros.Pla_Codigo = :pla" . $pri . " ";
        $parametros[ ':pla' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }

    if ( $tipo != "" ) {
      $pri = 1;
      foreach ( $tipo as $registro ) {
        if ( $pri == "1" ) {
          $sql .= " AND (";
        } else {
          $sql .= " OR ";
        }
        $sql .= " Par_Tipo = :tip" . $pri . " ";
        $parametros[ ':tip' . $pri ] = $registro;
        $pri++;
      }
      $sql .= " )";
    }

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
  public function listarParametrosTipoUsuario( $usuario, $tipo ) {

    $parametros = array( ":usu" => $usuario, ":tip" => $tipo );

    $sql = "SELECT Par_Codigo, Par_Nombre
    FROM parametros
    INNER JOIN plantas ON parametros.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE parametros.Par_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND parametros.Par_Tipo = :tip
    ORDER BY Par_Nombre ASC";

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
  public function listarParametrosTipoUsuarioMultiple( $usuario, $tipo ) {

    $parametros = array( ":usu" => $usuario);

    $sql = "SELECT Par_Codigo, Par_Nombre, parametros.Par_Tipo
    FROM parametros
    INNER JOIN plantas ON parametros.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE parametros.Par_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu ";
    
    if($tipo != ""){ 
      $pri = 1; 
      foreach($tipo as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= " parametros.Par_Tipo = :tip".$pri." "; 
        $parametros[':tip'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY Par_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarCargosUsuario( $planta, $usuario ) {

    $parametros = array( ":pla" => $planta, ":usu" => $usuario );

    $sql = "SELECT Par_Codigo, Par_Nombre
    FROM parametros
    INNER JOIN plantas ON parametros.Pla_Codigo = plantas.Pla_Codigo AND plantas.Pla_Estado = 1
    INNER JOIN plantas_usuarios ON plantas.Pla_Codigo = plantas_usuarios.Pla_Codigo AND plantas_usuarios.PlaU_Estado = 1
    WHERE parametros.Pla_Codigo = :pla AND parametros.Par_Estado = 1 AND plantas_usuarios.Usu_Codigo = :usu AND parametros.Par_Tipo = 6
    ORDER BY Par_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function FiltroParametrosUsuario() {

    $parametros = array( ":usu" => $usuario );

    $sql = "SELECT DISTINCT Par_Tipo,
       IF( Par_Tipo = 1, 'Unidades de Medida',
        IF( Par_Tipo = 7, 'Efectos FT',
          IF( Par_Tipo = 2, 'Estados Programacion',
            IF( Par_Tipo = 3, 'Grupo',
              IF( Par_Tipo = 8, 'Insumo',
                IF( Par_Tipo = 4, 'Distribución',
                  IF( Par_Tipo = 5, 'Marca',
                    IF( Par_Tipo = 6, 'Cargo', 
                      IF( Par_Tipo = 9, 'Tipo Defecto ( Plan de acción)', 
                        IF( Par_Tipo = 10, 'Prioridad ( Plan de acción)',  
                          IF( Par_Tipo = 11, 'Defectos de segunda',  
                            IF( Par_Tipo = 12, 'Defectos de rotura', 
                              IF( Par_Tipo = 13, 'Lados',
                                IF( Par_Tipo = 14, 'Estampos / punzón', 'No existe tipo' 
                                )
                              )
                            )
                          )
                        )
                      )
                    )
                  )
                )
              )
            )
          )
        )
      )as Tipo
     FROM parametros
     WHERE Par_Estado = 1 ";

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
  public function listarInsumosFT( $tipoEfecto ) {

    $parametros = array( ":tip" => $tipoEfecto );

    $sql = "SELECT Par_Codigo, Par_Nombre 
    FROM parametros
    WHERE Par_Tipo = 8 AND Par_RelacionFT = :tip AND Par_Estado = '1'
    ORDER BY Par_Nombre ASC";

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
  public function listarInsumosFTNPlanta( $tipoEfecto, $planta ) {

    $parametros = array( ":tip" => $tipoEfecto, ":pla" => $planta );

    $sql = "SELECT Par_Codigo, Par_Nombre 
    FROM parametros
    WHERE Par_Tipo = 8 AND Par_RelacionFT = :tip AND Pla_Codigo = :pla AND Par_Estado = '1'
    ORDER BY Par_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function listarEfectosFT($planta) {
	  
	$parametros = array( ":pla" => $planta );

    $sql = "SELECT Par_Codigo, Par_Nombre 
    FROM parametros
    WHERE Par_Tipo = 7 AND Par_Estado = 1 AND Pla_Codigo = :pla ORDER BY Par_Nombre ASC";

    $this->consultaSQL( $sql, $parametros);
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
  public function buscarCodTipoEfecto( $nombreInsumo ) {

    $parametros = array( ":nom" => $nombreInsumo );

    $sql = "SELECT Par_Codigo, Par_Nombre, Par_RelacionFT
    FROM parametros
    WHERE Par_Tipo = 8 AND Par_Nombre = :nom
    ORDER BY Par_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
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
  public function buscarCodTipoEfectoFTN( $nombreInsumo, $planta) {

    $parametros = array( ":nom" => $nombreInsumo, ":pla" => $planta );

    $sql = "SELECT Par_Codigo, Par_Nombre
    FROM parametros
    WHERE Par_Tipo = 7 AND Par_Nombre = :nom AND Pla_Codigo = :pla AND Par_Estado = '1'
    ORDER BY Par_Nombre ASC";

    $this->consultaSQL( $sql, $parametros );
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
}
?>


