$(document).ready(function(e) {
    $('#filtroHealthCheck_Area').multiselect({
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
  
  $('#filtroHealthCheck_Producto').multiselect({
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
  
  d_fechaI = $("#filtroHealthCheck_FechaI").val();
  d_fechaF = $("#filtroHealthCheck_FechaF").val();
  d_area = $("#filtroHealthCheck_Area").val();
  d_referencia = $("#filtroHealthCheck_Producto").val();

  $.ajax({
    type:"POST",
    url:"f_healthCheckListar.php",
    beforeSend: function() {
      $(".info_HealthCheckListar").html(loader());
    },
    data:{ 
      fechaI: d_fechaI,
      fechaF: d_fechaF,
      area: d_area,
      referencia: d_referencia
    },
    success: function(data) {
      $(".info_HealthCheckListar").html(data);
    },
    error: function(er1, er2, er3) {
      console.log(er2+"-"+er3);
    }
  });
  
  $("body").on("click", "#Btn_HealthCheckBuscar", function(e){
    e.preventDefault();
    
    d_fechaI = $("#filtroHealthCheck_FechaI").val();
    d_fechaF = $("#filtroHealthCheck_FechaF").val();
    d_area = $("#filtroHealthCheck_Area").val();
    d_referencia = $("#filtroHealthCheck_Producto").val();
    
    $.ajax({
      type:"POST",
      url:"f_healthCheckListar.php",
      beforeSend: function() {
        $(".info_HealthCheckListar").html(loader());
      },
      data:{ 
        fechaI: d_fechaI,
        fechaF: d_fechaF,
        area: d_area,
        referencia: d_referencia
      },
      success: function(data) {
        $(".info_HealthCheckListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });    
  });
  
  $("body").on("click", "#Btn_HealthCheckCrear", function(e){
    e.preventDefault();
    
    $("#vtn_HealthCheckCrear").modal({
      backdrop: 'static'
    });
    $.ajax({
      type:"POST",
      url:"f_healthCheckCrear.php",
      beforeSend: function() {
        $(".info_HealthCheckCrear").html(loader());
      },
      data:{  },
      success: function(data) {
        $(".info_HealthCheckCrear").html(data);
        $('#Ref_Codigo').multiselect({
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
  
  $("body").on("change", "#HeaC_Area", function(e){
    e.preventDefault();
    d_area = $("#HeaC_Area").val();
    if(d_area == "Horno"){
      $.ajax({
        type:"POST",
        url:"f_cargarHornosHealthCheck.php",
        beforeSend: function() {
          $(".e_cargarHornos").html(loader());
        },
        data:{  },
        success: function(data) {
          $(".e_cargarHornos").html(data);
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
    }else{
      $(".e_cargarHornos").html('<tr class="e_cargarHornos"></tr>');
    }    
  });
  
  $("body").on("change", "#f_healthCheckCrear #HeaC_Operador1", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Operador1").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario1").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario1").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario1").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario1").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Operador2", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Operador2").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario2").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario2").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario2").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario2").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Operador3", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Operador3").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario3").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario3").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario3").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario3").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Operador4", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Operador4").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario4").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario4").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario4").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario4").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Operador5", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Operador5").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario5").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario5").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario5").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario5").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Operador6", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Operador6").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario6").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario6").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario6").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario6").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Operador7", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Operador7").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario7").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario7").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario7").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario7").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Operador8", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Operador8").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario8").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario8").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario8").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario8").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Supervisor1", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Supervisor1").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario9").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario9").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario9").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario9").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Supervisor2", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Supervisor2").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario10").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario10").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario10").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario10").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Supervisor3", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Supervisor3").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario11").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario11").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario11").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario11").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Supervisor4", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Supervisor4").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario12").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario12").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario12").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario12").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Supervisor5", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Supervisor5").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario13").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario13").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario13").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario13").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_Supervisor6", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_Supervisor6").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario14").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario14").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario14").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario14").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_jefe1", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_jefe1").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario15").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario15").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario15").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario15").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckCrear #HeaC_jefe2", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckCrear #HeaC_jefe2").prop("checked") == false) {
      $("#f_healthCheckCrear #HeaC_Comentario16").attr("required", true);
      $("#f_healthCheckCrear #HeaC_Comentario16").css("border", "2px solid red");
    } else {
      $("#f_healthCheckCrear #HeaC_Comentario16").removeAttr("required");
      $("#f_healthCheckCrear #HeaC_Comentario16").css("border", "#ccc");
    }

  });

  $("body").on("submit", "#f_healthCheckCrear", function(e){
    e.preventDefault();
    
    d_fecha = $("#f_healthCheckCrear #HeaC_fecha").val();
    d_referencia = $("#f_healthCheckCrear #Ref_Codigo").val();
    d_proceso = $("#f_healthCheckCrear #HeaC_ProcesoEvaluar").val();
    d_supervisor = $("#f_healthCheckCrear #HeaC_Supervisor").val();
    d_area = $("#f_healthCheckCrear #HeaC_Area").val();
    d_horno = $("#f_healthCheckCrear #HeaC_Horno").val();
    d_operadorHC = $("#f_healthCheckCrear #Usu_CodigoHC").val();
    if ($("#f_healthCheckCrear #HeaC_Operador1").prop("checked") == true) {
      d_operador1 = 1;
    } else {
      d_operador1 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Operador2").prop("checked") == true) {
      d_operador2 = 1;
    } else {
      d_operador2 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Operador3").prop("checked") == true) {
      d_operador3 = 1;
    } else {
      d_operador3 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Operador4").prop("checked") == true) {
      d_operador4 = 1;
    } else {
      d_operador4 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Operador5").prop("checked") == true) {
      d_operador5 = 1;
    } else {
      d_operador5 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Operador6").prop("checked") == true) {
      d_operador6 = 1;
    } else {
      d_operador6 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Operador7").prop("checked") == true) {
      d_operador7 = 1;
    } else {
      d_operador7 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Operador8").prop("checked") == true) {
      d_operador8 = 1;
    } else {
      d_operador8 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Supervisor1").prop("checked") == true) {
      d_supervisor1 = 1;
    } else {
      d_supervisor1 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Supervisor2").prop("checked") == true) {
      d_supervisor2 = 1;
    } else {
      d_supervisor2 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Supervisor3").prop("checked") == true) {
      d_supervisor3 = 1;
    } else {
      d_supervisor3 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Supervisor4").prop("checked") == true) {
      d_supervisor4 = 1;
    } else {
      d_supervisor4 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Supervisor5").prop("checked") == true) {
      d_supervisor5 = 1;
    } else {
      d_supervisor5 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_Supervisor6").prop("checked") == true) {
      d_supervisor6 = 1;
    } else {
      d_supervisor6 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_jefe1").prop("checked") == true) {
      d_jefe1 = 1;
    } else {
      d_jefe1 = 0;
    }
    if ($("#f_healthCheckCrear #HeaC_jefe2").prop("checked") == true) {
      d_jefe2 = 1;
    } else {
      d_jefe2 = 0;
    }
    d_comentarios = $("#f_healthCheckCrear #HeaC_Comentarios").val();
    d_comentarios1 = $("#f_healthCheckCrear #HeaC_Comentario1").val();
    d_comentarios2 = $("#f_healthCheckCrear #HeaC_Comentario2").val();
    d_comentarios3 = $("#f_healthCheckCrear #HeaC_Comentario3").val();
    d_comentarios4 = $("#f_healthCheckCrear #HeaC_Comentario4").val();
    d_comentarios5 = $("#f_healthCheckCrear #HeaC_Comentario5").val();
    d_comentarios6 = $("#f_healthCheckCrear #HeaC_Comentario6").val();
    d_comentarios7 = $("#f_healthCheckCrear #HeaC_Comentario7").val();
    d_comentarios8 = $("#f_healthCheckCrear #HeaC_Comentario8").val();
    d_comentarios9 = $("#f_healthCheckCrear #HeaC_Comentario9").val();
    d_comentarios10 = $("#f_healthCheckCrear #HeaC_Comentario10").val();
    d_comentarios11 = $("#f_healthCheckCrear #HeaC_Comentario11").val();
    d_comentarios12 = $("#f_healthCheckCrear #HeaC_Comentario12").val();
    d_comentarios13 = $("#f_healthCheckCrear #HeaC_Comentario13").val();
    d_comentarios14 = $("#f_healthCheckCrear #HeaC_Comentario14").val();
    d_comentarios15 = $("#f_healthCheckCrear #HeaC_Comentario15").val();
    d_comentarios16 = $("#f_healthCheckCrear #HeaC_Comentario16").val();
    
    if(d_referencia != ""){
      $.ajax({
        type:"POST",
        url:"op_heathCheckCrear.php",
        beforeSend: function() {
          bloquearFormulario("f_healthCheckCrear");
          $("#Btn_HealthCheckCrearForm").hide();
        },
        complete: function() {
          desbloquearFormulario("f_healthCheckCrear");
          $("#Btn_HealthCheckCrearForm").show();
        },
        data: { 
          fecha: d_fecha,
          proceso: d_proceso,
          supervisor: d_supervisor,
          area: d_area,
          horno: d_horno,
          operador1: d_operador1,
          operador2: d_operador2,
          operador3: d_operador3,
          operador4: d_operador4,
          operador5: d_operador5,
          operador6: d_operador6,
          operador7: d_operador7,
          operador8: d_operador8,
          supervisor1: d_supervisor1,
          supervisor2: d_supervisor2,
          supervisor3: d_supervisor3,
          supervisor4: d_supervisor4,
          supervisor5: d_supervisor5,
          supervisor6: d_supervisor6,
          jefe1: d_jefe1,
          jefe2: d_jefe2,
          comentarios: d_comentarios,
          comentarios1: d_comentarios1,
          comentarios2: d_comentarios2,
          comentarios3: d_comentarios3,
          comentarios4: d_comentarios4,
          comentarios5: d_comentarios5,
          comentarios6: d_comentarios6,
          comentarios7: d_comentarios7,
          comentarios8: d_comentarios8,
          comentarios9: d_comentarios9,
          comentarios10: d_comentarios10,
          comentarios11: d_comentarios11,
          comentarios12: d_comentarios12,
          comentarios13: d_comentarios13,
          comentarios14: d_comentarios14,
          comentarios15: d_comentarios15,
          comentarios16: d_comentarios16,
          referencia: d_referencia,
          operador: d_operadorHC
        },
        dataType: 'json',
        success: function(rs) {
          if(rs.mensaje == "OK"){
            $("#vtn_HealthCheckNotificacionesCrear").modal({backdrop: 'static'});
            $(".info_HealthCheckNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
          }else{
            mensaje('2', rs.mensaje);
            $("#vtn_HealthCheckNotificacionesCrear").modal({backdrop: 'static'});
            $(".info_HealthCheckNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
          }
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });   
    }else{
      $(".referenciaObligatoria").html('<div class="alert alert-danger"> <strong>Por favor seleccione una referencia</strong> </div>'); 
    }
    
  });
  
  $("body").on("click", "#Btn_HealthCheckNotificacionesCrear", function(e){
    e.preventDefault();
    $("#vtn_HealthCheckNotificacionesCrear").modal('hide');
    $("#vtn_HealthCheckCrear").modal('hide');
    
    d_fechaI = $("#filtroHealthCheck_FechaI").val();
    d_fechaF = $("#filtroHealthCheck_FechaF").val();
    d_area = $("#filtroHealthCheck_Area").val();
    
    $.ajax({
      type:"POST",
      url:"f_healthCheckListar.php",
      beforeSend: function() {
        $(".info_HealthCheckListar").html(loader());
      },
      data:{ 
        fechaI: d_fechaI,
        fechaF: d_fechaF,
        area: d_area
      },
      success: function(data) {
        $(".info_HealthCheckListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });    
  });
  
  $("body").on("click", ".e_editarHealthCheck", function(e){
    e.preventDefault();
    
    d_codigo = $(this).attr("data-cod");
    $("#vtn_HealthCheckActualizar").modal({
      backdrop: 'static'
    });
    $.ajax({
      type:"POST",
      url:"f_healthCheckActualizar.php",
      beforeSend: function() {
        $(".info_HealthCheckActualizar").html(loader());
      },
      data:{ 
        codigo: d_codigo
      },
      success: function(data) {
        $(".info_HealthCheckActualizar").html(data);
         $('#Ref_CodigoAct').multiselect({
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
  
  $("body").on("change", "#HeaC_AreaAct", function(e){
    e.preventDefault();
    d_codigo = $("#codigoActualizar").val();
    d_area = $("#HeaC_AreaAct").val();
    if(d_area == "Horno"){
      $.ajax({
        type:"POST",
        url:"f_cargarHornosHealthCheckAct.php",
        beforeSend: function() {
          $(".e_cargarHornosAct").html(loader());
        },
        data:{ 
          codigo: d_codigo
        },
        success: function(data) {
          $(".e_cargarHornosAct").html(data);
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
    }else{
      $(".e_cargarHornosAct").html('<tr class="e_cargarHornosAct"></tr>');
    }    
  });
  
  $("body").on("change", "#f_healthCheckActualizar #HeaC_Operador1Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Operador1Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario1Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario1Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario1Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario1Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Operador2Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Operador2Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario2Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario2Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario2Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario2Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Operador3Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Operador3Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario3Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario3Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario3Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario3Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Operador4Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Operador4Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario4Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario4Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario4Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario4Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Operador5Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Operador5Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario5Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario5Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario5Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario5Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Operador6Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Operador6Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario6Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario6Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario6Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario6Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Operador7Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Operador7Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario7Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario7Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario7Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario7Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Operador8Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Operador8Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario8Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario8Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario8Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario8Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Supervisor1Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Supervisor1Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario9Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario9Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario9Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario9Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Supervisor2Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Supervisor2Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario10Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario10Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario10Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario10Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Supervisor3Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Supervisor3Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario11Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario11Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario11Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario11Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Supervisor4Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Supervisor4Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario12Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario12Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario12Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario12Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Supervisor5Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Supervisor5Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario13Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario13Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario13Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario13Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_Supervisor6Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_Supervisor6Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario14Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario14Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario14Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario14Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_jefe1Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_jefe1Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario15Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario15Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario15Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario15Act").css("border", "#ccc");
    }

  });

  $("body").on("change", "#f_healthCheckActualizar #HeaC_jefe2Act", function (e) {
    e.preventDefault();

    if ($("#f_healthCheckActualizar #HeaC_jefe2Act").prop("checked") == false) {
      $("#f_healthCheckActualizar #HeaC_Comentario16Act").attr("required", true);
      $("#f_healthCheckActualizar #HeaC_Comentario16Act").css("border", "2px solid red");
    } else {
      $("#f_healthCheckActualizar #HeaC_Comentario16Act").removeAttr("required");
      $("#f_healthCheckActualizar #HeaC_Comentario16Act").css("border", "#ccc");
    }

  });
  
  $("body").on("submit", "#f_healthCheckActualizar", function(e){
    e.preventDefault();
    
    d_codigo = $("#codigoActualizar").val();
    d_fecha = $("#f_healthCheckActualizar #HeaC_fechaAct").val();
    d_referencia = $("#f_healthCheckActualizar #Ref_CodigoAct").val();
    d_proceso = $("#f_healthCheckActualizar #HeaC_ProcesoEvaluarAct").val();
    d_supervisor = $("#f_healthCheckActualizar #HeaC_SupervisorAct").val();
    d_area = $("#f_healthCheckActualizar #HeaC_AreaAct").val();
    d_horno = $("#f_healthCheckActualizar #HeaC_HornoAct").val();
    d_operadorHC = $("#f_healthCheckActualizar #Usu_CodigoHCAct").val();
    if ($("#f_healthCheckActualizar #HeaC_Operador1Act").prop("checked") == true) {
      d_operador1 = 1;
    } else {
      d_operador1 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Operador2Act").prop("checked") == true) {
      d_operador2 = 1;
    } else {
      d_operador2 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Operador3Act").prop("checked") == true) {
      d_operador3 = 1;
    } else {
      d_operador3 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Operador4Act").prop("checked") == true) {
      d_operador4 = 1;
    } else {
      d_operador4 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Operador5Act").prop("checked") == true) {
      d_operador5 = 1;
    } else {
      d_operador5 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Operador6Act").prop("checked") == true) {
      d_operador6 = 1;
    } else {
      d_operador6 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Operador7Act").prop("checked") == true) {
      d_operador7 = 1;
    } else {
      d_operador7 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Operador8Act").prop("checked") == true) {
      d_operador8 = 1;
    } else {
      d_operador8 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Supervisor1Act").prop("checked") == true) {
      d_supervisor1 = 1;
    } else {
      d_supervisor1 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Supervisor2Act").prop("checked") == true) {
      d_supervisor2 = 1;
    } else {
      d_supervisor2 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Supervisor3Act").prop("checked") == true) {
      d_supervisor3 = 1;
    } else {
      d_supervisor3 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Supervisor4Act").prop("checked") == true) {
      d_supervisor4 = 1;
    } else {
      d_supervisor4 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Supervisor5Act").prop("checked") == true) {
      d_supervisor5 = 1;
    } else {
      d_supervisor5 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_Supervisor6Act").prop("checked") == true) {
      d_supervisor6 = 1;
    } else {
      d_supervisor6 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_jefe1Act").prop("checked") == true) {
      d_jefe1 = 1;
    } else {
      d_jefe1 = 0;
    }
    if ($("#f_healthCheckActualizar #HeaC_jefe2Act").prop("checked") == true) {
      d_jefe2 = 1;
    } else {
      d_jefe2 = 0;
    }
    d_comentarios = $("#f_healthCheckActualizar #HeaC_ComentariosAct").val();
    d_comentarios1 = $("#f_healthCheckActualizar #HeaC_Comentario1Act").val();
    d_comentarios2 = $("#f_healthCheckActualizar #HeaC_Comentario2Act").val();
    d_comentarios3 = $("#f_healthCheckActualizar #HeaC_Comentario3Act").val();
    d_comentarios4 = $("#f_healthCheckActualizar #HeaC_Comentario4Act").val();
    d_comentarios5 = $("#f_healthCheckActualizar #HeaC_Comentario5Act").val();
    d_comentarios6 = $("#f_healthCheckActualizar #HeaC_Comentario6Act").val();
    d_comentarios7 = $("#f_healthCheckActualizar #HeaC_Comentario7Act").val();
    d_comentarios8 = $("#f_healthCheckActualizar #HeaC_Comentario8Act").val();
    d_comentarios9 = $("#f_healthCheckActualizar #HeaC_Comentario9Act").val();
    d_comentarios10 = $("#f_healthCheckActualizar #HeaC_Comentario10Act").val();
    d_comentarios11 = $("#f_healthCheckActualizar #HeaC_Comentario11Act").val();
    d_comentarios12 = $("#f_healthCheckActualizar #HeaC_Comentario12Act").val();
    d_comentarios13 = $("#f_healthCheckActualizar #HeaC_Comentario13Act").val();
    d_comentarios14 = $("#f_healthCheckActualizar #HeaC_Comentario14Act").val();
    d_comentarios15 = $("#f_healthCheckActualizar #HeaC_Comentario15Act").val();
    d_comentarios16 = $("#f_healthCheckActualizar #HeaC_Comentario16Act").val();
    
    if(d_referencia != ""){
      $.ajax({
        type:"POST",
        url:"op_heathCheckActualizar.php",
        beforeSend: function() {
          bloquearFormulario("f_healthCheckActualizar");
          $("#Btn_HealthCheckActualizarForm").hide();
        },
        complete: function() {
          desbloquearFormulario("f_healthCheckActualizar");
          $("#Btn_HealthCheckActualizarForm").show();
        },
        data: { 
          codigo: d_codigo,
          fecha: d_fecha,
          proceso: d_proceso,
          supervisor: d_supervisor,
          area: d_area,
          horno: d_horno,
          operador1: d_operador1,
          operador2: d_operador2,
          operador3: d_operador3,
          operador4: d_operador4,
          operador5: d_operador5,
          operador6: d_operador6,
          operador7: d_operador7,
          operador8: d_operador8,
          supervisor1: d_supervisor1,
          supervisor2: d_supervisor2,
          supervisor3: d_supervisor3,
          supervisor4: d_supervisor4,
          supervisor5: d_supervisor5,
          supervisor6: d_supervisor6,
          jefe1: d_jefe1,
          jefe2: d_jefe2,
          comentarios: d_comentarios,
          comentarios1: d_comentarios1,
          comentarios2: d_comentarios2,
          comentarios3: d_comentarios3,
          comentarios4: d_comentarios4,
          comentarios5: d_comentarios5,
          comentarios6: d_comentarios6,
          comentarios7: d_comentarios7,
          comentarios8: d_comentarios8,
          comentarios9: d_comentarios9,
          comentarios10: d_comentarios10,
          comentarios11: d_comentarios11,
          comentarios12: d_comentarios12,
          comentarios13: d_comentarios13,
          comentarios14: d_comentarios14,
          comentarios15: d_comentarios15,
          comentarios16: d_comentarios16,
          referencia: d_referencia,
          operador: d_operadorHC
        },
        dataType: 'json',
        success: function(rs) {
          if(rs.mensaje == "OK"){
            $("#vtn_HealthCheckNotificacionesActualizar").modal({backdrop: 'static'});
            $(".info_HealthCheckNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
          }else{
            mensaje('2', rs.mensaje);
            $("#vtn_HealthCheckNotificacionesActualizar").modal({backdrop: 'static'});
            $(".info_HealthCheckNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
          }
        },
        error: function(er1, er2, er3) {
          console.log(er2+"-"+er3);
        }
      });
    }else{
      $(".referenciaObligatoriaAct").html('<div class="alert alert-danger"> <strong>Por favor seleccione una referencia</strong> </div>'); 
    }
  });
  
  $("body").on("click", "#Btn_HealthCheckNotificacionesActualizar", function(e){
    e.preventDefault();
    $("#vtn_HealthCheckNotificacionesActualizar").modal('hide');
    $("#vtn_HealthCheckActualizar").modal('hide');
    
    d_fechaI = $("#filtroHealthCheck_FechaI").val();
    d_fechaF = $("#filtroHealthCheck_FechaF").val();
    d_area = $("#filtroHealthCheck_Area").val();
    
    $.ajax({
      type:"POST",
      url:"f_healthCheckListar.php",
      beforeSend: function() {
        $(".info_HealthCheckListar").html(loader());
      },
      data:{ 
        fechaI: d_fechaI,
        fechaF: d_fechaF,
        area: d_area
      },
      success: function(data) {
        $(".info_HealthCheckListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });    
  });
  
  $("body").on("click", ".e_eliminarHealthCheck", function (e) {
    e.preventDefault();

    d_codigo = $(this).attr("data-cod");

    $("#vtn_HealthCheckEliminarConfNotificacionesEliminar").modal({
      backdrop: 'static'
    });

    $(".Cod_healthCheckEliminar").val(d_codigo);

  });
  
  $("body").on("click", "#Btn_HealthCheckEliminarConfNotificacionesEliminar", function (e) {
    e.preventDefault();

    d_codigo = $(".Cod_healthCheckEliminar").val();
    $("#vtn_HealthCheckEliminarConfNotificacionesEliminar").modal('hide');

    $.ajax({
      type: "POST",
      url: "op_healthCheckEliminar.php",
      beforeSend: function () {
        $(".e_eliminarHealthCheck").hide();
      },
      complete: function () {
        $(".e_eliminarHealthCheck").show();
      },
      data: {
        codigo: d_codigo
      },
      dataType: 'json',
      success: function (rs) {
        if (rs.mensaje == "OK") {
          $("#vtn_HealthCheckNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
        } else {
          mensaje('2', rs.mensaje);
          $("#vtn_HealthCheckNotificacionesEliminar").modal({backdrop: 'static'});
          $(".info_ReferenciasCargarNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');          
        }
      },
      error: function (er1, er2, er3) {
        console.log(er2 + "-" + er3);
      }
    });
  });
  
  $("body").on("click", "#Btn_HealthCheckNotificacionesEliminar", function(e){
    e.preventDefault();
    $("#vtn_HealthCheckNotificacionesEliminar").modal('hide');
    
    d_fechaI = $("#filtroHealthCheck_FechaI").val();
    d_fechaF = $("#filtroHealthCheck_FechaF").val();
    d_area = $("#filtroHealthCheck_Area").val();
    
    $.ajax({
      type:"POST",
      url:"f_healthCheckListar.php",
      beforeSend: function() {
        $(".info_HealthCheckListar").html(loader());
      },
      data:{ 
        fechaI: d_fechaI,
        fechaF: d_fechaF,
        area: d_area
      },
      success: function(data) {
        $(".info_HealthCheckListar").html(data);
      },
      error: function(er1, er2, er3) {
        console.log(er2+"-"+er3);
      }
    });    
  });
  
  $("body").on("change", "#HeaC_ProcesoEvaluar", function(e){
    e.preventDefault();
    
    d_puestoTrabajo = $("#f_healthCheckCrear #HeaC_ProcesoEvaluar").val();
    d_turno = $("#f_healthCheckCrear #turnoHC").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarOpcionesHealthCheck.php",
      beforeSend: function() {
        $(".cargarInfodefectoHealthCheck").html(loader());
      },
      data:{ puestoTrabajo: d_puestoTrabajo, turno: d_turno},
      success: function(data) {
        $(".cargarInfodefectoHealthCheck").html(data);
         $('#Ref_Codigo').multiselect({
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
  
  $("body").on("change", "#HeaC_ProcesoEvaluarAct", function(e){
    e.preventDefault();
    
    d_puestoTrabajo = $("#f_healthCheckActualizar #HeaC_ProcesoEvaluarAct").val();
    d_turno = $("#f_healthCheckActualizar #turnoHCAct").val();
    
    $.ajax({
      type:"POST",
      url:"f_cargarOpcionesHealthCheckActualizar.php",
      beforeSend: function() {
        $(".cambioPTAct").html(loader());
      },
      data:{ puestoTrabajo: d_puestoTrabajo, turno: d_turno},
      success: function(data) {
        $(".cambioPTAct").html(data);
         $('#Ref_CodigoAct').multiselect({
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
  
  //Exportar a Excel
  $("body").on("click", ".excel_exportarHealthCheck", function(e){
  e.preventDefault();
    
  d_fechaI = $("#filtroHealthCheck_FechaI").val();
  d_fechaF = $("#filtroHealthCheck_FechaF").val();
  d_area = $("#filtroHealthCheck_Area").val();
  d_referencia = $("#filtroHealthCheck_Producto").val();
    
  window.location.href = "excel_exportarHealthCheck.php?fechaI="+d_fechaI+"&fechaF="+d_fechaF+"&area="+d_area+"&referencia="+d_referencia;

  });
  
});// JavaScript Document