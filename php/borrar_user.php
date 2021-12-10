<?php
    include('dbconnection.php');
    $id = $_GET["id"];
    $sql = "SELECT * FROM agenda WHERE id = :identificador";
    $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $stmt->execute(array(':identificador' => $id));
    $user_view = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <title>Borrar usuario - CRUD Joaquín</title>
</head>
<body>

    <h2>Usuario seleccionado</h2>
    <p>ID: <?php print $user_view[0]["id"] ?></p>
    <p>Nombre: <?php print $user_view[0]["nombre"] ?></p>
    <p>Apellidos: <?php print $user_view[0]["apellido"] ?></p>
    <p>Teléfono: <?php print $user_view[0]["telefono"] ?></p>
    <p>Usuario: <?php print $user_view[0]["username"] ?></p>
    <p>Nacionalidad: <?php print $user_view[0]["nacionalidad"] ?></p>
    <p>Sexo: <?php print $user_view[0]["sexo"] ?></p>

    <?php
    $sql = "DELETE FROM agenda WHERE id = $id";
    $stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    // $stmt->execute();
    $conn = null;
    ?>

    <h1 class="text-danger">Asegúrese que es el usuario correcto</h1>
    <button class="btn btn-danger" onclick=borrar()>Borrar</button>
    <br>
    <br>
    <button class="btn btn-primary" id="volver">Volver</button>
    <script>
        document.getElementById("volver").onclick = function () {
            window.location.replace("listar_user.php")
        }
    </script>

    <script>
        function borrar() {
            window.location.replace("borrar_user_confirmado.php?id=<?=$id?>")
        }
    </script>


</body>
</html>