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
    <title>BLOG | </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/plyr.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="./style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="../index.php">
                            <img src="../assets/media/logo-light.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="./index.php">Homepage</a></li>
                                <li><a href="./categories.html">Categories <span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="../categories.html">Categories</a></li>
                                        <li><a href="../comming-soon.php?rq=animes">Animes</a></li>
                                        <li><a href="../blog.php">Blogs</a></li>
                                        <li><a href="../signup.html">Sign Up</a></li>
                                        <li><a href="../login.html">Login</a></li>
                                    </ul>
                                </li>
                                <li><a href="../blogs.php">Our Blogs</a></li>
                                <li><a href="#">Contacts</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right">
                        <a href="#" class="search-switch"><span class="icon_search"></span></a>
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            // User is logged in, display avatar and link to user page
                            echo '<a href="../user/index.php"><img src="assets/media/avatar.png" alt="Avatar"></a>';
                        } else {
                            // User is not logged in, display login icon and link to login page
                            echo '<a href="../login.html"><span class="icon_profile"></span></a>';
                        }
                        ?>
                    </div>
                </div>

                <div id="mobile-menu-wrap"></div>
            </div>
        </header>
        <!-- Header End -->
<?php
    // Read the JSON file
    $json = file_get_contents('../db/blogs.json');
    $data = json_decode($json, true);

    // Check if a blog ID was passed in the URL
    if (isset($_GET['id'])) {
        $blog_id = $_GET['id'];
        $blog = array_filter($data['blogs'], function ($blog) use ($blog_id) {
            return $blog['blog-id'] == $blog_id;
        });
        $blog = reset($blog); // Get the first (and only) element of the filtered array

        // Get the ID of the previous and next blogs
        $prev_blog_id = $blog_id - 1;
        $next_blog_id = $blog_id + 1;

        // Search for the previous blog's name
        $prev_blog = array_filter($data['blogs'], function ($blog) use ($prev_blog_id) {
            return $blog['blog-id'] == $prev_blog_id;
        });
        $prev_blog = reset($prev_blog); // Get the first (and only) element of the filtered array

        // Search for the next blog's name
        $next_blog = array_filter($data['blogs'], function ($blog) use ($next_blog_id) {
            return $blog['blog-id'] == $next_blog_id;
        });
        $next_blog = reset($next_blog); // Get the first (and only) element of the filtered array
    } else {
        // Redirect to the blogs page if no blog ID was passed
        header('Location: ../blog.php');
        exit;
    }
?>
        <!-- Blog Details Section Begin -->
        <section class="blog-details spad">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="blog__details__title">
                            <?php foreach ($blog['tags'] as $tag): ?>
                            <h6><p>
                                <?php echo $tag; ?>
                            </p>
                                <?php endforeach; ?>
                                <span>- <?php echo $blog['time']; ?></span></h6>
                            <h2><?php echo $blog['title']; ?></h2>
                            <div class="blog__details__social">
                                <a href="#" class="facebook"><i class="fa fa-facebook-square"></i> Facebook</a>
                                <a href="#" class="pinterest"><i class="fa fa-pinterest"></i> Pinterest</a>
                                <a href="#" class="linkedin"><i class="fa fa-linkedin-square"></i> Linkedin</a>
                                <a href="#" class="twitter"><i class="fa fa-twitter-square"></i> Twitter</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="blog__details__pic">
                            <img src="../<?php echo $blog['banner']; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="blog__details__content">
                            <div class="blog__details__text">
                                <p>
                                    <?php echo $blog['content']; ?>
                                </p>
                            </div>

<div class="blog__details__tags">
    <?php foreach ($blog['tags'] as $tag): ?>
        <a href="../search.php?tag=<?php echo $tag; ?>"><?php echo $tag; ?></a>
    <?php endforeach; ?>
</div>

<?php
if ($_GET['id'] == 1) {
  echo ' <button class="custom-btn btn-8"><span>Sigin Now</span></button>';
}
 ?>


<div class="blog__details__btns">
    <div class="row">
        <div class="col-lg-6">
            <div class="blog__details__btns__item">
                <h5>
                    <?php if (!empty($prev_blog)): ?>
                        <a href="?id=<?php echo $prev_blog_id; ?>"><span class="arrow_left"></span><?php echo $prev_blog['title']; ?></a>
                    <?php endif; ?>
                </h5>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="blog__details__btns__item blog__details__btns__item--next">
                <h5>
                    <?php if (!empty($next_blog)): ?>
                        <a href="?id=<?php echo $next_blog_id; ?>"><?php echo $next_blog['title']; ?><span class="arrow_right"></span></a>
                    <?php endif; ?>
                </h5>
            </div>
        </div>
    </div>
</div>

                            <div class="blog__details__comment">
                                <h4>3 Comments</h4>
                                <div class="blog__details__comment__item">
                                    <div class="blog__details__comment__item__pic">
                                        <img src="img/blog/details/comment-1.png" alt="">
                                    </div>
                                    <div class="blog__details__comment__item__text">
                                        <span>Sep 08, 2020</span>
                                        <h5>John Smith</h5>
                                        <p>
                                            Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi
                                        </p>
                                        <a href="#">Like</a>
                                        <a href="#">Reply</a>
                                    </div>
                                </div>
                                <div class="blog__details__comment__item blog__details__comment__item--reply">
                                    <div class="blog__details__comment__item__pic">
                                        <img src="img/blog/details/comment-2.png" alt="">
                                    </div>
                                    <div class="blog__details__comment__item__text">
                                        <span>Sep 08, 2020</span>
                                        <h5>Elizabeth Perry</h5>
                                        <p>
                                            Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi
                                        </p>
                                        <a href="#">Like</a>
                                        <a href="#">Reply</a>
                                    </div>
                                </div>
                                <div class="blog__details__comment__item">
                                    <div class="blog__details__comment__item__pic">
                                        <img src="img/blog/details/comment-3.png" alt="">
                                    </div>
                                    <div class="blog__details__comment__item__text">
                                        <span>Sep 08, 2020</span>
                                        <h5>Adrian Coleman</h5>
                                        <p>
                                            Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                            adipisci velit, sed quia non numquam eius modi
                                        </p>
                                        <a href="#">Like</a>
                                        <a href="#">Reply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="blog__details__form">
                                <h4>Leave A Commnet</h4>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <input type="text" placeholder="Name">
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <input type="text" placeholder="Email">
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea placeholder="Message"></textarea>
                                            <button type="submit" class="site-btn">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog Details Section End -->

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
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>

                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <!-- Search model Begin -->
        <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">
                    <i class="icon_close"></i>
                </div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div>
        <!-- Search model end -->

        <!-- Js Plugins -->
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/player.js"></script>
        <script src="../assets/js/jquery.nice-select.min.js"></script>
        <script src="../assets/js/mixitup.min.js"></script>
        <script src="../assets/js/jquery.slicknav.js"></script>
        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/main.js"></script>

    </body>

</html>