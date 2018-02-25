<?php 
session_start();
if (isset($_SESSION['Username'])) {		
	$pageTitle = 'Members';
	include 'init.php';

	$go = isset($_GET['go']) ?  $_GET['go'] : 'Manage';

	// Manage Page 
	if ($go == 'Manage'){ // Manage Page 

		$query = '';
		if (isset($_GET['page']) && $_GET['page']=='pending') {
			$query = 'AND RegStatus = 0';
		}

		$stmt = $con->prepare("SELECT * FROM users WHERE GroupID = 0 $query");
		$stmt->execute();

		$rows = $stmt->fetchAll();

		?>
		
		<h1 class="text-center">Manage Users</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-bordered">
					<tr>
						<td>ID</td>
						<td>Username</td>
						<td>Email</td>
						<td>Full Name</td>
						<td>Regestration Date</td>
						<td>Controle</td>
					</tr>
					<?php
						foreach ($rows as $row) {
							echo '<tr>';
								echo "<td>" . $row['UserID'] . "</td>";
								echo "<td>" . $row['Username'] . "</td>";
								echo "<td>" . $row['Email'] . "</td>";
								echo "<td>" . $row['FullName'] . "</td>";
								echo "<td>" . $row['Date'] . "</td>";
								echo "<td>";
									echo "<a href='?go=Edit&userid=" . $row['UserID'] . "' class='btn btn-primary'><i class='fa fa-edit'></i> Edit</a>";
									echo "<a href='?go=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger confirm'><i class='fa fa-trash'></i> Delet</a>";
									if ($row['RegStatus']==0) {
										echo "<a href='?go=Activate&userid=" . $row['UserID'] . "' class='btn btn-info'><i class='fa fa-check'></i> Activat</a>";
									}
								echo "</td>";
									
							echo '</tr>';
						}

					?>
				</table>
			</div>
			<a href="?go=Add" class="btn btn-primary"><i class='fa fa-plus'></i> Add New User</a>
		</div>
		
		<?php

	}elseif ($go == 'Add') { //Add Page ?>
		<div class="container">
			<h1 class="text-center">Add New User</h1>
			<form method="POST" action="?go=Insert" class="form-horizontal">
				
	          	<div class="form-group">
	                <label class="col-sm-3 control-label">Username</label>
	                <div class="col-sm-7">
	                    <input type="text" name="name" class="form-control" required="required" placeholder="Username" value="">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">password</label>
	                <div class="col-sm-7">
	                    <input type="password" name="pass" class="password form-control" required="required" placeholder ="Password" value="">
	                    <i class="show-pass fa fa-eye fa-lg"></i>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Email</label>
	                <div class="col-sm-7">
	                    <input type="text" name="email" class="form-control" required="required" placeholder="You'r Email">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Full Name</label>
	                <div class="col-sm-7">
	                    <input type="text" name="fullname" class="form-control" required="required" placeholder="Full Name">
	                </div>
	            </div>
	            <div class="col-ms-offset-3 form-group">
	                <div class="text-center">
	                    <input type="submit" value="Add To Database" class="btn btn-primary">
	                </div>
	            </div>
	    	</form>
	    </div>

		<?php

	}elseif ($go == 'Insert') { // Insert Page 
		echo "<div class='container'>";
		if ($_SERVER['REQUEST_METHOD']=='POST') {
				
			echo "<h1 class='text-center'>New User</h1>";
		
			//Get Items from the form
			$name 	=$_POST['name'];
			$pass 	=$_POST['pass'];
			$hashedpass = sha1($pass);
			$email =$_POST['email'];
			$full 	=$_POST['fullname'];

			// check if the user is exist in DB
			$check = checkItem("Username", "users", $name);
			if ($check==1) {
				$Msg = "<div class='alert alert-danger'>Sorry the Username Exist</div>";
				redirectHome($Msg);
			}else{

				//Insert to Database 
				$stmt = $con->prepare("INSERT INTO users(Username, Password, Email, FullName, Date)
										VALUES(:nam, :pass, :emai, :ful, now())");
				$stmt->execute(array(

					'nam' 	=> $name,
					'pass' 	=> $hashedpass,
					'emai'	=> $email,
					'ful'	=> $full

					));
				//echo success Message
				$Msg = '<div class="alert alert-success">' . $stmt->rowCount() . ' Records Inserted  ' . '<strong>' . $name . '</strong>' . ': Has been add to Database</div>';
				redirectHome($Msg);
			}
		}else{
			$Msg = "<div class='alert alert-danger'>You can\'t browse this page directly</div>";
			redirectHome($Msg);
		}
		echo "</div>";

	}elseif ($go == 'Edit') { // Edit Page

		echo "<div class='container'>";
		//Check If userid is numerical & Get the integer value of it
		$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']): 0;

		//Select All Data Debend On The id
		$stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
		$stmt->execute(array($userid));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();

		if ($stmt->rowCount() > 0) {?>
			
				<h1 class="text-center">Edit User</h1>
				<form method="POST" action="?go=Update" class="form-horizontal" role="form">

			        <input type="hidden" name="Userid" value="<?php echo $userid ?>">

		          	<div class="form-group">
		                <label for="inputName" class="col-sm-3 control-label">User Name</label>
		                <div class="col-sm-7">
		                    <input type="text" name="name" value="<?php echo $row['Username'] ?>" class="form-control" required="required">
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="inputEmail" class="col-sm-3 control-label">Password</label>
		                <div class="col-sm-7">
		                	<input type="hidden" name="oldpass" value="<?php echo $row['Password'] ?>">
		                    <input type="password" name="newpass" placeholder="New Password" class="password form-control">
		                    <i class="show-pass fa fa-eye fa-lg"></i>
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="email" class="col-sm-3 control-label">Email</label>
		                <div class="col-sm-7">
		                    <input type="text" name="email" value="<?php echo $row['Email'] ?>" class="form-control" required="required" placeholder="Email to contact You">
		                </div>
		            </div>
		            <div class="form-group">
		                <label for="offers" class="col-sm-3 control-label">Fullname</label>
		                <div class="col-sm-7">
		                    <input type="text" name="fullname" value="<?php echo $row['FullName'] ?>" class="form-control" required="required">
		                </div>
		            </div>
		            <div class="h1 form-group">
		                <div class="col-ms-offset-3 text-center">
		                    <button type="submit" class="btn btn-primary">Save To Database</button>
		                </div>
		            </div>
		    	</form>
		    	<?php
		    	$stmt = $con->prepare("SELECT comments.*, items.ItemName
								FROM comments 
								INNER JOIN
									items 	ON items.ItemID = comments.ItemID
								WHERE UserID = ?");
				$stmt->execute(array($userid));

				$rows = $stmt->fetchAll();
				if (! empty($rows)) {
				?>				

					<h1 class="text-center">Manage Comments</h1>
					<div class="table-responsive">
						<table class="main-table text-center table table-bordered">
							<tr>
								<td>Comment</td>
								<td>Item</td>
								<td>Date</td>
								<td>Controle</td>
							</tr>
							<?php
								foreach ($rows as $row) {
									echo '<tr>';
										echo "<td>" . $row['Comment'] . "</td>";
										echo "<td>" . $row['ItemName'] . "</td>";
										echo "<td>" . $row['CommDate'] . "</td>";
										echo "<td>";
											echo "<a href='?go=Edit&commid=" . $row['CommID'] . "' class='btn btn-primary'><i class='fa fa-edit'></i> Edit</a>";
											echo "<a href='?go=Delete&commid=" . $row['CommID'] . "' class='btn btn-danger confirm'><i class='fa fa-trash'></i> Delet</a>";
											if ($row['Status']==0) {
												echo "<a href='?go=Approve&commid=" . $row['CommID'] . "' class='btn btn-info'><i class='fa fa-check'></i> Approve</a>";
											}
										echo "</td>";
											
									echo '</tr>';
								}

							?>
						</table>
					</div>
	    		<?php } ?>
		<?php
		}else{
			$Msg = "<div class='alert alert-danger'>There is no such ID </div>";
			redirectHome($Msg);
		}
		echo "</div>";

	}elseif ($go == 'Update') { // Update Page 
		echo '<div class="container">';
		echo "<h1 class='text-center'>Update User</h1>";

		if ($_SERVER['REQUEST_METHOD']=='POST') {

			//Get Items from the form
			$UserID 	=$_POST['Userid'];
			$name 	=$_POST['name'];
			$email =$_POST['email'];
			$full =$_POST['fullname'];

			//Password Trick
			$pass = empty($_POST['newpass']) ? $_POST['oldpass'] : sha1($_POST['newpass']);

			// check if there is anther user with the same name 
			$stmt2 = $con->prepare("SELECT * FROM users WHERE Username = ? AND UserID != ?");
			$stmt2->execute(array($name, $UserID));
			$count = $stmt2->rowCount();
			if ($count == 1) {
				echo "<div class='alert alert-danger'>This Username Exist's in Database</div>";
			}else{

				//Update the Database 
				$stmt = $con->prepare("UPDATE users SET Username = ?, Password = ?, Email = ?, FullName = ? WHERE UserID = ?");
				$stmt->execute(array($name, $pass, $email, $full, $UserID));

				//echo success Message
				$Msg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Records Updated </div>';
				redirectHome($Msg, 'Back');
			}

		}else{
			$Msg="<div class='alert alert-danger'>" . 'You Cant Browse this page Directly</div>';
			redirectHome($Msg);
		}
		echo '</div>';

	}elseif ($go == 'Delete') { // Delet Page

		echo '<div class="container">';
		echo '<h1 class="text-center">Delete User</h1>';

			//Check If userid is numerical & Get the integer value of it
			$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']): 0;
			//Select All Data Debend On The id
			$check = checkItem("UserID", "users", $userid);

			if ($check > 0) {

				$stmt = $con->prepare("DELETE FROM users WHERE UserID = :use");
				$stmt->bindParam(":use", $userid);
				$stmt->execute();

				$Msg = "<div class='alert alert-success'>" . 'Deleted Successfuly </div>';
				redirectHome($Msg, "Back");

			}else{
				$Msg = "<div class='alert alert-danger'>" . 'This ID is not Exist </div>';
				redirectHome($Msg);
			}
		echo '</div>';
		
	}elseif ($go == 'Activate') { // Activate Page

		echo '<div class="container">';
		echo '<h1 class="text-center">Activate User</h1>';

			//Check If userid is numerical & Get the integer value of it
			$userid = isset($_GET['userid'])&& is_numeric($_GET['userid']) ? intval($_GET['userid']): 0;
			//Select All Data Debend On The id
			$check = checkItem("UserID", "users", $userid);

			if ($check > 0) {

				$stmt = $con->prepare("UPDATE users SET RegStatus=1 WHERE UserID = ?");
				$stmt->execute(array($userid));

				$Msg = "<div class='alert alert-success'>" . "Updated Successfuly </div>";
				redirectHome($Msg, "Back");

			}else{
				$Msg = "<div class='alert alert-danger'>" . 'This ID is not Exist </div>';
				redirectHome($Msg);
			}
		echo '</div>';
	}

	include $tpl . 'footer.php';
}else{ header('Location: index.php'); exit();}