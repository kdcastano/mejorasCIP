$(document).ready(function(e) {

  $('#filtroProgramaProduccion_Planta').multiselect({
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
  
  $("body").on("click", "#Btn_ProgramaProduccionBuscar", function(e){
    e.preventDefault();
    
    d_planta = $("#filtroProgramaProduccion_Planta").val();
    d_estado = $("#filtroProgramaProduccion_Estado").val();
    d_fechaInicial = $("#filtroProgramaProduccion_FechaInicial").val();
    d_fechaFinal = $("#filtroProgramaProduccion_FechaFinal").val();
    
    $.ajax({
      type:"POST",
      url:"f_programaProduccionListar.php",
      beforeSend: function() {
        $(".info_ProgramaProduccionListar").html(loader());
      },
      data: { planta: d_planta, estado: d_estado, fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal },
      success: function(data) {
        $(".info_ProgramaProduccionListar").html(data);
        $("#tbl_ProgramaProduccion").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });

  $("body").on("click", "#Btn_ProgramaProduccionCargar", function(e){
    e.preventDefault();
    
    $("#vtn_ProgramaProduccionCargar").modal({backdrop: 'static'});
    
    $.ajax({
      type:"POST",
      url:"f_programaProduccionCargar.php",
      beforeSend: function() {
        $(".info_ProgramaProduccionCargar").html(loader());
      },
      success: function(data) {
        $(".info_ProgramaProduccionCargar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_ProcesarArchivoProgramaProduccion", function(e){
    e.preventDefault();
    
    d_archivo = $("#i_Arc_ProgramaProduccion").val();
    
    $.ajax({
      type:"POST",
      url:"op_programaProduccionCargar.php",
      beforeSend: function() {
        $("#vtn_ProgramaProduccionCargarNotificaciones").modal({backdrop: 'static'});
        $(".info_ProgramaProduccionCargarNotificaciones").html(loader()+"<br><span>Procesando Archivo...</span>");
        $("#Btn_ProgramaProduccionCargarNotificaciones").hide();
        $("#Btn_ProcesarArchivoProgramaProduccion").hide();
      },
      complete: function() {
        $("#Btn_ProgramaProduccionCargarNotificaciones").show();
        $("#Btn_ProcesarArchivoProgramaProduccion").show();
      },
      data: { archivo: d_archivo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_ProgramaProduccionCargarNotificaciones").modal({backdrop: 'static'});
          $(".info_ProgramaProduccionCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Archivo Cargado Correctamente</h3><br><span class="letra16">Registros Creados: '+rs.TotRefNuevas+'</span><br><span class="letra16">Referencias No Existentes: '+rs.TotRefExisten+'</span><br><span class="letra16">Ordenes Ya Existen: '+rs.TotOrdExi+'</span><br><span class="letra16">Registros No Creados: '+rs.TotRefNoPlanta+'</span><br><span class="letra16">Registros Archivo: '+rs.TotRefArchivo+'</span>');
        }else{
          $("#vtn_ProgramaProduccionCargarNotificaciones").modal({backdrop: 'static'});
          $(".info_ProgramaProduccionCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Cargado el Archivo</h3>');
          $("#Btn_ProcesarArchivoProgramaProduccion").show();
          $("#Btn_ProgramaProduccionCargarNotificaciones").show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        $(".Men_ErrorFormato").html('<div class="alert alert-danger"><strong>Error de Formato</strong></div>');
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_ProgramaProduccionCargarNotificaciones", function(e){
    e.preventDefault();
    
    window.location.href = "fm_programaProduccion.php";
  
  });

});