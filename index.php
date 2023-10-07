<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Styles should be module and reference only when used in current page. -->
    <link rel="stylesheet" href="styles/menu.css"/>
    <!-- Same as above, script should also be module. -->
    <script src="scripts/menu.js" defer></script>

    <meta name="author" content="Group 5"/>
    <meta name="description" content="Backlog"/>
    <title>Backlog</title>
</head>

<body>
<?php require_once "menu.php"; ?>

<main>
    <h2>Rooms</h2>
    <ul id="roomList"></ul>
</main>
</body>

</html>