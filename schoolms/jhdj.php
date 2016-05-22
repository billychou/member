<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>培训学校综合管理系统</title>
<script src="js/suggest_ui.js" type="text/javascript"></script>
<script src="js/media/purunits.js" type="text/javascript"></script>

<!--
<?php
	include ('php/db_fns.php');
	include ('php/book_fns.php');
	include ('php/auth_check.php');
?>
-->

<?php
	$concretes=get_concrete();
?>

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"customer"});
	$("#name").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#phoneNum").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:["tel","mobile"],dataType:"enum",onError:"你输入的手机或电话格式不正确"});;
	$("#address").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#note").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#name").suggest(purunits,{dataContainer:"#purunitid"});;
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
					location.href = "customer_list.php";
				},2000)
			
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
  <legend>进货登记</legend>
  <form  action="php/activate_customer.php" method="post" class="table_wb" id="customer">
  <input type="hidden" name="action" id="action" value="save"/>
<table  align="center"   cellpadding="0" cellspacing="0"   class="biaoge">

  <tr >
    <td width="10%"class="jy">购货单位</td>
    <td width="20%"  colspan="4">
		<input name="purunitid" id="purunitid" type="hidden" />
		<input name="name" id="name" type="text" value=""  maxlength="50" style="width:99%;"/>
		<div id='suggest' class="ac_results"></div>
	</td>
    <td style="border-left:0px;"><div id='nameTip'style="width:150px"></div></td>
    </tr>
  <tr> 
  <td class="jy" width="10%">进货票号</td>
     <td><input name="phoneNum" id="phoneNum" type="text" value=""  maxlength="50" /></td>
     <td style="border-left:0px;"><div id='phoneNumTip'style="width:250px"></div></td>
       
        <td width="9%" class="jy">进货时间</td>
        <td ><input name="address" id="address" class="Wdate" type="text" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',skin:'whyGreen'})" maxlength="50" /></td>
        <td style="border-left:0px;"><div id='addressTip'style="width:150px"></div></td>
        
      </tr>
    <tr>   
    <td height="24" class="jy">水泥名称</td>
         <td><select> <option>==请选择水泥名称==</option></select></td>
         <td style="border-left:0px;"><div id='noteTip'style="width:150px;border-right:0px;"></div>   </td>
        <td width="9%" class="jy">水泥规格</td>
        <td>
			<select>
				<option value="">==请选择水泥规格==</option>
				<?php
					if($concretes){
						foreach ($concretes as $thisconcrete) {
				?>
				<option value="<?php echo $thisconcrete['concreteid']?>"><?php echo $thisconcrete['spc'] ?></option>
				<?php	
							}
					}
				?>
			</select>
		</td>
        <td style="border-left:0px;"><div id='addressTip'style="width:150px"></div></td>
       
     </tr>
       <tr>  
        <td height="24" class="jy">水泥单位</td>
         <td><input name="note" id="note" type="text" value=""  maxlength="50" />    </td>
         <td style="border-left:0px;"><div id='noteTip'style="width:150px;border-right:0px;"></div>   </td>  
            <td width="9%" class="jy">进货数量<span class="hx"></spaaan></td>
            <td ><input name="address" id="address" type="text" value=""  maxlength="50" /></td>
            <td style="border-left:0px;"><div id='addressTip'style="width:150px"></div></td>
            
        </tr>
        <tr>    
       		 <td height="24" class="jy">进货价格</td>
             <td><input name="note" id="note" type="text" value=""  maxlength="50" />    </td>
             <td style="border-left:0px;"><div id='noteTip'style="width:150px;border-right:0px;"></div>   </td>
            <td width="9%" class="jy">进货金额<span class="hx"></spaaan></td>
            <td ><input name="address" id="address" type="text" value=""  maxlength="50" /></td>
            <td style="border-left:0px;"><div id='addressTip'style="width:150px"></div></td>
         </tr>
         <tr>
             <td height="24" class="jy">备注信息</td>
             <td colspan="4"><input name="note" id="note" type="text" value=""  maxlength="50" style="width:99%;"/>    </td>
             <td style="border-left:0px;"><div id='noteTip'style="width:150px;border-right:0px;"></div>   </td>      
           </tr>
     
</table>
<div align="center"><a href="#" ><img src="images/submit.gif" onmouseover="this.src='images/submit-1.gif'"  onmouseout="this.src='images/submit.gif'" onclick="submit_form()">  </a></div>
   </form>
</fieldset>
</div>
</body>
</html>
