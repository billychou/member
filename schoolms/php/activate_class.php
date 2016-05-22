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
	$name = isset($_POST['name']) ? $_POST['name'] : "";
	$majorid = isset($_POST['majorid']) ? $_POST['majorid'] : "";
	$employeeid = isset($_POST['employeeid']) ? $_POST['employeeid'] : "";
	$createat = isset($_POST['createat']) ? $_POST['createat'] : "";
	$closeat = isset($_POST['closeat']) ? $_POST['closeat'] : "";
	$note = isset($_POST['note']) ? $_POST['note'] : "";
	
	$action = isset($_POST['action']) ? $_POST['action'] : "";
	$updatetime = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
	
	if(!isHeadQuarter()) {
		$branchid = $currentUser['branchid'];
	}
	
	if($action == "save") {  //保存客户信息
		if(insert_class($majorid,$name,$createat,$closeat,$note,$updatetime)) { //保存成功
		        $result = array("code"=>"1","info"=>"注册成功, 马上转入列表界面");								
		} else { //保存失败
			$result = array("code"=>"2","info"=>"注册失败, 请仔细核对输入信息");
		}
	} else if($action == "edit"){ //更新客户信息
		if(update_class_by_id($id,$majorid,$name,$createat,$closeat,$note,$updatetime)) {  //更新成功
				$result = array("code"=>"1","info"=>"更新成功, 马上转入列表界面");
		} else {
			$result = array("code"=>"2","info"=>"更新失败, 请仔细核对输入信息"); //更新失败
        }
	} else if($action == "delete"){ //删除客户信息
		if(delete_class_by_id($id,$updatetime)) {  //删除成功
			$result = array("code"=>"1","info"=>"删除成功, 马上转入列表界面");
		} else {
			$result = array("code"=>"2","info"=>"删除失败, 请仔细查看提示信息"); //删除失败
		}
	} else if($action == "select"){ //删除客户信息
		$result = get_classes_by_majorid($majorid);
	} else { //识别不出Action是啥东东
		$result = array("code"=>"9","info"=>"操作失败, 未授权的操作，请联系管理员。");
	}

	//返回操作结果的Message，Json格式{"code":"1","info":"操作成功"}
	//echo preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))",json_encode($result));
	echo json_encode($result);

?>
