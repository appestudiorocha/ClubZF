<?php error_reporting( E_ALL ); ?>

<?php
$random = rand(0, 10000000);
if (isset($_POST["agregar"])) {
	if ($_POST["titulo"] != '') {
		$titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : ''; 
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
				if ($anchoFinal >= 900) {
					@EscalarImagen("900", "0", $destinoFinal, $destinoRecortado, "80");
				} else {
					@EscalarImagen($anchoFinal, "0", $destinoFinal, $destinoRecortado, "80");
				}
				unlink($destinoFinal);
			}
		} else {
			$destinoRecortadoFinal = '';
		}
 


		$sql = "INSERT INTO `clientes`
		(`titulo_clientes`, `imagen_clientes`, `fecha_clientes`) 
		VALUES 
		('$titulo','$destinoRecortadoFinal',NOW())";

		$link = Conectarse();
		$r = mysql_query($sql, $link);

        // header("location:index.php?op=verClientes");
	} else {
		echo "<br/><center><span class='large-11 button' style='background:#872F30'>* Todos los datos son obligatorios</span></center>";
	}
}
?>

<div class="col-lg-12   ">
	<h4>Agregar a Producto</h4>
	<hr/>
	<form method="post" enctype="multipart/form-data">
		<label class="col-lg-8">Título:
			<br/>
			<input type="text" required name="titulo" class="form-control" value="<?php echo (isset($_POST['titulo']) ? $_POST['titulo'] : '') ?>" required>
		</label> 
		<div class="clearfix"> <br/> </div><br/>
		<label class="col-lg-4 col-md-4">Logo Cliente:
			<br/>
			<input type="file" name="img" class="form-control"/>
		</label>     
		<div class="clearfix"> <br/> </div><br/>
		<label class="col-lg-7">
			<input type="submit" class="btn btn-primary" name="agregar" value="Subir Cliente" />
		</label>
	</div>
</form>
</div>
