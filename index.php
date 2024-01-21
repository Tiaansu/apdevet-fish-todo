<?php
require 'db.php';
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
    </head>
    <body>
        <div class="tw-flex tw-min-h-screen tw-justify-center tw-items-center">
            <form
                action="login.php"
                method="post"
                class="tw-max-w-md tw-h-auto tw-backdrop-filter tw-backdrop-blur-xl tw-shadow-md tw-shadow-brand-900 tw-rounded-xl tw-px-10 tw-py-8"
            >
                <h1 class="tw-flex tw-justify-center tw-text-white">
                    🐟 Fish In
                </h1>
                <?php if (isset($_GET["error"])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET["error"] ?>
                    </div>
                <?php } ?>
                <div class="md:tw-flex md:tw-items-center tw-mb-4 tw-mt-10">
                    <div class="md:tw-w-1/3">
                        <label
                            for="inline-username"
                            class="tw-block tw-text-white tw-font-bold md:tw-text-right tw-mb-1 md:tw-mb-0 tw-pr-4"
                        >
                            Username
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            type="text"
                            id="inline-username"
                            name="username"
                            class="tw-appearance-none tw-border-none tw-outline-none tw-rounded tw-w-full tw-py-2 tw-px-4 tw-text-gray-700 tw-leading-tight tw-transition-all tw-duration-200 tw-ease-in-out focus:tw-outline-none focus:tw-ring-[6px] focus:tw-ring-brand-400"
                        />
                    </div>
                </div>
                <div class="md:tw-flex md:tw-items-center tw-mb-4 tw-mt-4">
                    <div class="md:tw-w-1/3">
                        <label
                            for="inline-password"
                            class="tw-block tw-text-white tw-font-bold md:tw-text-right tw-mb-1 md:tw-mb-0 tw-pr-4"
                        >
                            Password
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input
                            type="password"
                            id="inline-password"
                            name="password"
                            class="tw-appearance-none tw-border-none tw-outline-none tw-rounded tw-w-full tw-py-2 tw-px-4 tw-text-gray-700 tw-leading-tight tw-transition-all tw-duration-200 tw-ease-in-out focus:tw-outline-none focus:tw-ring-[6px] focus:tw-ring-brand-400"
                        />
                    </div>
                </div>
                <div class="tw-flex tw-justify-center tw-mb-4">
                    <button
                        class="tw-w-full tw-btn tw-btn-primary tw-font-bold tw-text-white"
                        <?= $is_failed ? 'disabled' : '' ?>
                        <?= $is_failed ? 'data-bs-toggle="tooltip" data-bs-title="Database connection failed. Try checking the credentials first"' : '' ?>
                    >
                        Fish In
                    </button>
                </div>
                <p class="tw-text-center tw-text-white">
                    Don&apos;t have an account?
                    <a
                        href="/fish-todo/register"
                        class="tw-text-brand-500 tw-no-underline hover:tw-underline tw-font-bold"
                        >Fish Up</a
                    >
                </p>
            </form>
        </div>

        <script src="assets/js/script.js"></script>
    </body>
</html>
