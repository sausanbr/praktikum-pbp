<!-- Nama        : Sausan Berliana Arrizqi
     NIM         : 24060122130092
     Tanggal     : 22 September 2024
     Lab         : PBP B1 
     Deskripsi   : Untuk melakukan login ke shopping cart -->

<?php
// TODO 1: Buat sebuah sesi baru
session_start();

// TODO 2: Lakukan koneksi dengan database
require_once('/Applications/XAMPP/xamppfiles/htdocs/PRAKTIKUM4/books/lib/db_login.php');

// Inisialisasi error message
$error_message = '';

// Memeriksa apakah user sudah submit form
if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Memeriksa validasi email
    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_message = 'Email is required';
        $valid = FALSE;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Invalid email format';
        $valid = FALSE;
    }

    // Memeriksa validasi password
    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_message = 'Password is required';
        $valid = FALSE;
    }

    // Memeriksa validasi
    if ($valid) {
        // TODO 3: Buatlah query untuk melakukan verifikasi terhadap kredensial yang diberikan
        $query = "SELECT * FROM admin WHERE email ='$email' AND password='$password'";
        
        // TODO 4: Eksekusi query
        $result = $db->query($query);
        
        if (!$result) {
            die("Could not query the database: <br />" . $db->error);
        } else {
            if ($result->num_rows > 0) {
                $_SESSION['username'] = $email;
                header('Location: show_cart.php');
                exit;
            } else {
                $error_message = 'Combination of email and password are not correct.';
            }
        }
        
        // TODO 5: Tutup koneksi dengan database
        $db->close();
    }
}
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
  <div class="card-header">Login</div>
  <div class="card-body">
    <form method="POST" action="login.php">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" required>
      </div>
      <br>
      <?php if ($error_message != ''): ?>
        <div class="text-danger"><?php echo $error_message; ?></div>
      <?php endif; ?>
      <button type="submit" class="btn btn-primary" name="submit">Login</button>
    </form>
  </div>
</div>
<?php include('./footer.php') ?>
