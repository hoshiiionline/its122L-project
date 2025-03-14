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

    $referenceNo = date('Ymd') . rand(1000, 9999);
    $_SESSION['referenceNo'] = $referenceNo;
    $userID = $_SESSION['userID'];
    $status = "PENDING";
    $schedule_period = $data['schedule_date'];

    $stmt = $conn->prepare("INSERT INTO reservation (referenceNo, userID, status, requestedDate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $referenceNo, $userID, $status, $schedule_period);

    if ($stmt->execute()) {
        //echo json_encode(["status" => "success", "message" => "Event added successfully"]);
    } else {
        //echo json_encode(["status" => "error", "message" => "Failed to add event"]);
    }

    $stmt->close();

    $stmt = $conn->prepare("SELECT reservationID FROM reservation WHERE referenceNo = ?");
    $stmt->bind_param("s", $referenceNo);
    $stmt->execute();
    $result = $stmt->get_result();
    $reservationID = $result->fetch_assoc()['reservationID'];
    $stmt->close(); 

    if ($data['purpose'] === "default") {
        //echo json_encode(["status" => "error", "message" => "Please select a purpose"]);
        exit;
    } else if ($data['purpose'] === "Baptism") {
        if (!isset($data['schedule_period'], $data['schedule_date'], $data['purpose'], $data['childName'], $data['dateOfBirth'], $data['fatherName'], $data['motherName'], $data['godParentsNo'])) {
            //echo json_encode(["status" => "error", "message" => "Missing/incorrect required fields"]);
            exit;
        } else {
            $stmt = $conn->prepare("INSERT INTO baptism (reservationID, childName, dateOfBirth, fatherName, motherName, godParentsNo) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssi", $reservationID, $data['childName'], $data['dateOfBirth'], $data['fatherName'], $data['motherName'], $data['godParentsNo']);

            if ($stmt->execute()) {
                //echo json_encode(["status" => "success", "message" => "Baptism details added successfully"]);
                ob_end_flush();
                header("Location: ../pages/hfp-thankYouPage.php");
                exit();
            } else {
                //echo json_encode(["status" => "error", "message" => "Failed to add baptism details"]);
            }

            $stmt->close();
        }
    } else if ($data['purpose'] === "Wedding") {
        //echo "wedding!";
        if (!isset($data['schedule_period'], $data['schedule_date'], $data['purpose'], $data['groomName'],  $data['brideName'], $data['guestsNo'])) {
            //echo json_encode(["status" => "error", "message" => "Missing/incorrect required fields"]);
            exit;
        } else {
            $stmt = $conn->prepare("INSERT INTO wedding (reservationID, groomName, brideName, guestsNo) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("issi", $reservationID, $data['groomName'], $data['brideName'], $data['guestsNo']);

            if ($stmt->execute()) {
                //echo json_encode(["status" => "success", "message" => "Wedding details added successfully"]);
                ob_end_flush();
                header("Location: ../pages/hfp-thankYouPage.php");
                exit();
            } else {
                //echo json_encode(["status" => "error", "message" => "Failed to add wedding details"]);
            }

            $stmt->close();
        }
    } 
}

$conn->close();
?>
