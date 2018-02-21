<?php session_start(); ?>
<?php $categoria = isset($_GET["categoria"]) ? $_GET["categoria"] : ''; ?>
<!DOCTYPE html>
<!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
    <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!-->
    <html class="no-js"> <!--<![endif]-->
    <head>
        <?php include("PHPMailer/class.phpmailer.php") ?>
        <?php include("inc/header.inc.php") ?>
    </head>
    <body>
        <div class="loader">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>

        <div class="nav-container">
            <?php include("inc/nav.inc.php"); ?>
        </div>

        <div class="main-container">
            <header class="page-header">
                <div class="background-image-holder parallax-background ">
                    <img class="background-image" alt="Background Image" src="img/slider_blur.jpg">
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="text-white alt-font">¡Pensamos en VOS!</span>
                            <h1 class="text-white">
                                Envianos tus consultas
                            </h1>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </header>


            <section style="background:#fff;">
                <div class="container">
                    <?php
                    if(isset($_POST["actualizar"])) {
                        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
                        $email = isset($_POST["email"]) ? $_POST["email"] : '';
                        $mensaje = isset($_POST["mensaje"]) ? $_POST["mensaje"] : '';
                        $asunto = "Recibimos un nuevo mensaje de contanto o sugerencia";
                        $mensajeF = "<b>Nombre y apellido: </b>".$nombre."<br/>";
                        $mensajeF .= "<b>Email: </b>".$email."<br/>";
                        $mensajeF .= "<b>Mensaje: </b>".$mensaje."<br/>";
                        $receptor = "info@clubzf.com.ar";
                        Enviar_User($asunto, $mensajeF, $receptor);
                    }
                    ?>
                    <form method="post" autocomplete="off">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre y apellido</label>
                            <input type="text" class="form-control"  
                            value="" id="nombre" required name="nombre"
                            placeholder="Escribir tu nombre">
                        </div>  
                        <div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control"
                            value="" required name="email" autocomplete='off' id="email"
                            placeholder="Escribir tu email">
                        </div> 
                        <div class="clearfix"></div>
                        <div class="form-group col-md-12">
                            <label for="email">Mensaje</label><br/>
                            <textarea required name="mensaje"class="form-control" rows="8"></textarea>
                        </div>  
                        <div class="form-group col-md-12">
                            <button type="submit" name="actualizar" class="btn btn-default">Enviar consulta o sugerencia</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <?php include("inc/footer.inc.php") ?>

    </body>
    </html>
