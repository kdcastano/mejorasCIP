<?php include('op_sesion.php');
include("../class/formularios_defectos.php");
include("../class/areas.php");
include_once("../class/usuarios.php");
include_once("../class/pacs.php");
include( "../class/maquinas.php" );
include( "../class/variables.php" );
include("c_hora.php");
include_once("../class/usuarios.php");
include_once("../class/formatos.php");
include_once("../class/agrupaciones.php");
include("../class/turnos.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");
$fecha2 = date("Y-m-d");

$var = new variables();

$maq = new maquinas();

$pac = new pacs();
$resPac = $pac->listarInfoPAC($_POST['formato'], $_POST['familia'], $_POST['color'], $_POST['calidad'], $_POST['fechaInicial'], $_POST['fechaFinal']);

foreach($resPac as $registro5){
  //hora, defecto
  $vecPac_Codigo[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[0];
  $vecOrigen[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[6];
  $vecMaquina[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[7];
  $vecvariable[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[8];
  $vecPlanAccion[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[9];
  $vecObsSupervisor[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[10];
  $vecHoraAjuste[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[11];
  $vecRequerimiento[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[12];
  $vecSupervisor[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[13];
//  $vecAreas[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[14];
  $vecvariableOtra[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[14];
  $vecObservacionJefe[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[15];
  $vecFechaProgramada[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[16];
  $vecFechaReal[date("H:i", strtotime($registro5[2]))][$registro5[5]] = $registro5[17];
}

$tur = new turnos();
$tur->setTur_Codigo($_POST['turno']);
$tur->consultar();

if($_POST['turno'] != "-1"){
  $FechaInicialRes = date("Y-m-d", strtotime($_POST['fecha']));
  $FechaFinalRes = date("Y-m-d", strtotime($_POST['fecha']));
  
  $HoraInicial = date("Y-m-d H:i", strtotime($_POST['fecha']." ".$tur->getTur_HoraInicio()));
  $HoraFinal = date("Y-m-d H:i", strtotime($_POST['fecha']." ".$tur->getTur_HoraFin() ." - 1 hour"));
  if($HoraInicial > $HoraFinal){
    $HoraFinal = date("Y-m-d H:i", strtotime($HoraFinal." + 1 days"));
    $FechaFinalRes = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));
  }
}else{
  $HoraInicial = date("Y-m-d 06:00", strtotime($_POST['fecha']));
  $HoraFinal = date("Y-m-d 05:00", strtotime($_POST['fecha']." + 1 days"));
  
  $FechaInicialRes = date("Y-m-d", strtotime($_POST['fecha']));
  $FechaFinalRes = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));
}


$HoraInicialValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraInicio()));
$HoraFinalValTEsp = date("Y-m-d H:i", strtotime($tur->getTur_HoraFin()));

$valEspTurnoR = 0;

//Validación por turno 3
if($HoraInicialValTEsp > $HoraFinalValTEsp){
 
  $fechaFinT = date("Y-m-d", strtotime($_POST['fecha']." - 1 days"));
  $HoraInicialRespT = date("H:i", strtotime($tur->getTur_HoraInicio()));
  $HoraFinalRespT = date("H:i", strtotime("23:59:00"));
  $HoraInicialRespT2 = date("H:i", strtotime("00:00:00"));
  $HoraFinalRespT2 = date("H:i", strtotime($tur->getTur_HoraFin()));
  
  // Ejm: hoy es 10-02-22
  
  if($HoraInicialValTEsp <= $hora && $hora <= "23:59"){
    
    //hoy 10-02-22
    $fechaIniT3 = date("Y-m-d", strtotime($_POST['fecha']));
    //mañana 11-02-22
    $fechaFinT3 = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));
  }else{
     
    //Dia nuevo
    //dia anterior 10-02-22 
    if($hora >= date("H:i", strtotime($HoraFinalValTEsp)) && $hora <= date("H:i", strtotime($HoraInicialValTEsp))){
      
      $fechaIniT3 = date("Y-m-d", strtotime($_POST['fecha']));
      //Hoy 11-02-22
      $fechaFinT3 = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));  
    }else{
      
      $fechaIniT3 = date("Y-m-d", strtotime($_POST['fecha']));
      //Hoy 11-02-22
      $fechaFinT3 = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));
    }
    
  }
  
  $valEspTurnoR = 1;
}else{
   
  $fechaFinT = $fecha2;
  $fechaIniT3 = $_POST['fecha'];
  $fechaFinT3 = date("Y-m-d", strtotime($_POST['fecha']." + 1 days"));;
  $valEspTurnoR = 0;
}


$for = new formularios_defectos();

$resFor = $for->listardefectosPAC($_POST['formato'], $_POST['familia'], $_POST['color'], $_POST['codigo'], $_POST['calidad'],date("H:i", strtotime($HoraInicial)), date("H:i", strtotime($HoraFinal)), $fechaIniT3, $fechaFinT3, $HoraInicialRespT, $HoraFinalRespT, $HoraInicialRespT2,$HoraFinalRespT2, $valEspTurnoR, $_POST['turno']);

$num = $_POST[ 'num' ];
$lista1 = $_POST[ 'lista1' ]; //valor
$lista2 = $_POST[ 'lista2' ]; //hora
$lista3 = $_POST[ 'lista3' ]; //color
$lista4 = $_POST[ 'lista4' ]; //fecha

for ( $i = 0; $i < $num; $i++ ) {
  $vecPorcentaje[$lista4[$i]][$lista2[$i]] = $lista1[$i];
  $vecColor[$lista4[$i]][$lista2[$i]] = $lista3[$i];
}

$are = new areas();
$resAre = $are->buscarAreasSegunCanal($_SESSION['CP_Usuario'],$_POST['agrupacion']);

//echo "codigo ".$_POST['codigo']." calidad ".$_POST['calidad']." formato ".$_POST['formato']." familia ".$_POST['familia']." color ".$_POST['color']." fecha ".$_POST['fecha']." estaU ".$_POST['estacionUsu'];

$resSupervisor = $usu->listarSupervisoresPAC($usu->getPla_Codigo());

$for = new formatos();
$for->setFor_Codigo($_POST['formato']);
$for->consultar();

$agr = new agrupaciones();
$agr->setAgr_Codigo($_POST['agrupacion']);
$agr->consultar();

?>

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>PAC'S - <?php echo $agr->getAgr_Nombre()."<br>"." Formato: ".$for->getFor_Nombre()." - Familia: ".$_POST['familia']." Color: ".$_POST['color'];  ?></strong>
      </div>

      <div class="panel-body">
        <form id="f_PanelSupervisorSegundaPACCrear"  role="form">
          <div class="table-responsive" id="imp_tabla">
            <table id="tbl_" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
              <thead>
                <tr class="encabezadoTab">
                  <th rowspan="2" class="vertical text-center" align="center">FECHA</th>
                  <th rowspan="2" class="vertical text-center" align="center">HORA</th>
                  <th rowspan="2" class="vertical text-center" align="center">TIPO</th>
                  <th rowspan="2" class="vertical text-center" align="center">DEFECTO</th>
                  <th rowspan="2" class="vertical text-center" align="center">%</th>
                  <th rowspan="2" class="vertical text-center" align="center">PLANES DE ACCIÓN</th>
                  <th rowspan="2" class="vertical text-center" align="center">SUPERVISOR</th>
                  <th colspan="2" class="vertical text-center" align="center">FECHA</th>
                  <th rowspan="2" class="vertical text-center" align="center">OBSERVACIÓN</th>
                  <th rowspan="2">&nbsp;</th>
                </tr>
                <tr class="encabezadoTab">
                  <th align="center" class="text-center">COMPROMISO</th>
                  <th align="center" class="text-center">CORRECCIÓN</th>
                </tr>
              </thead>
              <tbody class="buscar">
                <?php $cont = 0; $contSegunda = 0; $contRetal = 0; foreach($resFor as $registro2){ ?>
                  <?php if($_POST['tipo'] == "segunda"){ ?>
                    <?php if($vecPorcentaje[$registro2[0]][date("H:i", strtotime($registro2[1]))] > "1,0"){ $contSegunda++; ?>                
                      <input type="hidden" id="ForD_Codigo<?php echo $cont; ?>" value="<?php echo $registro2[4]; ?>">
                      <input type="hidden" id="Pac_Hora<?php echo $cont; ?>" value="<?php echo date("H:i", strtotime($registro2[1])); ?>">
				  	          <input type="hidden" id="Pac_Fecha<?php echo $cont; ?>" value="<?php echo $registro2[0]; ?>">
                      <tr>
                        <td nowrap class="vertical"><?php echo $registro2[0]; ?></td>
                        <td nowrap class="vertical"><?php echo date("H:i", strtotime($registro2[1])); ?></td>
                        <td nowrap class="vertical"><?php echo $registro2[2]; ?></td>
                        <td nowrap class="vertical"><?php echo $registro2[3]; ?></td>
                        <td nowrap class="vertical <?php if(isset($vecColor[$registro2[0]][date("H:i", strtotime($registro2[1]))])){ echo $vecColor[$registro2[0]][date("H:i", strtotime($registro2[1]))]; }  ?>">
                          <input type="hidden" id="Pac_Porcentaje<?php echo $cont; ?>" value="<?php echo $vecPorcentaje[$registro2[0]][date("H:i", strtotime($registro2[1]))]; ?>">
                          <?php echo $vecPorcentaje[$registro2[0]][date("H:i", strtotime($registro2[1]))]."%"; ?>
                        </td>
                        <input type="hidden" class="e_cambioOrigenCargueVariable" data-cod="<?php echo $cont; ?>" data-for="<?php echo $_POST['formato']; ?>" data-fam="<?php echo $_POST['familia']; ?>" data-col="<?php echo $_POST['color']; ?>">
                        <td nowrap>
                          <textarea class="form-control" id="Pac_AccionOperador<?php echo $cont; ?>" cols="10" rows="1" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>><?php if(isset($vecPlanAccion[date("H:i", strtotime($registro2[1]))][$_POST['codigo']])){ echo $vecPlanAccion[date("H:i", strtotime($registro2[1]))][$_POST['codigo']]; } ?></textarea>
                        </td>						 
                        <td nowrap>
                           <select id="Pac_Supervisor<?php echo $cont; ?>" class="form-control" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>>
                            <option value=""></option>
                            <?php foreach($resSupervisor as $registro4){ ?>
                              <option value="<?php echo $registro4[0]; ?>" <?php echo $vecSupervisor[date("H:i", strtotime($registro2[1]))][$_POST['codigo']] == $registro4[0] ? "selected":""; ?> ><?php echo $registro4[1]; ?></option>
                            <?php } ?>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control fecha" id="Pac_FechaProgramada<?php echo $cont; ?>" value="<?php if($vecFechaProgramada[date("H:i", strtotime($registro2[1]))][$_POST['codigo']] != ""){ echo $vecFechaProgramada[date("H:i", strtotime($registro2[1]))][$_POST['codigo']];} ?>" autocomplete="off" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>>
                        </td>
                        <td>
                          <input type="text" class="form-control fecha" id="Pac_FechaReal<?php echo $cont; ?>" value="<?php if($vecFechaReal[date("H:i", strtotime($registro2[1]))][$_POST['codigo']] != ""){ echo $vecFechaReal[date("H:i", strtotime($registro2[1]))][$_POST['codigo']];} ?>" autocomplete="off" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>>
                        </td>
                        <td nowrap>
                          <textarea class="form-control" id="Pac_AccionSupervisor<?php echo $cont; ?>" cols="10" rows="1" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>><?php if(isset($vecObsSupervisor[date("H:i", strtotime($registro2[1]))][$_POST['codigo']])){ echo $vecObsSupervisor[date("H:i", strtotime($registro2[1]))][$_POST['codigo']]; } ?></textarea>
                        </td>
                        <?php if(isset($vecPac_Codigo[date("H:i", strtotime($registro2[1]))][$_POST['codigo']])){ ?>
                        <input type="hidden" id="Pac_Codigo<?php echo $cont; ?>" value="<?php echo $vecPac_Codigo[date("H:i", strtotime($registro2[1]))][$_POST['codigo']]; ?>" >
                        <!-- Actualizar -->
                        <input type="hidden" id="accion<?php echo $cont; ?>" value="<?php echo "2"; ?>">
                       <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_eliminarPAC" data-cod="<?php echo $vecPac_Codigo[date("H:i", strtotime($registro2[1]))][$_POST['codigo']]; ?>" data-for="<?php echo $_POST['formato']; ?>" data-fam="<?php echo $_POST['familia']; ?>" data-col="<?php echo $_POST['color']; ?>" data-def="<?php echo $_POST['codigo']; ?>" data-cal="<?php echo $_POST['calidad']; ?>" data-estU="<?php echo $_POST['estacionUsu']; ?>" data-fec="<?php echo $_POST['fecha']; ?>" data-fecI="<?php echo $_POST['fechaInicial'] ?>" data-fecF="<?php echo $_POST['fechaFinal'] ?>" data-tip="<?php echo $_POST['tipo'] ?>" data-fil="<?php echo $_POST['fila'] ?>" data-num="<?php echo $_POST['num'] ?>" data-bot="<?php echo $_POST['codigo'] ?>" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>><span class="glyphicon glyphicon-trash"></span></button></td>
                      <?php }else{ ?>
                        <!-- Crear -->
                        <input type="hidden" id="accion<?php echo $cont; ?>" value="<?php echo "1"; ?>">
                      <?php } ?>
                      </tr>
                    <?php $cont++; } ?>                
                  <?php } ?>                               
                
                  <?php if($_POST['tipo'] == "retal"){ ?>
                    <?php if($vecPorcentaje[$registro2[0]][date("H:i", strtotime($registro2[1]))] > '0,5'){ $contRetal++; ?>                
                      <input type="hidden" id="ForD_Codigo<?php echo $cont; ?>" value="<?php echo $registro2[4]; ?>">
                      <input type="hidden" id="Pac_Hora<?php echo $cont; ?>" value="<?php echo date("H:i", strtotime($registro2[1])); ?>">
				  	          <input type="hidden" id="Pac_Fecha<?php echo $cont; ?>" value="<?php echo $registro2[0]; ?>">
                      <tr>
                        <td nowrap class="vertical"><?php echo $registro2[0]; ?></td>
                        <td nowrap class="vertical"><?php echo date("H:i", strtotime($registro2[1])); ?></td>
                        <td nowrap class="vertical"><?php echo $registro2[2]; ?></td>
                        <td nowrap class="vertical"><?php echo $registro2[3]; ?></td>
                        <td nowrap class="vertical <?php if(isset($vecColor[$registro2[0]][date("H:i", strtotime($registro2[1]))])){ echo $vecColor[$registro2[0]][date("H:i", strtotime($registro2[1]))]; }  ?>">
                          <input type="hidden" id="Pac_Porcentaje<?php echo $cont; ?>" value="<?php echo $vecPorcentaje[$registro2[0]][date("H:i", strtotime($registro2[1]))]; ?>">
                          <?php echo $vecPorcentaje[$registro2[0]][date("H:i", strtotime($registro2[1]))]."%"; ?>
                        </td>
                        <input type="hidden" class="e_cambioOrigenCargueVariable" data-cod="<?php echo $cont; ?>" data-for="<?php echo $_POST['formato']; ?>" data-fam="<?php echo $_POST['familia']; ?>" data-col="<?php echo $_POST['color']; ?>">
                        <td nowrap>
                          <textarea class="form-control" id="Pac_AccionOperador<?php echo $cont; ?>" cols="10" rows="1" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>><?php if(isset($vecPlanAccion[date("H:i", strtotime($registro2[1]))][$_POST['codigo']])){ echo $vecPlanAccion[date("H:i", strtotime($registro2[1]))][$_POST['codigo']]; } ?></textarea>
                        </td>			  
                        <td nowrap>
                           <select id="Pac_Supervisor<?php echo $cont; ?>" class="form-control" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>>
                            <option value=""></option>
                            <?php foreach($resSupervisor as $registro4){ ?>
                              <option value="<?php echo $registro4[0]; ?>" <?php echo $vecSupervisor[date("H:i", strtotime($registro2[1]))][$_POST['codigo']] == $registro4[0] ? "selected":""; ?> ><?php echo $registro4[1]; ?></option>
                            <?php } ?>
                          </select>
                        </td>						  
                       <td>
                        <input type="text" class="form-control fecha" id="Pac_FechaProgramada<?php echo $cont; ?>" value="<?php if(isset($vecFechaProgramada[date("H:i", strtotime($registro2[1]))][$_POST['codigo']])){ echo $vecFechaProgramada[date("H:i", strtotime($registro2[1]))][$_POST['codigo']];} ?>" autocomplete="off" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>>
                      </td>
                      <td>
                        <input type="text" class="form-control fecha" id="Pac_FechaReal<?php echo $cont; ?>" value="<?php if(isset($vecFechaReal[date("H:i", strtotime($registro2[1]))][$_POST['codigo']])){ echo $vecFechaReal[date("H:i", strtotime($registro2[1]))][$_POST['codigo']];} ?>" autocomplete="off" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>>
                      </td>
                      <td nowrap>
                        <textarea class="form-control" id="Pac_AccionSupervisor<?php echo $cont; ?>" cols="10" rows="1" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>><?php if(isset($vecObsSupervisor[date("H:i", strtotime($registro2[1]))][$_POST['codigo']])){ echo $vecObsSupervisor[date("H:i", strtotime($registro2[1]))][$_POST['codigo']]; } ?></textarea>
                      </td>
                        <?php if(isset($vecPac_Codigo[date("H:i", strtotime($registro2[1]))][$_POST['codigo']])){ ?>
                        <input type="hidden" id="Pac_Codigo<?php echo $cont; ?>" value="<?php echo $vecPac_Codigo[date("H:i", strtotime($registro2[1]))][$_POST['codigo']]; ?>" >
                        <!-- Actualizar -->
                        <input type="hidden" id="accion<?php echo $cont; ?>" value="<?php echo "2"; ?>">
                       <td align="center" class="vertical"><button class="btn btn-danger btn-xs e_eliminarPAC" data-cod="<?php echo $vecPac_Codigo[date("H:i", strtotime($registro2[1]))][$_POST['codigo']]; ?>" data-for="<?php echo $_POST['formato']; ?>" data-fam="<?php echo $_POST['familia']; ?>" data-col="<?php echo $_POST['color']; ?>" data-def="<?php echo $_POST['codigo']; ?>" data-cal="<?php echo $_POST['calidad']; ?>" data-estU="<?php echo $_POST['estacionUsu']; ?>" data-fec="<?php echo $_POST['fecha']; ?>" data-fecI="<?php echo $_POST['fechaInicial'] ?>" data-fecF="<?php echo $_POST['fechaFinal'] ?>" data-tip="<?php echo $_POST['tipo'] ?>" data-fil="<?php echo $_POST['fila'] ?>" data-num="<?php echo $_POST['num'] ?>" data-bot="<?php echo $_POST['codigo'] ?>" <?php if($usu->getUsu_Rol() != "3" && $usu->getUsu_Rol() != "4" && $usu->getUsu_Rol() != "11"){ echo "disabled"; } ?>><span class="glyphicon glyphicon-trash"></span></button></td>
                      <?php }else{ ?>
                        <!-- Crear -->
                        <input type="hidden" id="accion<?php echo $cont; ?>" value="<?php echo "1"; ?>">
                      <?php } ?>
                      </tr>
                    <?php $cont++; } ?>                
                  <?php } ?>                 
                <?php  } ?>
              </tbody>
            </table>
          </div>
          <div class="limpiar"></div>
          <br>
          <?php if($usu->getUsu_Rol() == "3" || $usu->getUsu_Rol() == "4" || $usu->getUsu_Rol() == "11" || $usu->getUsu_Rol() == "5" || $usu->getUsu_Rol() == "10"){ ?>
            <div align="right" class="ocultarBtn_GuardarMasivoPAC">
              <?php if($contRetal != "0" || $contSegunda != "0"){ ?>
              <button type="submit" class="btn btn-warning Btn_Notificaciones Btn_GuardarMasivoPAC" data-cal="<?php echo $_POST['calidad']; ?>" data-def="<?php echo $_POST['codigo']; ?>" >Guardar</button>
              <input type="hidden" class="Num_CantVariablesPAC" value="<?php echo $cont; ?>">
              <?php } ?>
            </div>
          <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">cargarhora();</script>
<script type="text/javascript">cargarfecha();</script>