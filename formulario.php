<?php

$email = "";
$nombre = "";
$url = "";
$comentario = "";
$genero = "";

$error = "";
$emailErr = "";
$urlErr = "";
$nombreErr = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST["email"]) || empty($_POST["nombre"]) || empty($_POST["url"]) || empty($_POST["sexo"])) {
        global $error;
        $error="Todos los campos requeridos deben completarse";
     }
    $email = $_POST["email"];
    $nombre = $_POST["nombre"];
    $url = $_POST["url"];
    $comentario = $_POST["comentario"];
    $genero = $_POST["sexo"];
    validar($email, $nombre, $url, $comentario, $genero);
}

function validar (string $email, string $nombre, string $url, string $comentario, string $genero) {
    $comentarioV = stripslashes(trim($comentario));
    $nombreV = stripcslashes(trim($nombre));
    $emailV = stripslashes(trim($email));
    $urlV = stripslashes (trim($url));

    validarEmail($emailV);
    validarUrl($urlV);
    validarNombre($nombreV);
     
}

function validarEmail (string $e) {
    global $emailErr;
    global $email;
    if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "El formato del email es incorrecto";
}

}

function validarUrl (string $u) {
    global $urlErr;
    global $url;

    if (!filter_var($u, FILTER_VALIDATE_URL)) {
        $urlErr = "El formato de la url es incorrecto";
    }
}

function validarNombre (string $n) {
    global $nombreErr;
    global $nombre;

    if (!preg_match("/^[a-zA-Z ]*$/",$n)) {
         $nombreErr = "Únicamente se permiten letras y espacios";
         } 

    
}


?>

<h1>Validacion de formularios</h1>

<h3 style="color:red">* Todos los campos con este simbolo deben ser rellenados antes de validar</h3>

<span style="color:red"><?php echo $error;?> </span>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
    <label>Nombre:</label>
    <input type ="text" id="nombre" name="nombre" value="<?php echo $nombre;?>"><span style="color:red">* <?php echo $nombreErr;?> </span></input>

    <br></br>

    <label>Email:</label>
    <input type="text" id="email" name="email" value="<?php echo $email;?>"><span style="color:red">* <?php echo $emailErr;?></span> </input>

    <br></br>

    <label>Pagina web </label>
    <input type="text" id="url" name="url" value="<?php echo $url;?>"><span style="color:red">* <?php echo $urlErr;?> </span></input>

    <br></br>

    <label>Comentario:</label>
    <textarea type="text" id="comentario" name="comentario" rows="7" cols="30" value="<?php echo $comentario;?>"></textarea>

    <br></br>

    <label>Genero <span style="color:red">*</span>:</label>
    <input type="radio" id="sexo" name="sexo" <?php if (isset($genero) && $genero=="hombre") echo "checked";?> value="hombre">Hombre</input>
    <input type="radio" id="sexo" name="sexo" <?php if (isset($genero) && $genero=="mujer") echo "checked";?>  value="mujer">Muyer</input>

    <br></br>

    <button type="submit">Validar</button>

</form>

<h2>Tus datos enviados</h2>

<?php
print("$nombre <br></br>");
print("$email <br></br>");
print("$url <br> </br>");
print("$genero <br></br>");
print("$comentario <br></br>");
?>

