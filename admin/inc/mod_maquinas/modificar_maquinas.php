<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id != '') {
	$data = Agencias_TraerPorId($id);
	$img = isset($data["logo"]) ? $data["logo"] : '';
	$count = '';
}

if (isset($_POST['agregar'])) {
	$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : '' ; 
	$domicilio = isset($_POST["domicilio"]) ? $_POST["domicilio"] : '' ; 
	$localidad = isset($_POST["localidad"]) ? $_POST["localidad"] : '' ; 
	$provincia = isset($_POST["provincia"]) ? $_POST["provincia"] : '' ; 
	$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : '';
	$descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : '' ; 
	$tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : '' ; 

	
	/* 1 */
	if (!empty($_FILES["img"]["name"])) {
		$imgInicio = "";
		$destinoImg = "";
		$prefijo = substr(md5(uniqid(rand())), 0, 6);
		$imgInicio = $_FILES["img"]["tmp_name"];
		$tucadena = $_FILES["img"]["name"];
		$partes = explode(".", $tucadena);
		$dominio = $partes[1];

		if ($dominio != '') {
			$destinoImg = "archivos/empresas/" . $prefijo . "." . $dominio;
			$destinoFinal = "../archivos/empresas/" . $prefijo . "." . $dominio;
			move_uploaded_file($imgInicio, $destinoFinal);
			chmod($destinoFinal, 0777);
			$destinoRecortado = "../archivos/empresas/recortadas/a_" . $prefijo . "." . $dominio;
			$destinoRecortadoFinal = "archivos/empresas/recortadas/a_" . $prefijo . "." . $dominio;
                //Saber tamaño
			$tamano = getimagesize($destinoFinal);
			$tamano1 = explode(" ", $tamano[3]);
			$anchoImagen = explode("=", $tamano1[0]);
			$anchoFinal = str_replace('"', "", trim($anchoImagen[1]));
			if ($anchoFinal >= 900) {
				@EscalarImagen("900", "0", $destinoFinal, $destinoRecortado, "80");
			} else {
				@EscalarImagen($anchoFinal, "0", $destinoFinal, $destinoRecortado, "80");
			}
			unlink($destinoFinal);
		}
	} else {
		$destinoRecortadoFinal = $img;
	}

	/* FIN 1 */ 
	$sql2 = "
	UPDATE `agencias` 
	SET 
	`agencia`= '$titulo',
	`descripcion`= '$descripcion',
	`domicilio`= '$domicilio',
	`categoria`= '$tipo',
	`localidad`= '$localidad',
	`provincia`= '$provincia',
	`telefono`= '$telefono',
	`logo`= '$destinoRecortadoFinal'
	WHERE `id` = '$id'";

	$link2 = Conectarse();
	$r2 = mysqli_query($link2,$sql2);
	header("location: index.php?op=modificarEmpresa&id=$id");
}
?>

<div class="col-lg-12	">
	<h4>Modificar Empresa</h4>
	<hr/>
	<form method="post" enctype="multipart/form-data">
		<div class="row" >
			<label class="col-lg-8">Título:
				<br/>
				<input type="text" name="titulo" class="form-control" value="<?php echo (isset($data['agencia']) ? $data['agencia'] : '') ?>" required>
			</label> 
			<label class="col-lg-4">Categoria:
				<br/>
				<select name="tipo" class="form-control">
					<option selected value="<?php echo $data["categoria"] ?>">Seleccionado -> <?php echo $data["categoria"] ?></option>
					<?php Categoria_Read_Empresas(); ?>
					<option value="Niños Entretenimiento">Niños Entretenimiento</option>
					<option value="Niños Indumentaria">Niños Indumentaria</option>
					<option value="Jugueterias">Jugueterias</option>
					<option value="Heladería">Heladería</option>
				</select>
			</label> 
			<div class="clearfix"></div>			 
			<label class="col-lg-3">Dirección:
				<br/>
				<input type="text" name="domicilio" class="form-control" value="<?php echo (isset($data['domicilio']) ? $data['domicilio'] : '') ?>"  >
			</label> 
			<label class="col-lg-3">Localidad:
				<br/>
				<input type="text" name="localidad" class="form-control" value="<?php echo (isset($data['localidad']) ? $data['localidad'] : '') ?>" required>
			</label> 
			<label class="col-lg-3">Provincia:
				<br/>
				<input type="text" name="provincia" class="form-control" value="<?php echo (isset($data['provincia']) ? $data['provincia'] : 'Córdoba') ?>" required>
			</label> 
			<label class="col-lg-3">Teléfono:
				<br/>
				<input type="text" name="telefono" class="form-control" value="<?php echo (isset($data['telefono']) ? $data['telefono'] : '') ?>"  >
			</label>

			<div class="clearfix"></div>			 
			<label class="col-md-12 col-lg-12">Desarrollo:
				<br/>
				<textarea name="descripcion" class="form-control"  style="height:300px;display:block"><?php echo (isset($data['descripcion']) ? $data['descripcion'] : '') ?></textarea>
				<script>
					CKEDITOR.replace('descripcion');
				</script> 
			</label>
			<div class="clearfix">
				<br/>
			</div>
			<br> 

			<label class="col-lg-2" style="margin-top:20px;margin-bottom: 20px">
				<?php if($img === '') {
					?>Imagen Logo
					<br/>
					<br/>
					<input type="file"   class="form-control" name="img" />
					<?php }else { ?>
					<div style="height:100%;overflow: hidden">
						<br/>
						<label>Imagen Logo
							<br/>
							<br/>
							<img src="../<?php echo $img ?>" width="100%" style="max-height:160px" >
						</label>
						<br/>
						<p onclick="">
							&rarr; Cambiar
						</p>
					</div>
					<div id="imgDiv" style="display:none">Logo Empresa (Proporción 1x1):
						<br/>
						<br/>
						<input type="file"   class="form-control" name="img" id="img2" />
					</div>

					<?php } ?>
				</label>

				<div class="clearfix">
					<br/>
				</div>
				<br>
				<label class="col-lg-7">
					<input type="submit" class="btn btn-primary" name="agregar" value="Subir Empresa" />
				</label>
			</div>
		</form>
	</div>

	<?php

	$borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';

	if ($borrar != '') {
		unlink("../".$borrar);
		$sql = "DELETE FROM `imagenes_maquinas` WHERE `ruta` = '$borrar'";
		$link = Conectarse();
		$r = mysql_query($sql, $link);
		header("location: index.php?op=modificarAgencias&id=$id");
	}

	?>




