<?php
session_start();
require_once 'database/function.php';

$id = $_GET['id'];

if (hapusFoto($id) > 0) {
    echo "<script>
    alert('Posting Berhasil Dihapus');
    document.location.href = 'explore.php'; 
    </script>";
} else {
    echo "<script>
    alert('NULL');
    document.location.href = 'explore.php'; 
    </script>";
}
