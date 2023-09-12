"use strict";

// *Account Dropdown*
function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}

document.querySelector(".account").addEventListener("click", toggleDropdown);

window.addEventListener("click", function (event) {
    if (!event.target.matches(".account")) {
        let dropdowns = document.getElementsByClassName("dropdown-content");
        let i;
        for (i = 0; i < dropdowns.length; i++) {
            let openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
            }
        }
    }
});

// *Add Task*
window.addEventListener("load", () => {
    const form = document.querySelector("#new-task-form");
    const input = document.querySelector("#new-task-input");
    const list_el = document.querySelector("#tasks");

    let tasks = JSON.parse(localStorage.getItem("tasks")) || [];

    // Save tasks to local storage
    function saveTasks() {
        localStorage.setItem("tasks", JSON.stringify(tasks));
    }

    // Render tasks
    function renderTasks() {
        list_el.innerHTML = "";

        tasks.forEach((task, index) => {
            const task_el = document.createElement("div");
            task_el.classList.add("task");

            const task_content_el = document.createElement("div");
            task_content_el.classList.add("content");

            task_el.appendChild(task_content_el);

            const task_status_el = document.createElement("div");
            task_status_el.classList.add("status");

            // Status-options
            const status_select_el = document.createElement("select");
            status_select_el.classList.add("status-select");

            // Default option
            const default_option_el = document.createElement("option");
            default_option_el.value = "";
            default_option_el.innerText = "Status";
            status_select_el.appendChild(default_option_el);

            const statusOptions = ["Priority", "Active", "Completed"];

            statusOptions.forEach((option) => {
                const option_el = document.createElement("option");
                option_el.value = option.toLowerCase();
                option_el.innerText = option;
                status_select_el.appendChild(option_el);
            });

            status_select_el.value = task.status;

            // Update the status and save changes
            status_select_el.addEventListener("change", () => {
                task.status = status_select_el.value;
                saveTasks();
                // Update the background color based on status
                updateBackgroundColor(task_el, task.status);
            });

            task_status_el.appendChild(status_select_el);

            const task_input_el = document.createElement("input");
            task_input_el.classList.add("text");
            task_input_el.type = "text";
            task_input_el.value = task.text;
            task_input_el.setAttribute("readonly", "readonly");

            const task_title_el = document.createElement("div");
            task_title_el.classList.add("title");
            task_title_el.innerText = task.title;

            task_content_el.appendChild(task_input_el);
            task_content_el.appendChild(task_title_el);

            const task_actions_el = document.createElement("div");
            task_actions_el.classList.add("actions");

            const task_details_el = document.createElement("button");
            task_details_el.classList.add("details");
            task_details_el.innerText = "Task Details";
            task_details_el.addEventListener("click", () => {
                // Redirect to the Task Details page when clicked
                window.location.href = "tasks.html"; // Replace with the actual URL here
            });

            // "Assigned to"options
            const assignedTo_select_el = document.createElement("select");
            assignedTo_select_el.classList.add("assigned-to-select");

            const assignedTo_default_option_el = document.createElement("option");
            assignedTo_default_option_el.value = "";
            assignedTo_default_option_el.innerText = "Assigned to";
            assignedTo_select_el.appendChild(assignedTo_default_option_el);

            const assignedToOptions = [
                "Carlos Taylor",
                "Duc Minh Nguyen",
                "Poonam Panchal",
                "Shengfan Wang",
            ];

            assignedToOptions.forEach((option) => {
                const option_el = document.createElement("option");
                option_el.value = option.toLowerCase();
                option_el.innerText = option;
                assignedTo_select_el.appendChild(option_el);
            });

            assignedTo_select_el.value = task.assignedTo;
            assignedTo_select_el.addEventListener("change", () => {
                task.assignedTo = assignedTo_select_el.value;
                saveTasks();
            });

            task_status_el.appendChild(assignedTo_select_el);

            const task_edit_el = document.createElement("button");
            task_edit_el.classList.add("edit");
            task_edit_el.innerText = "Edit";

            const task_delete_el = document.createElement("button");
            task_delete_el.classList.add("delete");
            task_delete_el.innerText = "Delete";

            task_actions_el.appendChild(task_status_el);
            task_status_el.appendChild(assignedTo_select_el);
            task_actions_el.appendChild(task_details_el);
            task_actions_el.appendChild(task_edit_el);
            task_actions_el.appendChild(task_delete_el);

            task_el.appendChild(task_actions_el);

            list_el.appendChild(task_el);

            task_edit_el.addEventListener("click", (e) => {
                if (task_edit_el.innerText.toLowerCase() == "edit") {
                    task_edit_el.innerText = "Save";
                    task_input_el.removeAttribute("readonly");
                    task_input_el.focus();
                } else {
                    // Save the changes with "Save" button
                    task_edit_el.innerText = "Edit";
                    task_input_el.setAttribute("readonly", "readonly");
                    task.text = task_input_el.value; // Update the task text with the edited value
                    saveTasks();
                }
            });

            task_delete_el.addEventListener("click", (e) => {
                list_el.removeChild(task_el);
                // Remove the task from the tasks array
                tasks.splice(index, 1);
                saveTasks();
            });

            // Update the background color based on status
            updateBackgroundColor(task_el, task.status);
        });
    }

    // Update the background color based on status
    function updateBackgroundColor(element, status) {
        element.classList.remove(
            "status-priority",
            "status-active",
            "status-completed"
        );

        // Add the class corresponding to the status
        element.classList.add(`status-${status.toLowerCase()}`);
    }

    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const taskText = input.value.trim();

        if (taskText !== "") {
            const newTask = {
                text: taskText,
                status: "", // Default status
                title: "Resident Name here", // Default title
                assignedTo: "", // Default assignedTo
            };

            tasks.push(newTask);
            saveTasks();
            input.value = "";
            renderTasks();
        }
    });

    // Load tasks and render on page load
    function loadTasks() {
        tasks = JSON.parse(localStorage.getItem("tasks")) || [];
        renderTasks();
    }

    loadTasks();

    // Save button
    const saveButton = document.getElementById("saveButton");
    saveButton.addEventListener("click", () => {
        saveTasks();
        renderTasks();
        alert("Data has been saved.");
    });
});
