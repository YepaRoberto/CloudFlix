<?php
    ob_start();
    session_set_cookie_params(2592000);
    session_start();

    // ...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CloudFlix | Home</title>

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
    <link rel="stylesheet" href="assets/css/style.css?v=2" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php include './assets/includes/header.php'; ?>

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                <?php
                // Read the contents of db/hero.json
                $json = file_get_contents('db/hero.json');

                // Convert the JSON string to an array
                $data = json_decode($json, true);

                // Get 3 random elements from the array
                $random_animes = array_rand($data, 3);

                // Loop through the 3 random elements and display them in the given format
                foreach ($random_animes as $anime) {
                    echo '<div class="hero__items set-bg" data-setbg="' . $data[$anime]['image'] . '">';
                    echo '<div class="row">';
                    echo '<div class="col-lg-6">';
                    echo '<div class="hero__text">';
                    echo '<div class="label">' . $data[$anime]['genre'] . '</div>';
                    echo '<h2>' . $data[$anime]['title'] . '</h2>';
                    echo '<p>' . $data[$anime]['description'] . '</p>';
                    echo '<a href="#"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    <?php
                    // Leer el archivo JSON
                    $json = file_get_contents('db/trending-shows.json');

                    // Decodificar el archivo JSON en un array de PHP
                    $data = json_decode($json, true);

                    // Mostrar los datos en la estructura HTML dada
                    echo '<div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Trending Now</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">';

                    // Iterar sobre los datos y mostrarlos en la estructura HTML dada
                    foreach ($data as $key => $value) {
                        if ($key >= 6) {
                            break;
                        }
                        echo '<div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="' . $value['image'] . '">
                                        <div class="ep">' . $value['episodes'] . '</div>
                                        <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                        <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>Active</li>
                                    <li>' . $value['category'] . '</li>
                                        </ul>
                                        <h5><a href="' . $value['link'] . '">Ver ' . $value['title'] . '</a></h5>
                                    </div>
                                </div>
                            </div>';
                    }

                    echo '  </div>
                    </div>';
                    ?>


<?php
session_start();
if (isset($_SESSION['user_id'])) {
    // El usuario ha iniciado sesión, mostrar avatar y enlace a la página del usuario
    $user_id = $_SESSION['user_id'];
    $users_json = file_get_contents('db/users.json');
    $users = json_decode($users_json, true);
    $avatar = $users[$user_id]['avatar'];
    $age = $users[$user_id]['age'];
    $gender = $users[$user_id]['gender'];
    // Leer el archivo JSON de detalles de animes
    $json = file_get_contents('db/detailsDB.json');
    $data = json_decode($json, true);
    // Calcular la coincidencia de cada anime con los valores de $age y $gender
    foreach ($data as $key => $value) {
        $coincidence = 0;
        $age_diff = abs($value['obAge'] - $age);
        if ($age_diff <= 2) {
            $coincidence += 2;
        } else if ($age_diff <= 5) {
            $coincidence += 1;
        }
        $gender_diff = 0;
        if ($value['obGender'] == "Female") {
            $gender_diff = 1;
        }
        if ($gender_diff == 0) {
            $coincidence += 1;
        } else if ($gender_diff == 1) {
            $coincidence += 0.5;
        }
        $data[$key]['coincidence'] = $coincidence;
    }
    // Ordenar los animes por coincidencia
    usort($data, function($a, $b) {
        return $b['coincidence'] - $a['coincidence'];
    });
    // Mostrar los 5 animes con mayor coincidencia en la estructura HTML dada
    echo '<div class="trending__product">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                    <h4>Para ti</h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="btn__all">
                    <a href="#" class="primary-btn">Ver todos <span class="arrow_right"></span></a></div>
            </div>
        </div>
        <div class="row">';
    $count = 0;
    foreach ($data as $key => $value) {
        if ($value['coincidence'] > 0) {
            echo '<div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="' . $value['Cover Link'] . '">
                        <div class="ep">' . $value['Temporadas'][0]['Episodes'] . '</div>
                        <div class="comment"><i class="fa fa-comments"></i> 11</div>
                        <div class="view"><i class="fa fa-eye"></i> 9141</div>
                    </div>
                    <div class="product__item__text">
                        <ul>
                            <li>Activo</li>
                            <li>' . $value['Genre'] . '</li>
                        </ul>
                        <h5><a href="' . $value['TrailerLink'] . '">Ver ' . $value['title'] . '</a></h5>
                    </div>
                </div>
            </div>';
            $count++;
            if ($count >= 5) {
                break;
            }
        }
    }
    echo '</div></div>';
}
?>
                        <!-- trending Area end -->
                        <div class="product__sidebar__comment">
                            <div class="section-title">
                                <h5>New Blogs</h5>
                            </div>
                            <?php
                            // Lee el archivo JSON de blogs
                            $json = file_get_contents('db/blogs.json');
                            $data = json_decode($json, true);
                            // Obtener los ultimos 4 blogs
                            $lastFourBlogs = array_slice($data['blogs'], -4);

                            // Muestra los blogs en el formato proporcionado
                            foreach ($lastFourBlogs as $blog) {
                                echo '<div class="product__sidebar__comment__item">';
                                echo '<div class="product__sidebar__comment__item__pic">';
                                echo '<img class="col-md-12 col-sm-12 col-lg-12" src="' . $blog['banner'] . '" alt="">';
                                echo '</div>';
                                echo '<div class="product__sidebar__comment__item__text">';
                                echo '<ul>';
                                echo '<li>' . $blog['anime'] . '</li>';
                                foreach ($blog['tags'] as $tag) {
                                    echo '<li>' . $tag . '</li>';
                                }
                                echo '</ul>';
                                echo '<h5><a href="blog/index.php?id=' . $blog['blog-id'] . '">' . $blog['title'] . '</a></h5>';
                                echo '<span><i class="fa fa-clock-o"></i> ' . $blog['time'] . '</span>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Product Section End -->

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