<div class="col-md-12">
	<div class="main-content blog">
		<h4>Agregar usuario</h3>
			<hr/> 
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
					$url = (isset($_POST["url"]) ? $_POST["url"] : '');
					$interesado = (isset($_POST["interesado"]) ? $_POST["interesado"] : '');
					$compra = (isset($_POST["compra"]) ? $_POST["compra"] : '');
					$id = isset($_GET["id"]) ? $_GET["id"] : '';

					$sql = "
					INSERT INTO `contactos`
					(`nombre`, `email`, `telefono`, `celular`, `provincia`, `localidad`, `domicilio`, `mensaje`, `interesado`, `compra`, `url`, `fecha`)
					VALUES
					('$nombre','$email','$telefono','$celular','$provincia','$localidad','$domicilio','$mensaje','$interesado','$compra','$url', NOW())";

					$link = Conectarse();
					$r = mysqli_query($link,$sql); 		

					header("location: index.php?op=verUsuarios");

				}
				?>
				<label class="form-group col-md-6">Nombre:
					<br />
					<input class="form-control form-control-line" required type="text" onkeypress="return textonly(event);"   name="nombre" placeholder="Nombre" value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : '' ?>"  />
				</label> 
				<label class="form-group col-md-6">E-mail:
					<br />
					<input class="form-control form-control-line"   type="email" name="email" placeholder="E-mail" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : '' ?>" />
				</label>
				<label class="form-group col-md-4">Provincia
					<br/>
					<input class="form-control form-control-line"  type="text" name="provincia"  value="<?php echo isset($_POST["provincia"]) ? $_POST["provincia"] : '' ?>"  />
				</label>
				<label class="form-group col-md-4">Localidad
					<br/> 
					<input class="form-control form-control-line"  type="text" name="localidad"  value="<?php echo isset($_POST["localidad"]) ? $_POST["localidad"] : '' ?>"  />
				</label> 
				<label class="form-group col-md-4">Domicilio:
					<br />
					<input class="form-control form-control-line"  type="text" name="domicilio"  value="<?php echo isset($_POST["direccion"]) ? $_POST["direccion"] : '' ?>"  />
				</label>
				<label class="form-group col-md-6">Teléfono con característica:
					<br />
					<input class="form-control form-control-line"  type="text" name="telefono"  onkeypress="return isNumberKey(event)" value="<?php echo isset($_POST["telefono"]) ? $_POST["telefono"] : '' ?>"  />
				</label>  		 
				<label class="form-group col-md-6">Celular con característica:
					<br />
					<input class="form-control form-control-line"  type="text" name="celular"  onkeypress="return isNumberKey(event)" value="<?php echo isset($_POST["celular"]) ? $_POST["celular"] : '' ?>"  />
				</label>  		 
				<label class="form-group col-md-12">URL de contacto
					<br />
					<input class="form-control form-control-line"  type="text" name="url" value="<?php echo isset($_POST["url"]) ? $_POST["url"] : '' ?>"  />
				</label>
				<label class="form-group col-md-6">Nivel de interés del usuario:
					<br />
					<select class="form-control form-control-line"  name="interesado">
						<option value=""></option>
						<option value="0">NO INTERESADO</option>
						<option value="1">INTERESADO</option>
						<option value="2">MUY INTERESADO</option>
					</select>
				</label>
				<label class="form-group col-md-6">Cierre de venta:
					<br />
					<select class="form-control form-control-line"  name="compra">
						<option value="0">NO</option>
						<option value="1">SI</option>
					</select>
				</label>	
				<label class="form-group col-md-12">Mensaje
					<br /><br />
					<textarea class="form-control form-control-line" name="mensaje" rows="8"><?php echo isset($_POST["mensaje"]) ? $_POST["mensaje"] : '' ?></textarea>
				</label>  		 
				<div class="clearfix"></div><br/>
				<div class="col-md-6 col-sm-6 text-left" >
					<a href="index.php?op=verUsuarios" class="btn btn-block btn-info" >Volver</a>
				</div>
				<div class="col-md-6 col-sm-6 text-right" >
					<input type="submit" class="btn btn-block btn-success" name="enviar" value="Agregar a mis contactos >" />
				</div>
			</form>
		</div>
		<div class="clearfix">
			<br />
			<br />
		</div>
	</div>