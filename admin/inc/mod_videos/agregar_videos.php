<?php
$random = rand(0, 10000000);
if (isset($_POST["agregar"])) {
	if ($_POST["titulo"] != '') {
		$titulo = $_POST["titulo"];
 		$url = $_POST["url"];
		$categoria = $_POST["categoria"];

		$sql = "
		INSERT INTO `videos`
		(`TituloVideos`, `UrlVideos`  ) 
		VALUES 
		('$titulo','$url'  )";
		$link = Conectarse();
		$r = mysql_query($sql, $link);

		header("location:index.php?op=verVideos");
	} else {
		echo "<br/><center><span class='large-11 button' style='background:#872F30'>* Todos los datos son obligatorios</span></center>";
	}
}
?> 
<div class="col-lg-10 col-md-12">
	<br/>
	<h4>Agregar Videos</h4>
	<hr/>
	<form method="post" enctype="multipart/form-data">
		<div class="row">
			<label class="col-lg-4">Título:
				<br/>
				<input type="text" class="form-control" name="titulo" value="<?php echo (isset($_POST["titulo"]) ? $_POST["titulo"] : '') ?>" required>
			</label>	 	
			<div class="clearfix"></div>
			<label class="col-lg-4" >Url (https://www.youtube.com/watch?v=<b>OCBspLsKTjo</b>):
				<input type="text" class="form-control" name="url" value="<?php echo (isset($_POST["url"]) ? $_POST["url"] : '') ?>" required>
			</label> 
			<div class="clearfix"><br/><br/></div>
			<div class="clearfix"><br/></div>
			<label class="col-lg-6" >
				<input type="submit" class="btn btn-success" name="agregar" value="Subir Video" style="margin-right:20px;"/>
			</label>
		</div>
	</form>
</div>
