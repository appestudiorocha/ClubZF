<div class="col-lg-12">
	<h4>Slider</h4>
	<div style="float:right">
		Iconografía
				<a href="#" id="tooltip" alt="Activado, pasar a desactivado" title="Activado, pasar a desactivado"><i class="glyphicon glyphicon-ok-circle" style="width: 20px"></i></a>
				<a href="#" id="tooltip3" alt="Desactivado, pasar a activado" title="Desactivado, pasar a activado"><i class="glyphicon glyphicon-ban-circle" style="width: 20px"></i></a>
				<a href="#" id="tooltip1" alt="Modificar" title="Modificar"><i class="glyphicon glyphicon-cog" style="width: 20px"></i></a>
				<a href="#" id="tooltip2" alt="Borrar" title="Borrar"><i class="glyphicon glyphicon-trash" style="width: 20px"></i></a>
			</div>
	<hr/>
	<table class="table  table-bordered table-striped">
		<thead>
			<th>Id</th>
			<th width="60%">Título</th>
 			<th>Visibilidad</th>
			<th>Ajustes</th>
		</thead>
		<tbody>
			<?php
			Slider_Read_Admin();
			?>
		</tbody>
	</table>
</div>

<?php
if (isset($_GET["upd"]) && isset($_GET["borrar"])) {
	$sql = "UPDATE `sliderbase` SET `EstadoSlider` = ". $_GET["upd"] . " WHERE `IdSlider` = " . $_GET["borrar"];
	$link = Conectarse();
	$r = mysql_query($sql, $link);
	header("location: index.php?op=verSlider");
}

if (isset($_GET["borrar"]) && !isset($_GET["upd"]) ) {
	$sql = "DELETE FROM `sliderbase` WHERE `IdSlider` =" . $_GET["borrar"];
	$link = Conectarse();
	$r = mysql_query($sql, $link);
	header("location: index.php?op=verSlider");
}
?>