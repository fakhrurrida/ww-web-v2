<?php 
include 'sqlconfig.php';

function alerta($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

if (isset($_POST['register'])) {
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["gambar"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
           $nama1 = $_POST['nama'];
            $nama = str_replace("'", "''", "$nama1");
            $harga = $_POST['price'];
            $deskripsi1 = $_POST['deskripsi'];
            $deskripsi = str_replace("'", "''", "$deskripsi1");
            $jumlah = $_POST['jumlah'];
            $check_registered = "SELECT * FROM user WHERE nama_cokelat='$nama'";
            $results = mysqli_query($db, $check_registered);
            if (!$results || mysqli_num_rows($results) == 0){
                $query = "INSERT INTO cokelat (nama_cokelat, total_amount, img_link, description, price)
                    VALUES ('$nama', '$jumlah', '$target_file', '$deskripsi', '$harga')";
                $results = mysqli_query($db, $query);
                header("location:../html/dashboard.php");
                alerta("The file ". htmlspecialchars( basename( $_FILES["gambar"]["name"])). " has been uploaded.");
                alerta("The product has successfully been added");
            }
            else{
                header("location:../html/add_new_chocolate.php");
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>