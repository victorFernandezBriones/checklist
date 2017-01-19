<!DOCTYPE html>
<?php require_once '../negocio/inicio/cargarInicio.php'; ?>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Inicio | Axioma Ingenieros Consultores</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="SHORTCUT ICON" href="media/LogoAxioma.jpg" /> 
        <link href="assets/plugins/sweetAlert/sweetalert2.min.css" rel="stylesheet" type="text/css">        
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/core.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/components.css" rel="stylesheet" type="text/css">
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
        <link href="assets/css/customStyle.css" rel="stylesheet" type="text/css">
        <link href="assets/css/pageLoader.css" rel="stylesheet" type="text/css">
        <link href="assets/css/fullcalendar.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

        <script src="assets/js/modernizr.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

    </head>


    <body class="fixed-left">

        <!--        <div id="loader-wrapper">
                    <div id="loader"></div>
                    <div class="loader-section section-left"></div>
                    <div class="loader-section section-right"></div>
                </div>-->

        <!-- INICIO DE LA PAGINA -->
        <div id="wrapper">

            <!-- INICIO NAVBAR -->
            <div class="topbar">
                <?php include_once 'navBar/navBarPrincipal.php'; ?>
            </div>
            <!-- FIN NAVBAR PRINCIPAL -->


            <!-- ========== INICIO BARRA LATERAL IZQUIERDA ========== -->
            <div class="left side-menu">
                <?php include_once 'navBar/navbarLateral.php'; ?>
            </div>
            <!-- FIN BARRA LATERAL IZQUIERDA --> 



            <!-- ============================================================== -->
            <!-- INICIO DEL CONTENIDO -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <div id="inicio">
                            <?php
                            if ($sessionUsuario->getIdTipoUsuario() == 3) {
                                require_once 'datosInicioUsuarioNormal.php'; //DATOS ADMIN Y ENCARGADOS
                            } else {

                                require_once 'datosInicio.php'; //DATOS ADMIN Y ENCARGADOS 
                            }
                            ?>
                        </div>
                        <!--CARGA DE CONTENIDO DINAMICO -->
                        <div class="cargaAjax">

                        </div>

                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    2016 © Axioma Ingenieros Consultores
                </footer>

            </div>
            <!-- ============================================================== -->
            <!-- FIN DEL CONTENIDO -->
            <!-- ============================================================== -->

        </div>
        <!-- FIN DEL CONTENEDOR PRINCIPAL -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        <script src="assets/js/jquery-ui.js"></script>
        <script src="funcionesJS/inicio/funcionesInicio.js"></script>
        <script src="funcionesJS/llamadasAjax.js"></script>


        <!--JQUERY VALIDATOR-->
        <script src="assets/js/jquery.validate.min.js"></script>
        <script src="assets/js/validacionesCustom.js"></script>

        <!-- jQuery  -->
        <script src="assets/plugins/sweetAlert/sweetalert2.min.js"></script>            



    </body>
</html>
