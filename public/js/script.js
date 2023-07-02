$(function () {
    // cari class dengan nama 'tombolTambahData' ketika diklick ubah isi tag dengan id 'judulModal' menjadi 'Tambah Data Mahasiswa'
    $('.tombolTambahData').on('click', function () {
        $('#judulModal').html('Tambah Data Mahasiswa')
        // cari tag button dengan tipe submit pada class 'modal-footer' kemudian ubah isinya menjadi 'Tambah Data'
        $('.modal-footer button[type=submit]').html('Tambah Data')
        $('.modal-content form').attr('action', 'http://localhost/wpu_mvc/public/mahasiswa/tambah')
    })

    $('.tampilModalUbah').on('click', function () {
        $('#judulModal').html('Ubah Data Mahasiswa')
        $('.modal-footer button[type=submit]').html('Ubah Data')
        $('.modal-content form').attr('action', 'http://localhost/wpu_mvc/public/mahasiswa/ubah')

        // ketika tombol diklick, ambil data data berupa id dan masukkan kedalam variabel id
        const id = $(this).data('id')

        $.ajax({
            // ambil proses getUbah pada controoller mahasiswa 
            url: 'http://localhost/wpu_mvc/public/mahasiswa/getUbah',
            // mengirimkan data {nama data yang dikirimkan : isi data yang dikirimkan}
            data: { id: id },
            // method pengiriman data
            method: 'post',
            // tipe data yang digunakan
            dataType: 'json',
            // ketika berhasil akan melakukan apa
            success: function (data) {
                $('#id').val(data.id)
                $('#nama').val(data.nama)
                $('#nim').val(data.nim)
                $('#email').val(data.email)
                $('#jurusan').val(data.jurusan)
            }
        })
    })
});

$(function () {
    function loadData(search) {
        $.ajax({
            type: 'post',
            url: 'http://localhost/wpu_mvc/public/mahasiswa/ajax_search',
            data: {
                search: search
            },
            dataType: 'html',
            cache: false,
            success: function (data) {
                $('#tampil').html(data);
            }
        });
    }

    // Load data saat halaman pertama kali dimuat
    loadData('');

    // Pencarian saat input berubah
    $('.search').on('input', function () {
        var name = $(this).val();
        loadData(name);
    });
});
