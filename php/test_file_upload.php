<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <title>Test file upload</title>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="imagen">Sube una imagen...</label>
        <input type="file" class="form-control" name="uploadedFile" id="uploadedFile" required>
        <button type="submit" class="btn btn-info" name="uploadBtn" value="Upload">Upload</button>
    </form>
</body>
</html>