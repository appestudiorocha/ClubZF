<div id="grupoNotificaciones">
    <div class="col-sm-12">
        <h2>
            Tu Grupo Familiar, también puede enterarse de los beneficios del Club ZF en el acto!
        </h2>
        <hr/>
        En esta pestaña podrás cargar los datos de personas que ya pertenecen a tu Grupo Familiar (previamente tenés que haberlos cargado en la pestaña anterior “Actualizar Datos de Mi Grupo Familiar”). De esta manera, ellos también recibirán notificaciones de nuevos beneficios, promociones y descuentos (de manera totalmente gratuita) para aprovechar al máximo del Club ZF. Una vez que completes los datos, hacé click en el botón “Sumar Notificación”. Si en algún momento querés que esa persona deje de recibir notificaciones, sólo deberás hacer clic en el botón azul con la cruz (x).
           <br/><br/>

        <?php
        if (isset($_POST["insertar"])) {
            $celular = isset($_POST["celular"]) ? $_POST["celular"] : '';
            $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
            $familia = isset($_POST["familia"]) ? $_POST["familia"] : '';
            $email = isset($_POST["email"]) ? $_POST["email"] : '';

            $con = Conectarse();
            $sql = "
            INSERT INTO `notificaciones`
            (`familia_notificaciones`, `email_notificaciones`, `celular_notificaciones`, `usuario_notificaciones`)
            VALUES
            ('$familia','$email','$celular','$usuario')
            ";
            $query = mysqli_query($con, $sql);
            echo("<script>location.href='modificar?op=notificaciones'</script>");
        }

        if (isset($_POST["actualizar"])) {
            $celular = isset($_POST["celular"]) ? $_POST["celular"] : '';
            $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : '';
            $familia = isset($_POST["familia"]) ? $_POST["familia"] : '';
            $email = isset($_POST["email"]) ? $_POST["email"] : '';
            $id = isset($_POST["id"]) ? $_POST["id"] : '';
            $con = Conectarse();
            $sql = "
            UPDATE `notificaciones`
            SET
            `familia_notificaciones`='$familia',
            `email_notificaciones`='$email',
            `celular_notificaciones`='$celular',
            `usuario_notificaciones`='$usuario'
            WHERE
            `id_notificaciones`= '$id'
            ";
            $query = mysqli_query($con, $sql);
            echo("<script>location.href='modificar?op=notificaciones'</script>");
        }

        $totalIntegrantes = Familia_Contar($_SESSION["empleados"]["familia"]);
        if ($totalIntegrantes[0] != '') {
            ?>
            <table class="table table-hovered table-bordered">
                <thead>
                <th style="text-transform: uppercase">Nombre y apellido</th>
                <th style="text-transform: uppercase">Nº de Celular</th>
                <th style="text-transform: uppercase">E-mail</th>
                <th></th>
                </thead>
                <?php
                FamiliaNotificaciones_TraerPorId($_SESSION["empleados"]["familia"]);
                ?>
            </table>
        <?php
        }
        ?>
    </div>
</div>