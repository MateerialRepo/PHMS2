<?php
    session_start();

    //to check if the patient is Logged in and can have access to the portal
    if (!isset($_SESSION['patientid'])) {
        # if the patientid is not set, meaning the attempt is not a logged in user.
        //redirect to the login page
        header("Location: patientlogin.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <link href="../css/bootstrap.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Halant:wght@500;600&family=Montserrat&family=Nunito:ital,wght@0,400;1,300;1,400&display=swap" rel="stylesheet">
    <link href="../css/dashboard.css" type="text/css" rel="stylesheet">
    
    <title>Dashboard - Username</title>

</head>

<body>
    <div class="wrapper">

        <div class="container-fluid">

            <div class="row">
                <!-- ============================================================== -->
                <!-- The sidebar section -->
                <div class="col-md-3" id="sidebarpanel">
                    <aside class="sidebar h-100">
                        <!-- ============================================================== -->
                        <!-- This holds the logo -->
                        <div class="text-sm-center p-md-3 shadow-sm mb-2">
                            <img src="../images/pristine.png" alt="" class="img-fluid" style="width:30%;">
                        </div> 

                        <!-- ============================================================== -->
                        <!-- this row holds the image and name of the user -->
                                <div class="text-sm-center p-md-3 shadow-sm mb-4">
                                    <img src="../images/user.png" alt="User email" class="img-fluid rounded-circle"><br><br>
                                    <p> <?php echo $_SESSION['patientlname']." ".$_SESSION['patientfname'];  ?></p>
                                </div>                    

                        <!-- ============================================================== -->
                        <!-- This div holds the navigation in the userarea -->
                        <nav class="navbar navbar-expand-lg navbar-light" id="sidebarnav">
                            
                                <a class="d-xl-none d-lg-none" href="#">Dashboard Menu</a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav flex-column">
                                        <li class="nav-divider d-sm-none">
                                            Dashboard Menu
                                        </li>

                                        <li class="nav-item ">
                                            <a class="nav-link" href="patientdashboard.php" style="font-size: 2rem;">Home</a>
                                        </li>


                                        <li class="nav-item">
                                            <a class="nav-link naviparent" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">Appointments</a>
                                            <div id="submenu-1" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="bookappointment.php">Book appointments</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="patientappointments.php">View appointments</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        
                                        <li class="nav-item">
                                            <a class="nav-link naviparent" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-settings" aria-controls="submenu-settings">Settings </a>
                                            <div id="submenu-settings" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="">Edit Profile</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" href="">Change Picture</a>
                                                    </li>
                                                    
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="">Change Password</a>
                                                    </li>                                        
                                                </ul>
                                            </div>
                                        </li>
                                        
                                        <li class="nav-item ">
                                            <a class="nav-link naviparent" href="logout.php">Logout</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            
                        </nav>
                    </aside>
                </div>

                
                <div class="col-md-9 p-2 ">
                    <!-- ============================================================== -->
                    <!-- THe main dashboard section -->
                     <section class="p-2 h-100">
                        <div class="container-fluid mainsection">
                                <!-- ============================================================== -->
                                <!-- MAin section header  -->
                                <div class="row p-3 mb-4">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="page-header">
                                            <h2 class="">PHMS Dashboard </h2>
                                            <p class="">Staff Portal</p>
                                             <!--<div class="">
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page">E-Commerce Dashboard Template</li>
                                                    </ol>
                                                </nav>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>