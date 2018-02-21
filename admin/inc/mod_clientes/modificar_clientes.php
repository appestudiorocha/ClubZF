<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$rotar = isset($_GET['rotar']) ? $_GET['rotar'] : '';

if ($id != '') {
	$data = Clientes_TraerPorId($id);
	$titulo = isset($data["titulo_clientes"]) ? $data["titulo_clientes"] : ''; 
	$img = isset($data["imagen_clientes"]) ? $data["imagen_clientes"] : ''; 
}


if (isset($_POST['agregar'])) {
	if ($_POST["titulo"] != '') {
		$titulo = $_POST["titulo"]; 

		if (!empty($_FILES["img"]["name"])) {
			$imgInicio = "";
			$destinoImg = "";
			$prefijo = substr(md5(uniqid(rand())), 0, 6);
			$imgInicio = $_FILES["img"]["tmp_name"];
			$tucadena = $_FILES["img"]["name"];
			$partes = explode(".", $tucadena);
			$dominio = $partes[1];
			if ($dominio != '') {
				$destinoImg = "archivos/clientes/" . $prefijo . "." . $dominio;
				$destinoFinal = "../archivos/clientes/" . $prefijo . "." . $dominio;
				move_uploaded_file($imgInicio, $destinoFinal);
				chmod($destinoFinal, 0777);
				$destinoRecortado = "../archivos/clientes/recortadas/a_" . $prefijo . "." . $dominio;
				$destinoRecortadoFinal = "archivos/clientes/recortadas/a_" . $prefijo . "." . $dominio;
//Saber tamaño
				$tamano = getimagesize($destinoFinal);
				$tamano1 = explode(" ", $tamano[3]);
				$anchoImagen = explode("=", $tamano1[0]);
				$anchoFinal = str_replace('"', "", trim($anchoImagen[1]));
				if ($anchoFinal >= 700) {
					@EscalarImagen("700", "0", $destinoFinal, $destinoRecortado, "60");
				} else {
					@EscalarImagen($anchoFinal, "0", $destinoFinal, $destinoRecortado, "60");
				}                   
				unlink($destinoFinal);
				unlink("../".$img);
			}
		} else {
			$destinoRecortadoFinal = $img;
		} 

		$sql = "
		UPDATE `clientes` 
		SET 			
		`titulo_clientes`= '$titulo',
		`imagen_clientes`='$destinoRecortadoFinal'  
		WHERE `id_clientes`= $id";
		$link = Conectarse();
		$r = mysql_query($sql, $link);

		header("location:index.php?op=modificarClientes&id=$id");
	}
}
?>
<div class="col-lg-12">
	<hr/>
	<form method="post" enctype="multipart/form-data">
		<label class="col-lg-8">Título:
			<br/>
			<input type="text" name="titulo" class="form-control" value="<?php echo $data["titulo_clientes"]; ?>" required>
		</label> 
		<div class="clearfix"></div>

		<label class="col-lg-5" style="margin-top:20px;margin-bottom: 20px">
			<?php if($img === '') {
				?>Imagen 1
				<br/>
				<br/>
				<input type="file"   class="form-control" name="img" />
				<?php }else { ?>
				<div style="height:100%;overflow: hidden">
					<br/>
					<label>Imagen 1
						<br/>
						<br/>
						<img src="../<?php echo $img ?>" width="100%" style="max-height:160px" ></label>
						<br/>
						<p onclick="">
							&rarr; Cambiar
						</p>
					</div>
					<div id="imgDiv" style="display:none">Imagen 1
						<br/>
						<br/>
						<input type="file"   class="form-control" name="img" id="img2" />
					</div>

					<?php } ?>
				</label>

				<div class="clearfix"></div>
				<label class="col-md-12">
					<input type="submit" class="btn btn-primary " name="agregar" value="Modificar Producto" />
				</label>
			</div>
		</div>
	</form>
</div>
