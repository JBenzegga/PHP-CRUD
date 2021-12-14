<?php
echo "Joaquin Ferrer Benzegga <br/>";
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
    <title>Ver usuario - CRUD Joaquín</title>
</head>
<body>
    <header class="header">
        <h1><?php print $user_view[0]["nombre"] ?> <?php print $user_view[0]["apellido"] ?></h1>
    </header>
    <main>
        <section class="main__imagen">
        <form action="subida.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="100000">
            <img src="subidas/<?=$user_view[0]["foto"]?>" alt="">
        </form>
        </section>
        <section class="main__info">
            <p>ID: <?php print $user_view[0]["id"] ?></p>
            <p>Teléfono: <?php print $user_view[0]["telefono"] ?></p>
            <p>Usuario: <?php print $user_view[0]["username"] ?></p>
            <p>Nacionalidad: <?php print $user_view[0]["nacionalidad"] ?></p>
            <p>Sexo: <?php print $user_view[0]["sexo"] ?></p>
        </section>

    </main>
    <br>
    <br>
    <button class="btn btn-primary" id="volver">Volver</button>
    <script>
        document.getElementById("volver").onclick = function () {
            window.location.replace("list_user.php")
        }
    </script>
</body>
</html>