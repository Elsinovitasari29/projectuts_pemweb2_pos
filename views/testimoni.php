<?php
require_once('Controllers/Testimoni.php');
require_once('Controllers/Produk.php');
require_once('Controllers/KategoriTokoh.php');

$testimoni = new Testimoni($pdo);
$produk = new Produk($pdo);
$kategori = new KategoriTokoh($pdo);
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    
                    <!-- Tombol Tambah Testimoni -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah Testimoni
                    </button>

                    <!-- Modal Tambah Testimoni -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Testimoni</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_tokoh">Nama Tokoh</label>
                                            <input type="text" class="form-control" name="nama_tokoh" placeholder="Nama Tokoh" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="komentar">Komentar</label>
                                            <textarea class="form-control" name="komentar" placeholder="Komentar" required></textarea>
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
                                            <label for="produk_id">Produk</label>
                                            <select class="form-control" name="produk_id" required>
                                                <option value="">Pilih Produk</option>
                                                <?php
                                                $produks = $produk->index();
                                                foreach ($produks as $produkItem) {
                                                    echo "<option value='" . $produkItem['id'] . "'>" . $produkItem['nama'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori_tokoh_id">Kategori Tokoh</label>
                                            <select class="form-control" name="kategori_tokoh_id" required>
                                                <option value="">Pilih Kategori Tokoh</option>
                                                <?php
                                                $kategoriTokoh = $kategori->index();
                                                foreach ($kategoriTokoh as $kategoriItem) {
                                                    echo "<option value='" . $kategoriItem['id'] . "'>" . $kategoriItem['kategori_tokoh_id'] . "</option>";
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

                    <!-- Tabel Testimoni -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Tokoh</th>
                                <th>Komentar</th>
                                <th>Rating</th>
                                <th>Produk</th>
                                <th>Kategori Tokoh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;
                            $rows = $testimoni->index();
                            foreach ($rows as $row) {
                                echo "
                                <tr>
                                    <td>" . $nomor++ . "</td>
                                    <td>" . $row['tanggal'] . "</td>
                                    <td>" . $row['nama_tokoh'] . "</td>
                                    <td>" . $row['komentar'] . "</td>
                                    <td>" . $row['rating'] . "</td>
                                    <td>" . $row['produk_id'] . "</td>
                                    <td>" . $row['kategori_tokoh_id'] . "</td>
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

                    <!-- Modal Edit Testimoni -->
                    <?php foreach ($rows as $row): ?>
                    <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $row['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?= $row['id'] ?>">Edit Testimoni</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" name="tanggal" value="<?= $row['tanggal'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_tokoh">Nama Tokoh</label>
                                            <input type="text" class="form-control" name="nama_tokoh" value="<?= $row['nama_tokoh'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="komentar">Komentar</label>
                                            <textarea class="form-control" name="komentar" required><?= $row['komentar'] ?></textarea>
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
                                            <label for="produk_id">Produk</label>
                                            <select class="form-control" name="produk_id" required>
                                                <?php foreach ($produks as $produkItem): ?>
                                                    <option value="<?= $produkItem['id'] ?>" <?= $row['produk_id'] == $produkItem['id'] ? 'selected' : '' ?>>
                                                        <?= $produkItem['nama'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori_tokoh_id">Kategori Tokoh</label>
                                            <select class="form-control" name="kategori_tokoh_id" required>
                                                <?php foreach ($kategoriTokoh as $kategoriItem): ?>
                                                    <option value="<?= $kategoriItem['id'] ?>" <?= $row['kategori_tokoh_id'] == $kategoriItem['id'] ? 'selected' : '' ?>>
                                                        <?= $kategoriItem['kategori_tokoh_id'] ?>
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
                    // Penanganan form tambah testimoni
                    if (isset($_POST['type']) && $_POST['type'] == 'tambah') {
                        $data = [
                            'tanggal' => $_POST['tanggal'],
                            'nama_tokoh' => $_POST['nama_tokoh'],
                            'komentar' => $_POST['komentar'],
                            'rating' => $_POST['rating'],
                            'produk_id' => $_POST['produk_id'],
                            'kategori_tokoh_id' => $_POST['kategori_tokoh_id'],
                        ];
                        $testimoni->create($data);
                        echo '<script>alert("Testimoni berhasil ditambahkan!");</script>';
                        echo '<meta http-equiv="refresh" content="0; url=?url=testimoni">';
                    }

                    // Penanganan form edit testimoni
                    if (isset($_POST['type']) && $_POST['type'] == 'edit') {
                        $data = [
                            'tanggal' => $_POST['tanggal'],
                            'nama_tokoh' => $_POST['nama_tokoh'],
                            'komentar' => $_POST['komentar'],
                            'rating' => $_POST['rating'],
                            'produk_id' => $_POST['produk_id'],
                            'kategori_tokoh_id' => $_POST['kategori_tokoh_id'],
                        ];
                        $testimoni->update($_POST['id'], $data);
                        echo '<script>alert("Testimoni berhasil diupdate!");</script>';
                        echo '<meta http-equiv="refresh" content="0; url=?url=testimoni">';
                    }

                    // Penanganan form hapus testimoni
                    if (isset($_POST['type']) && $_POST['type'] == 'delete') {
                        $testimoni->delete($_POST['id']);
                        echo '<script>alert("Testimoni berhasil dihapus!");</script>';
                        echo '<meta http-equiv="refresh" content="0; url=?url=testimoni">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>