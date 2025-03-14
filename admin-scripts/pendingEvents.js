function reloadEvents() {
    fetch("../admin-api/pendingEvents.php")
        .then((res) => res.json())
        .then((data) => {
            console.log("Pending Events:", data);
            updateTable("#pending-booking tbody", data);
        })
        .catch((error) => console.error("Error fetching bookings:", error));
}

function updateTable(tableSelector, data) {
    const tableBody = document.querySelector(tableSelector);
    if (!tableBody) {
        console.error(`Table with selector '${tableSelector}' not found.`);
        return;
    }

    tableBody.innerHTML = "";

    data.forEach((data) => {
        let row = document.createElement("tr");
        row.innerHTML = `
            <td>${data.eventType}</td>
            <td>${data.requestedDate}</td>
            <td>${data.firstName} ${data.lastName}</td>
            <td>
                <button class="view-event" data-id="${data.reservationID}|${data.eventType}">View</button>
            </td>
        `;
        tableBody.appendChild(row);
    });

    document.querySelectorAll(".view-event").forEach((button) => {
        button.addEventListener("click", function () {
            let [reservationID, eventType] = this.getAttribute("data-id").split("|");
            fetchBookingDetails(reservationID, eventType);
        });
    });
}


function fetchBookingDetails(reservationID, eventType) {
    if (eventType == "Wedding"){
        eT = "wd";
    } else {
        eT = "bt";
    }
    fetch(`../admin-api/getEvent.php?reservationID=${reservationID}&type=${eT}`)
        .then((response) => response.json())
        .then((data) => {
            console.log("Reservation Details:", data);
            displayBookingDetails(data);
        })
        .catch((error) => console.error("Error fetching reservation details:", error));
}

function reloadBookings() {
    fetch("../admin-api/pendingEvents.php")
        .then((res) => res.json())
        .then((data) => {
            console.log("Pending Event:", data);
            //updateTable("#pending-booking tbody", data);
        })
        .catch((error) => console.error("Error fetching bookings:", error));
}

function displayBookingDetails(data) {
    const detailsContainer = document.querySelector("#event-info tbody");
    const customerContainer = document.querySelector("#customer-info tbody");

    if (!detailsContainer || !customerContainer) return;

    detailsContainer.innerHTML = `
        <tr>
            <th>Desc.</th>
            <th>Info.</th>
        </tr>
        <tr>
            <td>Event Type</td>
            <td>${data.type}</td>
        </tr>
        <tr>
            <td>Date Req.</td>
            <td>${data.requestedDate}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td></td>
        </tr>
    `;
/*
    <tr>
    <td>Status</td>
    <td>
        <select id="status-select" data-id="${data.bookingID}">
            <option value="PENDING" ${data.status === "PENDING" ? "selected" : ""}>PENDING</option>
            <option value="FOR APPROVAL" ${data.status === "FOR APPROVAL" ? "selected" : ""}>FOR APPROVAL</option>
            <option value="APPROVED" ${data.status === "APPROVED" ? "selected" : ""}>APPROVED</option>
            <option value="CANCELLED" ${data.status === "CANCEL" ? "selected" : ""}>CANCELLED</option>
            <option value="DECLINED" ${data.status === "DECLINED" ? "selected" : ""}>DECLINED</option>
        </select>
    </td>
</tr>
<tr>
    <td>Price</td>
    <td>${data.pricingRateRoom}</td>
</tr>
*/

    customerContainer.innerHTML = `
        <tr>
            <th>Desc.</th>
            <th>Info.</th>
        </tr>
        <tr>
            <td>Name</td>
            <td>${data.firstName} ${data.lastName}</td>
        </tr>
        <tr>
            <td>Mobile No.</td>
            <td>${data.mobileNo}</td>
        </tr>
                <tr>
            <td>Email Add.</td>
            <td>${data.emailAddress}</td>
        </tr>
    `;

    document.querySelector("#status-select").addEventListener("change", function () {
        let bookingID = this.getAttribute("data-id");
        let newStatus = this.value;
        updateBookingStatus(bookingID, newStatus);
    });
}


function resetInfo(){
    const detailsContainer = document.querySelector("#event-info tbody");
    const customerContainer = document.querySelector("#customer-info tbody");

    if (!detailsContainer || !customerContainer) return;

    detailsContainer.innerHTML = `
        <tr>
            <th>Desc.</th>
            <th>Info.</th>
        </tr>
        <tr>
            <td>Room Type</td>
            <td>Please Select a Record</td>
        </tr>
        <tr>
            <td>Date</td>
            <td>Please Select a Record</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>Please Select a Record</td>
        </tr>
        <tr>
            <td>Price</td>
            <td>Please Select a Record</td>
        </tr>
    `;

    customerContainer.innerHTML = `
        <tr>
            <th>Desc.</th>
            <th>Info.</th>
        </tr>
        <tr>
            <td>Name</td>
            <td>Please Select a Record</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>Please Select a Record</td>
        </tr>
        <tr>
            <td>Mobile No.</td>
            <td>Please Select a Record</td>
        </tr>
    `;
}

/*
function updateBookingStatus(bookingID, newStatus) {
    fetch("../admin-api/updateBooking.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ bookingID: bookingID, status: newStatus }),
    })
    .then((response) => response.json())
    .then((data) => {
        console.log("Update Response:", data);
        if (data.success) {
            alert("Booking status updated successfully!");
            reloadBookings();
            resetInfo();
        } else {
            alert("Failed to update status: " + data.error);
        }
    })
    .catch((error) => console.error("Error updating booking status:", error));
}
*/

reloadEvents();
