<?php
echo "Joaquin Ferrer Benzegga <br/>";
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Usuario no reconocido! Joaquin Ferrer Benzegga";
    exit;
} else {
    // Conectamos con la base de datos
    include('dbconnection.php');
    $ultimo_login = null;
    echo "Comprobando conexión a base de datos...";

    $sql = "SELECT password FROM agenda WHERE username = :user";
    $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $stmt->execute(array(':user' => $_SERVER['PHP_AUTH_USER']));
    $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(password_verify($_SERVER['PHP_AUTH_PW'], $usuario[0]["password"])) {
        if (isset($_COOKIE['ultimo_login'])) {
            $ultimo_login = $_COOKIE['ultimo_login'];
            }
        setcookie("ultimo_login", time(), time()+3600);
    } else {
        header('WWW-Authenticate: Basic realm="Contenido restringido"');
        header("HTTP/1.0 401 Unauthorized");
        exit;
    }

    if (isset($ultimo_login))
        echo "Ultimo login: " . date("d/m/y \a \l\a\s H:i", $ultimo_login);
    else
        echo "Bienvenido. Esta es su primera visita.";

    $conn = null;

    // $ncount = $stmt->rowCount();
    // echo $ncount;
}

// echo "Nombre de usuario: ".$_SERVER['PHP_AUTH_USER']."<br />";
// echo "Contraseña: ".$_SERVER['PHP_AUTH_PW']."<br />";
?>