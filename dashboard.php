<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 6742f4d (update pbw uas)
>>>>>>> ce1a772 (update pbw uas)

<?php

//menyertakan code dari file koneksi
include "koneksi.php";


//query untuk mengambil data article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

//menghitung jumlah baris data article
$jumlah_article = $hasil1->num_rows; 


?>
<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-newspaper"></i> Article</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_article; ?></span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
    <div class="col">
        <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="p-3">
                        <h5 class="card-title"><i class="bi bi-camera"></i> Gallery</h5> 
                    </div>
                    <div class="p-3">
                        <span class="badge rounded-pill text-bg-danger fs-2">0</span>
                    </div> 
                </div>
            </div>
        </div>
    </div> 
</div>

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
<?php
include "koneksi.php";

// ambil user yang sedang login dari session
$username_login = $_SESSION["username"];

// ambil data user 
$sqlUser = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sqlUser);
$stmt->bind_param("s", $username_login);
$stmt->execute();
$dataUser = $stmt->get_result()->fetch_assoc();
$stmt->close();

// hitung jumlah article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);
$jumlah_article = $hasil1->num_rows;

// hitung jumlah gallery (sesuai database)
$sql2 = "SELECT * FROM gallery ORDER BY tanggal DESC";
$hasil2 = $conn->query($sql2);
$jumlah_gallery = $hasil2->num_rows;
?>

<div class="text-center pt-4">
  <h5 class="text-secondary">Selamat Datang,</h5>
  <h2 class="text-danger fw-bold"><?= $dataUser["username"] ?></h2>

  <?php if (!empty($dataUser["foto"])) { ?>
    <img src="img/<?= $dataUser["foto"] ?>" class="rounded-circle" style="width:220px; height:220px; object-fit:cover;">
  <?php } ?>
</div>

<div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center pt-4">
  <div class="col">
    <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="p-3">
            <h5 class="card-title"><i class="bi bi-newspaper"></i> Article</h5>
          </div>
          <div class="p-3">
            <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_article; ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card border border-danger mb-3 shadow" style="max-width: 18rem;">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div class="p-3">
            <h5 class="card-title"><i class="bi bi-camera"></i> Gallery</h5>
          </div>
          <div class="p-3">
            <span class="badge rounded-pill text-bg-danger fs-2"><?php echo $jumlah_gallery; ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
>>>>>>> 140b6fa (update pbw uas)
>>>>>>> 6742f4d (update pbw uas)
>>>>>>> ce1a772 (update pbw uas)
