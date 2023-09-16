<?php define('SITE_ROOT', 'http://192.168.43.108:2051'); ?>

<!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="./index.php">
                            <img src="assets/media/logo-light.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-2">
  <div class="header__right">
    <a href="#" class="search-switch avatar-size"><span class="icon_search"></span></a>
    <?php
if (isset($_SESSION['user_id'])) {
    // User is logged in, display avatar and link to user page
    $user_id = $_SESSION['user_id'];
    $users_json = file_get_contents('./db/users.json');
    $users = json_decode($users_json, true);
    $avatar = $users[$user_id]['avatar'];
    echo '<div class="col-2 col-lg-12" style="display: inline-block; align-items: center; margin-right: 5px; margin-bottom: 3px;"><a href="./user/index.php"><img class="rounded-circle img-fluid" style="max-width: 35px;" src="' . $avatar . '" alt="Avatar"></a></div>';
} else {
    // User is not logged in, display login icon and link to login page
    echo '<a href="./login.html"><span class="icon_profile"></span></a>';
}
?>
  </div>
</div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li <?php if (strpos($_SERVER['PHP_SELF'], 'index.php') !== false) echo 'class="active"'; ?>><a href="./index.php">Homepage</a></li>
                                <li><a href="./categories.html">Categories <span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="./categories.html">Categories</a></li>
                                        <li><a href="./comming-soon.php?rq=animes">Animes</a></li>
                                        <li><a href="./blog.php">Blogs</a></li>
                                        <li><a href="./signup.html">Sign Up</a></li>
                                        <li><a href="./login.html">Login</a></li>
                                    </ul>
                                </li>
                                <li <?php if (strpos($_SERVER['PHP_SELF'], 'blog.php') !== false) echo 'class="active"'; ?>><a href="./blog.php">Our Blogs</a></li>
                                <li><a href="#">Contacts</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                

                <div id="mobile-menu-wrap"></div>
            </div>
        </header>
        <!-- Header End -->


