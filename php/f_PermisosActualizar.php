<?php
include( "op_sesion.php" );
include( "../class/permisos.php" );

$per = new permisos();
$per->setPer_Codigo( $_POST[ 'codigo' ] );
$per->consultar();

?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading"> <strong>Actualizar Permisos</strong> </div>
      <div class="panel-body">
        <form id="f_permisosActualizar" role="form">
          <input type="hidden" id="codigoAct" value="<?php echo $_POST['codigo']; ?>">
          <div class="form-group">
            <label class="control-label">Módulo:<span class="rojo">*</span></label>
            <input type="text" id="Per_ModuloAct" class="form-control" maxlength="30" value="<?php echo $per->getPer_Modulo(); ?>" required>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Tipo:<span class="rojo">*</span></label>
            <select id="Per_TipoAct" class="form-control">
              <option value="Modulo" <?php echo $per->getPer_Tipo()=="Modulo"?"selected":""; ?>>Módulo</option>
              <option value="Consulta"  <?php echo $per->getPer_Tipo()=="Consulta"?"selected":""; ?> >Consulta</option>
            </select >
          </div>
		  <div class="form-group">
            <label class="control-label">Descripción:<span class="rojo">*</span></label>
            <textarea type="textarea" id="Per_DescripcionAct" class="form-control" maxlength=""required><?php echo $per->getPer_Descripcion(); ?></textarea>
          </div>
		  <div class="form-group">
            <label class="control-label">Estado:<span class="rojo">*</span></label>
            <select id="Per_EstadoAct" class="form-control">
              <option value="1" <?php echo $per->getPer_Estado()=="1"?"selected":""; ?>>Activo</option>
			<option value="0" <?php echo $per->getPer_Estado()=="0"?"selected":""; ?>>Inactivo</option>
            </select >
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
