$(document).ready(function (e) {
  $('#filtroAgrupaciones_Planta').multiselect({
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
  $('#filtroAgrupaciones_Area').multiselect({
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

  $("body").on("click", "#Btn_AgrupacionesBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroAgrupaciones_Planta").val();
    d_area = $("#filtroAgrupaciones_Area").val();
    d_estado = $("#filtroAgrupaciones_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesListar.php",
      beforeSend: function () {
        $(".info_agrupacionesListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
        area: d_area
      },
      success: function (data) {
        $(".info_agrupacionesListar").html(data);
        $("#tbl_agrupacionesListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_AgrupacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_agrupacionesCrear.php",
      beforeSend: function () {
        $(".info_AgrupacionesCrear").html(loader());
      },
      success: function (data) {
        $(".info_AgrupacionesCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_agrupacionesCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_agrupacionesCrear #Agr_Pla_Codigo").val();
    d_nombre = $("#f_agrupacionesCrear #Agr_Nombre").val();
    d_tipo = $("#f_agrupacionesCrear #Agr_Tipo").val();
    d_secuencia = $("#f_agrupacionesCrear #Agr_Secuencia").val();

    $.ajax({
      type: "POST",
      url: "op_agrupacionesCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_agrupacionesCrear");
        $("#Btn_AgrupacionesCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_agrupacionesCrear");
        $("#Btn_AgrupacionesCrearForm").show();
      },
      data: {
        planta: d_planta,
        nombre: d_nombre,
        tipo: d_tipo,
        secuencia: d_secuencia
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AgrupacionesNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesCrearNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        } else {
          $("#vtn_AgrupacionesNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesCrearNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_AgrupacionesNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesNotificacionesCrear").modal('hide');
    $("#vtn_AgrupacionesCrear").modal('hide');

    d_planta = $("#filtroAgrupaciones_Planta").val();
    d_area = $("#filtroAgrupaciones_Area").val();
    d_estado = $("#filtroAgrupaciones_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesListar.php",
      beforeSend: function () {
        $(".info_agrupacionesListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
        area: d_area
      },
      success: function (data) {
        $(".info_agrupacionesListar").html(data);
        $("#tbl_agrupacionesListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarAgrupacion", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_AgrupacionesActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_agrupacionesActualizar.php",
      beforeSend: function () {
        $(".info_AgrupacionesActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_AgrupacionesActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_agrupacionesActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_agrupacionesActualizar #codigoAct").val();
    d_planta = $("#f_agrupacionesActualizar #Agr_Pla_CodigoAct").val();
    d_nombre = $("#f_agrupacionesActualizar #Agr_NombreAct").val();
    d_estado = $("#f_agrupacionesActualizar #Agr_EstadoAct").val();
    d_tipo = $("#f_agrupacionesActualizar #Agr_TipoAct").val();
    d_secuencia = $("#f_agrupacionesActualizar #Agr_SecuenciaAct").val();

    $.ajax({
      type: "POST",
      url: "op_agrupacionesActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_agrupacionesActualizar");
        $("#Btn_AgrupacionesActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_agrupacionesActualizar");
        $("#Btn_AgrupacionesActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        nombre: d_nombre,
        estado: d_estado,
        tipo: d_tipo,
        secuencia: d_secuencia
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AgrupacionesNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesActualizarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_AgrupacionesNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesActualizarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_AgrupacionesNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesNotificacionesActualizar").modal('hide');
    $("#vtn_AgrupacionesActualizar").modal('hide');

    d_planta = $("#filtroAgrupaciones_Planta").val();
    d_area = $("#filtroAgrupaciones_Area").val();
    d_estado = $("#filtroAgrupaciones_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesListar.php",
      beforeSend: function () {
        $(".info_agrupacionesListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
        area: d_area
      },
      success: function (data) {
        $(".info_agrupacionesListar").html(data);
        $("#tbl_agrupacionesListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarAgrupacion", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_ConfiguracionReportesNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_ConfigReporte").val(d_codigo);

  });

  $("body").on("click", "#Btn_ConfiguracionReportesNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_ConfigReporte").val();
    
    $("#vtn_ConfiguracionReportesNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_agrupacionesEliminar.php",
      beforeSend: function () {
        $("#e_eliminarAgrupacion").hide();
      },
      complete: function () {
        $("#e_eliminarAgrupacion").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AgrupacionesNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesEliminarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_AgrupacionesNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_AgrupacionesEliminarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  $("body").on("click", "#Btn_AgrupacionesNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_AgrupacionesNotificacionesEliminar").modal('hide');

    d_planta = $("#filtroAgrupaciones_Planta").val();
    d_area = $("#filtroAgrupaciones_Area").val();
    d_estado = $("#filtroAgrupaciones_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_agrupacionesListar.php",
      beforeSend: function () {
        $(".info_agrupacionesListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado,
        area: d_area
      },
      success: function (data) {
        $(".info_agrupacionesListar").html(data);
        $("#tbl_agrupacionesListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_agregarAreaAgrupacion", function (e) {
    e.preventDefault();

    $("#vtn_AreasAgrupacionesCrear").modal({
      backdrop: 'static'
    });

    d_codigo = $(this).attr("data-cod");
    d_planta = $(this).attr("data-pla");

    $.ajax({
      type: "POST",
      url: "f_agregarAreaAgrupacion.php",
      beforeSend: function () {
        $(".info_AreasAgrupacionesCrear").html(loader());
      },
      data: {
        codigo: d_codigo,
		planta: d_planta
      },
      success: function (data) {
        $(".info_AreasAgrupacionesCrear").html(data);
        $('#agrupaciones_AreaAgregar').multiselect({
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

        $.ajax({
          type: "POST",
          url: "f_areasAgrupacionesListar.php",
          beforeSend: function () {
            $(".info_ListarAreasAgregadasAgrupacion").html(loader());
          },
          data: {
            agrupacion: d_codigo
          },
          success: function (data) {
            $(".info_ListarAreasAgregadasAgrupacion").html(data);
            $("#tbl_areasAgrupacionesListar").tablesorter();
          },
          error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
          }
        });
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
});
