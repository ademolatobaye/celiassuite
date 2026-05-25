<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Gallery | Celia's Suites</title>
    <meta name="description" content="Browse the Celia's Suites gallery and see our rooms, ambience, and hospitality spaces before planning your stay in Abeokuta.">
    <meta name="keywords" content="Celia's Suites gallery, hotel photos Abeokuta, room gallery Ogun State, hospitality images Nigeria, hotel picture gallery Abeokuta, accommodation photos Ogun State, event space images Abeokuta, room interior photos Nigeria, hotel environment Abeokuta">
    <meta name="author" content="Ademola Omomeji, THEADEMOLA, THEADEMOLAOMOMEJI">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#aa8453">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://celiassuites.com/gallery.php">
    <meta property="og:title" content="Gallery | Celia's Suites">
    <meta property="og:description" content="Browse the Celia's Suites gallery and see our rooms, ambience, and hospitality spaces before planning your stay in Abeokuta.">
    <meta property="og:image" content="https://celiassuites.com/icon.png">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://celiassuites.com/gallery.php">
    <meta property="twitter:title" content="Gallery | Celia's Suites">
    <meta property="twitter:description" content="Browse the Celia's Suites gallery and see our rooms, ambience, and hospitality spaces before planning your stay in Abeokuta.">
    <meta property="twitter:image" content="https://celiassuites.com/icon.png">
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dark-mode.css">
    <style>
        .gallery-grid {
            row-gap: 10px;
        }

        .gallery-grid .gallery-item {
            padding-top: 14px;
        }

        .gallery-grid .gallery-box {
            height: 100%;
            /* border-radius: 14px; */
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12);
            background: #fff;
        }

        .gallery-grid .gallery-img {
            aspect-ratio: 4 / 3;
        }

        .gallery-grid .gallery-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.35s ease;
        }

        .gallery-grid .gallery-box:hover .gallery-img img {
            transform: scale(1.04);
        }

        @media (max-width: 767.98px) {
            .gallery-grid .gallery-img {
                aspect-ratio: 1 / 1;
            }
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>
    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewbox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
        </svg>
    </div>
    <!-- Navbar -->
   <?php
   include("header.php");
   ?>

    <!-- Header Banner -->
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="img/slider/3.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left caption mt-90">
                    <h5> Celia's Suites</h5>
                    <h1>Our Gallery</h1>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Image Gallery -->
    <section class="section-padding">
        <div class="container">
            <div class="row gallery-grid">
                <div class="col-md-12">
                    <div class="section-subtitle">Images</div>
                    <div class="section-title">Image Gallery</div>
                </div>

                <?php
                include("db_conn.php");
                $sql = "SELECT * FROM `gallery_table` ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                <div class="col-sm-6 col-lg-4 gallery-item">
                    <a href="admin/<?php echo $row['galleryimage']; ?>" class="img-zoom">
                        <div class="gallery-box">
                            <div class="gallery-img">
                                <img src="admin/<?php echo $row['galleryimage']; ?>" class="img-fluid mx-auto d-block" alt="Gallery image">
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                    }
                } else {
                ?>
                <div class="col-12">
                    <p class="text-center mb-0">No gallery images available yet.</p>
                </div>
                <?php
                }
                ?>

            </div>
        </div>
    </section>
   
   
    <!-- Footer -->
   <?php
   include("footer.php");
   ?>

    <!-- jQuery -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery-migrate-3.5.0.min.js"></script>
    <script src="js/modernizr-2.6.2.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.isotope.v3.0.2.js"></script>
    <script src="js/pace.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scrollIt.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/YouTubePopUp.js"></script>
    <script src="js/select2.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script src="js/custom.js"></script>
<script src="js/dark-mode.js"></script>
</body>
</html>
