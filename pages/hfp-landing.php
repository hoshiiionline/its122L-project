<?php 
    require '../config/config.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['form_type'])) { //register
            $formType = $_POST['form_type'];
            if ($formType == "register") {
                $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] :"";
                $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] :"";
                $email = isset($_POST["email"]) ? $_POST["email"] :"";
                $password = isset($_POST["password"]) ? $_POST["password"] :"";
                $confirmPassword = isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] :"";
        
                if(empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword)) {
                    echo "Please fill out all fields.";
                } else {
                    if($password != $confirmPassword) {
                        echo "Passwords do not match.";
                    } else {
                        $sql = "SELECT userID FROM users WHERE emailAddress = ?";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
        
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                        if (mysqli_stmt_num_rows($stmt) > 0) {
                            $regis_err = "User with email already exists!";
                        } else {
                            $sql = "INSERT INTO users (firstName, lastName, emailAddress, password) VALUES (?, ?, ?, ?)";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $hashed_password);
                            
                            if (mysqli_stmt_execute($stmt)) {
                                $regis_success = true;
                            } else {
                                $regis_err = "Error: " . mysqli_error($conn);
                            }
                            mysqli_stmt_close($stmt);

                            $sql = "SELECT userID FROM users WHERE emailAddress = ?";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "s", $email);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $row = mysqli_fetch_assoc($result);
                            $userID = $row['userID'];
                            $_SESSION['userID'] = $userID;  
                            mysqli_stmt_close($stmt);
                            header('Location: hfp-dashboard.php');
                        }        
                    }
                }
            } else {
                $emailAddress = isset($_POST["emailAddress"]) ? $_POST["emailAddress"] : "";
                $password = isset($_POST["password"]) ? $_POST["password"] : "";
                        
                if(empty($emailAddress) || empty($password)) {
                    echo "Please fill out all fields.";
                } else {
                    $sql = "SELECT userID, password, isAdmin FROM users WHERE emailAddress = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $emailAddress);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    
                    if($row = mysqli_fetch_assoc($result)) {
                        if (password_verify($password, $row['password'])) {
                            // Start session if not already started
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
                            
                            $_SESSION['userID'] = $row['userID'];
                            
                            if ($row['isAdmin'] == 1) {
                                $_SESSION['isAdmin'] = 1;
                                header('Location: hfp-dashboard.php');
                            } else {
                                $_SESSION['isAdmin'] = 0;
                                header('Location: hfp-dashboard.php');
                            }
                            exit(); // Important: prevent further execution
                        } else {
                            echo "Invalid password.";
                        }
                    } else {
                        echo "User not found.";
                    }
                    mysqli_stmt_close($stmt);
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset ="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Holy Family Parish</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../styling/styling-landing.css" rel="stylesheet" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bentham&family=Figtree:ital,wght@0,300..900;1,300..900&family=Fjalla+One&family=Instrument+Serif:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&family=Lexend+Giga:wght@100..900&family=Oranienbaum&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        
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


    <div class="landing-page">
        <div class="video-overlay"></div>
        <video autoplay muted loop playsinline class="back-video" >
            <source src="../resources/vtour2.mp4" type="video/mp4">
        </video>
        <div class="content">
            <h1 class="landing-heading" id="grad1" data-aos="fade-up" data-aos-delay="100">Holy Family Parish</h1>
            <p class="landing-subheading" data-aos="fade-up" data-aos-delay="200">Explore our diverse parish community and chapels, where faith and fellowship thrive in every corner.</p>
        </div>
    </div>

    <br>

    <div class="carousel-section">  
        <div class ="carousel-heading" data-aos="fade-up" data-aos-delay="100">Explore our Parish</div>
        <br><br>
        <div class = "carousel-subheading" data-aos="fade-up" data-aos-delay="100">In 2021, despite the challenges of the pandemic, the faithful made an effort for the renovation and beautification of the Church. 2 Spanish Era light posts, Images of the 12 Apostles and Holy Family were installed on the church facade.  
        The church interior was completely renovated removing the damaged wooden parts of the church pillars and ceiling with fiber cement. Liturgical Molding, Carvings, Chapier, Rococo Wall Lamps, and Chandeliers were added as part of the renovation.
        </div>
    </div>


    <div class="carousel-container" data-aos="fade-up" data-aos-delay="700">
            <div class="slider" >
        
                <span style="--i:1;"><img src="../resources/gallery1.jpg" alt=""></span>
                <span style="--i:2;"><img src="../resources/gallery2.jpg" alt=""></span>
                <span style="--i:3;"><img src="../resources/gallery3.jpg" alt=""></span>
                <span style="--i:4;"><img src="../resources/gallery4.jpg" alt=""></span>
                <span style="--i:5;"><img src="../resources/gallery5.jpg" alt=""></span>
            </div>
        </div>

        <div class="about-container">

            <div class="left-side-about" data-aos="fade-up" data-aos-delay="100">
                <h1 class ="about-heading">about us</h1>
                <p class = "about-text">Sitting in the heart of Marikina, Holy Family Parish 
                    is a place of worship and community, serving as the hear of faith for generations. 

                </p>
                <br>
                <P class="about-text"> Our Parish is a constant reminder of the many sacrifices our parishioners and parish
                 priests have offered to the Lord with all their hearts.</P>
                </div>

            <div class="right-side-about" data-aos="fade-up" data-aos-delay="100">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.8926532433206!2d121.11119917546942!3d14.662032885831632!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b990756372e1%3A0x1ee8914e244f8696!2sHoly%20Family%20Parish%20Church%20-%20Parang%2C%20Marikina%20City%20(Diocese%20of%20Antipolo)!5e0!3m2!1sen!2sph!4v1740184472001!5m2!1sen!2sph" 
                width="500" height="450" 
                style="border:0; border-radius:10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

    <!-- registration container -->
    <div class="register-container">
        <div class="left-side" data-aos="fade-up" data-aos-delay="100">
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Register')" id="defaultOpen">Register</button>
                <button class="tablinks" onclick="openTab(event, 'Login')">Login</button>
            </div>
            
            <!-- REGISTER TAB -->
            <div id="Register" class="tabcontent">
                <h3>Create an Account</h3>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                        <small id="emailHelp" class="form-text">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="mobileNumber">Mobile number:</label>
                        <input type="mobileNumber" class="form-control" id="mobileNumber" name="mobileNumber" placeholder="(e.g. 9123456789)" required>
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Create a password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password">
                    </div>
                    <input type="hidden" name="form_type" value="register">
                    <input type="submit" value="Create Account">
                </form>
            </div>

            <!-- LOGIN TAB -->
            <div id="Login" class="tabcontent">
                <h3>Welcome Back!</h3>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="mb-3">
                        <label for="emailAddress">Email address</label>
                        <input type="text" class="form-control" id="emailAddress" name="emailAddress" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <input type="hidden" name="form_type" value="login">
                    <input type="submit" value="Sign In">
                </form>
            </div>
        </div>

        <div class="right-side" data-aos="fade-up" data-aos-delay="100">
            <h2>Welcome to Holy Family Parish</h2>
            <p>Join our community to stay updated with parish events and activities.</p>
            
            <div class="faq-container">
                <h2>Frequently Asked Questions</h2>
                <p>• What is the mass schedule?</p>
                <p>• What are the parish events?</p>
                <p>• What are the parish activities?</p>
                <p>• What are the parish programs?</p>
                <p>• What are the parish projects?</p>
            </div>
            
        </div>
    </div>
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Open the default tab
        document.getElementById("defaultOpen").click();
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
    </script>

    <script>
        // Loader
        window.addEventListener('load', function() {
            const loaderWrapper = document.querySelector('.loader-wrapper');
            setTimeout(() => {
                loaderWrapper.classList.add('fade-out');
            }, 2000); // Loader will show for 2 seconds
        });
        function confirmLogout(message) {
                return confirm(message);
        }
    </script>
    </body>
</html>