$(document).ready(function(e) {

  $('#filtroDescuentosTurnosOperaciones_TipoArea').multiselect({ 
    includeSelectAllOption: true, 
    enableFiltering: true, 
    selectAllText: 'Seleccionar Todos', 
    nonSelectedText: 'Seleccione...', 
    nSelectedText: ' Todos', 
    buttonWidth: '100%', 
    enableCaseInsensitiveFiltering: true, 
    maxHeight: 300, 
    dropUp: true 
  });
  
  $('#filtroDescuentosTurnosOperaciones_Area').multiselect({ 
    includeSelectAllOption: true, 
    enableFiltering: true, 
    selectAllText: 'Seleccionar Todos', 
    nonSelectedText: 'Seleccione...', 
    nSelectedText: ' Todos', 
    buttonWidth: '100%', 
    enableCaseInsensitiveFiltering: true, 
    maxHeight: 300, 
    dropUp: true 
  });
  
  $('#filtroDescuentosTurnosOperaciones_Turno').multiselect({ 
    includeSelectAllOption: true, 
    enableFiltering: true, 
    selectAllText: 'Seleccionar Todos', 
    nonSelectedText: 'Seleccione...', 
    nSelectedText: ' Todos', 
    buttonWidth: '100%', 
    enableCaseInsensitiveFiltering: true, 
    maxHeight: 300, 
    dropUp: true 
  });
  
  $("body").on("change", "#filtroDescuentosTurnosOperaciones_Planta", function(e){
    e.preventDefault();
    
    d_planta = $("#filtroDescuentosTurnosOperaciones_Planta").val();
    
    $.ajax({
      type:"POST",
      url:"f_descuentosTurnosOperacionesTurnos.php",
      beforeSend: function() {
        $(".FiltroCampo_filtroDescuentosTurnosOperacionesTurnos").html(loader());
      },
      data:{ planta: d_planta },
      success: function(data) {
        $(".FiltroCampo_filtroDescuentosTurnosOperacionesTurnos").html(data);
        $('#filtroDescuentosTurnosOperaciones_Turno').multiselect({ 
          includeSelectAllOption: true, 
          enableFiltering: true, 
          selectAllText: 'Seleccionar Todos', 
          nonSelectedText: 'Seleccione...', 
          nSelectedText: ' Todos', 
          buttonWidth: '100%', 
          enableCaseInsensitiveFiltering: true, 
          maxHeight: 300, 
          dropUp: true 
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("change", "#filtroDescuentosTurnosOperaciones_TipoArea", function(e){
    e.preventDefault();
    
    d_planta = $("#filtroDescuentosTurnosOperaciones_Planta").val();
    d_tipo = $("#filtroDescuentosTurnosOperaciones_TipoArea").val();
    
    $.ajax({
      type:"POST",
      url:"f_descuentosTurnosOperacionesAreas.php",
      beforeSend: function() {
        $(".FiltroCampo_filtroDescuentosTurnosOperacionesArea").html(loader());
      },
      data:{ planta: d_planta, tipo: d_tipo },
      success: function(data) {
        $(".FiltroCampo_filtroDescuentosTurnosOperacionesArea").html(data);
        $('#filtroDescuentosTurnosOperaciones_Area').multiselect({ 
          includeSelectAllOption: true, 
          enableFiltering: true, 
          selectAllText: 'Seleccionar Todos', 
          nonSelectedText: 'Seleccione...', 
          nSelectedText: ' Todos', 
          buttonWidth: '100%', 
          enableCaseInsensitiveFiltering: true, 
          maxHeight: 300, 
          dropUp: true 
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", ".Btn_CargarDatosDescuentosTurnosOperaciones", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroDescuentosTurnosOperaciones_FechaInicial").val();
    d_horaInicial = $("#filtroDescuentosTurnosOperaciones_HoraInicial").val();
    d_fechaFinal = $("#filtroDescuentosTurnosOperaciones_FechaFinal").val();
    d_horaFinal = $("#filtroDescuentosTurnosOperaciones_HoraFinal").val();
    d_tipoArea = $("#filtroDescuentosTurnosOperaciones_TipoArea").val();
    d_areas = $("#filtroDescuentosTurnosOperaciones_Area").val();
    d_planta = $("#filtroDescuentosTurnosOperaciones_Planta").val();
    d_turnos = $("#filtroDescuentosTurnosOperaciones_Turno").val();
    
    if(d_planta != "-1"){
      $.ajax({
        type:"POST",
        url:"f_descuentosTurnosOperacionesCrearMasivo.php",
        beforeSend: function() {
          $(".info_DescuentosTurnosOperacionesCrear").html(loader());
        },
        data:{ fechaInicial: d_fechaInicial, horaInicial: d_horaInicial, fechaFinal: d_fechaFinal, horaFinal: d_horaFinal, tipoArea: d_tipoArea, areas: d_areas, turnos: d_turnos, planta: d_planta },
        success: function(data) {
          $(".info_DescuentosTurnosOperacionesCrear").html(data);
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
      
      $.ajax({
        type:"POST",
        url:"f_descuentosTurnosOperacionesListarMasivo.php",
        beforeSend: function() {
          $(".info_DescuentosTurnosOperacionesListar").html(loader());
        },
        data:{ fechaInicial: d_fechaInicial, horaInicial: d_horaInicial, fechaFinal: d_fechaFinal, horaFinal: d_horaFinal, tipoArea: d_tipoArea, areas: d_areas, turnos: d_turnos, planta: d_planta },
        success: function(data) {
          $(".info_DescuentosTurnosOperacionesListar").html(data);
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
    }else{
      $(".info_DescuentosTurnosOperacionesCrear").html('<div class="limpiar"></div><div class="alert alert-danger"> <strong>Por favor seleccione una Planta</strong> </div>');
    }
  
  });
  
  $("body").on("submit", "#f_turnosOperacionesMasivoCrear", function(e){
    e.preventDefault();
    
    d_area = $("#f_turnosOperacionesMasivoCrear #TurO_Are_Codigo").val();
    d_observaciones = $("#f_turnosOperacionesMasivoCrear #TurO_Observaciones").val();
    d_planta = $("#filtroDescuentosTurnosOperaciones_Planta").val();
    
    d_lista1 = []; // Codigo Turno
    d_lista2 = []; // Fecha
    
		cont = 0;
		$(".Sel_DesTurOpeCampo:checked").each(function(){
			
			d_lista1[cont] = $(this).attr("data-tur");
      d_lista2[cont] = $(this).attr("data-fec");
			cont++;
		});
		d_num = cont;
    
    $.ajax({
      type:"POST",
      url:"op_descuentosTurnosOperacionesMasivoCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_turnosOperacionesMasivoCrear");
        $("#Btn_EjeCumCriTOForm").hide();
        $(".MensCarCreaDTO").html("Eliminando Respuestas...");
      },
      complete: function() {
        desbloquearFormulario("f_turnosOperacionesMasivoCrear");
        $("#Btn_EjeCumCriTOForm").show();
        $(".MensCarCreaDTO").html("");
      },
      data: { lista1: d_lista1, lista2: d_lista2, num: d_num, observaciones: d_observaciones, areas: d_areas, planta: d_planta },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $(".Btn_CargarDatosDescuentosTurnosOperaciones").click();
        }else{
          mensaje('2', rs.mensaje);
          $(".MensCarCreaDTO").html("");
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
  $("body").on("click", ".Btn_EliminarDescuentosTurnosOperacionesMasivo", function(e){
    e.preventDefault();
    
    d_planta = $("#filtroDescuentosTurnosOperaciones_Planta").val();
    
    d_lista1 = []; // Codigo Turnos Operaciones
    
		cont = 0;
		$(".Sel_DesTurOpeCampoEliminar:checked").each(function(){
			d_lista1[cont] = $(this).attr("data-cod");
			cont++;
		});
		d_num = cont;
    
    $.ajax({
      type:"POST",
      url:"op_descuentosTurnosOperacionesMasivoEliminar.php",
      beforeSend: function() {
        $(".Btn_EliminarDescuentosTurnosOperacionesMasivo").hide();
        $(".MensCarCreaDTOEliminar").html("Recuperando Respuestas...");
      },
      complete: function() {
        $(".Btn_EliminarDescuentosTurnosOperacionesMasivo").show();
        $(".MensCarCreaDTOEliminar").html("");
      },
      data: { lista1: d_lista1, num: d_num, planta: d_planta },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $(".Btn_CargarDatosDescuentosTurnosOperaciones").click();
        }else{
          mensaje('2', rs.mensaje);
          $(".MensCarCreaDTOEliminar").html("");
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
  $("body").on("change", ".Sel_DesTurOpeCampoSelectTodos", function(e){
    e.preventDefault();
    
    if($(this).prop("checked") == true){
      $(".Sel_DesTurOpeCampoEliminar").prop("checked", true);
    }else{
      $(".Sel_DesTurOpeCampoEliminar").prop("checked", false);
    }
    
  });

  $("body").on("change", ".Sel_DesTurOpeCampoSelectTodosCrear", function(e){
    e.preventDefault();
    
    if($(this).prop("checked") == true){
      $(".Sel_DesTurOpeCampo").prop("checked", true);
    }else{
      $(".Sel_DesTurOpeCampo").prop("checked", false);
    }
    
  });
  
});