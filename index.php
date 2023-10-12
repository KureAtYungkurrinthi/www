<?php require_once "includes/sessionValidator.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="styles/menu.css"/>
    <link rel="stylesheet" href="styles/index.css"/>
    <script src="scripts/menu.js" defer></script>
    <script src="scripts/index.js" defer></script>

    <meta name="author" content="Group 5"/>
    <meta name="description" content="Rooms Management"/>
    <title>Rooms Management</title>
</head>

<body>
<?php require_once "includes/menu.php"; ?>

<main>
    <h1>Rooms Management</h1>

    <?php
    require_once "includes/dbConnect.php";

    $sql = "SELECT Rooms.roomID, Rooms.roomNumber, Rooms.roomType, Patients.firstName, Patients.lastName 
            FROM Rooms 
            LEFT JOIN Patients ON Rooms.roomID = Patients.roomID;";
    if ($result = mysqli_query($conn, $sql)) {
        echo '<table>';
        echo '<tr><th>Room Number</th><th>Type</th><th>Occupied By</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            $occupiedBy = $row['firstName'] ? $row['firstName'].' '.$row['lastName'] : 'Vacant';
            echo '<tr data-room-id="'.$row["roomID"].'">';  // Added data attribute
            echo '<td>'.$row["roomNumber"].'</td>';
            echo '<td>'.$row["roomType"].'</td>';
            echo '<td>'.$occupiedBy.'</td>';
            echo '</tr>';
        }
        echo '</table>';
        mysqli_free_result($result);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
    ?>

    <h2>Add a New Room</h2>
    <form action="actions/addRoom.php" method="post">
        <label for="roomNumber">Room Number:</label>
        <input type="text" id="roomNumber" name="roomNumber" required/><br/>

        <label for="roomType">Room Type:</label>
        <select id="roomType" name="roomType" required>
            <option value="Regular">Regular</option>
            <option value="Premium">Premium</option>
            <option value="VIP">VIP</option>
        </select><br/>

        <input type="submit" value="Add Room"/>
    </form>
</main>
</body>

</html>
