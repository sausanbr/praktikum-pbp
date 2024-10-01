<!-- Nama        : Sausan Berliana Arrizqi
     NIM         : 24060122130092
     Tanggal     : 22 September 2024
     Lab         : PBP B1 
     Deskripsi   : Untuk konfirmasi menghapus data customer -->

<?php
session_start();

require_once('./lib/db_login.php');

if (!isset($_SESSION['username'])) {
  header('Location: ./login.php');
  exit;
}

$id = $_GET['id'];

$query = 'SELECT * FROM customers WHERE customerid="' . $id . '"';
$result = $db->query($query);

if (!$result) {
  die("Could not query the database: <br />" . $db->error . '<br>Query: ' . $query);
} else {
  while ($row = $result->fetch_object()) {
    $id = $row->customerid;
    $name = $row->name;
    $address = $row->address;
    $city = $row->city;
  }
}
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-4">
  <div class="card-header">Delete User Confirmation</div>
  <div class="card-body">
    <div>
      <h5>Are you sure want to delete this user?</h5>
      <label>Name: <?= $name; ?></label><br>
      <label>Address: <?= $address; ?></label><br>
      <label>City: <?= $city; ?></label><br>
    </div>
    <div class="mt-3">
      <a class="btn btn-danger mb-4" href=<?php echo 'delete_customer.php?id=' . $id ?>>Yes</a>
      <a class="btn btn-primary mb-4" href="view_customer.php">Back</a>
    </div>
  </div>
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>