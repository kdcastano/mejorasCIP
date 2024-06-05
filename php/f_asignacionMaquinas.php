<?php include("op_sesion.php");
include( "../class/agrupaciones_maquinas.php" );
include( "../class/maquinas.php" );
include( "../class/agrupaciones_maquinas_configft.php" );
include_once( "../class/usuarios.php" );

$pAgrupacionesMaq = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "40" );

$agrM = new agrupaciones_maquinas();
$agrM->setAgrM_Codigo($_POST['codigo']);
$agrM->consultar();

$maq = new maquinas();
$resMaq = $maq->listarMaquinasPorPlanta($usu->getPla_Codigo());
$cantMaquinas = count($resMaq);

$agrMaqCFT = new agrupaciones_maquinas_configft();
$ResAgrMaqCFT = $agrMaqCFT->listarMaquinasExistentes($_POST['codigo']);
$listAgrMaqCFT = $agrMaqCFT->listarMaquinasAgrupacionM($_POST['codigo']);
$contAgruMaquinas = count($listAgrMaqCFT);

foreach($ResAgrMaqCFT as $registro2){
  $vecMaquinasExistentes[$registro2[0]] = $registro2[0];
}

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <?php if($cantMaquinas == "0"){ ?>
      <div class="alert alert-danger"> <strong>Por favor realice la configuración de las máquinas</strong> </div>
    <?php }else{ ?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <strong>Asignación Máquinas - Grupo: <?php echo strtoupper($agrM->getAgrM_Nombre()); ?></strong>
        </div>

        <div class="panel-body">
       <?php /*?>  <div class="col-lg-5 col-md-5 col-sm-5">
          <form id="f_asignacionMaquinaAgrupacion" role="form">
            <input id="AgrM_Codigo" type="hidden" value="<?php echo $_POST['codigo']; ?>">
            <div class="form-group">
              <label class="control-label">Máquinas:<span class="rojo">*</span></label>
              <select id="Maq_Codigo" class="form-control" multiple required>
                <?php foreach($resMaq as $registro){ ?>
                  <?php if(!isset($vecMaquinasExistentes[$registro[0]])){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
            </div>
            <div align="center"> <br>
              <button id="Btn_AsignarMaquinaAgrupacionForm" class="btn btn-primary">Crear</button>
            </div>
          </form>
         </div><?php */?>
         <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="table-responsive">
             <?php if($contAgruMaquinas == "0"){ ?>
               <div class="alert alert-danger"> <strong>Sin información, por favor realice la configuración en el módulo de máquinas</strong></div>
             <?php }else{ ?>
              <table id="tbl_asignarMaquinaAgrupacion" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
                <thead>
                  <tr class="ordenamiento encabezadoTab">
                    <th align="center" class="text-center">Máquinas</th>
  <!--                  <th align="center" class="text-center"></th>-->
                  </tr>
                </thead>
                <tbody class="buscar">
                  <?php foreach($listAgrMaqCFT as $registro3){ ?>
                  <tr>
                    <td><?php echo $registro3[1];?></td>
                    <?php /*?><?php if($pAgrupacionesMaq[6] == "1"){ ?>
                      <td align="center"><button class="btn btn-danger btn-xs e_eliminarMaquinaAgrupacion" data-cod="<?php echo $registro3[0]; ?>">Eliminar</button></td>
                    <?php } ?><?php */?>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php } ?>
          </div>
         </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>