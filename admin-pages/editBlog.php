<?php
if (!isset($_GET['file'])) {
    die("No file specified.");
}

$filename = "../markdown-blog/posts/" . basename($_GET['file']) .".md";

if (!file_exists($filename)) {
    die("File not found.");
}

$content = file_get_contents($filename);

$lines = explode("\n", $content);

if (count($lines) > 1) {
    $title = array_shift($lines);
    $title = preg_replace('/^#\s*/', '', $title);

    echo '<script>console.log(' . json_encode($title) . ');</script>';
    $content = implode("\n", $lines);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
</head>
<body>
    <div class="edit-container">
        <h1>Edit Blog Post</h1>
        <input type="text" id="title-input" placeholder="Enter Blog Title" value="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>" maxlength="100">
        <textarea id="content-input"><?php echo htmlspecialchars($content); ?></textarea>
        <button onclick="updatePost()">Update Post</button>
    </div>

    <script>
        let easyMDE = new EasyMDE({ element: document.getElementById("content-input") });

        function updatePost() {
            const title = document.getElementById("title-input").value.trim();
            const content = easyMDE.value().trim();

            if (title === "" || content === "") {
                alert("Title and content cannot be empty.");
                return;
            }

            fetch("../admin-api/updateBlog.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ filename: "<?php echo basename($filename); ?>", title: title, content: content })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.success) {
                    window.location.href = '../markdown-blog/blog-posts-list.php';
                }
            })
            .catch(error => console.error("Error:", error));
        }
    </script>
</body>
</html>