$(document).ready(function (e) {

  $('#filtroSubmarcas_Planta').multiselect({
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

  $("body").on("click", "#Btn_SubmarcasBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroSubmarcas_Planta").val();
    d_estado = $("#filtroSubmarcas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_submarcasListar.php",
      beforeSend: function () {
        $(".info_SubmarcasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_SubmarcasListar").html(data);
        $("#tbl_submarcasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_SubmarcasCrear", function (e) {
    e.preventDefault();

    $("#vtn_SubmarcasCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_submarcasCrear.php",
      beforeSend: function () {
        $(".info_SubmarcasCrear").html(loader());
      },
      success: function (data) {
        $(".info_SubmarcasCrear").html(data);
        $('#Sub_Pla_Codigo').multiselect({
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

  $("body").on("submit", "#f_submarcasCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_submarcasCrear #Sub_Pla_Codigo").val();
    d_nombre = $("#f_submarcasCrear #Sub_Nombre").val();

    $.ajax({
      type: "POST",
      url: "op_submarcasCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_submarcasCrear");
        $("#Btn_SubmarcasCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_submarcasCrear");
        $("#Btn_SubmarcasCrearForm").show();
      },
      data: {
        planta: d_planta,
        nombre: d_nombre
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_SubmarcasNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_SubmarcasNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        } else {
          $("#vtn_SubmarcasNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_SubmarcasNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_SubmarcasNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_SubmarcasNotificacionesCrear").modal('hide');
    $("#vtn_SubmarcasCrear").modal('hide');

    d_planta = $("#filtroSubmarcas_Planta").val();
    d_estado = $("#filtroSubmarcas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_submarcasListar.php",
      beforeSend: function () {
        $(".info_SubmarcasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_SubmarcasListar").html(data);
        $("#tbl_submarcasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarSubmarca", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_SubmarcasActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_submarcasActualizar.php",
      beforeSend: function () {
        $(".info_SubmarcasActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_SubmarcasActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_submarcasActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_submarcasActualizar #codigoAct").val();
    d_planta = $("#f_submarcasActualizar #Sub_Pla_CodigoAct").val();
    d_nombre = $("#f_submarcasActualizar #Sub_NombreAct").val();
    d_estado = $("#f_submarcasActualizar #Sub_EstadoAct").val();

    $.ajax({
      type: "POST",
      url: "op_submarcasActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_submarcasActualizar");
        $("#Btn_SubmarcasActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_submarcasActualizar");
        $("#Btn_SubmarcasActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        nombre: d_nombre,
        estado: d_estado
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_SubmarcasNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_SubmarcasNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_SubmarcasNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_SubmarcasNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_SubmarcasNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_SubmarcasNotificacionesActualizar").modal('hide');
    $("#vtn_SubmarcasActualizar").modal('hide');

    d_planta = $("#filtroSubmarcas_Planta").val();
    d_estado = $("#filtroSubmarcas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_submarcasListar.php",
      beforeSend: function () {
        $(".info_SubmarcasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_SubmarcasListar").html(data);
        $("#tbl_submarcasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarSubmarca", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_SubMarcasConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_SubmarcasEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_SubMarcasConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_SubmarcasEliminar").val();
    $("#vtn_SubMarcasConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_submarcasEliminar.php",
      beforeSend: function () {
        $("#e_eliminarSubmarca").hide();
      },
      complete: function () {
        $("#e_eliminarSubmarca").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_SubmarcasNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_SubmarcasNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_SubmarcasNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_SubmarcasNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_SubmarcasNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_SubmarcasNotificacionesEliminar").modal('hide');

    d_planta = $("#filtroSubmarcas_Planta").val();
    d_estado = $("#filtroSubmarcas_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_submarcasListar.php",
      beforeSend: function () {
        $(".info_SubmarcasListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_SubmarcasListar").html(data);
        $("#tbl_submarcasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });


});
