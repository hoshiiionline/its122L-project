<?php
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$filename = "../markdown-blog/posts/" . basename($data["filename"]);

if (!file_exists($filename)) {
    echo json_encode(["success" => false, "message" => "File not found.", "filename" => $filename]);
    exit;
}

$newContent = "# " . $data["title"] . "\n\n" . $data["content"];

if (file_put_contents($filename, $newContent)) {
    echo json_encode(["success" => true, "message" => "Blog updated successfully.", "filename" => $filename]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to update the blog.", "filename" => $filename]);
}
?>
