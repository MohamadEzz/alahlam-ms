<!DOCTYPE html>
<html>
	<head>
       
        <!--        meta data icluding-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!--        this is the title-->
        <title><?php getTitle() ?></title>

        <!--        icluding css styles -->
		<link rel="stylesheet" href="<?php echo $css;?>bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo $css;?>font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo $css;?>frontend.css">

        <!--
                [if lt IE 9]>
              <script src="js/html5shiv.js"></script>
              <script src="js/respond.src.js"></script>
                <![endif]
        -->
		
	</head>
	<body>
		<!--        S t a r t   N a v   P a r-->
        <nav id="nav" class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#the-navbar1" aria-expanded="false">
				    <span class="sr-only">Toggle navigation</span>
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="index.php"><img class="img-circle pull-left logo1" src="layout/imgs/3 - Copy.jpg" alt="logo"/> Alahlam <span>MS</span></a>
				</div>

				<!-- Collect the nav links, and other content for toggling -->
				<div class="collapse navbar-collapse" id="the-navbar1">
				  <ul class="nav navbar-nav navbar-right">
				    <li class="active"><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
				    <li class="dropdown">
				      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catagoris <span class="caret"></span></a>
				      <ul class="dropdown-menu">
				        <li><a href="lap-skill-trainer.php">Lap Skill Trainer</a></li>
				        <li><a href="genral-sergery-devices.php">General Sergery & Devices</a></li>
				        <li role="separator" class="divider"></li>
				        <li><a href="cleaning-work.php">Cleaning Work</a></li>
				        <li><a href="consumable-medical-subblies.php">Consiomable Medical Supplis</a></li>
				      </ul>
				    </li>
				    <li><a href="contacts.php">Contact Us </a></li>
					<li class="dropdown">
				      <a href="about.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About Us <span class="caret"></span></a>
				      <ul class="dropdown-menu">
				        <li><a href="costomer-testemonials.php">Costomer Testemonials</a></li>
				        <li><a href="registration-certification.php">Registration Certification</a></li>
				        <li role="separator" class="divider"></li>
				        <li><a href="about.php">About ...</a></li>
				      </ul>
				    </li>
				    <li><a href="index-ar.php" class="aren">AR</a></li>
				  </ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-End Div -->
        </nav>
        <!--        E n d   N a v   P a r    -->