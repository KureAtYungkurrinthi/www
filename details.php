<?php require_once "includes/sessionValidator.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Styles should be module and reference only when used in current page. -->
    <link rel="stylesheet" href="styles/menu.css"/>
    <link rel="stylesheet" href="styles/details.css"/>
    <!-- Same as above, script should also be module. -->
    <script src="scripts/menu.js" defer></script>

    <meta name="author" content="Group 5"/>
    <meta name="description" content="Backlog"/>
    <title>Backlog</title>
</head>

<body>
<?php require_once "menu.php"; ?>

<main>
    <div id="title">
        <h1>Task details</h1>
        <p>UNIT XX</p>
    </div>

    <h1>Resident details</h1>
    <ul class="list-info">
        <li>Full name: Mr Harry Wellington</li>
        <li>Gender: Male</li>
        <li>Aged: 79</li>
    </ul>

    <form class="desc">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="6" placeholder="Add description here"></textarea>
        <label for="note">Note</label>
        <textarea id="note" name="note" rows="6" placeholder="Add note here"></textarea>
    </form>

    <h1>Tasks List</h1>
    <input type="text" id="taskInput" placeholder="Enter a new task">
    <button class="addbtn" onclick="addTask()">➕ Add</button>
    <ul id="taskList">
        <li>
            <input type="checkbox" class="taskCheckbox">
            <span>Assist residents in daily routine</span>
            <button class="deleteButton">❌</button>
        </li>
        <li>
            <input type="checkbox" class="taskCheckbox">
            <span>Meal Assistance</span>
            <button class="deleteButton">❌</button>
        </li>
        <li>
            <input type="checkbox" class="taskCheckbox">
            <span>Housekeeping</span>
            <button class="deleteButton">❌</button>
        </li>
        <li>
            <input type="checkbox" class="taskCheckbox">
            <span>Mobility and Exercise</span>
            <button class="deleteButton">❌</button>
        </li>
        <li>
            <input type="checkbox" class="taskCheckbox">
            <span>Health Monitoring</span>
            <button class="deleteButton">❌</button>
        </li>
        <li>
            <input type="checkbox" class="taskCheckbox">
            <span>Administer medications</span>
            <button class="deleteButton">❌</button>
        </li>

    </ul>
    <div class="assign-task">
        <section id="assignStaffSection">
            <h2>📃 Staff list</h2>
            <select id="assignedTo_select_el" multiple>
                <option value="staff1">Carlos Taylor</option>
                <option value="staff2">Duc Minh Nguyen</option>
                <option value="staff3">Poonam Panchal</option>
                <option value="staff4">Shengfan Wang</option>
            </select>
            <button id="assignButton">Assign</button>
        </section>
        <ol id="assignedStaff">
            <!-- Assigned staff will be dynamically added here -->
        </ol>
    </div>
    <button id="saveButton">Save</button>
</main>
</body>

</html>