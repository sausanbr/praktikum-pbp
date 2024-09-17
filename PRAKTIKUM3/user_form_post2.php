<head>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST['submit'])){
        //validasi nama: tidak boleh kosong hanya dapat berisi huruf dan spasi
        $nama = test_input($_POST['nama']);
        if (empty($nama)){
            $error_nama = "Nama harus diisi";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
            $error_nama = "Nama hanya dapat berisi huruf dan spasi";
        }

        //validasi email: tidak boleh kosong, format harus benar
        $email = test_input($_POST['email']);
        if (empty($email)){
            $error_email = "Email harus diisi";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_email = "Format email tidak benar";
        }

        //validasi alamat: tidak boleh kosong
        $alamat = test_input($_POST['alamat']);
        if (empty($alamat)){
            $error_alamat = "Alamat harus diisi";
        }

        //validasi jenis kelamin: tidak boleh kosong
        if (!isset($_POST['jenis_kelamin'])){
            $error_jenis_kelamin = "Jenis kelamin harus diisi";
        } else {
            $jenis_kelamin = $_POST['jenis_kelamin'];
        }

        //validasi kota: tidak boleh kosong
        $kota = $_POST['kota'];
        if (empty($kota)){
            $error_kota = "Kota harus diisi";
        }

        //validasi minat: tidak boleh kosong
        if (!isset($_POST['minat'])){
            $error_minat = "Peminatan harus dipilih";
        } else {
            $minat = $_POST['minat'];
        }
    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <form method="POST" autocomplete="on" action="">
        <!-- ==== NAMA ====  -->
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" maxlength="50" 
                value="<?php if(isset($nama)) {echo $nama;} ?>">
            <div class="error"><?php if (isset($error_nama)) echo $error_nama;?></div>
        </div>

        <!-- ==== EMAIL ====  -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email"
                value="<?php if (isset($email)) echo $email; ?>">
            <div class="error"><?php if (isset($error_email)) echo $error_email;?></div>
        </div>

        <!-- ==== ALAMAT ====  -->
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea class="form-control" id="alamat" name="alamat">
                <?php if (isset($alamat)) echo $alamat; ?></textarea>
            <div class="error"><?php if (isset($error_alamat)) echo $error_alamat;?></div>
        </div>


        <!-- ==== KOTA/KABUPATEN ====  -->
        <div class="form-group">
            <label for="kota">Kota/Kabupaten:</label>
            <select id="kota" name="kota" class="form-control">
                <option value="">Pilih Kota</option>
                <option value="Semarang"
                    <?php if (isset($kota) && $kota == "Semarang") echo 'selected="true"';?>> Semarang
                </option>
                <option value="Jakarta"
                    <?php if (isset($kota) && $kota == "Jakarta") echo 'selected="true"';?>> Jakarta
                </option>
                <option value="Bandung"
                    <?php if (isset($kota) && $kota == "Bandung") echo 'selected="true"';?>> Bandung
                </option>
                <option value="Surabaya"
                    <?php if (isset($kota) && $kota == "Surabaya") echo 'selected="true"';?>> Surabaya
                </option>
            </select>
            <div class="error"><?php if (isset($error_kota)) echo $error_kota;?></div>
        </div>

         <!-- ==== JENIS KELAMIN ====  -->
        <label>Jenis Kelamin:</label>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria"
                    <?php if (isset($jenis_kelamin) && $jenis_kelamin == "pria") echo 'checked="checked"'; ?>>Pria
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita"                    
                    <?php if (isset($jenis_kelamin) && $jenis_kelamin == "wanita") echo 'checked="checked"'; ?>>Wanita
            </label>
        </div>
        <div class="error"><?php if (isset($error_jenis_kelamin)) echo $error_jenis_kelamin;?></div>
        <br>

        <!-- ==== PEMINATAN ====  -->
        <label>Peminatan:</label>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="minat[]" value="coding"
                <?php if (isset($minat) && in_array('coding', $minat)) echo 'checked'; ?>>Coding
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="minat[]" value="ux_design"                
                <?php if (isset($minat) && in_array('ux_design', $minat)) echo 'checked'; ?>>UX Design

            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="minat[]" value="data_science"
                <?php if (isset($minat) && in_array('data_science', $minat)) echo 'checked'; ?>>Data Science
            </label>
        </div>
        <div class="error"><?php if (isset($error_minat)) echo $error_minat;?></div>
        <br>

        <!-- SUBMIT BUTTON -->
        <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
    </form>

    <?php
    if (isset($_POST["submit"])){
        echo "<h3>Your Input:</h3>";
        echo 'Nama = '.$_POST['nama'].'<br />';
        echo 'Email = '.$_POST['email'].'<br />';
        echo 'Kota = '.$_POST['kota'].'<br />';
        echo 'Jenis Kelamin = '.$_POST['jenis_kelamin'].'<br />';
        
        echo 'Peminatan yang dipilih: <br />';
        foreach ($_POST['minat'] as $minat_item){
            echo $minat_item.'<br />';
        }
    }
    ?>
</body>
