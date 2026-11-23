<?php require_once "configuracion.php";
    const EMOJIS = array('😀', '😂', '😍', '🥰', '😎', '🤔', '😭', '😡', '👍', '❤️');

    $config = sacarConfig();

    $max_lote = $config['max_lote'];

    $max_emojis = $config['max_emojis'];

    $max_contactos = $config['max_contactos'];

    function emojisDisponibles(int $num): array {
        $emojis = array();
        echo $num;
        for ($k = 0; $k < $num; $k++) {
            array_push($emojis, EMOJIS[$k]);
        }

        return $emojis;
    }

    function emojiAleatorio(array $emojis): string {
        rand(4, $max_emojis);

        return $emojis[4];
    }

    function validarContacto(array $c): array {
        $errs = array();

        return $errs;
    }

    function pintarFormularioContacto(int $i, string $emoji, array $valores, array $errores): string {

    }


?>