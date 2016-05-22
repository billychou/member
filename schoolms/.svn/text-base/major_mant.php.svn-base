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
		$name = "";
		$note = "";
	} else if($action == "edit") {
		$id = $_GET['id'];
		$thismajor = get_major_by_id($id);		
		$id = $thismajor['id'];
		$name = $thismajor['name'];
		$note = $thismajor['note'];
	}
	
?>

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"purunit"});
	$("#name").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#owner").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#note").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	
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
					location.href = "major_list.php";
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
  <legend>维护专业信息</legend>
  <form action="php/activate_major.php" method="post" class="table_wb" id="purunit">
  <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
  <input type="hidden" name="action" id="action" value="<?php echo $action ?>"/>
<table  align="center"   cellpadding="0" cellspacing="0"   class="biaoge">
  <tr >
    <td width="10%"class="jy">专业名称</td>
    <td width="20%"><input name="name" id="name" type="text" value="<?php echo $name ?>"  maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='nameTip'style="width:150px"></div></td>
  </tr>
  <tr >
    <td width="10%"class="jy">备注</td>
    <td width="20%"><input name="note" id="note" type="text" value="<?php echo $note ?>"  maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='noteTip'style="width:150px"></div></td>
  </tr>

</table>
<div align="center"><a href="javascript:void(0)" ><img src="images/submit.gif" onmouseover="this.src='images/submit-1.gif'"  onmouseout="this.src='images/submit.gif'" onclick="submit_form()">  </a></div>
		 
   </form>
</div>
</fieldset>
</div>
</body>
</html>
