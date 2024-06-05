<?php
include("op_sesion.php");
include_once("../class/usuarios.php");
include("../class/estaciones_usuarios.php");
include("../class/estaciones_areas.php");
include("../class/puestos_trabajos.php");
include("../class/areas.php");
include("../class/calidad.php");
include("../class/respuestas_calidad.php");
include("../class/formularios_defectos.php");
include("../class/frecuencias_calidad.php");
include("../class/turnos.php");
include("../class/parametros.php");
include( "../class/vacios_respuestas_calidad.php" );
include( "../class/plantas.php" );

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$fecha2 = date("Y-m-d");
$ayer = date("Y-m-d", strtotime($fecha . " - 1 days"));
$hora = date("H:i:s");

$estU = new estaciones_usuarios();
$estU->setEstU_Codigo($_POST['codigo']);
$estU->consultar();

$tur = new turnos();
$tur->setTur_Codigo($estU->getTur_Codigo());
$tur->consultar();

$usuOpe = new usuarios();
$usuOpe->setUsu_Codigo($estU->getUsu_Codigo());
$usuOpe->consultar();

$pueT = new puestos_trabajos();
$pueT->setPueT_Codigo($estU->getPueT_Codigo());
$pueT->consultar();

$estA = new estaciones_areas();
$estA->setEstA_Codigo($pueT->getEstA_Codigo());
$estA->consultar();

$are = new areas();
$are->setAre_Codigo($estA->getAre_Codigo());
$are->consultar();

$cal = new calidad();
$resCal = $cal->listarVariablesCalidadPanelOperador($usuOpe->getPla_Codigo(), $estA->getAre_Codigo());
$cantRegistros = count($resCal);

$HoraInicialValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraInicio()));
$HoraFinalValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraFin()));

$valEspTurnoR = 0;
//Validación por turno 3
if ($HoraInicialValTEsp > $HoraFinalValTEsp) {
    $fechaFinT = date("Y-m-d", strtotime($fecha2 . " - 1 days"));
    $HoraInicialRespT = date("H:i", strtotime($tur->getTur_HoraInicio()));
    $HoraFinalRespT = date("H:i", strtotime("23:59:00"));
    $HoraInicialRespT2 = date("H:i", strtotime("00:00:00"));
    $HoraFinalRespT2 = date("H:i", strtotime($tur->getTur_HoraFin()));

    // Ejm: hoy es 10-02-22

    if ($HoraInicialValTEsp <= $hora && $hora <= "23:59") {
        //hoy 10-02-22
        $fechaIniT3 = date("Y-m-d", strtotime($fecha2));
        //mañana 11-02-22
        $fechaFinT3 = date("Y-m-d", strtotime($fecha2 . " + 1 days"));
    } else {
        //Dia nuevo
        //dia anterior 10-02-22 
        if ($hora >= date("H:i", strtotime($HoraFinalValTEsp . " + 4 hour ")) && $hora <= date("H:i", strtotime($HoraInicialValTEsp))) {
            $fechaIniT3 = date("Y-m-d", strtotime($fecha2));
            //Hoy 11-02-22
            $fechaFinT3 = date("Y-m-d", strtotime($fecha2 . " + 1 days"));
        } else {
            $fechaIniT3 = date("Y-m-d", strtotime($fecha2 . " - 1 days"));
            //Hoy 11-02-22
            $fechaFinT3 = date("Y-m-d", strtotime($fecha2));
        }
    }

    $valEspTurnoR = 1;
} else {
    $fechaFinT = $fecha2;
    $fechaIniT3 = $fecha2;
    $fechaFinT3 = $fecha2;
    $valEspTurnoR = 0;
}


$res = new respuestas_calidad();
$resRes = $res->listarRespuestasCalidad($_POST['formato'], $_POST['familia'], $_POST['color'], $_POST['hora'], $estA->getAre_Codigo(), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2, $HoraFinalRespT2, $valEspTurnoR);

foreach ($resRes as $registro) {
    //CodCalidad,área, TomaDefectos,formato,familia,color, hora
    $vecRespuestaValor[$registro[1]][$registro[9]][$registro[8]][$registro[2]][$registro[3]][$registro[4]][date("H:i", strtotime($registro[5]))] = $registro[6];
    $vecRespuestaObservacion[$registro[1]][$registro[9]][$registro[8]][$registro[2]][$registro[3]][$registro[4]][date("H:i", strtotime($registro[5]))] = $registro[7];
    $vecRespuestaCod[$registro[1]][$registro[9]][$registro[8]][$registro[2]][$registro[3]][$registro[4]][date("H:i", strtotime($registro[5]))] = $registro[0];
    $vectorRespuestasVacios[$registro[1]][$registro[9]][$registro[8]][$registro[2]][$registro[3]][$registro[4]][date("H:i", strtotime($registro[5]))] = $registro[10];
}

$cantRespuestasValor = count($vecRespuestaValor);

$for = new formularios_defectos();
$defectosSegundaFor = $for->listardefectos("2", $_POST['hora'], $fecha, $_POST['formato'], $_POST['familia'], $_POST['color'], $estU->getPueT_Codigo());

foreach ($defectosSegundaFor as $registr10) {
    //Codigo defecto -> Parametros
    $vecDefectosSegundaCreados[$registr10[5]] = $registr10[5];
}

$defectosRoturaFor = $for->listardefectosRotura("3", $_POST['hora'], $fecha, $_POST['formato'], $_POST['familia'], $_POST['color'], $estU->getPueT_Codigo());

foreach ($defectosRoturaFor as $registro7) {
    //Codigo defecto -> Parametros
    $vecDefectosRoturaCreados[$registro7[5]] = $registro7[5];
}

$defectosSegundaDiaAnterior = $for->listardefectosDiaAnterior("2", $ayer, $estU->getPueT_Codigo(), $fecha);
$defectosRoturaDiaAnterior = $for->listardefectosDiaAnteriorRotura("3", $ayer, $estU->getPueT_Codigo(), $fecha);

$freCal = new frecuencias_calidad();

$resFreCal = $freCal->listarFrecuenciasCalidadPanelOperador($usuOpe->getPla_Codigo(), $estA->getAre_Codigo());

foreach ($resFreCal as $registro9) {
    if ($_POST['hora'] == date("H:i", strtotime($registro9[1]))) {
        $vectorFrecuCal[$registro9[0]][date("H:i", strtotime($registro9[1]))] = $registro9[0];
    }
}

$par = new parametros();
$estamposPar = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'], "14");
$ladosPar = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'], "13");
$defectosParSegunda = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'], "11");
$defectosParRotura = $par->listarParametrosTipoUsuario($_SESSION['CP_Usuario'], "12");

//echo "PP " . $_POST['programaProduccion'] . "estU " . $estU->getEstU_Codigo();

$vacRC = new vacios_respuestas_calidad();
$resVacRC = $vacRC->buscarRespuestasVacios($_POST['programaProduccion'], $estU->getEstU_Codigo());

//var_dump($resVacRC);

foreach ($resVacRC as $registro10) {
    $vectObservacionVacio[date("H:i", strtotime($registro10[2]))] = $registro10[3];
}

//echo "usuario ".$usu->getPla_Codigo();
$planta = new plantas($usu->getPla_Codigo());
$planta->consultar();

date_default_timezone_set($planta->getPla_ZonaHoraria());
$fechaActual = date("Y-m-d H:i:s");
$fechaAct2 = date("Y-m-d");

//$fechaActual = date("2023-02-23 23:59:00");
//$fechaAct2 = date("2023-02-23");
//var_dump($fechaActual);
//devuelve una fecha, sumando las horas o minutos, formato de la fecha YYYY-mm-dd HH:mm:ss
function fechaHoras($fecha, $horas = 0, $minutos = 0) {
    $ano = substr($fecha, 0, 4);
    $mes = substr($fecha, 5, 2);
    $dia = substr($fecha, 8, 2);
    $hora = substr($fecha, 11, 2);
    $minuto = substr($fecha, 14, 2);

    return date('Y-m-d H:i:s', mktime($hora + $horas, $minuto + $minutos, 0, $mes, $dia, $ano));
}

function transformar_ampm_militar($hora) {
    $nuevahora = strtotime($hora);
    $nuevahora = date("H:i:s", $nuevahora);
    return $nuevahora;
}

//$fecha_seleccion = '2023-03-24 00:00:00';
$fecha_seleccion = $fechaAct2 . " " . transformar_ampm_militar($_POST['hora']);

function diferenciaMinutos($horaini, $horafin) {
    $fecha1 = new DateTime($horaini);
    $fecha2 = new DateTime($horafin);
    $diferencia = $fecha1->diff($fecha2);

    $diftotal = ($diferencia->format('%h') * 60) + $diferencia->format('%i') + ($diferencia->format('%s') / 60);

    return $diftotal;
}

$diferenciaMin = round(diferenciaMinutos($fecha_seleccion, $fechaActual));
$fechahoraFinal = fechaHoras($fecha_seleccion, 0, $planta->getPla_Tolerancia());
$diferenciaVisual = round(diferenciaMinutos($fechaActual, $fechahoraFinal));

$FechaIniLimToma = date("Y-m-d H:i:s", strtotime($_POST['fecha']." ".$_POST['hora']." - ".$planta->getPla_Tolerancia()." minute"));
$FechaFinLimToma = date("Y-m-d H:i:s", strtotime($_POST['fecha']." ".$_POST['hora']." + ".$planta->getPla_Tolerancia()." minute"));
$FechaHoraActualToma = date("Y-m-d H:i:s");
$TiempoRestanteToma = round( diferenciaMinutos( $FechaFinLimToma, $FechaHoraActualToma ) );
/* var_dump("fa: ".$fechaActual);
  var_dump("fs ".$fecha_seleccion);
  var_dump($diferenciaMin);
  var_dump("hf ".$fechahoraFinal); */
?>
<!--
codigo: d_codigo,
        hora: d_hora,
        formato: d_formato,
        familia: d_familia,
        color: d_color
-->
<?php if($usu->getUsu_Rol() == "1" || $usu->getUsu_Rol() == "2"){ ?>
<input type="hidden" class="EstU_Codigo_GlobalPanelDetalle" value="<?php echo $_POST['codigo']; ?>">
<?php if ($FechaHoraActualToma >= $FechaIniLimToma && $FechaHoraActualToma <= $FechaFinLimToma) { ?>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <strong>Toma: <?php echo $_POST['hora'] . " - Quedan " . $TiempoRestanteToma . " minutos para la toma de variables"; ?></strong>
                    <div align="right"> Seleccionar Todos Paro&nbsp;&nbsp;
                        <input type="checkbox" class="Int_SeleccionTodosVaciosCalidad">
                        &nbsp;&nbsp; </div>
                </div>

                <div class="panel-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form id="f_variablesMasivasCalidadCrear" role="form">
                            <input type="hidden" id="ResCcodigoEstU" value="<?php echo $_POST['codigo']; ?>">
                            <input type="hidden" id="ResCfamilia" value="<?php echo $_POST['familia']; ?>">
                            <input type="hidden" id="ResCformato" value="<?php echo $_POST['formato']; ?>">
                            <input type="hidden" id="ResCcolor" value="<?php echo $_POST['color']; ?>">
                            <input type="hidden" id="ResCcolor" value="<?php echo $_POST['color']; ?>">
                            <input type="hidden" id="ResChora" value="<?php echo date("H:i", strtotime($_POST['hora'])); ?>">
                            <input type="hidden" id="ResCFecha" value="<?php echo $_POST['fecha']; ?>">
                            <input type="hidden" id="codProp" value="<?php echo $_POST['programaProduccion']; ?>">
                            <div class="e_cargarMensajeVacioCalidad"></div>
                            <div class="table-responsive" id="imp_tabla">
                                <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                                    <thead>
                                        <tr class="encabezadoTab">
                                            <th align="center" class="text-center">Calidad</th>
                                            <th align="center" class="text-center P10">Valor</th>
                                            <th align="center" class="text-center P40">Observación</th>
                                            <th align="center" class="text-center P5">Paro</th>
                                            <th align="center" class="text-center P10">Observación Paro</th>
                                        </tr>
                                    </thead>
                                    <tbody class="buscar">
                                        <?php
                                        $cont = 0;
                                        foreach ($resCal as $registro) {
                                            if (isset($vectorFrecuCal[$registro[0]][$_POST['hora']])) {
                                                if ($registro[5] == "2") {
                                                    $CalSegCodigo = $registro[0];
                                                }

                                                if ($registro[5] == "3") {
                                                    $CalRotCodigo = $registro[0];
                                                }
                                                ?>
                                                <tr>
                                            <input type="hidden" id="Cal_Codigo<?php echo $cont; ?>" value="<?php echo $registro[0]; ?>">
                                            <td class="vertical"><?php echo $registro[2]; ?></td>
                                            <td>
                                                <?php
                                                if (isset($vecRespuestaValor[$registro[0]][$registro[1]][$registro[5]][$_POST['formato']][$_POST['familia']][$_POST['color']][date("H:i", strtotime($_POST['hora']))]) || $vectorRespuestasVacios[$registro[0]][$registro[1]][$registro[5]][$_POST['formato']][$_POST['familia']][$_POST['color']][date("H:i", strtotime($_POST['hora']))] == "1" || $cantRespuestasValor > "0") {
                                                    $AccionCampo = 2; // Actualizar
                                                } else {
                                                    $AccionCampo = 1; // Crear
                                                }
                                                ?>
                                                <input type="text" id="ResC_ValorControl<?php echo $cont; ?>" class="form-control inputTablaEstEsp inputDecimales validarValorControlCalidad" autocomplete="off" value="<?php
                                                if (isset($vecRespuestaValor[$registro[0]][$registro[1]][$registro[5]][$_POST['formato']][$_POST['familia']][$_POST['color']][date("H:i", strtotime($_POST['hora']))])) {
                                                    echo $vecRespuestaValor[$registro[0]][$registro[1]][$registro[5]][$_POST['formato']][$_POST['familia']][$_POST['color']][date("H:i", strtotime($_POST['hora']))];
                                                }
                                                ?>" data-cod="<?php
                                                       if (isset($vecRespuestaCod[$registro[0]][$registro[1]][$registro[5]][$_POST['formato']][$_POST['familia']][$_POST['color']][date("H:i", strtotime($_POST['hora']))])) {
                                                           echo $vecRespuestaCod[$registro[0]][$registro[1]][$registro[5]][$_POST['formato']][$_POST['familia']][$_POST['color']][date("H:i", strtotime($_POST['hora']))];
                                                       }
                                                       ?>" data-acc="<?php echo $AccionCampo; ?>" data-con="<?php echo $cont; ?>" <?php
                                                       if ($vectorRespuestasVacios[$registro[0]][$registro[1]][$registro[5]][$_POST['formato']][$_POST['familia']][$_POST['color']][date("H:i", strtotime($_POST['hora']))] == "1") {
                                                           echo "disabled";
                                                       }
                                                       ?>>

                                            </td>

                                            <td> <input type="text" id="ResC_Observacion<?php echo $cont; ?>" class="form-control inputTablaEstEsp ResC_ObservacionTodos" dir="rtl" autocomplete="off" value="<?php
                                                if (isset($vecRespuestaObservacion[$registro[0]][$registro[1]][$registro[5]][$_POST['formato']][$_POST['familia']][$_POST['color']][date("H:i", strtotime($_POST['hora']))])) {
                                                    echo $vecRespuestaObservacion[$registro[0]][$registro[1]][$registro[5]][$_POST['formato']][$_POST['familia']][$_POST['color']][date("H:i", strtotime($_POST['hora']))];
                                                }
                                                ?>"></td>
                                            <td align="center"><?php
                                                if (isset($vectorRespuestasVacios[$registro[0]][$registro[1]][$registro[5]][$_POST['formato']][$_POST['familia']][$_POST['color']][date("H:i", strtotime($_POST['hora']))])) {
                                                    $AccionCampoVacio = 2; // Actualizar

                                                    if ($vectorRespuestasVacios[$registro[0]][$registro[1]][$registro[5]][$_POST['formato']][$_POST['familia']][$_POST['color']][date("H:i", strtotime($_POST['hora']))] == "1") {
                                                        $CheVacio = "checked";
                                                    } else {
                                                        $CheVacio = "";
                                                    }
                                                } else {
                                                    $AccionCampoVacio = 1; // Crear
                                                    $CheVacio = "";
                                                }
                                                ?>
                                                <input type="checkbox" class="campoVacioSelecCalidad T_CampoVacioCalidad<?php echo $cont; ?>" data-cont = "<?php echo $cont; ?>" data-acc="<?php echo $AccionCampoVacio; ?>" title="Reportar paro sobre esta variable" <?php echo $CheVacio; ?> disabled></td>
                                            <?php if ($cont == "0") { ?>
                                                <td rowspan="<?php echo $cantRegistros; ?>"> <textarea cols="5" rows="<?php echo $cantRegistros + 1; ?>" class="form-control vacRC_VacioObservacion" data-codObserVacio="<?php echo $vectObservacionVacio[date("H:i", strtotime($_POST['hora']))]; ?>" <?php
                                                    if (!isset($vectObservacionVacio[date("H:i", strtotime($_POST['hora']))])) {
                                                        echo "disabled";
                                                    }
                                                    ?> ><?php echo $vectObservacionVacio[date("H:i", strtotime($_POST['hora']))]; ?></textarea></td>
                                                <?php } ?>
                                            </tr>
                                            <?php
                                            $cont++;
                                        }
                                        ?>
    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="info_CargarMensajeValidacionSuma"></div>
                            <div class="info_CargarMensajeValidacionIndividual"></div>
                            <div align="right">
                              <input type="hidden" class="Num_CantVariablesCalidad" value="<?php echo $cont; ?>" data-for="<?php echo $_POST['formato']; ?>" data-fam= "<?php echo $_POST['familia']; ?>" data-col="<?php echo $_POST['color']; ?>" data-hor="<?php echo $_POST['hora']; ?>" data-porCal="<?php echo $_POST['porcentajeCalidad']; ?>" data-prop="<?php echo $_POST['programaProduccion']; ?>" data-fec="<?php echo $_POST['fecha']; ?>">
                            </div>
                        </form> 
                    </div>

                    <div class="limpiar"></div>
                    <br>
                    <div class="col-lg-12 col-md-12 col-sm-12">
    <?php if (isset($vectorFrecuCal[$CalSegCodigo][$_POST['hora']])) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <strong>Segunda</strong>
                                        <button style="float: right;" id="Btn_VariablesMasivasCalidadSegundaCrear" class="btn btn-primary btn-xs" data-cod="<?php echo $CalSegCodigo; ?>" data-hor= "<?php echo $_POST['hora']; ?>" data-for="<?php echo $_POST['formato']; ?>" data-fam= "<?php echo $_POST['familia']; ?>" data-col="<?php echo $_POST['color']; ?>" data-EstU="<?php echo $_POST['codigo']; ?>">Crear</button>
                                    </div>

                                    <div class="panel-body">
        <?php /* ?><input type="hidden" id="" value="<?php echo $CalSegCodigo; ?>"><?php */ ?>
                                        <div class="table-responsive" id="imp_tabla">
                                            <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                                                <thead>
                                                    <tr class="encabezadoTab">
                                                        <th align="center" class="text-center">DEFECTO</th>
                                                        <th align="center" class="text-center">PUNZÓN</th>
                                                        <th align="center" class="text-center">LADO</th>
                                                        <th align="center" class="text-center">NÚMERO DE PIEZAS</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="buscar">

                                                    <?php
                                                    $cont = 0;
                                                    foreach ($defectosSegundaFor as $registro6) {
                                                        ?>
            <?php $AccionCampo2 = "2"; // actualizar    ?>

                                                        <!-- codigo Formulario defecto-->
                                                    <input type="hidden" id="ForD_CodigoSegunda<?php echo $cont; ?>" value="<?php echo $registro6[0]; ?>">

                                                    <tr>
                                                        <td>
                                                            <select id="ForD_DefectoSegunda<?php echo $cont; ?>" class="form-control" required>
                                                                <?php foreach ($defectosParSegunda as $registro) { ?>
                                                                    <option value="<?php echo $registro[0]; ?>" <?php echo $registro6[5] == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
            <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td align="right">
                                                            <select id="ForD_EstampoSegunda<?php echo $cont; ?>" class="form-control" required>
                                                                <option></option>
                                                                <?php foreach ($estamposPar as $registro) { ?>
                                                                    <option value="<?php echo $registro[0]; ?>" <?php echo $registro6[6] == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
            <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td align="right">
                                                            <select id="ForD_LadoSegunda<?php echo $cont; ?>" class="form-control" required>
                                                                <option></option>
                                                                <?php foreach ($ladosPar as $registro) { ?>
                                                                    <option value="<?php echo $registro[0]; ?>" <?php echo $registro6[7] == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
            <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td align="left"><input type="text" id="ForD_NumeroPiezasSegunda<?php echo $cont; ?>" class="form-control" value="<?php echo $registro6[4]; ?>" data-acc="<?php echo $AccionCampo2; ?>"></td>
                                                        <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_eliminarCalidadFormulario" data-cod="<?php echo $registro6[0]; ?>"><span class="glyphicon glyphicon-trash"></span></button></td>
                                                    </tr>
                                                    <?php
                                                    $cont++;
                                                }
                                                ?>
                                                <!-- cantidad total defectos-->
                                                <input type="hidden" class="Num_CantVariablesdefectosSegunda" value="<?php echo $cont; ?>">


                                                <?php
                                                $cont2 = 0;
                                                foreach ($defectosSegundaDiaAnterior as $registro4) {
                                                    ?>
                                                                <?php if ($vecDefectosSegundaCreados[$registro4[1]] != $registro4[1]) { ?>
                                                                    <?php $AccionCampo2 = "1"; // crear  ?>
                                                        <tr>
                                                            <td>
                                                                <select id="ForD_DefectoSegundaAyer<?php echo $cont2; ?>" class="form-control" required>
                <?php foreach ($defectosParSegunda as $registro) { ?>
                                                                        <option value="<?php echo $registro[0]; ?>" <?php echo $registro4[1] == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td align="right">
                                                                <select id="ForD_EstampoSegundaAyer<?php echo $cont2; ?>" class="form-control" required>
                                                                    <option></option>
                <?php foreach ($estamposPar as $registro) { ?>
                                                                        <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td align="right">
                                                                <select id="ForD_LadoSegundaAyer<?php echo $cont2; ?>" class="form-control" required>
                                                                    <option></option>
                <?php foreach ($ladosPar as $registro) { ?>
                                                                        <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                                                        <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td align="right"><input type="text" id="ForD_NumeroPiezasSegundaAyer<?php echo $cont2; ?>" class="form-control" data-acc="<?php echo $AccionCampo2; ?>"></td>
                                                        </tr>
                <?php
                $cont2++;
            }
            ?>
        <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- cantidad total defectos-->
                        <input type="hidden" class="Num_CantVariablesdefectosSegundaAyer" value="<?php echo $cont2; ?>">
                        <!-- codigo Calidad -> Cal_Codigo -->
                        <input type="hidden" class="Cal_CodigoSegunda" value="<?php echo $CalSegCodigo; ?>">

    <?php if (isset($vectorFrecuCal[$CalRotCodigo][$_POST['hora']])) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <strong>Rotura/Desperdicio cocido</strong>
                                        <button style="float: right;" id="Btn_VariablesMasivasCalidadRoturaCrear" class="btn btn-primary btn-xs" data-cod= "<?php echo $CalRotCodigo; ?>" data-hor= "<?php echo $_POST['hora']; ?>" data-for="<?php echo $_POST['formato']; ?>" data-fam= "<?php echo $_POST['familia']; ?>" data-col="<?php echo $_POST['color']; ?>" data-EstU="<?php echo $_POST['codigo']; ?>">Crear</button>
                                    </div>

                                    <div class="panel-body">
        <?php /* ?><input type="hidden" id="" value="<?php echo $CalRotCodigo; ?>"><?php */ ?>
                                        <div class="table-responsive" id="imp_tabla">
                                            <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                                                <thead>
                                                    <tr class="encabezadoTab">
                                                        <th align="center" class="text-center">DEFECTO</th>
                                                        <th align="center" class="text-center">PUNZÓN</th>
                                                        <th align="center" class="text-center">LADO</th>
                                                        <th align="center" class="text-center">NÚMERO DE PIEZAS</th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="buscar">

        <?php
        $cont3 = 0;
        foreach ($defectosRoturaFor as $registro8) {
            ?>
                                                                <?php $AccionCampo2 = "2"; // actualizar  ?>
                                                        <!-- codigo Formulario defecto-->
                                                    <input type="hidden" id="ForD_CodigoRotura<?php echo $cont3; ?>" value="<?php echo $registro8[0]; ?>">
                                                    <tr>
                                                        <td>
                                                            <select id="ForD_DefectoRotura<?php echo $cont3; ?>" class="form-control" required>
            <?php foreach ($defectosParRotura as $registro) { ?>
                                                                    <option value="<?php echo $registro[0]; ?>" <?php echo $registro8[5] == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td align="right">
                                                            <select id="ForD_EstampoRotura<?php echo $cont3; ?>" class="form-control" required>
                                                                <option></option>
            <?php foreach ($estamposPar as $registro) { ?>
                                                                    <option value="<?php echo $registro[0]; ?>" <?php echo $registro8[6] == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td align="right">
                                                            <select id="ForD_LadoRotura<?php echo $cont3; ?>" class="form-control" required>
                                                                <option></option>
            <?php foreach ($ladosPar as $registro) { ?>
                                                                    <option value="<?php echo $registro[0]; ?>" <?php echo $registro8[7] == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                                                    <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td align="left"><input type="text" id="ForD_NumeroPiezasRotura<?php echo $cont3; ?>" class="form-control" value="<?php echo $registro8[4]; ?>" data-acc="<?php echo $AccionCampo2; ?>"></td>
                                                        <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_eliminarCalidadFormulario" data-cod="<?php echo $registro8[0]; ?>"><span class="glyphicon glyphicon-trash"></span></button></td>
                                                    </tr>
                                                    <?php
                                                    $cont3++;
                                                }
                                                ?>
                                                <!-- cantidad total defectos-->
                                                <input type="hidden" class="Num_CantVariablesdefectosRotura" value="<?php echo $cont3; ?>">

        <?php
        $cont4 = 0;
        foreach ($defectosRoturaDiaAnterior as $registro5) {
            ?>
                                                                <?php if ($vecDefectosRoturaCreados[$registro5[1]] != $registro5[1]) { ?>
                <?php $AccionCampo2 = "1"; // crear   ?>

                                                        <tr>
                                                            <td>
                                                                <select id="ForD_DefectoRoturaAyer<?php echo $cont4; ?>" class="form-control" required>
                                                                    <?php foreach ($defectosParRotura as $registro) { ?>
                                                                        <option value="<?php echo $registro[0]; ?>" <?php echo $registro5[1] == $registro[0] ? "selected" : ""; ?>><?php echo $registro[1]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td align="right">
                                                                <select id="ForD_EstampoRoturaAyer<?php echo $cont4; ?>" class="form-control" required>
                                                                    <option></option>
                                                                    <?php foreach ($estamposPar as $registro) { ?>
                                                                        <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td align="right">
                                                                <select id="ForD_LadoRoturaAyer<?php echo $cont4; ?>" class="form-control" required>
                                                                    <option></option>
                                                        <?php foreach ($ladosPar as $registro) { ?>
                                                                        <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                                                        <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td align="right"><input type="text" id="ForD_NumeroPiezasRoturaAyer<?php echo $cont4; ?>" class="form-control" data-acc="<?php echo $AccionCampo2; ?>"></td>
                                                        </tr>
                <?php
                $cont4++;
            }
            ?>
        <?php } ?>
                                                <!-- codigo Calidad -> Cal_Codigo -->
                                                <input type="hidden" class="Cal_CodigoRotura" value="<?php echo $CalRotCodigo; ?>">
                                                <!-- cantidad total defectos-->
                                                <input type="hidden" class="Num_CantVariablesdefectosRoturaAyer" value="<?php echo $cont4; ?>">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
    <?php } ?>
                    </div>
                    <div align="right" class="ocultarBotonVariablesMCCrear">
                        <button type="submit" class="btn btn-warning Btn_Notificaciones Btn_GuardarMasivoVarCalidad" form="f_variablesMasivasCalidadCrear" data-porCal="<?php echo $_POST['porcentajeCalidad']; ?>">Guardar</button>
                    </div>
                    <br>
                </div>
            </div>

        </div>
    </div>
<?php } else { ?>
  <div class="alert alert-danger" role="alert">Se encuentra fuera del tiempo de toma de la variable, Recuerde que tiene <?php echo $planta->getPla_Tolerancia(); ?> minutos antes y después de la hora de toma para realizar el registro</div>
<?php } ?>
<?php }else{
  include("op_cerrarSesion.php");
 } ?>
<script type="text/javascript">inputDecimales();</script>
