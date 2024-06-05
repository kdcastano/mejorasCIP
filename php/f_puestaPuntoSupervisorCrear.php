<?php include("op_sesion.php");
include("../class/formatos.php");
include("../class/programa_produccion.php");
include("../class/puesta_puntos.php");
include("../class/variables.php");
include( "../class/plantas.php" );
include_once("../class/usuarios.php");
include( "../class/puesta_puntos_aprobaciones.php" );

$pAprobadorSupervisor = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "54" );
$pAprobadorDos = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "55" );
$pAprobadorTres = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "56" );

$pla = new plantas();
$pla->setPla_Codigo($usu->getPla_Codigo());
$pla->consultar();

$pue = new puesta_puntos();
$pue->setPueP_Codigo($_POST['puestaPunto']);
$pue->consultar();

$pueApro = new puesta_puntos_aprobaciones();
$resPueApro = $pueApro->buscarPuestaPuntoCreadas($_POST['puestaPunto']);

foreach($resPueApro as $registro){
  $vectAprobadorPuestPunt[$registro[1]][$registro[2]] = $registro[0];
  $vectAprobadorPuestPuntDescripcion[$registro[1]][$registro[2]] = $registro[3];
  $vectAprobadorPuestPuntEstado[$registro[1]][$registro[2]] = $registro[4];
  $vectAprobadorPuestPuntFecha[$registro[1]][$registro[2]] = $registro[5];
  $vectAprobadorPuestPuntHora[$registro[1]][$registro[2]] = $registro[6];
  $vectAprobadorPuestPuntNombre[$registro[1]][$registro[2]] = $registro[7];
  $vectAprobadorPuestPuntAprobador[$registro[1]][$registro[2]] = $registro[2];
}

$var = new variables();
$var->setVar_Codigo($pue->getVar_Codigo());
$var->consultar();


$pro= new programa_produccion();
$pro->setProP_Codigo($pue->getProP_Codigo());
$pro->consultar();


$for = new formatos();
$for->setFor_Codigo($pro->getFor_Codigo());
$for->consultar();

$ope = new usuarios();
$ope->setUsu_Codigo($pue->getUsu_Codigo());
$ope->consultar();



?>
<!--maquina: d_maquina, variable: d_variable, variableCodigo: d_variableCodigo, estaUsu: d_estacionUsu, hora: d_hora-->
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>PUESTA A PUNTO <?php echo "<br>"."Referencia: ".$for->getFor_Nombre()." ".$pro->getProP_Familia()." ".$pro->getProP_Color(); ?></strong>
      </div>

      <div class="panel-body">
        <form id="f_puestaPuntoSupervisorActualizar" role="form">
         <input type="hidden" id="PueP_Codigo" value="<?php echo $pue->getPueP_Codigo(); ?>">
         <input type="hidden" id="contadorAprobador" value="<?php echo $pla->getPla_CantidadAprobador(); ?>">
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
                <tr class="encabezadoTab">
                  <th align="center" class="text-center">Control</th>
                  <th align="center" class="text-center">Operador</th>
                  <th align="center" class="text-center">Tolerancia</th>
                </tr>
              </thead>
              <tbody class="buscar">
                <tr>
                  <td align="center" nowrap class="vertical text-center"><?php if($pue->getPueP_Hora()){echo date("H:i", strtotime($pue->getPueP_Hora()));}else{ echo $_POST['hora'];} ?></td>
                  <td align="left" class="vertical"><?php echo $_POST['maquina']; ?></td>
                  <td align="left" class="vertical"><?php echo $var->getVar_Nombre(); ?></td>
                  <td align="left" class="vertical">
                    <input type="text" id="PueP_ValorControl" class="form-control inputDecimales" autocomplete="off" value="<?php echo $pue->getPueP_ValorControl(); ?>" required>
                  </td>
                  <td align="left" class="vertical">
                    <select id="PueP_Operador" class="form-control inputDecimales">
                      <option value="1" <?php echo $pue->getPueP_Operador() == "1" ? "selected":""; ?>> <?php echo ">="; ?></option>
                      <option value="2" <?php echo $pue->getPueP_Operador() == "2" ? "selected":""; ?>> <?php echo "<="; ?></option>
                      <option value="3" <?php echo $pue->getPueP_Operador() == "3" ? "selected":""; ?>> <?php echo "+-"; ?></option>
                    </select>
                  </td>
                  <td align="left" class="vertical">
                    <input type="text" id="PueP_ValorTolerancia" class="form-control inputDecimales" autocomplete="off" value="<?php echo $pue->getPueP_ValorTolerancia(); ?>" required>
                  </td>
                  <td align="left" class="vertical"><?php echo $pue->getPueP_UnidadMedida(); ?></td>
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
                      <td align="left" class="vertical"><?php echo $ope->getUsu_Nombres()." ".$ope->getUsu_Apellidos(); ?></td>
                      <td align="left" class="vertical">
                        <textarea class="form-control" id="PueP_MotivoCambio" style="height: 28px;" disabled ><?php echo $pue->getPueP_MotivoCambio(); ?></textarea>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
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
                            <td align="center" class="text-center vertical" nowrap><?php if($vectAprobadorPuestPuntAprobador[$_POST['puestaPunto']][$i] == $i){if($vectAprobadorPuestPuntFecha[$_POST['puestaPunto']][$i]){echo $vectAprobadorPuestPuntFecha[$_POST['puestaPunto']][$i];}} ?></td>
                            <td align="center" class="text-center vertical" nowrap><?php if($vectAprobadorPuestPuntAprobador[$_POST['puestaPunto']][$i] == $i){if($vectAprobadorPuestPuntHora[$_POST['puestaPunto']][$i]){echo date("H:i", strtotime($vectAprobadorPuestPuntHora[$_POST['puestaPunto']][$i]));}}?></td>
                            <td align="center" class="text-center vertical" nowrap><?php if($vectAprobadorPuestPuntAprobador[$_POST['puestaPunto']][$i] == $i){ echo $vectAprobadorPuestPuntNombre[$_POST['puestaPunto']][$i]; } ?></td>
                            <td align="left" class="vertical">
                              <textarea class="form-control PueP_ObservacionSupervisor<?php echo $i; ?>" data-act="<?php echo $vectAprobadorPuestPunt[$_POST['puestaPunto']][$i]; ?>" style="height: 28px;" minlength="20" required <?php /*?><?php echo $pue->getPueP_Estado() == "2" ? "disabled":""; ?><?php */?> 
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
                                ?>><?php 
                                        
//                                   if($_SESSION['CP_Usuario'] == "1"){
//                                          if($i == "1"){
//                                         echo $pAprobadorSupervisor[3] == "1" ? "required1 " : "disabled1 ";
//                                            echo " puestaPunto ".$pue->getPueP_Estado();
//                                           }   
//                                          if($i == "2"){
//                                            echo $pAprobadorDos[3] == "1" ? "required2 " : "disabled2"; 
//                                            echo " puestaPunto ".$pue->getPueP_Estado();
//                                          } 
//                                          if($i == "3"){
//                                            echo $pAprobadorTres[3] == "1" ? "required3 " : "disabled3"; 
//                                            echo " puestaPunto ".$pue->getPueP_Estado();
//                                          }
//                                        }
                                                                        
                                  if($vectAprobadorPuestPuntAprobador[$_POST['puestaPunto']][$i] == $i){ if($vectAprobadorPuestPuntDescripcion[$_POST['puestaPunto']][$i]){ echo $vectAprobadorPuestPuntDescripcion[$_POST['puestaPunto']][$i]; } } ?></textarea>
                            </td>
                            <td>
                              <select class="form-control inputDecimales PueP_Estado<?php echo $i; ?>" <?php /*?><?php echo $pue->getPueP_Estado() == "2" ? "disabled":""; ?><?php */?> <?php
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
                                <option value="2" <?php if($vectAprobadorPuestPuntAprobador[$_POST['puestaPunto']][$i] == $i){ echo $vectAprobadorPuestPuntEstado[$_POST['puestaPunto']][$i] == "2" ? "selected":""; } ?>> <?php echo "Aprobado"; ?></option>
                                <option value="3" <?php if($vectAprobadorPuestPuntAprobador[$_POST['puestaPunto']][$i] == $i){ echo $vectAprobadorPuestPuntEstado[$_POST['puestaPunto']][$i] == "3" ? "selected":"";} ?>> <?php echo "Rechazado"; ?></option>
                              </select>
                            </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php } ?>
            <?php }else{ ?>
              <?php if($pue->getPueP_Codigo()){ ?>
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
                          <td align="center" class="text-center vertical" nowrap><?php if($vectAprobadorPuestPuntFecha[$_POST['puestaPunto']][1]){echo $vectAprobadorPuestPuntFecha[$_POST['puestaPunto']][1];} ?></td>
                          <td align="center" class="text-center vertical" nowrap><?php if($vectAprobadorPuestPuntHora[$_POST['puestaPunto']][1]){echo date("H:i", strtotime($vectAprobadorPuestPuntHora[$_POST['puestaPunto']][1]));} ?></td>
                          <td align="center" class="text-center vertical" nowrap><?php echo $vectAprobadorPuestPuntNombre[$_POST['puestaPunto']][1]; ?></td>
                          <td align="left" class="vertical">
                            <textarea class="form-control PueP_ObservacionSupervisor<?php echo 1; ?>" data-act="<?php echo $vectAprobadorPuestPunt[$_POST['puestaPunto']][1]; ?>" style="height: 28px;" minlength="20" required <?php /*?><?php echo $pue->getPueP_Estado() == "2" ? "disabled":""; ?><?php */?> 
                                    <?php
                                       echo $pAprobadorSupervisor[3] == "1" ? "required " : "disabled ";
                              ?>><?php if($vectAprobadorPuestPuntDescripcion[$_POST['puestaPunto']][1]){ echo $vectAprobadorPuestPuntDescripcion[$_POST['puestaPunto']][1]; }; ?></textarea>
                          </td>
                          <td>
                            <select class="form-control inputDecimales PueP_Estado<?php echo 1; ?>" <?php /*?><?php echo $pue->getPueP_Estado() == "2" ? "disabled":""; ?><?php */?> <?php
                                       echo $pAprobadorSupervisor[3] == "1" ? "required ":"disabled";
                                ?>>
                              <option value="" selected disabled> <?php echo "Pendiente Autorización"; ?></option>
                              <option value="2" <?php echo $vectAprobadorPuestPuntEstado[$_POST['puestaPunto']][1] == "2" ? "selected":""; ?>> <?php echo "Aprobado"; ?></option>
                              <option value="3" <?php echo $vectAprobadorPuestPuntEstado[$_POST['puestaPunto']][1] == "3" ? "selected":""; ?>> <?php echo "Rechazado"; ?></option>
                            </select>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">inputDecimales();</script>