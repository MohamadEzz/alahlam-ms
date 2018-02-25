<?php

  // Creat Variables

  	$emailsubject = 'Medical Supplies';
  	$emailaddress = 'mohamadezoo@gmail.com';

  // Gethering Data 

  	$emailField = $_POST['email'];
  	$phoneField = $_POST['phone'];
  	$nameField = $_POST['name'];
  	$textField = $_POST['text'];

  	$body = <<<EOD
  <br><hr><br>
  Sender Email : $emailField <br>
  Phone : $phoneField <br>
  Name : $nameField <br>
  The Text : $textField <br>
  EOD;

  	$headers = "Form: $emailField\r\n";
  	$headers .="Content-type: text/html\r\n";

  	$success =  mail($emailaddress, $emailsubject, $body, $headers);

  	$theResults = <<<EOD
  <!DOCTYPE html>
  <html lang="en">
      <head>
          <meta Charset="UTF-8">

          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          
          <!--        this is the title-->
          <title>Contact Us</title>
          <!--        icluding css styles -->
          <link rel="stylesheet" href= "css/bootstrap.css">
          <link rel="stylesheet" href= "css/mystyle.css">
          <link rel="stylesheet" href= "css/">
          <!--        meta data icluding-->
          
          <!--
                  [if lt IE 9]>
                <script src="js/html5shiv.js"></script>
                <script src="js/respond.src.js"></script>
                  <![endif]
          -->
      </head>
      <!--here our code goes-->
      <body>
        <!--        S t a r t   N a v   P a r-->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#the-navbar1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.html"><img class="img-circle pull-left logo1" src="img/3 - Copy.jpg" alt="logo"/>Alahlam <span>MS</span></a>
                </div>

                <!-- Collect the nav links, and other content for toggling -->
                <div class="collapse navbar-collapse" id="the-navbar1">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.html">Home <span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catagoris <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="lap-skill-trainer.html">Lap Skill Trainer</a></li>
                        <li><a href="genral-sergery-devices.html">General Sergery & Devices</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="cleaning-work.html">Cleaning Work</a></li>
                        <li><a href="consumable-medical-subblies.html">Consiomable Medical Supplis</a></li>
                      </ul>
                    </li>
                    <li class="active"><a href="contacts.html">Contact Us </a></li>
                    <li class="dropdown">
                      <a href="about.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="costomer-testemonials.html">Costomer Testemonials</a></li>
                        <li><a href="registration-certification.html">Registration Certification</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="about.html">About ...</a></li>
                      </ul>
                    </li>
                    <li><a href="#" class="aren">AR</a></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-End Div -->
        </nav>
        <!--        E n d   N a v   P a r    -->
        
        <!--            Start Section Contact Us         -->
        <section class="contactus">
            <div class="container">
                <div class="row">

                    <div class="cont col-md-6">
                      <h1>Contact Us </h1>
                      <ul class="list-unstyled">
                          <li class="lead">Call Us : +249 912 352 982 </li>
                          <li class="lead">Email : hamidm124@gmail.com </li>
                          <li class="lead">Website : alahlam-ms.com </li>
                      </ul>
                    </div>
                    <div class="email-us col-md-6">
                        <h2>Email Us</h2>
                        <form action="email-us.php" method="POST" class="form-center">
                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" name="email" placeholder="You'r Email Here">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" name="phone" placeholder="you'r Phone Number">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-lg" name="name" placeholder="You'r Name">
                                </div>
                           
                                <div class="form-group">
                                    <textarea class="form-control input-lg" name="text" placeholder="your Text Go Here"></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="h3 form-control btn btn-primary btn-block input-lg">Send Email</botton>
                                </div>
                                <h3> Your Mail has been Sended </h3>
                        </form>
                    </div>
                </div>  <!-- Row Closer  -->
            </div>     <!--container Close  -->
        </section>
        <!--            End Section Contact Us    -->

        <!--    Start Section About location   -->
        <section class="about-location">
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <h3>Address</h3>
                <div class="lead confit-address">
                  <a href="https://www.google.com/maps/place/Alahlam+Medical+Supplies/@15.5980584,32.5275481,20z/data=!4m5!3m4!1s0x0:0xb9b792ce16972fa5!8m2!3d15.598209!4d32.527536?hl=en" target="_blank">
                      Sudan - Khartoum <br>
                      Hwadith st. <br>
                      Makah Bulding Office 7
                  </a>
                </div>
              </div>
              <div class="location col-md-6">
                <h2 class="h1">Our Location</h2>
                <a href="https://www.google.com/maps/place/Alahlam+Medical+Supplies/@15.5980584,32.5275481,20z/data=!4m5!3m4!1s0x0:0xb9b792ce16972fa5!8m2!3d15.598209!4d32.527536?hl=en" target="_blank"><img src="img/Capture.bmp" alt="The Location"></a> 
              </div>

            </div>
          </div>
        </section>
        <!--    Start Section About location   -->    

        <!--   Start Section About           -->
        <section class="about text-center">
          <div class="container">
            <h1> About <span>Alahlam Inc.</span> Say What you What about your Company</h1>
              <p class="lead"> We Brovide Alot of servise for our Clients so We hope you enjoy our services hope you enjoy our services</p>
          </div>
        </section>
        <!--    End Section About           -->
        
        <!--      Start Section Our Team       -->
        <section class="our-team text-center">
          <div class="team">
            <div class="container">
              <h1>Our Providers</h1>

              <div class"row">
                <div class="col-lg-1">
                    
                </div>

                <div class="col-lg-2 col-sm-6">
                  <div class="person">
                    <img class="img-circle" src="img/biolight-logo.png" alt="person1" />
                    <h3>BIOLIGHT</h3>
                    <p>some text no importent content</p>
                    <i class="fa fa-google-plus fa-lg"></i>
                    <i class="fa fa-facebook fa-lg"></i>
                    <i class="fa fa-twitter fa-lg"></i>
                    <i class="fa fa-youtube fa-lg"></i>
                  </div>
                </div>

                <div class="col-lg-2 col-sm-6">
                  <div class="person">
                    <img class="img-circle" src="img/3A-health-care.jpg" alt="person1" />
                    <h3>3A Italy</h3>
                    <p>some text no importent content</p>
                    <i class="fa fa-google-plus fa-lg"></i>
                    <i class="fa fa-facebook fa-lg"></i>
                    <i class="fa fa-twitter fa-lg"></i>
                    <i class="fa fa-youtube fa-lg"></i>
                  </div>
                </div>

                <div class="col-lg-2 col-sm-6">
                  <div class="person">
                    <img class="img-circle" src="img/medik-logo.jpg" alt="person1" />
                    <h3>Medik</h3>
                    <p>some text no importent content</p>
                    <i class="fa fa-google-plus fa-lg"></i>
                    <i class="fa fa-facebook fa-lg"></i>
                    <i class="fa fa-twitter fa-lg"></i>
                    <i class="fa fa-youtube fa-lg"></i>
                  </div>
                </div>

                <div class="col-lg-2 col-sm-6">
                  <div class="person">
                    <img class="img-circle" src="img/Schiller-Logo.jpg" alt="person1" />
                    <h3>schiller</h3>
                    <p>some text no importent content</p>
                    <i class="fa fa-google-plus fa-lg"></i>
                    <i class="fa fa-facebook fa-lg"></i>
                    <i class="fa fa-twitter fa-lg"></i>
                    <i class="fa fa-youtube fa-lg"></i>
                  </div>
                </div>

                <div class="col-lg-2 col-sm-6">
                  <div class="person">
                    <img class="img-circle" src="img/medical-simulations-logo.png" alt="person1" />
                    <h3 class="text-center">MEDICALSIMULATIONS</h3>
                    <p>some text no importent content</p>
                    <i class="fa fa-google-plus fa-lg"></i>
                    <i class="fa fa-facebook fa-lg"></i>
                    <i class="fa fa-twitter fa-lg"></i>
                    <i class="fa fa-youtube fa-lg"></i>
                  </div>
                </div>

                <div class="col-lg-1">
                    
                </div>

              </div>
            </div>
          </div>
        </section>
        <!--      End Section Our Team       -->

        <!--      Start Footer              -->
        <section class="footer">
          <div class="container">
            <div class="row">
              
            
              <!-- sitemap -->
            <div class="col-md-4">
              <img class="img-circle" src="img/fotter.png" alt="big logo"/>
            </div>

             <div class="col-md-4">
              <h3>SiteMap</h3>
                  <ul class="list-unstyled three-col ">
                      <li><a href="index.html">Home</a></li>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catagoris <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="lap-skill-trainer.html">Lap Skill Trainer</a></li>
                      <li><a href="genral-sergery-devices.html">General Sergery & Devices</a></li>
                      <li><a href="cleaning-work.html">Cleaning Work</a></li>
                      <li><a href="consumable-medical-subblies.html">Consiomable Medical Supplis</a></li>
                    </ul>
                  </li>
                      <li><a href="contacts.html">contact Us</a></li>
                <li class="dropdown">
                    <a href="about.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="costomer-testemonials.html">Costomer Testemonials</a></li>
                      <li><a href="registration-certification.html">Registration Certification</a></li>
                      <li><a href="about.html">About ...</a></li>
                    </ul>
                  </li>
                  </ul>
                    
                </div>

                <div class="col-md-4">
                    <h3>Follwo Us in Social Media</h3>
                    <ul class="list-unstyled social-list">
                      <li><a href="facebook.com">Like us in facebook<img class="pull-left" src="img/social/facebook.png" alt="facebook" /></a></li>
                      <li><a href="twitter.com">Follow Us in twitter<img class="pull-left" src="img/social/twitter.png" alt="twitter" /></a></li>
                      <li><a href="google-plus.com">Follow Us in Google Plus <img class="pull-left" src="img/social/google-plus.png" alt="google-plus" /></a></li>
                    </ul>
                </div>
              
            </div>
            <p class="lead text-center">© Alahlam 2017. All rights reserved.</p>
          </div>
        </section>
        <!--      End Footer              -->

        <!--    here is java script code or call for java code-->
        <script src='js/jquery-3.1.1.js'></script>
        <script src='js/bootstrap.js'></script>
        <!--    <script src='js/npm.js'></script>-->    
      </body>
  </html>
  EOD;

  	echo "$theResults"

?>