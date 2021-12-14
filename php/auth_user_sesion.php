<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Usuario no reconocido!";
    exit;
} else {
    // Conectamos con la base de datos
    session_start();
    if (!isset($_SESSION['usuario'])){
        $_SESSION['visita'] = array();
        include('dbconnection.php');
        echo "Comprobando conexión a base de datos... <br/>";
        
        $sql = "SELECT password FROM agenda WHERE username = :user";
        $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stmt->execute(array(':user' => $_SERVER['PHP_AUTH_USER']));
        $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (!(password_verify($_SERVER['PHP_AUTH_PW'], $usuario[0]["password"]))) {
            header('WWW-Authenticate: Basic realm="Contenido restringido"');
            header("HTTP/1.0 401 Unauthorized");
            exit;        
        } else {
            $_SESSION['usuario'] = $_SERVER['PHP_AUTH_USER'];
        }
        $conn = null;
    } else {
        if (isset($_POST['limpiar'])) {
            unset($_SESSION['visita']);
        } else {
            $_SESSION['visita'][] = time();
        }
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    echo "Nombre de usuario: ".$_SERVER['PHP_AUTH_USER']."<br />";
    echo "Hash de la contraseña: ".($_SERVER['PHP_AUTH_PW'])."<br />";
    if (isset($_SESSION['visita'])) {
        if (count($_SESSION['visita']) == 0)
            echo "Bienvenido. Esta es su primera visita.";
        else {
            date_default_timezone_set('Europe/Madrid');
            foreach($_SESSION['visita'] as $v)
                echo date("d/m/y \a \l\a\s H:i", $v) . "<br />";
        ?>
        <form id='vaciar' action='<?php echo $_SERVER['PHP_SELF'];?>' method='post'>
            <input type='submit' name='limpiar' value='Limpiar registro'/>
        </form>
        <?php
        }
    }
?>

</body>
</html>