$(document).ready(function(e) {
  
  $('#filtroReferencias_Planta').multiselect({
    includeSelectAllOption: true,
    enableFiltering: true,
    selectAllText: 'Seleccionar Todos',
    nonSelectedText: 'Seleccione...',
    nSelectedText: ' Todos',
    buttonWidth: '100%',
    enableCaseInsensitiveFiltering: true,
    maxHeight: 400,
    dropUp: true
  });
  
  $("body").on("click", "#Btn_ReferenciasBuscar", function(e){
    e.preventDefault();
    
    d_planta = $("#filtroReferencias_Planta").val();
    d_estado = $("#filtroReferencias_Estado").val();
    
    $.ajax({
      type:"POST",
      url:"f_referenciasListar.php",
      beforeSend: function() {
        $(".info_referenciasListar").html(loader());
      },
      data: { planta: d_planta, estado: d_estado },
      success: function(data) {
        $(".info_referenciasListar").html(data);
        $("#tbl_Referencias").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });

  $("body").on("click", "#Btn_ReferenciasCargar", function(e){
    e.preventDefault();
    
    $("#vtn_ReferenciasCargar").modal({backdrop: 'static'});
    
    $.ajax({
      type:"POST",
      url:"f_referenciasCargar.php",
      beforeSend: function() {
        $(".info_ReferenciasCargar").html(loader());
      },
      success: function(data) {
        $(".info_ReferenciasCargar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_ProcesarArchivoReferencias", function(e){
    e.preventDefault();
    
    d_archivo = $("#i_Arc_Referencias").val();
    
    $.ajax({
      type:"POST",
      url:"op_referenciasCargar.php",
      beforeSend: function() {
        $("#vtn_ReferenciasCargarNotificaciones").modal({backdrop: 'static'});
        $(".info_ReferenciasCargarNotificaciones").html(loader()+"<br><span>Procesando Archivo...</span>");
        $("#Btn_ReferenciasCargarNotificaciones").hide();
        $("#Btn_ProcesarArchivoReferencias").hide();
      },
      complete: function() {
        $("#Btn_ReferenciasCargarNotificaciones").show();
        $("#Btn_ProcesarArchivoReferencias").show();
      },
      data: { archivo: d_archivo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_ReferenciasCargarNotificaciones").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Archivo Cargado Correctamente</h3><br><span class="letra16">Registros Creados: '+rs.TotRefNuevas+'</span><br><span class="letra16">Registros Actualizados: '+rs.TotRefExisten+'</span><br><span class="letra16">Registros No Creados: '+rs.TotRefNoPlanta+'</span><br><span class="letra16">Registros Archivo: '+rs.TotRefArchivo+'</span>');
        }else{
          $("#vtn_ReferenciasCargarNotificaciones").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Cargado el Archivo</h3>');
          $("#Btn_ProcesarArchivoReferencias").show();
          $("#Btn_ReferenciasCargarNotificaciones").show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        $(".Men_ErrorFormato").html('<div class="alert alert-danger"><strong>Error de Formato</strong></div>');
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_ReferenciasCargarNotificaciones", function(e){
    e.preventDefault();
    
    window.location.href = "fm_referencias.php";
  
  });

});