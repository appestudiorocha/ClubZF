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
        if (isset($_POST["submit"])) {
            $dni = isset($_POST["dni"]) ? $_POST["dni"] : '';
            $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : '';
            $dni = trim($dni);
            if ($dni != '') {
                if($tipo == 0) {
                    $data = Empleados_Revision($dni);
                    $familia = $data["familia"];
                     $dataFamilia = Empleados_Revision_Completo($familia);
                } else {
                    $data = Empleados_Familia_Revision($dni);
                    $familia = $data["cod_familia"];
                    $data = Empleados_Revision_Completo($familia);
                }
                if ($data[0] != '') {
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
                                            DATOS DEL COLABORADOR
                                        </h1>
                                    </div>
                                    <div class="col-sm-6"><a href="<?php echo BASE_URL ?>/soycomercio" style="float:right;margin-top:10px"
                                       class="btn btn-filled btn-primary">BUSCAR OTRO USUARIO</a></div>
                                   </div>
                                   <!--end of row-->
                               </div>
                               <!--end of container-->
                           </header>

                           <section class="blanco" style="overflow-x:visible;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h2>
                                            Datos del colaborador
                                        </h2>
                                        <hr/>
                                        <table class="table table-hovered table-bordered">
                                            <thead>
                                                <th style="text-transform: uppercase">Nombre</th>
                                                <th style="text-transform: uppercase">Nacimiento</th>
                                                <th style="text-transform: uppercase">Área</th>
                                                <th style="text-transform: uppercase">DNI</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-transform: uppercase"><?php echo $data["nombre"] ?></td>
                                                    <td><?php echo date_format(date_create($data["nacimiento"]), "d/m/Y") ?></td>
                                                    <td style="text-transform: uppercase"><?php echo $data["area"] ?></td>
                                                    <td><?php echo $data["dni"] ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <?php
                                    $totalIntegrantes = Familia_Contar($familia);
                                    if ($totalIntegrantes[0] != '') {
                                        ?>
                                        <div class="col-sm-12">
                                            <h2>
                                                Grupo Familiar
                                            </h2>
                                            <hr/>
                                            <table class="table table-hovered table-bordered">
                                                <thead>
                                                    <th style="text-transform: uppercase">Nombre</th>
                                                    <th style="text-transform: uppercase">Nacimiento</th>
                                                    <th style="text-transform: uppercase">Relación</th>
                                                    <th style="text-transform: uppercase">DNI</th>
                                                    <th style="text-transform: uppercase">Ocupación/Estudios</th>
                                                </thead>
                                                <?php
                                                Familia_TraerPorId_Revision($data["familia"]);
                                                ?>
                                            </table>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </section>

                        <?php
                    } else {
                        ?>
                        <div class="main-container">
                            <section class="no-pad login-page fullscreen-element first-child" style="height: 955px;">
                                <div class="background-image-holder" style="background: url(&quot;img/hero6.jpg&quot;) 50% 0%;">
                                    <img class="background-image" alt="Poster Image For Mobiles" src="img/slider_blur.jpg"
                                    style="display: none;">
                                </div>
                                <div class="container align-vertical" style="padding-top: 279px;">
                                    <div class="row">
                                        <div class="hidden-xs hidden-sm"><br/><br/><br/><br/></div>
                                        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
                                            <h1 class="text-white">Ingresar DNI del empleado o familiar</h1>
                                            <div class="btn-block alert alert-warning">No se encuentran usuarios con ese DNI.</div>

                                            <div class="photo-form-wrapper clearfix">
                                                <form method="post">
                                                    <input type="number" required name="dni" placeholder="DNI">
                                                    <select name="tipo" class="form-control">
                                                        <option value="0">EMPLEADO</option>
                                                        <option value="1">FAMILIAR</option>
                                                    </select>
                                                    <div class="clearfix"></div>
                                                    <br/>
                                                    <input class="login-btn btn-filled" name="submit" type="submit" value="Ingresar">                                    
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <?php
                    }
                }
            } else {
                ?>
                <div class="main-container">
                    <section class="no-pad login-page fullscreen-element first-child" style="height: 955px;">
                        <div class="background-image-holder" style="background: url(&quot;img/hero6.jpg&quot;) 50% 0%;">
                            <img class="background-image" alt="Poster Image For Mobiles" src="img/slider_blur.jpg"
                            style="display: none;">
                        </div>
                        <div class="container align-vertical" style="padding-top: 279px;">
                            <div class="row">
                                <div class="hidden-xs hidden-sm"><br/><br/><br/><br/></div>
                                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 text-center">
                                    <h1 class="text-white">Ingresar DNI del empleado o familiar</h1>

                                    <div class="photo-form-wrapper clearfix">
                                        <form method="post">
                                            <input type="number" required name="dni" placeholder="DNI">
                                            <select name="tipo" class="form-control" style="float:left">
                                                <option value="0">EMPLEADO</option>
                                                <option value="1">FAMILIAR</option>
                                            </select>
                                            <div class="clearfix"></div>
                                            <br/>
                                            <input class="login-btn btn-filled" name="submit" type="submit" value="Ingresar">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php
            }
            ?>
            <?php include("inc/footer.inc.php") ?>
        </body>
        </html>
