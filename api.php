<?php
if (isset($_POST['name']) && isset($_POST['link']) && isset($_FILES['img']) && isset($_FILES['file'])) {
    $out = file_get_contents("input.json");
    $dec = json_decode($out, true);

    $maxId = 0;
    foreach ($dec as $item) {
        if ($item['id'] > $maxId) {
            $maxId = $item['id'];
        }
    }

    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["img"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $uploadOk = 1;
    
    $filedir = "files/";
    $tarFile = $filedir . basename($_FILES["file"]["name"]);
    $FileType = strtolower(pathinfo($tarfile, PATHINFO_EXTENSION));
    $upfile = 1;

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    if (isset($_POST["submit"])) {
        $checkfile = getimagesize($_FILES["file"]["tmp_name"]);
        if ($checkfile !== false) {
            echo "File - " . $checkfile["mime"] . ".";
            $upfile = 1;
        } else {
            echo "File is not.";
            $upfile = 0;
        }
    }

    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    if ($_FILES["img"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    
    if (file_exists($tarFile)) {
        echo "Sorry, file already exists.";
        $upfile = 0;
    }
    
    if ($_FILES["file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $upfile = 0;
    }

    if ($FileType != "zip") {
        echo "Sorry, only zip files are allowed.";
        $upfile = 0;
    }
    
    if ($uploadOk == 0 && $upfile == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile) && move_uploaded_file($_FILES["file"]["tmp_name"], $tarFile)) {
            echo "The file ". htmlspecialchars(basename($_FILES["img"]["name"])). "uploaded.";
            echo "The file ". htmlspecialchars(basename($_FILES["file"]["name"])). "uploaded.";
            header("Location: /index.php");

            $data = [
                "id" => $maxId + 1,
                "name" => $_POST['name'],
                "pick" => $targetFile,
                "file" => $tarFile,
                "link" => $_POST['link'],
                "caption" => $_POST['caption'],
                "date" => date('Y-m-d'),
                "time" => date('H:i:s')
            ];

            $dec[] = $data;
            usort($dec, function ($a, $b) {
                return $a['id'] <=> $b['id'];
            });

            $new = json_encode($dec, JSON_PRETTY_PRINT);
            file_put_contents("input.json", $new);

            echo "ok";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
