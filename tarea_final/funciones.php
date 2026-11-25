<?php declare(strict_types=1);
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

        $nombreV = isset($c['nombre']) && is_string($c['nombre']) ? stripslashes(trim($c['nombre'])) : '';
        $apellidosV = isset($c['apellidos']) && is_string($c['apellidos']) ? stripslashes(trim($c['apellidos'])) : '';
        $emailV = isset($c['email']) && is_string($c['email']) ? stripslashes(trim($c['email'])) : '';
        $telefonoV = isset($c['telefono']) && is_string($c['telefono']) ? stripslashes(trim($c['telefono'])) : '';

        if ($nombreV === '') {
            $errs['nombre'] = 'El nombre es obligatorio.';
        } elseif (preg_match('/[0-9]/', $nombreV)) {
            $errs['nombre'] = 'El nombre no puede contener números.';
        }

        if ($apellidosV === '') {
            $errs['apellidos'] = 'Los apellidos son obligatorios.';
        } elseif (preg_match('/[0-9]/', $apellidosV)) {
            $errs['apellidos'] = 'Los apellidos no pueden contener números.';
        }

        if ($emailV === '') {
            $errs['email'] = 'El email es obligatorio.';
        } elseif (filter_var($emailV, FILTER_VALIDATE_EMAIL) === false) {
            $errs['email'] = 'El email no tiene un formato válido.';
        }

        if ($telefonoV === '') {
            $errs['telefono'] = 'El teléfono es obligatorio.';
        } elseif (preg_match('/^[0-9]{9}$/', $telefonoV) !== 1) {
            $errs['telefono'] = 'El teléfono debe tener exactamente 9 números.';
        }

        return $errs;
    }

    function pintarFormularioContacto(int $i, string $emoji, array $valores, array $errores): string {
        
        $nombre = ($valores['nombre'] ?? '');
        $apellidos = ($valores['apellidos'] ?? '');
        $email = ($valores['email'] ?? '');
        $telefono = ($valores['telefono'] ?? '');

        $nombreErr = ($errores['nombre'] ?? '');
        $apellidosErr = ($errores['apellidos'] ?? '');
        $emailErr = ($errores['email'] ?? '');
        $telefonoErr = ($errores['telefono'] ?? '');

        $html ='
            <span> '.$emoji.' </span>
            <div>
                    <label>Nombre</label> <input name="contactos['.$i.'][nombre]" value="'.$nombre.'" required></input>
                    <p>'.$nombreErr.'</p>
                    <label>Apellidos</label> <input name="contactos['.$i.'][apellidos]" value="'.$apellidos.'"required></input>
                    <p>'.$apellidosErr.'</p>
                    <br></br>
                    <label>Email</label> <input name="contactos['.$i.'][email]" value="'.$email.'"required></input>
                    <p>'.$emailErr.'</p>
                    <label>Telefono</label> <input name="contactos['.$i.'][telefono]" value="'.$telefono.'"required></input>
                    <p>'.$telefonoErr.'</p>
                    </div>';

            return $html;
    }


?>