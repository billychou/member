<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>培训学校综合管理系统</title>
<script src="js/add_ui.js" type="text/javascript"></script>
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
		$spendnum = "";
		$spenddate = "";
		$employeeid = "";
		$spenduse = "";
		$note = "";		
        $branchid = "";
        $updatetime = "";
        
	} else if($action == "edit") {
		$id = $_GET['id'];
		$thisclass = get_spendment_by_id($id);	
		$spendnum = $thisclass['spendnum'];
		$spenddate = $thisclass['spenddate'];
		$employeeid = $thisclass['employeeid'];
		$spenduse = $thisclass['spenduse'];
		$note = $thisclass['note'];
        $updatetime = $thisclass['updatetime'];
        $branchid = $thisclass['branchid'];
	}
	
	$employees = get_employees();
    $branches = get_branchs();
?>

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"purunit"});
	$("#branchid").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#spendnum").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#employeeid").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"请选择经办人,请确认"});	
	$("#spenddate").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"请选择权限,请确认"});	
	$("#spenduse").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"请输入用途,请确认"});		
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
					location.href = "spendment_list.php";
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
  <legend>日常支出信息</legend>
  <form action="php/activate_spendment.php" method="post" class="table_wb" id="purunit">
  <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
  <input type="hidden" name="action" id="action" value="<?php echo $action ?>"/>
<table  align="center"  cellpadding="0" cellspacing="0"   class="biaoge">
  
  <tr>
    <td width="10%"class="jy">经手人</td>
    <td width="20%">
		<select id="employeeid" name="employeeid">
			<option value="">==请选择经手人==</option>
			<?php
				if($employees){
					foreach ($employees as $employee) {
						if($employee['id'] == $employeeid) {
			?>
							<option value="<?php echo $employee['id'] ?>" selected><?php echo $employee['name'] ?></option>
			<?php	
						} else {
			?>
							<option value="<?php echo $employee['id']?>"><?php echo $employee['name']?></option>
			<?php 
						}
					}
				}
			?>			
		</select>
	</td>
   <td style="border-left:0px;"><div id='employeeidTip'style="width:150px"></div></td>
  </tr>
  
   <tr>
    <td width="10%"class="jy">分校</td>
    <td width="20%">
		<select id="branchid" name="branchid">
			<option value="">==请选择所属分校==</option>
			<?php
				if($branches){
					foreach ($branches as $branch) {
						if($branch['id'] == $branchid) {
			?>
							<option value="<?php echo $branch['id'] ?>" selected><?php echo $branch['name'] ?></option>
			<?php	
						} else {
			?>
							<option value="<?php echo $branch['id']?>"><?php echo $branch['name']?></option>
			<?php 
						}
					}
				}
			?>			
		</select>
	</td>
   <td style="border-left:0px;"><div id='branchidTip'style="width:150px"></div></td>
  </tr>
  
  <tr>
    <td width="10%"class="jy">金额</td>
    <td width="20%"><input name="spendnum" id="spendnum" type="text" value="<?php echo $spendnum ?>"  maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='spendnumTip'style="width:150px"></div></td>
  </tr>

  
  <tr >
    <td width="10%"class="jy">时间</td>
    <td width="20%"><input name="spenddate" id="spenddate" type="text" value="<?php echo $spenddate ?>"  maxlength="50" class="Wdate" onClick="WdatePicker()" /> </td>
    <td style="border-left:0px;"><div id='spenddateTip'style="width:150px"></div></td>
  </tr>
  
  <tr >
    <td width="10%"class="jy">用途</td>
    <td width="20%"><input name="spenduse" id="spenduse" type="text" value="<?php echo $spenduse ?>"  maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='spenduseTip'style="width:150px"></div></td>
  </tr>
  
   <tr >
    <td width="10%"class="jy">备注</td>
    <td width="20%"><input name="note" id="note" type="text" value="<?php echo $note ?>"  maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='noteTip'style="width:150px"></div></td>
  </tr>

</table>
<input type="submit" value="测试用的提交">
<div align="center"><a href="#" ><img src="images/submit.gif" onmouseover="this.src='images/submit-1.gif'"  onmouseout="this.src='images/submit.gif'" onclick="submit_form()">  </a></div>

   </form>
</div>
</fieldset>
</div>
</body>
</html>
