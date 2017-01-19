$(document).ready(function () {

    $(":input").focus(function () {
        $(".mensajeExito").hide("fast");
        $(".mensajeError").hide("fast");
    });


    $("#perfilA").click(function () {
        $("#actualizarPerfilA").removeClass("active");
        $(this).addClass("active");
    });

    $("#actualizarPerfilA").click(function () {
        $("#perfilA").removeClass("active");
        $(this).addClass("active");
    });


//CARGANDO LOS CONTRATOS SEGUN AREA
    $("#idArea").change(function () {

        var idArea = $(this).val();

        $.get("configuracion/usuario/cargarContratoAjax.php", {"idArea": idArea},
                function (r) {
                    $.getScript("funcionesJS/configuracion/funcionesUsuarios.js");

                    $("#contratoAjax").html(r);

                });

    });


    //validacion de formulario de ingreso de usuarios
    $("#formIngresarUsuario").validate({
        rules: {
            nombre: {
                required: true,
                espacioBlanco: true,
                letterswithbasicpunc: true,
                maxlength: 30
            },
            apellidoP: {
                required: true,
                espacioBlanco: true,
                letterswithbasicpunc: true,
                maxlength: 30
            },
            apellidoM: {
                letterswithbasicpunc: true,
                maxlength: 30
            },
            correo: {
                required: true,
                espacioBlanco: true,
                maxlength: 30,
                email: true
            },
            nombreUsuario: {
                required: true,
                espacioBlanco: true,
                maxlength: 30
            },
            contrasena: {
                required: true,
                maxlength: 32
            },
            reContrasena: {
                required: true,
                equalTo: "#contrasena"
            },
            idArea: {
                required: true
            },
            idContrato: {
                required: true
            },
            idSubContratos: {
                required: true
            },
            idTipoUsuario: {
                required: true
            }
        },
        messages: {
            nombre: {
                required: "Por favor, ingrese nombre",
                espacioBlanco: "Error, no rellene con espacios",
                letterswithbasicpunc: "Por favor, ingrese letras solamente",
                maxlength: "Error, límite de caractéres excedidos"
            },
            apellidoP: {
                required: "Por favor, ingrese Apellido Paterno",
                espacioBlanco: "Error, no rellene con espacios",
                letterswithbasicpunc: "Por favor, ingrese letras solamente",
                maxlength: "Error, límite de caractéres excedidos"
            },
            apellidoM: {
                espacioBlanco: "Error, no rellene con espacios",
                letterswithbasicpunc: "Por favor, ingrese letras solamente",
                maxlength: "Error, límite de caractéres excedidos"
            },
            correo: {
                required: "Por favor, ingrese correo",
                espacioBlanco: "Error, no rellene con espacios",
                maxlength: "Error, límite de caractéres excedidos",
                email: "Error, formato de correo incorrecto"
            },
            nombreUsuario: {
                required: "Por favor, ingrese nombre de usuario",
                espacioBlanco: "Error, no rellene con espacios",
                maxlength: "Error, límite de caractéres excedidos"
            },
            contrasena: {
                required: "Por favor, ingrese contraseña",
                maxlength: "Error, límite de caractéres excedidos"
            },
            reContrasena: {
                required: "Por favor, re-ingrese Contrasena",
                equalTo: "Error, las contraseñas no coinciden"
            },
            idArea: {
                required: "Por favor, seleccione Área"
            },
            idSubContratos: {
                required: "Por favor, seleccione Sub-Contrato(s) "
            },
            idContrato: {
                required: "Por favor, seleccione Contrato"
            },
            idTipoUsuario: {
                required: "Por favor, seleccione Tipo de Usuario"
            }
        },
        submitHandler: function () {

            var nombre = $("#nombre").val();
            var apellidoP = $("#apellidoP").val();
            var apellidoM = $("#apellidoM").val();
            var correo = $("#correo").val();
            var nombreUsuario = $("#nombreUsuario").val();
            var contrasena = $("#contrasena").val();
            var idArea = $("#idArea").val();
            var idTipoUsuario = $("#idTipoUsuario").val();
            var idContrato = $("#idContrato").val();
            var idUsuarioSubContratos = $("#idSubContratos").val();

            //imagen de carga
            $(".gifCarga").fadeIn("fast");

            $.post("../negocio/configuracion/usuarios/procesarIngresarUsuario.php",
                    {"nombre": nombre, "apellidoP": apellidoP, "apellidoM": apellidoM, "correo": correo, "nombreUsuario": nombreUsuario,
                        "contrasena": contrasena, "idArea": idArea, "idTipoUsuario": idTipoUsuario, "idContrato": idContrato, "idUsuarioSubContratos": idUsuarioSubContratos},
                    function (r) {

                        $(".gifCarga").fadeOut("fast");//escondiendo gif de carga

                        if (r == 1) {
                            //mostrando mensajes
                            $(".mensajeError").hide("fast");
                            $(".mensajeExito").show("fast");
                            //limpiando el formulario
                            $("#formIngresarUsuario").each(function () {
                                this.reset();
                            });
                            $("#contratoAjax").empty();
                           

                        } else {
                            $(".mensajeError").show("fast");
                            $(".mensajeExito").hide("fast");
                        }

                    });
        }

    });

    //-----------------------------------------//
    //              EDITAR PERFIL             //
    //---------------------------------------//

    //------ACTUALIZAR PERFIL------//
    $("#formActualizarPerfil").validate({
        rules: {
            nombre: {
                required: true,
                espacioBlanco: true,
                maxlength: 30,
                letterswithbasicpunc: true
            },
            apellidoP: {
                required: true,
                espacioBlanco: true,
                maxlength: 30,
                letterswithbasicpunc: true
            },
            apellidoM: {
                required: true,
                espacioBlanco: true,
                maxlength: 30,
                letterswithbasicpunc: true
            },
            correo: {
                required: true,
                espacioBlanco: true,
                maxlength: 30,
                email: true
            }


        },
        messages: {
            nombre: {
                required: "Por favor, ingrese nombre",
                espacioBlanco: "Error, no rellene con espacios",
                maxlength: "Error, límite de caracteres excedido",
                letterswithbasicpunc: "Por favor, ingrese letras solamente"
            },
            apellidoP: {
                required: "Por favor, ingrese Apellido Paterno",
                espacioBlanco: "Error, no rellene con espacios",
                maxlength: "Error, límite de caracteres excedido",
                letterswithbasicpunc: "Por favor, ingrese letras solamente"
            },
            apellidoM: {
                required: "Por favor, ingrese Apellido Materno",
                espacioBlanco: "Error, no rellene con espacios",
                maxlength: "Error, límite de caracteres excedido",
                letterswithbasicpunc: "Por favor, ingrese letras solamente"
            },
            correo: {
                required: "Por favor, ingrese Correo",
                espacioBlanco: "Error, no rellene con espacios",
                maxlength: "Error, límite de caracteres excedido",
                email: "Error, formato de correo no válido"
            }
        },
        submitHandler: function (r) {
            var idUsuario = $("#idUsuario").val();
            var nombre = $("#nombre").val();
            var apellidoP = $("#apellidoP").val();
            var apellidoM = $("#apellidoM").val();
            var correo = $("#correo").val();

            //enviado post
            $.post("../negocio/configuracion/usuarios/procesarActualizarPerfil.php", {"nombre": nombre, "apellidoP": apellidoP, "apellidoM": apellidoM, "correo": correo, "idUsuario": idUsuario, "flag": 1},
                    function (r) {
                       
                        if (r == "1") {

                            $(".mensajeError").hide("fast");
                            $(".mensajeExito").show("fast");

                        } else {

                            $(".mensajeExito").hide("fast");
                            $(".mensajeError").show("fast");

                        }

                    });

        }
    });


    //---------------------------------//
    //      CAMBIAR CONTRASEÑA        //
    //-------------------------------//
    $("#formCambiarContrasena").validate({
        rules: {
            contrasenaN: {
                required: true
            },
            reContrasena: {
                required: true,
                equalTo: "#contrasenaN"
            }

        },
        messages: {
            contrasenaN: {
                required: "Por favor, ingrese contrasena nueva"
            },
            reContrasena: {
                required: "Por favor, confirme contraseña",
                equalTo: "Error, las contraseñas no coinciden"
            }

        },
        submitHandler: function () {

            var idUsuario = $("#idUsuario").val();
            var contrasena = $("#contrasenaN").val();

            $.post("../negocio/configuracion/usuarios/procesarActualizarPerfil.php", {"idUsuario": idUsuario, "contrasena": contrasena, "flag": 2},
                    function (r) {

                        if (r == "1") {

                            $(".mensajeErrorMod").hide("fast");
                            $(".mensajeExitoMod").show("fast");

                            $("#formCambiarContrasena").each(function () {

                                this.reset();//reseteando formulario

                            });

                        } else {

                            $(".mensajeExitoMod").hide("fast");
                            $(".mensajeErrorMod").show("fast");

                        }


                    });
        }

    });



});



function eliminarUsuario(idUsuario, idFila) {//metodo para eliminar un usuario

    swal({//seteando el plugin sweetAlert
        title: '¿Está seguro que desea eliminar al usuario?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'No, cancelar',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false
    }).then(function () {//funcion a realizar
        $.post("../negocio/configuracion/usuarios/procesarActualizarEliminarUsuarios.php", {"idUsuario": idUsuario, "flag": 2},
                function (r) {
                    if (r == 1) {//si la respuesta es 1 se borra la fila de a capa de presentacion y se despliega un mensaje

                        $("#" + idFila + "").hide("fast");
                        swal(
                                '¡Usuario Eliminado Exitosamente!',
                                '',
                                'success'
                                );
                    } else {//sino se despliega un mensaje de error
                        swal(
                                'Error',
                                'No se ha podido eliminar el usuario, es posible que tenga documentos o una entrada en el log asociados',
                                'error'
                                );
                    }

                });
    }, function (dismiss) {//si se presiona la opcion cancelar se despliega el siguiente mensaje

        if (dismiss === 'cancel') {
            swal(
                    'Cancelado',
                    'El usuario no fue eliminado',
                    'error'
                    );
        }
    });

}

function actualizarUsuario(idUsuario, nombreUsuario, apellidoPUsuario, apellidoMUsuario, idTipoUsuario, idEstadoUsuario) {

    var nombre = $("#" + nombreUsuario + "").val();
    var apellidoP = $("#" + apellidoPUsuario + "").val();
    var apellidoM = $("#" + apellidoMUsuario + "").val();
    var idTipoU = $("#" + idTipoUsuario + "").val();
    var idEstado = $("#" + idEstadoUsuario + "").val();

    $.post("../negocio/configuracion/usuarios/procesarActualizarEliminarUsuarios.php",
            {"idUsuario": idUsuario, "nombre": nombre, "apellidoP": apellidoP, "apellidoM": apellidoM, "idTipoUsuario": idTipoU, "idEstado": idEstado, "flag": 1},
            function (r) {
                if (r == 1) {

                    swal(
                            '¡Usuario actualizado exitosamente',
                            '',
                            'success'
                            );

                } else {
                    swal(
                            '!Error, no ha podido actualizar el usuario',
                            '',
                            'error');
                }

            });

}

