$(document).ready(function (e) {

    $("body").on("change", "#filtroEstacionesUsuario_AreaTipo", function (e) {
        e.preventDefault();

        d_areaTipo = $("#filtroEstacionesUsuario_AreaTipo").val();
        d_turno = $("#filtroEstacionesUsuario_Turno").val();

        $.ajax({
            type: "POST",
            url: "f_estacionesUsuariosAreasPuestosTrabajos.php",
            beforeSend: function () {
                $(".info_EstacionesUsuariosAreasPuestosTrabajos").html(loader());
            },
            data: {codigo: d_areaTipo, turno: d_turno},
            success: function (data) {
                $(".info_EstacionesUsuariosAreasPuestosTrabajos").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("change", "#filtroEstacionesUsuario_Turno", function (e) {
        e.preventDefault();

        d_areaTipo = $("#filtroEstacionesUsuario_AreaTipo").val();
        d_turno = $("#filtroEstacionesUsuario_Turno").val();

        if (d_areaTipo != "") {
            $.ajax({
                type: "POST",
                url: "f_estacionesUsuariosAreasPuestosTrabajos.php",
                beforeSend: function () {
                    $(".info_EstacionesUsuariosAreasPuestosTrabajos").html(loader());
                },
                data: {codigo: d_areaTipo, turno: d_turno},
                success: function (data) {
                    $(".info_EstacionesUsuariosAreasPuestosTrabajos").html(data);
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });
        }
    });

    $("body").on("change", "#filtroEstacionesUsuario_Fase", function (e) {
        e.preventDefault();

        d_fase = $("#filtroEstacionesUsuario_Fase").val();

        $.ajax({
            type: "POST",
            url: "f_estacionesUsuariosCargarCanales.php",
            beforeSend: function () {
                $(".e_cargarEstacionesUsuarios_Canales").html(loader());
            },
            data: {codigo: d_fase},
            success: function (data) {
                $(".e_cargarEstacionesUsuarios_Canales").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("change", "#filtroEstacionesUsuario_Canal", function (e) {
        e.preventDefault();

        d_canal = $("#filtroEstacionesUsuario_Canal").val();
        d_turno = $("#filtroEstacionesUsuario_Turno").val();

        $.ajax({
            type: "POST",
            url: "f_estacionesUsuariosAreasPuestosTrabajos.php",
            beforeSend: function () {
                $(".info_EstacionesUsuariosAreasPuestosTrabajos").html(loader());
            },
            data: {codigo: d_canal, turno: d_turno},
            success: function (data) {
                $(".info_EstacionesUsuariosAreasPuestosTrabajos").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".Btn_RegistrarUsuarioPuestoTrabajo", function (e) {
        e.preventDefault();

        $(".Btn_OperadorOcuCrearNVal").hide();

        d_agrupacion = $(this).attr("data-agr");

        d_lista1 = [];

        cont = 0;
        $(".PueTraSelOpeMasivo:checked").each(function () {
            d_lista1[cont] = $(this).attr("data-cod");
            cont++;
        });
        d_num = cont;

        d_turno = $("#filtroEstacionesUsuario_Turno").val();

        $.ajax({
            type: "POST",
            url: "op_estacionesUsuariosCrear.php",
            beforeSend: function () {
                $("#Btn_OperadorOcuCrear").hide();
            },
            complete: function () {
                //$("#Btn_OperadorOcuCrear").show();
            },
            data: {lista1: d_lista1, turno: d_turno, num: d_num},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    d_codigo = rs.CodigoEstTra;
                    d_usuario = rs.CodigoUsuPT;
                    $.ajax({
                        type: "POST",
                        url: "f_opcionesOperadorVariables.php",
                        beforeSend: function () {
                            $(".info_PanelOperadorVariables").html(loader());
                        },
                        data: {usuario: d_usuario, turno: d_turno, agrupacion: d_agrupacion},
                        success: function (data) {
                            $(".info_PanelOperadorVariables").html(data);
                            $(".e_activadorSelPPU1").click();
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });
                } else {
                    mensaje('2', rs.mensaje);
                    d_areaTipo = $("#filtroEstacionesUsuario_AreaTipo").val();
                    d_turno = $("#filtroEstacionesUsuario_Turno").val();

                    $.ajax({
                        type: "POST",
                        url: "f_estacionesUsuariosAreasPuestosTrabajos.php",
                        beforeSend: function () {
                            $(".info_EstacionesUsuariosAreasPuestosTrabajos").html(loader());
                        },
                        data: {codigo: d_areaTipo, turno: d_turno},
                        success: function (data) {
                            $(".info_EstacionesUsuariosAreasPuestosTrabajos").html(data);
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_seleccionarEstacionUsuarioLogin", function (e) {
        e.preventDefault();

        d_usuario = $(this).attr("data-cod");
        d_turno = $(this).attr("data-tur");

        $.ajax({
            type: "POST",
            url: "f_opcionesOperadorVariables.php",
            beforeSend: function () {
                $(".info_PanelOperadorVariables").html(loader());
            },
            data: {usuario: d_usuario, turno: d_turno},
            success: function (data) {
                $(".info_PanelOperadorVariables").html(data);
                $(".e_activadorSelPPU1").click();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarPanelVariablesUsuarioPuestoTrabajo", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");
        d_planta = $(this).attr("data-pla");
        d_agrupacion = $(this).attr("data-agr");

        $(".Btn_OpcionesPuestosPanelUsuario").removeClass("ColSelOptOpeUni");

        $.ajax({
            type: "POST",
            url: "f_panelOperadorVariables.php",
            beforeSend: function () {
                $(".info_PanelVariablesUsuarioOperadorActual").html(loader());
            },
            data: {codigo: d_codigo, planta: d_planta, agrupacion: d_agrupacion},
            success: function (data) {
                $(".info_PanelVariablesUsuarioOperadorActual").html(data);
                $(".OpcPanUnicoSel" + d_codigo).addClass("ColSelOptOpeUni");
                $("#filtroOperador_FormulaMolienda").change();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_tomarReferenciaProgramaProduccionPanel", function (e) {
        e.preventDefault();

        d_estacionUsuario = $(this).attr("data-estu");
        d_programaProduccion = $(this).attr("data-prop");
        $(".CMCRONN").click();

        $.ajax({
            type: "POST",
            url: "op_tomarReferenciaProgramaProduccion.php",
            beforeSend: function () {
                $(".e_tomarReferenciaProgramaProduccionPanel").hide();
            },
            complete: function () {
                $(".e_tomarReferenciaProgramaProduccionPanel").show();
            },
            data: {estacionUsuario: d_estacionUsuario, programaProduccion: d_programaProduccion},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $(".Btn_CierreProPManual").click();
                    $(".CMCRONN").click();

                    $.ajax({
                        type: "POST",
                        url: "f_panelOperadorVariables.php",
                        beforeSend: function () {
                            $(".info_PanelVariablesUsuarioOperadorActual").html(loader());
                        },
                        data: {codigo: d_estacionUsuario},
                        success: function (data) {
                            $(".info_PanelVariablesUsuarioOperadorActual").html(data);
                            $("#filtroOperador_FormulaMolienda").change();
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });
                } else {
                    $(".Btn_CierreProPManual").click();
                    $(".CMCRONN").click();

                    $.ajax({
                        type: "POST",
                        url: "f_panelOperadorVariables.php",
                        beforeSend: function () {
                            $(".info_PanelVariablesUsuarioOperadorActual").html(loader());
                        },
                        data: {codigo: d_estacionUsuario},
                        success: function (data) {
                            $(".info_PanelVariablesUsuarioOperadorActual").html(data);
                            $("#filtroOperador_FormulaMolienda").change();
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });
                    $(".e_tomarReferenciaProgramaProduccionPanel").show();
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarRefProProPanelOperarioListar", function (e) {
        e.preventDefault();

        d_estacionUsuario = $(this).attr("data-estu");        
        d_planta = $(this).attr("data-pla");
        d_codigoPP = $(this).attr("data-prop");        
        d_nombrePP = $(this).attr("data-prop2");
        d_fecha = "-1";        
        d_area = $(this).attr("data-are");
        d_agrupacion = $(this).attr("data-agr");

        $("#vtn_CambioReferenciaOperador").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_referenciaProduccionManual.php",
            beforeSend: function () {
                $(".info_CambioReferenciaOperador").html(loader());
            },
            data: {estacionUsuario: d_estacionUsuario, planta: d_planta, area: d_area, fecha: d_fecha, codigo: d_codigoPP, nombrePP: d_nombrePP, agrupacion: d_agrupacion},
            success: function (data) {
                $(".info_CambioReferenciaOperador").html(data);
                d_planta = $("#referenciasPM_planta").val();
                d_fecha = $("#filtroReferenciaproduccion_Fecha").val();
                d_area = $("#filtroReferenciaproduccion_Area").val();
                d_estacionUsuario = $("#referenciasPM_estacionUsuario").val();
                d_nombrePP = $("#nombrePPRef").val();
                d_agrupacion = $("#referenciasPM_agrupacion").val();

                $.ajax({
                    type: "POST",
                    url: "f_referenciaProduccionManual.php",
                    beforeSend: function () {
                        $(".info_CambioReferenciaOperador").html(loader());
                    },
                    data: {planta: d_planta, area: d_area, fecha: d_fecha, estacionUsuario: d_estacionUsuario, nombrePP: d_nombrePP, agrupacion: d_agrupacion},
                    success: function (data) {
                        $(".info_CambioReferenciaOperador").html(data);
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

//  $("body").on("click", "#Btn_referenciaPMBuscar", function(e){
//    e.preventDefault();
//    
//    d_planta = $("#referenciasPM_planta").val();
//    d_fecha = $("#filtroReferenciaproduccion_Fecha").val();
//    d_area = $("#filtroReferenciaproduccion_Area").val();
//    d_estacionUsuario = $("#referenciasPM_estacionUsuario").val();
//    
//    $.ajax({
//      type:"POST",
//      url:"f_referenciaProduccionManual.php",
//      beforeSend: function() {
//        $(".info_CambioReferenciaOperador").html(loader());
//      },
//      data:{planta: d_planta, area: d_area, fecha: d_fecha, estacionUsuario: d_estacionUsuario },
//      success: function(data) {
//        $(".info_CambioReferenciaOperador").html(data);
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  
//  });

    $("body").on("change", "#filtroReferenciaproduccion_Fecha", function (e) {
        e.preventDefault();
        d_planta = $("#referenciasPM_planta").val();
        d_fecha = $("#filtroReferenciaproduccion_Fecha").val();
        d_area = $("#filtroReferenciaproduccion_Area").val();
        d_estacionUsuario = $("#referenciasPM_estacionUsuario").val();

        $.ajax({
            type: "POST",
            url: "f_referenciaProduccionManual.php",
            beforeSend: function () {
                $(".info_CambioReferenciaOperador").html(loader());
            },
            data: {planta: d_planta, area: d_area, fecha: d_fecha, estacionUsuario: d_estacionUsuario},
            success: function (data) {
                $(".info_CambioReferenciaOperador").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("change", "#filtroReferenciaproduccion_Area", function (e) {
        e.preventDefault();
        d_planta = $("#referenciasPM_planta").val();
        d_fecha = $("#filtroReferenciaproduccion_Fecha").val();
        d_area = $("#filtroReferenciaproduccion_Area").val();
        d_estacionUsuario = $("#referenciasPM_estacionUsuario").val();

        $.ajax({
            type: "POST",
            url: "f_referenciaProduccionManual.php",
            beforeSend: function () {
                $(".info_CambioReferenciaOperador").html(loader());
            },
            data: {planta: d_planta, area: d_area, fecha: d_fecha, estacionUsuario: d_estacionUsuario},
            success: function (data) {
                $(".info_CambioReferenciaOperador").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", ".pdf_exportarFichaTecnica", function (e) {
        e.preventDefault();

        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_formato = $(this).attr("data-for");

        $("#vtn_FichaTecnicaPDFCrear").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_programaProduccionPdfFT2.php",
            beforeSend: function () {
                $(".info_FichaTecnicaPDFCrear").html(loader());
            },
            data: {familia: d_familia, color: d_color, formato: d_formato},
            success: function (data) {
                $(".info_FichaTecnicaPDFCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_ProgramaProduccionRealOperarioCalendario", function (e) {
        e.preventDefault();

        $("#vtn_CalendarioOperadorS").modal({
            backdrop: 'static'
        });
        $.ajax({
            type: "POST",
            url: "f_calendarioProgramaP.php",
            beforeSend: function () {
                $(".info_CalendarioOperadorS").html(loader());
            },
            data: {},
            success: function (data) {
                $(".info_CalendarioOperadorS").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("change", "#filtroOperador_FormulaMolienda", function (e) {
        e.preventDefault();

        d_formulaMolienda = $("#filtroOperador_FormulaMolienda").val();

        $.ajax({
            type: "POST",
            url: "f_formulasMoliendaPDFOperador.php",
            beforeSend: function () {
                $(".cargarPDFFormulasMolienda").html(loader());
            },
            data: {formulaMolienda: d_formulaMolienda},
            success: function (data) {
                $(".cargarPDFFormulasMolienda").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cambiarFormulaMoliendaerador", function (e) {
        e.preventDefault();

        d_estacionUsuario = $(this).attr("data-estu");
        d_formulaMolienda = $("#filtroOperador_FormulaMolienda").val();

        $.ajax({
            type: "POST",
            url: "op_formulaMoliendaOperadorCrear.php",
            beforeSend: function () {
                $(".e_cambiarFormulaMoliendaerador").hide();
            },
            complete: function () {
                $(".e_cambiarFormulaMoliendaerador").show();
            },
            data: {estacionUsuario: d_estacionUsuario, formulaMolienda: d_formulaMolienda},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $.ajax({
                        type: "POST",
                        url: "f_panelOperadorVariables.php",
                        beforeSend: function () {
                            $(".info_PanelVariablesUsuarioOperadorActual").html(loader());
                        },
                        data: {codigo: d_estacionUsuario},
                        success: function (data) {
                            $(".info_PanelVariablesUsuarioOperadorActual").html(data);
                            $.ajax({
                                type: "POST",
                                url: "f_formulasMoliendaPDFOperador.php",
                                beforeSend: function () {
                                    $(".cargarPDFFormulasMolienda").html(loader());
                                },
                                data: {formulaMolienda: d_formulaMolienda},
                                success: function (data) {
                                    $(".cargarPDFFormulasMolienda").html(data);
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

                } else {
                    $.ajax({
                        type: "POST",
                        url: "f_panelOperadorVariables.php",
                        beforeSend: function () {
                            $(".info_PanelVariablesUsuarioOperadorActual").html(loader());
                        },
                        data: {codigo: d_estacionUsuario},
                        success: function (data) {
                            $(".info_PanelVariablesUsuarioOperadorActual").html(data);
                            $.ajax({
                                type: "POST",
                                url: "f_formulasMoliendaPDFOperador.php",
                                beforeSend: function () {
                                    $(".cargarPDFFormulasMolienda").html(loader());
                                },
                                data: {formulaMolienda: d_formulaMolienda},
                                success: function (data) {
                                    $(".cargarPDFFormulasMolienda").html(data);
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
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_eliminarEstacionUsuarioSinRespuestas", function (e) {
        e.preventDefault();

        d_estacionUsuario = $(this).attr("data-estu");
        d_usuario = $(this).attr("data-usu");
        d_turno = $(this).attr("data-tur");

        $.ajax({
            type: "POST",
            url: "op_estacionesUsuariosPanelEliminar.php",
            beforeSend: function () {
                $(".e_eliminarEstacionUsuarioSinRespuestas").hide();
            },
            complete: function () {
                $(".e_eliminarEstacionUsuarioSinRespuestas").show();
            },
            data: {estacionUsuario: d_estacionUsuario},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $.ajax({
                        type: "POST",
                        url: "f_opcionesOperadorVariables.php",
                        beforeSend: function () {
                            $(".info_PanelOperadorVariables").html(loader());
                        },
                        data: {usuario: d_usuario, turno: d_turno},
                        success: function (data) {
                            $(".info_PanelOperadorVariables").html(data);
                            $(".e_activadorSelPPU1").click();
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "f_opcionesOperadorVariables.php",
                        beforeSend: function () {
                            $(".info_PanelOperadorVariables").html(loader());
                        },
                        data: {usuario: d_usuario, turno: d_turno},
                        success: function (data) {
                            $(".info_PanelOperadorVariables").html(data);
                            $(".e_activadorSelPPU1").click();
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

    //Colores Limite Control y plan de acción obligatorio
    $("body").on("change", ".cambioDatoCalculoLimitesToma", function (e) {
        e.preventDefault();

        d_variable = $(this).attr("data-var");
        d_valor = $("#VM_Valor" + d_variable).val();

        d_valor = parseFloat(d_valor);

        d_puestaPunto = $(this).attr("data-pue");

        if (d_puestaPunto == "1") {

            //Puesta punto

            d_operadorPP = $(this).attr("data-opePP");
            d_verde1PP = $(this).attr("data-ver1PP");
            d_verde2PP = $(this).attr("data-ver2PP");
            d_amarillo1PP = $(this).attr("data-ama1PP");
            d_amarillo2PP = $(this).attr("data-ama2PP");
            d_amarillo3PP = $(this).attr("data-ama3PP");
            d_amarillo4PP = $(this).attr("data-ama4PP");

            //Limpieza de CSS
            $("#VM_Valor" + d_variable).removeClass("VerdeCenterLine");
            $("#VM_Valor" + d_variable).removeClass("AmarilloCenterLine");
            $("#VM_Valor" + d_variable).removeClass("RojoCenterLine");

            // +- colorVariable
            if (d_operadorPP == "3") {
                if (d_valor >= d_verde1PP && d_valor <= d_verde2PP) {
                    $("#VM_Valor" + d_variable).css("background-color", "#68C090");
                    $("#VM_Valor" + d_variable).css("font-weight", "bold");
                    $("#VM_Valor" + d_variable).attr("data-val", "0");
                    $("#PlaA_ObservacionesOperario" + d_variable).removeAttr("required", false);
                    $("#PlaA_ObservacionesOperario" + d_variable).removeAttr("required", false);
                    $(".ColorSignoToma" + d_variable).css("background-color", "#68C090");
                    $(".ActInacCamAlet" + d_variable).attr("disabled", "true");
                    $("#colorVariablePuestaPunto" + d_variable).val("Verde");
                } else {
                    if (d_valor <= d_amarillo1PP && d_valor >= d_amarillo2PP) {
                        $("#VM_Valor" + d_variable).css("background-color", "#E8E868");
                        $("#VM_Valor" + d_variable).css("font-weight", "bold");
                        $("#VM_Valor" + d_variable).attr("data-val", "1");
                        $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                        $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                        $(".ColorSignoToma" + d_variable).css("background-color", "#E8E868");
                        $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                        $("#colorVariablePuestaPunto" + d_variable).val("Amarillo");
                    } else {
                        if (d_valor >= d_amarillo3PP && d_valor <= d_amarillo4PP) {
                            $("#VM_Valor" + d_variable).css("background-color", "#E8E868");
                            $("#VM_Valor" + d_variable).css("font-weight", "bold");
                            $("#VM_Valor" + d_variable).attr("data-val", "1");
                            $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                            $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                            $(".ColorSignoToma" + d_variable).css("background-color", "#E8E868");
                            $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                            $("#colorVariablePuestaPunto" + d_variable).val("Amarillo");
                        } else {
                            $("#VM_Valor" + d_variable).css("background-color", "#E86868");
                            $("#VM_Valor" + d_variable).css("font-weight", "bold");
                            $("#VM_Valor" + d_variable).attr("data-val", "1");
                            $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                            $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                            $(".ColorSignoToma" + d_variable).css("background-color", "#E86868");
                            $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                            $("#colorVariablePuestaPunto" + d_variable).val("Rojo");
                        }
                    }
                }
            }

            // >=
            if (d_operadorPP == "1") {
                if (d_valor >= d_verde1PP && d_valor <= d_verde2PP) {
                    $("#VM_Valor" + d_variable).css("background-color", "#68C090");
                    $("#VM_Valor" + d_variable).css("font-weight", "bold");
                    $("#VM_Valor" + d_variable).attr("data-val", "0");
                    $("#PlaA_ObservacionesOperario" + d_variable).removeAttr("required", false);
                    $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#ccc");
                    $(".ColorSignoToma" + d_variable).css("background-color", "#68C090");
                    $(".ActInacCamAlet" + d_variable).attr("disabled", "true");
                    $("#colorVariablePuestaPunto" + d_variable).val("Verde");
                } else {
                    if (d_valor <= d_amarillo1PP && d_valor >= d_amarillo2PP) {
                        $("#VM_Valor" + d_variable).css("background-color", "#E8E868");
                        $("#VM_Valor" + d_variable).css("font-weight", "bold");
                        $("#VM_Valor" + d_variable).attr("data-val", "1");
                        $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                        $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                        $(".ColorSignoToma" + d_variable).css("background-color", "#E8E868");
                        $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                        $("#colorVariablePuestaPunto" + d_variable).val("Amarillo");
                    } else {
                        $("#VM_Valor" + d_variable).css("background-color", "#E86868");
                        $("#VM_Valor" + d_variable).css("font-weight", "bold");
                        $("#VM_Valor" + d_variable).attr("data-val", "1");
                        $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                        $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                        $(".ColorSignoToma" + d_variable).css("background-color", "#E86868");
                        $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                        $("#colorVariablePuestaPunto" + d_variable).val("Rojo");
                    }
                }
            }

            // >=
            if (d_operadorPP == "2") {
                if (d_valor >= d_verde1PP && d_valor <= d_verde2PP) {
                    $("#VM_Valor" + d_variable).css("background-color", "#68C090");
                    $("#VM_Valor" + d_variable).css("font-weight", "bold");
                    $("#VM_Valor" + d_variable).attr("data-val", "0");
                    $("#PlaA_ObservacionesOperario" + d_variable).removeAttr("required", false);
                    $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#ccc");
                    $(".ColorSignoToma" + d_variable).css("background-color", "#68C090");
                    $(".ActInacCamAlet" + d_variable).attr("disabled", "true");
                    $("#colorVariablePuestaPunto" + d_variable).val("Verde");
                } else {
                    if (d_valor >= d_amarillo1PP && d_valor <= d_amarillo2PP) {
                        $("#VM_Valor" + d_variable).css("background-color", "#E8E868");
                        $("#VM_Valor" + d_variable).css("font-weight", "bold");
                        $("#VM_Valor" + d_variable).attr("data-val", "1");
                        $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                        $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                        $(".ColorSignoToma" + d_variable).css("background-color", "#E8E868");
                        $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                        $("#colorVariablePuestaPunto" + d_variable).val("Amarillo");
                    } else {
                        $("#VM_Valor" + d_variable).css("background-color", "#E86868");
                        $("#VM_Valor" + d_variable).css("font-weight", "bold");
                        $("#VM_Valor" + d_variable).attr("data-val", "1");
                        $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                        $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                        $(".ColorSignoToma" + d_variable).css("background-color", "#E86868");
                        $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                        $("#colorVariablePuestaPunto" + d_variable).val("Rojo");
                    }
                }
            }

            //Variable Normal 

            d_operador = $(this).attr("data-ope");
            d_verde1 = $(this).attr("data-ver1");
            d_verde2 = $(this).attr("data-ver2");
            d_amarillo1 = $(this).attr("data-ama1");
            d_amarillo2 = $(this).attr("data-ama2");
            d_amarillo3 = $(this).attr("data-ama3");
            d_amarillo4 = $(this).attr("data-ama4");

            // +- colorVariable
            if (d_operador == "3") {
                if (d_valor >= d_verde1 && d_valor <= d_verde2) {
                    $("#colorVariableNormal" + d_variable).val("Verde");
                    $("#colorVariableNormal" + d_variable).attr("data-val", "0");
                } else {
                    if (d_valor <= d_amarillo1 && d_valor >= d_amarillo2) {
                        $("#colorVariableNormal" + d_variable).val("Amarillo");
                        $("#colorVariableNormal" + d_variable).attr("data-val", "1");
                    } else {
                        if (d_valor >= d_amarillo3 && d_valor <= d_amarillo4) {
                            $("#colorVariableNormal" + d_variable).val("Amarillo");
                            $("#colorVariableNormal" + d_variable).attr("data-val", "1");
                        } else {
                            $("#colorVariableNormal" + d_variable).val("Rojo");
                            $("#colorVariableNormal" + d_variable).attr("data-val", "1");
                        }
                    }
                }
            }

            // >=
            if (d_operador == "1") {
                if (d_valor >= d_verde1 && d_valor <= d_verde2) {
                    $("#colorVariableNormal" + d_variable).val("Verde");
                    $("#colorVariableNormal" + d_variable).attr("data-val", "0");
                } else {
                    if (d_valor <= d_amarillo1 && d_valor >= d_amarillo2) {
                        $("#colorVariableNormal" + d_variable).val("Amarillo");
                        $("#colorVariableNormal" + d_variable).attr("data-val", "1");
                    } else {
                        $("#colorVariableNormal" + d_variable).val("Rojo");
                        $("#colorVariableNormal" + d_variable).attr("data-val", "1");
                    }
                }
            }

            // >=
            if (d_operador == "2") {
                if (d_valor >= d_verde1 && d_valor <= d_verde2) {
                    $("#colorVariableNormal" + d_variable).val("Verde");
                    $("#colorVariableNormal" + d_variable).attr("data-val", "0");
                } else {
                    if (d_valor >= d_amarillo1 && d_valor <= d_amarillo2) {
                        $("#colorVariableNormal" + d_variable).val("Amarillo");
                        $("#colorVariableNormal" + d_variable).attr("data-val", "1");
                    } else {
                        $("#colorVariableNormal" + d_variable).val("Rojo");
                        $("#colorVariableNormal" + d_variable).attr("data-val", "1");
                    }
                }
            }

        } else {

            //Sin puesta punto

            d_operador = $(this).attr("data-ope");
            d_verde1 = $(this).attr("data-ver1");
            d_verde2 = $(this).attr("data-ver2");
            d_amarillo1 = $(this).attr("data-ama1");
            d_amarillo2 = $(this).attr("data-ama2");
            d_amarillo3 = $(this).attr("data-ama3");
            d_amarillo4 = $(this).attr("data-ama4");

            //Limpieza de CSS
            $("#VM_Valor" + d_variable).removeClass("VerdeCenterLine");
            $("#VM_Valor" + d_variable).removeClass("AmarilloCenterLine");
            $("#VM_Valor" + d_variable).removeClass("RojoCenterLine");

            // +- colorVariable
            if (d_operador == "3") {
                if (d_valor >= d_verde1 && d_valor <= d_verde2) {
                    $("#VM_Valor" + d_variable).css("background-color", "#68C090");
                    $("#VM_Valor" + d_variable).css("font-weight", "bold");
                    $("#VM_Valor" + d_variable).attr("data-val", "0");
                    $("#PlaA_ObservacionesOperario" + d_variable).removeAttr("required", false);
                    $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#ccc");
                    $(".ColorSignoToma" + d_variable).css("background-color", "#68C090");
                    $(".ActInacCamAlet" + d_variable).attr("disabled", "true");
                    $("#colorVariablePuestaPunto" + d_variable).val("");
                    $("#colorVariableNormal" + d_variable).val("Verde");
                } else {
                    if (d_valor <= d_amarillo1 && d_valor >= d_amarillo2) {
                        $("#VM_Valor" + d_variable).css("background-color", "#E8E868");
                        $("#VM_Valor" + d_variable).css("font-weight", "bold");
                        $("#VM_Valor" + d_variable).attr("data-val", "1");
                        $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                        $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                        $(".ColorSignoToma" + d_variable).css("background-color", "#E8E868");
                        $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                        $("#colorVariablePuestaPunto" + d_variable).val("");
                        $("#colorVariableNormal" + d_variable).val("Amarillo");
                    } else {
                        if (d_valor >= d_amarillo3 && d_valor <= d_amarillo4) {
                            $("#VM_Valor" + d_variable).css("background-color", "#E8E868");
                            $("#VM_Valor" + d_variable).css("font-weight", "bold");
                            $("#VM_Valor" + d_variable).attr("data-val", "1");
                            $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                            $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                            $(".ColorSignoToma" + d_variable).css("background-color", "#E8E868");
                            $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                            $("#colorVariablePuestaPunto" + d_variable).val("");
                            $("#colorVariableNormal" + d_variable).val("Amarillo");
                        } else {
                            $("#VM_Valor" + d_variable).css("background-color", "#E86868");
                            $("#VM_Valor" + d_variable).css("font-weight", "bold");
                            $("#VM_Valor" + d_variable).attr("data-val", "1");
                            $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                            $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                            $(".ColorSignoToma" + d_variable).css("background-color", "#E86868");
                            $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                            $("#colorVariablePuestaPunto" + d_variable).val("");
                            $("#colorVariableNormal" + d_variable).val("Rojo");
                        }
                    }
                }
            }

            // >=
            if (d_operador == "1") {
                if (d_valor >= d_verde1 && d_valor <= d_verde2) {
                    $("#VM_Valor" + d_variable).css("background-color", "#68C090");
                    $("#VM_Valor" + d_variable).css("font-weight", "bold");
                    $("#VM_Valor" + d_variable).attr("data-val", "0");
                    $("#PlaA_ObservacionesOperario" + d_variable).removeAttr("required", false);
                    $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#ccc");
                    $(".ColorSignoToma" + d_variable).css("background-color", "#68C090");
                    $(".ActInacCamAlet" + d_variable).attr("disabled", "true");
                    $("#colorVariablePuestaPunto" + d_variable).val("");
                    $("#colorVariableNormal" + d_variable).val("Verde");
                } else {
                    if (d_valor <= d_amarillo1 && d_valor >= d_amarillo2) {
                        $("#VM_Valor" + d_variable).css("background-color", "#E8E868");
                        $("#VM_Valor" + d_variable).css("font-weight", "bold");
                        $("#VM_Valor" + d_variable).attr("data-val", "1");
                        $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                        $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                        $(".ColorSignoToma" + d_variable).css("background-color", "#E8E868");
                        $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                        $("#colorVariablePuestaPunto" + d_variable).val("");
                        $("#colorVariableNormal" + d_variable).val("Amarillo");
                    } else {
                        $("#VM_Valor" + d_variable).css("background-color", "#E86868");
                        $("#VM_Valor" + d_variable).css("font-weight", "bold");
                        $("#VM_Valor" + d_variable).attr("data-val", "1");
                        $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                        $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                        $(".ColorSignoToma" + d_variable).css("background-color", "#E86868");
                        $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                        $("#colorVariablePuestaPunto" + d_variable).val("");
                        $("#colorVariableNormal" + d_variable).val("Rojo");
                    }
                }
            }

            // >=
            if (d_operador == "2") {
                if (d_valor >= d_verde1 && d_valor <= d_verde2) {
                    $("#VM_Valor" + d_variable).css("background-color", "#68C090");
                    $("#VM_Valor" + d_variable).css("font-weight", "bold");
                    $("#VM_Valor" + d_variable).attr("data-val", "0");
                    $("#PlaA_ObservacionesOperario" + d_variable).removeAttr("required", false);
                    $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#ccc");
                    $(".ColorSignoToma" + d_variable).css("background-color", "#68C090");
                    $(".ActInacCamAlet" + d_variable).attr("disabled", "true");
                    $("#colorVariablePuestaPunto" + d_variable).val("");
                    $("#colorVariableNormal" + d_variable).val("Verde");
                } else {
                    if (d_valor >= d_amarillo1 && d_valor <= d_amarillo2) {
                        $("#VM_Valor" + d_variable).css("background-color", "#E8E868");
                        $("#VM_Valor" + d_variable).css("font-weight", "bold");
                        $("#VM_Valor" + d_variable).attr("data-val", "1");
                        $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                        $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                        $(".ColorSignoToma" + d_variable).css("background-color", "#E8E868");
                        $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                        $("#colorVariablePuestaPunto" + d_variable).val("");
                        $("#colorVariableNormal" + d_variable).val("Amarillo");
                    } else {
                        $("#VM_Valor" + d_variable).css("background-color", "#E86868");
                        $("#VM_Valor" + d_variable).css("font-weight", "bold");
                        $("#VM_Valor" + d_variable).attr("data-val", "1");
                        $("#PlaA_ObservacionesOperario" + d_variable).attr("required", true);
                        $("#PlaA_ObservacionesOperario" + d_variable).css("border-color", "#E86868");
                        $(".ColorSignoToma" + d_variable).css("background-color", "#E86868");
                        $(".ActInacCamAlet" + d_variable).removeAttr("disabled", "false");
                        $("#colorVariablePuestaPunto" + d_variable).val("");
                        $("#colorVariableNormal" + d_variable).val("Rojo");
                    }
                }
            }
        }

    });

    $("body").on("submit", "#f_variablesMasivasOperadorCrear", function (e) {
        e.preventDefault();

        d_a = $(".Num_CantVariablesTomaOpe").val();
        d_b = $(".Num_CantVariablesTomaOpe").attr("data-conMaq");
        d_maquina = $(".Num_CantVariablesTomaOpe").attr("data-conMaq");
        d_estacionUsuario = $(".Num_CantVariablesTomaOpe").attr("data-estu");
        d_hora = $(".Num_CantVariablesTomaOpe").attr("data-hor");
        d_ProgramaProduccion = $(".Num_CantVariablesTomaOpe").attr("data-ProP");
        d_fecha = $(".Num_CantVariablesTomaOpe").attr("data-fec");
//    d_planta = $(".Num_CantVariablesTomaOpe").attr("data-pla");

        d_lista1 = []; // accion
        d_lista2 = []; // valor
        d_lista3 = []; // observacion
        d_lista4 = []; // variable
        d_lista5 = []; // Cod Respuesta
        d_lista6 = []; // Cod Plan Acción
        d_lista7 = []; // Alerta
        d_lista8 = []; // Color puesta punto
        d_lista9 = []; // Color normal
        d_lista10 = []; // Campo vacío
        d_lista11 = []; // Campo vacío Observación
        d_lista12 = []; // Campo vacío Maquina
        d_lista13 = []; // Campo vacío Acción
        d_lista14 = []; // Codigo Campo vacío Observación
        d_lista15 = []; // Variables para corregir el usuario

        cont = 0;
        vacio = 0;
        d_validarVacios = 0;
        d_paroSelect = 0;
        cantidadCaracteres = 0;
        MenCar="";
        MenCarCantVar="";
        for (r = 0; r < d_a; r++) {
            d_valor = $(".TV_CampoValor" + r).val();

            if (d_valor != "") {
                d_lista1[cont] = $(".TV_CampoValor" + r).attr("data-acc");
                d_lista2[cont] = $(".TV_CampoValor" + r).val();
                d_lista3[cont] = $(".TObs_CampoValor" + r).val();
                d_lista4[cont] = $(".TV_CampoValor" + r).attr("data-var");
                d_lista5[cont] = $(".TV_CampoValor" + r).attr("data-cod");
                d_lista6[cont] = $(".TObs_CampoValor" + r).attr("data-codplaa");
                d_lista8[cont] = $(".colorVariablePuestaPuntoF" + r).val();
                d_lista9[cont] = $(".colorVariableNormalF" + r).val();
              
                variable = $(".TObs_CampoValor" + r).val();
                d_validarVac = $(".TV_CampoValor" + r).attr("data-val");
                
                if(d_validarVac == "1"){
                  d_validarVacios = 1;
                }
              
                if(d_valor != "" && variable != "" && d_validarVacios == "1"){
                  
                  sinEspacios = variable.replace(/\s+/g, '');
                  sinCaracteres = sinEspacios.replace(/[^a-zA-Z0-9 ]/g, '');
                  cantCaracteres = sinCaracteres.length;
                  
                  if(cantCaracteres < 15){
                    cantidadCaracteres = 1;
                    MenCarCantVar += $(".TV_CampoValor" + r).attr("data-varNomb");
                    MenCarCantVar += ", ";
                  }
                  if(sinCaracteres === ""){
                    vacio = 1;
                    MenCar += $(".TV_CampoValor" + r).attr("data-varNomb");
                    MenCar += ", ";
                  }
                }
                
              
                if ($(".TAle_CampoAlerta" + r).prop("checked") == true) {
                    d_lista7[cont] = 1;
                } else {
                    d_lista7[cont] = 0;
                }

                if ($(".T_CampoVacio" + r).prop("checked") == true) {
                    d_lista10[cont] = 1;
                    d_paroSelect = 1;
                } else {
                    d_lista10[cont] = 0;
                }

                cont++;
            } else {

                d_lista1[cont] = $(".TV_CampoValor" + r).attr("data-acc");
                d_lista2[cont] = $(".TV_CampoValor" + r).val();
                d_lista3[cont] = $(".TObs_CampoValor" + r).val();
                d_lista4[cont] = $(".TV_CampoValor" + r).attr("data-var");
                d_lista5[cont] = $(".TV_CampoValor" + r).attr("data-cod");
                d_lista6[cont] = $(".TObs_CampoValor" + r).attr("data-codplaa");
                d_lista8[cont] = $(".colorVariablePuestaPuntoF" + r).val();
                d_lista9[cont] = $(".colorVariableNormalF" + r).val();
                d_lista9[cont] = $(".colorVariableNormalF" + r).val();

                if ($(".TAle_CampoAlerta" + r).prop("checked") == true) {
                    d_lista7[cont] = 1;
                } else {
                    d_lista7[cont] = 0;
                }

                if ($(".T_CampoVacio" + r).prop("checked") == true) {
                    d_lista10[cont] = 1;
                    d_paroSelect = 1;
                } else {
                    d_lista10[cont] = 0;
                }

                d_lista1[cont] = $(".T_CampoVacio" + r).attr("data-acc");
                cont++;
            }
        }

        cont2 = 0;
        vacioParo = 0;
        for (r = 0; r < d_b; r++) {

            d_lista11[cont2] = $(".T_CampoVacioObservacion" + r).val();
            d_lista12[cont2] = $(".T_CampoVacioObservacion" + r).attr("data-maq");
            d_lista13[cont2] = $(".T_CampoVacioObservacion" + r).attr("data-acc");
            d_lista14[cont2] = $(".T_CampoVacioObservacion" + r).attr("data-codObse");

            cont2++;
            d_campoVacioParo = $(".T_CampoVacioObservacion" + r).val();
            d_valParo = $(".T_CampoVacioObservacion" + r).attr("data-valparo");
          
            if(d_paroSelect == "1"){
              d_validarVacios = 1;
            }
           
            if(d_paroSelect == "1" && d_valParo == "1"){
              sinEspaciosParo = d_campoVacioParo.replace(/\s+/g, '');
              sinCaracteresParo = sinEspaciosParo.replace(/[^a-zA-Z0-9 ]/g, '');
              cantidadCaracteresParo = sinCaracteresParo.length;
              
               if(cantidadCaracteresParo < 15){
                cantidadCaracteres = 1;
                MenCarCantVar += $(".T_CampoVacioObservacion" + r).attr("data-varNomb");
                MenCarCantVar += ", ";
              }
              
              if(sinCaracteresParo === ""){
                vacioParo = 1;
                MenCar += $(".T_CampoVacioObservacion" + r).attr("data-varNomb");
                MenCar += ", ";
              }
            }
        }

        d_num = cont;
        d_num2 = cont2;
      
      if(d_validarVacios == 1){
        if(vacio == 0){
          if(vacioParo == 0){
            if(cantidadCaracteres == 0){
              $.ajax({
                  type: "POST",
                  url: "op_respuestasMasivasTomaVariables.php",
                  beforeSend: function () {
                      bloquearFormulario("f_variablesMasivasOperadorCrear");
                      $(".ocultarBtn_GuardarMasivoVarTOpe").hide();
                  },
                  complete: function () {
                      desbloquearFormulario("f_variablesMasivasOperadorCrear");
                      $(".ocultarBtn_GuardarMasivoVarTOpe").show();
                  },
                  data: { lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, lista5: d_lista5, lista6: d_lista6, lista7: d_lista7, lista8: d_lista8, lista9: d_lista9, lista10: d_lista10, num: d_num, estacionUsuario: d_estacionUsuario, hora: d_hora, num2: d_num2, lista11: d_lista11, lista12: d_lista12, lista13: d_lista13, lista14: d_lista14, ProgramaProduccion: d_ProgramaProduccion, fecha: d_fecha },
                  dataType: 'json',
                  success: function (rs) {
                      if (rs.mensaje == "OK") {
                          $(".Rec_PanelOperador").click();
                      } else {
                          $(".Rec_PanelOperador").click();
                          $(".ocultarBtn_GuardarMasivoVarTOpe").show();
                          mensaje('2', rs.mensaje);
                      }
                  },
                  error: function (er1, er2, er3) {

                      console.log(er2 + "-" + er3);
                  }
              });
            }else{
              $(".validacionVacio").html('<div class="alert alert-danger"> <strong>El campo de "Acción A Tomar" debe tener mínimo 15 caracteres sin contar espacios en blanco, a continuación mencionamos las variables que debe organizar: '+MenCarCantVar+'</strong> </div>');
            }
          }else{ 
            $(".validacionVacio").html('<div class="alert alert-danger"> <strong>El campo de paro debe tener información valida, no puede estar vacio o lleno de caracteres especiales, a continuación mencionamos las variables que debe organizar: '+MenCar+' </strong> </div>');
          }
        }else{ 
          $(".validacionVacio").html('<div class="alert alert-danger"> <strong>El campo debe tener información valida, no puede estar vacio o lleno de caracteres especiales, a continuación mencionamos las variables que debe organizar: '+MenCar+' </strong> </div>');
        }
      }else{
        $.ajax({
            type: "POST",
            url: "op_respuestasMasivasTomaVariables.php",
            beforeSend: function () {
                bloquearFormulario("f_variablesMasivasOperadorCrear");
                $(".ocultarBtn_GuardarMasivoVarTOpe").hide();
            },
            complete: function () {
                desbloquearFormulario("f_variablesMasivasOperadorCrear");
                $(".ocultarBtn_GuardarMasivoVarTOpe").show();
            },
            data: { lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, lista5: d_lista5, lista6: d_lista6, lista7: d_lista7, lista8: d_lista8, lista9: d_lista9, lista10: d_lista10, num: d_num, estacionUsuario: d_estacionUsuario, hora: d_hora, num2: d_num2, lista11: d_lista11, lista12: d_lista12, lista13: d_lista13, lista14: d_lista14, ProgramaProduccion: d_ProgramaProduccion, fecha: d_fecha },
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $(".Rec_PanelOperador").click();
                } else {
                    $(".Rec_PanelOperador").click();
                    $(".ocultarBtn_GuardarMasivoVarTOpe").show();
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
      }
      

        

        //console.log(d_lista1);
        //console.log(d_lista2);
        //console.log(d_lista3);
        //console.log(d_lista4);
        //console.log(d_num);

    });

    $("body").on("change", ".Int_SeleccionTodosVacios", function (e) {
        e.preventDefault();

        if ($(this).prop("checked") == true) {
            $(".campoVacioSelec").prop("checked", true);
            $(".TObs_CampoValorTodos").attr("disabled", "true"); 
            $(".T_CampoVacioObser").attr("required", "true");
            $(".T_CampoVacioObser").removeAttr("disabled", "false");
            $(".T_CampoVacioObser").css("border-color", "#E86868");
            $(".validarCampoValor").attr("disabled", "true");
            $(".e_cargarMensajeVacio").html('<div class="alert alert-warning"> <strong>La información del campo de "valor" se va a borrar para la fila donde seleccionó la opción de paro</strong> </div>');
        } else {
            $(".campoVacioSelec").prop("checked", false);
            $(".TObs_CampoValorTodos").removeAttr("disabled", "false");
            $(".validarCampoValor").removeAttr("disabled", "false");
            $(".T_CampoVacioObser").removeAttr("required", "false");
            $(".T_CampoVacioObser").attr("disabled", "true");
            $(".T_CampoVacioObser").css("border-color", "#ccc");
            $(".e_cargarMensajeVacio").html('');
        }
    });

    $("body").on("change", ".campoVacioSelec", function (e) {
        e.preventDefault();

        d_cont = $(this).attr("data-cont");
        d_maq = $(this).attr("data-maq");

        if ($(this).prop("checked") == true) {
            $(".TV_CampoValor" + d_cont).attr("disabled", "true");
            $(".TObs_CampoValor" + d_cont).attr("disabled", "true");
            $(".T_CampoVacioObservacionUnico" + d_maq).attr("required", "true");
            $(".T_CampoVacioObservacionUnico" + d_maq).removeAttr("disabled", "false");
            $(".T_CampoVacioObservacionUnico" + d_maq).css("border-color", "#E86868");
            $(".T_CampoVacioObservacionUnico" + d_maq).attr("data-valparo", "1");
            $(".e_cargarMensajeVacio").html('<div class="alert alert-warning"> <strong>La información del campo de "valor" se va a borrar para la fila donde seleccionó la opción de paro</strong> </div>');
        } else {
            $(".TV_CampoValor" + d_cont).removeAttr("disabled", "false");
            $(".TObs_CampoValor" + d_cont).removeAttr("disabled", "false");
            $(".T_CampoVacioObservacionUnico" + d_maq).removeAttr("required", "false");
            $(".T_CampoVacioObservacionUnico" + d_maq).attr("disabled", "true");
            $(".T_CampoVacioObservacionUnico" + d_maq).css("border-color", "#ccc");
            $(".T_CampoVacioObservacionUnico" + d_maq).attr("data-valparo", "0");
            $(".e_cargarMensajeVacio").html('');
        }
    });

    $("body").on("click", "#Btn_UsuariosLogeadosBuscar", function (e) {
        e.preventDefault();

        d_fechaU = $("#filtroUsuariosLogeados_Fecha").val();
        $.ajax({
            type: "POST",
            url: "f_usuariosLogeados.php",
            beforeSend: function () {
                $(".info_usuariosLogeadosListar").html(loader());
            },
            data: {
                fecha: d_fechaU
            },
            success: function (data) {
                $(".info_usuariosLogeadosListar").html(data);
                $("#tbl_UsuariosLogeadosListar").tablesorter();
                $('#filtrarUsuariosLogeados').keyup(function () {
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


    //Panel SUPERVISOR
    $("body").on("click", ".Btn_OpcionesPuestosPanelUsuarioSupervisor", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

//        $(".Btn_OpcionesPuestosPanelUsuarioSupervisor").removeClass("ColSelOptOpeUni");

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorFiltro.php",
            beforeSend: function () {
                $(".info_PanelVariablesSupervisor").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
//                $(".OpcPanUnicoSelSup" + d_codigo).addClass("ColSelOptOpeUni");
                $(".info_PanelVariablesSupervisor").html(data);
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
                $(".Btn_CargarPanelSupervisorDatos").click();
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".Btn_CargarPanelSupervisorDatos", function (e) {
        e.preventDefault();

        d_codigo = $(".Inp_CodigoAgrupacionPanelSupervisor").val();
        d_referencia = $("#filtroPanelSupervisor_Referencia").val();
        d_fecha = $("#filtroPanelSupervisor_Fecha").val();
        d_turno = $("#filtroPanelSupervisor_Turno").val();
        d_area = $("#filtroPanelSupervisor_Area").val();
        d_planta = $(this).attr("data-pla");
        d_agrupacion = $(this).attr("data-agr");
        d_programaProduccion = $(this).attr("data-pro");

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorOpciones.php",
            beforeSend: function () {
                $(".e_cargarPanelesSupervisorDatos").html(loader());
            },
           data: { codigo: d_codigo, referencia: d_referencia, fecha: d_fecha, turno: d_turno, area: d_area, planta: d_planta, agrupacion: d_agrupacion, programaProduccion: d_programaProduccion },
            success: function (data) {
                $(".e_cargarPanelesSupervisorDatos").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorFiltroNotificaciones.php",
            beforeSend: function () {
                $(".e_cargarNotificacionesPS").html(loader());
            },
            data: {agrupacion: d_codigo, referencia: d_referencia, fecha: d_fecha, turno: d_turno},
            success: function (data) {
                $(".e_cargarNotificacionesPS").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });
  
    // Datos Panel Supervisor Puesto de trabajo
    $("body").on("click", ".Btn_CargarPanelSupervisorDatosPueTra", function (e) {
      e.preventDefault();

      d_codigo = $(".Inp_CodigoAgrupacionPanelSupervisor").val();
      d_referencia = $("#filtroPanelSupervisor_Referencia").val();
      d_fecha = $("#filtroPanelSupervisor_Fecha").val();
      d_turno = $("#filtroPanelSupervisor_Turno").val();
      d_area = $("#filtroPanelSupervisor_Area").val();
      d_planta = $(this).attr("data-pla");
      d_agrupacion = $(this).attr("data-agr");
      d_programaProduccion = $(this).attr("data-pro");

      $.ajax({
        type: "POST",
        url: "f_panelSupervisorDatosPuestosTrabajo.php",
        beforeSend: function () {
            $(".Info_CargarDatosPueTraTableroSupervisorNuevo").html(loader());
        },
        data: { codigo: d_codigo, referencia: d_referencia, fecha: d_fecha, turno: d_turno, area: d_area, planta: d_planta, agrupacion: d_agrupacion, programaProduccion: d_programaProduccion },
        success: function (data) {
            $(".Info_CargarDatosPueTraTableroSupervisorNuevo").html(data);
        },
        error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
        }
      });
    });
  
    // Datos Panel Supervisor Puesto de trabajo
    $("body").on("click", ".Btn_CargarPanelSupervisorDatosCalidad", function (e) {
      e.preventDefault();

      d_codigo = $(".Inp_CodigoAgrupacionPanelSupervisor").val();
      d_referencia = $("#filtroPanelSupervisor_Referencia").val();
      d_fecha = $("#filtroPanelSupervisor_Fecha").val();
      d_turno = $("#filtroPanelSupervisor_Turno").val();
      d_area = $("#filtroPanelSupervisor_Area").val();
      d_planta = $(this).attr("data-pla");
      d_agrupacion = $(this).attr("data-agr");
      d_programaProduccion = $(this).attr("data-pro");

      $.ajax({
        type: "POST",
        url: "f_panelSupervisorDatosCalidad.php",
        beforeSend: function () {
            $(".Info_CargarDatosCalidadTableroSupervisorNuevo").html(loader());
        },
        data: { codigo: d_codigo, referencia: d_referencia, fecha: d_fecha, turno: d_turno, area: d_area, planta: d_planta, agrupacion: d_agrupacion, programaProduccion: d_programaProduccion },
        success: function (data) {
            $(".Info_CargarDatosCalidadTableroSupervisorNuevo").html(data);
        },
        error: function (er1, er2, er3) {
            console.log(er2 + "-" + er3);
        }
      });
    });
  
    $("body").on("click", ".e_cargarRespuestaVariablePanelOperador", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-resp");
        d_estacionUsuario = $(this).attr("data-estu");

        $("#vtn_DetalleRespuestasSupervisor").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorDetalleRespuestas.php",
            beforeSend: function () {
                $(".info_DetalleRespuestasSupervisor").html(loader());
            },
            data: {codigo: d_codigo, estacionUsuario: d_estacionUsuario},
            success: function (data) {
                $(".info_DetalleRespuestasSupervisor").html(data);
//        $(".mensajeCreadoCorrectamentePSDR").html('');
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", "#btn_actualizarSupervisorInfo", function (e) {
        d_codigo = $("#codigoRespuestaActual").val();
        d_codigoplanaccion = $("#codigoPlanAccionActual").val();
        d_observacion = $("#guardarObservacionRespuesta").val();
        d_estacionUsuario = $("#estacionServicioActual").val();
        d_valor = $("#guardarValorRespuesta").val();
        $.ajax({
            type: "POST",
            url: "op_respuestaObservacionSupervisorActualizar.php",
            beforeSend: function () {
                $(".info_DetalleRespuestasSupervisor").html(loader());
            },
            data: {
                codigo: d_codigo,
                observacion: d_observacion,
                codigoplanaccion: d_codigoplanaccion,
            },
            success: function (data) {
                $.ajax({
                    type: "POST",
                    url: "op_respuestaValorSupervisorActualizar.php",
                    beforeSend: function () {
                        $(".info_DetalleRespuestasSupervisor").html(loader());
                    },
                    data: {
                        codigo: d_codigo,
                        valor: d_valor
                    },
                    success: function (data) {
                        $.ajax({
                            type: "POST",
                            url: "f_panelSupervisorDetalleRespuestas.php",
                            beforeSend: function () {
                                $(".info_DetalleRespuestasSupervisor").html(loader());
                            },
                            data: {codigo: d_codigo, estacionUsuario: d_estacionUsuario},
                            success: function (data) {
                                $(".info_DetalleRespuestasSupervisor").html(data);
//        $(".mensajeCreadoCorrectamentePSDR").html('');
                            },
                            error: function (er1, er2, er3) {
                                console.log(er2 + "-" + er3);
                            }
                        });
                    },
                    error: function (er1, er2, er3) {
                        console.log(er1);
                        console.log(er2);
                        console.log(er3);
                    }
                });
            },
            error: function (er1, er2, er3) {
                console.log(er1);
                console.log(er2);
                console.log(er3);
            }
        });
    });

    $("body").on("click", "#btn_actualizarSupervisorInfo2", function (e) {
        d_codigoplanaccion = $("#codigoPlanAccionActual2").val();
        d_observacion = $("#guardarObservacionRespuesta2").val();
        d_codigo = $("#codigoRespuestaActual2").val();
        $.ajax({
            type: "POST",
            url: "op_respuestaObservacionSupervisorActualizar.php",
            beforeSend: function () {
                $(".info_DetalleRespuestasSupervisor").html(loader());
            },
            data: {
                codigo: d_codigo,
                observacion: d_observacion,
                codigoplanaccion: d_codigoplanaccion,
            },
            success: function (data) {
                $.ajax({
                    type: "POST",
                    url: "f_panelSupervisorDetalleRespuestarPokayoque.php",
                    beforeSend: function () {
                        $(".info_DetalleRespuestasPokayoqueSupervisor").html(loader());
                    },
                    data: {codigo: d_codigo},
                    success: function (data) {
                        $(".info_DetalleRespuestasPokayoqueSupervisor").html(data);
//        $(".mensajeCreadoCorrectamentePSDR").html('');
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

    $("body").on("click", ".e_cargarRespuestaVariablePokayoquePanelOperador", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-resp");

        $("#vtn_DetalleRespuestasPokayoqueSupervisor").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorDetalleRespuestarPokayoque.php",
            beforeSend: function () {
                $(".info_DetalleRespuestasPokayoqueSupervisor").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_DetalleRespuestasPokayoqueSupervisor").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });
    $("body").on("click", ".e_guardarActRadio", function (e) {
        $(".e_guardarActRadio").prop('checked', false);

        d_codigo = $("#codigoRespuestaActual").val();
        d_numero = $(this).attr("data-num");
        switch (d_numero) {
            case '1' :
                $("#input_1").prop('checked', true);
                break;
            case '0' :
                $("#input_2").prop('checked', true);
                break;
            case '2' :
                $("#input_3").prop('checked', true);
                break;
        }
        $.ajax({
            type: "POST",
            url: "op_respuestaNumeroActualizar.php",
            beforeSend: function () {
            },
            data: {
                codigo: d_codigo,
                numero: d_numero,
            },
            success: function (data) {
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", "#Btn_PanelSupervisorObservacionCrear", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-res");

        $("#vtn_PanelSupervisorObservacionCrear").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorObservacion.php",
            beforeSend: function () {
                $(".info_PanelSupervisorObservacionCrear").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_PanelSupervisorObservacionCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_panelSupervisorObservacionCrear", function (e) {
        e.preventDefault();

        d_resCodigo = $("#f_panelSupervisorObservacionCrear #Res_Codigo").val();
        d_observacion = $("#f_panelSupervisorObservacionCrear #ResO_Observacion").val();

        $.ajax({
            type: "POST",
            url: "op_panelSupervisorObservacionCrear.php",
            beforeSend: function () {
                bloquearFormulario("f_panelSupervisorObservacionCrear");
                $("#Btn_PanelSupervisorObservacionCrearForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_panelSupervisorObservacionCrear");
                $("#Btn_PanelSupervisorObservacionCrearForm").show();
            },
            data: {resCodigo: d_resCodigo, observacion: d_observacion},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_PanelSupervisorObservacionNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_PanelSupervisorObservacionNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
                } else {
                    $("#vtn_PanelSupervisorObservacionNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_PanelSupervisorObservacionNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_PanelSupervisorObservacionNotificacionesCrear", function (e) {
        e.preventDefault();

        $("#vtn_PanelSupervisorObservacionCrear").modal('hide');
        $("#vtn_PanelSupervisorObservacionNotificacionesCrear").modal('hide');
        d_resCodigo = $("#f_panelSupervisorObservacionCrear #Res_Codigo").val();

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorDetalleRespuestas.php",
            beforeSend: function () {
                $(".info_DetalleRespuestasSupervisor").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_DetalleRespuestasSupervisor").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarPanelSupervisorObservacionEditar", function (e) {
        e.preventDefault();

        d_ResO_Codigo = $(this).attr("data-cod");
        d_Res_Codigo = $(this).attr("data-res");

        $("#vtn_PanelSupervisorObservacionActualizar").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorObservacionActualizar.php",
            beforeSend: function () {
                $(".info_PanelSupervisorObservacionActualizar").html(loader());
            },
            data: {codigo: d_ResO_Codigo, Res_Codigo: d_Res_Codigo},
            success: function (data) {
                $(".info_PanelSupervisorObservacionActualizar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_panelSupervisorObservacionActualizarForm", function (e) {
        e.preventDefault();

        d_ResO_Codigo = $("#f_panelSupervisorObservacionActualizarForm #ResO_CodigoAct").val();
        d_observacion = $("#f_panelSupervisorObservacionActualizarForm #ResO_ObservacionAct").val();

        $.ajax({
            type: "POST",
            url: "op_panelSupervisorObservacionActualizar.php",
            beforeSend: function () {
                bloquearFormulario("f_panelSupervisorObservacionActualizarForm");
                $("#Btn_PanelSupervisorObservacionActualizarForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_panelSupervisorObservacionActualizarForm");
                $("#Btn_PanelSupervisorObservacionActualizarForm").show();
            },
            data: {codigo: d_ResO_Codigo, observacion: d_observacion},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_PanelSupervisorObservacionNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_PanelSupervisorObservacionNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
                } else {
                    mensaje('2', rs.mensaje);
                    $("#vtn_PanelSupervisorObservacionNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_PanelSupervisorObservacionNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_PanelSupervisorObservacionNotificacionesActualizar", function (e) {
        e.preventDefault();

        $("#vtn_PanelSupervisorObservacionNotificacionesActualizar").modal('hide');
        $("#vtn_PanelSupervisorObservacionActualizar").modal('hide');
        d_resCodigo = $("#f_panelSupervisorObservacionActualizarForm #Res_CodigoAct").val();

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorDetalleRespuestas.php",
            beforeSend: function () {
                $(".info_DetalleRespuestasSupervisor").html(loader());
            },
            data: {codigo: d_codigo},
            success: function (data) {
                $(".info_DetalleRespuestasSupervisor").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_eliminarPanelSupervisorObservacionEliminar", function (e) {
        e.preventDefault();

        d_ResO_Codigo = $(this).attr("data-cod");
        d_Res_Codigo = $(this).attr("data-res");


        $(".Cod_Res_Codigo").val(d_Res_Codigo);

        $.ajax({
            type: "POST",
            url: "op_panelSupervisorObservacionEliminar.php",
            beforeSend: function () {
                $(".e_eliminarPanelSupervisorObservacionEliminar").hide();
            },
            complete: function () {
                $(".e_eliminarPanelSupervisorObservacionEliminar").show();
            },
            data: {codigo: d_ResO_Codigo, Res_Codigo: d_Res_Codigo},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_PanelSupervisorObservacionNotificacionesEliminar").modal({backdrop: 'static'});
                    $(".info_PanelSupervisorObservacionNotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
                } else {
                    $("#vtn_PanelSupervisorObservacionNotificacionesEliminar").modal({backdrop: 'static'});
                    $(".info_PanelSupervisorObservacionNotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_PanelSupervisorObservacionNotificacionesEliminar", function (e) {
        e.preventDefault();

        d_Res_Codigo = $(".Cod_Res_Codigo").val();

        $("#vtn_PanelSupervisorObservacionNotificacionesEliminar").modal('hide');

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorDetalleRespuestas.php",
            beforeSend: function () {
                $(".info_DetalleRespuestasSupervisor").html(loader());
            },
            data: {codigo: d_Res_Codigo},
            success: function (data) {
                $(".info_DetalleRespuestasSupervisor").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });


    });

    $("body").on("click", ".e_cargarRefProProPanelSupervisorListar", function (e) {
        e.preventDefault();

        d_area = $(this).attr("data-are");
        d_planta = $(this).attr("data-pla");

        $("#vtn_ProgramaProduccionSupervisorInfo").modal({backdrop: 'static'});

        $.ajax({
            type: "POST",
            url: "f_referenciaProduccionManualSupervisor.php",
            beforeSend: function () {
                $(".info_ProgramaProduccionSupervisorInfo").html(loader());
            },
            data: {area: d_area, planta: d_planta},
            success: function (data) {
                $(".info_ProgramaProduccionSupervisorInfo").html(data);
                d_fecha = $("#filtroReferenciaproduccion_Fecha").val();
                d_area = $("#filtroReferenciaproduccion_Area").val();
                d_planta = $("#referenciasPMPanelSupervisor_planta").val();

                $.ajax({
                    type: "POST",
                    url: "f_referenciaProduccionManualSupervisorListar.php",
                    beforeSend: function () {
                        $(".info_cargarReferenciaProduccionManualSupervisorListar").html(loader());
                    },
                    data: {fecha: d_fecha, area: d_area, planta: d_planta},
                    success: function (data) {
                        $(".info_cargarReferenciaProduccionManualSupervisorListar").html(data);
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

    $("body").on("click", ".e_cargarusuariosLPanelSupervisorListar", function (e) {
        e.preventDefault();

        d_agrupacion = $(this).attr("data-agr");
        d_planta = $(this).attr("data-pla");
        d_fecha = $("#filtroPanelSupervisor_Fecha").val();
        d_turno = $("#filtroPanelSupervisor_Turno").val();
        d_area = $("#filtroPanelSupervisor_Area").val();

        $("#vtn_PanelSupervisorUsuariosLogueados").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorUsuariosLogueados.php",
            beforeSend: function () {
                $(".info_PanelSupervisorUsuariosLogueados").html(loader());
            },
            data: {agrupacion: d_agrupacion, planta: d_planta, fecha: d_fecha, turno: d_turno, area: d_area},
            success: function (data) {
                $(".info_PanelSupervisorUsuariosLogueados").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarusuariosLPanelSupervisorNotificacion", function (e) {
        e.preventDefault();

        d_agrupacion = $(this).attr("data-agr");
        d_planta = $(this).attr("data-pla");
        d_fecha = $("#filtroPanelSupervisor_Fecha").val();
        d_turno = $("#filtroPanelSupervisor_Turno").val();
        d_area = $("#filtroPanelSupervisor_Area").val();
        d_formato = $(this).attr("data-for");
        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_referencia = $("#filtroPanelSupervisor_Referencia").val();

        $("#vtn_PanelSupervisorUsuariosLogueados").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorUsuariosLogueNot.php",
            beforeSend: function () {
                $(".info_PanelSupervisorUsuariosLogueados").html(loader());
            },
            data: {agrupacion: d_agrupacion, planta: d_planta, fecha: d_fecha, turno: d_turno, area: d_area, formato: d_formato, familia: d_familia, color: d_color, referencia: d_referencia},
            success: function (data) {
                $(".info_PanelSupervisorUsuariosLogueados").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

//  $("body").on("click", "#Btn_referenciaPMBuscar", function(e){
//    e.preventDefault();
//    
//    d_fecha = $("#filtroReferenciaproduccion_Fecha").val();
//    d_area = $("#filtroReferenciaproduccion_Area").val();
//    d_planta = $("#referenciasPMPanelSupervisor_planta").val();
//    
//    $.ajax({
//      type:"POST",
//      url:"f_referenciaProduccionManualSupervisorListar.php",
//      beforeSend: function() {
//        $(".info_cargarReferenciaProduccionManualSupervisorListar").html(loader());
//      },
//      data:{ fecha: d_fecha, area: d_area, planta: d_planta },
//      success: function(data) {
//        $(".info_cargarReferenciaProduccionManualSupervisorListar").html(data);
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });
//  
//  });

    $("body").on("change", "#filtroReferenciaproduccion_Fecha", function (e) {
        e.preventDefault();

        d_fecha = $("#filtroReferenciaproduccion_Fecha").val();
        d_area = $("#filtroReferenciaproduccion_Area").val();
        d_planta = $("#referenciasPMPanelSupervisor_planta").val();

        $.ajax({
            type: "POST",
            url: "f_referenciaProduccionManualSupervisorListar.php",
            beforeSend: function () {
                $(".info_cargarReferenciaProduccionManualSupervisorListar").html(loader());
            },
            data: {fecha: d_fecha, area: d_area, planta: d_planta},
            success: function (data) {
                $(".info_cargarReferenciaProduccionManualSupervisorListar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("change", "#filtroReferenciaproduccion_Area", function (e) {
        e.preventDefault();

        d_fecha = $("#filtroReferenciaproduccion_Fecha").val();
        d_area = $("#filtroReferenciaproduccion_Area").val();
        d_planta = $("#referenciasPMPanelSupervisor_planta").val();

        $.ajax({
            type: "POST",
            url: "f_referenciaProduccionManualSupervisorListar.php",
            beforeSend: function () {
                $(".info_cargarReferenciaProduccionManualSupervisorListar").html(loader());
            },
            data: {fecha: d_fecha, area: d_area, planta: d_planta},
            success: function (data) {
                $(".info_cargarReferenciaProduccionManualSupervisorListar").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    //Observaciones Supervisor Panel Operador
    $("body").on("click", ".Btn_GuardarObsSupPanelSupDet", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-res");
        d_codigoPlanAccion = $(this).attr("data-cod");
        d_observacion = $("#OanelSupDet_ObservacionesSup").val();

        $.ajax({
            type: "POST",
            url: "op_detallePanelSupervisorObservaciones.php",
            beforeSend: function () {
                $(".Btn_GuardarObsSupPanelSupDet").hide();
            },
            complete: function () {
                $(".Btn_GuardarObsSupPanelSupDet").show();
            },
            data: {codigoPlanAccion: d_codigoPlanAccion, observacion: d_observacion},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $.ajax({
                        type: "POST",
                        url: "f_panelSupervisorDetalleRespuestas.php",
                        beforeSend: function () {
                            $(".info_DetalleRespuestasSupervisor").html(loader());
                        },
                        data: {codigo: d_codigo},
                        success: function (data) {
                            $(".info_DetalleRespuestasSupervisor").html(data);
                            $(".mensajeCreadoCorrectamentePSDR").html('<div class="alert alert-success"> <strong>Creado correctamente</strong> </div>');
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "f_panelSupervisorDetalleRespuestas.php",
                        beforeSend: function () {
                            $(".info_DetalleRespuestasSupervisor").html(loader());
                        },
                        data: {codigo: d_codigo},
                        success: function (data) {
                            $(".info_DetalleRespuestasSupervisor").html(data);
                            $(".mensajeCreadoCorrectamentePSDR").html('<div class="alert alert-danger"> <strong>No Creado</strong> </div>');
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

    $("body").on("click", ".e_eliminarEstacionUsuarioFotoPrinpal", function (e) {
        e.preventDefault();

        d_usuario = $(this).attr("data-cod");
        d_turno = $(this).attr("data-tur");

        $.ajax({
            type: "POST",
            url: "op_inactivarEstacionUsuarioOperadorPrinpal.php",
            beforeSend: function () {
                $(".Btn_OcultarEstUsuInactivar").hide();
            },
            complete: function () {
                $(".Btn_OcultarEstUsuInactivar").show();
            },
            data: {usuario: d_usuario, turno: d_turno},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    window.location.href = "f_operador.php";
                } else {
                    window.location.href = "f_operador.php";
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    //Variables PokaYoke 1 Solo Guardar
    $("body").on("submit", "#f_variablesMasivasOperadorPokCrear", function (e) {
        e.preventDefault();

        d_a = $(".Num_CantVariablesTomaOpePok").val();
        d_b = $(".Num_CantVariablesTomaOpePok").attr("data-conMaq");
        d_estacionUsuario = $(".Num_CantVariablesTomaOpePok").attr("data-estu");
        d_hora = $(".Num_CantVariablesTomaOpePok").attr("data-hor");
        d_programaProduccion = $(".Num_CantVariablesTomaOpePok").attr("data-prop");
        d_fecha = $(".Num_CantVariablesTomaOpePok").attr("data-fec");

        d_lista1 = []; // accion
        d_lista2 = []; // valor
        d_lista3 = []; // observacion
        d_lista4 = []; // variable
        d_lista5 = []; // Cod Respuesta
        d_lista6 = []; // Cod Plan Acción
        d_lista7 = []; // Requiere mantenimiento
        d_lista8 = []; // Tarjeta Roja
        d_lista9 = []; // Aviso SAP
        d_lista10 = []; // Observaciones
        d_lista11 = []; // Usuario SAP
        d_lista12 = []; // Fecha mantenimiento
        d_lista13 = []; // observación vacio
        d_lista14 = []; // maquina Vacio
        d_lista15 = []; // accion
        d_lista16 = []; // Codigo observación vacio
//    d_lista13 = []; // Días transcurridos


        cont = 0;
        $(".Inp_CheInfoPok:checked").each(function () {
            varia = $(this).attr("data-var");
            d_lista1[cont] = $(this).attr("data-acc");
            d_lista2[cont] = $(this).attr("data-val");
            d_lista3[cont] = $("#PlaA_ObservacionesOperarioPok" + varia).val();
            d_lista4[cont] = $(this).attr("data-var");
            d_lista5[cont] = $(this).attr("data-cod");
            d_lista6[cont] = $("#PlaA_ObservacionesOperarioPok" + varia).attr("data-codplaa");

            if ($("#PlaA_Mantenimiento" + varia).prop("checked") == true) {
                d_lista7[cont] = 1;
            } else {
                d_lista7[cont] = 0;
            }

            d_lista8[cont] = $("#PlaA_Mant_TarjetaRoja" + varia).val();
            d_lista9[cont] = $("#PlaA_Mant_AvisoSAP" + varia).val();
            d_lista10[cont] = $("#PlaA_Mant_Observaciones" + varia).val();
            d_lista11[cont] = $("#PlaA_Mant_usuarioSAP" + varia).val();
            d_lista12[cont] = $("#PlaA_Mant_Fecha" + varia).val();
            cont++;
        });
        d_num = cont;

        cont2 = 0;
        for (r = 0; r < d_b; r++) {

            d_lista13[cont2] = $(".T_CampoVacioObservacion" + r).val();
            d_lista14[cont2] = $(".T_CampoVacioObservacion" + r).attr("data-maq");
            d_lista15[cont2] = $(".T_CampoVacioObservacion" + r).attr("data-acc");
            d_lista16[cont2] = $(".T_CampoVacioObservacion" + r).attr("data-codObse");

            cont2++;
        }

        d_num2 = cont2;

        $.ajax({
            type: "POST",
            url: "op_respuestasMasivasTomaVariablesPok.php",
            beforeSend: function () {
                bloquearFormulario("f_variablesMasivasOperadorPokCrear");
                $(".ocultarBtn_GuardarMasivoVarTOpePok").hide();
            },
            complete: function () {
                desbloquearFormulario("f_variablesMasivasOperadorPokCrear");
                $(".ocultarBtn_GuardarMasivoVarTOpePok").show();
            },
            data: { lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, lista5: d_lista5, lista6: d_lista6, lista7: d_lista7, lista8: d_lista8, lista9: d_lista9, lista10: d_lista10, lista11: d_lista11, lista12: d_lista12, num: d_num, estacionUsuario: d_estacionUsuario, hora: d_hora, num2: d_num2, lista13: d_lista13, programaProduccion: d_programaProduccion, num2: d_num2, lista13: d_lista13, lista14: d_lista14, lista15: d_lista15, lista16: d_lista16, fecha: d_fecha },
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $(".Rec_PanelOperador").click();
                } else {
                    $(".Rec_PanelOperador").click();
                    $(".ocultarBtn_GuardarMasivoVarTOpePok").show();
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

//    console.log(d_lista1);
//    console.log(d_lista2);
//    console.log(d_lista3);
//    console.log(d_lista4);
//    console.log(d_lista5);
//    console.log(d_lista6);
//    console.log(d_num);

    });

    $("body").on("change", ".Int_SeleccionTodosVaciosPokayoke", function (e) {
        e.preventDefault();

        if ($(this).prop("checked") == true) {
            $(".campoVacioSelectPokayoke").prop("checked", true);
            $(".TObs_CampoValorPokTodos").attr("disabled", "true");
            $(".T_CampoVacioObserPok").attr("required", "true");
            $(".T_CampoVacioObserPok").removeAttr("disabled", "false");
            $(".T_CampoVacioObserPok").css("border-color", "#E86868");

        } else {
            $(".campoVacioSelectPokayoke").prop("checked", false);
            $(".TObs_CampoValorPokTodos").removeAttr("disabled", "false");
            $(".T_CampoVacioObserPok").removeAttr("required", "false");
            $(".T_CampoVacioObserPok").attr("disabled", "true");
            $(".T_CampoVacioObserPok").css("border-color", "#ccc");

        }

    });

    $("body").on("change", ".CambioReqMan", function (e) {
        e.preventDefault();

        d_variable = $(this).attr("data-var");


        if ($("#PlaA_Mantenimiento" + d_variable).prop("checked") == true) {
            $("#PlaA_Mant_TarjetaRoja" + d_variable).attr("required", true);
            $("#PlaA_Mant_AvisoSAP" + d_variable).attr("required", true);
            $("#PlaA_Mant_TarjetaRoja" + d_variable).css("border", "2px solid #BC2818");
            $("#PlaA_Mant_AvisoSAP" + d_variable).css("border", "2px solid #BC2818");
        } else {
            $("#PlaA_Mant_TarjetaRoja" + d_variable).removeAttr("required");
            $("#PlaA_Mant_AvisoSAP" + d_variable).removeAttr("required");
            $("#PlaA_Mant_TarjetaRoja" + d_variable).css("border", "#ccc");
            $("#PlaA_Mant_AvisoSAP" + d_variable).css("border", "#ccc");
        }


    });

    $("body").on("change", ".Inp_CheInfoPok", function (e) {
        e.preventDefault();

        d_variable = $(this).attr("data-var");
        d_maquina = $(this).attr("data-maq");
        d_valor = $(this).attr("data-val");

        if (d_valor == "0") {
            $("#PlaA_ObservacionesOperarioPok" + d_variable).attr("required", true);
            $("#PlaA_ObservacionesOperarioPok" + d_variable).css("border-color", "#E86868");

        } else {
            $("#PlaA_ObservacionesOperarioPok" + d_variable).removeAttr("required", true);
            $("#PlaA_ObservacionesOperarioPok" + d_variable).css("border-color", "#ccc");
        }

        if ($("#VM_ValorVacio" + d_variable).prop("checked") == true) {
            $(".T_CampoVacioObservacionUnico" + d_maquina).attr("required", "true");
            $(".T_CampoVacioObservacionUnico" + d_maquina).removeAttr("disabled", "false");
            $(".T_CampoVacioObservacionUnico" + d_maquina).css("border-color", "#E86868");
            $("#PlaA_ObservacionesOperarioPok" + d_variable).attr("disabled", "true");
        } else {
            $(".T_CampoVacioObservacionUnico" + d_maquina).removeAttr("required", "false");
            $(".T_CampoVacioObservacionUnico" + d_maquina).attr("disabled", "true");
            $(".T_CampoVacioObservacionUnico" + d_maquina).css("border-color", "#ccc");
            $("#PlaA_ObservacionesOperarioPok" + d_variable).removeAttr("disabled", "false");
        }

    });


    //Acciones Modulo Calidad
    $("body").on("click", ".e_cargarVariablesCalidad", function (e) {
        e.preventDefault();

        $("#vtn_VariablesMasivasCalidadCrear").modal({backdrop: 'static'});

        d_codigo = $(this).attr("data-estu");
        d_hora = $(this).attr("data-hor");
        d_formato = $(this).attr("data-for");
        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_codigoPorcentajeCalidad = $(this).attr("data-porCal");
        d_programaProduccion = $(this).attr("data-prop");
        d_fecha = $(this).attr("data-fec");

        $.ajax({
            type: "POST",
            url: "f_variablesMasivasCalidadCrear.php",
            beforeSend: function () {
                $(".info_VariablesMasivasCalidadCrear").html(loader());
            },
           data: {
                codigo: d_codigo,
                hora: d_hora,
                formato: d_formato,
                familia: d_familia,
                color: d_color,
                porcentajeCalidad: d_codigoPorcentajeCalidad,
                programaProduccion: d_programaProduccion,
                fecha: d_fecha
            },
            success: function (data) {
                $(".info_VariablesMasivasCalidadCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("keypress", "#f_variablesMasivasCalidadCrear", function (e) {

        //tecla = (document.all) ? e.keyCode : e.which; 
        tecla = (e.keyCode) ? k = e.keyCode : k = e.which;

        //console.log(tecla); 
        if (tecla == 13 || tecla == 9 || (e.shiftKey && e.keyCode == 9)) {
            e.preventDefault();
        } else {

        }
    });

    $("body").on("submit", "#f_variablesMasivasCalidadCrear", function (e) {
        e.preventDefault();

        d_codEstU = $("#f_variablesMasivasCalidadCrear #ResCcodigoEstU").val();
        d_vacioObservacion = $("#f_variablesMasivasCalidadCrear .vacRC_VacioObservacion").val();
        d_formato = $(".Num_CantVariablesCalidad").attr("data-for");
        d_familia = $(".Num_CantVariablesCalidad").attr("data-fam");
        d_color = $(".Num_CantVariablesCalidad").attr("data-col");
        d_hora = $(".Num_CantVariablesCalidad").attr("data-hor");
        d_codigoObservacionVacio = $("#f_variablesMasivasCalidadCrear .vacRC_VacioObservacion").attr("data-codObserVacio");
        d_fecha = $(".Num_CantVariablesCalidad").attr("data-fec");
        d_programaProduccion = $(".Num_CantVariablesCalidad").attr("data-prop");
        d_codigoPorcentajeCalidad = $(".Btn_GuardarMasivoVarCalidad").attr("data-porCal");
        $(".Cod_porcal").val(d_codigoPorcentajeCalidad);

        d_a = $(".Num_CantVariablesCalidad").val();

        d_valorComp = 0;

        d_lista1 = []; // Valor
        d_lista2 = []; // Observacion
        d_lista3 = []; // Codigo calidad
        d_lista4 = []; // accion
        d_lista5 = []; // Codigo respuesta
        d_lista28 = []; // Vacio

        cont = 0;
//    d_valorCompTotal = 0;
        for (r = 0; r < d_a; r++) {
            d_valor = $("#ResC_ValorControl" + r).val();

            d_lista1[cont] = $("#ResC_ValorControl" + r).val();
            d_lista2[cont] = $("#ResC_Observacion" + r).val();
            d_lista3[cont] = $("#Cal_Codigo" + r).val();
            d_lista4[cont] = $("#ResC_ValorControl" + r).attr("data-acc");
            d_lista5[cont] = $("#ResC_ValorControl" + r).attr("data-cod");

//        d_valorCompTotal = Number(number_format(d_valorCompTotal, 1, ".", "")) + Number(d_valor);

            if ($(".T_CampoVacioCalidad" + r).prop("checked") == true) {
                d_lista28[cont] = 1;
            } else {
                d_lista28[cont] = 0;
            }

            cont++;
        }

//    console.log(d_valorCompTotal);

        d_num = cont;

        ////////////////////////////////////////////////////////////////////////////////////////////////

        d_Cal_CodigoSegunda = $(".Cal_CodigoSegunda").val();

        // segunda 

        d_s = $(".Num_CantVariablesdefectosSegunda").val();

        d_valorComp2 = 0;

        d_lista6 = []; // ForD_Codigo
        d_lista7 = []; // Defecto
        d_lista8 = []; // Estampo
        d_lista9 = []; // lado
        d_lista10 = []; // Numero de piezas
        d_lista11 = []; // Acción

        cont2 = 0;
        d_valorComp2 = 0;
        d_validarCero = 0;
        for (r = 0; r < d_s; r++) {
            d_valor = $("#ForD_CodigoSegunda" + r).val();

            d_lista6[cont2] = $("#ForD_CodigoSegunda" + r).val();
            d_lista7[cont2] = $("#ForD_DefectoSegunda" + r).val();
            d_lista8[cont2] = $("#ForD_EstampoSegunda" + r).val();
            d_lista9[cont2] = $("#ForD_LadoSegunda" + r).val();
            if ($("#ForD_NumeroPiezasSegunda" + r).val() == "0") {
                d_validarCero += 1;
            }
            d_lista10[cont2] = $("#ForD_NumeroPiezasSegunda" + r).val();
            d_lista11[cont2] = $("#ForD_NumeroPiezasSegunda" + r).attr("data-acc");

            d_valorComp2 = Number(number_format(d_valorComp2, 1, ".", "")) + Number(d_valor);
            cont2++;
        }

//    console.log(d_valorComp2);

        d_numSegunda = cont2;


        //segunda Ayer 


        d_sa = $(".Num_CantVariablesdefectosSegundaAyer").val();

        d_valorComp = 0;

        d_lista12 = []; // Defecto
        d_lista13 = []; // Estampo
        d_lista14 = []; // lado
        d_lista15 = []; // Numero de piezas
        d_lista16 = []; // Acción

        cont3 = 0;
        d_valorComp = 0;
        for (r = 0; r < d_sa; r++) {
            d_valor = $("#ForD_NumeroPiezasSegundaAyer" + r).val();

            d_lista12[cont3] = $("#ForD_DefectoSegundaAyer" + r).val();
            d_lista13[cont3] = $("#ForD_EstampoSegundaAyer" + r).val();
            d_lista14[cont3] = $("#ForD_LadoSegundaAyer" + r).val();
            if ($("#ForD_NumeroPiezasSegundaAyer" + r).val() == "0") {
                d_validarCero += 1;
            }
            d_lista15[cont3] = $("#ForD_NumeroPiezasSegundaAyer" + r).val();
            d_lista16[cont3] = $("#ForD_NumeroPiezasSegundaAyer" + r).attr("data-acc");

            d_valorComp = Number(number_format(d_valorComp, 1, ".", "")) + Number(d_valor);
            cont3++;

        }

//    console.log(d_valorComp);

        d_numSegundaAyer = cont3;

        //rotura 

        d_Cal_CodigoRotura = $(".Cal_CodigoRotura").val();

        d_r = $(".Num_CantVariablesdefectosRotura").val();

        d_valorComp = 0;

        d_lista17 = []; // ForD_Codigo
        d_lista18 = []; // Defecto
        d_lista19 = []; // Estampo
        d_lista20 = []; // lado
        d_lista21 = []; // Numero de piezas
        d_lista22 = []; // Acción

        cont4 = 0;
        d_valorComp = 0;
        for (r = 0; r < d_r; r++) {
            d_valor = $("#ForD_CodigoRotura" + r).val();

            d_lista17[cont4] = $("#ForD_CodigoRotura" + r).val();
            d_lista18[cont4] = $("#ForD_DefectoRotura" + r).val();
            d_lista19[cont4] = $("#ForD_EstampoRotura" + r).val();
            d_lista20[cont4] = $("#ForD_LadoRotura" + r).val();
            if ($("#ForD_NumeroPiezasRotura" + r).val() == "0") {
                d_validarCero += 1;
            }
            d_lista21[cont4] = $("#ForD_NumeroPiezasRotura" + r).val();
            d_lista22[cont4] = $("#ForD_NumeroPiezasRotura" + r).attr("data-acc");

            d_valorComp = Number(number_format(d_valorComp, 1, ".", "")) + Number(d_valor);
            cont4++;

        }

//    console.log(d_valorComp);

        d_numRotura = cont4;

        //rotura Ayer 

        d_r = $(".Num_CantVariablesdefectosRoturaAyer").val();

        d_valorComp = 0;

        d_lista23 = []; // Defecto
        d_lista24 = []; // Estampo
        d_lista25 = []; // lado
        d_lista26 = []; // Numero de piezas
        d_lista27 = []; // Acción

        cont5 = 0;
        d_valorComp = 0;
        for (r = 0; r < d_r; r++) {
            d_valor = $("#ForD_NumeroPiezasRoturaAyer" + r).val();

            d_lista23[cont5] = $("#ForD_DefectoRoturaAyer" + r).val();
            d_lista24[cont5] = $("#ForD_EstampoRoturaAyer" + r).val();
            d_lista25[cont5] = $("#ForD_LadoRoturaAyer" + r).val();
            if ($("#ForD_NumeroPiezasRoturaAyer" + r).val() == "0") {
                d_validarCero += 1;
            }
            d_lista26[cont5] = $("#ForD_NumeroPiezasRoturaAyer" + r).val();
            d_lista27[cont5] = $("#ForD_NumeroPiezasRoturaAyer" + r).attr("data-acc");

            d_valorComp = Number(number_format(d_valorComp, 1, ".", "")) + Number(d_valor);
            cont5++;

        }

//    console.log(d_valorComp);

        d_numRoturaAyer = cont5;

        ////////////////////////////////////////////////////////////////////////////////////////////////

//    if( d_valorCompTotal == "100"){
        if (d_validarCero == "0") {
            $(".info_CargarMensajeValidacionSuma").html('');
            $.ajax({
                type: "POST",
                url: "op_respuestasMasivasTomaVariablesCalidad.php",
                beforeSend: function () {
                    bloquearFormulario("f_variablesMasivasCalidadCrear");
                    $("#Btn_GuardarMasivoVarCalidad").hide();
                    $(".ocultarBotonVariablesMCCrear").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_variablesMasivasCalidadCrear");
                    $("#Btn_GuardarMasivoVarCalidad").show();
                    $(".ocultarBotonVariablesMCCrear").show();
                },
                data: { formato: d_formato, familia: d_familia, color: d_color, hora: d_hora, lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, lista5: d_lista5, num: d_num, codEstU: d_codEstU, lista6: d_lista6, lista7: d_lista7, lista8: d_lista8, lista9: d_lista9, lista10: d_lista10, lista11: d_lista11, numSegunda: d_numSegunda, lista12: d_lista12, lista13: d_lista13, lista14: d_lista14, lista15: d_lista15, lista16: d_lista16, numSegundaAyer: d_numSegundaAyer, lista17: d_lista17, lista18: d_lista18, lista19: d_lista19, lista20: d_lista20, lista21: d_lista21, lista22: d_lista22, numRotura: d_numRotura, lista23: d_lista23, lista24: d_lista24, lista25: d_lista25, lista26: d_lista26, lista27: d_lista27, lista28: d_lista28, numRoturaAyer: d_numRoturaAyer, calCodSegunda: d_Cal_CodigoSegunda, calCodRotura: d_Cal_CodigoRotura, codigoPorcentajeCalidad: d_codigoPorcentajeCalidad, vacioObservacion: d_vacioObservacion, programaProduccion: d_programaProduccion, codigoObservacionVacio: d_codigoObservacionVacio, fecha: d_fecha },
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        $("#vtn_VariablesMasivasCalidadNotificacionesGuardar").modal({backdrop: 'static'});
                        $(".info_VariablesMasivasCalidadNotificacionesGuardar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Variables guardadas Correctamente</h3>');
                    } else {
                        mensaje('2', rs.mensaje);
                        $("#vtn_VariablesMasivasCalidadNotificacionesGuardar").modal({backdrop: 'static'});
                        $(".info_VariablesMasivasCalidadNotificacionesGuardar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>Variables NO Guardadas</h3>');
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });
        } else {
            $(".info_CargarMensajeValidacionSuma").html('<div class="alert alert-danger"> <strong> El número de piezas no puede ser 0</strong> </div>');
        }
//    }else{
//      $(".info_CargarMensajeValidacionSuma").html('<div class="alert alert-danger"> <strong>La sumatoria total de los valores es '+d_valorCompTotal+' y debe ser el 100%, por favor verificar y volver a guardar</strong> </div>');
//    }

    });

    $("body").on("change", ".Int_SeleccionTodosVaciosCalidad", function (e) {
        e.preventDefault();

        if ($(this).prop("checked") == true) {
            $(".campoVacioSelecCalidad").prop("checked", true);
            $(".validarValorControlCalidad").attr("disabled", "true");
            $(".ResC_ObservacionTodos").attr("disabled", "true");
            $(".vacRC_VacioObservacion").removeAttr("disabled", "false");
            $(".e_cargarMensajeVacioCalidad").html('<div class="alert alert-warning"> <strong>La información del campo de "valor" se va a borrar para la fila donde seleccionó la opción de paro</strong> </div>');
        } else {
            $(".campoVacioSelecCalidad").prop("checked", false);
            $(".validarValorControlCalidad").removeAttr("disabled", "false");
            $(".ResC_ObservacionTodos").removeAttr("disabled", "false");
            $(".vacRC_VacioObservacion").attr("disabled", "true");
            $(".e_cargarMensajeVacioCalidad").html('');
        }
    });

    $("body").on("change", ".campoVacioSelecCalidad", function (e) {
        e.preventDefault();

        d_cont = $(this).attr("data-cont");

        if ($(this).prop("checked") == true) {
            $(".vacRC_VacioObservacion").removeAttr("disabled", "false");
            $("#ResC_ValorControl" + d_cont).attr("disabled", "true");
            $(".e_cargarMensajeVacioCalidad").html('<div class="alert alert-warning"> <strong>La información del campo de "valor" se va a borrar para la fila donde seleccionó la opción de paro</strong> </div>');
        } else {
            $("#ResC_ValorControl" + d_cont).removeAttr("disabled", "false");
            $(".e_cargarMensajeVacioCalidad").html('');
            $(".vacRC_VacioObservacion").attr("disabled", "true");
        }
    });

    $("body").on("click", "#Btn_VariablesMasivasCalidadNotificacionesGuardar", function (e) {
        e.preventDefault();

        $("#vtn_VariablesMasivasCalidadNotificacionesGuardar").modal('hide');

        d_codigo = $("#f_variablesMasivasCalidadCrear #ResCcodigoEstU").val();
        d_formato = $("#f_variablesMasivasCalidadCrear #ResCformato").val();
        d_familia = $("#f_variablesMasivasCalidadCrear #ResCfamilia").val();
        d_color = $("#f_variablesMasivasCalidadCrear #ResCcolor").val();
        d_hora = $("#f_variablesMasivasCalidadCrear #ResChora").val();
        d_programaProduccion = $("#f_variablesMasivasCalidadCrear #codProp").val();
        d_fecha = $("#f_variablesMasivasCalidadCrear #ResCFecha").val();
        d_codigoporcal = $(".Cod_porcal").val();

        $.ajax({
            type: "POST",
            url: "f_variablesMasivasCalidadCrear.php",
            beforeSend: function () {
                $(".info_VariablesMasivasCalidadCrear").html(loader());
            },
            data: {
                codigo: d_codigo,
                hora: d_hora,
                formato: d_formato,
                familia: d_familia,
                color: d_color,
                porcentajeCalidad: d_codigoporcal,
                programaProduccion: d_programaProduccion,
                fecha: d_fecha
            },
            success: function (data) {
                $(".info_VariablesMasivasCalidadCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", "#Btn_VariablesMasivasCalidadSegundaCrear", function (e) {
        e.preventDefault();

        d_codCalidad = $(this).attr("data-cod");
        d_formato = $(this).attr("data-for");
        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_hora = $(this).attr("data-hor");
        d_codigoEstU = $(this).attr("data-EstU");
        d_tipoParametro = "2";

        $("#vtn_VariablesMasivasCalidadFormularioCrear").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_variablesMasivasCalidadFormulario.php",
            beforeSend: function () {
                $(".info_VariablesMasivasCalidadFormularioCrear").html(loader());
            },
            data: {codigo: d_codCalidad, hora: d_hora, tipoParametro: d_tipoParametro, formato: d_formato, familia: d_familia, color: d_color, codigoEstU: d_codigoEstU},
            success: function (data) {
                $(".info_VariablesMasivasCalidadFormularioCrear").html(data);
                $('#ForD_Defecto').multiselect({
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

    $("body").on("click", "#Btn_VariablesMasivasCalidadRoturaCrear", function (e) {
        e.preventDefault();

        d_codCalidad = $(this).attr("data-cod");
        d_formato = $(this).attr("data-for");
        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_hora = $(this).attr("data-hor");
        d_codigoEstU = $(this).attr("data-EstU");
        d_tipoParametro = "8";

        $("#vtn_VariablesMasivasCalidadFormularioCrear").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_variablesMasivasCalidadFormulario.php",
            beforeSend: function () {
                $(".info_VariablesMasivasCalidadFormularioCrear").html(loader());
            },
            data: {codigo: d_codCalidad, hora: d_hora, tipoParametro: d_tipoParametro, formato: d_formato, familia: d_familia, color: d_color, codigoEstU: d_codigoEstU},
            success: function (data) {
                $(".info_VariablesMasivasCalidadFormularioCrear").html(data);
                $('#ForD_Defecto').multiselect({
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

    $("body").on("submit", "#f_variablesMasivasCalidadFormulario", function (e) {
        e.preventDefault();

        d_defecto = $("#f_variablesMasivasCalidadFormulario #ForD_Defecto").val();
        d_estampo = $("#f_variablesMasivasCalidadFormulario #ForD_Estampo").val();
        d_lado = $("#f_variablesMasivasCalidadFormulario #ForD_Lado").val();
        d_numPieza = $("#f_variablesMasivasCalidadFormulario #ForD_NumeroPiezas").val();
        d_hora = $("#f_variablesMasivasCalidadFormulario #ForD_Hora").val();
        d_codCalidad = $("#f_variablesMasivasCalidadFormulario #Cal_Codigo").val();
        d_familia = $("#f_variablesMasivasCalidadFormulario #ForD_Familia").val();
        d_formato = $("#f_variablesMasivasCalidadFormulario #For_Codigo").val();
        d_color = $("#f_variablesMasivasCalidadFormulario #ForD_Color").val();
        d_codigoEstU = $("#f_variablesMasivasCalidadFormulario #ForD_codigoEstU").val();

        if (d_numPieza == 0) {
            $(".mensajeErrorDefectoCrear").html('<div class="alert alert-danger"> <strong> El número de piezas no puede ser 0</strong> </div>');
        } else {
            $.ajax({
                type: "POST",
                url: "op_variablesMasivasCalidadFormulario.php",
                beforeSend: function () {
                    bloquearFormulario("f_variablesMasivasCalidadFormulario");
                    $("#Btn_VariablesMasivasCalidadFormularioCrearForm").hide();
                },
                complete: function () {
                    desbloquearFormulario("f_variablesMasivasCalidadFormulario");
                    $("#Btn_VariablesMasivasCalidadFormularioCrearForm").show();
                },
                data: {defecto: d_defecto, estampo: d_estampo, lado: d_lado, numPieza: d_numPieza, hora: d_hora, codCalidad: d_codCalidad, formato: d_formato, familia: d_familia, color: d_color, codigoEstU: d_codigoEstU},
                dataType: 'json',
                success: function (rs) {
                    if (rs.mensaje == "OK") {
                        $("#vtn_VariablesMasivasCalidadFormularioNotificacionesCrear").modal({backdrop: 'static'});
                        $(".info_VariablesMasivasCalidadFormularioNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Defecto creado Correctamente</h3>');
                        $("#f_variablesMasivasCalidadCrear").submit();
                    } else {
                        mensaje('2', rs.mensaje);
                        $("#vtn_VariablesMasivasCalidadFormularioNotificacionesCrear").modal({backdrop: 'static'});
                        $(".info_VariablesMasivasCalidadFormularioNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>Defecto NO Creado</h3>');
                    }
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });
        }

    });

    $("body").on("click", "#Btn_VariablesMasivasCalidadFormularioNotificacionesCrear", function (e) {
        e.preventDefault();

        $("#vtn_VariablesMasivasCalidadFormularioNotificacionesCrear").modal('hide');
        $("#vtn_VariablesMasivasCalidadFormularioCrear").modal('hide');

//    d_codigo = $("#f_variablesMasivasCalidadCrear #ResCcodigoEstU").val();
//    d_formato = $("#f_variablesMasivasCalidadCrear #ResCformato").val();
//    d_familia = $("#f_variablesMasivasCalidadCrear #ResCfamilia").val();
//    d_color = $("#f_variablesMasivasCalidadCrear #ResCcolor").val();
//    d_hora = $("#f_variablesMasivasCalidadCrear #ResChora").val();
//    
//    $.ajax({
//      type:"POST",
//      url:"f_variablesMasivasCalidadCrear.php",
//      beforeSend: function() {
//        $(".info_VariablesMasivasCalidadCrear").html(loader());
//      },
//      data:{
//        codigo: d_codigo,
//        hora: d_hora,
//        formato: d_formato,
//        familia: d_familia,
//        color: d_color
//      },
//      success: function(data) {
//        $(".info_VariablesMasivasCalidadCrear").html(data);
//      },
//      error: function(er1, er2, er3) {
//        console.log(er2+"-"+er3);
//      }
//    });

    });

    $("body").on("click", ".e_editarCalidadSegunda", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");
        d_tipoParametro = "2";

        $("#vtn_VariablesMasivasCalidadFormularioActualizar").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_variableMasivasCalidadFormularioActualizar.php",
            beforeSend: function () {
                $(".info_VariablesMasivasCalidadFormularioActualizar").html(loader());
            },
            data: {codigo: d_codigo, tipoParametro: d_tipoParametro},
            success: function (data) {
                $(".info_VariablesMasivasCalidadFormularioActualizar").html(data);
                $('#ForD_DefectoAct').multiselect({
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

    $("body").on("submit", "#f_variablesMasivasCalidadFormularioActualizar", function (e) {
        e.preventDefault();

        d_ForD_Codigo = $("#f_variablesMasivasCalidadFormularioActualizar #ForD_Codigo").val();
        d_defecto = $("#f_variablesMasivasCalidadFormularioActualizar #ForD_DefectoAct").val();
        d_estampo = $("#f_variablesMasivasCalidadFormularioActualizar #ForD_EstampoAct").val();
        d_lado = $("#f_variablesMasivasCalidadFormularioActualizar #ForD_LadoAct").val();
        d_numPieza = $("#f_variablesMasivasCalidadFormularioActualizar #ForD_NumeroPiezasAct").val();

        $.ajax({
            type: "POST",
            url: "op_variablesMasivasCalidadFormularioActualizar.php",
            beforeSend: function () {
                bloquearFormulario("f_variablesMasivasCalidadFormularioActualizar");
                $("#Btn_VariablesMasivasCalidadFormularioActualizarForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_variablesMasivasCalidadFormularioActualizar");
                $("#Btn_VariablesMasivasCalidadFormularioActualizarForm").show();
            },
            data: {codigo: d_ForD_Codigo, defecto: d_defecto, estampo: d_estampo, lado: d_lado, numPieza: d_numPieza},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_VariablesMasivasCalidadFormularioNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_VariablesMasivasCalidadFormularioNotificacionesActualizar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
                } else {
                    mensaje('2', rs.mensaje);
                    $("#vtn_VariablesMasivasCalidadFormularioNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_VariablesMasivasCalidadFormularioNotificacionesActualizar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_VariablesMasivasCalidadFormularioNotificacionesActualizar", function (e) {
        e.preventDefault();

        $("#vtn_VariablesMasivasCalidadFormularioNotificacionesActualizar").modal('hide');
        $("#vtn_VariablesMasivasCalidadFormularioActualizar").modal('hide');

        d_codigo = $("#f_variablesMasivasCalidadCrear #ResCcodigoEstU").val();
        d_formato = $("#f_variablesMasivasCalidadCrear #ResCformato").val();
        d_familia = $("#f_variablesMasivasCalidadCrear #ResCfamilia").val();
        d_color = $("#f_variablesMasivasCalidadCrear #ResCcolor").val();
        d_hora = $("#f_variablesMasivasCalidadCrear #ResChora").val();

        $.ajax({
            type: "POST",
            url: "f_variablesMasivasCalidadCrear.php",
            beforeSend: function () {
                $(".info_VariablesMasivasCalidadCrear").html(loader());
            },
            data: {
                codigo: d_codigo,
                hora: d_hora,
                formato: d_formato,
                familia: d_familia,
                color: d_color
            },
            success: function (data) {
                $(".info_VariablesMasivasCalidadCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_editarCalidadRotura", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");
        d_tipoParametro = "8";

        $("#vtn_VariablesMasivasCalidadFormularioActualizar").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_variableMasivasCalidadFormularioActualizar.php",
            beforeSend: function () {
                $(".info_VariablesMasivasCalidadFormularioActualizar").html(loader());
            },
            data: {codigo: d_codigo, tipoParametro: d_tipoParametro},
            success: function (data) {
                $(".info_VariablesMasivasCalidadFormularioActualizar").html(data);
                $('#ForD_DefectoAct').multiselect({
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

    $("body").on("click", ".e_eliminarCalidadFormulario", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $.ajax({
            type: "POST",
            url: "op_variableMasivasCalidadFormularioEliminar.php",
            beforeSend: function () {
                $(".e_eliminarCalidadFormulario").hide();
            },
            complete: function () {
                $(".e_eliminarCalidadFormulario").show();
            },
            data: {codigo: d_codigo},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_VariablesMasivasCalidadFormularioNotificacionesEliminar").modal({backdrop: 'static'});
                    $(".info_VariablesMasivasCalidadFormularioNotificacionesEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
                } else {
                    mensaje('2', rs.mensaje);
                    $("#vtn_VariablesMasivasCalidadFormularioNotificacionesEliminar").modal({backdrop: 'static'});
                    $(".info_VariablesMasivasCalidadFormularioNotificacionesEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Eliminado</h3>');
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_VariablesMasivasCalidadFormularioNotificacionesEliminar", function (e) {
        e.preventDefault();

        $("#vtn_VariablesMasivasCalidadFormularioNotificacionesEliminar").modal('hide');

        d_codigo = $("#f_variablesMasivasCalidadCrear #ResCcodigoEstU").val();
        d_formato = $("#f_variablesMasivasCalidadCrear #ResCformato").val();
        d_familia = $("#f_variablesMasivasCalidadCrear #ResCfamilia").val();
        d_color = $("#f_variablesMasivasCalidadCrear #ResCcolor").val();
        d_hora = $("#f_variablesMasivasCalidadCrear #ResChora").val();

        $.ajax({
            type: "POST",
            url: "f_variablesMasivasCalidadCrear.php",
            beforeSend: function () {
                $(".info_VariablesMasivasCalidadCrear").html(loader());
            },
            data: {
                codigo: d_codigo,
                hora: d_hora,
                formato: d_formato,
                familia: d_familia,
                color: d_color
            },
            success: function (data) {
                $(".info_VariablesMasivasCalidadCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarVariablesSegundaInforme", function (e) {
        e.preventDefault();

        d_formato = $(this).attr("data-for");
        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_hora = $(this).attr("data-hor");
        d_fecha = $(this).attr("data-fec");

        $("#vtn_VariablesMasivasCalidadListarInfoSegundaCrear").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_variablesMasivasCalidadListarTS.php",
            beforeSend: function () {
                $(".info_VariablesMasivasCalidadListarInfoSegundaCrear").html(loader());
            },
            data: {formato: d_formato, familia: d_familia, color: d_color, hora: d_hora, fecha: d_fecha},
            success: function (data) {
                $(".info_VariablesMasivasCalidadListarInfoSegundaCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarVariablesRoturaInforme", function (e) {
        e.preventDefault();

        d_formato = $(this).attr("data-for");
        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_hora = $(this).attr("data-hor");
        d_fecha = $(this).attr("data-fec");

        $("#vtn_VariablesMasivasCalidadListarInfoRoturaCrear").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_variablesMasivasCalidadListarTSRotura.php",
            beforeSend: function () {
                $(".info_VariablesMasivasCalidadListarInfoRoturaCrear").html(loader());
            },
            data: {formato: d_formato, familia: d_familia, color: d_color, hora: d_hora, fecha: d_fecha},
            success: function (data) {
                $(".info_VariablesMasivasCalidadListarInfoRoturaCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarCenterLine", function (e) {
        e.preventDefault();

        $("#vtn_centerLine").modal({
            backdrop: 'static'
        });

        d_formato = $(this).attr("data-for");
        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_maquina = $(this).attr("data-maq");
        d_variableNombre = $(this).attr("data-var");
        d_operador = $(this).attr("data-ope");
        d_control = $(this).attr("data-con");
        d_tolerancia = $(this).attr("data-tol");
        d_codigoVariable = $(this).attr("data-varC");
        d_area = $(this).attr("data-are");
        d_turno = $(this).attr("data-tur");
        d_fecha = $(this).attr("data-fec");
        d_agrupacion = $(this).attr("data-agr");
        d_puestoTrabajo = $(this).attr("data-pue");
        d_cantAreas = $(this).attr("data-cantAre");
        d_progProd = $(this).attr("data-prop");
        d_tipgra = $(this).attr("data-tipgra");

        $.ajax({
            type: "POST",
            url: "f_centerLineTS.php?v=1",
            beforeSend: function () {
                $(".info_centerLine").html(loader());
            },
           data: { formato: d_formato, familia: d_familia, color: d_color, maquina: d_maquina, nombreVariable: d_variableNombre, operador: d_operador, control: d_control, tolerancia: d_tolerancia, codigoVariable: d_codigoVariable, area: d_area, turno: d_turno, fecha: d_fecha, agrupacion: d_agrupacion, puestoTrabajo: d_puestoTrabajo, cantAreas: d_cantAreas, progProd: d_progProd, tipgra: d_tipgra },
            success: function (data) {
                $(".info_centerLine").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", ".e_cargarCenterLinePuestaPunto", function (e) {
        e.preventDefault();

        $("#vtn_centerLine").modal({
            backdrop: 'static'
        });

        d_formato = $(this).attr("data-for");
        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_maquina = $(this).attr("data-maq");
        d_variableNombre = $(this).attr("data-var");
        d_operador = $(this).attr("data-ope");
        d_control = $(this).attr("data-con");
        d_tolerancia = $(this).attr("data-tol");
        d_codigoVariable = $(this).attr("data-varC");
        d_area = $(this).attr("data-are");
        d_turno = $(this).attr("data-tur");
        d_fecha = $(this).attr("data-fec");
        d_agrupacion = $(this).attr("data-agr");
        d_progProd = $(this).attr("data-prop");

        $.ajax({
            type: "POST",
            url: "f_centerLineTSPuestaPunto.php",
            beforeSend: function () {
                $(".info_centerLine").html(loader());
            },
            data: {formato: d_formato, familia: d_familia, color: d_color, maquina: d_maquina, nombreVariable: d_variableNombre, operador: d_operador, control: d_control, tolerancia: d_tolerancia, codigoVariable: d_codigoVariable, area: d_area, turno: d_turno, fecha: d_fecha, agrupacion: d_agrupacion, progProd: d_progProd},
            success: function (data) {
                $(".info_centerLine").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", ".e_cargarCenterLineOperador", function (e) {
        e.preventDefault();

        $("#vtn_centerLineOperador").modal({
            backdrop: 'static'
        });

        d_formato = $(this).attr("data-for");
        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_maquina = $(this).attr("data-maq");
        d_variableNombre = $(this).attr("data-var");
        d_operador = $(this).attr("data-ope");
        d_control = $(this).attr("data-con");
        d_tolerancia = $(this).attr("data-tol");
        d_codigoVariable = $(this).attr("data-varC");
        d_area = $(this).attr("data-are");
        d_turno = $(this).attr("data-tur");
        d_fecha = $(this).attr("data-fec");
        d_agrupacion = $(this).attr("data-agr");
        d_progProd = $(this).attr("data-prop");
        d_puestoTrabajo = $(this).attr("data-pue");
      
        $.ajax({
            type: "POST",
            url: "f_centerLineTSPuestaPunto.php",
            beforeSend: function () {
                $(".info_centerLineOperador").html(loader());
            },
            data: {formato: d_formato, familia: d_familia, color: d_color, maquina: d_maquina, nombreVariable: d_variableNombre, operador: d_operador, control: d_control, tolerancia: d_tolerancia, codigoVariable: d_codigoVariable, area: d_area, turno: d_turno, fecha: d_fecha, agrupacion: d_agrupacion, progProd: d_progProd, puestoTrabajo: d_puestoTrabajo},
            success: function (data) {
                $(".info_centerLineOperador").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarCenterLineOperadorMoliendaPE", function (e) {
        e.preventDefault();

        $("#vtn_centerLineOperador").modal({
            backdrop: 'static'
        });

        d_formato = $(this).attr("data-for");
        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_maquina = $(this).attr("data-maq");
        d_variableNombre = $(this).attr("data-var");
        d_operador = $(this).attr("data-ope");
        d_control = $(this).attr("data-con");
        d_tolerancia = $(this).attr("data-tol");
        d_codigoVariable = $(this).attr("data-varC");
        d_area = $(this).attr("data-are");
        d_turno = $(this).attr("data-tur");
        d_fecha = $(this).attr("data-fec");
        d_agrupacion = $(this).attr("data-agr");

        $.ajax({
            type: "POST",
            url: "f_centerLineMoliendaPE.php",
            beforeSend: function () {
                $(".info_centerLineOperador").html(loader());
            },
            data: {formato: d_formato, familia: d_familia, color: d_color, maquina: d_maquina, nombreVariable: d_variableNombre, operador: d_operador, control: d_control, tolerancia: d_tolerancia, codigoVariable: d_codigoVariable, area: d_area, turno: d_turno, fecha: d_fecha, agrupacion: d_agrupacion},
            success: function (data) {
                $(".info_centerLineOperador").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_PanelSupervisorUsuariosLogueadosNotActualizar", function (e) {
        e.preventDefault();
        $(".e_cargarusuariosLPanelSupervisorNotificacion").click();
    });

    $("body").on("click", ".e_cargarDefectosSegundaPAC", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");
        d_calidad = $(this).attr("data-cal");
        d_estacionUsuario = $(this).attr("data-estU");
        d_formato = $(this).attr("data-for");
        d_familia = $(this).attr("data-fam");
        d_color = $(this).attr("data-col");
        d_fecha = $(this).attr("data-fec");
        d_agrupacion = $(this).attr("data-agr");
        d_turno = $(this).attr("data-tur");

        //variables para validación de turno 3
//    d_horaInicial = $(this).attr("data-horI");
//    d_horaFinal = $(this).attr("data-horF");
//    d_fecI1 = $(this).attr("data-fecI1");
//    d_fecF1 = $(this).attr("data-fecF1");
//    d_horI1 = $(this).attr("data-horI1");
//    d_horF1 = $(this).attr("data-horF1");
//    d_horI2 = $(this).attr("data-horI2");
//    d_horF2 = $(this).attr("data-horF2");
//    d_valTur = $(this).attr("data-valTur");
//    d_Tur = $(this).attr("data-Tur");

        d_fecInicial = $(this).attr("data-fecI");
        d_fecFinal = $(this).attr("data-fecF");

        d_lista1 = []; // valor
        d_lista2 = []; // hora
        d_lista3 = []; // color
        d_lista4 = []; // fecha

        d_a = $(this).attr("data-num");
        d_fila = $(this).attr("data-fil");
        d_tipo = $(this).attr("data-tip");

        if (d_tipo == "segunda") {
            cont = 0;
            for (r = 0; r < d_a; r++) {
                d_valor = $("#F" + d_fila + "_" + r).val();

                if (d_valor != "") {
                    d_lista1[cont] = $("#F" + d_fila + "_" + r).val();
                    d_lista2[cont] = $("#F" + d_fila + "_" + r).attr("data-hor");
                    d_lista3[cont] = $("#F" + d_fila + "_" + r).attr("data-col");
                    d_lista4[cont] = $("#F" + d_fila + "_" + r).attr("data-fec");

                    cont++;
                }
            }

            d_num = cont;
        }

        if (d_tipo == "retal") {
            cont = 0;
            for (r = 0; r < d_a; r++) {
                d_valor = $("#F" + d_fila + "_" + r).val();

                if (d_valor != "") {
                    d_lista1[cont] = $("#Fr" + d_fila + "_" + r).val();
                    d_lista2[cont] = $("#Fr" + d_fila + "_" + r).attr("data-hor");
                    d_lista3[cont] = $("#Fr" + d_fila + "_" + r).attr("data-col");
                    d_lista4[cont] = $("#Fr" + d_fila + "_" + r).attr("data-fec");

                    cont++;
                }
            }

            d_num = cont;
        }

        $("#vtn_PanelSupervisorSegundaPACCrear").modal({
            backdrop: 'static'
        });

//    horaInicial : d_horaInicial, horaFinal: d_horaFinal, fechaInicial1: d_fecI1, fechaFinal1: d_fecF1, horaInicial1: d_horI1, horaFinal1: d_horF1, horaInicial2: d_horI2, horaFinal2: d_horF2, valTur: d_valTur, turno: d_Tur

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorPAC.php",
            beforeSend: function () {
                $(".info_PanelSupervisorSegundaPACCrear").html(loader());
            },

            data: {codigo: d_codigo, calidad: d_calidad, formato: d_formato, familia: d_familia, color: d_color, fecha: d_fecha, estacionUsu: d_estacionUsuario, num: d_num, lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, fechaInicial: d_fecInicial, fechaFinal: d_fecFinal, tipo: d_tipo, fila: d_fila, agrupacion: d_agrupacion, turno: d_turno},
            success: function (data) {
                $(".info_PanelSupervisorSegundaPACCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("change", ".e_cambioOrigenCargueVariable", function (e) {
        e.preventDefault();

        d_cont = $(this).attr("data-cod");
        d_area = $("#Pac_Origen" + d_cont).val();
        d_formato = $(".e_cambioOrigenCargueVariable").attr("data-for");
        d_familia = $(".e_cambioOrigenCargueVariable").attr("data-fam");
        d_color = $(".e_cambioOrigenCargueVariable").attr("data-col");

        $.ajax({
            type: "POST",
            url: "f_cargarMaquinasPAC.php",
            beforeSend: function () {
                $(".e_cargarMaquinaPAC" + d_cont).html(loader());
            },
            data: {
                area: d_area, cont: d_cont, formato: d_formato, familia: d_familia, color: d_color
            },
            success: function (data) {
                $(".e_cargarMaquinaPAC" + d_cont).html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("change", ".e_cambioOrigenCargueMaquina", function (e) {
        e.preventDefault();

        d_cont = $(this).attr("data-cod");
        d_area = $("#Pac_Origen" + d_cont).val();
        d_maquina = $("#Maq_Codigo" + d_cont).val();
        d_formato = $(".e_cambioOrigenCargueMaquina").attr("data-for");
        d_familia = $(".e_cambioOrigenCargueMaquina").attr("data-fam");
        d_color = $(".e_cambioOrigenCargueMaquina").attr("data-col");


        $.ajax({
            type: "POST",
            url: "f_cargarVariablesPAC.php",
            beforeSend: function () {
                $(".e_cargarVariablesPAC" + d_cont).html(loader());
            },
            data: {
                area: d_area, cont: d_cont, formato: d_formato, familia: d_familia, color: d_color, maquina: d_maquina
            },
            success: function (data) {
                $(".e_cargarVariablesPAC" + d_cont).html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("submit", "#f_PanelSupervisorSegundaPACCrear", function (e) {
        e.preventDefault();

        d_calidad = $(".Btn_GuardarMasivoPAC").attr("data-cal");
//    d_fecha = $(".Btn_GuardarMasivoPAC").attr("data-fec");
        d_formato = $(".e_cambioOrigenCargueVariable").attr("data-for");
        d_familia = $(".e_cambioOrigenCargueVariable").attr("data-fam");
        d_color = $(".e_cambioOrigenCargueVariable").attr("data-col");

        d_p = $(".Num_CantVariablesPAC").val();

        d_valorComp = 0;

        d_lista1 = []; // Origen ->Area
        d_lista2 = []; // ForD_Codigo
        d_lista3 = []; // Hora Ajuste
        d_lista4 = []; // Variables fuera de control
        d_lista5 = []; // Acción operador
        d_lista6 = []; // Acción supervisor
        d_lista7 = []; // Requerimiento SAP
        d_lista8 = []; // Supervisor
        d_lista9 = []; // Hora
        d_lista10 = []; // Pac_Codigo
        d_lista11 = []; // Acción
        d_lista12 = []; // variables fuera de control otras
        d_lista13 = []; // Maquina
        d_lista14 = []; // fecha
        d_lista15 = []; // fecha programada
        d_lista16 = []; // fecha real
        d_lista17 = []; // Observación jefes - directores
        d_lista18 = []; // Porcentajes

        cont6 = 0;
        d_valorComp = 0;
        for (r = 0; r < d_p; r++) {
            d_origen = $("#Pac_Origen" + r).val();
            d_maquina = $("#Maq_Codigo" + r).val();
            d_variable = $("#Pac_VariablesFC" + r).val();

            if (d_origen != "" && d_maquina != "" && d_variable != "") {
                d_lista1[cont6] = $("#Pac_Origen" + r).val();
                d_lista2[cont6] = $("#ForD_Codigo" + r).val();
                d_lista3[cont6] = $("#Pac_HoraAjuste" + r).val();
                d_lista4[cont6] = $("#Pac_VariablesFC" + r).val();
                d_lista5[cont6] = $("#Pac_AccionOperador" + r).val();
                d_lista6[cont6] = $("#Pac_AccionSupervisor" + r).val();
                d_lista7[cont6] = $("#Pac_RequerimientoSAP" + r).val();
                d_lista8[cont6] = $("#Pac_Supervisor" + r).val();
                d_lista9[cont6] = $("#Pac_Hora" + r).val();
                d_lista10[cont6] = $("#Pac_Codigo" + r).val();
                d_lista11[cont6] = $("#accion" + r).val();
                d_lista12[cont6] = $("#Pac_VariablesFCOtro" + r).val();
                d_lista13[cont6] = $("#Maq_Codigo" + r).val();
                d_lista14[cont6] = $("#Pac_Fecha" + r).val();
                d_lista15[cont6] = $("#Pac_FechaProgramada" + r).val();
                d_lista16[cont6] = $("#Pac_FechaReal" + r).val();
                d_lista17[cont6] = $("#Pac_ObservacionJefes" + r).val();
                d_lista18[cont6] = $("#Pac_Porcentaje" + r).val();
            }
            cont6++;
        }

        d_num = cont6;

        console.log(d_lista12);

        $.ajax({
            type: "POST",
            url: "op_panelSupervisorPAC.php",
            beforeSend: function () {
                bloquearFormulario("f_PanelSupervisorSegundaPACCrear");
                $(".ocultarBtn_GuardarMasivoPAC").hide();
                $(".Btn_GuardarMasivoPAC").hide();
            },
            complete: function () {
                desbloquearFormulario("f_PanelSupervisorSegundaPACCrear");
                $(".ocultarBtn_GuardarMasivoPAC").show();
                $(".Btn_GuardarMasivoPAC").show();
            },
            data: {calidad: d_calidad, formato: d_formato, familia: d_familia, color: d_color, lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, lista5: d_lista5, lista6: d_lista6, lista7: d_lista7, lista8: d_lista8, lista9: d_lista9, num: d_num, lista10: d_lista10, lista11: d_lista11, lista12: d_lista12, lista13: d_lista13, lista14: d_lista14, lista15: d_lista15, lista16: d_lista16, lista17: d_lista17, lista18: d_lista18},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_PanelSupervisorPACNot").modal({backdrop: 'static'});
                    $(".info_PanelSupervisorPACNot").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Guardado Correctamente</h3>');
                } else {
                    $("#vtn_PanelSupervisorPACNot").modal({backdrop: 'static'});
                    $(".info_PanelSupervisorPACNot").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO guardado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_PanelSupervisorPACNot", function (e) {
        e.preventDefault();

        $("#vtn_PanelSupervisorPACNot").modal('hide');
        $("#vtn_PanelSupervisorSegundaPACCrear").modal('hide');
//    $(".Btn_CargarPanelSupervisorDatos").click();

    });

    $("body").on("click", ".e_eliminarPAC", function (e) {
        e.preventDefault();

        d_codigo = $(this).attr("data-cod");

        $("#vtn_PanelSupervisorPACNotConfirmacion").modal({
            backdrop: 'static'
        });

        $(".CodEliminar").val(d_codigo);

    });

    $("body").on("click", "#Btn_PanelSupervisorPACNotConfirmacionForm", function (e) {
        e.preventDefault();

        $("#vtn_PanelSupervisorPACNotConfirmacion").modal('hide');

        d_codigo = $(".CodEliminar").val();

        $.ajax({
            type: "POST",
            url: "op_panelSupervisorPACEliminar.php",
            beforeSend: function () {
                $(".e_eliminarPAC").hide();
            },
            complete: function () {
                $(".e_eliminarPAC").show();
            },
            data: {codigo: d_codigo},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_PanelSupervisorPACNotEliminar").modal({backdrop: 'static'});
                    $(".info_PanelSupervisorPACNotEliminar").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Eliminado Correctamente</h3>');
                } else {
                    $("#vtn_PanelSupervisorPACNotEliminar").modal({backdrop: 'static'});
                    $(".info_PanelSupervisorPACNotEliminar").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_PanelSupervisorPACNotEliminar", function (e) {
        e.preventDefault();

        $("#vtn_PanelSupervisorPACNotEliminar").modal('hide');

        d_codigo = $(".e_eliminarPAC").attr("data-bot");
        d_calidad = $(".e_eliminarPAC").attr("data-cal");
        d_estacionUsuario = $(".e_eliminarPAC").attr("data-estU");
        d_formato = $(".e_eliminarPAC").attr("data-for");
        d_familia = $(".e_eliminarPAC").attr("data-fam");
        d_color = $(".e_eliminarPAC").attr("data-col");
        d_fecha = $(".e_eliminarPAC").attr("data-fec");

        d_fecInicial = $(".e_eliminarPAC").attr("data-fecI");
        d_fecFinal = $(".e_eliminarPAC").attr("data-fecF");

        d_lista1 = []; // valor
        d_lista2 = []; // hora
        d_lista3 = []; // color
        d_lista4 = []; // fecha

        d_a = $(".e_eliminarPAC").attr("data-num");
        d_fila = $(".e_eliminarPAC").attr("data-fil");
        d_tipo = $(".e_eliminarPAC").attr("data-tip");

        if (d_tipo == "segunda") {
            cont = 0;
            for (r = 0; r < d_a; r++) {
                d_valor = $("#F" + d_fila + "_" + r).val();

                if (d_valor != "") {
                    d_lista1[cont] = $("#F" + d_fila + "_" + r).val();
                    d_lista2[cont] = $("#F" + d_fila + "_" + r).attr("data-hor");
                    d_lista3[cont] = $("#F" + d_fila + "_" + r).attr("data-col");
                    d_lista4[cont] = $("#F" + d_fila + "_" + r).attr("data-fec");

                    cont++;
                }
            }

            d_num = cont;
        }

        if (d_tipo == "retal") {
            cont = 0;
            for (r = 0; r < d_a; r++) {
                d_valor = $("#F" + d_fila + "_" + r).val();

                if (d_valor != "") {
                    d_lista1[cont] = $("#Fr" + d_fila + "_" + r).val();
                    d_lista2[cont] = $("#Fr" + d_fila + "_" + r).attr("data-hor");
                    d_lista3[cont] = $("#Fr" + d_fila + "_" + r).attr("data-col");
                    d_lista4[cont] = $("#Fr" + d_fila + "_" + r).attr("data-fec");

                    cont++;
                }
            }

            d_num = cont;
        }

        $.ajax({
            type: "POST",
            url: "f_panelSupervisorPAC.php",
            beforeSend: function () {
                $(".info_PanelSupervisorSegundaPACCrear").html(loader());
            },

            data: {codigo: d_codigo, calidad: d_calidad, formato: d_formato, familia: d_familia, color: d_color, fecha: d_fecha, estacionUsu: d_estacionUsuario, num: d_num, lista1: d_lista1, lista2: d_lista2, lista3: d_lista3, lista4: d_lista4, fechaInicial: d_fecInicial, fechaFinal: d_fecFinal, tipo: d_tipo},
            success: function (data) {
                $(".info_PanelSupervisorSegundaPACCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });


    });

    $("body").on("change", ".e_cambioPac_VariablesFC", function (e) {
        e.preventDefault();

        d_cont = $(this).attr("data-cod");
        d_variable = $("#Pac_VariablesFC" + d_cont).val();

        $.ajax({
            type: "POST",
            url: "f_cargarVariablesPACOtras.php",
            beforeSend: function () {
                $(".OtrasVariables" + d_cont).html(loader());
            },
            data: {cont: d_cont, variable: d_variable},
            success: function (data) {
                $(".OtrasVariables" + d_cont).html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    //HEALTH CHECK

    $("body").on("click", ".e_cargarHealthCheckCrear", function (e) {
        e.preventDefault();

        d_referencia = $(this).attr("data-ref");
        d_agrupacion = $(this).attr("data-agr");

        $("#vtn_HealthCheckPSCrear").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_healthCheckCrear.php",
            beforeSend: function () {
                $(".info_HealthCheckPSCrear").html(loader());
            },
            data: {referencia: d_referencia, agrupacion: d_agrupacion},
            success: function (data) {
                $(".info_HealthCheckPSCrear").html(data);
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
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("change", "#HeaC_ProcesoEvaluar", function (e) {
        e.preventDefault();

        d_puestoTrabajo = $("#f_healthCheckCrear #HeaC_ProcesoEvaluar").val();
        d_turno = $("#f_healthCheckCrear #turnoHC").val();

        $.ajax({
            type: "POST",
            url: "f_cargarOpcionesHealthCheck.php",
            beforeSend: function () {
                $(".cargarInfodefectoHealthCheck").html(loader());
            },
            data: {puestoTrabajo: d_puestoTrabajo, turno: d_turno},
            success: function (data) {
                $(".cargarInfodefectoHealthCheck").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("change", "#HeaC_Area", function (e) {
        e.preventDefault();
        d_area = $("#HeaC_Area").val();
        if (d_area == "Horno") {
            $.ajax({
                type: "POST",
                url: "f_cargarHornosHealthCheck.php",
                beforeSend: function () {
                    $(".e_cargarHornos").html(loader());
                },
                data: {},
                success: function (data) {
                    $(".e_cargarHornos").html(data);
                },
                error: function (er1, er2, er3) {
                    console.log(er2 + "-" + er3);
                }
            });
        } else {
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

    $("body").on("submit", "#f_healthCheckCrear", function (e) {
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

        $.ajax({
            type: "POST",
            url: "op_heathCheckCrear.php",
            beforeSend: function () {
                bloquearFormulario("f_healthCheckCrear");
                $("#Btn_HealthCheckPSCrearForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_healthCheckCrear");
                $("#Btn_HealthCheckPSCrearForm").show();
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
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_HealthCheckPSNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_HealthCheckPSNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente</h3>');
                } else {
                    mensaje('2', rs.mensaje);
                    $("#vtn_HealthCheckPSNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_HealthCheckPSNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("click", "#Btn_HealthCheckPSNotificacionesCrear", function (e) {
        e.preventDefault();

        $("#vtn_HealthCheckPSCrear").modal('hide');
        $("#vtn_HealthCheckPSNotificacionesCrear").modal('hide');

    });

    $("body").on("click", ".e_cargarChatCrear", function (e) {
        e.preventDefault();

        d_agrupacion = $(this).attr("data-agr");

        $("#vtn_ChatCanalCrear").modal({
            backdrop: 'static'
        });

        $.ajax({
            type: "POST",
            url: "f_chatCanal.php",
            beforeSend: function () {
                $(".info_ChatCanalCrear").html(loader());
            },
            data: {agrupacion: d_agrupacion},
            success: function (data) {
                $(".info_ChatCanalCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarPlanesAccion", function (e) {
        e.preventDefault();

        d_agrupacion = $(this).attr("data-agr");

        window.open('fm_consolidadoPAC.php?agrupacion=' + d_agrupacion);

    });

    $("body").on("submit", "#chatMensaje", function (e) {
        e.preventDefault();

        d_mensaje = $("#mensajeChatEnviar").val();
        d_agrupacion = $("#Agr_Codigo").val();
        d_adjunto = $("#chatMensaje #i_Arc_FT_Adjunto").val();

        $.ajax({
            type: "POST",
            url: "op_chatCrear.php",
            beforeSend: function () {
                bloquearFormulario("chatMensaje");
                $(".e_cargarMensaje").hide();
            },
            complete: function () {
                desbloquearFormulario("chatMensaje");
                $(".e_cargarMensaje").show();
            },
            data: {mensaje: d_mensaje, agrupacion: d_agrupacion, adjunto: d_adjunto},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $.ajax({
                        type: "POST",
                        url: "f_chatCanal.php",
                        beforeSend: function () {
                            $(".info_ChatCanalCrear").html(loader());
                        },
                        data: {agrupacion: d_agrupacion},
                        success: function (data) {
                            $(".info_ChatCanalCrear").html(data);
                        },
                        error: function (er1, er2, er3) {
                            console.log(er2 + "-" + er3);
                        }
                    });
                } else {
                    mensaje('2', rs.mensaje);
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".e_cargarImagenChat", function (e) {
        e.preventDefault();

        $("#vtn_ChatCanalImagen").modal({
            backdrop: 'static'
        });

        d_ruta = $(this).attr("data-rut");
        d_nombre = $(this).attr("data-nom");

        $.ajax({
            type: "POST",
            url: "f_chatCanalImagen.php",
            beforeSend: function () {
                $(".info_ChatCanalImagen").html(loader());
            },
            data: {ruta: d_ruta, nombre: d_nombre},
            success: function (data) {
                $(".info_ChatCanalImagen").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", ".Btn_puestaPuntoMasivoVarTOpe", function (e) {
        e.preventDefault();

        $("#vtn_PuestaPuntoCrear").modal({
            backdrop: 'static'
        });

        d_maquina = $(this).attr('data-maq');
        d_variable = $(this).attr('data-var');
        d_variableCodigo = $(this).attr('data-varCod');
        d_estacionUsu = $(this).attr('data-estUsu');
        d_hora = $(this).attr('data-hora');
        d_unidadMedida = $(this).attr('data-uni');
        d_tipo = $(this).attr('data-tip');
        d_fecha = $(this).attr('data-fec');

        $.ajax({
            type: "POST",
            url: "f_puestaPuntoCrear.php",
            beforeSend: function () {
                $(".info_PuestaPuntoCrear").html(loader());
            },
            data: { maquina: d_maquina, variable: d_variable, variableCodigo: d_variableCodigo, estaUsu: d_estacionUsu, hora: d_hora, unidadMedida: d_unidadMedida, tipo: d_tipo, fecha: d_fecha },
            success: function (data) {
                $(".info_PuestaPuntoCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });
    });

    $("body").on("submit", "#f_puestaPuntoCrear", function (e) {
        e.preventDefault();

        d_variable = $("#f_puestaPuntoCrear #Var_Codigo").val();
        d_programaProduccion = $("#f_puestaPuntoCrear #ProP_Codigo").val();
        d_unidadMedida = $("#f_puestaPuntoCrear #PueP_UnidadMedida").val();
        d_valorControl = $("#f_puestaPuntoCrear #PueP_ValorControl").val();
        d_operador = $("#f_puestaPuntoCrear #PueP_Operador").val();
        d_tolerancia = $("#f_puestaPuntoCrear #PueP_ValorTolerancia").val();
        d_motivoCambio = $("#f_puestaPuntoCrear #PueP_MotivoCambio").val();
        d_tipo = $("#f_puestaPuntoCrear #PueP_TipoVariable").val();
        d_hora = $("#f_puestaPuntoCrear #HoraSolicitadaPP").val();
        d_fecha = $("#f_puestaPuntoCrear #PueP_Fecha").val();
      
        $.ajax({
            type: "POST",
            url: "op_puestaPuntoCrear.php",
            beforeSend: function () {
                bloquearFormulario("f_puestaPuntoCrear");
                $("#vtn_PuestaPuntoCrear").hide();
            },
            complete: function () {
                desbloquearFormulario("f_puestaPuntoCrear");
                $("#vtn_PuestaPuntoCrear").show();
            },
            data: { variable: d_variable, programaProduccion: d_programaProduccion, unidadMedida: d_unidadMedida, valorControl: d_valorControl, operador: d_operador, tolerancia: d_tolerancia, motivoCambio: d_motivoCambio, tipo: d_tipo, hora: d_hora, fecha: d_fecha },
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_PuestaPuntoNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_PuestaPuntoNotificacionesCrear").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Creado Correctamente <br><br> Pendiente de autorización por parte del supervisor</h3>');
                } else {
                    mensaje('2', rs.mensaje);
                    $("#vtn_PuestaPuntoNotificacionesCrear").modal({backdrop: 'static'});
                    $(".info_PuestaPuntoNotificacionesCrear").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Creado</h3>');
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_PuestaPuntoNotificacionesCrear", function (e) {
        e.preventDefault();

        $("#vtn_PuestaPuntoNotificacionesCrear").modal('hide');
        $("#vtn_PuestaPuntoCrear").modal('hide');

    });

    $("body").on("click", ".Btn_puestaPuntoPanelSupervisor", function (e) {
        e.preventDefault();

        $("#vtn_PuestaPuntoTableroSupervisorCrear").modal({
            backdrop: 'static'
        });

        d_puestaPunto = $(this).attr("data-pue");
        d_maquina = $(this).attr("data-maq");

        $.ajax({
            type: "POST",
            url: "f_puestaPuntoSupervisorCrear.php",
            beforeSend: function () {
                $(".info_PuestaPuntoTableroSupervisorCrear").html(loader());
            },
            data: {puestaPunto: d_puestaPunto, maquina: d_maquina},
            success: function (data) {
                $(".info_PuestaPuntoTableroSupervisorCrear").html(data);
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("submit", "#f_puestaPuntoSupervisorActualizar", function (e) {
        e.preventDefault();

        d_codigoPuestaP = $("#f_puestaPuntoSupervisorActualizar #PueP_Codigo").val();
        d_valorControl = $("#f_puestaPuntoSupervisorActualizar #PueP_ValorControl").val();
        d_operador = $("#f_puestaPuntoSupervisorActualizar #PueP_Operador").val();
        d_tolerancia = $("#f_puestaPuntoSupervisorActualizar #PueP_ValorTolerancia").val();
        d_a = $("#f_puestaPuntoSupervisorActualizar #contadorAprobador").val();

        d_lista1 = []; // Observaciones
        d_lista2 = []; // Estado
        d_lista3 = []; // Codigo Actualizar
        d_lista4 = []; // Aprobador

        cont = 0;
       d_rechazar = 0;
        for (r = 1; r <= d_a; r++) {
            d_ObservacionSupervisor = $(".PueP_ObservacionSupervisor" + r).val();

            if (d_ObservacionSupervisor != "") {
                d_lista1[cont] = $(".PueP_ObservacionSupervisor" + r).val();
                d_lista2[cont] = $(".PueP_Estado"+ r).val();
                d_lista4[cont] = r;
              
                if($(".PueP_Estado"+ r).val() == "3"){
                  d_rechazar = 1;
                }
              
                if($(".PueP_ObservacionSupervisor" + r).attr("data-act") != ""){
                  d_lista3[cont] = $(".PueP_ObservacionSupervisor" + r).attr("data-act");
                }else{
                  d_lista3[cont] = "vacio";
                }
                

                cont++;
            } 
        }

        d_num = cont;

        $.ajax({
            type: "POST",
            url: "op_puestaPuntoSupervisorActualizar.php",
            beforeSend: function () {
                bloquearFormulario("f_puestaPuntoSupervisorActualizar");
                $("#Btn_PuestaPuntoTableroSupervisorCrearForm").hide();
            },
            complete: function () {
                desbloquearFormulario("f_puestaPuntoSupervisorActualizar");
                $("#Btn_PuestaPuntoTableroSupervisorCrearForm").show();
            },
            data: {PuestaPunto: d_codigoPuestaP, valorControl: d_valorControl, operador: d_operador, tolerancia: d_tolerancia, observacion: d_lista1, estado: d_lista2, num: d_num, lista3: d_lista3, rechazo: d_rechazar, aprobador: d_lista4},
            dataType: 'json',
            success: function (rs) {
                if (rs.mensaje == "OK") {
                    $("#vtn_PuestaPuntoSupervisorNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_PuestaPuntoSupervisorNotificaciones").html('<span class="glyphicon glyphicon-ok letra50 verde"></span><h3>Actualizado Correctamente</h3>');
                } else {
                    mensaje('2', rs.mensaje);
                    $("#vtn_PuestaPuntoSupervisorNotificacionesActualizar").modal({backdrop: 'static'});
                    $(".info_PuestaPuntoSupervisorNotificaciones").html('<span class="glyphicon glyphicon-remove letra50 rojo"></span><h3>NO Actualizado</h3>');
                }
            },
            error: function (er1, er2, er3) {
                console.log(er2 + "-" + er3);
            }
        });

    });

    $("body").on("click", "#Btn_PuestaPuntoSupervisorNotificacionesActualizar", function (e) {
        e.preventDefault();

        $("#vtn_PuestaPuntoSupervisorNotificacionesActualizar").modal('hide');
        $("#vtn_PuestaPuntoTableroSupervisorCrear").modal('hide');

        $(".Btn_CargarPanelSupervisorDatos").click();

    });


});