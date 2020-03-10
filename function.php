<?php

//                        " K O N E K S I - K E - D A T A B A S E "
require_once 'database/koneksi.php';

//                    " E D I T - P R O F I L E "
function EditProfile($data) {

    global $koneksi;
$id = $data["id"];
$name = $data["nama"];
$username = $data["username"];
$website = $data["website"];
$bio = $data["bio"];
$email = $data["email"];
$number_phone = $data["number_phone"];
$gender = $data["gender"];

$query = "UPDATE profil SET nama = '$name', username = '$username'  , website = '$website', bio = '$bio', email = '$email',number_phone = '$number_phone', gender = '$gender'  WHERE id = $id  ";
mysqli_query($koneksi, $query);
return mysqli_affected_rows($koneksi);
}

//                        " M E N D A P A T K A N - H A S I L - Q U E R Y "
function query($query) {

    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] =  $row;
        }
    return $rows;
}



//                        " U P L O A D - F O T O "
function uploadFoto($data) {

    global $koneksi;
    $caption = htmlspecialchars($data['caption']);
    $ekstensi_allowed = array('png', 'jpg', 'jpeg', 'svg');
    $gambar = $_FILES['gambar']['name'];
    $x = explode('.', $gambar);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['gambar']['size'];
    $file_tmp = $_FILES['gambar']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_allowed) === true) {
            if ($ukuran < 1044070) {
                move_uploaded_file($file_tmp, 'img/' . $gambar);
                $query = "INSERT INTO photo VALUES('','$gambar','$caption')";
                mysqli_query($koneksi, $query);
            } else {
                echo '<script>File is Very Big</script>';
            }
        } else {
            echo '<script>Your Format be Denied!</script>';
    }
}



//                     " S E A R C H - C A P T I O N "
function cariCaption($cari) {

    $query = "SELECT * FROM photo WHERE caption LIKE '%$cari%' ";
    return query($query);
}



//                     " H A P U S - F O T O "
function hapusFoto($id) {

    global $koneksi;
mysqli_query($koneksi, "DELETE FROM photo WHERE id = $id");
return mysqli_affected_rows($koneksi);
}

