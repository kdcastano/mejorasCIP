$(document).ready(function (e) {

  $('#filtroFichaTecnica_Planta').multiselect({
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

  $('#filtroFichaTecnica_Fases').multiselect({
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

  $('#filtroFichaTecnica_Canales').multiselect({
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

  $('#filtroFichaTecnica_Area').multiselect({
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

  $('#filtroFichaTecnica_Formatos').multiselect({
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

  $('#filtroFichaTecnica_Familia').multiselect({
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
  
//    $('#filtroFichaTecnica_Version').multiselect({
//    includeSelectAllOption: true,
//    enableFiltering: true,
//    selectAllText: 'Seleccionar Todos',
//    nonSelectedText: 'Seleccione...',
//    nSelectedText: ' Todos',
//    buttonWidth: '100%',
//    enableCaseInsensitiveFiltering: true,
//    maxHeight: 300,
//    dropUp: true
//  });

  $("body").on("click", "#Btn_FichaTecnicaBuscar", function (e) {
    e.preventDefault();

    d_plantas = $("#filtroFichaTecnica_Planta").val();
    d_formatos = $("#filtroFichaTecnica_Formatos").val();
    d_estado = $("#filtroFichaTecnica_Estado").val();
    d_familia = $("#filtroFichaTecnica_Familia").val();
    d_version = $("#filtroFichaTecnica_Version").val();
    d_fecha = $("#filtroVariablesCriticas_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaListar.php",
      beforeSend: function () {
        $(".info_FichaTecnicaListar").html(loader());
      },
      data: {
        planta: d_plantas,
        formatos: d_formatos,
        estado: d_estado,
        familia: d_familia,
        version: d_version,
        fecha: d_fecha
      },
      success: function (data) {
        $(".info_FichaTecnicaListar").html(data);
        $("#tbl_FichaTecnicaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_FichaTecnicaCrear", function (e) {
    e.preventDefault();

    $("#vtn_FichatecnicaCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaCrear.php",
      beforeSend: function () {
        $(".info_FichatecnicaCrear").html(loader());
      },
      data: {},
      success: function (data) {
        $(".info_FichatecnicaCrear").html(data);
        //        $("#id_tabla").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });


  $("body").on("change", "#FicT_Familia", function (e) {
    e.preventDefault();

    d_familia = $("#f_FichaTecnicaCrear #FicT_Familia").val();
    d_planta = $("#f_FichaTecnicaCrear #Pla_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_cargarColor.php",
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

  $("body").on("change", "#Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_Codigo").val();
    $(".e_cargarFamiliaPlanta").html('<div class="form-group"><label class="control-label">Familia:<span class="rojo">*</span></label><select id="FicT_Familia" class="form-control" required><option></option></select></div>');
    $(".e_cargarColorCrear").html('<div class="form-group"><label class="control-label">Color:<span class="rojo">*</span></label><select id="FicT_Color" class="form-control" required><option></option></select></div>');

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

  $("body").on("change", "#For_Codigo", function (e) {
    e.preventDefault();

    d_formato = $("#For_Codigo").val();
    d_planta = $("#Pla_Codigo").val();
    d_clonar = $("#ClonarFTConfirmacion").val();
    $(".e_cargarColorCrear").html('<div class="form-group"><label class="control-label">Color:<span class="rojo">*</span></label><select id="FicT_Color" class="form-control" required><option></option></select></div>');

    $.ajax({
      type: "POST",
      url: "f_cargarFamiliaPlanta.php",
      beforeSend: function () {
        $(".e_cargarFamiliaPlanta").html(loader());
      },
      data: {
        formato: d_formato,
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarFamiliaPlanta").html(data);
        $.ajax({
          type: "POST",
          url: "f_fichaTecnicaClonar.php",
          beforeSend: function () {
            $(".e_clonarFichaTecnica").html(loader());
          },
          data: {
            clonar: d_clonar,
            formato: d_formato
          },
          success: function (data) {
            $(".e_clonarFichaTecnica").html(data);
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

  $("body").on("submit", "#f_FichaTecnicaCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_FichaTecnicaCrear #Pla_Codigo").val();
    d_formato = $("#f_FichaTecnicaCrear #For_Codigo").val();
    d_familia = $("#f_FichaTecnicaCrear #FicT_Familia").val();
    d_color = $("#f_FichaTecnicaCrear #FicT_Color").val();
    d_fechaEmision = $("#f_FichaTecnicaCrear #FicT_FecEmision").val();
    d_cicloHorno = $("#f_FichaTecnicaCrear #FicT_CicloHorno").val();
    d_nombreArchivo = $("#f_FichaTecnicaCrear #FicT_NombreArchivo").val();
    d_codigoFTClonar = $("#f_FichaTecnicaCrear #FichaTecnicaClonar").val();
    d_confirClonar = $("#f_FichaTecnicaCrear #ClonarFTConfirmacion").val();
    d_foto = $("#f_FichaTecnicaCrear #i_Arc_FT_Foto").val();
    d_fotoDos = $("#f_FichaTecnicaCrear #i_Arc_FT_FotoDos").val();

    $.ajax({
      type: "POST",
      url: "op_fichaTecnicaCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_FichaTecnicaCrear");
        $("#Btn_FichatecnicaCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_FichaTecnicaCrear");
        $("#Btn_FichatecnicaCrearForm").show();
      },
      data: {
        planta: d_planta,
        formato: d_formato,
        familia: d_familia,
        color: d_color,
        fechaEmision: d_fechaEmision,
        cicloHorno: d_cicloHorno,
        nombreArchivo: d_nombreArchivo,
        codigoFT: d_codigoFTClonar,
        clonar: d_confirClonar,
        foto: d_foto,
        fotoDos: d_fotoDos
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FichaTecnicaNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_FichaTecnicaNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');

        } else {
          $("#vtn_FichaTecnicaNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_FichaTecnicaNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });


  });

  $("body").on("click", "#Btn_FichaTecnicaNotificacionesCrear", function (e) {
    e.preventDefault();

    $("#vtn_FichaTecnicaNotificacionesCrear").modal('hide');
    $("#vtn_FichatecnicaCrear").modal('hide');

    d_plantas = $("#filtroFichaTecnica_Planta").val();
    d_formatos = $("#filtroFichaTecnica_Formatos").val();
    d_estado = $("#filtroFichaTecnica_Estado").val();
    d_familia = $("#filtroFichaTecnica_Familia").val();
    d_version = $("#filtroFichaTecnica_Version").val();
    d_fecha = $("#filtroVariablesCriticas_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaListar.php",
      beforeSend: function () {
        $(".info_FichaTecnicaListar").html(loader());
      },
      data: {
        planta: d_plantas,
        formatos: d_formatos,
        estado: d_estado,
        familia: d_familia,
        fecha: d_fecha,
        version: d_version
      },
      success: function (data) {
        $(".info_FichaTecnicaListar").html(data);
        $("#tbl_FichaTecnicaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_crearDetalleFichaTecnica", function (e) {
    e.preventDefault();

    d_planta = $(this).attr("data-pla");
    d_codigo = $(this).attr("data-cod");
    d_formato = $(this).attr("data-form");
    d_tipo = "2";

    $("#vtn_FichatecnicaCrearDetalle").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaCrearDetalle.php",
      beforeSend: function () {
        $(".info_FichatecnicaCrearDetalle").html(loader());
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        formato: d_formato,
        tipo: d_tipo
      },
      success: function (data) {
        $(".info_FichatecnicaCrearDetalle").html(data);


        $.ajax({
          type: "POST",
          url: "f_fichaTecnicaCrearDetalleAreas.php",
          beforeSend: function () {
            $(".e_cargarDetalleFT" + d_tipo).html(loader());
          },
          data: {
            tipo: d_tipo,
            planta: d_planta,
            codigo: d_codigo,
            formato: d_formato,
            familia: d_familia
          },
          success: function (data) {
            $(".e_cargarDetalleFT" + d_tipo).html(data);

          },
          error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
          }
        });


        //        $("#id_tabla").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_FichatecnicaDetalleCrearForm", function (e) {
    e.preventDefault();

    d_fichaTecnica = $("#DetFT_FicT_Codigo").val();
    a = $(this).attr("data-num");

    d_lista1 = [];
    d_lista2 = [];
    d_lista3 = [];
    d_lista4 = [];
    d_lista5 = [];
    d_lista6 = [];
    d_lista7 = [];
    d_lista8 = [];

    cont = 0;
    for (i = 0; i < a; i++) {
      d_lista1[cont] = $("#FTConFT_Codigo_" + i).val();
      d_lista2[cont] = $("#FTCampoTipo_" + i).val();
      d_lista3[cont] = $("#FTCampoUniMedida_" + i).val();
      d_lista4[cont] = $("#FTCampoValorControl_" + i).val();
      d_lista5[cont] = $("#FTCampoValorTolerancia_" + i).val();
      d_lista6[cont] = $("#FTCampoOperador_" + i).val();
      d_lista7[cont] = $("#FTCampoTomaVariable_" + i).val();
      d_lista8[cont] = $("#Maq_Codigo_" + i).val();
      cont++;
    }
    d_num = cont;

    $.ajax({
      type: "POST",
      url: "op_detalleFichaTecnicaCrear.php",
      beforeSend: function () {
        $("#Btn_FichatecnicaActualizarForm").hide();
      },
      complete: function () {
        $("#Btn_FichatecnicaActualizarForm").show();
      },
      data: {
        fichaTecnica: d_fichaTecnica,
        lista1: d_lista1,
        lista2: d_lista2,
        lista3: d_lista3,
        lista4: d_lista4,
        lista5: d_lista5,
        lista6: d_lista6,
        lista7: d_lista7,
        lista8: d_lista8,
        num: d_num
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          alert("ok");
        } else {
          $("#Btn_FichatecnicaActualizarForm").show();
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_editarFichaTecnica", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_FichaTecnicaActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaActualizar.php",
      beforeSend: function () {
        $(".info_FichaTecnicaActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_FichaTecnicaActualizar").html(data);
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
    $(".e_cargarFamiliaPlantaActualizar").html('<div class="form-group"><label class="control-label">Familia:<span class="rojo">*</span></label><select id="FicT_Familia" class="form-control" required><option></option></select></div>');
    $(".e_cargarColorActualizar").html('<div class="form-group"><label class="control-label">Color:<span class="rojo">*</span></label><select id="FicT_Color" class="form-control" required><option></option></select></div>');

    $.ajax({
      type: "POST",
      url: "f_cargarAreasActualizar.php",
      beforeSend: function () {
        $(".e_cargarAreaActualizar").html(loader());
      },
      data: {
        planta: d_planta,
        codigo: d_codigo
      },
      success: function (data) {
        $(".e_cargarAreaActualizar").html(data);

        $.ajax({
          type: "POST",
          url: "f_cargarFormatosFTActualizar.php",
          beforeSend: function () {
            $(".e_cargarFormatosPlantaAct").html(loader());
          },
          data: {
            planta: d_planta,
            codigo: d_codigo
          },
          success: function (data) {
            $(".e_cargarFormatosPlantaAct").html(data);
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

  $("body").on("change", "#For_CodigoAct", function (e) {
    e.preventDefault();

    d_formato = $("#For_CodigoAct").val();
    d_planta = $("#Pla_CodigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarFamiliaPlantaFTActualizar.php",
      beforeSend: function () {
        $(".e_cargarFamiliaPlantaActualizar").html(loader());
      },
      data: {
        formato: d_formato,
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarFamiliaPlantaActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#FicT_FamiliaAct", function (e) {
    e.preventDefault();

    d_familia = $("#f_FichaTecnicaActualizar #FicT_FamiliaAct").val();
    d_planta = $("#f_FichaTecnicaActualizar #Pla_CodigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarColorActualizar.php",
      beforeSend: function () {
        $(".e_cargarColorActualizar").html(loader());
      },
      data: {
        familia: d_familia,
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarColorActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_FichaTecnicaActualizar", function (e) {
    e.preventDefault();

    d_planta = $("#f_FichaTecnicaActualizar #Pla_CodigoAct").val();
    d_formato = $("#f_FichaTecnicaActualizar #For_CodigoAct").val();
    d_familia = $("#f_FichaTecnicaActualizar #FicT_FamiliaAct").val();
    d_color = $("#f_FichaTecnicaActualizar #FicT_ColorAct").val();
    d_fechaEmision = $("#f_FichaTecnicaActualizar #FicT_FecEmisionAct").val();
//    d_cicloHorno = $("#f_FichaTecnicaActualizar #FicT_CicloHornoAct").val();
    d_nombreArchivo = $("#f_FichaTecnicaActualizar #FicT_NombreArchivoAct").val();
    d_codigo = $("#f_FichaTecnicaActualizar #codigoAct").val();
    d_foto = $("#f_FichaTecnicaActualizar #i_Arc_FT_FotoAct").val();
    d_fotoDos = $("#f_FichaTecnicaActualizar #i_Arc_FT_FotoDosAct").val();

    $.ajax({
      type: "POST",
      url: "op_fichaTecnicaActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_FichaTecnicaActualizar");
        $("#Btn_FichaTecnicaActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_FichaTecnicaActualizar");
        $("#Btn_FichaTecnicaActualizarForm").show();
      },
      data: {
        codigo: d_codigo,
        planta: d_planta,
        formato: d_formato,
        familia: d_familia,
        color: d_color,
        fechaEmision: d_fechaEmision,
//        cicloHorno: d_cicloHorno,
        nombreArchivo: d_nombreArchivo,
        foto: d_foto,
        fotoDos: d_fotoDos
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_FichaTecnicaNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_FichaTecnicaNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_FichaTecnicaNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_FichaTecnicaNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });


  });

  $("body").on("click", "#Btn_FichaTecnicaNotificacionesActualizar", function (e) {
    e.preventDefault();
    $("#vtn_FichaTecnicaNotificacionesActualizar").modal('hide');
    $("#vtn_FichaTecnicaActualizar").modal('hide');

    d_plantas = $("#filtroFichaTecnica_Planta").val();
    d_formatos = $("#filtroFichaTecnica_Formatos").val();
    d_estado = $("#filtroFichaTecnica_Estado").val();
    d_familia = $("#filtroFichaTecnica_Familia").val();
    d_version = $("#filtroFichaTecnica_Version").val();
    d_fecha = $("#filtroVariablesCriticas_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaListar.php",
      beforeSend: function () {
        $(".info_FichaTecnicaListar").html(loader());
      },
      data: {
        planta: d_plantas,
        formatos: d_formatos,
        estado: d_estado,
        familia: d_familia,
        fecha: d_fecha,
        version: d_version
      },
      success: function (data) {
        $(".info_FichaTecnicaListar").html(data);
        $("#tbl_FichaTecnicaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#f_InfoDetalleFichaTecnicaCrear #DFT_Tipo", function (e) {
    e.preventDefault();

    d_tipo = $("#f_InfoDetalleFichaTecnicaCrear #DFT_Tipo").val();
    d_codigoDFT = $("#f_InfoDetalleFichaTecnicaCrear #DFT_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_cargarCamposTipoFTD.php",
      beforeSend: function () {
        $(".e_cargarTipoFTD").html(loader());
      },
      data: {
        tipo: d_tipo,
        codigo: d_codigoDFT
      },
      success: function (data) {
        $(".e_cargarTipoFTD").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", ".e_cargarInformacionDTF", function (e) {
    e.preventDefault();

    d_codigoFT = $(this).attr("data-codFT");
    d_codigoConfigFT = $(this).attr("data-confFT");
    d_nombreVariable = $(this).attr("data-var");
    d_nombreArea = $(this).attr("data-are");
    d_codigoArea = $(this).attr("data-codAre");
    d_codigoPlanta = $(this).attr("data-pla");
    d_codigoDFT = $(this).attr("data-codDFT");
    d_formato = $(this).attr("data-form");
    d_tipo = $(this).attr("data-tip");
    d_maquina = $(this).attr("data-maq");

    $("#vtn_InfoDetalleFichaTecnicaCrear").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaAgregarDetalle.php",
      beforeSend: function () {
        $(".info_InfoDetalleFichaTecnicaCrear").html(loader());
      },
      data: {
        codigoFT: d_codigoFT,
        codigoConfigFT: d_codigoConfigFT,
        variable: d_nombreVariable,
        area: d_nombreArea,
        codArea: d_codigoArea,
        planta: d_codigoPlanta,
        codDFT: d_codigoDFT,
        formato: d_formato,
        tipo: d_tipo,
        maquina: d_maquina
      },
      success: function (data) {
        $(".info_InfoDetalleFichaTecnicaCrear").html(data);
        //        $("#id_tabla").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("submit", "#f_InfoDetalleFichaTecnicaCrear", function (e) {
    e.preventDefault();

    d_FicT_Codigo = $("#f_InfoDetalleFichaTecnicaCrear #FicT_Codigo").val();
    d_ConFT_Codigo = $("#f_InfoDetalleFichaTecnicaCrear #ConFT_Codigo").val();
    d_Maq_Codigo = $("#f_InfoDetalleFichaTecnicaCrear #Maq_Codigo").val();
    d_tipo = $("#f_InfoDetalleFichaTecnicaCrear #DFT_Tipo").val();
    d_unidadMedida = $("#f_InfoDetalleFichaTecnicaCrear #DFT_UnidadMedida").val();
    d_vControl = $("#f_InfoDetalleFichaTecnicaCrear #DFT_ValorControl").val();
    d_vOperador = $("#f_InfoDetalleFichaTecnicaCrear #DFT_Operador").val();
    d_vTolerancia = $("#f_InfoDetalleFichaTecnicaCrear #DFT_ValorTolerancia").val();
    d_tomaVariable = $("#f_InfoDetalleFichaTecnicaCrear #DFT_TomaVariable").val();

    $.ajax({
      type: "POST",
      url: "op_fichaTecnicaDetalleCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_InfoDetalleFichaTecnicaCrear");
        $("#Btn_InfoDetalleFichaTecnicaCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_InfoDetalleFichaTecnicaCrear");
        $("#Btn_InfoDetalleFichaTecnicaCrearForm").show();
      },
      data: {
        FicT_Codigo: d_FicT_Codigo,
        ConFT_Codigo: d_ConFT_Codigo,
        Maq_Codigo: d_Maq_Codigo,
        tipo: d_tipo,
        unidadMedida: d_unidadMedida,
        valorControl: d_vControl,
        valorOperador: d_vOperador,
        valorTolerancia: d_vTolerancia,
        tomaVariable: d_tomaVariable
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_InfoDetalleFichaTecnicaNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_InfoDetalleFichaTecnicaNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_InfoDetalleFichaTecnicaNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_InfoDetalleFichaTecnicaNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_InfoDetalleFichaTecnicaNotificacionesCrear", function (e) {
    e.preventDefault();

    d_posisionSc = $("#vtn_FichatecnicaCrearDetalle").scrollTop();
    
    $("#vtn_InfoDetalleFichaTecnicaNotificacionesCrear").modal('hide');
    $("#vtn_InfoDetalleFichaTecnicaCrear").modal('hide');

    d_FicT_Codigo = $("#f_InfoDetalleFichaTecnicaCrear #FicT_Codigo").val();
    d_planta = $("#f_InfoDetalleFichaTecnicaCrear #Pla_Codigo").val();
    d_formato = $("#f_InfoDetalleFichaTecnicaCrear #For_Codigo").val();
    d_tipo = $("#f_InfoDetalleFichaTecnicaCrear #tipo").val();

    $(".Sel_FTDetalleCrear" + d_tipo).attr("data-pos", d_posisionSc);
    
    $(".Sel_FTDetalleCrear" + d_tipo).click();

  });

  $("body").on("change", "#DFT_TipoAct", function (e) {
    e.preventDefault();

    d_tipo = $("#DFT_TipoAct").val();
    d_codigoDFT = $("#f_InfoDetalleFichaTecnicaActualizar #DFT_CodigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarCamposTipoFTDAct.php",
      beforeSend: function () {
        $(".e_cargarTipoFTDActualizar").html(loader());
      },
      data: {
        tipo: d_tipo,
        codigo: d_codigoDFT
      },
      success: function (data) {
        $(".e_cargarTipoFTDActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#f_InfoDetalleFichaTecnicaActualizar #DFT_TipoAct", function (e) {
    e.preventDefault();

    d_tipo = ("#f_InfoDetalleFichaTecnicaActualizar #DFT_TipoAct").val();
    d_codigoDFT = ("#f_InfoDetalleFichaTecnicaActualizar #DFT_CodigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarCamposTipoFTDAct.php",
      beforeSend: function () {
        $(".e_cargarTipoFTDActualizar").html(loader());
      },
      data: {
        tipo: d_tipo,
        codigo: d_codigoDFT
      },
      success: function (data) {
        $(".e_cargarTipoFTDActualizar").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("submit", "#f_InfoDetalleFichaTecnicaActualizar", function (e) {
    e.preventDefault();

    d_codigoDFT = $("#f_InfoDetalleFichaTecnicaActualizar #codDFT").val();
    d_tipo = $("#f_InfoDetalleFichaTecnicaActualizar #DFT_TipoAct").val();
    d_unidadMedida = $("#f_InfoDetalleFichaTecnicaActualizar #DFT_UnidadMedidaAct").val();
    d_vControl = $("#f_InfoDetalleFichaTecnicaActualizar #DFT_ValorControlAct").val();
    d_vOperador = $("#f_InfoDetalleFichaTecnicaActualizar #DFT_OperadorAct").val();
    d_vTolerancia = $("#f_InfoDetalleFichaTecnicaActualizar #DFT_ValorToleranciaAct").val();
    d_tomaVariable = $("#f_InfoDetalleFichaTecnicaActualizar #DFT_TomaVariableAct").val();

    $.ajax({
      type: "POST",
      url: "op_fichaTecnicaDetalleActualizar.php",
      beforeSend: function () {
        bloquearFormulario("f_InfoDetalleFichaTecnicaActualizar");
        $("#Btn_InfoDetalleFichaTecnicaActualizarForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_InfoDetalleFichaTecnicaActualizar");
        $("#Btn_InfoDetalleFichaTecnicaActualizarForm").show();
      },
      data: {
        codigo: d_codigoDFT,
        tipo: d_tipo,
        unidadMedida: d_unidadMedida,
        valorControl: d_vControl,
        valorOperador: d_vOperador,
        valorTolerancia: d_vTolerancia,
        tomaVariable: d_tomaVariable
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_InfoDetalleFichaTecnicaNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_InfoDetalleFichaTecnicaNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_InfoDetalleFichaTecnicaNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_InfoDetalleFichaTecnicaNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_InfoDetalleFichaTecnicaNotificacionesActualizar", function (e) {
    e.preventDefault();
    
    $("#vtn_InfoDetalleFichaTecnicaNotificacionesActualizar").modal('hide');
    $("#vtn_InfoDetalleFichaTecnicaCrear").modal('hide');
    
    d_posisionSc = $("#vtn_FichatecnicaCrearDetalle").scrollTop();

    d_FicT_CodigoAct = $("#f_InfoDetalleFichaTecnicaActualizar #FicT_CodigoAct").val();
    d_plantaAct = $("#f_InfoDetalleFichaTecnicaActualizar #Pla_CodigoAct").val();
    d_formato = $("#f_InfoDetalleFichaTecnicaActualizar #For_CodigoAct").val();
    d_tipo = $("#f_InfoDetalleFichaTecnicaActualizar #tipoAct").val();
    
    $(".Sel_FTDetalleCrear" + d_tipo).attr("data-pos", d_posisionSc);
    $(".Sel_FTDetalleCrear" + d_tipo).click();
  });

  // Selección Menu
  $("body").on("click", ".Sel_FTDetalleCrear", function (e) {
    e.preventDefault();

    d_tipo = $(this).attr("data-tip");
    d_planta = $(this).attr("data-pla");
    d_codigo = $(this).attr("data-cod");
    d_formato = $(this).attr("data-form");
    d_posisionSc = $(this).attr("data-pos");

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaCrearDetalleAreas.php",
      beforeSend: function () {
        $(".e_cargarDetalleFT" + d_tipo).html(loader());
      },
      data: {
        tipo: d_tipo,
        planta: d_planta,
        codigo: d_codigo,
        formato: d_formato
      },
      success: function (data) {
        $(".e_cargarDetalleFT" + d_tipo).html(data);
        $("#vtn_FichatecnicaCrearDetalle").scrollTop(d_posisionSc);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".Sel_FTDetalleCrearLinea", function (e) {
    e.preventDefault();

    d_tipo = $(this).attr("data-tip");
    d_planta = $(this).attr("data-pla");
    d_codigo = $(this).attr("data-cod");
    d_formato = $(this).attr("data-form");
    d_posisionSc = $(this).attr("data-pos");

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaCrearDetalleAreasLineas.php",
      beforeSend: function () {
        $(".e_cargarDetalleFT" + d_tipo).html(loader());
      },
      data: {
        tipo: d_tipo,
        planta: d_planta,
        codigo: d_codigo,
        formato: d_formato
      },
      success: function (data) {
        $(".e_cargarDetalleFT" + d_tipo).html(data);
        $("#vtn_FichatecnicaCrearDetalle").scrollTop(d_posisionSc);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".e_finalizarFichaTecnica", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");
    d_formato = $(this).attr("data-form");
    d_familia = $(this).attr("data-fami");
    d_color = $(this).attr("data-color");

    $("#vtn_FichaTecnicaFinalizar").modal({
      backdrop: 'static'
    });

    $(".Cod_FichaTecnicaFinalizar").val(d_codigo);
    $(".Cod_FormatoFinalizar").val(d_formato);
    $(".FamiliaFinalizar").val(d_familia);
    $(".ColorFinalizar").val(d_color);

  });

  $("body").on("click", "#Btn_FichaTecnicaFinalizarForm", function (e) {
    e.preventDefault();

    d_codigoFT = $(".Cod_FichaTecnicaFinalizar").val();
    d_formato = $(".Cod_FormatoFinalizar").val();
    d_familia = $(".FamiliaFinalizar").val();
    d_color = $(".ColorFinalizar").val();

    $("#vtn_FichaTecnicaFinalizar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_fichaTecnicaFinalizar.php",
      beforeSend: function () {
        $("#Btn_FichaTecnicaFinalizarForm").hide();
        $("#vtn_FTNotificacionFinalizar").modal({
          backdrop: 'static'
        });
        $(".info_FTNotificacionFinalizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Procesando...</h3>');
        $("#Btn_FTNotificacionFinalizar").hide();
      },
      complete: function () {
        $("#Btn_FichaTecnicaFinalizarForm").show();
      },
      data: {
        codigo: d_codigoFT,
        formato: d_formato,
        familia: d_familia,
        color: d_color
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#Btn_FTNotificacionFinalizar").show();
          $(".info_FTNotificacionFinalizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Finalizado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_FTNotificacionFinalizar").modal({
            backdrop: 'static'
          });
          $(".info_FTNotificacionFinalizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Finalizado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", "#Btn_FTNotificacionFinalizar", function (e) {
    e.preventDefault();
    $("#vtn_FTNotificacionFinalizar").modal('hide');
    d_plantas = $("#filtroFichaTecnica_Planta").val();
    d_formatos = $("#filtroFichaTecnica_Formatos").val();
    d_estado = $("#filtroFichaTecnica_Estado").val();
    d_familia = $("#filtroFichaTecnica_Familia").val();
    d_version = $("#filtroFichaTecnica_Version").val();
    d_fecha = $("#filtroVariablesCriticas_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaListar.php",
      beforeSend: function () {
        $(".info_FichaTecnicaListar").html(loader());
      },
      data: {
        planta: d_plantas,
        formatos: d_formatos,
        estado: d_estado,
        familia: d_familia,
        fecha: d_fecha,
        version: d_version
      },
      success: function (data) {
        $(".info_FichaTecnicaListar").html(data);
        $("#tbl_FichaTecnicaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#filtroFichaTecnica_Planta", function (e) {
    e.preventDefault();

    d_planta = $("#filtroFichaTecnica_Planta").val();

    $.ajax({
      type: "POST",
      url: "f_cargarFamiliaPlanta.php",
      beforeSend: function () {
        $(".e_cargarFamiliaFm").html(loader());
      },
      data: {
        planta: d_planta
      },
      success: function (data) {
        $(".e_cargarFamiliaFm").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#DFT_ValorControlTipo", function (e) {
    e.preventDefault();

    d_tipoEfecto = $("#DFT_ValorControlTipo").val();

    $.ajax({
      type: "POST",
      url: "f_cargarInsumoFT.php",
      beforeSend: function () {
        $(".e_cargarInsumo").html(loader());
      },
      data: {
        tipoEfecto: d_tipoEfecto
      },
      success: function (data) {
        $(".e_cargarInsumo").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("change", "#DFT_ValorControlTipoAct", function (e) {
    e.preventDefault();

    d_tipoEfecto = $("#DFT_ValorControlTipoAct").val();
    d_codigo = $("#DFT_CodigoAct").val();

    $.ajax({
      type: "POST",
      url: "f_cargarInsumoFTAct.php",
      beforeSend: function () {
        $(".e_cargarInsumoAct").html(loader());
      },
      data: {
        tipoEfecto: d_tipoEfecto,
        codDFT: d_codigo
      },
      success: function (data) {
        $(".e_cargarInsumoAct").html(data);
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });

  $("body").on("click", ".pdf_exportarFT", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");
    d_planta = $(this).attr("data-pla");
    d_formato = $(this).attr("data-form");
    d_fechaEmision = $(this).attr("data-fecha");
    d_productoColor = $(this).attr("data-prod");

    window.location.href = "pdfFT.php?codigo=" + d_codigo + "&planta=" + d_planta + "&formato=" + d_formato + "&fecha=" + d_fechaEmision + "&producto=" + d_productoColor;

  });

  $("body").on("change", "#ClonarFTConfirmacion", function (e) {
    e.preventDefault();

    d_clonar = $("#ClonarFTConfirmacion").val();
    d_formato = $("#f_FichaTecnicaCrear #For_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaClonar.php",
      beforeSend: function () {
        $(".e_clonarFichaTecnica").html(loader());
      },
      data: {
        clonar: d_clonar,
        formato: d_formato
      },
      success: function (data) {
        $(".e_clonarFichaTecnica").html(data);
        $('#FichaTecnicaClonar').multiselect({
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

  });

  $("body").on("click", ".e_cargarInformacionDTFEliminar", function (e) {
    e.preventDefault();

    d_codDFT = $(this).attr("data-codDFT");
    d_tipo = $(this).attr("data-tip");

    $("#vtn_VariablesNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_DetalleFichaTecnica").val(d_codDFT);
    $(".Cod_FichaTecnicaTipo").val(d_tipo);

  });

  $("body").on("click", "#Btn_VariablesNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codDFT = $(".Cod_DetalleFichaTecnica").val();

    $("#vtn_VariablesNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_detalleFichaTecnicaEliminar.php",
      beforeSend: function () {
        $("#Btn_VariablesNotificacionesEliminar").hide();
      },
      complete: function () {
        $("#Btn_VariablesNotificacionesEliminar").show();
      },
      data: {
        codigo: d_codDFT
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_NotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_NotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_NotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_NotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_NotificacionesEliminar", function (e) {
    e.preventDefault();
    
    d_posisionSc = $("#vtn_FichatecnicaCrearDetalle").scrollTop();

    $("#vtn_VariablesNotificacionesEliminar").modal('hide');
    $("#vtn_NotificacionesEliminar").modal('hide');

    d_tipo = $(".Cod_FichaTecnicaTipo").val();
    
    $(".Sel_FTDetalleCrear" + d_tipo).attr("data-pos", d_posisionSc);

    $(".Sel_FTDetalleCrear" + d_tipo).click();

  });

  $("body").on("click", ".e_cargarEliminarFT", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_FichaTecnicaNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_FichaTecnica").val(d_codigo);

  });

  $("body").on("click", "#Btn_FichaTecnicaNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_FichaTecnica").val();

    $("#vtn_FichaTecnicaNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_fichaTecnicaEliminar.php",
      beforeSend: function () {
        $("#Btn_FichaTecnicaNotificacionesEliminar").hide();
      },
      complete: function () {
        $("#Btn_FichaTecnicaNotificacionesEliminar").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_NotificacionesFichaTecnicaEliminar").modal({
            backdrop: 'static'
          });
          $(".info_NotificacionesFichaTecnicaEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_NotificacionesFichaTecnicaEliminar").modal({
            backdrop: 'static'
          });
          $(".info_NotificacionesFichaTecnicaEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });

  $("body").on("click", "#Btn_NotificacionesFichaTecnicaEliminar", function (e) {
    e.preventDefault();

    $("#vtn_NotificacionesFichaTecnicaEliminar").modal('hide');
    $("#vtn_FichaTecnicaNotificacionesEliminar").modal('hide');

    d_plantas = $("#filtroFichaTecnica_Planta").val();
    d_formatos = $("#filtroFichaTecnica_Formatos").val();
    d_estado = $("#filtroFichaTecnica_Estado").val();
    d_familia = $("#filtroFichaTecnica_Familia").val();
    d_version = $("#filtroFichaTecnica_Version").val();
    d_fecha = $("#filtroVariablesCriticas_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaListar.php",
      beforeSend: function () {
        $(".info_FichaTecnicaListar").html(loader());
      },
      data: {
        planta: d_plantas,
        formatos: d_formatos,
        estado: d_estado,
        familia: d_familia,
        fecha: d_fecha,
        version: d_version
      },
      success: function (data) {
        $(".info_FichaTecnicaListar").html(data);
        $("#tbl_FichaTecnicaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("click", ".e_eliminarTodasVariablesMaquinaZonaEsmaltado", function(e){
    e.preventDefault();
    
    d_codFT = $(this).attr("data-FT");
    d_codMaquina = $(this).attr("data-maq");
    
    $.ajax({
      type:"POST",
      url:"op_detalleFichaTecnicaEliminarVariables.php",
      beforeSend: function() {
        $(".e_eliminarTodasVariablesMaquinaZonaEsmaltado").hide();
      },
      complete: function() {
        $(".e_eliminarTodasVariablesMaquinaZonaEsmaltado").show();
      },
      data: { codigoFT: d_codFT, codigoMaquina: d_codMaquina },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $(".Cod_FichaTecnicaTipo").val(d_tipo);
          $("#vtn_NotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_NotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $(".Cod_FichaTecnicaTipo").val(d_tipo);
          $("#vtn_NotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_NotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });
  
  $("body").on("click", ".e_eliminarTodasVariablesMaquinaZonaDecorado", function(e){
    e.preventDefault();
    
    d_codFT = $(this).attr("data-FT");
    d_codMaquina = $(this).attr("data-maq");
    d_tipo = $(this).attr("data-tip");
    
    $.ajax({
      type:"POST",
      url:"op_detalleFichaTecnicaEliminarVariables.php",
      beforeSend: function() {
        $(".e_eliminarTodasVariablesMaquinaZonaDecorado").hide();
      },
      complete: function() {
        $(".e_eliminarTodasVariablesMaquinaZonaDecorado").show();
      },
      data: { codigoFT: d_codFT, codigoMaquina: d_codMaquina },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $(".Cod_FichaTecnicaTipo").val(d_tipo);
          $("#vtn_NotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_NotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $(".Cod_FichaTecnicaTipo").val(d_tipo);
          $("#vtn_NotificacionesEliminar").modal({
            backdrop: 'static'
          });
          $(".info_NotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  
  });

});
