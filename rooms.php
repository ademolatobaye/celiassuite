<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Rooms | Celia's Suites</title>
    <meta name="description" content="Explore the rooms and suites at Celia's Suites in Abeokuta, designed for comfort, relaxation, and a memorable hospitality experience.">
    <meta name="keywords" content="Rooms at Celia's Suites, suites in Abeokuta, hotel rooms Abeokuta, accommodation rooms Ogun State, luxury suites Nigeria, business suite Abeokuta, royal deluxe Abeokuta, diplomatic suite Abeokuta, vintage suite Abeokuta, room rates Abeokuta, book hotel room Ogun State, premium lodging Nigeria, comfortable rooms Abeokuta">
    <meta name="author" content="Ademola Omomeji, THEADEMOLA, THEADEMOLAOMOMEJI">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#aa8453">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://celiassuites.com/rooms.php">
    <meta property="og:title" content="Rooms | Celia's Suites">
    <meta property="og:description" content="Explore the rooms and suites at Celia's Suites in Abeokuta, designed for comfort, relaxation, and a memorable hospitality experience.">
    <meta property="og:image" content="https://celiassuites.com/icon.png">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://celiassuites.com/rooms.php">
    <meta property="twitter:title" content="Rooms | Celia's Suites">
    <meta property="twitter:description" content="Explore the rooms and suites at Celia's Suites in Abeokuta, designed for comfort, relaxation, and a memorable hospitality experience.">
    <meta property="twitter:image" content="https://celiassuites.com/icon.png">
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dark-mode.css">
    <style>
        /* Fix room card details visibility in dark mode when flipped */
        body.dark-mode .square2 {
            background-color: #1b1b1b !important;
            border: 1px solid #333;
        }
        body.dark-mode .square-container2 h4,
        body.dark-mode .square-container2 h6,
        body.dark-mode .square-container2 p,
        body.dark-mode .square-container2 .room-facilities ul li {
            color: #ffffff !important;
        }
        body.dark-mode .square-container2 .room-facilities ul li i {
            color: #aa8453 !important;
        }
        body.dark-mode .square-container2 .btn-line a {
            color: #ffffff !important;
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
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="img/rooms/7.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-right caption mt-90">
                    <span>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                        <i class="star-rating"></i>
                    </span>
                    <h5>Celia's Suites Luxury Hotel</h5>
                    <h1>Rooms & Suites</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Rooms 3 -->
    <div class="rooms3 section-padding">
        <div class="container">
            <div class="row">
                <?php
                include("db_conn.php");
                $sql = "SELECT * FROM `room_table` ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                ?>
                <div class="col-md-4">
                    <div class="square-flip">
                        <div class="square bg-img" data-background="admin/roomupload/<?php echo $row['roomimage']; ?>">
                            <div class="square-container d-flex align-items-end justify-content-end">
                                <div class="box-title">
                                    <h6>&#8358;<?php echo number_format($row['price'], 2); ?></h6>
                                    <h4><?php echo $row['room_name']; ?></h4>
                                </div>
                            </div>
                            <div class="flip-overlay"></div>
                        </div>

                        <div class="square2">
                            <div class="square-container2">
                                <h6>&#8358;<?php echo number_format($row['price'], 2); ?></h6>
                                <h4><?php echo $row['room_name']; ?></h4>
                                <p><?php echo $row['description']; ?></p>
                                <div class="row room-facilities mb-30">
                                    <div class="col-md-6">
                                        <ul>
                                            <li><i class="flaticon-group"></i><?php echo $row['capacity']; ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="btn-line"><a href="book-room.php?room_uin=<?php echo $row['room_uin']; ?>">Book Now</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    
    </div>
   
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
