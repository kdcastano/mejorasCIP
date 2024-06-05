$(document).ready(function (e) {

  $("body").on("click", ".e_crearAreaAgrupacion", function (e) {
    e.preventDefault();

    d_area = $("#agrupaciones_AreaAgregar").val();
    d_codigoAgrupacion = $(this).attr("data-cod");

    $.ajax({
      type: "POST",
      url: "op_areaAgrupacionCrear.php",
      beforeSend: function () {
        $(".e_crearAreaAgrupacion").hide();
      },
      complete: function () {
        $(".e_crearAreaAgrupacion").show();
      },
      data: {
        area: d_area,
        agrupacion: d_codigoAgrupacion
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          d_Agrupacion = $("#codigoAgrupacion").val();
          $.ajax({
            type: "POST",
            url: "f_agregarAreaAgrupacion.php",
            beforeSend: function () {
              $(".info_AreasAgrupacionesCrear").html(loader());
            },
            data: {
              codigo: d_Agrupacion
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
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
          $.ajax({
            type: "POST",
            url: "f_areasAgrupacionesListar.php",
            beforeSend: function () {
              $(".info_ListarAreasAgregadasAgrupacion").html(loader());
            },
            data: {
              agrupacion: d_Agrupacion
            },
            success: function (data) {
              $(".info_ListarAreasAgregadasAgrupacion").html(data);
              $("#tbl_areasAgrupacionesListar").tablesorter();
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
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        } else {
          d_Agrupacion = $("#codigoAgrupacion").val();
          $.ajax({
            type: "POST",
            url: "f_areasAgrupacionesListar.php",
            beforeSend: function () {
              $(".info_ListarAreasAgregadasAgrupacion").html(loader());
            },
            data: {
              agrupacion: d_Agrupacion
            },
            success: function (data) {
              $(".info_ListarAreasAgregadasAgrupacion").html(data);
              $("#tbl_areasAgrupacionesListar").tablesorter();
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
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_areaAgrupacionEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    d_planta = $(this).attr("data-pla");
    $.ajax({
      type: "POST",
      url: "op_areaAgrupacionEliminar.php",
      beforeSend: function () {
        //$(".e_areaAgrupacionEliminar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".e_areaAgrupacionEliminar").html(data);
        d_agrupacion = $("#codigoAgrupacion").val();
        $.ajax({
          type: "POST",
          url: "f_areasAgrupacionesListar.php",
          beforeSend: function () {
            $(".info_ListarAreasAgregadasAgrupacion").html(loader());
          },
          data: {
            agrupacion: d_agrupacion
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
        d_agrupacion = $("#codigoAgrupacion").val();

        $.ajax({
          type: "POST",
          url: "f_areasAgrupacionesListar.php",
          beforeSend: function () {
            $(".info_ListarAreasAgregadasAgrupacion").html(loader());
          },
          data: {
            agrupacion: d_agrupacion
          },
          success: function (data) {
            $(".info_ListarAreasAgregadasAgrupacion").html(data);
            $("#tbl_areasAgrupacionesListar").tablesorter();
          },
          error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
          }
        });
        console.log(er2 + "-" + er3);
      }
    });
  });


});
