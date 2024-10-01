<!-- Nama        : Sausan Berliana Arrizqi
     NIM         : 24060122130092
     Tanggal     : 22 September 2024
     Lab         : PBP B1 
     Deskripsi   : Untuk melakukan logout -->

<?php 
// TODO 1: Inisialisasi session
session_start();
if(isset($_SESSION['username'])){
    unset($_SESSION['username']);
    session_destroy();
}
header('Location: login.php');
?>