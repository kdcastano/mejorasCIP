$(document).ready(function (e) {

  $('#filtroFormatosHornos_Planta').multiselect({
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

  $('#filtroFormatosHornos_Area').multiselect({
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

  $('#filtroFormatosHornos_Formatos').multiselect({
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

  $("body").on("click", "#Btn_FormatosHornosBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroFormatosHornos_Planta").val();
    d_area = $("#filtroFormatosHornos_Area").val();
    d_estado = $("#filtroFormatosHornos_Estado").val();
    d_formato = $("#filtroFormatosHornos_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_formatosHornosListar.php",
      beforeSend: function () {
        $(".info_FormatosHornosListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado,
        formatos: d_formato
      },
      success: function (data) {
        $(".info_FormatosHornosListar").html(data);
        $("#tbl_formatosHornosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });


  $("body").on("click", "#Btn_FormatosHornosCrear", function (e) {
    e.preventDefault();

    $("#vtn_FormatosHornosCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_formatosHornosCrear.php",
      beforeSend: function () {
        $(".info_FormatosHornosCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_FormatosHornosCrear").html(data);
        //        $("#id_tabla").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_Codigo").val();
    d_tipo = "1";

    $.ajax({
      type: "POST",
      url: "f_cargarAreas.php",
      beforeSend: function () {
        $(".e_cargarAreaCrear").html(loader());
      },
      data: {
        planta: d_planta,
        tipo: d_tipo
      },
      success: function (data) {
        $(".e_cargarAreaCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_FormatosHornosCrear", function (e) {
    e.preventDefault();

    d_area = $("#f_FormatosHornosCrear #Are_Codigo").val();
    d_formato = $("#f_FormatosHornosCrear #For_Codigo").val();

    $.ajax({
      type: "POST",
      url: "op_formatosHornosCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_FormatosHornosCrear");
        $("#Btn_FormatosHornosCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_FormatosHornosCrear");
        $("#Btn_FormatosHornosCrearForm").show();
      },
      data: {
        area: d_area,
        formato: d_formato
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FormatosHornosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_FormatosHornosNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');

        } else {
          $("#vtn_FormatosHornosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_FormatosHornosNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_FormatosHornosNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_FormatosHornosNotificacionesCrear").modal('hide');
    $("#vtn_FormatosHornosCrear").modal('hide');

    d_planta = $("#filtroFormatosHornos_Planta").val();
    d_fases = $("#filtroFormatosHornos_Fases").val();
    d_canales = $("#filtroFormatosHornos_Canales").val();
    d_area = $("#filtroFormatosHornos_Area").val();
    d_estado = $("#filtroFormatosHornos_Estado").val();
    d_formato = $("#filtroFormatosHornos_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_formatosHornosListar.php",
      beforeSend: function () {
        $(".info_FormatosHornosListar").html(loader());
      },
      data: {
        planta: d_planta,
        fases: d_fases,
        canales: d_canales,
        area: d_area,
        estado: d_estado,
        formatos: d_formato
      },
      success: function (data) {
        $(".info_FormatosHornosListar").html(data);
        $("#tbl_formatosHornosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_editarFormatosHornos", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_FormatosHornosActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_formatosHornosActualizar.php",
      beforeSend: function () {
        $(".info_FormatosHornosActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_FormatosHornosActualizar").html(data);
        //        $("#id_tabla").tablesorter();
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
    d_tipo = "1";

    $.ajax({
      type: "POST",
      url: "f_cargarAreasActualizar.php",
      beforeSend: function () {
        $(".e_cargarAreaActualizar").html(loader());
      },
      data: {
        planta: d_planta,
        codigo: d_codigo,
        tipo: d_tipo
      },
      success: function (data) {
        $(".e_cargarAreaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_FormatosHornosActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_FormatosHornosActualizar #codigoAct").val();
    d_area = $("#f_FormatosHornosActualizar #Are_CodigoAct").val();
    d_formato = $("#f_FormatosHornosActualizar #For_CodigoAct").val();
    d_estado = $("#f_FormatosHornosActualizar #ForH_EstadoAct").val();

    $.ajax({
      type: "POST",
      url: "op_formatosHornosActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_FormatosHornosActualizar");
        $("#Btn_FormatosHornosActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_FormatosHornosActualizar");
        $("#Btn_FormatosHornosActualizarForm").show();
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
          $("#vtn_FormatosHornosNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosHornosNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');

        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_FormatosHornosNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosHornosNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_FormatosHornosNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_FormatosHornosNotificacionesActualizar").modal('hide');
    $("#vtn_FormatosHornosActualizar").modal('hide');

    d_planta = $("#filtroFormatosHornos_Planta").val();
    d_area = $("#filtroFormatosHornos_Area").val();
    d_estado = $("#filtroFormatosHornos_Estado").val();
    d_formato = $("#filtroFormatosHornos_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_formatosHornosListar.php",
      beforeSend: function () {
        $(".info_FormatosHornosListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado,
        formatos: d_formato
      },
      success: function (data) {
        $(".info_FormatosHornosListar").html(data);
        $("#tbl_formatosHornosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("click", ".e_eliminarFormatosHornos", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_FormatosAreasConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_FormatoAreasEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_FormatosAreasConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_FormatoAreasEliminar").val();
    $("#vtn_FormatosAreasConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_formatosHornosEliminar.php",
      beforeSend: function () {
        $(".e_eliminarFormatosHornos").hide();
      },
      complete: function () {
        $(".e_eliminarFormatosHornos").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FormatosHornosNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosHornosNotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');

        } else {
          $("#vtn_FormatosHornosNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosHornosNotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_FormatosHornosNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_FormatosHornosNotificacionesEliminar").modal('hide');
    d_planta = $("#filtroFormatosHornos_Planta").val();
    d_area = $("#filtroFormatosHornos_Area").val();
    d_estado = $("#filtroFormatosHornos_Estado").val();
    d_formato = $("#filtroFormatosHornos_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_formatosHornosListar.php",
      beforeSend: function () {
        $(".info_FormatosHornosListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado,
        formatos: d_formato
      },
      success: function (data) {
        $(".info_FormatosHornosListar").html(data);
        $("#tbl_formatosHornosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });


});
