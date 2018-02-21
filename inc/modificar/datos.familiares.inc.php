<div id="grupoFamiliar">
    <?php
    $totalIntegrantes = Familia_Contar($_SESSION["empleados"]["familia"]);
    if ($totalIntegrantes[0] != ''  ) {
        ?>
        <div class="col-sm-12">
            <h2>
                Mi Grupo Familiar
            </h2>
            <hr/>
            En este cuadro vas a ver a aquellas personas de tu Grupo Familiar que ya están agregadas en el sistema. No te preocupes si necesitás eliminar a alguien porque podés hacerlo utilizando la cruz (x) azul del último casillero.
            <br/><br/>
            <table class="table table-hovered table-bordered">
                <thead>
                    <th style="text-transform: uppercase">NOMBRE</th>
                    <th style="text-transform: uppercase">NACIMIENTO</th>
                    <th style="text-transform: uppercase">PARENTESCO</th>
                    <th style="text-transform: uppercase">OCUPACIÓN/ESTUDIOS</th>
                    <th></th>
                </thead>
                <?php
                Familia_TraerPorId($_SESSION["empleados"]["familia"]);
                ?>
            </table>
        </div>
        <?php
    }

    $borrar = isset($_GET["borrar"]) ? $_GET["borrar"] : '';
    if ($borrar != '') {
        $con = Conectarse();
        $sql = "DELETE FROM `familia` WHERE `id_familia`  = '$borrar'";
        $query = mysqli_query($con, $sql);
        echo("<script>location.href='modificar?op=familiar'</script>");
    }
    ?>
    
    <div class="col-sm-12">
        <h2>
            Quiero agregar personas a Mi Grupo Familiar
        </h2>
        <hr/>
        Completá los siguientes datos de la persona que querés agregar a tu Grupo Familiar. Utilizá el botón rojo  “restar” (-) para quitar a una persona antes de guardar los cambios y el botón verde de “sumar” (+) para agregar a otra persona más antes de guardar los cambios. Una vez que hayas terminado de cargar a las personas que querés en tu Grupo Personal, presioná el botón “Actualizar Mi Grupo Familiar”.
        <br/><br/>
    </div>
    <?php
    if (isset($_POST["actualizar"])) {
        $count = count($_POST["nombre"]);
        //echo $count;
        $familia = $_SESSION["empleados"]["familia"];
        for ($i = 0; $i < $count; $i++) {
            $fecha = $_POST["ano"][$i] . "-" . $_POST["mes"][$i] . "-" . $_POST["dia"][$i];
            $nombre = $_POST["nombre"][$i];
            $tipo = $_POST["tipo"][$i];
            $ocupacion = $_POST["ocupacion"][$i];
            $estudios = isset($_POST["estudios"][$i]) ? $_POST["estudios"][$i] : '';
            $dni = $_POST["dni"][$i];

           // echo   $nombre ." | ". $fecha  ." | ". $tipo ." | ". $ocupacion ." | ". $estudios ." | ". $dni."<br/>";

            $con = Conectarse();
            $sql = "INSERT INTO `familia` 
            (`cod_familia`, `nombre_familia`,`dni_familia`, `nacimiento_familia`, `tipo_familia`, `ocupacion_familia`, `estudios_familia`)
            VALUES 
            ('$familia', '$nombre','$dni', '$fecha', '$tipo', '$ocupacion', '$estudios')";
            $query = mysqli_query($con, $sql);
            echo("<script>location.href='modificar?op=familiar'</script>"); 
        }
    }
    ?>
    <form method="post">
        <div class="col-md-2">Nombre y apellido</div>
        <div class="col-md-2">DNI</div>
        <div class="col-md-2">Fecha de nacimiento</div>
        <div class="col-md-1">Parentesco</div>
        <div class="col-md-2">Ocupación</div>
        <div class="col-md-3"><span class="opacityEstudios">¿Es estudiante?<br/><span style="font-size:12px">Ingresá el nombre del establecimiento</span></div>
        <div class="clearfix"></div>
        <div data-role="dynamic-fields">
            <div class="form-inline">
                <div class="form-group col-md-2 col-sm-12">
                    <input type="text" class="form-control" name="nombre[]" placeholder="Nombre y apellido" style="width:100% !important;" required>
                </div>
                <div class="form-group col-md-2 col-sm-12">
                    <input type="text" class="form-control validadorNumero" minlength="7" maxlength="8" name="dni[]" placeholder="DNI" style="width:100% !important;" required>
                </div>
                <div class="form-group col-md-2  col-sm-12 ">
                    <label style="width:30%">
                        <input type="text" name="dia[]" class="validadorNumero form-control" minlength="2" style="font-weight:normal;padding:0 4px;width:100% !important" maxlength="2" placeholder="día" required/>
                    </label>
                    <label style="width:30%">
                        <input type="text" name="mes[]" class="validadorNumero form-control" minlength="2" style="font-weight:normal;padding:0 4px;width:100% !important" maxlength="2" placeholder="mes" required/>
                    </label>
                    <label style="width:32%">
                        <input type="text" name="ano[]" class="validadorNumero form-control" minlength="4" style="font-weight:normal;padding:0 4px;width:100% !important" maxlength="4" placeholder="año" required/>
                    </label>
                </div>
                <div class="form-group col-md-1  col-sm-12">
                    <select id="tipo" name="tipo[]" class="form-control" style="width:100% !important;" required>
                        <option disabled selected></option>
                        <option value="cónyuge hombre">Cónyuge hombre</option>
                        <option value="cónyuge mujer">Cónyuge mujer</option>
                        <option value="hijo">Hijo</option>
                        <option value="hija">Hija</option>
                        <option value="padre">Padre</option>
                        <option value="madre">Madre</option>
                        <option value="hermano">Hermano</option>
                        <option value="hermana">Hermana</option>
                    </select>
                </div>
                <div class="form-group col-md-2  col-sm-12">
                    <select name="ocupacion[]" id="" class="ocupacion form-control" required style="width:100% !important">
                        <option disabled selected>Elegir la opción</option>                        
                        <option value="Estudiante" class="default">Estudiante</option>
                        <option value="Gerentes">Gerentes</option>
                        <option value="Administración">Administración</option>
                        <option value="Comercial/Ventas">Comercial/Ventas</option>
                        <option value="Profesional">Profesional</option>
                        <option value="Secretario/a">Secretario/a</option>
                        <option value="Viajante">Viajante</option>
                        <option value="Cajero/a">Cajero/a</option>
                        <option value="Operario">Operario</option>
                        <option value="Maestranza">Maestranza</option>
                        <option value="Ama de Casa">Ama de Casa</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>
                <div class="form-group col-md-2  col-sm-12 " >
                  <input type="text" name="estudios[]" value='' class="form-control" style="font-weight:normal;padding:0 4px;width:100% !important" />
              </div>                
              <div class="col-md-1">
                <button class="btn"
                style="background:rgba(183, 53, 53,0.5);padding:5px;border:0;width: 48%;float:right; margin:1%; color:#fff"
                data-role="remove">
                <b> - </b>
            </button>
            <button class="btn"
            style="background:rgba(2, 140, 57,0.5);padding:5px;border:0;width: 48%;float:right; margin:1%; color:#fff"
            data-role="add">
            <b> + </b>
        </button>
    </div>
    <div class="col-md-1">

    </div>
    <div class="clearfix"></div>
    <hr/>
</div>
</div>
<div class="form-group col-md-12">
    <button type="submit" name="actualizar" class="btn btn-default">Actualizar Mi Grupo Familiar</button>
</div>
</form>
</div>



