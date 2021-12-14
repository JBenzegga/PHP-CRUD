<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Usuario no reconocido!";
    exit;
} else {
    // Conectamos con la base de datos
    session_start();
    include('dbconnection.php');
    $ultimo_login = null;
    echo "Comprobando conexión a base de datos... <br/>";

    $sql = "SELECT password FROM agenda WHERE username = :user";
    $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $stmt->execute(array(':user' => $_SERVER['PHP_AUTH_USER']));
    $usuario = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if(password_verify($_SERVER['PHP_AUTH_PW'], $usuario[0]["password"])) {

        if (isset($_POST['limpiar'])) {
            unset($_SESSION['visita']);
            unset($_POST['limpiar']);
            $_SESSION['visita'] = array();
        } else {
            ?>
            <form id='vaciar' action='<?php echo $_SERVER['PHP_SELF'];?>' method='post'>
                <input type='submit' name='limpiar' value='Limpiar registro'/>
            </form>
            <?php
            $_SESSION['visita'][] = time();
        }

        echo "Nombre de usuario: ".$_SERVER['PHP_AUTH_USER']."<br />";
        echo "Hash de la contraseña: ".($_SERVER['PHP_AUTH_PW'])."<br />";
        if (count($_SESSION['visita']) == 0)
            echo "Bienvenido. Esta es su primera visita.";
        else {
            date_default_timezone_set('Europe/Madrid');
            foreach($_SESSION['visita'] as $v)
                echo date("d/m/y \a \l\a\s H:i", $v) . "<br />";
        }
    } else {
        header('WWW-Authenticate: Basic realm="Contenido restringido"');
        header("HTTP/1.0 401 Unauthorized");
        exit;
    }

    // if (isset($ultimo_login))
    //     echo "Ultimo login: " . date("d/m/y \a \l\a\s H:i", $ultimo_login);
    // else
    //     echo "Bienvenido. Esta es su primera visita.";

    $conn = null;

    // $ncount = $stmt->rowCount();
    // echo $ncount;
}

// echo "Nombre de usuario: ".$_SERVER['PHP_AUTH_USER']."<br />";
// echo "Contraseña: ".$_SERVER['PHP_AUTH_PW']."<br />";
?>