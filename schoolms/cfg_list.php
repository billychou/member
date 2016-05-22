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

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"purunit"});
	$("#account_id").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#username").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#password").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#sys_role").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"请选择权限,请确认"});
	$("#biz_role").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"请选择权限,请确认"});
	
	htmlObj = $.ajax({ 
		url: "php/activate_config.php", 
		type:"POST", 
		data:{"action":"get"}, 
		success: function(data){
			var jsonObj = eval("("+data+")");//转换为json对象 
			if(jsonObj.code == 1) {
				$("#companyname").html(jsonObj.companyname);
				$("#marktext").html(jsonObj.marktext);
				$("#updatetime").html(jsonObj.updatetime);
				$("#operator").html(jsonObj.operator);
			} else {
				alert("sb");
				var pop=new Pop("操作失败",
				jsonObj.info
				);
				return false;
			}
		}
	});
						
	
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
  <legend>系统参数
  <?php
		if(canAdm()) {
	?>
	&nbsp;&nbsp;
	<a href="cfg_mant.php"><img src="images/edit.png" title="修改信息" border="0" id="edit_btn"/></a>
	<?php
		}
	?>
  </legend>
<table  align="center"   cellpadding="0" cellspacing="0"   class="biaoge">

  <tr >
    <td width="10%"class="jy">公司名称</td>
    <td width="20%">&nbsp;&nbsp;<span id="companyname"></span></td>
    <td style="border-left:0px;"><div id='companynameTip'style="width:150px"></div></td>
  </tr>
  <tr >
    <td width="10%"class="jy">单据水印</td>
    <td width="20%">&nbsp;&nbsp;<span id="marktext"></span></td>
    <td style="border-left:0px;"><div id='marktextTip'style="width:150px"></div></td>
  </tr>
  
  <tr >
    <td width="10%"class="jy">上次更新时间</td>
    <td width="20%">&nbsp;&nbsp;<span id="updatetime"></span></td>
    <td style="border-left:0px;">&nbsp;</td>
  </tr>
   <tr >
    <td width="10%"class="jy">上次操作者</td>
    <td width="20%">&nbsp;&nbsp;<span id="operator"></span></td>
    <td style="border-left:0px;">&nbsp;</td>
  </tr>

</table>
</div>
</fieldset>
</div>
</body>
</html>
