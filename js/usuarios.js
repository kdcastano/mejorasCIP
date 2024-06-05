$(document).ready(function (e) {

  $('#filtroUsuarios_Planta').multiselect({
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

  $("body").on("click", "#Btn_buscarUsuarios", function (e) {
    e.preventDefault();

    d_planta = $("#filtroUsuarios_Planta").val();

    $.ajax({
      type: "POST",
      url: "f_usuariosListar.php",
      beforeSend: function () {
        $(".info_usuariosListar").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".info_usuariosListar").html(data);
        $("#tbl_UsuariosListar").tablesorter();
        $('#filtrarUsuarios').keyup(function () {
          var rex = new RegExp($(this).val(), 'i');
          $('.buscar tr').hide();
          $('.buscar tr').filter(function () {
            return rex.test($(this).text());
          }).show();
        });
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_UsuariosCrear", function (e) {
    e.preventDefault();

    $("#vtn_UsuariosCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_usuariosCrear.php",
      beforeSend: function () {
        $(".info_UsuariosCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_UsuariosCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_cargarCargos.php",
      beforeSend: function () {
        $(".e_cargarCargosCrear").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarCargosCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_usuariosCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_usuariosCrear #Pla_Codigo").val();
    d_usuario = $("#f_usuariosCrear #Usu_Usuario").val();
    d_cedula = $("#f_usuariosCrear #Usu_Documento").val();
    d_nombre = $("#f_usuariosCrear #Usu_Nombres").val();
    d_apellido = $("#f_usuariosCrear #Usu_Apellidos").val();
    d_rol = $("#f_usuariosCrear #Usu_rol").val();
    d_cargo = $("#f_usuariosCrear #Usu_Cargo").val();
    d_correo = $("#f_usuariosCrear #Usu_Correo").val();
    d_telefono = $("#f_usuariosCrear #Usu_TelMovil").val();
    d_foto = $("#f_usuariosCrear #i_Arc_Usu_Foto").val();

    $.ajax({
      type: "POST",
      url: "op_usuariosCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_usuariosCrear");
        $("#Btn_UsuariosCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_usuariosCrear");
        $("#Btn_UsuariosCrearForm").show();
      },
      data: {
        planta: d_planta,
        usuario: d_usuario,
        cedula: d_cedula,
        nombre: d_nombre,
        apellido: d_apellido,
        rol: d_rol,
        cargo: d_cargo,
        correo: d_correo,
        telefono: d_telefono,
        foto: d_foto
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_CrearCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_CrearCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');

        } else {
          $("#vtn_CrearCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_CrearCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_CrearCargarNotificaciones", function (e) {
    e.preventDefault();

    $("#vtn_CrearCargarNotificaciones").modal('hide');
    $("#vtn_UsuariosCrear").modal('hide');

    $.ajax({
      type: "POST",
      url: "f_usuariosListar.php",
      beforeSend: function () {
        $(".info_usuariosListar").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_usuariosListar").html(data);
        $("#tbl_UsuariosListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_editarUsuarios", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_UsuariosActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_usuariosActualizar.php",
      beforeSend: function () {
        $(".info_UsuariosActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_UsuariosActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_usuariosEditar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_usuariosEditar #codigoAct").val();
    d_planta = $("#f_usuariosEditar #Pla_CodigoAct").val();
    d_usuario = $("#f_usuariosEditar #Usu_UsuarioAct").val();
    d_cedula = $("#f_usuariosEditar #Usu_DocumentoAct").val();
    d_nombre = $("#f_usuariosEditar #Usu_NombresAct").val();
    d_apellido = $("#f_usuariosEditar #Usu_ApellidosAct").val();
    d_rol = $("#f_usuariosEditar #Usu_rolAct").val();
    d_cargo = $("#f_usuariosEditar #Usu_CargoAct").val();
    d_correo = $("#f_usuariosEditar #Usu_CorreoAct").val();
    d_telefono = $("#f_usuariosEditar #Usu_TelMovilAct").val();
    d_estado = $("#f_usuariosEditar #Usu_EstadoAct").val();
    d_foto = $("#f_usuariosEditar #i_Arc_Usu_FotoAct").val();

    $.ajax({
      type: "POST",
      url: "op_usuariosActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_usuariosEditar");
        $("#Btn_UsuariosActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_usuariosEditar");
        $("#Btn_UsuariosActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        usuario: d_usuario,
        cedula: d_cedula,
        nombre: d_nombre,
        apellido: d_apellido,
        rol: d_rol,
        cargo: d_cargo,
        correo: d_correo,
        telefono: d_telefono,
        estado: d_estado,
        foto: d_foto
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_ActualizarCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ActualizarCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_ActualizarCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ActualizarCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_ActualizarCargarNotificaciones", function (e) {
    e.preventDefault();
    $("#vtn_ActualizarCargarNotificaciones").modal('hide');
    $("#vtn_UsuariosActualizar").modal('hide');

    $.ajax({
      type: "POST",
      url: "f_usuariosListar.php",
      beforeSend: function () {
        $(".info_usuariosListar").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_usuariosListar").html(data);
        $("#tbl_UsuariosListar").tablesorter();
        $('#filtrarUsuarios').keyup(function () {
          var rex = new RegExp($(this).val(), 'i');
          $('.buscar tr').hide();
          $('.buscar tr').filter(function () {
            return rex.test($(this).text());
          }).show();
        });
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_permisosUsuarios", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_UsuariosPermisos").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_usuariosPermisos.php",
      beforeSend: function () {
        $(".info_UsuariosPermisos").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_UsuariosPermisos").html(data);
        $('#Per_Codigo').multiselect({
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

  //Ver
  $("body").on("change", ".e_PermisoUsuActualizar1", function (e) {

    e.preventDefault();
    d_codigo = $(this).attr("data-cod");
    i = $(this).attr("data-num");

    $("body input[name='ver" + i + "']").each(function (index, element) {
      if ($(this).prop("checked") == true) {
        d_valor1 = 1;
      } else {
        d_valor1 = 0;
      }
    });
    d_valor2 = "NO";
    d_valor3 = "NO";
    d_valor4 = "NO";

    $.ajax({
      type: "POST",
      url: "op_usuarioPermisosActualizar.php",
      beforeSend: function () {
        //bloquearFormulario("f_usuarioActualizar");
      },
      complete: function () {
        //desbloquearFormulario("f_usuarioActualizar");
      },
      data: {
        codigo: d_codigo,
        valor1: d_valor1,
        valor2: d_valor2,
        valor3: d_valor3,
        valor4: d_valor4
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {} else {
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  //Crear
  $("body").on("change", ".e_PermisoUsuActualizar2", function (e) {

    e.preventDefault();
    d_codigo = $(this).attr("data-cod");
    i = $(this).attr("data-num");

    $("body input[name='crear" + i + "']").each(function (index, element) {
      if ($(this).prop("checked") == true) {
        d_valor2 = 1;
      } else {
        d_valor2 = 0;
      }
    });
    d_valor1 = "NO";
    d_valor3 = "NO";
    d_valor4 = "NO";

    $.ajax({
      type: "POST",
      url: "op_usuarioPermisosActualizar.php",
      beforeSend: function () {
        //bloquearFormulario("f_usuarioActualizar");
      },
      complete: function () {
        //desbloquearFormulario("f_usuarioActualizar");
      },
      data: {
        codigo: d_codigo,
        valor1: d_valor1,
        valor2: d_valor2,
        valor3: d_valor3,
        valor4: d_valor4
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {} else {
          mensaje('2', rs.mensaje, "#d_mensajeModalusuarioAct");
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  // Modificar
  $("body").on("change", ".e_PermisoUsuActualizar3", function (e) {

    e.preventDefault();
    d_codigo = $(this).attr("data-cod");
    i = $(this).attr("data-num");

    $("body input[name='modificar" + i + "']").each(function (index, element) {
      if ($(this).prop("checked") == true) {
        d_valor3 = 1;
      } else {
        d_valor3 = 0;
      }
    });
    d_valor2 = "NO";
    d_valor1 = "NO";
    d_valor4 = "NO";

    $.ajax({
      type: "POST",
      url: "op_usuarioPermisosActualizar.php",
      beforeSend: function () {
        //bloquearFormulario("f_usuarioActualizar");
      },
      complete: function () {
        //desbloquearFormulario("f_usuarioActualizar");
      },
      data: {
        codigo: d_codigo,
        valor1: d_valor1,
        valor2: d_valor2,
        valor3: d_valor3,
        valor4: d_valor4
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {} else {
          mensaje('2', rs.mensaje, "#d_mensajeModalusuarioAct");
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  //Eliminar
  $("body").on("change", ".e_PermisoUsuActualizar4", function (e) {

    e.preventDefault();
    d_codigo = $(this).attr("data-cod");
    i = $(this).attr("data-num");

    $("body input[name='eliminar" + i + "']").each(function (index, element) {
      if ($(this).prop("checked") == true) {
        d_valor4 = 1;
      } else {
        d_valor4 = 0;
      }
    });
    d_valor2 = "NO";
    d_valor3 = "NO";
    d_valor1 = "NO";

    $.ajax({
      type: "POST",
      url: "op_usuarioPermisosActualizar.php",
      beforeSend: function () {
        //bloquearFormulario("f_usuarioActualizar");
      },
      complete: function () {
        //desbloquearFormulario("f_usuarioActualizar");
      },
      data: {
        codigo: d_codigo,
        valor1: d_valor1,
        valor2: d_valor2,
        valor3: d_valor3,
        valor4: d_valor4
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {} else {
          mensaje('2', rs.mensaje, "#d_mensajeModalusuarioAct");
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_agregarPlantaUsuarios", function (e) {
    e.preventDefault();

    $("#vtn_UsuariosPlantaCrear").modal({
      backdrop: 'static'
    });

    d_codigo = $(this).attr("data-cod");

    $.ajax({
      type: "POST",
      url: "f_agregarPlantasUsuarios.php",
      beforeSend: function () {
        $(".info_UsuariosPlantaCrear").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_UsuariosPlantaCrear").html(data);
        $('#usuarios_PlantaAgregar').multiselect({
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
          url: "f_plantaUsuariosListar.php",
          beforeSend: function () {
            $(".info_ListarPlantasAgregadasUsuario").html(loader());
          },
          data: {
            usuario: d_codigo
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
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_usuariosPermisos", function (e) {
    e.preventDefault();

    d_usuCodigo = $("#f_usuariosPermisos #Usu_CodigoPer").val();
    d_perCodigo = $("#f_usuariosPermisos #Per_Codigo").val();

    $.ajax({
      type: "POST",
      url: "op_usuariosPermisosCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_usuariosPermisos");
        $("#Btn_PermisosCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_usuariosPermisos");
        $("#Btn_PermisosCrearForm").show();
      },
      data: {
        usuario: d_usuCodigo,
        perCodigo: d_perCodigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          d_codigo = $("#f_usuariosPermisos #Usu_CodigoPer").val();

          $.ajax({
            type: "POST",
            url: "f_usuariosPermisos.php",
            beforeSend: function () {
              $(".info_UsuariosPermisos").html(loader());
            },
            data: {
              codigo: d_codigo
            },
            success: function (data) {
              $(".info_UsuariosPermisos").html(data);
              $('#Per_Codigo').multiselect({
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
        } else {
          d_codigo = $("#f_usuariosPermisos #Usu_CodigoPer").val();
          $.ajax({
            type: "POST",
            url: "f_usuariosPermisos.php",
            beforeSend: function () {
              $(".info_UsuariosPermisos").html(loader());
            },
            data: {
              codigo: d_codigo
            },
            success: function (data) {
              $(".info_UsuariosPermisos").html(data);
				$('#Per_Codigo').multiselect({
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
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_UsuariosRestaurarContrasena", function (e) {
    e.preventDefault();

    d_codigo = $("#f_usuariosEditar #codigoAct").val();
    d_usuario = $("#f_usuariosEditar #Usu_UsuarioAct").val();

    $.ajax({
      type: "POST",
      url: "op_restaurarContrasena.php",
      beforeSend: function () {
        bloquearFormulario("f_usuariosEditar");
        $("#Btn_UsuariosRestaurarContrasena").hide();
        $("#Btn_UsuariosActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_usuariosEditar");
        $("#Btn_UsuariosRestaurarContrasena").show();
        $("#Btn_UsuariosActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        usuario: d_usuario
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_ActualizarCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ActualizarCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Cambio de contraseña Correcto</h3>');
        } else {
          $("#vtn_ActualizarCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_ActualizarCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO  se realizo el cambio de contraseña</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_cambiarClave", function (e) {
    e.preventDefault();

    d_claveAct = $("#f_cambiarClave #clave_actual").val();
    d_clave2 = $("#f_cambiarClave #clave2").val();

    $.ajax({
      type: "POST",
      url: "op_cambiarClave.php",
      data: {
        claveAct: d_claveAct,
        clave2: d_clave2
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_CambiarClaveNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_CambiarClaveNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Clave Actualizada Correctamente</h3>');
        } else {
          $("#d_mensajeCambioClave").html("Error: " + rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_CambiarClaveNotificaciones", function (e) {
    e.preventDefault();
    window.location.href = "f_index.php";
  });

});
