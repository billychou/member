﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>培训学校综合管理系统</title>
<link  href="style/conter.css"  rel="stylesheet">

<script src="js/add_ui.js" type="text/javascript"></script>
<script src="js/ignoreBackspace.js" type="text/javascript"></script>
</head>
<!--
<?php
include ('php/auth_check.php');
?>
-->

<?php
$currentUser = $_SESSION['thisuser'];
?>
<body>
<div class="top-top">
	<div class="nav-top">
		<div class="top-left">
            <img src="images/top-left.png">
		</div>
		<div class="top-right">
            <h1 align="center">题名教育总部</h1>
		</div>
	</div>
	<div class="nav-nav">
                <div class="nav-left">
                	<a href="index.php" target="_top"><img src="images/nav-left.png"></a>
                </div>
		欢迎<font color="#FFFF00"><b>
		【<?php echo $currentUser['branchname']?>】 &nbsp;<?php echo $currentUser['username'] ?></b></font> 登入系统 
		&nbsp; &nbsp; 角色：<font color="#FFFF00"><b>
		<?php echo $currentUser['sys_role_desc']?></b></font>
	</div>    
	<div class="nav-right">
		<a href="password_mant.php" target="mainFrame"><img src="images/xgmm.png"></a>
		<a href="login.php?code=-2" target="_top" onclick="if(confirm('确定退出系统吗?')){return true;}"><img id="logout1" src="images/tcxx.png"></a>
	</div>
</div>
</div>
</body>
</html>
