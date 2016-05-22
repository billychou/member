<?php
    //header('Content-Type:text/html;charset=utf-8');
	header('Content-type: text/json;charset=utf-8');  
	include ('db_fns.php');
	include ('admin_fns.php');
	include ('book_fns.php');
	include ('file_fns.php');
    session_start();	 
	$id = isset($_POST['id']) ? $_POST['id'] : "";
	$account_id = isset($_POST['account_id']) ? $_POST['account_id'] : "";
	$username = isset($_POST['username']) ? $_POST['username'] : "";
	$password = isset($_POST['password']) ? $_POST['password'] : "";
	$password0 = isset($_POST['password0']) ? $_POST['password0'] : "";
	$code = isset($_POST['code']) ? $_POST['code'] : "";
	$sys_role = isset($_POST['sys_role']) ? $_POST['sys_role'] : "";
	$branchid = isset($_POST['branchid']) ? $_POST['branchid'] : "";
	$action = isset($_POST['action']) ? $_POST['action'] : "";
	$updatetime = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
	
	if($action == "login") {
			if($code != $_SESSION['code']) {
				$result = array("code"=>"2","info"=>"验证码不正确"); //删除失败
			} else {
				if($thisuser = get_user_by_accountID($account_id)) {
					if($thisuser['password'] == $password) {
						$result = array("code"=>"1","info"=>"登录成功"); //删除失败
						$_SESSION['thisuser'] = $thisuser;
						insert_log($thisuser['id'],$updatetime,$_SERVER["REMOTE_ADDR"],"登录");
						
					} else {
						$result = array("code"=>"3","info"=>"密码与用户名不匹配"); //删除失败
					}
				} else {
					$result = array("code"=>"2","info"=>"该用户名不存在"); //删除失败
				}
				
			}
	} else if($action == "logout"){
		unset ($_SESSION['thisuser']);
		$result = array("code"=>"1","info"=>"退出成功");
	}else { //识别不出Action是啥东东
		$result = array("code"=>"9","info"=>"操作失败, 未授权的操作，请联系管理员。");
	}

	//返回操作结果的Message，Json格式{"code":"1","info":"操作成功"}
	//echo preg_replace("#\\\u([0-9a-f]{4})#ie", "iconv('UCS-2BE', 'UTF-8', pack('H4', '\\1'))",json_encode($result));
	echo json_encode($result);

?>
