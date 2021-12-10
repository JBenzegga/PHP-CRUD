<?php
    if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {
        $fileTmpPath = $_FILES["uploadedFile"]["tmp_name"];
        $fileName = $_FILES["uploadedFile"]["name"];
        $fileSize = $_FILES["uploadedFile"]["size"];
        $fileType = $_FILES["uploadedFile"]["type"];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        move_uploaded_file($fileTmpPath, "subidas/".$fileName);

        echo $fileName;
        echo '<img src="subidas/' . $fileName . '">';
    }
?>