<div class="container mt-4">

    <div class="row">
        <div class="col-lg-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <h3 class="mb-4">Daftar Mahasiswa</h3>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="input-group mb-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-3 tombolTambahData" data-bs-toggle="modal" data-bs-target="#modalTambah" value="Tambah Data">Tambah Data Mahasiswa </button>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="search form-control" id="search" placeholder="Nama Mahasiswa" aria-label="Nama Mahasiswa" aria-describedby="button-addon2">
                    <button class="btn btn-primary" type="button" id="button-addon2">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

            </div>

            <!-- tampilkan data -->
            <div id="tampil"></div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="judulModal">Tambah Data Mahasiswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= BASEURL; ?>mahasiswa/tambah" method="POST">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="number" class="form-control" id="nim" name="nim">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select class="form-control" id="jurusan" name="jurusan">
                            <option disabled selected value>Pilih Jurusan</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Teknik Industri">Teknik Industri</option>
                            <option value="Teknik Elektro">Teknik Elektro</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Matematika">Matematika</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        // cari class dengan nama 'tombolTambahData' ketika diklick ubah isi tag dengan id 'judulModal' menjadi 'Tambah Data Mahasiswa'
        $(document).on('click', '.tombolTambahData', function() {
            $('#judulModal').html('Tambah Data Mahasiswa')
            // cari tag button dengan tipe submit pada class 'modal-footer' kemudian ubah isinya menjadi 'Tambah Data'
            $('.modal-footer button[type=submit]').html('Tambah Data')
            $('.modal-content form').attr('action', 'http://localhost/wpu_mvc/public/mahasiswa/tambah')
        })

        // ubah
        $(document).on('click', '.tampilModalUbah', function() {
            $('#judulModal').html('Ubah Data Mahasiswa');
            $('.modal-footer button[type=submit]').html('Ubah Data');
            $('.modal-content form').attr('action', 'http://localhost/wpu_mvc/public/mahasiswa/ubah');

            const id = $(this).data('id');

            $.ajax({
                url: 'http://localhost/wpu_mvc/public/mahasiswa/getUbah',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#nim').val(data.nim);
                    $('#email').val(data.email);
                    $('#jurusan').val(data.jurusan);
                }
            });
        });


        // searching
        const loadData = (search) => {
            $.ajax({
                type: 'post',
                url: 'http://localhost/wpu_mvc/public/mahasiswa/ajax_search',
                data: {
                    search
                },
                dataType: 'html',
                cache: false,
                success: (data) => $('#tampil').html(data)
            });
        };

        // Tombol cari
        var searchBtn = $('#button-addon2');
        // Input search
        var searchInput = $('#search');

        // Event listener saat input berubah
        searchInput.on('input', function() {
            var name = searchInput.val();

            // Jika input tidak kosong, ubah tombol menjadi ikon "X"
            if (name !== '') {
                searchBtn.html('<i class="fas fa-times"></i>');
                $('.search').on('input', () => loadData($('.search').val()));

            } else {
                searchBtn.html('<i class="fas fa-search"></i>');
            }
        });

        // Event listener saat tombol cari diklik
        searchBtn.on('click', function() {
            // Jika tombol berisi ikon "X", reset input dan ubah tombol kembali menjadi ikon "Search"
            if (searchBtn.html().includes('fa-times')) {
                searchInput.val('');
                loadData('');
                searchBtn.html('<i class="fas fa-search"></i>');
            }
        });

    });
</script>