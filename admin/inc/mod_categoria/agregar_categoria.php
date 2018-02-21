<div class="large-12 column">
	<br/>
	<h3>Agregar Categoría</h3>
	<hr/>
	<form  method="post">
		<?php
		if (isset($_POST["publicar"])) {
			if ($_POST["nombre"] != '') {
				Insertar_Categoria($_POST["nombre"], $_POST["trabajo"]);
			} else {
				echo "<span class='error'>Lo sentimos, todos los datos deben ser completados para subir la categoría.</span>";
			}
		}
		?>
		<input type="text" name="nombre" placeholder="Categoría" value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : ''  ?>" style="width:50%;float:left"/>
		<select name="trabajo" style="width:49%;float:right">
			<option value="DIGITAL">DIGITAL</option>
			<option value="PLOTEO">PLOTEO</option>
			<option value="OFFSET">OFFSET</option>
			<option value="SERIGRAFIA">SERIGRAFÍA</option>
		</select>
		<div class="clearfix">&zwnj;</div>
		<button onclick="window.location.back()" class="button left" style="background:#333">
			VOLVER
		</button>
		<input type="submit" class="button right" name="publicar" value="CREAR CATEGORIA"/>
	</form>
</div>
