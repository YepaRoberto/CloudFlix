<div class="col-lg-3">
    <h3 class="color-white mb-32">Recent Blogs</h3>
    <?php
        $blogs = json_decode(file_get_contents('db/blogs.json'), true);
        $recent_blogs = array_slice($blogs, -4, 4, true);
        krsort($recent_blogs);
        foreach ($recent_blogs as $blog) {
            echo '<a href="blog.php?id=' . $blog['id'] . '" class="blog-block">';
            echo '<img src="' . $blog['banner'] . '" alt="">';
            echo '<div class="content">';
            echo '<h6 class="color-primary">' . date('jS F Y', strtotime($blog['time'])) . '</h6>';
            echo '<p class="color-white">' . $blog['title'] . '</p>';
            echo '</div>';
            echo '</a>';
        }
    ?>
</div>
