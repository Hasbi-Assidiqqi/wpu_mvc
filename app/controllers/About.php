<?php 

class About extends Controller {

    public function index($nama = "Hasbi", $pekerjaan = "Programmer", $umur = "21") {
        $data ['judul'] = 'About';
        $data ['nama'] = $nama;
        $data ['pekerjaan'] = $pekerjaan;
        $data ['umur'] = $umur;

        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }
    public function Page() {
        $this->view('about/page');
    }
}