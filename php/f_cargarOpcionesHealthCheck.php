<?php include("op_sesion.php");
include("../class/estaciones_usuarios.php");
include("../class/programa_produccion.php");
include("../class/referencias.php");
include("../class/areas.php");
include_once("../class/usuarios.php");
include("../class/puestos_trabajos.php");
include("../class/estaciones_areas.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$est = new estaciones_usuarios();
$resEst = $est->buscarEstUsuHealthCheck($_POST['puestoTrabajo'],$fecha,$_POST['turno']);

$est->setEstU_Codigo($resEst[0]);
$est->consultar();

$pro = new programa_produccion();
$pro->setProP_Codigo($est->getProP_Codigo());
$pro->consultar();

$ref = new referencias();
$resRef = $ref->buscarReferencia($pro->getProP_Familia(),$pro->getFor_Codigo(),$pro->getProP_Color());
$resRefFiltro = $ref->filtroReferenciasHeathCheck($usu->getPla_Codigo());

$pue = new puestos_trabajos();
$pue->setPueT_Codigo($est->getPueT_Codigo());
$pue->consultar();

$estA = new estaciones_areas();
$estA->setEstA_Codigo($pue->getEstA_Codigo());
$estA->consultar();

$are = new areas();
$are->setAre_Codigo($estA->getAre_Codigo());
$are->consultar();

$resOperador = $usu->listarOperadoresHealthCheck($usu->getPla_Codigo());
?>

<tr>
 <th class="encabezadoTab vertical letra14" align="left">Referencia:</th>
  <th colspan="4">
    <select id="Ref_Codigo" class="form-control">
      <option value="">Seleccione</option>
      <option value="NULL">No aplica</option>
      <?php foreach($resRefFiltro as $registro3){ ?>
      <option value="<?php echo $registro3[0]; ?>" <?php echo $registro3[0] == $resRef[0] ? "selected":""; ?>><?php echo $registro3[1]; ?></option>
      <?php } ?>
    </select>
  </th>
</tr>
<tr>
  <th class="encabezadoTab vertical letra14" align="left">Operador: </th>
  <th> <select id="Usu_CodigoHC" class="form-control" required>
      <option value="">Seleccione</option>
      <?php foreach($resOperador as $registro5){ ?>
      <option value="<?php echo $registro5[0]; ?>" <?php echo $registro5[0] == $est->getUsu_Codigo() ? "selected":""; ?>><?php echo $registro5[1]; ?></option>
      <?php } ?>
    </select>
  </th>
</tr>
<tr>
  <th class="encabezadoTab vertical letra14" align="left">Área: </th>
  <th colspan="4"> 
    <select id="HeaC_Area" class="form-control" required>
      <option value="">Seleccione</option>
      <option value="Molienda y Atomizado" <?php echo $are->getAre_Tipo() == "1" ? "selected":""; ?>>Molienda y Atomizado <?php echo $are->getAre_Tipo(); ?></option>
      <option value="Prensas" <?php echo $are->getAre_Tipo() == "2" ? "selected":""; ?>>Prensas</option>
      <option value="Secadero" <?php echo $are->getAre_Tipo() == "3" ? "selected":""; ?>>Secadero</option>
      <option value="Decorado" <?php echo $are->getAre_Tipo() == "9" ? "selected":""; ?>>Decorado</option>
      <option value="Esmaltado" <?php echo $are->getAre_Tipo() == "4" ? "selected":""; ?>>Esmaltado</option>
      <option value="Horno" <?php echo $are->getAre_Tipo() == "5" ? "selected":""; ?>>Horno</option>
      <option value="Calidad" <?php echo $are->getAre_Tipo() == "6" ? "selected":""; ?>>Calidad</option>
      <option value="Preparación Esmaltes" <?php echo $are->getAre_Tipo() == "7" ? "selected":""; ?>>Preparación Esmaltes</option>
      <option value="Laboratorio" <?php echo $are->getAre_Tipo() == "8" ? "selected":""; ?>>Laboratorio</option>
    </select>
  </th>
</tr>
<script>
  $(document).ready(function(e) {
    $("#HeaC_Area").change();
  });
</script>
<tr class="e_cargarHornos"></tr>
