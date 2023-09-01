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
        <form method="POST" action="update-result.php">
            <label>Select a student from the drop-down list:</label>
            <select id="studentID" name="studentID">
                
                <!-- connect to db -->
                <!-- get all ids and names from table -->
                <!-- define option values -->

            </select>
            <input type="text" name="newMark" placeholder="Enter a mark" />
            <input type="submit" value="Submit">
        </form>
    </main>
</body>

</html>