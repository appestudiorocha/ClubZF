<div class="col-lg-12">
	<h4>Clientes</h4>
	<hr/>
	<table class="table  table-bordered table-striped">
		<thead>
 			<th width="40%">Título</th>
  			<th>Ajustes</th>
		</thead>
		<tbody>
			<?php
			Clientes_Read();
			$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';
  
			if ($borrar != '') {
				$sql = "DELETE FROM `clientes` WHERE `id_clientes` = '$borrar'";
				$link = Conectarse();
				$r = mysql_query($sql, $link);
				header("location: index.php?op=verClientes");
			}
 			 
			?>
		</tbody>
	</table>
</div>

