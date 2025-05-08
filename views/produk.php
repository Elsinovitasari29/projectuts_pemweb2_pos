<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="card w-100">
                <!-- Modal -->
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
                                        <input class="form-control" name="kode" type="text" placeholder="Kode" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input class="form-control" name="nama" type="text" placeholder="Nama" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input class="form-control" name="harga" type="text" placeholder="Harga" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="stok">Stok</label>
                                        <input class="form-control" name="stok" type="date" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Rating</label>
                                        <!-- filepath: c:\xampp\htdocs\pemweb2\projectuts_pemweb2_pos\views\produk.php -->
                                            <div class="form-group">
                                                <label>Rating</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="rating1" type="radio" name="rating" value="1" required />
                                                    <label class="form-check-label" for="rating1">
                                                        <i class="fas fa-star"></i>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="rating2" type="radio" name="rating" value="2" required />
                                                    <label class="form-check-label" for="rating2">
                                                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="rating3" type="radio" name="rating" value="3" required />
                                                    <label class="form-check-label" for="rating3">
                                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="rating4" type="radio" name="rating" value="4" required />
                                                    <label class="form-check-label" for="rating4">
                                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="rating5" type="radio" name="rating" value="5" required />
                                                    <label class="form-check-label" for="rating5">
                                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                                    </label>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="min_stok">Email</label>
                                        <input class="form-control" name="min_stok" type="min_stok" placeholder="Email" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" placeholder="deskripsi" style="height: 10rem;" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_produk_id">Kelurahan</label>
                                        <select class="form-control" name="jenis_produk_id" required>
                                            <option value="">Pilih Jenis Produk</option>
                                            <?php
                                            require_once('Controllers/kelurahan.php');
                                            
                                            $jenises = $jenis->index();
                                            foreach($jenises as $jen) {
                                                echo "<option value='".$jen['id']."'>".$jen['nama']."</option>";
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
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah Produk
                    </button>
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
                                <th>deskripsi</th>
                                <th>Jenis Produk</th>
                                <th>aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once('Controllers/Produk.php');
                            $nomor = 1;
                            $row = $produk->index();
                            foreach ($row as $list) {
                                echo "
                                <tr>
                                <td>" . $nomor++ . "</td>
                                <td>" . $list['kode'] . "</td>
                                <td>" . $list['nama'] . "</td>
                                <td>" . $list['harga'] . "</td>
                                <td>" . $list['stok'] . "</td>
                                <td>" . $list['reting'] . "</td>
                                <td>" . $list['min_stok'] . "</td>
                                <td>" . $list['deskripsi'] . "</td>
                                <td>" . $list['jenis_produk'] . "</td>
                                <td>
                                    <button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editModal".$list['id']."'>
                                        Edit
                                    </button>
                                    <div class='modal fade' id='editModal".$list['id']."' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='editModalLabel'>Edit Data Produk</h5>
                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>
                                                <form method='post'>
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='id' value='".$list['id']."'>
                                                        <input type='hidden' name='type' value='edit'>
                                                        <div class='form-group'>
                                                            <label>Kode</label>
                                                            <input type='text' class='form-control' name='kode' value='".$list['kode']."' required>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label>Nama</label>
                                                            <input type='text' class='form-control' name='nama' value='".$list['nama']."' required>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label>Harga</label>
                                                            <input type='text' class='form-control' name='harga' value='".$list['harga']."' required>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label>Stok</label>
                                                            <input type='date' class='form-control' name=stok' value='".$list['stok']."' required>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label>Reting</label>
                                                            <select class='form-control' name='reting' required>
                                                                <option value='1' ".($list['reting'] == '1' ? 'selected' : '').">1</option>
                                                                <option value='2' ".($list['reting'] == '2' ? 'selected' : '').">2</option>
                                                                <option value='3' ".($list['reting'] == '3' ? 'selected' : '').">3</option>
                                                                <option value='4' ".($list['reting'] == '4' ? 'selected' : '').">4</option>
                                                                <option value='5' ".($list['reting'] == '5' ? 'selected' : '').">5</option>
                                                            </select>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label>Min Stok</label>
                                                            <input type='min_stok' class='form-control' name='min_stok' value='".$list['min_stok']."' required>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label>Deskripsi</label>
                                                            <textarea class='form-control' name='deskripsi' required>".$list['deskripsi']."</textarea>
                                                        </div>
                                                        <div class='form-group'>
                                                            <label>Jenis Produk</label>
                                                            <select class='form-control' name='jenis_produk_id'] required>";
                                                            foreach($jenises as $jen) {
                                                                $selected = ($jen['id'] == $list['kelurahan_id']) ? 'selected' : '';
                                                                echo "<option value='".$jen['id']."' ".$selected.">".$jen['nama']."</option>";
                                                            }
                                                            echo "</select>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                                        <button type='submit' class='btn btn-primary'>Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <form method='post' style='display:inline'>
                                        <input type='hidden' name='id' value='".$list['id']."'>
                                        <input type='hidden' name='type' value='delete'>
                                        <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</button>
                                    </form>
                                </td>
                                </tr>
                                ";
                            }
                            if(isset($_POST['type'])){
                                if($_POST['type']=='tambah'){
                                    $data = [
                                        'kode' => $_POST['kode'],
                                        'nama' => $_POST['nama'],
                                        'tmp_lahir' => $_POST['harga'],
                                        'stok' => $_POST['stok'],
                                        'reting' => $_POST['reting'],
                                        'min_stok' => $_POST['min_stok'],
                                        'deskripsi' => $_POST['deskripsi'],
                                        'kelurahan_id' => $_POST['jenis_produk_id']
                                    ];
                                    
                                    $pasien->create($data);
                                    echo '<script>alert("Data berhasil ditambahkan")</script><meta http-equiv="refresh" content="0; url=?url=pasien">';
                                } elseif($_POST['type']=='edit') {
                                    $data = [
                                        'kode' => $_POST['kode'],
                                        'nama' => $_POST['nama'],
                                        'harga' => $_POST['harga'],
                                        'stok' => $_POST['stok'],
                                        'reting' => $_POST['reting'],
                                        'min_stok' => $_POST['min_stok'],
                                        'deskripsi' => $_POST['deskripsi'],
                                        'jenis_produk_id'=> $_POST['jenis_produk_id']
                                    ];
                                    
                                    $pasien->update($_POST['id'], $data);
                                    echo '<script>alert("Data berhasil diupdate")</script><meta http-equiv="refresh" content="0; url=?url=pasien">';
                                } elseif($_POST['type']=='delete') {
                                    $pasien->delete($_POST['id']);
                                    echo '<script>alert("Data berhasil dihapus")</script><meta http-equiv="refresh" content="0; url=?url=pasien">';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- /.card -->
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <!-- /.card -->
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>