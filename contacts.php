<?php

  session_start();
  $pageTitle = 'Alahlam Medical Supplis';
  include 'init.php';
?>
<!--            Start Section Contact Us         -->
<section class="contactus">
    <div class="container">
        <div style="margin-top: 20px;" class="row">

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
              <!-- this form needs some work -->
              <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="form-center">
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
                    <button type="submit" class="form-control btn btn-primary btn-block btn-lg input-lg">Send Email</botton>
                </div>
              </form>

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
              ?>
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
          <a href="https://www.google.com/maps/place/Alahlam+Medical+Supplies/@15.5982139,32.5253476,17z/data=!3m1!4b1!4m5!3m4!1s0x168e8e1ac9a13af7:0xb9b792ce16972fa5!8m2!3d15.5982087!4d32.5275363" target="_blank">
              Sudan - Khartoum <br>
              Hwadith st. <br>
              Makah Bulding Office 7
          </a>
        </div>
      </div>
      <div class="location col-md-6">
        <h2 class="h1">Our Location</h2>
        <a href="https://www.google.com/maps/place/Alahlam+Medical+Supplies/@15.5982139,32.5253476,17z/data=!3m1!4b1!4m5!3m4!1s0x168e8e1ac9a13af7:0xb9b792ce16972fa5!8m2!3d15.5982087!4d32.5275363">
          <img src="layout/imgs/map2.jpg" alt="The Location">
        </a>
      </div>

    </div>
  </div>
</section>
<!--    Start Section About location   -->

<!--   Start Section About           -->
<section class="about text-center">
  <div class="container">
    <h1> About <span>Alahlam Inc.</span></h1>
      <p class="lead">dreams Medical Subblies company is Founded  in 2005 and its the leader in the supply and import of medical products in Sudan. We Brovide Alot of servise for our Clients so We hope you enjoy our services.</p>
  </div>
</section>
<!--    End Section About           -->

<?php include $tpl . 'ourproviders.php'; ?>
<?php include $tpl . 'footer.php'; ?>
