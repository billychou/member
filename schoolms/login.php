<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="js/login_ui.js" type="text/javascript"></script>
<script src="js/ignoreBackspace.js" type="text/javascript"></script>
<title>375医考综合管理系统</title>
<style>
*{margin:0; padding:0;overflow:hidden;}
.dl{
	width:100%;
	height:100%;
}
.dl-bg{
	width:100%;
	height:252px;
	background:url(images/dl-bg.png);
	margin-top:210px;
}
.dl-k{
	width:364px;
	height:252px;
	background:url(images/dl.png);
	position:relative;
	top:-253px;
	right:10%;
	float:right;
}
.dl-w{
	width:529px;
	height:252px;
	background:url(images/dl-w.png);
	position:relative;
	top:-253px;
	left:10%;
	float:left;
}
.yhm{
	width:224px;
	height:120px;
	line-height:30px;
	position:relative;
	top:22px;
	left:129px;
}

.yhm input{margin-left:10px;}

#msg_tip{
	font-size:12px;
	line-height:30px;
	color:red;
}
</style>
<script type="text/javascript">

function refreshCaptcha() {
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}

function submit_form() {
	var msg = "";
	//alert($("#account_id").val());
	if ($("#account_id").val() == "") {
		msg = "登录用户名不能为空！";		
	} else if($("#password").val() == "") {
		msg = "密码不能为空！";
	} else if($("#code").val() == ""){
		msg = "验证码不能为空！";
	} else  {
		var result = $("#code").val().match(/^[0-9]{4}/);
		if(result == null) {	
			msg = "验证码必须是四位数字！";
		}
	}
	
	if(msg != "") {
		$("#msg_tip").html(msg);
		return false;
	} else {
		$("#msg_tip").html("")
	}
		 
	$('#login_form').ajaxSubmit(function(data){ //利用jquery.form中的方法 用ajax方式提交表单
		var jsonObj = eval("("+data+")");//转换为json对象 
		if(jsonObj.code == 1) {
			location.href="index.php";
		} else {
			$("#msg_tip").html(jsonObj.info);
			refreshCaptcha();
			return false;
		}
	});
	
    return false;
}
</script>
<?php

	if(isset($_GET['code'])) {
		$code = $_GET['code'];
	} else {
		$code = "";
	}
	if($code == -1) {
		$msg = "未登录或超时，请重新登录";
	} else if($code == -2) {
		session_start();
		if(isset($_SESSION['thisuser'])) {
			unset ($_SESSION['thisuser']);
		}
		$msg = "已退出系统！";
	} else {
        session_start();
        $msg = "";
	}
?>

</head>

<body bgcolor="#e7f7fb">
<div class="dl">
	<div class="dl-bg">
    </div>
    <div class="dl-w">
    </div>
    <div class="dl-k">
    <form id="login_form" method="post" action="php/activate_login.php">
	
	<input type="hidden" name="action" id="action" value="login"/>
    <table  class="yhm">
    <tr>    
        <td height="30" colspan="2">
            <div align="left" id="msg_tip">
                <?php echo $msg ?>
            </div>
        
        </td>
    </tr>
  <tr>
    <td colspan="2" height="28">
		<input name="account_id" id="account_id" type="text" value=""  style="width:146px; height:23px; line-height:23px;border:0;background:none;"/>	
	</td>
  </tr>
  <tr>
    <td colspan="2" height="52">
		<input name="password" id="password" type="password" value=""  style="width:146px; height:23px; line-height:23px;border:0;background:none;"/>
	</td>
  </tr>
  <tr>
    <td width="107" height="30"><input name="code"  id="code" type="text" value=""  style="width:70px; height:23px; line-height:23px;border:0;background:none;"/></td>
    <td width="215" height="30"><img id="captchaimg" style="width:70px;height:23px; line-height:23px;border:0;margin-right:18px;margin-top: 5px;margin-bottom:2px;
vertical-align: middle;" onclick="refreshCaptcha()" src="captcha_code_file.php?rand=<?php echo rand();?>" ></td>
  </tr>
    <tr>    
    <td colspan="2" height="60">
		<div align="left">&nbsp;&nbsp;
			<a href="javascript:void(0)"  onclick="submit_form()"><img  src="images/dl-dlan.png" border="0"></a>
		</div>
	</td>
  </tr>
</table>
</form>
    </div>
</div>

</body>
</html>
