<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
}


include "config/config-calendar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST ?: json_decode(file_get_contents("php://input"), true);


    if (!isset($data['lastname'], $data['firstname'], $data['email'], $data['contact_number'], $data['purpose'], $data['schedule_date'], $data['schedule_period'])) {
        echo json_encode(["status" => "error", "message" => "Missing required fields"]);
        exit;
    }

    $lastname = $data['lastname'];
    $firstname = $data['firstname'];
    $email = $data['email'];
    $contact_number = $data['contact_number'];
    $purpose = $data['purpose'];
    $schedule_date = $data['schedule_date'];
    $schedule_period = $data['schedule_period'];

    $stmt = $conn->prepare("INSERT INTO pendingEvents (lastname, firstname, email, contact_number, purpose, schedule_date, schedule_period) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $lastname, $firstname, $email, $contact_number, $purpose, $schedule_date, $schedule_period);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Event added successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to add event"]);
    }

    $stmt->close();
    
}

$conn->close();
?>
