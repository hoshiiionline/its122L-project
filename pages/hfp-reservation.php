<?php
require "../api/submitEvent.php";
require "../config/config.php";

$userID = $_SESSION['userID'];
$sql = "SELECT * FROM users WHERE userID = '$userID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../styling/styling-calendar.css" rel="stylesheet" type="text/css">
    <title>Calendar - Holy Family Parish</title>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <link href="styling/styling-calendar.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300..900&family=Oranienbaum&display=swap" rel="stylesheet">
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          selectable: true,
          initialView: 'dayGridMonth',
          events: '../api/getEvents.php',
          dateClick: function(info) {
            alert('Date selected: ' + info.dateStr)
            document.getElementById('schedule_date').value = info.dateStr;
          }
        });
        calendar.render();
      });
    </script>
</head>
<body>
    <nav class="navbar">
        <ul class="list">
            <li><a href="hfp-dashboard.php"><i class="fa-solid fa-house"></i></i> Dashboard</a></li>
            <li><a href="#"><i class="fa-solid fa-newspaper"></i> Newsletter</a></li>
            <li><a href="hfp-landing.php"> <i class="fa-solid fa-door-open"></i> Exit</a></li>
        </ul>
    </nav>
    <div class="main-container">
        <div id="calendar"></div>
        <div class="form-container">
            <h2>Schedule an Event</h2>
            <form action="" method="POST">
                <label>Last Name:</label>
                <input type="text" name="lastname" required>

                <label>First Name:</label>
                <input type="text" name="firstname" required>

                <label>Email:</label>
                <input type="email" name="email" required>

                <label>Contact Number:</label>
                <input type="tel" name="contact_number" required>

                <label>Purpose:</label>
                <input type="text" name="purpose" required>

                <label>Schedule Date:</label>
                <input type="date" name="schedule_date" id="schedule_date" readonly>

                <label>Schedule Period:</label>
                <select name="schedule_period" required>
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>