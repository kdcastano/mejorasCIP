<?php
include("op_sesion.php");
include("../class/sap_programa_produccion.php");
include("../class/formatos.php");
include("../class/areas.php");

$sapPPro = new sap_programa_produccion();
$resSapPPro = $sapPPro->listarAnalisisProgramaProduccion($_POST['semana'], $_POST['planta'], $_SESSION['CP_Usuario'], $_POST['formato']);

$for = new formatos();
$resFor = $for->listarFormatosProgramaProduccionHorno($_SESSION['CP_Usuario']);

foreach($resFor as $registro2){
  $vectorHornos[$registro2[0]][$registro2[1]] = $registro2[1];
  $vectorHornosCod[$registro2[0]][$registro2[1]] = $registro2[2];
  $vectorHornosVarios[$registro2[0]] += 1;
}

$are = new areas();
$resAre = $are->prensasAnalisisProgramaProduccion($_SESSION['CP_Usuario']);

$cantTotal = count($resSapPPro);
?>
<div class="col-lg-5 col-md-5">
  <br>
  <div class="input-group">
    <span class="input-group-addon"><strong>Buscar:</strong></span>
    <input id="filtrarAnalisiPPListar" type="text" class="form-control">
  </div>
</div>

<div class="limpiar"></div>
<?php if($cantTotal != 0){ ?>
<div align="right">
  Seleccionar Todos&nbsp;&nbsp;<input type="checkbox" class="Int_SeleccionTodosAPP">&nbsp;&nbsp;
</div>
<div class="table-responsive">
  <table id="tbl_SAPProgramaProduccion" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
    <thead>
      <tr class="ordenamiento encabezadoTab">
        <th class="text-center" align="center"># ORDEN</th>
        <th class="text-center" align="center">FECHA PLAN</th>
        <th class="text-center" align="center">DESCRIPCIÓN</th>
        <th class="text-center" align="center">FORMATO</th>
        <th class="text-center" align="center">FAMILIA</th>
        <th class="text-center" align="center">COLOR</th>
        <th class="text-center" align="center">CANTIDAD ORDENADA</th>
        <th class="text-center" align="center">PRENSA</th>
        <th class="text-center" align="center"></th>
      </tr>
    </thead>
    <tbody class="buscar">
      <?php
      $a = 0;
      foreach($resSapPPro as $registro){ ?>
        <tr>
          <td><?php echo $registro[11]; ?></td>
          <td>
            <input type="hidden" class="ProP_Semana<?php echo $a; ?>" value="<?php echo $registro[0]; ?>">
            <input type="hidden" class="ProP_CantEP<?php echo $a; ?>" value="<?php echo $registro[6]; ?>">
            <input type="hidden" class="ProP_CantEXPO<?php echo $a; ?>" value="<?php echo $registro[7]; ?>">
            <input type="hidden" class="ProP_Pla_Codigo<?php echo $a; ?>" value="<?php echo $registro[8]; ?>">
            <input type="hidden" class="ProP_For_Codigo<?php echo $a; ?>" value="<?php echo $registro[9]; ?>">
            <input type="hidden" class="ProP_CentroCostos<?php echo $a; ?>" value="<?php echo $registro[10]; ?>">
            <input type="hidden" class="ProP_FechaOriginal<?php echo $a; ?>" value="<?php echo $registro[1]; ?>">
            <input type="text" value="<?php echo $registro[1]; ?>" class="form-control fechaEntre inputTablaEstEsp ProP_Fecha<?php echo $a; ?>" autocomplete="off">
            <input type="hidden" class="ProP_Descripcion<?php echo $a; ?>" value="<?php echo str_replace(" EP ", " ", str_replace(" EX ", " SL ", $registro[12])); ?>">
            <input type="hidden" class="ProP_CodigoMaterial<?php echo $a; ?>" value="<?php echo $registro[13]; ?>">
          </td>
          <td><?php echo str_replace(" EP ", " ", str_replace(" EX ", " SL ", $registro[12])); ?></td>  
          <td><?php echo $registro[2]; ?></td>  
          <td><input type="hidden" class="ProP_Familia<?php echo $a; ?>" value="<?php echo $registro[3]; ?>"><?php echo $registro[3]; ?></td>  
          <td><input type="hidden" class="ProP_Color<?php echo $a; ?>" value="<?php echo $registro[4]; ?>"><?php echo $registro[4]; ?></td>  
          <td align="right"><input type="hidden" class="ProP_Cantidad<?php echo $a; ?>" value="<?php echo $registro[5]; ?>"><?php echo number_format($registro[5], 2, ",", "."); ?></td>  
          <td>
            <?php if(isset($vectorHornos[$registro[2]])){ ?>
              <select class="form-control inputTablaEstEsp ProP_Are_Codigo<?php echo $a; ?>">
                <?php if($vectorHornosVarios[$registro[2]] > 1){ ?>
                  <option></option>
                <?php } ?>
                <?php foreach($vectorHornos[$registro[2]] as $registro3){ ?>
                  <option value="<?php echo $vectorHornosCod[$registro[2]][$registro3]; ?>"><?php echo $registro3; ?></option>
                <?php } ?>
              </select>
            <?php }else{ ?>
              <select class="form-control inputTablaEstEsp ProP_Are_Codigo<?php echo $a; ?>">
                <option value="-1">-- Seleccione --</option>
                <?php foreach($resAre as $registro4){ ?>
                  <option value="<?php echo $registro4[0]; ?>"><?php echo $registro4[1]; ?></option>
                <?php } ?>
              </select>
            <?php } ?>
          </td>
          <td align="center"><input type="checkbox" class="inp_CamposSeleccionAPP" data-cod="<?php echo $a; ?>"></td> 
        </tr>
      <?php $a++; } ?>
    </tbody>
  </table>
</div>
<br>
<div align="right">
  <button id="Btn_AnalisisPasarAProgramaProduccion" class="btn btn-warning Btn_Notificaciones">Programar</button>
</div>
<script type="text/javascript">cargarfechaEntre(0,15);</script>
<?php } else{ ?>
<div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
<?php } ?>