<?php
include("db_conn.php");
ini_set('display_errors', '1');
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Contact Us | Celia's Suites</title>
    <meta name="description" content="Contact Celia's Suites for reservations, enquiries, and support. Reach our team in Abeokuta for room bookings and hospitality information.">
    <meta name="keywords" content="Contact Celia's Suites, hotel contact Abeokuta, reservations Ogun State, hospitality enquiries Nigeria, phone number Celia's Suites, hotel address Abeokuta, booking enquiries Ogun State, customer care hotel Nigeria, room reservation contact Abeokuta">
    <meta name="author" content="Ademola Omomeji, THEADEMOLA, THEADEMOLAOMOMEJI">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#aa8453">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://celiassuites.com/contact.php">
    <meta property="og:title" content="Contact Us | Celia's Suites">
    <meta property="og:description" content="Contact Celia's Suites for reservations, enquiries, and support. Reach our team in Abeokuta for room bookings and hospitality information.">
    <meta property="og:image" content="https://celiassuites.com/icon.png">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://celiassuites.com/contact.php">
    <meta property="twitter:title" content="Contact Us | Celia's Suites">
    <meta property="twitter:description" content="Contact Celia's Suites for reservations, enquiries, and support. Reach our team in Abeokuta for room bookings and hospitality information.">
    <meta property="twitter:image" content="https://celiassuites.com/icon.png">
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dark-mode.css">
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
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="3" data-background="img/slider/1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-left caption mt-90">
                    <h5>Get in touch</h5>
                    <h1>Contact Us</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact -->
    <section class="contact section-padding">
        <div class="container">
            <div class="row mb-90">
                <div class="col-md-6 mb-60">
                    <h3>Celia's Suites Luxury Hotel</h3>
                    <p>Our services include well furnished suites, complimentary breakfast, tourism packages, indoor bar, meeting rooms, spa, car hire services.</p>
                    <div class="reservations mb-30">
                        <div class="icon"><span class="flaticon-call"></span></div>
                        <div class="text">
                            <p>Reservation</p> <a href="tel:2348099913500">+234 809 991 3500</a>
                        </div>
                    </div>
                    <div class="reservations mb-30">
                        <div class="icon"><span class="flaticon-envelope"></span></div>
                        <div class="text">
                            <p>Email Info</p> <a href="mailto:booking@celiasuites.com">booking@celiasuites.com</a>
                        </div>
                    </div>
                    <div class="reservations">
                        <div class="icon"><span class="flaticon-location-pin"></span></div>
                        <div class="text">
                            <p>Address</p> Celia's suites, No. 1, Wole Soyinka road, <br>
                            Ibara G.R.A, Abeokuta, Ogun state, Nigeria.
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mb-30 offset-md-1">
                   
                    <h3>Get in touch</h3>

                    <form method="post">

                     <?php
                        $year = date("Y");
                        error_reporting(E_ALL);
                        if(isset($_REQUEST["submit"])){
                            $fullname =trim(addslashes($_REQUEST["fullname"]));
                            $email = trim(addslashes($_REQUEST["email"]));
                            $phone = trim(addslashes($_REQUEST["phone"]));
                            $message = trim(addslashes($_REQUEST["message"]));

// Create instance of PHPMailer
	$mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "mail.celiassuites.com";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "ssl";
//Port to connect smtp
	$mail->Port = "465";
//Set gmail username
	$mail->Username = "info@celiassuites.com";
//Set gmail password
	$mail->Password = MAIL_PASSWORD;
//Email subject
	$mail->Subject = "New Message Notification";
//Set sender email
	$mail->setFrom('info@celiassuites.com', $fullname);
//Enable HTML
	$mail->isHTML(true);
//Attachment


//Email body
	$mail->Body = "<style>
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: 'Roboto', sans-serif !important;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 24px;
            color: #8094ae;
            font-weight: 400;
        }
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
        }
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }
        table table table {
            table-layout: auto;
        }
        a {
            text-decoration: none;
        }
        img {
            -ms-interpolation-mode:bicubic;
        }
    </style>

    <center style='width: 100%; background-color: #f5f6fa;'>
        <table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#f5f6fa'>
            <tr>
                <td style='padding: 40px 0;'>
                    <table style='width:100%;max-width:620px;margin:0 auto;'>
                        <tbody>
                            <tr>
                                <td style='text-align: center; padding-bottom:25px'>
                                    <a href='https://celiassuites.com'><img style='height: 60px' src='https://celiassuites.com/logo.png' alt='logo'></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table style='width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;'>
                        <tbody>
                            <tr>
                                <td style='padding: 30px 30px 15px 30px; text-align: center;'>
                                    <h2 style='font-size: 18px; color: #aa8453; font-weight: 600; margin: 0;'>New Message Notification</h2>
                                </td>
                            </tr>
                            <tr>
                                <td style='padding: 0 30px 20px; text-align: center;'>
                                    <p style='margin-bottom: 10px;'>$message</p>
                                    <h1 style='font-size: 35px; color: #aa8453; font-weight: 600; margin: 0;'></h1>
                                
                                </td>
                            </tr>
                           
                           
                        </tbody>
                    </table>
                    <table style='width:100%;max-width:620px;margin:0 auto;'>
                        <tbody>
                            <tr>
                                <td style='text-align: center; padding:25px 20px 0;'>
                                    <p style='font-size: 13px;'>Copyright © $year Celia Suites. All rights reserved. <br> </p>
                                    
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </center>";
//Add recipient
	$mail->addAddress("booking@celiasuites.com");
//Finally send email
	if ( $mail->send() ) {


                            echo"<script>alert('Dear $fullname, Thank you for contacting us. We will check your message and revert to you as soon as possible.')</script>";

                            }
                         else {
    echo "<script>alert('Mail error: " . $mail->ErrorInfo . "')</script>";
}
                        }

                        

                        ?>

                        <!-- form elements -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input name="fullname" type="text" placeholder="Your Name *" required="">
                            </div>

                            <div class="col-md-6 form-group">
                                <input name="email" type="email" placeholder="Your Email *" required="">
                            </div>

                            <div class="col-md-6 form-group">
                                <input name="phone" type="text" placeholder="Your Number *" required="">
                            </div>

                            <div class="col-md-12 form-group">
                                <textarea name="message" id="message" cols="30" rows="4" placeholder="Message *" required=""></textarea>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" name="submit" class="butn-dark2"><span>Send Message</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Map Section -->
            <div class="row">
                <div class="col-md-12 map animate-box" data-animate-effect="fadeInUp">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.977483818705!2d3.339106374050035!3d7.1286008158379435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103a4b81263217d7%3A0x66ade7ff82dfd047!2sCelia&#39;s%20Suites!5e0!3m2!1sen!2sng!4v1779135023891!5m2!1sen!2sng" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
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