<?php
    include('dbconnection.php');
    $id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
        <title>Editar usuario - CRUD Joaquín</title>
    </head>
    <body>

    <?php
        $sql = "SELECT * FROM agenda WHERE id = :identificador";
        $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stmt->execute(array(':identificador' => $id));
        $user_view = $stmt->fetchAll();

        $sqlpaises = "SELECT * FROM paises";
        $stmt = $conn->prepare($sqlpaises);
        $stmt->execute();
        $user_viewpais = $stmt->fetchAll();

    ?>


    

    <div class="mx-auto w-50">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=$id"; ?>" method="post">
            <h1>Edición de usuario</h1>
            <input type="hidden" name="usuarioId" value="<?=$_GET["id"]?>"> <br>
            <label class="form-label" for="id">ID: </label><input class="form-control" value="<?=$user_view[0]["id"]?>" type="text" name="nombre" id="nombre" readonly> <br>
            <label class="form-label" for="nombre">Nombre: </label><input class="form-control" value="<?=$user_view[0]["nombre"]?>" type="text" name="nombre" id="nombre" required> <br>
            <label class="form-label" for="apellidos">Apellidos: </label><input class="form-control" value="<?=$user_view[0]["apellido"]?>" type="text" name="apellidos" id="apellidos" required> <br>
            <label class="form-label" for="telefono">Teléfono: </label><input class="form-control" value="<?=$user_view[0]["telefono"]?>" type="text" name="telefono" id="telefono" required> <br>
            <label class="form-label" for="usuario">Usuario: </label><input class="form-control" value="<?=$user_view[0]["username"]?>" type="email" name="usuario" id="usuario" required> <br>
            <label class="form-label" for="nacionalidad">Nacionalidad: </label>
            <select name="nacionalidad" id="nacionalidad" class="select is-primary" required>
                <?php
                foreach ($user_viewpais as $pais) {
                print "<option value=\"$pais[1]\">$pais[2]</option>";
                }
                ?>
            </select> <br>
            <label for="sexo" class="label">Sexo: </label>
            <input type="radio" name="sexo" id="sexo" value="m" required>Mujer</input>
            <input type="radio" name="sexo" id="sexo" value="h" required>Hombre</input> <br> <br>
            <input type="submit" value="Actualizar usuario" name="submit" class="btn btn-dark mx-auto">
        </form>
    </div>

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
        // $contrasena = filtrado($_POST["contrasena"]);
        // $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $nacionalidad = filtrado($_POST["nacionalidad"]);
        $sexo = filtrado($_POST["sexo"]);

    // $sql = "INSERT INTO agenda (nombre, apellido, telefono, username, password, nacionalidad, sexo)
    // VALUES ('$nombre', '$apellidos', '$telefono', '$usuario', '$hash', '$nacionalidad', '$sexo')";

    $data = [
        'nombre' => $nombre,
        'apellidos' => $apellidos,
        'telefono' => $telefono,
        'usuario' => $usuario,
        // 'contrasena' => $hash,
        'nacionalidad' => $nacionalidad,
        'sexo' => $sexo
    ];

    $sql = "UPDATE agenda SET nombre = :nombre, apellido = :apellidos, telefono = :telefono, username = :usuario, 
    nacionalidad = :nacionalidad, sexo = :sexo WHERE id = $id";
    
    $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $stmt->execute($data);
    $ultimo_id = $conn->lastInsertId();

    $conn = null;

    }

    if (isset($ultimo_id)) {
    ?>

    <h2>Usuario editado correctamente</h2>
    <p>ID: <?php print $id ?></p>
    <p>Nombre: <?php isset($nombre) ? print $nombre : ""; ?></p>
    <p>Apellidos: <?php isset($apellidos) ? print $apellidos : ""; ?></p>
    <p>Teléfono: <?php isset($telefono) ? print $telefono : ""; ?></p>
    <p>Usuario: <?php isset($usuario) ? print $usuario : ""; ?></p>
    <p>Nacionalidad: <?php isset($nacionalidad) ? print $nacionalidad : "Sin contraseña"; ?></p>
    <p>Sexo: <?php isset($sexo) ? print $sexo : ""; ?></p>

    <?php }
    else {
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