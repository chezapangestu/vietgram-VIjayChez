<?php

require_once 'koneksi.php';

function signup($data)
{
        global $koneksi;
    $username = strtolower(stripslashes($data["username"]));
    $pass = mysqli_real_escape_string($koneksi, $data['password']);
    $email = htmlspecialchars($data["email"]);
    $result = mysqli_query($koneksi, "SELECT username WHERE username = '$username' ");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>username already exist! </script>";
        return false;
    }
    // enk pss
    $pass = password_hash($pass, PASSWORD_DEFAULT);

    if (!empty(trim($username)) && !empty(trim($pass))) {
        mysqli_query($koneksi, "INSERT INTO user VALUES('','$username','$pass','$email')");
    }

    return mysqli_affected_rows($koneksi);
}
