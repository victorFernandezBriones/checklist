$(document).ready(function () {
    $(":input").focus(function () {
        $(".mensajeExito").hide("fast");
        $(".mensajeContratos").hide("fast");

    });
    //CHEQUEANDO PRODUCTOS
    $(".chequeo").click(function () {

        var totalChequeados = parseInt($("#spanProdCheck").text());
        var totalProductos = parseInt($("#spanTotalProd").text());
        var porcentaje = 0;


        if ($(this).prop('checked')) {//AUMENTO EL CONTADOR SI SE CHECKEA EL INPUT
            totalChequeados++;

            porcentaje = (totalChequeados * 100) / totalProductos;
            //CAMBIO EL ESTADO DEL PRODUCTO EN LA BD
            $.post("../negocio/inicio/procesarChequearChecklist.php", {"idProducto": $(this).val(), "chequeo": 1, "flag": 2});

        } else {//DISMINUYO EL CONTADOR SI SE QUITA EL CHECK DEL INPUT

            //CAMBIO EL ESTADO DEL PRODUCTO EN LA BD
            $.post("../negocio/inicio/procesarChequearChecklist.php", {"idProducto": $(this).val(), "chequeo": -1, "flag": 2});
            totalChequeados--;
            porcentaje = (totalChequeados * 100) / totalProductos;
        }

        //ACTUALIZO EL TEXTO EN EL FRONTEND
        $("#spanProdCheck").text(" " + totalChequeados);
        $("#spanPorcCheck").text(" " + porcentaje.toFixed(2) + "%");
    });


    //ELIMINANDO MENSAJES DE ERROR EN LOS DIV DE FECHAS
    $("#fechaEnvio").change(function () {
        $("#divFechaEnvio").removeClass("has-error");
        $("#fechaEnvio-error").hide("fast");
    });

    $(".divFecha").change(function () {
        $(".divFecha").removeClass("has-error");
        $("#fechaChecklist-error").hide("fast");
    });

//GENERAR CHECKLIST
    $("#formGenerarChecklist").validate({
        rules: {
            fechaEnvio: {
                required: true
            }
        },
        messages: {
            fechaEnvio: {
                required: "Ingrese Fecha"
            }
        },
        submitHandler: function () {
            var fechaEnvio = $("#fechaEnvio").val();
            $(".gifCarga").show("fast");


            $.post("../negocio/admChecklist/procesarGenerarChecklist.php", {"fechaEnvio": fechaEnvio}, function (r) {
                $(".gifCarga").hide("fast");

                var res = $.parseJSON(r);

                if (res['contratosSinCheck'] != "") {

                    $(".mensajeExito").show("fast");
                    $("#pContratosSinCheck").text(res['contratosSinCheck']);


                }


                if (res['contratosConCheck'] != "") {

                    $(".mensajeContratos").show("fast");
                    $("#lblContratosConChecklist").text(res['contratosConCheck']);
                }

            });


        }

    });


    //*******************************************//
    //           MODIFICAR CHECKLIST            //
    //*****************************************//

    $("#formBuscarChecklist").validate({
        rules: {
            idContratoModCheck: {
                required: true
            },
            fechaChecklist: {
                required: true,
                formatoFecha: true
            }
        },
        messages: {
            idContratoModCheck: {
                required: "Seleccione Contrato"
            },
            fechaChecklist: {
                required: "Ingrese fecha",
                formatoFecha: "Error, formato de fecha incorrecto"
            }
        },
        submitHandler: function () {

            var idContratoModCheck = $("#idContratoModCheck").val();
            var fechaChecklist = $("#fechaChecklist").val();


            $.get("admChecklist/checklistModAjax.php", {"idContratoModCheck": idContratoModCheck,
                "fechaChecklist": fechaChecklist}, function (r) {

                $.getScript("funcionesJS/admChecklist/funcionesChecklist.js");
                $(".ajaxChecklist").html(r);

            });

        }
    });


    //HISTORIAL CHECKLIST
    $("#formBuscarHistorialChecklist").validate({
        rules: {
            idContrato: {
                required: true
            }
        },
        messages: {
            idContrato: {
                required: "Seleccione un Contrato"
            }
        },
        submitHandler: function () {
            var idContrato = $("#idContrato").val();

            $(".gifCarga").show("fast");

            $.get("admChecklist/historialChecklistAjax.php", {"idContrato": idContrato}, function (r) {

                $(".gifCarga").hide("fast");

                $(".ajaxChecklist").html(r);
            });
        }

    });

});


function cambiarEstadoCheck(idEstadoC, idChecklist) {

    var idEstadoCheck = $("#" + idEstadoC + "").val();

    $.post("../negocio/admChecklist/procesarCargarChecklistMod.php", {"idEstadoCheck": idEstadoCheck, "idChecklist": idChecklist},
            function (r) {
                if (r == 1) {
                    swal(
                            '¡Estado actualizado exitosamente',
                            '',
                            'success'
                            );
                } else {
                    swal(
                            '¡Error, no se ha podido actualizar el estado',
                            '',
                            'error'
                            );
                }
            });

}