<?php
require_once 'Config/DB.php';


class Produk
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index()
    {
        $stmt = $this->pdo->query("SELECT produk.*, jenis_produk.nama AS jenis_produk 
                                    FROM produk 
                                    LEFT JOIN jenis_produk ON produk.jenis_produk_id = jenis_produk.id;");
        return $stmt->fetchAll();
    }

    public function show($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM produk WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
{
    $stmt = $this->pdo->prepare("
        INSERT INTO produk (kode, nama, harga, stok, rating, min_stok, deskripsi, jenis_produk_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    return $stmt->execute([
        $data['kode'], 
        $data['nama'], 
        $data['harga'], 
        $data['stok'], 
        $data['rating'], 
        $data['min_stok'], 
        $data['deskripsi'], 
        $data['jenis_produk_id']
    ]);
}

public function update($id, $data)
{
    $stmt = $this->pdo->prepare("
        UPDATE produk 
        SET 
            kode = ?, 
            nama = ?, 
            harga = ?, 
            stok = ?, 
            rating = ?, 
            min_stok = ?, 
            deskripsi = ?, 
            jenis_produk_id = ? 
        WHERE id = ?
    ");
    return $stmt->execute([
        $data['kode'], 
        $data['nama'], 
        $data['harga'], 
        $data['stok'], 
        $data['rating'], 
        $data['min_stok'], 
        $data['deskripsi'], 
        $data['jenis_produk_id'], 
        $id
    ]);
}


public function delete($id)
{
    try {
        $stmt = $this->pdo->prepare("DELETE FROM produk WHERE id = ?");
        $result = $stmt->execute([$id]);

        if (!$result) {
            $errorInfo = $stmt->errorInfo();
            echo "Error Code: " . $errorInfo[0] . "<br>";
            echo "Error Message: " . $errorInfo[2] . "<br>";
        }

        return $result;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
}
$produk = new Produk($pdo);