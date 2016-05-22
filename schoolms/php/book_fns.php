<?php
header('Content-Type:text/html;charset=utf-8');


function get_sql_endstr() {
	$endStr = "";
	$currentUser = $_SESSION['thisuser'];
	$branchid = $currentUser['branchid'];
	if(isHeadQuarter()) {
		
	} else {
		$endStr = " and branchid = ".$branchid;
	}
	return $endStr;
}

function get_users() {
   // query database for a list of concrete
   $conn = db_connect();
   //$query = "select * from concrete";
   $query = " select * from adminv where 1=1 ";
   $query .= get_sql_endstr();
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_user_by_accountID($account_id) {
   $conn = db_connect();
   $query = " select * from adminv where 1=1 ";
   $query .= " and account_id = '".$account_id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_branchs() {
   $conn = db_connect();
   $query = " select * from branchv where 1=1";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_majors() {
   $conn = db_connect();
   $query = " select * from majorv where 1=1";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_employees() {
   $conn = db_connect();
   $query = " select * from employeev where 1=1";
   $query .= get_sql_endstr();
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_classes_by_majorid($majorid) {
   $conn = db_connect();
   $query = " select id,classname from classv where 1=1";
   if ($majorid) {
	$query .= " and majorid = ".$majorid;
   }
   
   //echo $query;
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_user_by_id($id) {
   $conn = db_connect();
   $query = " select * from adminv where 1=1 ";
   $query .= " and id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_employee_by_id($id) {
   $conn = db_connect();
   $query = " select * from employeev where 1=1 ";
   $query .= " and id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_branch_by_id($id) {
   $conn = db_connect();
   $query = " select * from branchv where 1=1 ";
   $query .= " and id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_major_by_id($id) {
   $conn = db_connect();
   $query = " select * from majorv where 1=1 ";
   $query .= " and id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}
function get_class_by_id($id) {
   $conn = db_connect();
   $query = " select * from classv where 1=1 ";
   $query .= " and id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_classes() {
   $conn = db_connect();
   $query = " select * from classv where 1=1";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_members() {
   $conn = db_connect();
   $query = " select * from memberv0 where 1=1";
   $query .= get_sql_endstr();
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}


function get_member_by_id($id) {
   $conn = db_connect();
   $query = " select * from memberv0 where 1=1 ";
   $query .= " and id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_vip_member_by_id($id) {
   $conn = db_connect();
   $query = " select * from vipv where 1=1 ";
   $query .= " and id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}


function get_spendments() {
   $conn = db_connect();
   $query = "select * from spendmentv where 1=1";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_spendment_by_id($id) {
   $conn = db_connect();
   $query = " select * from spendmentv where 1=1 ";
   $query .= " and id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_notice_list() {
   $conn = db_connect();
   $query = " select * from notice where 1=1";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_payments() {
   $conn = db_connect();
   $query = "select * from paymentv where 1=1";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_member_by_cardnum($cardnum) {
   $conn = db_connect();
   $query = " select * from memberv0 where 1=1 ";
   $query .= " and cardnum = '".$cardnum."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_payment_by_id($id) {
   $conn = db_connect();
   $query = " select * from paymentv where 1=1 ";
   $query .= " and id = '".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_notice_top3() {
   $conn = db_connect();
   $query = " select * from notice where 1=1 ";
   //$query .= " and id = '".$id."'";
   //echo $query;
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}
function get_payments_by_branchid($branchid) {
   $conn = db_connect();
   $query = "select * from paymentv where 1=1";
   $query .= " and branchid = '".$branchid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function getTotalSpendment() {
   $conn = db_connect();
   $query = "select sum(spendnum) as totalsm  from spendmentv where 1=1";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

?>
