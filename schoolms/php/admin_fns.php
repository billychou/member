<?php
header('Content-Type:text/html;charset=utf-8');

function insert_user($account_id,
			$username,
			$password,
			$sys_role,
			$branchid,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "insert into admin(account_id,name,sys_role,branchid,password,updatetime) values ( "
					."'".$account_id."',"
					."'".$username."',"
					."'".$sys_role."',"
					."'".$branchid."',"
					."'".$password."',"
					."'".$updatetime."'"
					.")";
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
}
function insert_branch($name,
			$owner,
			$note,$updatetime){
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "insert into branch(name,updatetime,owner,note) values ( "
					."'".$name."',"
					."'".$updatetime."',"
					."'".$owner."',"
					."'".$note."'"
					.")";
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
}

function insert_payment($memberid,$paynum,$cardnum,$note,$paytime,$operatorid,$updatetime){
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "insert into payment(memberid,paynum,cardnum,note,paytime,operatorid,updatetime) values ( "
					."'".$memberid."',"
					."'".$paynum."',"
                    ."'".$cardnum."',"
					."'".$note."',"
					."'".$paytime."',"
					."'".$operatorid."',"
                    ."'".$updatetime."'"
					.")";
                  //echo $query;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
}

function update_payment_by_id($id,$memberid,$paynum,$cardnum,$note,$paytime,$operatorid,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update payment set "
					." memberid = '".$memberid."',"
					." paynum = '".$paynum."',"
					." cardnum = '".$cardnum."',"
					." note = '".$note."',"
                    ." paytime = '".$paytime."',"
                    ." operatorid = '".$operatorid."',"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
       //echo $query;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
	
}

function insert_class($majorid,$name,$createat,$closeat,$note,$updatetime){
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "insert into class(majorid,name,createat,closeat,note,updatetime) values ( "
					."'".$majorid."',"
					."'".$name."',"
					."'".$createat."',"
					."'".$closeat."',"
					."'".$note."',"
					."'".$updatetime."'"
					.")";
					//echo $query;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
}
function insert_major($name,$note,$updatetime){
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "insert into major(name,updatetime,note) values ( "
					."'".$name."',"
					."'".$updatetime."',"
					."'".$note."'"
					.")";
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	return true;
}

function insert_employee($name,$gender,$title,$creditnum,$contact,$onbroadtime,$branchid,$updatetime){
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "insert into employee(name,gender,title,creditnum,contact,onbroadtime,branchid,updatetime) values ( "
					."'".$name."',"
					."'".$gender."',"
					."'".$title."',"
					."'".$creditnum."',"
					."'".$contact."',"
					."'".$onbroadtime."',"
					."'".$branchid."',"
					."'".$updatetime."'"
					.")";
					//echo $query;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
}

function insert_member($cardnum,
                       $classid,
                       $applyat,
                       $contact,
                       $name,
                       $gender,
                       $qq,
                       $creditnum,
                       $address,
                       $education,
                       $book,
                       $branchid, 
                       $operatorid, 
                       $updatetime,
                       $note,$jobtitle){
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "insert into member(cardnum, classid, applyat,contact,name,gender,qq,creditnum
                 ,address, education, book, branchid, operatorid, updatetime, note, jobtitle) values ( "
					."'".$cardnum."',"
					."".$classid.","
					."'".$applyat."',"
					."'".$contact."',"
					."'".$name."',"
					."'".$gender."',"
					."'".$qq."',"
                    .'"'.$creditnum.'",'
                    ."'".$address."',"
                    ."'".$education."',"
                    ."'".$book."',"
                    ."".$branchid.","
                    ."".$operatorid.","
					."'".$updatetime."',"
                    ."'".$note."',"
                    ."'".$jobtitle."'"
					.")";
					echo $query;
	   $result = $conn->query($query);
	   

	   
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
}
function insert_log($userid,$updatetime,$ip,$operattype
                        ) {
	$conn = db_connect();
	$note = '';
	
	$query = "INSERT INTO `log`(`id`, `userid`, `updatetime`, `ip`, `opearttype`) VALUES (null,"
				.$userid.",'"
				.$updatetime."','"
				.$ip."','"
				.$operattype."')";
				
				//echo $query;
   $result = $conn->query($query);
   if (!$result) {
     //echo "failed to insert"; 
     return false;
   } else {
     return true;
   }
}
function update_member_by_id($id,$cardnum,$classid,$applyat,$contact,$name,$gender,$qq,
            $creditnum,$address,$education, $book, $branchid,$operatorid, $updatetime, $note, $jobtitle){
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update member set "
					." cardnum = '".$cardnum."',"
					." classid = '".$classid."',"
					." applyat = '".$applyat."',"
					." contact = '".$contact."',"
					." name = '".$name."',"
					." gender = '".$gender."',"
					." qq = '".$qq."',"
					.' creditnum = "'.$creditnum.'",'
					." address = '".$address."',"
					." education = '".$education."',"
					." book = '".$book."',"
					." branchid = '".$branchid."',"
					." operatorid = '".$operatorid."',"
					." updatetime = '".$updatetime."',"
                    ." note = '".$note."',"
                    ." jobtitle = '".$jobtitle."'"
				." where id=".$id;
                //echo $query;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;		
			
} 


function update_user_by_id($id,$account_id,
			$username,
			$password,
			$sys_role,
			$branchid,$updatetime
			) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update admin set "
					." account_id = '".$account_id."',"
					." name = '".$username."',"
					." password = '".$password."',"
					." sys_role = '".$sys_role."',"
					." branchid = '".$branchid."',"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;		
			
} 

function update_employee_by_id($id,$name,$gender,$title,$creditnum,$contact,$onbroadtime,$branchid,$updatetime){
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update employee set "
					." name = '".$name."',"
					." gender = '".$gender."',"
					." title = '".$title."',"
					." creditnum = '".$creditnum."',"
					." contact = '".$contact."',"
					." onbroadtime = '".$onbroadtime."',"
					." branchid = '".$branchid."',"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;		
			
} 


function update_major_by_id($id,
			$name,
			$note, $updatetime
			) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update major set "
					." name = '".$name."',"
					." note = '".$note."',"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;		
			
} 

function update_branch_by_id($id,$name,
			$owner,
			$updatetime,
			$note
			) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update branch set "
					." name = '".$name."',"
					." owner = '".$owner."',"
					." note = '".$note."',"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
			
			
} 
function update_class_by_id($id,$majorid,$name,$createat,$closeat,$note,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update class set "
					." majorid = '".$majorid."',"
					." name = '".$name."',"
					." createat = '".$createat."',"
					." closeat = '".$closeat."',"
					." note = '".$note."',"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
				//echo $query;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
}

function update_vip_member_by_id($id,$address,$booktime,$branchid,$company,$creditnum,
                       $docregtime,$doctorscores,$education,$email,$gender,$graduateschool, 
                       $mobilenum,$name,$nation,
                       $native,$phonenum,$politics,$positionaltitle,
                       $qqnum,$title,$trainedtime,$updatetime,$classid){
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update vip set "
					." address = '".$address."',"
					." booktime = '".$booktime."',"
					." branchid = '".$branchid."',"
					." company = '".$company."',"
					." creditnum = '".$creditnum."',"
					." docregtime = '".$docregtime."',"
					." doctorscores = '".$doctorscores."',"
					." education = '".$education."',"
					." email = '".$email."',"
					." gender = '".$gender."',"
					." graduateschool = '".$graduateschool."',"
					." mobilenum = '".$mobilenum."',"
					." name = '".$name."',"
                    ." nation = '".$nation."',"
                    ." native = '".$native."',"
                    ." phonenum = '".$phonenum."',"
                    ." politics = '".$politics."',"
                    ." positionaltitle = '".$positionaltitle."',"
                    ." qqnum = '".$qqnum."',"
                    ." title = '".$title."',"
                    ." trainedtime = '".$trainedtime."',"
					." updatetime = '".$updatetime."',"
                    ." classid = '".$classid."'"
				." where id=".$id;
                //echo $query;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;					
} 

function delete_user_by_id($id,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update admin set "
					." del_flag = 1,"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;		
}

function delete_member_by_id($id,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update member set "
					." del_flag = 1,"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;		
}

function delete_class_by_id($id,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update class set "
					." del_flag = 1,"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;		
}

function delete_branch_by_id($id,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   $query = "update branch set "
					." del_flag = 1 ,"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
			
			
}

function delete_major_by_id($id,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   $query = "update major set "
					." del_flag = 1 ,"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
			
			
}

function delete_employee_by_id($id,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   $query = "update employee set "
					." del_flag = 1 ,"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;			
}

function delete_payment_by_id($id,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
       $query = "update payment set "
					." del_flag = 1 ,"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;		
}

function update_user_psw_by_account_id($id,$password,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update admin set "
					." password = '".$password."',"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;			
}


function insert_vip_member($address,$booktime,$branchid,$company,$creditnum,
                       $docregtime,$doctorscores,$education,$email,$gender,$graduateschool, 
                       $mobilenum,$name,$nation,
                       $native,$phonenum,$politics,$positionaltitle,
                       $qqnum,$title,$trainedtime,$updatetime,$classid){
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "insert into vip (address,booktime,branchid,company,creditnum,
                       docregtime,doctorscores,education,email,gender, graduateschool, 
                       mobilenum,name,nation,native,phonenum,politics,positionaltitle,
                       qqnum,title,trainedtime,updatetime,classid) values ( "
					."'".$address."',"
					."'".$booktime."',"
					."'".$branchid."',"
					."'".$company."',"
					."'".$creditnum."',"
					."'".$docregtime."',"
					."".$doctorscores.","
                    ."'".$education."',"
                    ."'".$email."',"
                    ."'".$gender."',"
                    ."'".$graduateschool."',"
					."'".$mobilenum."',"
                    ."'".$name."',"
                    ."'".$nation."',"
                    ."'".$native."',"
                    ."'".$phonenum."',"
                    ."'".$politics."',"
                    ."'".$positionaltitle."',"
                    ."'".$qqnum."',"
                    ."'".$title."',"
                    ."'".$trainedtime."',"
                    ."'".$updatetime."',"
                    ."'".$classid."'"
					.")";
                    //echo $query;
	   $result = $conn->query($query);
       
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
}

function insert_spendment($spendnum,$spenddate,$employeeid,$spenduse,
            $note,$branchid,$updatetime){
            
    $conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "insert into spendment (spendnum,spenddate,employeeid,spenduse,note,branchid,updatetime) values ( "
					."'".$spendnum."',"
					."'".$spenddate."',"
					."'".$employeeid."',"
					."'".$spenduse."',"
					."'".$note."',"
                    ."'".$branchid."',"
					."'".$updatetime."'"
					.")";
					//echo $query;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;                 
    }
    
function update_spendment_by_id($id,$spendnum,$spenddate,$employeeid,$spenduse,$note,$branchid,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update spendment set "
					." spendnum = '".$spendnum."',"
					." spenddate = '".$spenddate."',"
					." employeeid = '".$employeeid."',"
					." spenduse = '".$spenduse."',"
					." note = '".$note."',"
                    ." branchid = '".$branchid."',"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
				//echo $query;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;
	
}

function delete_spendment_by_id($id,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   $query = "update spendment set "
					." del_flag = 1 ,"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;		
}

function delete_vip_member_by_id($id,$updatetime) {
	$conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "update vip set "
					." del_flag = 1,"
					." updatetime = '".$updatetime."'"
				." where id=".$id;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;		
}

function insert_notice($title,$body,$adminid,$updatetime,
            $validays,$branchid){
            
    $conn = db_connect();   
    $conn->autocommit(false); 
    try {
	   // insert new balance
	   $query = "insert into notice (title,body,adminid,updatetime,validays,branchid) values ( "
					."'".$title."',"
					."'".$body."',"
					."'".$adminid."',"
					."'".$updatetime."',"
					."'".$validays."',"
                    ."'".$branchid."'"
					.")";
					//echo $query;
	   $result = $conn->query($query);
	} catch(Exception $e) {
		$conn->rollback();
		$conn->autocommit(true); 
		return false;
	}
	
	$conn->commit(); 
	$conn->autocommit(true); 
	
	return true;                 
    }
    

?>
