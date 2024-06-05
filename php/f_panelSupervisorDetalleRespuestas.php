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

$resp = new respuestas();
$resp->setRes_Codigo($_POST['codigo']);
$resp->consultar();

$var = new variables();
$var->setVar_Codigo($resp->getVar_Codigo());
$var->consultar();

$maq = new maquinas();
$maq->setMaq_Codigo($var->getMaq_Codigo());
$maq->consultar();

$vac = new vacios_respuestas();
$resVac = $vac->buscarComentariosVaciosTS($maq->getMaq_Codigo(), $resp->getEstU_Codigo(), $resp->getRes_Fecha(), $resp->getRes_HoraSugerida());

$plaA = new planes_acciones();
$resObsPla = $plaA->listarObservacionesRespuestasPanelSupervisor($_POST['codigo']);

$res = new respuestas_observaciones();
$Resres = $res->listarPanelSupervisorObservaciones($_POST['codigo']);
//estacionUsuario
//$fecha_variable = $resp->getRes_Fecha() . " " . $resp->getRes_HoraSugerida();

$planta = new plantas($usu->getPla_Codigo());
$planta->consultar();

$tur = new turnos();
$restur = $tur->filtroTurnosOperadorCalCierres($usu->getPla_Codigo());

foreach ($restur as $reg) {
    if ($resp->getRes_HoraSugerida() >= $reg['Tur_HoraInicio'] && $resp->getRes_HoraSugerida() <= $reg['Tur_HoraFin']) {
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

$diferenciaHoraAct = diferenciaHoras($fechaactual, $resp->getRes_Fecha() . " " . $hora_inicial);
?>
<input type="hidden" value="<?php echo $_POST['codigo']; ?>" id="codigoRespuestaActual">
<input type="hidden" value="<?php echo $_POST['estacionUsuario']; ?>" id="estacionServicioActual">
<input type="hidden" value="<?php echo $resObsPla[0]; ?>" id="codigoPlanAccionActual">
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <strong>Variable: <?php echo $var->getVar_Nombre(); ?> - Hora: <?php echo date("H:i", strtotime($resp->getRes_HoraSugerida())); ?></strong>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                        <thead>
                            <tr class="encabezadoTab">
                                <th align="center" class="text-center">Maquina</th>
                                <th align="center" class="text-center">Variable</th>
                                <th align="center" class="text-center">Valor Especificación</th>
                                <th align="center" class="text-center P10">Valor</th>
                                <th align="center" class="text-center P30">Acción A Tomar</th>
                                <th align="center" class="text-center P2"></th>
                                <th align="center" class="text-center P5">Alerta</th>
                                <th align="center" class="text-center P5">Paro</th>
                                <th align="center" class="text-center P10">Observación Paro</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="buscar">
                            <tr>
                                <td class="P10 vertical"><?php echo $maq->getMaq_Nombre(); ?>&nbsp;&nbsp;</td>
                                <td class="vertical" nowrap><?php echo $var->getVar_Nombre(); ?></td>
                                <td align="center">
                                    <?php
                                    switch ($var->getVar_Operador()) {
                                        case 3: $OperValCon = " +- ";
                                            break;
                                        case 1: $OperValCon = " >= ";
                                            break;
                                        case 2: $OperValCon = " <= ";
                                            break;
                                    }
                                    echo $var->getVar_ValorControl() . $OperValCon . $var->getVar_ValorTolerancia() . " " . $var->getVar_UnidadMedida();
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $ValorToma = $resp->getRes_ValorNum();
                                    $AccionCampo = 2; // Actualizar
                                    $ObsObli = "";

                                    if ($resp->getRes_Alerta() == "1") {
                                        $CheAlert = "checked";
                                    } else {
                                        $CheAlert = "";
                                    }

                                    if ($resp->getRes_Vacio() == "1") {
                                        $CheVacio = "checked";
                                    } else {
                                        $CheVacio = "";
                                    }

                                    if ($var->getVar_Operador() == "3") {
                                        $ValorControl = $var->getVar_ValorControl();
                                        $ValorTol = $var->getVar_ValorTolerancia();
                                        $LVerde1 = round($ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN); 
                                        $LVerde2 = round($ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);

                                        $LAmarillo1 = round($LVerde1 - 0.001, 3, PHP_ROUND_HALF_EVEN);
                                        $LAmarillo2 = round($LAmarillo1 - $ValorTol / 2 + 0.001, 3, PHP_ROUND_HALF_EVEN);

                                        $LAmarillo3 = round($LVerde2 + 0.001, 3, PHP_ROUND_HALF_EVEN);
                                        $LAmarillo4 = round($LAmarillo3 + $ValorTol / 2 - 0.001, 3, PHP_ROUND_HALF_EVEN);

                                        $ColValCenterLine = "";
                                        if ($resp->getRes_ValorNum() >= $LVerde1 && $resp->getRes_ValorNum() <= $LVerde2) {
                                            $ColValCenterLine = "VerdeCenterLine";
                                            $ObsObli = "";
                                            $DeshAlertCol = "disabled";
                                        } else {
                                            if ($resp->getRes_ValorNum() <= $LAmarillo1 && $resp->getRes_ValorNum() >= $LAmarillo2) {
                                                $ColValCenterLine = "AmarilloCenterLine";
                                                $ObsObli = "required";
                                                $DeshAlertCol = "";
                                            } else {
                                                if ($resp->getRes_ValorNum() >= $LAmarillo3 && $resp->getRes_ValorNum() <= $LAmarillo4) {
                                                    $ColValCenterLine = "AmarilloCenterLine";
                                                    $ObsObli = "required";
                                                    $DeshAlertCol = "";
                                                } else {
                                                    $ColValCenterLine = "RojoCenterLine";
                                                    $ObsObli = "required";
                                                    $DeshAlertCol = "";
                                                }
                                            }
                                        }
                                    }

                                    if ($var->getVar_Operador() == "1") {
                                         $ValorControl = $var->getVar_ValorControl();
                                        $ValorTol = $var->getVar_ValorTolerancia();

                                        $LVerde1 = round($ValorControl - $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN);
                                        $LVerde2 = 99999999999;

                                        $LAmarillo1 = round($LVerde1 - 0.001, 3, PHP_ROUND_HALF_EVEN);
                                        $LAmarillo2 = round($LAmarillo1 - $ValorTol / 2 + 0.001, 3, PHP_ROUND_HALF_EVEN);

                                        $ColValCenterLine = "";
                                        if ($resp->getRes_ValorNum() >= $LVerde1 && $resp->getRes_ValorNum() <= $LVerde2) {
                                            $ColValCenterLine = "VerdeCenterLine";
                                            $ObsObli = "";
                                            $DeshAlertCol = "disabled";
                                        } else {
                                            if ($resp->getRes_ValorNum() <= $LAmarillo1 && $resp->getRes_ValorNum() >= $LAmarillo2) {
                                                $ColValCenterLine = "AmarilloCenterLine";
                                                $ObsObli = "required";
                                                $DeshAlertCol = "";
                                            } else {
                                                $ColValCenterLine = "RojoCenterLine";
                                                $ObsObli = "required";
                                                $DeshAlertCol = "";
                                            }
                                        }
                                    }

                                    if ($var->getVar_Operador() == "2") {
                                        $ValorControl = $var->getVar_ValorControl();
                                        $ValorTol = $var->getVar_ValorTolerancia();

                                        $LVerde1 = 0;
                                        $LVerde2 = round($ValorControl + $ValorTol / 2, 3, PHP_ROUND_HALF_EVEN); 

                                        $LAmarillo1 = round($LVerde2 + 0.001, 3, PHP_ROUND_HALF_EVEN);
                                        $LAmarillo2 = round($LAmarillo1 + $ValorTol / 2 - 0.001, 3, PHP_ROUND_HALF_EVEN);

                                        $ColValCenterLine = "";
                                        if ($resp->getRes_ValorNum() >= $LVerde1 && $resp->getRes_ValorNum() <= $LVerde2) {
                                            $ColValCenterLine = "VerdeCenterLine";
                                            $ObsObli = "";
                                            $DeshAlertCol = "disabled";
                                        } else {
                                            if ($resp->getRes_ValorNum() >= $LAmarillo1 && $resp->getRes_ValorNum() <= $LAmarillo2) {
                                                $ColValCenterLine = "AmarilloCenterLine";
                                                $ObsObli = "required";
                                                $DeshAlertCol = "";
                                            } else {
                                                $ColValCenterLine = "RojoCenterLine";
                                                $ObsObli = "required";
                                                $DeshAlertCol = "";
                                            }
                                        }
                                    }
                                    ?>
                                    <input type="text" value="<?php echo $ValorToma; ?>" id="guardarValorRespuesta" class="form-control inputTablaEstEsp <?php
                                    if ($resp->getRes_Vacio() != "1") {
                                        echo $ColValCenterLine;
                                    }
                                    ?> <?php echo $formIngDato; ?> TV_CampoValor<?php echo $cont; ?>" dir="rtl" autocomplete="off">
                                </td>
                                <td>
                                    <input class="form-control inputTablaEstEsp TObs_CampoValor<?php echo $cont; ?>" value="<?php echo $resObsPla[1]; ?>" autocomplete="off" id="guardarObservacionRespuesta" disabled>
                                </td>
                                <td align="center"><div class="CirculoColoresToma <?php echo $ColValCenterLine; ?>"></div></td>
                                <td align="center"><input type="checkbox" class="TAle_CampoAlerta<?php echo $cont; ?>" title="Reportar alerta sobre esta variable" <?php echo $CheAlert; ?> <?php echo $DeshAlertCol; ?> disabled></td>
                                <td align="center"><input type="checkbox" class="TAle_CampoVacio<?php echo $cont; ?>" title="Reportar paro sobre esta variable" <?php echo $CheVacio; ?> disabled></td>
                              <td><?php if(isset($resVac[1])){ echo $resVac[1];}else{ echo "&nbsp;";} ?></td>
                              <td></td>
<!--                                <td align="center"><?php if ($diferenciaHoraAct <= 20) { ?><button id="btn_actualizarSupervisorInfo" class="btn btn-sm btn-success">Actualizar</button><?php } ?></td>-->
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <?php if ($usu->getUsu_Rol() != "1") { ?>
                            <div>
                                <label>Observaciones Supervisor:</label>
                                <textarea id="OanelSupDet_ObservacionesSup" class="form-control" <?php echo $resObsPla[0] != "" ? "" : "disabled"; ?>><?php echo $resObsPla[4]; ?></textarea>
                                <br>
                                <?php if ($resObsPla[0] > "0") { ?>
                                    <div align="center">
                                        <button class="btn btn-danger Btn_Notificaciones Btn_GuardarObsSupPanelSupDet" data-cod="<?php echo $resObsPla[0]; ?>" data-res="<?php echo $_POST['codigo']; ?>">Guardar</button>
                                    </div>
                                    <br>
                                    <div class="mensajeCreadoCorrectamentePSDR"></div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <?php //if($_SESSION['CP_Usuario'] == "1"){    ?>
                                <?php if ($usu->getUsu_Rol() != "1") { ?>
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <strong>Observación Jefaturas</strong>
                                            <button style="float: right;" id="Btn_PanelSupervisorObservacionCrear" class="btn btn-primary btn-xs" data-res="<?php echo $_POST['codigo']; ?>">Crear</button>
                                        </div>

                                        <div class="panel-body">
                                            <div class="table-responsive" id="imp_tabla">
                                                <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                                                    <thead>
                                                        <tr class="encabezadoTab">
                                                            <th align="center" class="text-center">FECHA <br> CREACIÓN</th>
                                                            <th align="center" class="text-center vertical">USUARIO</th>
                                                            <th align="center" class="text-center vertical">OBSERVACIÓN</th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="buscar">
                                                        <?php foreach ($Resres as $registro) { ?>
                                                            <tr>
                                                                <td><?php echo $registro[2]; ?></td>
                                                                <td><?php echo $registro[1]; ?></td>
                                                                <td><?php echo $registro[3]; ?></td>
                                                                <?php if ($registro[4] == $_SESSION['CP_Usuario']) { ?>
                                                                    <td align="center" class="vertical"><button class="btn btn-warning btn-xs e_cargarPanelSupervisorObservacionEditar" data-cod="<?php echo $registro[0]; ?>" data-res="<?php echo $_POST['codigo']; ?>">Editar</button></td>
                                                                    <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_eliminarPanelSupervisorObservacionEliminar" data-cod="<?php echo $registro[0]; ?>" data-res="<?php echo $_POST['codigo']; ?>">Eliminar</button></td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php //}    ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>