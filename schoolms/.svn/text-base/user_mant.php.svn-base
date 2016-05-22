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
	$action = $_GET['action'];
	if($action == "save") {
		$id = "";
		$account_id = "";
		$username = "";
		$password = "";
		$sys_role = "";
		$branchid = $thisuser['branchid'];
	} else if($action == "edit") {
		$id = $_GET['id'];
		$thisuser = get_user_by_id($id);		
		$id = $thisuser['id'];
		$account_id = $thisuser['account_id'];
		$username = $thisuser['username'];
		$password = $thisuser['password'];
		$sys_role = $thisuser['sys_role'];
		$branchid = $thisuser['branchid'];
	}
	
	$branchs = get_branchs();
?>

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"purunit"});
	<?php 
		if($action == 'save') {
	?>	
		$("#account_id").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	<?php
		}
	?>
	$("#username").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#password").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#sys_role").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"请选择权限,请确认"});	
<?php 
	if(isHeadQuarter()) {
?>
	$("#branchid").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"请选择分校机构,请确认"});		
<?php
	}
?>
	
});


function submit_form() {

	if ($.formValidator.pageIsValid('1')==true) {  //如果校验成功，则提交表单，如果校验不成功则 return false
		 
		$('#purunit').ajaxSubmit(function(data){ //利用jquery.form中的方法 用ajax方式提交表单
			var jsonObj = eval("("+data+")");//转换为json对象 
			
			if(jsonObj.code == 1) {
				var pop=new Pop("操作成功",
				jsonObj.info
				);
				
				setTimeout(function(){
					location.href = "user_list.php";
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
  <legend>维护系统用户</legend>
  <form action="php/activate_user.php" method="post" class="table_wb" id="purunit">
  <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
  <input type="hidden" name="action" id="action" value="<?php echo $action ?>"/>
<table  align="center"   cellpadding="0" cellspacing="0"   class="biaoge">
  <tr >
    <td width="10%"class="jy">登录ID</td>
	<?php 
		if($action == 'edit') {
	?>	
		<td width="20%"><input name="account_id" id="account_id" type="hidden" value="<?php echo $account_id ?>"  maxlength="50" />&nbsp;&nbsp;<?php echo $account_id ?> </td>
		<td style="border-left:0px;">&nbsp;</td>
	<?php
		} else {
	?>
    <td width="20%"><input name="account_id" id="account_id" type="text" value="<?php echo $account_id ?>"  maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='account_idTip'style="width:150px"></div></td>
	<?php 
		}
	?>
  </tr>
	<tr >
    <td width="10%"class="jy">用户姓名</td>
    <td width="20%"><input name="username" id="username" type="text" value="<?php echo $username ?>"  maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='usernameTip'style="width:150px"></div></td>
  </tr>
  <tr >
    <td width="10%"class="jy">初始密码</td>
    <td width="20%"><input name="password" id="password" type="password" value="<?php echo $password ?>"  maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='passwordTip'style="width:150px"></div></td>
  </tr>
  
  <tr>
    <td width="10%"class="jy">系统权限</td>
    <td width="20%">
		<select id="sys_role" name="sys_role">
			<option value="">==请选择系统权限==</option>
			<script>
				var tempStr = '<?php echo $sys_role ?>';
				for(var i=0; i < sys_roles.length;i++) {
					if(sys_roles[i][0] == tempStr) {
						
						document.write("<option value='" + sys_roles[i][0] + "' selected>" + sys_roles[i][1] + "</option>");
					} else {
						document.write("<option value='" + sys_roles[i][0] + "'>" + sys_roles[i][1] + "</option>");
					}
					
				}
			</script>
		</select>
	</td>
    <td style="border-left:0px;"><div id='sys_roleTip'style="width:150px"></div></td>
  </tr>
  
<?php 
	if(isHeadQuarter()) {
?>  
  <tr>
    <td width="10%"class="jy">分校机构</td>
    <td width="20%">
		<select id="branchid" name="branchid">
			<option value="">==请选择分校机构==</option>
			
			<?php
				if($branchs){
					foreach ($branchs as $branch) {
						if($branch['id'] == $branchid) {
			?>
							<option value="<?php echo $branch['id'] ?>" selected><?php echo $branch['name'] ?></option>
			<?php	
						} else {
			?>
							<option value="<?php echo $branch['id']?>"><?php echo$branch['name']?></option>
			<?php 
						}
					}
				}
			?>			
		</select>
	</td>
    <td style="border-left:0px;"><div id='branchidTip'style="width:150px"></div></td>
  </tr>	
<?php 
	}
?>
</table>
<div align="center"><a href="#" ><img src="images/submit.gif" onmouseover="this.src='images/submit-1.gif'"  onmouseout="this.src='images/submit.gif'" onclick="submit_form()">  </a></div>
		 
   </form>
</div>
</fieldset>
</div>
</body>
</html>
