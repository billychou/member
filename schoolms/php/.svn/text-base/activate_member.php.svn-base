<?php
  //header('Content-Type:text/html;charset=utf-8');
	header('Content-type: text/json;charset=utf-8');  
	include ('db_fns.php');
	include ('admin_fns.php');
	include ('book_fns.php');
	include ('file_fns.php');
	include ('auth_check.php');
	 
	$currentUser = $_SESSION['thisuser'];
	
	$id = isset($_POST['id']) ? $_POST['id'] : "";
    $majorid = isset($_POST['majorid']) ?$_POST['majorid'] : "";
    $classid = isset($_POST['classid']) ?$_POST['classid'] : "";
    $applyat = isset($_POST['applyat']) ?$_POST['applyat'] : "";
    $cardnum = isset($_POST['cardnum']) ?$_POST['cardnum'] : "";
    $name = isset($_POST['name']) ? $_POST['name'] : "";
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $creditnum = isset($_POST['creditnum']) ? $_POST['creditnum'] : "";
	$contact = isset($_POST['contact']) ? $_POST['contact'] : "";
	$qq = isset($_POST['qq']) ? $_POST['qq'] : "";
    $address = isset($_POST['address']) ? $_POST['address'] : "";
    $education = isset($_POST['education']) ? $_POST['education'] : "";
    $note = isset($_POST['note']) ? $_POST['note'] : "";
    
    $paynum = isset($_POST['paynum']) ? $_POST['paynum'] : "";
    $book = isset($_POST['book']) ? $_POST['book'] : "";
    
    $jobtitle = isset($_POST['jobtitle']) ? $_POST['jobtitle'] : "";
    $operatorid = isset($_POST['operatorid']) ? $_POST['operatorid'] : "";
    
	$action = isset($_POST['action']) ? $_POST['action'] : "";
	$updatetime = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
	
	//$operatorid = $currentUser['id'];
	
	if(!isHeadQuarter()) {
		$branchid = $currentUser['branchid'];
	}
	
	if($action == "save") {  //保存客户信息
		if(insert_member($cardnum,$classid,$applyat,$contact,$name,$gender,$qq,
            "'".$creditnum,$address,$education, $book, $branchid,$operatorid, $updatetime, $note, $jobtitle)) { //保存成功
		        $result = array("code"=>"1","info"=>"注册成功, 马上转入列表界面");								
		} else { //保存失败
			$result = array("code"=>"2","info"=>"注册失败, 请仔细核对输入信息");
		}
	} else if($action == "edit"){ //更新客户信息
		if(update_member_by_id($id,$cardnum,$classid,$applyat,$contact,$name,$gender,$qq,
            $creditnum,$address,$education, $book, $branchid,$operatorid, $updatetime, $note, $jobtitle)) {  //更新成功
				$result = array("code"=>"1","info"=>"更新成功, 马上转入列表界面");
		} else {
			$result = array("code"=>"2","info"=>"更新失败, 请仔细核对输入信息"); //更新失败
        }
	} else if($action == "delete"){ //删除客户信息
		if(delete_member_by_id($id,$updatetime)) {  //删除成功
			$result = array("code"=>"1","info"=>"删除成功, 马上转入列表界面");
		} else {
			$result = array("code"=>"2","info"=>"删除失败, 请仔细查看提示信息"); //删除失败
		}
	}else { //识别不出Action是啥东东
		$result = array("code"=>"9","info"=>"操作失败, 未授权的操作，请联系管理员。");
	}

	//返回操作结果的Message，Json格式{"code":"1","info":"操作成功"}
	//echo preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))",json_encode($result));
	echo json_encode($result);

?>
