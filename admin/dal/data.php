<?php
include 'cnx.php';
$op = isset($_GET['op']) ? $_GET['op'] : '';
$pagina = isset($_GET['pag']) ? $_GET['pag'] : '';

function Contenidos_Read()
{
 $idConn = Conectarse();
 $sql = " 
 SELECT * 
 FROM contenidos 
 ORDER BY id ASC 
 ";
 $resultado = mysqli_query($idConn, $sql);
 while ($row = mysqli_fetch_array($resultado)) {
  $codigo = $row['codigo'];
  ?>
  <tr>
   <td class="maxwidth"><?php
    echo($row['id']);
    ?></td>
    <td style="text-transform:uppercase"><?php
     echo strtoupper($codigo);
     ?></td>
     <td>
      <center>
       <a href="index.php?op=modificarContenidos&id=<?php
       echo $row['id'];
       ?>" style="width:20px"
       data-toggle="tooltip" alt="Modificar" title="Modificar"><i
       class="glyphicon glyphicon-cog"></i></a>
      </center>
     </td>
    </tr>
    <?php
   }
  }

  function Contenido_eId($id)
  {
   $sql = "SELECT * 
   FROM contenidos 
   WHERE codigo = '$id'";
   $link = Conectarse();
   $result = mysqli_query($link, $sql);
   $data = mysqli_fetch_array($result);
   return $data;
  }

  function Contenido_TraerPorIdAdmin($id)
  {
   $sql = "SELECT * 
   FROM contenidos 
   WHERE id = '$id'";
   $link = Conectarse();
   $result = mysqli_query($link, $sql);
   $data = mysqli_fetch_array($result);
   return $data;
  }

  function Traer_Contenidos($codigo)
  {
   $sql = "SELECT * 
   FROM contenidos 
   WHERE codigo = '$codigo'";
   $link = Conectarse();
   $result = mysqli_query($link, $sql);
   while ($data = mysqli_fetch_array($result)) {
    echo $data["contenido"];
   }
  }

  function Categoria_Read_Productos()
  {
   $idConn = Conectarse();
   $sql = "SELECT categoria_portfolio FROM portfolio GROUP BY categoria_portfolio";
   $resultado = mysqli_query($idConn, $sql);
   while ($row = mysqli_fetch_array($resultado)) {
    $categoria = $row["categoria_portfolio"];
    switch ($categoria) {
     case 1:
     $categoriaFinal = "MEDICAMENTOS";
     break;
     case 2:
     $categoriaFinal = "MONODROGOS";
     break;
     case 3:
     $categoriaFinal = "PROMOCIÓN";
     break;
     case 4:
     $categoriaFinal = "PERFUMERÍA";
     break;
     case 5:
     $categoriaFinal = "ACCESORIOS";
     break;
     default:
     $categoriaFinal = "SIN CATEGORÍA";
     break;
    }
    ?>
    <option value="<?php
    echo $row["categoria_portfolio"];
    ?>"><?php
    echo $categoriaFinal;
    ?></option>
    <?php
   }
  }

  function Suscripto_TraerPorId($email)
  {
   $sql = "SELECT * 
   FROM suscriptobase 
   WHERE EmailSuscriptos LIKE '%$email%'";
   $link = Conectarse();
   $result = mysqli_query($link, $sql);
   $data = mysqli_fetch_array($result);
   return $data;
  }

  function Dolar_TraerPorId()
  {
   $idConn = Conectarse();
   $sql = "SELECT * FROM `dolar` LIMIT 1";
   $resultado = mysqli_query($idConn, $sql);
   $data = mysqli_fetch_array($resultado);
   return $data;
  }

  function Contacto_Read($pag)
  {
   $limit = "";
   if ($pag == "inicio") {
    $limit = "LIMIT 0,10";
   } else {
    $limit = "";
   }
   $idConn = Conectarse();
   $sql = "SELECT * FROM `contacto` ORDER BY  IdContacto Desc, EstadoContacto ASC $limit";
   $resultado = mysqli_query($idConn, $sql);
   while ($row = mysqli_fetch_array($resultado)) {
    $date = explode("-", $row["FechaContacto"]);
    ?>
    <tr>
     <td><?php
      echo $date[2] . "/" . $date[1] . "/" . $date[0];
      ?></td>
      <td><?php
       echo strtoupper($row["NombreContacto"] . " " . $row["ApellidoContacto"]);
       ?></td>
       <td style="text-transform: none"><?php
        echo strtolower($row["EmailContacto"]);
        ?></td>
        <td><?php
         echo $row["TelefonoContacto"];
         ?></td>
         <td><?php
          echo $row["CelularContacto"];
          ?></td>
          <td><?php
           echo $row["MensajeContacto"];
           ?></td>
           <td style="text-align: right">
            <a href=<?php
            echo 'mailto:' . $row["EmailContacto"] . '?Subject=Respuesta%20a%20la%20Consulta%20TV5';
            ?> style="margin:5px"><span
            class="glyphicon glyphicon-envelope"></span></a>
            <?php
            if ($row["EstadoContacto"] != 0) {
             ?>
             <a href="index.php?op=verContacto&borrar=<?php
             echo $row["IdContacto"];
             ?>&upd=0" style="margin:5px">
             <span class="glyphicon glyphicon-ok"></span>
            </a>
            <?php
           } else {
            ?>
            <a href="index.php?op=verContacto&borrar=<?php
            echo $row["IdContacto"];
            ?>&upd=1" style="margin:5px"><span
            class="glyphicon glyphicon-time"></span></a>
            <?php
           }
           ?>
          </td>
         </tr>
         <?php
        }
       }

       function Suscriptos_Read($promo)
       {
        $idConn = Conectarse();
        $sql = "SELECT * FROM `suscriptos` WHERE PromoSuscripto = $promo ORDER BY  IdSuscripto Desc, EstadoSuscripto ASC";
        $resultado = mysqli_query($idConn, $sql);
        while ($row = mysqli_fetch_array($resultado)) {
         $fecha = explode(" ", $row["FechaSuscripto"]);
         $date = explode("-", $fecha[0]);
         ?>
         <tr>
          <td><?php
           echo $date[2] . "/" . $date[1] . "/" . $date[0] . " " . $fecha[1];
           ?></td>
           <td><?php
            echo strtoupper($row["NombreSuscripto"]);
            ?></td>
            <td style="text-transform: none"><?php
             echo strtolower($row["EmailSuscripto"]);
             ?></td>
             <td><?php
              echo $row["TelefonoSuscripto"];
              ?></td>
              <td><?php
               echo $row["DireccionSuscripto"];
               ?></td>
               <td style="text-align: right">
                <a href=<?php
                echo 'mailto:' . $row["EmailSuscripto"] . '?Subject=Respuesta%20a%20la%20Suscripción%20TV5';
                ?> style="margin:5px"><span
                class="glyphicon glyphicon-envelope"></span></a>
                <?php
                if ($row["EstadoSuscripto"] != 0) {
                 ?>
                 <a href="index.php?op=verSuscriptos&promo=<?php
                 echo $promo;
                 ?>&borrar=<?php
                 echo $row["IdSuscripto"];
                 ?>&upd=0"
                 style="margin:5px"><span class="glyphicon glyphicon-ok"></span></a>
                 <?php
                } else {
                 ?>
                 <a href="index.php?op=verSuscriptos&promo=<?php
                 echo $promo;
                 ?>&borrar=<?php
                 echo $row["IdSuscripto"];
                 ?>&upd=1"
                 style="margin:5px"><span class="glyphicon glyphicon-time"></span></a>
                 <?php
                }
                ?>
                <a href="index.php?op=verSuscriptos&promo=<?php
                echo $promo;
                ?>&borrar=<?php
                echo $row["IdSuscripto"];
                ?>"
                style="margin:5px"><span class="glyphicon glyphicon-trash"></span></a>
               </td>
              </tr>
              <?php
             }
            }

            function Inscriptos_Read($pag)
            {
             $limit = '';
             if ($pag == "inicio") {
              $limit = "LIMIT 0,10";
             }
             $idConn = Conectarse();
             $sql = "SELECT * FROM `inscriptos_socios` ORDER BY fecha_inscriptosocio DESC $limit ";
             $resultado = mysqli_query($idConn, $sql);
             while ($row = mysqli_fetch_array($resultado)) {
              $fecha = explode(" ", $row["fecha_inscriptosocio"]);
              $date = explode("-", $fecha[0]);
              ?>
              <tr>
               <td><?php
                echo $date[2] . "/" . $date[1] . "/" . $date[0] . " " . $fecha[1];
                ?></td>
                <td><?php
                 echo $row["socio_inscriptosocio"];
                 ?></td>
                 <td><?php
                  echo strtoupper($row["nombre_inscriptosocio"]);
                  ?></td>
                  <td class="hidden-xs"><?php
                   echo strtoupper($row["cargo_inscriptosocio"]);
                   ?></td>
                   <td class="hidden-xs"
                   style="text-transform: none"><?php
                   echo strtolower($row["email_inscriptosocio"]);
                   ?></td>
                   <td style="text-align: center">
                    <a href="../<?php
                    echo $row["invitacion_inscriptosocio"];
                    ?>" target="_blank" style="margin:5px"><span
                    class="glyphicon glyphicon-file"></span></a>
                    <a href=<?php
                    echo 'mailto:' . $row["email_inscriptosocio"] . '?Subject=Respuesta%20a%20la%20Consulta%20Evento%20Acorca';
                    ?> style="margin:5px"><span
                    class="glyphicon glyphicon-envelope"></span></a>
                    <?php
                    if ($row["estado_inscriptosocio"] != 0) {
                     ?>
                     <a href="index.php?op=verInscriptosS&borrar=<?php
                     echo $row["id_inscriptosocio"];
                     ?>&upd=0"
                     style="margin:5px"><span class="glyphicon glyphicon-ok"></span></a>
                     <?php
                    } else {
                     ?>
                     <a href="index.php?op=verInscriptosS&borrar=<?php
                     echo $row["id_inscriptosocio"];
                     ?>&upd=1"
                     style="margin:5px"><span class="glyphicon glyphicon-time"></span></a>
                     <?php
                    }
                    ?>
                    <a href="index.php?op=verInscriptosS&elim=<?php
                    echo $row["id_inscriptosocio"];
                    ?>" style="margin:5px"
                    title="Borrar"><span class="glyphicons glyphicon glyphicon-remove-circle"></span></a>
                   </td>


                  </tr>
                  <?php
                 }
                }

                function Usuarios_Inscriptos_Read($pag)
                {
                 $limit = "";
                 if ($pag == "inicio") {
                  $limit = "LIMIT 0,10";
                 }
                 $idConn = Conectarse();
                 $sql = "SELECT * FROM `inscriptos_usuarios` ORDER BY fecha_inscripto  DESC $limit ";
                 $resultado = mysqli_query($idConn, $sql);
                 while ($row = mysqli_fetch_array($resultado)) {
                  $fecha = explode(" ", $row["fecha_inscripto"]);
                  $date = explode("-", $fecha[0]);
                  ?>
                  <tr>
                   <td><?php
                    echo $date[2] . "/" . $date[1] . "/" . $date[0] . " " . $fecha[1];
                    ?></td>
                    <td><?php
                     echo strtoupper($row["nombre_inscripto"]);
                     ?></td>
                     <td class="hidden-xs"><?php
                      echo $row["empresa_inscripto"];
                      ?></td>
                      <td class="hidden-xs" style="text-transform: none"><?php
                       echo $row["telefono_inscripto"];
                       ?></td>
                       <td style="text-transform: none"><?php
                        echo $row["celular_inscripto"];
                        ?></td>
                        <td class="hidden-xs" style="text-transform: none"><?php
                         echo strtolower($row["email_inscripto"]);
                         ?></td>

                         <td class="hidden-xs" style="text-transform: none"><?php
                          echo $row["localidad_inscripto"];
                          ?></td>
                          <td class="hidden-xs" style="text-transform: none"><?php
                           echo $row["provincia_inscripto"];
                           ?></td>
                           <td style="text-align: center">
                            <a href="index.php?op=verInscriptosI&email=<?php
                            echo $row["email_inscripto"];
                            ?>&archivo=<?php
                            echo $row["invitacion_inscripto"];
                            ?>"
                            style="margin:5px" title="Reenviar Invitación"><span class="fa fa-share-square fa-fw"></span></a>
                            <a href="../<?php
                            echo $row["invitacion_inscripto"];
                            ?>" target="_blank" style="margin:5px"
                            title="Ver Invitación"><span class="glyphicon glyphicon-file"></span></a>
                            <a href=<?php
                            echo 'mailto:' . $row["email_inscripto"] . '?Subject=Respuesta%20a%20la%20Consulta%20Evento%20Acorca';
                            ?> title="Enviar
                            Email" style="margin:5px"><span class="glyphicon glyphicon-envelope"></span></a>
                            <?php
                            if ($row["estado_inscripto"] != 0) {
                             ?>
                             <a href="index.php?op=verInscriptosI&borrar=<?php
                             echo $row["id_inscripto"];
                             ?>&upd=0"
                             style="margin:5px" title="Cerrado!"><span class="glyphicon glyphicon-ok"></span></a>
                             <?php
                            } else {
                             ?>
                             <a href="index.php?op=verInscriptosI&borrar=<?php
                             echo $row["id_inscripto"];
                             ?>&upd=1"
                             style="margin:5px" title="Esperando..."><span class="glyphicon glyphicon-time"></span></a>
                             <?php
                            }
                            ?>
                            <a href="index.php?op=verInscriptosI&elim=<?php
                            echo $row["id_inscripto"];
                            ?>" style="margin:5px"
                            title="Borrar"><span class="glyphicons glyphicon glyphicon-remove-circle"></span></a>
                           </td>
                          </tr>
                          <?php
                         }
                        }

                        function Videos_Read()
                        {
                         $idConn = Conectarse();
                         $sql = "SELECT * FROM videos ORDER BY IdVideos DESC";
                         $resultado = mysqli_query($idConn, $sql);
                         while ($row = mysqli_fetch_array($resultado)) {
                          ?>
                          <tr>
                           <td><?php
                            echo $row['TituloVideos'];
                            ?></td>
                            <td>
                             <div style="width:60px;margin: auto;display:block">
                              <a href="index.php?op=modificarVideos&id=<?php
                              echo $row['IdVideos'];
                              ?>" style="width:20px"
                              data-toggle="tooltip" alt="Modificar" title="Modificar"><i
                              class="glyphicon glyphicon-cog"></i></a>
                              <a href="index.php?op=verVideos&borrar=<?php
                              echo $row['IdVideos'];
                              ?>" style="width:20px"
                              data-toggle="tooltip" alt="Eliminar" title="Eliminar"
                              onClick="return confirm('¿Seguro querés eliminar el video?')"><i
                              class="glyphicon glyphicon-trash"></i></a>
                             </div>
                            </td>
                           </tr>

                           <?php
                          }
                         }

                         function Videos_Read_Front()
                         {
                          $idConn = Conectarse();
                          $sql = "SELECT * FROM videos ORDER BY IdVideos DESC";
                          $resultado = mysqli_query($idConn, $sql);
                          while ($row = mysqli_fetch_array($resultado)) {
                           ?>
                           <div class="col-md-4" style="margin-bottom:20px;">
                            <h4 style="height:40px;text-transform:uppercase;text-align:center"><b><?php
                             echo $row["TituloVideos"];
                             ?></b>
                            </h4>
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php
                            echo $row["UrlVideos"];
                            ?>"
                            frameborder="0" allowfullscreen></iframe>
                           </div>
                           <?php
                          }
                         }

                         function Videos_Read_Side()
                         {
                          $idConn = Conectarse();
                          $sql = "SELECT * FROM videos ORDER BY RAND() LIMIT 0,1";
                          $resultado = mysqli_query($idConn, $sql);
                          while ($row = mysqli_fetch_array($resultado)) {
                           ?>

                           <iframe width="100%" height="250px" src="//www.youtube.com/embed/<?php
                           echo $row["UrlVideos"];
                           ?>"
                           frameborder="0" allowfullscreen></iframe>

                           <?php
                          }
                         }

                         function Slider_Read()
                         {
                          $idConn = Conectarse();
                          $sql = "SELECT * FROM sliderbase WHERE EstadoSlider = 0 ORDER BY IdSlider DESC";
                          $resultado = mysqli_query($idConn, $sql);
                          $i = 0;
                          while ($row = mysqli_fetch_array($resultado)) {
                           $pos = strpos($row["LinkSlider"], "http");
                           $titulo = trim($row["TituloSlider"]);
                           $subtitulo = trim($row["SubtituloSlider"]);
                           ?>
                           <div class="item <?php
                           if ($i == 0) {
                            echo "active";
                           }
                           ?>"
                           style="background:url('<?php
                            echo BASE_URL;
                            ?>/<?php
                            echo $row["ImgSlider"];
                            ?>') no-repeat left center/cover;height:520px">
                            <div class="caption">
                             <?php
                             if ($subtitulo != '') {
                              ?>
                              <h2 class="wow fadeInUp" data-wow-delay="0.6s"><?php
                               echo $row["SubtituloSlider"];
                               ?></h2>
                               <?php
                              }
                              ?>
                              <div class="clearfix"></div>
                              <?php
                              if ($titulo != '') {
                               ?>
                               <h1 class="wow fadeInLeft" data-wow-delay="0.6s"><?php
                                echo $row["TituloSlider"];
                                ?></h1>
                                <?php
                               }
                               ?>
                               <div class="clearfix"></div>
                               <a href="<?php
                               echo $row["LinkSlider"];
                               ?>" class="btn btn-azul">
                               VER AQUÍ
                              </a>

                              <div class="clearfix"></div>
                             </div>
                            </div>
                            <?php
                            $i++;
                           }
                          }

                          function Notas_Slide_Read($cod)
                          {
                           $idConn = Conectarse();
                           $sql = "SELECT `ruta` FROM `imagenes` WHERE `codigo` =  '$cod'";
                           $resultado = mysqli_query($idConn, $sql);
                           $i = 0;
                           while ($row = mysqli_fetch_array($resultado)) {
                            $imagen = BASE_URL . "/" . $row['ruta'];
                            ?>
                            <div class="item <?php
                            if ($i == 0) {
                             echo "active";
                            }
                            ?>">
                            <img src="<?php
                            echo $imagen;
                            ?>" width="100%"/>
                           </div>
                           <?php
                           $i++;
                          }
                         }

                         function Slider_Read_Admin()
                         {
                          $idConn = Conectarse();
                          $sql = "SELECT * FROM sliderbase ORDER BY IdSlider DESC";
                          $resultado = mysqli_query($idConn, $sql);
                          $i = 0;
                          while ($row = mysqli_fetch_array($resultado)) {
                           ?>
                           <tr>
                            <td><?php
                             echo $row['IdSlider'];
                             ?></td>
                             <td><?php
                              echo $row['TituloSlider'];
                              ?></td>

                              <td>
                               <center>
                                <?php
                                switch ($row['EstadoSlider']) {
                                 case 0:
                                 ?><a href="index.php?op=verSlider&upd=1&borrar=<?php
                                 echo $row[0];
                                 ?>"
                                 id="tooltip<?php
                                 echo $i++;
                                 ?>" style="width:20px"><i
                                 class="glyphicon glyphicon-ok-circle"></i></a><?php
                                 break;
                                 case 1:
                                 ?><a href="index.php?op=verSlider&upd=0&borrar=<?php
                                 echo $row[0];
                                 ?>"
                                 id="tooltip<?php
                                 echo $i++;
                                 ?>" style="width:20px"><i
                                 class="glyphicon glyphicon-ban-circle"></i></a><?php
                                 break;
                                }
                                ?>
                               </center>
                              </td>
                              <td>
                               <center>
                                <a href="index.php?op=modificarSlider&id=<?php
                                echo $row[0];
                                ?>"><i
                                class="glyphicon glyphicon-cog"></i></a>
                                <a href="index.php?op=verSlider&borrar=<?php
                                echo $row[0];
                                ?>"><i
                                class="glyphicon glyphicon-trash"></i></a>
                               </center>
                              </td>
                             </tr>

                             <?php
                            }
                           }

                           function Registro_Read()
                           {
                            $idConn = Conectarse();
                            $sql = "SELECT * FROM registrobase ORDER BY IdRegistro DESC";
                            $resultado = mysqli_query($idConn, $sql);
                            while ($row = mysqli_fetch_array($resultado)) {
                             ?>
                             <tr>
                              <td><?php
                               echo $row['IdRegistro'];
                               ?></td>
                               <td><?php
                                echo $row['NombreRegistro'];
                                ?></td>
                                <td><?php
                                 echo $row['EmailRegistro'];
                                 ?></td>
                                 <td><?php
                                  echo $row['TelefonoRegistro'];
                                  ?></td>
                                  <td>
                                   <div style="width:60px;margin: auto;display:block">
                                    <a href="index.php?pag=registros&id=<?php
                                    echo $row[0];
                                    ?>&op=m"><img src="img/iconos/Settings.png"
                                    width="20px"
                                    style="margin-right:10px;"></a>
                                    <a href="index.php?pag=registros&id=<?php
                                    echo $row[0];
                                    ?>&op=e"><img
                                    src="img/iconos/Recycle_Bin_Empty.png" width="20px"></a>
                                   </div>
                                  </td>
                                 </tr>

                                 <?php
                                }
                               }

                               function Precio_Read()
                               {
                                $idConn = Conectarse();
                                $sql = "SELECT * FROM preciosbase ORDER BY id DESC";
                                $resultado = mysqli_query($idConn, $sql);
                                while ($row = mysqli_fetch_array($resultado)) {
                                 ?>
                                 <tr>
                                  <td><?php
                                   echo $row['id'];
                                   ?></td>
                                   <td><?php
                                    echo $row['titulo'];
                                    ?></td>
                                    <td><?php
                                     echo $row['precio'];
                                     ?></td>
                                     <td>
                                      <div style="width:60px;margin: auto;display:block">
                                       <a href="index.php?pag=precios&id=<?php
                                       echo $row["id"];
                                       ?>&op=m"><img src="img/iconos/Settings.png"
                                       width="20px"
                                       style="margin-right:10px;"></a>
                                       <a href="index.php?pag=precios&id=<?php
                                       echo $row["id"];
                                       ?>&op=e"><img
                                       src="img/iconos/Recycle_Bin_Empty.png" width="20px"></a>
                                      </div>
                                     </td>
                                    </tr>

                                    <?php
                                   }
                                  }

                                  function Precio_Read_Front()
                                  {
                                   $idConn = Conectarse();
                                   $sql = "SELECT * FROM preciosbase ORDER BY id asc";
                                   $resultado = mysqli_query($idConn, $sql);
                                   $sql2 = "SELECT COUNT(*) FROM preciosbase";
                                   $resultado2 = mysqli_query($idConn, $sql2);
                                   $cantidad = mysqli_fetch_row($resultado2);
                                   if ($cantidad[0] <= 2) {
                                    $clase = "one_half";
                                   } elseif ($cantidad[0] <= 3) {
                                    $clase = "one_third";
                                   } else {
                                    $clase = "one_fourth";
                                   }
                                   while ($row = mysqli_fetch_array($resultado)) {
                                    $caract = explode(",", $row["descripcion"]);
                                    ?>
                                    <div class="<?php
                                    echo $clase;
                                    ?>">
                                    <div class="pricingtable">
                                     <h2 class="title"><?php
                                      echo $row["nombre_portfolio"];
                                      ?></h2>

                                      <div class="cmsms_price" style="background-color:#6cc437;">
                                       <span class="currency">$</span>
                                       <span class="price"><?php
                                        echo $row["precio"];
                                        ?></span>
                                        <span class="period"><?php
                                         echo $row["periodo"];
                                         ?></span>
                                        </div>
                                        <ul>
                                         <?php
                                         foreach ($caract as $caracts) {
                                          ?>
                                          <li><?php
                                           echo $caracts;
                                           ?></li>
                                           <?php
                                          }
                                          ?>
                                         </ul>
                                        </div>
                                       </div>
                                       <?php
                                      }
                                     }

                                     function Suscripto_Read()
                                     {
                                      $idConn = Conectarse();
                                      $sql = "SELECT IdSuscriptos, EmailSuscriptos, FechaSuscriptos FROM suscriptobase";
                                      $resultado = mysqli_query($idConn, $sql);
                                      while ($row = mysqli_fetch_row($resultado)) {
                                       ?>
                                       <tr>
                                        <td><?php
                                         echo $row[0];
                                         ?></td>
                                         <td><?php
                                          echo $row[1];
                                          ?></td>
                                          <td><?php
                                           echo $row[2];
                                           ?></td>
                                           <td class="options-width">
                                            <a href="index2.php?pagina=suscriptosModif&op=m&sup=<?php
                                            echo $row[0];
                                            ?>" title="Editar"
                                            onClick="return confirm('¿Seguro quiere editar la nota?')" class="icon-1 info-tooltip"></a>
                                            <a href='index2.php?pagina=suscriptosElim&op=e&sus=<?php
                                            echo $row[0];
                                            ?>'
                                            onClick="return confirm('¿Seguro quiere eliminar el suplemento?')" class='icon-2 info-tooltip'></a>
                                            <!--    <a href="index2.php?pagina=suplementoElim&sup=<?php
                                            ?>" title="Eliminar" onClick="" ></a>-->
                                           </td>
                                          </tr>

                                          <?php
                                         }
                                        }

                                        function Categoria_Read_Agregar()
                                        {
                                         $idConn = Conectarse();
                                         $sql = "SELECT IdSuplementos, TituloSuplementos  FROM categoriabase ORDER BY IdSuplementos DESC";
                                         $resultado = mysqli_query($idConn, $sql);
                                         while ($row = mysqli_fetch_row($resultado)) {
                                          ?>
                                          <option value="<?php
                                          echo $row[0];
                                          ?>"><?php
                                          echo $row[1];
                                          ?></option>
                                          <?php
                                         }
                                        }

                                        function Leer_Pedidos($id_usuario)
                                        {
                                         $idConn = Conectarse();
                                         $sql = "SELECT * FROM pedidos WHERE usuario_pedido =  '2' ORDER BY estado_pedido ASC";
                                         $resultado = mysqli_query($idConn, $sql);
                                         $i = 0;
                                         while ($row = mysqli_fetch_array($resultado)) {
                                          ?>
                                          <li class="listado" <?php
                                          if ($row["estado_pedido"] == 1) {
                                           echo "style='background:#4393C3'";
                                          } else {
                                           echo "style='background:#2166AC'";
                                          }
                                          ?>>
                                          <p><?php
                                           echo "Pedido &rarr; " . strtoupper($row["categoria_pedido"]) . "<br/>Solicitado &rarr; " . $row["fecha_pedidos"];
                                           ?> </p>
                                           <button onclick=($("#pedido<?php
                                            echo $i;
                                            ?>").slideToggle('500'))>Ver +
                                           </button>
                                          </li>
                                          <span class="listadoSpan" id="pedido<?php
                                          echo $i;
                                          ?>" style="display:none">
                                          <?php
                                          echo $row["contenido_pedido"];
                                          ?>
                                          <?php
                                          if ($row["estado_pedido"] == 1) {
                                           echo "Presupuesto &rarr; $" . $row["costo_pedido"] . " <a href='pedido.php?op=pagar'>PAGAR</a>";
                                          }
                                          ?>
                                         </span>

                                         <?php
                                         $i++;
                                        }
                                       }

                                       function CategoriaPro_Read_Agregar()
                                       {
                                        $idConn = Conectarse();
                                        $sql = "SELECT * FROM categoriaproducto ORDER BY IdCategoriaProducto DESC";
                                        $resultado = mysqli_query($idConn, $sql);
                                        while ($row = mysqli_fetch_row($resultado)) {
                                         ?>
                                         <option value="<?php
                                         echo $row[0];
                                         ?>"><?php
                                         echo $row[1];
                                         ?></option>
                                         <?php
                                        }
                                       }

                                       function Banner_Read_Agregar()
                                       {
                                        $idConn = Conectarse();
                                        $sql = "SELECT * FROM bannersize";
                                        $resultado = mysqli_query($idConn, $sql);
                                        while ($row = mysqli_fetch_row($resultado)) {
                                         ?>
                                         <option value="<?php
                                         echo $row[0];
                                         ?>"><?php
                                         echo $row[1];
                                         ?> x <?php
                                         echo $row[2];
                                         ?></option>
                                         <?php
                                        }
                                       }

                                       function Notas_Read()
                                       {
                                        $idConn = Conectarse();
                                        $sql = " 
                                        SELECT * 
                                        FROM notabase 
                                        ORDER BY IdNotas DESC 
                                        ";
                                        $resultado = mysqli_query($idConn, $sql);
                                        while ($row = mysqli_fetch_array($resultado)) {
                                         ?>
                                         <tr>
                                          <td class="maxwidth"><?php
                                           echo($row['IdNotas']);
                                           ?></td>
                                           <td style="text-transform:uppercase"><?php
                                            echo strtoupper($row['TituloNotas']);
                                            ?></td>
                                            <td style="text-transform:uppercase"><?php
                                             echo strtoupper($row['CategoriaNotas']);
                                             ?></td>
                                             <td>

                                              <Center>
                                               <a href="index.php?op=modificarNotas&id=<?php
                                               echo $row['IdNotas'];
                                               ?>" style="width:20px"
                                               data-toggle="tooltip" alt="Modificar" title="Modificar"><i
                                               class="glyphicon glyphicon-cog"></i></a>
                                               <a href="index.php?op=verNotas&borrar=<?php
                                               echo $row["CodNotas"];
                                               ?>" style="width:20px"
                                               data-toggle="tooltip" alt="Eliminar" title="Eliminar"
                                               onClick="return confirm('¿Seguro querés eliminar la novedad?')"><i
                                               class="glyphicon glyphicon-trash"></i></a>
                                              </Center>
                                             </td>
                                            </tr>
                                            <?php
                                           }
                                          }

                                          function Cursos_Read()
                                          {
                                           $idConn = Conectarse();
                                           $sql = " 
                                           SELECT * 
                                           FROM cursos 
                                           ORDER BY IdCursos DESC 
                                           ";
                                           $resultado = mysqli_query($idConn, $sql);
                                           while ($row = mysqli_fetch_array($resultado)) {
                                            ?>
                                            <tr>
                                             <td><?php
                                              echo $row['IdCursos'];
                                              ?></td>
                                              <td class="maxwidth"><?php
                                               echo substr($row['TituloCursos'], 0, 50) . "...";
                                               ?></td>
                                               <td>

                                                <?php
                                                switch ($row["DestacarCurso"]) {
                                                 case 1:
                                                 ?>
                                                 <a href="index.php?op=verCursos&es=<?php
                                                 echo $row["IdCursos"];
                                                 ?>&estado=0"><img
                                                 src="img/estado2.jpg" width="20"></a>
                                                 <?php
                                                 break;
                                                 case 0:
                                                 ?>
                                                 <a href="index.php?op=verCursos&es=<?php
                                                 echo $row["IdCursos"];
                                                 ?>&estado=1"><img
                                                 src="img/estado3.jpg" width="20"></a>
                                                 <?php
                                                 break;
                                                }
                                                ?>


                                                <a href="index.php?op=modificarCursos&id=<?php
                                                echo $row['IdCursos'];
                                                ?>"><img src="img/modif.png"
                                                width="20"
                                                style="margin:2px"></a>
                                                <a href="index.php?op=verCursos&borrar=<?php
                                                echo $row["IdCursos"];
                                                ?>"><img src="img/elim.jpg"
                                                width="20"
                                                style="margin:2px"></a>
                                               </td>
                                              </tr>
                                              <?php
                                             }
                                            }

                                            function Cursos_Read_Front($cantidad)
                                            {
                                             $idConn = Conectarse();
                                             $sql = " 
                                             SELECT SocioCursos 
                                             FROM cursos 
                                             GROUP BY SocioCursos 
                                             ";
                                             $resultado = mysqli_query($idConn, $sql);
                                             $i = 0;
                                             while ($row = mysqli_fetch_array($resultado)) {
                                              $socio = $row["SocioCursos"];
                                              $i++;
                                              ?>
                                              <div class="news column c-<?php
                                              echo $cantidad;
                                              ?> clearfix">
                                              <h2 style="width:100%;padding-bottom:6px;font-size:15px;color:#4496D2"><?php
                                               echo $row["SocioCursos"];
                                               ?></h2>

                                               <div style="width:100%;border-bottom:1px solid #EEEEEE;"></div>

                                               <div class="arrows" style="position:relative; top:30px;margin-bottom:10px"></div>
                                               <div class="cContent clearfix rotator ">
                                                <ul class="slides">
                                                 <?php
                                                 $sql2 = " 
                                                 SELECT * 
                                                 FROM cursos 
                                                 WHERE SocioCursos = '$socio'   
                                                 ORDER BY IdCursos desc                   
                                                 ";
                                                 $resultado2 = mysqli_query($idConn, $sql2);
                                                 while ($row2 = mysqli_fetch_array($resultado2)) {
                                                  ?>
                                                  <li>
                                                   <div class="post">
                                                    <div class="imagen">
                                                     <a href="capacitacion.php?cap=<?php
                                                     echo $row2['IdCursos'];
                                                     ?>"><img
                                                     src="<?php
                                                     echo $row2['ImgCursos'];
                                                     ?>" class="imgCurso"></a>
                                                    </div>

                                                    <div class="info" style="border-left:#003F54 2px solid;">
                                                     <a href="capacitacion.php?cap=<?php
                                                     echo $row2['IdCursos'];
                                                     ?>">
                                                     <h5><?php
                                                      echo $row2['TituloCursos'];
                                                      ?></h5></a>
                                                      <br/>

                                                      <p style="text-align: justify">
                                                       <?php
                                                       echo ltrim(strip_tags(substr($row2['DesarrolloCursos'], 0, 150) . "..."));
                                                       ?>
                                                      </p>
                                                      <br/>
                                                      <a href="capacitacion.php?cap=<?php
                                                      echo $row2['IdCursos'];
                                                      ?>" class="right">ver
                                                      +</a>
                                                     </div>
                                                    </div>
                                                   </li>
                                                   <?php
                                                  }
                                                  ?>
                                                 </ul>
                                                </div>
                                               </div>
                                               <?php
                                              }
                                             }

                                             function Clientes_Read()
                                             {
                                              $idConn = Conectarse();
                                              $sql = " 
                                              SELECT * 
                                              FROM clientes 
                                              ORDER BY id_clientes DESC 
                                              ";
                                              $resultado = mysqli_query($idConn, $sql);
                                              while ($row = mysqli_fetch_array($resultado)) {
                                               ?>
                                               <tr>
                                                <td style="text-transform:uppercase"><?php
                                                 echo substr(strtoupper($row['titulo_clientes']), 0, 50);
                                                 ?></td>
                                                 <td style="text-align:center">
                                                  <a href="index.php?op=modificarClientes&id=<?php
                                                  echo $row['id_clientes'];
                                                  ?>" data-toggle="tooltip"
                                                  alt="Modificar" title="Modificar"><i class="glyphicon glyphicon-cog"></i></a>
                                                  <a href="index.php?op=verClientes&borrar=<?php
                                                  echo $row["id_clientes"];
                                                  ?>"
                                                  onClick="return confirm('¿Seguro querés eliminar el producto?')" data-toggle="tooltip" alt="Eliminar"
                                                  title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
                                                 </td>
                                                </tr>
                                                <?php
                                               }
                                              }

                                              function Clientes_Read_Front()
                                              {
                                               $idConn = Conectarse();
                                               $sql = " 
                                               SELECT * 
                                               FROM clientes 
                                               ORDER BY id_clientes DESC 
                                               ";
                                               $resultado = mysqli_query($idConn, $sql);
                                               while ($row = mysqli_fetch_array($resultado)) {
                                                ?>
                                                <div class="col-md-2">
                                                 <div
                                                 style="background:url('<?php
                                                  echo $row['imagen_clientes'];
                                                  ?>') no-repeat center center/contain;height:200px;">
                                                 </div>
                                                </div>
                                                <?php
                                               }
                                              }

                                              function Maquinas_Read()
                                              {
                                               $idConn = Conectarse();
                                               $sql = " 
                                               SELECT * 
                                               FROM maquinas 
                                               ORDER BY id_portfolio DESC 
                                               ";
                                               $resultado = mysqli_query($idConn, $sql);
                                               while ($row = mysqli_fetch_array($resultado)) {
                                                if ($row['categoria_portfolio'] == 1) {
                                                 $categoria = "Nutrición";
                                                } elseif ($row['categoria_portfolio'] == 2) {
                                                 $categoria = "Conservación de Forrajes";
                                                } elseif ($row['categoria_portfolio'] == 3) {
                                                 $categoria = "Efluentes";
                                                }
                                                if ($row['tipo_portfolio'] == 1) {
                                                 $tipo = "Reconstruidos";
                                                } else {
                                                 $tipo = "Usados";
                                                }
                                                ?>
                                                <tr>
                                                 <td><?php
                                                  echo $row['id_portfolio'];
                                                  ?></td>
                                                  <td style="text-transform:uppercase"><?php
                                                   echo substr(strtoupper($row['nombre_portfolio']), 0, 50);
                                                   ?></td>
                                                   <td style="text-transform:uppercase"><?php
                                                    echo strtoupper($categoria);
                                                    ?></td>
                                                    <td style="text-transform:uppercase"><?php
                                                     echo strtoupper($tipo);
                                                     ?></td>
                                                     <td style="text-align:center">
                                                      <a href="index.php?op=modificarMaquinas&id=<?php
                                                      echo $row['id_portfolio'];
                                                      ?>" data-toggle="tooltip"
                                                      alt="Modificar" title="Modificar"><i class="glyphicon glyphicon-cog"></i></a>
                                                      <a href="index.php?op=verMaquinas&borrar=<?php
                                                      echo $row["cod_portfolio"];
                                                      ?>"
                                                      onClick="return confirm('¿Seguro querés eliminar el producto?')" data-toggle="tooltip" alt="Eliminar"
                                                      title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
                                                     </td>
                                                    </tr>
                                                    <?php
                                                   }
                                                  }

                                                  function Maquinas_Read_Front($categoria, $tipo)
                                                  {
                                                   $idConn = Conectarse();
                                                   $sql = " 
                                                   SELECT * 
                                                   FROM maquinas 
                                                   WHERE categoria_portfolio = '$categoria' AND  tipo_portfolio = '$tipo' 
                                                   ORDER BY id_portfolio DESC 
                                                   ";
                                                   $resultado = mysqli_query($idConn, $sql);
                                                   while ($row = mysqli_fetch_array($resultado)) {
                                                    if ($row['categoria_portfolio'] == 1) {
                                                     $categoria = "Nutrición";
                                                    } elseif ($row['categoria_portfolio'] == 2) {
                                                     $categoria = "Conservación de Forrajes";
                                                    } elseif ($row['categoria_portfolio'] == 3) {
                                                     $categoria = "Efluentes";
                                                    }
                                                    $cod = $row["cod_portfolio"];
                                                    $sql2 = "SELECT * FROM `imagenes_maquinas` WHERE `maquina` = '$cod'";
                                                    $res = mysqli_query($idConn, $sql2);
                                                    $imagen = mysqli_fetch_row($res);
                                                    ?>
                                                    <div class="col-md-4 col-xs-12 col-sm-12 product-box"> <!-- product box start -->
                                                     <a href="reconstruidos.php?id=<?php
                                                     echo $row["id_portfolio"];
                                                     ?>">
                                                     <div class="product-wrap"><img src="<?php
                                                      echo $imagen[1];
                                                      ?>" width="100%"></div>
                                                     </a>
                                                    </div>
                                                    <div class="col-md-8">
                                                     <h2>
                                                      <a href="reconstruidos.php?id=<?php
                                                      echo $row["id_portfolio"];
                                                      ?>"><?php
                                                      echo htmlspecialchars(utf8_encode($row["nombre_portfolio"]));
                                                      ?></a>
                                                     </h2>

                                                     <p>
                                                      <?php
                                                      echo strip_tags(utf8_encode($row["descripcion_portfolio"]), "<br/><b><li><ul><br>");
                                                      ?>
                                                     </p>
                                                     <a href="reconstruidos.php?id=<?php
                                                     echo $row["id_portfolio"];
                                                     ?>" class="btn btn-outline"><i
                                                     class="fa fa-info"></i>VER MÁS</a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <br/>
                                                    <?php
                                                   }
                                                  }

                                                  function Portfolio_Read_Front($tipo, $categoria)
                                                  {
                                                   require_once("paginacion/Zebra_Pagination.php");
                                                   $con = Conectarse_Mysqli();
                                                   if ($categoria == '') {
                                                    $query = "SELECT * FROM  `portfolio` where estado_portfolio = 0   ORDER BY id_portfolio Desc";
                                                    $res = $con->query($query);
                                                    $num_registros = mysqli_num_rows($res);
                                                    $resul_x_pagina = 12;
                                                    $paginacion = new Zebra_Pagination();
                                                    $paginacion->records($num_registros);
                                                    $paginacion->records_per_page($resul_x_pagina);
                                                    $consulta = "SELECT * FROM  `portfolio` where estado_portfolio = 0   ORDER BY  id_portfolio Desc 
                                                    LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
                                                   } else {
                                                    $query = "SELECT * FROM  `portfolio` where categoria_portfolio = '$categoria' and estado_portfolio = 0 and tipo_portfolio = '$tipo'   ORDER BY id_portfolio Desc";
                                                    $res = $con->query($query);
                                                    $num_registros = mysqli_num_rows($res);
                                                    $resul_x_pagina = 12;
                                                    $paginacion = new Zebra_Pagination();
                                                    $paginacion->records($num_registros);
                                                    $paginacion->records_per_page($resul_x_pagina);
                                                    $consulta = "SELECT * FROM  `portfolio` where categoria_portfolio = '$categoria' and estado_portfolio = 0 and tipo_portfolio = '$tipo'   ORDER BY  id_portfolio Desc
                                                    LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
                                                   }
                                                   $result = $con->query($consulta);
                                                   while ($row = mysqli_fetch_array($result)) {
                                                    $car = array(
                                                     " ",
                                                     "?",
                                                     "-",
                                                     "%"
                                                     );
                                                    $cod = trim($row["id_portfolio"]);
                                                    $urlLink = str_replace($car, "+", strtolower(substr(trim($row["nombre_portfolio"]), 0, 120)));
                                                    if (is_file($row["imagen1_portfolio"])) {
                                                     $imagen = BASE_URL . "/" . $row["imagen1_portfolio"];
                                                    } else {
                                                     $imagen = BASE_URL . '/img/producto_sin_imagen.jpg';
                                                    }
                                                    $precio = $row["precio_portfolio"];
                                                    $fecha = explode("-", $row["fecha_portfolio"]);
                                                    $titulo = utf8_encode(trim($row["nombre_portfolio"]));
                                                    $categoria = $row["categoria_portfolio"];
                                                    switch ($categoria) {
                                                     case 1:
                                                     $categoriaFinal = "MEDICAMENTOS";
                                                     break;
                                                     case 2:
                                                     $categoriaFinal = "MONODROGOS";
                                                     break;
                                                     case 3:
                                                     $categoriaFinal = "PROMOCIÓN";
                                                     break;
                                                     case 4:
                                                     $categoriaFinal = "PERFUMERÍA";
                                                     break;
                                                     case 5:
                                                     $categoriaFinal = "ACCESORIOS";
                                                     break;
                                                     default:
                                                     $categoriaFinal = "SIN CATEGORÍA";
                                                     break;
                                                    }
                                                    ?>
                                                    <div class=" col-md-4 col-xs-12 product-box hvr-outline-in">
                                                     <a href="<?php
                                                     echo BASE_URL;
                                                     ?>/producto/<?php
                                                     echo $urlLink;
                                                     ?>_<?php
                                                     echo strtoupper($row["id_portfolio"]);
                                                     ?>">
                                                     <div class="product-wrap"
                                                     style="height:150px;overflow:hidden;background:url('<?php
                                                      echo $imagen;
                                                      ?>') no-repeat center center;background-size:contain"></div>
                                                     </a>

                                                     <h1 class="tituloProducto"><a
                                                      href="<?php
                                                      echo BASE_URL;
                                                      ?>/producto/<?php
                                                      echo $urlLink;
                                                      ?>_<?php
                                                      echo $row["id_portfolio"];
                                                      ?>"
                                                      style="font-size:25px"><?php
                                                      echo($titulo);
                                                      ?></a></h1>
                                                      <span class="precioProducto"><b>Categoría: </b><br/><a
                                                       href='productos.php?buscar=<?php
                                                       echo $categoria;
                                                       ?>'><?php
                                                       echo $categoriaFinal;
                                                       ?></a></span><br/>
                                                       <?php
                                                       if ($tipo != 0) {
                                                        ?>
                                                        <span class="precioProducto"><?php
                                                         echo "<b>Precio: </b>$" . ($precio);
                                                         ?></span>
                                                         <?php
                                                        }
                                                        ?>
                                                        <div class="clearfix"></div>
                                                        <br/>
                                                        <a href="<?php
                                                        echo BASE_URL;
                                                        ?>/producto/<?php
                                                        echo $urlLink;
                                                        ?>_<?php
                                                        echo $row["id_portfolio"];
                                                        ?>"
                                                        class="hvr-shutter-out-vertical btn btn-default"><i class="fa fa-plus"></i> VER MÁS</a>
                                                       </div>
                                                       <?php
                                                      }
                                                      echo '<center class="col-md-12 blog-pagination"><br/> ';
                                                      $paginacion->render();
                                                      echo '<br/><br/></center>';
                                                     }

                                                     function Portfolio_Read_Slide()
                                                     {
                                                      $idConn = Conectarse();
                                                      $sql = " 
                                                      SELECT * 
                                                      FROM portfolio 
                                                      WHERE estado_portfolio = 0   
                                                      ORDER BY RAND() 
                                                      LIMIT 25 
                                                      ";
                                                      $resultado = mysqli_query($idConn, $sql);
                                                      while ($row = mysqli_fetch_array($resultado)) {
                                                       $car = array(
                                                        " ",
                                                        "?",
                                                        "-",
                                                        "%"
                                                        );
                                                       $cod = trim($row["id_portfolio"]);
                                                       $urlLink = str_replace($car, "+", strtolower(substr($row["nombre_portfolio"], 0, 120)));
                                                       if ($row["imagen1_portfolio"] != '') {
                                                        if (is_file($row["imagen1_portfolio"])) {
                                                         $imagen = BASE_URL . "/" . $row["imagen1_portfolio"];
                                                        } else {
                                                         $imagen = 'img/producto_sin_imagen.jpg';
                                                        }
                                                       } else {
                                                        $imagen = 'img/producto_sin_imagen.jpg';
                                                       }
                                                       $precio = $row["precio_portfolio"];
                                                       $titulo = ($row["nombre_portfolio"]);
                                                       $fecha = explode("-", $row["fecha_portfolio"]);
                                                       ?>
                                                       <div class="productosMasVistos">
                                                        <a href="<?php
                                                        echo BASE_URL;
                                                        ?>/producto/<?php
                                                        echo $urlLink;
                                                        ?>_<?php
                                                        echo strtoupper($row["id_portfolio"]);
                                                        ?>">
                                                        <div class="product-wrap"
                                                        style="height:180px;overflow:hidden;background:url('<?php
                                                         echo $imagen;
                                                         ?>') no-repeat center center;background-size:contain"></div>
                                                        </a>

                                                        <h1 class="tituloProducto"><a
                                                         href="<?php
                                                         echo BASE_URL;
                                                         ?>/producto/<?php
                                                         echo $urlLink;
                                                         ?>_<?php
                                                         echo $row["id_portfolio"];
                                                         ?>"><?php
                                                         echo($titulo);
                                                         ?></a>
                                                        </h1>

                                                        <div class="clearfix"></div>
                                                        <br/>
                                                       </div>
                                                       <?php
                                                      }
                                                     }

                                                     function Portfolio_Read_Front_Relacionados($categoria)
                                                     {
                                                      $idConn = Conectarse();
                                                      $sql = " 
                                                      SELECT * 
                                                      FROM portfolio 
                                                      WHERE categoria_portfolio = $categoria 
                                                      ORDER BY RAND() 
                                                      LIMIT 4 
                                                      ";
                                                      $resultado = mysqli_query($idConn, $sql);
                                                      while ($row = mysqli_fetch_array($resultado)) {
                                                       ?>
                                                       <div class="col-md-4 product-box">
                                                        <a href="repuestos.php?id=<?php
                                                        echo $row["id_portfolio"];
                                                        ?>">
                                                        <div class="product-wrap"
                                                        style="background:url(<?php
                                                         echo $row["imagen1_portfolio"];
                                                         ?>)no-repeat center center;background-size:cover;height:160px;width:100%"></div>
                                                        </a>

                                                        <h2>
                                                         <a href="repuestos.php?id=<?php
                                                         echo $row["id_portfolio"];
                                                         ?>"><?php
                                                         echo utf8_encode($row["nombre_portfolio"]);
                                                         ?></a>
                                                        </h2>
                                                        <a href="repuestos.php?id=<?php
                                                        echo $row["id_portfolio"];
                                                        ?>" class="btn btn-outline"><i
                                                        class="fa fa-plus"></i>VER MÁS</a>
                                                       </div>
                                                       <?php
                                                      }
                                                     }

                                                     function Portfolio_Read_Front_Side()
                                                     {
                                                      $idConn = Conectarse();
                                                      $sql = " 
                                                      SELECT * 
                                                      FROM portfolio 
                                                      ORDER BY RAND()";
                                                      $resultado = mysqli_query($idConn, $sql);
                                                      while ($row = mysqli_fetch_array($resultado)) {
                                                       ?>
                                                       <div class="row product-box">
                                                        <div class="col-md-4" style="overflow:hidden;height:60px"><!-- product photo -->
                                                         <div class="product-wrap">
                                                          <img src="<?php
                                                          echo $row["imagen1_portfolio"];
                                                          ?>" width="100%" class="img-responsive"/>
                                                         </div>
                                                        </div>
                                                        <div class="col-md-8"><!-- product info -->
                                                         <h3>
                                                          <a href="repuestos.php?id=<?php
                                                          echo $row["id_portfolio"];
                                                          ?>"><?php
                                                          echo htmlspecialchars($row["nombre_portfolio"]);
                                                          ?></a>
                                                         </h3>
                                                        </div>
                                                       </div>
                                                       <div class="clearfix"></div>
                                                       <?php
                                                      }
                                                     }

                                                     function Portfolio_Read_Front_Busqueda($palabra)
                                                     {
                                                      $idConn = Conectarse();
                                                      $sql = " 
                                                      SELECT * 
                                                      FROM portfolio 
                                                      WHERE categoria_portfolio LIKE '%$palabra%' 
                                                      ORDER BY 'id_portfolio' ASC 
                                                      ";
                                                      $resultado = mysqli_query($idConn, $sql);
                                                      while ($row = mysqli_fetch_array($resultado)) {
                                                       ?>
        <!-- <div class="col-sm-4 col-md-3" >
        <div class="thumbnail" style="height:400px">
         <h3 style="text-transform:uppercase;font-size:16px"><?php
          echo utf8_encode($row["nombre_portfolio"]);
          ?></h3>
          <a href="<?php
          echo BASE_URL;
          ?>/producto/<?php
          echo $urlLink;
          ?>_<?php
          echo $row["id_portfolio"];
          ?>" title="<?php
          echo utf8_encode($row["nombre_portfolio"]);
          ?>" ><div style="background: url(<?php
           echo $row["imagen1_portfolio"];
           ?>) center center;background-size:cover;height:200px;"></div></a>
           <div class="caption">
            <p><a href="<?php
             echo BASE_URL;
             ?>/producto/<?php
             echo $urlLink;
             ?>_<?php
             echo $row["id_portfolio"];
             ?>" title="<?php
             echo utf8_encode($row["nombre_portfolio"]);
             ?>" class="btn btn-primary2" style="background: #E64A50" role="button">Ver más</a><br /><br />
             <a href="#" class="btn btn-default" disabled role="button" style="border:none"><i class="glyphicon glyphicon-chevron-right" style="margin-right:10px"></i><?php
              echo strtoupper($row["categoria_portfolio"]);
              ?></a></p>
             </div>
            </div>
           </div> -->

           <div class="column dt-sc-one-third catelog-menu all-sort non-veg-receipes-sort soups-sort isotope-item"
           style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px);">
           <!--catelog-menu Starts Here-->
           <a href="images/shop-item1.jpg" data-gal="prettyPhoto[gallery]">
            <div class="catelog-thumb">
             <img src="images/shop-item1.jpg" alt="" title="The Buffet Corner">
            </div>
           </a>
           <h5><a href="#">Turkish Cream Delight</a></h5>
           <span class="price">$14.55</span>
          </div>
          <?php
         }
        }

        function Ver_Control($cod)
        {
         $idConn = Conectarse();
         if ($cod != 0) {
          $sql = " 
          SELECT * 
          FROM `interno` 
          WHERE `control` = '$cod' 
          ORDER BY `fecha` DESC 
          ";
         } else {
          $sql = " 
          SELECT * 
          FROM interno 
          ORDER BY fecha DESC 
          ";
         }
         $resultado = mysqli_query($idConn, $sql);
         while ($row = mysqli_fetch_array($resultado)) {
          $f = explode(" ", $row["fecha"]);
          $fecha = explode("-", $f[0]);
          ?>
          <tr>
           <?php
           if ($row["control"] != 0) {
            ?>
            <td><?php
             echo $row["control"];
             ?></td>
             <?php
            } else {
             echo "<td>Sin Orden</td>";
            }
            ?>
            <td><?php
             echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0];
             ?></td>
             <td><?php
              echo $row["cliente"];
              ?></td>
              <td><?php
               echo $row["tiempo"];
               ?></td>
               <td><?php
                echo $row["estado"];
                ?></td>
                <td>
                 <center>
                  <a href="index.php?op=infoControl&id=<?php
                  echo $row["id"];
                  ?>"><img src="img/ver.jpg" width="20"
                  style="margin:2px"></a>
                  <a href="index.php?pag=control&op=e&id=<?php
                  echo $row["id"];
                  ?>"><img src="img/elim.jpg" width="15"
                  style="margin:2px"></a>
                 </center>
                </td>
               </tr>
               <?php
              }
             }

             function Ver_Orden($estado)
             {
              $idConn = Conectarse();
              $sql = " 
              SELECT nombre_usuario,id_orden,cliente_orden,trabajo_orden,area_orden,cod_orden,pedido_orden,estado_usuario,estado_orden 
              FROM orden, empleados 
              WHERE user_orden = id_usuario AND estado_orden = $estado 
              ORDER BY id_orden DESC 
              ";
              $resultado = mysqli_query($idConn, $sql);
              while ($row = mysqli_fetch_array($resultado)) {
               $fecha = explode("-", $row["pedido_orden"]);
               $usuario = explode(" ", $row["nombre_usuario"]);
               ?>
               <tr>
                <td><?php
                 echo strtoupper($row["id_orden"]);
                 ?></td>
                 <td><?php
                  echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0];
                  ?></td>
                  <td><?php
                   echo strtoupper($usuario[0]);
                   ?></td>
                   <td><?php
                    echo strtoupper($row["cliente_orden"]);
                    ?></td>
                    <td><?php
                     echo strtoupper(substr($row["trabajo_orden"], 0, 22));
                     ?>...
                    </td>
                    <td><?php
                     echo strtoupper($row["area_orden"]);
                     ?></td>
                     <td>
                      <center>
                       <a href="index.php?op=agregarControl&id=<?php
                       echo $row["cod_orden"];
                       ?>"><img src="img/add.jpg"
                       width="20"
                       style="margin:2px"></a>
                       <a href="index.php?op=modificarOrden&id=<?php
                       echo $row["cod_orden"];
                       ?>"><img src="img/modif.png"
                       width="20"
                       style="margin:2px"></a>
                       <a href="index.php?op=verControl&id=<?php
                       echo $row["cod_orden"];
                       ?>"><img src="img/repo.jpg"
                       width="20"
                       style="margin:2px"></a>


                       <?php
                       if ($_SESSION["usuario"]["estado_usuario"] != 0) {
                        ?>
                        <a href="index.php?pag=orden&op=e&id=<?php
                        echo $row["id_orden"];
                        ?>"><img src="img/elim.jpg"
                        width="15"
                        style="margin:2px"></a>
                        <a href="index.php?pag=orden&op=infoOrden&id=<?php
                        echo $row["id_orden"];
                        ?>"><img src="img/info.jpg"
                        width="20"
                        style="margin:2px">
                       </a><?php
                      }
                      ?>
                     </center>
                    </td>
                    <td>
                     <center>
                      <?php
                      switch ($row["estado_orden"]) {
                       case 1:
                       ?>
                       <a href="index.php?op=verOrden&es=<?php
                       echo $row["id_orden"];
                       ?>&estado=0"><img
                       src="img/estado2.jpg"></a>
                       <?php
                       break;
                       case 0:
                       ?>
                       <a href="index.php?op=verOrden&es=<?php
                       echo $row["id_orden"];
                       ?>&estado=1"><img
                       src="img/estado.jpg"></a>
                       <?php
                       break;
                       case 2:
                       ?>
                       <a href="index.php?op=verOrden&es=<?php
                       echo $row["id_orden"];
                       ?>&estado=1"><img
                       src="img/estado3.jpg"></a>
                       <?php
                       break;
                      }
                      ?>

                     </center>
                    </td>
                   </tr>
                   <?php
                  }
                 }

                 function Ver_Resumen()
                 {
                  $idConn = Conectarse();
                  $sql = " 
                  SELECT * 
                  FROM  `subcategorias` ,  `categorias` ,  `usuarios` ,  `pedidos` 
                  WHERE  `usuario_pedido` =  `id` 
                  AND  `categoria_pedido` =  `id_categoria` 
                  ";
                  $resultado = mysqli_query($idConn, $sql);
                  while ($row = mysqli_fetch_array($resultado)) {
                   $fecha = explode("-", $row["pedido_orden"]);
                   $usuario = explode(" ", $row["nombre_usuario"]);
                   ?>
                   <tr>
                    <td><?php
                     echo strtoupper($row["id_orden"]);
                     ?></td>
                     <td><?php
                      echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0];
                      ?></td>
                      <td><?php
                       echo strtoupper($usuario[0]);
                       ?></td>
                       <td><?php
                        echo strtoupper($row["cliente_orden"]);
                        ?></td>
                        <td><?php
                         echo strtoupper(substr($row["trabajo_orden"], 0, 22));
                         ?>...
                        </td>
                        <td><?php
                         echo strtoupper($row["area_orden"]);
                         ?></td>
                         <td>
                          <center>
                           <a href="index.php?op=agregarControl&id=<?php
                           echo $row["cod_orden"];
                           ?>"><img src="img/add.jpg"
                           width="20"
                           style="margin:2px"></a>
                           <a href="index.php?op=modificarOrden&id=<?php
                           echo $row["cod_orden"];
                           ?>"><img src="img/modif.png"
                           width="20"
                           style="margin:2px"></a>
                           <a href="index.php?op=verControl&id=<?php
                           echo $row["cod_orden"];
                           ?>"><img src="img/repo.jpg"
                           width="20"
                           style="margin:2px"></a>


                           <?php
                           if ($_SESSION["usuario"]["estado_usuario"] != 0) {
                            ?>
                            <a href="index.php?pag=orden&op=e&id=<?php
                            echo $row["id_orden"];
                            ?>"><img src="img/elim.jpg"
                            width="15"
                            style="margin:2px"></a>
                            <a href="index.php?pag=orden&op=infoOrden&id=<?php
                            echo $row["id_orden"];
                            ?>"><img src="img/info.jpg"
                            width="20"
                            style="margin:2px">
                           </a><?php
                          }
                          ?>
                         </center>
                        </td>
                        <td>
                         <center>
                          <?php
                          switch ($row["estado_orden"]) {
                           case 1:
                           ?>
                           <a href="index.php?op=verOrden&es=<?php
                           echo $row["id_orden"];
                           ?>&estado=0"><img
                           src="img/estado2.jpg"></a>
                           <?php
                           break;
                           case 0:
                           ?>
                           <a href="index.php?op=verOrden&es=<?php
                           echo $row["id_orden"];
                           ?>&estado=1"><img
                           src="img/estado.jpg"></a>
                           <?php
                           break;
                           case 2:
                           ?>
                           <a href="index.php?op=verOrden&es=<?php
                           echo $row["id_orden"];
                           ?>&estado=1"><img
                           src="img/estado3.jpg"></a>
                           <?php
                           break;
                          }
                          ?>

                         </center>
                        </td>
                       </tr>
                       <?php
                      }
                     }

                     function Ver_Orden_RRHH()
                     {
                      $idConn = Conectarse();
                      $sql = " 
                      SELECT nombre_usuario,id_orden,cliente_orden,busqueda_orden,puesto_orden,cod_orden,ingreso_orden,estado_usuario,estado_orden
                      FROM rrhh, empleados 
                      WHERE user_orden = id_usuario 
                      ORDER BY id_orden DESC 
                      ";
                      $resultado = mysqli_query($idConn, $sql);
                      while ($row = mysqli_fetch_array($resultado)) {
                       $fecha = explode("-", $row["ingreso_orden"]);
                       $usuario = explode(" ", $row["nombre_usuario"]);
                       ?>
                       <tr>
                        <td><?php
                         echo strtoupper($row["id_orden"]);
                         ?></td>
                         <td><?php
                          echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0];
                          ?></td>
                          <td><?php
                           echo strtoupper($usuario[0]);
                           ?></td>
                           <td><?php
                            echo strtoupper($row["cliente_orden"]);
                            ?></td>
                            <td><?php
                             echo strtoupper(substr($row["busqueda_orden"], 0, 22));
                             ?>...
                            </td>
                            <td><?php
                             echo strtoupper($row["puesto_orden"]);
                             ?></td>
                             <td>
                              <center>
                               <a href="index.php?op=modificarRRHH&id=<?php
                               echo $row["cod_orden"];
                               ?>"><img src="img/modif.png"
                               width="20"
                               style="margin:2px"></a>
                               <?php
                               if ($_SESSION["usuario"]["estado_usuario"] != 0) {
                                ?>
                                <a href="index.php?pag=orden&op=infoRRHH&id=<?php
                                echo $row["id_orden"];
                                ?>"><img src="img/info.jpg"
                                width="20"
                                style="margin:2px">
                               </a><?php
                              }
                              ?>
                             </center>
                            </td>
                            <td>
                             <center>
                              <?php
                              if ($row["estado_orden"] != 0) {
                               ?>
                               <a href="index.php?op=verRRHH&es=<?php
                               echo $row["id_orden"];
                               ?>&estado=0"><img
                               src="img/estado2.jpg"></a>
                               <?php
                              } else {
                               ?>
                               <a href="index.php?op=verRRHH&es=<?php
                               echo $row["id_orden"];
                               ?>&estado=1"><img
                               src="img/estado.jpg"></a>
                               <?php
                              }
                              ?>
                             </center>
                            </td>
                           </tr>
                           <?php
                          }
                         }

                         function Buscar($palabra)
                         {
                          $sql = "SELECT * FROM notabase WHERE `TituloNotas` LIKE '%$palabra%' ";
                          $link = Conectarse();
                          $result = mysqli_query($link, $sql);
                          while ($row = mysqli_fetch_array($result)) {
                           ?>
                           <div class="span4">
                            <div class="blog-post-overview-2 alt fixed">
                             <div class="blog-post-title">
                              <img src="_layout/images/icons/45x45/white/pen.png" alt="">

                              <h3><a href="nota.php?id=<?php
                               echo $row["IdNotas"];
                               ?>"><?php
                               echo $row["TituloNotas"];
                               ?></a></h3>
                              </div>
                              <!-- .blog-post-title -->

                              <p><?php
                               echo (substr(strip_tags($row["DesarrolloNotas"]), 0, 250)) . "...";
                               ?></p>

                               <img src="<?php
                               echo $row["ImgPortadaNotas"];
                               ?>" alt="">

                               <div class="blog-post-readmore">
                                <a href="nota.php?id=<?php
                                echo $row["IdNotas"];
                                ?>"> <img
                                src="_layout/images/icons/icon-arrow-8.png" alt=""> ver más </a>

                                <div class="arrow"></div>
                               </div>
                               <!-- end .blog-post-readmore -->
                              </div>
                              <!-- blog-post-overview-2 -->
                             </div>
                             <?php
                            }
                           }

                           function Notas_Read_Front()
                           {
                            require_once("paginacion/Zebra_Pagination.php");
                            $con = Conectarse_Mysqli();
                            $query = "SELECT * FROM  `notabase` ORDER BY IdNotas Desc";
                            $res = $con->query($query);
                            $num_registros = mysqli_num_rows($res);
                            $resul_x_pagina = 4;
                            $paginacion = new Zebra_Pagination();
                            $paginacion->records($num_registros);
                            $paginacion->records_per_page($resul_x_pagina);
                            $consulta = "SELECT * FROM  `notabase` ORDER BY IdNotas Desc 
                            LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
                            $result = $con->query($consulta);
                            while ($row = mysqli_fetch_array($result)) {
                             $fecha = explode("-", $row["FechaNotas"]);
                             $cod = $row["CodNotas"];
                             $sqlImagen = "SELECT `ruta` FROM `imagenes` WHERE `codigo` = '$cod'";
                             $idConn = Conectarse();
                             $resultadoImagen = mysqli_query($idConn, $sqlImagen);
                             while ($imagenes = mysqli_fetch_row($resultadoImagen)) {
                              $imagen = BASE_URL . "/" . $imagenes[0];
                             }
                             ?>
                             <div class="col-md-12 blog-post">
                              <div class="blog-thumbnail">
                               <a href="notas.php?id=<?php
                               echo $row["IdNotas"];
                               ?>">
                               <div><img src="<?php
                                echo $imagen;
                                ?>" width="100%"/></div>
                               </a>
                              </div>
                              <h2 class="blog-title">
                               <a href="notas.php?id=<?php
                               echo $row["IdNotas"];
                               ?>">
                               <?php
                               echo utf8_encode($row['TituloNotas']);
                               ?>
                              </a>
                             </h2>

                             <div class="meta">
                              <p><span class="meta-date"><i
                               class="fa fa-calendar"></i> <?php
                               echo $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
                               ?></span>
                               <span class="tags">
                                <i class="fa fa-tags"></i> <?php
                                echo $row["CategoriaNotas"];
                                ?></span></p>
                               </div>
                               <div class="blog-content">
                                <p><?php
                                 echo strip_tags(substr(utf8_encode($row["DesarrolloNotas"]), 0, 300));
                                 ?></p>
                                 <a href="notas.php?id=<?php
                                 echo $row["IdNotas"];
                                 ?>" class="btn btn-default"><i
                                 class="fa fa-caret-right"></i> Ver más</a>
                                </div>
                               </div>
                               <div class="clearfix"></div>
                               <?php
                              }
                              echo "<center><br/><br/>";
                              $paginacion->render();
                              echo "</center><br/><br/>";
                             }

                             function Notas_Read_Front_Clientes()
                             {
                              require_once("paginacion/Zebra_Pagination.php");
                              $con = Conectarse_Mysqli();
                              $query = "SELECT * FROM  `notabase` WHERE `VipNotas` = 1 ORDER BY IdNotas Desc";
                              $res = $con->query($query);
                              $num_registros = mysqli_num_rows($res);
                              $resul_x_pagina = 6;
                              $paginacion = new Zebra_Pagination();
                              $paginacion->records($num_registros);
                              $paginacion->records_per_page($resul_x_pagina);
                              $consulta = "SELECT * FROM  `notabase` WHERE `VipNotas` = 1 ORDER BY IdNotas Desc 
                              LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
                              $result = $con->query($consulta);
                              while ($row = mysqli_fetch_array($result)) {
                               $fecha = explode("-", $row["FechaNotas"]);
                               if ($row['CategoriaNotas'] == 1) {
                                $categoria = "Nutrición";
                                $verMas = "nutricion";
                               } elseif ($row['CategoriaNotas'] == 2) {
                                $categoria = "Conservación de Forrajes";
                                $verMas = "forrajes";
                               } elseif ($row['CategoriaNotas'] == 3) {
                                $categoria = "Efluentes";
                                $verMas = "efluentes";
                               } elseif ($row['CategoriaNotas'] == 4) {
                                $categoria = "Implecor Social";
                                $verMas = "social";
                               }
                               ?>
                               <div class="row">
                                <div class="blog-thumbnail col-md-3">
                                 <a href="notas.php?id=<?php
                                 echo $row["IdNotas"];
                                 ?>"><img src="<?php
                                 echo $row["ImgPortadaNotas"];
                                 ?>"
                                 alt="" width="100%"></a>
                                </div>
                                <div class="col-md-9" style="margin:0;padding:0">
                                 <a href="notas.php?id=<?php
                                 echo $row["IdNotas"];
                                 ?>" style="margin:0;padding:0">
                                 <?php
                                 echo utf8_encode($row['TituloNotas']);
                                 ?>
                                </a>
                               </div>
                               <div class="meta">
                                <p style="font-size:14px"><span
                                 class="meta-date"><?php
                                 echo $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
                                 ?></span>
                                 · <b><?php
                                 echo $categoria;
                                 ?></b></span><br/>
                                 <a href="notas.php?id=<?php
                                 echo $row["IdNotas"];
                                 ?>">Ver más</a>
                                </div>
                               </div>
                               <div class="clearfix"></div>
                               <?php
                              }
                              $paginacion->render();
                             }

                             function Notas_Read_Front_Categoria($categoria)
                             {
                              require_once("paginacion/Zebra_Pagination.php");
                              $con = Conectarse_Mysqli();
                              $query = "SELECT * FROM  `notabase` WHERE `CategoriaNotas` = '$categoria' ORDER BY IdNotas Desc";
                              $res = $con->query($query);
                              $num_registros = mysqli_num_rows($res);
                              $resul_x_pagina = 5;
                              $paginacion = new Zebra_Pagination();
                              $paginacion->records($num_registros);
                              $paginacion->records_per_page($resul_x_pagina);
                              $consulta = "SELECT * FROM  `notabase` WHERE `CategoriaNotas` = '$categoria' ORDER BY IdNotas Desc 
                              LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
                              $result = $con->query($consulta);
                              while ($row = mysqli_fetch_array($result)) {
                               $cod = $row["CodNotas"];
                               $sqlImagen = "SELECT `ruta` FROM `imagenes` WHERE `codigo` = '$cod'";
                               $idConn = Conectarse();
                               $resultadoImagen = mysqli_query($idConn, $sqlImagen);
                               while ($imagenes = mysqli_fetch_row($resultadoImagen)) {
                                $imagen = $imagenes[0];
                               }
                               $fecha = explode("-", $row["FechaNotas"]);
                               ?>
                               <div class="col-md-12 blog-post">
                                <div class="blog-thumbnail">
                                 <a href="notas.php?id=<?php
                                 echo $row["IdNotas"];
                                 ?>"><img src="<?php
                                 echo $imagen;
                                 ?>" alt=""></a>
                                </div>
                                <h2 class="blog-title"><a
                                 href="notas.php?id=<?php
                                 echo $row["IdNotas"];
                                 ?>"><?php
                                 echo utf8_encode($row['TituloNotas']);
                                 ?></a>
                                </h2>

                                <div class="meta">
                                 <p><span class="meta-date"><?php
                                  echo $fecha[2] . "-" . $fecha[1] . "-" . $fecha[0];
                                  ?></span>
                                  <span class="tags">
                                   <a href="<?php
                                   echo $verMas;
                                   ?>.php?op=notas"><?php
                                   echo $categoria;
                                   ?></a></span></p>
                                  </div>
                                  <div class="blog-content">
                                   <p><?php
                                    echo strip_tags(substr($row["DesarrolloNotas"], 0, 500), "<a><span>");
                                    ?></p>
                                    <a href="notas.php?id=<?php
                                    echo $row["IdNotas"];
                                    ?>" class="btn btn-outline">Ver más</a>
                                   </div>
                                  </div>
                                  <?php
                                 }
                                 echo '<div class="col-md-12">';
                                 $paginacion->render();
                                 echo '</div>';
                                 echo '<div class="clearfix"></div><br/>';
                                }

                                function Read_Agenda($letra)
                                {
                                 $Letra = isset($letra) ? $letra : '';
                                 require_once("paginacion/Zebra_Pagination.php");
                                 $con = mysqli_connect("localhost", "root", "", "braver") or die("Error en el server" . mysqli_error($con));
                                 $query = "SELECT * FROM  `agenda` WHERE nombre LIKE '$Letra%' ORDER BY nombre asc";
                                 $res = $con->query($query);
                                 $num_registros = mysqli_num_rows($res);
                                 $resul_x_pagina = 20;
                                 $paginacion = new Zebra_Pagination();
                                 $paginacion->records($num_registros);
                                 $paginacion->records_per_page($resul_x_pagina);
                                 $consulta = "SELECT * FROM  `agenda` WHERE nombre LIKE '$letra%' ORDER BY nombre asc  
                                 LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
                                 $result = $con->query($consulta);
                                 while ($row = mysqli_fetch_array($result)) {
                                  ?>
                                  <tr>
                                   <td><?php
                                    echo $row["nombre"];
                                    ?></td>
                                    <td><?php
                                     echo $row["direccion"];
                                     ?></td>
                                     <td><?php
                                      echo $row["telefono"];
                                      ?></td>
                                     </tr>
                                     <?php
                                    }
                                    ?>
                                   </tbody>
                                  </table>
                                  <div class="clearfix"></div>
                                  <?php
                                  $paginacion->render();
                                 }

                                 function Videos_Read_Front_Categoria($categoria)
                                 {
                                  require_once("paginacion/Zebra_Pagination.php");
                                  $con = Conectarse_Mysqli();
                                  $query = "SELECT * FROM  `videos` WHERE `CategoriaVideos` = '$categoria' ORDER BY IdVideos Desc";
                                  $res = $con->query($query);
                                  $num_registros = mysqli_num_rows($res);
                                  $resul_x_pagina = 5;
                                  $paginacion = new Zebra_Pagination();
                                  $paginacion->records($num_registros);
                                  $paginacion->records_per_page($resul_x_pagina);
                                  $consulta = "SELECT * FROM  `videos` WHERE `CategoriaVideos` = '$categoria' ORDER BY IdVideos Desc 
                                  LIMIT " . (($paginacion->get_page() - 1) * $resul_x_pagina) . ',' . $resul_x_pagina;
                                  $result = $con->query($consulta);
                                  while ($row = mysqli_fetch_array($result)) {
                                   if ($row['CategoriaVideos'] == 1) {
                                    $categoria = "Nutrición";
                                    $verMas = "nutricion";
                                   } elseif ($row['CategoriaVideos'] == 2) {
                                    $categoria = "Conservación de Forrajes";
                                    $verMas = "forrajes";
                                   } elseif ($row['CategoriaVideos'] == 3) {
                                    $categoria = "Efluentes";
                                    $verMas = "efluentes";
                                   }
                                   ?>
                                   <div class="col-md-6 blog-post">
                                    <div class="blog-thumbnail">
                                     <iframe width="100%" height="350px" src="//www.youtube.com/embed/<?php
                                     echo $row["UrlVideos"];
                                     ?>"
                                     frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <h2 class="blog-title"><?php
                                     echo utf8_encode($row['TituloVideos']);
                                     ?></h2>

                                     <div class="meta">
                                      <p><span><i class="fa fa-archive"></i> <?php
                                       echo $categoria;
                                       ?></span></p>
                                      </div>
                                      <div class="blog-content"></div>
                                     </div>
                                     <?php
                                    }
                                    echo '<div class="col-md-12">';
                                    $paginacion->render();
                                    echo '</div>';
                                    echo '<div class="clearfix"></div><br/>';
                                   }

                                   function Notas_Read_Front_Side()
                                   {
                                    $idConn = Conectarse();
                                    $sql = " 
                                    SELECT * 
                                    FROM notabase 
                                    ORDER BY IdNotas DESC 
                                    LIMIT 0,5 
                                    ";
                                    $resultado = mysqli_query($idConn, $sql);
                                    while ($row = mysqli_fetch_array($resultado)) {
                                     $date = $row["FechaNotas"];
                                     $explode = explode("-", $date);
                                     $cod = $row["CodNotas"];
                                     $sqlImagen = "SELECT `ruta` FROM `imagenes` WHERE `codigo` = '$cod'";
                                     $idConn = Conectarse();
                                     $resultadoImagen = mysqli_query($idConn, $sqlImagen);
                                     while ($imagenes = mysqli_fetch_row($resultadoImagen)) {
                                      $imagen = BASE_URL . "/" . $imagenes[0];
                                     }
                                     $fecha = $explode[2] . "-" . $explode[1] . "-" . $explode[0];
                                     ?>
                                     <li class="notasSide row">
                                      <div class="col-md-4" style="overflow:hidden;height:60px"><a
                                       href="notas.php?id=<?php
                                       echo $row["IdNotas"];
                                       ?>"><img src="<?php
                                       echo $imagen;
                                       ?>" width="100%">
                                      </a></div>
                                      <div class="col-md-8"><a href="notas.php?id=<?php
                                       echo $row["IdNotas"];
                                       ?>"
                                       style="text-transform: uppercase "><?php
                                       echo substr(strtoupper(htmlspecialchars($row["TituloNotas"])), 0, 40) . "...";
                                       ?></a><br/>
                                       <span class="meta-date" style="font-size:13px"><i
                                        class="fa fa-calendar"></i> <?php
                                        echo $fecha;
                                        ?></span></div>
                                       </li>
                                       <?php
                                      }
                                     }

                                     function Notas_Read_Front_Index()
                                     {
                                      $idConn = Conectarse();
                                      $sql = " 
                                      SELECT * 
                                      FROM notabase 
                                      ORDER BY IdNotas DESC 
                                      LIMIT 0,6 
                                      ";
                                      $resultado = mysqli_query($idConn, $sql);
                                      while ($row = mysqli_fetch_array($resultado)) {
                                       $cod = $row["CodNotas"];
                                       $sqlImagen = "SELECT `ruta` FROM `imagenes` WHERE `codigo` = '$cod'";
                                       $idConn = Conectarse();
                                       $resultadoImagen = mysqli_query($idConn, $sqlImagen);
                                       while ($imagenes = mysqli_fetch_row($resultadoImagen)) {
                                        $imagen = BASE_URL . "/" . $imagenes[0];
                                       }
                                       ?>
                                       <div class="col-md-4">
                                        <div class="notasMasVistos">
                                         <span style="position:relative">
                                          <a href="notas.php?id=<?php
                                          echo $row["IdNotas"];
                                          ?>">
                                          <div
                                          style="background:url('<?php
                                           echo $imagen;
                                           ?>') no-repeat center center;background-size:100%;height:200px;width:100%"></div>
                                          </a>
                                          <div class="infoIndexNews" style="height:220px;">
                                           <p style="font-size:17px;padding: 10px 10px;text-align:left;margin-top:5px">
                                            <b style="font-size:18px;"><?php
                                             echo $row["TituloNotas"];
                                             ?></b>

                                             <div class="clearfix"></div>
                                             <p style="font-size:13px;"> <?php
                                              echo substr(strip_tags($row["DesarrolloNotas"]), 0, 200);
                                              ?></p>
                                              <a href="notas.php?id=<?php
                                              echo $row["IdNotas"];
                                              ?>" class="btn btn-info fright">ver nota</a></p>
                                             </div>
                                            </span>
                                           </div>
                                          </div>
                                          <?php
                                         }
                                        } 
                                        function Insertar_Categoria($categoria, $trabajo)
                                        {
                                         $idConn = Conectarse();
                                         $sql = "INSERT INTO `categorias`(`nombre_categoria`, `trabajo_categoria`) 
                                         VALUES 
                                         ('$categoria','$trabajo')";
                                         $resultado = mysqli_query($idConn, $sql);
                                         ?>
                                         <script>parent.window.location.reload();</script><?php
                                        }

                                        function Insertar_SubCategoria($categoria, $subcategoria)
                                        {
                                         $idConn = Conectarse();
                                         $sql = "INSERT INTO `subcategorias`(`categorias`, `nombre_subcategorias`) 
                                         VALUES 
                                         ('$categoria','$subcategoria')";
                                         $resultado = mysqli_query($idConn, $sql);
                                        }

                                        function Insertar_Sesion($nombre, $email, $telefono, $fecha)
                                        {
                                         $idConn = Conectarse();
                                         $sql = "INSERT INTO `sesiones` 
                                         (`NombreSesion`, `TelefonoSesion`, `EmailSesion`, `FechaSesion`, `InicioSesion`) 
                                         VALUES ('$nombre','$telefono','$email','$fecha', NOW())";
                                         $resultado = mysqli_query($idConn, $sql);
                                        }

                                        function Insertar_Control($user, $control, $opciones_final)
                                        {
                                         $idConn = Conectarse();
                                         $nombre = $_POST["nombre"];
                                         $cliente = $_POST["cliente"];
                                         $fecha = $_POST["fecha"];
                                         $tiempo = $_POST["tiempo"];
                                         $control = isset($_POST["control"]) ? $_POST["control"] : $control;
                                         $estado = $_POST["estado"];
                                         $opciones = $opciones_final;
                                         $trabajo = $_POST["trabajo"];
                                         $observaciones = $_POST["observaciones"];
                                         $sql = "INSERT INTO `interno` 
                                         (`id`, `nombre`, `cliente`, `opciones`, `trabajo`, `observacion`, `control`, `tiempo`, `estado`, `fecha`, `usuario`) 
                                         VALUES 
                                         (NULL, '$nombre', '$cliente', '$opciones', '$trabajo', '$observaciones', '$control', '$tiempo', '$estado', '$fecha', '$user')";
                                         $resultado = mysqli_query($idConn, $sql);
                                        }

                                        function Insertar_Agencia($nombre, $tel, $direccion, $email, $provincia, $localidad, $destino, $tipo, $cod)
                                        {
                                         $idConn = Conectarse();
                                         $sql = "INSERT INTO `agencias` 
                                         (`nombre_agencia`, `direccion_agencia`, `localidad_agencia`, `provincia_agencia`, `tel_agencia`, `email_agencia`, `logo_agencia`, `tipo_agencia`, `cod_agencia`, `fecha_agencia`)
                                         VALUES 
                                         ('$nombre', '$direccion', '$localidad', '$provincia', '$tel', '$email', '$destino', '$tipo', '$cod', NOW())";
                                         $resultado = mysqli_query($idConn, $sql);
                                        }

                                        function Insertar_Publicidad($url, $img, $provincia, $localidad, $usuario, $tipo, $cod)
                                        {
                                         $idConn = Conectarse();
                                         $sql = "INSERT INTO `publicidad` 
                                         (`url_publicidad`, `img_publicidad`, `provincia_publicidad`, `localidad_publicidad`, `usuario_publicidad`, `tipo_publicidad`, `inicio_publicidad`, `cierre_publicidad`,`cod_publicidad`)
                                         VALUES 
                                         ('$url', '$img', '$provincia','$localidad', '$usuario', '$tipo', NOW(), ADDDATE(NOW(), INTERVAL 31 DAY), '$cod')";
                                         $resultado = mysqli_query($idConn, $sql);
                                        }

                                        function Insertar_Micrositio($cod, $descripcion, $maps, $img1, $img2, $img3, $img4, $img5)
                                        {
                                         $idConn = Conectarse();
                                         $sql = "INSERT INTO `micrositio`(`cod_micrositio`, `descripcion_micrositio`, `maps_micrositio`, `img1_micrositio`, `img2_micrositio`, `img3_micrositio`, `img4_micrositio`, `img5_micrositio`, `fecha_micrositio`)
                                         VALUES 
                                         ('$cod', '$descripcion', '$maps', '$img1', '$img2', '$img3', '$img4', '$img5', NOW())";
                                         $resultado = mysqli_query($idConn, $sql);
                                        }

                                        function Insertar_Usuario($nombre, $email, $postal, $direccion, $localidad, $provincia, $pass)
                                        {
                                         $idConn = Conectarse();
                                         $sql = "INSERT INTO `usuarios` 
                                         (`nombre`, `email`, `pass`, `postal`, `direccion`, `localidad`, `provincia`, `inscripto`) 
                                         VALUES 
                                         ('$nombre','$email','$pass','$postal','$direccion','$localidad','$provincia', NOW())";
                                         $resultado = mysqli_query($idConn, $sql);
                                         Enviar_Usuario($nombre, $email, $pass);
                                         Enviar_Nuevo_Usuario($nombre, $email, $pass);
                                        }

                                        function Insertar_Orden($user, $cod, $texto, $tipo, $tipo2, $img)
                                        {
                                         $idConn = Conectarse();
                                         $sql = "INSERT INTO `pedidos` 
                                         (`cod_pedido`, `categoria_pedido`, `contenido_pedido`,`tipo_pedido`, `img_pedido`, `usuario_pedido`, `fecha_pedidos`) 
                                         VALUES 
                                         ('$cod','$tipo','$texto','$tipo2','$img','$user', NOW())";
                                         $resultado = mysqli_query($idConn, $sql);
                                         header("Location: pedido.php?op=pedido");
                                        }

                                        function Insertar_Orden_RRHH($user, $cod, $publicidad, $examenes)
                                        {
                                         $idConn = Conectarse();
                                         $orden = $cod;
                                         $ingreso = isset($_POST["ingreso"]) ? $_POST["ingreso"] : '';
                                         $facturacion = isset($_POST["facturacion"]) ? $_POST["facturacion"] : '';
                                         $puesto = isset($_POST["puesto"]) ? $_POST["puesto"] : '';
                                         $cliente = isset($_POST["cliente"]) ? $_POST["cliente"] : '';
                                         $contacto = isset($_POST["contacto"]) ? $_POST["contacto"] : '';
                                         $posicion = isset($_POST["posicion"]) ? $_POST["posicion"] : '';
                                         $busqueda = isset($_POST["busqueda"]) ? $_POST["busqueda"] : '';
                                         $observaciones = isset($_POST["observaciones"]) ? $_POST["observaciones"] : '';
                                         $presupuesto = isset($_POST["presupuesto"]) ? $_POST["presupuesto"] : '';
                                         $detallepubli = isset($_POST["detallepubli"]) ? $_POST["detallepubli"] : '';
                                         $gastopubli = isset($_POST["gastopubli"]) ? $_POST["gastopubli"] : '';
                                         $presupuestopubli = isset($_POST["presupuestopubli"]) ? $_POST["presupuestopubli"] : '';
                                         $psicologo = isset($_POST["psicologo"]) ? $_POST["psicologo"] : '';
                                         $psicologoCosto = isset($_POST["psicologocosto"]) ? $_POST["psicologocosto"] : '';
                                         $medico = isset($_POST["medico"]) ? $_POST["medico"] : '';
                                         $medicoCosto = isset($_POST["medicocosto"]) ? $_POST["medicocosto"] : '';
                                         $profesional = isset($_POST["profesional"]) ? $_POST["profesional"] : '';
                                         $profesionalCosto = isset($_POST["profesionalcosto"]) ? $_POST["profesionalcosto"] : '';
                                         $medicos = $profesional . "-" . $medico . "-" . $psicologo;
                                         $sql = " 
                                         INSERT INTO `rrhh` 
                                         (`cod_orden`, `ingreso_orden`, `facturacion_orden`, `cliente_orden`, `contacto_orden`, `posicion_orden`, `puesto_orden`, `busqueda_orden`, `observacion_orden`, `publicidad_orden`, `costopubli_orden`, `detallepubli_orden`, `presupuestopubli_orden`, `examenes_orden`, `drexamenes_orden`, `costo_psico`, `costo_fisico`, `costo_ambiental`, `user_orden`, `final_orden`)
                                         VALUES 
                                         ('$orden', '$ingreso', '$facturacion', '$cliente', '$contacto', '$posicion', '$puesto', '$busqueda', '$observaciones', '$publicidad', '$gastopubli', '$detallepubli', '$presupuestopubli', '$examenes', '$medicos', '$psicologoCosto', '$medicoCosto', '$profesionalCosto', '$user','$presupuesto')";
                                         $resultado = mysqli_query($idConn, $sql);
                                        }

                                        function Insertar_Compra($nombre, $email, $titulo, $texto, $total, $estado)
                                        {
                                         $idConn = Conectarse();
                                         $rand = rand(0, 100000000);
                                         $fecha = date("Y-m-d H:i:s");
                                         $sql = "INSERT INTO `comprasbase` 
                                         (`id`, `nombre`, `email`, `codigo`,`descripcion`, `total`, `fecha`, `estado`) 
                                         VALUES 
                                         ('$rand','$nombre','$email','0','$texto','$total','$fecha','$estado')";
                                         $resultado = mysqli_query($idConn, $sql);
                                         switch ($estado) {
                                          case "0":
                                          @Enviar_Compra($nombre, $email, $titulo . "<br/>" . $texto . "<br/><b>Precio</b>" . $total, "Exitoso");
                                          break;
                                          case "1":
                                          @Enviar_Compra($nombre, $email, $titulo . "<br/>" . $texto . "<br/><b>Precio</b>" . $total, "Pendiente");
                                          break;
                                          case "2":
                                          @Enviar_Compra($nombre, $email, $titulo . "<br/>" . $texto . "<br/><b>Precio</b>" . $total, "Proceso");
                                          break;
                                          case "3":
                                          @Enviar_Compra($nombre, $email, $titulo . "<br/>" . $texto . "<br/><b>Precio</b>" . $total, "Rechazado");
                                          break;
                                          case "4":
                                          @Enviar_Compra($nombre, $email, $titulo . "<br/>" . $texto . "<br/><b>Precio</b>" . $total, "Anulado");
                                          break;
                                         }
                                         session_destroy();
                                        }

                                        function Producto_Create()
                                        {
                                         $idConn = Conectarse();
                                         $Cod = $_POST["cod"];
                                         $Nombre = $_POST["titulo"];
                                         $Slogan = $_POST["slogan"];
                                         $Descripcion = $_POST['descripcion'];
                                         $Precio = $_POST["precio"];
                                         $sql = "INSERT INTO `productobase` 
                                         (`NombreProducto`,`DireccionProducto`, `PrecioProducto`, `DescripcionProducto`, `SubCategoriaProducto`) 
                                         VALUES 
                                         ('$Nombre', '$Slogan', '$Precio', '$Descripcion', '$Cod')";
                                         $resultado = mysqli_query($idConn, $sql);
                                         echo "<script language=Javascript> location.href=\"index.php?pag=productos&op=A\"; </script>";
                                        }

                                        function Promocion_Create()
                                        {
                                         $idConn = Conectarse();
                                         $Nombre = $_POST["titulo"];
                                         $Slogan = $_POST["slogan"];
                                         $Descripcion = $_POST['descripcion'];
                                         $Precio1 = $_POST["precio1"];
                                         $Precio2 = $_POST["precio2"];
                                         $imgInicio1 = "";
                                         $destinoImg1 = "";
                                         $prefijo1 = substr(md5(uniqid(rand())), 0, 6);
                                         $imgInicio1 = $_FILES["img1"]["tmp_name"];
                                         $tucadena1 = $_FILES["img1"]["name"];
                                         $partes1 = explode(".", $tucadena1);
                                         $dominio1 = $partes1[1];
                                         if ($dominio1 != '') {
                                          $destinoImg1 = "../archivos/promociones/" . $prefijo1 . "." . $dominio1;
                                          move_uploaded_file($imgInicio1, $destinoImg1);
                                          chmod($destinoImg1, 0777);
                                         } else {
                                          $destinoImg1 = '';
                                         }
                                         $sql = "INSERT INTO `promocionbase` 
                                         (`titulo`, `subtitulo`, `descripcion`, `precio1`, `precio2`, `imagen`) 
                                         VALUES 
                                         ('$Nombre', '$Slogan', '$Descripcion','$Precio1','$Precio2', '$destinoImg1')";
                                         $resultado = mysqli_query($idConn, $sql);
                                        }

                                        function Promocion_Read()
                                        {
                                         $idConn = Conectarse();
                                         $sql = " 
                                         SELECT * 
                                         FROM `promocionbase` 
                                         ORDER BY  `promocionbase`.`id` desc ";
                                         $result = mysqli_query($idConn, $sql);
                                         while ($resultado = mysqli_fetch_array($result)) {
                                          $imagen = explode("/", $resultado["imagen"]);
                                          ?>
                                          <div style="width:100%;height:250px; overflow:hidden; display: block ">
                                           <div class="four columns picture alpha" style="height: 150px;overflow: hidden">
                                            <a href="<?php
                                            echo $imagen[1] . "/" . $imagen[2] . "/" . $imagen[3];
                                            ?>" data-rel="prettyPhoto"
                                            title=""><span class="magnify"></span>
                                            <img src="<?php
                                            echo $imagen[1] . "/" . $imagen[2] . "/" . $imagen[3];
                                            ?>" alt=""
                                            class="scale-with-grid"></a>
                                            <em></em><!-- end room picture-->
                                           </div>
                                           <div class="seven columns omega">
                                            <h3><?php
                                             echo $resultado["titulo"];
                                             ?> <span> <?php
                                             echo $resultado["subtitulo"];
                                             ?></span></h3>

                                             <p>
                                              <?php
                                              echo $resultado["descripcion"];
                                              ?>
                                             </p>
                                             <h4 style="color:#69B10B;font-weight:bold;float:right ">$<?php
                                              echo $resultado["precio2"];
                                              ?></h4>
                                              <h4 style="float:right "> / </h4>
                                              <h4 style="text-decoration:line-through;color:#FF0000;float:right">
                                               $<?php
                                               echo $resultado["precio1"];
                                               ?></h4>
                                               <br class="clear"/><br class="clear"/><br class="clear"/><br class="clear"/><br class="clear"/><br
                                               class="clear"/><br class="clear"/>
                                              </div>
                                             </div>
                                             <?php
                                            }
                                           }

                                           function Slider_Create()
                                           {
                                            $idConn = Conectarse();
                                            $nombre = $_POST["titulo"];
                                            $descripcion = $_POST["descripcion"];
                                            $imgInicio = "";
                                            $destinoImg = "";
                                            $prefijo = substr(md5(uniqid(rand())), 0, 6);
                                            $imgInicio = $_FILES["img"]["tmp_name"];
                                            $tucadena = $_FILES["img"]["name"];
                                            $partes = explode(".", $tucadena);
                                            $dominio = $partes[1];
                                            $destinoImg = "archivos/slider/" . $prefijo . "." . $dominio;
                                            move_uploaded_file($imgInicio, $destinoImg);
                                            chmod($destinoImg, 0777);
                                            $sql = " 
                                            INSERT INTO `sliderbase` 
                                            (`TituloSlider`, `DescripcionSlider`, `ImgSlider`) 
                                            VALUES 
                                            ('$nombre','$descripcion','$destinoImg') 
                                            ";
                                            $resultado = mysqli_query($idConn, $sql);
                                            echo "<script language=Javascript> location.href=\"index.php?pag=slider&op=A\"; </script>";
                                           }

                                           function Banner_Create()
                                           {
                                            $idConn = Conectarse();
                                            $titulo = $_POST["titulo"];
                                            $link = $_POST["link"];
                                            $size = $_POST["categoria"];
                                            $imgInicio = "";
                                            $destinoImg = "";
                                            $prefijo = substr(md5(uniqid(rand())), 0, 6);
                                            $imgInicio = $_FILES["img"]["tmp_name"];
                                            $tucadena = $_FILES["img"]["name"];
                                            $partes = explode(".", $tucadena);
                                            $dominio = $partes[1];
                                            $destinoImg = "archivos/banner/" . $prefijo . "." . $dominio;
                                            move_uploaded_file($imgInicio, $destinoImg);
                                            chmod($destinoImg, 0777);
                                            $sql = "INSERT INTO `banner_fijo` 
                                            (`TituloBanner`, `LinkBanner`, `RutaBanner`,  `SizeBanner`) 
                                            VALUES 
                                            ('$titulo', '$link', '$destinoImg', '$size')";
                                            $resultado = mysqli_query($idConn, $sql);
                                            echo "<script language=Javascript> location.href=\"index.php?pag=banner&op=A\"; </script>";
                                           }

                                           function Insertar_Reserva($nombre, $email, $descripcion, $categoria)
                                           {
                                            $idConn = Conectarse();
                                            $rand = rand(0, 100000000);
                                            $fecha = date("Y-m-d H:i:s");
                                            $sql = "INSERT INTO `consultasbase`(`id`,`nombre`, `email`, `consulta`, `fecha`, `estado`, `categoria`) 
                                            VALUES ('$rand','$nombre', '$email', '$descripcion', '$fecha', 0, '$categoria')";
                                            $resultado = mysqli_query($idConn, $sql);
                                           }

                                           function TraerConsultas($categoria)
                                           {
                                            $idConn = Conectarse();
                                            $sql = "SELECT * FROM consultasbase WHERE`estado` = 0 AND `categoria` = $categoria ORDER BY fecha DESC";
                                            $resultado = mysqli_query($idConn, $sql);
                                            while ($row = mysqli_fetch_row($resultado)) {
                                             ?>
                                             <tr>
                                              <td><?php
                                               echo strtoupper($row[1]);
                                               ?></td>
                                               <td><?php
                                                echo $row[2];
                                                ?></td>
                                                <td><?php
                                                 echo $row[3];
                                                 ?></td>
                                                 <td><?php
                                                  echo $row[4];
                                                  ?></td>
                                                  <td>
                                                   <div style="width:60px;margin: auto;display:block">
                                                    <?php
                                                    if ($row[6] != 3) {
                                                     ?>
                                                     <a href="mailto:<?php
                                                     echo $row[2];
                                                     ?>?Subject=Respuesta de la consulta realizada"><img
                                                     src="img/iconos/Chat.png" width="20px" style="margin-right:10px;"></a>
                                                     <a href="index.php?pag=consultas&id=<?php
                                                     echo $row[0];
                                                     ?>&op=m"><img
                                                     src="img/iconos/Recycle_Bin_Empty.png" width="20px"></a>
                                                     <?php
                                                    } else {
                                                     ?><a href="mailto:<?php
                                                     echo $row[2];
                                                     ?>?Subject=Respuesta de la consulta realizada">
                                                     <img src="img/iconos/Chat.png" width="20px" style="margin-right:10px;"></a>
                                                     <?php
                                                    }
                                                    ?>
                                                   </div>
                                                  </td>
                                                 </tr>

                                                 <?php
                                                }
                                               }

                                               function TraerPedidos($id)
                                               {
                                                $idConn = Conectarse();
                                                $sql = "SELECT * FROM `pedidos` WHERE `usuario_pedidos` = '$id' ORDER BY id_pedidos DESC";
                                                $resultado = mysqli_query($idConn, $sql);
                                                if (mysql_num_rows($resultado) != 0) {
                                                 while ($row = mysqli_fetch_array($resultado)) {
                                                  $fecha = explode(" ", $row["fecha_pedidos"]);
                                                  $fechaF = explode("-", $fecha[0]);
                                                  ?>
                                                  <div class="panel panel-default">
                                                   <div class="panel-heading" role="tab" id="heading<?php
                                                   echo $row["id_pedido"];
                                                   ?>">
                                                   <h5 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion"
                                                    href="#collapse<?php
                                                    echo $row["id_pedidos"];
                                                    ?>" aria-expanded="true"
                                                    aria-controls="collapse<?php
                                                    echo $row["id_pedidos"];
                                                    ?>">
                                                    <i class="fa fa-angle-right"></i> Cod. Pedido nº: <?php
                                                    echo $row["id_pedidos"];
                                                    ?> - <i
                                                    class="fa fa-calendar"></i> <?php
                                                    echo $fechaF[2] . "-" . $fechaF[1] . "-" . $fechaF[0];
                                                    ?>
                                                    <?php
                                                    $contacto = Contenido_TraerPorId("contacto");
                                                    switch ($row["estado_pedidos"]) {
                                                     case 0:
                                                     echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-warning fRight'>Estado: Pago pendiente</span>";
                                                     $leyenda = "<b>Estaríamos necesitando el pago para poder proseguir con el pedido solicitado.</b><hr/><br/>Comunicate con nosotros<hr/>" . $contacto[1];
                                                     break;
                                                     case 1:
                                                     echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-success fRight'>Estado: Pago exitoso</span>";
                                                     $leyenda = "<b>Excelente el pago fue acreditado, para poder proseguir con el pedido solicitado.</b><hr/><br/>Comunicate con nosotros<hr/>" . $contacto[1];
                                                     break;
                                                     case 2:
                                                     echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-danger fRight'>Estado: Pago erroneo</span>";
                                                     $leyenda = "<b>Tuvimos problemas con el pago para poder proseguir con el pedido solicitado.</b><hr/><br/>Comunicate con nosotros<hr/>" . $contacto[1];
                                                     break;
                                                     case 3:
                                                     echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-info fRight'>Estado: Enviado</span>";
                                                     $leyenda = "<b>Excelente el pago y el envío fueron exitosos.<br/>Muchas gracias por su compra.</b><hr/><br/>Comunicate con nosotros<hr/>" . $contacto[1];
                                                     break;
                                                    }
                                                    ?>

                                                   </a>
                                                  </h5>
                                                 </div>
                                                 <div id="collapse<?php
                                                 echo $row["id_pedidos"];
                                                 ?>" class="panel-collapse collapse " role="tabpanel"
                                                 aria-labelledby="headingOne">
                                                 <div class="panel-body">
                                                  <table class="table table-striped">
                                                   <thead>
                                                    <th>Nombre producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio unidad</th>
                                                    <th>Precio total</th>
                                                   </thead>
                                                   <tbody>
                                                    <?php
                                                    echo $row["productos_pedidos"];
                                                    ?>
                                                   </tbody>
                                                  </table>
                                                  <hr/>
                                                  <?php
                                                  echo $leyenda;
                                                  ?>
                                                 </div>
                                                </div>
                                               </div>
                                               <?php
                                              }
                                             } else {
                                              ?>
                                              <div class="alert alert-danger animated fadeInDown" role="alert">¡No tenés ningún pedido añadido! <a
                                               href="productos.php" class="btn btn-default" style="float:right;position:relative;bottom:7px;">AÑADIR
                                               PRODUCTOS</a></div><?php
                                              }
                                             }

                                             function TraerPedidos_Admin($tipo)
                                             {
                                              $idConn = Conectarse();
                                              if ($tipo == '') {
                                               $sql = "SELECT * FROM `usuarios`, `pedidos` WHERE `usuario_pedidos` = `id` and `estado_pedidos` != 3  ORDER BY id_pedidos DESC";
                                              } else {
                                               $sql = "SELECT * FROM `usuarios`, `pedidos` WHERE `usuario_pedidos` = `id` and `estado_pedidos` = '$tipo' ORDER BY id_pedidos DESC";
                                              }
                                              $resultado = mysqli_query($idConn, $sql);
                                              if (mysql_num_rows($resultado) != 0) {
                                               while ($row = mysqli_fetch_array($resultado)) {
                                                $fecha = explode(" ", $row["fecha_pedidos"]);
                                                $fechaF = explode("-", $fecha[0]);
                                                $usuario = "<h3>Datos del usuario</h3><b>Nombre:</b> " . $row['nombre'] . "<br/> <b>Empresa:</b> " . $row['empresa'] . "<br/> <b>Email:</b> " . $row['email'] . "<br/> <b>Teléfono:</b> " . $row['telefono'] . "<br/> <b>Domicilio:</b> " . $row['direccion'] . "<br/> <b>Localidad:</b> " . $row['localidad'] . "<br/> <b>Provincia:</b> " . $row['provincia'] . "<br/> <b>País:</b> " . $row['pais'] . "<br/> <b>Fecha de inscripción:</b> " . $row['inscripto'] . "<br/>";
                                                ?>
                                                <div class="panel panel-default">
                                                 <div class="panel-heading" role="tab" id="heading<?php
                                                 echo $row["id_pedido"];
                                                 ?>">
                                                 <h5 class="panel-title">
                                                  <a data-toggle="collapse" data-parent="#accordion"
                                                  href="#collapse<?php
                                                  echo $row["id_pedidos"];
                                                  ?>" aria-expanded="true"
                                                  aria-controls="collapse<?php
                                                  echo $row["id_pedidos"];
                                                  ?>">
                                                  <i class="fa fa-angle-right"></i> Cod. Pedido nº: <?php
                                                  echo $row["id_pedidos"];
                                                  ?> - <i
                                                  class="fa fa-calendar"></i> <?php
                                                  echo $fechaF[2] . "-" . $fechaF[1] . "-" . $fechaF[0];
                                                  ?>
                                                  <?php
                                                  switch ($row["estado_pedidos"]) {
                                                   case 0:
                                                   echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-warning fRight'>Estado: Pago pendiente</span>";
                                                   $leyenda = "<b>Estaríamos necesitando el pago para poder proseguir con el pedido solicitado.</b>";
                                                   break;
                                                   case 1:
                                                   echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-success fRight'>Estado: Pago exitoso</span>";
                                                   $leyenda = "<b>Excelente el pago fue acreditado, para poder proseguir con el pedido solicitado.</b>";
                                                   break;
                                                   case 2:
                                                   echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-danger fRight'>Estado: Pago erroneo</span>";
                                                   $leyenda = "<b>Tuvimos problemas con el pago para poder proseguir con el pedido solicitado.</b>";
                                                   break;
                                                   case 3:
                                                   echo "<span  style='padding:4px;font-size:13px;margin-top:-3px' class='btn-info fRight'>Estado: Enviado</span>";
                                                   $leyenda = "<b>Excelente el pago y el envío fueron exitosos.<br/>Muchas gracias por su compra.</b>";
                                                   break;
                                                  }
                                                  ?>

                                                 </a>
                                                </h5>
                                               </div>
                                               <div id="collapse<?php
                                               echo $row["id_pedidos"];
                                               ?>" class="panel-collapse collapse " role="tabpanel"
                                               aria-labelledby="headingOne">
                                               <div class="panel-body">
                                                <table class="table table-striped">
                                                 <thead>
                                                  <th>Nombre producto</th>
                                                  <th>Cantidad</th>
                                                  <th>Precio unidad</th>
                                                  <th>Precio total</th>
                                                 </thead>
                                                 <tbody>
                                                  <?php
                                                  echo $row["productos_pedidos"];
                                                  ?>
                                                 </tbody>
                                                </table>
                                                <hr/>
                                                <div class="col-md-12 col-xs-12">
                                                 <?php
                                                 echo $leyenda;
                                                 ?>
                                                </div>
                                                <div class="col-md-12 col-xs-12">
                                                 <br/>
                                                 <span>Cambiar estado por:</span>

                                                 <div class="clearfix"></div>
                                                 <br/>
                                                 <a href="index.php?op=verPedidos&estado=0&id=<?php
                                                 echo $row["id_pedidos"];
                                                 ?>"
                                                 class=" btnPedidosAdmin <?php
                                                 if ($row["estado_pedidos"] == 0) {
                                                  echo "btnPedidosAdminOk";
                                                 }
                                                 ?> btn btn-warning">Pago pendiente</a>

                                                 <a href="index.php?op=verPedidos&estado=1&id=<?php
                                                 echo $row["id_pedidos"];
                                                 ?>"
                                                 class=" btnPedidosAdmin <?php
                                                 if ($row["estado_pedidos"] == 1) {
                                                  echo "btnPedidosAdminOk";
                                                 }
                                                 ?> btn btn-success">Pago exitoso</a>

                                                 <a href="index.php?op=verPedidos&estado=2&id=<?php
                                                 echo $row["id_pedidos"];
                                                 ?>"
                                                 class=" btnPedidosAdmin <?php
                                                 if ($row["estado_pedidos"] == 2) {
                                                  echo "btnPedidosAdminOk";
                                                 }
                                                 ?> btn btn-danger">Pago erróneo</a>

                                                 <a href="index.php?op=verPedidos&estado=3&id=<?php
                                                 echo $row["id_pedidos"];
                                                 ?>"
                                                 class=" btnPedidosAdmin <?php
                                                 if ($row["estado_pedidos"] == 3) {
                                                  echo "btnPedidosAdminOk";
                                                 }
                                                 ?> btn  btn-info">Pedido enviado</a>

                                                </div>
                                                <div class="clearfix"></div>
                                                <hr/>
                                                <div class="col-md-12 col-xs-12">
                                                 <?php
                                                 echo $usuario;
                                                 ?>
                                                </div>
                                               </div>
                                              </div>
                                             </div>
                                             <?php
                                            }
                                           } else {
                                            ?>
                                            <div class="alert alert-danger animated fadeInDown" role="alert">¡No tenés ningún pedido añadido!</div><?php
                                           }
                                          }

                                          function Banner_A_Create()
                                          {
                                           $idConn = Conectarse();
                                           $nombre = $_POST["link"];
                                           $imgInicio = "";
                                           $destinoImg = "";
                                           $prefijo = substr(md5(uniqid(rand())), 0, 6);
                                           $imgInicio = $_FILES["archivo_subir"]["tmp_name"];
                                           $tucadena = $_FILES["archivo_subir"]["name"];
                                           $partes = explode(".", $tucadena);
                                           $dominio = $partes[1];
                                           $destinoImg = "../bannerF/" . $prefijo . "." . $dominio;
                                           move_uploaded_file($imgInicio, $destinoImg);
                                           $destinoFinal = "bannerF/" . $prefijo . "." . $dominio;
                                           chmod($destinoImg, 0777);
                                           $sql = "INSERT INTO `banner_animado` 
                                           (`LinkBanner`, `RutaBanner`) 
                                           VALUES 
                                           ('$nombre', '$destinoFinal')";
                                           $resultado = mysqli_query($idConn, $sql);
                                          }

                                          function Categoria_Create()
                                          {
                                           $TituloSuplemento = $_POST["titulo"];
                                           $sql = "INSERT INTO `categoriabase` 
                                           (`IdSuplementos`,`TituloSuplementos`) 
                                           VALUES 
                                           (NULL, '$TituloSuplemento')";
                                           $idConn = Conectarse();
                                           $resultado = mysqli_query($idConn, $sql);
                                           echo "<script language=Javascript> location.href=\"index.php?pag=notas&op=A\"; </script>";
                                          }

                                          function CategoriaPro_Create()
                                          {
                                           $nombre = $_POST["titulo"];
                                           $sql = "INSERT INTO `categoriaproducto` 
                                           (`IdCategoriaProducto`,`NombreCategoriaProducto`) 
                                           VALUES 
                                           (NULL, '$nombre')";
                                           $idConn = Conectarse();
                                           $resultado = mysqli_query($idConn, $sql);
                                           echo "<script language=Javascript> location.href=\"index.php?pag=productos&op=A\"; </script>";
                                          }

                                          function Video_Create()
                                          {
                                           $TituloSuplemento = $_POST["titulo"];
                                           $sql = "INSERT INTO `videosbase` VALUES 
                                           (NULL, '$TituloSuplemento')";
                                           $idConn = Conectarse();
                                           $resultado = mysqli_query($idConn, $sql);
                                           echo "<script language=Javascript> location.href=\"index.php?pag=videos&op=A\"; </script>";
                                          }

                                          function Registro_Create()
                                          {
                                           $nombre = $_POST["nombre"];
                                           $email = $_POST["email"];
                                           $pass = $_POST["pass"];
                                           $direccion = $_POST["direccion"];
                                           $provincia = $_POST["provincia"];
                                           $localidad = $_POST["localidad"];
                                           $telefono = $_POST["telefono"];
                                           $sql = "INSERT INTO `registrobase` 
                                           (`NombreRegistro`, `EmailRegistro`,`PasswordRegistro`  , `ProvinciaRegistro`, `LocalidadRegistro`,`DireccionRegistro`,  `TelefonoRegistro`) 
                                           VALUES 
                                           ('$nombre' , '$email' ,'$pass' , '$provincia' , '$localidad' ,'$direccion' ,'$telefono')";
                                           $idConn = Conectarse();
                                           $resultado = mysqli_query($idConn, $sql);
                                           echo "<script language=Javascript> location.href=\"index.php?pag=registros&op=A\"; </script>";
                                          }

                                          function Precio_Create()
                                          {
                                           $titulo = $_POST["titulo"];
                                           $periodo = $_POST["periodo"];
                                           $precio = $_POST["precio"];
                                           $descripcion = $_POST["caracteristicas"];
                                           $sql = "INSERT INTO `preciosbase` 
                                           VALUES 
                                           (NULL,'$titulo' , '$periodo' ,'$descripcion' , '$precio')";
                                           $idConn = Conectarse();
                                           $resultado = mysqli_query($idConn, $sql);
                                           echo "<script language=Javascript> location.href=\"index.php?pag=precios&op=A\"; </script>";
                                          }

                                          function Revisar_Registro($email)
                                          {
                                           $sql = "SELECT  `EmailRegistro` FROM registrobase WHERE  `EmailRegistro` = '$email'";
                                           $link = Conectarse();
                                           $result = mysqli_query($link, $sql);
                                           $data = mysqli_fetch_array($result);
                                           return $data;
                                          }

                                          function Revisar_Compras($email)
                                          {
                                           $sql = "SELECT  * 
                                           FROM `registrobase`, `comprasbase` 
                                           WHERE  `EmailRegistro` = `email` AND `IdRegistro` = $email";
                                           $link = Conectarse();
                                           $result = mysqli_query($link, $sql);
                                           while ($row = mysqli_fetch_array($result)) {
                                            $f = explode(" ", $row["fecha"]);
                                            $fecha = explode("-", $f[0]);
                                            ?>
                                            <tr>
                                             <td><?php
                                              echo strtoupper($row["descripcion"]);
                                              ?></td>
                                              <td>$<?php
                                               echo $row["total"];
                                               ?></td>
                                               <td><?php
                                                echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0] . " " . $f[1];
                                                ?></td>
                                                <td>
                                                 <?php
                                                 switch ($row['estado']) {
                                                  case "0":
                                                  echo "Exitoso";
                                                  break;
                                                  case "1":
                                                  echo "Pendiente";
                                                  break;
                                                  case "2":
                                                  echo "Proceso";
                                                  break;
                                                  case "3":
                                                  echo "Rechazado";
                                                  break;
                                                  case "4":
                                                  echo "Anulado";
                                                  break;
                                                 }
                                                 ?>
                                                </td>
                                               </tr>

                                               <?php
                                              }
                                             }

                                             function Registro_Create_Front()
                                             {
                                              $nombre = $_POST["nombre"];
                                              $email = $_POST["email"];
                                              $pass = $_POST["pass"];
                                              $direccion = $_POST["direccion"];
                                              $provincia = $_POST["provincia"];
                                              $localidad = $_POST["localidad"];
                                              $telefono = $_POST["telefono"];
                                              $sql = "INSERT INTO `registrobase` 
                                              (`NombreRegistro`, `UsuarioRegistro`, `EmailRegistro`,`PasswordRegistro`  , `ProvinciaRegistro`, `LocalidadRegistro`,`DireccionRegistro`,  `TelefonoRegistro`) 
                                              VALUES 
                                              ('$nombre' , '$email' , '$email' ,'$pass' , '$provincia' , '$localidad' ,'$direccion' ,'$telefono')";
                                              $idConn = Conectarse();
                                              $resultado = mysqli_query($idConn, $sql);
                                             }

                                             function Suscripto_Create()
                                             {
                                              if (isset($_POST['Enviar'])) {
                                               $fecha = date("j, n, Y");
                                               $email = $_POST['suscripto'];
                                               if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                $idConn = Conectarse();
                                                $sql = "INSERT INTO `suscriptobase`(`EmailSuscriptos`, `FechaSuscriptos`)VALUES ('$email', '$fecha')";
                                                $resultado = mysqli_query($idConn, $sql);
                                                unset($email);
                                               }
                                              }
                                             }

                                             if ($pagina == "notas" && $op == "e") {
                                              $idCategoria = $_GET["id"];
                                              $Base = "notabase";
                                              $Tabla = "IdNotas";
                                              Categoria_Eliminar($idCategoria, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "videos" && $op == "e") {
                                              $idNota = $_GET["id"];
                                              $Base = "videosbase";
                                              $Tabla = "IdVideo";
                                              Categoria_Eliminar($idNota, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "banner" && $op == "e") {
                                              $idSuscrpito = $_GET["id"];
                                              $Base = "banner_fijo";
                                              $Tabla = "IdBanner";
                                              Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "slider" && $op == "e") {
                                              $idSuscrpito = $_GET["id"];
                                              $Base = "sliderbase";
                                              $Tabla = "IdSlider";
                                              Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "registros" && $op == "e") {
                                              $idSuscrpito = $_GET["id"];
                                              $Base = "registrobase";
                                              $Tabla = "IdRegistro";
                                              Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "productos" && $op == "e") {
                                              $idSuscrpito = $_GET["id"];
                                              $Base = "productobase";
                                              $Tabla = "IdProducto";
                                              Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "promociones" && $op == "e") {
                                              $idSuscrpito = $_GET["id"];
                                              $Base = "promocionbase";
                                              $Tabla = "id";
                                              Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "home" && $op == "e") {
                                              $idSuscrpito = $_GET["id"];
                                              $Base = "consultasbase";
                                              $Tabla = "id";
                                              Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "compra" && $op == "e") {
                                              $idSuscrpito = $_GET["id"];
                                              $Base = "comprasbase";
                                              $Tabla = "id";
                                              Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "precios" && $op == "e") {
                                              $idSuscrpito = $_GET["id"];
                                              $Base = "preciosbase";
                                              $Tabla = "id";
                                              Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "control" && $op == "e") {
                                              $idSuscrpito = $_GET["id"];
                                              $Base = "interno";
                                              $Tabla = "id";
                                              Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "orden" && $op == "e") {
                                              $idSuscrpito = $_GET["id"];
                                              $Base = "orden";
                                              $Tabla = "id_orden";
                                              Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
                                             } elseif ($pagina == "portfolio" && $op == "e") {
                                              $idSuscrpito = $_GET["id"];
                                              $Base = "portfolio";
                                              $Tabla = "IdPortfolio";
                                              Categoria_Eliminar($idSuscrpito, $Base, $Tabla, $pagina);
                                             }
                                             function Categoria_Eliminar($id, $base, $tabla, $pagina)
                                             {
                                              $sql = "DELETE FROM $base WHERE $tabla = $id";
                                              $link = Conectarse();
                                              $r = mysqli_query($link, $sql);
                                              return $r;
                                              echo "<script language=Javascript> location.href=\"index.php?pag=$pagina&op=A\"; </script>";
                                             }

                                             function Categoria_Read_Solo($id)
                                             {
                                              $idConn = Conectarse();
                                              $sql = "SELECT * FROM categoriabase WHERE IdSuplementos = $id";
                                              $resultado = mysqli_query($idConn, $sql);
                                              return $resultado;
                                              $row = mysqli_fetch_row($resultado);
                                             }

                                             function Categoria_Read_Comercios()
                                             {
                                              $sql = "SELECT categoria 
                                              FROM agencias 
                                              GROUP BY categoria";
                                              $link = Conectarse();
                                              $result = mysqli_query($link, $sql);
                                              echo "<option selected disabled>Seleccionar Rubro</option>";
                                              while ($data = mysqli_fetch_array($result)) {
                                               echo "<option value='" . $data["categoria"] . "'>" . $data["categoria"] . "</option>";
                                              }
                                             }

                                             function Slider_TraerPorId($id)
                                             {
                                              $sql = "SELECT * 
                                              FROM sliderbase 
                                              WHERE IdSlider = $id";
                                              $link = Conectarse();
                                              $result = mysqli_query($link, $sql);
                                              $data = mysqli_fetch_array($result);
                                              return $data;
                                             }

                                             function Promociones_TraerPorId($id)
                                             {
                                              $idConn = Conectarse();
                                              $sql = " 
                                              SELECT * 
                                              FROM promociones 
                                              WHERE IdPromociones = $id 
                                              ";
                                              $resultado = mysqli_query($idConn, $sql);
                                              $data = mysqli_fetch_array($resultado);
                                              return $data;
                                             }

                                             function Notificaciones_TraerPorId($id)
                                             {
                                              $idConn = Conectarse();
                                              $sql = " 
                                              SELECT * 
                                              FROM notificaciones 
                                              WHERE usuario_notificaciones = '$id'";
                                              $resultado = mysqli_query($idConn, $sql);
                                              $data = mysqli_fetch_array($resultado);
                                              return $data;
                                             }

                                             function Familia_TraerPorId($cod)
                                             {
                                              $idConn = Conectarse();
                                              $sql = " 
                                              SELECT * 
                                              FROM familia 
                                              WHERE `cod_familia` = '$cod'";
                                              $resultado = mysqli_query($idConn, $sql);
                                              while ($data = mysqli_fetch_array($resultado)) {
                                               echo "<tr>";
                                               echo "<td style='text-transform:uppercase !important;'>" . $data["nombre_familia"] . "</td>";
                                               echo "<td style='text-transform:uppercase !important;'>" . date("d/m/Y", strtotime($data["nacimiento_familia"])) . "</td>";
                                               echo "<td style='text-transform:uppercase !important;'>" . $data["tipo_familia"] . "</td>";
                                               echo "<td style='text-transform:uppercase !important;'>" . $data["ocupacion_familia"] . "</td>";
                                               ?>
                                               <td class='text-center'>
                                                <a href='modificar?op=familiar&borrar=<?php
                                                echo $data["id_familia"];
                                                ?>'
                                                data-toggle='tooltip' data-placement='top' title='Eliminar'
                                                onclick="return confirm('¿Seguro querés eliminar al integrante?')">
                                                <i class='icon icon_close_alt'></i>
                                               </a>
                                              </td>
                                              <?php
                                              echo "</tr>";
                                             }
                                            }

                                            function Familia_TraerPorId_Revision($cod)
                                            {
                                             $idConn = Conectarse();
                                             $sql = " 
                                             SELECT * 
                                             FROM familia 
                                             WHERE `cod_familia` = '$cod'";
                                             $resultado = mysqli_query($idConn, $sql);
                                             while ($data = mysqli_fetch_array($resultado)) {
                                              echo "<tr>";
                                              echo "<td style='text-transform:uppercase !important;'>" . $data["nombre_familia"] . "</td>";
                                              echo "<td style='text-transform:uppercase !important;'>" . date("d/m/Y", strtotime($data["nacimiento_familia"])) . "</td>";
                                              echo "<td style='text-transform:uppercase !important;'>" . $data["tipo_familia"] . "</td>";
                                              echo "<td style='text-transform:uppercase !important;'>" . $data["dni_familia"] . "</td>";
                                              echo "<td style='text-transform:uppercase !important;'>" . $data["ocupacion_familia"] . "</td>";
                                              echo "</tr>";
                                             }
                                            }

                                            function FamiliaNotificaciones_TraerPorId($cod)
                                            {
                                             $idConn = Conectarse();
                                             $sql = " 
                                             SELECT * 
                                             FROM familia 
                                             WHERE `cod_familia` = '$cod'";
                                             $resultado = mysqli_query($idConn, $sql);
                                             while ($data = mysqli_fetch_array($resultado)) {
                                              $nombre = isset($data["nombre_familia"]) ? $data["nombre_familia"] : '';
                                              $usuario = isset($data["id_familia"]) ? $data["id_familia"] : '';
                                              $familia = isset($data["cod_familia"]) ? $data["cod_familia"] : '';
                                              $noti = Notificaciones_TraerPorId($usuario);
                                              $celular = isset($noti["celular_notificaciones"]) ? $noti["celular_notificaciones"] : '';
                                              $email = isset($noti["email_notificaciones"]) ? $noti["email_notificaciones"] : '';
                                              ?>
                                              <form method="post">
                                               <input type='hidden' value='<?php
                                               echo $usuario;
                                               ?>' name="usuario"/>
                                               <input type='hidden' value='<?php
                                               echo $familia;
                                               ?>' name="familia"/>
                                               <tr>
                                                <td style='text-transform:uppercase !important;'>
                                                 <?php
                                                 echo $nombre;
                                                 ?>
                                                </td>
                                                <td>
                                                 <input type='text' value='<?php
                                                 echo $celular;
                                                 ?>' class="validadorNumero form-control"
                                                 name="celular"/>
                                                </td>
                                                <td>
                                                 <input type='text' value='<?php
                                                 echo $email;
                                                 ?>' class="form-control" name="email"/>
                                                </td>
                                                <td>
                                                 <?php
                                                 if ($noti["id_notificaciones"] != '') {
                                                  ?>
                                                  <input type='hidden' value='<?php
                                                  echo $noti["id_notificaciones"];
                                                  ?>' name="id"/>
                                                  <input type="submit" name="actualizar"
                                                  style="width:100% !important;min-width:200px !important;padding:6px;margin-top:5px"
                                                  class="btn btn-block btn-xs btn-primary" value="Actualizar Notificación"/>
                                                  <?php
                                                 } else {
                                                  ?>
                                                  <input type="submit" name="insertar"
                                                  style="width:100% !important;min-width:200px !important;padding:6px;margin-top:5px"
                                                  class="btn btn-block btn-xs btn-primary" value="Sumar Notificación"/>
                                                  <?php
                                                 }
                                                 ?>
                                                </td>
                                               </tr>
                                              </form>
                                              <?php
                                             }
                                            }

                                            function Familia_Contar($cod)
                                            {
                                             $idConn = Conectarse();
                                             $sql = " 
                                             SELECT COUNT(*) 
                                             FROM familia 
                                             WHERE `cod_familia` = '$cod' 
                                             GROUP BY `cod_familia` 
                                             ";
                                             $resultado = mysqli_query($idConn, $sql);
                                             $data = mysqli_fetch_array($resultado);
                                             return $data;
                                            }

                                            function Traer_Subcategorias($id)
                                            {
                                             $sql = "SELECT * 
                                             FROM subcategorias 
                                             WHERE categorias = $id";
                                             $link = Conectarse();
                                             $result = mysqli_query($link, $sql);
                                             while ($data = mysqli_fetch_array($result)) {
                                              echo "<span style='margin-right:10px;'>" . strtoupper($data["nombre_subcategorias"]) . " <a href='index.php?op=subCategoria&borrar=" . $data['id_subcategorias'] . "'><img src='img/borrar2.png' width='12'></a></span> ";
                                             }
                                            }

                                            function Traer_Promociones_Logo($categoria)
                                            {
                                             if ($categoria == '') {
                                              $sql = "SELECT * FROM agencias";
                                             } else {
                                              $sql = "SELECT * FROM agencias WHERE categoria LIKE '%" . $categoria . "%'";
                                              echo "<div class='btn btn-primary btn-filled btn-block'>Buscando en <b>" . strtoupper($categoria) . "</b></div>";
                                              echo "<div class='clearfix'></div><br/>";
                                             }
                                             $link = Conectarse();
                                             $result = mysqli_query($link, $sql);
                                             while ($data = mysqli_fetch_array($result)) {
                                              $domicilio = trim($data["domicilio"]);
                                              $telefono = trim($data["telefono"]);
                                              ?>
                                              <div class="col-md-3 boxPromos">
                                               <?php
                                               if ($data["voucher"] == 1) {
                                                if (@$_SESSION["empleados"]["id"] != '') {
                                                 ?>
                                                 <div style="position:absolute;top:0;left:0;background:url('img/voucher.png') no-repeat left top / contain;width:130px;height:130px"></div>
                                                 <?php
                                                } else {
                                                 ?>
                                                 <div style="position:absolute;top:0;left:0;background:url('img/voucher.png') no-repeat left top / contain;width:130px;height:130px"></div>
                                                 <?php
                                                }
                                               }
                                               ?>
                                               <a href="<?php
                                               echo BASE_URL;
                                               ?>/comercio.php?id=<?php
                                               echo $data["id"];
                                               ?>">
                                               <div style="height:120px;background:url('<?php
                                                echo $data["logo"];
                                                ?>') no-repeat center center/contain;margin-bottom:30px;padding:10px"></div>
                                               </a>
                                               <div class="clearfix"></div>
                                               <h5><?php
                                                echo htmlspecialchars($data["agencia"]);
                                                ?></h5>
                                                <hr/>
                                                <p style='text-transform:uppercase !important'><b>Rubro: </b> <?php
                                                 echo ucfirst($data["categoria"]);
                                                 ?></p>
                                                 <hr/>
                                                 <p style='text-transform:uppercase !important'>
                                                  <?php
                                                  echo "<b>Beneficio</b><br/>" . strip_tags(substr($data["descripcion"], 0, 160));
                                                  ?> ...
                                                  (<a style="color:#198BB3;text-transform:lowercase !important" href="<?php
                                                   echo BASE_URL;
                                                   ?>/comercio.php?id=<?php
                                                   echo $data["id"];
                                                   ?>">ver más</a>)
                                                  </p>
                                                  <hr/>
                                                  <a class="btn btn-primary btn-sm " href="<?php
                                                  echo BASE_URL;
                                                  ?>/comercio.php?id=<?php
                                                  echo $data["id"];
                                                  ?>">más información</a>
                                                  <?php
                                                  if ($data["voucher"] == 1) {
                                                   if (@$_SESSION["empleados"]["id"] != '') {
                                                    ?>
                                                    <a href="<?php
                                                    echo BASE_URL;
                                                    ?>/voucher.php?nombre=<?php
                                                    echo $data["id"];
                                                    ?>" target="_blank" style="margin-top:10px" class="btn btn-primary btn-sm ">descargar voucher</a>
                                                    <?php
                                                   }
                                                  }
                                                  ?>
                                                 </div>
                                                 <?php
                                                }
                                               }

                                               function Traer_Promociones_Logo_Slide($categoria)
                                               {
                                                if ($categoria == '') {
                                                 $sql = "SELECT * FROM agencias ORDER BY RAND()";
                                                } else {
                                                 $sql = "SELECT * FROM agencias WHERE categoria LIKE '%" . $categoria . "%' ORDER BY RAND()";
                                                 echo "<div class='btn btn-primary btn-filled btn-block'>Buscando en <b>" . strtoupper($categoria) . "</b></div>";
                                                 echo "<div class='clearfix'></div>";
                                                }
                                                $link = Conectarse();
                                                $result = mysqli_query($link, $sql);
                                                while ($data = mysqli_fetch_array($result)) {
                                                 $domicilio = trim($data["domicilio"]);
                                                 $telefono = trim($data["telefono"]);
                                                 ?>
                                                 <center>
                                                  <div
                                                  style="height:120px;background:url('<?php
                                                   echo $data["logo"];
                                                   ?>') no-repeat center center/contain;margin-bottom:30px;padding:10px"></div>
                                                   <div class="clearfix"></div>
                                                   <h3><?php
                                                    echo htmlspecialchars($data["agencia"]);
                                                    ?></h3>
                                                    <hr/>
                                                    <p>
                                                     <b>Rubro: </b> <?php
                                                     echo ucfirst($data["categoria"]);
                                                     ?><br/>
                                                     <br/>
                                                     <a href="<?php
                                                     echo BASE_URL;
                                                     ?>/comercio.php?id=<?php
                                                     echo $data["id"];
                                                     ?>"
                                                     class="btn btn-primary btn-sm ">más información</a>
                                                    </p>
                                                   </center>
                                                   <?php
                                                  }
                                                 }

                                                 function TraerDatos_DB($db)
                                                 {
                                                  $sql = "SELECT COUNT(*) FROM $db";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Usuario_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM usuarios 
                                                  WHERE id = '$id'";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Cursos_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM cursos 
                                                  WHERE IdCursos = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Agencias_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM agencias WHERE id = '$id'";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Publicidad_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM publicidad 
                                                  WHERE id_publicidad = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Micrositio_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM agencias, micrositio 
                                                  WHERE cod_agencia = cod_micrositio  AND cod_micrositio = '$id' ";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function TraerServer($id)
                                                 {
                                                  $sql = "SELECT * FROM server 
                                                  WHERE id = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Precios_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM preciosbase 
                                                  WHERE id = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Categoria_Read_Empresas()
                                                 {
                                                  $idConn = Conectarse();
                                                  $sql = "SELECT * FROM `agencias` GROUP BY `categoria` ";
                                                  $resultado = mysqli_query($idConn, $sql);
                                                  while ($row = mysqli_fetch_array($resultado)) {
                                                   ?>
                                                   <option value="<?php
                                                   echo $row["categoria"];
                                                   ?>"><?php
                                                   echo $row["categoria"];
                                                   ?></option>
                                                   <?php
                                                  }
                                                 }

                                                 function porcentaje($cantidad, $porciento, $decimales)
                                                 {
                                                  return number_format($cantidad * $porciento / 100, $decimales, '.', '');
                                                 }

                                                 function TraerCodigo($id)
                                                 {
                                                  $sql = "SELECT * FROM productobase 
                                                  WHERE SubCategoriaProducto = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Promocion_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM promocionbase 
                                                  WHERE promocionbase.id = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Registro_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM usuarios 
                                                  WHERE id = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Categoria_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM categoriabase 
                                                  WHERE IdSuplementos = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Banner_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM banner_fijo, bannersize 
                                                  WHERE IdSizeBanner = SizeBanner && IdBanner = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Banner_A_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM banner_animado 
                                                  WHERE IdBanner = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Nota_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM notabase 
                                                  WHERE  IdNotas = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Portfolio_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM portfolio 
                                                  WHERE  id_portfolio = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Clientes_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM clientes 
                                                  WHERE  id_clientes = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Imagenes_Reconstruidos_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT ruta   FROM `imagenes_maquinas` 
                                                  WHERE  `maquina` = '$id'";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  while ($data = mysqli_fetch_array($result)) {
                                                   @$imagenes .= $data[0] . "-";
                                                  };
                                                  return $imagenes;
                                                 }

                                                 function Imagenes_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT ruta   FROM `imagenes` 
                                                  WHERE  `codigo` = '$id'";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  while ($data = mysqli_fetch_array($result)) {
                                                   @$imagenes .= $data[0] . "-";
                                                  };
                                                  return $imagenes;
                                                 }

                                                 function Reconstruidos_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM maquinas 
                                                  WHERE  id_portfolio = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Nota_TraerPorId_Front($id)
                                                 {
                                                  $sql = "SELECT * FROM notabase 
                                                  WHERE IdNotas = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Producto_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM productobase 
                                                  WHERE IdProducto = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Control_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM interno 
                                                  WHERE id = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Orden_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM orden 
                                                  WHERE cod_orden = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function RRHH_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM rrhh 
                                                  WHERE cod_orden = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Orden_TraerPorId_Info($id)
                                                 {
                                                  $sql = "SELECT * FROM orden, `interno` 
                                                  WHERE `cod_orden` = `control` AND `id_orden` = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Orden_TraerPorId_Info2($id)
                                                 {
                                                  $sql = "SELECT * FROM orden 
                                                  WHERE `id_orden` = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function RRHH_TraerPorId_Info($id)
                                                 {
                                                  $sql = "SELECT * FROM rrhh 
                                                  WHERE `id_orden` = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Suma_Tiempo_Orden($id)
                                                 {
                                                  $sql = "SELECT SUM(tiempo) FROM orden, interno 
                                                  WHERE cod_orden = control AND id_orden = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Video_TraerPorId($id)
                                                 {
                                                  $sql = "SELECT * FROM videos 
                                                  WHERE  IdVideos = $id";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Suplemendo_Modificar($arrData)
                                                 {
                                                  $sql = "UPDATE categoriabase 
                                                  SET 
                                                  TituloSuplementos='$arrData[TituloSuplementos]' 
                                                  , FechaSuplementos='$arrData[FechaSuplementos]' 
                                                  , AutorSuplemento = '$arrData[AutorSuplemento]' 
                                                  , DescripcionSuplemento='$arrData[DescripcionSuplemento]' 
                                                  WHERE IdSuplementos=$arrData[IdSuplementos]";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                 }

                                                 function ModificarServer($server)
                                                 {
                                                  $sql = "UPDATE server 
                                                  SET 
                                                  server='$server' 
                                                  WHERE id=1";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                 }

                                                 function Actualizar_Stock($id, $stock)
                                                 {
                                                  $sql = "UPDATE productobase 
                                                  SET 
                                                  FiltroProducto='$stock' 
                                                  WHERE IdProducto= '$id'";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                  echo "<script language=Javascript> location.href=\"index.php?pag=productos&op=A\"; </script>";
                                                 }

                                                 function Sumar_Micrositio($id)
                                                 {
                                                  $sql = "UPDATE micrositio 
                                                  SET 
                                                  visitas_micrositio = visitas_micrositio+1 
                                                  WHERE cod_micrositio = '$id'";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                 }

                                                 function Sumar_Visitas($pag)
                                                 {
                                                  $link = Conectarse();
                                                  $ip = getenv('REMOTE_ADDR');
                                                  $consulta = "select * from  `visitas` where `ip_visita`='$ip' AND `pag_visita` = $pag AND fecha_visita = NOW()";
                                                  $resultado = mysqli_query($link, $consulta);
                                                  $fila = mysqli_fetch_array($resultado);
                                                  if ($fila == "") {
                                                   $consulta2 = "INSERT INTO `visitas`(`fecha_visita`, `pag_visita`, `ip_visita`) VALUES (NOW(), '$pag', '$ip')";
                                                   $resultado2 = mysqli_query($link, $consulta2);
                                                  }
                                                 }

                                                 function Actualizar_Estado($id, $estado)
                                                 {
                                                  $sql = "UPDATE cursos 
                                                  SET DestacarCurso = '$estado' 
                                                  WHERE IdCursos = '$id'";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                 }

                                                 function Actualizar_Estado_Publi($id, $estado)
                                                 {
                                                  $sql = "UPDATE publicidad 
                                                  SET estado_publicidad = '$estado' 
                                                  WHERE cod_publicidad = '$id'";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                 }

                                                 function Actualizar_Tipo($id, $estado)
                                                 {
                                                  $sql = "UPDATE agencias 
                                                  SET tipo_agencia = '$estado' 
                                                  WHERE cod_agencia = '$id'";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                 }

                                                 function Actualizar_Estado_RRHH($id, $estado)
                                                 {
                                                  $sql = "UPDATE rrhh 
                                                  SET 
                                                  estado_orden = '$estado' 
                                                  WHERE id_orden = '$id'";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                  header("Location: index.php?op=verRRHH");
                                                 }

                                                 function Pasar_Vistos($id, $categoria)
                                                 {
                                                  $sql = "UPDATE consultasbase 
                                                  SET 
                                                  categoria = '$categoria' 
                                                  WHERE id= '$id'";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                  header("Refresh: 2; URL='index.php?pag=consultas'");
                                                 }

                                                 function Restar_Stock($id, $stock)
                                                 {
                                                  $sql = "UPDATE productobase 
                                                  SET 
                                                  FiltroProducto='$stock' 
                                                  WHERE IdProducto= '$id'";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                 }

                                                 function Slider_Modificar($arrData)
                                                 {
                                                  $sql = "UPDATE sliderbase 
                                                  SET 
                                                  TituloSlider='$arrData[TituloSlider]' 
                                                  , DescripcionSlider='$arrData[DescripcionSlider]' 
                                                  , ImgSlider='$arrData[ImgSlider]' 
                                                  WHERE IdSlider=$arrData[IdSlider]";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                 }

                                                 function Banner_Modificar($arrData)
                                                 {
                                                  $sql = "UPDATE banner_fijo 
                                                  SET 
                                                  LinkBanner='$arrData[LinkBanner]' 
                                                  , RutaBanner='$arrData[RutaBanner]' 
                                                  WHERE IdBanner=$arrData[IdBanner]";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                  echo "<script language=Javascript> location.href=\"index2.php?pagina=bannerTodos\"; </script>";
                                                 }

                                                 function Banner_Modificar_A($arrData)
                                                 {
                                                  $sql = "UPDATE banner_animado 
                                                  SET 
                                                  LinkBanner='$arrData[LinkBanner]' 
                                                  , RutaBanner='$arrData[RutaBanner]' 
                                                  WHERE IdBanner=$arrData[IdBanner]";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                  echo "<script language=Javascript> location.href=\"index2.php?pagina=animadoTodos\"; </script>";
                                                 }

                                                 function Nota_Modificar($arrData)
                                                 {
                                                  $sql = "UPDATE notabase 
                                                  SET 
                                                  TituloNotas='$arrData[TituloNotas]' 
                                                  , CitasNotas='$arrData[CitasNotas]' 
                                                  , FechaNotas='$arrData[FechaNotas]' 
                                                  , IdSumplemento='' 
                                                  , AutorNotas = '$arrData[AutorNotas]' 
                                                  , DesarrolloNotas='$arrData[DesarrolloNotas]' 
                                                  , ImgNotas='$arrData[ImgNotas]' 
                                                  WHERE IdNotas=$arrData[IdNotas]";
                                                  $link = Conectarse();
                                                  $r = mysqli_query($link, $sql);
                                                 }

                                                 function Usuario_Login($user, $pass)
                                                 {
                                                  $sql = "SELECT  * FROM  `empleados` 
                                                  WHERE  `usuario_usuario` =  '$user' 
                                                  AND  `pass_usuario` =  '$pass' 
                                                  ";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  return $result;
                                                 }

                                                 function Registros_Login($user, $pass)
                                                 {
                                                  $sql = "SELECT  * FROM  `usuarios` 
                                                  WHERE  `email` =  '$user' 
                                                  AND  `pass` =  '$pass' 
                                                  ";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  return $result;
                                                 }

                                                 function RLogin($usuario, $clave)
                                                 {
                                                  $result = Registros_Login($usuario, $clave);
                                                  $data = mysqli_fetch_array($result);
                                                  if ($data) {
                                                   $_SESSION["user"] = $data;
                                                   header("location: sesion.php");
                                                  } else {
                                                   echo "<span class='alert alert-danger btn-block'>Los datos son incorrectos</span>";
                                                  }
                                                 }

                                                 function Login($usuario, $clave)
                                                 {
                                                  $result = Usuario_Login($usuario, $clave);
                                                  $data = mysqli_fetch_array($result);
                                                  if ($data) {
                                                   $_SESSION['usuario'] = $data;
                                                   echo "<script>location.reload();</script>";
                                                  } else {
                                                   ?>
                                                   <script>alert("No puede ingresar ya que los datos no son los correctos.")</script>
                                                   <?php
                                                  }
                                                 }

                                                 function Empleados_Cumpleanos()
                                                 {
                                                  $hoy = date("Y-m-d");
                                                  $fecha = explode("-", $hoy);
                                                  $fecha = $fecha[1] . "-" . $fecha[2];
    //$fecha = "07-14";
                                                  $sql = "SELECT  `nombre`,`email` FROM  `usuarios` WHERE  `nacimiento` LIKE '%$fecha%' AND `email` != ''";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  while ($data = mysqli_fetch_array($result)) {
                                                   $nombre = mb_strtoupper($data["nombre"]);
                                                   $receptor = strtolower($data["email"]);
                                                   Enviar_User_Cumpleano("¡FELIZ CUMPLE, ".$nombre."!", $nombre, $receptor);
                                                  }
                                                 }

                                                 function Familiares_Cumpleanos()
                                                 {
                                                  $hoy = date("Y-m-d");
                                                  $fecha = explode("-", $hoy);
                                                  $fecha = $fecha[1] . "-" . $fecha[2];
    //$fecha = "07-14";
                                                  $sql = "SELECT  `nombre_familia`,`email_notificaciones` FROM  `familia`,`notificaciones` WHERE  familia_notificaciones = cod_familia AND `nacimiento_familia` LIKE '%$fecha%' AND `email_notificaciones` != '' GROUP BY id_familia";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  while ($data = mysqli_fetch_array($result)) {
                                                   $nombre = mb_strtoupper($data["nombre_familia"]);
                                                   $receptor = strtolower($data["email_notificaciones"]);
      //echo $nombre." ". $receptor;
                                                   Enviar_User_Cumpleano("¡FELIZ CUMPLE, ".$nombre."!", $nombre, $receptor);
                                                  }
                                                 }


                                                 function Empleados_Login($legajo, $dni)
                                                 {
                                                  $sql = "SELECT  * FROM  `usuarios` 
                                                  WHERE  `legajo` =  '$legajo' 
                                                  AND  `dni` =  '$dni' 
                                                  ";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  return $result;
                                                 }

                                                 function Empleados_Revision($dni)
                                                 {
                                                  $sql = "SELECT * FROM usuarios WHERE dni = $dni";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Empleados_Revision_Completo($cod)
                                                 {
                                                  $sql = "SELECT * FROM familia, usuarios WHERE familia = '$cod' and cod_familia = familia";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function Empleados_Familia_Revision($dni)
                                                 {
                                                  $sql = "SELECT * FROM familia WHERE dni_familia = $dni";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  return $data;
                                                 }

                                                 function ELogin($legajo, $dni)
                                                 {
                                                  $result = Empleados_Login($legajo, $dni);
                                                  $data = mysqli_fetch_array($result);
                                                  if ($data) {
                                                   $_SESSION["empleados"] = $data;
                                                  } else {
                                                   $error = 1;
                                                   return $error;
                                                  }
                                                 }

                                                 function normaliza($cadena)
                                                 {
                                                  $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ 
                                                  ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
                                                  $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy 
                                                  bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
                                                  $cadena = utf8_decode($cadena);
                                                  $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
                                                  $cadena = strtolower($cadena);
                                                  return utf8_encode($cadena);
                                                 }

                                                 function LogOut()
                                                 {
                                                  unset($_SESSION['usuario']);
                                                  session_unset();
                                                  session_destroy();
                                                 }

                                                 function Revisar_Email($base, $tabla, $email)
                                                 {
                                                  $sql = " 
                                                  FROM  `$base` 
                                                  WHERE  `$tabla` =  '$email'";
                                                  $link = Conectarse();
                                                  $result = mysqli_query($link, $sql);
                                                  $data = mysqli_fetch_array($result);
                                                  if ($data != '') {
                                                   $msg = "si";
                                                  } else {
                                                   $msg = "no";
                                                  }
                                                  return $msg;
                                                 } 

                                                 function Agencias_Read()
                                                 {
                                                  $idConn = Conectarse();
                                                  $sql = " 
                                                  SELECT * 
                                                  FROM agencias 
                                                  ORDER BY id DESC 
                                                  ";
                                                  $resultado = mysqli_query($idConn, $sql);
                                                  while ($row = mysqli_fetch_array($resultado)) {
                                                   $id = $row['id'];
                                                   ?>
                                                   <tr>
                                                    <td><?php
                                                     echo $id;
                                                     ?></td>
                                                     <td style="text-transform:uppercase"><?php
                                                      echo substr(strtoupper($row['agencia']), 0, 50);
                                                      ?></td>
                                                      <td style="text-align:center">
                                                       <a href="index.php?op=modificarEmpresa&id=<?php
                                                       echo $row['id'];
                                                       ?>" data-toggle="tooltip"
                                                       alt="Modificar" title="Modificar"><i class="glyphicon glyphicon-cog"></i></a>
                                                       <a href="index.php?op=verBeneficios&borrar=<?php
                                                       echo $row["id"];
                                                       ?>"
                                                       onClick="return confirm('¿Seguro querés eliminar a la empresa?')" data-toggle="tooltip"
                                                       alt="Eliminar" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a>
                                                      </td>
                                                     </tr>
                                                     <?php
                                                    }
                                                   }

                                                   function Agencias_Read_Front($categoria)
                                                   {
                                                    $idConn = Conectarse();
                                                    if ($categoria == '') {
                                                     $sql = " 
                                                     SELECT * 
                                                     FROM `agencias` 
                                                     ORDER BY RAND() 
                                                     ";
                                                    } else {
                                                     $sql = " 
                                                     SELECT * 
                                                     FROM `agencias` 
                                                     WHERE `categoria` LIKE '%$categoria%' 
                                                     ORDER BY RAND() 
                                                     ";
                                                    }
                                                    $resultado = mysqli_query($idConn, $sql);
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_array($resultado)) {
                                                     $id = $row['id'];
                                                     ?>
                                                     <div class="col-md-2" style="min-height:350px">
                                                      <a href="empresas.php?id=<?php
                                                      echo $row['id'];
                                                      ?>">
                                                      <?php
                                                      if (is_file($row["logo"])) {
                                                       ?>
                                                       <div
                                                       style="background:url('<?php
                                                        echo $row["logo"];
                                                        ?>') center center no-repeat;background-size:contain;height:200px"></div>
                                                       <?php
                                                      } else {
                                                       ?>
                                                       <div
                                                       style="background:url('<?php
                                                        echo 'img/producto_sin_imagen.jpg';
                                                        ?>') center center no-repeat;background-size:contain;height:200px"></div>
                                                       <?php
                                                      }
                                                      ?>
                                                     </a>
                                                     <hr>
                                                     <a href="empresas.php?id=<?php
                                                     echo $row['id'];
                                                     ?>"><h4><?php
                                                     echo $row['agencia'];
                                                     ?></h4></a>
                                                     <h6><?php
                                                      echo $row['localidad'];
                                                      ?> / <?php
                                                      echo $row['provincia'];
                                                      ?></h6>
                                                     </div>
                                                     <?php
                                                     if ($i == 6) {
                                                      $i = 1;
                                                      echo "<div class='clearfix'></div>";
                                                     } else {
                                                      $i++;
                                                     }
                                                    }
                                                   }

                                                   function Contar_Agencias($estado)
                                                   {
                                                    $idConn = Conectarse();
                                                    $sql2 = "SELECT COUNT('id_agencia') FROM  `agencias` WHERE estado_agencia = $estado";
                                                    $resultado2 = mysqli_query($idConn, $sql2);
                                                    $row2 = mysqli_fetch_row($resultado2);
                                                    echo "(" . $row2[0] . ")";
                                                   }

                                                   function Contar_Publicidad($estado)
                                                   {
                                                    $idConn = Conectarse();
                                                    $sql2 = "SELECT COUNT('id_publicidad') FROM  `publicidad` WHERE estado_publicidad = $estado";
                                                    $resultado2 = mysqli_query($idConn, $sql2);
                                                    $row2 = mysqli_fetch_row($resultado2);
                                                    echo "(" . $row2[0] . ")";
                                                   }

                                                   function Contar_Notas_Categoria($categoria)
                                                   {
                                                    $idConn = Conectarse();
                                                    $sql2 = "SELECT COUNT('IdNotas') FROM  `notabase` WHERE CategoriaNotas = $categoria AND VipNotas = 0";
                                                    $resultado2 = mysqli_query($idConn, $sql2);
                                                    $row2 = mysqli_fetch_row($resultado2);
                                                    echo $row2[0];
                                                   }

                                                   function Contar_Videos_Categoria($categoria)
                                                   {
                                                    $idConn = Conectarse();
                                                    $sql2 = "SELECT COUNT('IdVideos') FROM  `videos` WHERE CategoriaVideos = $categoria";
                                                    $resultado2 = mysqli_query($idConn, $sql2);
                                                    $row2 = mysqli_fetch_row($resultado2);
                                                    echo $row2[0];
                                                   }

                                                   function Contar_Reconstruidos_Categoria($categoria)
                                                   {
                                                    $idConn = Conectarse();
                                                    $sql2 = "SELECT COUNT('id_portfolio') FROM  `maquinas` WHERE categoria_portfolio = $categoria AND tipo_portfolio = 1";
                                                    $resultado2 = mysqli_query($idConn, $sql2);
                                                    $row2 = mysqli_fetch_row($resultado2);
                                                    return $row2;
                                                   }

                                                   function Contar_Usados_Categoria($categoria)
                                                   {
                                                    $idConn = Conectarse();
                                                    $sql2 = "SELECT COUNT('id_portfolio') FROM  `maquinas` WHERE categoria_portfolio = $categoria AND tipo_portfolio = 2";
                                                    $resultado2 = mysqli_query($idConn, $sql2);
                                                    $row2 = mysqli_fetch_row($resultado2);
                                                    return $row2;
                                                   }

                                                   function Pedidos_Read_Admin($estado)
                                                   {
                                                    $idConn = Conectarse();
                                                    $sql = "SELECT * FROM  `pedidos`,`usuarios`  WHERE estado_pedido = $estado AND usuario_pedido = id ORDER BY `id_pedido` DESC";
                                                    $sql2 = "SELECT COUNT('id_pedido') FROM  `pedidos` WHERE estado_pedido = $estado ORDER BY `id_pedido` DESC";
                                                    $resultado = mysqli_query($idConn, $sql);
                                                    $resultado2 = mysqli_query($idConn, $sql2);
                                                    $row2 = mysqli_fetch_row($resultado2);
                                                    $count = $row2[0];
                                                    $i = 1;
                                                    if ($count != 0) {
                                                     while ($row = mysqli_fetch_array($resultado)) {
                                                      ?>
                                                      <dd class="">
                                                       <a href="#panel<?php
                                                       echo $i;
                                                       ?>b">Pedido de: <?php
                                                       echo $row["nombre"];
                                                       ?> </a>

                                                       <div id="panel<?php
                                                       echo $i;
                                                       ?>b" class="content">
                                                       <?php
                                                       echo $row["contenido_pedido"];
                                                       ?>
                                                       <?php
                                                       if ($row["costo_pedido"] != '') {
                                                        echo "Presupuestado: $" . $row["costo_pedido"];
                                                       }
                                                       ?>
                                                       <form method="post">
                                                        <input type="hidden" value="<?php
                                                        echo $row["cod_pedido"];
                                                        ?>" name="cod">
                                                        <input type="number" name="presupuesto" placeholder="Costo" style="width:50%;float:left;">
                                                        <input type="submit" name="enviar" class="button" value="Modificar">
                                                       </form>
                                                      </div>
                                                     </dd>
                                                     <?php
                                                     $i++;
                                                    }
                                                   } else {
                                                    echo "No se ha encontrado ningún registro.";
                                                   }
                                                  }

                                                  function Usuarios_Read_Admin()
                                                  {
                                                   $idConn = Conectarse();
                                                   $sql = "SELECT * FROM  `usuarios` ORDER BY `familia` DESC";
                                                   $sql2 = "SELECT count(id) FROM  `usuarios` ORDER BY `familia` DESC";
                                                   $resultado = mysqli_query($idConn, $sql);
                                                   $resultado2 = mysqli_query($idConn, $sql2);
                                                   $row2 = mysqli_fetch_row($resultado2);
                                                   $count = $row2[0];
                                                   if ($count != 0) {
                                                    while ($row = mysqli_fetch_array($resultado)) {
                                                     ?>
                                                     <tr>
                                                      <td><?php echo strtoupper($row["legajo"]); ?></td>
                                                      <td style="text-transform: uppercase;"><?php echo strtoupper($row["nombre"]); ?></td>
                                                      <td style="text-transform: lowercase;"><?php echo strtoupper($row["email"]); ?></td>
                                                      <td style="text-transform: uppercase;"><?php echo strtoupper($row["dni"]); ?></td>
                                                      <td style="text-transform: uppercase;"><?php echo strtoupper($row["area"]); ?></td>
                                                      <td>
                                                       <?php
                                                       if(trim($row["familia"]) != '') {
                                                        ?>
                                                        <a class="btn btn-info btn-sm" href="index.php?op=verFamilia&dni=<?php echo $row["dni"]; ?>&familia=<?php echo $row["familia"]; ?>" target="_blank">
                                                         VER FAMILIA
                                                        </a>                                      
                                                        <?php
                                                       }
                                                       ?> 
                                                       <a href="index.php?op=verUsuarios&familia=<?php echo $row["familia"]; ?>"  onClick="return confirm('¿Seguro querés eliminar el usuario y su familia?')" class="btn btn-sm btn-danger" >
                                                        <i style="" class="fa fa-trash"></i>
                                                       </a>
                                                      </td>
                                                     </tr>  
                                                     <?php
                                                    }
                                                   } else {
                                                    echo "No se ha encontrado ningún registro.";
                                                   }
                                                  } 

                                                  function Productos_Read_Front($filtro)
                                                  {
                                                   $idConn = Conectarse();
                                                   if ($filtro == '0') {
                                                    $sql = " 
                                                    SELECT * 
                                                    FROM productobase, categoriaproducto 
                                                    WHERE CategoriaProducto = IdCategoriaProducto AND FiltroProducto != 0 
                                                    ORDER BY IdProducto DESC 
                                                    ";
                                                   } else {
                                                    $sql = " 
                                                    SELECT * 
                                                    FROM productobase, categoriaproducto 
                                                    WHERE CategoriaProducto = IdCategoriaProducto AND CategoriaProducto = $filtro AND FiltroProducto != 0 
                                                    ORDER BY IdProducto DESC 
                                                    ";
                                                   }
                                                   $resultado = mysqli_query($idConn, $sql);
                                                   while ($row = mysqli_fetch_array($resultado)) {
                                                    $fecha = explode("-", $row['LocalidadProducto']);
                                                    ?>
                                                    <div class="col_6 viaje">
                                                     <h1><?php
                                                      echo strtoupper($row['NombreProducto']);
                                                      ?></h1>

                                                      <h3>Salida el <?php
                                                       echo $fecha[2] . "/" . $fecha[1] . "/" . $fecha[0];
                                                       ?></h3>

                                                       <div class="overImg">
                                                        <img src="<?php
                                                        echo $row["ImgProducto1"];
                                                        ?>" width="100%"/>
                                                       </div>
                                                       <h2><?php
                                                        echo $row["DireccionProducto"];
                                                        ?></h2>
                                                        <hr class="alt1"/>
                                                        <p><?php
                                                         echo substr(strip_tags($row["Descripcionroducto"]), 0, 200) . "...";
                                                         ?></p>

                                                         <div class="clear"></div>
                                                         <a href="index.php?op=viaje&id=<?php
                                                         echo $row["IdProducto"];
                                                         ?>" class="boton_ver" alt="Más Info"
                                                         title="Más Info">Más Info</a>
                                                         <a href="index.php?op=pasajeros&id=<?php
                                                         echo $row["IdProducto"];
                                                         ?>" class="boton_reser" alt="Reservá Ahora"
                                                         title="Reservá Ahora">Reservá Ahora</a>
                                                         <img src="img/sombra.png" class="sombra hide-phone  hide-tablet ">
                                                        </div>
                                                        <?php
                                                       }
                                                      }

                                                      function Enviar_User_Cumpleano($asunto, $mensaje, $receptor)
                                                      {
                                                       $mail = new PHPMailer();
                                                       $mail->CharSet = 'UTF-8';
                                                       $mail->IsSMTP();
                                                       $mail->SMTPDebug = 1;
                                                       $mail->SMTPAuth = true;
                                                       $mail->Host = "mail.clubzf.com.ar";
                                                       $mail->Port = 587;
                                                       $mail->Username = "info@clubzf.com.ar";
                                                       $mail->Password = "inCl2017";
                                                       $mail->SetFrom('info@clubzf.com.ar', 'ClubZF');
                                                       $fecha = date("Y-m-d H:i:s");
                                                       $cuerpo = "
                                                       <body>
                                                        <table style='width:600px !important;text-align:center !important'>
                                                         <h1 style='text-align:center;margin:0;width:600px'><b>HOLA $mensaje</b></h1>
                                                         <h2 style='text-align:center;margin:0;width:600px'>EL CLUB ZF TE DESEA<hr/></h2>
                                                         <img src='img/cumple/1.jpg' width='600px' /><br/>
                                                         <img src='img/cumple/2.gif' width='600px' /><br/>
                                                         <img src='img/cumple/3.jpg' width='600px' /><br/>
                                                        </table>
                                                       </body>";
                                                       $cuerpo = eregi_replace("[\]", '', $cuerpo);
                                                       $mail->AddReplyTo('info@clubzf.com.ar', 'ClubZF');
                                                       $mail->Subject = $asunto;
                                                       $mail->AltBody = "Para ver el mensaje, por favor use Thunderbird o algún programa que vea HTML!";
                                                       $mail->MsgHTML($cuerpo);
                                                       $mail->AddAddress($receptor, "");
                                                       $mail->AddCc("info@clubzf.com.ar",'');
    //$mail->AddCc("mjfdg@hotmail.com",'');
                                                       if (!$mail->Send()) {
                                                        echo '<div class="alert alert-danger" role="alert">El mensaje no se pudo enviar.</div>';
                                                       } else {
                                                        echo '<div class="alert alert-success" role="alert">El mensaje fue enviado exitosamente.</div>';
                                                       } 
                                                      }


                                                      function Enviar_User($asunto, $mensaje, $receptor)
                                                      {
                                                       $mail = new PHPMailer();
                                                       $mail->CharSet = 'UTF-8';
                                                       $mail->IsSMTP();
                                                       $mail->SMTPDebug = 1;
                                                       $mail->SMTPAuth = true;
                                                       $mail->Host = "mail.clubzf.com.ar";
                                                       $mail->Port = 587;
                                                       $mail->Username = "info@clubzf.com.ar";
                                                       $mail->Password = "inCl2017";
                                                       $mail->SetFrom('info@clubzf.com.ar', 'ClubZf');
                                                       $fecha = date("Y-m-d H:i:s");
                                                       $cuerpo = " 
                                                       <body style='background:#333 fixed;  font-family: Tahoma,Verdana,Segoe,sans-serif; '> 
                                                        <div style='min-height:900px;height:100% !important;margin:0 !important;padding:0 !important'> 
                                                         <div style='width:700px;margin:auto;padding:20px;background:#f1f1f1;'> 
                                                          <img src='img/logo-light.png' style='width:250px'> 
                                                         </div> 
                                                         <div style='width:700px;margin:auto;padding:20px;background:#fff;'> 
                                                          <h3>¡Hola! ¿cómo están?</h3> 
                                                          <p style='font-size:14px'>Nuevo mensaje de consulta.</p> 
                                                          <p style='font-size:14px'>$mensaje</p><br/> 
                                                          <span style='font-size:13px'> 
                                                           <b>CLUB ZF</b> 
                                                           <hr/> 
                                                           AV. DE LA UNIVERSIDAD 51 2400 SAN FRANCISCO CÓRDOBA <br/> 
                                                           03564 43-8900<br/> 
                                                           INFO@CLUBZF.COM.AR<br/> 
                                                           <br/>  
                                                          </span><br/><br/> 
                                                          <hr/> 
                                                          <p>Fecha del email:" . $fecha . "</p> 
                                                         </div> 
                                                        </div> 
                                                       </body> 
                                                       ";
                                                       $cuerpo = eregi_replace("[\]", '', $cuerpo);
                                                       $mail->AddReplyTo('facundo@estudiorochayasoc.com.ar', 'Estudio Rocha & Asociados');
                                                       $mail->Subject = $asunto;
                                                       $mail->AltBody = "Para ver el mensaje, por favor use Thunderbird o algún programa que vea HTML!";
                                                       $mail->MsgHTML($cuerpo);
                                                       $mail->AddAddress($receptor, "");
                                                       if (!$mail->Send()) {
                                                        echo '<div class="alert alert-danger" role="alert">El mensaje no se pudo enviar.</div>';
                                                       } else {
                                                        echo '<div class="alert alert-success" role="alert">El mensaje fue enviado exitosamente.</div>';
                                                       }
                                                      }

                                                      function Enviar_User_Admin($asunto, $mensaje, $receptor)
                                                      {
                                                       $mail = new PHPMailer();
                                                       $mail->CharSet = 'UTF-8';
                                                       $mail->IsSMTP();
                                                       $mail->SMTPDebug = 1;
                                                       $mail->SMTPAuth = true;
                                                       $mail->Host = "mail.estudiorochayasoc.com";
                                                       $mail->Port = 587;
                                                       $mail->Username = "facundo@estudiorochayasoc.com";
                                                       $mail->Password = "faAr2010";
                                                       $mail->SetFrom('facundo@estudiorochayasoc.com.ar', 'Estudio Rocha & Asociados');
                                                       $fecha = date("Y-m-d H:i:s");
                                                       $cuerpo = " 
                                                       <body style='background:#333 fixed;  font-family: Tahoma,Verdana,Segoe,sans-serif; '> 
                                                        <div style='min-height:900px;height:100% !important;margin:0 !important;padding:0 !important'> 
                                                         <div style='width:700px;margin:auto;padding:20px;background:#f1f1f1;'> 
                                                          <img src='img/logo.png' style='width:250px'> 
                                                         </div> 
                                                         <div style='width:700px;margin:auto;padding:20px;background:#fff;'> 
                                                          <h3>¡Hola! ¿cómo están?</h3> 
                                                          <p style='font-size:14px'>Llego un nuevo mensaje de consulta.</p> 
                                                          <p style='font-size:14px'>$mensaje</p><br/> 
                                                          <span style='font-size:13px'> 
                                                           <b>BOMBEROS VOLUTARIOS SAN FRANCISCO CÓRDOBA</b> 
                                                           <hr/> 
                                                           Garibaldi 360 (San Francisco. Córdoba)<br/> 
                                                           Teléfono: +54 (3564) 420000<br/> 
                                                           info@bomberossanfrancisco.com<br/><br/> 
                                                           <br/>  
                                                          </span><br/><br/> 
                                                          <hr/> 
                                                          <p>Fecha del email:" . $fecha . "</p> 
                                                         </div> 
                                                        </div> 
                                                       </body> 
                                                       ";
                                                       $cuerpo = $cuerpo;
                                                       $mail->AddReplyTo('info@clubzf.com.ar', 'ClubZf');
                                                       $mail->Subject = $asunto;
                                                       $mail->AltBody = "Para ver el mensaje, por favor use Thunderbird o algún programa que vea HTML!";
                                                       $mail->MsgHTML($cuerpo);
                                                       $mail->AddAddress($receptor, "");
                                                       if (!$mail->Send()) {
                                                        echo "<script>alert('Su mensaje no se ha podido enviar, vuelva a intentarlo')</script>";
                                                       } else {
                                                        echo "<script>alert('Su mensaje se ha podido enviar, muchas gracias')</script>";
                                                       }
                                                      }

                                                      function EscalarImagen($ancho, $alto, $imagen, $guardar, $calidad)
                                                      {
                                                       $image = new Zebra_Image();
                                                       $image->source_path = $imagen;
                                                       $image->target_path = $guardar;
                                                       $image->jpeg_quality = $calidad;
                                                       $image->preserve_aspect_ratio = true;
                                                       $image->enlarge_smaller_images = true;
                                                       $image->preserve_time = true;
                                                       if (!$image->resize($ancho, $alto, ZEBRA_IMAGE_NOT_BOXED)) {
                                                        switch ($image->error) {
                                                         case 1:
                                                         echo 'Source file could not be found!';
                                                         break;
                                                         case 2:
                                                         echo 'Source file is not readable!';
                                                         break;
                                                         case 3:
                                                         echo 'Could not write target file!';
                                                         break;
                                                         case 4:
                                                         echo 'Unsupported source file format!';
                                                         break;
                                                         case 5:
                                                         echo 'Unsupported target file format!';
                                                         break;
                                                         case 6:
                                                         echo 'GD library version does not support target file format!';
                                                         break;
                                                         case 7:
                                                         echo 'GD library is not installed!';
                                                         break;
                                                        }
                                                       }
                                                      }

                                                      ?>