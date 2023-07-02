<?php

class mahasiswa extends Controller
{
    public function index()
    {
        $data['judul'] = 'Daftar Mahasiswa';
        $data['mhs'] = $this->model('Mahasiswa_model')->getAllMahasiswa();

        $this->view('templates/header', $data);
        $this->view('mahasiswa/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Mahasiswa';
        $data['mhs'] = $this->model('Mahasiswa_model')->getMahasiswaById($id);

        $this->view('templates/header', $data);
        $this->view('mahasiswa/detail', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('Mahasiswa_model')->tambahDataMahasiswa($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . 'mahasiswa');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . 'mahasiswa');
            exit;
        }
    }

    public function ubah()
    {
        if ($this->model('Mahasiswa_model')->ubahDataMahasiswa($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . 'mahasiswa');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . 'mahasiswa');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('Mahasiswa_model')->hapusDataMahasiswa($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . 'mahasiswa');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . 'mahasiswa');
            exit;
        }
    }

    public function getUbah()
    {
        $data = $this->model('Mahasiswa_model')->getMahasiswaById($_POST['id']);
        echo json_encode($data);
    }

    public function ajax_search()
    {
        $keyword = isset($_POST['search']) ? $_POST['search'] : '';
        $data['mhs'] = $this->model('Mahasiswa_model')->cariDataMahasiswa($keyword);

        $output = '';

        foreach ($data['mhs'] as $mhs) {
            $output .= '<li class="list-group-item">
                            ' . $mhs['nama'] . '
                            <a href="' . BASEURL . 'mahasiswa/hapus/' . $mhs['id'] . '" class="badge text-bg-danger float-end" onclick="return confirm(\'Yakin ingin menghapus data?\');">Hapus</a>
                            <a href="' . BASEURL . 'mahasiswa/ubah/' . $mhs['id'] . '" class="badge text-bg-warning text-white float-end me-1 tampilModalUbah" data-bs-toggle="modal" data-bs-target="#modalTambah" data-id="' . $mhs['id'] . '">Ubah</a>
                            <a href="' . BASEURL . 'mahasiswa/detail/' . $mhs['id'] . '" class="badge text-bg-primary float-end me-1">Detail</a>
                        </li>';
        }

        echo '<ul class="list-group">' . $output . '</ul>';
    }
}
