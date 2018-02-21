<div class="col-lg-12">
	<h4>Productos</h4>
	<hr/>
	<table class="table  table-bordered table-hovered table-striped">
		<thead>
			<th>Cod</th>
			<th width="40%">Título</th>			
			<th>Categoría</th>		
			<th>Precio</th>
			<th>Tienda?</th>
			<th>Estado</th>			
			<th>Ajustes</th>
		</thead>
		<tbody>
			<?php
			Portfolio_Read();
			$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';

			
			$estado = isset($_GET["estado"]) ? $_GET["estado"] : '';
			$tipo = isset($_GET["tipo"]) ? $_GET["tipo"] : '';
			$id = isset($_GET["id"]) ? $_GET["id"] : '';

			$idGuardar = isset($_POST["idGuardar"]) ? $_POST["idGuardar"] : '';
			$precioGuardar = isset($_POST["precioGuardar"]) ? $_POST["precioGuardar"] : '';
			$botonGuardar = isset($_POST["botonGuardar"]) ? $_POST["botonGuardar"] : '';

			if ($borrar != '') {
				$sql = "DELETE FROM `portfolio` WHERE `id_portfolio` = '$borrar'";
				$link = Conectarse();
				$r = mysql_query($sql, $link);
				header("location: index.php?op=verPortfolio");
			}
			if($precioGuardar != '' ) {
				$sql = "UPDATE `portfolio` SET `precio_portfolio`= '$precioGuardar'  WHERE `id_portfolio` = '$idGuardar'";
				$link = Conectarse();
				$r = mysql_query($sql, $link);
				header("location: index.php?op=verPortfolio");
			}
			if ($estado != '') {
				$sql = "UPDATE `portfolio` SET 	`estado_portfolio`= '$estado' WHERE `id_portfolio` = '$id'";
				$link = Conectarse();
				$r = mysql_query($sql, $link);
				header("location: index.php?op=verPortfolio");
			}

			if ($tipo != '') {
				$sql = "UPDATE `portfolio` SET 	`tipo_portfolio`= '$tipo' WHERE `id_portfolio` = '$id'";
				$link = Conectarse();
				$r = mysql_query($sql, $link);
				header("location: index.php?op=verPortfolio");
			}
			?>
		</tbody>
	</table>
</div>

