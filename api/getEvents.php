<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");
}

include "../config/config-calendar.php";


$stmt = $conn->prepare("
    SELECT *
    FROM confirmedEvents
");

//$stmt->bind_param("ss", $startDate, $endDate);
$stmt->execute();
$result = $stmt->get_result();

$availableRooms = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    echo json_encode($availableRooms);
}

$conn->close();
?>
