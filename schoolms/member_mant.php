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
		$cardnum = "";
		$classid = "";
		$applyat = gmdate('Y-m-d', time() + 3600 * 8);
		$contact = "";
		$name = "";
		$gender = "";
		$qq = "";
		$creditnum = "";
		$address = "";
		$education = "";
		$book = "";
		$note = "";
		$paynum = "";
        $majorid = "";
        $operatorid = "";
        $jobtitle = "";
	} else if($action == "edit") {
		$id = $_GET['id'];
		$thismember = get_member_by_id($id);
		$cardnum = $thismember["cardnum"];
		$classid = $thismember["classid"];
		$applyat = $thismember["applyat"];
		$contact = $thismember["contact"];
		$name = $thismember["name"];
		$gender = $thismember["gender"];
		$qq = $thismember["qq"];
		$creditnum = $thismember["creditnum"];
		$address = $thismember["address"];
		$education = $thismember["education"];
		$book = $thismember["book"];
		$paynum = $thismember["paynum"];
		$note = $thismember["note"];
        $jobtitle= $thismember["jobtitle"];
        
        $majorid = $thismember["majorid"];
        $classid = $thismember["classid"];
        $operatorid = $thismember["operatorid"];
	}
	$majors = get_majors();
    $classes = get_classes();
    $operators = get_employees();
?>

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"customer"});
	$("#majorid").formValidator({onFocus:"请选择",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#cardnum").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#classid").formValidator({onFocus:"请选择",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"请选择班级"});
	$("#applyat").formValidator({onFocus:"请选择",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#name").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#contact").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#gender").formValidator({onFocus:"请选择",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	//$("#qq").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#creditnum").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#address").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	//$("#education").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	//$("#book").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#paynum").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	//$("#note").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});

	$("#majorid").change(function(){
		var majorid = $(this).val();
		if(majorid != '') {
			htmlObj = $.ajax({ 
				url: "php/activate_class.php", 
				type:"POST", 
				data:{"action":"select","majorid":$(this).val()}, 
				success: function(data){
					var tempStr = "<option value=''>====请选择班级====</option>";
					$("#classid").html('').append(tempStr).val('');
					var jsonObj = eval("("+data+")");//转换为json对象
					if(jsonObj[0]) {
						var tempStr = getOption(jsonObj);
						$("#classid").append(tempStr);
					} else {
						var tempStr = "<option value=''>====请选择班级====</option>";
						$("#classid").html('').append(tempStr).val('');
						var pop=new Pop("注意：",
							"该专业下还没有建立班级，请重新确认！"
						);
						return false;
					}
				}
			});
		} else {
			var tempStr = "<option value=''>====请选择班级====</option>";
			$("#classid").html('').append(tempStr).val('');
		}
	});
});

function getOption(arr) {
	var tempStr="";
	for(var i = 0; i < arr.length ; i++) {
		tempStr += "<option value='" + arr[i]['id'] + "'>" + arr[i]['classname'] + "</option>";				
	}
	return tempStr;	
}

function submit_form() {
	if ($.formValidator.pageIsValid('1')==true) {  //如果校验成功，则提交表单，如果校验不成功则 return false	 
		$('#customer').ajaxSubmit(function(data){ //利用jquery.form中的方法 用ajax方式提交表单
			var jsonObj = eval("("+data+")");//转换为json对象 
			
			if(jsonObj.code == 1) {
				var pop=new Pop("操作成功",
				jsonObj.info
				);
				
				setTimeout(function(){
					location.href = "member_list.php";
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
  <legend>维护学员信息</legend>
  <form  action="php/activate_member.php" method="post" class="table_wb" id="customer">
  <input type="hidden" name="id" id="id" value="<?php echo $id ?>"/>
  <input type="hidden" name="action" id="action" value="<?php echo $action ?>"/>
  <table align="center" cellpadding="0" cellspacing="0" class="biaoge">
	<tr>
		<td width="9%" class="jy">专业类别</td>
        <td >
			<select id="majorid" name="majorid">
				<option value="">==请选择专业类别==</option>
				<?php
					if($majors){
						foreach ($majors as $major) {
							if($major['id'] == $majorid) {
				?>
                    <option value="<?php echo $major['id'] ?>" selected>
                        <?php echo $major['name'] ?>
                    </option>
				<?php	
							} else {
				?>
								<option value="<?php echo $major['id']?>">
                                    <?php echo $major['name']?>
                                </option>
				<?php 
							}
						}
					}
				?>			
			</select>
		</td>
         <td style="border-left:0px;"><div id='majoridTip'style="width:150px"></div></td>
		 <td width="9%" class="jy">班级</td>
        <td >
			<select id="classid" name="classid">
				<option value="">====请选择班级====</option>
				
				<?php
					if($classes){
						foreach ($classes as $class) {
							if($class['id'] == $classid) {
				?>
								<option value="<?php echo $class['id'] ?>" selected>
                                    <?php echo $class['classname'] ?>
                                </option>
				<?php	
							} else {
				?>
								<option value="<?php echo $class['id']?>">
                                    <?php echo $class['classname'] ?>
                                </option>
				<?php 
							}
						}
					}
				?>			
			</select>
		</td>
         <td style="border-left:0px;"><div id='classidTip'style="width:150px"></div></td>
	</tr>
	<tr>    
        <td width="9%" class="jy">报名日期</td>
        <td>
            <input name="applyat" id="applyat" type="text" value="<?php echo $applyat?>"  maxlength="50" readonly='true' class="Wdate" onClick="WdatePicker()" />
        </td>
        <td style="border-left:0px;">
            <div id='applyatTip'style="width:150px"></div>
        </td>
        <td width="9%" class="jy">听课证编号</td>
        <td>
			<input name="cardnum" id="cardnum" type="text" value="<?php echo $cardnum?>"  maxlength="50" />
		</td>
        <td style="border-left:0px;"><div id='cardnumTip'style="width:150px"></div></td>       
              
    </tr>
	<tr><td colspan="6" height="10px" >&nbsp;</td></tr>
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
	<tr>      
        <td height="24" class="jy">QQ:</td>
        <td><input name="qq" id="qq" type="text" value="<?php echo $qq?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='qqTip'style="width:150px"></div></td>        
    	<td width="9%" class="jy">单位或地址</td>
        <td><input name="address" id="address" type="text" value="<?php echo $address?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='addressTip'style="width:150px"></div></td>    
	</tr>
	<tr>  
		<td height="24" class="jy">学历</td>
        <td><input name="education" id="education" type="text" value="<?php echo $education?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='educationTip'style="width:150px"></div></td>             
		<td width="9%" class="jy">备注</td>
        <td><input name="note" id="note" type="text" value="<?php echo $note?>"  maxlength="50"  /></td>
        <td style="border-left:0px;"><div id='noteTip'style="width:150px"></div></td>     
	</tr>	   
	<tr>  
		            
		<td width="9%" class="jy">书目</td>
        <td><input name="book" id="book" type="text" value="<?php echo $book?>"  maxlength="50"  /></td>
        <td style="border-left:0px;"><div id='bookTip'style="width:150px"></div></td>        	  
	</tr>  
    
    
    <tr><td colspan="6" height="10px" >&nbsp;</td></tr>
		<tr>    
        <td width="9%" class="jy">职别</td>
        <td><input name="jobtitle" id="jobtitle" type="text" value="<?php echo $jobtitle?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='jobtitleTip'style="width:150px"></div></td>
        <td width="9%" class="jy">经办人</td>
        <td>
			<select id="operatorid" name="operatorid">
				<option value="">====请选择经办人====</option>
				
				<?php
					if($operators){
						foreach ($operators as $employee) {
							if($employee['id'] == $operatorid) {
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
              
    </tr>
</table>

   <!-- <input type='submit' value='提交' /> -->
    <div align="center">
        <a href="#">
            <img src="images/submit.gif" onmouseover="this.src='images/submit-1.gif'" onmouseout="this.src='images/submit.gif'" onclick="submit_form()">
        </a>
    </div>
  </form>
</fieldset>
</div>
</body>
</html>
