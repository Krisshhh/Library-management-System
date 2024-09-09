<?php
session_start();

if(isset($_POST['login'])){
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $query = "select * from admins where email = '$_POST[email]'";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        if($row['email'] == $_POST['email']){
            if($row['password'] == $_POST['password']){
                $_SESSION['name'] =  $row['name'];
                $_SESSION['email'] =  $row['email'];
                header("Location: admin_dashboard.php");
                exit; // It's good practice to exit after sending a header redirect
            }
            else{
                $error_message = "Wrong Password !!";
            }
        }
    }
}
?>
<!DOCTYPE html>


<html>
<head>
    <title>LMS | Login</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="./bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="./bootstrap-4.4.1/js/bootstrap.min.js"></script></head>
    <style type="text/css">
        body {
        /* background-color: #36454F; 
        background-image: url('https://imgmedia.lbb.in/media/2018/01/5a64cb63f2377c0ef4861e97_57c4ac72474f25a725467b06_1516555107569.jpg'); 
        background-size: cover; 
        background-position: center; 
        position: relative; 
        overflow: hidden; */
        font-family: "Andale Mono", monospace;
    }
    #video-bg {
        position: fixed;
        /* background-size:cover;
        background-position: center;
        position: relative; */
        top: 0;
        left: 0;
        min-width: 100vw;
        min-height: 100vh;
        z-index: -1;
    }


    /* .background-image {
        content: "";
            position: absolute;
            
            background-size: cover;
            background-position: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            filter: blur(10px);
            z-index: -1;
        } */
        .container-flex {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* margin-top: 30px; */
            /* flex-wrap: nowrap; Prevent items from wrapping */
        }
		.row{
			display: flex;
			justify-content: center;
            align-items: flex-start;
			margin-top: -20px;	
			flex-wrap: nowrap;
		}

        #main_content {
            padding: 50px;
            background: rgba(0,0,0,0.9);
            color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 2);
            height: 500px; /* Changed height */
            width: 750px; /* Changed width */
            margin-right: 20px;
            margin-left: 10px; /* Added margin-right for spacing between sidebar and user login form */
        }

        #side_bar {
            background: rgba(0,0,0,0.9);
            padding: 50px;
            color: white;
            border-radius: 10px;
            box-shadow:  0px 0px 15px 0px rgba(0, 0, 0, 2);

            height: 500px; /* Changed height */
            width: 580px; /* Changed width */
            margin-right: 20px;
        }

        #main_content h3 {
            text-decoration: none; /* Remove underline */
        }

        .navbar-nav .nav-link {
        font-weight: bold; /* Make font bold */
        font-size: 18px; /* Increase font size */
    }


    .navbar {
            background: rgba(0,0,0,0.6);
            /* filter: blur(4px); */
            /* -o-filter: blur(4px); */
            /* -ms-filter: blur(4px); */
            /* -moz-filter: blur(4px); */
            /* -webkit-filter: blur(4px); */
        }

    </style>

<body>

<video autoplay muted loop id="video-bg">
        <source src="video/lib.mp4" type="video/mp4">
        <!-- Add additional sources if needed -->
        Your browser does not support HTML5 video.
    </video>
<nav class="navbar navbar-expand-lg navbar-dark "style="font-weight: bold; font: size 30px;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">LIBRARY MANAGEMENT SYSTEM</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="index.php">AdminLogin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../signup.php" >Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../index.php" >Login</a>
            </li>
        </ul>
    </div>
</nav><br>
<span style="display: block; color: white; padding: 10px; font-weight: bold; font-size: 20 px; text-shadow: 2px 2px 4px rgba(0,0,0,0.9);">
    <marquee>This is library management system. Library opens at 8:00 AM and closes at 8:00 PM</marquee>
</span><br><br>
<div class="container-flex">
    <div class="row">
        <div class="col-md-4" id="side_bar">
            <h5>Library Timing</h5>
            <ul>
                <li>Opening: 8:00 AM</li>
                <li>Closing: 8:00 PM</li>
                <li>(Sunday Off)</li>
            </ul>
            <h5>What We provide ?</h5>
            <ul>
                <li>Full furniture</li>
                <li>Free Wi-fi</li>
                <li>News Papers</li>
                <li>Discussion Room</li>
                <li>RO Water</li>
                <li>Peacefull Environment</li>
            </ul>
        </div>
        <div class="col-md-8" id="main_content">
            <center><h3>Admin Login Form</h3></center>
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email ID:</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </form>
            <?php
            if(isset($_POST['login'])){
                $connection = mysqli_connect("localhost","root","");
                $db = mysqli_select_db($connection,"lms");
                $query = "select * from admins where email = '$_POST[email]'";
                $query_run = mysqli_query($connection,$query);
                while ($row = mysqli_fetch_assoc($query_run)) {
                    if($row['email'] == $_POST['email']){
                        if($row['password'] == $_POST['password']){
                            $_SESSION['name'] =  $row['name'];
                            $_SESSION['email'] =  $row['email'];
                            header("Location: admin_dashboard.php");
                        }
                        else{
                            ?>
                            <br><br><center><span class="alert-danger">Wrong Password !!</span></center>
                            <?php
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
