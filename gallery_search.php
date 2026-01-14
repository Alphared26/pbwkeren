<?php
include "koneksi.php";

$keyword = $_POST['keyword'];

$sql = "SELECT * FROM gallery 
        WHERE deskripsi LIKE ? OR tanggal LIKE ? OR username LIKE ?
        ORDER BY tanggal DESC";

$stmt = $conn->prepare($sql);
$search = "%" . $keyword . "%";
$stmt->bind_param("sss", $search, $search, $search);
$stmt->execute();

$hasil = $stmt->get_result();
$no = 1;
while ($row = $hasil->fetch_assoc()) {
?>
<tr>
  <td><?= $no++ ?></td>

  <td>
    <strong><?= $row["deskripsi"] ?></strong>
    <br>pada : <?= $row["tanggal"] ?>
    <br>oleh : <?= $row["username"] ?>
  </td>

  <td>
    <?php
      if ($row["gambar"] != '') {
        if (file_exists('img/' . $row["gambar"])) {
          echo '<img src="img/' . $row["gambar"] . '" class="img-fluid" alt="Gambar Artikel">';
        }
      }
    ?>
  </td>

  <td>
    <!-- tombol aksi -->
    <a href="#" title="edit" class="badge rounded-pill text-bg-success"
       data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>">
       <i class="bi bi-pencil"></i>
    </a>

    <a href="#" title="delete" class="badge rounded-pill text-bg-danger"
       data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>">
       <i class="bi bi-x-circle"></i>
    </a>
  </td>

  <td>
    <!-- MODAL EDIT -->
    <div class="modal fade" id="modalEdit<?= $row["id"] ?>" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Edit gallery</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <form method="post" action="" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">deskripsi</label>
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <input type="text" class="form-control" name="deskripsi"
                       value="<?= $row["deskripsi"] ?>" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Ganti Gambar</label>
                <input type="file" class="form-control" name="gambar">
              </div>

              <div class="mb-3">
                <label class="form-label">Gambar Lama</label><br>
                <?php
                  if ($row["gambar"] != '') {
                    if (file_exists('img/' . $row["gambar"])) {
                      echo '<img src="img/' . $row["gambar"] . '" class="img-fluid">';
                    }
                  }
                ?>
                <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- MODAL HAPUS -->
    <div class="modal fade" id="modalHapus<?= $row["id"] ?>" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Konfirmasi Hapus gallery</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <form method="post" action="">
            <div class="modal-body">
              Yakin akan menghapus artikel
              "<strong><?= $row["deskripsi"] ?></strong>"?
              <input type="hidden" name="id" value="<?= $row["id"] ?>">
              <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
              <input type="submit" value="hapus" name="hapus" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>

  </td>
</tr>
<?php
}
?>
