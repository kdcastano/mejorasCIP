$(document).ready(function (e) {
  $('#filtroFormatosAreas_Formatos').multiselect({
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

  $('#filtroFormatosAreas_Planta').multiselect({
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

  $('#filtroFormatosAreas_Area').multiselect({
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

  $('#Are_Codigo').multiselect({
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

  $("body").on("click", "#Btn_FormatosAreasBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroFormatosAreas_Planta").val();
    d_area = $("#filtroFormatosAreas_Area").val();
    d_formato = $("#filtroFormatosAreas_Formatos").val();
    d_estado = $("#filtroFormatosAreas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_formatosAreasListar.php",
      beforeSend: function () {
        $(".info_FormatosAreasListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado,
        formatos: d_formato
      },
      success: function (data) {
        $(".info_FormatosAreasListar").html(data);
        $("#tbl_formatosAreasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_FormatosAreasCrear", function (e) {
    e.preventDefault();

    $("#vtn_FormatosAreasCrear").modal({
      backdrop: 'static'
    });
    $.ajax({
      type: "POST",
      url: "f_formatosAreasCrear.php",
      beforeSend: function () {
        $(".info_FormatosAreasCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_FormatosAreasCrear").html(data);
        $('#Are_Codigo').multiselect({
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
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_Codigo").val();
    d_tipo = "2";

    $.ajax({
      type: "POST",
      url: "f_cargarAreasCrear.php",
      beforeSend: function () {
        $(".e_cargarAreaCrear").html(loader());
      },
      data: {
        planta: d_planta,
        tipo: d_tipo
      },
      success: function (data) {
        $(".e_cargarAreaCrear").html(data);
        $('#Are_Codigo').multiselect({
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
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_FormatosAreasCrear", function (e) {
    e.preventDefault();

    d_area = $("#f_FormatosAreasCrear #Are_Codigo").val();
    d_formato = $("#f_FormatosAreasCrear #For_Codigo").val();

    $.ajax({
      type: "POST",
      url: "op_formatosAreasCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_FormatosAreasCrear");
        $("#Btn_FormatosAreasCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_FormatosAreasCrear");
        $("#Btn_FormatosAreasCrearForm").show();
      },
      data: {
        area: d_area,
        formato: d_formato
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FormatosAreasNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_FormatosAreasNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');

        } else {
          $("#vtn_FormatosAreasNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_FormatosAreasNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_FormatosAreasNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_FormatosAreasNotificacionesCrear").modal('hide');
    $("#vtn_FormatosAreasCrear").modal('hide');

    d_planta = $("#filtroFormatosAreas_Planta").val();
    d_area = $("#filtroFormatosAreas_Area").val();
    d_formato = $("#filtroFormatosAreas_Formatos").val();
    d_estado = $("#filtroFormatosAreas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_formatosAreasListar.php",
      beforeSend: function () {
        $(".info_FormatosAreasListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado,
        formatos: d_formato
      },
      success: function (data) {
        $(".info_FormatosAreasListar").html(data);
        $("#tbl_formatosAreasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarformatosAreas", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_FormatosAreasActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_formatosAreasActualizar.php",
      beforeSend: function () {
        $(".info_FormatosAreasActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_FormatosAreasActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#Pla_CodigoAct", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_CodigoAct").val();
    d_codigo = $("#codigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarAreasActualizar.php",
      beforeSend: function () {
        $(".e_cargarAreaActualizar").html(loader());
      },
      data: {
        planta: d_planta,
        codigo: d_codigo
      },
      success: function (data) {
        $(".e_cargarAreaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_FormatosAreasActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_FormatosAreasActualizar #codigoAct").val();
    d_area = $("#f_FormatosAreasActualizar #Are_CodigoAct").val();
    d_formato = $("#f_FormatosAreasActualizar #For_CodigoAct").val();
    d_estado = $("#f_FormatosAreasActualizar #ForA_EstadoAct").val();

    $.ajax({
      type: "POST",
      url: "op_formatosAreasActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_FormatosAreasActualizar");
        $("#Btn_FormatosAreasActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_FormatosAreasActualizar");
        $("#Btn_FormatosAreasActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        area: d_area,
        formato: d_formato,
        estado: d_estado
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FormatosAreasNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosAreasNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');

        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_FormatosAreasNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosAreasNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_FormatosAreasNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_FormatosAreasNotificacionesActualizar").modal('hide');
    $("#vtn_FormatosAreasActualizar").modal('hide');

    d_planta = $("#filtroFormatosAreas_Planta").val();
    d_area = $("#filtroFormatosAreas_Area").val();
    d_formato = $("#filtroFormatosAreas_Formatos").val();
    d_estado = $("#filtroFormatosAreas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_formatosAreasListar.php",
      beforeSend: function () {
        $(".info_FormatosAreasListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado,
        formatos: d_formato
      },
      success: function (data) {
        $(".info_FormatosAreasListar").html(data);
        $("#tbl_formatosAreasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarformatosAreas", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_FormatoAreasConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_FormatosAreasEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_FormatoAreasConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_FormatosAreasEliminar").val();
    $("#vtn_FormatoAreasConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_formatosAreasEliminar.php",
      beforeSend: function () {
        $(".e_eliminarformatosAreas").hide();
      },
      complete: function () {
        $(".e_eliminarformatosAreas").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FormatosAreasNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosAreasNotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');

        } else {
          $("#vtn_FormatosAreasNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosAreasNotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_FormatosAreasNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_FormatosAreasNotificacionesEliminar").modal('hide');

    d_planta = $("#filtroFormatosAreas_Planta").val();
    d_area = $("#filtroFormatosAreas_Area").val();
    d_formato = $("#filtroFormatosAreas_Formatos").val();
    d_estado = $("#filtroFormatosAreas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_formatosAreasListar.php",
      beforeSend: function () {
        $(".info_FormatosAreasListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado,
        formatos: d_formato
      },
      success: function (data) {
        $(".info_FormatosAreasListar").html(data);
        $("#tbl_formatosAreasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
});
