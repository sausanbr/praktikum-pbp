<!-- Nama        : Sausan Berliana Arrizqi
     NIM         : 24060122130092
     Tanggal     : 22 September 2024
     Lab         : PBP B1 -->

<?php 
$db_host='localhost';
$db_database='bookorama';
$db_username='root';
$db_password='123';

$db = new mysqli($db_host,$db_username,$db_password,$db_database);
if($db->connect_errno){
    die("Could not connect to the database: <br/>". $db->connect_error);
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>