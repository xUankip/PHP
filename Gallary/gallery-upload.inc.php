<?php
global $conn;
if (isset($_POST['submit'])){

    $newFileName = $_POST['filename'];
    if (empty($newFileName)){
        $newFileName="gallery";
    }else{
        $newFileName = strtolower(str_replace("","-", $newFileName));
    }
    $imageTitle = $_POST['filetitle'];
    $imageDesc = $_POST['filedesc'];

    $file = $_FILES['file'];

    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    if (in_array($fileActualExt, $allowed)){
        if ($fileError === 0){
            if ($fileSize<7000000){
                $imageFullName = $newFileName . "." . uniqid("",true ). "." .$fileActualExt;
                $fileDestination = "../img/gallery/". $imageFullName;

                include_once  "dbh.inc.php";
                if (empty($imageTitle) || empty($imageDesc)){
                    header("location :../gallery.php?upload=empty");
                    exit();
                } else{
                    $sql = "SELECT * FROM gallery;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)){
                        echo "SQL statement failed";
                    }else{
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $rowCount = mysqli_num_rows($result);
                        $setImageOder = $rowCount +1;

                        $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) Values (?,?,?,?)";
                        if (!mysqli_stmt_prepare($stmt, $sql)){
                            echo "SQL Statement failed!";
                        }else {
                            mysqli_stmt_bind_param($stmt, "ssss", $imageTitle,$imageDesc, $imageFullName, $setImageOder);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTempName, $fileDestination);

                            header('location: ../img/gallery.php?upload=success');
                        }
                    }
                }
            }else{
                echo "FIle size is too big!!";
                exit();
            }
        }else{
            echo "ERROR";
            exit();
        }
    }else{
        echo "upload a Proper file type";
        exit();
    }
}

//global $conn;
//if (isset($_POST['submit'])) {
//
//    $newFileName = $_POST['filename'];
//    if (empty($newFileName)) {
//        $newFileName = "gallery";
//    } else {
//        $newFileName = strtolower(str_replace("", "-", $newFileName));
//    }
//    $imageTitle = $_POST['filetitle'];
//    $imageDesc = $_POST['filedesc'];
//
//    $file = $_FILES['file'];
//
//    $fileName = $file["name"];
//    $fileType = $file["type"];
//    $fileTempName = $file["tmp_name"];
//    $fileError = $file["error"];
//    $fileSize = $file["size"];
//
//    $fileExt = explode(".", $fileName);
//    $fileActualExt = strtolower(end($fileExt));
//
//    $allowed = array("jpg", "jpeg", "png");
//
//    if (in_array($fileActualExt, $allowed)) {
//        if ($fileError === 0) {
//            if ($fileSize < 7000000) {
//                $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
//                $fileDestination = "../img/gallery/" . $imageFullName;
//
//                // Create the directory if it doesn't exist
//                if (!file_exists("../img/gallery/")) {
//                    mkdir("../img/gallery/");
//                }
//
//                include_once "dbh.inc.php";
//                if (empty($imageTitle) || empty($imageDesc)) {
//                    header("location: ../gallery.php?upload=empty");
//                    exit();
//                } else {
//                    $sql = "SELECT * FROM gallery;";
//                    $stmt = mysqli_stmt_init($conn);
//                    if (!mysqli_stmt_prepare($stmt, $sql)) {
//                        echo "SQL statement failed";
//                    } else {
//                        mysqli_stmt_execute($stmt);
//                        $result = mysqli_stmt_get_result($stmt);
//                        $rowCount = mysqli_num_rows($result);
//                        $setImageOder = $rowCount + 1;
//
//                        $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery) Values (?,?,?,?)";
//                        if (!mysqli_stmt_prepare($stmt, $sql)) {
//                            echo "SQL Statement failed!";
//                        } else {
//                            mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullName, $setImageOder);
//                            mysqli_stmt_execute($stmt);
//
//                            move_uploaded_file($fileTempName, $fileDestination);
//
//                            header('location: ../img/gallery.php?upload=success');
//                        }
//                    }
//                }
//            } else {
//                echo "File size is too big!!";
//                exit();
//            }
//        } else {
//            echo "ERROR";
//            exit();
//        }
//    } else {
//        echo "Upload a proper file type";
//        exit();
//    }
//}

