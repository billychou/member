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
    $action=$_GET['action'];
	if($action == "save") {
		$id = "";
		$name = "";
        $address = "";
		$gender = "";
        $nation = "";
        $politics = "";
        $native = "";
        $creditnum = "";
        $mobilenum = "";
        $phonenum = "";
        $qqnum = "";
        $email = "";
        $education = "";
        $graduateschool = "";
        $company = "";
        $positionaltitle = "";
        $title = "";
        $doctorscores = "";
        $docregtime = "";
		$booktime = "";
        $trainedtime="";
        $branchid="";	
        $classid="";
        $updatetime=gmdate('Y-m-d', time() + 3600 * 8);
               
	} else if($action == "edit") {
		$id = $_GET['id'];
		$thismember = get_vip_member_by_id($id);
        
        $id = $thismember["id"];
		$name = $thismember["name"];
		$gender = $thismember["gender"];
        $nation = $thismember["nation"];
        $politics = $thismember["politics"];
        $native = $thismember["native"];
        $creditnum = $thismember["creditnum"];
        $mobilenum = $thismember["mobilenum"];
        $phonenum = $thismember["phonenum"];
        $qqnum = $thismember["qqnum"];
        $email = $thismember["email"];
        $education = $thismember["education"];
        $graduateschool = $thismember["graduateschool"];
        $company = $thismember["company"];
        $positionaltitle = $thismember["positionaltitle"];
        $title = $thismember["title"];
        $doctorscores = $thismember["doctorscores"];
        $docregtime = $thismember["docregtime"];
        $address = $thismember["address"];
		$booktime = $thismember["booktime"];
        $trainedtime = $thismember["trainedtime"];
        $branchid = $thismember["branchid"];
        $classid = $thismember["classid"];
	}
    $branches = get_branchs();
    $classes = get_classes();
?>

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"vip"});
	$("#name").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#gender").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#creditnum").formValidator({onFocus:"请选择",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"请选择班级"});
	$("#nation").formValidator({onFocus:"请选择",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#native").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
    $("#branchid").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#mobilenum").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:["tel","mobile"],dataType:"enum",onError:"电话格式不正确"});;
	$("#politics").formValidator({onFocus:"请选择",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#qqnum").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#company").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});   
	$("#email").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#address").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#education").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#graduateschool").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#positionaltitle").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#title").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#doctorscores").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#docregtime").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#booktime").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#trainedtime").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});

    //$("#").formValidator({onFocus:"请输入",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
});

function getOption(arr) {
	var tempStr="";
	for(var i = 0; i < arr.length ; i++) {
		tempStr += "<option value='" + arr[i]['id'] + "'>" + arr[i]['classname'] + "</option>";				
	}
	return tempStr;	
}

function submit_form() {
    alert("提交到submit");
	if ($.formValidator.pageIsValid('1')==true) {  //如果校验成功，则提交表单，如果校验不成功则 return false 
		$('#vip').ajaxSubmit(function(data){ //利用jquery.form中的方法 用ajax方式提交表单
			var jsonObj = eval("("+data+")");//转换为json对象 
			if(jsonObj.code == 1) {
				var pop=new Pop("操作成功",
				jsonObj.info
				);
				setTimeout(function(){
					location.href = "vip_member_list.php";
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
  <legend>维护红友会信息</legend>
  <form action="php/activate_vip_member.php" method="post" class="table_wb" id="vip">
  <input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
  <input type="hidden" name="action" id="action" value="<?php echo $action ?>" />
  <table align="center" cellpadding="0" cellspacing="0" class="biaoge">

    <tr>
        <td width="9%" class="jy">分校</td>
        <td >
			<select id="branchid" name="branchid">
				<option value="">====请选择分校====</option>				
				<?php
					if($branches){
						foreach ($branches as $branch) {
							if($branch['id'] == $branchid) {
				?>
								<option value="<?php echo $branch['id'] ?>" selected>
                                    <?php echo $branch['name'] ?>
                                </option>
				<?php	
							} else {
				?>branch
								<option value="<?php echo $branch['id']?>">
                                    <?php echo $branch['name'] ?>
                                </option>
				<?php 
							}
						}
					}
				?>			
			</select>
		</td>
        <td style="border-left:0px;"><div id='branchTip'style="width:150px"></div></td>
        <td width="9%" class="jy">班级</td>
        <td>
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
	<tr><td colspan="6" height="10px" >&nbsp;</td></tr>
		<tr>    
        <td width="9%" class="jy">姓名</td>
        <td>
            <input name="name" id="name" type="text" value="<?php echo $name?>"  maxlength="50" />
        </td>
        <td style="border-left:0px;">
            <div id='nameTip'style="width:150px"></div>
        </td>
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
        <td style="border-left:0px;">
            <div id='genderTip'style="width:150px"></div>
        </td>          
    </tr>  
     
	
    <tr>      
        <td width="9%" class="jy">政治面貌</td>
        <td>
            <input name="politics" id="politics" type="text" value="<?php echo $politics?>" />
		</td>
        <td style="border-left:0px;"><div id='politicsTip'style="width:150px"></div></td>
        <td width="9%" class="jy">民族</td>
        <td>
            <input name="nation" id="nation" type="text" value="<?php echo $nation ?>" />
		</td>
		<td style="border-left:0px;"><div id='nationTip'style="width:150px"></div></td>
    	
	</tr>
    <tr>      
        <td height="24" class="jy">籍贯</td>
        <td><input name="native" id="native" type="text" value="<?php echo $native?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='nativeTip'style="width:150px"></div></td>        
    	 
        <td height="24" class="jy">身份证号</td>
        <td><input name="creditnum" id="creditnum" type="text" value="<?php echo $creditnum?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='creditnumTip'style="width:150px"></div></td> 
	</tr>
	

    <tr><td colspan="6" height="10px" >&nbsp;</td></tr>
    
    <tr>
        <td width="9%" class="jy">手机号码</td>
        <td><input name="mobilenum" id="mobilenum" type="text" value="<?php echo $mobilenum?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='mobilenumTip'style="width:150px"></div></td>  
         <td width="9%" class="jy">固话</td>
        <td><input name="phonenum" id="phonenum" type="text" value="<?php echo $mobilenum?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='phonenumTip'style="width:150px"></div></td>
    </tr>
	<tr>      
        <td height="24" class="jy">QQ</td>
        <td><input name="qqnum" id="qqnum" type="text" value="<?php echo $qqnum?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='qqnumTip'style="width:150px"></div></td>        
    	<td width="9%" class="jy">工作单位</td>
        <td><input name="company" id="company" type="text" value="<?php echo $company?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='companyTip'style="width:150px"></div></td>    
	</tr>
    
    <tr>      
        <td height="24" class="jy">Email</td>
        <td><input name="email" id="email" type="text" value="<?php echo $email?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='emailTip'style="width:150px"></div></td>        
    	<td width="9%" class="jy">通讯地址</td>
        <td><input name="address" id="address" type="text" value="<?php echo $address?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='addressTip'style="width:150px"></div></td>    
	</tr>
	<tr>  
		<td height="24" class="jy">学历</td>
        <td><input name="education" id="education" type="text" value="<?php echo $education?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='educationTip'style="width:150px"></div></td>             
		<td width="9%" class="jy">毕业学校</td>
        <td><input name="graduateschool" id="graduateschool" type="text" value="<?php echo $graduateschool?>"  maxlength="50"  /></td>
        <td style="border-left:0px;"><div id='graduateschoolTip'style="width:150px"></div></td>     
	</tr>
    <tr><td colspan="6" height="10px" >&nbsp;</td></tr>
	<tr>  
		<td height="24" class="jy">医师职称</td>
        <td><input name="positionaltitle" id="positionaltitle" type="text" value="<?php echo $positionaltitle?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='positionaltitleTip'style="width:150px"></div></td>             
		<td width="9%" class="jy">职务</td>
        <td><input name="title" id="title" type="text" value="<?php echo $title?>"  maxlength="50"  /></td>
        <td style="border-left:0px;"><div id='titleTip'style="width:150px"></div></td>     
	</tr>
    	<tr>  
		<td height="24" class="jy">执业医师考试分数</td>
        <td><input name="doctorscores" id="doctorscores" type="text" value="<?php echo $doctorscores?>"  maxlength="50" /></td>
        <td style="border-left:0px;"><div id='doctorscoresTip'style="width:150px"></div></td>             
		<td width="9%" class="jy">执业注册时间</td>
        <td><input name="docregtime" id="docregtime" type="text" value="<?php echo $docregtime?>"  maxlength="50" readonly='true' class="Wdate" onClick="WdatePicker()" /></td>
        <td style="border-left:0px;"><div id='docregtimeTip'style="width:150px"></div></td>     
	</tr>
    
    <tr>  
		<td height="24" class="jy">购买红宝书时间</td>
        <td>
            <input name="booktime" id="booktime" type="text" value="<?php echo $booktime?>"  maxlength="50" readonly='true' class="Wdate" onClick="WdatePicker()" />
        </td>
        <td style="border-left:0px;">
            <div id='booktimeTip'style="width:150px">
            </div>
        </td>             
		<td width="9%" class="jy">参加培训时间</td>
        <td><input name="trainedtime" id="trainedtime" type="text" value="<?php echo $trainedtime?>"  maxlength="50" readonly='true' class="Wdate" onClick="WdatePicker()" /></td>
        <td style="border-left:0px;"><div id='trainedtimeTip'style="width:150px"></div></td>     
	</tr>
</table>
<input type="submit" value="测试提交">
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
