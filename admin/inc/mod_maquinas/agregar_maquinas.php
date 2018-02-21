<?php
$random = rand(0, 10000000);
if (isset($_POST["agregar"])) {
    if ($_POST["titulo"] != '') {
        $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : '';
        $domicilio = isset($_POST["domicilio"]) ? $_POST["domicilio"] : '';
        $localidad = isset($_POST["localidad"]) ? $_POST["localidad"] : '';
        $provincia = isset($_POST["provincia"]) ? $_POST["provincia"] : '';
        $telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : '';
        $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : '';
        $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : '';

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
            $destinoRecortadoFinal = '';
        }
        
        $sql = "
        INSERT INTO `agencias`
        (`agencia`, `descripcion`, `categoria`,`domicilio`,`localidad`, `provincia`, `telefono`, `logo`) 
        VALUES 
        ('$titulo','$descripcion','$tipo','$domicilio','$localidad','$provincia','$telefono', '$destinoRecortadoFinal')";
        $link = Conectarse();
        $r = mysqli_query($link, $sql);

        header("location:index.php?op=verEmpresa");
    } else {
        echo "<br/><center><span class='large-11 button' style='background:#872F30'>* Todos los datos son obligatorios</span></center>";
    }
}
?>

<div class="col-lg-12	">
    <h4>Agregar Empresa</h4>
    <hr/>
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <label class="col-lg-8">Título:
                <br/>
                <input type="text" name="titulo" class="form-control"
                value="<?php echo(isset($_POST['titulo']) ? $_POST['titulo'] : '') ?>" required>
            </label>
            <label class="col-lg-4">Categoria:
                <br/>
                <select name="tipo" class="form-control">
                    <?php Categoria_Read_Empresas(); ?>
                    <option value="Zapatería">Zapatería</option>
                    <option value="Perfumería">Perfumería</option>
                    <option value="Limpieza e Higiene">Limpieza e Higiene</option>
                    <option value="Bancos y Créditos">Bancos y Créditos</option>
                    <option value="Motos">Motos</option>
                    <option value="Heladería">Heladería</option>
                </select>
            </label>

            <div class="clearfix"></div>
            <label class="col-lg-3">Dirección:
                <br/>
                <input type="text" name="domicilio" class="form-control"
                value="<?php echo(isset($_POST['domicilio']) ? $_POST['domicilio'] : '') ?>"  >
            </label>
            <label class="col-lg-3">Localidad:
                <br/>
                <input type="text" name="localidad" class="form-control"
                value="<?php echo(isset($_POST['localidad']) ? $_POST['localidad'] : 'San Francisco') ?>"
                required>
            </label>
            <label class="col-lg-3">Provincia:
                <br/>
                <input type="text" name="provincia" class="form-control"
                value="<?php echo(isset($_POST['provincia']) ? $_POST['provincia'] : 'Córdoba') ?>" required>
            </label>
            <label class="col-lg-3">Teléfono:
                <br/>
                <input type="text" name="telefono" class="form-control"
                value="<?php echo(isset($_POST['telefono']) ? $_POST['telefono'] : '') ?>"  >
            </label>

            <div class="clearfix"></div>
            <label class="col-md-12 col-lg-12">Desarrollo:
                <br/>
                <textarea name="descripcion" class="form-control"
                style="height:300px;display:block"><?php echo(isset($_POST['descripcion']) ? $_POST['descripcion'] : '') ?></textarea>
                <script>
                    CKEDITOR.replace('descripcion');
                </script>
            </label>

            <div class="clearfix">
                <br/>
            </div>
            <br>
            <label class="col-lg-2 col-md-2">Logo Empresa (Proporción 1x1):
                <br/>
                <input type="file" name="img" class="form-control"/>
            </label>

            <div class="clearfix">
                <br/><br/>
            </div>
            <div class="col-lg-7">
                <input type="submit" class="btn btn-primary" name="agregar" value="Subir Empresa"/>
            </div>
        </div>
    </form>
</div>
