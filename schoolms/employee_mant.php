<?php
    session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>培训学校综合管理系统</title>
<script src="js/suggest_ui.js" type="text/javascript"></script>
<script src="js/constants.js" type="text/javascript"></script>
<script src="js/ignoreBackspace.js" type="text/javascript"></script>
<script src='js/datepicker/WdatePicker.js' type='text/javascript' charset='uft-8'></script>
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
		$branchid = "";
		$name = "";
		$gender = "";
		$title = "";
		$creditnum = "";
		$contact = "";
		$onbroadtime = "";
	} else if($action == "edit") {
		$id = $_GET['id'];
		$thisemployee=get_employee_by_id($id);
		$id = $thisemployee['id'];
		$branchid = $thisemployee['branchid'];
		$name = $thisemployee['name'];
		$gender = $thisemployee['gender'];
		$title = $thisemployee['title'];
		$creditnum = $thisemployee['creditnum'];
		$contact = $thisemployee['contact'];
		$onbroadtime = $thisemployee['onbroadtime'];
	}
	$branchs = get_branchs();
?>

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"customer"});
	$("#name").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#gender").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"请选择性别"});
	$("#title").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#creditnum").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#contact").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:["tel","mobile"],dataType:"enum",onError:"电话格式不正确"});;
	$("#onbroadtime").formValidator({onFocus:"请选择日期",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	<?php 
		if(isHeadQuarter()) {
	?>
		$("#branchid").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"请选择分校机构"});		
	<?php
		}
	?>				
});


function submit_form() {

	if ($.formValidator.pageIsValid('1')==true) {  //如果校验成功，则提交表单，如果校验不成功则 return false
		 
		$('#customer').ajaxSubmit(function(data){ //利用jquery.form中的方法 用ajax方式提交表单
			var jsonObj = eval("("+data+")");//转换为json对象 
			
			if(jsonObj.code == 1) {
				var pop=new Pop("操作成功",
				jsonObj.info
				);
				
				setTimeout(function(){
					location.href = "employee_list.php";
				},1000)
			
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

 <fieldset> 
  <legend>维护员工信息</legend>
  <form  action="php/activate_employee.php" method="post" class="table_wb" id="customer">
  <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
  <input type="hidden" name="action" id="action" value="<?php echo $action ?>"/>
<table  align="center"   cellpadding="0" cellspacing="0"   class="biaoge">
	<?php 
		if(isHeadQuarter()) {
	?>  
	<tr>
		<td width="9%" class="jy">分校机构</td>
        <td >
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
		 <td style="border-left:0px;" colspan='3'>&nbsp;</td> 
	</tr>
	<?php 
		}
	?>
	<tr>    
        <td width="9%" class="jy">姓名</td>
        <td><input name="name" id="name" type="text" value="<?php echo $name?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='nameTip'style="width:150px"></div></td>
        <td width="9%" class="jy">性别</td>
        <td>
			<select id="gender" name="gender">
			<option value="">====请选择性别====</option>
			<script>
				var tempStr1 = '<?php echo $gender ?>';
				for(var i=0; i < genders.length;i++) {
					if(genders[i][0] == tempStr1) {
						document.write("<option value='" + genders[i][0] + "' selected>" + genders[i][1] + "</option>");
					} else {
						document.write("<option value='" + genders[i][0] + "'>" + genders[i][1] + "</option>");
					}
				}
			</script>
		</select>
		</td>
        <td style="border-left:0px;"><div id='genderTip'style="width:150px"></div></td>       
              
    </tr>
	
    <tr>      
        <td height="24" class="jy">证件号码</td>
        <td><input name="creditnum" id="creditnum" type="text" value="<?php echo $creditnum?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='creditnumTip'style="width:150px"></div></td>        
    	<td width="9%" class="jy">联系方式</td>
        <td><input name="contact" id="contact" type="text" value="<?php echo $contact?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='contactTip'style="width:150px"></div></td>    
	</tr>
	<tr><td colspan="6" height="10px" >&nbsp;</td></tr>
	<tr>  
		<td height="24" class="jy">职位</td>
        <td><input name="title" id="title" type="text" value="<?php echo $title?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='titleTip'style="width:150px"></div></td>             
		<td width="9%" class="jy">入职时间</td>
        <td><input name="onbroadtime" id="onbroadtime" type="text" value="<?php echo $onbroadtime?>"  maxlength="50"  readonly='true' class="Wdate" onClick="WdatePicker()" /></td>
        <td style="border-left:0px;"><div id='onbroadtimeTip'style="width:150px"></div></td>        	  
	</tr>
       
</table>


<div align="center"><a href="#" ><img src="images/submit.gif" onmouseover="this.src='images/submit-1.gif'"  onmouseout="this.src='images/submit.gif'" onclick="submit_form()">  </a></div>
   </form>
</fieldset>
</div>
</body>
</html>
