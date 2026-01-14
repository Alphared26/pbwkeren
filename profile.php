<?php
// pastikan session sudah jalan di admin.php (biasanya sudah)
include "koneksi.php";

$username_login = $_SESSION["username"];

// ambil data user yang sedang login (hanya data miliknya)
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username_login);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (isset($_POST["simpan"])) {

  $password_baru = $_POST["password"] ?? "";
  $foto_lama     = $user["foto"] ?? "";

  // default foto tetap foto lama
  $foto_baru = $foto_lama;

  // kalau upload foto baru
  if (!empty($_FILES["foto"]["name"])) {
    $nama_file = time() . "_" . basename($_FILES["foto"]["name"]);
    $tmp       = $_FILES["foto"]["tmp_name"];

    if (move_uploaded_file($tmp, "img/" . $nama_file)) {
      // hapus foto lama kalau ada
      if (!empty($foto_lama) && file_exists("img/" . $foto_lama)) {
        unlink("img/" . $foto_lama);
      }
      $foto_baru = $nama_file;
    } else {
      echo "<script>alert('Upload foto gagal');</script>";
    }
  }

  // update (password opsional)
  if ($password_baru != "") {
    $password_md5 = md5($password_baru);
    $sql = "UPDATE user SET password = ?, foto = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $password_md5, $foto_baru, $username_login);
  } else {
    $sql = "UPDATE user SET foto = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $foto_baru, $username_login);
  }

  if ($stmt->execute()) {
    echo "<script>alert('Profile berhasil diupdate'); document.location='admin.php?page=profile';</script>";
  } else {
    echo "<script>alert('Profile gagal diupdate');</script>";
  }
  $stmt->close();
}
?>




<form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" class="form-control" value="<?= $user["username"] ?>" readonly>
  </div>

  <div class="mb-3">
    <label class="form-label">Ganti Password</label>
    <input type="password" name="password" class="form-control"
      placeholder="Tuliskan Password Baru Jika Ingin Mengganti Password Saja">
  </div>

  <div class="mb-3">
    <label class="form-label">Ganti Foto Profil</label>
    <input type="file" name="foto" class="form-control">
  </div>

  <div class="mb-3">
    <label class="form-label">Foto Profil Saat Ini</label><br>
    <?php if (!empty($user["foto"]) && file_exists("img/" . $user["foto"])) { ?>
      <img src="img/<?= $user["foto"] ?>" style="max-width:150px;">
    <?php } else { ?>
      <small class="text-muted">Belum ada foto profil</small>
    <?php } ?>
  </div>

  <button type="submit" name="simpan" class="btn btn-primary">simpan</button>
</form>
