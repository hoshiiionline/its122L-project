<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");
}

include_once "../config/config.php";

$stmt = $conn->prepare("
    SELECT 
        reservation.reservationID, 
        reservation.requestedDate, 
        users.firstName, 
        users.lastName, 
        'Wedding' AS eventType, 
        wedding.weddingID AS eventID, 
        wedding.groomName, wedding.brideName, wedding.guestsNo, 
        NULL AS childName, NULL AS dateOfBirth, NULL AS motherName, NULL AS fatherName, NULL AS godparentsNo
    FROM reservation
    INNER JOIN users ON reservation.userID = users.userID
    INNER JOIN wedding ON reservation.reservationID = wedding.reservationID

    UNION

    SELECT 
        reservation.reservationID, 
        reservation.requestedDate, 
        users.firstName, 
        users.lastName, 
        'Baptism' AS eventType, 
        baptism.baptismID AS eventID, 
        NULL AS groomName, NULL AS brideName, NULL AS guestsNo, 
        baptism.childName, baptism.dateOfBirth, baptism.motherName, baptism.fatherName, baptism.godparentsNo
    FROM reservation
    INNER JOIN users ON reservation.userID = users.userID
    INNER JOIN baptism ON reservation.reservationID = baptism.reservationID

    ORDER BY 2 ASC;
");

$stmt->execute();
$result = $stmt->get_result();

$availableRooms = $result->fetch_all(MYSQLI_ASSOC);

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    echo json_encode($availableRooms);
}

$conn->close();
?>
