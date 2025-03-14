<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
}


include "../config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST ?: json_decode(file_get_contents("php://input"), true);


    if (!isset($data['lastname'], $data['firstname'], $data['email'], $data['contact_number'], $data['purpose'], $data['schedule_date'], $data['schedule_period']) && ($data['purpose'] !== "default")) {
        echo json_encode(["status" => "error", "message" => "Missing/incorrect required fields"]);
        exit;
    }

    $referenceNo = date('Ymd') . rand(1000, 9999);
    $userID = $_SESSION['userID'];
    $status = "PENDING";
    $schedule_period = $data['schedule_date'];

    $stmt = $conn->prepare("INSERT INTO reservation (referenceNo, userID, status, requestedDate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $referenceNo, $userID, $status, $schedule_period);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Event added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add event"]);
    }

    $stmt->close();
    
}

$conn->close();
?>
