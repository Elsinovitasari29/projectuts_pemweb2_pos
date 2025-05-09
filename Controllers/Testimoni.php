<?php
require_once 'Config/DB.php';

class Testimoni
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Ambil semua data testimoni
    public function index()
    {
        $stmt = $this->pdo->query("
            SELECT testimoni.*, produk.nama AS nama_produk, kategori_tokoh.nama AS nama_kategori 
            FROM testimoni
            LEFT JOIN produk ON testimoni.produk_id = produk.id
            LEFT JOIN kategori_tokoh ON testimoni.kategori_tokoh_id = kategori_tokoh.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tambah data testimoni
    public function create($data)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO testimoni (tanggal, nama_tokoh, komentar, rating, produk_id, kategori_tokoh_id) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['tanggal'],
            $data['nama_tokoh'],
            $data['komentar'],
            $data['rating'],
            $data['produk_id'],
            $data['kategori_tokoh_id']
        ]);
    }

    // Update data testimoni
    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare("
            UPDATE testimoni 
            SET 
                tanggal = ?, 
                nama_tokoh = ?, 
                komentar = ?, 
                rating = ?, 
                produk_id = ?, 
                kategori_tokoh_id = ? 
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['tanggal'],
            $data['nama_tokoh'],
            $data['komentar'],
            $data['rating'],
            $data['produk_id'],
            $data['kategori_tokoh_id'],
            $id
        ]);
    }

    // Hapus data testimoni
    public function delete($id)
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM testimoni WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
$testimoni = new Testimoni($pdo);