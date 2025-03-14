<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Approved Events | Holy Family Parish</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  </head>


<body class="background1">
<div class="wrap">
  <div class="row1">
    <!-- Left Container: Available Rooms -->
    <div class="col-lg-7 container mid-container">
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
    
    <div class="col-lg-4 container right-container">
      <h2>Calendar</h2>
      <div id='calendar'></div>
    </div>

  </div>
</div>

<?php
echo '<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>';
echo '<script src="../admin-scripts/approvedEvents.js"></script>';
?>
