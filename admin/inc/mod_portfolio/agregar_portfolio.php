<?php error_reporting( E_ALL ); ?>

<?php
$random = rand(0, 10000000);
if (isset($_POST["agregar"])) {
    if ($_POST["titulo"] != '') {
        $titulo = isset($_POST["titulo"]) ? $_POST["titulo"] : '';
        $cod = isset($_POST["cod"]) ? $_POST["cod"] : '';
        $stock = isset($_POST["stock"]) ? $_POST["stock"] : '';
        $precio = isset($_POST["precio"]) ? $_POST["precio"] : '';
        $tienda = isset($_POST["tienda"]) ? $_POST["tienda"] : '';
        $moneda = isset($_POST["moneda"]) ? $_POST["moneda"] : '';
        $descripcion = isset($_POST["descripcion"]) ? $_POST["descripcion"] : '';
        $categorias = isset($_POST["tipo"]) ? $_POST["tipo"] : '';

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
                $destinoImg = "archivos/productos/" . $prefijo . "." . $dominio;
                $destinoFinal = "../archivos/productos/" . $prefijo . "." . $dominio;
                move_uploaded_file($imgInicio, $destinoFinal);
                chmod($destinoFinal, 0777);
                $destinoRecortado = "../archivos/productos/recortadas/a_" . $prefijo . "." . $dominio;
                $destinoRecortadoFinal = "archivos/productos/recortadas/a_" . $prefijo . "." . $dominio;
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

        /* FIN 1 */

        /* 2 */
        if (!empty($_FILES["img2"]["name"])) {
            $imgInicio2 = "";
            $destinoImg2 = "";
            $prefijo2 = substr(md5(uniqid(rand())), 0, 6);
            $imgInicio2 = $_FILES["img2"]["tmp_name"];
            $tucadena2 = $_FILES["img2"]["name"];
            $partes2 = explode(".", $tucadena2);
            $dominio2 = $partes2[1];

            if ($dominio2 != '') {
                $destinoImg2 = "archivos/productos/" . $prefijo2 . "." . $dominio2;
                $destinoFinal2 = "../archivos/productos/" . $prefijo2 . "." . $dominio2;
                move_uploaded_file($imgInicio2, $destinoFinal2);
                chmod($destinoFinal2, 0777);
                $destinoRecortado2 = "../archivos/productos/recortadas/a_" . $prefijo2 . "." . $dominio2;
                $destinoRecortadoFinal2 = "archivos/productos/recortadas/a_" . $prefijo2 . "." . $dominio2;
                //Saber tamaño
                $tamano = getimagesize($destinoFinal2);
                $tamano1 = explode(" ", $tamano[3]);
                $anchoImagen = explode("=", $tamano1[0]);
                $anchoFinal = str_replace('"', "", trim($anchoImagen[1]));
                if ($anchoFinal >= 900) {
                    @EscalarImagen("900", "0", $destinoFinal2, $destinoRecortado2, "80");
                } else {
                    @EscalarImagen($anchoFinal, "0", $destinoFinal2, $destinoRecortado2, "80");
                }
                unlink($destinoFinal2);
            }
        } else {
            $destinoRecortadoFinal2 = '';
        }
        /* FIN 2 */

        /* 3 */
        if (!empty($_FILES["img3"]["name"])) {

            $imgInicio3 = "";
            $destinoImg3 = "";
            $prefijo3 = substr(md5(uniqid(rand())), 0, 6);
            $imgInicio3 = $_FILES["img3"]["tmp_name"];
            $tucadena3 = $_FILES["img3"]["name"];
            $partes3 = explode(".", $tucadena3);
            $dominio3 = $partes3[1];

            if ($dominio3 != '') {
                $destinoImg3 = "archivos/productos/" . $prefijo3 . "." . $dominio3;
                $destinoFinal3 = "../archivos/productos/" . $prefijo3 . "." . $dominio3;
                move_uploaded_file($imgInicio3, $destinoFinal3);
                chmod($destinoFinal3, 0777);
                $destinoRecortado3 = "../archivos/productos/recortadas/a_" . $prefijo3 . "." . $dominio3;
                $destinoRecortadoFinal3 = "archivos/productos/recortadas/a_" . $prefijo3 . "." . $dominio3;
                //Saber tamaño
                $tamano = getimagesize($destinoFinal3);
                $tamano1 = explode(" ", $tamano[3]);
                $anchoImagen = explode("=", $tamano1[0]);
                $anchoFinal = str_replace('"', "", trim($anchoImagen[1]));
                if ($anchoFinal >= 900) {
                    @EscalarImagen("900", "0", $destinoFinal3, $destinoRecortado3, "80");
                } else {
                    @EscalarImagen($anchoFinal, "0", $destinoFinal3, $destinoRecortado3, "80");
                }               
                unlink($destinoFinal3);
            }
        } else {
            $destinoRecortadoFinal3 = '';
        }
        /* FIN 3 */

        /* 4 */
        if (!empty($_FILES["img4"]["name"])) {
            $imgInicio4 = "";
            $destinoImg4 = "";
            $prefijo4 = substr(md5(uniqid(rand())), 0, 6);
            $imgInicio4 = $_FILES["img4"]["tmp_name"];
            $tucadena4 = $_FILES["img4"]["name"];
            $partes4 = explode(".", $tucadena4);
            $dominio4 = $partes4[1];

            if ($dominio4 != '') {
                $destinoImg4 = "archivos/productos/" . $prefijo4 . "." . $dominio4;
                $destinoFinal4 = "../archivos/productos/" . $prefijo4 . "." . $dominio4;
                move_uploaded_file($imgInicio4, $destinoFinal4);
                chmod($destinoFinal4, 0777);
                $destinoRecortado4 = "../archivos/productos/recortadas/a_" . $prefijo4 . "." . $dominio4;
                $destinoRecortadoFinal4 = "archivos/productos/recortadas/a_" . $prefijo4 . "." . $dominio4;
                 //Saber tamaño
                $tamano = getimagesize($destinoFinal4);
                $tamano1 = explode(" ", $tamano[3]);
                $anchoImagen = explode("=", $tamano1[0]);
                $anchoFinal = str_replace('"', "", trim($anchoImagen[1]));
                if ($anchoFinal >= 900) {
                    @EscalarImagen("900", "0", $destinoFinal4, $destinoRecortado4, "80");
                } else {
                    @EscalarImagen($anchoFinal, "0", $destinoFinal4, $destinoRecortado4, "80");
                }  
                unlink($destinoFinal4);
            }
        } else {
            $destinoRecortadoFinal4 = '';
        }
        /* FIN 4 */

        /* 5 */
        if ($_FILES["img5"]["tmp_name"] != '') {
            $imgInicio5 = "";
            $destinoImg5 = "";
            $prefijo5 = substr(md5(uniqid(rand())), 0, 6);
            $imgInicio5 = $_FILES["img5"]["tmp_name"];
            $tucadena5 = $_FILES["img5"]["name"];
            $partes5 = explode(".", $tucadena5);
            $dominio5 = $partes5[1];

            if ($dominio5 != '') {
                $destinoImg5 = "archivos/productos/" . $prefijo5 . "." . $dominio5;
                $destinoFinal5 = "../archivos/productos/" . $prefijo5 . "." . $dominio5;
                move_uploaded_file($imgInicio5, $destinoFinal5);
                chmod($destinoFinal5, 0777);
                $destinoRecortado5 = "../archivos/productos/recortadas/a_" . $prefijo5 . "." . $dominio5;
                $destinoRecortadoFinal5 = "archivos/productos/recortadas/a_" . $prefijo5 . "." . $dominio5;
                //Saber tamaño
                $tamano = getimagesize($destinoFinal5);
                $tamano1 = explode(" ", $tamano[3]);
                $anchoImagen = explode("=", $tamano1[0]);
                $anchoFinal = str_replace('"', "", trim($anchoImagen[1]));
                if ($anchoFinal >= 900) {
                    @EscalarImagen("900", "0", $destinoFinal5, $destinoRecortado5, "80");
                } else {
                    @EscalarImagen($anchoFinal, "0", $destinoFinal5, $destinoRecortado5, "80");
                }                 
                unlink($destinoFinal5);
            }
        } else {
            $destinoRecortadoFinal5 = '';
        }
        /* FIN 5 */



        $sql = "INSERT INTO `portfolio`
        (`cod_portfolio`, `nombre_portfolio`, `descripcion_portfolio`, `categoria_portfolio`, `moneda_portfolio`, `precio_portfolio`, `stock_portfolio`, `imagen1_portfolio`, `imagen2_portfolio`, `imagen3_portfolio`, `imagen4_portfolio`, `imagen5_portfolio`, `estado_portfolio`,  `tipo_portfolio`,`fecha_portfolio`) 
        VALUES 
        ('$cod','$titulo','$descripcion','$categorias','$moneda','$precio','$stock','$destinoRecortadoFinal','$destinoRecortadoFinal2','$destinoRecortadoFinal3','$destinoRecortadoFinal4','$destinoRecortadoFinal5','0','$tienda',NOW())";

        $link = Conectarse();
        $r = mysql_query($sql, $link);

        header("location:index.php?op=verPortfolio");
    } else {
      echo "<br/><center><span class='large-11 button' style='background:#872F30'>* Todos los datos son obligatorios</span></center>";
  }
}
?>

<div class="col-lg-12   ">
    <h4>Agregar a Producto</h4>
    <hr/>
    <form method="post" enctype="multipart/form-data">
        <div class="row" >
            <label class="col-lg-8">Título:
                <br/>
                <input type="text" name="titulo" class="form-control" value="<?php echo (isset($_POST['titulo']) ? $_POST['titulo'] : '') ?>" required>
            </label>
            <label class="col-lg-4">Categoría Productos:
                <select name="tipo" class="form-control">
                  <option>--  Seleccionar categoría --</option>                  
                  <option value="MIEL">MIEL</option>   
                  <option value="MERMELADA">MERMELADA</option>   
                  <option value="ACEITE">ACEITE</option>   
                  <option value="FIDEOS SECOS">FIDEOS SECOS</option>                 
              </select>
          </label>
          <div class="clearfix"></div>
          <label class="col-md-2">Moneda:
          <select name="moneda" disabled class="form-control">
               <option value="" disabled selected>-- moneda --</option>
               <option value="ARS" selected>ARS</option>                  
           </select>              
       </label> 
       <label class="col-md-1">Código:<br/>
        <input type="text" class="form-control" name="cod" value="<?php echo (isset($_POST["cod"]) ? $_POST["cod"] : '0' ); ?>">                 
    </label>
    <label class="col-md-3">¿Productos / Tienda?:
        <select name="tienda"  disabled class="form-control">
          <option value="0" selected>PRODUCTOS</option>                  
      </select>        
  </label>
  <label class="col-md-3">Precio:
    <div class="input-group">
       <div class="input-group-addon">$</div>
       <input type="text" class="form-control" disabled name="precio" value="<?php echo (isset($_POST["precio"]) ? $_POST["precio"] : '' ); ?>">                 
   </div>     
</label>
<label class="col-md-3">Stock:
    <div class="input-group">
       <input type="number" class="form-control" disabled name="stock" value="<?php echo (isset($_POST["stock"]) ? $_POST["stock"] : '' ); ?>">                    
       <div class="input-group-addon">unid.</div>

   </div>     
</label>
<div class="clearfix"></div>             
<label class="col-md-12 col-lg-12">Desarrollo:
    <br/>
    <textarea name="descripcion" class="form-control"  style="height:300px;display:block"><?php echo (isset($_POST['descripcion']) ? $_POST['descripcion'] : '') ?></textarea>
    <script>
   // CKEDITOR.replace('descripcion');
</script> 
</label>
<div class="clearfix">
    <br/>
</div>
<br> 
<label class="col-lg-2 col-md-2">Imagen 1 producto:
    <br/>
    <input type="file" name="img" class="form-control"/>
</label>
<label class="col-lg-2 col-md-2">Imagen 2 producto:
    <br/>
    <input type="file" name="img2" class="form-control"/>
</label>
<label class="col-lg-2 col-md-2">Imagen 3  producto:
    <br/>
    <input type="file" name="img3" class="form-control"/>
</label>
<label class="col-lg-2 col-md-2">Imagen 4 producto:
    <br/>
    <input type="file" name="img4" class="form-control"/>
</label>
<label class="col-lg-2 col-md-2">Imagen 5 producto:
    <br/>
    <input type="file" name="img5" class="form-control"/>
</label>         
<div class="clearfix">
    <br/>
</div>
<br>
<label class="col-lg-7">
    <input type="submit" class="btn btn-primary" name="agregar" value="Subir Producto" />
</label>
</div>
</form>
</div>
