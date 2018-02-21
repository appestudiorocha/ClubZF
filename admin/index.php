<?php include("inc/encabezado.inc.php")
?>

<?php
if (!isset($_SESSION["usuario"]["nombre_usuario"])) {
    ?>
    <center class="container">
        <center class="col-lg-12">
            <img src="../img/logo-dark.png" width="300">
        </center>
    </center>
    <?php
}


if (isset($_SESSION["usuario"]["nombre_usuario"])) {
    ?>
    <div id="wrapper">

      <?php
      include("inc/nav.inc.php");
      ?>
      <center id="loading" class="loading" style="display: none">
       <div class='clearfix'>
        &zwnj;
    </div><img src='img/loader.gif' />
    <br>
    <p style="color:#2980B9">
        Subiendo imagen de publcidad y datos
    </p>
    <div class='clearfix'>
        &zwnj;
    </div>
</center>
<div id="page-wrapper">
   <div class="row">
    <div class="col-lg-12">

     <div class="row">
      <div class="col-lg-12">
       <h1 class="col-md-8">Hola <?php echo $_SESSION["usuario"]["nombre_usuario"] ?></h1>
       <?php
    /*
           $dolar = Dolar_TraerPorId();

           if(isset($_POST["enviar"])) {
               if($_POST["dolar"] != '') {
                   $idConn = Conectarse();
                   $id = $dolar["id"];
                   $dolarFinal = $_POST['dolar'];
                   $sql = "UPDATE `dolar` SET `dolar` = $dolarFinal WHERE `id` = $id";
                   $resultado = mysql_query($sql, $idConn);
                   header("Refresh:0");
               }
           }*/
           ?>
						<!--
							<div class="col-md-4 text-right" style="padding:0;margin-top:10px">
								<b>Dolar actual: </b><?php echo $dolar["dolar"] ?><br/>
								<form method="post">
									<label>
										Cambio de dolar: (usar punto para decimales) <b>$</b>
										<input type="text" name="dolar" value="<?php echo(isset($dolar['dolar']) ? $dolar['dolar'] : '') ?>" size="5"/>
										<input type="submit" name="enviar" class="btn btn-success" value="modificar" style="padding:3px 10px !important"/>
									</label>
								</form>
							</div>
						-->
						<div class="page-header">
							<br/>
						</div>
					</div>            
				</div>
			</div>
			<?php
            switch ($op) {
                case 'verPagos' :
                include("inc/mod_mp/buscar.inc.php");
                break;
                case 'verContacto' :
                include("inc/mod_contacto/ver_contacto.php");
                break;
                case 'verSuscriptos' :
                include("inc/mod_suscriptos/ver_suscriptos.php");
                break;
                case 'agregarCategoria' :
                include("inc/mod_categoria/agregar_categoria.php");
                break;
                case 'verPromos' :
                include("inc/mod_promos/ver_promos.php");
                break;
                case 'agregarPromos' :
                include("inc/mod_promos/agregar_promos.php");
                break;
                case 'modificarPromos' :
                include("inc/mod_promos/modificar_promos.php");
                break;
                case 'verBeneficios' :
                include("inc/mod_maquinas/ver_maquinas.php");
                break;
                case 'agregarBeneficios' :
                include("inc/mod_maquinas/agregar_maquinas.php");
                break;
                case 'modificarBeneficios' :
                include("inc/mod_maquinas/modificar_maquinas.php");
                break;
                case 'agregarEmpresa' :
                include("inc/mod_maquinas/agregar_maquinas.php");
                break;
                case 'modificarEmpresa' :
                include("inc/mod_maquinas/modificar_maquinas.php");
                break;
                case 'verEmpresa' :
                include("inc/mod_maquinas/ver_maquinas.php");
                break;
                case 'verContenidos' :
                include("inc/mod_contenido/ver_contenido.php");
                break;
                case 'agregarContenidos' :
                include("inc/mod_contenido/agregar_contenido.php");
                break;
                case 'modificarContenidos' :
                include("inc/mod_contenido/modificar_contenido.php");
                break;
                case 'verCategoria' :
                include("inc/mod_categoria/ver_categoria.php");
                break;
                case 'subCategoria' :
                include("inc/mod_categoria/agregar_subcategoria.php");
                break;
                case 'agregarPortfolio' :
                include("inc/mod_portfolio/agregar_portfolio.php");
                break;
                case 'modificarPortfolio' :
                include("inc/mod_portfolio/modificar_portfolio.php");
                break;
                case 'verPortfolio' :
                include("inc/mod_portfolio/ver_portfolio.php");
                break;
                case 'agregarClientes' :
                include("inc/mod_clientes/agregar_clientes.php");
                break;
                case 'modificarClientes' :
                include("inc/mod_clientes/modificar_clientes.php");
                break;
                case 'verClientes' :
                include("inc/mod_clientes/ver_clientes.php");
                break;
                case 'agregarMaquinas' :
                include("inc/mod_maquinas/agregar_maquinas.php");
                break;
                case 'modificarMaquinas' :
                include("inc/mod_maquinas/modificar_maquinas.php");
                break;
                case 'verMaquinas' :
                include("inc/mod_maquinas/ver_maquinas.php");
                break;
                case 'verSesiones' :
                include("inc/mod_sesiones/ver_sesiones.php");
                break;
                case 'verPedidos' :
                include("inc/mod_pedidos/ver_pedidos.php");
                break;
                case 'modPedidos' :
                include("inc/mod_pedidos/modificar_pedidos.php");
                break;
                case 'verUsuarios' :
                include("inc/mod_usuarios/ver_usuarios.php");
                break;
                case 'verInscriptosI' :
                include("inc/mod_inscriptos/ver_inscriptosI.php");
                break;
                case 'verInscriptosS' :
                include("inc/mod_inscriptos/ver_inscriptosS.php");
                break;
                case 'agregarUsuarios' :
                include("inc/mod_usuarios/agregar_usuarios.php");
                break;
                case 'modUsuarios' :
                include("inc/mod_usuarios/modificar_usuario.php");
                break;
                case 'verNotas' :
                include("inc/mod_notas/ver_notas.php");
                break;
                case 'agregarNotas' :
                include("inc/mod_notas/agregar_notas.php");
                break;
                case 'modificarNotas' :
                include("inc/mod_notas/modificar_notas.php");
                break;
                case 'verSlider' :
                include("inc/mod_sliders/ver_slider.php");
                break;
                case 'agregarSlider' :
                include("inc/mod_sliders/agregar_slider.php");
                break;
                case 'modificarSlider' :
                include("inc/mod_sliders/modificar_slider.php");
                break;
                case 'verVideos' :
                include("inc/mod_videos/ver_videos.php");
                break;
                case 'agregarVideos' :
                include("inc/mod_videos/agregar_videos.php");
                break;
                case 'modificarVideos' :
                include("inc/mod_videos/modificar_videos.php");
                break;
                case 'verCursos' :
                include("inc/mod_cursos/ver_cursos.php");
                break;
                case 'agregarCursos' :
                include("inc/mod_cursos/agregar_cursos.php");
                break;
                case 'verMensajes' :
                include("inc/mod_sms/ver_sms.php");
                break;
                case 'agregarBases' :
                include("inc/mod_sms/agregar_base.php");
                break;
                case 'agregarMensajes' :
                include("inc/mod_sms/agregar_sms.php");
                break;
                case 'modificarCursos' :
                include("inc/mod_cursos/modificar_cursos.php");
                break;
                case 'verBases' :
                include("inc/mod_db/ver_bases.php");
                break;
                case 'verFamilia' :
                include("inc/mod_usuarios/ver_familia.php");
                break;
                case 'verStatsConsultas' :
                include ("inc/mod_stats/ver_stats_consultas.php");
                break;
                case 'verStatsConsultasApp' :
                include ("inc/mod_stats/ver_stats_consultasApp.php");
                break;
                case 'verStatsVendedores' :
                include ("inc/mod_stats/ver_stats_vendedores.php");
                break;
                case 'salir' :
                LogOut();
                header("location:index.php");
                break;
                default :
                include("inc/mod_maquinas/ver_maquinas.php");
                break;
            }
            ?>
        </div>
    </div>
</div>
</div>
<?php
} else {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ingresar al administrador</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <?php
                            if (isset($_POST["login"])) {
                                if ($_POST["user"] != '' && $_POST["pass"] != '') {
                                    @Login($_POST["user"], $_POST["pass"]);
                                }
                            }
                            ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="pass" type="password"
                                    value="">
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Ingresar"
                                name="login"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php include("inc/pie.inc.php")
    ?>