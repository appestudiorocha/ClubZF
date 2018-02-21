<div class="col-md-12">
	<div class="main-content blog">
		<h4>Modificar usuario</h3>
			<hr/>
			<?php
			$id = $_GET["id"];
			$data = Usuario_TraerPorId($id);
			$img = isset($data["imagen"]) ? $data["imagen"] : 'img/sin_imagen_perfil.png';
			?>
			<form method="post" class="row form-material" enctype="multipart/form-data" onsubmit="showLoading()">
				<?php
				if (isset($_POST["enviar"])) {
					$nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : '');
					$email = (isset($_POST["email"]) ? $_POST["email"] : '');
					$telefono = (isset($_POST["telefono"]) ? $_POST["telefono"] : '');
					$celular = (isset($_POST["celular"]) ? $_POST["celular"] : '');
					$provincia = (isset($_POST["provincia"]) ? $_POST["provincia"] : '');
					$localidad = (isset($_POST["localidad"]) ? $_POST["localidad"] : '');
					$domicilio = (isset($_POST["domicilio"]) ? $_POST["domicilio"] : '');
					$mensaje = (isset($_POST["mensaje"]) ? $_POST["mensaje"] : '');
					$respuesta = (isset($_POST["respuesta"]) ? $_POST["respuesta"] : '');
					$estado = (isset($_POST["estado"]) ? $_POST["estado"] : '');
					$url = (isset($_POST["url"]) ? $_POST["url"] : '');
					$interesado = (isset($_POST["interesado"]) ? $_POST["interesado"] : '');
					$compra = (isset($_POST["compra"]) ? $_POST["compra"] : '');
					$id = isset($_GET["id"]) ? $_GET["id"] : '';

					$sql = "
					UPDATE `contactos` 
					SET 
					`nombre` = '$nombre',
					`email` = '$email',
					`telefono` = '$telefono',
					`celular` = '$celular',
					`provincia` = '$provincia',
					`localidad` = '$localidad',
					`domicilio` = '$domicilio',
					`estado` = '$estado',
					`mensaje` = '$mensaje',
					`respuesta` = '$respuesta',
					`interesado` = '$interesado',
					`compra` = '$compra',
					`url` = '$url'
					WHERE 
					`id`= '$id'
					";

					$link = Conectarse();
					$r = mysqli_query($link,$sql); 		

					header("location: index.php?op=verUsuarios");

				}
				?>
				<label class="form-group col-md-6">Nombre:
					<br />
					<input class="form-control form-control-line" required type="text" onkeypress="return textonly(event);"   name="nombre" placeholder="Nombre" value="<?php echo utf8_encode(isset($data["nombre"]) ? $data["nombre"] : ''); ?>"  />
				</label> 
				<label class="form-group col-md-6">E-mail:
					<br />
					<input class="form-control form-control-line"   type="email" name="email" placeholder="E-mail" value="<?php echo utf8_encode(isset($data["email"]) ? $data["email"] : ''); ?>" />
				</label>
				<label class="form-group col-md-4">Provincia
					<br/>
					<input class="form-control form-control-line"  type="text" name="provincia"  value="<?php echo utf8_encode(isset($data["provincia"]) ? $data["provincia"] : ''); ?>"  />
				</label>
				<label class="form-group col-md-4">Localidad
					<br/> 
					<input class="form-control form-control-line"  type="text" name="localidad"  value="<?php echo utf8_encode(isset($data["localidad"]) ? $data["localidad"] : ''); ?>"  />
				</label> 
				<label class="form-group col-md-4">Domicilio:
					<br />
					<input class="form-control form-control-line"  type="text" name="domicilio"  value="<?php echo utf8_encode(isset($data["direccion"]) ? $data["direccion"] : ''); ?>"  />
				</label>
				<label class="form-group col-md-6">Teléfono con característica:
					<br />
					<input class="form-control form-control-line"  type="text" name="telefono"  onkeypress="return isNumberKey(event)" value="<?php echo utf8_encode(isset($data["telefono"]) ? $data["telefono"] : ''); ?>"  />
				</label>  		 
				<label class="form-group col-md-6">Celular con característica:
					<br />
					<input class="form-control form-control-line"  type="text" name="celular"  onkeypress="return isNumberKey(event)" value="<?php echo utf8_encode(isset($data["celular"]) ? $data["celular"] : ''); ?>"  />
				</label>  		 
				<label class="form-group col-md-6">URL de contacto
					<br />
					<input class="form-control form-control-line"  type="text" name="url" value="<?php echo utf8_encode(isset($data["url"]) ? $data["url"] : ''); ?>"  />
				</label>
				<label class="form-group col-md-6">Estado de la consulta
					<br />
					<select class="form-control form-control-line"  name="estado">
						<option value="0" <?php if($data["estado"] == 0) {echo "selected";} ?>>PENDIENTE</option>
						<option value="1" <?php if($data["estado"] == 1) {echo "selected";} ?>>RESPONDIDA</option>
					</select>
				</label>
				<label class="form-group col-md-6">Nivel de interés del usuario:
					<br />
					<select class="form-control form-control-line"  name="interesado">
						<option value="" <?php if($data["interesado"] == '') {echo "selected";} ?>></option>
						<option value="0" <?php if($data["interesado"] == "0") {echo "selected";} ?>>NO INTERESADO</option>
						<option value="1" <?php if($data["interesado"] == "1") {echo "selected";} ?>>INTERESADO</option>
						<option value="2" <?php if($data["interesado"] == "2") {echo "selected";} ?>>MUY INTERESADO</option>
					</select>
				</label>
				<label class="form-group col-md-6">Cierre de venta:
					<br />
					<select class="form-control form-control-line"  name="compra">
						<option value="0" <?php if($data["compra"] == 0) {echo "selected";} ?>>NO</option>
						<option value="1" <?php if($data["compra"] == 1) {echo "selected";} ?>>SI</option>
					</select>
				</label>
				<label class="form-group col-md-12">Mensaje
					<br /><br />
					<textarea class="form-control form-control-line" name="mensaje" rows="8"><?php echo (isset($data["mensaje"]) ? $data["mensaje"] : ''); ?></textarea>
				</label>  		 
				<label class="form-group col-md-12">Respuesta
					<br /><br />
					<textarea class="form-control form-control-line" name="respuesta" rows="8"><?php echo (isset($data["respuesta"]) ? $data["respuesta"] : ''); ?></textarea>
				</label>  		 
				<div class="clearfix"></div><br/>
				<div class="col-sm-6 col-xs-6 col-md-6 text-left" >
					<a href="index.php?op=verUsuarios" class="btn btn-block btn-info" >Volver</a>
				</div>
				<div class="col-sm-6 col-xs-6 col-md-6 text-right" >
					<input type="submit" class="btn btn-block btn-success" name="enviar" value="Modificar" />
				</div>
			</form>
		</div>
		<div class="clearfix">
			<br />
			<br />
		</div>
	</div>