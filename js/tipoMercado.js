$(document).ready(function (e) {
  $('#filtroTipoM_Planta').multiselect({
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

  $('#filtroTipoM_Submarca').multiselect({
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

  $("body").on("click", "#Btn_TipoMercadoBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroTipoM_Planta").val();
    d_submarca = $("#filtroTipoM_Submarca").val();
    d_estado = $("#filtroTipoM_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_tipoMListar.php",
      beforeSend: function () {
        $(".info_TipoMercadoListar").html(loader());
      },
      data: {
        planta: d_planta,
        submarca: d_submarca,
        estado: d_estado
      },
      success: function (data) {
        $(".info_TipoMercadoListar").html(data);
        $("#tbl_TipoMercadoListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });


  $("body").on("click", "#Btn_TipoMercadoCrear", function (e) {
    e.preventDefault();

    $("#vtn_TipoMercadoCrear").modal({
      backdrop: 'static'
    });
    $.ajax({
      type: "POST",
      url: "f_tipoMCrear.php",
      beforeSend: function () {
        $(".info_TipoMercadoCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_TipoMercadoCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#Pla_Codigo_tipoM", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_Codigo_tipoM").val();

    $.ajax({
      type: "POST",
      url: "f_cargarSubmarcas.php",
      beforeSend: function () {
        $(".e_cargarsubmarcasCrear").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarsubmarcasCrear").html(data);
        $('#Sub_Codigo').multiselect({
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
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_tipoMCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_tipoMCrear #Pla_Codigo_tipoM").val();
    d_submarca = $("#f_tipoMCrear #Sub_Codigo").val();
    d_tipo = $("#f_tipoMCrear #TipoM_Tipo").val();

    $.ajax({
      type: "POST",
      url: "op_tipoMCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_tipoMCrear");
        $("#Btn_TipoMercadoCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_tipoMCrear");
        $("#Btn_TipoMercadoCrearForm").show();
      },
      data: {
        planta: d_planta,
        submarca: d_submarca,
        tipo: d_tipo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_TipoMercadoNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_TipoMercadoNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');

        } else {
          $("#vtn_TipoMercadoNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_TipoMercadoNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_TipoMercadoNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_TipoMercadoNotificacionesCrear").modal('hide');
    $("#vtn_TipoMercadoCrear").modal('hide');

    d_planta = $("#filtroTipoM_Planta").val();
    d_submarca = $("#filtroTipoM_Submarca").val();
    d_estado = $("#filtroTipoM_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_tipoMListar.php",
      beforeSend: function () {
        $(".info_TipoMercadoListar").html(loader());
      },
      data: {
        planta: d_planta,
        submarca: d_submarca,
        estado: d_estado
      },
      success: function (data) {
        $(".info_TipoMercadoListar").html(data);
        $("#tbl_TipoMercadoListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarTipoMercado", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_TipoMercadoActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_tipoMActualizar.php",
      beforeSend: function () {
        $(".info_TipoMercadosActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_TipoMercadosActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#Pla_Codigo_tipoMercadosAct", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_Codigo_tipoMercadosAct").val();
    d_codigo = $("#codigotipoMercadoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarSubmarcasActualizar.php",
      beforeSend: function () {
        $(".e_cargarSubmarcasActualizar").html(loader());
      },
      data: {
        planta: d_planta,
        codigo: d_codigo
      },
      success: function (data) {
        $(".e_cargarSubmarcasActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_tipoMercadosActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_tipoMercadosActualizar #codigotipoMercadoAct").val();
    d_planta = $("#f_tipoMercadosActualizar #Pla_Codigo_tipoMercadosAct").val();
    d_submarca = $("#f_tipoMercadosActualizar #Sub_CodigoAct").val();
    d_tipo = $("#f_tipoMercadosActualizar #TipoM_TipoAct").val();
    d_estado = $("#f_tipoMercadosActualizar #TipoM_EstadoAct").val();

    $.ajax({
      type: "POST",
      url: "op_tipoMActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_tipoMercadosActualizar");
        $("#Btn_TipoMercadoActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_tipoMercadosActualizar");
        $("#Btn_TipoMercadoActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        submarca: d_submarca,
        tipo: d_tipo,
        estado: d_estado
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_TipoMercadoNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_TipoMercadoNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_TipoMercadoNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_TipoMercadoNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_TipoMercadoNotificacionesActualizar", function (e) {
    e.preventDefault();
    $("#vtn_TipoMercadoNotificacionesActualizar").modal('hide');
    $("#vtn_TipoMercadoActualizar").modal('hide');

    d_planta = $("#filtroTipoM_Planta").val();
    d_submarca = $("#filtroTipoM_Submarca").val();
    d_estado = $("#filtroTipoM_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_tipoMListar.php",
      beforeSend: function () {
        $(".info_TipoMercadoListar").html(loader());
      },
      data: {
        planta: d_planta,
        submarca: d_submarca,
        estado: d_estado
      },
      success: function (data) {
        $(".info_TipoMercadoListar").html(data);
        $("#tbl_TipoMercadoListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarTipoMercado", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_TipoMercadoConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_TipoMercadoEliminar").val(d_codigo);

  });


  $("body").on("click", "#Btn_TipoMercadoConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_TipoMercadoEliminar").val();
    $("#vtn_TipoMercadoConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_tipoMEliminar.php",
      beforeSend: function () {
        $(".e_eliminarTipoMercado").hide();
      },
      complete: function () {
        $(".e_eliminarTipoMercado").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_TipoMercadoNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_TipoMercadoNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');

        } else {
          $("#vtn_TipoMercadoNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_TipoMercadoNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_TipoMercadoNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_TipoMercadoNotificacionesEliminar").modal('hide');

    d_planta = $("#filtroTipoM_Planta").val();
    d_submarca = $("#filtroTipoM_Submarca").val();
    d_estado = $("#filtroTipoM_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_tipoMListar.php",
      beforeSend: function () {
        $(".info_TipoMercadoListar").html(loader());
      },
      data: {
        planta: d_planta,
        submarca: d_submarca,
        estado: d_estado
      },
      success: function (data) {
        $(".info_TipoMercadoListar").html(data);
        $("#tbl_TipoMercadoListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

});
