<?php require_once "configuracion.php";
    const EMOJIS = array('😀', '😂', '😍', '🥰', '😎', '🤔', '😭', '😡', '👍', '❤️');

    function emojisDisponibles(int $num): array {
        $emojis = array();
        for ($k = 0; $k < $num; $k++) {
            array_push($emojis, EMOJIS[$k]);
        }

        return $emojis;
    }

    function emojiAleatorio(array $emojis): string {
        $emoji = rand(0, count($emojis)-1);
        return $emojis[$emoji];
    }

    function validarContacto(array $c): array {
        $errs = array();

        return $errs;
    }

    function pintarFormularioContacto(int $i, string $emoji, array $valores, array $errores): string {
        $erroresCampos = "";
        $nombre = ($valores['nombre'] ?? '');
        $apellidos = ($valores['apellidos'] ?? '');
        $email = ($valores['email'] ?? '');
        $telefono = ($valores['telefono'] ?? '');

        foreach ($errores as $error) {
            $erroresCampos = $erroresCampos + $error + "; ";
        }
        $html ='
            <span> ' . $emoji  . ' </span> 
            <div>
                    <label>Nombre</label> <input name="contactos[' . $i . '][nombre]" value=" ' . $nombre . '" required></input>
                    <label>Apellidos</label> <input name="contactos[' . $i . '][apellidos]" value=" ' . $apellidos . '" required></input>
                    <br></br>
                    <label>Email</label> <input name="contactos[' . $i . '][email]" value="' . $email . ' "required></input>
                    <label>Telefono</label> <input name="contactos[' . $i . '][telefono]" value=" '. $telefono . ' "required></input>
                    <p> ' . $erroresCampos . '</p>
                    </div>';

            return $html;
    }


?>