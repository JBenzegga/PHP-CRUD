<?php
echo "Joaquin Ferrer Benzegga <br/>";
include('dbconnection.php');
$id = $_GET["id"];

$sql = "DELETE FROM agenda WHERE id = $id";
$stmt = $conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$stmt->execute();
$conn = null;
?>

<script>
    alert("Usuario <?=$id?> borrado correctamente")
    window.location.replace("list_user.php")
</script>