<?php
include("op_sesion.php");
include("../class/programa_produccion.php");
include("../class/semanas.php");
include( "../class/areas.php" );
include("../class/estaciones_usuarios.php");
include("../class/estaciones_areas.php");
include("../class/puestos_trabajos.php");
include("c_hora.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$hora = date("H:i:s");

$sem = new semanas();
$resSemAct = $sem->hallarSemanaFecha($fecha);

$proP = new programa_produccion();
$resProPAct = $proP->listarProgramaProduccionActivoManual($resSemAct[0], $_POST['planta'], $_POST['fecha'], $_POST['area']);

$resProPReferencia = $proP->listarProgramaProduccionRealSupervisorSinSemana($_POST['area'], $usu->getPla_Codigo(), $_POST['fecha']);

?>
<style>
.colorEmergencia{
  background-color: #F6D4A6 !important; 
}
</style>
<div class="row">
  <div class="col-lg-12 col-md-12">
    
    <div class="table-responsive">
      <table border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
        <thead>
          <tr class="encabezadoTab">
            <th align="center" class="text-center vertical" rowspan="2">FECHA</th>
            <th align="center" class="text-center vertical" rowspan="2">HORA INICIO</th>
            <th align="center" class="text-center vertical" rowspan="2">PRENSA</th>
            <th align="center" class="text-center vertical" rowspan="2">REFERENCIA</th>
            <th align="center" class="text-center vertical" rowspan="2">ESTADO</th>
            <th align="center" class="text-center vertical" rowspan="2">&#13217; 1A <br> VENDIBLES</th>
            <th align="center" class="text-center vertical" colspan="2">EUROPALET</th>
            <th align="center" class="text-center vertical" colspan="2">EXPORTACIÓN</th>
            <th align="center" class="text-center vertical" rowspan="2">FICHA<br>TÉCNICA</th>
            <th align="center" class="text-center vertical" rowspan="2">FECHA<br>VERSIÓN FT</th>
          </tr>
          <tr class="encabezadoTab">
            <th align="center" class="text-center vertical">CANT.</th>
            <th align="center" class="text-center vertical"><span>&#13217;</span></th>
            <th align="center" class="text-center vertical">CANT.</th>
            <th align="center" class="text-center vertical"><span>&#13217;</span></th>
          </tr>
        </thead>
        <tbody class="buscar">
          <?php $cantReferenciaProduccion = 0; foreach($resProPAct as $registro){ ?>
            <tr class="<?php if($registro[15] == 1){echo "colorEmergencia";} ?>">
              <td align="center"><?php echo $registro[12]; ?></td>  
              <td align="center"><?php echo PasarMilitaraAMPM($registro[16]); ?></td>  
              <td><?php echo $registro[1]; ?></td>  
              <td nowrap><?php if($usu->getPla_Codigo() == "22"){ echo $registro[2]." ".$registro[3]." ".$registro[4]; }else{ echo $registro[6]; }?></td>   
              <td <?php if($registro[5] == "Listo para fabricar"){echo 'style="background-color:#98D4FD !important"';}
              if($registro[5] == "Producción"){echo 'style="background-color:#E9EC30 !important"';}
              if($registro[5] == "Finalizado"){echo 'style="background-color:#46EC30 !important"';}
              if($registro[5] == "Cancelado"){echo 'style="background-color:#EC4630 !important"';}
              if($registro[5] == "Suspendido"){echo 'style="background-color:#FEB35E !important"';}?>><?php echo $registro[5]; ?></td>  
              <td align="right"><?php echo number_format($registro[7], 2, ".", ","); ?></td>  
              <td align="right"><?php echo $registro[8]; ?></td> 
              <td align="right"><?php echo $registro[9]; ?></td> 
              <td align="right"><?php echo $registro[10]; ?></td> 
              <td align="right"><?php echo $registro[11]; ?></td> 
              <td align="center"><?php if($registro[13] != ""){ ?> <img src="../imagenes/pdf.png" width="20px" class="pdf_exportarFichaTecnica manito" data-fam="<?php echo $registro[3]; ?>" data-col="<?php echo $registro[4]; ?>" data-for="<?php echo $registro[2]; ?>" title="Exportar a PDF"> <?php } else{ echo "Sin FT";} ?></td>
              <td align="center"><?php echo $registro[14] != "" ? $registro[14]: "Sin FT"; ?></td>
            </tr>
			 <?php if($registro[5] == 'Producción'){
			   $cantReferenciaProduccion++;     
			} ?>
          <?php } ?>
        </tbody>
      </table>
		
	
	<?php if($cantReferenciaProduccion == "0"){ ?>
	  <div class="table-responsive">
		<table id="tbl_ProgramaProduccionReal" border="1px" class="table tableEstrecha table-hover table-bordered table-striped">
		  <thead>
			<tr class="encabezadoTab">
			  <th align="center" class="text-center vertical" rowspan="2">FECHA</th>
			  <th align="center" class="text-center vertical" rowspan="2">HORA INICIO</th>
			  <th align="center" class="text-center vertical" rowspan="2">PRENSA</th>
			  <th align="center" class="text-center vertical" rowspan="2">REFERENCIA</th>
			  <th align="center" class="text-center vertical" rowspan="2">ESTADO</th>
			  <th align="center" class="text-center vertical" rowspan="2">&#13217; 1A <br> vendibles</th>
			  <th align="center" class="text-center vertical" colspan="2">EUROPALET</th>
			  <th align="center" class="text-center vertical" colspan="2">EXPORTACIÓN</th>
			  <th align="center" class="text-center vertical" rowspan="2">FICHA <br>TÉCNICA</th>
			  <th align="center" class="text-center vertical" rowspan="2">FECHA <br>VERSIÓN FT</th>
			</tr>
			<tr class="encabezadoTab">
			  <th align="center" class="text-center">CANT.</th>
			  <th align="center" class="text-center"><span>&#13217;</span></th>
			  <th align="center" class="text-center">CANT.</th>
			  <th align="center" class="text-center"><span>&#13217;</span></th>
			</tr>
		  </thead>
		  <tbody class="buscar">
			<?php
			$cont = 0;
			$CantTotR = count($resProPReferencia);
			foreach($resProPReferencia as $registro){ ?>
			  <tr class="FilActCol<?php echo $registro[0]; ?> <?php if($registro[15] == 1){echo "colorEmergencia";} ?>">
				<td align="center"><?php echo $registro[1]; ?></td>
				<td align="center" ><?php echo PasarMilitaraAMPM($registro[14]); ?></td>
				<td><?php echo $registro[5]; ?></td>
				<td nowrap><?php if($usu->getPla_Codigo() == "22"){ echo $registro[2]." ".$registro[3]." ".$registro[4]; }else{ echo $registro[16]; }?></td>
				<td <?php if($registro[11] == "Listo para fabricar"){echo 'style="background-color:#98D4FD !important"';}
				if($registro[11] == "Producción"){echo 'style="background-color:#E9EC30 !important"';}
				if($registro[11] == "Finalizado"){echo "disabled"." ".'style="background-color:#46EC30 !important"';}
				if($registro[11] == "Cancelado"){echo "disabled"." ".'style="background-color:#EC4630 !important"';}
				if($registro[11] == "Suspendido"){echo 'style="background-color:##FEB35E !important"';} ?> class="form-control"> <?php echo $registro[11];  ?>
				</td>
				<td align="right"><?php echo number_format($registro[6], 2, ".", ","); ?></td>
				<td align="right"><?php echo $registro[7]; ?></td>
				<td align="right"><?php echo $registro[12]; ?></td>
				<td align="right"><?php echo $registro[8]; ?></td>
				<td align="right"><?php echo $registro[13]; ?></td>
				<td align="center"><?php if($registro[18] != ""){ ?> <img src="../imagenes/pdf.png" width="20px" class="pdf_exportarFichaTecnica manito" data-fam="<?php echo $registro[3]; ?>" data-col="<?php echo $registro[4]; ?>" data-for="<?php echo $registro[2]; ?>" title="Exportar a PDF"> <?php } else{ echo "Sin FT";} ?></td>
				<td align="center"><?php echo $registro[19] != "" ? $registro[19]: "Sin FT"; ?></td>
			  </tr>
			<?php $cont++; } ?>
		  </tbody>
		</table>
	  </div>
	<?php } ?>
    </div>
  </div>
</div>
<script type="text/javascript">cargarhora();</script>