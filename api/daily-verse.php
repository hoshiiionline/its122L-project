<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
    <link href="../css/main.css" rel="stylesheet" />
    <link href="../css/scripture.css" rel="stylesheet" />
    <title>Bible API Example Application</title>
  </head>
  <body>
    </header>
    <div class="subheader">
      <div class="container flex">
        <div class="subheadings">
          <!--<h2>Verse of the Day:</h2>-->
          <h3 id="viewing"><span id="verse"></span></h3>
        </div>
      </div>
    </div>
    <main class="container">
      <div id="verse-content" class="verse-container"></div>
    </main>
    <script src="http://cdn.scripture.api.bible/fums/fumsv2.min.js"></script>
    <script src="daily-verse-api.js"></script>
  </body>
</html>