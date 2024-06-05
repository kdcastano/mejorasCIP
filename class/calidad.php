<?php
require_once('basedatos.php');

  class calidad extends basedatos {
    private $Cal_Codigo;
    private $Are_Codigo;
    private $Cal_Nombre;
    private $Cal_ValorCritico;
    private $Cal_Tolerancia;
    private $Cal_Operador;
    private $Cal_TomaDefectos;
    private $Cal_Ordenamiento;
    private $Cal_AgrupadorSuma;
    private $Cal_FechaHoraCrea;
    private $Cal_UsuarioCrea;
    private $Cal_Estado;

  function __construct($Cal_Codigo = NULL, $Are_Codigo = NULL, $Cal_Nombre = NULL, $Cal_ValorCritico = NULL, $Cal_Tolerancia = NULL, $Cal_Operador = NULL, $Cal_TomaDefectos = NULL, $Cal_Ordenamiento = NULL, $Cal_AgrupadorSuma = NULL, $Cal_FechaHoraCrea = NULL, $Cal_UsuarioCrea = NULL, $Cal_Estado = NULL) {
    $this->Cal_Codigo = $Cal_Codigo;
    $this->Are_Codigo = $Are_Codigo;
    $this->Cal_Nombre = $Cal_Nombre;
    $this->Cal_ValorCritico = $Cal_ValorCritico;
    $this->Cal_Tolerancia = $Cal_Tolerancia;
    $this->Cal_Operador = $Cal_Operador;
    $this->Cal_TomaDefectos = $Cal_TomaDefectos;
    $this->Cal_Ordenamiento = $Cal_Ordenamiento;
    $this->Cal_AgrupadorSuma = $Cal_AgrupadorSuma;
    $this->Cal_FechaHoraCrea = $Cal_FechaHoraCrea;
    $this->Cal_UsuarioCrea = $Cal_UsuarioCrea;
    $this->Cal_Estado = $Cal_Estado;
    $this->tabla = "calidad";
  }

  function getCal_Codigo() {
    return $this->Cal_Codigo;
  }

  function getAre_Codigo() {
    return $this->Are_Codigo;
  }

  function getCal_Nombre() {
    return $this->Cal_Nombre;
  }

  function getCal_ValorCritico() {
    return $this->Cal_ValorCritico;
  }

  function getCal_Tolerancia() {
    return $this->Cal_Tolerancia;
  }

  function getCal_Operador() {
    return $this->Cal_Operador;
  }

  function getCal_TomaDefectos() {
    return $this->Cal_TomaDefectos;
  }

  function getCal_Ordenamiento() {
    return $this->Cal_Ordenamiento;
  }

  function getCal_AgrupadorSuma() {
    return $this->Cal_AgrupadorSuma;
  }

  function getCal_FechaHoraCrea() {
    return $this->Cal_FechaHoraCrea;
  }

  function getCal_UsuarioCrea() {
    return $this->Cal_UsuarioCrea;
  }

  function getCal_Estado() {
    return $this->Cal_Estado;
  }

  function setCal_Codigo($Cal_Codigo) {
    $this->Cal_Codigo = $Cal_Codigo;
  }

  function setAre_Codigo($Are_Codigo) {
    $this->Are_Codigo = $Are_Codigo;
  }

  function setCal_Nombre($Cal_Nombre) {
    $this->Cal_Nombre = $Cal_Nombre;
  }

  function setCal_ValorCritico($Cal_ValorCritico) {
    $this->Cal_ValorCritico = $Cal_ValorCritico;
  }

  function setCal_Tolerancia($Cal_Tolerancia) {
    $this->Cal_Tolerancia = $Cal_Tolerancia;
  }

  function setCal_Operador($Cal_Operador) {
    $this->Cal_Operador = $Cal_Operador;
  }

  function setCal_TomaDefectos($Cal_TomaDefectos) {
    $this->Cal_TomaDefectos = $Cal_TomaDefectos;
  }

  function setCal_Ordenamiento($Cal_Ordenamiento) {
    $this->Cal_Ordenamiento = $Cal_Ordenamiento;
  }

  function setCal_AgrupadorSuma($Cal_AgrupadorSuma) {
    $this->Cal_AgrupadorSuma = $Cal_AgrupadorSuma;
  }

  function setCal_FechaHoraCrea($Cal_FechaHoraCrea) {
    $this->Cal_FechaHoraCrea = $Cal_FechaHoraCrea;
  }

  function setCal_UsuarioCrea($Cal_UsuarioCrea) {
    $this->Cal_UsuarioCrea = $Cal_UsuarioCrea;
  }

  function setCal_Estado($Cal_Estado) {
    $this->Cal_Estado = $Cal_Estado;
  }

  public function insertar(){
    $campos = array("Are_Codigo", "Cal_Nombre", "Cal_ValorCritico", "Cal_Tolerancia", "Cal_Operador", "Cal_TomaDefectos", "Cal_Ordenamiento", "Cal_AgrupadorSuma", "Cal_FechaHoraCrea", "Cal_UsuarioCrea", "Cal_Estado");
    $valores = array(
    array( 
      $this->Are_Codigo, 
      $this->Cal_Nombre, 
      $this->Cal_ValorCritico, 
      $this->Cal_Tolerancia, 
      $this->Cal_Operador, 
      $this->Cal_TomaDefectos, 
      $this->Cal_Ordenamiento, 
      $this->Cal_AgrupadorSuma, 
      $this->Cal_FechaHoraCrea, 
      $this->Cal_UsuarioCrea, 
      $this->Cal_Estado
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
    $sql =  "SELECT * FROM calidad WHERE Cal_Codigo = :cod";
    $parametros = array(":cod"=>$this->Cal_Codigo);
    if($this->consultaSQL($sql, $parametros)){
      $res = $this->cargarRegistro();

      $this->setAre_Codigo($res[1]);
      $this->setCal_Nombre($res[2]);
      $this->setCal_ValorCritico($res[3]);
      $this->setCal_Tolerancia($res[4]);
      $this->setCal_Operador($res[5]);
      $this->setCal_TomaDefectos($res[6]);
      $this->setCal_Ordenamiento($res[7]);
      $this->setCal_AgrupadorSuma($res[8]);
      $this->setCal_FechaHoraCrea($res[9]);
      $this->setCal_UsuarioCrea($res[10]);
      $this->setCal_Estado($res[11]);

      $this->desconectar();
     }
  }

  public function actualizar(){
    $campos = array("Are_Codigo", "Cal_Nombre", "Cal_ValorCritico", "Cal_Tolerancia", "Cal_Operador", "Cal_TomaDefectos", "Cal_Ordenamiento", "Cal_AgrupadorSuma", "Cal_FechaHoraCrea", "Cal_UsuarioCrea", "Cal_Estado");
    $valores = array($this->getAre_Codigo(), $this->getCal_Nombre(), $this->getCal_ValorCritico(), $this->getCal_Tolerancia(), $this->getCal_Operador(), $this->getCal_TomaDefectos(), $this->getCal_Ordenamiento(), $this->getCal_AgrupadorSuma(), $this->getCal_FechaHoraCrea(), $this->getCal_UsuarioCrea(), $this->getCal_Estado());
    $llaveprimaria = "Cal_Codigo";
    $valorllaveprimaria = $this->getCal_Codigo();
    $res = $this->actualizarRegistros($campos, $valores, $llaveprimaria, $valorllaveprimaria);
    $this->desconectar();
    return $res;
  }

  public function eliminar(){
    $sql = "DELETE FROM calidad WHERE Cal_Codigo = :cod";
    $parametros = array(":cod"=>$this->Cal_Codigo);
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
  public function listarCalidadGeneral($planta, $estado){

    $parametros = array(":est"=>$estado);

    $sql = "SELECT Cal_Codigo, plantas.Pla_Nombre, Are_Nombre, Cal_Nombre, Cal_ValorCritico, Cal_Tolerancia,
    IF(Cal_TomaDefectos = 1, 'Primera',
      IF(Cal_TomaDefectos = 2, 'Segunda',
       IF(Cal_TomaDefectos = 3, 'Rotura', 
         IF(Cal_TomaDefectos = 4, 'No aplica', 
          IF(Cal_TomaDefectos = 5, 'Segunda Planar',
           IF(Cal_TomaDefectos = 6, 'Segunda Liner',
            IF(Cal_TomaDefectos = 7, 'Retal Planar', 
             IF(Cal_TomaDefectos = 8, 'Retal liner', 'Ninguna')
            )
           )
         )
        )
       )
      )
     ) AS Defecto, 
    IF(Cal_Operador = 1, '>=',
      IF(Cal_Operador = 2, '<=',
          IF(Cal_Operador = 3, '+-', 'Sin operador'
          )
        )
      ) AS Operador, Cal_Ordenamiento,     
      IF(Cal_AgrupadorSuma = 1, 'Segunda Global',
        IF(Cal_AgrupadorSuma = 2, 'Rotura Clasificada',
          IF(Cal_AgrupadorSuma = 3, 'Primera', 'Sin agrupador'
          )
        )
      ) AS Agrupador
    FROM calidad
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND Pla_Estado = 1
    WHERE Cal_Estado = :est ";
    
    if($planta != "null"){ 
      $pri = 1; 
      foreach($planta as $registro){ 
        if($pri == "1"){ 
          $sql .= " AND (";  
        }else{ 
          $sql .= " OR "; 
        } 
        $sql .= "  plantas.Pla_Codigo = :pla".$pri." "; 
        $parametros[':pla'.$pri] = $registro; 
        $pri++; 
      } 
      $sql .= " )"; 
    }
    
    $sql .= " ORDER BY Are_Nombre, Cal_TomaDefectos, Cal_Ordenamiento ASC";

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
  public function listarCalidadGeneralTomaVariablesCalidad($planta, $estado){

    $parametros = array(":est"=>$estado, ":pla"=>$planta);

    $sql = "SELECT Cal_Codigo, plantas.Pla_Nombre, Are_Nombre, Cal_Nombre, Cal_ValorCritico, Cal_Tolerancia,
    IF(Cal_TomaDefectos = 1, 'Primera',
      IF(Cal_TomaDefectos = 2, 'Segunda',
       IF(Cal_TomaDefectos = 3, 'Rotura', 
         IF(Cal_TomaDefectos = 4, 'No aplica', 
          IF(Cal_TomaDefectos = 5, 'Segunda Planar',
           IF(Cal_TomaDefectos = 6, 'Segunda Liner',
            IF(Cal_TomaDefectos = 7, 'Retal Planar', 
             IF(Cal_TomaDefectos = 8, 'Retal liner', 'Ninguna')
            )
           )
         )
        )
       )
      )
     ) AS Defecto, 
    IF(Cal_Operador = 1, '>=',
      IF(Cal_Operador = 2, '<=',
          IF(Cal_Operador = 3, '+-', 'Sin operador'
          )
        )
      ) AS Operador, Cal_Ordenamiento,     
      IF(Cal_AgrupadorSuma = 1, 'Segunda Global',
        IF(Cal_AgrupadorSuma = 2, 'Rotura Clasificada',
          IF(Cal_AgrupadorSuma = 3, 'Primera', 'Sin agrupador'
          )
        )
      ) AS Agrupador
    FROM calidad
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1
    INNER JOIN plantas ON areas.Pla_Codigo = plantas.Pla_Codigo AND Pla_Estado = 1
    WHERE Cal_Estado = :est AND plantas.Pla_Codigo = :pla ORDER BY Are_Nombre, Cal_TomaDefectos, Cal_Ordenamiento ASC";

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
  public function listarUltimoRegistroCalidad($usuario){

    $parametros = array(":usu"=>$usuario);

    $sql = "SELECT Cal_Codigo
    FROM calidad
    WHERE Cal_Estado = 1 AND Cal_UsuarioCrea = :usu
    ORDER BY Cal_Codigo DESC
    LIMIT 1";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarRegistro();
    $this->desconectar();
    return $res;
  }
    
  /*
  Autor: RxDavid
  Fecha: 
  Descripción: NO MODIFICAR
  Parámetros:
  */
  public function listarVariablesCalidadPanelOperador($planta, $area){

    $parametros = array(":pla"=>$planta, ":are"=>$area);

    $sql = "SELECT Cal_Codigo, calidad.Are_Codigo, Cal_Nombre, Cal_ValorCritico, Cal_Tolerancia, Cal_TomaDefectos,
    IF(Cal_Operador = 1, '>=',
     IF(Cal_Operador = 2, '<=',
      IF(Cal_Operador = 3, '+-', 'Ninguna')
     )
    ) AS Operador, Cal_Operador, Cal_AgrupadorSuma
    FROM calidad
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo AND areas.Are_Estado = 1
    WHERE Cal_Estado = 1 AND areas.Pla_Codigo = :pla AND areas.Are_Codigo = :are
    ORDER BY Cal_Ordenamiento ASC";

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
  public function frecuenciaCantidadRegistrosAgrupacion($agrupacion){

    $parametros = array(":agr"=>$agrupacion);

    $sql = "SELECT COUNT(calidad.Cal_Codigo) AS Cant, FreC_Hora 
    FROM calidad  
    INNER JOIN areas ON calidad.Are_Codigo = areas.Are_Codigo AND Are_Estado = 1  
    INNER JOIN agrupaciones_areas ON areas.Are_Codigo = agrupaciones_areas.Are_Codigo AND agrupaciones_areas.AgrA_Estado = 1 
    INNER JOIN agrupaciones ON agrupaciones_areas.Agr_Codigo = agrupaciones.Agr_Codigo AND agrupaciones.Agr_Estado = 1 
    INNER JOIN frecuencias_calidad ON calidad.Cal_Codigo = frecuencias_calidad.Cal_Codigo 
    WHERE agrupaciones.Agr_Codigo = :agr AND Cal_Estado = 1 AND frecuencias_calidad.FreC_Estado = 1 
    GROUP BY FreC_Hora";

    $this->consultaSQL($sql, $parametros);
    $res = $this->cargarTodo();
    $this->desconectar();
    return $res;
  }
}
?>
