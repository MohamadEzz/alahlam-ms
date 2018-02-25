<?php

	session_start();
	$pageTitle = 'Cleaning Works';
	include 'init.php'; 

?>     
        <!--      Start Section cleaning work     -->
        <section class="cleaning-work text-center">
        	<div class="trans">
				<div class="container">
					<h1>Cleaning Work </h1>

					<div class="row">
					  
						<div class="col-sm-6 col-xs-12">
							<div class="price-box">
							  <img class="img-circle" src="layout/imgs/cleaning-works/clean (5).jpg" alt="person1">
							  <p class="lead center-block">Housbitals Cleaning</p>
							  <ul class="list-unstyled">
							    <li>Cleaning Works</li>
							  </ul>
							  <a href="contacts.php" class="btn btn-danger">Contact Us</a>
							</div>
						</div>

						<div class="col-sm-6 col-xs-12">
							<div class="price-box">
							  <img class="img-circle" src="layout/imgs/cleaning-works/clean (6).jpg" alt="person1">
							  <p class="lead center-block">Office Cleaning</p>
							  <ul class="list-unstyled">
							    <li>Cleaning Works</li>
							    
							  </ul>
							  <a href="contacts.php" class="btn btn-danger">Contact Us</a>
							</div>
						</div>

						<div class="col-sm-6 col-xs-12">
							<div class="price-box">
							  <img class="img-circle" src="layout/imgs/cleaning-works/clean (7).jpg" alt="person1">
							  <p class="lead center-block">Galleries Cleaning</p>
							  <ul class="list-unstyled">
							    <li>medical supply</li>
							    
							  </ul>
							  <a href="contacts.php" class="btn btn-danger">Contact Us</a>
							</div>
						</div>

						<div class="col-sm-6 col-xs-12">
							<div class="price-box">
							  <img class="img-circle" src="layout/imgs/cleaning-works/clean (8).jpg" alt="person1">
							  <p class="lead center-block">cleaning tools</p>
							  <ul class="list-unstyled">
							    <li>medical supply</li>
							    
							  </ul>
							  <a href="contacts.php" class="btn btn-danger">Contact Us</a>
							</div>
						</div>              
					</div>

				</div>
			</div>
        </section>
        <!--      End Section cleaning work      -->
        
<?php include $tpl . 'ourproviders.php'; ?>
        
<?php include $tpl . 'footer.php'; ?>