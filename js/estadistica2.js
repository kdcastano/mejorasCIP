$(document).ready(function(e) {

  $('#filtroREjecucionCumplimientoCriticidad_Area').multiselect({ 
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
  
  $('#filtroREjecucionCumplimientoCriticidad_PuestosTrabajo').multiselect({ 
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
  
  $('#filtroREjecucionCumplimientoCriticidad_Turno').multiselect({ 
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
  
  $("body").on("change", "#filtroREjecucionCumplimientoCriticidad_Planta", function(e){
    $("#filtroREjecucionCumplimientoCriticidad_TipoArea").val("-1");
    
    d_planta = $("#filtroREjecucionCumplimientoCriticidad_Planta").val();
    d_tipo = $("#filtroREjecucionCumplimientoCriticidad_TipoArea").val();
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoAreasCriticidad.php",
      beforeSend: function() {
        //$(".infoEjeCum_datosAreas").html(loader());
      },
      data:{ planta: d_planta, tipo: d_tipo },
      success: function(data) {
        $(".infoEjeCum_datosAreasCriticidad").html(data);
        $('#filtroREjecucionCumplimientoCriticidad_Area').multiselect({ 
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
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoPuestosTrabajoCriticidad.php",
      beforeSend: function() {
        //$(".infoEjeCum_datosPuestosTrabajo").html(loader());
      },
      data:{ planta: d_planta, tipo: d_tipo },
      success: function(data) {
        $(".infoEjeCum_datosPuestosTrabajoCriticidad").html(data);
        $('#filtroREjecucionCumplimientoCriticidad_PuestosTrabajo').multiselect({ 
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
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoTurnosCriticidad.php",
      beforeSend: function() {
        //$(".infoEjeCum_datosPuestosTrabajo").html(loader());
      },
      data:{ planta: d_planta },
      success: function(data) {
        $(".infoEjeCum_datosTurnos").html(data);
        $('#filtroREjecucionCumplimientoCriticidad_Turno').multiselect({ 
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
  
  $("body").on("change", "#filtroREjecucionCumplimientoCriticidad_TipoArea", function(e){
    e.preventDefault();
    
    d_planta = $("#filtroREjecucionCumplimientoCriticidad_Planta").val();
    d_tipo = $("#filtroREjecucionCumplimientoCriticidad_TipoArea").val();
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoAreasCriticidad.php",
      beforeSend: function() {
        //$(".infoEjeCum_datosAreas").html(loader());
      },
      data:{ planta: d_planta, tipo: d_tipo },
      success: function(data) {
        $(".infoEjeCum_datosAreasCriticidad").html(data);
        $('#filtroREjecucionCumplimientoCriticidad_Area').multiselect({ 
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
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoPuestosTrabajoCriticidad.php",
      beforeSend: function() {
        //$(".infoEjeCum_datosPuestosTrabajo").html(loader());
      },
      data:{ planta: d_planta, tipo: d_tipo },
      success: function(data) {
        $(".infoEjeCum_datosPuestosTrabajoCriticidad").html(data);
        $('#filtroREjecucionCumplimientoCriticidad_PuestosTrabajo').multiselect({ 
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
  
  $("body").on("click", ".Btn_CargarDatosEjecucionCumplimientoCriticidad", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#filtroREjecucionCumplimientoCriticidad_FechaInicial").val();
    d_horaInicial = $("#filtroREjecucionCumplimientoCriticidad_HoraInicial").val();
    d_fechaFinal = $("#filtroREjecucionCumplimientoCriticidad_FechaFinal").val();
    d_horaFinal = $("#filtroREjecucionCumplimientoCriticidad_HoraFinal").val();
    d_tipoArea = $("#filtroREjecucionCumplimientoCriticidad_TipoArea").val();
    d_nombreArea = $("#filtroREjecucionCumplimientoCriticidad_TipoArea :selected").attr("data-tipnom");
    d_areas = $("#filtroREjecucionCumplimientoCriticidad_Area").val();
    d_puestosTrabajo = $("#filtroREjecucionCumplimientoCriticidad_PuestosTrabajo").val();
    
    d_tipoVariable = $("#filtroREjecucionCumplimientoCriticidad_TipoVariable").val();
    d_criticidad = $("#filtroREjecucionCumplimientoCriticidad_Criticidad").val();
    
    d_planta = $("#filtroREjecucionCumplimientoCriticidad_Planta").val();
    d_turnos = $("#filtroREjecucionCumplimientoCriticidad_Turno").val();
    
    if(d_planta != "-1"){
      $.ajax({
        type:"POST",
        url:"f_ejecucionCumplimientoListarCriticidad.php",
        beforeSend: function() {
          $(".info_EjecucionCumplimientoListarCriticidad").html(loader());
        },
        data:{ fechaInicial: d_fechaInicial, horaInicial: d_horaInicial, fechaFinal: d_fechaFinal, horaFinal: d_horaFinal, tipoArea: d_tipoArea, nombreArea: d_nombreArea, areas: d_areas, puestosTrabajo: d_puestosTrabajo, tipoVariable: d_tipoVariable, criticidad: d_criticidad, turnos: d_turnos },
        success: function(data) {
          $(".info_EjecucionCumplimientoListarCriticidad").html(data);
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
    }else{
      $(".info_EjecucionCumplimientoListarCriticidad").html('<div class="limpiar"></div><div class="alert alert-danger"> <strong>Por favor seleccione una Planta</strong> </div>');
    }
  
  });
  
  $("#b_excelEjeCumCriBoton").click(function (event) {
    $("#input_resultadoEjeCumCri").val($("<div>").append($("#imp_tablaEjeCumCri").eq(0).clone()).html());
    $("#f_consultaEjeCumCri").submit();
  });

  // Detalle para descuentos de turnos de operación
  $("body").on("click", ".e_cargarEjeCumCriDetListarCrear", function(e){
    e.preventDefault();
    
    $("#vtn_DetalleEjeCumCriTurnosOperaciones").modal({backdrop: 'static'});
    
    d_planta = $("#filtroREjecucionCumplimientoCriticidad_Planta").val();
    d_fechaInicial = $(this).attr("data-fecini");
    d_fechaFinal = $(this).attr("data-fecfin");
    d_codigoMaquina = $(this).attr("data-codmaq");
    d_nombreVariable = $(this).attr("data-nomvar");
    d_turnos = $("#filtroREjecucionCumplimientoCriticidad_Turno").val();
    d_horaInicial = $("#filtroREjecucionCumplimientoCriticidad_HoraInicial").val();
    d_horaFinal = $("#filtroREjecucionCumplimientoCriticidad_HoraFinal").val();
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoCriticidadDetalleTO.php",
      beforeSend: function() {
        $(".info_DetalleEjeCumCriListar").html(loader());
      },
      data:{ planta: d_planta, fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, codigoMaquina: d_codigoMaquina, nombreVariable: d_nombreVariable, turnos: d_turnos, horaInicial: d_horaInicial, horaFinal: d_horaFinal },
      success: function(data) {
        $(".info_DetalleEjeCumCriListar").html(data);
        $("#Btn_EjeCumCriTOCrear").click();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  // Listar tabla con las fechas y turnos para crear
  $("body").on("click", "#Btn_EjeCumCriTOCrear", function(e){
    e.preventDefault();
    
    d_fechaInicial = $("#FiltroEjeCumCriDet_FechaInicial").val();
    d_fechaFinal = $("#FiltroEjeCumCriDet_FechaFinal").val();
    d_codigoMaquina = $("#FiltroEjeCumCriDet_Maquina").val();
    d_nombreVariable = $("#FiltroEjeCumCriDet_Variable").val();
    d_planta = $("#filtroREjecucionCumplimientoCriticidad_Planta").val();
    d_turnos = $("#filtroREjecucionCumplimientoCriticidad_Turno").val();
    d_horaInicial = $("#filtroREjecucionCumplimientoCriticidad_HoraInicial").val();
    d_horaFinal = $("#filtroREjecucionCumplimientoCriticidad_HoraFinal").val();
    
    $.ajax({
      type:"POST",
      url:"f_ejecucionCumplimientoCriticidadDetalleTOCrear.php",
      beforeSend: function() {
        $(".info_EjeCumCriDetTOCrear").html(loader());
      },
      data:{ fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, planta: d_planta, codigoMaquina: d_codigoMaquina, nombreVariable: d_nombreVariable, turnos: d_turnos, horaInicial: d_horaInicial, horaFinal: d_horaFinal },
      success: function(data) {
        $(".info_EjeCumCriDetTOCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });

  });
  
  // Insertar las selecciones de los turnos
  $("body").on("submit", "#f_turnosOperacionesCrear", function(e){
    e.preventDefault();
    
    d_nombreVariable = $("#f_turnosOperacionesCrear #TurO_Variable").val();
    d_codigoMaquina = $("#f_turnosOperacionesCrear #TurO_Maq_Codigo").val();
    d_observaciones = $("#f_turnosOperacionesCrear #TurO_Observaciones").val();
    
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
      url:"op_ejecucionCumplimientoCriticidadTOCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_turnosOperacionesCrear");
        $("#Btn_EjeCumCriTOForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_turnosOperacionesCrear");
        $("#Btn_EjeCumCriTOForm").show();
      },
      data: { lista1: d_lista1, lista2: d_lista2, num: d_num, nombreVariable: d_nombreVariable, codigoMaquina: d_codigoMaquina, observaciones: d_observaciones },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          
          d_planta = $("#filtroREjecucionCumplimientoCriticidad_Planta").val();
          d_fechaInicial = $("#FiltroEjeCumCriDet_FechaInicial").val();
          d_fechaFinal = $("#FiltroEjeCumCriDet_FechaFinal").val();
          d_turnos = $("#filtroREjecucionCumplimientoCriticidad_Turno").val();
          d_horaInicial = $("#filtroREjecucionCumplimientoCriticidad_HoraInicial").val();
          d_horaFinal = $("#filtroREjecucionCumplimientoCriticidad_HoraFinal").val();

          $.ajax({
            type:"POST",
            url:"f_ejecucionCumplimientoCriticidadDetalleTO.php",
            beforeSend: function() {
              $(".info_DetalleEjeCumCriListar").html(loader());
            },
            data:{ planta: d_planta, fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, codigoMaquina: d_codigoMaquina, nombreVariable: d_nombreVariable, turnos: d_turnos, horaInicial: d_horaInicial, horaFinal: d_horaFinal },
            success: function(data) {
              $(".info_DetalleEjeCumCriListar").html(data);
              $("#Btn_EjeCumCriTOCrear").click();
            },
            error: function(er1, er2, er3) {
              console.log(er2+"-"+er3);
            }
          });
          
        }else{
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", ".e_eliminarEjeCumCriDet", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $.ajax({
      type:"POST",
      url:"op_ejecucionCumplimientoCriticidadEliminar.php",
      beforeSend: function() {
        $(".e_eliminarEjeCumCriDet").hide();
      },
      complete: function() {
        $(".e_eliminarEjeCumCriDet").show();
      },
      data: { codigo: d_codigo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          
          d_nombreVariable = $("#f_turnosOperacionesCrear #TurO_Variable").val();
          d_codigoMaquina = $("#f_turnosOperacionesCrear #TurO_Maq_Codigo").val();
          d_planta = $("#filtroREjecucionCumplimientoCriticidad_Planta").val();
          d_fechaInicial = $("#FiltroEjeCumCriDet_FechaInicial").val();
          d_fechaFinal = $("#FiltroEjeCumCriDet_FechaFinal").val();
          d_turnos = $("#filtroREjecucionCumplimientoCriticidad_Turno").val();
          d_horaInicial = $("#filtroREjecucionCumplimientoCriticidad_HoraInicial").val();
          d_horaFinal = $("#filtroREjecucionCumplimientoCriticidad_HoraFinal").val();

          $.ajax({
            type:"POST",
            url:"f_ejecucionCumplimientoCriticidadDetalleTO.php",
            beforeSend: function() {
              $(".info_DetalleEjeCumCriListar").html(loader());
            },
            data:{ planta: d_planta, fechaInicial: d_fechaInicial, fechaFinal: d_fechaFinal, codigoMaquina: d_codigoMaquina, nombreVariable: d_nombreVariable, turnos: d_turnos, horaInicial: d_horaInicial, horaFinal: d_horaFinal },
            success: function(data) {
              $(".info_DetalleEjeCumCriListar").html(data);
              $("#Btn_EjeCumCriTOCrear").click();
            },
            error: function(er1, er2, er3) {
              console.log(er2+"-"+er3);
            }
          });
        }else{
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
});