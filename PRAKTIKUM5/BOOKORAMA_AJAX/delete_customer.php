<!-- Nama        : Sausan Berliana Arrizqi
     NIM         : 24060122130092
     Tanggal     : 22 September 2024
     Lab         : PBP B1 
     Deskripsi   : Untuk menghapus data customer baru -->

<?php
session_start();
require_once('./lib/db_login.php');

if (!isset($_SESSION['username'])) {
  header('Location: ./login.php');
  exit;
}

$id = $_GET['id'];

$query = "DELETE FROM customers WHERE customerid = '" . $id . "'";
  $result = $db->query($query);
  if (!$result) {
    die("Could not query the database: <br />" . $db->error);
  } else {
    $db->close();
    header('Location: view_customer.php');
  }
?>