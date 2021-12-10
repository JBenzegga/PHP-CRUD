<?php
    include('dbconnection.php');
    $listaUsuarios = "SELECT * FROM agenda";
    $stmt = $conn->prepare($listaUsuarios);
    $stmt->execute();
    $listaUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <title>Listar usuarios - CRUD Joaquín</title>
    <style>
        th, td {
            border: 1px solid black;
            margin
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <script>
        function crearuser() {
            window.location.replace("registro.php");
        }
    </script>
    <button onclick=crearuser() class="btn btn-primary">Crear usuario</button>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Username</th>
            <th>Nacionalidad</th>
            <th>Sexo</th>
            <th>Fecha de modificación</th>
            <th>Edición</th>
        </tr>
        <?php
        foreach ($listaUsuarios as $usuario) {
            echo "<tr>";
            foreach ($usuario as $column => $data) {
                if ($column <> "password") {
                    echo "<td>$data</td>";
                }
            } ?>
            <td><a href="ver_user.php?id=<?=$usuario["id"]?>">👁</a><a href="editar_user.php?id=<?=$usuario["id"]?>">✏</a><a href="borrar_user.php?id=<?=$usuario["id"]?>">✖</a></td>
            <?php
            echo "</tr>";
        }
        ?>

        </table>
</body>
</html>