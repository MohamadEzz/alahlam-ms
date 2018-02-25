<?php 
session_start();
if (isset($_SESSION['Username'])) {		
	$pageTitle = 'Items';
	include 'init.php';

	$go = isset($_GET['go']) ?  $_GET['go'] : 'Manage';

	// Manage Page 
	if ($go == 'Manage'){ // Manage Page 

		$stmt = $con->prepare("SELECT items.*,
								categories.CatName,
								users.Username
								FROM items 
								INNER JOIN
									categories 	ON categories.CatID = items.CatID
								INNER JOIN 
									users 		ON users.UserID = items.MemberID");
		$stmt->execute();
		$items = $stmt->fetchAll();

		?>

		<h1 class="text-center">Manage Items</h1>
		<div class="container">
			<div class="table-responsive">
				<table class="main-table text-center table table-bordered">
					<tr>
						<td>ID</td>
						<td>Item Name</td>
						<td>Description</td>
						<td>Price</td>
						<td>Add Date</td>
						<td>Category</td>
						<td>Username</td>
						<td>Controle</td>
					</tr>
					<?php
						foreach ($items as $item) {
							echo '<tr>';
								echo "<td>" . $item['ItemID'] . "</td>";
								echo "<td>" . $item['ItemName'] . "</td>";
								echo "<td>" . $item['ItemDescription'] . "</td>";
								echo "<td>" . $item['Price'] . "</td>";
								echo "<td>" . $item['AddDate'] . "</td>";
								echo "<td>" . $item['CatName'] . "</td>";
								echo "<td>" . $item['Username'] . "</td>";
								echo "<td>";
									echo "<a href='?go=Edit&itemid=" . $item['ItemID'] . "' class='btn btn-primary'><i class='fa fa-edit'></i> Edit</a>";
									echo "<a href='?go=Delete&itemid=" . $item['ItemID'] . "' class='btn btn-danger confirm'><i class='fa fa-trash'></i> Delet</a>";
									if ($item['Approve']==0) {
										echo "<a href='?go=Approve&itemid=" . $item['ItemID'] . "' class='btn btn-info'><i class='fa fa-check-square-o'></i> Approve</a>";
									}
								echo "</td>";
									
							echo '</tr>';
						}
					?>
				</table>
			</div>
			<a href="?go=Add" class="btn btn-primary"><i class='fa fa-plus'></i> Add New Item</a>
		</div>
		
		<?php

	}elseif ($go == 'Add') { // Add Page 
		?>
		<div class="container">
			<h1 class="text-center">Add Item</h1>
			<form method="POST" action="?go=Insert" class="form-horizontal">

	          	<div class="form-group">
	                <label class="col-sm-3 control-label">Item Name</label>
	                <div class="col-sm-7">
	                    <input type="text" name="itemname" class="form-control" required="required" placeholder="Item Name">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Description</label>
	                <div class="col-sm-7">
	                    <input type="text" name="itemdesc" class="form-control" placeholder ="The Description for Item">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Price</label>
	                <div class="col-sm-7">
	                    <input type="text" name="price" class="form-control" placeholder="Number to Arrang Categories">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Contry</label>
	                <div class="col-sm-7">
		          		<input type="text" name="contry" class="form-control" placeholder="Made Contry for Item">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Status</label>
	                <div class="col-sm-7">
	                	<select name="status" class="form-control">
	                		<option value="0">....</option>
	                		<option value="1">New</option>
	                		<option value="2">Like New</option>
	                		<option value="3">Old</option>
	                		<option value="4">Antteq</option>
	                	</select>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Member</label>
	                <div class="col-sm-7">
	                	<select name="member" class="form-control">
	                		<option value="0">....</option>
	                		<?php 
	                		$stmtmem = $con->prepare('SELECT * FROM users');
	                		$stmtmem->execute();
	                		$users = $stmtmem->fetchAll();
	                		foreach ($users as $user) {
	                			echo "<option value='" . $user["UserID"] . "'  >" . $user["Username"] . "</option>";
	                		}

	                		?>
	                	</select>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Category</label>
	                <div class="col-sm-7">
	                	<select name="category" class="form-control">
	                		<option value="0">....</option>
	                		<?php 
	                		$stmtcat = $con->prepare('SELECT * FROM categories');
	                		$stmtcat->execute();
	                		$cats = $stmtcat->fetchAll();
	                		foreach ($cats as $cat) {
	                			echo "<option value='" . $cat["CatID"] . "'  >" . $cat["CatName"] . "</option>";
	                		}

	                		?>
	                	</select>
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
				
			echo "<h1 class='text-center'>New Item</h1>";
		
			//Get Items from the form
			$itname 	=$_POST['itemname'];
			$itdesc 	=$_POST['itemdesc'];
			$itprice 	=$_POST['price'];
			$itcontry 	=$_POST['contry'];
			$itstatus 	=$_POST['status'];
			$itmem 		=$_POST['member'];
			$itcat 		=$_POST['category'];

			//Insert to Database 
			$stmt = $con->prepare("INSERT INTO items(ItemName, ItemDescription, Price, ContryMade, Status, AddDate, MemberID, CatID)
									VALUES(:name, :descr, :price, :cont, :stat, now(), :memid, :catid)");
			$stmt->execute(array(

				'name' 	=> $itname,
				'descr'	=> $itdesc,
				'price'	=> $itprice,
				'cont'	=> $itcontry,
				'stat'	=> $itstatus,
				'memid' => $itmem,
				'catid' => $itcat

				));
			//echo success Message
			$Msg = '<div class="alert alert-success">' . $stmt->rowCount() . ' Records Inserted  ' . '<strong>' . $itname . '</strong>' . ': Has been add to Database</div>';
			redirectHome($Msg, 'Back');

		}else{
			$Msg = "<div class='alert alert-danger'>You can\'t browse this page directly</div>";
			redirectHome($Msg);
		}
		echo "</div>";

	}elseif ($go == 'Edit') { // Edit Page 

		echo "<div class='container'>";
		//Check If userid is numerical & Get the integer value of it
		$itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid']) ? intval($_GET['itemid']): 0;

		//Select All Data Debend On The id
		$stmt = $con->prepare("SELECT * FROM items WHERE ItemID = ?");
		$stmt->execute(array($itemid));
		$item = $stmt->fetch();
		$count = $stmt->rowCount();

		if ($count > 0) {?>
			
			<div class="container">
				<h1 class="text-center">Edit Item</h1>
				<form method="POST" action="?go=Update" class="form-horizontal">
					<input type="hidden" name="itemid" value="<?php echo $itemid ?>">
		          	<div class="form-group">
		                <label class="col-sm-3 control-label">Item Name</label>
		                <div class="col-sm-7">
		                    <input type="text" name="itemname" class="form-control" required="required" placeholder="Item Name" value="<?php echo $item['ItemName'];?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Description</label>
		                <div class="col-sm-7">
		                    <input type="text" name="itemdesc" class="form-control" placeholder ="The Description for Item" value="<?php echo $item['ItemDescription'];?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Price</label>
		                <div class="col-sm-7">
		                    <input type="text" name="price" class="form-control" placeholder="Number to Arrang Categories" value="<?php echo $item['Price'];?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Contry</label>
		                <div class="col-sm-7">
			          		<input type="text" name="contry" class="form-control" placeholder="Made Contry for Item" value="<?php echo $item['ContryMade'];?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Status</label>
		                <div class="col-sm-7">
		                	<select name="status" class="form-control">
		                		<option value="1" <?php if ($item['Status']== 1){ echo "selected";}?>>New</option>
		                		<option value="2" <?php if ($item['Status']== 2){ echo "selected";}?>>Like New</option>
		                		<option value="3" <?php if ($item['Status']== 3){ echo "selected";}?>>Old</option>
		                		<option value="4" <?php if ($item['Status']== 4){ echo "selected";}?>>Antteq</option>
		                	</select>
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Member</label>
		                <div class="col-sm-7">
		                	<select name="member" class="form-control">
		                		<option value="0">....</option>
		                		<?php 
		                		$stmtmem = $con->prepare('SELECT * FROM users');
		                		$stmtmem->execute();
		                		$users = $stmtmem->fetchAll();
		                		foreach ($users as $user) {
		                			echo "<option value='" . $user["UserID"] . "'";
		                				if ($item['MemberID'] == $user["UserID"]) {echo "selected";}
		                			echo ">" . $user["Username"] . "</option>";
		                		}

		                		?>
		                	</select>
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Category</label>
		                <div class="col-sm-7">
		                	<select name="category" class="form-control">
		                		<option value="0">....</option>
		                		<?php 
		                		$stmtcat = $con->prepare('SELECT * FROM categories');
		                		$stmtcat->execute();
		                		$cats = $stmtcat->fetchAll();
		                		foreach ($cats as $cat) {
		                			echo "<option value='" . $cat["CatID"] . "'";
		                				if ($item['CatID'] == $cat["CatID"]) {echo "selected";}
		                			echo ">" . $cat["CatName"] . "</option>";
		                		}

		                		?>
		                	</select>
		                </div>
		            </div>
		            <div class="col-ms-offset-3 form-group">
		                <div class="text-center">
		                    <input type="submit" value="Update" class="btn btn-primary">
		                </div>
		            </div>
		    	</form>
		    	<?php
		    	$stmt = $con->prepare("SELECT comments.*, users.Username
								FROM comments
								INNER JOIN 
									users 		ON users.UserID = comments.UserID
									WHERE ItemID = ?");
				$stmt->execute(array($itemid));

				$rows = $stmt->fetchAll();
				if (! empty($rows)) {
				?>

				<h1 class="text-center">Manage [ <?php echo $item['ItemName'];?> ] Comments</h1>
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered">
						<tr>
							<td>Comment</td>
							<td>User</td>
							<td>Date</td>
							<td>Controle</td>
						</tr>
						<?php
							foreach ($rows as $row) {
								echo '<tr>';
									echo "<td>" . $row['Comment'] . "</td>";
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
				<?php } ?>
		    </div>
	    	
		<?php
		}else{
			$Msg = "<div class='alert alert-danger'>There is no such ID </div>";
			redirectHome($Msg);
		}
		echo "</div>";

	}elseif ($go == 'Update') { //Update Page 

		echo '<div class="container">';
		echo "<h1 class='text-center'>Update Item</h1>";

		if ($_SERVER['REQUEST_METHOD']=='POST') {

			//Get Items from the form
			$itemid 	=$_POST['itemid'];
			$name 		=$_POST['itemname'];
			$desc 		=$_POST['itemdesc'];
			$price 		=$_POST['price'];
			$contry		=$_POST['contry'];
			$status		=$_POST['status'];
			$member 	=$_POST['member'];
			$cat 		=$_POST['category'];

			//Update the Database 
			$stmt = $con->prepare("UPDATE items SET ItemName = ?, ItemDescription = ?, Price = ?, ContryMade = ?, Status = ?, MemberID = ?, CatID = ? WHERE ItemID = ?");
			$stmt->execute(array($name, $desc, $price, $contry, $status, $member, $cat, $itemid));

			//echo success Message
			$Msg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Records Updated </div>';
			redirectHome($Msg, 'Back');
			
		}else{
			$Msg="<div class='alert alert-danger'>" . 'You Cant Browse this page Directly</div>';
			redirectHome($Msg);
		}
		echo '</div>';

	}elseif ($go == 'Delete') { // Delet Page

		echo '<div class="container">';
		echo '<h1 class="text-center">Delete Item</h1>';

			//Check If userid is numerical & Get the integer value of it
			$itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid']) ? intval($_GET['itemid']): 0;
			//Select All Data Debend On The id
			$check = checkItem("ItemID", "items", $itemid);

			if ($check > 0) {

				$stmt = $con->prepare("DELETE FROM items WHERE ItemID = :tem");
				$stmt->bindParam(":tem", $itemid);
				$stmt->execute();

				$Msg = "<div class='alert alert-success'>" . 'Deleted Successfuly </div>';
				redirectHome($Msg, "Back");

			}else{
				$Msg = "<div class='alert alert-danger'>" . 'This ID is not Exist </div>';
				redirectHome($Msg);
			}
		echo '</div>';

	}elseif ($go == 'Approve') { // Approve Page
		echo '<div class="container">';
		echo '<h1 class="text-center">Approve Item</h1>';

			//Check If userid is numerical & Get the integer value of it
			$itemid = isset($_GET['itemid'])&& is_numeric($_GET['itemid']) ? intval($_GET['itemid']): 0;
			//Select All Data Debend On The id
			$check = checkItem("ItemID", "items", $itemid);

			if ($check > 0) {

				$stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE ItemID = ?");
				$stmt->execute(array($itemid));

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