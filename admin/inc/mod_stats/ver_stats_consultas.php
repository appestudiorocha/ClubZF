<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

<?php 
$opA = isset($_GET["op"]) ? $_GET["op"] : '';
$mensaje = '';
$seCargaron = array();
$seCargaronFamiliares = array();
$tiposFamiliares = array();
$con = Conectarse();

// COLABORADORES QUE SE CARGARON

$usuariosSinCargaron= "SELECT * FROM `usuarios` WHERE familia = ''";
$usuariosConCargaron= "SELECT * FROM `usuarios` WHERE familia != ''";

$usuariosSinCargaResult = mysqli_query($con,$usuariosSinCargaron);
$usuariosConCargaResult = mysqli_query($con,$usuariosConCargaron);

$usuariosSinCargaron = mysqli_num_rows($usuariosSinCargaResult);
$usuariosConCargaron = mysqli_num_rows($usuariosConCargaResult);

array_push($seCargaron, array("indexLabel" => "No Cargados", "y" => $usuariosSinCargaron));
array_push($seCargaron, array("indexLabel" => "Cargados", "y" => $usuariosConCargaron));

// COLABORADORES QUE CARGARON FAMILIARES

$usuariosSinFamiliaQuery= "SELECT * FROM `usuarios` WHERE familia != ''";
$usuariosConFamiliaQuery= "SELECT * FROM `usuarios`,`familia` WHERE familia = cod_familia GROUP BY cod_familia";

$usuariosSinFamiliaResult = mysqli_query($con,$usuariosSinFamiliaQuery);
$usuariosConFamiliaResult = mysqli_query($con,$usuariosConFamiliaQuery);

$usuariosSinFamilia = mysqli_num_rows($usuariosSinFamiliaResult);
$usuariosConFamilia = mysqli_num_rows($usuariosConFamiliaResult);

array_push($seCargaronFamiliares, array("indexLabel" => "No Cargados", "y" => ($usuariosConCargaron - $usuariosConFamilia)));
array_push($seCargaronFamiliares, array("indexLabel" => "Cargados", "y" => $usuariosConFamilia));

// TIPOS DE FAMILIARES QUE CARGARON LOS COLABORADORES

$tipoFamiliaQuery= "SELECT count(*),tipo_familia FROM `familia` GROUP BY tipo_familia";

$tipoFamiliaResult = mysqli_query($con,$tipoFamiliaQuery);

while($tipoFamilia = mysqli_fetch_row($tipoFamiliaResult)) {
    array_push($tiposFamiliares, array("label" => $tipoFamilia[1], "y" => $tipoFamilia[0]));
}
 
?>

<div class="col-lg-12 col-md-12">
    <h4>
        Estadísticas del Club  
    </h4>
    <hr/>
</div>
<div class="col-lg-6 col-md-6" style="min-height: 500px">    
    <h3>COLABORADORES QUE SE CARGARON<br/><span style="font-size: 17px">TOTAL: <?php echo $usuariosConCargaron ?> de <?php echo $usuariosConCargaron +  $usuariosSinCargaron ?></span></h3><hr/>

    <div id="chartContainer"></div>
</div>  
<div class="col-lg-6 col-md-6" style="min-height: 500px">    
    <h3>FAMILIAS QUE SE CARGARON <br/><span style="font-size: 17px">TOTAL: <?php echo $usuariosConFamilia ?> de <?php echo $usuariosConCargaron ?></span></h3><hr/>
    <div id="chartContainer2"></div>    
</div>
<div class="clearfix"></div> <hr/>
<div class="col-lg-12 col-md-12">    
    <h3>TIPOS DE FAMILIARES QUE CARGARON LOS COLABORADORES</h3><hr/>
    <div id="chartContainer3"></div>    
</div> 
<script type="text/javascript">
   window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
        animationEnabled: true,
        theme: "theme2",
        title:{
            text: ""
        },
        legend: {
            maxWidth: 350,
            itemWidth: 120
        },
        data: [
        {
            type: "pie",
            showInLegend: true,
            legendText: "{indexLabel}",
            dataPoints: <?php echo json_encode($seCargaron, JSON_NUMERIC_CHECK); ?>
        }
        ]
    });
    chart.render();

    var chart2 = new CanvasJS.Chart("chartContainer2",
    {
        animationEnabled: true,
        theme: "theme2",
        title:{
            text: ""
        },
        legend: {
            maxWidth: 350,
            itemWidth: 120
        },
        data: [
        {
            type: "pie",
            showInLegend: true,
            legendText: "{indexLabel}",
            dataPoints: <?php echo json_encode($seCargaronFamiliares, JSON_NUMERIC_CHECK); ?>
        }
        ]
    });
    chart2.render();

    var chart3 = new CanvasJS.Chart("chartContainer3",
    {
        animationEnabled: true,
        theme: "theme2",
        title:{
            text: ""
        },
        legend: {
            maxWidth: 350,
            itemWidth: 120
        },
        data: [
        {
            type: "column",
            showInLegend: true,
            legendText: "{indexLabel}",
            dataPoints: <?php echo json_encode($tiposFamiliares, JSON_NUMERIC_CHECK); ?>
        }
        ]
    });
    chart3.render();
}
</script> 

