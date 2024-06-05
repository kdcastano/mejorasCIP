<?php include("op_sesion.php");
include("../class/parametros.php");
include_once("../class/usuarios.php");

$par = new parametros();
$resPar = $par->listarParametrosTipoUsuarioMultiple($usu->getUsu_Codigo(),$_POST['tipo']);
$tipo = "";

?>
 <div class="form-group">
  <label class="control-label">Defectos:</label>
   <?php if($_POST['tipo'] != null){ ?>
    <select id="filtroConsolidadoPAC_defecto" class="form-control" multiple>
      <?php foreach($resPar as $registro){ ?>
      <?php if($registro[2] == "11"){ 
        $tipo = " (Segunda)";
       } ?> 

      <?php if($registro[2] == "12"){
        $tipo = " (Rotura)";
       } ?>
      <option value="<?php echo $registro[0]; ?>" selected><?php echo $registro[1]."".$tipo; ?></option>
      <?php } ?>
    </select>
   <?php }else{ ?>
     <select id="filtroConsolidadoPAC_defecto" class="form-control">
     </select>
   <?php } ?>
</div>