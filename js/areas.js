$(document).ready(function (e) {

  $('#filtroAreas_Planta').multiselect({
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

  $("body").on("click", "#Btn_AreasBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroAreas_Planta").val();
    d_estado = $("#filtroAreas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_areasListar.php",
      beforeSend: function () {
        $(".info_AreasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_AreasListar").html(data);
        $("#tbl_areasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_AreasCrear", function (e) {
    e.preventDefault();

    $("#vtn_AreasCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_areasCrear.php",
      beforeSend: function () {
        $(".info_AreasCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_AreasCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#f_AreasCrear #Pla_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_cargarAreaAnterior.php",
      beforeSend: function () {
        $(".cargarAreaAnterior").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".cargarAreaAnterior").html(data);
        //        $("#id_tabla").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#f_AreasCrear #Pla_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_cargarAreaSiguiente.php",
      beforeSend: function () {
        $(".cargarAreaSiguiente").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".cargarAreaSiguiente").html(data);
        //        $("#id_tabla").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });


  $("body").on("submit", "#f_AreasCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_AreasCrear #Pla_Codigo").val();
    d_areaAnterior = $("#f_AreasCrear #Are_Anterior").val();
    d_areaSiguiente = $("#f_AreasCrear #Are_Siguiente").val();
    d_nombre = $("#f_AreasCrear #Are_Nombre").val();
    d_secuencia = $("#f_AreasCrear #Are_Secuencia").val();
    d_tipo = $("#f_AreasCrear #Are_Tipo").val();

    $.ajax({
      type: "POST",
      url: "op_arearCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_AreasCrear");
        $("#Btn_AreasCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_AreasCrear");
        $("#Btn_AreasCrearForm").show();
      },
      data: {
        planta: d_planta,
        areaAnterior: d_areaAnterior,
        areaSiguiente: d_areaSiguiente,
        nombre: d_nombre,
        secuencia: d_secuencia,
        tipo: d_tipo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AreasNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');


        } else {
          $("#vtn_AreasNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_AreasNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_AreasNotificacionesCrear").modal('hide');
    $("#vtn_AreasCrear").modal('hide');

    d_planta = $("#filtroAreas_Planta").val();
    d_estado = $("#filtroAreas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_areasListar.php",
      beforeSend: function () {
        $(".info_AreasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_AreasListar").html(data);
        $("#tbl_areasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarAreas", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_AreasActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_areasActualizar.php",
      beforeSend: function () {
        $(".info_AreasActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_AreasActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("change", "#Pla_CodigoAct", function(e){
    e.preventDefault();
    
     d_planta = $("#f_AreasActualizar #Pla_CodigoAct").val();
     d_codigo = $("#f_AreasActualizar #codigoAreasAct").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarAreaAnteriorActualizar.php",
      beforeSend: function() {
        $(".cargarAreaAnteriorAct").html(loader());
      },
      data:{ planta:d_planta, codigo: d_codigo },
      success: function(data) {
        $(".cargarAreaAnteriorAct").html(data);
        $("#id_tabla").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  }); 
  
  $("body").on("change", "#Pla_CodigoAct", function(e){
    e.preventDefault();
    
     d_planta = $("#f_AreasActualizar #Pla_CodigoAct").val();
     d_codigo = $("#f_AreasActualizar #codigoAreasAct").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarAreaSiguienteActualizar.php",
      beforeSend: function() {
        $(".cargarAreaSiguienteAct").html(loader());
      },
      data:{ planta:d_planta, codigo: d_codigo },
      success: function(data) {
        $(".cargarAreaSiguienteAct").html(data);
        $("#id_tabla").tablesorter();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });


  $("body").on("submit", "#f_AreasActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_AreasActualizar #codigoAreasAct").val();
    d_areaAnterior = $("#f_AreasActualizar #Are_AnteriorAct").val();
    d_areaSiguiente = $("#f_AreasActualizar #Are_SiguienteAct").val();
    d_nombre = $("#f_AreasActualizar #Are_NombreAct").val();
    d_secuencia = $("#f_AreasActualizar #Are_SecuenciaAct").val();
    d_tipo = $("#f_AreasActualizar #Are_TipoAct").val();
    d_estado = $("#f_AreasActualizar #Are_EstadoAct").val();

    $.ajax({
      type: "POST",
      url: "op_areasActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_AreasActualizar");
        $("#Btn_AreasActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_AreasActualizar");
        $("#Btn_AreasActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        areaAnterior: d_areaAnterior,
        areaSiguiente: d_areaSiguiente,
        nombre: d_nombre,
        secuencia: d_secuencia,
        tipo: d_tipo,
        estado: d_estado
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AreasNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_AreasNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });


  });

  $("body").on("click", "#Btn_AreasNotificacionesActualizar", function (e) {
    e.preventDefault();
    $("#vtn_AreasNotificacionesActualizar").modal('hide');
    $("#vtn_AreasActualizar").modal('hide');

    d_planta = $("#filtroAreas_Planta").val();
    d_estado = $("#filtroAreas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_areasListar.php",
      beforeSend: function () {
        $(".info_AreasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_AreasListar").html(data);
        $("#tbl_areasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("click", ".e_eliminarAreas", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_AreasNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_EquipoEliminar").val(d_codigo);
    
  });

  $("body").on("click", "#Btn_AreasNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_EquipoEliminar").val();
    $("#vtn_AreasNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_areaEliminar.php",
      beforeSend: function () {
        $(".e_eliminarAreas").hide();
      },
      complete: function () {
        $(".e_eliminarAreas").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AreasNotificacionesEliminarConfirma").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificacionesConfirma").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_AreasNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificacionesConfirma").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_AreasNotificacionesEliminarConfirma", function (e) {
    e.preventDefault();
    $("#vtn_AreasNotificacionesEliminar").modal('hide');
    $("#vtn_AreasNotificacionesEliminarConfirma").modal('hide');
    
    d_planta = $("#filtroAreas_Planta").val();
    d_estado = $("#filtroAreas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_areasListar.php",
      beforeSend: function () {
        $(".info_AreasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_AreasListar").html(data);
        $("#tbl_areasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  //Exportar a Excel
  $("#b_excelAreasBoton").click(function (event) {
    $(".e_editarAreas").hide();
    $("#input_resultadoAreas").val($("<div>").append($("#tbl_areasListar").eq(0).clone()).html());
    $("#f_consultaAreas").submit();
  });


});
