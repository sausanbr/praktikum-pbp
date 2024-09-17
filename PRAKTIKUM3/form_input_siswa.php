<!-- Nama       : Sausan Berliana Arrizqi  
     NIM        : 24060122130092
     Lab        : PBP B1  
     Tanggal    : 15 September 2024 
     Deskripsi  : Tugas 3 Pemrosesan Form (Method GET & POST)-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Siswa</title>
    <link rel="stylesheet" href="form_input_siswa.css">
    <script src="form_input_siswa.js"> </script>
</head>
<body>
    <div class="container">
        <h2>Form Input Siswa</h2>
        <?php
        $nis = $nama = $jenis_kelamin = $kelas = "";
        $ekstrakurikuler = [];
        $error_nis = $error_nama = $error_jenis_kelamin = $error_kelas = $error_ekstrakurikuler = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validasi NIS
            if (empty($_POST["nis"])) {
                $error_nis = "NIS harus diisi";
            } elseif (!preg_match("/^[0-9]{10}$/", $_POST["nis"])) {
                $error_nis = "NIS harus terdiri dari 10 digit angka";
            } else {
                $nis = $_POST["nis"];
            }

            // Validasi Nama
            if (empty($_POST["nama"])) {
                $error_nama = "Nama harus diisi";
            } else {
                $nama = $_POST["nama"];
            }

            // Validasi Jenis Kelamin
            if (empty($_POST["jenis_kelamin"])) {
                $error_jenis_kelamin = "Jenis kelamin harus dipilih";
            } else {
                $jenis_kelamin = $_POST["jenis_kelamin"];
            }

            // Validasi Kelas
            if (empty($_POST["kelas"])) {
                $error_kelas = "Kelas harus dipilih";
            } else {
                $kelas = $_POST["kelas"];
            }

            // Validasi Ekstrakurikuler jika kelas X atau XI
            if (isset($_POST["kelas"]) && ($_POST["kelas"] == "X" || $_POST["kelas"] == "XI")) {
                if (!isset($_POST["ekstrakurikuler"])) {
                    $error_ekstrakurikuler = "Pilih minimal 1 ekstrakurikuler";
                } elseif (count($_POST["ekstrakurikuler"]) > 3) {
                    $error_ekstrakurikuler = "Maksimal 3 ekstrakurikuler yang dapat dipilih";
                } else {
                    $ekstrakurikuler = $_POST["ekstrakurikuler"];
                }
            }
        }
        ?>

        <form method="POST" action="" autocomplete="off">
            <div class="form-group">
                <!-- NIS -->
                <label for="nis">NIS:</label>
                <input type="text" name="nis" value="<?php echo $nis; ?>">
                <span class="error"><?php echo $error_nis; ?></span>
            </div>

            <div class="form-group">
                <!-- Nama -->
                <label for="nama">Nama:</label>
                <input type="text" name="nama" value="<?php echo $nama; ?>">
                <span class="error"><?php echo $error_nama; ?></span>
            </div>

            <!-- Jenis Kelamin -->
            <div class="form-group">
                <label>Jenis Kelamin:</label>
                <input type="radio" name="jenis_kelamin" value="Pria" <?php if ($jenis_kelamin == "Pria") echo "checked"; ?>>Pria <br>
                <input type="radio" name="jenis_kelamin" value="Wanita" <?php if ($jenis_kelamin == "Wanita") echo "checked"; ?>>Wanita <br>
                <span class="error"><?php echo $error_jenis_kelamin; ?></span>
            </div>

            <div class="form-group">
                <!-- Kelas -->
                <label for="kelas">Kelas:</label>
                <select id="kelas" name="kelas" onchange="toggleEkstrakurikuler()">
                    <option value="">--Pilih Kelas--</option>
                    <option value="X" <?php if ($kelas == "X") echo "selected"; ?>>X</option>
                    <option value="XI" <?php if ($kelas == "XI") echo "selected"; ?>>XI</option>
                    <option value="XII" <?php if ($kelas == "XII") echo "selected"; ?>>XII</option>
                </select>
                <span class="error"><?php echo $error_kelas; ?></span>
            </div>

            <!-- Ekstrakurikuler (tampil jika kelas X atau XI) -->
            <div id="ekstrakurikuler-group" class="form-group ekstrakurikuler-group">
                <label>Ekstrakurikuler:</label>
                <input type="checkbox" name="ekstrakurikuler[]" value="Pramuka" <?php if (in_array("Pramuka", $ekstrakurikuler)) echo "checked"; ?>>Pramuka<br>
                <input type="checkbox" name="ekstrakurikuler[]" value="Seni Tari" <?php if (in_array("Seni Tari", $ekstrakurikuler)) echo "checked"; ?>>Seni Tari<br>
                <input type="checkbox" name="ekstrakurikuler[]" value="Sinematografi" <?php if (in_array("Sinematografi", $ekstrakurikuler)) echo "checked"; ?>>Sinematografi<br>
                <input type="checkbox" name="ekstrakurikuler[]" value="Basket" <?php if (in_array("Basket", $ekstrakurikuler)) echo "checked"; ?>>Basket<br>
                <span class="error"><?php echo $error_ekstrakurikuler; ?></span>
            </div>

            <!-- Submit dan Reset -->
            <input type="submit" class="btn btn-submit" value="Submit">
            <input type="button" class="btn btn-reset" value="Reset" onclick="resetFormAndRefresh()">        
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($error_nis) && empty($error_nama) 
        && empty($error_jenis_kelamin) && empty($error_kelas) && empty($error_ekstrakurikuler)) {
        echo '<div class="data-siswa-container">';
        echo '<div class="data-siswa">';
        echo "<h3>Data Siswa</h3>";
        echo '<div><span>NIS</span>: ' . $nis . '</div>';
        echo '<div><span>Nama</span>: ' . $nama . '</div>';
        echo '<div><span>Jenis Kelamin</span>: ' . $jenis_kelamin . '</div>';
        echo '<div><span>Kelas</span>: ' . $kelas . '</div>';
        if (!empty($ekstrakurikuler)) {
            echo '<div><span>Ekstrakurikuler:</span><ul class="ekstrakurikuler-list">';
            foreach ($ekstrakurikuler as $ekstrakurikuler_item) {
                echo "- ".$ekstrakurikuler_item."<br>";
            }
            echo "</ul></div>";
        }
        echo '</div>';
        echo '</div>';
    }
    ?>
</body>
</html>
