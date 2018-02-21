<div class="popNotification hidden-xs hidden-sm wow fadeInRight" data-wow-delay="2s">
  <div class="text-right" style="padding:10px 10px;vertical-align: middle;">
    <b onclick="$('.textoPop').slideToggle();"><span style="float: left">¡SUMAR COMERCIOS!</span></b>
    <a onclick="$('.textoPop').slideToggle();$('.maximizar').hide()" class="minimizar" style="color:#fff;font-size: 12px;font-weight: bolder;"> - </a>
    <a onclick="$('.textoPop').slideToggle();$('.minimizar').hide()" class="maximizar" style="color:#fff;font-size: 12px;font-weight: bolder;"> + </a>
  </div>
  <div class="textoPop text-center" style=" padding:0px 30px 30px 30px;">
    <h5>¿Te gustaría sumar un nuevo comercio?</h5>
    <h4>¡Hacé click aquí y nosotros nos encargamos de comunicarnos con el comercio!</h4>
    <br>
    <a href="contacto.php" class="btn btn-default" style="background-color: rgba(255,255,255,0.7)">¡Click aquí!</a>
  </div>
</div>

<div class="footer-container">
  <footer class="details">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <img alt="logo" class="logo" src="img/logo-dark.png">
          <p>
           Club ZF es un sistema con importantes descuentos y beneficios en distintos comercios de la ciudad, pensado exclusivamente para vos. Ser parte de ZF tiene sus ventajas y es un orgullo marcar la diferencia.  A lo largo de este año seguiremos sumando comercios para que tengas más oportunidades. 
         </p>
       </div>
       <div class="col-sm-4">
        <h1>Contacto</h1>
        <p>
          AV. DE LA UNIVERSIDAD 51<br/>
          2400 SAN FRANCISCO<br/>
          CÓRDOBA <br/>
          03564 43-8900<br/>
          INFO@CLUBZF.COM.AR
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <span class="sub">© Copright 2017 <a href="#">Estudio Rocha & Asociados</a> - All Rights Reserved</span>
      </div>
    </div>
  </div>
</footer>
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
<script>
  $(document).ready(function(){
    $('.textoPop').slideToggle();
    $('.maximizar').hide();  
  })

  $(".localidadB").change(function(){
    var localidad = $('.localidadB').val();
    if(localidad == "SAN FRANCISCO") {
      $("#FRONTERA").hide();
      $("#SANFRANCISCO").show();
    } else {
      $("#FRONTERA").show();
      $("#SANFRANCISCO").hide();
    }
  });

  new WOW().init();

  $('[data-toggle="tooltip"]').tooltip();

  $('.responsive').slick({
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    prevArrow: "<i class=' arrow_carrot-left_alt2 leftArrow'></i>",
    nextArrow: "<i class='arrow_carrot-right_alt2 rightArrow'></i>",
    slidesToScroll: 4,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    ]
  }); 
</script> 