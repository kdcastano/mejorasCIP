<?php
include("op_sesion.php");

include("../class/respuestas.php");
include("../class/variables.php");
include("../class/maquinas.php");
include("../class/planes_acciones.php");
include("../class/respuestas_observaciones.php");
include("../class/plantas.php");
include("../class/turnos.php");
include("../class/vacios_respuestas.php");

//date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$resP = new respuestas();
$resP->setRes_Codigo($_POST['codigo']);
$resP->consultar();

$var = new variables();
$var->setVar_Codigo($resP->getVar_Codigo());
$var->consultar();

$maq = new maquinas();
$maq->setMaq_Codigo($var->getMaq_Codigo());
$maq->consultar();

$vac = new vacios_respuestas();
$resVac = $vac->buscarComentariosVaciosTS($maq->getMaq_Codigo(), $resP->getEstU_Codigo(), $resP->getRes_Fecha(), $resP->getRes_HoraSugerida());

$plaA = new planes_acciones();
$resObsPla = $plaA->listarObservacionesRespuestasPanelSupervisor($_POST['codigo']);

$res = new respuestas_observaciones();
$Resres = $res->listarPanelSupervisorObservaciones($_POST['codigo']);

//nuevo
$planta = new plantas($usu->getPla_Codigo());
$planta->consultar();

$tur = new turnos();
$restur = $tur->filtroTurnosOperadorCalCierres($usu->getPla_Codigo());

foreach ($restur as $reg) {
    if ($resP->getRes_HoraSugerida() >= $reg['Tur_HoraInicio'] && $resP->getRes_HoraSugerida() <= $reg['Tur_HoraFin']) {
        $hora_inicial = $reg['Tur_HoraInicio'];
    }
}
date_default_timezone_set($planta->getPla_ZonaHoraria());
$fechaactual = date("Y-m-d H:i:s");

//var_dump($fechaactual);
//devuelve la diferencia de horas entre dos fechas
function diferenciaHoras($fechainicial, $fechafinal) {
    $fecha1 = new DateTime($fechainicial);
    $fecha2 = new DateTime($fechafinal);
    $diferencia = $fecha1->diff($fecha2);

    $horas = $diferencia->h + ($diferencia->d * 24) + ($diferencia->m * 30 * 24) + ($diferencia->y * 365 * 24);
    return $horas;
}

$diferenciaHoraAct = diferenciaHoras($fechaactual, $resP->getRes_Fecha() . " " . $hora_inicial);
//var_dump("horas: ".$diferenciaHoraAct);
?>
<input type="hidden" value="<?php echo ($resObsPla[0] == '') ? -1 : $resObsPla[0]; ?>" id="codigoPlanAccionActual2">
<input type="hidden" value="<?php echo $_POST['codigo']; ?>" id="codigoRespuestaActual2">
<input type="hidden" class="EstU_Codigo_GlobalPanelDetalle" value="<?php echo $_POST['codigo']; ?>">
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <strong>Toma: <?php echo date("H:i", strtotime($resP->getRes_HoraSugerida())); ?></strong>
            </div>

            <div class="panel-body">
                <form id="f_variablesMasivasOperadorPokCrear" role="form">
                    <div class="table-responsive">
                        <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                            <thead>
                                <tr class="encabezadoTab">
                                    <th align="center" class="text-center">Maquina</th>
                                    <th align="center" class="text-center P30">Variable</th>
                                    <th align="center" class="text-center P10">Si</th>
                                    <th align="center" class="text-center P10">No</th>
                                    <th align="center" class="text-center P10">Sin Uso</th>
                                    <th align="center" class="text-center P10">Paro</th>
                                    <th align="center" class="text-center P30">Acción A Tomar</th>
                                    <th align="center" class="text-center P10">Observación Paro</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="buscar">
                                <tr>
                                    <td class="P10 vertical"><?php echo $maq->getMaq_Nombre(); ?>&nbsp;&nbsp;</td>
                                    <td class="vertical" nowrap><?php echo $var->getVar_Nombre(); ?></td>
                                    <?php
                                    if ($resP->getRes_ValorNum() == "1") {
                                        $ColValCenterLine = "VerdeCenterLine";
                                    } else {
                                        if ($resP->getRes_ValorNum() == "2") {
                                            $ColValCenterLine = "";
                                        } else {
                                            if ($resP->getRes_ValorNum() == "3") {
                                                $ColValCenterLine = "";
                                            } else {
                                                $ColValCenterLine = "RojoCenterLine";
                                            }
                                        }
                                    }
                                    ?>
                                    <td align="center" class="<?php
                                    if ($resP->getRes_ValorNum() == 1) {
                                        echo $ColValCenterLine;
                                    }
                                    ?>">
                                        <input style="margin-top: 5px;" type="radio"  name="eradioseleccion" <?php echo $resP->getRes_ValorNum() == "1" ? "checked" : ""; ?> class="e_guardarActRadio" id="input_1" data-num="1" <?php echo ($diferenciaHoraAct <= 20) ?: 'disabled' ?>>
                                    </td>
                                    <td align="center" class="<?php
                                    if ($resP->getRes_ValorNum() == 0) {
                                        echo $ColValCenterLine;
                                    }
                                    ?>">
                                        <input style="margin-top: 5px;" type="radio" <?php echo $resP->getRes_ValorNum() == "0" ? "checked" : ""; ?> name="eradioseleccion" class="e_guardarActRadio" data-num="0" id="input_2" <?php echo ($diferenciaHoraAct <= 20) ?: 'disabled' ?>>
                                    </td>
                                    <td align="center">
                                        <input style="margin-top: 5px;" type="radio" <?php echo $resP->getRes_ValorNum() == "2" ? "checked" : ""; ?> name="eradioseleccion" class="e_guardarActRadio" data-num="2" id="input_3" <?php echo ($diferenciaHoraAct <= 20) ?: 'disabled' ?>>
                                    </td> 
                                    <td align="center">
                                        <input style="margin-top: 5px;" type="radio" <?php echo $resP->getRes_ValorNum() == "3" ? "checked" : ""; ?> disabled>
                                    </td>
                                    <td>
                                        <input style="margin-top: 5px;" class="form-control inputTablaEstEsp" id="guardarObservacionRespuesta2" value="<?php echo $resObsPla[1]; ?>" autocomplete="off" disabled>
                                    </td>
                                  <td><?php if(isset($resVac[1])){ echo $resVac[1];}else{ echo "&nbsp;";} ?></td>
                                    <td align="center"><div class="CirculoColoresToma <?php echo $ColValCenterLine; ?>"></div></td>
                                      <td></td>
<!--                                    <td align="center"><?php if ($diferenciaHoraAct <= 122220) { ?><button id="btn_actualizarSupervisorInfo2" class="btn btn-sm btn-success">Actualizar</button><?php } ?></td>-->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>