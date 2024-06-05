<?php include("op_sesion.php");
include( "../class/plantas.php" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario( $_SESSION[ 'CP_Usuario' ] );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php include("s_cabecera.php"); ?>
<script src="../js/formulas_moliendas.js"></script>
</head>
<?php include("s_menu.php"); ?>
<body>
  <div id="d_contenedor" class="container">
    <!-- Todo el Contenido -->
    
    <div class="col-lg-12 col-md-12">
      
      <div class="panel panel-primary">
        <div class="panel-heading">
        <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
              <div class="col-lg-3 col-md-3"> <strong class="letra16">Fórmulas Moliendas</strong> </div>
				<div class="col-lg-2 col-md-2 col-sm-2">
				  <div class="form-group">
					<label class="control-label">Plantas:</label>
					<select id="filtroFormulasM_Planta" class="form-control" multiple>
					  <?php foreach($resPla as $registro){ ?>
					  <option value="<?php echo $registro[0]; ?>"><?php echo $registro[1]; ?></option>
					  <?php } ?>
					</select>
				  </div>
				  </div>
				<div class="col-lg-2 col-md-2 col-sm-2">
				  <div class="form-group">
					<label class="control-label">Estado:</label>
					<select id="filtroFormulasM_Estado" class="form-control">
					  <option value="1">Activo</option>
					  <option value="0">Inactivo</option>
					</select>
				  </div>
				</div>
				<div class="col-lg-1 col-md-1"> <br>
				  <button id="Btn_FormulasMBuscar" class="btn btn-info">Buscar</button>
				</div>
				<div class="col-lg-1 col-md-1"> <br>
					<?php if($pFormulasM[4] == 1){ ?>
				  <button id="Btn_FormulasMCrear" class="btn btn-primary">Crear</button>
					<?php } ?>
				</div>
              </div>
			</div>            
        </div>        
        <div class="panel-body info_formulasMListar">
        
        
        </div>
      </div>      
    </div>    
  </div>
<!-- Crear Formulas Moliendas -->
<div id="vtn_FormulasMCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_FormulasMCrear"> </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="Btn_FormulasMCrearForm" form="f_formulasMCrear">Crear</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Formulas Moliendas Crear -->
<div id="vtn_FormulasMNotificacionesCrear" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FormulasMCrearNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_FormulasMNotificacionesCrear" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

	<!-- Actualizar Formulas Moliendas -->
<div id="vtn_FormulasMActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body info_FormulasMActualizar"> </div>
      <div class="modal-footer">
        <div class="d_mensajeFormulasMActualizar"></div>
		  <?php 	if($pFormulasM[5] == 1){ ?>
        <button type="submit" id="Btn_FormulasMActualizarForm" class="btn btn-warning" form="f_formulasMActualizar">Actualizar</button>
		  <?php } ?>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones Formulas Moliendas Actualizar -->
<div id="vtn_FormulasMNotificacionesActualizar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FormulasMActualizarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_FormulasMNotificacionesActualizar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Notificaciones FormulasMoliendaConf Eliminar -->
<div id="vtn_FormulasMoliendaConfNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FormulasMoliendaConfNotificacionesEliminar"><br>
          <strong class="letra14">¿Esta seguro de eliminar el registro?</strong></span>
          <input type="hidden" class="Cod_formulasMoliendaEliminar">
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="Btn_FormulasMoliendaConfNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Notificaciones FormulasM Eliminar -->
<div id="vtn_FormulasMNotificacionesEliminar" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content Est_EspModNot">
      <div class="modal-body" align="center">
        <div align="center"> <img src="../imagenes/logo_rojolamosaNot.png" width="90%"> </div>
        <div class="Cont_InfoMensajeNot" align="center"> <span class="info_FormulasMEliminarNotificaciones"></span>
          <div class="limpiar"></div>
          <button type="button" id="Btn_FormulasMNotificacionesEliminar" class="btn btn-success Btn_Notificaciones">Aceptar</button>
          <div class="limpiar"></div>
          <br>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Crear Historial Formulas Molienda -->
<div id="vtn_HistorialFM" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-body info_HistorialFM">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>