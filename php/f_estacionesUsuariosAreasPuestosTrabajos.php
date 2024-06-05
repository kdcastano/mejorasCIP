<?php
include("op_sesion.php");
include("../class/areas.php");
include("../class/estaciones.php");
include("../class/puestos_trabajos.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$are = new areas();
$resAre = $are->estacionesUsuariosAreasOperador($_POST['codigo']);

$pueT = new puestos_trabajos();
$resPueT = $pueT->estacionesUsuariosPuestosTrabajosInicio($_POST['codigo'], $_SESSION['CP_Usuario']);

$resPueTExis = $pueT->estacionesUsuariosPuestosTrabajosInicioYaExiste($_SESSION['CP_Usuario'], $fecha, $_POST['turno']);

foreach($resPueTExis as $registro5){
  $vectorPueTYaExis[$registro5[0]] = $registro5[0];
}

foreach($resPueT as $registro2){
  $vectorEstaciones[$registro2[1]] = $registro2[1];
  $vectorEstacionesNom[$registro2[1]] = $registro2[3];
  $vectorPuestosTrabajo[$registro2[1]][$registro2[0]] = $registro2[0];
  $vectorPuestosTrabajoNom[$registro2[0]] = $registro2[4];
}
?>
<?php
  $cont = 1;
  foreach($vectorEstaciones as $registro){ ?>
  <div class="col-lg-6 col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Estación: <?php echo $vectorEstacionesNom[$registro]; ?></strong>
      </div>

      <div class="panel-body">
        <?php if(isset($vectorPuestosTrabajo[$registro])){ ?>
          <?php foreach($vectorPuestosTrabajo[$registro] as $registro4){ ?>
            <div class="<?php if(isset($vectorPueTYaExis[$registro4])){ echo "DesactivadoOpe"; }else{ echo "Btn_PuestosTrabajosUsuarios"; } ?>" <?php if(!isset($vectorPueTYaExis[$registro4])){ ?><?php } ?>>
              <?php if(!isset($vectorPueTYaExis[$registro4])){ ?>
                <input type="checkbox" class="PueTraSelOpeMasivo" data-cod="<?php echo $registro4; ?>">&nbsp;&nbsp;
              <?php } ?>
              <?php echo $vectorPuestosTrabajoNom[$registro4]; ?>
            </div>
            <div class="EspPeqEU"></div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php if($cont == "2"){ ?>
    <div class="limpiar"></div>
  <?php $cont = 0; } ?>
<?php $cont++; } ?>
<div class="limpiar"></div>
<div align="center" class="Btn_OperadorOcuCrearNVal">
  <button class="btn btn-warning Btn_Notificaciones Btn_RegistrarUsuarioPuestoTrabajo" data-agr="<?php echo $_POST['codigo']; ?>">Crear Puesto Trabajo</button>
</div>