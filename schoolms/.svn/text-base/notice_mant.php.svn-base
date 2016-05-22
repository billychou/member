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
		$title = "";
		$body = "";
		$validays = "";
        $adminid = "";
	} else if($action == "edit") {
		$id = $_GET['id'];
		$thisnotice = get_notice_by_id($id);		
		$id = $thisnotice['id'];
		$title = $thisnotice['title'];
		$body = $thisnotice['body'];
		$validays = $thisnotice['validays'];
        $adminid = $thisnotice['adminid'];
	}
    $operators = get_employees();
?>

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"purunit"});
	$("#title").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#body").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#validays").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
    $("#adminid").formValidator({onFocus:"不能为空",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});

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
					location.href = "notice_list.php";
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
  <legend>维护系统公告</legend>
  <form action="php/activate_notice.php" method="post" class="table_wb" id="purunit">
  <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
  <input type="hidden" name="action" id="action" value="<?php echo $action ?>"/>
<table  align="center"   cellpadding="0" cellspacing="0"   class="biaoge">

  <tr >
    <td width="10%"class="jy">公告标题</td>
    <td width="20%"><input name="title" id="title" type="text" value="<?php echo $title ?>"  maxlength="50" /> </td>
    <td style="border-left:0px;"><div id='titleTip'style="width:150px"></div></td>
  </tr>
  
  <tr>
    
	<td width="10%"class="jy">有效期</td>
    <td width="20%">
			<select id="validays" name="validays">
			<option value="">==请选择有效期==</option>
			<script>
				var tempStr = '<?php echo $validays ?>';
				for(var i=0; i < validays.length;i++) {
					if(validays[i][0] == tempStr) {
						
						document.write("<option value='" + validays[i][0] + "' selected>" + validays[i][1] + "</option>");
					} else {
						document.write("<option value='" + validays[i][0] + "'>" + validays[i][1] + "</option>");
					}
					
				}
			</script>
		</select>
	</td>
    <td style="border-left:0px;"><div id='validaysTip'style="width:150px"></div></td>
  </tr>
  
  <tr >
    <td width="10%"class="jy">公告正文</td>
    <td width="20%" cols="2">
		&nbsp;&nbsp;<textarea name="body" id="body" cols="80" rows="5"><?php echo $body ?></textarea>
	</td>
    <td style="border-left:0px;"><div id='bodyTip'style="width:150px"></div></td>
  </tr>
  
   <td width="9%" class="jy">发布人</td>
        <td>
			<select id="adminid" name="adminid">
				<option value="">====请选择发布人====</option>
				
				<?php
					if($operators){
						foreach ($operators as $employee) {
							if($employee['id'] == $adminid) {
				?>
								<option value="<?php echo $employee['id'] ?>" selected>
                                    <?php echo $employee['name'] ?>
                                </option>
				<?php	
							} else {
				?>
								<option value="<?php echo $employee['id']?>">
                                    <?php echo $employee['name'] ?>
                                </option>
				<?php 
							}
						}
					}
				?>			
			</select>
		</td>
        <td style="border-left:0px;"><div id='operatoridTip'style="width:150px"></div></td>   

</table>

<input type="submit" value="提交"/>
<div align="center"><a href="#" ><img src="images/submit.gif" onmouseover="this.src='images/submit-1.gif'"  onmouseout="this.src='images/submit.gif'" onclick="submit_form()">  </a></div>
		 
   </form>
</div>
</fieldset>
</div>
</body>
</html>
