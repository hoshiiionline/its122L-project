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
            r.*, 
            u.*, 
            w.*
        FROM reservation r
        INNER JOIN users u ON r.userID = u.userID
        LEFT JOIN wedding w ON r.reservationID = w.reservationID
        WHERE r.reservationID = ?;
    ");
    } else {
        $stmt = $conn->prepare("
        SELECT 
            r.*, 
            u.*, 
            b.*
        FROM reservation r
        INNER JOIN users u ON r.userID = u.userID
        LEFT JOIN baptism b ON r.reservationID = b.reservationID
        WHERE r.reservationID = ?;
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