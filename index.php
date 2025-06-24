<?php

// include '../lifeinsystemadmin/database/queries/dbconnection.php';
// Testing
//i will commit this one!

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>e-Registration for Membership</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="images/signup-img.jpg" alt="">
                </div>
                <div class="signup-form">
                    <form action="../lifeinsystemadmin/database/display/lifein_addingmembers.php" method="POST" enctype = "multipart/form-data" class="register-form" id="register-form">

                    <!-- <form action="" method="POST" > -->
                        <h2>Lifein Fullness Registration - IN FixTemp</h2>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">First Name :</label>
                                <input type="text" name="firstnamef" id="name" placeholder="Your First Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="name">Middle Name :</label>
                                <input type="text" name="middlenamef" id="name" placeholder="Your Middle Name" required/>
                            </div>
                            <div class="form-group">
                                <label for="father_name">Last Name :</label>
                                <input type="text" name="lastnamef" id="father_name" placeholder="Your Last Name" required/>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">Birth Date :</label>
                                <input type="date" name="dobf" id="name" placeholder="Your current Municipal / City" required/>
                            </div>
                            <div class="form-group">
                                <label for="city">Email Address</label>
                                <input type="text" name="emailf" id="name" placeholder="example@gmail.com" required/>
                            </div>
                            <div class="form-group">
                                <label for="city">Contact No.</label>
                                <input type="text" name="contactf" id="name" placeholder="Mobile No." required/>
                            </div>
                        </div>
                        <div class="form-radio">
                            <label for="gender" class="radio-label">Gender :</label>
                            <div class="form-radio-item">
                                <input type="radio" value="Male" name="genderf" id="male" checked>
                                <label for="male">Male</label>
                                <span class="check"></span>
                            </div>
                            <div class="form-radio-item">
                                <input type="radio" value="Female" name="genderf" id="female">
                                <label for="female">Female</label>
                                <span class="check"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">House No. / Bldng No. :</label>
                            <input type="text" name="housef" id="address" placeholder="Your current House / Building" required/>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">Municipal / City :</label>
                                <input type="text" name="cityf" id="name" placeholder="Your current Municipal / City" required/>
                            </div>
                            <div class="form-group">
                                <label for="city">Province</label>
                                <input type="text" name="provincef" id="name" placeholder="Your current Province" required/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password1">Enter Password :</label>
                                <input type="text" name="password1" id="name" placeholder="*******" required/>
                            </div>
                            <div class="form-group">
                                <label for="password2">Retype Password :</label>
                                <input type="text" name="password1" id="name" placeholder="*******" required/>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="address">Package Availed :</label>
                            <input type="text" name="housef" id="address" placeholder="Your current House / Building" required/>
                        </div> -->

                        <div class="form-group">
                          <label for="exampleInputConfirmPassword1">Package Availed :</label>
                          <select name="form_package" id="cars">
                            <option value="Package A - 4,999.00">Package A - 4,999.00</option>
                            <option value="Package B - 5,999.00">Package B - 5,999.00</option>
                            <option value="Package C - 5,999.00">Package C - 5,999.00</option>
                            <option value="Package D - 4,999.00">Package D - 4,999.00</option>
                            <option value="Package (A+B+C+D) - 25,999.00">Package (A+B+C+D) - 25,999.00</option>


                          </select>
                        </div>

                        <div class = "form-group">
                            <label for = "exampleInputUsername1"><b>Profile Picture</b></label>
                            <input type = "file" name = "theprofilepic">

                        </div>

                        <div class="uplineletter">
                          <label for="">
                                <h3>UPLINE INFORMATION</h3>
                                </label>
                        </div>
                       
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">Upline First Name</label>
                                <input type="text" name="uplinefnf" id="name" placeholder="Upline Firstname" required/>
                            </div>
                            <div class="form-group">
                                <label for="city">Upline Last Name</label>
                                <input type="text" name="uplinelnf" id="name" placeholder="Upline Lastname" required/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Upline Membership ID</label>
                            <input type="text" name="membershipidf" id="birth_date">
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">Date and Time of Payment for Membership</label>
                                <input type="datetime-local" name="domf" id="name" placeholder="Your current Municipal / City" required/>
                            </div>
                            <div class="form-group">
                                <label for="city">Proof of Payments</label>
                                <input type="file" name="paymentf" required/>
                            </div>
                        </div>
                        
                        <div class="form-submit">
                            <a href="https://lifeinfullnessnaturals.com/">                            
                                <input type="button" value="Exit" class="submit" name="reset" id="reset" />
                            </a>
                            <input type="submit" value="Submit" class="submit" name="submitsubmit" id="submit" />
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>