
        <?php
        include "View/cabecera.php";
        
        
        $combinacion = "bolibic";
        $oportunidades = 4;
        if (!isset($_REQUEST["oportunidades"])) {
            ?>
            <div id="contenedor">
            <div id="cabezapico">
                <div  id="picoarriba">
                </div>
                <div  id="picoabajo">
                </div>
                <div  id="cabeza">
                </div>
            </div>
            <div  id="cuerpo">
            </div>
            <div  id="patadel">
            </div>
            <div  id="patatra">
            </div>

        </div>
            <div id="contrasena">
                <form action="acceso.php" method="post">
                    Para acceder a Podenco,<br>
                    introduce la contraseña.<br>
                    <input type="password" name="codigoIntro" autofocus>
                    <?php
                        echo '<input type="hidden" name="oportunidades" value="', $oportunidades, '">';
                    ?>
                    <input type="submit" value="Abrir">
                </form>
                <br />
                <a href="../Controller/listadoInglesEsp.php">listado</a>
            </div>
            <?php
        } else {
            $combinacion = "bolibic";
            $oportunidades = $_REQUEST["oportunidades"];
            $codigoIntro = $_REQUEST["codigoIntro"];

            if (($oportunidades > 0) && ($combinacion != $codigoIntro)) {
                $oportunidades--;
            }
            if (($oportunidades > 0) && ($combinacion != $codigoIntro)) {
                echo "<div id='contrasena'>";
                echo "Has fallado, te quedan ", ($oportunidades), " oportunidades<br>";
                echo "Introduce un nuevo código.";
                echo '<form action="acceso.php" method="post">';
                echo '<input type="text" name="codigoIntro" autofocus>';
                echo '<input type="hidden" name="oportunidades" value="', $oportunidades, '">';
                echo '<input type="submit" value="Abrir">';
                echo '</form>';
                echo '</div>';
            }
            if ($combinacion == $codigoIntro) {
                header("Location: Controller/modificarGeneral.php");
            }
            if (($oportunidades == 0)) {
                if ($combinacion == $codigoIntro) {
                    header("Location: Controller/modificarGeneral.php");
                } else {
                    echo "<div id='contrasena'>";
                    echo "Has agotado tus oportunidades, no puedes acceder a podenco";
                    echo '</div>';
                }
            }
        }
        ?>
    </body>
</html>
