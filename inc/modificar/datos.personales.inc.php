<div class="col-sm-12">
  <h2>Datos del Colaborador</h2>
  <hr/>
  En esta pestaña solo tenés que colocar los datos faltantes (fecha de nacimiento / e-mail / Nº de teléfono fijo / Nº de celular)  para que podamos comunicarnos con vos, enviarte notificaciones y avisarte cuando existan nuevos beneficios para quienes pertenecemos al Club ZF.
  Una vez que agregaste estos datos clickeá sobre “actualizar mis datos personales” y listo!<br/><br/>
  <?php  if(isset($_GET["mensaje"])) { ?>
  <div style="color:#fff;background:#1a8bb3;padding: 10px">    
    <p>Estamos armando mejores promociones para vos, necesitamos que nos digas en que localidad y barrio vivis.</p>
  </div>
  <?php } ?>
  <br/>
</div>
<?php

if ($_SESSION["empleados"]["nacimiento"] != '0000-00-00') {
  $fecha = date("d/m/Y", strtotime($_SESSION["empleados"]["nacimiento"]));
} else {
  $fecha = '';
}

if($_SESSION["empleados"]["telefono"] != '') {
  $telefono=explode(" ",$_SESSION["empleados"]["telefono"]);    
}

if($_SESSION["empleados"]["celular"] != '') {
  $celular=explode(" ",$_SESSION["empleados"]["celular"]);    
}

if (isset($_POST["actualizar"])) {
  $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : '';
  $nacimiento = isset($_POST["nacimiento"]) ? $_POST["nacimiento"] : '';
  $nacimiento = explode("/", $nacimiento);
  $nacimiento = $nacimiento[2] . "-" . $nacimiento[1] . "-" . $nacimiento[0];
  $legajo = isset($_POST["legajo"]) ? $_POST["legajo"] : '';
  $dni = isset($_POST["dni"]) ? $_POST["dni"] : '';
  $area = isset($_POST["area"]) ? $_POST["area"] : '';
  $email = isset($_POST["email"]) ? $_POST["email"] : '';

  $cTelefono = isset($_POST["cTelefono"]) ? $_POST["cTelefono"] : '';
  $cCelular = isset($_POST["cCelular"]) ? $_POST["cCelular"] : '';
  $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : '';
  $celular = isset($_POST["celular"]) ? $_POST["celular"] : '';
  $terminos = isset($_POST["terminos"]) ? $_POST["terminos"] : '';

  $localidad = isset($_POST["localidad"]) ? $_POST["localidad"] : '';
  $barrio = isset($_POST["barrio"]) ? $_POST["barrio"] : '';

  if ($_SESSION["empleados"]["familia"] == '') {
    $familia = rand(0, 9999999999);
  } else {
    $familia = $_SESSION["empleados"]["familia"];
  }

  $telefono = $cTelefono." ".$telefono;
  $celular = $cCelular." ".$celular;

  $id = $_SESSION["empleados"]["id"];
  $con = Conectarse();
  $sql = "
  UPDATE `usuarios`
  SET `legajo`= '$legajo',
  `nombre`= '$nombre',
  `dni`= '$dni',
  `nacimiento`= '$nacimiento',
  `familia`= '$familia',
  `email`= '$email',
  `telefono`= '$telefono',
  `celular`= '$celular',
  `localidad`= '$localidad',
  `barrio`= '$barrio',
  `area`= '$area'
  WHERE `id` = '$id'";
  $query = mysqli_query($con, $sql);
  ELogin($legajo, $dni);
  echo("<script>location.href='modificar?op=datos'</script>");
}
?>
<form method="post" autocomplete="off">
  <div class="form-group col-md-8">
    <label for="nombre">Nombre y apellido</label>
    <input type="text" class="form-control" readonly
    value="<?php echo $_SESSION["empleados"]["nombre"]; ?>" id="nombre" name="nombre"
    placeholder="Escribir tu nombre">
  </div>
  <div class="form-group col-md-4">
    <label for="nacimiento">Fecha de nacimiento</label>
    <input type="text" class="form-control nacimiento validadorNumero" maxlength="10"
    id="nacimiento"
    name="nacimiento" value="<?php echo $fecha; ?>"
    placeholder="dd/mm/yyyy" required>
  </div>
  <div class="form-group col-md-4">
    <label for="legajo">Legajo</label>
    <input type="text" readonly class="form-control"
    value="<?php echo $_SESSION["empleados"]["legajo"]; ?>" id="legajo" name="legajo"
    placeholder="Escribir tu legajo">
  </div>
  <div class="form-group col-md-4">
    <label for="dni">DNI</label>
    <input type="text" readonly class="form-control"
    value="<?php echo $_SESSION["empleados"]["dni"]; ?>" id="dni" name="dni"
    placeholder="Escribir tu dni">
  </div>
  <div class="form-group col-md-4">
    <label for="area">Sector de trabajo</label>
    <input type="text" class="form-control" readonly
    value="<?php echo $_SESSION["empleados"]["area"]; ?>" id="area" name="area"
    placeholder="Escribir tu area">
  </select>
</div>
<div class="form-group col-md-4">
  <label for="email">E-mail</label>
  <input type="email" class="form-control"
  value="<?php echo $_SESSION["empleados"]["email"]; ?>" name="email" autocomplete='off' id="email"
  placeholder="Escribir tu email">
</div>
<div class="form-group col-md-4">
  <label for="telefono">Nº de Teléfono</label><br/>
  <span style="width:2%;display:inline-block">0</span>
  <input style="width:25%;display:inline-block" type="number" maxlength="4" class="form-control validadorNumero"
  value="<?php echo $telefono[0]; ?>" name="cTelefono" autocomplete='off'
  id="telefono" placeholder="Escribir tu teléfono">
  <span style="margin-left:10px;width:2%;display:inline-block">4</span>
  <input style="width:40%;display:inline-block" type="number"  maxlength="5" class="form-control validadorNumero"
  value="<?php echo $telefono[1]; ?>" name="telefono" autocomplete='off'
  id="telefono"
  placeholder="Escribir tu teléfono">
</div>
<div class="form-group col-md-4">
  <label for="celular">Nº de Celular (sin 0 ni 15)</label>
  <br/>
  <span style="width:2%;display:inline-block">0</span>
  <input style="width:25%;display:inline-block" type="number" class="form-control validadorNumero"
  value="<?php echo $celular[0]; ?>" name="cCelular" maxlength="10" autocomplete='off'
  id="celular" placeholder="Escribir tu celular 3564">
  <span style="margin-left:10px;width:5%;display:inline-block">15</span>
  <input style="width:40%;display:inline-block" type="number"  maxlength="7" class="form-control validadorNumero"
  value="<?php echo $celular[1]; ?>" name="celular" autocomplete='off'
  id="telefono"
  placeholder="Escribir tu celular">
</div>
<div class="form-group col-md-6">
  <label>Localidad</label>
  <select name="localidad" class="localidadB form-control">
    <option value="" disabled selected>SELECCIONAR</option>
    <option value="SAN FRANCISCO">SAN FRANCISCO</option>
    <option value="FRONTERA">FRONTERA</option>
  </select>
</div>
<div class="form-group col-md-6">
  <div id="SANFRANCISCO"  style="display:none">
   <label>Barrios</label>
   <select name="barrios" required="" class="form-control">
    <option value="" disabled selected>SELECCIONAR</option>
    <option value="ROCA">ROCA</option>
    <option value="CATEDRAL">CATEDRAL</option>
    <option value="SARMIENTO">SARMIENTO</option>
    <option value="V. SÁRSFIELD">V. SÁRSFIELD</option>
    <option value="LA CONSOLATA">LA CONSOLATA</option>
    <option value="ROQUE S. PEÑA">ROQUE S. PEÑA</option>
    <option value="JARDÍN">JARDÍN</option>
    <option value="COTTOLENGO">COTTOLENGO</option>
    <option value="J. HERNÁNDEZ">J. HERNÁNDEZ</option>
    <option value="SAN MARTÍN">SAN MARTÍN</option>
    <option value="LA FLORIDA">LA FLORIDA</option>
    <option value="LA MILKA">LA MILKA</option>
    <option value="ITURRASPE">ITURRASPE</option>
    <option value="INDEPENDENCIA">INDEPENDENCIA</option>
    <option value="HOSPITAL">HOSPITAL</option>
    <option value="9 DE SEPTIEMBRE">9 DE SEPTIEMBRE</option>
    <option value="SAN CAYETANO">SAN CAYETANO</option>
    <option value="SAN FRANCISCO">SAN FRANCISCO</option>
    <option value="DOS HERMANOS">DOS HERMANOS</option>
    <option value="BOUCHARD">BOUCHARD</option>
    <option value="PARQUE">PARQUE</option>
    <option value="CENTRO CÍVICO">CENTRO CÍVICO</option>
    <option value="CORRADI">CORRADI</option>
    <option value="PLAZA SAN FRANCISCO">PLAZA SAN FRANCISCO</option>
    <option value="20 DE JUNIO">20 DE JUNIO</option>
    <option value="EL PRADO">EL PRADO</option>
    <option value="MAIPÚ">MAIPÚ</option>
    <option value="LAS ROSAS">LAS ROSAS</option>
    <option value="GENERAL SAVIO">GENERAL SAVIO</option>
    <option value="BARRIO CHALET">BARRIO CHALET</option>
    <option value="PARQUE INDUSTRIAL">PARQUE INDUSTRIAL</option>
    <option value="BARRIO CIUDAD (400 VIVIENDAS)">BARRIO CIUDAD (400 VIVIENDAS)</option>
    <option value="202 VIVIENDAS">202 VIVIENDAS</option>
    <option value="108 VIVIENDAS">108 VIVIENDAS</option>
    <option value="PALMARES 1, 2 Y 3">PALMARES 1, 2 Y 3 </option>
    <option value="MAGDALENA 1 Y 2">MAGDALENA 1 Y 2</option>
    <option value="DEL LIBERTADOR">DEL LIBERTADOR</option>
    <option value="VILLA GOLF">VILLA GOLF </option>
    <option value="AIRES DEL GOLF">AIRES DEL GOLF</option>
    <option value="ALTOS DEL PRADO">ALTOS DEL PRADO</option>
    <option value="PLAZA SAN FRANCISCO">PLAZA SAN FRANCISCO</option>
    <option value="CHACRAS DEL NORTE">CHACRAS DEL NORTE </option>
    <option value="TIMBÚES 1 Y 2">TIMBÚES 1 Y 2</option>
    <option value="CAMPO CHICO">CAMPO CHICO </option>
    <option value="SENDEROS DEL SAVIO">SENDEROS DEL SAVIO </option>
    <option value="BRISAS DEL SUR.">BRISAS DEL SUR. </option>
    <option value="MANANTIALES">MANANTIALES</option>
    <option value="NUEVO ITALIA">NUEVO ITALIA</option>
    <option value="PARQUE MAIPÚ">PARQUE MAIPÚ</option>
    <option value="PARQUE DE LAS ROSAS">PARQUE DE LAS ROSAS</option>
    <option value="LA ALAMEDA">LA ALAMEDA</option>
    <option value="CASONAS DEL BOSQUE">CASONAS DEL BOSQUE </option>
    <option value="NUEVO CENTRO">NUEVO CENTRO</option>
  </select> 
</div>
<div style="display:none" id="FRONTERA">
 <label>Barrios</label>
 <select name="barrios" required=""  class="form-control">
  <option value="" disabled selected>SELECCIONAR</option>
  <option value="VICTORINO FRANCUCCI">VICTORINO FRANCUCCI</option>
  <option value="ESTE">ESTE</option>
  <option value="SAN JOSE">SAN JOSE</option>
  <option value="GENARO FRANCUCCI">GENARO FRANCUCCI</option>
  <option value="SANTA TERESITA">SANTA TERESITA</option>
  <option value="COLEGIALES">COLEGIALES</option>
  <option value="PUZZI SANTIAGO">PUZZI SANTIAGO</option>
  <option value="PUZZI BERTA">PUZZI BERTA</option>
  <option value="PIOVANO - ALLOCO">PIOVANO - ALLOCO</option>
  <option value="VILLANI">VILLANI</option>
  <option value="SAN ROQUE">SAN ROQUE</option>
  <option value="PUZZI BERTELLO">PUZZI BERTELLO</option>
  <option value="SAN LUIS">SAN LUIS</option>
  <option value="ROGGERO">ROGGERO</option>
  <option value="SAN JAVIER">SAN JAVIER</option>
  <option value="SANTA ANA">SANTA ANA</option>
  <option value="EVA PERON">EVA PERON</option>
  <option value="PLAN FEDERAL">PLAN FEDERAL</option>
  <option value="ESTACION FRONTERA">ESTACION FRONTERA</option>
  <option value="VILLA JOSEFINA ">VILLA JOSEFINA </option>
</select>
</div>
<div class="clearfix"></div>
</div>
<div class="form-group col-md-12">
  <label>
    <input type="checkbox" checked /> Al actualizar mis datos, ACEPTO los <a href="<?php echo BASE_URL ?>/img/terminos.pdf" target="_blank">términos y condiciones</a> del Club ZF
  </label>
</div>
<div class="form-group col-md-12">
  <button type="submit" name="actualizar" class="btn btn-default">Actualizar mis datos personales</button>
</div>
</form>
<br/>

