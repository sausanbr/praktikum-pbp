// Nama       : Sausan Berliana Arrizqi  
// NIM        : 24060122130092
// Lab        : PBP B1  
// Tanggal    : 15 September 2024 
// Deskripsi  : Tugas 3 Pemrosesan Form (Method GET & POST)

function resetFormAndRefresh() {
    document.querySelector('form').reset();  
    window.location.reload();  
}

function showAlert() {
    alert("Formulir telah terkirim");
}

function toggleEkstrakurikuler() {
    const kelasSelect = document.getElementById('kelas');
    const ekstrakurikulerGroup = document.getElementById('ekstrakurikuler-group');
    const checkboxes = ekstrakurikulerGroup.querySelectorAll('input[type="checkbox"]');

    if (kelasSelect.value === "X" || kelasSelect.value === "XI") { 
        // Checkbox hanya aktif jika kelas X atau XI
        ekstrakurikulerGroup.style.display = 'block';
        checkboxes.forEach(checkbox => checkbox.disabled = false);
    } else if (kelasSelect.value === "XII") {
        // Checkbox tidak tampil saat klik kelas XII
        ekstrakurikulerGroup.style.display = 'none';
        checkboxes.forEach(checkbox => checkbox.disabled = true);
    } else {
        // Tidak tampil jika tidak ada kelas yang dipilih
        ekstrakurikulerGroup.style.display = 'none';
    }
}

window.onload = function() {
    toggleEkstrakurikuler(); 
};
