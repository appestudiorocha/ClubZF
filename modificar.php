<?php session_start(); ?>
<?php $op = isset($_GET["op"]) ? $_GET["op"] : ''; ?>
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
        if (@$_SESSION["empleados"][0] != '') {
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
                 </header>
                 <section style="background: white">
                    <div class="container">
                        <div class="row">
                            <?php
                            switch ($op) {
                                case "datos":
                                include("inc/modificar/datos.personales.inc.php");
                                break;
                                case "familiar":
                                include("inc/modificar/datos.familiares.inc.php");
                                break;
                                case "notificaciones":
                                include("inc/modificar/datos.notificaciones.inc.php");
                                break;
                                case "out":
                                session_destroy();
                                break;
                            }
                            ?>
                        </div>
                    </div>
                </section>
            </div>
            <?php
        } else {
            header("location:sesion.php");
        }
        ?>
        <div class="container">
            <h2>Comercios adheridos</h2>
            <hr/>
            <p>Prestá atención al detalle de cada comercio ya que en algunos deberás presentar un cupón impreso que vas a descargar y en otros podrás obtener la promoción presentando solo la credencial con el DNI y en el caso de ser del Grupo Familiar, solo el DNI (acordate que si no sos el titular deberás estar cargado como grupo familiar en la web para poder disfrutar del beneficio).</p>
            <div class="slider responsive" >
                <?php
                Traer_Promociones_Logo_Slide("");
                ?>
            </div>
        </div>
        <br/><br/>
        <?php include("inc/footer.inc.php") ?>

        <script>
        $(function () {
        // Remove button click
        $(document).on(
            'click',
            '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
            function (e) {
                e.preventDefault();
                $(this).closest('.form-inline').remove();
            }
            );

        $(document).on(
            'click',
            '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
            function (e) {
                e.preventDefault();
                var container = $(this).closest('[data-role="dynamic-fields"]');
                new_field_group = container.children().filter('.form-inline:first-child').clone();
                new_field_group.find('input').each(function () {
                    $(this).val('');
                });

                container.append(new_field_group);                
            }
            );
    });

        $(function () {
        // Remove button click
        $(document).on(
            'click',
            '[data-role="datosNotificaciones"] > .form-inline [data-role="remove2"]',
            function (e) {
                e.preventDefault();
                $(this).closest('.form-inline').remove();
            }
            );

        $(document).on(
            'click',
            '[data-role="datosNotificaciones"] > .form-inline [data-role="add2"]',
            function (e) {
                e.preventDefault();
                var container = $(this).closest('[data-role="dynamic-fields"]');
                new_field_group = container.children().filter('.form-inline:first-child').clone();
                new_field_group.find('input').each(function () {
                    $(this).val('');
                });
                container.append(new_field_group);
            }
            );
    });


        $(document).ready(function () {

            $(".nacimiento").keyup(function (e) {
                if (e.keyCode != 8) {
                    if ($(this).val().length == 2) {
                        $(this).val($(this).val() + "/");
                    } else if ($(this).val().length == 5) {
                        $(this).val($(this).val() + "/");
                    }
                }
            });

            $(".validadorNumero").keypress(function (event) {
                var controlKeys = [8, 9, 13, 35, 36, 37, 39];
                var isControlKey = controlKeys.join(",").match(new RegExp(event.which));
                if (!event.which ||
                    (48 <= event.which && event.which <= 57) || ($(this).attr("value")) || isControlKey) {
                    return;
            } else {
                event.preventDefault();
            }
        });
        });

        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        </script>
    <!--
        <script type="text/javascript">if(typeof svp == 'undefined') { var svp = []} svp.push({id:'svp-6cf8c',w:800,h:600,open:true}); sjsb = 'https://www.survio.com/survey/js/';</script>
        <script type="text/javascript" src="https://www.survio.com/survey/js/popup.js"></script>
        <a id="svp-6cf8c" href="https://www.survio.com/survey/p/A9C3N9F2T1B9A1Q5D"> </a>
    -->
    </body>
    </html>
