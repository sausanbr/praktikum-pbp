<!-- Nama        : Sausan Berliana Arrizqi
     NIM         : 24060122130092
     Tanggal     : 22 September 2024
     Lab         : PBP B1 
     Deskripsi   : Untuk menampilkan data customer -->

<?php
session_start();

if (!isset($_SESSION['username'])) {
  header('Location: ./login.php');
  exit;
}
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-5">
  <div class="card-header">Customers Data</div>
  <div class="card-body">
    <div class="mb-3 d-flex justify-content-between">
      <a href="add_customer.php" class="btn btn-primary">+ Add Customer Data</a>
      <a class="btn btn-danger" href="logout.php">Logout</a>
    </div>
    <table class="table table-striped">
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Address</th>
        <th>City</th>
        <th>Action</th>
      </tr>
      <?php
      require_once('./lib/db_login.php');

      $query = "SELECT * FROM customers ORDER BY customerid";
      $result = $db->query($query);
      if (!$result) {
        die("Could not query the database: <br />" . $db->error . '<br>Query: ' . $query);
      }

      $i = 1;
      while ($row = $result->fetch_object()) {
        echo '<tr>';
        echo '<td>' . $i . '</td>';
        echo '<td>' . $row->name . '</td>';
        echo '<td>' . $row->address . '</td>';
        echo '<td>' . $row->city . '</td>';
        echo '<td><a class="btn btn-warning btn-sm" href="edit_customer.php?id=' . $row->customerid . '">Edit</a>&nbsp;&nbsp;';
        echo '<a class="btn btn-danger btn-sm" href="confirm_delete_customer.php?id=' . $row->customerid . '">Delete</a></td>';
        echo '</tr>';
        $i++;
      }

      echo '</table>';
      echo '<br>';
      echo 'Total Rows = ' . $result->num_rows;

      $result->free();

      $db->close();
      ?>
  </div>
</div>
<?php include('./footer.php') ?>