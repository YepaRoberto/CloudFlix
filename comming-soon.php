<!DOCTYPE html>
<html lang="en">

    
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1,
            shrink-to-fit=no">
        <meta name="description" content="Coming Soon - <?php echo $_GET['anime'] ?>">

        <title>Coming Soon - <?php echo $_GET['rq'] ?> </title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon"
            href="assets/media/favicon-light.png">

        <!-- All CSS files -->
        <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/vendor/font-awesome.css">
        <link rel="stylesheet" href="assets/css/vendor/slick.css">
        <link rel="stylesheet" href="assets/css/vendor/slick-theme.css">
        <link rel="stylesheet" href="assets/css/app.css">
    </head>

    <body>
 <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-container">
            <div class="spinner">
                <div class="spinner">
                    <div class="spinner">
                        <div class="spinner">
                            <div class="spinner">
                                <div class="spinner"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        <!-- Back To Top Start -->
        <a href="#main-wrapper" id="backto-top" class="back-to-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Main Wrapper Start -->
        <div id="main-wrapper" class="main-wrapper overflow-hidden">

<?php
// Parse the URL and retrieve the value of the rq parameter
$url = $_SERVER['REQUEST_URI'];
$query = parse_url($url, PHP_URL_QUERY);
parse_str($query, $params);
$rq = isset($params['rq']) ? $params['rq'] : null;

// Set the date based on the rq parameter
if ($rq == 'animes') {
  $date = strtotime('1');
} elseif ($rq == 'mangas') {
  $date = strtotime('2023-11-2');
} else {
  $date = null;
}

// Output the countdown script with the calculated date
if ($date) {
  $js = <<<EOD
<script>
// Get the date for the countdown
var now = new Date().getTime();
var date = $date ? strtotime('now') + $date : null;
    
// Find the distance between now and the count down date
var distance = date - now;
    
// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
// Output the result in the countdown element
if (date) {
  document.getElementById("days").innerHTML = days + "<span>Days</span>";
  document.getElementById("hours").innerHTML = hours + "<span>Hrs</span>";
  document.getElementById("minutes").innerHTML = minutes + "<span>Min</span>";
  document.getElementById("seconds").innerHTML = seconds + "<span>Sec</span>";
} else {
  console.log("No date defined.");
}
</script>
EOD;
  echo $js;
} else {
  echo '<p>No date defined.</p>';
}
?>

<section class="coming-soon-page text-center">
  <div class="container-fluid">
    <img src="assets/media/bg/logo-large.png" alt="" class="mb-32 logo">
    <h4 class="color-white mb-32">We are under construction</h4>
    <img src="assets/media/bg/coming-soon.png" alt="" class="mb-32">
    <ul id="countdown" class="timer countdown mb-0">
      <li id="days"></li>
      <li id="hours"></li>
      <li id="minutes"></li>
      <li id="seconds"></li>
    </ul>
  </div>
</section>
        
        <!-- Jquery Js -->
        <script src="assets/js/vendor/jquery-3.6.3.min.js"></script>
        <script src="assets/js/vendor/bootstrap.min.js"></script>
        <script src="assets/js/vendor/jquery.countdown.min.js"></script>
        <script src="assets/js/vendor/slick.min.js"></script>
        <script src="assets/js/vendor/jquery-appear.js"></script>
        <script src="assets/js/vendor/jquery-validator.js"></script>
        <!-- Site Scripts -->
       <script src="assets/js/app.js?v=2"></script>
    </body>

</html>