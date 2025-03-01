<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset ="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Holy Family Parish</title>
        <link href="styling/styling-landing.css" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bentham&family=Figtree:ital,wght@0,300..900;1,300..900&family=Fjalla+One&family=Instrument+Serif:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&family=Lexend+Giga:wght@100..900&family=Oranienbaum&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    </head>
    <body>

    <!--<nav class="navbar">
        <ul class="list">
            <li><a href="#">About</a></li>
            <li><a href="#">Projects</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <button class="search">Search</button>
        <button class="menu">Menu</button>
    </nav>-->


    <div class = "landing-page">
        <video autoplay muted plays-inline class="back-video">
            <source src="resources/vtour2.mp4" type="video/mp4">
        </video>
        <div class="content">
            <h1 class = "landing-heading" id="grad1">Holy Family Parish</h1>
            <p class="landing-subheading">Explore our diverse parish community and chapels, where faith and fellowship thrive in every corner.</p>
        </div>
    </div>

    <br>

    <div class="carousel-section">  
        <div class ="carousel-heading">Explore our Parish</div>
        <br><br>
        <div class = "carousel-subheading">In 2021, despite the challenges of the pandemic, the faithful made an effort for the renovation and beautification of the Church. 2 Spanish Era light posts, Images of the 12 Apostles and Holy Family were installed on the church facade.  
        The church interior was completely renovated removing the damaged wooden parts of the church pillars and ceiling with fiber cement. Liturgical Molding, Carvings, Chapier, Rococo Wall Lamps, and Chandeliers were added as part of the renovation.
        </div>
    </div>


    <div class="carousel-container">
            <div class="slider">
        
                <span style="--i:1;"><img src="resources/gallery1.jpg" alt=""></span>
                <span style="--i:2;"><img src="resources/gallery2.jpg" alt=""></span>
                <span style="--i:3;"><img src="resources/gallery3.jpg" alt=""></span>
                <span style="--i:4;"><img src="resources/gallery4.jpg" alt=""></span>
                <span style="--i:5;"><img src="resources/gallery5.jpg" alt=""></span>
            </div>
        </div>

        <div class="about-container">

            <div class="left-side-about">
                <h1 class ="about-heading">about us</h1>
                <p class = "about-text">Sitting in the heart of Marikina, Holy Family Parish 
                    is a place of worship and community, serving as the hear of faith for generations. 

                </p>
                <br>
                <P class="about-text"> Our Parish is a constant reminder of the many sacrifices our parishioners and parish
                 priests have offered to the Lord with all their hearts.</P>
                </div>


                <div class="right-side-about">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.8926532433206!2d121.11119917546942!3d14.662032885831632!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b990756372e1%3A0x1ee8914e244f8696!2sHoly%20Family%20Parish%20Church%20-%20Parang%2C%20Marikina%20City%20(Diocese%20of%20Antipolo)!5e0!3m2!1sen!2sph!4v1740184472001!5m2!1sen!2sph" 
                    width="600" height="450" 
                    style="border:0; border-radius:10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>


        </div>

    <div class="register-container">


        <div class="left-side">
            <h1>Register for Admin side</h1>

            <form>
                <label for="username">Enter Username: </label>
                <input type="text" id="uname" name="fname"><br>
                <label for="password">Password: </label>
                <input type="password" id="pw" name="lname"><br>

                <input type="submit" value="Submit">
            </form>

        </div>


        <div class="right-side">
            This is where the content of the landing page will go.
        </div>


    </div>

    </body>
</html>