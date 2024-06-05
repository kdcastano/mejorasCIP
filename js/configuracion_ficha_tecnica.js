$(document).ready(function (e) {
  $('#filtroConfigFT_Planta').multiselect({
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

  $('#filtroConfigFT_Area').multiselect({
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
  
  $('#filtroConfigFT_Maquina').multiselect({
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

  $("body").on("click", "#Btn_ConfigFTBuscar", function (e) {
    e.preventDefault();

    d_planta = $("#filtroConfigFT_Planta").val();
    d_area = $("#filtroConfigFT_Area").val();
    d_estado = $("#filtroConfigFT_Estado").val();
    d_maquina = $("#filtroConfigFT_Maquina").val();

    $.ajax({
      type: "POST",
      url: "f_configuracionFichaTecnicaListar.php",
      beforeSend: function () {
        $(".info_ConfigFTListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado,
        maquina: d_maquina
      },
      success: function (data) {
        $(".info_ConfigFTListar").html(data);
        $("#tbl_ConfigFTListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_ConfigFTCrear", function (e) {
    e.preventDefault();

    $("#vtn_ConfigFTCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_configuracionFichaTecnicaCrear.php",
      beforeSend: function () {
        $(".info_ConfigFTCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_ConfigFTCrear").html(data);
        $("#tbl_ConfigFTListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#f_ConfigFTCrear #Pla_Codigo", function (e) {
    e.preventDefault();
    d_planta = $("#f_ConfigFTCrear #Pla_Codigo").val();
    $(".e_cargarMaquinaCrear").html('<div class="form-group"><label class="control-label">Máquina:<span class="rojo">*</span></label><select id="Maq_Codigo" class="form-control" required><option></option></select></div>');

    $.ajax({
      type: "POST",
      url: "f_cargarAreas.php",
      beforeSend: function () {
        $(".e_cargarAreaCrear").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarAreaCrear").html(data);

        d_planta = $("#f_ConfigFTCrear #Pla_Codigo").val();
        $.ajax({
          type: "POST",
          url: "f_cargarAgrupacionConfigFTCrear.php",
          beforeSend: function () {
            $(".e_cargarAgrupacionConfigFTCrear").html(loader());
          },
          data: {
            planta: d_planta
          },
          success: function (data) {
            $(".e_cargarAgrupacionConfigFTCrear").html(data);
          },
          error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
          }
        });

        $.ajax({
          type: "POST",
          url: "f_cargarTurnos.php",
          beforeSend: function () {
            $(".e_cargarTurnosPlanta").html(loader());
          },
          data: {
            planta: d_planta
          },
          success: function (data) {
            $(".e_cargarTurnosPlanta").html(data);
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

  $("body").on("change", "#Are_Codigo", function (e) {
    e.preventDefault();

    d_area = $("#Are_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_cargarMaquinas.php",
      beforeSend: function () {
        $(".e_cargarMaquinaCrear").html(loader());
      },
      data: {
        area: d_area
      },
      success: function (data) {
        $(".e_cargarMaquinaCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", "#AgrC_Codigo", function (e) {
    e.preventDefault();

    d_agrupacion = $("#f_ConfigFTCrear #AgrC_Codigo").val();
    $.ajax({
      type: "POST",
      url: "f_cargarVariableCrear.php",
      beforeSend: function () {
        $(".e_cargarVariableCrear").html(loader());
      },
      data: {
        agrupacion: d_agrupacion
      },
      success: function (data) {
        $(".e_cargarVariableCrear").html(data);
        $("#id_tabla").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_ConfigFTCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_ConfigFTCrear #Pla_Codigo").val();
    d_area = $("#f_ConfigFTCrear #Are_Codigo").val();
    d_variable = $("#f_ConfigFTCrear #ConFT_Variable").val();
    d_ordenamiento = $("#f_ConfigFTCrear #ConFT_Ordenamiento").val();
    d_tomaVariable = $("#f_ConfigFTCrear #ConFT_TomaVariable").val();
    d_maquina = $("#f_ConfigFTCrear #Maq_Codigo").val();
    d_agrupacionConfigFT = $("#f_ConfigFTCrear #AgrC_Codigo").val(); 
    
    d_lista1 = [];
    d_lista2 = [];
    d_lista3 = [];
    
		cont = 0;
		$(".Inp_TurnosSel").each(function(){
			
			d_lista1[cont] = $(this).attr("data-tur");
      d_lista2[cont] = $(this).attr("data-hor");
      a = $(this).attr("data-num");
      
      if($("#Inp_ValCrear"+a).prop("checked") == true){
				d_lista3[cont] = 1;
			}else{
				d_lista3[cont] = 0;
			}
      
			cont++;
		});
		d_num = cont;

    $.ajax({
      type: "POST",
      url: "op_configuracionFichaTecnica.php",
      beforeSend: function () {
        bloquearFormulario("f_ConfigFTCrear");
        $("#Btn_ConfigFTCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_ConfigFTCrear");
        $("#Btn_ConfigFTCrearForm").show();
      },
      data: {
        planta: d_planta,
        area: d_area,
        variable: d_variable,
        ordenamiento: d_ordenamiento,
        TomaVariable: d_tomaVariable,
        maquina: d_maquina,
        agrupacionConfigFT: d_agrupacionConfigFT,
        lista1: d_lista1,
        lista2: d_lista2,
        lista3: d_lista3,
        num: d_num
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_ConfigFTNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_ConfigFTNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');

        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_ConfigFTNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_ConfigFTNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_ConfigFTNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_ConfigFTNotificacionesCrear").modal('hide');
    $("#vtn_ConfigFTCrear").modal('hide');

    d_planta = $("#filtroConfigFT_Planta").val();
    d_area = $("#filtroConfigFT_Area").val();
    d_estado = $("#filtroConfigFT_Estado").val();
    d_maquina = $("#filtroConfigFT_Maquina").val();

    $.ajax({
      type: "POST",
      url: "f_configuracionFichaTecnicaListar.php",
      beforeSend: function () {
        $(".info_ConfigFTListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado,
        maquina: d_maquina
      },
      success: function (data) {
        $(".info_ConfigFTListar").html(data);
        $("#tbl_ConfigFTListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_editarConfigFT", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_ConfigFTActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_configuracionFichaTecnicaActualizar.php",
      beforeSend: function () {
        $(".info_ConfigFTActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_ConfigFTActualizar").html(data);
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
    d_tipo = "2";
    $(".e_cargarMaquinaActualizar").html('<div class="form-group"><label class="control-label">Máquina:<span class="rojo">*</span></label><select id="Maq_CodigoAct" class="form-control" required><option></option></select></div>');

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

  $("body").on("change", "#AgrC_CodigoAct", function (e) {
    e.preventDefault();

    d_agrupacion = $("#f_ConfigFTActualizar #AgrC_CodigoAct").val();
    d_codigoAct = $("#f_ConfigFTActualizar #codigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarVariableActualizar.php",
      beforeSend: function () {
        $(".e_cargarVariableActualizar").html(loader());
      },
      data: {
        agrupacion: d_agrupacion,
        codigo: d_codigoAct
      },
      success: function (data) {
        $(".e_cargarVariableActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#f_ConfigFTActualizar #Are_CodigoAct", function (e) {
    e.preventDefault();

    d_area = $("#f_ConfigFTActualizar #Are_CodigoAct").val();
    d_codigo = $("#f_ConfigFTActualizar #codigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarMaquinaActualizar.php",
      beforeSend: function () {
        $(".e_cargarMaquinaActualizar").html(loader());
      },
      data: {
        area: d_area,
        codigo: d_codigo,
      },
      success: function (data) {
        $(".e_cargarMaquinaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_ConfigFTActualizar", function (e) {
    e.preventDefault();

    d_codigo = $("#f_ConfigFTActualizar #codigoAct").val();
    d_planta = $("#f_ConfigFTActualizar #Pla_CodigoAct").val();
    d_area = $("#f_ConfigFTActualizar #Are_CodigoAct").val();
    d_variable = $("#f_ConfigFTActualizar #ConFT_VariableAct").val();
    d_ordenamiento = $("#f_ConfigFTActualizar #ConFT_OrdenamientoAct").val();
    d_estado = $("#f_ConfigFTActualizar #ConFT_EstadoAct").val();
    d_tomaVariable = $("#f_ConfigFTActualizar #ConFT_TomaVariableAct").val();
    d_maquina = $("#f_ConfigFTActualizar #Maq_CodigoAct").val();
    //agrupacion
    d_agrupacionConfigFT = $("#f_ConfigFTActualizar #AgrC_CodigoAct").val();
    
    d_lista1 = [];
    d_lista2 = [];
    d_lista3 = [];
    d_lista4 = [];
    d_lista5 = [];
    
		cont = 0;
		$(".Inp_TurnosSel").each(function(){
			
			d_lista1[cont] = $(this).attr("data-tur");
      d_lista2[cont] = $(this).attr("data-hor");
      d_lista3[cont] = $(this).attr("data-acc");
      d_lista4[cont] = $(this).attr("data-codfre");
      a = $(this).attr("data-num");
      
      if($("#Inp_ValAct"+a).prop("checked") == true){
				d_lista5[cont] = 1;
			}else{
				d_lista5[cont] = 0;
			}
      
			cont++;
		});
		d_num = cont;

    $.ajax({
      type: "POST",
      url: "op_configuracionFichaTecnicaActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_ConfigFTActualizar");
        $("#Btn_ConfigFTActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_ConfigFTActualizar");
        $("#Btn_ConfigFTActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        area: d_area,
        variable: d_variable,
        ordenamiento: d_ordenamiento,
        estado: d_estado,
        tomaVariable: d_tomaVariable,
        maquina: d_maquina,
        agrupacionConfigFT: d_agrupacionConfigFT,
        lista1: d_lista1,
        lista2: d_lista2,
        lista3: d_lista3,
        lista4: d_lista4,
        lista5: d_lista5,
        num: d_num
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_ConfigFTNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_ConfigFTNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_ConfigFTNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_ConfigFTNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });


  });

  $("body").on("click", "#Btn_ConfigFTNotificacionesActualizar", function (e) {
    e.preventDefault();

    $("#vtn_ConfigFTNotificacionesActualizar").modal('hide');
    $("#vtn_ConfigFTActualizar").modal('hide');

    d_planta = $("#filtroConfigFT_Planta").val();
    d_area = $("#filtroConfigFT_Area").val();
    d_estado = $("#filtroConfigFT_Estado").val();
    d_maquina = $("#filtroConfigFT_Maquina").val();

    $.ajax({
      type: "POST",
      url: "f_configuracionFichaTecnicaListar.php",
      beforeSend: function () {
        $(".info_ConfigFTListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado,
        maquina: d_maquina
      },
      success: function (data) {
        $(".info_ConfigFTListar").html(data);
        $("#tbl_ConfigFTListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_eliminarConfigFT", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $.ajax({
      type: "POST",
      url: "op_configuracionFichaTecnicaEliminar.php",
      beforeSend: function () {
        $(".e_eliminarConfigFT").hide();
      },
      complete: function () {
        $(".e_eliminarConfigFT").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_ConfigFTNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_ConfigFTNotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          $("#vtn_ConfigFTNotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_ConfigFTNotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');


          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_ConfigFTNotificacionesEliminar", function (e) {
    e.preventDefault();

    $("#vtn_ConfigFTNotificacionesEliminar").modal('hide');

    d_planta = $("#filtroConfigFT_Planta").val();
    d_area = $("#filtroConfigFT_Area").val();
    d_estado = $("#filtroConfigFT_Estado").val();
    d_maquina = $("#filtroConfigFT_Maquina").val();

    $.ajax({
      type: "POST",
      url: "f_configuracionFichaTecnicaListar.php",
      beforeSend: function () {
        $(".info_ConfigFTListar").html(loader());
      },
      data: {
        planta: d_planta,
        area: d_area,
        estado: d_estado,
        maquina: d_maquina
      },
      success: function (data) {
        $(".info_ConfigFTListar").html(data);
        $("#tbl_ConfigFTListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", ".Int_SeleccionTodos", function (e) {
    e.preventDefault();

    if ($(this).prop("checked") == true) {
      $(".Inp_TurnosSel").prop("checked", true);
    } else {
      $(".Inp_TurnosSel").prop("checked", false);
    }
  });

  $("body").on("change", ".Int_SeleccionTodosConfFtAct", function (e) {
    e.preventDefault();

    if ($(this).prop("checked") == true) {
      $(".Inp_TurnosSel").prop("checked", true);
    } else {
      $(".Inp_TurnosSel").prop("checked", false);
    }
  });
});
