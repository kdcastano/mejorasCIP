<?php
include( "op_sesion.php" );
include( "../class/bitacoras.php" );
include_once("../class/usuarios.php");
include("../class/plantas.php");
include("../class/puestos_trabajos.php");

$pBitacora = $usuPerUsu->Permisos( $_SESSION[ 'CP_Usuario' ], "49" );

$pla = new plantas();
$resPla = $pla->filtroPlantasUsuario($_SESSION['CP_Usuario']);

$usu10 = new usuarios();
$usu10->setUsu_Codigo($_SESSION['CP_Usuario']);
$usu10->consultar();
$resUsu10 = $usu10->listarUsuariosBitacora($usu10->getPla_Codigo());

$bit = new bitacoras();
$resBit = $bit->bitacorasListarPrincipal( $_POST['puesto'], $_POST['fechaI'], $_POST['fechaF'], $_POST['usuario'],$_POST['sapsam'], $_POST['requerimiento'],$usu10->getPla_Codigo());
$cantTotal = count( $resBit );

$pueT = new puestos_trabajos();
$resPueT = $pueT->listarPuestosTrabajoFiltros($_SESSION['CP_Usuario']);

?>
<?php if($cantTotal != 0){ ?>
  <?php if($pBitacora[4] == "1" || $pBitacora[5] == "1"){ ?>
    <div align="right">
    <!--            <button id="Btn_BitacorasCrear" class="btn btn-primary">Crear</button>-->
      <button class="btn btn-primary e_cargarNuevoRegistro">Nuevo registro</button>
    </div> <br>
  <?php } ?>
<?php }else{ ?>
  <?php if($pBitacora[4] == "1" || $pBitacora[5] == "1"){ ?>
    <div align="right"> 
      <button id="Btn_BitacorasCrear" class="btn btn-primary">Crear</button>
<!--      <button class="btn btn-primary e_cargarNuevoRegistro">Nuevo registro</button>-->
    </div> <br>
  <?php } ?>
<?php } ?>

<?php if($cantTotal != 0){ ?>

<?php /*?><?php if($pBitacora[4] == 1){ ?>
  <div align="right">
   <button class="btn btn-primary btn-xs e_cargarNuevoRegistro">Nuevo registro</button>
  </div>
<?php } ?><?php */?>

<form id="f_bitacorasTablaCrear" role="form">
  <div class="table-responsive" id="imp_tabla">
    <table id="tbl_bitacorasListar" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
      <thead>
        <tr class="ordenamiento encabezadoTab">
          <th rowspan="2" class="vertical text-center">PLANTA</th>
          <th rowspan="2" class="vertical text-center">PUESTO TRABAJO</th>
          <th rowspan="2" class="vertical text-center">USUARIO</th>
          <th rowspan="2" class="vertical text-center">FECHA</th>
          <th rowspan="2" class="vertical text-center">DESCRIPCIÓN</th>
          <th rowspan="2" class="vertical text-center">ACCIÓN</th>
          <th colspan="3" class="vertical text-center">REQUERIMIENTO</th>
          <th rowspan="2" class="vertical text-center">SAP/SAM</th>
          <th colspan="2" class="vertical text-center">FECHA</th>
<!--          <th rowspan="2" class="vertical text-center">SAM</th>-->
          <th rowspan="2">DÍAS <br> RETRASO</th>
          <th rowspan="2">&nbsp;</th>
        </tr>
        <tr class="ordenamiento encabezadoTab">
          <th align="center" class="text-center vertical">PROD.</th>
          <th align="center" class="text-center vertical">MTTO.</th>
          <th align="center" class="text-center vertical">N/A</th>
          <th nowrap align="center" class="text-center vertical">PROGRAMADA</th>
          <th nowrap align="center" class="text-center vertical">REAL</th>
        </tr>
      </thead>
      <tbody class="buscar BitacoraNuevoRegistro">
        <?php $cont = 0; foreach($resBit as $registro){ ?>
        <input type="hidden" id="Bit_Codigo<?php echo $cont; ?>" value="<?php echo $registro[0]; ?>">
        <tr>
          <td>
            <select id="Pla_Codigo<?php echo $cont; ?>" class="form-control" <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>>
              <option value=""></option>
              <?php foreach($resPla as $registro2){ ?>
                <option value="<?php echo $registro2[0]; ?>" <?php echo $registro[12] == $registro2[0] ? "selected":"";?>><?php echo $registro2[1]; ?></option>
              <?php } ?>
            </select>
          </td>
          <td>
            <select id="PueT_Codigo<?php echo $cont; ?>" class="form-control" <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>>
              <option value="">Seleccione</option>
            <?php foreach($resPueT as $registro4){ ?>
              <option value="<?php echo $registro4[0]; ?>" <?php echo $registro[13] == $registro4[0] ? "selected":"";?>><?php echo $registro4[1]; ?></option>
            <?php } ?>
            </select>
          </td>
          <td>
            <input type="hidden" id="Usu_Codigo<?php echo $cont; ?>" value="<?php echo $registro[16]; ?>" <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>>
            <?php echo $registro[3]; ?>
          </td>
          <td>
            <input type="hidden" id="Bit_Fecha<?php echo $cont; ?>" value="<?php echo $registro[9]; ?>" <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>>
            <?php echo $registro[9]; ?>
          </td>
          <td><textarea style="height: 31px; width: 194px;" id="Bit_Descripcion<?php echo $cont; ?>" class="form-control" required autocomplete="off" <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>><?php if($registro[4]){echo $registro[4];} ?></textarea></td>
          <td><textarea id="Bit_Accion<?php echo $cont; ?>" class="form-control" style="height: 31px; width: 194px;" autocomplete="off" <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>><?php if($registro[5]){ echo $registro[5];} ?></textarea></td>
          <td class=" text-center vertical ">
            <input type="radio" name="opcion_Bit_Requerimiento<?php echo $cont; ?>" class="Bit_Requerimiento<?php echo $cont; ?>" value="1" required <?php echo $registro[6] == "1" ? "checked":""; ?> <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>>
          </td>
          <td class=" text-center vertical ">
            <input type="radio" name="opcion_Bit_Requerimiento<?php echo $cont; ?>" class="Bit_Requerimiento<?php echo $cont; ?>" value="2" required <?php echo $registro[6] == "2" ? "checked":""; ?> <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>>
          </td>
          <td class=" text-center vertical ">
            <input type="radio" name="opcion_Bit_Requerimiento<?php echo $cont; ?>" class="Bit_Requerimiento<?php echo $cont; ?>" value="3" required <?php echo $registro[6] == "3" ? "checked":""; ?> <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>>
          </td>
          <td>
            <select id="Bit_SAP<?php echo $cont; ?>" class="form-control" <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>>
              <option value="">Seleccione</option>
              <option value="-1" <?php echo $registro[7] == "" ? "selected":"";?>>No aplica</option>
              <?php foreach($resUsu10 as $registro2){ ?>
                <option value="<?php echo $registro2[0]; ?>" <?php echo $registro[14] == $registro2[0] ? "selected":"";?>><?php echo $registro2[1]; ?></option>
              <?php } ?>
            </select>
          </td>
         <?php /*?> <td>
            <select id="Bit_SAM<?php echo $cont; ?>" class="form-control" <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>>
              <option value="">Seleccione</option>
              <option value="-1" <?php echo $registro[8] == "" ? "selected":"";?>>No aplica</option>
              <?php foreach($resUsu10 as $registro3){ ?>
                <option value="<?php echo $registro3[0]; ?>" <?php echo $registro[15] == $registro3[0] ? "selected":"";?>><?php echo $registro3[1]; ?></option>
              <?php } ?>
            </select>
          </td><?php */?>
          
          <td>
            
             <input type="text" class="form-control fecha" id="Bit_FechaProgramada<?php echo $cont; ?>" value="<?php if($registro[17] != "0000-00-00"){echo $registro[17];}; ?>" autocomplete="off" <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>>
          </td>
          <td>
            <input type="text" class="form-control fecha tamanoFecha" id="Bit_FechaReal<?php echo $cont; ?>" value="<?php if($registro[18] != "0000-00-00"){echo $registro[18];}; ?>" autocomplete="off" <?php echo $registro[11] == $_SESSION['CP_Usuario'] ? "":"disabled"; ?>>
          </td>
          <td>
            <?php if($registro[17] != "0000-00-00"){
              $segundos = strtotime('now') - strtotime($registro[17]); 
                $diferencia_dias = intval($segundos/60/60/24); 
                $dias = $diferencia_dias." días";
            }else{
              $dias = "0 días";
              $diferencia_dias = 0;
            } ?>
            
            <?php echo $diferencia_dias; ?>
          </td>
          
          
          <?php //if ( $registro[11] == $_SESSION['CP_Usuario'] ) { ?>
            <td align="center" class="vertical">
             <?php /*?> <button class="btn btn-warning btn-xs e_editarBitacora" data-cod="<?php echo $registro[0]; ?>">Editar</button><?php */?>
          <?php // } ?>
            <?php if($pBitacora[6] == "1"){
              if ( $registro[11] == $_SESSION['CP_Usuario'] ) {
                ?>
            <button class="btn btn-danger btn-xs e_eliminarBitacora" data-cod="<?php echo $registro[0]; ?>">Eliminar</button>
            <?php } } ?></td>
        </tr>
        <?php $cont++;  } ?>
         <input type="hidden" id="cantRegistroBitacora" value="<?php echo $cont; ?>">
      </tbody>
      <tr class="encabezadoTab">
        <td colspan="11" class="letra14">TOTAL REGISTROS: <?php echo number_format($cantTotal, 0, ",", "."); ?></td>
      </tr>
    </table>
  </div>
  <?php if($pBitacora[4] == "1" && $pBitacora[5] == "1"){ ?>
    <div align="right" class="ocultarBtn_GuardarMasivoBitacoras">
      <button type="submit" class="btn btn-warning Btn_Notificaciones Btn_GuardarMasivoBitacora">Guardar</button>
      <input type="hidden" id="Num_CantVariablesBitacoras" value="<?php echo $cont; ?>">
    </div>
  <?php } ?>
  
  <?php } else{ ?>
  <div class="alert alert-danger text-center" align="center"> <strong>No existe ningún registro</strong> </div>
  <?php } ?>
</form>
<script type="text/javascript">cargarfecha();</script>
