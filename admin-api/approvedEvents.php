<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");
}

include_once "../config/config.php";

$stmt = $conn->prepare("
    SELECT reservation.reservationID, reservation.requestedDate, users.firstName, users.lastName, wedding.weddingID, baptism.baptismID
    FROM reservation
    INNER JOIN users ON reservation.userID = users.userID
    LEFT JOIN wedding on reservation.reservationID = wedding.reservationID
    LEFT JOIN baptism on reservation.reservationID = baptism.reservationID
");

$stmt->execute();
$result = $stmt->get_result();

$availableRooms = $result->fetch_all(MYSQLI_ASSOC);

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    echo json_encode($availableRooms);
}

$conn->close();
?>
