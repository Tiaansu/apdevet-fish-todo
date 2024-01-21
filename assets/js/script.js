const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

const STORAGE_NAME = 'cabading-fish-todo-app;';

let tasksArray = JSON.parse(localStorage.getItem(STORAGE_NAME));
tasksArray = tasksArray ?? [];
let isEditingTask = false;
let taskID;

function modalReset() {
    isEditingTask = false;

    $('input[id="new-task-title"]').val('');
    $('textarea[id="new-task-description"]').val('');

    $('button[id="new-task-btn"]')
        .removeClass('btn-outline-warning')
        .addClass('btn-outline-success');
    $('button[id="new-task-btn"]').text('Add new task');

    $('#new-task-modal').modal('toggle');
}

// ---
// JQuery
// ---
$('#new-task-modal').on('shown.bs.modal', () => {
    $('input[id="new-task-title"]').focus();
});

$('button[id="new-task-btn"]').click((e) => {
    console.log(e);
    if ($('input[id="new-task-title"]').val().length === 0) {
        $('#alert-container').html(`
            <div class="alert alert-danger" role="alert">
                Please add a title for your task.
            </div>
        `);

        setTimeout(() => {
            $('#alert-container').html('');
        }, 2500);
    } else if ($('textarea[id="new-task-description"]').val().length === 0) {
        $('#alert-container').html(`
            <div class="alert alert-danger" role="alert">
                Please add a description for your task.
            </div>
        `);

        setTimeout(() => {
            $('#alert-container').html('');
        }, 2500);
    } else {
        if (isEditingTask === true) {
            tasksArray[taskID].title = $('input[id="new-task-title"]').val();
            tasksArray[taskID].description = $(
                'textarea[id="new-task-description"]'
            ).val();

            modalReset();

            localStorage.setItem(
                STORAGE_NAME,
                JSON.stringify(tasksArray, null, 2)
            );
        } else {
            const newTask = {
                id: tasksArray.length,
                title: $('input[id="new-task-title"]').val(),
                description: $('textarea[id="new-task-description"]').val(),
                timeAdded: new Date().getTime(),
                timeFinished: null,
                isFinished: false,
            };

            tasksArray.push(newTask);

            modalReset();

            localStorage.setItem(
                STORAGE_NAME,
                JSON.stringify(tasksArray, null, 2)
            );
        }
    }

    showTasks();
});

$('body').on('click', 'button.task-btn', (e) => {
    const btns = Array.from(e.target.classList);
    taskID = e.target.getAttribute('data-task-id');

    btns.forEach((button) => {
        if (button === 'task-btn-pending') {
            setTaskPending(taskID);
        } else if (button === 'task-btn-finish') {
            setTaskFinished(taskID);
        } else if (button === 'task-btn-edit') {
            editTask(taskID);
        } else if (button === 'task-btn-delete') {
            deleteTask(taskID);
        }
    });
});

$('body').on('mouseover', '[data-bs-toggle="tooltip"]', function (e) {
    e.stopPropagation();
    return new bootstrap.Tooltip(this).show();
});

$('body').on('mouseleave', '[data-bs-toggle="tooltip"]', function (e) {
    $('[role="tooltip"]').fadeOut(function () {
        e.stopPropagation();
        $(this).remove();
    });
});

// ---
// Functions
// ---
function showTasks() {
    $('#tasks-container').html('');

    let tasksHTML = '';

    if (tasksArray.length > 0) {
        tasksArray.forEach((task, id) => {
            tasksHTML += `
                <div class="accordion-item">
                    <h2 class="accordion-header" id="tasks-heading-${task.id}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tasks-body-${
                            task.id
                        }" aria-expanded="false" aria-controls="tasks-body-${
                task.id
            }">
                            ${task.title} <span class="badge ${
                task.isFinished ? 'bg-success' : 'bg-danger'
            } ms-2">${task.isFinished ? 'Finished' : 'Pending'}</span>
                        </button>
                    </h2>
                    <div id="tasks-body-${
                        task.id
                    }" class="accordion-collapse collapse" aria-labelledby="tasks-heading-${
                task.id
            }" data-bs-parent="#tasks-container">
                        <div class="accordion-body">
                            <p id="tasks-body-${task.id}-description">
                                <strong>Description:</strong> ${
                                    task.description
                                }
                            </p>
                            <p id="tasks-body-${task.id}-date-added">
                                <strong>Date added:</strong> ${convertTimestampToDate(
                                    task.timeAdded
                                )}
                            </p>
                            ${
                                task.isFinished
                                    ? `
                            <p id="tasks-body-${task.id}-date-finished">
                                <strong>Date finished:</strong> ${convertTimestampToDate(
                                    task.timeFinished
                                )}
                            </p>
                            `
                                    : ''
                            }
                            <div class="accordion-btn-container">
                                ${
                                    task.isFinished
                                        ? `
                                <button type="button" class="btn btn-outline-info task-btn task-btn-pending" data-task-id="${id}">
                                    Pending <i class="fa solid fa-rotate-left task-btn-pending" data-task-id="${id}"></i>
                                </button>
                                `
                                        : `
                                <button type="button" class="btn btn-outline-success task-btn task-btn-finish" data-task-id="${id}">
                                    Finish <i class="fa-solid fa-check task-btn-finish" data-task-id="${task.id}"></i>
                                </button>
                                `
                                }
                                <button type="button" class="btn btn-outline-warning task-btn task-btn-edit" data-task-id="${id}">
                                    Edit <i class="fa-solid fa-pen task-btn-edit" data-task-id="${
                                        task.id
                                    }"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger task-btn task-btn-delete" data-task-id="${id}">
                                    Delete <i class="fa-solid fa-trash task-btn-delete" data-task-id="${id}"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
    }

    $('#tasks-container').html(
        tasksArray.length > 0
            ? tasksHTML
            : `<p class="text-center tw-text-white">You don't have any task yet.</p>`
    );
}
showTasks();

function setTaskPending(id) {
    tasksArray[id].isFinished = false;
    tasksArray[id].timeFinished = null;

    localStorage.setItem(STORAGE_NAME, JSON.stringify(tasksArray, null, 2));

    showTasks();
}

function setTaskFinished(id) {
    tasksArray[id].isFinished = true;
    tasksArray[id].timeFinished = new Date().getTime();

    localStorage.setItem(STORAGE_NAME, JSON.stringify(tasksArray, null, 2));

    showTasks();
}

function editTask(id) {
    if (tasksArray[id].isFinished === true) {
        $('#alert-container').html(`
            <div class="alert alert-danger m-3 p-2" role="alert">
                You can't edit a task that is already finished.
            </div>
        `);

        setTimeout(() => {
            $('#alert-container').html('');
        }, 1000);
    } else {
        isEditingTask = true;
        $('h5[id="new-task-modal-label"]').text(`Edit task`);
        $('input[id="new-task-title"]').val(`${tasksArray[id].title}`);
        $('textarea[id="new-task-description"]').val(
            `${tasksArray[id].description}`
        );
        $('button[id="new-task-btn"]')
            .addClass('btn-outline-warning')
            .removeClass('btn-outline-success');
        $('button[id="new-task-btn"]').text('Edit task');
        $('#new-task-modal').modal('show');
    }
}

function deleteTask(id) {
    isEditingTask = false;
    tasksArray.splice(id, 1);
    localStorage.setItem(STORAGE_NAME, JSON.stringify(tasksArray));

    showTasks();
}

function convertTimestampToDate(timestamp) {
    return moment(timestamp).format('MMMM DD, YYYY hh:mm A');
}
