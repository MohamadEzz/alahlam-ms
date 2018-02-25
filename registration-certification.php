<?php

  session_start();
  $pageTitle = 'Alahlam Medical Supplis';
  include 'init.php'; 

?>   
    <!--    Start Section registration-certification    -->
    <section class="registration-certification text-center">
      <div class="container"> 
        <h1>Registration Certifications</h1>
        <div Class="row">
          <div class="col-md-6 col-sm-12">
            <h2>Registration Certificat</h2>
            <img src="layout/imgs/certification/certi (1).jpg" alt="Registration Certificat">
          </div>

          <div class="col-md-6 col-sm-12">
            <h2>Membership Certificat</h2>
            <img src="layout/imgs/certification/certi (2).jpg" alt="Membership Certificat">
          </div>

        </div>

        <div Class="row">
          <div class="col-md-6 col-sm-12">
            <h2>Establishment Certificat</h2>
            <img src="layout/imgs/certification/certi (3).jpg" alt="Establishment Certificat">
          </div>

          <div class="col-md-6 col-sm-12">
            <h2>Registration Certificat</h2>
            <img src="layout/imgs/certification/certi (5).jpg" alt="Registration Certificat">
          </div>

        </div>

      </div>
    </section>
    <!--    Start Section registration-certification     -->    
        

<?php 
  include $tpl . 'ourproviders.php';
  include $tpl . 'footer.php'; ?>