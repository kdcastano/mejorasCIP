  $("body").on("click", ".e_cargarEliminarFT", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_FichaTecnicaNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_FichaTecnica").val(d_codigo);

   //d_codigo = $(".Cod_ConfigReporte").val();
    //$("#vtn_ConfiguracionReportesNotificacionesEliminar").modal('hide');

  });$(document).ready(function (e) {
  $('#filtroFormatos_Planta').multiselect({
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

  $("body").on("click", "#Btn_FormatosBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroFormatos_Planta").val();
    d_estado = $("#filtroFormatos_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_formatosListar.php",
      beforeSend: function () {
        $(".info_FormatosListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_FormatosListar").html(data);
        $("#tbl_formatosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_FormatosCrear", function (e) {
    e.preventDefault();

    $("#vtn_FormatosCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_formatosCrear.php",
      beforeSend: function () {
        $(".info_FormatosCrear").html(loader());
      },
      success: function (data) {
        $(".info_FormatosCrear").html(data);
        $('#For_Pla_Codigo').multiselect({
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

  $("body").on("submit", "#f_formatosCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_formatosCrear #For_Pla_Codigo").val();
    d_nombre = $("#f_formatosCrear #For_Nombre").val();
    d_factorConversion = $("#f_formatosCrear #For_FactorConversion").val();

    $.ajax({
      type: "POST",
      url: "op_formatosCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_formatosCrear");
        $("#Btn_FormatosCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_formatosCrear");
        $("#Btn_FormatosCrearForm").show();
      },
      data: {
        planta: d_planta,
        nombre: d_nombre,
        factorConversion: d_factorConversion
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FormatosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_FormatosNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        } else {
          $("#vtn_FormatosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_FormatosNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_FormatosNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_FormatosNotificacionesCrear").modal('hide');
    $("#vtn_FormatosCrear").modal('hide');

    d_planta = $("#filtroFormatos_Planta").val();
    d_estado = $("#filtroFormatos_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_formatosListar.php",
      beforeSend: function () {
        $(".info_FormatosListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_FormatosListar").html(data);
        $("#tbl_formatosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarFormato", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_FormatosActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_formatosActualizar.php",
      beforeSend: function () {
        $(".info_FormatosActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_FormatosActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_formatosActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_formatosActualizar #codigoAct").val();
    d_planta = $("#f_formatosActualizar #For_Pla_CodigoAct").val();
    d_nombre = $("#f_formatosActualizar #For_NombreAct").val();
    d_factorConversion = $("#f_formatosActualizar #For_FactorConversionAct").val();
    d_estado = $("#f_formatosActualizar #For_EstadoAct").val();

    $.ajax({
      type: "POST",
      url: "op_formatosActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_formatosActualizar");
        $("#Btn_FormatosActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_formatosActualizar");
        $("#Btn_FormatosActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        nombre: d_nombre,
        estado: d_estado,
        factorConversion: d_factorConversion
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FormatosNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_FormatosNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_FormatosNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_FormatosNotificacionesActualizar").modal('hide');
    $("#vtn_FormatosActualizar").modal('hide');

    d_planta = $("#filtroFormatos_Planta").val();
    d_estado = $("#filtroFormatos_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_formatosListar.php",
      beforeSend: function () {
        $(".info_FormatosListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_FormatosListar").html(data);
        $("#tbl_formatosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
    
  $("body").on("click", ".e_eliminarFormato", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_FormatosConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_FormatosEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_FormatosConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_FormatosEliminar").val();
    $("#vtn_FormatosConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_formatosEliminar.php",
      beforeSend: function () {
        $("#e_eliminarFormato").hide();
      },
      complete: function () {
        $("#e_eliminarFormato").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FormatosNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_FormatosNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_FormatosNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

    $("body").on("click", "#Btn_FormatosNotificacionesEliminar", function (e) {
      e.preventDefault();

      $("#vtn_FormatosNotificacionesEliminar").modal('hide');

      d_planta = $("#filtroFormatos_Planta").val();
      d_estado = $("#filtroFormatos_Estado").val();

      $.ajax({
        type: "POST",
        url: "f_formatosListar.php",
        beforeSend: function () {
          $(".info_FormatosListar").html(loader());
        },
        data: {
          planta: d_planta,
          estado: d_estado
        },
        success: function (data) {
          $(".info_FormatosListar").html(data);
          $("#tbl_formatosListar").tablesorter();
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
    });
  });

});
