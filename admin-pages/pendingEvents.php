<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pending Events | Holy Family Parish</title>
    <link href="../styling/styling-pending.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300..900&family=Oranienbaum&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  </head>
<body class="background1">
<!-- Add navbar -->
<nav class="navbar">
    <ul>
        <li><a href="../pages/hfp-dashboard.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="pendingEvents.php" class="active"><i class="fas fa-clock"></i> Pending</a></li>
        <li><a href="approvedEvents.php"><i class="fas fa-check-circle"></i> Approved</a></li>
        <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</nav>

<div class="wrap">
  <div class="row1">
    <div class="col-lg-7 container left-container">
      <h2>Pending Bookings</h2>
      <div class="scrollable-content">
        <table id="pending-event" class="table table-striped">
          <thead>
            <tr>
              <th>Event Type</th>
              <th>Req. Date</th>
              <th>Client</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="col-lg-4 container mid-container">
      <h2>Detailed Information</h2>
      <div class="scrollable-content">
        <h4>Customer Information</h4>
        <table id="customer-info" class="table table-striped">
          <tr>
              <th>Desc.</th>
              <th>Info.</th>
          </tr>
          <tr>
              <td>Name</td>
              <td>Please Select a Record</td>
          </tr>
          <tr>
              <td>Mobile No.</td>
              <td>Please Select a Record</td>
          </tr>
          <tr>
              <td>Email Add.</td>
              <td>Please Select a Record</td>
          </tr>
          <tbody>
          </tbody>  
        </table>
        <h4>Event Information</h4>
        <table id="event-info" class="table table-striped">
          <tr>
              <th>Desc.</th>
              <th>Info.</th>
          </tr>
          <tr>
              <td>Event Type</td>
              <td>Please Select a Record</td>
          </tr>
          <tr>
              <td>Date Req.</td>
              <td>Please Select a Record</td>
          </tr>
          <tr>
              <td>Status</td>
              <td>Please Select a Record</td>
          </tr>
          <tbody>
          </tbody>  
        </table>

      </div>
    </div>



  </div>
</div>

<?php
echo '<script src="../admin-scripts/pendingEvents.js"></script>';
?>

</body>
</html>
