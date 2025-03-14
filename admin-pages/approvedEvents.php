<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Approved Events | Holy Family Parish</title>
    <link href="../styling/styling-approved.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300..900&family=Oranienbaum&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  </head>


<body class="background1">
<!-- Add navbar -->
<nav class="navbar">
    <ul>
        <li><a href="../hfp-dashboard.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="pendingEvents.php"><i class="fas fa-clock"></i> Pending</a></li>
        <li><a href="approvedEvents.php" class="active"><i class="fas fa-check-circle"></i> Approved</a></li>
        <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</nav>

<div class="wrap">
  <div class="row1">
    <div class="container mid-container">
      <h2>Approved Bookings</h2>
      <div class="scrollable-content">
        <table id="approved-booking" class="table table-striped">
          <thead>
            <tr>
              <th>Room</th>
              <th>Occ. Type</th>
              <th>Dates</th>
              <th>Client</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="container right-container">
      <h2>Calendar</h2>
      <div id='calendar'></div>
    </div>
  </div>
</div>

<?php
echo '<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>';
echo '<script src="../admin-scripts/approvedEvents.js"></script>';
?>

</body>
</html>
