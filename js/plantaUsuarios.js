$(document).ready(function (e) {

  $("body").on("click", ".e_crearPlantaUsuario", function (e) {
    e.preventDefault();

    d_planta = $("#usuarios_PlantaAgregar").val();
    d_codigoUsuario = $(this).attr("data-cod");

    $.ajax({
      type: "POST",
      url: "op_plantaUsuarioCrear.php",
      beforeSend: function () {
        $(".e_crearPlantaUsuario").hide();
      },
      complete: function () {
        $(".e_crearPlantaUsuario").show();
      },
      data: {
        planta: d_planta,
        usuario: d_codigoUsuario
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          d_Usuario = $("#codigoUsuario").val();
          $.ajax({
            type: "POST",
            url: "f_plantaUsuariosListar.php",
            beforeSend: function () {
              $(".info_ListarPlantasAgregadasUsuario").html(loader());
            },
            data: {
              usuario: d_Usuario
            },
            success: function (data) {
              $(".info_ListarPlantasAgregadasUsuario").html(data);
              $("#tbl_plantaUsuariosListar").tablesorter();
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        } else {
          d_Usuario = $("#codigoUsuario").val();
          $.ajax({
            type: "POST",
            url: "f_plantaUsuariosListar.php",
            beforeSend: function () {
              $(".info_ListarPlantasAgregadasUsuario").html(loader());
            },
            data: {
              usuario: d_Usuario
            },
            success: function (data) {
              $(".info_ListarPlantasAgregadasUsuario").html(data);
              $("#tbl_plantaUsuariosListar").tablesorter();
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

  $("body").on("click", ".e_plantaUsuarioEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $.ajax({
      type: "POST",
      url: "op_plantaUsuariosEliminar.php",
      beforeSend: function () {
        //$(".e_plantaUsuarioEliminar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".e_plantaUsuarioEliminar").html(data);
        d_usuario = $("#codigoUsuario").val();

        $.ajax({
          type: "POST",
          url: "f_plantaUsuariosListar.php",
          beforeSend: function () {
            $(".info_ListarPlantasAgregadasUsuario").html(loader());
          },
          data: {
            usuario: d_usuario
          },
          success: function (data) {
            $(".info_ListarPlantasAgregadasUsuario").html(data);
            $("#tbl_plantaUsuariosListar").tablesorter();
          },
          error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
          }
        });
      },
      error: function (er1, er2, er3) {
         d_usuario = $("#codigoUsuario").val();

        $.ajax({
          type: "POST",
          url: "f_plantaUsuariosListar.php",
          beforeSend: function () {
            $(".info_ListarPlantasAgregadasUsuario").html(loader());
          },
          data: {
            usuario: d_usuario
          },
          success: function (data) {
            $(".info_ListarPlantasAgregadasUsuario").html(data);
            $("#tbl_plantaUsuariosListar").tablesorter();
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
