<?php 
ob_start();
session_set_cookie_params(2592000);
session_start();
?>
		
	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CloudFlix | Blogs</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="assets/css/plyr.css" type="text/css">
    <link rel="stylesheet" href="assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

     <?php include './assets/includes/header.php'; ?>

   <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="assets/media/bg/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Our Blog</h2>
                        <p>Welcome to the official Anime blog.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->


<?php
// Read the JSON file
$json = file_get_contents('db/blogs.json');
$data = json_decode($json, true);

// Check if a search query was submitted
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $filtered_blogs = array_filter($data['blogs'], function ($blog) use ($search) {
        return stripos($blog['title'], $search) !== false || stripos($blog['content'], $search) !== false;
    });
    $blogs = $filtered_blogs;
} else {
    $blogs = $data['blogs'];
}

// Open the blog section
echo '<section class="blog spad">';

// Open the container div
echo '<div class="container">';

// Open the row div
echo '<div class="row">';

// Initialize a counter to track the remainder
$counter = 0;

// Loop through the blogs and display them
foreach ($blogs as $blog) {

    // Increment the counter
    $counter++;

    // Determine the CSS class for the blog item based on the remainder
    $css_class = '';
    switch ($counter % 8) {
        case 0:
        case 5:
            $css_class = 'col-lg-12';
            break;
        case 1:
        case 2:
        case 3:
        case 4:
        case 6:
        case 7:
            $css_class = 'col-md-6 col-sm-6';
            break;
    }

    // Echo the blog item
    echo '<div class="' . $css_class . '">
        <div class="blog__item set-bg" data-setbg="' . $blog['banner'] . '">
            <div class="blog__item__text">
                <p><span class="icon_calendar"></span>' . date('jS F Y', strtotime($blog['time'])) . '</p>
                <h4><a href="blog/index.php?id=' . $blog['blog-id'] . '">' . $blog['title'] . '</a></h4>
            </div>
        </div>
    </div>';
}

// Close the row div
echo '</div>';

// Close the container div
echo '</div>';

// Close the blog section
echo '</section>';
?>



    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="page-up">
            <a href="#" id="scrollToTopButton"><span class="arrow_carrot-up"></span></a>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer__logo">
                        <a href="./index.html"><img src="img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer__nav">
                        <ul>
                            <li class="active"><a href="./index.html">Homepage</a></li>
                            <li><a href="./categories.html">Categories</a></li>
                            <li><a href="./blog.html">Our Blog</a></li>
                            <li><a href="#">Contacts</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>

                  </div>
              </div>
          </div>
      </footer>
      <!-- Footer Section End -->

      <!-- Search model Begin -->
      <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

         <!-- Js Plugins -->
        <script src="assets/js/jquery-3.3.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/player.js"></script>
        <script src="assets/js/jquery.nice-select.min.js"></script>
        <script src="assets/js/mixitup.min.js"></script>
        <script src="assets/js/jquery.slicknav.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/main.js"></script>



</body>

</html>