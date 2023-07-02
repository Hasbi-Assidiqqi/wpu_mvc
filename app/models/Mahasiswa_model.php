<?php

class Mahasiswa_model
{
    private $table = 'mahasiswa';
    private $searchBy = ['jurusan'];
    private $db;

    public function __construct()
    {
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

    public function tambahDataMahasiswa($data)
    {
        $query = "INSERT INTO {$this->table} VALUES ('', :nama, :nim, :email, :jurusan)";
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataMahasiswa($data)
    {
        $query = "UPDATE {$this->table} SET nama=:nama, nim=:nim, email=:email, jurusan=:jurusan WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('nim', $data['nim']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('jurusan', $data['jurusan']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataMahasiswa($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id=:id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function cariDataMahasiswa($keyword)
    {
        $keywords = explode(' ', $keyword);
        $conditions = [];
        $bindValues = [];

        foreach ($keywords as $index => $keyword) {
            $subConditions = [];
            foreach ($this->searchBy as $field) {
                $subConditions[] = "{$field} LIKE :search{$index}_{$field}";
                $bindValues["search{$index}_{$field}"] = "%{$keyword}%";
            }
            $conditions[] = "(" . implode(' OR ', $subConditions) . ")";
        }

        $conditionStr = implode(' AND ', $conditions);
        $query = "SELECT * FROM {$this->table} WHERE {$conditionStr}";
        $this->db->query($query);

        foreach ($bindValues as $placeholder => $value) {
            $this->db->bind($placeholder, $value);
        }

        return $this->db->resultSet();
    }
}
