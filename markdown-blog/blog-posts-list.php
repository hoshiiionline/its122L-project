<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts | Holy Family Parish</title>
    <link href="../styling/styling-blog.css" rel="stylesheet" type="text/css">
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
    
    <div class="blog-container">
        <div class="blog-header">
            <h1 class="blog-heading">Parish Blog Posts</h1>
            <a href="../pages/hfp-blogs.php" class="create-post-btn">
                <i class="fa-solid fa-plus"></i> Create New Post
            </a>
        </div>
        <div class="blog-grid">
            <?php include 'postListRenderer.php'; ?>
        </div>
    </div>
</body>
</html>
