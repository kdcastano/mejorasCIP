<?php
include( "op_sesion.php" );
include( "../class/parametros.php" );
include( "../class/plantas.php" );
include_once("../class/usuarios.php");

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );

$par = new parametros();
$par->setPar_Codigo( $_POST[ 'codigo' ] );
$par->consultar();

$resEf = $par->listarEfectosFT($par->getPla_Codigo());

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Parámetros</strong> </div>
      <div class="panel-body">
        <form id="f_ParametrosActualizar" role="form">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Planta:<span class="rojo">*</span></label>
            <select id="Par_Pla_CodigoAct" class="form-control">
              <?php foreach($resPla as $registro){ ?>
              <option value="<?php echo $registro[0]; ?>" <?php if($registro[0] == $par->getPla_Codigo()){ echo "selected";} ?>><?php echo $registro[1]; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Nombre:<span class="rojo">*</span></label>
            <input type="text" id="Par_NombreAct" class="form-control" maxlength="60" value="<?php echo $par->getPar_Nombre(); ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="control-label">Tipo:<span class="rojo">*</span></label>
            <select id="Par_TipoAct" class="form-control">
              <option value="6" <?php echo $par->getPar_Tipo()=="6"?"selected":""; ?>>Cargo</option>
              <option value="12" <?php echo $par->getPar_Tipo()=="12"?"selected":""; ?>>Defectos rotura</option>
              <option value="11" <?php echo $par->getPar_Tipo()=="11"?"selected":""; ?>>Defectos segunda</option>
              <option value="7" <?php echo $par->getPar_Tipo()=="7"?"selected":""; ?>>Efectos FT</option>
              <option value="2" <?php echo $par->getPar_Tipo()=="2"?"selected":""; ?>>Estados Programación</option>
              <option value="14" <?php echo $par->getPar_Tipo()=="14"?"selected":""; ?>>Estampos / punzón</option>
              <option value="4" <?php echo $par->getPar_Tipo()=="4"?"selected":""; ?>>Región</option>
              <option value="3" <?php echo $par->getPar_Tipo()=="3"?"selected":""; ?>>Grupo</option>
              <option value="8" <?php echo $par->getPar_Tipo()=="8"?"selected":""; ?>>Insumo</option>
              <option value="13" <?php echo $par->getPar_Tipo()=="13"?"selected":""; ?>>Lados</option>
              <option value="5" <?php echo $par->getPar_Tipo()=="5"?"selected":""; ?>>Marca/Pais</option>
              <option value="10" <?php echo $par->getPar_Tipo()=="10"?"selected":""; ?>>Prioridad  (Plan de acción)</option>
              <option value="9" <?php echo $par->getPar_Tipo()=="9"?"selected":""; ?>>Tipo Defecto (Plan de acción)</option>
              <option value="1" <?php echo $par->getPar_Tipo()=="1"?"selected":""; ?>>Unidades de Medida</option>
            </select >
          </div>
          <div class="e_cargarEfectosAct form-group">
            <?php if($par->getPar_Tipo()=="8"){ ?>                  
                <label class="control-label">Tipo Efecto: <span class="rojo">*</span></label>
                <select id="Par_EfectoAct" class="form-control" required>
                  <option></option>
                  <?php foreach($resEf as $registro2){ ?>
                  <option value="<?php echo $registro2[0]; ?>" <?php if($registro2[0]==$par->getPar_RelacionFT()){ echo "selected"; } ?>><?php echo $registro2[1]; ?></option>
                  <?php } ?>
                </select>                  
              <?php }	?>
            </div>
          <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="Par_EstadoAct" class="form-control">
              <option value="1" <?php echo $par->getPar_Estado()=="1"?"selected":""; ?>>Activo</option>
              <option value="0" <?php echo $par->getPar_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
