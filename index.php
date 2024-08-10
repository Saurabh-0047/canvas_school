<?php
session_start();
$message="";
include 'config.php';

if (isset($_POST['submit'])) {
    $user_id = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);

    $check_admin = mysqli_query($con, "SELECT * FROM tb_admin WHERE user_id = '$user_id' AND password = '$password' ");
    if (mysqli_num_rows($check_admin) >= 1) {
        $row = mysqli_fetch_assoc($check_admin);
        $user_id = $row['id'];
        $datetime = $_POST['datetimeget'];
        $ip_address = $_SERVER['REMOTE_ADDR'];
       
            $_SESSION["id"] = $row['id'];
            $_SESSION["is_login"] = "Admin";
            echo "<script>window.open('dashboard.php','_self')</script>";
       
    } else {
        $message = "Invalid Username or Password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin-Login </title>
    <!-- Vendors Style-->
    <link rel="stylesheet" href="src/css/vendors_css.css">
    <!-- Style-->  
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/skin_color.css">    
    <!-- Particles.js Library -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(63,57,115,0.87718837535014) 33%, rgba(46,9,116,1) 100%);
            z-index: -1;
        }
    </style>
</head>
<body class="hold-transition theme-primary bg-img">
    <div id="particles-js"></div>
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">    
            <div class="col-12">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-5 col-md-5 col-12">
                        <div class="bg-white rounded10 shadow-lg">
                            <div class="content-top-agile p-20 pb-0">
                                <h2 class="text-primary fw-600">Let's Get Started</h2>
                                <p class="mb-0 text-fade">Sign in to continue to Admin Panel.</p>                            
                            </div>
                            <div class="p-40">
                                <div class="message" style="color: red; font-size: 15px;"><?php if($message!="") { echo $message; } ?></div>
                                <form method="post">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent"><i class="text-fade ti-user"></i></span>
                                            <input type="text" class="form-control ps-15 bg-transparent" name="email" placeholder="Username" autocomplete="off">
                                            <input type="hidden" class="form-control ps-15 bg-transparent" id="datetime" name="datetimeget" placeholder="Username" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-transparent"><i class="text-fade ti-lock"></i></span>
                                            <input type="password" class="form-control ps-15 bg-transparent" name="password" placeholder="Password" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit" name="submit" class="btn btn-primary w-p100 mt-10">SIGN IN</button>
                                        </div>
                                    </div>
                                </form>                                
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS -->
    <script src="src/js/vendors.min.js"></script>
    <script src="src/js/pages/chat-popup.js"></script>
    <script src="assets/icons/feather-icons/feather.min.js"></script>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var currentDateTime = new Date();
            var dateString = currentDateTime.toDateString();
            var timeString = currentDateTime.toTimeString().split(' ')[0];
            $('#datetime').val(dateString + ' ' + timeString);
            particlesJS.load('particles-js', 'particles-config.json', function() {
                console.log('particles.js loaded - callback');
            });
        });
    </script>
</body>
</html>
