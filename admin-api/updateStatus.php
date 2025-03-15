<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include_once "../config/config.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["reservationID"]) || !isset($data["status"])) {
    echo json_encode(["success" => false, "error" => "Missing parameters"]);
    exit;
}

$reservationID = $data["reservationID"];
$status = $data["status"];

$validStatuses = ["PENDING", "CONFIRMED", "CANCELLED"];
if (!in_array($status, $validStatuses)) {
    echo json_encode(["success" => false, "error" => "Invalid status"]);
    exit;
}

$stmt = $conn->prepare("UPDATE reservation SET status = ? WHERE reservationID = ?");
$stmt->bind_param("si", $status, $reservationID);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "query" => "UPDATE reservation SET status = ". $reservationID." WHERE reservationID = ". $status]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
