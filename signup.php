<?php
include('includes/navbar.php');
require('includes/conn.php');

$registrationSuccess = false;

if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);

    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT username, email FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($result);

    if ($rows > 0) {
        $registrationSuccess = false;
    } else {
        $registrationSuccess = true;
        $query_insert = "INSERT INTO `users` (username, password, email)
        VALUES ('$username', '" . hash('sha256', $password) . "', '$email')";
        $result = mysqli_query($conn, $query_insert);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- STYLESHEETS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login_style.css">
    <link rel="stylesheet" href="https://ka-f.fontawesome.com/releases/v6.4.0/css/free.min.css?token=af9f472305">
    <!-- STYLESHEETS -->
    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    <!-- SCRIPTS -->

</head>

<body>

    <div class="login-page bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-1">
                    <h3 class="mb3 text-white">
                        Sign Up Now
                    </h3>
                    <div class="bg-white shadow rounded-3">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form action="" method="POST" class="row g-4">
                                        <div class="col-12">
                                            <label for="username">Username <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa-solid fa-user"></i>
                                                </div>
                                                <input type="text" name="username" id="username" class="form-control"
                                                    placeholder="Enter Username" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </div>
                                                <input type="text" name="email" id="email" class="form-control"
                                                    placeholder="Enter Email" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa-solid fa-key"></i>
                                                </div>
                                                <input type="password" name="password" id="password"
                                                    class="form-control" placeholder="Enter Password" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" id="liveToastBtn"
                                                class="btn btn-dark px-4 float-end mt-4">Sign
                                                Up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-dark text-white text-center pt-5">
                                    <img src="images/Salt-Bae-Chef-PNG-Image.png" alt="imagey" class="img img-fluid">
                                    <h2 class="fs-1">Create an account</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST -->

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="https://media.tenor.com/Iqb8yXDX198AAAAi/twitch-onigiri.gif" class="rounded me-2" style="width: 20px;" alt="...">
                <strong class="me-auto">Alert</strong>
                <small>Just Now...</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php
                if ($registrationSuccess) {
                    echo '<div class="registration-message">Registration Successful</div>';
                } else {
                    echo '<div class="registration-message">Username or Email is already taken, try again</div>';
                }
                ?>
                ?>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    $(document).ready(function () {
        $("form").submit(function (event) {
            event.preventDefault();

            var form = $(this);
            var url = form.attr("action");
            var formData = form.serialize();

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function (response) {
                    form[0].reset();
                    var toast = new bootstrap.Toast(document.getElementById('liveToast'));
                    var message = $(response).find('.registration-message').html().trim();

                    var toastBody = toast._element.querySelector('.toast-body');
                    toastBody.innerHTML = message;

                    toast.show();
                }
            });
        });
    });

</script>

<script>
    const toastTrigger = document.getElementById('liveToastBtn')
    const toastLiveExample = document.getElementById('liveToast')
    if (toastTrigger) {
        toastTrigger.addEventListener('click', () => {
            const toast = new bootstrap.Toast(toastLiveExample)

            toast.show()
        })
    }
</script>