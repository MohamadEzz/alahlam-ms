<?php 
	session_start();
	$noNavbar = '';
	$pageTitle = 'Login';
	if (isset($_SESSION['Username'])) {
		header('Location: dashboard.php'); //Redirect To Dashboard
	}
	include 'init.php';

	//Check if User Coming from HTTP POST Requst 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$username = $_POST['user'];
		$password = $_POST['pass'];
		$hashedPass = sha1($password);

		//Check if User Exists in DB
		$stmt = $con->prepare("SELECT UserID, Username, Password FROM users WHERE Username = ? AND Password = ? AND GroupID = 1 LIMIT 1");
		$stmt->execute(array($username, $hashedPass));
		$row = $stmt->fetch();
		$count = $stmt->rowcount();

		//If Count > 0 Means thers Record About the user
		if ($count > 0) {
			$_SESSION['Username'] = $username; //Regester Session Name
			$_SESSION['ID'] = $row['UserID']; //Regester Session ID
			header('Location: dashboard.php'); //Redirect To Dashboard
			exit();
		}
	}
	?>

	

	<form class="login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
		<h4>Admin Login</h4>
		<div class="form-group form-group-lg">
			<input type="text" class="form-control" name="user" placeholder="Username" autocomplete="off"> <i class='fa fa-user'></i> 
		</div>
		<div class="form-group form-group-lg">
			<input type="password" class="form-control" name="pass" placeholder="Password" autocomplete="new-password"><i class='fa fa-lock'></i> 
		</div>
		<input type="submit" class="btn btn-primary btn-block btn-lg" value="login">
	</form>

<?php include $tpl . 'footer.php'; ?>