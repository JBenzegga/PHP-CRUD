<?php
        $fileTmpPath = $_FILES["foto"]["tmp_name"];
        $fileName = $_FILES["foto"]["name"];
        $fileSize = $_FILES["foto"]["size"];
        $fileType = $_FILES["foto"]["type"];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
            move_uploaded_file($fileTmpPath, "subidas/".$foto);
            echo '<img src="subidas/' . $foto . '">';
?>