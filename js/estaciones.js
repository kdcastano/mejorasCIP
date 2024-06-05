$(document).ready(function (e) {

  $('#filtroEstaciones_Planta').multiselect({
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

  $("body").on("click", "#Btn_EstacionesBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroEstaciones_Planta").val();
    d_estado = $("#filtroEstaciones_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_estacionesListar.php",
      beforeSend: function () {
        $(".info_EstacionesListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_EstacionesListar").html(data);
        $("#tbl_Estaciones").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_EstacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_EstacionesCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_estacionesCrear.php",
      beforeSend: function () {
        $(".info_EstacionesCrear").html(loader());
      },
      success: function (data) {
        $(".info_EstacionesCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_estacionesCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_estacionesCrear #Est_Pla_Codigo").val();
    d_nombre = $("#f_estacionesCrear #Est_Nombre").val();

    $.ajax({
      type: "POST",
      url: "op_estacionesCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_estacionesCrear");
        $("#Btn_EstacionesCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_estacionesCrear");
        $("#Btn_EstacionesCrearForm").show();
      },
      data: {
        planta: d_planta,
        nombre: d_nombre
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_EstacionesNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_EstacionesNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        } else {
          $("#vtn_EstacionesNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_EstacionesNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_EstacionesNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_EstacionesNotificacionesCrear").modal('hide');
    $("#vtn_EstacionesCrear").modal('hide');

    d_planta = $("#filtroEstaciones_Planta").val();
    d_estado = $("#filtroEstaciones_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_estacionesListar.php",
      beforeSend: function () {
        $(".info_EstacionesListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_EstacionesListar").html(data);
        $("#tbl_Estaciones").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });


  $("body").on("click", ".e_cargarEstacionesActualizar", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_EstacionesActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_estacionesActualizar.php",
      beforeSend: function () {
        $(".info_EstacionesActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_EstacionesActualizar").html(data);
        $("#tbl_Estaciones").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_estacionesActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_estacionesActualizar #Est_CodigoAct").val();
    d_nombre = $("#f_estacionesActualizar #Est_NombreAct").val();

    $.ajax({
      type: "POST",
      url: "op_estacionesActualizar.php",
      beforeSend: function () {
        $("#Btn_EstacionesActualizarForm").hide();
      },
      complete: function () {
        $("#Btn_EstacionesActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        nombre: d_nombre
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_EstacionesNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_EstacionesNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_EstacionesNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_EstacionesNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_EstacionesNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#Btn_EstacionesBuscar").click();
    $("#vtn_EstacionesNotificacionesActualizar").modal('hide');

    d_codigo = $("#f_estacionesActualizar #Est_CodigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_estacionesActualizar.php",
      beforeSend: function () {
        $(".info_EstacionesActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_EstacionesActualizar").html(data);
        $("#tbl_Estaciones").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  //Estaciones Maquinas
  $("body").on("click", "#Btn_EstacionesMaquinasCrear", function (e) {
    e.preventDefault();

    $("#vtn_EstacionesMaquinasCrear").modal({
      backdrop: 'static'
    });

    d_codigo = $(this).attr("data-cod");

    $.ajax({
      type: "POST",
      url: "f_estacionesMaquinasCrear.php",
      beforeSend: function () {
        $(".info_EstacionesMaquinasCrear").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_EstacionesMaquinasCrear").html(data);
        $('#EstM_Maq_Codigo').multiselect({
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

  $("body").on("change", "#f_estacionesMaquinasCrear #EstM_Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#f_estacionesMaquinasCrear #EstM_Pla_Codigo").val();
    $(".e_cargarEstacionesMaquinas_Maquinas").html('<div class="form-group"><label class="control-label">Máquina:<span class="rojo">*</span></label><select id="EstM_Maq_Codigo" class="form-control" required><option></option></select></div>');

    $.ajax({
      type: "POST",
      url: "f_estacionesMaquinasAreasCargarCrear.php",
      beforeSend: function () {
        $(".e_cargarEstacionesMaquinas_Areas").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarEstacionesMaquinas_Areas").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#f_estacionesMaquinasCrear #EstM_Are_Codigo", function (e) {
    e.preventDefault();

    d_area = $("#f_estacionesMaquinasCrear #EstM_Are_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_estacionesMaquinasMaquinasCargarCrear.php",
      beforeSend: function () {
        $(".e_cargarEstacionesMaquinas_Maquinas").html(loader());
      },
      data: {
        area: d_area
      },
      success: function (data) {
        $(".e_cargarEstacionesMaquinas_Maquinas").html(data);
        $('#EstM_Maq_Codigo').multiselect({
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

  $("body").on("submit", "#f_estacionesMaquinasCrear", function (e) {
    e.preventDefault();

    d_estacion = $("#f_estacionesMaquinasCrear #EstM_Est_Codigo").val();
    d_maquina = $("#f_estacionesMaquinasCrear #EstM_Maq_Codigo").val();

    $.ajax({
      type: "POST",
      url: "op_estacionesMaquinasCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_estacionesMaquinasCrear");
        $("#Btn_EstacionesMaquinasCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_estacionesMaquinasCrear");
        $("#Btn_EstacionesMaquinasCrearForm").show();
      },
      data: {
        estacion: d_estacion,
        maquina: d_maquina
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_EstacionesMaquinasNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_EstacionesMaquinasNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Máquina Asignada Correctamente</h3>');
        } else {
          $("#vtn_EstacionesMaquinasNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_EstacionesNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>Máquina NO Asignada</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_EstacionesMaquinasNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_EstacionesMaquinasNotificacionesCrear").modal('hide');
    $("#vtn_EstacionesMaquinasCrear").modal('hide');

    d_estacion = $("#f_estacionesMaquinasCrear #EstM_Est_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_estacionesActualizar.php",
      beforeSend: function () {
        $(".info_EstacionesActualizar").html(loader());
      },
      data: {
        codigo: d_estacion
      },
      success: function (data) {
        $(".info_EstacionesActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("click", ".e_estacionesMaquinasEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_EstacionesMaquinasEliminarNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_EstacionesMaquinasEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_EstacionesMaquinasEliminarNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_EstacionesMaquinasEliminar").val();
    d_estacion = $("#f_estacionesActualizar #Est_CodigoAct").val();
    
    $("#vtn_EstacionesMaquinasEliminarNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_estacionesMaquinasEliminar.php",
      beforeSend: function () {
        $(".e_estacionesMaquinasEliminar").hide();
      },
      complete: function () {
        $(".e_estacionesMaquinasEliminar").show();
      },
      data: {
        codigoEst: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $.ajax({
            type: "POST",
            url: "f_estacionesActualizar.php",
            beforeSend: function () {
              $(".info_EstacionesActualizar").html(loader());
            },
            data: {
              codigo: d_estacion
            },
            success: function (data) {
              $(".info_EstacionesActualizar").html(data);
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        } else {
          $.ajax({
            type: "POST",
            url: "f_estacionesActualizar.php",
            beforeSend: function () {
              $(".info_EstacionesActualizar").html(loader());
            },
            data: {
              codigo: d_estacion
            },
            success: function (data) {
              $(".info_EstacionesActualizar").html(data);
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

  // Puestos Trabajos
  $("body").on("click", ".e_cargarPuestosTrabajo", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_PuestosTrabajoCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_puestosTrabajosCrear.php",
      beforeSend: function () {
        $(".info_PuestosTrabajoCrear").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_PuestosTrabajoCrear").html(data);
        $('#PueTEM_EstM_Codigo').multiselect({
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

  $("body").on("submit", "#f_puestosTrabajosCrear", function (e) {
    e.preventDefault();

    d_estacion = $("#f_puestosTrabajosCrear #PueT_Est_Codigo").val();
    d_estacionesAreas = $("#f_puestosTrabajosCrear #PueT_EstA_Codigo").val();
    d_nombre = $("#f_puestosTrabajosCrear #PueT_Nombre").val();

    $.ajax({
      type: "POST",
      url: "op_puestosTrabajosCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_puestosTrabajosCrear");
        $("#Btn_PuestosTrabajosCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_puestosTrabajosCrear");
        $("#Btn_PuestosTrabajosCrearForm").show();
      },
      data: {
        estacion: d_estacion,
        estacionesAreas: d_estacionesAreas,
        nombre: d_nombre
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_PuestosTrabajosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_PuestosTrabajosNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Puesto de Trabajo Creado Correctamente</h3>');
        } else {
          $("#vtn_PuestosTrabajosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_PuestosTrabajosNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>Puesto de Trabajo NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_PuestosTrabajosNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_PuestosTrabajosNotificacionesCrear").modal('hide');

    d_estacion = $("#f_puestosTrabajosCrear #PueT_Est_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_puestosTrabajosCrear.php",
      beforeSend: function () {
        $(".info_PuestosTrabajoCrear").html(loader());
      },
      data: {
        codigo: d_estacion
      },
      success: function (data) {
        $(".info_PuestosTrabajoCrear").html(data);
        $('#PueTEM_EstM_Codigo').multiselect({
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

  $("body").on("submit", "#f_puestosTrabajosMaquinasCrear", function (e) {
    e.preventDefault();

    d_estacion = $("#f_puestosTrabajosCrear #PueT_Est_Codigo").val();
    d_puestoTrabajo = $("#f_puestosTrabajosMaquinasCrear #PueTEM_PueT_Codigo").val();
    d_maquina = $("#f_puestosTrabajosMaquinasCrear #PueTEM_EstM_Codigo").val();

    $.ajax({
      type: "POST",
      url: "op_puestosTrabajosMaquinasCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_puestosTrabajosMaquinasCrear");
        $("#Btn_PuestosTrabajosMaquinasCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_puestosTrabajosMaquinasCrear");
        $("#Btn_PuestosTrabajosMaquinasCrearForm").show();
      },
      data: {
        puestoTrabajo: d_puestoTrabajo,
        maquina: d_maquina
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_PuestosTrabajosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_PuestosTrabajosNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Máquina Asignada Correctamente</h3>');
        } else {
          $("#vtn_PuestosTrabajosNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_PuestosTrabajosNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>Máquina NO Asignada</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("click", ".e_puestrosTrabajosMaquinasAsignadasEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_EstacionesPuestosTrabajoMaquinaNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_PuestosTrabjoMaquinaEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_EstacionesPuestosTrabajoMaquinaNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_PuestosTrabjoMaquinaEliminar").val();
    $("#vtn_EstacionesPuestosTrabajoMaquinaNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_puestosTrabajosMaquinasAsignadasEliminar.php",
      beforeSend: function () {
        $(".e_puestrosTrabajosMaquinasAsignadasEliminar").hide();
      },
      complete: function () {
        $(".e_puestrosTrabajosMaquinasAsignadasEliminar").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          d_estacion = $("#f_puestosTrabajosCrear #PueT_Est_Codigo").val();

          $.ajax({
            type: "POST",
            url: "f_puestosTrabajosCrear.php",
            beforeSend: function () {
              $(".info_PuestosTrabajoCrear").html(loader());
            },
            data: {
              codigo: d_estacion
            },
            success: function (data) {
              $(".info_PuestosTrabajoCrear").html(data);
              $('#PueTEM_EstM_Codigo').multiselect({
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
          $(".e_puestrosTrabajosMaquinasAsignadasEliminar").show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_puestoTrabajosEditar", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");
    d_estacion = $("#PueT_Est_Codigo").val();

    $("#vtn_PuestosTrabajoActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_puestosTrabajosEditar.php",
      beforeSend: function () {
        $(".info_PuestosTrabajoActualizar").html(loader());
      },
      data: {
        codigo: d_codigo,
		estacion: d_estacion
      },
      success: function (data) {
        $(".info_PuestosTrabajoActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_puestosTrabajosActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_puestosTrabajosActualizar #PueT_CodigoAct").val();
    d_nombre = $("#f_puestosTrabajosActualizar #PueT_NombreAct").val();

    $.ajax({
      type: "POST",
      url: "op_puestosTrabajosActualizar.php",
      beforeSend: function () {
        $("#Btn_PuestosTrabajoActualizarForm").hide();
      },
      complete: function () {
        $("#Btn_PuestosTrabajoActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        nombre: d_nombre
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_PuestosTrabajoNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_PuestosTrabajoNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          $("#vtn_PuestosTrabajoNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_PuestosTrabajoNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_PuestosTrabajoNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_PuestosTrabajoNotificacionesActualizar").modal('hide');
    $("#vtn_PuestosTrabajoActualizar").modal('hide');

     d_estacion = $("#f_puestosTrabajosActualizar #PueT_Est_CodigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_puestosTrabajosCrear.php",
      beforeSend: function () {
        $(".info_PuestosTrabajoCrear").html(loader());
      },
      data: {
        codigo: d_estacion
      },
      success: function (data) {
        $(".info_PuestosTrabajoCrear").html(data);
        $('#PueTEM_EstM_Codigo').multiselect({
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
  
  $("body").on("click", ".e_puestoTrabajosEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_EstacionesPuestosTrabajoNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_PuestoTrabajoEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_EstacionesPuestosTrabajoNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_PuestoTrabajoEliminar").val();
    $("#vtn_EstacionesPuestosTrabajoNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_puestosTrabajosEliminar.php",
      beforeSend: function () {
        $(".e_puestoTrabajosEliminar").hide();
      },
      complete: function () {
        $(".e_puestoTrabajosEliminar").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          d_estacion = $("#f_puestosTrabajosCrear #PueT_Est_Codigo").val();

          $.ajax({
            type: "POST",
            url: "f_puestosTrabajosCrear.php",
            beforeSend: function () {
              $(".info_PuestosTrabajoCrear").html(loader());
            },
            data: {
              codigo: d_estacion
            },
            success: function (data) {
              $(".info_PuestosTrabajoCrear").html(data);
              $('#PueTEM_EstM_Codigo').multiselect({
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
          $(".e_puestoTrabajosEliminar").show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  // Estaciones Áreas
  $("body").on("click", ".Bnt_AgregarEstacionesAreasCrear", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_EstacionesAreasCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_estacionesAreasCrear.php",
      beforeSend: function () {
        $(".info_EstacionesAreasCrear").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_EstacionesAreasCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#f_estacionesAreasCrear #EstA_Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#f_estacionesAreasCrear #EstA_Pla_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_estacionesAreasCargarCrear.php",
      beforeSend: function () {
        $(".Cont_EstacionesAreasCargarArea").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".Cont_EstacionesAreasCargarArea").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_estacionesAreasCrear", function (e) {
    e.preventDefault();

    d_estacion = $("#f_estacionesAreasCrear #EstA_Est_Codigo").val();
    d_area = $("#f_estacionesAreasCrear #EstA_Are_Codigo").val();

    $.ajax({
      type: "POST",
      url: "op_estacionesAreasCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_estacionesAreasCrear");
        $("#Btn_EstacionesAreasCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_estacionesAreasCrear");
        $("#Btn_EstacionesAreasCrearForm").show();
      },
      data: {
        estacion: d_estacion,
        area: d_area
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_EstacionesAreasCrear").modal('hide');
          $.ajax({
            type: "POST",
            url: "f_estacionesActualizar.php",
            beforeSend: function () {
              $(".info_EstacionesActualizar").html(loader());
            },
            data: {
              codigo: d_estacion
            },
            success: function (data) {
              $(".info_EstacionesActualizar").html(data);
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        } else {
          $("#vtn_EstacionesAreasCrear").modal('hide');
          $.ajax({
            type: "POST",
            url: "f_estacionesActualizar.php",
            beforeSend: function () {
              $(".info_EstacionesActualizar").html(loader());
            },
            data: {
              codigo: d_estacion
            },
            success: function (data) {
              $(".info_EstacionesActualizar").html(data);
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
          desbloquearFormulario("f_estacionesAreasCrear");
          $("#Btn_EstacionesAreasCrearForm").show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_eliminarEstaciones", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");

    $("#vtn_estacionesNotificacionesEliminarConfirmar").modal({
      backdrop: 'static'
    });

    $(".Cod_Est_Codigo").val(d_codigo);
  });

  $("body").on("click", "#Btn_estacionesNotificacionesEliminarConfirmarForm", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_Est_Codigo").val();
    
    $("#vtn_estacionesNotificacionesEliminarConfirmar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_estacioesEliminar.php",
      beforeSend: function () {
        $(".e_eliminarEstaciones").hide();
      },
      complete: function () {
        $(".e_eliminarEstaciones").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_estacionesNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_estacionesEliminarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_estacionesNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_estacionesEliminarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_estacionesNotificacionesEliminar", function (e) {
    e.preventDefault();
    $("#vtn_estacionesNotificacionesEliminar").modal('hide');

    d_planta = $("#filtroEstaciones_Planta").val();
    d_estado = $("#filtroEstaciones_Estado").val();

    $.ajax({
      type: "POST",
      url: "f_estacionesListar.php",
      beforeSend: function () {
        $(".info_EstacionesListar").html(loader());
      },
      data: {
        planta: d_planta,
        estado: d_estado
      },
      success: function (data) {
        $(".info_EstacionesListar").html(data);
        $("#tbl_Estaciones").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_estacionesAreasEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_EstacionesEquiposEliminarNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_EstacionesEquiposEliminar").val(d_codigo);

  });

  $("body").on("click", "#Btn_EstacionesEquiposEliminarNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_EstacionesEquiposEliminar").val();
    d_estacion = $("#f_estacionesActualizar #Est_CodigoAct").val();
    
    $("#vtn_EstacionesEquiposEliminarNotificacionesEliminar").modal('hide');
    
    $.ajax({
      type: "POST",
      url: "op_estacionesAreasEliminar.php",
      beforeSend: function () {
        $("#e_estacionesAreasEliminar").hide();
      },
      complete: function () {
        $("#e_estacionesAreasEliminar").show();
      },
      data: {
        codigo1: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $.ajax({
            type: "POST",
            url: "f_estacionesActualizar.php",
            beforeSend: function () {
              $(".info_EstacionesActualizar").html(loader());
            },
            data: {
              codigo: d_estacion
            },
            success: function (data) {
              $(".info_EstacionesActualizar").html(data);
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        } else {
          $.ajax({
            type: "POST",
            url: "f_estacionesActualizar.php",
            beforeSend: function () {
              $(".info_EstacionesActualizar").html(loader());
            },
            data: {
              codigo: d_estacion
            },
            success: function (data) {
              $(".info_EstacionesActualizar").html(data);
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

  $("body").on("change", "#filtroPanelSupervisor_Fecha", function(e){
    e.preventDefault();
    
    d_area = $("#Inp_PanelSupervisorAreaFiltro").val();
    d_fecha = $("#filtroPanelSupervisor_Fecha").val();
    d_agrupacion = $(this).attr("data-agr");
    
    $.ajax({
      type:"POST",
      url:"f_panelSupervisorFiltroRefenciasFecha.php",
      beforeSend: function() {
        $(".e_cargarPSFiltroReferenciasFecha").html(loader());
      },
      data:{ area: d_area, fecha: d_fecha, agrupacion: d_agrupacion },
      success: function(data) {
        $(".e_cargarPSFiltroReferenciasFecha").html(data);
        $('#filtroPanelSupervisor_Referencia').multiselect({
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
        $("#filtroPanelSupervisor_Turno").val(-1);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", ".Btn_PSLimpiarFiltroReferencias", function(e){
    e.preventDefault();
    
    d_area = $(this).attr("data-are");
    
    $.ajax({
      type:"POST",
      url:"f_panelSupervisorFiltroRefencias.php",
      beforeSend: function() {
        $(".e_cargarPSFiltroReferenciasFecha").html(loader());
      },
      data:{ area: d_area },
      success: function(data) {
        $(".e_cargarPSFiltroReferenciasFecha").html(data);
        $('#filtroPanelSupervisor_Referencia').multiselect({
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
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", ".Btn_PSVerFechaReferencia", function(e){
    e.preventDefault();
  
    d_area = $(this).attr("data-are");
    d_referencia = $("#filtroPanelSupervisor_Referencia").val();
    
    $("#vtn_VerFechasReferencias").modal({backdrop: 'static'});
    
    $.ajax({
      type:"POST",
      url:"f_panelSuperviisorFechasReferencia.php",
      beforeSend: function() {
        $(".info_VerFechasReferencias").html(loader());
      },
      data:{ area: d_area, referencia: d_referencia },
      success: function(data) {
        $(".info_VerFechasReferencias").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });

  $("body").on("click", ".e_cargarPSFechaSelDiaRef", function(e){
    e.preventDefault();
    
    d_fecha = $(this).attr("data-fec");
    
    $(".PSMFecCerr").click();
    
    $("#filtroPanelSupervisor_Fecha").val(d_fecha);
    $("#filtroPanelSupervisor_Turno").val(-1);
    
    $(".Btn_CargarPanelSupervisorDatos").click();
  
  });
  
  $("body").on("click", ".e_ActualizarTSPAC", function(e){
    e.preventDefault();
    
    $(".Btn_CargarPanelSupervisorDatos").click();
    
  });
  
});