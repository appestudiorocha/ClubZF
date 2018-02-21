<div class="clear">
	&zwnj;
</div>
<div class="large-12 columns">
	<h3>Categorías</h3>
	<hr/>
	<table width="100%">
		<thead>
			<th>Categoría</th>
			<th>Trabajo</th>			
			<th style="text-align: right">Ajustes</th>
		</thead>
		<tbody>
			<?php
			Categoria_Read();
			
			$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';
			
			if ($borrar != '') {
				$sql = "DELETE FROM `categorias` WHERE `id_categoria` = '$borrar'";
				$link = Conectarse();
				$r = mysql_query($sql, $link);
				header("location: index.php?op=verCategoria");
			}
			?>
		</tbody>
	</table>
</div>
