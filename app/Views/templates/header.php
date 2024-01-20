<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Spinner Game Project</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- jQuery Validation Plugin -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
</head>
<body>

    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h1>Logo</h1>
                </div>
                <div class="col-6 text-end">
                    <nav>
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="#">Home</a></li>
                            <li class="list-inline-item"><a href="#">About</a></li>
                            <li class="list-inline-item"><a href="#">Services</a></li>
                            <li class="list-inline-item"><a href="#">Contact</a></li>
                            <li class="list-inline-item">
                    
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1"><?= $_SESSION["username"] ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                       <!--  <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
 -->                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= base_url('logout'); ?>">Sign out</a></li>
                    </ul>
                
                </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php
            // Check if a flash message exists
            $successMessage = session()->getFlashdata('success_message');
            $errorMessage = session()->getFlashdata('error_message');

            if ($successMessage) {
                echo 'showToast("success", "' . $successMessage . '");';
            } elseif ($errorMessage) {
                echo 'showToast("error", "' . $errorMessage . '");';
            }
            ?>

            function showToast(type, message) {
                var toastContainer = document.getElementById('toast-container');

                var toastHTML = '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">' +
                    '<div class="toast-header bg-' + (type === "success" ? 'success' : 'danger') + '">' +
                    '<strong class="me-auto text-white">Notification</strong>' +
                    '<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>' +
                    '</div>' +
                    '<div class="toast-body">' +
                    message +
                    '</div>' +
                    '</div>';

                // Create a new toast element
                var toastElement = document.createElement('div');
                toastElement.innerHTML = toastHTML;

                // Append the toast element to the container
                toastContainer.appendChild(toastElement);

                // Create a Bootstrap Toast instance and show it
                var toast = new bootstrap.Toast(toastElement.querySelector('.toast'));
                toast.show();

                // Remove the toast element after it is closed
                toastElement.addEventListener('hidden.bs.toast', function () {
                    toastElement.remove();
                });
            }
        });
    </script>
    <div class="container-fluid">
    <div class="row flex-nowrap">

    