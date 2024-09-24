<!-- Nama        : Sausan Berliana Arrizqi
     NIM         : 24060122130092
     Tanggal     : 22 September 2024
     Lab         : PBP B1 
     Deskripsi   : Untuk menghapus cart -->

<?php
session_start();

if (isset($_SESSION['cart'])) {
  unset($_SESSION['cart']);
}

header('Location: show_cart.php');