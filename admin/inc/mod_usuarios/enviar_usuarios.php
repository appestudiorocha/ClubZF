<div class="col-md-12">
	<div class="main-content blog">
		<h4>Modificar usuario</h3>
			<hr/>
			<?php
			$id = $_GET["id"];
			$data = Usuario_TraerPorId($id);

			$nombre = isset($data["nombre"]) ? $data["nombre"] : '';
			$email = isset($data["email"]) ? $data["email"] : '';
			$telefono = isset($data["telefono"]) ? $data["telefono"] : '';
			$celular = isset($data["celular"]) ? $data["celular"] : '';
			$provincia = isset($data["provincia"]) ? $data["provincia"] : '';
			$localidad = isset($data["localidad"]) ? $data["localidad"] : '';
			$domicilio = isset($data["domicilio"]) ? $data["domicilio"] : '';
			$mensaje = isset($data["mensaje"]) ? $data["mensaje"] : '';
			$de = isset($_SESSION["usuario"]["email"]) ? $_SESSION["usuario"]["email"] : '';

			$mensajeFinal = "<br/><br/>----------------------------------<br/>";
			$mensajeFinal .= "Nombre: ".$nombre."<br/>";
			$mensajeFinal .= "Email: ".$email."<br/>";
			$mensajeFinal .= "Telefono: ".$telefono."<br/>";
			$mensajeFinal .= "Celular: ".$celular."<br/>";
			$mensajeFinal .= "Provincia: ".$provincia."<br/>";
			$mensajeFinal .= "Localidad: ".$localidad."<br/>";
			$mensajeFinal .= "Domicilio: ".$domicilio."<br/>";
			$mensajeFinal .= "Mensaje: ".$mensaje."<br/>";
			?>
			<form method="post" class="row form-material" enctype="multipart/form-data" onsubmit="showLoading()">
				<?php
				if (isset($_POST["enviar"])) {
					$asunto = (isset($_POST["asunto"]) ? $_POST["asunto"] : '');
					$email = (isset($_POST["email"]) ? $_POST["email"] : ''); 
					$cc = (isset($_POST["cc"]) ? $_POST["cc"] : ''); 
					$mensaje = (isset($_POST["mensaje"]) ? $_POST["mensaje"] : '');  

					if($asunto != '' && $email != '' && $mensaje != '') {
						$mail = new PHPMailer();
						$mail->CharSet = 'UTF-8';
						$mail -> IsSMTP();
						$mail -> SMTPDebug = 1;
						$mail -> SMTPAuth = true;
						$mail -> Host = "mail.antunpeugeot.com";
						$mail -> Port = 587;
						$mail -> Username = "info@antunpeugeot.com";
						$mail -> Password = "Antun2017";
						$mail -> SetFrom($de, "");
						$fecha = date("Y-m-d H:i:s");

						$cuerpo = "
						<body style='font-family: Tahoma,Verdana,Segoe,sans-serif; '>
							<div>							
								<div style='margin:auto;padding:20px;'>
									<img src='images/logo.png' style='width:170px;'><hr/>
									<p style='font-size:14px'>".$mensaje."
									</p><br/>
									<span style='font-size:13px'>
										<b>Atte. Antun Peugeot</b>
										<br/> 
									</span><br/><br/>
									<hr/>
									<p>Fecha del email:" . $fecha . "</p>
								</div>
							</div>
						</body>
						";

						$cuerpo = eregi_replace("[\]", '', $cuerpo);
						$mail -> Subject = $asunto;
						$mail -> AltBody = "Para ver el mensaje, por favor use Thunderbird o algún programa que vea HTML!";
						$mail -> MsgHTML($cuerpo);
						$mail -> AddAddress($email, "");
						$mail -> AddReplyTo($de,"");
						if($cc != '') {
							$mail -> AddCC($cc, "");
						}

						if (!$mail -> Send()) {
							echo '<div class="col-md-12"><div style="display:block" class="btn-block alert alert-danger" role="alert">El mensaje no se pudo enviar.</div></div>';
						} else {
							echo '<div class="col-md-12"><div style="display:block" class="btn-block alert alert-success" role="alert">El mensaje fue enviado exitosamente.</div></div>';
						}
						//header("location: index.php?op=verUsuarios");
					} else {
						echo '<div class="col-md-12"><div style="display:block" class="alert alert-danger" role="alert">Todos los campos son requeridos.</div></div>';
					}
					echo "<div class='clearfix'></div>";
				}
				?>
				<label class="form-group col-md-4">Asunto:
					<br />
					<input class="form-control form-control-line" required type="text" onkeypress="return textonly(event);"   name="asunto" placeholder="asunto" value=""  />
				</label> 
				<label class="form-group col-md-4">E-mail:
					<br />
					<input class="form-control form-control-line" required type="email" name="email" placeholder="E-mail" value="<?php echo utf8_encode(isset($data["email"]) ? $data["email"] : ''); ?>" />
				</label>
				<label class="form-group col-md-4">E-mail en Copia:
					<br />
					<input class="form-control form-control-line"  type="email" name="cc" placeholder="" value="" />
				</label>
				<label class="form-group col-md-12">Mensaje
					<br /><br />
					<textarea class="form-control form-control-line" required name="mensaje" rows="8"><?php echo htmlspecialchars(isset($mensajeFinal) ? $mensajeFinal : ''); ?></textarea>
				</label>  		 
				<div class="clearfix"></div><br/>
				<div class="col-md-6 text-left" >
					<a href="index.php?op=verUsuarios" class="btn btn-info" >Volver al listado</a>
				</div>
				<div class="col-md-6 text-right" >
					<input type="submit" class="btn btn-success" name="enviar" value="Enviar Correo" />
				</div>
			</form>
		</div>
		<div class="clearfix">
			<br />
			<br />
		</div>
	</div>