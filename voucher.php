<?php session_start(); ?>
<?php $nombre = isset($_GET["nombre"]) ? $_GET["nombre"] : ''; ?>
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
        <?php include("inc/header.inc.php");
        if($_SESSION["empleados"]["nombre"] == '') {
           echo("<script>location.href='sesion'</script>"); 

       }

       $date = date("d-m-Y");
       $mod_date = strtotime($date."+ 10 days");


       ?>
       <?php $datos = Agencias_TraerPorId($nombre)?>
   </head>
   <body>
    <div class="loader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    <div>
        <div style="width:283px;padding:30px;margin:10px; border:2px solid #0075BD;text-align:center">
            <h6>CUPÓN DE BENEFICIO</h6>
            <hr/>
            <img src="<?php echo BASE_URL ?>/img/logo-dark.png" width="300px"><br/>
            <hr/>
            <h4 style="line-height:2">
                <b>Comercio: </b><?php echo $datos["agencia"] ?><br/>
                <?php if($datos["agencia"] == "Supermercado Chapulín") { ?>
                <img src="<?php echo BASE_URL ?>/archivos/logo_chapu.jpg" width="100%"/><br/>
                <?php } ?>
                <b>Vale por<br/></b><p style="font-size:12px !important"><?php echo strip_tags($datos["descripcion"]); ?></p>
                <?php if($datos["agencia"] == "Supermercado Chapulín") { ?>
                <img src="<?php echo BASE_URL ?>/archivos/chapu.jpg" /><br/>
                <?php } ?>                
                <span style="font-size:12px !important"><b>Rubro: </b><?php echo $datos["categoria"] ?><br/>
                    <b>Colaborador DNI<br/> </b><?php echo strtoupper($_SESSION["empleados"]["nombre"]) ?> | <?php echo $_SESSION["empleados"]["dni"] ?></span>
                </h4>
                <br/>
                <i>* válido hasta el día <?php echo date("d/m/Y",$mod_date) . "\n";  ?></i>
            </div><br/>
            <button id="printPageButton" onClick="window.print();" class="btn btn-primary">IMPRIMIR CUPÓN</button>
        </div>        

        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.plugin.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.flexslider-min.js"></script>
        <script src="js/smooth-scroll.min.js"></script>
        <script src="js/skrollr.min.js"></script>
        <script src="js/scrollReveal.min.js"></script>
        <script src="js/isotope.min.js"></script>
        <script src="js/lightbox.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/scripts.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>

        <style>
        @media print {
          #printPageButton {
            display: none;
        }
    }
    </style>
</body>
</html>
