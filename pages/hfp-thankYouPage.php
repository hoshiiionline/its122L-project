<?php 
require "../config/config.php";

$referenceNo = $_SESSION['referenceNo'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styling/styling-thankYouPage.css">
</head>
<body class="background1">
<div class="container" style="border-radius: 2em">
    <h2>THANK YOU!</h2>
    <h3 style="padding-top: 1em">Your request has been received. A confirmation email with your booking details will be sent to your inbox shortly. If you have any questions, feel free to contact us.</h3>
    <br>
    <h3>Your reference no.: <?php echo $referenceNo?></h3>
    <h3 style="margin: 0; padding: 0; font-size: 1.5em;"><a class="back" href="hfp-dashboard.php">Return to dashboard</a></h3>
</div>
</body>
</html>