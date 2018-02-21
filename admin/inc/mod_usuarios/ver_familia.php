<?php
$dni = isset($_GET["dni"]) ? $_GET["dni"] : '';
$familia = isset($_GET["familia"]) ? $_GET["familia"] : '';
$data = Empleados_Revision($dni);
$familia = $data["familia"];
$dataFamilia = Empleados_Revision_Completo($familia);
?>
<section class="blanco" style="overflow-x:visible;">
	<div class="col-sm-12">
		<h2>
			Datos del colaborador
		</h2>
		<hr/>
		<table class="table table-hovered table-bordered">
			<thead>
				<th style="text-transform: uppercase">Nombre</th>
				<th style="text-transform: uppercase">Nacimiento</th>
				<th style="text-transform: uppercase">Área</th>
				<th style="text-transform: uppercase">DNI</th>
			</thead>
			<tbody>
				<tr>
					<td style="text-transform: uppercase"><?php echo $data["nombre"] ?></td>
					<td><?php echo date_format(date_create($data["nacimiento"]), "d/m/Y") ?></td>
					<td style="text-transform: uppercase"><?php echo $data["area"] ?></td>
					<td><?php echo $data["dni"] ?></td>
				</tr>
			</tbody>
		</table>
	</div>

	<?php
	$totalIntegrantes = Familia_Contar($familia);
	if ($totalIntegrantes[0] != '') {
		?>
		<div class="col-sm-12">
			<h2>
				Grupo Familiar
			</h2>
			<hr/>
			<table class="table table-hovered table-bordered">
				<thead>
					<th style="text-transform: uppercase">Nombre</th>
					<th style="text-transform: uppercase">Nacimiento</th>
					<th style="text-transform: uppercase">Relación</th>
					<th style="text-transform: uppercase">DNI</th>
					<th style="text-transform: uppercase">Ocupación/Estudios</th>
				</thead>
				<?php
				Familia_TraerPorId_Revision($data["familia"]);
				?>
			</table>
		</div>
		<?php
	}
	?>
</section>
