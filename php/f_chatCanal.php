<?php
include("op_sesion.php");
include("../class/agrupaciones.php");
include("../class/chat_canal.php");
include_once("../class/usuarios.php");

date_default_timezone_set("America/Bogota");
setlocale(LC_TIME, 'spanish');

$fecha = date("Y-m-d");
$fechaFin = date("Y-m-d", strtotime($fecha." + 3 days"));
$hora = date("H:i:s");

$cha = new chat_canal();
$resCha = $cha->listarInfoChat($_POST['agrupacion'],$fecha, $fechaFin);

$agr = new agrupaciones();
$agr->setAgr_Codigo($_POST['agrupacion']);
$agr->consultar();
?>
<script>
$( ".scrollTop" ).scrollTop(99999999999999);
</script>

<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>Chat - <?php echo $agr->getAgr_Nombre(); ?></strong>
      </div>

      <div class="panel-body">   
        <div class="panel panel-default scrollTop" style="overflow-y: scroll;">
          <div class="panel-body" style="height: 250px;">
            
          <div class="table-responsive" id="imp_tabla">
              <table id="tbl_" border="0px" class="table">
                <tbody class="buscar">
                  <?php foreach($resCha as $registro){ ?>
                    <tr style="border: hidden">
                      <?php if($registro[4] == $usu->getUsu_Codigo()){ ?>
                        <td style="padding: 0px; width: 50%"></td>
                        <td style="padding: 0px; width: 50%"> 
                          <div class="panel panel-success">
                            <div class="panel-heading" style="padding: 0px"><?php echo $registro[0]; ?></div>
                            <div class="panel-body" style="padding: 0px">
                              <?php echo $registro[3]; ?><br>
                              <?php if($registro[5]){ 
  
                                $ruta = "../files/adjuntos_chat/".$registro[5];
  
                                $arc1 = $registro[5]; 
                                $valores1 = explode('.', $arc1); 
                                $extension1 = end($valores1);
                                  if($extension1 == "jpg" || $extension1 == "gif" || $extension1 == "png" || $extension1 == "jpeg"){ ?>
                                    &nbsp;
                                    <img src="<?php echo $ruta; ?>" width="20%" class="manito e_cargarImagenChat" data-rut="<?php echo $ruta; ?>" data-nom="<?php echo $registro[0]; ?>" title="Ver Imagen">
                              
                                  <?php }else{ 
                                     if($extension1 == "xlsx" || $extension1 == "xls" || $extension1 == "xlsm"){ ?>
                                       <a class="manito" href="<?php echo $ruta; ?>" download="<?php echo $registro[0]."_".$registro[2]; ?> "><img src="../imagenes/excel.png" width="10%"> Descargar</a> 
                                    <?php }else{ ?>
                                       <?php if($extension1 == "pdf"){ ?>
                                         <a class="manito" href="<?php echo $ruta; ?>" download="<?php echo $registro[0]."_".$registro[2]; ?> "><img src="../imagenes/pdf.png" width="10%"> Descargar</a> 
                                      <?php }else{ ?>
                                        <a class="manito" href="<?php echo $ruta; ?>" download="<?php echo $registro[0]."_".$registro[2]; ?> "><img src="../imagenes/clip.png" width="10%"> Descargar</a> 
                                      <?php } ?>
                                    <?php } ?>
                                  <?php } ?>
                              <?php } ?>
                            </div>
                            <div align="right" style="font-style: italic; font-size: 10px"><?php echo $registro[2]; ?>
                          </div>
                        </td>
                      <?php }else{ ?>
                        <td style="padding: 0px; width: 50%">
                         <div class="panel panel-info">
                            <div class="panel-heading" style="padding: 0px"><?php echo $registro[0]; ?></div>
                            <div class="panel-body" style="padding: 0px">
                              <?php echo $registro[3]; ?>
                              <?php if($registro[5]){
                              
                                $ruta = "../files/adjuntos_chat/".$registro[5];
  
                                $arc1 = $registro[5]; 
                                $valores1 = explode('.', $arc1); 
                                $extension1 = end($valores1);
                                  if($extension1 == "jpg" || $extension1 == "gif" || $extension1 == "png" || $extension1 == "jpeg"){ ?>
                                    &nbsp;
                                    <img src="<?php echo $ruta; ?>" width="20%" class="manito e_cargarImagenChat" data-rut="<?php echo $ruta; ?>" data-nom="<?php echo $registro[0]; ?>" title="Ver Imagen">
                              
                                  <?php }else{ 
                                     if($extension1 == "xlsx" || $extension1 == "xls" || $extension1 == "xlsm"){ ?>
                                       <a class="manito" href="<?php echo $ruta; ?>" download="<?php echo $registro[0]."_".$registro[2]; ?> "><img src="../imagenes/excel.png" width="10%"> Descargar</a> 
                                    <?php }else{ ?>
                                       <?php if($extension1 == "pdf"){ ?>
                                         <a class="manito" href="<?php echo $ruta; ?>" download="<?php echo $registro[0]."_".$registro[2]; ?> "><img src="../imagenes/pdf.png" width="10%"> Descargar</a> 
                                      <?php }else{ ?>
                                        <a class="manito" href="<?php echo $ruta; ?>" download="<?php echo $registro[0]."_".$registro[2]; ?> "><img src="../imagenes/clip.png" width="10%"> Descargar</a> 
                                      <?php } ?>
                                    <?php } ?>
                                  <?php } ?>
                              <?php } ?>
                             </div>
                            <div align="right" style="font-style: italic; font-size: 10px"><?php echo $registro[2]; ?>
                          </div>
                        </td>
                        <td style="padding: 0px; width: 50%"></td>
                      <?php } ?>
                    </tr> 
                  <?php } ?>
                </tbody>
              </table>
            </div> 
            
            <?php /*?><div class="col-lg-6 col-md-6 col-sm-6">
              <?php foreach($resCha as $registro){ ?>
                 <?php if($registro[4] != $usu->getUsu_Codigo()){ ?>
                  <div class="panel panel-info">
                    <div class="panel-heading">
                      <div align="left" class="letra4 panel-success"><?php echo $registro[0]; ?></div>
                      <?php echo $registro[3]; ?>
                      <div align="right" class="letra4 panel-success"><?php echo $registro[2]; ?></div>
                    </div>
                  </div>
                 <?php }else{ ?>
                  <div>
                  </div>
                 <?php } ?>
              <?php } ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
               <?php foreach($resCha as $registro){ ?>
                 <?php if($registro[4] == $usu->getUsu_Codigo()){ ?>
                    <div class="panel panel-success">
                      <div class="panel-heading">
                        <div align="left" class="letra4 panel-success"><?php echo $registro[0]; ?></div>
                        <?php echo $registro[3]; ?>
                        <div align="right" class="letra4 panel-success"><?php echo $registro[2]; ?></div>
                      </div>
                    </div>
                 <?php }else{ ?>
                  <div>
                  </div>
                 <?php } ?>
              <?php } ?>
            </div><?php */?>
            
          </div>
        </div>

        <form id="chatMensaje" role="form">
          <textarea class="form-control" id="mensajeChatEnviar" placeholder="Escribe un mensaje aquí" cols="5" rows="5"></textarea><br>
          <input type="hidden" id="Agr_Codigo" value="<?php echo $_POST['agrupacion']; ?>">
          <div class="form-group">
            <div id="Arc_FT_Adjunto"></div>
            <input type="hidden" id="i_Arc_FT_Adjunto">
          </div>
          <button style="float: right;"  class="btn btn-primary e_cargarMensaje">Enviar</button>
          
        </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
  $("#Arc_FT_Adjunto").uploadFile({
    url:"../imgPHP/subirAdjuntoChat.php",
    maxFileSize: 20000*20000,
    maxFileCount:1,
    dragDrop:true,
    fileName:"myfile",
    showPreview:true,
    returnType: "json",
    showDownload:false,
    uploadStr:"Subir adjunto",
    statusBarWidth:300,
    dragdropWidth:300,
    previewHeight: "200px",
    previewWidth: "200px",
    afterUploadAll:function(obj){
      archivo = obj.existingFileNames[0];
      $("#i_Arc_FT_Adjunto").val(archivo);
    $("#Arc_FT_Adjunto .ajax-upload-dragdrop").hide();
    $("#Arc_FT_Adjunto .ajax-file-upload").hide();
    }
  });
});
</script> 