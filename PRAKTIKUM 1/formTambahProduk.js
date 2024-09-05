//  Nama       : Sausan Berliana Arrizqi  
//  NIM        : 24060122130092
//  Lab        : PBP B1  
//  Tanggal    : 2 September 2024 
//  Deskripsi  : Tugas 1 Form Tambah Data Produk (JavaScript)  

document.addEventListener('DOMContentLoaded', function () {
    const kategori = document.getElementById('kategori');
    const subkategori = document.getElementById('subkategori');
    const hargaGrosir = document.getElementById('hargaGrosir');
    const grosirYa = document.getElementById('grosirYa');
    const grosirTidak = document.getElementById('grosirTidak');
    const captchaText = document.getElementById('captchaText');
    const form = document.getElementById('formulir');

    // Pilih subkategori berdasarkan kategori
    kategori.addEventListener('change', function () { 
        subkategori.innerHTML = '<option value="">--Pilih Sub Kategori--</option>';
        if (this.value === 'Baju') {
            subkategori.innerHTML += '<option value="Baju Pria">Baju Pria</option>';
            subkategori.innerHTML += '<option value="Baju Wanita">Baju Wanita</option>';
            subkategori.innerHTML += '<option value="Baju Anak">Baju Anak</option>';
        } else if (this.value === 'Elektronik') {
            subkategori.innerHTML += '<option value="Mesin Cuci">Mesin Cuci</option>';
            subkategori.innerHTML += '<option value="Kulkas">Kulkas</option>';
            subkategori.innerHTML += '<option value="AC">AC</option>';
        } else if (this.value === 'Alat Tulis') {
            subkategori.innerHTML += '<option value="Kertas">Kertas</option>';
            subkategori.innerHTML += '<option value="Map">Map</option>';
            subkategori.innerHTML += '<option value="Pulpen">Pulpen</option>';
        }
    });

    grosirYa.addEventListener('change', function () {
        hargaGrosir.disabled = false;
    });

    grosirTidak.addEventListener('change', function () {
        hargaGrosir.disabled = true;
        hargaGrosir.value = '0';
    });

    // Generate Captcha
    function generateCaptcha() {
        let captcha = '';
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        for (let i = 0; i < 5; i++) {
            captcha += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        captchaText.textContent = captcha;
    }
    generateCaptcha();

    // Form Validation
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const namaProduk = document.getElementById('namaProduk').value.trim();
        const deskripsi = document.getElementById('deskripsi').value.trim();
        const harga = document.getElementById('harga').value.trim();
        const captchaInput = document.getElementById('captcha').value.trim();
        const selectedShipping = document.querySelectorAll('input[name="shipping"]:checked');

        if (namaProduk.length < 5 || namaProduk.length > 30) {
            alert('Nama Produk harus diisi dengan minimal 5 karakter dan maksimal 30 karakter.');
            return;
        }

        if (deskripsi.length < 5 || deskripsi.length > 100) {
            alert('Deskripsi harus diisi dengan minimal 5 karakter dan maksimal 100 karakter.');
            return;
        }

        if (!kategori.value) {
            alert('Kategori harus dipilih.');
            return;
        }

        if (!subkategori.value) {
            alert('Sub Kategori harus dipilih.');
            return;
        }

        if (!harga || isNaN(harga)) {
            alert('Harga Satuan harus diisi dengan nilai numerik.');
            return;
        }

        if (grosirYa.checked && (!hargaGrosir.value || isNaN(hargaGrosir.value))) {
            alert('Harga Grosir harus diisi dengan nilai numerik.');
            return;
        }

        if (selectedShipping.length < 3) {
            alert('Minimal jasa kirim yang dipilih adalah 3.');
            return;
        }

        if (captchaInput !== captchaText.textContent) {
            alert('Captcha tidak sesuai.');
            return;
        }

        alert('Form berhasil disubmit!');
        form.reset(); // Reset form 
        generateCaptcha(); // Generate captcha baru setelah direset
    });
});
