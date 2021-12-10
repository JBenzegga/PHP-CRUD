<?php
include('dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <title>Registrar usuario - CRUD Joaquín</title>
</head>
<body>

    <?php
        $sqlpaises = "SELECT * FROM paises";
        $stmt = $conn->prepare($sqlpaises);
        $stmt->execute();
        $user_viewpais = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre: </label><input value="" type="text" name="nombre" id="nombre"> <br> 
        <label for="apellidos">Apellidos: </label><input value="" type="text" name="apellidos" id="apellidos"> <br> 
        <label for="telefono">Teléfono: </label><input value="" type="text" name="telefono" id="telefono"> <br> 
        <label for="usuario">Usuario: </label><input value="" type="email" name="usuario" id="usuario"> <br> 
        <label for="contrasena">Contraseña: </label><input value="" type="text" name="contrasena" id="contrasena"> <br> 
        <label for="nacionalidad">Nacionalidad: </label>
        <select name="nacionalidad" id="nacionalidad">
            <?php 
            foreach ($user_viewpais as $pais) {
            print "<option value=\"$pais[1]\">$pais[2]</option>";
            }
            ?>
        </select> <br>
        <label for="sexo">Sexo: </label>
        <input type="radio" name="sexo" id="sexo" value="m">Mujer</input>
        <input type="radio" name="sexo" id="sexo" value="h">Hombre</input> <br>
        <input type="file" name="foto" id="foto" class="form-check">
        <input type="submit" value="Crear nuevo usuario" name="submit" class="btn btn-info">
    </form>

    <?php 
    function filtrado($datos) {
        $datos = trim($datos);
        $datos = stripslashes($datos);
        $datos = htmlspecialchars($datos);
        return $datos;
    }

    if (isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"]=="POST") {
        $nombre = filtrado($_POST["nombre"]);
        $apellidos = filtrado($_POST["apellidos"]);
        $telefono = filtrado($_POST["telefono"]);
        $usuario = filtrado($_POST["usuario"]);
        $contrasena = filtrado($_POST["contrasena"]);
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $nacionalidad = filtrado($_POST["nacionalidad"]);
        $sexo = filtrado($_POST["sexo"]);
        $foto = filtrado($_FILES["foto"]["name"]);
        include('upload_registro.php');

    // $sql = "INSERT INTO agenda (nombre, apellido, telefono, username, password, nacionalidad, sexo)
    // VALUES ('$nombre', '$apellidos', '$telefono', '$usuario', '$hash', '$nacionalidad', '$sexo')";

    $data = [
        'nombre' => $nombre,
        'apellidos' => $apellidos,
        'telefono' => $telefono,
        'usuario' => $usuario,
        'contrasena' => $hash,
        'nacionalidad' => $nacionalidad,
        'sexo' => $sexo,
        'foto' => $foto
    ];

    $sql = "INSERT INTO agenda (nombre, apellido, telefono, username, password, nacionalidad, sexo, foto) 
    VALUES (:nombre, :apellidos, :telefono, :usuario, :contrasena, :nacionalidad, :sexo, :foto)";
    $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $stmt->execute($data);
    $ultimo_id = $conn->lastInsertId();

    $conn = null;

    }

    if (isset($ultimo_id)) {
    ?>

    <h2>Mostrar datos enviados</h2>
    <p>ID: <?php print $ultimo_id ?></p>
    <p>Nombre: <?php isset($nombre) ? print $nombre : ""; ?></p>
    <p>Apellidos: <?php isset($apellidos) ? print $apellidos : ""; ?></p>
    <p>Teléfono: <?php isset($telefono) ? print $telefono : ""; ?></p>
    <p>Usuario: <?php isset($usuario) ? print $usuario : ""; ?></p>
    <p>Contraseña: <?php isset($contrasena) ? print $contrasena : ""; ?></p>
    <p>Nacionalidad: <?php isset($nacionalidad) ? print $nacionalidad : "Sin contraseña"; ?></p>
    <p>Sexo: <?php isset($sexo) ? print $sexo : ""; ?></p>

    <?php }
    else {
        print "";
    }
    ?>

    <br>
    <br>
    <button class="btn btn-primary" id="volver">Volver</button>
    <script>
        document.getElementById("volver").onclick = function () {
            window.location.replace("listar_user.php")
        }
    </script>

</body>
</html>