<?php
//menyertakan code dari file koneksi
include "koneksi.php";
?>


<!DOCTYPE html>
<html lang="en" id="htmlPage" data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="icon" href="img/logo.png" />
    <style>
      .accordion-button:not(.collapsed) {
        background-color: #da6a73;
        color: white;
      }

      body,
      .card,
      footer,
      section {
        transition: background-color 0.5s ease, color 0.5s ease;
      }

      [data-bs-theme="dark"] body,
      [data-bs-theme="dark"] #hero,
      [data-bs-theme="dark"] #gallery,
      [data-bs-theme="dark"] #aboutme {
        background-color: #343a40 !important;
        color: white;
      }
      [data-bs-theme="dark"] .navbar,
      [data-bs-theme="dark"] #article,
      [data-bs-theme="dark"] footer,
      [data-bs-theme="dark"] #schedule {
        background-color: #1c1f22 !important;
        color: white;
      }

      [data-bs-theme="dark"] .navbar-brand,
      [data-bs-theme="dark"] .nav-link {
        color: white !important;
      }

      [data-bs-theme="dark"] .card {
        color: white;
        border: none;
      }

      [data-bs-theme="dark"] .card-footer .text-body-secondary {
        color: #adb5bd !important;
      }

      [data-bs-theme="dark"] .bi-book,
      [data-bs-theme="dark"] .bi-laptop,
      [data-bs-theme="dark"] .bi-people,
      [data-bs-theme="dark"] .bi-bicycle,
      [data-bs-theme="dark"] .bi-film,
      [data-bs-theme="dark"] .bi-bag,
      [data-bs-theme="dark"] footer i {
        color: white !important;
      }
      [data-bs-theme="dark"] .p-4.border {
        border-color: #6c757d !important;
      }

      .btn-group .btn.active {
        box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
      }

      #btn-dark-mode {
        background-color: #212529;
        border-color: #212529;
      }
      #btn-light-mode {
        background-color: #dc3545;
        border-color: #dc3545;
      }
      #btn-dark-mode.active,
      #btn-light-mode.active {
        opacity: 1;
      }
      #btn-dark-mode:not(.active),
      #btn-light-mode:not(.active) {
        opacity: 0.6;
      }

      

      
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">My Daily Journal</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#article">Article</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#gallery">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#schedule">Schedule</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#aboutme">About Me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php" target="_blank">Login</a>
            </li>
          </ul>

          <div class="btn-group ms-3" role="group" aria-label="Basic example">
            <button
              type="button"
              class="btn btn-dark active"
              id="btn-dark-mode"
            >
              <i class="bi bi-moon-stars-fill"></i>
            </button>
            <button type="button" class="btn btn-danger" id="btn-light-mode">
              <i class="bi bi-sun-fill"></i>
            </button>
          </div>
        </div>
      </div>
    </nav>
    <section id="hero" class="text-center bg-danger-subtle p-5 text-sm-start">
      <div class="container">
        <div class="d-sm-flex flex-sm-row-reverse align-items-center">
          <img src="img/banner.jpg" class="img-fluid" width="300" />
          <div>
            <h1 class="fw-bold display-4">
              Create Memories, Save Memories, Everyday
            </h1>
            <h4 class="lead display-6">
              Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali
            </h4>
            <h6>
              <span id="tanggal"></span>
              <span id="jam"></span>
            </h6>
          </div>
        </div>
      </div>
    </section>
    <section id="article" class="text-center p-5">
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Article</h1>
        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
    				<?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql); 

        
        while ($row = $hasil->fetch_assoc()) {
          
        ?>
        <!-- col start   -->
        <div class="col">
            <div class="card h-100">
              <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title"><?= $row["judul"] ?></h5>
                <p class="card-text">
                  <?= $row["isi"] ?>
                </p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary">
                   <?=$row["tanggal"]?>
                </small>
              </div>
            </div>
          </div>
           <?php
        } 
        ?>
        </div>
        <!-- col end -->
       
 
      </div>
    </section>
    <section id="gallery" class="bg-danger-subtle text-center p-5">
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 6742f4d (update pbw uas)
>>>>>>> ce1a772 (update pbw uas)
      <div class="container">
        <h1 class="fw-bold display-4 pb-3">Gallery</h1>
        <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/gal1.jpg" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
              <img src="img/gal2.jpg" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
              <img src="img/gal4.jpg" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
              <img src="img/gal5.jpg" class="d-block w-100" alt="..." />
            </div>
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExample"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </section>
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
  <div class="container">
    <h1 class="fw-bold display-4 pb-3">Gallery</h1>

    <div id="carouselExample" class="carousel slide">
      <div class="carousel-inner">

        <?php
          $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
          $hasil = $conn->query($sql); 

          $no = 0;
          while ($row = $hasil->fetch_assoc()) {
        ?>
          <div class="carousel-item <?= ($no === 0) ? 'active' : '' ?>">
            <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="..." />
          </div>
        <?php
            $no++;
          } 
        ?>

      </div>

      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselExample"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>

      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselExample"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>

    </div>
  </div>
</section>

>>>>>>> 140b6fa (update pbw uas)
>>>>>>> 6742f4d (update pbw uas)
>>>>>>> ce1a772 (update pbw uas)
    <section id="schedule" class="text-center p-5">
      <h1 class="fw-bold display-4 pb-3">Schedule</h1>
      <div
        class="row row-cols-2 row-cols-sm-3 row-cols-lg-4 g-4 justify-content-center"
      >
        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-book text-danger fs-1"></i>
            <h5 class="mt-3">Membaca</h5>
            <p>Menambah wawasan setiap pagi sebelum beraktivitas.</p>
          </div>
        </div>
        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-laptop text-danger fs-1"></i>
            <h5 class="mt-3">Menulis</h5>
            <p>Mencatat setiap pengalaman harian di jurnal pribadi.</p>
          </div>
        </div>
        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-people text-danger fs-1"></i>
            <h5 class="mt-3">Diskusi</h5>
            <p>Bertukar ide dengan teman dalam kelompok belajar.</p>
          </div>
        </div>
        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-bicycle text-danger fs-1"></i>
            <h5 class="mt-3">Olahraga</h5>
            <p>Menjaga kesehatan dengan bersepeda sore hari.</p>
          </div>
        </div>
        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-film text-danger fs-1"></i>
            <h5 class="mt-3">Movie</h5>
            <p>Menonton film yang bagus di bioskop.</p>
          </div>
        </div>
        <div class="col">
          <div class="p-4 border rounded shadow-sm h-100">
            <i class="bi bi-bag text-danger fs-1"></i>
            <h5 class="mt-3">Belanja</h5>
            <p>Membeli kebutuhan bulanan di supermarket.</p>
          </div>
        </div>
      </div>
    </section>
    <section id="aboutme" class="bg-danger-subtle text-center p-5">
      <h1 class="fw-bold display-4 pb-3">About Me</h1>
      <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button
              class="accordion-button"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseOne"
              aria-expanded="true"
              aria-controls="collapseOne"
            >
              Universitas Dian Nuswantoro Semarang (2024-Now)
            </button>
          </h2>
          <div
            id="collapseOne"
            class="accordion-collapse collapse show"
            data-bs-parent="#accordionExample"
          >
            <div class="accordion-body">
              <strong>This is the first item’s accordion body.</strong> It is
              shown by default, until the collapse plugin adds the appropriate
              classes that we use to style each element. These classes control
              the overall appearance, as well as the showing and hiding via CSS
              transitions. You can modify any of this with custom CSS or
              overriding our default variables. It’s also worth noting that just
              about any HTML can go within the <code>.accordion-body</code>,
              though the transition does limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseTwo"
              aria-expanded="false"
              aria-controls="collapseTwo"
            >
<<<<<<< HEAD
              SMA Negeri 1 Semarang (2024–2021)
=======
<<<<<<< HEAD
              SMA Negeri 1 Semarang (2024–2021)
=======
<<<<<<< HEAD
              SMA Negeri 1 Semarang (2024–2021)
=======
              SMA Negeri 2 Demak (2021–2024)
>>>>>>> 140b6fa (update pbw uas)
>>>>>>> 6742f4d (update pbw uas)
>>>>>>> ce1a772 (update pbw uas)
            </button>
          </h2>
          <div
            id="collapseTwo"
            class="accordion-collapse collapse"
            data-bs-parent="#accordionExample"
          >
            <div class="accordion-body">
              <strong>This is the second item’s accordion body.</strong> It is
              hidden by default, until the collapse plugin adds the appropriate
              classes that we use to style each element. These classes control
              the overall appearance, as well as the showing and hiding via CSS
              transitions. You can modify any of this with custom CSS or
              overriding our default variables. It’s also worth noting that just
              about any HTML can go within the <code>.accordion-body</code>,
              though the transition does limit overflow.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseThree"
              aria-expanded="false"
              aria-controls="collapseThree"
            >
<<<<<<< HEAD
              SMP Negeri 2 Semarang (2021–2018)
=======
<<<<<<< HEAD
              SMP Negeri 2 Semarang (2021–2018)
=======
<<<<<<< HEAD
              SMP Negeri 2 Semarang (2021–2018)
=======
              SMP Negeri 2 Demak(2018-2021)
>>>>>>> 140b6fa (update pbw uas)
>>>>>>> 6742f4d (update pbw uas)
>>>>>>> ce1a772 (update pbw uas)
            </button>
          </h2>
          <div
            id="collapseThree"
            class="accordion-collapse collapse"
            data-bs-parent="#accordionExample"
          >
            <div class="accordion-body">
              <strong>This is the third item’s accordion body.</strong> It is
              hidden by default, until the collapse plugin adds the appropriate
              classes that we use to style each element. These classes control
              the overall appearance, as well as the showing and hiding via CSS
              transitions. You can modify any of this with custom CSS or
              overriding our default variables. It’s also worth noting that just
              about any HTML can go within the <code>.accordion-body</code>,
              though the transition does limit overflow.
            </div>
          </div>
        </div>
      </div>
    </section>
    <footer class="text-center p-5">
      <div>
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 6742f4d (update pbw uas)
>>>>>>> ce1a772 (update pbw uas)
        <i class="h2 bi bi-instagram p-2"></i>
        <i class="h2 bi bi-twitter p-2"></i>
        <i class="h2 bi bi-whatsapp p-2"></i>
      </div>
      <div><p>Aprilyani Nur Safitri &copy; 2023</p></div>
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
=======
       <a href="https://www.instagram.com/gavin_alphared"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
				<a href="https://twitter.com/udinusofficial"><i class="bi bi-twitter h2 p-2 text-dark"></i></a>
				<a href="https://wa.me/6281953382671"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
      </div>
      
      <div><p>Gavin Alphared &copy; 2025</p></div>
>>>>>>> 140b6fa (update pbw uas)
>>>>>>> 6742f4d (update pbw uas)
>>>>>>> ce1a772 (update pbw uas)
    </footer>
    <button
      id="backToTop"
      class="btn btn-danger rounded-circle position-fixed bottom-0 end-0 m-3 d-none"
    >
      <i class="bi bi-arrow-up" title="Back to Top"></i>
    </button>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>

    <script type="text/javascript">
      function waktu() {
        const waktu = new Date();
        const arrBulan = [
          "1",
          "2",
          "3",
          "4",
          "5",
          "6",
          "7",
          "8",
          "9",
          "10",
          "11",
          "12",
        ];
        const tanggal = waktu.getDate();
        const bulan = waktu.getMonth();
        const tahun = waktu.getFullYear();
        const jam = waktu.getHours();
        const menit = waktu.getMinutes();
        const detik = waktu.getSeconds();

        const tanggal_full = tanggal + "/" + arrBulan[bulan] + "/" + tahun;
        const jam_full = jam + ":" + menit + ":" + detik;

        document.getElementById("tanggal").innerHTML = tanggal_full;
        document.getElementById("jam").innerHTML = jam_full;
      }

      setInterval(waktu, 1000);
      waktu();
    </script>

    <script>
      const html = document.getElementById("htmlPage");
      const btnDark = document.getElementById("btn-dark-mode");
      const btnLight = document.getElementById("btn-light-mode");

      function setDarkMode() {
        html.setAttribute("data-bs-theme", "dark");
        btnDark.classList.add("active");
        btnLight.classList.remove("active");
        localStorage.setItem("theme", "dark");
      }

      function setLightMode() {
        html.setAttribute("data-bs-theme", "light");
        btnLight.classList.add("active");
        btnDark.classList.remove("active");
        localStorage.setItem("theme", "light");
      }

      const savedTheme = localStorage.getItem("theme");
      if (savedTheme === "dark") {
        setDarkMode();
      } else {
        setLightMode();
      }

      btnDark.addEventListener("click", setDarkMode);
      btnLight.addEventListener("click", setLightMode);

      const backToTop = document.getElementById("backToTop");

      window.addEventListener("scroll", function () {
        if (window.scrollY > 1000) {
          backToTop.classList.remove("d-none");
          backToTop.classList.add("d-block");
        } else {
          backToTop.classList.remove("d-block");
          backToTop.classList.add("d-none");
        }
      });

      backToTop.addEventListener("click", function () {
        window.scrollTo({ top: 0, behavior: "smooth" });
      });
    </script>
  </body>
</html>
