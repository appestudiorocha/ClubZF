<?php session_start();?>
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
            <header class="fullscreen-element no-pad centered-text">
                <div class="background-image-holder parallax-background overlay">
                    <img class="background-image" alt="Background Image" src="img/slider.jpg">
                </div>

                <div class="container align-vertical">
                    <div class="row">
                        <div class="hidden-sm hidden-xs"><br/><br/><br/><br/><br/><br/> </div>
                        <div class="col-md-7">

                            <h1 class="text-white wow fadeInLeft"><b>¡Pensamos en VOS!</b></h1>
                            <p class="lead text-white wow fadeInRight" style="opacity: 0.65;"><img src="img/20.png" width="340"></p>

                            <a href="<?php echo BASE_URL ?>/como-usar" class="wow fadeInDown btn btn-primary btn-filled">¿Cómo usar la tarjeta?</a>
                        </div>

                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </header>
            <section class="blanco">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 wow fadeInLeft">
                            <h1 class="space-bottom-medium">Festejamos 20 años de ZF Argentina en San Francisco, junto a vos y tu familia. <br/>¡Bienvenido, ya sos parte del Club ZF!</h1>

                            <p class="lead space-bottom-medium">
                                En ZF Argentina pensamos en vos. Por eso creamos Club ZF, un sistema con importantes beneficios y descuentos en los diferentes comercios de la ciudad, pensado exclusivamente para quienes colaboran en ZF y su grupo familiar.<br/><br/>
                                ¡Ser parte de nuestra empresa tiene sus beneficios! Es un orgullo marcar la diferencia, brindándote nuevas posibilidades.
                            </p>
                            <a href="<?php echo BASE_URL ?>/promociones" class="wow fadeInDown btn btn-primary btn-filled">Conocé todas las promociones</a>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <img src="<?php echo BASE_URL ?>/img/tarjeta.png" width="100%"  class="wow fadeInRight"/>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>
            <div class="container">
                <h2>Comercios adheridos</h2>
                <hr/>
                <p>Prestá atención al detalle de cada comercio ya que en algunos deberás presentar un cupón impreso que vas a descargar y en otros podrás obtener la promoción presentando solo la credencial con el DNI y en el caso de ser del Grupo Familiar, solo el DNI (acordate de que si no sos el titular deberás estar cargado como grupo familiar en la web para poder disfrutar del beneficio).</p>
                <div class="slider responsive" >
                    <?php
                    Traer_Promociones_Logo_Slide("");
                    ?>
                </div>
            </div>
            <br/><br/>
            <?php include("inc/footer.inc.php") ?>
        </body>
        </html>
