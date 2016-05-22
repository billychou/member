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
        if ($action == "save"){
            $id = "";
            $paynum = "";
            $cardnum = "";
            $paytime = "";
            $note = "";
            $operatorid = "";
            $updatetime = "";
            $memberid = "";
        }
        else if($action="edit"){
            $id = $_GET['id'];
            $thispayment = get_payment_by_id($id);
            $paynum = $thispayment["paynum"];
            $cardnum = $thispayment["cardnum"];
            $paytime = $thispayment["paytime"];
            $note = $thispayment["note"];
            $operatorid = $thispayment["operatorid"];
            $updatetime = $thispayment["updatetime"];
            $memberid =   $thispayment["memberid"];    
        }
        
        $members = get_members();
        $employees = get_employees();
?>

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"customer"});
    $("#operatorid").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
    $("#paynum").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
    $("#cardnum").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
});

function submit_form() {
    if ($.formValidator.pageIsValid('1')==true) { 
		if($("#paynum").val() == '' || isNaN($("#paynum").val())) {
			alert('缴费金额必须是数字');
			return false;
		}
        
		$('#customer').ajaxSubmit(function(data){ 
            //利用jquery.form中的方法,用ajax方式提交表单
			var jsonObj = eval("("+data+")");//转换为json对象 
			if(jsonObj.code == 1) {
				var pop=new Pop("操作成功",
				jsonObj.info
				);			
				setTimeout(function(){
					location.href = "payment_list.php";
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

 <fieldset> 
  <legend>学员缴费信息</legend>
  <form  action="php/activate_payment.php" method="post" class="table_wb" id="customer">
  <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
  <input type="hidden" name="memberid" id="memberid" value="<?php echo $memberid ?>"/>
  <input type="hidden" name="action" id="action" value="<?php echo $action?>"/>
  <table align="center" cellpadding="0" cellspacing="0" class="biaoge">
  <tr>
    <td width="10%"class="jy">经手人</td>
    <td width="20%">
		<select id="operatorid" name="operatorid">
			<option value="">==请选择经手人==</option>
			<?php
				if($employees){
					foreach ($employees as $employee) {
						if($employee['id'] == $operatorid) {
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
    <td style="border-left:0px;">
        <div id='operatoridTip'style="width:150px">
        </div>
    </td>
    
    <td width="10%" class="jy">听课证编号</td>
    <td width="20%">
		<select id="cardnum" name="cardnum">
			<option value="">==请选择听课证编号==</option>
			<?php
				if($members){
					foreach ($members as $member) {
						if($member['id'] == $memberid) {
			?>
							<option value="<?php echo $member['cardnum'] ?>" selected><?php echo $member['cardnum'] ?></option>
			<?php	
						} else {
			?>
							<option value="<?php echo $member['cardnum']?>"><?php echo $member['cardnum']?></option>
			<?php 
						}
					}
				}
			?>			
		</select>
	</td>
    <td style="border-left:0px;"><div id='cardnumTip'style="width:150px"></div></td>
   </tr>
   <tr>
        <td width="10%" class="jy">缴费数目</td>
        <td width="20%">
          <input name="paynum" id="paynum" type="text" value="<?php echo $paynum ?>"  maxlength="50" /> </td>  
        </td>
        <td style="border-left:0px;"><div id='paynumTip'style="width:150px"></div></td> 
        
        
        <td width="10%" class="jy">缴费时间</td>
        <td width="20%">
          <input name="paytime" id="paytime" type="text" value="<?php echo $paytime ?>"  maxlength="50" class="Wdate" onClick="WdatePicker()" /> </td>  
        </td>
        <td style="border-left:0px;">
        <div id='paytimeTip'style="width:150px"></div>
        </td>     
        
   </tr>
   <tr>
        <td width="10%" class="jy">备注</td>
        <td width="20%">
          <input name="note" id="note" type="text" value="<?php echo $note ?>"  maxlength="50" /> </td>  
        </td>
        <td style="border-left:0px;">
        <div id='noteTip'style="width:150px"></div>
        </td>     
   </tr>
</table>
<!--<input type="submit" value="测试" />-->
    <div align="center">
        <a href="#" >
            <img src="images/submit.gif" onmouseover="this.src='images/submit-1.gif'" onmouseout="this.src='images/submit.gif'" onclick="submit_form()">
        </a>
    </div>  
</form>
</fieldset>
</div>
</body>
</html>
