<?php 
session_start();
if (isset($_SESSION['Username'])) {		
	$pageTitle = 'Comments';
	include 'init.php';

	$go = isset($_GET['go']) ?  $_GET['go'] : 'Manage';

	// Manage Page 
	if ($go == 'Manage'){ // Manage Page 

		$stmt = $con->prepare("SELECT comments.*, items.ItemName, users.Username
								FROM comments 
								INNER JOIN
									items 	ON items.ItemID = comments.ItemID
								INNER JOIN 
									users 		ON users.UserID = comments.UserID");
		$stmt->execute();

		$rows = $stmt->fetchAll();

		?>

		<h1 class="text-center">Manage Comments</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-bordered">
					<tr>
						<td>ID</td>
						<td>Comment</td>
						<td>Item</td>
						<td>User</td>
						<td>Date</td>
						<td>Controle</td>
					</tr>
					<?php
						foreach ($rows as $row) {
							echo '<tr>';
								echo "<td>" . $row['CommID'] . "</td>";
								echo "<td>" . $row['Comment'] . "</td>";
								echo "<td>" . $row['ItemName'] . "</td>";
								echo "<td>" . $row['Username'] . "</td>";
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
		</div>
		
		<?php

	}elseif ($go == 'Edit') { // Edit Page

		echo "<div class='container'>";
		//Check If userid is numerical & Get the integer value of it
		$commid = isset($_GET['commid'])&& is_numeric($_GET['commid']) ? intval($_GET['commid']): 0;

		//Select All Data Debend On The id
		$stmt = $con->prepare("SELECT * FROM comments WHERE CommID = ? LIMIT 1");
		$stmt->execute(array($commid));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();

		if ($stmt->rowCount() > 0) {?>
			
				<h1 class="text-center">Edit Comment</h1>
				<form method="POST" action="?go=Update" class="form-horizontal" role="form">

			        <input type="hidden" name="commid" value="<?php echo $commid ?>">

		          	<div class="form-group">
		                <label for="inputName" class="col-sm-3 control-label">Comment</label>
		                <div class="col-sm-7">
		                    <input type="text" name="comment" value="<?php echo $row['Comment'] ?>" class="form-control" required="required">
		                </div>
		            </div>
		            <div class="h1 form-group">
		                <div class="col-ms-offset-3 text-center">
		                    <button type="submit" class="btn btn-primary">Update Comment</button>
		                </div>
		            </div>
		    	</form>
	    	
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
			$CommID 	=$_POST['commid'];
			$Comment 	=$_POST['comment'];

			//Update the Database 
			$stmt = $con->prepare("UPDATE comments SET Comment = ? WHERE CommID = ?");
			$stmt->execute(array($Comment, $CommID));

			//echo success Message
			$Msg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Comment Updated </div>';
			redirectHome($Msg, 'Back');
			
		}else{
			$Msg="<div class='alert alert-danger'>" . 'You Cant Browse this page Directly</div>';
			redirectHome($Msg);
		}
		echo '</div>';

	}elseif ($go == 'Delete') { // Delet Page

		echo '<div class="container">';
		echo '<h1 class="text-center">Delete Comment</h1>';

			//Check If userid is numerical & Get the integer value of it
			$commid = isset($_GET['commid'])&& is_numeric($_GET['commid']) ? intval($_GET['commid']): 0;
			//Select All Data Debend On The id
			$check = checkItem("CommID", "comments", $commid);

			if ($check > 0) {

				$stmt = $con->prepare("DELETE FROM comments WHERE CommID = :omm");
				$stmt->bindParam("omm", $commid);
				$stmt->execute();

				$Msg = "<div class='alert alert-success'>" . 'Deleted Successfuly </div>';
				redirectHome($Msg, "Back");

			}else{
				$Msg = "<div class='alert alert-danger'>" . 'This ID is not Exist </div>';
				redirectHome($Msg);
			}
		echo '</div>';
		
	}elseif ($go == 'Approve') { // Activate Page

		echo '<div class="container">';
		echo '<h1 class="text-center">Approve Comment</h1>';

			//Check If userid is numerical & Get the integer value of it
			$commid = isset($_GET['commid'])&& is_numeric($_GET['commid']) ? intval($_GET['commid']): 0;
			//Select All Data Debend On The id
			$check = checkItem("CommID", "comments", $commid);

			if ($check > 0) {

				$stmt = $con->prepare("UPDATE comments SET Status=1 WHERE CommID = ?");
				$stmt->execute(array($commid));

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