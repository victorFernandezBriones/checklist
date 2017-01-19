<?php require_once 'negocio/login/procesarLogin.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link rel="SHORTCUT ICON" href="pa/media/LogoAxioma.jpg" /> 
        <link rel="stylesheet" href="pa/assets/css/cssLogin.css">
        <link rel="stylesheet" href="pa/assets/css/bootstrap.min.css">
        <title>Login</title>
    </head>
    <body id="bodyLogin">
        <div id="head">
            <header id="headTitulo">
                <h1>CHECKEO DE INVENTARIO EN L&Iacute;NEA</h1>
            </header>
        </div>

        <div class="container">
            <div id="divLogin">
                <form action="index.php" method="post" class="form-horizontal">
                    <div class="form-group">                       
                        <div class="col-sm-12">
                            <input type="text" name="usuario" id="usuario" placeholder="Ingrese nombre usuario" class="form-control bordeAxioma">
                        </div>
                    </div>
                    <div class="form-group">                       
                        <div class="col-sm-12">
                            <input type="password" name="contrasena" id="contrasena" placeholder="************" class="form-control bordeAxioma">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="submit" id="btnIngresar" name="btnIngresar" value="Ingresar" class="btn btnApp btn-lg">
                        </div>
                    </div>
                </form>

                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>


        <footer class="footer">
            <h2>AXIOMA INGENIEROS CONSULTORES S.A </h2>
        </footer>
    </body>
</html>