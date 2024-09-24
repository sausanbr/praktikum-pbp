<!-- Nama        : Sausan Berliana Arrizqi
     NIM         : 24060122130092
     Tanggal     : 22 September 2024
     Lab         : PBP B1 
     Deskripsi   : Untuk menampilkan list data customer dalam html -->

<div class="card mt-5">
    <div class="card-header">Customers Data</div>
    <div class="card-body">
        <a href="add_customer.php" class="btn btn-primary mb-4">+ Add Customer Data</a>
        <br>
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Action</th>
            </tr>
            <?php
            // Hubungkan dengan file db_login.php
            require_once('lib/db_login.php');

            // Query ke database
            $query  = "SELECT * FROM customers ORDER BY customerid";
            $result = $db->query($query);
            if (!$result) {
                die ("Could not query the database: <br />". $db->error ."<br />Query: ". $query);
            }

            // Parsing data dari database ke halaman HTML
            $i = 1;
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>'. $i .'</td>';
                echo '<td>'. htmlspecialchars($row->name) .'</td>';
                echo '<td>'. htmlspecialchars($row->address) .'</td>';
                echo '<td>'. htmlspecialchars($row->city) .'</td>';
                echo '<td>
                    <a class="btn btn-warning btn-sm" href="edit_customer.php?id='. $row->customerid .'">Edit</a>&nbsp;&nbsp;
                    <a class="btn btn-danger btn-sm" href="delete_customer.php?id='. $row->customerid .'">Delete</a>
                    </td>';
                echo '</tr>';
                $i++;
            }

            echo '</table>';
            echo '<br />';
            echo 'Total Rows = '. $result->num_rows;

            // Dealokasi variabel $result
            $result->free();

            // Tutup koneksi database
            $db->close();
            ?>
    </div>
</div>
