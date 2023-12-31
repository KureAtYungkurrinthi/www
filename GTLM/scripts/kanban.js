function sortListByDate(columnId) {
    console.log("Sorting by Date for column: ", columnId);
    const column = document.getElementById(columnId);
    const tasks = Array.from(column.getElementsByClassName("task"));
    tasks.sort((a, b) => {
        const dateA = new Date(a.getAttribute("data-due-date"));
        const dateB = new Date(b.getAttribute("data-due-date"));
        console.log("Comparing: ", dateA, dateB);
        return dateA - dateB;
    });
    tasks.forEach((task) => column.appendChild(task));
}

function sortListByPriority(columnId) {
    console.log("Sorting by Priority for column: ", columnId);
    const column = document.getElementById(columnId);
    const tasks = Array.from(column.getElementsByClassName("task"));
    const priorityOrder = { High: 1, Medium: 2, Low: 3 };
    tasks.sort((a, b) => {
        const priorityA = a.getAttribute("data-priority");
        const priorityB = b.getAttribute("data-priority");
        console.log("Comparing: ", priorityA, priorityB);
        return priorityOrder[priorityA] - priorityOrder[priorityB];
    });
    tasks.forEach((task) => column.appendChild(task));
}
