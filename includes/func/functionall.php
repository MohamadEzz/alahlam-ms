<?php

	/***************************************
	** function to get all tables items from DB
	** 6 Parameters
	** Requird 1 Parameters //$table//
	** Other Parameters Optional 
	****************************************/
	function getAll($table, $orderby = NULL, $where = NULL, $item = Null, $and = NULL, $ordring = 'DESC'){
		global $con;

		$itemq 		= ($item == NULL) ? '*' : $item ;
		$whereq 	= ($where == NULL) ? '' : $where ;
		$andq 		= ($and == NULL) ? '' 	: $and ;
		$orderbyq 	= ($orderby == NULL) ? '' : $orderby ;

		$st = $con->prepare("SELECT $itemq FROM $table $whereq $andq ORDER BY $orderbyq $ordring");
		$st->execute();

		$rows = $st->fetchall();

		return $rows;
	}


?>