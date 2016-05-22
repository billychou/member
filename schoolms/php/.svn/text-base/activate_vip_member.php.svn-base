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
    $address = isset($_POST['address']) ? $_POST['address'] : "";
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $nation = isset($_POST['nation']) ? $_POST['nation'] : "";   
    $politics = isset($_POST['politics']) ?$_POST['politics'] : "";
    $native = isset($_POST['native']) ?$_POST['native'] : "";
    $creditnum = isset($_POST['creditnum']) ?$_POST['creditnum'] : "";
    $mobilenum = isset($_POST['mobilenum']) ?$_POST['mobilenum'] : "";
    $phonenum = isset($_POST['phonenum']) ? $_POST['phonenum'] : "";  
	$email = isset($_POST['email']) ? $_POST['email'] : "";
	$qqnum = isset($_POST['qqnum']) ? $_POST['qqnum'] : "";   
    $education = isset($_POST['education']) ? $_POST['education'] : "";   
    $graduateschool = isset($_POST['graduateschool']) ? $_POST['graduateschool'] : "";   
    $company = isset($_POST['company']) ? $_POST['company'] : "";
    $positionaltitle = isset($_POST['positionaltitle']) ? $_POST['positionaltitle'] : "";
    $title = isset($_POST['title']) ? $_POST['title'] : "";
    $docregtime = isset($_POST['docregtime']) ? $_POST['docregtime'] : "";
    $booktime = isset($_POST['booktime']) ? $_POST['booktime'] : "";
    $trainedtime = isset($_POST['trainedtime']) ? $_POST['trainedtime'] : "";
    $branchid = isset($_POST['branchid']) ? $_POST['branchid'] : "";
    $doctorscores = isset($_POST['doctorscores']) ? $_POST['doctorscores'] : "";
	$updatetime = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
    $classid = isset($_POST['classid']) ? $_POST['classid'] : "";
    $action = isset($_POST['action']) ? $_POST['action'] : "";
	if($action == "save") {  //保存客户信息
		if(insert_vip_member($address,$booktime,$branchid,$company,$creditnum,
                       $docregtime,$doctorscores,$education,$email,$gender,$graduateschool, 
                       $mobilenum,$name,$nation,
                       $native,$phonenum, $politics,$positionaltitle,
                       $qqnum,$title,$trainedtime,$updatetime,$classid)) { //保存成功
		        $result = array("code"=>"1","info"=>"保存成功, 马上转入列表界面");								
		} else { //保存失败
			$result = array("code"=>"2","info"=>"保存失败, 请仔细核对输入信息");
		}
	} else if($action == "edit"){ //更新客户信息
		if(update_vip_member_by_id($id,$address,$booktime,$branchid,$company,$creditnum,
                       $docregtime,$doctorscores,$education,$email,$gender,$graduateschool, 
                       $mobilenum,$name,$nation,
                       $native,$phonenum, $politics,$positionaltitle,
                       $qqnum,$title,$trainedtime,$updatetime,$classid)) {  //更新成功
				$result = array("code"=>"1","info"=>"更新成功, 马上转入列表界面");
		} else {
			$result = array("code"=>"2","info"=>"更新失败, 请仔细核对输入信息"); //更新失败
        }
	} else if($action == "delete"){ //删除客户信息
		if(delete_vip_member_by_id($id,$updatetime)) {  //删除成功
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
