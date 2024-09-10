<!-- Nama       : Sausan Berliana Arrizqi  
     NIM        : 24060122130092
     Lab        : PBP B1  
     Tanggal    : 2 September 2024 
     Deskripsi  : Tugas 1 Form Tambah Data Produk (JavaScript) -->

<?php
function print_identitas($nama, $nim, $lab, $date, $prak) {
    echo 'Nama: ' . $nama . '<br />';
    echo 'NIM: ' . $nim . '<br />';
    echo 'Lab: ' . $lab . '<br />';
    echo 'Tanggal: ' . $date . '<br />';
    echo 'Praktikum: ' . $prak . '<br /><br />';
}
print_identitas('Sausan Berliana Arrizqi', '24060122130092', 'PBP B1', '3 September 2024','2');

// Menghitung rata-rata nilai mahasiswa
function hitung_rata($array) {
    $jumlah = array_sum($array);
    $banyak = count($array);
    return $jumlah / $banyak;
}

// Menampilkan nilai dan rata-rata mahasiswa
function print_mhs($array_mhs) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr>
        <th>Nama</th>
        <th>Nilai 1</th>
        <th>Nilai 2</th>
        <th>Nilai 3</th>
        <th>Rata2</th>
        </tr>";
    
    foreach ($array_mhs as $nama => $nilai) {
        $rata = hitung_rata($nilai);
        echo "<tr>";
        echo "<td>$nama</td>";
        echo "<td>{$nilai[0]}</td>";
        echo "<td>{$nilai[1]}</td>";
        echo "<td>{$nilai[2]}</td>";
        echo "<td>$rata</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}

// Array Nilai Mahasiswa
$array_mhs = array(
    'Abdul' => array(89, 90, 54),
    'Budi' => array(98, 65, 74),
    'Nina' => array(67, 56, 84)
);

print_mhs($array_mhs);
?>
