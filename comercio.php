<?php session_start(); ?>
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

    <?php $id = isset($_GET["id"]) ? $_GET["id"] : ''; ?>

    <?php 
    $datos = Agencias_TraerPorId($id);
    $domicilio = trim($datos["domicilio"]);
    $telefono = trim($datos["telefono"]);
    ?>

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
            <div class="col-sm-12">
              <span class="text-white alt-font">¡Pensamos en VOS!</span>
              <h2 class="text-white" style="text-transform:uppercase !important">
                Beneficio del Comercio: <?php echo strtoupper($datos["agencia"]) ?>
                <a href="<?php echo BASE_URL; ?>/promociones.php" class="btn btn-primary btn-sm " style="float:right;background:#fff">VOLVER A PROMOCIONES</a>
              </h2>
            </div>
          </div>
        </div>
      </header>

    </div>
    <br/><br/><br/>
  </div>

  <div class="container" style="min-height:400px">
    <div class="col-md-4">
      <img src="<?php echo BASE_URL."/".$datos["logo"]; ?>"  width="100%" />
    </div>
    <div class="col-md-8">
      <p style='text-transform:uppercase !important'>
        <b>Beneficio: </b><br/><?php echo  ($datos["descripcion"]); ?>
        <hr/>
        <b>Rubro: </b><?php echo $datos["categoria"] ?> 
        <hr/>
        <?php 
        if($domicilio != '') {
          echo "<b>Domicilio: </b>".$datos["domicilio"].", ";  
        }
          echo $datos["localidad"].", ".$datos["provincia"];  
        ?>
       </p>
        <?php
        if($telefono != '') {
          echo "<hr/><p><b>Teléfono: </b>".($datos["telefono"])."</p>"; 
        }

        if($datos["voucher"] == 1) {
         if(@$_SESSION["empleados"]["id"] != ''){
          ?>
          <a href="<?php echo BASE_URL ?>/voucher.php?nombre=<?php echo $datos["id"] ?>" target="_blank" style="margin-top:10px" class="btn btn-primary btn-sm ">descargar voucher</a>
          <?php
        }
      } 
      ?>
      <br/><br/>


    </div>
  </div>

  <div class="container">
    <h2>Comercios adheridos</h2>
    <hr/>
    <p>Prestá atención al detalle de cada comercio ya que en algunos deberás presentar un cupón impreso que vas a descargar y en otros podrás obtener la promoción presentando solo la credencial con el DNI y en el caso de ser del Grupo Familiar, solo el DNI (acordate que si no sos el titular deberás estar cargado como grupo familiar en la web para poder disfrutar del beneficio).</p>    <div class="slider responsive" >
    <?php
    Traer_Promociones_Logo_Slide("");
    ?>
  </div>
</div>
<br/><br/>
<?php include("inc/footer.inc.php") ?>
<script type="text/javascript" src="js/rotate.js"></script>

<script> 

$('.slider2').slick({
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  prevArrow: "<div class='leftArrow' style='padding:15px'><i class=' arrow_carrot-left_alt2'></i></div>",
  nextArrow: "<div class='rightArrow' style='padding:15px'><i class='arrow_carrot-right_alt2'></i></div>",
  slidesToScroll: 1,
  responsive: [
  {
    breakpoint: 1024,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      dots: true
    }
  },
  {
    breakpoint: 600,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1,infinite: true,
      dots: true
    }
  },
  {
    breakpoint: 480,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      dots: true
    }
  }
  ]
});


var angle1 = 0;
setInterval(function(){
  angle1+=5;
  $("#1").rotate(angle1);
},50);

var angle2 = 0;
setInterval(function(){
  angle2+=9;
  $("#2").rotate(angle2);
},50);

var angle3 = 0;
setInterval(function(){
  angle3+=5;
  $("#3").rotate(angle3);
},50);
</script>
</body>
</html>
