<div class="large-12 column">
	<br/>
	<h3>Agregar Subcategoría</h3>
	<hr/>
	<?php $id = (isset($_GET["id"]) ? $_GET["id"] : '');
		$borrar = (isset($_GET["borrar"]) ? $_GET["borrar"] : '');
	?>
	<div class="row column">
		<?php Traer_Subcategorias($id)
		?>
	</div>
	<br/>
	<?php
	if ($borrar != '') {
		$sql = "DELETE FROM `subcategorias` WHERE `id_subcategorias` = '$borrar'";
		$link = Conectarse();
		$r = mysql_query($sql, $link);
		header("location: index.php?op=verCategoria");
	}
	?>
	<div class="clear">
		&zwnj;
	</div>
	<form  method="post">
		<?php
		if (isset($_POST["publicar"])) {
			if ($_POST["nombre"] != '') {
				Insertar_SubCategoria($_GET["id"], $_POST["nombre"]);
			} else {
				echo "<span class='error'>Lo sentimos, todos los datos deben ser completados para subir la categoría.</span>";
			}
		}
		?>
		<input type="text" name="nombre" placeholder="Subcategoría" value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : ''  ?>" style="width:50%;float:left"/>
		<div class="clearfix">
			&zwnj;
		</div>
		<button onclick="window.location.back()" class="button left" style="background:#333">
			VOLVER
		</button>
		<input type="submit" class="button right" name="publicar" value="CREAR SUBCATEGORIA"/>
	</form>

</div>
