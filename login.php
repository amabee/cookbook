<?php
include('includes/navbar.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
    <?php
    
    require('includes/conn.php');

    if(isset($_POST['username'])){
        
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn , $username);       

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn , $password);

        $query = "SELECT * FROM users WHERE username = '$username' OR email = '$username' AND password = '". hash('sha256', $password) ."'";

        $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
        
        $rows = mysqli_num_rows($result);

        if($rows == 1){
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            // echo "<script>alert('Welcome Back $username');</script>";
            exit();
        }else{
            echo "<script>alert('Invalid Credentials');</script>";
        }
    }else{
        ?>
             <div class="login-page bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-1">
                    <h3 class="mb3 text-white">
                        Login Now
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
                                                    placeholder="Enter Username">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa-solid fa-key"></i>
                                                </div>
                                                <input type="password" name="password" id="password"
                                                    class="form-control" placeholder="Enter Password">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <a href="#" class="float-start text-decoration-none" data-bs-toggle="modal"
                                                data-bs-target="#costumModal27">Forgot Password?</a>


                                        </div>

                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-dark px-4 float-end mt-4">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-dark text-white text-center pt-5">
                                    <img src="images/Salt-Bae-Chef-PNG-Image.png" alt="imagey" class="img img-fluid">
                                    <h2 class="fs-1">Welcome Back</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" data-easein="shake" id="costumModal27" role="dialog" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered text-center">
            <div class="modal-content">
                <div class="modal-title pt-2">
                    <img src="https://media.tenor.com/Iqb8yXDX198AAAAi/twitch-onigiri.gif" alt="onigiri" class="rounded-3 img-fluid" style="width: 100px;">
                </div>
                <div class="modal-body mt-2">
                    RELAX! Try to remember your password
                </div>
            </div>
        </div>
    </div>
 
    <?php } ?>
   

</body>

</html>