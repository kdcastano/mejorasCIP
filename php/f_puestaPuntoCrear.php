<?php include("op_sesion.php");
include("../class/formatos.php");
include("../class/estaciones_usuarios.php");
include("../class/programa_produccion.php");
include( "../class/puesta_puntos.php" );
include_once("../class/usuarios.php");
include( "../class/plantas.php" );
include( "../class/puesta_puntos_aprobaciones.php" );

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$usu2 = new usuarios();

$pla = new plantas();
$pla->setPla_Codigo($usu->getPla_Codigo());
$pla->consultar();

$estu= new estaciones_usuarios();
$estu->setEstU_Codigo($_POST['estaUsu']);
$estu->consultar();

$pro= new programa_produccion();
$pro->setProP_Codigo($estu->getProP_Codigo());
$pro->consultar();


$for = new formatos();
$for->setFor_Codigo($pro->getFor_Codigo());
$for->consultar();

$diaAnterior = date("Y-m-d", strtotime($fecha." - 3 days"));
$diaSiguiente = date("Y-m-d", strtotime($fecha." + 1 days"));

$pue = new puesta_puntos();
$resPue = $pue->listarPuestaPuntosCreados($diaAnterior,$diaSiguiente,$for->getFor_Codigo(),$pro->getProP_Familia(),$pro->getProP_Color());

foreach($resPue as $registro){
  $codPuestaPunto[$registro[3]][$registro[1]] = $registro[0];
}

if($codPuestaPunto[$pro->getProP_Codigo()][$_POST['variableCodigo']] != ""){
  $pue->setPueP_Codigo($codPuestaPunto[$pro->getProP_Codigo()][$_POST['variableCodigo']]);
  $pue->consultar();
  
  $ope = new usuarios();
  $ope->setUsu_Codigo($pue->getUsu_Codigo());
  $ope->consultar();
  
  $usu2->setUsu_Codigo($pue->getUsu_Codigo());
  $usu2->consultar();
}


$pueApro = new puesta_puntos_aprobaciones();
$resPueApro = $pueApro->buscarPuestaPuntoCreadas($pue->getPueP_Codigo());

foreach($resPueApro as $registro){
  $vectAprobadorPuestPunt[$registro[1]][$registro[2]] = $registro[0];
  $vectAprobadorPuestPuntDescripcion[$registro[1]][$registro[2]] = $registro[3];
  $vectAprobadorPuestPuntEstado[$registro[1]][$registro[2]] = $registro[4];
  $vectAprobadorPuestPuntFecha[$registro[1]][$registro[2]] = $registro[5];
  $vectAprobadorPuestPuntHora[$registro[1]][$registro[2]] = $registro[6];
  $vectAprobadorPuestPuntNombre[$registro[1]][$registro[2]] = $registro[7];
  $vectAprobadorPuestPuntAprobador[$registro[1]][$registro[2]] = $registro[2];
}
//var_dump($vectAprobadorPuestPuntDescripcion);

?>
<!--maquina: d_maquina, variable: d_variable, variableCodigo: d_variableCodigo, estaUsu: d_estacionUsu, hora: d_hora-->
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>PUESTA A PUNTO <?php echo "<br>"."Hora: ".$_POST['hora']." - "."Referencia: ".$for->getFor_Nombre()." ".$pro->getProP_Familia()." ".$pro->getProP_Color(); ?></strong>
      </div>

      <div class="panel-body">
        <form id="f_puestaPuntoCrear" role="form">
         <input type="hidden" id="Var_Codigo" value="<?php echo $_POST['variableCodigo']; ?>">
         <input type="hidden" id="ProP_Codigo" value="<?php echo $pro->getProP_Codigo(); ?>">
         <input type="hidden" id="PueP_UnidadMedida" value="<?php echo $_POST['unidadMedida']; ?>">
         <input type="hidden" id="PueP_TipoVariable" value="<?php echo $_POST['tipo']; ?>">
         <input type="hidden" id="HoraSolicitadaPP" value="<?php echo $_POST['hora']; ?>">
         <input type="hidden" id="PueP_Fecha" value="<?php echo $_POST['fecha']; ?>">
         <div border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
           <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
              <thead>
                 <tr class="encabezadoTab">
                  <th colspan="7" align="center" class="text-center vertical">SOLICITUD</th>
                </tr>
                <tr class="encabezadoTab">
                  <th rowspan="2" align="center" class="text-center vertical">Hora inicio</th>
                  <th rowspan="2" align="center" class="text-center vertical">Máquina</th>
                  <th rowspan="2" align="center" class="text-center vertical">Variable</th>
                  <th colspan="3" align="center" class="text-center">Valor</th>
                  <th rowspan="2" align="center" class="text-center vertical">Unidad medida</th>
                </tr>
              </thead>
              <tbody class="buscar">
                <tr>
                  <td align="center" nowrap class="vertical text-center"><?php if($pue->getPueP_Hora()){echo date("H:i", strtotime($pue->getPueP_Hora()));}else{ echo $_POST['hora'];} ?></td>
                  <td align="left" class="vertical"><?php echo $_POST['maquina']; ?></td>
                  <td align="left" class="vertical"><?php echo $_POST['variable']; ?></td>
                  <td align="left" class="vertical">
                    <input type="text" id="PueP_ValorControl" class="form-control inputDecimales" autocomplete="off" <?php if($pue->getPueP_ValorControl() != ""){ echo "value="."'".$pue->getPueP_ValorControl()."'"." "."disabled";} ?> required>
                  </td>
                  <td align="left" class="vertical">
                    <select id="PueP_Operador" class="form-control inputDecimales" <?php if($pue->getPueP_Operador() != ""){ echo "disabled"; } ?>>
                      <option value="1" <?php echo $pue->getPueP_Operador() == "1" ? "selected":""; ?>> <?php echo ">="; ?></option>
                      <option value="2" <?php echo $pue->getPueP_Operador() == "2" ? "selected":""; ?>> <?php echo "<="; ?></option>
                      <option value="3" selected <?php echo $pue->getPueP_Operador() == "3" ? "selected":""; ?>> <?php echo "+-"; ?></option>
                    </select>
                  </td>
                  <td align="left" class="vertical">
                    <input type="text" id="PueP_ValorTolerancia" class="form-control inputDecimales" autocomplete="off" <?php if($pue->getPueP_ValorTolerancia() != ""){ echo "value="."'".$pue->getPueP_ValorTolerancia()."'"." "."disabled";} ?> required>
                  </td>
                  <td align="left" class="vertical"><?php echo $_POST['unidadMedida']; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-3 col-md-3 col-sm-3"></div>
            <div class="col-lg-6 col-md-6 col-sm-6">
               <div border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                  <thead>
                    <tr class="encabezadoTab">
                      <th colspan="4" align="center" class="text-center vertical">SOLICITANTE</th>
                    </tr>
                    <tr class="encabezadoTab">
                      <th rowspan="2" align="center" class="text-center vertical">Fecha</th>
                      <th rowspan="2" align="center" class="text-center vertical">Hora</th>
                      <th rowspan="2" align="center" class="text-center vertical">Operario</th>
                      <th rowspan="2" align="center" class="text-center vertical">Observación</th>
                    </tr>
                  </thead>
                  <tbody class="buscar">
                    <tr>
                      <td align="center" class="text-center vertical" nowrap><?php if($pue->getPueP_Fecha()){echo $pue->getPueP_Fecha();}else{ echo $fecha;} ?></td>
                      <td align="center" class="text-center vertical" nowrap><?php if($pue->getPueP_FechaHoraUsuarioCrea()){echo date("H:i", strtotime($pue->getPueP_FechaHoraUsuarioCrea()));}else{ echo $hora;} ?></td>
                      <td align="left" class="vertical"><?php if($pue->getPueP_Codigo() == ""){ echo $usu->getUsu_Nombres()." ".$usu->getUsu_Apellidos(); }else{ echo $ope->getUsu_Nombres()." ".$ope->getUsu_Apellidos();} ?></td>
                      <td align="left" class="vertical">
                         <textarea class="form-control" id="PueP_MotivoCambio" style="height: 28px;" <?php if($pue->getPueP_MotivoCambio() != ""){ echo "disabled";} ?> required><?php if($pue->getPueP_MotivoCambio() != ""){ echo $pue->getPueP_MotivoCambio();} ?></textarea> 
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <?php if($pue->getPueP_Codigo()){ ?>
             <div class="col-lg-12 col-md-12 col-sm-12">
              <?php if($pla->getPla_CantidadAprobador() >= "2"){ ?>
                <?php for($i=1;$i<=$pla->getPla_CantidadAprobador();$i++){ ?>
                  <div class="col-lg-6 col-md-6 col-sm-6">
                     <div border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                      <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                        <thead>
                          <tr class="encabezadoTab">
                            <th colspan="5" align="center" class="text-center vertical">APROBACIÓN <?php echo $i; ?></th>
                          </tr>
                          <tr class="encabezadoTab">
                            <th rowspan="2" align="center" class="text-center vertical">Fecha</th>
                            <th rowspan="2" align="center" class="text-center vertical">Hora</th>
                            <th rowspan="2" align="center" class="text-center vertical">Nombre</th>
                            <th rowspan="2" align="center" class="text-center vertical">Observación</th>
                            <th rowspan="2" align="center" class="text-center vertical">Estado</th>
                          </tr>
                        </thead>
                        <tbody class="buscar">
                          <tr> 
                              <td align="center" class="text-center vertical" nowrap><?php if($vectAprobadorPuestPuntAprobador[$pue->getPueP_Codigo()][$i] == $i){if($vectAprobadorPuestPuntFecha[$pue->getPueP_Codigo()][$i]){echo $vectAprobadorPuestPuntFecha[$pue->getPueP_Codigo()][$i];}} ?></td>
                              <td align="center" class="text-center vertical" nowrap><?php if($vectAprobadorPuestPuntAprobador[$pue->getPueP_Codigo()][$i] == $i){if($vectAprobadorPuestPuntHora[$pue->getPueP_Codigo()][$i]){echo date("H:i", strtotime($vectAprobadorPuestPuntHora[$pue->getPueP_Codigo()][$i]));}}?></td>
                              <td align="center" class="text-center vertical" nowrap><?php if($vectAprobadorPuestPuntAprobador[$pue->getPueP_Codigo()][$i] == $i){ echo $vectAprobadorPuestPuntNombre[$pue->getPueP_Codigo()][$i]; } ?></td>
                              <td align="left" class="vertical">
                                <textarea class="form-control PueP_ObservacionSupervisor<?php echo $i; ?>" data-act="<?php echo $vectAprobadorPuestPunt[$pue->getPueP_Codigo()][$i]; ?>" style="height: 28px;" required <?php echo $pue->getPueP_Estado() == "2" ? "disabled":""; ?> 
                                        <?php
                                         if($i == "1"){
                                           echo $pAprobadorSupervisor[3] == "1" ? "required " : "disabled ";
                                         }   
                                        if($i == "2"){
                                          echo $pAprobadorDos[3] == "1" ? "required " : "disabled"; 
                                        } 
                                        if($i == "3"){
                                          echo $pAprobadorTres[3] == "1" ? "required " : "disabled"; 
                                        }
                                  ?>><?php if($vectAprobadorPuestPuntAprobador[$pue->getPueP_Codigo()][$i] == $i){ if($vectAprobadorPuestPuntDescripcion[$pue->getPueP_Codigo()][$i]){ echo $vectAprobadorPuestPuntDescripcion[$pue->getPueP_Codigo()][$i]; } } ?></textarea>
                              </td>
                              <td>
                                <select class="form-control inputDecimales PueP_Estado<?php echo $i; ?>" <?php echo $pue->getPueP_Estado() == "2" ? "disabled":""; ?> <?php
                                        if($i == "1"){
                                           echo $pAprobadorSupervisor[3] == "1" ? "required ":"disabled";
                                         }   
                                        if($i == "2"){
                                          echo $pAprobadorDos[3] == "1" ? "required ":"disabled"; 
                                        } 
                                        if($i == "3"){
                                          echo $pAprobadorTres[3] == "1" ? "required ":"disabled"; 
                                        }
                                    ?>>
                                  <option value="" selected disabled> <?php echo "Pendiente Autorización"; ?></option>
                                  <option value="2" <?php if($vectAprobadorPuestPuntAprobador[$pue->getPueP_Codigo()][$i] == $i){ echo $vectAprobadorPuestPuntEstado[$pue->getPueP_Codigo()][$i] == "2" ? "selected":""; } ?>> <?php echo "Aprobado"; ?></option>
                                  <option value="3" <?php if($vectAprobadorPuestPuntAprobador[$pue->getPueP_Codigo()][$i] == $i){ echo $vectAprobadorPuestPuntEstado[$pue->getPueP_Codigo()][$i] == "3" ? "selected":"";} ?>> <?php echo "Rechazado"; ?></option>
                                </select>
                              </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                <?php } ?>
              <?php }else{ ?>
                <div class="col-lg-6 col-md-6 col-sm-6">
                   <div border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                    <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                      <thead>
                        <tr class="encabezadoTab">
                          <th colspan="5" align="center" class="text-center vertical">APROBACIÓN <?php echo "1"; ?></th>
                        </tr>
                        <tr class="encabezadoTab">
                          <th rowspan="2" align="center" class="text-center vertical">Fecha</th>
                          <th rowspan="2" align="center" class="text-center vertical">Hora</th>
                          <th rowspan="2" align="center" class="text-center vertical">Nombre</th>
                          <th rowspan="2" align="center" class="text-center vertical">Observación</th>
                          <th rowspan="2" align="center" class="text-center vertical">Estado</th>
                        </tr>
                      </thead>
                      <tbody class="buscar">
                        <tr>
                          <td align="center" class="text-center vertical" nowrap><?php if($vectAprobadorPuestPuntFecha[$pue->getPueP_Codigo()][1]){echo $vectAprobadorPuestPuntFecha[$pue->getPueP_Codigo()][1];} ?></td>
                          <td align="center" class="text-center vertical" nowrap><?php if($vectAprobadorPuestPuntHora[$pue->getPueP_Codigo()][1]){echo date("H:i", strtotime($vectAprobadorPuestPuntHora[$pue->getPueP_Codigo()][1]));} ?></td>
                          <td align="center" class="text-center vertical" nowrap><?php echo $vectAprobadorPuestPuntNombre[$pue->getPueP_Codigo()][1]; ?></td>
                          <td align="left" class="vertical">
                            <textarea class="form-control PueP_ObservacionSupervisor<?php echo 1; ?>" data-act="<?php echo $vectAprobadorPuestPunt[$pue->getPueP_Codigo()][1]; ?>" style="height: 28px;" required <?php echo $pue->getPueP_Estado() == "2" ? "disabled":""; ?> 
                                    <?php
                                       echo $pAprobadorSupervisor[3] == "1" ? "required " : "disabled ";
                              ?>><?php if($vectAprobadorPuestPuntDescripcion[$pue->getPueP_Codigo()][1]){ echo $vectAprobadorPuestPuntDescripcion[$pue->getPueP_Codigo()][1]; }; ?></textarea>
                          </td>
                          <td>
                            <select class="form-control inputDecimales PueP_Estado<?php echo 1; ?>" <?php echo $pue->getPueP_Estado() == "2" ? "disabled":""; ?> <?php
                                       echo $pAprobadorSupervisor[3] == "1" ? "required ":"disabled";
                                ?>>
                              <option value="" selected disabled> <?php echo "Pendiente Autorización"; ?></option>
                              <option value="2" <?php echo $vectAprobadorPuestPuntEstado[$pue->getPueP_Codigo()][1] == "2" ? "selected":""; ?>> <?php echo "Aprobado"; ?></option>
                              <option value="3" <?php echo $vectAprobadorPuestPuntEstado[$pue->getPueP_Codigo()][1] == "3" ? "selected":""; ?>> <?php echo "Rechazado"; ?></option>
                            </select>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php } ?>
            </div>
          <?php } ?>
          <?php if($codPuestaPunto[$pro->getProP_Codigo()][$_POST['variableCodigo']] == "" || $codPuestaPunto[$pro->getProP_Codigo()][$_POST['variableCodigo']] == null){ ?>
            <div align="right">
              <button type="submit" class="btn btn-primary" id="Btn_PuestaPuntoCrearForm">Crear</button>
            </div>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">inputDecimales();</script>