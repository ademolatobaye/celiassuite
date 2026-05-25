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

if (!isset($_REQUEST['room_uin'])){
    header("Location: rooms.php");
    exit();
}

$room_uin = $_REQUEST['room_uin'];

$query = "SELECT * FROM room_table WHERE room_uin = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $room_uin);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$room = mysqli_fetch_assoc($result);
$roomPrice = isset($room['price']) ? (float) $room['price'] : 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Book Room | Celia's Suites</title>
    <meta name="description" content="Book your stay at Celia's Suites in Abeokuta and reserve a comfortable room with our simple booking process.">
    <meta name="keywords" content="Book room Celia's Suites, book hotel room Abeokuta, reserve accommodation Ogun State, hotel reservation Nigeria, room booking Abeokuta, online hotel booking Ogun State, suite reservation Abeokuta, reserve stay Nigeria">
    <meta name="author" content="Ademola Omomeji, THEADEMOLA, THEADEMOLAOMOMEJI">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#aa8453">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://celiassuites.com/book-room.php">
    <meta property="og:title" content="Book Room | Celia's Suites">
    <meta property="og:description" content="Book your stay at Celia's Suites in Abeokuta and reserve a comfortable room with our simple booking process.">
    <meta property="og:image" content="https://celiassuites.com/icon.png">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://celiassuites.com/book-room.php">
    <meta property="twitter:title" content="Book Room | Celia's Suites">
    <meta property="twitter:description" content="Book your stay at Celia's Suites in Abeokuta and reserve a comfortable room with our simple booking process.">
    <meta property="twitter:image" content="https://celiassuites.com/icon.png">
    <link rel="icon" href="img/favicon.png" type="image/png" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dark-mode.css">
    
    <style>
        /* Keep the custom date input inside a plain white wrapper. */
        .booking-date-inner {
            position: relative;
            background: #fff;
            overflow: hidden;
        }

        /* Remove the theme's default pseudo-icon from the date wrapper. */
        .booking-date-inner:after {
            content: none !important;
        }

        /* Make the native date input match the rest of the form fields. */
        .booking-date-input {
            display: block;
            width: 100%;
            height: 62px;
            min-height: 62px;
            line-height: 22px;
            padding: 19px 48px 19px 19.5px !important;
            cursor: pointer;
            background: #fff !important;
            color: #222 !important;
            border: none !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            font-family: 'Outfit', sans-serif;
            font-size: 15px;
            color-scheme: light;
        }

        /* Keep the browser's date-picker icon clickable and neatly aligned. */
        .booking-date-input::-webkit-calendar-picker-indicator {
            cursor: pointer;
            opacity: 0.9;
            padding: 0;
            margin: 0;
        }

        /* Force all parts of the native date text to stay dark and readable. */
        .booking-date-input::-webkit-datetime-edit,
        .booking-date-input::-webkit-datetime-edit-fields-wrapper,
        .booking-date-input::-webkit-datetime-edit-text,
        .booking-date-input::-webkit-datetime-edit-month-field,
        .booking-date-input::-webkit-datetime-edit-day-field,
        .booking-date-input::-webkit-datetime-edit-year-field {
            color: #222;
        }

        /* Preserve the same styling when the date field receives focus. */
        .booking-date-input:focus {
            outline: none;
            background: #fff !important;
            color: #222 !important;
        }

        /* Remove Firefox's default inner date-input border. */
        .booking-date-input::-moz-focus-inner {
            border: 0;
        }

        /* Normalize spacing between all booking-form field rows. */
        .booking-booking-form .input1_wrapper,
        .booking-booking-form .select1_wrapper {
            margin-bottom: 15px;
        }

        /* Prevent Select2 from adding extra space under the select row. */
        .booking-booking-form .select2 {
            margin-bottom: 0;
        }

        /* Keep date fields white even while the page is in dark mode. */
        body.dark-mode .booking-date-input {
            background: #fff !important;
            color: #222 !important;
        }

        /* Keep the date wrapper white in dark mode as well. */
        body.dark-mode .booking-date-inner {
            background: #fff !important;
        }

        /* Keep native date text dark and readable in dark mode. */
        body.dark-mode .booking-date-input::-webkit-datetime-edit,
        body.dark-mode .booking-date-input::-webkit-datetime-edit-fields-wrapper,
        body.dark-mode .booking-date-input::-webkit-datetime-edit-text,
        body.dark-mode .booking-date-input::-webkit-datetime-edit-month-field,
        body.dark-mode .booking-date-input::-webkit-datetime-edit-day-field,
        body.dark-mode .booking-date-input::-webkit-datetime-edit-year-field {
            color: #222 !important;
        }

        /* Leave the calendar icon untouched because the field remains white. */
        body.dark-mode .booking-date-input::-webkit-calendar-picker-indicator {
            filter: none;
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
    <div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="img/slider/1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 caption mt-90">
                    <h5>Celia's Suites</h5>
                    <h1>Book A Room</h1>
                </div>
            </div>
        </div>
    </div>
   
                        <!-- Booking From -->
                    <div class="col-md-5 offset-md-2">
                        <div class="booking-box">
                            <div class="head-box">
                                <h4 style="color: black;">Book Room</h4>
                            </div>
                            <div class="booking-inner clearfix">
                                <form action="" method="post" class="form1 booking-booking-form clearfix">

                                <?php
                                include("db_conn.php");
                                date_default_timezone_set("Africa/Lagos");
                                $booking_id = 'CS-' . strtoupper(uniqid());
                                $date= date('Y-m-d');
                                $formatted_date = date("l jS F, Y", strtotime($date));
                                $year= date("Y");
                                error_reporting(E_ALL);
                                if(isset($_REQUEST['book'])){
                                    $customer_name = trim(addslashes($_REQUEST['fullname']));
                                    $customer_email = trim(addslashes($_REQUEST['email']));
                                    $customer_phone = trim(addslashes($_REQUEST['phone']));
                                    $checkIn = trim(addslashes($_REQUEST['checkin']));
                                    $checkOut = trim(addslashes($_REQUEST['checkout']));
                                    $guest = trim(addslashes($_REQUEST['guest']));
                                    $room_name = trim(addslashes($_REQUEST['room']));
                                    $price = (float) str_replace(array('₦', ','), '', trim($_REQUEST['price']));
                                    
                                    $checkInFormatted  = date("jS F Y", strtotime($checkIn));
                                    $checkOutFormatted = date("jS F Y", strtotime($checkOut));

                                    //Inserting into booking details into database
                                    $sql= "INSERT INTO bookings(booking_id, `date`, customer_name, customer_email, customer_phone, price, room_name, check_in, check_out, guests, `status`) VALUES('$booking_id', '$date', '$customer_name', '$customer_email', '$customer_phone', '$price', '$room_name', '$checkIn', '$checkOut', '$guest', 'Pending')";

                                     mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                        $num = mysqli_insert_id($conn);
                                        if(mysqli_affected_rows($conn)!= 1){
                                        $message = "Error inserting record.";
                                        }
                                        else{

            // Send confirmation email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'mail.celiassuites.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'info@celiassuites.com';
                $mail->Password = MAIL_PASSWORD;
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                // Recipients
                $mail->setFrom('info@celiassuites.com', 'Celia Suites');
                $mail->addAddress('ademolaomomeji@gmail.com');

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'New Booking Notification';
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
            color: #aa8453;
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
                        <tbody align='center'>
							<a href='https://celiassuites.com' target='_blank'><img style='height: 60px' src='https://celiassuites.com/logo.png' alt='Celia Suites'></a>

							</tbody>
                    </table>
                    <table style='width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;'>
                        <tbody align='left'>
                            
                            <tr>
                                <td style='padding: 0 30px 20px;'>

                                <p></p><br>

									<p style='margin-bottom: 10px;'>New Booking Received.</p>

									<p style='margin-bottom: 10px;'>A new booking has been made for $room_name. Below are details of the booking.</p>

                                    <p style='margin-bottom: 10px;'>Customer Name: <strong> $customer_name.</strong><br>
									<p style='margin-bottom: 10px;'>Customer Email: <strong> $customer_email.</strong><br>
									<p style='margin-bottom: 10px;'>Customer Phone: <strong> $customer_phone.</strong><br>
									<p style='margin-bottom: 10px;'>Booking ID: <strong> $booking_id.</strong><br>
									<p style='margin-bottom: 10px;'>Check In Date: <strong> $checkInFormatted.</strong><br>
									<p style='margin-bottom: 10px;'>Check Out Date: <strong> $checkOutFormatted.</strong><br>
									<p style='margin-bottom: 10px;'>Number of Guest(s): <strong> $guest.</strong>
                                     <hr>

                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <table style='width:100%;max-width:620px;margin:0 auto;'>
                        <tbody>
                            <tr>
                                <td style='text-align: center; padding:25px 20px 0;'>
                                    <p style='font-size: 13px;'>Copyright © $year <strong>Celia Suites</strong>. All Rights Reserved. <br> </p>

                                    <p style='padding-top: 15px; font-size: 12px;'>This email was sent to you as a registered Admin on <a style='color: #aa8453; text-decoration:none;' href=''><strong>Celia Suites</strong></a>.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
               </td>
            </tr>
        </table>
    </center>";

                $mail->send();
            } catch (Exception $e) {
                error_log("Mailer Error: " . $mail->ErrorInfo);
            }

                                        // $_SESSION["customer_name"] = $customer_name;
                                        // $_SESSION["customer_email"] = $customer_email;
                                        // $_SESSION["booking_id"] = $booking_id;

                                        echo "<script>alert('Dear $customer_name, just one more step to complete your booking.');
                                            window.location.href='checkout.php?booking_id=$booking_id';</script>";
                                    }
                                }

                                
                                ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Input your fullname</label>
                                                <div class="input1_inner has-user-icon">
                                                    <input type="text" name="fullname" class="form-control input" placeholder="Input your fullname" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Input your Email Address</label>
                                                <div class="input1_inner has-email-icon">
                                                    <input type="text" name="email" class="form-control input" placeholder="Input your Email Address" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Input your Phone Number</label>
                                                <div class="input1_inner has-phone-icon">
                                                    <input type="text" name="phone" class="form-control input" placeholder="Input your Phone Number" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Check In</label>
                                                <div class="input1_inner booking-date-inner">
                                                    <input type="date" id="checkin" name="checkin" class="form-control input booking-date-input" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Check Out</label>
                                                <div class="input1_inner booking-date-inner">
                                                    <input type="date" id="checkout" name="checkout" class="form-control input booking-date-input" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="select1_wrapper">
                                                <label>Guest(s)</label>
                                                <div class="select1_inner">
                                                    <select class="select2 select" name="guest" style="width: 100%" required>
                                                        <option value="">Number Of Guest(s)</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Selected Room</label>
                                                <div class="input1_inner has-room-icon">
                                                    <input type="text" name="room" class="form-control input" value="<?php echo $room['room_name']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="input1_wrapper">
                                                <label>Amount</label>
                                                <div class="input1_inner has-money-icon">
                                                    <input type="text" id="price" name="price" class="form-control input" value="&#8358;<?php echo number_format($roomPrice, 2); ?>" readonly data-base-price="<?php echo htmlspecialchars((string) $roomPrice, ENT_QUOTES); ?>">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <button type="submit" name="book" class="btn-form1-submit mt-15" onclick="return confirm('Are you sure to proceed?')">Book Room</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

    <!-- Facilties -->
    <section class="facilties section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-subtitle">Our Services</div>
                    <div class="section-title">Hotel Facilities</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-wifi"></span>
                        <h5>Free High Speed Internet</h5>
                        <p>Enjoy fast and reliable WiFi access throughout your stay.</p>
                        <div class="facility-shape"> <span class="flaticon-wifi"></span> </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-car"></span>
                        <h5>Free Resident Car Parking</h5>
                        <p>Secure and convenient parking space for all our guests.</p>
                        <div class="facility-shape"> <span class="flaticon-car"></span> </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-bed"></span>
                        <h5>24-hours Room Service</h5>
                        <p>Order meals and services anytime, day or night.</p>
                        <div class="facility-shape"> <span class="flaticon-bed"></span> </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-group"></span>
                        <h5>Conference Facilities</h5>
                        <p>Modern spaces designed for meetings business events.</p>
                        <div class="facility-shape"> <span class="flaticon-group"></span> </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-call"></span>
                        <h5>24-hours Reception</h5>
                        <p>Friendly front desk support available around the clock.</p>
                        <div class="facility-shape"> <span class="flaticon-call"></span> </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-world"></span>
                        <h5>Business Services</h5>
                        <p>Professional services to support your work and productivity.</p>
                        <div class="facility-shape"> <span class="flaticon-world"></span> </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-breakfast"></span>
                        <h5>Bed and Breakfast</h5>
                        <p>Enjoy comfortable accomodation with complimentary breakfast included.</p>
                        <div class="facility-shape"> <span class="flaticon-breakfast"></span> </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-towel"></span>
                        <h5>Laundry Facilities</h5>
                        <p>Quick, convenient and professional laundry services for your comfort.</p>
                        <div class="facility-shape"> <span class="flaticon-towel"></span> </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-swimming"></span>
                        <h5>Gym Facilities</h5>
                        <p>Stay active with access to our fully equipped fitness center.</p>
                        <div class="facility-shape"> <span class="flaticon-swimming"></span> </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-world"></span>
                        <h5>Tour Operation</h5>
                        <p>Explore top destinations with our guided tour services.</p>
                        <div class="facility-shape"> <span class="flaticon-travel-guide"></span> </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-clock"></span>
                        <h5>Event Booking</h5>
                        <p>Your perfect venue options for celebrations and special occasions.</p>
                        <div class="facility-shape"> <span class="flaticon-clock"></span> </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                        <span class="flaticon-breakfast"></span>
                        <h5>Bar & Restaurant</h5>
                        <p>Enjoy delicious meals and refreshing drinks in a relaxing atmosphere.</p>
                        <div class="facility-shape"> <span class="flaticon-breakfast"></span> </div>
                    </div>
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
    
    <script>
        (function () {
            const checkInInput = document.getElementById("checkin");
            const checkOutInput = document.getElementById("checkout");
            const priceInput = document.getElementById("price");

            // Stop running if the expected booking inputs are missing.
            if (!checkInInput || !checkOutInput || !priceInput) {
                return;
            }

            // Read the selected room's single-night rate from the amount field.
            const basePrice = Number(priceInput.dataset.basePrice || 0);
            const nairaFormatter = new Intl.NumberFormat("en-NG", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            // Format calculated totals as a currency string for the amount field.
            function formatCurrency(amount) {
                return "₦" + nairaFormatter.format(amount);
            }

            // Convert the raw date input value into a safe Date object.
            function toDate(value) {
                if (!value) {
                    return null;
                }

                const date = new Date(value + "T00:00:00");
                return Number.isNaN(date.getTime()) ? null : date;
            }

            // Move a Date object forward by a given number of days.
            function addDays(date, days) {
                const result = new Date(date);
                result.setDate(result.getDate() + days);
                return result;
            }

            // Convert a Date object into the YYYY-MM-DD format used by date inputs.
            function toInputValue(date) {
                return date.toISOString().split("T")[0];
            }

            // Calculate the number of nights between check-in and check-out.
            function getNightCount() {
                const checkInDate = toDate(checkInInput.value);
                const checkOutDate = toDate(checkOutInput.value);

                if (!checkInDate || !checkOutDate || checkOutDate <= checkInDate) {
                    return 0;
                }

                const oneDay = 24 * 60 * 60 * 1000;
                return Math.round((checkOutDate - checkInDate) / oneDay);
            }

            // Update the displayed amount using the room price times the nights stayed.
            function updatePrice() {
                const nights = getNightCount();
                priceInput.value = formatCurrency(nights > 0 ? nights * basePrice : basePrice);
            }

            // Enforce today's date as the minimum and require at least one night stay.
            function updateDateLimits() {
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                const todayValue = toInputValue(today);

                checkInInput.min = todayValue;

                if (checkInInput.value && checkInInput.value < todayValue) {
                    checkInInput.value = todayValue;
                }

                const checkInDate = toDate(checkInInput.value) || today;
                const minimumCheckout = addDays(checkInDate, 1);
                const minimumCheckoutValue = toInputValue(minimumCheckout);

                checkOutInput.min = minimumCheckoutValue;

                if (checkOutInput.value && checkOutInput.value <= checkInInput.value) {
                    checkOutInput.value = minimumCheckoutValue;
                }
            }

            // When check-in changes, refresh the date rules and recalculate the amount.
            checkInInput.addEventListener("change", function () {
                updateDateLimits();
                updatePrice();
            });

            // When checkout changes, recalculate the amount only.
            checkOutInput.addEventListener("change", updatePrice);

            // Initialize the form state as soon as the page loads.
            updateDateLimits();
            updatePrice();
        })();
    </script>
</body>
</html>




