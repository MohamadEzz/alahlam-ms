<?php

    session_start();
    $pageTitle = 'Alahlam Medical Supplis';
    include 'init.php';

?>
<!--    Start Section About location   -->
<section class="about-location">
  <div class="container">
    <div class="row text-center">

        <div class="about col-md-8 text-center">
            <h2>Meet The Owner</h2>
            <img class="img-circle" src="layout/imgs/person (1).jpg" alt="The Owner">
            <p class="lead">We Brovide Alot of servise for our Clients so We hope you enjoy our services hope you enjoy our servicesWe Brovide Alot of servise for our Clients so We hope you enjoy our services hope you enjoy our services</p>
        </div>

        <div class="m">
            <h3 class="h2">We Guarntee Quality</h3>
            <p class="lead">Quality is Our Goal in Our products So We Care About The Quality Because You Matter To Us</p>
        </div>
        <div class="m">
            <h3 class="h2">We are dealing with the Best.</h3>
            <!-- needs rewriting  -->
            <p class="lead">The company relies on the registration of products classified in one of the biggest European countries and East Asia</p>
        </div>

    </div>
  </div>
</section>
<!--    Start Section About location   -->

<!--    Start Section About           -->
<section class="about text-center">
  <div class="container">
    <h1> About <span>Alahlam </span>MS Company</h1>
      <p class="lead">The company operates in all medical specialties in respect of the provision of private goods and import of medical disposables and rehabilitation of hospitals and operation of laboratories</p>
  </div>
</section>
<!--    End Section About           -->

<?php include $tpl . 'ourproviders.php'; ?>

<?php include $tpl . 'footer.php'; ?>
