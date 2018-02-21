<?php session_start(); ?>
<?php $op = isset($_GET["op"]) ? $_GET["op"] : ''; ?>
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

        <?php
        if (@$_SESSION["empleados"][0] == '') {
            if (isset($_POST["submit"])) {
                $dni = isset($_POST["dni"]) ? $_POST["dni"] : '';
                $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : '';
                $dni = trim($dni);
                $legajo = trim($legajo);
                if ($dni != '' && $legajo != '') {
                    $data = ELogin($legajo, $dni);    
                    if($data != 1) {
                        echo("<script>location.href='sesion.php'</script>");
                    }
                }
            }
            ?>
            <div class="main-container">
                <section class="no-pad login-page fullscreen-element first-child" style="height: 955px;">
                    <div class="background-image-holder" style="background: url(&quot;img/hero6.jpg&quot;) 50% 0%;">
                        <img class="background-image" alt="Poster Image For Mobiles" src="img/slider_blur.jpg"
                        style="display: none;">
                    </div>
                    <div class="container align-vertical" style="padding-top: 279px;">
                        <div class="row">
                            <div class="hidden-xs hidden-sm"><br/><br/><br/><br/><br/><br/></div>
                            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
                                <h1 class="text-white">Ingresar con Legajo y DNI</h1>
                                <div id="mensaje">
                                    <?php
                                    if(@$data == 1) {
                                        ?>
                                        <div class="btn-block alert alert-warning">No se encuentran usuarios con ese DNI y Legajo.</div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="photo-form-wrapper clearfix">
                                    <form method="post">
                                        <input type="number" name="legajo" placeholder="LEGAJO">
                                        <input type="number" name="dni" placeholder="DNI">
                                        <input class="login-btn btn-filled" name="submit" type="submit" value="Ingresar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php } else {
                if($_SESSION["empleados"]["localidad"] === '') {
                    echo("<script>location.href='modificar?op=datos&mensaje=localidad'</script>");                    
                }
                ?>
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
                                        Hola <?php echo ucwords(strtolower($_SESSION["empleados"]["nombre"])); ?>
                                    </h1>

                                </div>

                                <div class="col-sm-6 navUl" >
                                    <div class="col-md-4">
                                        <a href="<?php echo BASE_URL ?>/modificar?op=datos"
                                         class="btn btn-block btn-primary btn-filled btn-xs <?php if ($op == "datos") {
                                             echo "btn-active";
                                         } ?>">Actualizar<br/> mis datos</a>
                                     </div>
                                     <div class="col-md-4">
                                        <?php if ($_SESSION["empleados"]["familia"] == '') { ?>
                                        <a class="btn btn-block btn-primary btn-filled btn-xs"
                                        data-placement='top' data-toggle='tooltip'
                                        title='Primero debes actualizar tus datos personales!'>Actualizar<br/> grupo familiar</a>
                                        <?php } else { ?>
                                        <a href="<?php echo BASE_URL ?>/modificar?op=familiar"
                                         class="btn btn-block btn-primary btn-filled btn-xs <?php if ($op == "familiar") {
                                             echo "btn-active";
                                         } ?>"
                                         >Actualizar<br/> grupo familiar</a>
                                         <?php } ?>
                                     </div>

                                     <div class="col-md-4">
                                        <?php if ($_SESSION["empleados"]["familia"] == '') { ?>
                                        <a class="btn btn-block btn-primary btn-filled btn-xs"
                                        data-placement='top' data-toggle='tooltip'
                                        title='Primero debes actualizar tus datos personales!'>Actualizar<br/> notificaciones</a>
                                        <?php } else { ?>
                                        <a href="<?php echo BASE_URL ?>/modificar?op=notificaciones"
                                         class="btn btn-block btn-primary btn-filled btn-xs <?php if ($op == "notificaciones") {
                                             echo "btn-active";
                                         } ?>"
                                         >Actualizar<br/> notificaciones</a>
                                         <?php } ?>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <!--end of container-->
                     </header>
                     <section class="duplicatable-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="feature">
                                        <h5>1)  Actualizá tus datos</h5>
                                        <p>
                                            Necesitamos saber tu correo electrónico, tu teléfono de línea (en caso de que lo tengas) y un número de celular para informarte semanalmente de las nuevas promociones que Club ZF tiene para vos. Una vez que finalices de cargar dichos datos, hacé clic en “Actualizar mis datos personales”.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="feature">
                                        <h5>2)  Actualizar Grupo Familiar</h5>
                                        <p>
                                            Cargá los datos de aquellos familiares (solamente cónyuge e hijos) que disfrutarán, tanto como vos, de los descuentos y beneficios de Club ZF. De esta manera, ellos podrán ir a los comercios con su DNI y, si los cargaste anteriormente, el comercio verificará su relación con vos para obtener los mismos beneficios.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="feature">
                                        <h5>3)  Actualizar Notificaciones</h5>
                                        <p>
                                            Cargá los datos de aquellos familiares que quieran recibir las notificaciones, novedades, descuentos y beneficios del Club ZF, al igual que vos. De esta manera, ellos podrán ir a los comercios con su DNI y, si los cargaste anteriormente, el comercio verificará su relación con vos para obtener los mismos beneficios.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-9">
                                    <h2>Comercios adheridos</h2>
                                </div>
                                <div class="col-sm-3">
                                    <form method="get" action="promociones.php">
                                        <select class="form-control" name="categoria" onchange="this.form.submit()">
                                            <?php Categoria_Read_Comercios() ?>
                                        </select>
                                    </form>
                                </div>
                                <div class="clearfix"></div>
                                <hr/>
                            </div>
                            <div class="row client-row">
                                <?php Traer_Promociones_Logo($categoria); ?>
                            </div>
                        </div>
                    </section>
                </div>
                <?php }

                if ($op == "out") {
                    session_destroy();
                    echo("<script>location.href='sesion.php'</script>");
                }
                ?>
                <?php include("inc/footer.inc.php") ?>

            </body>
            </html>
