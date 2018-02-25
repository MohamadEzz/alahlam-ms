<?php 
session_start();
if (isset($_SESSION['Username'])) {		
	$pageTitle = 'Categories';
	include 'init.php';

	$go = isset($_GET['go']) ?  $_GET['go'] : 'Manage';

	// Manage Page 
	if ($go == 'Manage'){ // Manage Page 

		$sort = 'ASC';

		$sort_arry = array('ASC', 'DESC');
		if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_arry)) {
			$sort = $_GET['sort'];
		}

		$stmt= $con->prepare("SELECT * FROM categories ORDER BY Ordering $sort");
		$stmt->execute();

		$cats = $stmt->fetchAll();
		?>
		<h1 class="text-center">Manege Categories</h1>
		<div class="container categories">
			<div class="panel panel-default">
				<div class="panel-heading">
					Maneg Page
					<div class="ordering pull-right">
						Order By: 
						<a href="?sort=ASC" class="<?php if ($_GET['sort']=='ASC') {echo "active"; }?>">Asc </a>|
						<a href="?sort=DESC" class="<?php if ($_GET['sort']=='DESC') {echo "active"; }?>"> Desc</a>
					</div>
				</div>
				<div class="panel-body">
					<?
						foreach ($cats as $cat) {
							echo "<div class='cat'>";
								echo "<div class='hidden-btns'>";
									echo "<a href='?go=Edit&catid=" . $cat['CatID'] . "' class='btn'><i class='fa fa-edit'></i> Edit </a>";
									echo "<a href='?go=Delete&catid=" . $cat['CatID'] . "' class='btn'><i class='fa fa-trash'></i> Delete </a>";
								echo "</div>";
								echo '<h3>' . $cat['CatName'] . "</h3>";
								echo "<p>"; if ($cat['CatDescription']== '') { echo "No Description"; }else {echo $cat['CatDescription'];} echo "</p>";
								if ($cat['Visibility']==0) {
								 	echo '<span class="visibility">Hidden</span>' . ' ';
								 }
								if ($cat['Allow_Comments']==0) {
								 	echo '<span class="comments">Comments Disabled</span>';
								 }
								if ($cat['Allow_Ads']==0) {
								 	echo '<span class="advertises">Ads Disables</span>';
								 }
							echo "</div>";
							echo "<hr>";
						}

					?>	
				</div>
			</div>
			<a class="btn btn-primary" href="?go=Add"><i class="fa fa-plus"></i> Add Category</a>
		</div>

		<?php

	}elseif ($go == 'Add') { // Add Page ?>
		<div class="container">
			<h1 class="text-center">Add Category</h1>
			<form method="POST" action="?go=Insert" class="form-horizontal">

	          	<div class="form-group">
	                <label class="col-sm-3 control-label">Cat Name</label>
	                <div class="col-sm-7">
	                    <input type="text" name="catname" class="form-control" required="required" placeholder="Category Name" value="">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Description</label>
	                <div class="col-sm-7">
	                    <input type="text" name="catdesc" class="form-control" placeholder ="The Description for Category" value="">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Ordering</label>
	                <div class="col-sm-7">
	                    <input type="text" name="ordering" class="form-control" placeholder="Number to Arrang Categories">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Visible</label>
	                <div class="col-sm-7">
	                    <input id="vis-yes" type="radio" name="visibility" value="1" checked>
	                    <label for="vis-yes">Yes</label>
	                    <input id="vis-no" type="radio" name="visibility" value="0">
	                    <label for="vis-no">No</label>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Allo Comments</label>
	                <div class="col-sm-7">
	                    <input id="com-yes" type="radio" name="comments" value="1" checked>
	                    <label for="com-yes">Yes</label>
	                    <input id="com-no" type="radio" name="comments" value="0">
	                    <label for="com-no">No</label>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-3 control-label">Allow Ads</label>
	                <div class="col-sm-7">
	                    <input id="ads-yes" type="radio" name="ads" value="1" checked>
	                    <label for="ads-yes">Yes</label>
	                    <input id="ads-no" type="radio" name="ads" value="0">
	                    <label for="ads-no">No</label>
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
				
			echo "<h1 class='text-center'>New Category</h1>";
		
			//Get Items from the form
			$name 	=$_POST['catname'];
			$desc 	=$_POST['catdesc'];
			$order 	=$_POST['ordering'];
			$vis 	=$_POST['visibility'];
			$com 	=$_POST['comments'];
			$ads 	=$_POST['ads'];

			// check if the Cat is exist in DB
			$check = checkItem("CatName", "categories", $name);
			if ($check==1) {
				$Msg = "<div class='alert alert-danger'>Sorry this Category Exists</div>";
				redirectHome($Msg);
			}else{

				//Insert to Database 
				$stmt = $con->prepare("INSERT INTO categories(CatName, CatDescription, Ordering, Visibility, Allow_Comments, Allow_Ads)
										VALUES(:name, :descr, :orderi, :visi, :comen, :advs)");
				$stmt->execute(array(

					'name' 		=> $name,
					'descr' 	=> $desc,
					'orderi'	=> $order,
					'visi'		=> $vis,
					'comen'		=> $com,
					'advs'		=> $ads

					));
				//echo success Message
				$Msg = '<div class="alert alert-success">' . $stmt->rowCount() . ' Records Inserted  ' . $name . ': Has been add to Database</div>';
				redirectHome($Msg, 'Back');
			}
		}else{
			$Msg = "<div class='alert alert-danger'>You can\'t browse this page directly</div>";
			redirectHome($Msg);
		}
		echo "</div>";

	}elseif ($go == 'Edit') { // Edit Page 

		echo "<div class='container'>";
		//Check If catid is numerical & Get the integer value of it
		$catid = isset($_GET['catid'])&& is_numeric($_GET['catid']) ? intval($_GET['catid']): 0;

		//Select All Data Debend On The id
		$stmt = $con->prepare("SELECT * FROM categories WHERE CatID = ?");
		$stmt->execute(array($catid));
		$cat = $stmt->fetch();
		$count = $stmt->rowCount();

		if ($count > 0) {?>
			
			<div class="container">
			<h1 class="text-center">Edit Category</h1>
				<form method="POST" action="?go=Update" class="form-horizontal">
					<input type="hidden" name="catid" value="<?php echo $catid;?>">
		          	<div class="form-group">
		                <label class="col-sm-3 control-label">Cat Name</label>
		                <div class="col-sm-7">
		                    <input type="text" name="catname" class="form-control" placeholder="Category Name" value="<?php echo $cat['CatName'];?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Description</label>
		                <div class="col-sm-7">
		                    <input type="text" name="catdesc" class="form-control" placeholder ="The Description for Category" value="<?php echo $cat['CatDescription'];?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Ordering</label>
		                <div class="col-sm-7">
		                    <input type="text" name="ordering" class="form-control" placeholder="Number to Arrang Categories" value="<?php echo $cat['Ordering'];?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Visible</label>
		                <div class="col-sm-7">
		                    <input id="vis-yes" type="radio" name="visibility" value="1" <?php if($cat['Visibility']==1){echo "checked";}?> >
		                    <label for="vis-yes">Yes</label>
		                    <input id="vis-no" type="radio" name="visibility" value="0" <?php if($cat['Visibility']==0){echo "checked";}?> >
		                    <label for="vis-no">No</label>
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Allo Comments</label>
		                <div class="col-sm-7">
		                    <input id="com-yes" type="radio" name="comments" value="1"  <?php if($cat['Allow_Comments']==1){echo "checked";}?> >
		                    <label for="com-yes">Yes</label>
		                    <input id="com-no" type="radio" name="comments" value="0" <?php if($cat['Allow_Comments']==0){echo "checked";}?> >
		                    <label for="com-no">No</label>
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-sm-3 control-label">Allow Ads</label>
		                <div class="col-sm-7">
		                    <input id="ads-yes" type="radio" name="ads" value="1" <?php if($cat['Allow_Ads']==1){echo "checked";}?> >
		                    <label for="ads-yes">Yes</label>
		                    <input id="ads-no" type="radio" name="ads" value="0" <?php if($cat['Allow_Ads']==0){echo "checked";}?> >
		                    <label for="ads-no">No</label>
		                </div>
		            </div>
		            <div class="form-group col-ms-offset-3">
		                <div class="text-center">
		                    <input type="submit" value="Update Database" class="btn btn-primary">
		                </div>
		            </div>
		    	</form>
	    	</div>
	    	
		<?php
		}else{
			$Msg = "<div class='alert alert-danger'>There is no such ID </div>";
			redirectHome($Msg);
		}
		echo "</div>";

	}elseif ($go == 'Update') { //Update Page 
		echo '<div class="container">';
		echo "<h1 class='text-center'>Update Categories</h1>";

		if ($_SERVER['REQUEST_METHOD']=='POST') {

			//Get Items from the form
			$catid 	=$_POST['catid'];
			$catn 	=$_POST['catname'];
			$desc 	=$_POST['catdesc'];
			$ord 	=$_POST['ordering'];
			$vis 	=$_POST['visibility'];
			$com 	=$_POST['comments'];
			$ads 	=$_POST['ads'];

			//Update the Database 
			$stmt = $con->prepare("UPDATE 
										categories 
									SET 
										CatName = ?, 
										CatDescription = ?, 
										Ordering = ?, 
										Visibility = ?, 
										Allow_Comments = ?, 
										Allow_Ads = ? 
									WHERE 
										CatID = ?");
			$stmt->execute(array($catn, $desc, $ord, $vis, $com, $ads, $catid));

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
		echo '<h1 class="text-center">Delete User</h1>';

			//Check If userid is numerical & Get the integer value of it
			$catid = isset($_GET['catid'])&& is_numeric($_GET['catid']) ? intval($_GET['catid']): 0;
			//Select All Data Debend On The id
			$check = checkItem("CatID", "categories", $catid);

			if ($check > 0) {

				$stmt = $con->prepare("DELETE FROM categories WHERE CatID = :cid");
				$stmt->bindParam(":cid", $catid);
				$stmt->execute();

				$Msg = "<div class='alert alert-success'>" . 'Deleted Successfuly </div>';
				redirectHome($Msg, "Back");

			}else{
				$Msg = "<div class='alert alert-danger'>" . 'This ID is not Exist </div>';
				redirectHome($Msg);
			}
		echo '</div>';

	}elseif ($go == 'Activate') { // Active Page

	}

	include $tpl . 'footer.php';
}else{ header('Location: index.php'); exit();}