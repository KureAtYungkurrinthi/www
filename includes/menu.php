<header>
    <a href="../index.php">
        <img id="logo" src="../images/logo.png" alt="Flinders Care"/>
    </a>

    <?php

    if (isset($_SESSION["user_name"])) {
        $username = $_SESSION["user_name"];
        $e = $_SESSION["user_email"];
        echo '<a id="username" href="../users.php">' . $username . '</a>';
    } else {
        // If the user is not logged in, you can display a default or login link here.
        header("Location: login.php");
        echo '<a id="username" href="../login.php">Login</a>';
    }
    ?>

</header>

<nav id="side-nav">
    <a href="../index.php">Main</a>
    <a href="../users.php">Users</a>
    <a href="kanban.php">Kanban</a>
    <a href="stats.php">Statistics</a>
    <a href="../logout.php">Logout</a>
</nav>

<footer>
    <p>&copy; <span id="currentYear"></span> Flinders Care. All rights reserved.</p>
</footer>