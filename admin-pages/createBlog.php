<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Blog Post | Holy Family Parish</title>
    <link href="../styling/styling-blog-create.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300..900&family=Oranienbaum&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
  </head>
  <body>
    <nav class="navbar">
        <ul class="list">
            <li><a href="hfp-dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="#"><i class="fa-solid fa-newspaper"></i> Newsletter</a></li>
            <li><a href="hfp-landing.php"><i class="fa-solid fa-door-open"></i> Exit</a></li>
        </ul>
    </nav>

    <div class="create-container">
        <div class="create-header">
            <h1>Create New Blog Post</h1>
            <a href="../markdown-blog/blog-posts-list.php" class="back-to-posts">
                <i class="fa-solid fa-arrow-left"></i> Back to Posts
            </a>
        </div>
        
        <div class="form-container">
            <input type="text" id="title-input" placeholder="Enter Blog Title" maxlength="100">
            <textarea id="content-input"></textarea>
            <button onclick="submitPost()" class="submit-btn">
                <i class="fa-solid fa-paper-plane"></i> Publish Post
            </button>
        </div>
    </div>

    <script>
        let easyMDE;

        document.addEventListener("DOMContentLoaded", function () {
            easyMDE = new EasyMDE({ 
                element: document.getElementById("content-input"),
                imageUpload: false,
                imagePaste: false,
                toolbar: [
                    "bold", "italic", "heading", "|",
                    "quote", "unordered-list", "ordered-list", "|",
                    "link", "preview", "side-by-side", "fullscreen", "|",
                    "guide"
                ],
                status: ["lines", "words"],
                spellChecker: false,
                placeholder: "Write your blog post content here...",
            });
        });

        function submitPost() {
            const title = document.getElementById("title-input").value.trim();
            const content = easyMDE.value().trim();

            if (title === "" || content === "") {
                alert("Title and content cannot be empty.");
                return;
            }

            fetch("../admin-api/createBlog.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ title: title, content: content })
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