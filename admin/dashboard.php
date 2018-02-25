<?php 
	session_start();
	if (isset($_SESSION['Username'])) {
		
		$pageTitle = 'Dashboard';
		include 'init.php';

		$limitUsers = 6;//number of Latest Users 
		$latestUsers = getLatest("*", "users", "UserID", $limitUsers);

		$limitItems = 5;//number of Latest Items 
		$latestItems = getLatest("*", "items", "ItemID", $limitItems);
		/* Start */?>

		<div class="container home-stats text-center">
			<h1>Dashbord</h1>
			<div class="row">
				<div class="col-md-3">
					<a href="members.php?go=Manage">
					<div class="stat st-members">
						<i class="fa fa-users"></i>
						<div class="info">
							Total Members
							<span>
								<?php echo countItem('UserID', 'users'); ?>
							</span>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-md-3">
					<a href="members.php?go=Manage&page=pending">
					<div class="stat st-pending">
						<i class="fa fa-user-plus"></i>
						<div class="info">
							Bending Members
							<span>
								<?php echo checkItem("RegStatus", "users", 0)?>		
							</span>
						</div>
					</div>
					</a>
				</div>
				
				<div class="col-md-3">
					<a href="items.php?go=Manage">
						<div class="stat st-items">
							<i class="fa fa-tags"></i>
							<div class="info">
								Total Items
								<span>
									<?php echo countItem('ItemID', 'items'); ?>
								</span>
							</div>
						</div>
					</a>
				</div>
				
				<div class="col-md-3">
					<div class="stat st-comments">
						<i class="fa fa-comments"></i>
						<div class="info">
							Total Comments
							<span>1526</span>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container latest">
			<div class="row">

				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-user "></i> Latest <?php echo $limitUsers; ?> Registerd Users
							<span class="toggel-info pull-right">
								<i class="fa fa-minus fa-lg"></i>
							</span>
						</div>
						<div class="panel-body">
							<ul class='list-unstyled latest-users'>
							<?php 
								foreach ($latestUsers as $user) {
									echo '<li>' . $user['Username'] . 
										'<a href="members.php?go=Edit&userid=' . $user['UserID'] . '
										">' . 
											'<span class="btn btn-success pull-right">
												<i class="fa fa-edit"></i>Edit
											</span></a>';
											if ($user['RegStatus']==0) {
												echo "<a href='members.php?go=Activate&userid=" . $user['UserID'] . "' class='btn btn-info pull-right'><i class='fa fa-check'></i> Activat</a>";
											}
										echo'</li>';
								}
							?>
							</ul>
						</div>	
					</div>
				</div>	
				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-tag "></i> Latest <?php echo $limitItems; ?> Items 
							<span class="toggel-info pull-right">
								<i class="fa fa-minus fa-lg"></i>
							</span>
						</div>
						<div class="panel-body">
							<ul class='list-unstyled latest-users'>
							<?php 
								foreach ($latestItems as $item) {
									echo '<li>' . $item['ItemName'] . 
										'<a href="items.php?go=Edit&itemid=' . $item['ItemID'] . '
										">' . 
											'<span class="btn btn-success pull-right">
												<i class="fa fa-edit"></i>Edit
											</span></a>';
											if ($item['Approve']==0) {
												echo "<a href='items.php?go=Approve&itemid=" . $item['ItemID'] . "' class='btn btn-info pull-right'><i class='fa fa-check'></i> Approve</a>";
											}
										echo'</li>';
								}
							?>
							</ul>
						</div>				
					</div>
				</div>
				
			</div>
			<div class="row">

				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-comment "></i> Latest Comments
							<span class="toggel-info pull-right">
								<i class="fa fa-minus fa-lg"></i>
							</span>
						</div>
						<div class="panel-body">
							<?php 

								$stmt = $con->prepare("SELECT comments.*, items.ItemName, users.Username
								FROM comments 
								INNER JOIN
									items 	ON items.ItemID = comments.ItemID
								INNER JOIN 
									users 		ON users.UserID = comments.UserID");
								$stmt->execute();

								$comments = $stmt->fetchAll();

								foreach ($comments as $comment) {
									echo "<div class='comment-box'>";
										echo "<span class='member-n'>". $comment['Username'] . "</span>";
										echo "<p class='member-c'>" . $comment['Comment'] . "</p>";
										/*echo "<a href='comments.php?go=Edit&commid=" . $comment['CommID'] . "' class='btn btn-success pull-right'><i class='fa fa-edit'></i> Approve</a>";
										if ($comment['Status']==0) {
											echo "<a href='comments.php?go=Approve&commid=" . $comment['CommID'] . "' class='btn btn-info pull-right'><i class='fa fa-check'></i> Approve</a>";
										}*/
										/*echo "<div class='text-center hidden-btns'>";
											echo "<a href='?go=Edit&catid=" . $comment['CommID'] . "' class='btn'><i class='fa fa-edit'></i> Edit </a>";
											echo "<a href='?go=Delete&catid=" . $comment['CommID'] . "' class='btn'><i class='fa fa-trash'></i> Delete </a>";
										echo "</div>";*/
									echo "</div>";
								}
							?>
						</div>	
					</div>
				</div>	
			</div>
		</div>


		
		<?php /* End */
		
		include $tpl . 'footer.php';
	}else{
		header('Location: index.php');
		exit();
	}