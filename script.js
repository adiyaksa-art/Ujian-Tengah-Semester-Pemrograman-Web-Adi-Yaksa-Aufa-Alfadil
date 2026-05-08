function validasiForm() {
    const judul = document.getElementById('judul_buku').value;
    const pengarang = document.getElementById('nama_pengarang').value;
    const tahun = document.getElementById('tahun_terbit').value;
    const foto = document.getElementById('foto');
    const id = document.querySelector('input[name="id"]').value;

    if (judul.trim() === "" || pengarang.trim() === "" || tahun.trim() === "") {
        alert("Semua field teks harus diisi!");
        return false;
    }

    if (id === "" && foto.files.length === 0) {
        alert("Foto sampul wajib diunggah!");
        return false;
    }

    if (foto.files.length > 0) {
        const file = foto.files[0];
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            alert("Format file harus JPG, JPEG, atau PNG!");
            foto.value = '';
            return false;
        }
        if (file.size > 2 * 1024 * 1024) { 
            alert("Ukuran file maksimal 2MB!");
            foto.value = '';
            return false;
        }
    }
    return true;
}

function konfirmasiHapus() {
    return confirm('Apakah Anda yakin ingin menghapus buku ini?');
}