const tasks = ["Task 1", "Task 2", "Task 3", "Task 4", "Task 5"];

const assignees = ["Duc Minh Nguyen", "Poonam Panchal", "Hussnain Shakeel", "Shengfan Wang", "Kavindu Weeratunga"];

function populateTasks() {
    const taskList = document.getElementById('taskList');

    tasks.forEach(task => {
        const li = document.createElement('li');
        li.innerHTML = `
            <span class="task-name">${task}</span>
            <select class="assignee">
                <option value="" disabled selected>Select Assignee</option>
                ${assignees.map(assignee => `<option value="${assignee}">${assignee}</option>`).join('')}
            </select>
        `;
        taskList.appendChild(li);
    });
}

document.getElementById('saveBtn').addEventListener('click', function () {
    const taskElements = document.querySelectorAll('#taskList li');
    taskElements.forEach((element, index) => {
        tasks[index].assignee = element.querySelector('.assignee').value;
    });
    console.log(tasks);
});

document.addEventListener('DOMContentLoaded', populateTasks);