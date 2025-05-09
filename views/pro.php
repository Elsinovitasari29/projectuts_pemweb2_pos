<?php
require_once('Controllers/Produk.php');
$produk = new Produk($pdo); // Pastikan $pdo sudah diinisialisasi di Config/DB.php
require_once('Controllers/JenisProduk.php');
$jenis = new Jenis($pdo); // Untuk dropdown jenis produk
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    
                    <!-- Tombol Tambah Produk -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah Produk
                    </button>

                    <!-- Modal Tambah Produk -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="kode">Kode</label>
                                            <input type="text" class="form-control" name="kode" placeholder="Kode Produk" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Nama Produk" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="number" class="form-control" name="harga" placeholder="Harga Produk" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" name="stok" placeholder="Stok Produk" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="rating">Rating</label>
                                            <select class="form-control" name="rating" required>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="min_stok">Min Stok</label>
                                            <input type="number" class="form-control" name="min_stok" placeholder="Minimal Stok" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" placeholder="Deskripsi Produk" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_produk_id">Jenis Produk</label>
                                            <select class="form-control" name="jenis_produk_id" required>
                                                <option value="">Pilih Jenis Produk</option>
                                                <?php
                                                $jenisProduks = $jenis->index();
                                                foreach ($jenisProduks as $jenisItem) {
                                                    echo "<option value='" . $jenisItem['id'] . "'>" . $jenisItem['nama'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="type" value="tambah" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Produk -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Rating</th>
                                <th>Min Stok</th>
                                <th>Deskripsi</th>
                                <th>Jenis Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;
                            $rows = $produk->index();
                            foreach ($rows as $row) {
                                echo "
                                <tr>
                                    <td>" . $nomor++ . "</td>
                                    <td>" . $row['kode'] . "</td>
                                    <td>" . $row['nama'] . "</td>
                                    <td>" . $row['harga'] . "</td>
                                    <td>" . $row['stok'] . "</td>
                                    <td>" . $row['rating'] . "</td>
                                    <td>" . $row['min_stok'] . "</td>
                                    <td>" . $row['deskripsi'] . "</td>
                                    <td>" . $row['jenis_produk'] . "</td>
                                    <td>
                                        <button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editModal" . $row['id'] . "'>
                                            Edit
                                        </button>
                                        <form method='post' style='display:inline'>
                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                            <input type='hidden' name='type' value='delete'>
                                            <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Modal Edit Produk -->
                    <?php foreach ($rows as $row): ?>
                    <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $row['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?= $row['id'] ?>">Edit Produk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <div class="form-group">
                                            <label for="kode">Kode</label>
                                            <input type="text" class="form-control" name="kode" value="<?= $row['kode'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" class="form-control" name="nama" value="<?= $row['nama'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga</label>
                                            <input type="number" class="form-control" name="harga" value="<?= $row['harga'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" name="stok" value="<?= $row['stok'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="rating">Rating</label>
                                            <select class="form-control" name="rating" required>
                                                <option value="1" <?= $row['rating'] == 1 ? 'selected' : '' ?>>1</option>
                                                <option value="2" <?= $row['rating'] == 2 ? 'selected' : '' ?>>2</option>
                                                <option value="3" <?= $row['rating'] == 3 ? 'selected' : '' ?>>3</option>
                                                <option value="4" <?= $row['rating'] == 4 ? 'selected' : '' ?>>4</option>
                                                <option value="5" <?= $row['rating'] == 5 ? 'selected' : '' ?>>5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="min_stok">Min Stok</label>
                                            <input type="number" class="form-control" name="min_stok" value="<?= $row['min_stok'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" required><?= $row['deskripsi'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_produk_id">Jenis Produk</label>
                                            <select class="form-control" name="jenis_produk_id" required>
                                                <?php foreach ($jenisProduks as $jenisItem): ?>
                                                    <option value="<?= $jenisItem['id'] ?>" <?= $row['jenis_produk_id'] == $jenisItem['id'] ? 'selected' : '' ?>>
                                                        <?= $jenisItem['nama'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" name="type" value="edit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <?php
                    // Penanganan form tambah produk
                    if (isset($_POST['type']) && $_POST['type'] == 'tambah') {
                        $data = [
                            'kode' => $_POST['kode'],
                            'nama' => $_POST['nama'],
                            'harga' => $_POST['harga'],
                            'stok' => $_POST['stok'],
                            'rating' => $_POST['rating'],
                            'min_stok' => $_POST['min_stok'],
                            'deskripsi' => $_POST['deskripsi'],
                            'jenis_produk_id' => $_POST['jenis_produk_id']
                        ];
                        $produk->create($data);
                        echo '<script>alert("Produk berhasil ditambahkan!");</script>';
                        echo '<meta http-equiv="refresh" content="0; url=?url=pro">';
                    }

                    // Penanganan form edit produk
                    if (isset($_POST['type']) && $_POST['type'] == 'edit') {
                        $data = [
                            'kode' => $_POST['kode'],
                            'nama' => $_POST['nama'],
                            'harga' => $_POST['harga'],
                            'stok' => $_POST['stok'],
                            'rating' => $_POST['rating'],
                            'min_stok' => $_POST['min_stok'],
                            'deskripsi' => $_POST['deskripsi'],
                            'jenis_produk_id' => $_POST['jenis_produk_id']
                        ];
                        $produk->update($_POST['id'], $data);
                        echo '<script>alert("Produk berhasil diupdate!");</script>';
                        echo '<meta http-equiv="refresh" content="0; url=?url=pro">';
                    }

                    // Penanganan form hapus produk
                    if (isset($_POST['type']) && $_POST['type'] == 'delete') {
                        $produk->delete($_POST['id']);
                        echo '<script>alert("Produk berhasil dihapus!");</script>';
                        echo '<meta http-equiv="refresh" content="0; url=?url=pro">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>