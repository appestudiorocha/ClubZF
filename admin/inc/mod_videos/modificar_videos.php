<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id != '') {
	$data = Video_TraerPorId($id);
	$titulo = isset($data["nombre_portfolio"]) ? $data["nombre_portfolio"] : '';
	$img = isset($data["imagen_portfolio"]) ? $data["imagen_portfolio"] : '';
}

if (isset($_POST['agregar'])) {
	if ($_POST["titulo"] != '' && $_POST["url"] != '') {
		$titulo = $_POST["titulo"];
		$url = $_POST["url"];
 
		$sql = "
		UPDATE `videos` 
		SET 			
		`TituloVideos`= '$titulo',						
 		`UrlVideos`='$url'						
		WHERE `IdVideos`= $id";
		$link = Conectarse();
		$r = mysql_query($sql, $link);

		header("location:index.php?op=verVideos");
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
				<input type="text" class="form-control" name="titulo" value="<?php echo $data["TituloVideos"] ?>" required>
			</label> 	
			<div class="clearfix"></div>
			<label class="col-lg-4" >Url (https://www.youtube.com/watch?v=<b>OCBspLsKTjo</b>):
				<input type="text" class="form-control" name="url" value="<?php echo $data["UrlVideos"] ?>" required>
			</label> 
			<div class="clearfix"><br/><br/></div>
			<div class="clearfix"><br/></div>
			<label class="col-lg-6" >
				<input type="submit" class="btn btn-success" name="agregar" value="Subir Video" style="margin-right:20px;"/>
			</label>
		</div>
	</form>
</div>
