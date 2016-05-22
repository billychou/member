<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>培训学校综合管理系统</title>
<script src="js/add_ui.js" type="text/javascript"></script>
<script src="js/constants.js" type="text/javascript"></script>
<script src="js/ignoreBackspace.js" type="text/javascript"></script>

<!--
<?php
	include ('php/db_fns.php');
	include ('php/book_fns.php');
	include ('php/auth_check.php');
?>
-->

<?php
	$currentUser = $_SESSION['thisuser'];
	$username = $currentUser["username"];
	$account_id = $currentUser["account_id"];
?>

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"purunit"});
	$("#password0").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#password").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).functionValidator({fun:validatePsssWord});
	$("#password1").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).functionValidator({fun:validatePsssWord});
});

function validatePsssWord() {
	if($("#password").val() != '' && $("#password0").val() != "" ) {
		if($("#password").val() == $("#password0").val()) {
			return "新密码不能与原密码一致";
		}
	}
	if($("#password").val() != '' && $("#password1").val() != "" ) {
		if($("#password").val() == $("#password1").val()) {
			return true;
		} else {
			return "两次输入密码不一致!";
		}
	} else {
		return true; 
	}
}

function submit_form() {

	if ($.formValidator.pageIsValid('1')==true) {  //如果校验成功，则提交表单，如果校验不成功则 return false
		 
		$('#purunit').ajaxSubmit(function(data){ //利用jquery.form中的方法 用ajax方式提交表单
			var jsonObj = eval("("+data+")");//转换为json对象 
			
			if(jsonObj.code == 1) {
				var pop=new Pop("操作成功",
				jsonObj.info
				);
				
				setTimeout(function(){
					location.href = "main.php";
				},20)
			
			} else {
				var pop=new Pop("操作失败",
				jsonObj.info
				);
				return false;
			}
        });
	} 
    return false;
}
</script>
</head>

<body>
<div class="zt">

 <fieldset> 
  <legend>修改用户密码</legend>
  <form action="php/activate_user.php" method="post" class="table_wb" id="purunit">
  <input type="hidden" name="action" id="action" value="updatePSW"/>
<table  align="center"   cellpadding="0" cellspacing="0"   class="biaoge">

  <tr >
    <td width="10%"class="jy">用户姓名</td>
    <td width="20%"><span>&nbsp;&nbsp;<?php echo $username ?></span></td>
    <td style="border-left:0px;"><div id='usernameTip'style="width:150px"></div></td>
  </tr>
  <tr >
    <td width="10%"class="jy">登录ID</td>
    <td width="20%">
		<input name="account_id" id="account_id" readonly="true" type="hidden" value="<?php echo $account_id ?>"  maxlength="50" /> 
		<span>&nbsp;&nbsp;<?php echo $account_id ?></span>
	</td>
    <td style="border-left:0px;">&nbsp;</td>
  </tr>
  
  <tr >
    <td width="10%"class="jy">原密码</td>
    <td width="20%"><input name="password0" id="password0" type="password" maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='password0Tip'style="width:200px"></div></td>
  </tr>
  
  <tr >
    <td width="10%"class="jy">新密码</td>
    <td width="20%"><input name="password" id="password" type="password" value=""  maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='passwordTip'style="width:200px"></div></td>
  </tr>
  
  <tr >
    <td width="10%"class="jy">确认新密码</td>
    <td width="20%"><input name="password1" id="password1" type="password" value=""  maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='password1Tip'style="width:200px"></div></td>
  </tr>
  
</table>

<div align="center"><a href="javascript:void(0)" ><img src="images/submit.gif" onmouseover="this.src='images/submit-1.gif'"  onmouseout="this.src='images/submit.gif'" onclick="submit_form()">  </a></div>
		 
   </form>
</div>
</fieldset>
</div>
</body>
</html>
