<?php include("op_sesion.php");
include( "../class/agrupaciones_maquinas.php" );
include( "../class/agrupaciones_configft.php" );
include( "../class/agrupaciones_variables_configft.php" );
include_once( "../class/usuarios.php" );
$pAgrupacionesMaq = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "40" );

$agrM = new agrupaciones_maquinas();
$agrM->setAgrM_Codigo($_POST['codigo']);
$agrM->consultar();

$agrConFT = new agrupaciones_configft();
$resAgruConFT = $agrConFT->listarAgrupacionesConfFT($_POST['planta'],$usu->getUsu_Codigo());
$cantInfo = count($resAgruConFT);

$agrVarCFT = new agrupaciones_variables_configft();
$resagrVarCFT = $agrVarCFT->listarAgrupacionesCreadas($_POST['codigo']);
$ListAgrVarCFT = $agrVarCFT->listarAgrupacionesTodas($_POST['codigo']);

foreach($resagrVarCFT as $registro2){
  $vectAgrVarExiste[$registro2[0]] = $registro2[0];
}
//Variables de control

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <?php if($cantInfo == "0"){ ?>
      <div class="alert alert-danger"> <strong>Por favor realice la configuración de las variables de control</strong> </div>
    <?php }else{ ?>
      <div class="panel panel-primary">
        <div class="panel-heading">
          <strong>Asignación Variables - Grupo: <?php echo strtoupper($agrM->getAgrM_Nombre()); ?></strong>
        </div>

        <div class="panel-body">
         <div class="col-lg-5 col-md-5 col-sm-5">
          <form id="f_asignacionVariablesMaquinas" role="form">
            <input id="AgrM_Codigo" type="hidden" value="<?php echo $_POST['codigo']; ?>">
            <input id="AgrM_Planta" type="hidden" value="<?php echo $_POST['planta']; ?>">
            <div class="form-group">
              <label class="control-label">Variables de control:<span class="rojo">*</span></label>
              <select id="AgrC_Codigo" class="form-control" multiple required>
                <?php foreach($resAgruConFT as $registro){ ?>
                  <?php if(!isset($vectAgrVarExiste[$registro[0]])){ ?>
                    <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                  <?php } ?>
                <?php } ?>
              </select>
            </div>
            <div align="center"> <br>
              <button id="Btn_AsignarVariablesMaquinasForm" class="btn btn-primary">Crear</button>
            </div>
          </form>
         </div>
         <div class="col-lg-7 col-md-7 col-sm-7">
           <div class="table-responsive">
            <table id="tbl_asignarVariablesMaquinas" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
              <thead>
                <tr class="ordenamiento encabezadoTab">
                  <th align="center" class="text-center">Variables de control</th>
                  <th align="center" class="text-center"></th>
                </tr>
              </thead>
              <tbody class="buscar">
                <?php foreach($ListAgrVarCFT as $registro3){ ?>
                <tr>
                  <td><?php echo $registro3[1];?></td>
                  <?php if($pAgrupacionesMaq[6] == "1"){ ?>
                    <td align="center"><button class="btn btn-danger btn-xs e_eliminarVariableControlMaquina" data-cod="<?php echo $registro3[0]; ?>" data-pla="<?php echo $_POST['planta']; ?>">Eliminar</button></td>
                  <?php } ?>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
         </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>