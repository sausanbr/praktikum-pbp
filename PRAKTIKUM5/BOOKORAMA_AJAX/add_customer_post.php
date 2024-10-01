<!-- Nama        : Sausan Berliana Arrizqi
     NIM         : 24060122130092
     Tanggal     : 24 September 2024
     Lab         : PBP B1 -->
     
<?php
    require_once('./lib/db_login.php');

    $name = $db->real_escape_string($_POST['name']);
    $address = $db->real_escape_string($_POST['address']);
    $city = $db->real_escape_string($_POST['city']);

    // Assign a query
    $query = "INSERT INTO customers (name, address, city) VALUES ('" . $name . "', '" . $address . "', '" . $city . "')";
    $result = $db->query($query);

    if (!$result) {
        // TODO 1: Jika error, tulislah response yang sesuai
        echo "<div class='alert-danger alert-dismissible'><strong>Error!!</strong> Could not query the database.<br>";
        $db->error. '<br>query: ' .$query;
        echo "</div>";
    } else {
        // TODO 2: Jika sukses, tulislah response yang sesuai
        echo "<div class='alert-success alert-dismissible'><strong>success!!</strong> data has been added.<br>
        Name = ".$_POST["name"]." <br>
        Address = ".$_POST["address"]." <br>
        City = ".$_POST["city"]." <br>
        </div>";
    }

    // Close DB Connection
    $db->close();
?>