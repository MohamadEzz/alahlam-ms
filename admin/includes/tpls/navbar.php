<!--        S t a r t   N a v   P a r-->
        <nav class="navbar navbar-inverse">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#the-navbar1" aria-expanded="false">
				    <span class="sr-only">Toggle navigation</span>
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
				    <span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="dashboard.php"><?php echo lang('HOME')?></a>
				</div>

				<!-- Collect the nav links, and other content for toggling -->
				<div class="collapse navbar-collapse" id="the-navbar1">
					<ul class="nav navbar-nav">
						<li><a href="categories.php"><?php echo lang('CATEGORIES')?></a></li>
						<li><a href="items.php"><?php echo lang('ITEMS')?></a></li>
						<li><a href="members.php"><?php echo lang('MEMBERS')?></a></li>
						<li><a href="comments.php"><?php echo lang('COMMENTS')?></a></li>
						<li><a href="#"><?php echo lang('STATISTICS')?></a></li>
						<li><a href="#"><?php echo lang('LOGS')?></a></li>
					</ul> 
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo "Welcome " . $_SESSION['Username']; ?><span class="caret"></span></a>
						  	<ul class="dropdown-menu">
						     <li><a href="../index.php">Home Page</a></li>
						     <li><a href="members.php?go=Edit&userid=<?php echo $_SESSION['ID'] ?>">Edit Profile</a></li>
					    	 <li><a href="#">Settings</a></li>
					    	 <li role="separator" class="divider"></li>
					    	 <li><a href="logout.php">Log Out</a></li>
					  		</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-End Div -->
        </nav>
        <!--        E n d   N a v   P a r    -->