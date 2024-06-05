$(document).ready(function (e) {

  $('#plantas_Buscar').keyup(function () {
    var rex = new RegExp($(this).val(), 'i');
    $('.buscar tr').hide();
    $('.buscar tr').filter(function () {
      return rex.test($(this).text());
    }).show();
  });

  $.ajax({
    type: "POST",
    url: "f_plantasListar.php",
    beforeSend: function () {
      $(".info_PlantasListar").html(loader());
    },
    data: {},
    success: function (data) {
      $(".info_PlantasListar").html(data);
		$("#tbl_PlantasListar").tablesorter();
    },
    error: function (er1, er2, er3) {
      console.log(er2 + "-" + er3);
    }
  });

  $("body").on("click", "#Btn_PlantasCrear", function (e) {
    e.preventDefault();

    $("#vtn_PlantasCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_plantaCrear.php",
      beforeSend: function () {
        $(".info_PlantasCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_PlantasCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_PlantasCrearForm", function (e) {
    e.preventDefault();

    d_centroCosto = $("#Pla_CentroCostos").val();
    d_nombre = $("#Pla_Nombre").val();
    d_acceso = $("#Pla_VerMarcaSubMarca").val();
    d_formatoSAP = $("#Pla_FormatoSAP").val();
    d_horaAHora = $("#Pla_HoraAHora").val();
    d_aprobador = $("#Pla_CantidadAprobador").val();
//    d_grupo = $("#Pla_Grupo").val();
//    d_negocio = $("#Pla_Negocio").val();
//    d_distribucion = $("#Pla_Distribucion").val();
//    d_marca = $("#Pla_Marca").val();

    $.ajax({
      type: "POST",
      url: "op_plantaCrear.php",
      beforeSend: function () {
        $("#Btn_PlantasCrearForm").hide();
      },
      complete: function () {
        $("#Btn_PlantasCrearForm").show();
      },
      data: {
        centroCosto: d_centroCosto,
        nombre: d_nombre,
        acceso: d_acceso,
        formato: d_formatoSAP,
        horaAHora: d_horaAHora,
        aprobador: d_aprobador
//        grupo: d_grupo,
//        negocio: d_negocio,
//        distribucion: d_distribucion,
//        marca: d_marca
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_PlantasNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');

        } else {
          $("#vtn_PlantasNotificacionesCrear").modal({
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

  $("body").on("click", "#Btn_PlantasNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_PlantasNotificacionesCrear").modal('hide');
    $("#vtn_PlantasCrear").modal('hide');

    $.ajax({
      type: "POST",
      url: "f_plantasListar.php",
      beforeSend: function () {
        $(".info_PlantasListar").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_PlantasListar").html(data);
		$("#tbl_PlantasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_editarPlanta", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_PlantasActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_plantaActualizar.php",
      beforeSend: function () {
        $(".info_PlantasActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_PlantasActualizar").html(data);
        //        $("#id_tabla").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_PlantasActualizarForm", function (e) {
    e.preventDefault();


    d_codigo = $("#codigoAct").val();
    d_centroCosto = $("#Pla_CentroCostosAct").val();
    d_nombre = $("#Pla_NombreAct").val();
    d_grupo = $("#Pla_GrupoAct").val();
    d_distribucion = $("#Pla_DistribucionAct").val();
    d_marca = $("#Pla_MarcaAct").val();
    d_estado = $("#Pla_EstadoAct").val();
    d_acceso = $("#Pla_VerMarcaSubMarcaAct").val();
    d_formatoSAP = $("#Pla_FormatoSAPAct").val();
    d_horaAHora = $("#Pla_HoraAHoraAct").val();
    d_aprobador = $("#Pla_CantidadAprobadorAct").val();

    $.ajax({
      type: "POST",
      url: "op_plantaActualizar.php",
      beforeSend: function () {
        $("#Btn_PlantasActualizarForm").hide();
      },
      complete: function () {
        $("#Btn_PlantasActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        centroCosto: d_centroCosto,
        nombre: d_nombre,
        grupo: d_grupo,
        distribucion: d_distribucion,
        marca: d_marca,
		estado: d_estado,
        acceso: d_acceso,
        formato: d_formatoSAP,
        horaAHora: d_horaAHora,
        aprobador: d_aprobador
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_PlantasNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');

        } else {
          $("#vtn_PlantasNotificacionesActualizar").modal({
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

  $("body").on("click", "#Btn_PlantasNotificacionesActualizar", function (e) {
    e.preventDefault();
    $("#vtn_PlantasNotificacionesActualizar").modal('hide');
    $("#vtn_PlantasActualizar").modal('hide');

    $.ajax({
      type: "POST",
      url: "f_plantasListar.php",
      beforeSend: function () {
        $(".info_PlantasListar").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_PlantasListar").html(data);
		$("#tbl_PlantasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
    $("body").on("click", ".e_eliminarPlanta", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_PlantasNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_plantaEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_PlantasNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_plantaEliminar").val();
    $("#vtn_PlantasNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_plantaEliminar.php",
      beforeSend: function () {
        $(".e_eliminarPlanta").hide();
      },
      complete: function () {
        $(".e_eliminarPlanta").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_PlantaEliminar").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');

        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_PlantaEliminar").modal({
            backdrop: 'static'
          });
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO eliminado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_PlantaEliminar", function (e) {
    e.preventDefault();

    $("#vtn_PlantaEliminar").modal('hide');
    $.ajax({
      type: "POST",
      url: "f_plantasListar.php",
      beforeSend: function () {
        $(".info_PlantasListar").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_PlantasListar").html(data);
		$("#tbl_PlantasListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });


});
