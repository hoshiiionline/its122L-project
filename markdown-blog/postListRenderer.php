<?php
    require_once 'postRenderer.php';

    $posts = getPostsList();
    foreach ($posts as $post) {
        $titleAndSummary = getFirstWords($post['markdown'], 50);
        // Separate title and content
        $lines = explode("\n", $titleAndSummary);
        $title = trim(str_replace('#', '', $lines[0])); // Remove markdown # from title
        array_shift($lines); // Remove title from content array
        $excerpt = implode(' ', $lines); // Join remaining content
?>
    <div class="blog-post">
        <div class="blog-post-content">
            <h2><a href="<?php echo $post['slug'] ?>" class="blog-post-title"><?php echo $title; ?></a></h2>
            <div class="blog-post-meta">
                <i class="fa-regular fa-calendar"></i> 
                <?php echo date("d M Y", $post['create_date']); ?>
            </div>
            <div class="blog-post-excerpt">
                <?php echo $excerpt; ?>
            </div>
            <div class="blog-post-actions">
                <a href="../admin-pages/editBlog.php?file=<?php echo urlencode($post['slug']); ?>" class="blog-post-link">
                    Edit Post <i class="fa-solid fa-pen"></i>
                </a>
                <a href="<?php echo $post['slug'] ?>" class="blog-post-link">
                    Read More <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
<?php }?>
