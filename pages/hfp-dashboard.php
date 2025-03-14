<!--  Nav  -->
    <!--  Home  -->
    <!--  Reservation -->
    <!--  Newsletter  -->
    <!--  Profile  -->


<!--  Bible Verse of The Day  -->
<!--  News  -->
<!--  Latest Posts (Blog)  -->
<!--  Church Calendar  -->  


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset ="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Holy Family Parish</title>
        <link href="../styling/styling-dashboard.css" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bentham&family=Figtree:ital,wght@0,300..900;1,300..900&family=Fjalla+One&family=Instrument+Serif:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&family=Lexend+Giga:wght@100..900&family=Oranienbaum&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    </head>


    <body>  

        <nav class="navbar">
            <ul class="list">
                
                <li><a href="../pages/hfp-reservation.php"><i class="fa-solid fa-calendar-days"></i></i> Reservation</a></li>
                <li><a href="../markdown-blog"><i class="fa-solid fa-newspaper"></i> Newsletter</a></li>
                <li><a href="hfp-landing.php"> <i class="fa-solid fa-door-open"></i> Exit</a></li>
            </ul>
             
            
        </nav>

        <div class="dailyverse" >
            <h1 data-aos="fade-right" data-aos-delay="100">Bible Verse of the Day</h1>
            <h2 id="verse" data-aos="fade-right" data-aos-delay="100"></h2>
            <div id="verse-content" data-aos="fade-up" data-aos-delay="1000"><?php include '../api/daily-verse.php'?></div>
        </div>

        <div class="news">
            <div class="news-header">
                <h2>Here are the latest posts from the HFP Community</h2>
                <p>Feel free to click on the posts below to read more or add your own post and share your devotions, prayers, and experiences with the community.</p>
            </div>
            
            <div class="news-grid">
                <?php 
                    require_once '../markdown-blog/getLatestPosts.php';
                    $latestPosts = getLatestPosts(4);
                    
                    if (empty($latestPosts)) {
                        // Display placeholder cards if no posts are found
                        for ($i = 0; $i < 3; $i++) {
                ?>  
                        
                        <a href="../markdown-blog/blog-posts-list.php" class="news-card">
                            <div class="news-content">
                                <h3>No Posts Yet</h3>
                                <p>Share updates and announcements with the parish community. Click here to start creating blog posts.</p>
                                <div class="news-meta">
                                    <span class="read-more">Create Post <i class="fa-solid fa-plus"></i></span>
                                </div>
                            </div>
                        </a>
                <?php
                        }
                    } else {
                        foreach ($latestPosts as $post) {
                            $titleAndSummary = getFirstWords($post['markdown'], 30);
                            $lines = explode("\n", $titleAndSummary);
                            $title = trim(str_replace('#', '', $lines[0]));
                            array_shift($lines);
                            $excerpt = implode(' ', $lines);
                ?>
                        <a href="../markdown-blog/blog-page.php?page=<?php echo $post['slug']; ?>" class="news-card">
                            <div class="news-content">
                                <h3><?php echo htmlspecialchars($title); ?></h3>
                                <p><?php echo htmlspecialchars($excerpt); ?></p>
                                <div class="news-meta">
                                    <span><i class="fa-regular fa-calendar"></i> <?php echo date("d M Y", $post['create_date']); ?></span>
                                    <span class="read-more">Read More <i class="fa-solid fa-arrow-right"></i></span>
                                </div>
                            </div>
                        </a>
                <?php 
                        }
                    }
                ?>
            </div>
        </div>

        <!--<div class ="posts">
            <h1>This is where the latest posts will go.</h1>
            <p>Additional text will go here</p>
        </div>-->

        <div class ="calendar">
            <h1>Parish Calendar</h1>
            <p>View all upcoming events, activities, and scheduled masses.</p>
            <div><?php include '../api/calendar-retrieval.php'?></div>
        </div>
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();

            // Carousel functionality
            const carousel = document.querySelector('.carousel');
            const images = carousel.querySelectorAll('img');
            const dotsContainer = document.querySelector('.carousel-dots');
            const prevBtn = document.querySelector('.prev-btn');
            const nextBtn = document.querySelector('.next-btn');
            let currentIndex = 0;

            // Create dots
            images.forEach((_, index) => {
                const dot = document.createElement('button');
                dot.classList.add('dot');
                if (index === 0) dot.classList.add('active');
                dot.addEventListener('click', () => showImage(index));
                dotsContainer.appendChild(dot);
            });

            function showImage(index) {
                images.forEach(img => img.classList.remove('active'));
                const dots = dotsContainer.querySelectorAll('.dot');
                dots.forEach(dot => dot.classList.remove('active'));
                
                currentIndex = index;
                images[currentIndex].classList.add('active');
                dots[currentIndex].classList.add('active');
            }

            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                showImage(currentIndex);
            });

            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % images.length;
                showImage(currentIndex);
            });
        </script>
    </body>


</html>