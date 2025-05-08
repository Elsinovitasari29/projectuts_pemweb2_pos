<?php
require_once 'Config/DB.php';

class KategoriTokoh
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT * FROM kategori_tokoh");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM kategori_tokoh WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO kategori_tokoh (nama) VALUES (?)");
        return $stmt->execute([$data['nama']]);
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE kategori_tokoh SET nama = ? WHERE id = ?");
        return $stmt->execute([$data['nama'], $id]);
    }

    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM kategori_tokoh WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            // Tangani error jika terjadi
            return false;
        }
    }
}

$kategoriTokoh = new KategoriTokoh($pdo);