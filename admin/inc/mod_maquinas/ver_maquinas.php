<div class="col-lg-12">
	<h4>Empresas inscriptas</h4>
	<hr/>
	<table class="table  table-bordered table-striped">
		<thead>
			<th>Id</th>
			<th width="60%">Nombre</th> 
			<th>Ajustes</th>
		</thead>
		<tbody>
			<?php
			Agencias_Read();
			$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';

			if ($borrar != '') {
				$link = Conectarse();
  				$sql = "DELETE FROM `agencias` WHERE `id` = '$borrar'";
				$r = mysqli_query($link,$sql);
 				header("location: index.php?op=verBeneficios");
			}
			?>
		</tbody>
	</table>
</div>

