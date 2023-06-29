<?php

class Mahasiswa_model
{
    private $table = 'mahasiswa';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllMahasiswa()
    {
        $query = "SELECT * FROM {$this->table}";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getMahasiswaById($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function tambahDataMahasiswa($data) {
        $query = "INSERT INTO {$this->table} VALUES ('', :nama, :nim, :email, :jurusan)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataMahasiswa($id) {
        $query = "DELETE FROM {$this->table} WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
