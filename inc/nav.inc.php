<nav class="top-bar overlay-bar">
    <div class="container">

        <div class="row utility-menu">
            <div class="col-sm-12">
                <div class="utility-inner clearfix">
                    <span class="alt-font"><i class="icon icon_pin"></i> Av. de la Universidad 51, 2400 San Francisco, Córdoba</span>
                    <span class="alt-font"><i class="icon icon_mail"></i> info@clubzf.com.ar</span>

                    <div class="pull-right">
                        <?php if (!isset($_SESSION["empleados"])) { ?>
                        <a href="<?php echo BASE_URL ?>/sesion" class="btn btn-primary btn-filled btn-xs">Ingresar
                            con tu legajo y dni</a>
                            <?php } else { ?>
                            <a href="<?php echo BASE_URL ?>/sesion" class="btn btn-primary btn-filled btn-xs">Mi
                                cuenta</a>
                                <a href="<?php echo BASE_URL ?>/sesion?op=out" class="btn btn-primary login-button btn-xs">Cerrar
                                    Sesión</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end of row-->


                    <div class="row nav-menu">
                        <div class="col-sm-3 col-md-2 columns">
                            <a href="index.php">
                                <img class="logo logo-light" alt="Logo" src="img/logo-light.png" style="margin-top:10px">
                                <img class="logo logo-dark" alt="Logo" src="img/logo-dark.png"> 
                            </a>
                        </div>

                        <div class="col-sm-9 col-md-10 col-xs-12 columns">
                            <ul class="menu">
                                <li><a href="<?php echo BASE_URL ?>/index.php">Inicio</a></li>
                                <li><a href="<?php echo BASE_URL ?>/promociones">Promociones</a></li>
                                <li><a href="<?php echo BASE_URL ?>/como-usar">¿Cómo usar la tarjeta?</a></li>
                                <li><a href="<?php echo BASE_URL ?>/contacto" id="test"  data-wow-delay="1500ms" data-wow-iteration="1" data-wow-duration="1500ms" class="wow tada"><i class="icon_comment_alt"></i> Envianos tus dudas y sugerencias</a></li>
                                <div class="hidden-md hidden-lg">
                                    <?php if (!isset($_SESSION["empleados"])) { ?>
                                    <li><a href="<?php echo BASE_URL ?>/sesion">Ingresar con tu legajo y dni</a></li>
                                    <?php } else { ?>
                                    <hr/>
                                    <li><a href="<?php echo BASE_URL ?>/sesion">Mi cuenta</a></li>
                                    <li><a href="<?php echo BASE_URL ?>/sesion?op=out">Cerrar Sesión</a></li>
                                    <?php } ?>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <!--end of row-->

                    <div class="mobile-toggle">
                        <i class="icon icon_menu"></i>
                    </div>

                </div>
                <!--end of container-->
            </nav>
            <!--
            <button class="btn btn-danger btnPromociones" onclick="$('#promocionesSlider').slideToggle(200)" >¡VER TODOS LOS COMERCIOS ADHERIDOS!</button>
            <div id="promocionesSlider" class="row">
                <button class="btn btn-primary btn-filled btn-xs" onclick="$('#promocionesSlider').slideToggle(200)" style="position:relative;bottom:12px; float:right" >CERRAR VENTANA</button>
                <center>
                <div class="col-md-12 slider responsive" >
                    <?php
                    Traer_Promociones_Logo_Slide("");
                    ?>
                </div>
            </center>
            </div>-->