<div class="col-lg-12 col-md-12">
	<h4 class="row">
		<div class="col-md-7">Usuarios </div> 
	</h4>
	<div class="clearfix"></div>
	<hr/> 
	<div class="table-responsive">
		<table class="table stylish-table">
			<thead>
				<th>Legajo</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>DNI</th> 
				<th>Área</th> 
				<th></th> 
			</thead> 		
			<?php 					
			Usuarios_Read_Admin();
			?>				
		</table>
	</div>
</div>

<?php
$familia = isset($_GET["familia"]) ? $_GET["familia"] : ''; 

if ($familia != '') {
	$sql1 = "DELETE FROM `usuarios`  WHERE `familia` = '$familia' ";
	$sql2 = "DELETE FROM  `familia`  WHERE  `cod_familia` = '$familia'  ";
	$sql3 = "DELETE FROM `notificaciones` WHERE `familia_notificaciones` = '$familia'";
	$link = Conectarse();
	$r = mysqli_query($link, $sql1);
	$r = mysqli_query($link, $sql2);
	$r = mysqli_query($link, $sql3);
	header("location: index.php?op=verUsuarios");
}
?> 