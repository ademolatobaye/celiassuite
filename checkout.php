<?php
include("db_conn.php");

// ini_set('display_errors', '1');
// 	require 'includes/PHPMailer.php';
// 	require 'includes/SMTP.php';
// 	require 'includes/Exception.php';
// //Define name spaces
// 	use PHPMailer\PHPMailer\PHPMailer;
// 	use PHPMailer\PHPMailer\SMTP;
// 	use PHPMailer\PHPMailer\Exception;

if (!isset($_REQUEST['booking_id'])) {
    header("Location: rooms.php");
    exit();
}

$bookingId = $_REQUEST['booking_id'];

$query = "SELECT * FROM bookings WHERE booking_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $bookingId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$booking = mysqli_fetch_assoc($result);

$checkIn = date("jS F, Y", strtotime($booking['check_in']));
$checkOut = date("jS F, Y", strtotime($booking['check_out']));
$customer_email = $booking['customer_email'];
$customer_name = $booking['customer_name'];
$customer_phone = $booking['customer_phone'];
$nightCount = 0;

if (!empty($booking['check_in']) && !empty($booking['check_out'])) {
    $checkInDate = new DateTime($booking['check_in']);
    $checkOutDate = new DateTime($booking['check_out']);
    $nightCount = $checkInDate->diff($checkOutDate)->days;
}

$amount = number_format((float) $booking['price'], 2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Checkout | Celia's Suites</title>
    <meta name="description" content="Review your reservation details and proceed with your Celia's Suites booking checkout securely and clearly.">
    <meta name="keywords" content="Celia's Suites checkout, hotel checkout Abeokuta, reservation checkout Ogun State, book stay Nigeria, confirm room booking Abeokuta, hotel reservation summary Nigeria">
    <meta name="author" content="Ademola Omomeji, THEADEMOLA, THEADEMOLAOMOMEJI">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#aa8453">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://celiassuites.com/checkout.php">
    <meta property="og:title" content="Checkout | Celia's Suites">
    <meta property="og:description" content="Review your reservation details and proceed with your Celia's Suites booking checkout securely and clearly.">
    <meta property="og:image" content="https://celiassuites.com/icon.png">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://celiassuites.com/checkout.php">
    <meta property="twitter:title" content="Checkout | Celia's Suites">
    <meta property="twitter:description" content="Review your reservation details and proceed with your Celia's Suites booking checkout securely and clearly.">
    <meta property="twitter:image" content="https://celiassuites.com/icon.png">
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dark-mode.css">
    <style>
        .checkout-section {
            padding: 120px 0 90px;
        }

        .checkout-card {
            background: #fff;
            border: 1px solid rgba(170, 132, 83, 0.18);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            padding: 40px 32px;
        }

        .checkout-card h3 {
            margin-bottom: 10px;
        }

        .checkout-note {
            margin-bottom: 30px;
            color: #666;
        }

        .checkout-summary {
            background: #f8f5f0;
            padding: 24px;
            margin-bottom: 25px;
        }

        .checkout-summary-item {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(34, 34, 34, 0.08);
        }

        .checkout-summary-item:last-child {
            border-bottom: none;
        }

        .payment-option {
            border: 1px solid rgba(170, 132, 83, 0.25);
            padding: 18px 20px;
            margin-bottom: 20px;
        }

        .payment-option label {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
            cursor: pointer;
        }

        .payment-option span {
            color: #666;
            font-size: 14px;
        }

        body.dark-mode .checkout-card {
            background: #1a1a1a;
            border-color: #333;
        }

        body.dark-mode .checkout-summary {
            background: #222;
        }

        body.dark-mode .checkout-note,
        body.dark-mode .payment-option span {
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"><span></span></div>
        </div>
    </div>

    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewbox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
        </svg>
    </div>

    <?php include("header.php"); ?>

    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="img/slider/2.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 caption mt-90">
                    <h5>Celia's Suites</h5>
                    <h1>Checkout</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="checkout-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="checkout-card">
                        <h3>Complete Your Booking</h3>
                        <p class="checkout-note">Choose how you would like to proceed with this booking.</p>

                        <div class="checkout-summary">
                            <div class="checkout-summary-item">
                                <strong>Booking ID</strong>
                                <span><?php echo htmlspecialchars($booking['booking_id']); ?></span>
                            </div>

                            <div class="checkout-summary-item">
                                <strong>Fullname</strong>
                                <span><?php echo htmlspecialchars($booking['customer_name']); ?></span>
                            </div>

                            <div class="checkout-summary-item">
                                <strong>Email Address</strong>
                                <span><?php echo htmlspecialchars($booking['customer_email']); ?></span>
                            </div>

                            <div class="checkout-summary-item">
                                <strong>Phone Number</strong>
                                <span><?php echo htmlspecialchars($booking['customer_phone']); ?></span>
                            </div>

                            <div class="checkout-summary-item">
                                <strong>Selected Room</strong>
                                <span><?php echo htmlspecialchars($booking['room_name']); ?></span>
                            </div>

                            <div class="checkout-summary-item">
                                <strong>Stay</strong>
                                <span><?php echo htmlspecialchars($checkIn . " - " . $checkOut); ?></span>
                            </div>

                            <div class="checkout-summary-item">
                                <strong>Nights</strong>
                                <span><?php echo (int) $nightCount; ?> Night<?php echo $nightCount === 1 ? '' : 's'; ?></span>
                            </div>

                            <div class="checkout-summary-item">
                                <strong>Total</strong>
                                <span>&#8358;<?php echo $amount; ?></span>
                            </div>
                        </div>

                        <form action="" method="post">
                            <?php
                            include("db_conn.php");
                            $year = date("Y");
                            $checkInFormatted  = date("jS F Y", strtotime($checkIn));
                            $checkOutFormatted = date("jS F Y", strtotime($checkOut));
                            error_reporting(E_ALL);
                            if(isset($_REQUEST['submit'])){
                                $paymentMethod = trim(addslashes($_REQUEST['payment_method']));

                                // UPDATING VALUES INTO THE DATABASE.
                                $sql="UPDATE bookings SET payment_method ='$paymentMethod' WHERE booking_id ='$bookingId' ";
                                mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                $num = mysqli_insert_id($conn);

                                if(mysqli_affected_rows($conn)!= 1){
                                    $message = "Error inserting record.";
                                } else {

            // Send confirmation email using PHPMailer
    //         $mail = new PHPMailer(true);

    //         try {
    //             // Server settings
    //             $mail->isSMTP();
    //             $mail->Host = 'mail.celiassuites.com';
    //             $mail->SMTPAuth = true;
    //             $mail->Username = 'info@celiassuites.com';
    //             $mail->Password = MAIL_PASSWORD;
    //             $mail->SMTPSecure = 'ssl';
    //             $mail->Port = 465;

    //             // Recipients
    //             $mail->setFrom('info@celiassuites.com', 'Celia Suites');
    //             $mail->addAddress($customer_email);

    //             // Content
    //             $mail->isHTML(true);
    //             $mail->Subject = 'Booking Notification';
    //             $mail->Body = "<style>

    //     html,
    //     body {
    //         margin: 0 auto !important;
    //         padding: 0 !important;
    //         height: 100% !important;
    //         width: 100% !important;
    //         font-family: 'Roboto', sans-serif !important;
    //         font-size: 14px;
    //         margin-bottom: 10px;
    //         line-height: 24px;
    //         color: #aa8453;
    //         font-weight: 400;
    //     }
    //     * {
    //         -ms-text-size-adjust: 100%;
    //         -webkit-text-size-adjust: 100%;
    //         margin: 0;
    //         padding: 0;
    //     }
    //     table,
    //     td {
    //         mso-table-lspace: 0pt !important;
    //         mso-table-rspace: 0pt !important;
    //     }
    //     table {
    //         border-spacing: 0 !important;
    //         border-collapse: collapse !important;
    //         table-layout: fixed !important;
    //         margin: 0 auto !important;
    //     }
    //     table table table {
    //         table-layout: auto;
    //     }
    //     a {
    //         text-decoration: none;
    //     }
    //     img {
    //         -ms-interpolation-mode:bicubic;
    //     }
    // </style>

    // <center style='width: 100%; background-color: #f5f6fa;'>
    //     <table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#f5f6fa'>
    //         <tr>
    //            <td style='padding: 40px 0;'>
    //                 <table style='width:100%;max-width:620px;margin:0 auto;'>
    //                     <tbody align='center'>
	// 						<a href='https://celiassuites.com' target='_blank'><img style='height: 60px' src='https://celiassuites.com/logo.png' alt='Celia Suites'></a>

	// 						</tbody>
    //                 </table>
    //                 <table style='width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;'>
    //                     <tbody align='left'>
                            
    //                         <tr>
    //                             <td style='padding: 0 30px 20px;'>

    //                             <p></p><br>

	// 								<p style='margin-bottom: 10px;'>BOOKING NOTIFICATION.</p>

	// 								<p style='margin-bottom: 10px;'>Dear $customer_name, your booking has been received. You selected Cash on Arrival. Below are details of the booking.</p>

    //                                 <p style='margin-bottom: 10px;'>Name: <strong> $customer_name.</strong><br>
	// 								<p style='margin-bottom: 10px;'>Email: <strong> $customer_email.</strong><br>
	// 								<p style='margin-bottom: 10px;'>Phone Number: <strong> $customer_phone.</strong><br>
	// 								<p style='margin-bottom: 10px;'>Booking ID: <strong> $booking_id.</strong><br>
	// 								<p style='margin-bottom: 10px;'>Check In Date: <strong> $checkInFormatted.</strong><br>
	// 								<p style='margin-bottom: 10px;'>Check Out Date: <strong> $checkOutFormatted.</strong><br>
	// 								<p style='margin-bottom: 10px;'>Number of Guest(s): <strong> $guest.</strong>
    //                                  <hr>

    //                             </td>
    //                         </tr>

    //                     </tbody>
    //                 </table>
    //                 <table style='width:100%;max-width:620px;margin:0 auto;'>
    //                     <tbody>
    //                         <tr>
    //                             <td style='text-align: center; padding:25px 20px 0;'>
    //                                 <p style='font-size: 13px;'>Copyright © $year <strong>Celia Suites</strong>. All Rights Reserved. <br> </p>

    //                                 <p style='padding-top: 15px; font-size: 12px;'>This email was sent to you recognized guest on <a style='color: #aa8453; text-decoration:none;' href=''><strong>Celia Suites</strong></a>.</p>
    //                             </td>
    //                         </tr>
    //                     </tbody>
    //                 </table>
    //            </td>
    //         </tr>
    //     </table>
    // </center>";

    //             $mail->send();
    //         } catch (Exception $e) {
    //             error_log("Mailer Error: " . $mail->ErrorInfo);
    //         }

                                    echo "<script>alert('Dear $customer_name, your booking has been received. You selected payment on Arrival.'); window.location.href='rooms.php';</script>";
                                }
                            }
                            ?>

                            <input type="hidden" name="booking_id" value="<?php echo htmlspecialchars($booking['booking_id']); ?>">

                            <div class="payment-option">
                                <label for="cash_on_arrival">
                                    <input type="radio" id="cash_on_arrival" name="payment_method" value="cash_on_arrival" checked>
                                    <div>
                                        <strong>Pay on Arrival</strong> <br>
                                        <span>Reserve now and complete payment when you arrive at the hotel.</span>
                                    </div>
                                </label>
                            </div>

                            <button type="submit" name="submit" class="btn-form1-submit">Confirm Booking</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("footer.php"); ?>

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
