<?php
session_start();

if (!isset($_SESSION["username"]) && !isset($_SESSION["id"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>🐟 Fish Todo</title>
        <link rel="stylesheet" href="assets/css/output.css" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script
            src="https://kit.fontawesome.com/1122500902.js"
            crossorigin="anonymous"
        ></script>
    </head>
    <body class="tw-min-h-screen tw-flex tw-items-center tw-justify-center">
        <div
            class="container rounded-1 tw-backdrop-filter tw-backdrop-blur-xl tw-shadow-md tw-shadow-brand-900 tw-rounded-xl"
        >
            <h1 class="text-center m-3 tw-text-white">
                <?php echo $_SESSION["username"] ?>&apos;s To Do List
            </h1>
            <div class="gap-2 m-3 tw-flex tw-justify-center">
                <button
                    type="button"
                    class="btn btn-success text-center tw-w-full"
                    data-bs-toggle="modal"
                    data-bs-target="#new-task-modal"
                >
                    Add new task
                    <span class="m-3"
                        ><i class="fa-solid fa-list-check"></i
                    ></span>
                </button>

                <a
                    href="logout.php"
                    class="btn btn-danger text-center tw-w-full"
                >
                    Logout

                    <span class="m-3">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span>
                </a>
            </div>

            <!-- alert -->
            <span id="alert-container"></span>

            <!-- list -->
            <div class="accordion m-3" id="tasks-container"></div>
        </div>

        <!-- modal -->
        <div
            class="modal fade"
            id="new-task-modal"
            tabindex="-1"
            aria-labelledby="new-task-modal-label"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add new task</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <form id="new-task-form">
                            <span id="alert-container"></span>
                            <div class="mb-3">
                                <label for="new-task-title">Title</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="new-task-title"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="new-task-description"
                                    >Description</label
                                >
                                <textarea
                                    id="new-task-description"
                                    class="form-control"
                                ></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-outline-danger"
                            data-bs-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            type="button"
                            class="btn btn-outline-success"
                            id="new-task-btn"
                        >
                            Add new task
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script src="assets/js/jquery-3.7.1.mins.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/script.js"></script>
    </body>
</html>
