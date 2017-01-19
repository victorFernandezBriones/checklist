$(document).ready(function () {

//****************************************//
//        MODULO USUARIO NORMAL          //
//**************************************//

//    CHEQUEANDO PRODUCTOS
    $(".checkbox").click(function () {

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


//ENVIANDO CHECK LIST
    $("#btnEnviarChecklist").click(function () {
        swal({//seteando el plugin sweetAlert
            title: '¿Está seguro que desea enviar el checklist?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, enviar',
            cancelButtonText: 'No, cancelar',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function () {//funcion a realizar
            $.post("../negocio/inicio/procesarChequearChecklist.php", {"idChecklist": $("#idChecklist").val(), "flag": 3},
                    function (r) {

                        if (r == 1) {
                            swal(
                                    '¡Checklist Enviado Exitosamente!',
                                    '',
                                    'success');
                            //borrando datos para evitar modificaciones
                            $("#divChecklist").empty();
                            $("#tituloChecklist").text("No hay Checklist pendientes");
                        } else {
                            swal(
                                    '¡Error, no se ha podido enviar el checklist!',
                                    '',
                                    'error');
                        }
                    });
        }, function (dismiss) {//si se presiona la opcion cancelar se despliega el siguiente mensaje

            if (dismiss === 'cancel') {
                swal(
                        'Cancelado',
                        'El checklist no fue enviado',
                        'error'
                        );
            }
        });

    });


    //*************************************************//
    //              MODULO ADMINISTRADOR              //
    //***********************************************//


    // CERRANDO CHECKLIST
    $("#btnCerrarChecklist").click(function () {

        swal({//seteando el plugin sweetAlert
            title: '¿Está seguro que desea cerrar el checklist?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, cerrar',
            cancelButtonText: 'No, cancelar',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false
        }).then(function () {//funcion a realizar
            $.post("../negocio/inicio/procesarVerificarChecklist.php", {"idChecklist": $("#idChecklist").val()},
                    function (r) {

                        if (r == 1) {
                            swal(
                                    '¡Checklist Cerrado Exitosamente!',
                                    '',
                                    'success');
                            //borrando datos para evitar modificaciones

                            $("#divChecklist").empty();
                            $("#tituloChecklist").text("Checklist cerrado, retorna al inicio")

                        } else {
                            swal(
                                    '¡Error, no se ha podido enviar el checklist!',
                                    '',
                                    'error');
                        }


                    });
        }, function (dismiss) {//si se presiona la opcion cancelar se despliega el siguiente mensaje

            if (dismiss === 'cancel') {
                swal(
                        'Cancelado',
                        'El checklist no fue enviado',
                        'error'
                        );
            }
        });

    });


//LIMPIANDO MODALES AL CERRAR
    $('#modalAgregarComentarioFinal').on('hidden.bs.modal', function () {
        $("#comentarioFinalProducto").val("");
    });


    $('#modalAgregarComentario').on('hidden.bs.modal', function () {
        $("#comentarioCheckProducto").val("");
    });

    $('#modalAgregarResponsable').on('hidden.bs.modal', function () {
        $("#nombreResponsable").val("");
    });


});




function cargarChecklist(idChecklist, nombreContrato) {

    $("#inicio").hide("fast");

    $.get("inicio/detalleCheklistContrato.php", {"idChecklist": idChecklist, "nombreContrato": nombreContrato}, function (r) {
        $.getScript("funcionesJS/inicio/funcionesInicio.js");
        $(".cargaAjax").html(r);

    });

}

function cargarIdProductoModal(idProducto, idButtonEsconder, nombreLbl) {
    //cargando valores en input hidden del modal
    $("#idProductoModal").val(idProducto);
    $("#idBotonEsconderModal").val(idButtonEsconder);
    $("#nombrePMod").val(nombreLbl);
}



function agregarComentario() {

    var idProducto = $("#idProductoModal").val();
    var comentario = $("#comentarioCheckProducto").val();

    $.post("../negocio/inicio/procesarChequearChecklist.php", {"comentarioCheck": comentario, "idProducto": idProducto, "flag": 1}, function (r) {

        if (r == 1) {
            swal(
                    '¡Comentario agregado exitosamente!',
                    '',
                    'success'
                    );
            //escondiendo boton y cargando comentario en el label
            $("#" + $("#nombrePMod").val() + "").text(comentario);
        }

        $("#comentarioCheckProducto").val("");
        $('#modalAgregarComentario').modal('hide');
    });

}

function agregarComentarioFinal() {

    var idProducto = $("#idProductoModal").val();
    var comentario = $("#comentarioFinalProducto").val();

    $.post("../negocio/inicio/procesarVerificarChecklist.php", {"comentarioFinal": comentario, "idProducto": idProducto}, function (r) {

        if (r == 1) {
            swal(
                    '¡Comentario agregado exitosamente!',
                    '',
                    'success'
                    );
            //escondiendo boton y cargando comentario en el label
            $("#" + $("#nombrePMod").val() + "").text(comentario);

        }
        
        $("#comentarioCheckProducto").val("");
        $('#modalAgregarComentario').modal('hide');
    });

}



function cargarIdProductoModalResponsable(idProducto, nombreLbl) {
    //cargando valores en input hidden del modal
    $("#idProductoModalResp").val(idProducto);
    $("#nombrePModResp").val(nombreLbl);
}



function agregarResponsable() {

    var idProducto = $("#idProductoModalResp").val();
    var responsable = $("#nombreResponsable").val();


    $.post("../negocio/inicio/procesarVerificarChecklist.php", {"responsable": responsable, "idProducto": idProducto, "flag": 1}, function (r) {

        if (r == 1) {
            swal(
                    '¡Responsable modificado exitosamente!',
                    '',
                    'success'
                    );
            //escondiendo boton y cargando comentario en el label
            $("#" + $("#nombrePModResp").val() + "").text(responsable);
        }


        $("#nombreResponsable").val("");
        $('#modalAgregarResponsable').modal('hide');
    });


}