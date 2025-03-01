<?php
require "api/submitEvent.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
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
    </style>
</head>
<body>
    <div id="calendar"></div>
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
</body>
</html>
