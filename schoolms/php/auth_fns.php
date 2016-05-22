<?php
	header('Content-type: text/html;charset=utf-8');  
	//判断是否是管理角色（admin），如果是，返回true，界面显示修改删除入口
	function canAdm() {
		return true;
	}
	
	//判断是否是操作（含管理）角色（admin or operator），如果是，返回true，界面显示新增入口
	function canOpt() {
		return true;
	}
?>