<!-- Nama        : Sausan Berliana Arrizqi
     NIM         : 24060122130092
     Tanggal     : 22 September 2024
     Lab         : PBP B1 
     Deskripsi   : Untuk menambah data customer baru -->

<?php
session_start();
require_once('./lib/db_login.php');

if (!isset($_SESSION['username'])) {
  header('Location: ./login.php');
  exit;
}

if (isset($_POST["submit"])) {
  $valid = TRUE;

  // Validasi name
  $name = test_input($_POST['name']);
  if ($name == '') {
    $error_name = "Name is required";
    $valid = FALSE;
  } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
    $error_name = "Only letters and white space allowed";
    $valid = FALSE;
  }

  // Validasi address
  $address = test_input($_POST['address']);
  if ($address == '') {
    $error_address = "Address is required";
    $valid = FALSE;
  }

  // Validasi city
  $city = $_POST['city'];
  if ($city == '' || $city == 'none') {
    $error_city = "City is required";
    $valid = FALSE;
  }

  // Jika validasi berhasil, masukkan data ke database
  if ($valid) {
    // Gunakan prepared statement untuk keamanan
    $query = "INSERT INTO customers (name, address, city) VALUES (?, ?, ?)";
    if ($stmt = $db->prepare($query)) {
      $stmt->bind_param('sss', $name, $address, $city);

      if ($stmt->execute()) {
        // Jika berhasil, alihkan ke halaman view_customer.php
        $stmt->close();
        $db->close();
        header('Location: view_customer.php');
      } else {
        // Tampilkan error jika terjadi kesalahan
        die("Could not query the database: <br />" . $stmt->error);
      }
    } else {
      die("Error preparing the statement: <br />" . $db->error);
    }
  }
}
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-4">
  <div class="card-header">Add Customer Data</div>
  <div class="card-body">
    <form method="POST" autocomplete="on">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php if (isset($name)) echo $name; ?>">
        <div class="error text-danger mt-2"><?php if (isset($error_name)) echo $error_name; ?></div>
      </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <textarea class="form-control" name="address" id="address" rows="5"><?php if (isset($address)) echo $address; ?></textarea>
        <div class="error text-danger mt-2"><?php if (isset($error_address)) echo $error_address; ?></div>
      </div>
      <div class="form-group">
        <label for="city">City:</label>
        <select name="city" id="city" class="form-control" required>
          <option value="none" <?php if (!isset($city)) echo 'selected'; ?>>--Select a city--</option>
          <option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected'; ?>>Airport West</option>
          <option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected'; ?>>Box Hill</option>
          <option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected'; ?>>Yarraville</option>
        </select>
        <div class="error text-danger mt-2"><?php if (isset($error_city)) echo $error_city; ?></div>
      </div>
      <br>
      <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
      <a href="view.php" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>
<?php include('./footer.php') ?>
