<div class="col-lg-12 col-md-12">
	<h4>Novedades</h4>
	 
	<hr/>
	<table class="table  table-bordered  ">
		<thead>
			<th width="10%">Id</th>
			<th width="50%">Título</th>
			<th width="30%">Categorías</th>
			<th width="10%">Ajustes</th>
		</thead>
		<tbody>
			<?php
			Notas_Read();
			?>
		</tbody>
	</table>
</div>
<?php
if (isset($_GET["borrar"]))  {
	$link = Conectarse();
	$cod = $_GET["borrar"];

	$sql = "DELETE FROM `notabase` WHERE `CodNotas` =  '$cod'";
	$r = mysql_query($sql, $link);

	$sql2 = "SELECT `ruta` FROM `imagenes` WHERE `codigo` = '$cod'";
	$r2 = mysql_query($sql2, $link);
	while($imagenes = mysql_fetch_row($r2)) {
		unlink("../".$imagenes[0]);		
	}

	$sql3 = "DELETE FROM `imagenes` WHERE `codigo` = '$cod'";
	$r3 = mysql_query($sql3, $link);
	header("location: index.php?op=verNotas");
}
?>