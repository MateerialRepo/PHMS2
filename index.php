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
	<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
    <link href="css/index.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Halant:wght@500;600&family=Montserrat&family=Nunito:ital,wght@0,400;1,300;1,400&display=swap" rel="stylesheet">
    
    <title>Pristine HMS</title>

</head>
<body>
    <div class="container-fluid parent">
        <!-- Navbar starts here -->
        <div class="row justify-content-between" id="nav-bar">
        	<div class="col-lg-12">        		
	        		<nav class="navbar sticky-top navbar-expand-md navbar-green" >
					  <a class="navbar-brand" href="#">
					  	<img src="images/pristine.png" alt="" class="img-fluid" style="width:10%;">
					  	<span>Pristine Technologies</span>
					  </a>
					  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
					    <span class="navbar-toggler-icon"></span>
					  </button>

					  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
					    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
					      <li class="nav-item">
					        <a class="nav-link" href="">Home</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="#features">Product Offering</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="#contact">Contact Us</a>
					      </li>
                          <li class="nav-item">
                            <a class="nav-link naviparent" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">Patient Portal</a>
                            <div id="submenu-1" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="patient/patientregister.php">Patient Registration</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="patient/patientlogin.php">Patient Login</a>
                                    </li>
                                </ul>
                            </div>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link naviparent" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2">Staff Portal</a>
                            <div id="submenu-2" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="staff/register.php">Staff Registration</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="staff/login.php">Staff Login</a>
                                    </li>
                                </ul>
                            </div>
                          </li>
					      <!-- <li class="nav-item">
					        <a class="nav-link" href="login.php" target="_blank">Login</a>
					      </li>
                          <li class="nav-item">
					        <a class="nav-link" href="register.php" target="_blank">Register</a>
					      </li> -->
					    </ul>
					  </div>
					</nav>				
			</div>
        </div>
        <!-- Navbar ends here -->

        <!--The banner/brief about product  -->
        <div class="row justify-content-center mt-1" id="banner">
            <div class="col-lg-5 text-lg-center align-self-center">
                <h1 class="mt-sm-2">PHMS</h1>
                <p>Pristine health management system is an easy to use web based hospital management system designed to digitize your processes and make running your clinic as smooth as butter.</p>
                <p>Equiped with State-of-the-art analytics capability, we take care of all the operational aspect of your healthcare business while you focus on what matters - taking care of your patients.</p>
            </div>

            <div class="col-lg-5">
               <img src="images/docapp.jpg" alt="Doctor on Tab" class="img-fluid">
            </div>
            
        </div>

        <!-- Section showing the features of the products -->
        <div id="features">
        <div class="row mt-2">
            <div class="col-lg text-center p-2">
                <h2>Our Unique Value Proposition</h2>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-md mt-2">
                <!-- <div class="card-deck"> -->
                  <div class="card h-100 border-0">
                    <img class="card-img-top" src="images/records.jpg" alt="Card image cap">
                    <div class="card-body">
                      <h4 class="card-title">Patient Medical History</h4>
                      <p class="card-text">This feature comes as a default with the application. The hospital management software helps you see tha Patients medical history and how to manage each patient progressively.</p>
                    </div>
                  </div>
                </div>
            <!-- </div> -->

            <div class="col-md mt-2">
                <!-- <div class="card-deck"> -->
                  <div class="card h-100 border-0">
                    <img class="card-img-top" src="images/bed.jpg" alt="Card image cap">
                    <div class="card-body">
                      <h4 class="card-title">Ward Management</h4>
                      <p class="card-text">This module helps you manage space allocation in the hospital. It is a premuim feature that comes as an added cost in the software aquisition</p>
                    </div>
                  </div>
                <!-- </div> -->
            </div>

            <div class="col-md mt-2">
                <!-- <div class="card-deck"> -->
                  <div class="card h-100 border-0">
                    <img class="card-img-top" src="images/diagnosis.jpg" alt="Card image cap">
                    <div class="card-body">
                      <h4 class="card-title">Disease analytics</h4>
                      <p class="card-text">This module helps with the analytics of the common diseases or ailments of patients that visit the clinic. It help the hospital adequately prepare to tackle these common cases especially in inventory management. It is a feature that comes with added cost</p>
                    </div>
                  </div>
                <!-- </div> -->
            </div>

            <div class="col-md mt-2">
                <!-- <div class="card-deck"> -->
                  <div class="card h-100 border-0">
                    <img class="card-img-top" src="images/lab.jpg" alt="Card image cap">
                    <div class="card-body">
                      <h4 class="card-title">Lab & Pharmacy Management</h4>
                      <p class="card-text">This module helps in managing the labortory and pharmacy activities in the clinic. Helps with the inventory management and general operation optimization. It comes with added cost to the application</p>
                    </div>
                  </div>
                <!-- </div> -->
            </div>  

        </div>
        </div>

        <!-- The footer -->
        
        <div class="row mt-2 p-3 footer">
            <div class="col-lg text-center">
                <h2 id="contact">Contact US</h2>
            </div>
        </div>

        <div class="row justify-content-between p-2 footer">
            <div class="col-lg-3 mt-2 mb-5">
                <h3>Our Address</h3>
                <p>No2, Awosika street, off Ponmile avenue, by Ragolis water factory, Coker Bus-stop, Lagos state.</p>
                <p>Telephone number: 07030280111</p>
                <p>Email: Belloolaluqman@gmail.com or info@pristinesolutions.com</p>
            </div>
            <div class="col-lg-4 mt-2 mb-5">
                <h3>Subscribe to Our Newsletter</h3>
                <form action="" method="post">
                     <div class="form-group">
                        <input type="text" name="" value="" placeholder="First Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="" value="" placeholder="Last Name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="" value="" placeholder="Email Address" class="form-control">
                    </div>
                        <button class="btn btn-dark btn-lg btn-block mb-2">Submit</button>
                </form>
            </div>
            <div class="col-lg-3 mt-2 mb-5">
                <h3>Social Media Links</h3>
                <div id="socialmedia">
                    <a href="#"><img src="images/whatsapp.png" class="socialmediaimg"></a>
                    <a href="#"><img src="images/facebook.png" class="socialmediaimg"></a>
                    <a href="#"><img src="images/linkedin.png" class="socialmediaimg"></a>
                    <a href="#"><img src="images/twitter.png" class="socialmediaimg"></a>
                    <a href="#"><img src="images/instagram.png" class="socialmediaimg"></a>
                    <a href="#"><img src="images/youtube.png" class="socialmediaimg"></a>
                </div>
            </div>

            </div>

        <div>
            <p class="mt-5 mb-3 text-muted text-center">© Luqman Bello 2020</p>
        </div>

    </div>


    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/popper.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    
</body>
</html>