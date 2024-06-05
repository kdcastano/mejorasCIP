<?php 
include( "op_sesion.php" ); 
include( "../class/health_check.php" ); 
include_once( "../class/usuarios.php" );
include("../class/areas.php");
include_once( "../class/referencias.php" );
include("../class/puestos_trabajos.php");
include("../class/turnos.php");

$hor = new areas();
$resHor = $hor->listarAreasUsuarioSoloHornosHeathCheck($_SESSION['CP_Usuario']);
 
$hea = new health_check(); 
$hea->setHeaC_Codigo( $_POST[ 'codigo' ] ); 
$hea->consultar(); 
 
$usuEva = new usuarios(); 
$usuEva->setUsu_Codigo($hea->getHeaC_Evaluador());
$usuEva->consultar();
$resUsuSupervisor = $usu->listarSupervisoresHealthCheck($usuEva->getPla_Codigo());

$resOperador = $usu->listarOperadoresHealthCheck($usu->getPla_Codigo());
 
date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$ref = new referencias();
$resRef = $ref->filtroReferenciasHeathCheck($usu->getPla_Codigo());

$pueT = new puestos_trabajos();
$resPueT = $pueT->listarPuestosTrabajoFiltros($_SESSION['CP_Usuario']);

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
      <div class="panel-heading"> <strong>Actualizar Health Check</strong> </div> 
      <div class="panel-body"> 
        <form id="f_healthCheckActualizar" role="form"> 
          <input type="hidden" id="turnoHCAct" value="<?php echo $tur->getTur_Codigo(); ?>">
          <input type="hidden" id="codigoActualizar" value="<?php echo $_POST['codigo']; ?>"> 
          <div class="table-responsive" id="imp_tabla"> 
            <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped"> 
              <thead> 
                <tr class="encabezadoTab"> 
                  <th height="35" colspan="5" class="text-center vertical" align="center">AUDITORÍA HEALTH-CHECK</th> 
                </tr> 
                <tr> 
                  <th class="encabezadoTab vertical letra14" align="center">Fecha y hora:</th> 
                  <th colspan="4"><input type="text" id="HeaC_fechaAct" class="form-control fecha" value="<?php echo $hea->getHeaC_fecha(); ?>"></th> 
                </tr> 
                <tr> 
                  <th class="encabezadoTab vertical letra14" align="center">Evaluador:</th> 
                  <th colspan="4"><input type="text" id="HeaC_EvaluadorAct" class="form-control" value="<?php echo $usuEva->getUsu_Nombres()." ".$usuEva->getUsu_Apellidos(); ?>" disabled></th> 
                </tr>
                <tr> 
                  <th class="encabezadoTab vertical letra14" align="center">Supervisor de turno o equipo: </th> 
                  <th> <select id="HeaC_SupervisorAct" class="form-control" required> 
                      <?php foreach($resUsuSupervisor as $registro2){ ?> 
                      <option value="<?php echo $registro2[0]; ?>" <?php if($hea->getHeaC_Supervisor() ==  $registro2[0]) {echo "selected"; } ?>><?php echo $registro2[1]; ?></option> 
                      <?php } ?> 
                    </select> 
                  </th> 
                </tr>
                <tr>
                  <th class="encabezadoTab vertical letra14" align="left">Proceso a Evaluar:</th>
                  <th colspan="4">
                    
                     <select id="HeaC_ProcesoEvaluarAct" class="form-control" required>
                        <option value="">Seleccione</option>
                      <?php foreach($resPueT as $registro4){ ?>
                        <option value="<?php echo $registro4[0]; ?>" <?php echo $registro4[0] == $hea->getHeaC_ProcesoEvaluar() ? "selected":""; ?>><?php echo $registro4[1]; ?></option>
                      <?php } ?>
                    </select>
                    
                  </th>
                </tr>
                </thead> 
                <thead class="cambioPTAct"> 
                  <tr>
                    <th class="encabezadoTab vertical letra14" align="left">Referencia:</th>
                    <th colspan="4">
                      <select id="Ref_CodigoAct" class="form-control">
                        <option value="">Seleccione</option>
                        <option value="NULL">No aplica</option>
                        <?php foreach($resRef as $registro3){ ?>
                        <option value="<?php echo $registro3[0]; ?>" <?php echo $registro3[0] == $hea->getRef_Codigo() ? "selected":""; ?>><?php echo $registro3[1]; ?></option>
                        <?php } ?>
                      </select>
                    </th>
                  </tr>
                    <tr>
                    <th class="encabezadoTab vertical letra14" align="left">Operador: </th>
                    <th> <select id="Usu_CodigoHCAct" class="form-control" required>
                        <option value="">Seleccione</option>
                        <?php foreach($resOperador as $registro5){ ?>
                        <option value="<?php echo $registro5[0]; ?>" <?php if($hea->getUsu_Codigo() ==  $registro5[0]) {echo "selected"; } ?>><?php echo $registro5[1]; ?></option>
                        <?php } ?>
                      </select>
                    </th>
                  </tr>
                  <tr> 
                    <th class="encabezadoTab vertical letra14" align="center">Área: </th> 
                    <th colspan="4">  
                      <select id="HeaC_AreaAct" class="form-control" required> 
                        <option value="">Seleccione</option>
                        <option value="Molienda y Atomizado" <?php echo $hea->getHeaC_Area()=="Molienda y Atomizado"?"selected":""; ?>>Molienda y Atomizado</option>
                        <option value="Prensas" <?php echo $hea->getHeaC_Area()=="Prensas"?"selected":""; ?>>Prensas</option>
                        <option value="Secadero" <?php echo $hea->getHeaC_Area()=="Secadero"?"selected":""; ?>>Secadero</option>
                        <option value="Decorado" <?php echo $hea->getHeaC_Area()=="Decorado"?"selected":""; ?>>Decorado</option> 
                        <option value="Esmaltado" <?php echo $hea->getHeaC_Area()=="Esmaltado"?"selected":""; ?>>Esmaltado</option>
                        <option value="Horno" <?php echo $hea->getHeaC_Area()=="Horno"?"selected":""; ?>>Horno</option>
                        <option value="Calidad" <?php echo $hea->getHeaC_Area()=="Calidad"?"selected":""; ?>>Calidad</option>
                        <option value="Preparación Esmaltes" <?php echo $hea->getHeaC_Area()=="Preparación Esmaltes"?"selected":""; ?>>Preparación Esmaltes</option>
                        <option value="Laboratorio" <?php echo $hea->getHeaC_Area()=="Laboratorio"?"selected":""; ?>>Laboratorio</option>
                      </select>
                    </th> 
                  </tr>
                  <tr class="e_cargarHornosAct"> 
                    <?php if($hea->getHeaC_Area()=="Horno"){ ?>
                      <th class="encabezadoTab vertical letra14" align="center">Horno: </th> 
                      <th> 
                        <select id="Hor_CodigoAct" class="form-control"> 
                          <?php foreach($resHor as $registro){ ?> 
                          <option value="<?php echo $registro[1]; ?>" <?php if($hea->getHeaC_Horno() ==  $registro[1]) {echo "selected"; } ?>><?php echo $registro[1]; ?></option> 
                          <?php } ?> 
                        </select>
                      </th> 
                    <?php } ?>
                  </tr>                 
              </thead> 
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
                      <input type="radio" name="opcion_HeaC_Operador1" id="HeaC_Operador1Act" <?php if($hea->getHeaC_Operador1() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td width="50" class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador1" id="HeaC_Operador1Act" <?php if($hea->getHeaC_Operador1() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario1Act"><?php echo $hea->getHeaC_Comentarios1(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 2 </td> 
                  <td align="left" class="vertical">¿Todos los operadores tienen registrados graficamente los centerlines que se han definido?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador2" id="HeaC_Operador2Act" <?php if($hea->getHeaC_Operador2() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador2" id="HeaC_Operador2Act" <?php if($hea->getHeaC_Operador2() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario2Act"><?php echo $hea->getHeaC_Comentarios2(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 3 </td> 
                  <td align="left" class="vertical">¿El operador reconoce cuando un center line se encuentra fuera de su valor objetivo?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador3" id="HeaC_Operador3Act" <?php if($hea->getHeaC_Operador3() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador3" id="HeaC_Operador3Act" <?php if($hea->getHeaC_Operador3() == 0) { echo "checked"; } ?> required>NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario3Act"><?php echo $hea->getHeaC_Comentarios3(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 4 </td> 
                  <td align="left" class="vertical">¿EL operador conoce la razón de por qué el center line se encuentra fuera de su valor objetivo?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador4" id="HeaC_Operador4Act" <?php if($hea->getHeaC_Operador4() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador4" id="HeaC_Operador4Act" <?php if($hea->getHeaC_Operador4() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario4Act"><?php echo $hea->getHeaC_Comentarios4(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 5 </td> 
                  <td align="left" class="vertical">En caso de que un punto se encuentre fuera de especificación (zona Roja) , el personal sabe que acciones tomar</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador5" id="HeaC_Operador5Act" <?php if($hea->getHeaC_Operador5() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador5" id="HeaC_Operador5Act" <?php if($hea->getHeaC_Operador5() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario5Act"><?php echo $hea->getHeaC_Comentarios5(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 6 </td> 
                  <td align="left" class="vertical">¿Para todo centerline reportado fuera de su valor objetivo existe un comentario sobre la posible causa y una acción contingente (inmediata)? </td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador6" id="HeaC_Operador6Act" <?php if($hea->getHeaC_Operador6() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador6" id="HeaC_Operador6Act" <?php if($hea->getHeaC_Operador6() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario6Act"><?php echo $hea->getHeaC_Comentarios6(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 7 </td> 
                  <td align="left" class="vertical">¿El operador reporta cualquier ajuste realizado a los center line durante su turno?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador7" id="HeaC_Operador7Act" <?php if($hea->getHeaC_Operador7() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador7" id="HeaC_Operador7Act" <?php if($hea->getHeaC_Operador7() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario7Act"><?php echo $hea->getHeaC_Comentarios7(); ?></textarea></td>
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 8 </td> 
                  <td align="left" class="vertical">¿El valor registrado en el sistema de monitoreo coincide con el que se encuentra en la máquina?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador8" id="HeaC_Operador8Act" <?php if($hea->getHeaC_Operador8() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Operador8" id="HeaC_Operador8Act" <?php if($hea->getHeaC_Operador8() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario8Act"><?php echo $hea->getHeaC_Comentarios8(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 9 </td> 
                  <td rowspan="6" align="center" class="text-center vertical">Supervisor</td> 
                  <td align="left" class="vertical">¿En el caso de que algún center line muestre continuas desviaciones a las especificaciones existe un plan de acción definido?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor1" id="HeaC_Supervisor1Act" <?php if($hea->getHeaC_Supervisor1() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor1" id="HeaC_Supervisor1Act" <?php if($hea->getHeaC_Supervisor1() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario9Act"><?php echo $hea->getHeaC_Comentarios9(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 10 </td> 
                  <td align="left" class="vertical">¿Se están monitoreando en un registro o gráficamente en el área todos los centerlines de acuerdo a lo establecido en el procedimiento operativo estandar (POE)?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor2" id="HeaC_Supervisor2Act" <?php if($hea->getHeaC_Supervisor2() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor2" id="HeaC_Supervisor2Act" <?php if($hea->getHeaC_Supervisor2() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario10Act"><?php echo $hea->getHeaC_Comentarios10(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 11 </td> 
                  <td align="left" class="vertical">¿El Supervisor revisa y asegura que el monitoreo de las variables se realice dentro de las horas programadas del turno?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor3" id="HeaC_Supervisor3Act" <?php if($hea->getHeaC_Supervisor3() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor3" id="HeaC_Supervisor3Act" <?php if($hea->getHeaC_Supervisor3() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario11Act"><?php echo $hea->getHeaC_Comentarios11(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 12 </td> 
                  <td align="left" class="vertical">¿El Supervisor conoce el estado de los center line de los diferentes equipos en el turno?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor4" id="HeaC_Supervisor4Act" <?php if($hea->getHeaC_Supervisor4() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor4" id="HeaC_Supervisor4Act" <?php if($hea->getHeaC_Supervisor4() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario12Act"><?php echo $hea->getHeaC_Comentarios12(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 13 </td> 
                  <td align="left" class="vertical">¿El Supervisor registra cada turno los resultados del proceso, obtenidos en el reporte diario (% ejecucion y  % cumplimiento)?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor5" id="HeaC_Supervisor5Act" <?php if($hea->getHeaC_Supervisor5() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor5" id="HeaC_Supervisor5Act" <?php if($hea->getHeaC_Supervisor5() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario13Act"><?php echo $hea->getHeaC_Comentarios13(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 14 </td> 
                  <td align="left" class="vertical">¿En alguna junta se revisan los resultados del proceso obtenidos por día?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor6" id="HeaC_Supervisor6Act" <?php if($hea->getHeaC_Supervisor6() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_Supervisor6" id="HeaC_Supervisor6Act" <?php if($hea->getHeaC_Supervisor6() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario14Act"><?php echo $hea->getHeaC_Comentarios14(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 15 </td> 
                  <td rowspan="2" align="center" class="text-center vertical">Jefe de área</td> 
                  <td align="left" class="vertical">¿El Jefe de área asegura que existen planes de acción para los center line que se encuentran fuera de especificación?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_jefe1" id="HeaC_jefe1Act" <?php if($hea->getHeaC_jefe1() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_jefe1" id="HeaC_jefe1Act" <?php if($hea->getHeaC_jefe1() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario15Act"><?php echo $hea->getHeaC_Comentarios15(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td class="text-center vertical" align="center"> 16 </td> 
                  <td align="left" class="vertical">¿El jefe de área se asegura que los planes se ejecuten en tiempo y forma?</td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_jefe2" id="HeaC_jefe2Act" <?php if($hea->getHeaC_jefe2() == 1) { echo "checked"; } ?> required> 
                      SI </label></td> 
                  <td class=" text-center vertical "><label> 
                      <input type="radio" name="opcion_HeaC_jefe2" id="HeaC_jefe2Act" <?php if($hea->getHeaC_jefe2() == 0) { echo "checked"; } ?> required> 
                      NO </label></td> 
                  <td><textarea class="form-control" rows="2" id="HeaC_Comentario16Act"><?php echo $hea->getHeaC_Comentarios16(); ?></textarea></td> 
                </tr> 
                <tr> 
                  <td height="35" class="encabezadoTab text-center vertical" colspan="6" align="center">COMENTARIOS:</td> 
                </tr> 
                <tr> 
                  <td colspan="6"><textarea class="form-control" rows="3" id="HeaC_ComentariosAct"><?php echo $hea->getHeaC_Comentarios(); ?></textarea></td> 
                </tr> 
              </tbody> 
            </table>
            <div class="referenciaObligatoriaAct"></div>
            <div class="supervisorObligatoriaAct"></div>
            <div class="procesoObligatoriaAct"></div>
            <div class="areaObligatoriaAct"></div>
            <div class="operadorHCObligatoriaAct"></div>
          </div> 
        </form> 
      </div> 
    </div> 
  </div> 
</div> 
<script type="text/javascript">cargarfecha();</script>