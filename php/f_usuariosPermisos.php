<?php
include("op_sesion.php");
include("../class/permisos.php");
include_once("../class/usuarios.php");

$usu2 = new usuarios();
$usu2->setUsu_Codigo($_POST['codigo']);
$usu2->consultar();

$per = new permisos();
$resPer = $per->listarPermisosTodos();
$resPerUsu = $per->listarPermisosSelect($_POST['codigo']);

foreach($resPerUsu as $registro2){
  $vectorPermisosUsuarios[$registro2[0]] = $registro2[0];
}
?>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Permisos</strong>
      </div>

      <div class="panel-body">
        <form id="f_usuariosPermisos" role="form">
          <input type="hidden" value="<?php echo $_POST['codigo']; ?>" id="Usu_CodigoPer">
          
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
              <label class="control-label letra16">Nombre Completo: <?php echo $usu2->getUsu_Nombres().' '.$usu2->getUsu_Apellidos(); ?></label>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
              <label class="control-label">Permisos:</label>
              <select id="Per_Codigo" class="form-control" multiple>
                <?php foreach($resPer as $registro){ ?>
                <?php if(!isset($vectorPermisosUsuarios[$registro[0]])){ ?>
                  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
                <?php }
                } ?>
              </select>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6" align="center">
            <div class="form-group">
              <button type="submit" class="btn btn-success" id="Btn_PermisosCrearForm">Crear</button>
            </div>
          </div>
        </form>
        <br>
        <br>
        <br>
        <div class="col-lg-12 col-md-12">
					<div class="table-responsive">
						<table id="tbl_ListarUsuariosPermisos" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
							<thead>
								<tr class="ordenamiento encabezadoTab">
									<th class="text-center" align="center">PERMISO</th>  
									<th class="text-center" align="center">VER</th>  
									<th class="text-center" align="center">CREAR</th>  
									<th class="text-center" align="center">MODIFICAR</th>  
									<th class="text-center" align="center">ELIMINAR</th>  
								</tr>
							</thead>
							<tbody class="buscar">
								<?php
								$con = 1;
								foreach($resPerUsu as $registro3){ ?>
									<tr>
										<td><?php echo $registro3[1]; ?></td>  

										<td class="text-center" align="center"><input type="checkbox" name="ver<?php echo $con; ?>" <?php echo $registro3[2]=="1" ? "checked" : ""; ?> data-num="<?php echo $con; ?>" data-cod="<?php echo $registro3[6]; ?>" class="e_PermisoUsuActualizar1"></td></td>
										<td class="text-center" align="center"><input type="checkbox" name="crear<?php echo $con; ?>" <?php echo $registro3[3]=="1" ? "checked" : ""; ?> data-num="<?php echo $con; ?>" data-cod="<?php echo $registro3[6]; ?>" class="e_PermisoUsuActualizar2"></td>
										<td class="text-center" align="center"><input type="checkbox" name="modificar<?php echo $con; ?>" <?php echo $registro3[4]=="1" ? "checked" : ""; ?> data-num="<?php echo $con; ?>" data-cod="<?php echo $registro3[6]; ?>" class="e_PermisoUsuActualizar3"></td>
										<td class="text-center" align="center"><input type="checkbox" name="eliminar<?php echo $con; ?>" <?php echo $registro3[5]=="1" ? "checked" : ""; ?> data-num="<?php echo $con; ?>" data-cod="<?php echo $registro3[6]; ?>" class="e_PermisoUsuActualizar4"></td>
									</tr>
								<?php $con++; } ?>
							</tbody>
						</table> 
					</div>
				</div>
        
      </div>
    </div>
  </div>
</div>

