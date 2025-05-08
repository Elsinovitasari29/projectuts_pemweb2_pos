<?php
require_once 'Config/DB.php';

class Kategori
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM kategori_tokoh");
        return $stmt->fetchAll();
    }

    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM kategori_tokoh WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO kategori_tokoh (nama) VALUES (?)"); // Ganti 'jenis' dengan 'nama'
        return $stmt->execute([$data['nama']]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE kategori_tokoh SET nama = ? WHERE id = ?"); // Ganti 'jenis' dengan 'nama'
        return $stmt->execute([$data['nama'], $id]);
    }

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM kategori_tokoh WHERE id = ?"); // Hapus referensi ke 'jenis_id'
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // For debugging
            return false;
        }
    }
}

$kategori = new Kategori($pdo);