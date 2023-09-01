<!DOCTYPE html>
<html lang="en">

<head>
    <title>Workshop 04: Update student mark</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Brett Wilkinson" />
</head>

<body>
    <h1>Update a student result</h1>
    <main>
        <form method="post" action="update-result.php">
            <label>Select a student from the drop-down list:</label>
            <select id="studentID" name="studentID">
                <?php
                require_once "inc/dbconn.inc.php";

                $sql = "SELECT id, name FROM StudentResults;";
                if ($result = mysqli_query($conn, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value=\"" . $row["id"] . "\" name=\"" . $row["name"] . "\">" . $row["name"] . "</option>";
                        }
                        // Free up memory consumed by the $result object
                        mysqli_free_result($result);
                    }
                }
                mysqli_close($conn);
                ?>
            </select>
            <input type="text" name="newMark" placeholder="Enter a mark" />
            <input type="submit" value="Submit">
        </form>
    </main>
</body>

</html>