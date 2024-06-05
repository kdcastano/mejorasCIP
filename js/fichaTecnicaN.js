$(document).ready(function(e) {

  $('#filtroFichaTecnicaN_Planta').multiselect({
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
  
  $('#filtroFichaTecnicaN_Formatos').multiselect({
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
  
  $('#filtroFichaTecnicaN_Formatos').multiselect({
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
  
  $('#filtroFichaTecnicaN_Familia').multiselect({
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
  
  $("body").on("click", "#Btn_FichaTecnicaNBuscar", function (e) {
    e.preventDefault();

    d_plantas = $("#filtroFichaTecnicaN_Planta").val();
    d_formatos = $("#filtroFichaTecnicaN_Formatos").val();
    d_estado = $("#filtroFichaTecnicaN_Estado").val();
    d_familia = $("#filtroFichaTecnicaN_Familia").val();
    d_version = $("#filtroFichaTecnicaN_Version").val();
    d_fecha = $("#filtroFichaTecnicaN_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaNListar.php",
      beforeSend: function () {
        $(".info_FichaTecnicaNListar").html(loader());
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
        $(".info_FichaTecnicaNListar").html(data);
        $("#tbl_FichaTecnicaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("click", "#Btn_FichaTecnicaNCrear", function(e){
    e.preventDefault();
    
    $("#vtn_fichaTecnicaCrear").modal({
      backdrop: 'static'
    });
    
    $.ajax({
      type:"POST",
      url:"f_fichaTecnicaNCrear.php",
      beforeSend: function() {
        $(".info_fichaTecnicaCrear").html(loader());
      },
      data:{  },
      success: function(data) {
        $(".info_fichaTecnicaCrear").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("change", "#Pla_Codigo", function (e) {
    e.preventDefault();

    d_planta = $("#Pla_Codigo").val();
    $(".e_cargarFamiliaPlanta").html('<div class="form-group"><label class="control-label">Familia:<span class="rojo">*</span></label><select id="FicT_FamiliaN" class="form-control" required><option></option></select></div>');
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
      url: "f_cargarFamiliaPlantaN.php",
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
  
  $("body").on("change", "#FicT_FamiliaN", function (e) {
    e.preventDefault();

    d_familia = $("#f_FichaTecnicaCrear #FicT_FamiliaN").val();
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
  
  $("body").on("submit", "#f_FichaTecnicaCrear", function (e) {
    e.preventDefault();

    d_planta = $("#f_FichaTecnicaCrear #Pla_Codigo").val();
    d_formato = $("#f_FichaTecnicaCrear #For_Codigo").val();
    d_familia = $("#f_FichaTecnicaCrear #FicT_FamiliaN").val();
    d_color = $("#f_FichaTecnicaCrear #FicT_Color").val();
    d_fechaEmision = $("#f_FichaTecnicaCrear #FicT_FecEmision").val();
    d_cicloHorno = $("#f_FichaTecnicaCrear #FicT_CicloHorno").val();
    d_nombreArchivo = $("#f_FichaTecnicaCrear #FicT_NombreArchivo").val();
    d_codigoFTClonar = $("#f_FichaTecnicaCrear #FichaTecnicaClonarN").val();
    d_confirClonar = $("#f_FichaTecnicaCrear #ClonarFTConfirmacionN").val();
    d_foto = $("#f_FichaTecnicaCrear #i_Arc_FT_Foto").val();
    d_fotoDos = $("#f_FichaTecnicaCrear #i_Arc_FT_FotoDos").val();

    $.ajax({
      type: "POST",
      url: "op_fichaTecnicaNCrear.php",
      beforeSend: function () {
        bloquearFormulario("f_FichaTecnicaCrear");
        $("#Btn_fichaTecnicaCrearForm").hide();
      },
      complete: function () {
        desbloquearFormulario("f_FichaTecnicaCrear");
        $("#Btn_fichaTecnicaCrearForm").show();
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
          $("#vtn_fichaTecnicaNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_fichaTecnicaNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');

        } else {
          $("#vtn_fichaTecnicaNotificacionesCrear").modal({
            backdrop: 'static'
          });
          $(".info_fichaTecnicaNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          mensaje('2', rs.mensaje);
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_fichaTecnicaNotificacionesCrear", function(e){
    e.preventDefault();
    
    $("#vtn_fichaTecnicaNotificacionesCrear").modal('hide');
    $("#vtn_fichaTecnicaCrear").modal('hide');
    
    d_plantas = $("#filtroFichaTecnicaN_Planta").val();
    d_formatos = $("#filtroFichaTecnicaN_Formatos").val();
    d_estado = $("#filtroFichaTecnicaN_Estado").val();
    d_familia = $("#filtroFichaTecnicaN_Familia").val();
    d_version = $("#filtroFichaTecnicaN_Version").val();
    d_fecha = $("#filtroFichaTecnicaN_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaNListar.php",
      beforeSend: function () {
        $(".info_FichaTecnicaNListar").html(loader());
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
        $(".info_FichaTecnicaNListar").html(data);
        $("#tbl_FichaTecnicaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", ".e_editarFichaTecnica", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_fichaTecnicaActualizar").modal({
      backdrop: 'static'
    });

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaNActualizar.php",
      beforeSend: function () {
        $(".info_fichaTecnicaActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_fichaTecnicaActualizar").html(data);
        //        $("#id_tabla").tablesorter();
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
      url: "op_fichaTecnicaNActualizar.php",
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
          $(".info_FichaTecnicaNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_FichaTecnicaNotificacionesActualizar").modal({
            backdrop: 'static'
          });
          $(".info_FichaTecnicaNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_FichaTecnicaActualizarForm", function (e) {
    e.preventDefault();
    $("#vtn_FichaTecnicaNotificacionesActualizar").modal('hide');
    $("#vtn_fichaTecnicaActualizar").modal('hide');

    d_plantas = $("#filtroFichaTecnicaN_Planta").val();
    d_formatos = $("#filtroFichaTecnicaN_Formatos").val();
    d_estado = $("#filtroFichaTecnicaN_Estado").val();
    d_familia = $("#filtroFichaTecnicaN_Familia").val();
    d_version = $("#filtroFichaTecnicaN_Version").val();
    d_fecha = $("#filtroFichaTecnicaN_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaNListar.php",
      beforeSend: function () {
        $(".info_FichaTecnicaNListar").html(loader());
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
        $(".info_FichaTecnicaNListar").html(data);
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
      url: "f_fichaTecnicaNCrearDetalle.php",
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
          url: "f_fichaTecnicaCrearAgrupacion.php",
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
            $('#fichaTecnica_Agrupacion' + d_tipo).multiselect({
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
            
            $('.SelEquiposFT').multiselect({
              includeSelectAllOption: true,
              enableFiltering: true,
              selectAllText: 'Seleccionar Todos',
              nonSelectedText: 'Seleccione...',
              nSelectedText: ' Todos',
              buttonWidth: '140px',
              enableCaseInsensitiveFiltering: true,
              maxHeight: 300,
              dropUp: true,
              numberDisplayed: 1
            });
          },
          error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
          }
        });
        //$("#Btn_FichaTecnicaNCrearAgrupacion").click();
        //        $("#id_tabla").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("click", "#Btn_FichaTecnicaNCrearAgrupacion2, #Btn_FichaTecnicaNCrearAgrupacion9, #Btn_FichaTecnicaNCrearAgrupacion5, #Btn_FichaTecnicaNCrearAgrupacion4, #Btn_FichaTecnicaNCrearAgrupacion13, #Btn_FichaTecnicaNCrearAgrupacion14", function(e){
    e.preventDefault();
    
    d_agrupacion = $("#fichaTecnica_Agrupacion" + d_tipo).val();
    d_tipo = $(this).attr("data-tip");
    d_codigo = $(this).attr("data-cod");
    d_formato = $(this).attr("data-for");
    d_planta = $(this).attr("data-pla");
    if(d_agrupacion == null){
      d_cantidad = "0"
    }else{
      d_cantidad = d_agrupacion.length;
    }
    
    
    if(d_cantidad != "0"){
      
      $(".cargar_AgrupacionTipo"+d_tipo).html('');
      $.ajax({
        type: "POST",
        url: "f_fichaTecnicaNCrearDetalleAreas.php",
        beforeSend: function () {
          $(".cargar_AgrupacionTipo"+d_tipo).html(loader());
        },
        data: {
          tipo: d_tipo,
          agrupacion: d_agrupacion,
          codigo: d_codigo,
          formato: d_formato,
          planta: d_planta
        },
        success: function (data) {
          $(".cargar_AgrupacionTipo"+d_tipo).html(data);
          $('.SelEquiposFT').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            selectAllText: 'Seleccionar Todos',
            nonSelectedText: 'Seleccione...',
            nSelectedText: ' Todos',
            buttonWidth: '140px', 
            enableCaseInsensitiveFiltering: true,
            maxHeight: 300,
            dropUp: true,
            numberDisplayed: 1
          });
        },
        error: function (er1, er2, er3) {
          console.log(er2 + "-" + er3);
        }
      });
    }else{
      $(".cargar_AgrupacionTipo"+d_tipo).html('<br><div class="alert alert-danger"> <strong>Por favor Seleccione una agrupación</strong> </div>');
    }
  });
  
  // Selección Menu
  $("body").on("click", ".Sel_FTDetalleCrear", function (e) {
    e.preventDefault();

    d_tipo = $(this).attr("data-tip");
    d_planta = $(this).attr("data-pla");
    d_codigo = $(this).attr("data-cod");
    d_formato = $(this).attr("data-form");
    d_posisionSc = $(this).attr("data-pos");
    
    // Validar Si hay o no Agrupaciones Creadas
    
    

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaCrearAgrupacion.php",
      beforeSend: function () {
        $(".e_cargarDetalleFT" + d_tipo).html(loader());
      },
      data: {
        tipo: d_tipo,
        planta: d_planta,
        codigo: d_codigo,
        formato: d_formato,
        posicion: d_posisionSc
      },
      success: function (data) {
        $(".e_cargarDetalleFT" + d_tipo).html(data);
        //setTimeout("$('#Btn_FichaTecnicaNCrearAgrupacion').click()",5000);
        $('#fichaTecnica_Agrupacion' + d_tipo).multiselect({
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
        
        $('.SelEquiposFT').multiselect({
          includeSelectAllOption: true,
          enableFiltering: true,
          selectAllText: 'Seleccionar Todos',
          nonSelectedText: 'Seleccione...',
          nSelectedText: ' Todos',
          buttonWidth: '140px',
          enableCaseInsensitiveFiltering: true,
          maxHeight: 300,
          dropUp: true,
          numberDisplayed: 1
        });
        //$('#Btn_FichaTecnicaNCrearAgrupacion'+d_tipo).click();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
//    $("#Btn_FichaTecnicaNCrearAgrupacion").click();

  });
  
  $("body").on("click", ".e_GuardarRegistroFT", function(e){
    e.preventDefault();
    
    d_con = $(this).attr("data-cont");
    d_tipo = $(this).attr("data-tip");
    d_accion = $(this).attr("data-acc");
	  
    $(".Cod_Contador").val(d_con);
    $(".Cod_Accion").val(d_accion);
    $(".Cod_Tipo").val(d_tipo);
    
    d_fichaTecnica = $("#FicT_Codigo").val();
    d_lista1 = []; 
    d_lista2 = []; 
    
    if(d_accion == "Act"){
      cont = 0; 
      $("#T"+d_tipo+"Maq_Codigo"+d_con+" :selected").each(function(){ 

       d_lista1[cont] = $(this).attr("data-coddft"); 
       d_lista2[cont] = $(this).val(); 
       cont++; 
      });
      d_num = cont;
      
    }else{
      if(d_accion == "crearAct"){
        cont = 0; 
        $("#TAct"+d_tipo+"Maq_Codigo"+d_con+" :selected").each(function(){ 

         d_lista1[cont] = $(this).attr("data-coddft"); 
         d_lista2[cont] = $(this).val(); 
         cont++; 
        });
        d_num = cont;
      }else{
        if(d_accion == "agregar"){
          cont = 0; 
          $("#A"+d_tipo+"Maq_Codigo"+d_con+" :selected").each(function(){ 

           d_lista1[cont] = $(this).attr("data-coddft"); // cod Detalle FT
           d_lista2[cont] = $(this).val(); // Máquina
           cont++; 
          });
          d_num = cont; 
        }else{
          cont = 0; 
          $("#TC"+d_tipo+"Maq_Codigo"+d_con+" :selected").each(function(){ 

           d_lista1[cont] = $(this).attr("data-coddft"); // cod Detalle FT
           d_lista2[cont] = $(this).val(); // Máquina
           cont++; 
          });
          d_num = cont; 
        }
      }
    }
    
    if(d_num != '0'){
      
      $(".alertaNoGuardadoFT").html('');
      
      if(d_accion == "Act"){
        d_agrVCon = $("#T"+d_tipo+"AgrVCon_Codigo"+d_con).val();
        d_agrM = $("#T"+d_tipo+"AgrM_Codigo"+d_con).val();
        d_tipoVariable = $("#T"+d_tipo+"DetFT_Tipo"+d_con).val();
        d_unidadMedida = $("#T"+d_tipo+"DetFT_UnidadMedida"+d_con).val();
        d_valorControl = $("#T"+d_tipo+"DetFT_ValorControl"+d_con).val();
        d_valorControlTexto = $("#T"+d_tipo+"DetFT_ValorControlTexto"+d_con).val();
        d_valorTolerancia = $("#T"+d_tipo+"DetFT_ValorTolerancia"+d_con).val();
        d_operador = $("#T"+d_tipo+"DetFT_Operador"+d_con).val();
        d_tomaVariable = $("#T"+d_tipo+"DetFT_TomaVariable"+d_con).val();
      }else{
        if(d_accion == "crearAct"){
          d_agrVCon = $("#TAct"+d_tipo+"AgrVCon_Codigo"+d_con).val();
          d_agrM = $("#TAct"+d_tipo+"AgrM_Codigo"+d_con).val();
          d_tipoVariable = $("#TAct"+d_tipo+"DetFT_Tipo"+d_con).val();
          d_unidadMedida = $("#TAct"+d_tipo+"DetFT_UnidadMedida"+d_con).val();
          d_valorControl = $("#TAct"+d_tipo+"DetFT_ValorControl"+d_con).val();
          d_valorControlTexto = $("#TAct"+d_tipo+"DetFT_ValorControlTexto"+d_con).val();
          d_valorTolerancia = $("#TAct"+d_tipo+"DetFT_ValorTolerancia"+d_con).val();
          d_operador = $("#TAct"+d_tipo+"DetFT_Operador"+d_con).val();
          d_tomaVariable = $("#TAct"+d_tipo+"DetFT_TomaVariable"+d_con).val();
        }else{
          if(d_accion == "agregar"){
            d_agrVCon = $("#A"+d_tipo+"AgrVCon_Codigo"+d_con).val();
            d_agrM = $("#A"+d_tipo+"AgrM_Codigo"+d_con).val();
            d_tipoVariable = $("#A"+d_tipo+"DetFT_Tipo"+d_con).val();
            d_unidadMedida = $("#A"+d_tipo+"DetFT_UnidadMedida"+d_con).val();
            d_valorControl = $("#A"+d_tipo+"DetFT_ValorControl"+d_con).val();
            d_valorControlTexto = $("#A"+d_tipo+"DetFT_ValorControlTexto"+d_con).val();
            d_valorTolerancia = $("#A"+d_tipo+"DetFT_ValorTolerancia"+d_con).val();
            d_operador = $("#A"+d_tipo+"DetFT_Operador"+d_con).val();
            d_tomaVariable = $("#A"+d_tipo+"DetFT_TomaVariable"+d_con).val();
          }else{
            d_agrVCon = $("#TC"+d_tipo+"AgrVCon_Codigo"+d_con).val();
            d_agrM = $("#TC"+d_tipo+"AgrM_Codigo"+d_con).val();
            d_tipoVariable = $("#TC"+d_tipo+"DetFT_Tipo"+d_con).val();
            d_unidadMedida = $("#TC"+d_tipo+"DetFT_UnidadMedida"+d_con).val();
            d_valorControl = $("#TC"+d_tipo+"DetFT_ValorControl"+d_con).val();
            d_valorControlTexto = $("#TC"+d_tipo+"DetFT_ValorControlTexto"+d_con).val();
            d_valorTolerancia = $("#TC"+d_tipo+"DetFT_ValorTolerancia"+d_con).val();
            d_operador = $("#TC"+d_tipo+"DetFT_Operador"+d_con).val();
            d_tomaVariable = $("#TC"+d_tipo+"DetFT_TomaVariable"+d_con).val();
          }
        } 
      }
      
      
      if(d_valorControl == null){
        $(".alertaNoGuardadoFT").html('<div class="alert alert-danger"> <strong>Por favor agregue información en el valor de control</strong> </div>');
      }else{
        if(d_valorTolerancia == null){
          $(".alertaNoGuardadoFT").html('<div class="alert alert-danger"> <strong>Por favor agregue información en el valor de tolerancia</strong> </div>');
        }else{
          $(".alertaNoGuardadoFT").html('');
          $.ajax({
            type:"POST",
            url:"op_fichaTecnicaNDetalleCrear.php",
            beforeSend: function() {
              bloquearFormulario("f_fichaTecnicaNCrearDetalleArea");
              $(".e_GuardarRegistroFT").hide();
            },
            complete: function() {
              desbloquearFormulario("f_fichaTecnicaNCrearDetalleArea");
              $(".e_GuardarRegistroFT").show();
            },
//            , agrMCon: d_agrMCon , codigo: d_codigo, maquina: d_maquina
            data: { num: d_num, lista1: d_lista1, agrVCon: d_agrVCon, tipoVariable: d_tipoVariable, unidadMedida: d_unidadMedida, valorControl: d_valorControl, valorControlTexto: d_valorControlTexto, tolerancia: d_valorTolerancia, operador: d_operador, tomaVariables: d_tomaVariable, fichaTecnica: d_fichaTecnica, tipo: d_tipo, agrupadorMaquinaCod: d_agrM, accion: d_accion, lista2: d_lista2 },
            dataType: 'json',
            success: function(rs) {
              if(rs.mensaje == "OK"){
                $("#vtn_FichaTecnicaGuardarNotificaciones").modal({backdrop: 'static'});
                $(".info_FichaTecnicaGuardarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Guardado Correctamente</h3>');
              }else{
                mensaje('2', rs.mensaje);
                $("#vtn_FichaTecnicaGuardarNotificaciones").modal({backdrop: 'static'});
                $(".info_FichaTecnicaGuardarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
              }
            },
            error: function(er1, er2, er3) {
              console.log(er2+"-"+er3);
            }
          });
        }
      }
      
    }else{
      $(".alertaNoGuardadoFT").html('<div class="alert alert-danger"> <strong>Por favor seleccione un equipo</strong> </div>');
    }
  });
  
  $("body").on("click", "#Btn_FichaTecnicaGuardarNotificaciones", function(e){
    e.preventDefault();
    
    $("#vtn_FichaTecnicaGuardarNotificaciones").modal('hide');
	  
	 d_contador = $(".Cod_Contador").val();
	 d_tipo = $(".Cod_Tipo").val();
	 d_accion = $(".Cod_Accion").val();
	 d_codigo = $(".e_GuardarRegistroFT").attr("data-cod");
    
     $.ajax({
      type:"POST",
      url:"f_fichaTecnicaNCrearDetalleAreas.php",
      beforeSend: function() {
        if(d_accion == "crearAct" || d_accion == "Act"){
          $(".codigoGuardarUnico"+d_tipo+d_contador).html("<td class='text-center vertical' align='center'><button type='button' class='btn btn-info btn-xs' disabled><span class='glyphicon glyphicon-floppy-disk'></span></button></td>");
        }else{
          $(".codigoGuardarUnicoCrear"+d_tipo+d_contador).html("<td class='text-center vertical' align='center'><button type='button' class='btn btn-info btn-xs' disabled><span class='glyphicon glyphicon-floppy-disk'></span></button></td>");
        }
      },
      data:{ contador: d_contador, tipo: d_tipo, accion: d_accion, codigo : d_codigo },
      success: function(data) {
        
        $(".codigoGuardarUnico"+d_tipo+d_contador).removeAttr("disabled", "false");
        $(".codigoGuardarUnicoCrear"+d_tipo+d_contador).removeAttr("disabled", "false");
        
        if(d_accion == "crearAct"){
          
          $(".codigoGuardarUnico"+d_tipo+d_contador).html();
          $(".codigoGuardarUnico"+d_tipo+d_contador).html('<button type="button" class="btn btn-success btn-xs e_GuardarRegistroFT" data-cont='+d_contador+' data-tip='+d_tipo+' data-acc="Act" data-cod= "" disabled><span class="glyphicon glyphicon-floppy-saved"></span></button>');
          $("#TAct"+d_tipo+"DetFT_ValorControl"+d_contador).attr("disabled", true);
          $("#TAct"+d_tipo+"DetFT_Operador"+d_contador).attr("disabled", true);
          $("#TAct"+d_tipo+"DetFT_ValorTolerancia"+d_contador).attr("disabled", true);
          $("#TAct"+d_tipo+"DetFT_ValorControlTexto"+d_contador).attr("disabled", true);
          $("#TAct"+d_tipo+"Maq_Codigo"+d_contador).attr("disabled", true);
          
        }else{
          
          if(d_accion == "Act"){
            $(".codigoGuardarUnico"+d_tipo+d_contador).html();
            $(".codigoGuardarUnico"+d_tipo+d_contador).html('<button type="button" class="btn btn-success btn-xs e_GuardarRegistroFT" data-cont='+d_contador+' data-tip='+d_tipo+' data-acc="Act" data-cod= "" disabled><span class="glyphicon glyphicon-floppy-saved"></span></button>');
            $("#T"+d_tipo+"DetFT_ValorControl"+d_contador).attr("disabled", true);
            $("#T"+d_tipo+"DetFT_Operador"+d_contador).attr("disabled", true);
            $("#T"+d_tipo+"DetFT_ValorTolerancia"+d_contador).attr("disabled", true);
            $("#T"+d_tipo+"DetFT_ValorControlTexto"+d_contador).attr("disabled", true);
            $("#T"+d_tipo+"Maq_Codigo"+d_contador).attr("disabled", true);
          }else{
            
            if(d_accion == "crear"){
              $(".codigoGuardarUnicoCrear"+d_tipo+d_contador).html();
              $(".codigoGuardarUnicoCrear"+d_tipo+d_contador).html('<button type="button" class="btn btn-success btn-xs e_GuardarRegistroFT" data-cont='+d_contador+' data-tip='+d_tipo+' data-acc="Act" data-cod= "" disabled><span class="glyphicon glyphicon-floppy-saved"></span></button>');
              $("#TC"+d_tipo+"DetFT_ValorControl"+d_contador).attr("disabled", true);
              $("#TC"+d_tipo+"DetFT_Operador"+d_contador).attr("disabled", true);
              $("#TC"+d_tipo+"DetFT_ValorTolerancia"+d_contador).attr("disabled", true);
              $("#TC"+d_tipo+"DetFT_ValorControlTexto"+d_contador).attr("disabled", true);
              $("#TC"+d_tipo+"Maq_Codigo"+d_contador).attr("disabled", true);
            }else{
              if(d_accion == "agregar"){
                $(".codigoGuardarUnicoAgregar"+d_tipo+d_contador).html();
                $(".codigoGuardarUnicoAgregar"+d_tipo+d_contador).html('<button type="button" class="btn btn-success btn-xs e_GuardarRegistroFT" data-cont='+d_contador+' data-tip='+d_tipo+' data-acc="Act" data-cod= "" disabled><span class="glyphicon glyphicon-floppy-saved"></span></button>');
                $("#A"+d_tipo+"DetFT_ValorControl"+d_contador).attr("disabled", true);
                $("#A"+d_tipo+"DetFT_Operador"+d_contador).attr("disabled", true);
                $("#A"+d_tipo+"DetFT_ValorTolerancia"+d_contador).attr("disabled", true);
                $("#A"+d_tipo+"DetFT_ValorControlTexto"+d_contador).attr("disabled", true);
                $("#A"+d_tipo+"Maq_Codigo"+d_contador).attr("disabled", true);
              }
            }
          }
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
  $("body").on("click", ".e_EditarRegistroFT", function(e){
    e.preventDefault();
    
     $("#vtn_FichaTecnicaNActualizar").modal({
      backdrop: 'static'
    });
    
    d_variable = $(this).attr("data-var");
    d_fichaTecnica = $(this).attr("data-ft");
    d_tipo = $(this).attr("data-tip");
    d_accion = $(this).attr("data-acc");
    d_agrupacionMaq = $(this).attr("data-agrM");
    d_planta = $(this).attr("data-pla");
    d_efecto = $(this).attr("data-efec");
    
    if(d_efecto == "" || d_efecto == null){
      d_efecto = "";
    }
    
    $.ajax({
      type:"POST",
      url:"f_fichaTecnicaNActualizarDetalleAreas.php",
      beforeSend: function() {
        $(".info_FichaTecnicaNActualizar").html(loader());
      },
      data:{ variable: d_variable, fichaTecnica: d_fichaTecnica, tipo: d_tipo, accion: d_accion, agrupacion : d_agrupacionMaq, planta: d_planta, efecto: d_efecto },
      success: function(data) {
        $(".info_FichaTecnicaNActualizar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", ".e_GuardarRegistroFTVariable", function(e){
    e.preventDefault();
    
    $("#vtn_FichaTecnicaGuardarConfirmacionNotificaciones").modal({
      backdrop: 'static'
    });
    
    d_con = $(this).attr("data-cont");
    d_tipo = $(this).attr("data-tip");
    d_accion = $(this).attr("data-acc");
    d_codigo = $(this).attr("data-cod");
    
    d_unidadMedida = $("#Act"+d_tipo+"DetFT_UnidadMedida"+d_con).val();
    d_valorControl = $("#Act"+d_tipo+"DetFT_ValorControl"+d_con).val();
    d_valorControlTexto = $("#Act"+d_tipo+"DetFT_ValorControlTexto"+d_con).val();
    d_valorTolerancia = $("#Act"+d_tipo+"DetFT_ValorTolerancia"+d_con).val();
    d_operador = $("#Act"+d_tipo+"DetFT_Operador"+d_con).val();
    d_tomaVariable = $("#Act"+d_tipo+"DetFT_TomaVariable"+d_con).val();
    d_tipoVariable = $("#Act"+d_tipo+"DetFT_Tipo"+d_con).val();
    
    $(".GuardarConfirmacion_contador").val(d_con);
    $(".GuardarConfirmacion_tipo").val(d_tipo);
    $(".GuardarConfirmacion_accion").val(d_accion);
    $(".GuardarConfirmacion_codigo").val(d_codigo);
    $(".GuardarConfirmacion_unidadMedida").val(d_unidadMedida);
    $(".GuardarConfirmacion_valorControl").val(d_valorControl);
    $(".GuardarConfirmacion_valorControlTexto").val(d_valorControlTexto);
    $(".GuardarConfirmacion_valorTolerancia").val(d_valorTolerancia);
    $(".GuardarConfirmacion_operador").val(d_operador);
    $(".GuardarConfirmacion_tomaVariable").val(d_tomaVariable);
    $(".GuardarConfirmacion_tipoVariable").val(d_tipoVariable);
   
  });
  
   $("body").on("click", "#Btn_FichaTecnicaGuardarConfirmacionNotificaciones", function(e){
    e.preventDefault();
     
      $("#vtn_FichaTecnicaGuardarConfirmacionNotificaciones").modal('hide');

      d_con = $(".GuardarConfirmacion_contador").val();
      d_tipo = $(".GuardarConfirmacion_tipo").val();
      d_accion = $(".GuardarConfirmacion_accion").val();
      d_codigo = $(".GuardarConfirmacion_codigo").val();

      d_unidadMedida = $(".GuardarConfirmacion_unidadMedida").val();
      d_valorControl = $(".GuardarConfirmacion_valorControl").val();
      d_valorControlTexto = $(".GuardarConfirmacion_valorControlTexto").val();
      d_valorTolerancia = $(".GuardarConfirmacion_valorTolerancia").val();
      d_operador = $(".GuardarConfirmacion_operador").val();
      d_tomaVariable = $(".GuardarConfirmacion_tomaVariable").val();
      d_tipoVariable = $(".GuardarConfirmacion_tipoVariable").val();
    
      $.ajax({
      type:"POST",
      url:"op_fichaTecnicaNDetalleActualizar.php",
      beforeSend: function() {
        bloquearFormulario("f_FTNActualizarDetalleAreas");
        $(".e_GuardarRegistroFTVariable").hide();
      },
      complete: function() {
        desbloquearFormulario("f_FTNActualizarDetalleAreas");
        $(".e_GuardarRegistroFTVariable").show();
      },
      data: { unidadMedida: d_unidadMedida, valorControl: d_valorControl, valorControlTexto: d_valorControlTexto, valorTolerancia: d_valorTolerancia, operador: d_operador, tomaVariables: d_tomaVariable, tipoVariable: d_tipoVariable, codigo: d_codigo, accion: d_accion },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_AgrupacionesMaquinasNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_AgrupacionesMaquinasActualizarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_AgrupacionesMaquinasNotificacionesActualizar").modal({backdrop: 'static'});
          $(".info_AgrupacionesMaquinasActualizarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
  $("body").on("click", "#Btn_AgrupacionesMaquinasNotificacionesActualizar", function(e){
    e.preventDefault();
    
    $("#vtn_AgrupacionesMaquinasNotificacionesActualizar").modal('hide');
    
    d_variable = $("#f_FTNActualizarDetalleAreas #variableFTAct").val();
    d_fichaTecnica = $("#f_FTNActualizarDetalleAreas #FTAct").val();
    d_tipo = $("#f_FTNActualizarDetalleAreas #tipoFTAct").val();
    d_accion = $("#f_FTNActualizarDetalleAreas #accionFTAct").val();
    d_agrupacionMaq = $("#f_FTNActualizarDetalleAreas #agrupacionFTAct").val();
    d_planta = $("#f_FTNActualizarDetalleAreas #plantaFTAct").val();
    
    $.ajax({
      type:"POST",
      url:"f_fichaTecnicaNActualizarDetalleAreas.php",
      beforeSend: function() {
        $(".info_FichaTecnicaNActualizar").html(loader());
      },
      data:{ variable: d_variable, fichaTecnica: d_fichaTecnica, tipo: d_tipo, accion: d_accion, agrupacion : d_agrupacionMaq, planta: d_planta },
      success: function(data) {
        $(".info_FichaTecnicaNActualizar").html(data);
        $("#Btn_FichaTecnicaNCrearAgrupacion"+d_tipo).click();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", ".e_EliminarRegistroFTVariable", function(e){
    e.preventDefault();
    
     d_codigo = $(this).attr("data-cod");
    
     $("#vtn_FichaTecnicaNActualizarDetalleAreasConfirmacionNotificacionesEliminar").modal({
      backdrop: 'static'
     });
    
    $(".Cod_DetalleFTEliminar").val(d_codigo);
    
  });
  
  $("body").on("click", "#Btn_FichaTecnicaNActualizarDetalleAreasConfirmacionNotificacionesEliminar", function(e){
    e.preventDefault();
    
    $("#vtn_FichaTecnicaNActualizarDetalleAreasConfirmacionNotificacionesEliminar").modal('hide');
    d_codigo = $(".Cod_DetalleFTEliminar").val();
    
    $.ajax({
      type:"POST",
      url:"op_fichaTecnicaNDetalleEliminar.php",
      beforeSend: function() {
        bloquearFormulario("f_FTNActualizarDetalleAreas");
        $(".e_EliminarRegistroFTVariable").hide();
      },
      complete: function() {
        desbloquearFormulario("f_FTNActualizarDetalleAreas");
        $(".e_EliminarRegistroFTVariable").show();
      },
      data: { codigo: d_codigo },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_FichaTecnicaNActualizarDetalleAreasNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_FichaTecnicaNActualizarDetalleAreasEliminarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_FichaTecnicaNActualizarDetalleAreasNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_FichaTecnicaNActualizarDetalleAreasEliminarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_FichaTecnicaNActualizarDetalleAreasNotificacionesEliminar", function(e){
    e.preventDefault();
    
    $("#vtn_FichaTecnicaNActualizarDetalleAreasNotificacionesEliminar").modal('hide');
    
    d_variable = $("#f_FTNActualizarDetalleAreas #variableFTAct").val();
    d_fichaTecnica = $("#f_FTNActualizarDetalleAreas #FTAct").val();
    d_tipo = $("#f_FTNActualizarDetalleAreas #tipoFTAct").val();
    d_accion = $("#f_FTNActualizarDetalleAreas #accionFTAct").val();
    d_agrupacionMaq = $("#f_FTNActualizarDetalleAreas #agrupacionFTAct").val();
    d_planta = $("#f_FTNActualizarDetalleAreas #plantaFTAct").val();
    
    $.ajax({
      type:"POST",
      url:"f_fichaTecnicaNActualizarDetalleAreas.php",
      beforeSend: function() {
        $(".info_FichaTecnicaNActualizar").html(loader());
      },
      data:{ variable: d_variable, fichaTecnica: d_fichaTecnica, tipo: d_tipo, accion: d_accion, agrupacion : d_agrupacionMaq, planta: d_planta },
      success: function(data) {
        $(".info_FichaTecnicaNActualizar").html(data);
        $("#Btn_FichaTecnicaNCrearAgrupacion"+d_tipo).click();
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
  $("body").on("click", ".e_AgregarRegistroFT", function(e){
    e.preventDefault();
    
    d_tipo = $(this).attr("data-tip");
    d_maquina = $(this).attr("data-maq");
    d_variable = $(this).attr("data-var");
    d_planta = $(this).attr("data-pla");
    d_tipoVariable = $(this).attr("data-tipVar");
    d_unidadMedida = $(this).attr("data-uni");
    d_monitorea = $(this).attr("data-mon");
    d_contador = $("#contadorFinal").val();
    d_formato = $(this).attr("data-for");
    
    d_fichaTecnica = $("#FicT_Codigo").val();
    
    $.ajax({
      type:"POST",
      url:"f_fichaTecnicaNAgregarDetalleAreas.php",
      beforeSend: function() {
        $(".e_cargarDuplicadoVariable"+d_tipo).html(loader());
      },
      data:{ tipo: d_tipo, maquina: d_maquina, variable: d_variable, planta: d_planta, fichaTecnica: d_fichaTecnica, tipoVariable: d_tipoVariable, unidadMedida: d_unidadMedida, monitorea: d_monitorea, contador: d_contador, formato: d_formato },
      success: function(data) {
        $(".e_cargarDuplicadoVariable"+d_tipo).html(data);
        $('.SelEquiposFT').multiselect({
          includeSelectAllOption: true,
          enableFiltering: true,
          selectAllText: 'Seleccionar Todos',
          nonSelectedText: 'Seleccione...',
          nSelectedText: ' Todos',
          buttonWidth: '140px',
          enableCaseInsensitiveFiltering: true,
          maxHeight: 300,
          dropUp: true,
          numberDisplayed: 1
        });
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("change", "#ClonarFTConfirmacionN", function (e) {
    e.preventDefault();

    d_clonar = $("#ClonarFTConfirmacionN").val();
    d_formato = $("#f_FichaTecnicaCrear #For_Codigo").val();

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaClonarN.php",
      beforeSend: function () {
        $(".e_clonarFichaTecnica").html(loader());
      },
      data: {
        clonar: d_clonar,
        formato: d_formato
      },
      success: function (data) {
        $(".e_clonarFichaTecnica").html(data);
        $('#FichaTecnicaClonarN').multiselect({
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
      url: "op_fichaTecnicaNFinalizar.php",
      beforeSend: function () {
        $("#Btn_FichaTecnicaFinalizarForm").hide();
        $("#vtn_FTNotificacionFinalizar").modal({
          backdrop: 'static'
        });
        $(".info_FTNotificacionFinalizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Procesando...<br><br>No actualice ni cargue la página mientras finaliza el proceso</h3>');
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
          $("#Btn_FTNotificacionFinalizar").show();
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
    
    d_plantas = $("#filtroFichaTecnicaN_Planta").val();
    d_formatos = $("#filtroFichaTecnicaN_Formatos").val();
    d_estado = $("#filtroFichaTecnicaN_Estado").val();
    d_familia = $("#filtroFichaTecnicaN_Familia").val();
    d_version = $("#filtroFichaTecnicaN_Version").val();
    d_fecha = $("#filtroFichaTecnicaN_Fecha").val();

    $.ajax({
      type: "POST",
      url: "f_fichaTecnicaNListar.php",
      beforeSend: function () {
        $(".info_FichaTecnicaNListar").html(loader());
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
        $(".info_FichaTecnicaNListar").html(data);
        $("#tbl_FichaTecnicaListar").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });

  });
  
  $("body").on("click", ".pdf_exportarFTN", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");
    d_planta = $(this).attr("data-pla");
    d_formato = $(this).attr("data-form");
    d_fechaEmision = $(this).attr("data-fecha");
    d_productoColor = $(this).attr("data-prod");

    window.location.href = "pdfFTN.php?codigo=" + d_codigo + "&planta=" + d_planta + "&formato=" + d_formato + "&fecha=" + d_fechaEmision + "&producto=" + d_productoColor;

  });
  
  $("body").on("click", ".e_cargarEliminarFotoFT", function(e){
    e.preventDefault();
  
    d_codigo = $(this).attr("data-cod");
    d_foto = $(this).attr("data-tip");
    
    $("#vtn_FichaTecnicaEliminarImagenConfirmacion").modal({
      backdrop: 'static'
    });
    
    $(".Cod_FichaTecnicaEliminarImagen").val(d_codigo);
    $(".Cod_Imagen").val(d_foto);  
    
  });
  
  $("body").on("click", "#Btn_FichaTecnicaEliminarImagenConfirmacionForm", function(e){
    e.preventDefault();
  
    d_codigo = $(".Cod_FichaTecnicaEliminarImagen").val();
    d_foto = $(".Cod_Imagen").val();
    
    $("#vtn_FichaTecnicaEliminarImagenConfirmacion").modal('hide');
    
    $.ajax({
      type:"POST",
      url:"op_fichaTecnicaNEliminarFoto.php",
      beforeSend: function() {
        $(".e_cargarEliminarFotoFT").hide();
      },
      complete: function() {
        $(".e_cargarEliminarFotoFT").show();
      },
      data: { codigo: d_codigo, foto: d_foto },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_FichaTecnicaEliminarImagenNotificaciones").modal({backdrop: 'static'});
          $(".info_FichaTecnicaEliminarImagenNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_FichaTecnicaEliminarImagenNotificaciones").modal({backdrop: 'static'});
          $(".info_FichaTecnicaEliminarImagenNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
    
  });
  
  $("body").on("click", "#Btn_FichaTecnicaEliminarImagenNotificaciones", function(e){
    e.preventDefault();
    
      $("#vtn_FichaTecnicaEliminarImagenNotificaciones").modal('hide');
    
      d_codigo = $("#f_FichaTecnicaActualizar #codigoAct").val();
    
      $.ajax({
      type: "POST",
      url: "f_fichaTecnicaNActualizar.php",
      beforeSend: function () {
        $(".info_fichaTecnicaActualizar").html(loader());
      },
      data: {
        codigo: d_codigo
      },
      success: function (data) {
        $(".info_fichaTecnicaActualizar").html(data);
        //        $("#id_tabla").tablesorter();
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  
  });
  
  $("body").on("click", ".e_guardarObservacion2, .e_guardarObservacion9, .e_guardarObservacion5, .e_guardarObservacion4", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    d_tipo = $(this).attr("data-tip");
    d_codigoObseravcion = $(this).attr("data-codObs");
    d_observacion = $("#ft_pdf_Observaciones"+d_tipo).val();
    
    $.ajax({
      type:"POST",
      url:"op_fichaTecnicaNGuardarObservacion.php",
      beforeSend: function() {
        $(".e_guardarObservacion"+d_tipo).hide();
      },
      complete: function() {
        $(".e_guardarObservacion"+d_tipo).show();
      },
      data: { codigo: d_codigo, tipo:d_tipo, observacion: d_observacion, codObservacion: d_codigoObseravcion },
      dataType: 'json',
      success: function(rs) {
        if(rs.mensaje == "OK"){
          $("#vtn_FTGuardarObservacionNotificaciones").modal({backdrop: 'static'});
          $(".info_FTGuardarObservacionNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Guardado Correctamente</h3>');
        }else{
          mensaje('2', rs.mensaje);
          $("#vtn_FTGuardarObservacionNotificaciones").modal({backdrop: 'static'});
          $(".info_FTGuardarObservacionNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
        }
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_FTGuardarObservacionNotificaciones", function(e){
    e.preventDefault();
    
    $("#vtn_FTGuardarObservacionNotificaciones").modal('hide');
  
  });
  
  $("body").on("change", ".Inp_ValorTipoEfecto", function(e){
    e.preventDefault();
    
    d_tipoEfecto = $(this).val();
    d_tipoEfectoAgr = $(this).attr("data-opec");
    d_planta = $(this).attr("data-pla");
    d_id = $(".e_cargarListadoInsumos"+d_tipoEfectoAgr).attr("data-ins");
    
    $.ajax({
      type:"POST",
      url:"f_cargarFTNInsumo.php",
      beforeSend: function() {
        $(".e_cargarListadoInsumos"+d_tipoEfectoAgr).html(loader());
      },
      data:{ efecto: d_tipoEfecto, id:d_id, planta: d_planta },
      success: function(data) {
        $(".e_cargarListadoInsumos"+d_tipoEfectoAgr).html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  }); 
  
  
  $("body").on("change", ".Inp_ValorTipoEfectoAct", function(e){
    e.preventDefault();
    
    d_tipoEfecto = $(this).val();
    d_tipoEfectoAgr = $(this).attr("data-opec");
    d_planta = $(this).attr("data-pla");
    d_id = $(".e_cargarListadoInsumosAct"+d_tipoEfectoAgr).attr("data-ins");
    
    $.ajax({
      type:"POST",
      url:"f_cargarFTNInsumo.php",
      beforeSend: function() {
        $(".e_cargarListadoInsumosAct"+d_tipoEfectoAgr).html(loader());
      },
      data:{ efecto: d_tipoEfecto, id:d_id, planta: d_planta },
      success: function(data) {
        $(".e_cargarListadoInsumosAct"+d_tipoEfectoAgr).html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });
  }); 
  
  $("body").on("change", ".Inp_ValorTipoEfectoAgr", function(e){
    e.preventDefault();
    
    d_tipoEfecto = $(this).val();
    d_tipoEfectoAgr = $(this).attr("data-opec");
    d_planta = $(this).attr("data-pla");
    d_id = $(".e_cargarListadoInsumosAgr"+d_tipoEfectoAgr).attr("data-ins");
    
    $.ajax({
      type:"POST",
      url:"f_cargarFTNInsumo.php",
      beforeSend: function() {
        $(".e_cargarListadoInsumoAgr"+d_tipoEfectoAgr).html(loader());
      },
      data:{ efecto: d_tipoEfecto, id:d_id, planta: d_planta },
      success: function(data) {
        $(".e_cargarListadoInsumosAgr"+d_tipoEfectoAgr).html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
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

    $("#Btn_FichaTecnicaNBuscar").click();

  });

});