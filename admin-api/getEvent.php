<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");
}

include_once "../config/config.php";

$reservationID = isset($_GET["reservationID"]) ? $_GET["reservationID"] : null;
$type = isset($_GET["type"]) ? $_GET["type"] : null;

if ($reservationID) {
    if ($type == "wd"){
        $stmt = $conn->prepare("
        SELECT 
            reservation.reservationID, 
            reservation.status,
            reservation.requestedDate, 
            users.emailAddress,
            users.mobileNumber,
            users.firstName, 
            users.lastName, 
            'Wedding' AS eventType, 
            wedding.weddingID AS eventID, 
            wedding.groomName, wedding.brideName, wedding.guestsNo, 
            NULL AS childName, NULL AS dateOfBirth, NULL AS motherName, NULL AS fatherName, NULL AS godparentsNo
        FROM reservation
        INNER JOIN users ON reservation.userID = users.userID
        INNER JOIN wedding ON reservation.reservationID = wedding.reservationID
        WHERE reservation.reservationID = ?
    ");
    } else {
        $stmt = $conn->prepare("
        SELECT 
            reservation.reservationID, 
            reservation.status,
            reservation.requestedDate, 
            users.emailAddress,
            users.mobileNumber,
            users.firstName, 
            users.lastName, 
            'Baptism' AS eventType, 
            baptism.baptismID AS eventID, 
            NULL AS groomName, NULL AS brideName, NULL AS guestsNo, 
            baptism.childName, baptism.dateOfBirth, baptism.motherName, baptism.fatherName, baptism.godparentsNo
        FROM reservation
        INNER JOIN users ON reservation.userID = users.userID
        INNER JOIN baptism ON reservation.reservationID = baptism.reservationID
        WHERE reservation.reservationID = ?
    ");
    }

    $stmt->bind_param("i", $reservationID);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $data["type"] = ($type === "wd") ? "Wedding" : (($type === "bt") ? "Baptism" : "Unknown");

    echo json_encode($data);
} else {
    echo json_encode(["error" => "No reservation ID provided"]);
}

$conn->close();
?>