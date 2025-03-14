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
    <title>Edit Blog Post | Holy Family Parish</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300..900&family=Oranienbaum&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-color: #ffc936;
            --primary-dark: #e6b42e;
            --text-dark: #161616;
            --text-light: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.2)),
                        url("../resources/bg2.jpg") no-repeat center center / cover;
            background-attachment: fixed;
        }

        .edit-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 30px;
            background: var(--glass-bg);
            border-radius: 20px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
        }

        h1 {
            font-family: 'Oranienbaum', serif;
            color: var(--text-dark);
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary-color);
        }

        #title-input {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-size: 16px;
            font-family: 'Figtree', sans-serif;
            background: rgba(255, 255, 255, 0.9);
            transition: var(--transition);
        }

        #title-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(255, 201, 54, 0.2);
        }

        .EasyMDEContainer {
            margin-bottom: 20px;
        }

        .editor-toolbar {
            border-color: rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
        }

        .CodeMirror {
            border-color: rgba(0, 0, 0, 0.1) !important;
            background: rgba(255, 255, 255, 0.9) !important;
        }

        .editor-preview {
            background: rgba(255, 255, 255, 0.95) !important;
        }

        button {
            background: var(--primary-color);
            color: var(--text-dark);
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(230, 180, 46, 0.3);
        }

        /* Navbar Styles */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
            padding: 15px 30px;
            z-index: 1000;
            box-shadow: var(--shadow);
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .navbar li {
            margin: 0;
        }

        .navbar a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
            padding: 8px 16px;
            border-radius: 8px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar a:hover {
            background: rgba(255, 201, 54, 0.2);
        }

        .navbar a.active {
            background: var(--primary-color);
            color: var(--text-dark);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .edit-container {
                padding: 20px;
                margin: 60px 10px 20px;
            }

            h1 {
                font-size: 24px;
            }

            button {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Add navbar -->
    <nav class="navbar">
        <ul>
            <li><a href="../hfp-dashboard.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="../markdown-blog/blog-posts-list.php"><i class="fas fa-blog"></i> Blog List</a></li>
            <li><a href="createBlog.php"><i class="fas fa-plus"></i> New Post</a></li>
            <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="edit-container">
        <h1>Edit Blog Post</h1>
        <input type="text" id="title-input" placeholder="Enter Blog Title" value="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>" maxlength="100">
        <textarea id="content-input"><?php echo htmlspecialchars($content); ?></textarea>
        <button onclick="updatePost()">
            <i class="fas fa-save"></i> Update Post
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
    <script>
        let easyMDE = new EasyMDE({ 
            element: document.getElementById("content-input"),
            spellChecker: false,
            autofocus: true,
            placeholder: "Write your blog post content here...",
            status: ['lines', 'words', 'cursor'],
            toolbar: [
                'bold', 'italic', 'heading', '|',
                'quote', 'unordered-list', 'ordered-list', '|',
                'link', 'image', '|',
                'preview', 'side-by-side', 'fullscreen', '|',
                'guide'
            ]
        });

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