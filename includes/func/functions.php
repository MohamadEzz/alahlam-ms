<?php


	/*************************************
	***Function To set Page Titles
	***Debending on the Variable pageTitle  
	**************************************/
	function getTitle(){
		global $pageTitle;
		if (isset($pageTitle)) {
			echo $pageTitle;
		}else{
			echo 'Default';
		}
	}


	/*************************************
	***Function To set Page Titles
	***Debending on the Variable pageTitle  
	**************************************/
	function checkUserStat($user){
		global $con;	
		//Check if User Exists in DB
		$stmtx = $con->prepare("SELECT Username FROM users WHERE Username = ? AND RegStatus = 0");
		$stmtx->execute(array($user));
		$status = $stmtx->rowcount();

		return $status;
	}


	/***************************************
	** function to get Latest Cats from DB
	** 0 Parameters
	****************************************/
	function getCats(){
		global $con;

		$stmtcats = $con->prepare("SELECT * FROM categories ORDER BY CatID ASC");
		$stmtcats->execute();

		$cats = $stmtcats->fetchall();

		return $cats;
	}


	/***************************************
	** function to get Latest items from DB
	** 1 Parameters
	****************************************/
	function getItems($CatID){
		global $con;

		$stmtitems = $con->prepare("SELECT * FROM items WHERE CatID = ? ORDER BY ItemID DESC");
		$stmtitems->execute(array($CatID));

		$items = $stmtitems->fetchall();

		return $items;
	}


	/***********************************
	** Function to Redirect Home or Back
	** Takes Tow Parameters
	************************************/
	function redirectHome($Msg, $url=null, $seconds = 3){

		if ($url === null) {
			$url = 'index.php';
			$link= 'Home Page';
		}else{
			if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
				$url = $_SERVER['HTTP_REFERER'];
				$link= 'Previous Page';
			}else{
				$url = 'index.php';
				$link= 'Home Page';	
			}
		}

		echo $Msg;
		echo "<div class='alert alert-info'>You will be redirected to $link after $seconds Seconds</div>";
		header("refresh:$seconds;url=$url");
		exit();
	}

	/*************************
	** function to check items
	** 3 Parameters
	**************************/
	function checkItem($select, $from, $value){
		global $con;

		$stmt1 = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
		$stmt1->execute(array($value));
		$count = $stmt1->rowCount();
		return $count;
	}

	/**************************
	** function To Count Items
	** 2 Parameters
	***************************/
	function countItem($item, $table){
		global $con;

		$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
		$stmt2->execute();

		return $stmt2->fetchColumn();
	} 

	/***************************************
	** function to get Latest items from DB
	** 4 Parameters
	****************************************/
	function getLatest($select, $table, $order, $limit = 5){
		global $con;

		$stmt3 = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
		$stmt3->execute();

		$rows = $stmt3->fetchall();

		return $rows;
	}