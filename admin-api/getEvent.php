<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");
}

include_once "../config/config.php";

$reservationID = isset($_GET["reservationID"]) ? $_GET["reservationID"] : null;

if ($reservationID) {
    $stmt = $conn->prepare("
        SELECT reservation.reservationID, reservation.requestedDate, users.firstName, users.lastName, wedding.weddingID, baptism.baptismID
        FROM reservation
        INNER JOIN users ON reservation.userID = users.userID
        LEFT JOIN wedding on reservation.reservationID = wedding.reservationID
        LEFT JOIN baptism on reservation.reservationID = baptism.reservationID
        WHERE reservation.reservationID = ?
    ");
    $stmt->bind_param("i", $reservationID);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    echo json_encode($data);
} else {
    echo json_encode(["error" => "No reservation ID provided"]);
}

$conn->close();
?>