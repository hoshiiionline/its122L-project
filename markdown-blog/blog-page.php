<?php
/**
 * Loads the markdown file given in the ?page query param into $markdown.
 */
require_once 'postRenderer.php';
$postSlug = $_GET['page'];
$page = __DIR__ . '/posts/' . $postSlug;

// Avoid path traversal, if /../ is passed
$realPath = realpath($page);
$containsPathTraversal = $realPath === false || strpos($realPath, __DIR__) !== 0;

if (!$containsPathTraversal && file_exists($page)) {
    $markdown = file_get_contents($page);
    $pageTitle = getPostTitle($markdown);
    $createDate = filemtime($page); // Get file modification time for post date
} else {
    header('HTTP/1.1 404 Not Found');
    $markdown = "# <center>404 😢<br/> Post not found<br/></center>";
    $markdown.= '<center><a href="./" class="back-to-blog"><i class="fa-solid fa-arrow-left"></i> Back to all posts</a></center>';
    $pageTitle = 'Blog post not found!';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?> | Holy Family Parish</title>
    <link href="../styling/styling-blog-post.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300..900&family=Oranienbaum&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <ul class="list">
            <li><a href="../pages/hfp-dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa-solid fa-newspaper"></i> Newsletter</a></li>
            <li><a href="../pages/hfp-landing.php"><i class="fa-solid fa-door-open"></i> Exit</a></li>
        </ul>
    </nav>

    <div class="post-container">
        <?php if (!$containsPathTraversal && file_exists($page)): ?>
            <div class="post-header">
                <h1 class="post-title"><?php echo $pageTitle; ?></h1>
                <div class="post-meta">
                    <span><i class="fa-regular fa-calendar"></i> <?php echo date("d M Y", $createDate); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <div class="post-content">
            <?php echo renderMarkdown($markdown); ?>
        </div>

        <?php if (!$containsPathTraversal && file_exists($page)): ?>
            <a href="./" class="back-to-blog">
                <i class="fa-solid fa-arrow-left"></i> Back to all posts
            </a>
        <?php endif; ?>
    </div>
</body>
</html>
