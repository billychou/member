<?php
session_start();
//$_SESSION['thisuser'] = array("sys_role"=>"admin","biz_role"=>"log","username"=>"习近平","account_id"=>"xjp","id"=>"4");
$thisuser = "";
/*判断执行当前页面或操作的时候有没有用户登录，如果没有则跳转到登录界面，提示登录*/
if(isset($_SESSION['thisuser'])) {
	$thisuser = $_SESSION['thisuser'];
	return true;
} else {
	//$login = "http://".$_SERVER ['HTTP_HOST']."../login.php?code=-1";
	$login = "login.php?code=-1";
	header("Location:$login");
}
//判断是否是管理角色（admin），如果是，返回true，界面显示修改删除入口
function canAdm() {
	$currentUser = $_SESSION['thisuser'];
	if($currentUser['sys_role'] == "admin") {
		return true;
	} else {
		return false;	
	}
}

//判断是否是操作（含管理）角色（admin or operator），如果是，返回true，界面显示新增入口
function canOpt() {
	$currentUser = $_SESSION['thisuser'];
	$sys_role = $currentUser['sys_role'];
	if($sys_role == "admin" or $sys_role == "operator") {
		return true;
	} else {
		return false;
	}
}

//判断登录用户是否是总部用户
function isHeadQuarter() {
	$currentUser = $_SESSION['thisuser'];
	$branchid = $currentUser['branchid'];
	if($branchid == "0") {
		return true;
	} else {
		return false;
	}
}

?>
