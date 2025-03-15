let calendar;

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: "../admin-api/genCalendar.php",
    });
    calendar.render();
  });

function reloadEvents() {
    fetch("../admin-api/approvedEvents.php")
        .then((res) => res.json())
        .then((data) => {
            console.log("Approved Events:", data);
            updateTable("#approved-event tbody", data);
        })
        .catch((error) => console.error("Error fetching bookings:", error));
}

function updateTable(tableSelector, events) {
    const tableBody = document.querySelector(tableSelector);
    if (!tableBody) {
        console.error(`Table with selector '${tableSelector}' not found.`);
        return;
    }

    tableBody.innerHTML = "";

    events.forEach((data) => {
        let row = document.createElement("tr");
        row.innerHTML = `
            <td>${data.eventType}</td>
            <td>${data.requestedDate}</td>
            <td>${data.firstName} ${data.lastName}</td>
            <td>
                <select class="status-select" data-id="${data.reservationID}">
                    <option value="PENDING" ${data.status === "PENDING" ? "selected" : ""}>PENDING</option>
                    <option value="CONFIRMED" ${data.status === "CONFIRMED" ? "selected" : ""}>CONFIRMED</option>
                    <option value="CANCELLED" ${data.status === "CANCELLED" ? "selected" : ""}>CANCELLED</option>
                </select>
            </td>
        `;
        tableBody.appendChild(row);
    });

    document.querySelectorAll(".status-select").forEach((select) => {
        select.addEventListener("change", function () {
            let reservationID = this.getAttribute("data-id");
            let newStatus = this.value;
            updateReservationStatus(reservationID, newStatus);
        });
    });
}


function updateReservationStatus(reservationID, newStatus) {
    fetch("../admin-api/updateStatus.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ reservationID: reservationID, status: newStatus }),
    })
    .then((response) => response.json())
    .then((data) => {
        console.log("Update Response:", data);
        if (data.success) {
            alert("Reservation status updated successfully!");
            reloadEvents();
        } else {
            alert("Failed to update status: " + data.error);
        }
    })
    .catch((error) => console.error("Error updating booking status:", error));
}

reloadEvents();
