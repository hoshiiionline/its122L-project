<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $input = json_decode(file_get_contents("php://input"), true);
    $title = trim($input["title"] ?? "");
    $content = trim($input["content"] ?? "");

    if (!empty($title) && !empty($content)) {
        // Generate slug
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        $filename = "../markdown-blog/posts/" . date("Y-m-d") . "-{$slug}.md";

        // Markdown file format
        $markdownContent = "# {$title}\n\n";
        $markdownContent .= $content;

        // Save the file
        if (file_put_contents($filename, $markdownContent)) {
            echo json_encode(["status" => "success", "message" => "✅ Post saved successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "❌ Error saving the post."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Title and content are required."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
