<!-- Nama        : Sausan Berliana Arrizqi
     NIM         : 24060122130092
     Tanggal     : 22 September 2024
     Lab         : PBP B1 
     Deskripsi   : Untuk melakukan login ke halaman customer -->

<?php
// TODO 1: Buat sebuah sesi baru
session_start();
// TODO 2 : Lakukan koneksi dengan database
require_once('/Applications/XAMPP/xamppfiles/htdocs/PRAKTIKUM4/BOOKORAMA/lib/db_login.php') ;

// Memeriksa apakah user sudah submit form
if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Memeriksa validasi email
    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_email = 'Email is required';
        $valid = FALSE;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = 'Invalid email format';
        $valid = FALSE;
    }

    // Memeriksa validasi password
    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_password = 'Password is required';
        $valid = FALSE;
    }

    
    // Memeriksa validasi
    if ($valid) {
        // TODO 3: Buatlah query untuk melakukan verifikasi terhadap kredensial yang diberikan
        $query = "SELECT * FROM admin WHERE email ='".$email."' AND password='".($password)."' ";
        // TODO 4: Eksekusi query
        $result = $db->query ($query) ;
        if(!$result){
            die("Could not query the database: <br />". $db->error) ;
        } else{
            if($result->num_rows > 0){
                $_SESSION['username'] = $email;
                $id = $_POST['email'];
                header('Location: view_customer.php') ;
                exit ;
            }else{
                echo '<span class="error"> Combination of username and password are not correct.</span>';
            }
        }
        
        // TODO 5: Tutup koneksi dengan database
        $db->close() ;
    }
}
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Login Form</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($email)) echo $email; ?>">
                <div class="error"><?php if (isset($error_email)) echo $error_email ?></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="">
                <div class="error"><?php if (isset($error_password)) echo $error_password ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>