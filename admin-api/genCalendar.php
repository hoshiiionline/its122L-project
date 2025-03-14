<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");
}

include_once "../config/config.php";

$stmt = $conn->prepare("
    SELECT reservation.reservationID, reservation.requestedDate, 
    users.firstName, users.lastName, 
    wedding.weddingID, baptism.baptismID
    FROM reservation
    INNER JOIN users ON reservation.userID = users.userID
    LEFT JOIN wedding ON reservation.reservationID = wedding.reservationID
    LEFT JOIN baptism ON reservation.reservationID = baptism.reservationID
");

$stmt->execute();
$result = $stmt->get_result();

$events = [];

while ($row = $result->fetch_assoc()) {
    $eventType = !is_null($row["weddingID"]) ? "Wedding" : "Baptism";

    $events[] = [
        "id" => $row["reservationID"],
        "title" => "$eventType - {$row['firstName']} {$row['lastName']}",
        "start" => date("Y-m-d", strtotime($row["requestedDate"])),
        "allDay" => true
    ];
}

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    echo json_encode($events, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

$conn->close();
?>
