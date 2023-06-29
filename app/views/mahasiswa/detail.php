<div class="container mt-4">

    <div class="row">
        <div class="col-lg-6">
            <h3 class="mb-4">Detail Mahasiswa</h3>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $data['mhs']['nama'] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $data['mhs']['nim'] ?></h6>
                    <p class="card-text"><?= $data['mhs']['email'] ?></p>
                    <p class="card-text"><?= $data['mhs']['jurusan'] ?></p>
                    <a href="<?= BASEURL; ?>mahasiswa" class="card-link">Kembali</a>
                </div>
            </div>
        </div>
    </div>

</div>