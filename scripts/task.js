document.addEventListener('DOMContentLoaded', function () {
    // Define the task data
    const taskData = {
        location: 'Ward C',
        person: 'John Smith',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur nec elit at purus tincidunt consequat sit amet ac arcu. Ut ac nunc rutrum, aliquet sem at, porta erat. Pellentesque bibendum, enim ac imperdiet luctus, lacus lorem elementum nulla, vel condimentum quam nisl a erat. Cras arcu ipsum, tempus eget pellentesque aliquam, consequat at lorem. Integer felis arcu, pretium vel tellus non, ullamcorper molestie enim. Quisque ac venenatis metus. Etiam fringilla libero sed rutrum molestie. Nullam arcu elit, pulvinar vitae vehicula at, ultrices vel tellus. Donec id ultrices erat.',
        details: 'Praesent tellus lorem, tristique a nisl eu, laoreet laoreet nibh. Cras vel erat fermentum, sagittis ante sed, fringilla magna. Fusce commodo velit finibus, iaculis felis eget, hendrerit ipsum. Donec vel luctus magna, non congue tellus. Aenean turpis lectus, volutpat a nunc quis, imperdiet ullamcorper nibh. Suspendisse ac arcu vitae eros dictum dapibus nec in dolor. Nulla efficitur fringilla felis nec consequat. Nullam ac nunc ut neque pretium laoreet.',
        subTasks: [
            'Sub-Task 1',
            'Sub-Task 2',
            'Sub-Task 3'
        ]
    };

    // Populate the data into the HTML
    document.getElementById('task-location').innerText = taskData.location;
    document.getElementById('task-person').innerText = taskData.person;
    document.getElementById('task-description').innerText = taskData.description;
    document.getElementById('task-details').innerText = taskData.details;


    const subTasksList = document.getElementById('sub-tasks-list');
    taskData.subTasks.forEach(task => {
        const listItem = document.createElement('li');
        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.classList.add('sub-task-checkbox');
        const label = document.createElement('label');
        label.innerHTML = task;
        label.insertBefore(checkbox, label.firstChild);
        listItem.appendChild(label);
        subTasksList.appendChild(listItem);
    });

});
