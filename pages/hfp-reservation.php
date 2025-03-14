<?php
ob_start();
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
          height: '100%',
          dateClick: function(info) {
            document.getElementById('schedule_date').value = info.dateStr;
          }
        });
        calendar.render();

        document.querySelector('form').addEventListener('submit', function(e) {
          e.preventDefault();
          const formData = new FormData(this);
          
          fetch('', {
            method: 'POST',
            body: formData
          }).then(response => {
            if(response.ok) {
              calendar.refetchEvents();
              this.reset();
              window.location.href = '../pages/hfp-thankYouPage.php';
            }
          });
        });
      });
    </script>
    <style>
        form {
          display: flex;
          flex-direction: column;
          gap: 10px;
        }
        label {
          font-weight: bold;
        }
        input, select, button {
          padding: 8px;
          font-size: 16px;
        }
        .hidden {
          display: none;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <ul class="list">
            <li><a href="hfp-dashboard.php"><i class="fa-solid fa-house"></i></i> Dashboard</a></li>
            <li><a href="../markdown-blog"><i class="fa-solid fa-newspaper"></i> Newsletter</a></li>
            <li><a href="hfp-profile.php"><i class="fa-solid fa-circle-user"></i> Profile</a></li>
            <li><a href="../admin-pages/pendingEvents.php" class="active"><i class="fas fa-clock"></i> Events</a></li>
            <li><a href="hfp-landing.php" onclick="return confirmLogout('Are you sure you want to logout?');"> <i class="fa-solid fa-door-open"></i> Exit</a></li>
            </ul>
    </nav>
    <div class="main-container">
        <div id="calendar"></div>
        <div class="form-container">
            <h2>Schedule an Event</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <label>Last Name:</label>
                <input type="text" name="lastname" value=<?php echo $row['lastName']?> readonly>

                <label>First Name:</label>
                <input type="text" name="firstname" value=<?php echo $row['firstName']?> readonly>

        <label>Email:</label>
        <input type="email" name="email" placeholder="johndoe@example.com" value=<?php echo $row['emailAddress']?> readonly>

        <label>Contact Number:</label>
        <input type="tel" name="contact_number" placeholder="9123456789" value=<?php echo $row['mobileNumber']?> readonly>

                <label>Schedule Date:</label>
                <input type="date" name="schedule_date" id="schedule_date" readonly>

                <label>Schedule Period:</label>
                <select name="schedule_period" required>
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                </select>

        <label for="purpose">Purpose:</label>
        <select name="purpose" id="event" required>
            <option value="default">Please select an event...</option>
            <option value="Baptism">Baptism</option>
            <option value="Wedding">Wedding</option>
            <option value="Others">Others</option>
        </select>

        <div id="baptismFields" class="hidden">
            <label for="childName">Child's Name:</label>
            <input type="text" name="childName" >
            <label for="dateOfBirth">Date of Birth:</label>
            <input type="date" name="dateOfBirth">
            <label for="fatherName">Father's Name:</label>
            <input type="text" name="fatherName">
            <label for="motherName">Mother's Name:</label>
            <input type="text" name="motherName">
            <label for="godParentsNo">Number of Godparents:</label>
            <input type="number" name="godParentsNo">
        </div> 
        
        <div id="weddingFields" class="hidden">
            <label>Groom's Name:</label>
            <input type="text" name="groomName">
            <label>Bride's Name:</label>
            <input type="text" name="brideName">
            <label>Number of Guests:</label>
            <input type="number" name="guestsNo">
        </div>

        <label for="notes">Notes:</label>
        <textarea style="resize: none;" name="notes" rows="4" cols="50" placeholder="Any additional details..."></textarea>
        <button type="submit" >Submit</button>
    </form>
</body>

<script>
    const comboBox = document.getElementById('event');
    const option1Fields = document.getElementById('baptismFields');
    const option2Fields = document.getElementById('weddingFields');

    comboBox.addEventListener('change', function() {
      option1Fields.classList.add('hidden');
      option2Fields.classList.add('hidden');

      if (this.value === 'Baptism') {
        option1Fields.classList.remove('hidden');
      } else if (this.value === 'Wedding') {
        option2Fields.classList.remove('hidden');
      }
    });

    function confirmLogout(message) {
                return confirm(message);
            }
  </script>
</html>