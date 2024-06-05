<?php
include( "op_sesion.php" );
include_once( "../class/usuarios.php" );
include_once( "../class/referencias.php" );
include("../class/puestos_trabajos.php");
include("../class/turnos.php");

$usuNom = new usuarios( $_SESSION[ 'CP_Usuario' ] );
$usuNom->consultar();

$resUsuSupervisor = $usu->listarSupervisoresHealthCheck($usuNom->getPla_Codigo());

$resOperador = $usu->listarOperadoresHealthCheck();
date_default_timezone_set( "America/Bogota" );
setlocale( LC_TIME, 'spanish' );

$fecha = date( "Y-m-d" );
$hora = date( "H:i:s" );

$ref = new referencias();
$resRef = $ref->filtroReferenciasHeathCheck($usuNom->getPla_Codigo());

$pueT = new puestos_trabajos();
if($_POST['agrupacion']){
  $resPueT = $pueT->listarPuestosTrabajoHCAgrupacion($_SESSION['CP_Usuario'],$_POST['agrupacion']);
}else{
  $resPueT = $pueT->listarPuestosTrabajoFiltros($_SESSION['CP_Usuario']);
}

$tur = new turnos();
$resTurPred = $tur->hallarTurnoSegunHora($usu->getPla_Codigo(), $hora);
  
if($resTurPred){
  $TurnoPrediccion = $resTurPred[0];
}else{
  $TurnoPrediccion = "";
}

$tur->setTur_Codigo($TurnoPrediccion);
$tur->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Crear Health Check</strong> </div>
      <div class="panel-body">
        <form id="f_healthCheckCrear" role="form">
          <input type="hidden" id="turnoHC" value="<?php echo $tur->getTur_Codigo(); ?>">
          <div class="table-responsive" id="imp_tabla">
            <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
              <thead>
                <tr class="encabezadoTab">
                  <th height="35" colspan="5" class="text-center vertical letra14" align="center">AUDITORÍA HEALTH-CHECK</th>
                </tr>
                <tr>
                  <th class="encabezadoTab vertical letra14" align="left">Fecha y hora:</th>
                  <th colspan="4"><input type="text" id="HeaC_fecha" class="form-control fecha" value="<?php echo $fecha." ".$hora; ?>"></th>
                </tr>
                <tr>
                  <th class="encabezadoTab vertical letra14" align="left">Evaluador:</th>
                  <th colspan="4"><input type="text" id="HeaC_Evaluador" class="form-control" value="<?php echo $usuNom->getUsu_Nombres()." ".$usuNom->getUsu_Apellidos(); ?>" disabled></th>
                </tr>
                <tr>
                  <th class="encabezadoTab vertical letra14" align="left">Supervisor de turno o equipo: </th>
                  <th> <select id="HeaC_Supervisor" class="form-control" required>
                      <option value="">Seleccione</option>
                      <?php foreach($resUsuSupervisor as $registro2){ ?>
                      <option value="<?php echo $registro2[0]; ?>"><?php echo $registro2[1]; ?></option>
                      <?php } ?>
                    </select>
                  </th>
                </tr>
                <tr>
                  <th class="encabezadoTab vertical letra14" align="left">Proceso a Evaluar:</th>
                  <th colspan="4">
                    <select id="HeaC_ProcesoEvaluar" class="form-control" required>
      
                        <option value="">Seleccione</option>
                      <?php foreach($resPueT as $registro4){ ?>
                        <option value="<?php echo $registro4[0]; ?>"><?php echo $registro4[1]; ?></option>
                      <?php } ?>
                    </select>
                  </th>
                </tr>
              </thead>
              <thead class="cargarInfodefectoHealthCheck"></thead>
            </table>
            <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
              <thead>
                <tr class="encabezadoTab">
                  <th width="27" height="35" class="text-center vertical" align="center">#</th>
                  <th width="138" align="center" class="text-center vertical">DIRECCIÓN DE LA PREGUNTA </th>
                  <th width="670" align="center" class="text-center vertical">PREGUNTA</th>
                  <th colspan="2" class="vertical text-center">CUMPLE</th>
                  <th width="216" align="center" class="text-center vertical">OBSERVACIÓN </th>
                </tr>
              </thead>
              <tbody class="buscar">
                <tr>
                  <td class="text-center vertical" align="center"> 1 </td>
                  <td rowspan="8" align="center" class="text-center vertical">Operador en  turno</td>
                  <td align="left" class="vertical">¿Todos los operadores de la línea realizan el registros de center line dentro de las horas del turno?</td>
                  <td width="50" class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador1" id="HeaC_Operador1" required>
                      SI </label></td>
                  <td width="50" class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador1" id="HeaC_Operador1" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario1"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 2 </td>
                  <td align="left" class="vertical">¿Todos los operadores tienen registrados graficamente los centerlines que se han definido?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador2" id="HeaC_Operador2" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador2" id="HeaC_Operador2" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario2"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 3 </td>
                  <td align="left" class="vertical">¿El operador reconoce cuando un center line se encuentra fuera de su valor objetivo?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador3" id="HeaC_Operador3" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador3" id="HeaC_Operador3" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario3"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 4 </td>
                  <td align="left" class="vertical">¿EL operador conoce la razón de por qué el center line se encuentra fuera de su valor objetivo?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador4" id="HeaC_Operador4" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador4" id="HeaC_Operador4" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario4"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 5 </td>
                  <td align="left" class="vertical">En caso de que un punto se encuentre fuera de especificación (zona Roja) , el personal sabe que acciones tomar</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador5" id="HeaC_Operador5" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador5" id="HeaC_Operador5" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario5"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 6 </td>
                  <td align="left" class="vertical">¿Para todo centerline reportado fuera de su valor objetivo existe un comentario sobre la posible causa y una acción contingente (inmediata)? </td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador6" id="HeaC_Operador6" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador6" id="HeaC_Operador6" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario6"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 7 </td>
                  <td align="left" class="vertical">¿El operador reporta cualquier ajuste realizado a los center line durante su turno?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador7" id="HeaC_Operador7" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador7" id="HeaC_Operador7" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario7"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 8 </td>
                  <td align="left" class="vertical">¿El valor registrado en el sistema de monitoreo coincide con el que se encuentra en la máquina?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador8" id="HeaC_Operador8" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Operador8" id="HeaC_Operador8" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario8"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 9 </td>
                  <td rowspan="6" align="center" class="text-center vertical">Supervisor</td>
                  <td align="left" class="vertical">¿En el caso de que algún center line muestre continuas desviaciones a las especificaciones existe un plan de acción definido?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Supervisor1" id="HeaC_Supervisor1" required>
                      SI </label></td>
                  <td class=" text-center vertical"><label>
                      <input type="radio" name="opcion_HeaC_Supervisor1" id="HeaC_Supervisor1" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario9"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 10 </td>
                  <td align="left" class="vertical">¿Se están monitoreando en un registro o gráficamente en el área todos los centerlines de acuerdo a lo establecido en el procedimiento operativo estandar (POE)?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Supervisor2" id="HeaC_Supervisor2" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Supervisor2" id="HeaC_Supervisor2" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario10"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 11 </td>
                  <td align="left" class="vertical">¿El Supervisor revisa y asegura que el monitoreo de las variables se realice dentro de las horas programadas del turno?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Supervisor3" id="HeaC_Supervisor3" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Supervisor3" id="HeaC_Supervisor3" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario11"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 12 </td>
                  <td align="left" class="vertical">¿El Supervisor conoce el estado de los center line de los diferentes equipos en el turno?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Supervisor4" id="HeaC_Supervisor4" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Supervisor4" id="HeaC_Supervisor4" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario12"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 13 </td>
                  <td align="left" class="vertical">¿El Supervisor registra cada turno los resultados del proceso, obtenidos en el reporte diario (% ejecucion y  % cumplimiento)?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Supervisor5" id="HeaC_Supervisor5" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Supervisor5" id="HeaC_Supervisor5" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario13"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 14 </td>
                  <td align="left" class="vertical">¿En alguna junta se revisan los resultados del proceso obtenidos por día?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Supervisor6" id="HeaC_Supervisor6" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_Supervisor6" id="HeaC_Supervisor6" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario14"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 15 </td>
                  <td rowspan="2" align="center" class="text-center vertical">Jefe de área</td>
                  <td align="left" class="vertical">¿El Jefe de área asegura que existen planes de acción para los center line que se encuentran fuera de especificación?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_jefe1" id="HeaC_jefe1" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_jefe1" id="HeaC_jefe1" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario15"></textarea></td>
                </tr>
                <tr>
                  <td class="text-center vertical" align="center"> 16 </td>
                  <td align="left" class="vertical">¿El jefe de área se asegura que los planes se ejecuten en tiempo y forma?</td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_jefe2" id="HeaC_jefe2" required>
                      SI </label></td>
                  <td class=" text-center vertical "><label>
                      <input type="radio" name="opcion_HeaC_jefe2" id="HeaC_jefe2" required>
                      NO </label></td>
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario16"></textarea></td>
                <tr>
                  <td height="35" class="encabezadoTab text-center vertical" colspan="6" align="center">COMENTARIOS:</td>
                </tr>
                <tr>
                  <td colspan="6"><textarea class="form-control" rows="3" id="HeaC_Comentarios"></textarea></td>
                </tr>
              </tbody>
            </table>
            <div class="referenciaObligatoria"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">cargarfecha();</script>