<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset ="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Holy Family Parish | Blog</title>
    <link href="../styling/styling-dashboard.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bentham&family=Figtree:ital,wght@0,300..900;1,300..900&family=Fjalla+One&family=Instrument+Serif:ital@0;1&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&family=Lexend+Giga:wght@100..900&family=Oranienbaum&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
  </head>
  <body>
  <div class="formContainer">
        <input type="text" id="title-input" placeholder="Enter Blog Title" maxlength="100">
        <textarea id="content-input"></textarea>
        <button onclick="submitPost()">Submit</button>
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
                ]
            });
        });

        function submitPost() {
            const title = document.getElementById("title-input").value.trim();
            const content = easyMDE.value().trim();

            if (title === "" || content === "") {
                alert("Title and content cannot be empty.");
                return;
            }

            fetch("../api/createBlog.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ title: title, content: content })
            })
            .then(response => response.json())
            .then(data => alert(data.message))
            .catch(error => console.error("Error:", error));
        }
    </script>
  </body>
</html>