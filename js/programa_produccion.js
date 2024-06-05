$(document).ready(function (e) {

  $('#filtroAnalisisProgramaProduccion_Planta').multiselect({
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
  
  $('#filtroProgramaProduccionReal_Formatos').multiselect({
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
  
  $('#filtroAnalisisProgramaProduccion_Formatos').multiselect({
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

  $("body").on("click", "#Btn_AnalisisProgramaProduccionBuscar", function (e) {
    e.preventDefault();

    d_semana = $("#filtroAnalisisProgramaProduccion_Semana").val();
    d_planta = $("#filtroAnalisisProgramaProduccion_Planta").val();
    d_formato = $("#filtroAnalisisProgramaProduccion_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_analisisProgramaProduccionListar.php",
      beforeSend: function () {
        $(".info_AnalisisProgramaProduccionListar").html(loader());
      },
      data: {
        semana: d_semana,
        planta: d_planta,
        formato: d_formato
      },
      success: function (data) {
        $(".info_AnalisisProgramaProduccionListar").html(data);
        $("#tbl_SAPProgramaProduccion").tablesorter();
        $('#filtrarAnalisiPPListar').keyup(function () {
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

  $("body").on("change", ".Int_SeleccionTodosAPP", function (e) {
    e.preventDefault();

    if ($(this).prop("checked") == true) {
      $(".inp_CamposSeleccionAPP").prop("checked", true);
    } else {
      $(".inp_CamposSeleccionAPP").prop("checked", false);
    }

  });

  $("body").on("click", "#Btn_AnalisisPasarAProgramaProduccion", function (e) {
    e.preventDefault();

    d_lista1 = [];
    d_lista2 = [];
    d_lista3 = [];
    d_lista4 = [];
    d_lista5 = [];
    d_lista6 = [];
    d_lista7 = [];
    d_lista8 = [];
    d_lista9 = [];
    d_lista10 = [];
    d_lista11 = [];
    d_lista12 = [];
    d_lista13 = [];
    d_lista14 = [];

    cont = 0;

    $(".inp_CamposSeleccionAPP:checked").each(function () {
      a = $(this).attr("data-cod");
      d_lista1[cont] = $(".ProP_CantEP" + a).val();
      d_lista2[cont] = $(".ProP_CantEXPO" + a).val();
      d_lista3[cont] = $(".ProP_Pla_Codigo" + a).val();
      d_lista4[cont] = $(".ProP_For_Codigo" + a).val();
      d_lista5[cont] = $(".ProP_CentroCostos" + a).val();
      d_lista6[cont] = $(".ProP_Fecha" + a).val();
      d_lista7[cont] = $(".ProP_Familia" + a).val();
      d_lista8[cont] = $(".ProP_Color" + a).val();
      d_lista9[cont] = $(".ProP_Cantidad" + a).val();
      d_lista10[cont] = $(".ProP_Are_Codigo" + a).val();
      d_lista11[cont] = $(".ProP_FechaOriginal" + a).val();
      d_lista12[cont] = $(".ProP_Descripcion" + a).val();
      d_lista13[cont] = $(".ProP_Semana" + a).val();
      d_lista14[cont] = $(".ProP_CodigoMaterial" + a).val();
      cont++;
    });

    d_num = cont;

    $.ajax({
      type: "POST",
      url: "op_analisisProgramaProduccionCrear.php",
      beforeSend: function () {
        $("#Btn_AnalisisPasarAProgramaProduccion").hide();
      },
      complete: function () {
        $("#Btn_AnalisisPasarAProgramaProduccion").show();
      },
      data: {
        lista1: d_lista1,
        lista2: d_lista2,
        lista3: d_lista3,
        lista4: d_lista4,
        lista5: d_lista5,
        lista6: d_lista6,
        lista7: d_lista7,
        lista8: d_lista8,
        lista9: d_lista9,
        lista10: d_lista10,
        lista11: d_lista11,
        lista12: d_lista12,
        lista13: d_lista13,
        lista14: d_lista14,
        num: d_num
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_AnalisisProgramaProduccionCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_AnalisisProgramaProduccionCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Programado Correctamente</h3>');
        } else {
          $("#vtn_AnalisisProgramaProduccionCargarNotificaciones").modal({
            backdrop: 'static'
          });
          $(".info_AnalisisProgramaProduccionCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Programado</h3>');
          $("#Btn_AnalisisPasarAProgramaProduccion").show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_AnalisisProgramaProduccionCargarNotificaciones", function (e) {
    e.preventDefault();

    $("#vtn_AnalisisProgramaProduccionCargarNotificaciones").modal("hide");
    $("#Btn_AnalisisProgramaProduccionBuscar").click();

  });

  // Programa Producción Real
  $('#filtroProgramaProduccionReal_Area').multiselect({
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

  $('#filtroProgramaProduccionReal_Planta').multiselect({
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

  $("body").on("click", "#Btn_ProgramaProduccionRealCalendario", function (e) {
    e.preventDefault();

    $("#vtn_Calendario").modal({
      backdrop: 'static'
    });
    $.ajax({
      type:"POST",
      url:"f_calendarioProgramaP.php",
      beforeSend: function() {
      $(".info_Calendario").html(loader());
      },
      data:{  },
      success: function(data) {
      $(".info_Calendario").html(data);
      },
      error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
      }
    });	  
  });
  
  $("body").on("click", "#Btn_ProgramaProduccionRealSupervisorCalendario", function (e) {
    e.preventDefault();

    $("#vtn_CalendarioSupervisor").modal({
      backdrop: 'static'
    });
    $.ajax({
      type:"POST",
      url:"f_calendarioProgramaP.php",
      beforeSend: function() {
      $(".info_CalendarioSupervisor").html(loader());
      },
      data:{  },
      success: function(data) {
      $(".info_CalendarioSupervisor").html(data);
      },
      error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
      }
    });	  
  });
  
  d_semana = $("#filtroProgramaProduccionReal_Semana").val();
  d_area = $("#filtroProgramaProduccionReal_Area").val();
  d_planta = $("#filtroProgramaProduccionReal_Planta").val();
  d_estado = $("#filtroProgramaProduccionReal_Estado").val();
  d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

  $.ajax({
    type: "POST",
    url: "f_programaProduccionReal.php",
    beforeSend: function () {
      $(".info_ProgramaProduccionRealListar").html(loader());
    },
    data: {
      semana: d_semana,
      area: d_area,
      planta: d_planta,
      estado: d_estado,
      formato: d_formato
    },
    success: function (data) {
      $(".info_ProgramaProduccionRealListar").html(data);
    },
    error: function (er1, er2, er3) {
      console.log(er2 + "-" + er3);
    }
  });
  
  $("body").on("change", "#filtroProgramaProduccionReal_Semana", function(e){
    e.preventDefault();
    
    d_semana = $("#filtroProgramaProduccionReal_Semana").val();
    d_area = $("#filtroProgramaProduccionReal_Area").val();
    d_planta = $("#filtroProgramaProduccionReal_Planta").val();
    d_estado = $("#filtroProgramaProduccionReal_Estado").val();
    d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionReal.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        planta: d_planta,
        estado: d_estado,
        formato: d_formato
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });    
  });
  
  $("body").on("change", "#filtroProgramaProduccionReal_Area", function(e){
    e.preventDefault();
    
    d_semana = $("#filtroProgramaProduccionReal_Semana").val();
    d_area = $("#filtroProgramaProduccionReal_Area").val();
    d_planta = $("#filtroProgramaProduccionReal_Planta").val();
    d_estado = $("#filtroProgramaProduccionReal_Estado").val();
    d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionReal.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        planta: d_planta,
        estado: d_estado,
        formato: d_formato
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });    
  });
  
  $("body").on("change", "#filtroProgramaProduccionReal_Planta", function(e){
    e.preventDefault();
    
    d_semana = $("#filtroProgramaProduccionReal_Semana").val();
    d_area = $("#filtroProgramaProduccionReal_Area").val();
    d_planta = $("#filtroProgramaProduccionReal_Planta").val();
    d_estado = $("#filtroProgramaProduccionReal_Estado").val();
    d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionReal.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        planta: d_planta,
        estado: d_estado,
        formato: d_formato
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });    
  });
  
 $("body").on("change", "#filtroProgramaProduccionReal_Estado", function(e){
    e.preventDefault();
    
    d_semana = $("#filtroProgramaProduccionReal_Semana").val();
    d_area = $("#filtroProgramaProduccionReal_Area").val();
    d_planta = $("#filtroProgramaProduccionReal_Planta").val();
    d_estado = $("#filtroProgramaProduccionReal_Estado").val();
    d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionReal.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        planta: d_planta,
        estado: d_estado,
        formato: d_formato
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });    
  });  
  
 $("body").on("change", "#filtroProgramaProduccionReal_Formatos", function(e){
    e.preventDefault();
    
    d_semana = $("#filtroProgramaProduccionReal_Semana").val();
    d_area = $("#filtroProgramaProduccionReal_Area").val();
    d_planta = $("#filtroProgramaProduccionReal_Planta").val();
    d_estado = $("#filtroProgramaProduccionReal_Estado").val();
    d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionReal.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        planta: d_planta,
        estado: d_estado,
        formato: d_formato
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });    
  });
  
//  $("body").on("change", ".estadoActualColor", function(e){
//    e.preventDefault();
//    
//    d_codigo = $("#codigoPPActualizarColor").val();
//    d_estado = $(".EProP_EstadoActual"+ d_codigo).val();
//    
//    if(d_estado == "Listo para fabricar"){
//       $(".estadoActualColor").css("background-color", "#3070EC");
//    }
//    
//  
//  });

  $("body").on("click", ".e_guardarInfoProgramaProduccion", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    d_fecha = $(".ProP_Fecha" + d_codigo).val();
    d_horaInicio = $(".ProP_HoraInicio" + d_codigo).val();
    d_horno = $(".ProP_Are_Codigo" + d_codigo).val();
    d_cantidadOrdenada = $(".ProP_Cantidad" + d_codigo).val();
    d_cantidadEP = $(".ProP_CantEP" + d_codigo).val();
    d_cantidadEXPO = $(".ProP_CantEXPO" + d_codigo).val();
    d_estado = $(".EProP_EstadoActual" + d_codigo).val();
    d_estadoComp = $(".EProP_EstadoActualComp" + d_codigo).val();

    d_metrosEP = $(".ProP_MetrosEP" + d_codigo).val();
    d_metrosEXPO = $(".ProP_MetrosEXPO" + d_codigo).val();

    $.ajax({
      type: "POST",
      url: "op_programaProduccionRealActualizar.php",
      beforeSend: function () {
        $(".e_guardarInfoProgramaProduccion").hide();
      },
      complete: function () {
        $(".e_guardarInfoProgramaProduccion").show();
      },
      data: {
        codigo: d_codigo,
        fecha: d_fecha,
        horaInicio: d_horaInicio,
        horno: d_horno,
        cantidadOrdenada: d_cantidadOrdenada,
        cantidadEP: d_cantidadEP,
        cantidadEXPO: d_cantidadEXPO,
        estado: d_estado,
        estadoComp: d_estadoComp,
        metrosEP: d_metrosEP,
        metrosEXPO: d_metrosEXPO
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          d_semana = $("#filtroProgramaProduccionReal_Semana").val();
          d_area = $("#filtroProgramaProduccionReal_Area").val();
          d_planta = $("#filtroProgramaProduccionReal_Planta").val();
          d_estado = $("#filtroProgramaProduccionReal_Estado").val();
          d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

          $.ajax({
            type: "POST",
            url: "f_programaProduccionReal.php",
            beforeSend: function () {
              $(".info_ProgramaProduccionRealListar").html(loader());
            },
            data: {
              semana: d_semana,
              area: d_area,
              planta: d_planta,
              estado: d_estado,
              formato: d_formato
            },
            success: function (data) {
              $(".info_ProgramaProduccionRealListar").html(data);
              $(".FilActCol" + d_codigo).css("background-color", "#55B340");
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        } else {
          d_semana = $("#filtroProgramaProduccionReal_Semana").val();
          d_area = $("#filtroProgramaProduccionReal_Area").val();
          d_planta = $("#filtroProgramaProduccionReal_Planta").val();
          d_estado = $("#filtroProgramaProduccionReal_Estado").val();
          d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

          $.ajax({
            type: "POST",
            url: "f_programaProduccionReal.php",
            beforeSend: function () {
              $(".info_ProgramaProduccionRealListar").html(loader());
            },
            data: {
              semana: d_semana,
              area: d_area,
              planta: d_planta,
              estado: d_estado,
              formato: d_formato
            },
            success: function (data) {
              $(".info_ProgramaProduccionRealListar").html(data);
              $(".FilActCol" + d_codigo).css("background-color", "red");
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

  $("body").on("click", ".e_subirProgramaProduccion", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");
    a = $(this).attr("data-num");
    b = parseInt(a) - 1;

    d_codigoArriba = $(".ProP_CodigoOrdenamiento" + b).val();

    $.ajax({
      type: "POST",
      url: "op_subirProgramaProduccion.php",
      beforeSend: function () {
        $(".e_subirProgramaProduccion").hide();
      },
      complete: function () {
        $(".e_subirProgramaProduccion").show();
      },
      data: {
        codigo: d_codigo,
        codigoArriba: d_codigoArriba
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#Btn_ProgramaProduccionRealBuscar").click();
        } else {
          $(".e_subirProgramaProduccion").show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_bajarProgramaProduccion", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");
    a = $(this).attr("data-num");
    b = parseInt(a) + 1;

    d_codigoArriba = $(".ProP_CodigoOrdenamiento" + b).val();

    $.ajax({
      type: "POST",
      url: "op_bajarProgramaProduccion.php",
      beforeSend: function () {
        $(".e_bajarProgramaProduccion").hide();
      },
      complete: function () {
        $(".e_bajarProgramaProduccion").show();
      },
      data: {
        codigo: d_codigo,
        codigoArriba: d_codigoArriba
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#Btn_ProgramaProduccionRealBuscar").click();
        } else {
          $(".e_bajarProgramaProduccion").show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", ".e_cambiarManualOrdenamientoPP", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    d_numero = $(".ProP_Prioridad" + d_codigo).val();

    $.ajax({
      type: "POST",
      url: "op_manualProgramaProduccion.php",
      beforeSend: function () {},
      complete: function () {},
      data: {
        codigo: d_codigo,
        numero: d_numero
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#Btn_ProgramaProduccionRealBuscar").click();
        } else {
          $("#Btn_ProgramaProduccionRealBuscar").click();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
  d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();
  d_fecha = $("#filtroProgramaProduccionRealSupervisor_Fecha").val();

  $.ajax({
    type: "POST",
    url: "f_programaProduccionRealSupervisor.php",
    beforeSend: function () {
      $(".info_ProgramaProduccionRealSupervisorListar").html(loader());
    },
    data: {
      semana: d_semana,
      area: d_area,
      fecha: d_fecha
    },
    success: function (data) {
      $(".info_ProgramaProduccionRealSupervisorListar").html(data);
    },
    error: function (er1, er2, er3) {
      console.log(er2 + "-" + er3);
    }
  });


  $("body").on("change", "#filtroProgramaProduccionRealSupervisor_Semana", function (e) {
    e.preventDefault();

    d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
    d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();
    d_fecha = $("#filtroProgramaProduccionRealSupervisor_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionRealSupervisor.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealSupervisorListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        fecha: d_fecha
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealSupervisorListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#filtroProgramaProduccionRealSupervisor_Area", function (e) {
    e.preventDefault();

    d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
    d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();
    d_fecha = $("#filtroProgramaProduccionRealSupervisor_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionRealSupervisor.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealSupervisorListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        fecha: d_fecha
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealSupervisorListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("change", "#filtroProgramaProduccionRealSupervisor_Fecha", function (e) {
    e.preventDefault();

    d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
    d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();
    d_fecha = $("#filtroProgramaProduccionRealSupervisor_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionRealSupervisor.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealSupervisorListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        fecha: d_fecha
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealSupervisorListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("change", ".e_guardarInfoProgramaProduccionSupervisor", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    d_horaConfirmada = $(".ProP_HoraConfirmada"+d_codigo).val();
    d_fechaConfirmada = $(".ProP_FechaConfirmada"+d_codigo).val();
    d_estado = $(".EProP_EstadoActualSupervisor"+d_codigo).val();
    d_estadoComp = $(".EProP_EstadoCompActualSupervisor"+d_codigo).val();

    $.ajax({
      type: "POST",
      url: "op_programaProduccionRealSupervisorActualizar.php",
      beforeSend: function () {
        $(".e_guardarInfoProgramaProduccionSupervisor").hide();
      },
      complete: function () {
        $(".e_guardarInfoProgramaProduccionSupervisor").show();
      },
      data: {
        codigo: d_codigo,
        estado: d_estado,
        estadoComp: d_estadoComp,
        horaConfirmada: d_horaConfirmada,
        fechaConfirmada: d_fechaConfirmada
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
          d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();
          d_fecha = $("#filtroProgramaProduccionRealSupervisor_Fecha").val();

          $.ajax({
            type: "POST",
            url: "f_programaProduccionRealSupervisor.php",
            beforeSend: function () {
              $(".info_ProgramaProduccionRealSupervisorListar").html(loader());
            },
            data: {
              semana: d_semana,
              area: d_area,
              fecha: d_fecha
            },
            success: function (data) {
              $(".info_ProgramaProduccionRealSupervisorListar").html(data);
              $(".FilActCol" + d_codigo).css("background-color", "#55B340");
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        } else {
          d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
          d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();
          d_fecha = $("#filtroProgramaProduccionRealSupervisor_Fecha").val();

          $.ajax({
            type: "POST",
            url: "f_programaProduccionRealSupervisor.php",
            beforeSend: function () {
              $(".info_ProgramaProduccionRealSupervisorListar").html(loader());
            },
            data: {
              semana: d_semana,
              area: d_area,
              fecha: d_fecha
            },
            success: function (data) {
              $(".info_ProgramaProduccionRealSupervisorListar").html(data);
              $(".FilActCol" + d_codigo).css("background-color", "red");
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
  
//  $("body").on("click", "#Btn_ProgramaProduccionRealCrear", function(e){
//    e.preventDefault();
//    
//     $("#vtn_ProgramaProduccionRealCrear").modal({
//      backdrop: 'static'
//    });
//    
//    $.ajax({
//      type:"POST",
//      url:"f_programaProduccionRealCrear.php",
//      beforeSend: function() {
//        $(".info_ProgramaProduccionRealCrear").html(loader());
//      },
//      data:{  },
//      success: function(data) {
//        $(".info_ProgramaProduccionRealCrear").html(data);
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  
//  });
  
  $("body").on("change", "#f_ProgramaProducciónRealCrear #Pla_Codigo", function(e){
    e.preventDefault();
    
    d_planta = $("#f_ProgramaProducciónRealCrear #Pla_Codigo").val();
    $(".e_cargarFamiliaPlanta").html('<div class="form-group"><label class="control-label">Familia:<span class="rojo">*</span></label><select id="FicT_Familia" class="form-control" required><option></option></select></div>');
    $(".e_cargarColorCrear").html('<div class="form-group"><label class="control-label">Color:<span class="rojo">*</span></label><select id="FicT_Color" class="form-control" required><option></option></select></div>');
    
    $.ajax({
      type: "POST",
      url: "f_cargarAreasPP.php",
      beforeSend: function () {
        $(".e_cargarAreaCrear").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarAreaCrear").html(data);
        $.ajax({
          type: "POST",
          url: "f_cargarFormatos.php",
          beforeSend: function () {
            $(".e_cargarFormatoPlanta").html(loader());
          },
          data: {
            planta: d_planta
          },
          success: function (data) {
            $(".e_cargarFormatoPlanta").html(data);
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

  $("body").on("change", "#f_ProgramaProducciónRealCrear #For_Codigo", function(e){
    e.preventDefault();
    
    d_formato = $("#f_ProgramaProducciónRealCrear #For_Codigo").val();
    d_planta = $("#f_ProgramaProducciónRealCrear #Pla_Codigo").val();
    $(".e_cargarColorCrear").html('<div class="form-group"><label class="control-label">Color:<span class="rojo">*</span></label><select id="FicT_Color" class="form-control" required><option></option></select></div>');
    
     $.ajax({
      type:"POST",
      url:"f_cargarFamiliaPlantaPP.php",
      beforeSend: function() {
        $(".e_cargarFamiliaPlanta").html(loader());
      },
      data:{ formato: d_formato, planta: d_planta },
      success: function(data) {
        $(".e_cargarFamiliaPlanta").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("change", "#f_ProgramaProducciónRealCrear #ProP_Familia", function(e){
    e.preventDefault();
    
    d_familia = $("#f_ProgramaProducciónRealCrear #ProP_Familia").val();
    d_planta = $("#f_ProgramaProducciónRealCrear #Pla_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_cargarColorPP.php",
      beforeSend: function () {
        $(".e_cargarColorCrear").html(loader());
      },
      data: {
        familia: d_familia,
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarColorCrear").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  
  });
//  
//  $("body").on("submit", "#f_ProgramaProducciónRealCrear", function(e){
//    e.preventDefault();
//    
//    d_orden = $("#f_ProgramaProducciónRealCrear #ProP_Prioridad").val();
//    d_fecha = $("#f_ProgramaProducciónRealCrear #ProP_Fecha").val();
//    d_horaInicio = $("#f_ProgramaProducciónRealCrear #ProP_HoraInicio").val();
//    d_planta = $("#f_ProgramaProducciónRealCrear #Pla_Codigo").val();
//    d_formatos = $("#f_ProgramaProducciónRealCrear #For_Codigo").val();
//    d_familia = $("#f_ProgramaProducciónRealCrear #ProP_Familia").val();
//    d_color = $("#f_ProgramaProducciónRealCrear #ProP_Color").val();
//    d_prensa = $("#f_ProgramaProducciónRealCrear #Are_Codigo").val();
//    d_cantOrdenada = $("#f_ProgramaProducciónRealCrear #ProP_Cantidad").val();
//    d_cantEuropalet = $("#f_ProgramaProducciónRealCrear #ProP_CantEP").val();
//    d_cantEuropaletM = $("#f_ProgramaProducciónRealCrear #ProP_MetrosEP").val();
//    d_cantExportacion = $("#f_ProgramaProducciónRealCrear #ProP_CantEXPO").val();
//    d_cantExportacionM = $("#f_ProgramaProducciónRealCrear #ProP_MetrosEXPO").val();
//  
//  
//  
//    $.ajax({
//      type:"POST",
//      url:"op_programaProduccionRealCrear.php",
//      beforeSend: function() {
//        bloquearFormulario("f_ProgramaProducciónRealCrear");
//        $("#Btn_ProgramaProduccionRealCrearForm").hide();
//      },
//      complete: function() {
//        desbloquearFormulario("f_ProgramaProducciónRealCrear");
//        $("#Btn_ProgramaProduccionRealCrearForm").show();
//      },
//      data: {  
//        orden: d_orden,
//        fecha: d_fecha,
//        horaInicio: d_horaInicio,
//        planta: d_planta,
//        formatos: d_formatos,
//        familia: d_familia,
//        color: d_color,
//        prensa: d_prensa,
//        cantOrdenada: d_cantOrdenada,
//        canteuroPalet: d_cantEuropalet,
//        cantEuropaletM: d_cantEuropaletM,
//        cantExportacion: d_cantExportacion,
//        cantExportacionM: d_cantExportacionM  },
//      dataType: 'json',
//      success: function(rs) {
//        if(rs.mensaje == "OK"){
//          $("#vtn_ProgramaProduccionRealNotificacionesCrear").modal({backdrop: 'static'});
//          $(".info_ProgramaProduccionRealNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
//        }else{
//          mensaje('2', rs.mensaje);
//          $("#vtn_ProgramaProduccionRealNotificacionesCrear").modal({backdrop: 'static'});
//          $(".info_ProgramaProduccionRealNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
//        }
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  });
  
  $("body").on("click", "#Btn_ProgramaProduccionRealNotificacionesCrear", function(e){
    e.preventDefault();
    
      $("#vtn_ProgramaProduccionRealNotificacionesCrear").modal('hide');
      $("#vtn_ProgramaProduccionRealCrear").modal('hide');
    
      d_semana = $("#filtroProgramaProduccionReal_Semana").val();
      d_area = $("#filtroProgramaProduccionReal_Area").val();
      d_planta = $("#filtroProgramaProduccionReal_Planta").val();
      d_estado = $("#filtroProgramaProduccionReal_Estado").val();
      d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

      $.ajax({
        type: "POST",
        url: "f_programaProduccionReal.php",
        beforeSend: function () {
          $(".info_ProgramaProduccionRealListar").html(loader());
        },
        data: {
          semana: d_semana,
          area: d_area,
          planta: d_planta,
          estado: d_estado,
          formato: d_formato
        },
        success: function (data) {
          $(".info_ProgramaProduccionRealListar").html(data);
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
  
  });
  
  $("body").on("click", ".e_cargarCrearReferEmergencia", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    d_planta = $(this).attr("data-pla");
    d_formatos = $(this).attr("data-for");
    d_prensa = $(this).attr("data-are");
    d_exportacion = $(this).attr("data-exp");
    d_europalet = $(this).attr("data-eur");
    
     $("#vtn_ReferenciasEmergenciaCrear").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_PPReferenciasEmergenciaCrear.php",
      beforeSend: function() {
        $(".info_ReferenciasEmergenciaCrear").html(loader());
      },
      data:{ codigo: d_codigo, planta: d_planta, formato: d_formatos, area: d_prensa, exportacion: d_exportacion, europalet: d_europalet},
      success: function(data) {
        $(".info_ReferenciasEmergenciaCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });  
  
  $("body").on("click", ".e_cargarCrearReferEmergenciaSupervisor", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    d_planta = $(this).attr("data-pla");
    d_formatos = $(this).attr("data-for");
    d_prensa = $(this).attr("data-are");
    d_exportacion = $(this).attr("data-exp");
    d_europalet = $(this).attr("data-eur");
    
     $("#vtn_ReferenciasEmergenciaCrear").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_PPReferenciasEmergenciaCrear.php",
      beforeSend: function() {
        $(".info_ReferenciasEmergenciaCrear").html(loader());
      },
      data:{ codigo: d_codigo, planta: d_planta, formato: d_formatos, area: d_prensa, exportacion: d_exportacion, europalet: d_europalet},
      success: function(data) {
        $(".info_ReferenciasEmergenciaCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("keyup", "#f_PPReferenciasEmergenciasCrear #ProP_CantEP", function (e) {
    e.preventDefault();
    
    d_cantEuropalet = $("#f_PPReferenciasEmergenciasCrear #ProP_CantEP").val();
    d_promEuropalet = $("#f_PPReferenciasEmergenciasCrear #promedioEP").val();
    
    totalMetrosEP = parseFloat(d_cantEuropalet) * parseFloat(d_promEuropalet);
    
    if(d_cantEuropalet > 0){
      $("#ProP_MetrosEP").val(number_format(totalMetrosEP, 1, ".", ""));   
    }else{
      $("#ProP_MetrosEP").val("");   
    } 

  });  
  
  $("body").on("keyup", "#f_PPReferenciasEmergenciasCrear #ProP_CantEXPO", function (e) {
    e.preventDefault();
    
    d_cantEuropalet = $("#f_PPReferenciasEmergenciasCrear #ProP_CantEXPO").val();
    d_promEuropalet = $("#f_PPReferenciasEmergenciasCrear #promedioEXPO").val();
    
    totalMetrosEP = parseFloat(d_cantEuropalet) * parseFloat(d_promEuropalet);
    
    if(d_cantEuropalet > 0){
      $("#ProP_MetrosEXPO").val(number_format(totalMetrosEP, 1, ".", ""));   
    }else{
      $("#ProP_MetrosEXPO").val("");   
    } 

  });
  
  $("body").on("submit", "#f_PPReferenciasEmergenciasCrear", function(e){
    e.preventDefault();
    
    d_orden = $("#f_PPReferenciasEmergenciasCrear #ProP_Prioridad").val();
    d_fecha = $("#f_PPReferenciasEmergenciasCrear #ProP_Fecha").val();
    d_horaInicio = $("#f_PPReferenciasEmergenciasCrear #ProP_HoraInicio").val();
    d_planta = $("#f_PPReferenciasEmergenciasCrear #Pla_Codigo").val();
    d_formatos = $("#f_PPReferenciasEmergenciasCrear #For_Codigo").val();
    d_familia = $("#f_PPReferenciasEmergenciasCrear #RefE_Familia").val();
    d_color = $("#f_PPReferenciasEmergenciasCrear #RefE_Color").val();
    d_prensa = $("#f_PPReferenciasEmergenciasCrear #Are_Codigo").val();
    d_cantOrdenada = $("#f_PPReferenciasEmergenciasCrear #ProP_Cantidad").val();
    d_cantEuropalet = $("#f_PPReferenciasEmergenciasCrear #ProP_CantEP").val();
    d_cantEuropaletM = $("#f_PPReferenciasEmergenciasCrear #ProP_MetrosEP").val();
    d_cantExportacion = $("#f_PPReferenciasEmergenciasCrear #ProP_CantEXPO").val();
    d_cantExportacionM = $("#f_PPReferenciasEmergenciasCrear #ProP_MetrosEXPO").val();
    d_tipo = $("#f_PPReferenciasEmergenciasCrear #ProP_Tipo").val();
    d_descripcion = $("#f_PPReferenciasEmergenciasCrear #RefE_Descripcion").val();
    
    $.ajax({
      type:"POST",
      url:"op_programaProduccionRealCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_PPReferenciasEmergenciasCrear");
        $("#Btn_ReferenciasEmergenciaCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_PPReferenciasEmergenciasCrear");
        $("#Btn_ReferenciasEmergenciaCrearForm").show();
      },
      data: { 
       orden: d_orden,
      fecha: d_fecha,
      horaInicio: d_horaInicio,
      planta: d_planta,
      formatos: d_formatos,
      familia: d_familia,
      color: d_color,
      prensa: d_prensa,
      cantOrdenada: d_cantOrdenada,
      canteuroPalet: d_cantEuropalet,
      cantEuropaletM: d_cantEuropaletM,
      cantExportacion: d_cantExportacion,
      cantExportacionM: d_cantExportacionM,
      tipo: d_tipo,
      descripcion: d_descripcion
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_ReferenciasEmergenciaNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_ReferenciasEmergenciaNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>'); $("#vtn_ReferenciasEmergenciaSupervisorNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_ReferenciasEmergenciaSupervisorNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_ReferenciasEmergenciaNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_ReferenciasEmergenciaNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          $("#vtn_ReferenciasEmergenciaSupervisorNotificacionesCrear").modal({backdrop: 'static'});
          $(".info_ReferenciasEmergenciaSupervisorNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>No Creado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_ReferenciasEmergenciaNotificacionesCrear", function(e){
    e.preventDefault();
  
    $("#vtn_ReferenciasEmergenciaCrear").modal('hide');
    $("#vtn_ReferenciasEmergenciaNotificacionesCrear").modal('hide');
    
    d_semana = $("#filtroProgramaProduccionReal_Semana").val();
    d_area = $("#filtroProgramaProduccionReal_Area").val();
    d_planta = $("#filtroProgramaProduccionReal_Planta").val();
    d_estado = $("#filtroProgramaProduccionReal_Estado").val();
    d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionReal.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        planta: d_planta,
        estado: d_estado,
        formato: d_formato
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_ReferenciasEmergenciaSupervisorNotificacionesCrear", function(e){
    e.preventDefault();
  
    $("#vtn_ReferenciasEmergenciaCrear").modal('hide');
    $("#vtn_ReferenciasEmergenciaSupervisorNotificacionesCrear").modal('hide');
    
    d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
    d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionRealSupervisor.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealSupervisorListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealSupervisorListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  //Calculo de Metros Europalet
  $("body").on("change", ".calcularMetrosEuroPalet", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    d_cantidad = $(".ProP_CantEP"+d_codigo).val();
    d_metros = $(".CalculoEuroPalet"+d_codigo).val();
    
    totalMetrosEP = parseFloat(d_cantidad) * parseFloat(d_metros);
    
    if(d_cantidad > 0){
      $(".ProP_MetrosEP"+d_codigo).val(number_format(totalMetrosEP, 1, ".", ""));
    }else{
      $(".ProP_MetrosEP"+d_codigo).val("");
    }
  
  });
  
  //Calculo de Metros Exportación
  $("body").on("change", ".calcularMetrosExporTacion", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    d_cantidad = $(".ProP_CantEXPO"+d_codigo).val();
    d_metros = $(".CalculoExporTacion"+d_codigo).val();
    
    totalMetrosEXPO = parseFloat(d_cantidad) * parseFloat(d_metros);
    
    if(d_cantidad > 0){
      $(".ProP_MetrosEXPO"+d_codigo).val(number_format(totalMetrosEXPO, 1, ".", ""));   
    }else{
      $(".ProP_MetrosEXPO"+d_codigo).val("");   
    }  
  });
  
  $("body").on("click", ".e_cargarEliminarPP", function(e){
    e.preventDefault();
    
    $("#vtn_PPGuardarConfirmacionNotificaciones").modal({
      backdrop: 'static'
    });
    
    d_codigo = $(this).attr("data-cod"); 
    d_familia = $(this).attr("data-fam"); 
    d_formato = $(this).attr("data_for"); 
    d_color = $(this).attr("data-col"); 
    d_semana = $(this).attr("data-sem");
    
    $(".codigoEliminar").val(d_codigo);
    $(".familiaEliminar").val(d_familia);
    $(".formatoEliminar").val(d_formato);
    $(".colorEliminar").val(d_color);
    $(".semanaEliminar").val(d_semana);
   
  });
  
  $("body").on("click", "#Btn_PPGuardarConfirmacionNotificaciones", function(e){ 
    e.preventDefault(); 
    
    $("#vtn_PPGuardarConfirmacionNotificaciones").modal('hide');
    
    d_codigo =  $(".codigoEliminar").val(); 
    d_familia = $(".familiaEliminar").val();
    d_formato = $(".formatoEliminar").val(); 
    d_color = $(".colorEliminar").val();
    d_semana = $(".semanaEliminar").val();
     
    $.ajax({
      type:"POST",
      url:"op_eliminarProgramaProduccion.php",
      beforeSend: function() {
        $("#e_cargarEliminarPP").hide();
      },
      complete: function() {
        $("#e_cargarEliminarPP").show();
      },
      data: { 
        codigo: d_codigo,
        familia: d_familia,
        formato: d_formato,
        color: d_color,
        semana: d_semana
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_ProgramaProduccionRealNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_ProgramaProduccionRealNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          $("#vtn_ProgramaProduccionRealNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_ProgramaProduccionRealNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });      
  });
  
    
  $("body").on("click", ".e_cargarEliminarREPP", function(e){ 
    e.preventDefault(); 
     
    d_codigo = $(this).attr("data-cod");  
     
    $.ajax({
      type:"POST",
      url:"op_eliminarProgramaProduccionRE.php",
      beforeSend: function() {
        $("#e_cargarEliminarREPP").hide();
      },
      complete: function() {
        $("#e_cargarEliminarREPP").show();
      },
      data: { 
        codigo: d_codigo
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_ProgramaProduccionRealNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_ProgramaProduccionRealNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          $("#vtn_ProgramaProduccionRealNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_ProgramaProduccionRealNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });      
  });
  

  $("body").on("click", "#Btn_ProgramaProduccionRealNotificacionesEliminar", function(e){
    e.preventDefault();
    $("#vtn_ProgramaProduccionRealNotificacionesEliminar").modal('hide');
    
    d_semana = $("#filtroProgramaProduccionReal_Semana").val();
    d_area = $("#filtroProgramaProduccionReal_Area").val();
    d_planta = $("#filtroProgramaProduccionReal_Planta").val();
    d_estado = $("#filtroProgramaProduccionReal_Estado").val();
    d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionReal.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        planta: d_planta,
        estado: d_estado,
        formato: d_formato
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
 $("body").on("click", ".e_cargarEliminarPPSup", function(e){
    e.preventDefault();
    
    $("#vtn_PPGuardarConfirmacionNotificacionesSup").modal({
      backdrop: 'static'
    });
    
    d_codigo = $(this).attr("data-cod"); 
    d_familia = $(this).attr("data-fam"); 
    d_formato = $(this).attr("data_for"); 
    d_color = $(this).attr("data-col"); 
    d_semana = $(this).attr("data-sem");
    
    $(".codigoEliminar").val(d_codigo);
    $(".familiaEliminar").val(d_familia);
    $(".formatoEliminar").val(d_formato);
    $(".colorEliminar").val(d_color);
    $(".semanaEliminar").val(d_semana);
   
  });
  
  $("body").on("click", "#Btn_PPGuardarConfirmacionNotificacionesSup", function(e){ 
    e.preventDefault(); 
    
    $("#vtn_PPGuardarConfirmacionNotificacionesSup").modal('hide');
    
    d_codigo =  $(".codigoEliminar").val(); 
    d_familia = $(".familiaEliminar").val();
    d_formato = $(".formatoEliminar").val(); 
    d_color = $(".colorEliminar").val();
    d_semana = $(".semanaEliminar").val();
     
    $.ajax({
      type:"POST",
      url:"op_eliminarProgramaProduccion.php",
      beforeSend: function() {
        $("#e_cargarEliminarPPSup").hide();
      },
      complete: function() {
        $("#e_cargarEliminarPPSup").show();
      },
      data: { 
        codigo: d_codigo,
        familia: d_familia,
        formato: d_formato,
        color: d_color,
        semana: d_semana
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_ProgramaProduccionRealSupervisorNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_ProgramaProduccionRealSupervisorNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          $("#vtn_ProgramaProduccionRealSupervisorNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_ProgramaProduccionRealSupervisorNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });      
  });
  
    
  $("body").on("click", ".e_cargarEliminarREPPSup", function(e){ 
    e.preventDefault(); 
     
    d_codigo = $(this).attr("data-cod");  
     
    $.ajax({
      type:"POST",
      url:"op_eliminarProgramaProduccionRE.php",
      beforeSend: function() {
        $("#e_cargarEliminarREPPSup").hide();
      },
      complete: function() {
        $("#e_cargarEliminarREPPSup").show();
      },
      data: { 
        codigo: d_codigo
      },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_ProgramaProduccionRealSupervisorNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_ProgramaProduccionRealSupervisorNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          $("#vtn_ProgramaProduccionRealSupervisorNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_ProgramaProduccionRealSupervisorNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });      
  });
  

  $("body").on("click", "#Btn_ProgramaProduccionRealSupervisorNotificacionesEliminar", function(e){
    e.preventDefault();
    $("#vtn_ProgramaProduccionRealSupervisorNotificacionesEliminar").modal('hide');
    
    d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
    d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();
    d_fecha = $("#filtroProgramaProduccionRealSupervisor_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionRealSupervisor.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealSupervisorListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        fecha: d_fecha
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealSupervisorListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".pdf_exportarFichaTecnica", function(e){
    e.preventDefault();
    
    d_familia = $(this).attr("data-fam");
    d_color = $(this).attr("data-col");
    d_formato = $(this).attr("data-for");
    
     $("#vtn_FichaTecnicaPDFCrear").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_programaProduccionPdfFT2.php",
      beforeSend: function() {
        $(".info_FichaTecnicaPDFCrear").html(loader());
      },
      data:{ familia: d_familia, color:d_color, formato: d_formato },
      success: function(data) {
        $(".info_FichaTecnicaPDFCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_PPRealObservacionCrear", function(e){
    e.preventDefault();
    
     $("#vtn_PPRealObservacionCrear").modal({
      backdrop: 'static'
    });
    
    d_semana = $("#filtroProgramaProduccionReal_Semana").val();
    d_area = $("#filtroProgramaProduccionReal_Area").val();
    
    $.ajax({
      type:"POST",
      url:"f_PPRealObservacion.php",
      beforeSend: function() {
        $(".info_PPRealObservacionCrear").html(loader());
      },
      data:{ semana: d_semana, area: d_area },
      success: function(data) {
        $(".info_PPRealObservacionCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("submit", "#f_PPRealObservacion", function(e){
    e.preventDefault();
    
    d_area = $("#f_PPRealObservacion #Are_Codigo").val();
    d_semana = $("#f_PPRealObservacion #ProPO_Semana").val();
    d_observacion = $("#f_PPRealObservacion #ProPO_Observacion").val();
    
    $.ajax({
      type:"POST",
      url:"op_PPRealObservacionCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_PPRealObservacion");
        $("#Btn_PPRealObservacionCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_PPRealObservacion");
        $("#Btn_PPRealObservacionCrearForm").show();
      },
      data: { area: d_area, semana: d_semana, observacion: d_observacion },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_PPRealObservacionNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_PPRealObservacionNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_PPRealObservacionNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_PPRealObservacionNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_PPRealObservacionNotificacionesActualizar", function(e){
    e.preventDefault();
    
      $("#vtn_PPRealObservacionNotificacionesActualizar").modal('hide');
      $("#vtn_PPRealObservacionCrear").modal('hide');
    
      d_semana = $("#filtroProgramaProduccionReal_Semana").val();
      d_area = $("#filtroProgramaProduccionReal_Area").val();
      d_planta = $("#filtroProgramaProduccionReal_Planta").val();
      d_estado = $("#filtroProgramaProduccionReal_Estado").val();
      d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

      $.ajax({
        type: "POST",
        url: "f_programaProduccionReal.php",
        beforeSend: function () {
          $(".info_ProgramaProduccionRealListar").html(loader());
        },
        data: {
          semana: d_semana,
          area: d_area,
          planta: d_planta,
          estado: d_estado,
          formato: d_formato
        },
        success: function (data) {
          $(".info_ProgramaProduccionRealListar").html(data);
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
  
  });
  
  $("body").on("click", ".e_cargarPPRealObservacion", function(e){
    e.preventDefault();
    
    $("#vtn_PPRealObservacionActualizar").modal({
      backdrop: 'static'
    });
    
    d_codigo = $(this).attr("data-cod");
    
    $.ajax({
      type:"POST",
      url:"f_PPRealObservacionActualizar.php",
      beforeSend: function() {
        $(".info_PPRealObservacionActualizar").html(loader());
      },
      data:{ codigo: d_codigo },
      success: function(data) {
        $(".info_PPRealObservacionActualizar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("submit", "#f_PPRealObservacionActualizarForm", function(e){
    e.preventDefault();
    
    d_observacion = $("#f_PPRealObservacionActualizarForm #ProPO_ObservacionActualizar").val();
    d_codigo = $("#f_PPRealObservacionActualizarForm #ProPO_CodigoActualizar").val();
    
    $.ajax({
      type:"POST",
      url:"op_PPRealObservacionActualizar.php",
      beforeSend: function() {
        bloquearFormulario("f_PPRealObservacionActualizarForm");
        $("#Btn_PPRealObservacionActualizarForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_PPRealObservacionActualizarForm");
        $("#Btn_PPRealObservacionActualizarForm").show();
      },
      data: { observacion: d_observacion, codigo: d_codigo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_PPRealObservacionNotificacionesActualizarNotificacion").modal({backdrop: 'static'});
          $(".info_PPRealObservacionNotificacionesActualizarNotificacion").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_PPRealObservacionNotificacionesActualizarNotificacion").modal({backdrop: 'static'});
          $(".info_PPRealObservacionNotificacionesActualizarNotificacion").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_PPRealObservacionNotificacionesActualizarNotificacion", function(e){
    e.preventDefault();
    
      $("#vtn_PPRealObservacionNotificacionesActualizarNotificacion").modal('hide');
      $("#vtn_PPRealObservacionActualizar").modal('hide');
    
      d_semana = $("#filtroProgramaProduccionReal_Semana").val();
      d_area = $("#filtroProgramaProduccionReal_Area").val();
      d_planta = $("#filtroProgramaProduccionReal_Planta").val();
      d_estado = $("#filtroProgramaProduccionReal_Estado").val();
      d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

      $.ajax({
        type: "POST",
        url: "f_programaProduccionReal.php",
        beforeSend: function () {
          $(".info_ProgramaProduccionRealListar").html(loader());
        },
        data: {
          semana: d_semana,
          area: d_area,
          planta: d_planta,
          estado: d_estado,
          formato: d_formato
        },
        success: function (data) {
          $(".info_ProgramaProduccionRealListar").html(data);
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
  
    }); 
  
    $("body").on("click", "#Btn_PPRealObservacionSupervisorNotificacionesActualizarNotificacion", function(e){
    e.preventDefault();
    
      $("#vtn_PPRealObservacionNotificacionesActualizarNotificacion").modal('hide');
      $("#vtn_PPRealObservacionSupervisorActualizar").modal('hide');
      
      d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
      d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();
      d_fecha = $("#filtroProgramaProduccionRealSupervisor_Fecha").val();

      $.ajax({
        type: "POST",
        url: "f_programaProduccionRealSupervisor.php",
        beforeSend: function () {
          $(".info_ProgramaProduccionRealSupervisorListar").html(loader());
        },
        data: {
          semana: d_semana,
          area: d_area,
          fecha: d_fecha
        },
        success: function (data) {
          $(".info_ProgramaProduccionRealSupervisorListar").html(data);
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
    });
  
    $("body").on("click", "#Btn_PPRealObservacionSupervisorNotificacionesActualizar", function(e){
    e.preventDefault();
    
      $("#vtn_PPRealObservacionSupervisorNotificacionesActualizar").modal('hide');
      $("#vtn_PPRealObservacionSupervisorCrear").modal('hide');
      
      d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
      d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();
      d_fecha = $("#filtroProgramaProduccionRealSupervisor_Fecha").val();

      $.ajax({
        type: "POST",
        url: "f_programaProduccionRealSupervisor.php",
        beforeSend: function () {
          $(".info_ProgramaProduccionRealSupervisorListar").html(loader());
        },
        data: {
          semana: d_semana,
          area: d_area,
          fecha: d_fecha
        },
        success: function (data) {
          $(".info_ProgramaProduccionRealSupervisorListar").html(data);
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
    }); 
  
    $("body").on("click", "#Btn_PPRealObservacionSupervisorNotificacionesEliminarNotificacion", function(e){
    e.preventDefault();
    
      $("#vtn_PPRealObservacionSupervisorNotificacionesEliminarNotificacion").modal('hide');
      
      d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
      d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();
      d_fecha = $("#filtroProgramaProduccionRealSupervisor_Fecha").val();

      $.ajax({
        type: "POST",
        url: "f_programaProduccionRealSupervisor.php",
        beforeSend: function () {
          $(".info_ProgramaProduccionRealSupervisorListar").html(loader());
        },
        data: {
          semana: d_semana,
          area: d_area,
          fecha: d_fecha
        },
        success: function (data) {
          $(".info_ProgramaProduccionRealSupervisorListar").html(data);
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
    });  
  
    $("body").on("click", "#Btn_PPRealObservacionNotificacionesEliminarNotificacion", function(e){
    e.preventDefault();
    
      $("#vtn_PPRealObservacionNotificacionesEliminarNotificacion").modal('hide');
    
      d_semana = $("#filtroProgramaProduccionReal_Semana").val();
      d_area = $("#filtroProgramaProduccionReal_Area").val();
      d_planta = $("#filtroProgramaProduccionReal_Planta").val();
      d_estado = $("#filtroProgramaProduccionReal_Estado").val();
      d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

      $.ajax({
        type: "POST",
        url: "f_programaProduccionReal.php",
        beforeSend: function () {
          $(".info_ProgramaProduccionRealListar").html(loader());
        },
        data: {
          semana: d_semana,
          area: d_area,
          planta: d_planta,
          estado: d_estado,
          formato: d_formato
        },
        success: function (data) {
          $(".info_ProgramaProduccionRealListar").html(data);
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
  
  });
  
  $("body").on("click", ".e_eliminarPPRealObservacion", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $.ajax({
      type:"POST",
      url:"op_PPRealObservacionEliminar.php",
      beforeSend: function() {
        $(".e_eliminarPPRealObservacion").hide();
      },
      complete: function() {
        $(".e_eliminarPPRealObservacion").show();
      },
      data: { codigo: d_codigo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_PPRealObservacionNotificacionesEliminarNotificacion").modal({backdrop: 'static'});
          $(".info_PPRealObservacionNotificacionesEliminarNotificacion").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_PPRealObservacionNotificacionesEliminarNotificacion").modal({backdrop: 'static'});
          $(".info_PPRealObservacionNotificacionesEliminarNotificacion").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
   $("body").on("click", "#Btn_PPRealObservacionSupervisorCrear", function(e){
    e.preventDefault();
    
     $("#vtn_PPRealObservacionSupervisorCrear").modal({
      backdrop: 'static'
    });
    
    d_semana = $("#filtroProgramaProduccionRealSupervisor_Semana").val();
    d_area = $("#filtroProgramaProduccionRealSupervisor_Area").val();
    
    $.ajax({
      type:"POST",
      url:"f_PPRealSupervisorObservacion.php",
      beforeSend: function() {
        $(".info_PPRealObservacionSupervisorCrear").html(loader());
      },
      data:{ semana: d_semana, area: d_area },
      success: function(data) {
        $(".info_PPRealObservacionSupervisorCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("submit", "#f_PPRealSupervisorObservacion", function(e){
    e.preventDefault();
    
    d_area = $("#f_PPRealSupervisorObservacion #Are_Codigo").val();
    d_semana = $("#f_PPRealSupervisorObservacion #ProPO_Semana").val();
    d_observacion = $("#f_PPRealSupervisorObservacion #ProPO_Observacion").val();
    
    $.ajax({
      type:"POST",
      url:"op_PPRealObservacionCrear.php",
      beforeSend: function() {
        bloquearFormulario("f_PPRealSupervisorObservacion");
        $("#Btn_PPRealObservacionSupervisorCrearForm").hide();
      },
      complete: function() {
        desbloquearFormulario("f_PPRealSupervisorObservacion");
        $("#Btn_PPRealObservacionSupervisorCrearForm").show();
      },
      data: { area: d_area, semana: d_semana, observacion: d_observacion },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_PPRealObservacionSupervisorNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_PPRealObservacionSupervisorNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_PPRealObservacionSupervisorNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_PPRealObservacionSupervisorNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
    $("body").on("click", ".e_cargarPPRealSupervisorObservacion", function(e){
    e.preventDefault();
    
    $("#vtn_PPRealObservacionSupervisorActualizar").modal({
      backdrop: 'static'
    });
    
    d_codigo = $(this).attr("data-cod");
    
    $.ajax({
      type:"POST",
      url:"f_PPRealObservacionActualizar.php",
      beforeSend: function() {
        $(".info_PPRealObservacionSupervisorActualizar").html(loader());
      },
      data:{ codigo: d_codigo },
      success: function(data) {
        $(".info_PPRealObservacionSupervisorActualizar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
   $("body").on("click", ".e_eliminarPPRealSupervisorObservacion", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    
    $.ajax({
      type:"POST",
      url:"op_PPRealObservacionEliminar.php",
      beforeSend: function() {
        $(".e_eliminarPPRealSupervisorObservacion").hide();
      },
      complete: function() {
        $(".e_eliminarPPRealSupervisorObservacion").show();
      },
      data: { codigo: d_codigo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_PPRealObservacionSupervisorNotificacionesEliminarNotificacion").modal({backdrop: 'static'});
          $(".info_PPRealObservacionSupervisorNotificacionesEliminarNotificacion").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_PPRealObservacionSupervisorNotificacionesEliminarNotificacion").modal({backdrop: 'static'});
          $(".info_PPRealObservacionSupervisorNotificacionesEliminarNotificacion").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", ".Btn_PPMas_GuardarCambiosMasivo", function(e){
    e.preventDefault();
    
    d_a = $(this).attr("data-num");
    
    d_lista1 = []; //Codigo
    d_lista2 = []; //Secuencia
    d_lista3 = []; //Fecha
    d_lista4 = []; //Hora
    d_lista5 = []; //Area
    d_lista6 = []; //Cantidad
    d_lista7 = []; //Europalet Cantidad
    d_lista8 = []; //Europalet Metros
    d_lista9 = []; //Exportacion Cantidad
    d_lista10 = []; //Exportacion Metros
    d_lista11 = []; //Estado Actual
    d_lista12 = []; //Estado Nuevo
    d_lista13 = []; //Descripción estado (suspendido - cancelado)
    
    cont = 0;
    for(a= 0; a < d_a; a++){
      if (!$(".PPDMas_EstadoNuevo"+a).prop("disabled") && $(".PPDMas_EstadoNuevo"+a + " option:selected").length > 0) {
        d_lista1[cont] = $(".ProP_CodigoAutoInc"+a).val();
        d_lista2[cont] = $(".PPDMas_Secuencia"+a).val();
        d_lista3[cont] = $(".PPDMas_Fecha"+a).val();
        d_lista4[cont] = $(".PPDMas_HoraInicio"+a).val();
        d_lista5[cont] = $(".PPDMas_Area"+a).val();
        d_lista6[cont] = $(".PPDMas_Cantidad"+a).val();
        d_lista7[cont] = $(".PPDMas_EuropaletCantidad"+a).val();
        d_lista8[cont] = $(".PPDMas_EuropaletMetros"+a).val();
        d_lista9[cont] = $(".PPDMas_ExportacionCantidad"+a).val();
        d_lista10[cont] = $(".PPDMas_ExportacionMetros"+a).val();
        d_lista11[cont] = $(".PPDMas_EstadoActual"+a).val();
        d_lista12[cont] = $(".PPDMas_EstadoNuevo"+a).val();
        d_lista13[cont] = $(".observacionEstadoUnico"+a).val();
        cont++;
      }
    }
    
    d_num = cont;
    
    $.ajax({
      type:"POST",
      url:"op_programaProduccionRealMasivoActualizar.php",
      beforeSend: function() {
        $(".Btn_PPMas_GuardarCambiosMasivo").hide();
      },
      complete: function() {
        $(".Btn_PPMas_GuardarCambiosMasivo").show();
      },
      data: { lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, lista5: d_lista5, lista6: d_lista6, lista7: d_lista7, lista8: d_lista8, lista9: d_lista9, lista10: d_lista10, lista11: d_lista11, lista12: d_lista12, num: d_num, lista13: d_lista13 },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          d_semana = $("#filtroProgramaProduccionReal_Semana").val();
          d_area = $("#filtroProgramaProduccionReal_Area").val();
          d_planta = $("#filtroProgramaProduccionReal_Planta").val();
          d_estado = $("#filtroProgramaProduccionReal_Estado").val();
          d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

          $.ajax({
            type: "POST",
            url: "f_programaProduccionReal.php",
            beforeSend: function () {
              $(".info_ProgramaProduccionRealListar").html(loader());
            },
            data: {
              semana: d_semana,
              area: d_area,
              planta: d_planta,
              estado: d_estado,
              formato: d_formato
            },
            success: function (data) {
              $(".info_ProgramaProduccionRealListar").html(data);
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        }else{
          mensaje('2', rs.mensaje);
          d_semana = $("#filtroProgramaProduccionReal_Semana").val();
          d_area = $("#filtroProgramaProduccionReal_Area").val();
          d_planta = $("#filtroProgramaProduccionReal_Planta").val();
          d_estado = $("#filtroProgramaProduccionReal_Estado").val();
          d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

          $.ajax({
            type: "POST",
            url: "f_programaProduccionReal.php",
            beforeSend: function () {
              $(".info_ProgramaProduccionRealListar").html(loader());
            },
            data: {
              semana: d_semana,
              area: d_area,
              planta: d_planta,
              estado: d_estado,
              formato: d_formato
            },
            success: function (data) {
              $(".info_ProgramaProduccionRealListar").html(data);
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
//    console.log(d_lista1);
//    console.log(d_lista2);
//    console.log(d_lista3);
//    console.log(d_lista4);
//    console.log(d_lista5);
//    console.log(d_lista6);
//    console.log(d_lista7);
//    console.log(d_lista8);
//    console.log(d_lista9);
//    console.log(d_lista10);
//    console.log(d_lista11);
//    console.log(d_lista12);
  
  });
  
 $("body").on("change", ".PP_SelEstadosActAutomaticaN", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    d_PDFfichaTecnica = $(this).attr("data-ficT");
    d_estadoActual = $(".EProP_EstadoActual"+d_codigo).val();
    d_estadoComp = $(".EProP_EstadoActualComp"+d_codigo).val();
    $(".Cod_Codigo").val(d_codigo);
    $(".Cod_estadoActual").val(d_estadoActual);
    $(".Cod_estadoComp").val(d_estadoComp);
    
    d_observacion = $("#ProP_ObservacionEstado"+d_codigo).val();
      if (d_estadoActual == "Listo para fabricar") {
        if(d_PDFfichaTecnica == ""){
          $(".ProP_ObservacionEstado").val('');
          $("#vtn_SinFTNotificacionesCrear").modal({
            backdrop: 'static'
          });
          d_semana = $("#filtroProgramaProduccionReal_Semana").val();
          d_area = $("#filtroProgramaProduccionReal_Area").val();
          d_planta = $("#filtroProgramaProduccionReal_Planta").val();
          d_estado = $("#filtroProgramaProduccionReal_Estado").val();
          d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

          $.ajax({
            type: "POST",
            url: "f_programaProduccionReal.php",
            beforeSend: function () {
              $(".info_ProgramaProduccionRealListar").html(loader());
            },
            data: {
              semana: d_semana,
              area: d_area,
              planta: d_planta,
              estado: d_estado,
              formato: d_formato
            },
            success: function (data) {
              $(".info_ProgramaProduccionRealListar").html(data);
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        }else{
           $.ajax({
            type:"POST",
            url:"op_programaProduccionRealEstadoActualizar.php",
            beforeSend: function() {
            },
            complete: function() {
            },
            data: { codigo: d_codigo, estadoActual: d_estadoActual, estadoComp: d_estadoComp },
            dataType: 'json',
            success: function(rs) {
              if(rs.mensaje == "OK"){
                d_semana = $("#filtroProgramaProduccionReal_Semana").val();
                d_area = $("#filtroProgramaProduccionReal_Area").val();
                d_planta = $("#filtroProgramaProduccionReal_Planta").val();
                d_estado = $("#filtroProgramaProduccionReal_Estado").val();
                d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

                $.ajax({
                  type: "POST",
                  url: "f_programaProduccionReal.php",
                  beforeSend: function () {
                    $(".info_ProgramaProduccionRealListar").html(loader());
                  },
                  data: {
                    semana: d_semana,
                    area: d_area,
                    planta: d_planta,
                    estado: d_estado,
                    formato: d_formato
                  },
                  success: function (data) {
                    $(".info_ProgramaProduccionRealListar").html(data);
                  },
                  error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                  }
                });
              }else{
                d_semana = $("#filtroProgramaProduccionReal_Semana").val();
                d_area = $("#filtroProgramaProduccionReal_Area").val();
                d_planta = $("#filtroProgramaProduccionReal_Planta").val();
                d_estado = $("#filtroProgramaProduccionReal_Estado").val();
                d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

                $.ajax({
                  type: "POST",
                  url: "f_programaProduccionReal.php",
                  beforeSend: function () {
                    $(".info_ProgramaProduccionRealListar").html(loader());
                  },
                  data: {
                    semana: d_semana,
                    area: d_area,
                    planta: d_planta,
                    estado: d_estado,
                    formato: d_formato
                  },
                  success: function (data) {
                    $(".info_ProgramaProduccionRealListar").html(data);
                  },
                  error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                  }
                });
                mensaje('2', rs.mensaje);
              }
            },
            error: function(er1, er2, er3) {
              console.log(er2+"-"+er3);
            }
          });
        }
      }else{
        if (d_estadoActual == "Cancelado" || d_estadoActual == "Suspendido") {
            $(".observacionVacia").html('');
            $(".ProP_ObservacionEstado").val('');
            
            observacionPP = "#ProP_ObservacionEstado" + d_codigo;

            if ($(observacionPP).length && $(observacionPP).val() != "") {
                $(".ProP_ObservacionEstado").val($(observacionPP).val());
            }
          
            $("#vtn_ObservacionEstadoCrearNotificacionesCrear").modal({
              backdrop: 'static'
            });

            $("#ProP_ObservacionEstado"+d_codigo).css("border", "2px solid red");

            $(".Cod_Codigo").val(d_codigo);
            $(".Cod_estadoActual").val(d_estadoActual);
            $(".Cod_estadoComp").val(d_estadoComp);
        }else{
          $.ajax({
            type:"POST",
            url:"op_programaProduccionRealEstadoActualizar.php",
            beforeSend: function() {
            },
            complete: function() {
            },
            data: { codigo: d_codigo, estadoActual: d_estadoActual, estadoComp: d_estadoComp },
            dataType: 'json',
            success: function(rs) {
              if(rs.mensaje == "OK"){
                d_semana = $("#filtroProgramaProduccionReal_Semana").val();
                d_area = $("#filtroProgramaProduccionReal_Area").val();
                d_planta = $("#filtroProgramaProduccionReal_Planta").val();
                d_estado = $("#filtroProgramaProduccionReal_Estado").val();
                d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

                $.ajax({
                  type: "POST",
                  url: "f_programaProduccionReal.php",
                  beforeSend: function () {
                    $(".info_ProgramaProduccionRealListar").html(loader());
                  },
                  data: {
                    semana: d_semana,
                    area: d_area,
                    planta: d_planta,
                    estado: d_estado,
                    formato: d_formato
                  },
                  success: function (data) {
                    $(".info_ProgramaProduccionRealListar").html(data);
                  },
                  error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                  }
                });
              }else{
                d_semana = $("#filtroProgramaProduccionReal_Semana").val();
                d_area = $("#filtroProgramaProduccionReal_Area").val();
                d_planta = $("#filtroProgramaProduccionReal_Planta").val();
                d_estado = $("#filtroProgramaProduccionReal_Estado").val();
                d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

                $.ajax({
                  type: "POST",
                  url: "f_programaProduccionReal.php",
                  beforeSend: function () {
                    $(".info_ProgramaProduccionRealListar").html(loader());
                  },
                  data: {
                    semana: d_semana,
                    area: d_area,
                    planta: d_planta,
                    estado: d_estado,
                    formato: d_formato
                  },
                  success: function (data) {
                    $(".info_ProgramaProduccionRealListar").html(data);
                  },
                  error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                  }
                });
                mensaje('2', rs.mensaje);
              }
            },
            error: function(er1, er2, er3) {
              console.log(er2+"-"+er3);
            }
          });
        } 
      }
  });
  
  
  $("body").on("click", "#Btn_ObservacionEstadoCrearNotificacionesCrear", function(e){ 
    e.preventDefault();
    
    d_codigo = $(".Cod_Codigo").val();
    d_estadoActual = $(".Cod_estadoActual").val();
    d_estadoComp = $(".Cod_estadoComp").val();
    d_observacion = $(".ProP_ObservacionEstado").val();
    
    $(".Cod_CodigoNot").val(d_codigo);
    $(".Cod_estadoActualNot").val(d_estadoActual);
    $(".Cod_estadoCompNot").val(d_estadoComp);
    $(".Cod_observacionNot").val(d_observacion);
    
    $(".observacionVacia").html('');
    
    $("#vtn_ObservacionEstadoNotiCrearNotificacionesCrear").modal({
      backdrop: 'static'
    });
    
  });
  
  $("body").on("click", "#Btn_ObservacionEstadoNotiCrearNotificacionesCrear", function(e){
    e.preventDefault();
    
    d_codigo = $(".Cod_CodigoNot").val();
    d_estadoActual = $(".Cod_estadoActualNot").val();
    d_estadoComp = $(".Cod_estadoCompNot").val();
    d_observacion = $(".Cod_observacionNot").val();
    
    cantidadCaracteres = 0;
    sinEspacios = d_observacion.replace(/\s+/g, '');
    sinCaracteres = sinEspacios.replace(/[^a-zA-Z0-9 ]/g, '');
    cantCaracteres = sinCaracteres.length;

    if(cantCaracteres < 10){
      cantidadCaracteres = 1;
    }
    
    if(d_observacion == ""){
     $("#vtn_ObservacionEstadoNotiCrearNotificacionesCrear").modal('hide');
     $(".observacionVacia").html('<br><div class="alert alert-danger"> <strong>Por favor debe agregar una descripción" </strong> </div>');
     }else{
       if(cantidadCaracteres == "1"){
         $("#vtn_ObservacionEstadoNotiCrearNotificacionesCrear").modal('hide');
         $(".observacionVacia").html('<br><div class="alert alert-danger"> <strong>El campo debe cumplir las siguientes caracteristicas: <br> -Tener mínimo 10 caracteres <br> -No estar lleno de espacios vacios <br> -No estar lleno de caracteres especiales <br> Por favor validar y volver a digitar el campo. </strong> </div>');
       }else{
        $.ajax({
          type:"POST",
          url:"op_programaProduccionRealEstadoActualizar.php",
          beforeSend: function() {
          },
          complete: function() {
          },
          data: { codigo: d_codigo, estadoActual: d_estadoActual, estadoComp: d_estadoComp, observacion: d_observacion },
          dataType: 'json',
          success: function(rs) {
            if(rs.mensaje == "OK"){

              $("#vtn_ObservacionEstadoCrearNotificacion").modal({backdrop: 'static'});
              $(".info_ObservacionEstadoCrearNotificacion").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Agregado Correctamente</h3>');

            }else{
              mensaje('2', rs.mensaje);
              $("#vtn_ObservacionEstadoCrearNotificacion").modal({backdrop: 'static'});
              $(".info_ObservacionEstadoCrearNotificacion").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Agregado</h3>');
            }
          },
          error: function(er1, er2, er3) {
            console.log(er2+"-"+er3);
          }
        });
       }
       
     }
  
  });
  
  $("body").on("click", "#Btn_ObservacionEstadoCrearNotificacion", function(e){
    e.preventDefault();
    
    $("#vtn_ObservacionEstadoCrearNotificacionesCrear").modal('hide');
    $("#vtn_ObservacionEstadoCrearNotificacion").modal('hide');
    $("#vtn_ObservacionEstadoNotiCrearNotificacionesCrear").modal('hide');
    
    d_semana = $("#filtroProgramaProduccionReal_Semana").val();
    d_area = $("#filtroProgramaProduccionReal_Area").val();
    d_planta = $("#filtroProgramaProduccionReal_Planta").val();
    d_estado = $("#filtroProgramaProduccionReal_Estado").val();
    d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionReal.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        planta: d_planta,
        estado: d_estado,
        formato: d_formato
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealListar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  
  });
  
  $("body").on("click", "#Btn_ObservacionEstadoCerrar", function(e){
    e.preventDefault();
    
    $("#vtn_ObservacionEstadoCrearNotificacionesCrear").modal('hide');
    
    d_semana = $("#filtroProgramaProduccionReal_Semana").val();
    d_area = $("#filtroProgramaProduccionReal_Area").val();
    d_planta = $("#filtroProgramaProduccionReal_Planta").val();
    d_estado = $("#filtroProgramaProduccionReal_Estado").val();
    d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

    $.ajax({
      type: "POST",
      url: "f_programaProduccionReal.php",
      beforeSend: function () {
        $(".info_ProgramaProduccionRealListar").html(loader());
      },
      data: {
        semana: d_semana,
        area: d_area,
        planta: d_planta,
        estado: d_estado,
        formato: d_formato
      },
      success: function (data) {
        $(".info_ProgramaProduccionRealListar").html(data);
//        $("#ProP_ObservacionEstado"+d_codigo).css("border", "#ccc");
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  
  });
  
  $("body").on("change", ".PP_SelEstadosActAutomaticaNPlanta", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    d_estadoActual = $(".EProP_EstadoActual"+d_codigo).val();
    d_estadoComp = $(".EProP_EstadoActualComp"+d_codigo).val();
    
    
    $.ajax({
      type:"POST",
      url:"op_programaProduccionRealEstadoActualizar.php",
      beforeSend: function() {
      },
      complete: function() {
      },
      data: { codigo: d_codigo, estadoActual: d_estadoActual, estadoComp: d_estadoComp },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          d_semana = $("#filtroProgramaProduccionReal_Semana").val();
          d_area = $("#filtroProgramaProduccionReal_Area").val();
          d_planta = $("#filtroProgramaProduccionReal_Planta").val();
          d_estado = $("#filtroProgramaProduccionReal_Estado").val();
          d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

          $.ajax({
            type: "POST",
            url: "f_programaProduccionReal.php",
            beforeSend: function () {
              $(".info_ProgramaProduccionRealListar").html(loader());
            },
            data: {
              semana: d_semana,
              area: d_area,
              planta: d_planta,
              estado: d_estado,
              formato: d_formato
            },
            success: function (data) {
              $(".info_ProgramaProduccionRealListar").html(data);
              if (d_estadoActual == "Cancelado" || d_estadoActual == "Suspendido") {
               $("#ProP_ObservacionEstado"+d_codigo).css("border", "2px solid red");
              } else {
               $("#ProP_ObservacionEstado"+d_codigo).css("border", "#ccc");
              }
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        }else{
          d_semana = $("#filtroProgramaProduccionReal_Semana").val();
          d_area = $("#filtroProgramaProduccionReal_Area").val();
          d_planta = $("#filtroProgramaProduccionReal_Planta").val();
          d_estado = $("#filtroProgramaProduccionReal_Estado").val();
          d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

          $.ajax({
            type: "POST",
            url: "f_programaProduccionReal.php",
            beforeSend: function () {
              $(".info_ProgramaProduccionRealListar").html(loader());
            },
            data: {
              semana: d_semana,
              area: d_area,
              planta: d_planta,
              estado: d_estado,
              formato: d_formato
            },
            success: function (data) {
              $(".info_ProgramaProduccionRealListar").html(data);
              if (d_estadoActual == "Cancelado" || d_estadoActual == "Suspendido") {
               $("#ProP_ObservacionEstado"+d_codigo).css("border", "2px solid red");
              } else {
               $("#ProP_ObservacionEstado"+d_codigo).css("border", "#ccc");
              }
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
          mensaje('2', rs.mensaje);
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", ".Btn_PPMas_GuardarCambiosMasivoPlanta", function(e){
    e.preventDefault();
    
    d_a = $(this).attr("data-num");
    
    d_lista1 = []; //Codigo
    d_lista2 = []; //Secuencia
    d_lista3 = []; //Fecha
    d_lista4 = []; //Hora
    d_lista5 = []; //Area
    d_lista6 = []; //Cantidad
    d_lista7 = []; //Europalet Cantidad
    d_lista8 = []; //Europalet Metros
    d_lista9 = []; //Exportacion Cantidad
    d_lista10 = []; //Exportacion Metros
    d_lista11 = []; //Estado Actual
    d_lista12 = []; //Estado Nuevo
    d_lista13 = []; //Descripción estado (suspendido - cancelado)
    
    cont = 0;
    for(a= 0; a < d_a; a++){
      d_lista1[cont] = $(".ProP_CodigoAutoInc"+a).val();
      d_lista2[cont] = $(".PPDMas_Secuencia"+a).val();
      d_lista3[cont] = $(".PPDMas_Fecha"+a).val();
      d_lista4[cont] = $(".PPDMas_HoraInicio"+a).val();
      d_lista5[cont] = $(".PPDMas_Area"+a).val();
      d_lista6[cont] = $(".PPDMas_Cantidad"+a).val();
      d_lista7[cont] = $(".PPDMas_EuropaletCantidad"+a).val();
      d_lista8[cont] = $(".PPDMas_EuropaletMetros"+a).val();
      d_lista9[cont] = $(".PPDMas_ExportacionCantidad"+a).val();
      d_lista10[cont] = $(".PPDMas_ExportacionMetros"+a).val();
      d_lista11[cont] = $(".PPDMas_EstadoActual"+a).val();
      d_lista12[cont] = $(".PPDMas_EstadoNuevo"+a).val();
      d_lista13[cont] = $(".observacionEstadoUnico"+a).val();
      
      if (d_lista12[cont] == "Cancelado" || d_lista12[cont] == "Suspendido") {
       $("#ProP_ObservacionEstado"+d_lista1[cont]).css("border", "#ccc");
      }
      
      console.log("#ProP_ObservacionEstado"+d_lista1[cont]);
      console.log(d_lista12[cont]);
			cont++;
    }
    
    d_num = cont;
    
    $.ajax({
      type:"POST",
      url:"op_programaProduccionRealMasivoActualizar.php",
      beforeSend: function() {
        $(".Btn_PPMas_GuardarCambiosMasivo").hide();
      },
      complete: function() {
        $(".Btn_PPMas_GuardarCambiosMasivo").show();
      },
      data: { lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, lista5: d_lista5, lista6: d_lista6, lista7: d_lista7, lista8: d_lista8, lista9: d_lista9, lista10: d_lista10, lista11: d_lista11, lista12: d_lista12, num: d_num, lista13: d_lista13 },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          d_semana = $("#filtroProgramaProduccionReal_Semana").val();
          d_area = $("#filtroProgramaProduccionReal_Area").val();
          d_planta = $("#filtroProgramaProduccionReal_Planta").val();
          d_estado = $("#filtroProgramaProduccionReal_Estado").val();
          d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

          $.ajax({
            type: "POST",
            url: "f_programaProduccionReal.php",
            beforeSend: function () {
              $(".info_ProgramaProduccionRealListar").html(loader());
            },
            data: {
              semana: d_semana,
              area: d_area,
              planta: d_planta,
              estado: d_estado,
              formato: d_formato
            },
            success: function (data) {
              $(".info_ProgramaProduccionRealListar").html(data);
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        }else{
          mensaje('2', rs.mensaje);
          d_semana = $("#filtroProgramaProduccionReal_Semana").val();
          d_area = $("#filtroProgramaProduccionReal_Area").val();
          d_planta = $("#filtroProgramaProduccionReal_Planta").val();
          d_estado = $("#filtroProgramaProduccionReal_Estado").val();
          d_formato = $("#filtroProgramaProduccionReal_Formatos").val();

          $.ajax({
            type: "POST",
            url: "f_programaProduccionReal.php",
            beforeSend: function () {
              $(".info_ProgramaProduccionRealListar").html(loader());
            },
            data: {
              semana: d_semana,
              area: d_area,
              planta: d_planta,
              estado: d_estado,
              formato: d_formato
            },
            success: function (data) {
              $(".info_ProgramaProduccionRealListar").html(data);
            },
            error: function (er1, er2, er3) {
              console.log(er2 + "-" + er3);
            }
          });
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  
});
