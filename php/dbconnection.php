<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
<?php

$servername = "localhost";
$dbname = "prueba2";
$username = "app";
$password = "543210";


// $conn = new mysqli('localhost','app','543210','prueba2');
// $error = $conn->connect_errno;

// if ($error != null) {
//     echo "<p>Error $error conectando a la base de datos: $conn->connect_error</p>";
//     exit();
// } else {
//     echo $conn->server_info;
// }

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class=\"text-success\">Conexión establecida con éxito</p>";
} catch(PDOException $e) {
    echo $e->getMessage();
}

?>