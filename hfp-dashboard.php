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
        <link href="styling/styling-dashboard.css" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bentham&family=Figtree:ital,wght@0,300..900;1,300..900&family=Fjalla+One&family=Instrument+Serif:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&family=Lexend+Giga:wght@100..900&family=Oranienbaum&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    </head>


    <body>  

        <nav class="navbar">
            <ul class="list">
                <li><a href="#">Home</a></li>
                <li><a href="#">Reservation</a></li>
                <li><a href="#">Newsletter</a></li>
            </ul>
             
            
        </nav>

        <div class = "dailyverse">
            <h1>BIble Verse of the Day</h1>
            <h2><?php include 'daily-verse.php'?></h2> <!--This heading will contain the retrieval of Bible Verse-->
            <p>Additional text will come go here.</p>
        </div>

        <div class ="news">


            <a href="salon-amenities.php" style = "text-decoration: none">
                <div class="news-left">
                    Blog 1
                </div>
            </a>

            <a href="salon-stylists.php" style = "text-decoration: none">
                <div class="news-center" >
                    Blog 2
                </div>
            </a>

            <a href="salon-services.php" style = "text-decoration: none">
                <div class="news-right">
                    Blog 3
                </div>
            </a>
        </div>

        <div class ="posts">
            <h1>This is where the latest posts will go.</h1>
            <p>Additional text will go here</p>
        </div>

        <div class ="calendar">
            <h1>This is where the calendar will go.</h1>
            <p>Additional text will go here</p>
        </div>
        
    </body>


</html>