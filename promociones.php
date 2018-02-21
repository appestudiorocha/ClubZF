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
                                Promociones
                            </h1>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </header>


            <section style="background:#fff;">
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
                        <p>Prestá atención al detalle de cada comercio ya que en algunos deberás presentar un cupón impreso que vas a descargar y en otros podrás obtener la promoción presentando solo la credencial con el DNI y en el caso de ser del Grupo Familiar, solo el DNI (acordate que si no sos el titular deberás estar cargado como grupo familiar en la web para poder disfrutar del beneficio).</p>
                    </div>
                    <!--end of row-->

                    <div class="row client-row">
                        <?php
                        Traer_Promociones_Logo($categoria);
                        ?>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
        </div>

        <?php include("inc/footer.inc.php") ?>

    </body>
    </html>
