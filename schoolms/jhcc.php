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
<script src="js/ignoreBackspace.js" type="text/javascript"></script>
<script>
	document.write("<script src='js/media/purunits.js?rnd= " + Math.random() + " '></s" + "cript> " );
	document.write("<script src='js/media/customers.js?rnd= " + Math.random() + " '></s" + "cript> " );
	document.write("<script src='js/media/drivers.js?rnd= " + Math.random() + " '></s" + "cript> " );
	document.write("<script src='js/media/traunits.js?rnd= " + Math.random() + " '></s" + "cript> " );
</script>
<!--
<?php
	include ('php/db_fns.php');
	include ('php/book_fns.php');
        include ('php/auth_check.php');
        include ('php/get_count_num.php');
?>
-->
<?php
        
    //$action = $_GET['action'];
	$action = "save";
	if($action == "save") {
		$id = "";
		$name = "";
		$listindex = "";
		$time = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
		$concreteid = "";
		$unit = "";
		$initvalue = "";
		$cost = "";
		$purchaseprice = "";
		$note = "";
		$purunit = "";
		$purunitid = "";
		$purunitname = "";
	} else if($action == "edit") {
		$id = $_GET['id'];
		$thisimport=get_importlist_info_by_id($id);
		$listindex = $thisimport['listindex'];
                $time = $thisimport['updatetime'];
                $concreteid = $thisimport['concreteid'];
		$unit = $thisimport['unit'];
                $initvalue = $thisimport['initvalue'];
                $purchaseprice = $thisimport['purchaseprice'];
                $cost = (float)$initvalue * (float)$purchaseprice;             
		$note = $thisimport['note'];
		$purunitid = $thisimport['purunitid'];		
		$purunit = get_purunit_info_by_id($thisimport['purunitid']);
		$purunitname = $purunit['name'];

	}

?>

<script type="text/javascript">
$(function(){
	$.formValidator.initConfig({formID:"customer"});
	$("#name").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#drivername").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#traunitname").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#phoneNum").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:["tel","mobile"],dataType:"enum",onError:"你输入的手机或电话格式不正确"});;
	$("#importlistindex").formValidator({onFocus:"请选择票号",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#note").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
			
	$("#fhsl").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:"num1",dataType:"enum",onError:"数字格式不正确"}).functionValidator({
	    fun:function(val,elem){
	        if(val <= parseFloat($("#factoryvalue").val())){
			    return true;
		    }else{
			    return "不能大于提货初值"
		    }
		}
	});;
	<?php
			if(!isLog()) {
	?>	
		$("#cpdj").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:"num1",dataType:"enum",onError:"数字格式不正确"});
		$("#driverprice").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:"num1",dataType:"enum",onError:"数字格式不正确"});
		$("#payment").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:"num1",dataType:"enum",onError:"数字格式不正确"});

		$("#cyjg").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:"num1",dataType:"enum",onError:"数字格式不正确"});
		$("#fcjg").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:"num1",dataType:"enum",onError:"数字格式不正确"});
	<?php
			} else {
	?>
		$("#driverprice").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:"num1",dataType:"enum",onError:"数字格式不正确"});
		$("#shipprice").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"}).regexValidator({regExp:"num1",dataType:"enum",onError:"数字格式不正确"});

	<?php
			}
	?>
	
	$("#customername").formValidator({onFocus:"至少1个长度",onCorrect:"输入合法"}).inputValidator({min:1,empty:{leftEmpty:false,rightEmpty:false,emptyError:"两边不能有空符号"},onError:"不能为空,请确认"});
	$("#customername").suggest(customers,{hot_list:customers,dataContainer:"#customerid"});
	$("#name").suggest(purunits,{hot_list:purunits,dataContainer:"#purunitid"});
	$("#drivername").suggest(drivers,{hot_list:drivers,dataContainer:"#driverid"});
	
	$("#traunitname").suggest(traunits,{hot_list:traunits,dataContainer:"#traunitid"});
	
	$("#name").change(function(){
		$("#purunitid").val("").change();
	});
	$("#purunitid").change(function(){
		
		//初始化票号1的select选项
		$("#importlistindex").val("").html("<option value=''>====请选择提货票号====</option>");
		
		//初始所有的水泥规格信息
		reSetValue();	
		$("#thjy").val("");
		$("#yfje").val("");
		if($("#purunitid").val() != "") {
			$.ajax({ 
				url: "php/activate_importlist_merge.php", 
				type:"POST", 
				data:{"action":"suggest1","purunitid":$(this).val()}, 
				success: function(data){
					var jsonObj = eval("("+data+")");//转换为json对象
					if(jsonObj[0]) {
						var tempStr = getOption(jsonObj);
						
						$("#importlistindex").append(tempStr);
					} else {
						var pop=new Pop("注意：",
							"该单位下还没有提货票号，请重新确认单位信息！"
						);
						return false;
					}
				}
			});
		}
	});
	
	$("#importlistindex").change(function(){
		reSetValue();
		if($("#importlistindex").val() == ''){
			return false;
		} else {
			$.ajax({ 
				url: "php/activate_importlist_merge.php", 
				type:"POST", 
				data:{"action":"importlist","listindex":$(this).val()}, 
				success: function(data){
					var jsonObj = eval("("+data+")");//转换为json对象	
					
					$("#spc").val(jsonObj['spc']);
					$("#factoryvalue").val(jsonObj['factoryvalue']);
					$("#factoryname").val(jsonObj['factoryname']);
								
					reGetValue();
					//var tempStr = getOption(jsonObj);
					
					//$("#listindex1").append(tempStr);			
					//alert("sjosn"+jsonObj);
				}
			});
		}
		
	});
	
	$("#cpdj").change(function(){
		reGetValue();
	});
	
	$("#fhsl").change(function(){
		reGetValue();
	});
	
	$("#customerid").change(function(){
		
		if($("#customerid").val() == ''){
			return false;
		} else {
		//alert("change");
			$.ajax({ 
				url: "php/activate_pickup_goods.php", 
				type:"POST", 
				data:{"action":"customer","customerid":$(this).val()}, 
				success: function(data){
					
					var jsonObj = eval("("+data+")");//转换为json对象	
					//alert(jsonObj['phoneNum']);
					$("#customerphonenum").html(jsonObj['phoneNum']);
				}
			});
		}
	});
	
	$("#driverid").change(function(){
	
		if($("#driverid").val() == ''){
			return false;
		} else {
			$.ajax({ 
				url: "php/activate_pickup_goods.php", 
				type:"POST", 
				data:{"action":"driver","driverid":$(this).val()}, 
				success: function(data){
					var jsonObj = eval("("+data+")");//转换为json对象	
					
					$("#driverPhoneNum").html(jsonObj['phoneNum']);
					$("#frontNum").html(jsonObj['frontNum']);
					$("#backNum").html(jsonObj['backNum']);
					$("#carSize").html(jsonObj['carSize']);
				}
			});
		}
	});
	
	$("#cardid").change(function(){			
		if($("#cardid").val() != "") {
			$.ajax({ 
				url: "php/activate_recharge.php", 
				type:"POST", 
				data:{"action":"getcard","cardid":$(this).val()}, 
				success: function(data){
					var jsonObj = eval("("+data+")");//转换为json对象
					if(jsonObj.code == 1) {
						$("#remainingsum").html(jsonObj.remainingsum);
						$("#knjy").html(jsonObj.remainingsum);
						$("#customerphonenum").html(jsonObj.customerphonenum);
						$("#customerid").val(jsonObj.customerid).blur();
						$("#customername").val(jsonObj.customername).attr("readonly","true");							
						
					} else {
						var pop=new Pop("注意：",
						"卡号不存在！"
						);
						$("#remainingsum").html("");
						$("#customerphonenum").html("");
						$("#knjy").html("");
						$("#customerid").val("").blur();
						$("#customername").val("").attr("readonly","");
						
					}
				}
			});
		} else {
			$("#remainingsum").html("");
			$("#knjy").html("");
			$("#customerphonenum").html("");
			$("#customerid").val("").blur();
			$("#customername").val("").attr("readonly","");
		}
	});
	
	$("#yfje").change(function(){
		//alert("change");
		var remainingsum = $("#remainingsum").html();
		//alert("remainingsum "+remainingsum);
		//alert($(this).val());
		if($(this).val() != "" && remainingsum != "") {
			$("#knjy").html(remainingsum - $(this).val());
		} else {
			$("#knjy").html(remainingsum);
		}
	});
});


function reSetValue(){
	
	$("#factoryvalue").val("");
	$("#factoryname").val("");
	$("#spc").val("");
	$("#concreteid").val("");
	
}

function reGetValue() {
	var factoryvalue =  $("#factoryvalue").val() == "" ? "" : parseFloat($("#factoryvalue").val());
	var fhsl = $("#fhsl").val() == "" ? "" : parseFloat($("#fhsl").val());
	var cpdj = $("#cpdj").val() == "" ? "" : parseFloat($("#cpdj").val());
	
	if(fhsl <= factoryvalue  && factoryvalue != "" && fhsl != '') {
		$("#thjy").val(factoryvalue - fhsl);
	} else {
		$("#thjy").val("");
	}
	
	if(fhsl != "" && cpdj != "" && fhsl <= factoryvalue ) {
		$("#yfje").val(fhsl * cpdj).change();
	} else {
		$("#yfje").val("").change();
	}
	
}

function getOption(arr) {
	var tempStr="";
	for(var i = 0; i < arr.length ; i++) {
		tempStr += "<option value='" + arr[i] + "'>" + arr[i] + "</option>";				
	}
	return tempStr;
	
}

function getCardNum(obj){			
	var cardNo = new ActiveXObject("getCardNo");
	var result = cardNo.getCardNo();    
	
	if(result == "1") {	var pop=new Pop("注意：",
			"读卡器尚未链接，请把读卡器接入USB口！"
		);
		return false;
	}
	if(result == "2") {
		var pop=new Pop("注意：",
			"读卡失败，请把卡靠近读卡器！"
		);
		return false;
	}
	$(obj).parent().prev().val(result).change();
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
					location.href = "carbill_print.php";
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
  <legend>提货出厂</legend>
  <form  action="php/activate_billoflading.php" method="post" class="table_wb" id="customer">
  <input type="hidden" name="action" id="action" value="save"/>
<table  align="center"   cellpadding="0" cellspacing="0"   class="biaoge">

        <?php
			if(!isLog()) {
	?>
	<tr>    
        <td width="9%" class="jy">发货卡号</td>
        <td ><input name="cardid" id="cardid" type="text" value=""  maxlength="50" /><a href="#" ><img src="images/tckh.png" onmouseover="this.src='images/tckh-hover.png'"  onmouseout="this.src='images/tckh.png'" onclick="getCardNum(this)">  </a></td>
        <td style="border-left:0px;">&nbsp;</td>
        <td width="9%" class="jy">发货日期</td>
        <td ><input name="time" id="time" type="text" maxlength="50" value="<?php echo gmdate('Y-m-d H:i:s', time() + 3600 * 8); ?>" /></td>
        <td style="border-left:0px;">&nbsp;</td>       
    </tr>
    <tr>      
        <td height="24" class="jy">客户姓名</td>
        <td>
			<input name="customerid" id="customerid" type="hidden"  value="" />
			<input name="customername" id="customername" type="text" value=""  maxlength="50" style="width:99%;"/>
		</td>
        <td style="border-left:0px;"><div id='customernameTip'style="width:150px"></div></td>         
    	<td width="9%" class="jy">客户电话</td>
        <td >&nbsp;&nbsp;<span id="customerphonenum"></span></td>
        <td style="border-left:0px;">&nbsp;</td>           
	</tr>
	<tr>   
        <td height="24" class="jy">卡内初值</td>
		<td>&nbsp;&nbsp;<span id="remainingsum">00.00</span>&nbsp; 元</td>
		<td style="border-left:0px;">&nbsp;</td>       
		<td width="9%" class="jy">卡内结余</td>
		<td >&nbsp;&nbsp;<span id="knjy">00.00</span>&nbsp; 元</td>
		<td style="border-left:0px;">&nbsp;</td>          	  
	</tr>
        <?php
                }else{
        ?>
        <tr>    
        <td width="9%" class="jy">发货日期</td>
        <td ><input name="time" id="time" type="text" maxlength="50" value="<?php echo gmdate('Y-m-d H:i:s', time() + 3600 * 8); ?>" /></td>
        <td style="border-left:0px;">&nbsp;</td>       
    </tr>
    <tr>      
        <td height="24" class="jy">客户姓名</td>
        <td>
			<input name="customerid" id="customerid" type="hidden"  value="" />
			<input name="customername" id="customername" type="text" value=""  maxlength="50" style="width:99%;"/>
		</td>
        <td style="border-left:0px;"><div id='customernameTip'style="width:150px"></div></td>         
    	<td width="9%" class="jy">客户电话</td>
        <td >&nbsp;&nbsp;<span id="customerphonenum"></span></td>
        <td style="border-left:0px;">&nbsp;</td>           
	</tr>
        <?php
                }
        ?>

	<tr><td colspan="6" height="10px" >&nbsp;</td></tr>
    
	<tr>  
	   <td width="9%" class="jy">司机姓名</td>
		<td>
			<input name="driverid" id="driverid" type="hidden"  value="" />
			<input name="drivername" id="drivername" type="text" value=""  maxlength="50" style="width:99%;"/>
		</td>
		<td style="border-left:0px;"><div id='drivernameTip'style="width:150px"></div></td>  
		<td width="9%" class="jy">司机电话</td>
		<td>&nbsp;&nbsp;<span id="driverPhoneNum"></span></td>
		<td style="border-left:0px;"><div id=''style="width:150px"></div></td>           
	</tr>
	<tr>   
		<td height="24" class="jy">车头号牌</td>
		<td>&nbsp;&nbsp;<span id="frontNum"></span></td>
		<td style="border-left:0px;">&nbsp;</td> 
		<td height="24" class="jy">车尾号牌</td>
		<td>&nbsp;&nbsp;<span id="backNum"></span></td>
		<td style="border-left:0px;">&nbsp;</td>         
	</tr>
	<tr>          
		<td class="jy" width="10%">车辆载重</td>
		<td>&nbsp;&nbsp;<span id="carSize"></span>&nbsp;吨</td>
		<td style="border-left:0px;" colspan="4">&nbsp;</td>           				
	</tr>
	
	<tr><td colspan="6" height="10px" >&nbsp;</td></tr>	
	
	<tr>   
		<td width="9%" class="jy">运输单位</td>
		<td>
			<input name="traunitid" id="traunitid" type="hidden"  value="" />
			<input name="traunitname" id="traunitname" type="text" value=""  maxlength="50" style="width:99%;"/>
		</td>
		<td style="border-left:0px;"><div id="traunitnameTip" style="width:150px"></div></td>          
		<td height="24" class="jy">水泥流向</td>
		<td><input name="wheretogo" id="note" type="text" value=""  maxlength="50" /></td>
		<td style="border-left:0px;">&nbsp;</td>            
	</tr>
	<tr>   
		<td width="9%" class="jy">购货单位</td>
		<td>
			<input name="purunitid" id="purunitid" type="hidden"  value="<?php echo $purunitid ?>" />
			<input name="name" id="name" type="text" value="<?php echo $purunitname ?>"  maxlength="50" style="width:99%;"/>
		</td>
		<td style="border-left:0px;"><div id="nameTip" style="width:150px"></div></td>          
		<td height="24" class="jy">发货单位</td>
		<td>
			<input name="whereisfrom" id="whereisfrom" type="text" value=""  maxlength="50" />    
		</td>
		<td style="border-left:0px;"><div id="Tip" style="width:150px"></div></td>   
	</tr>
	
	<tr><td colspan="6" height="10px" >&nbsp;</td></tr>	
    <tr>  
		<td width="9%" class="jy">提货票号</td>
        <td>
			<select id="importlistindex" style="width:220px" name="importlistindex"> <option value="">====请选择提货票号====</option></select>
		</td>
		<td style="border-left:0px;"><div id='importlistindexTip'style="width:150px"></div></td>  
		<td height="24" class="jy">水泥厂家</td>
		<td><input name="factoryname" id="factoryname" type="text" value="" readonly="true"  maxlength="50" />  </td>
		<td style="border-left:0px;">&nbsp;</td>       
	</tr>
    <tr>  
		<td width="9%" class="jy">产品规格</td>
		<td ><input name="spc" id="spc" type="text" value=""  readonly="true"  maxlength="50" /></td>
		<td style="border-left:0px;">&nbsp;</td>  
		<td height="24" class="jy">提货初值</td>
		<td><input name="factoryvalue" id="factoryvalue" readonly="true" type="text" value=""  maxlength="50" /> &nbsp;吨   </td>
		<td style="border-left:0px;">&nbsp;</td>      
    </tr>
    <tr>        	   
		
                <td width="9%" class="jy">发货数量</td>
                <td><input name="fhsl" id="fhsl" type="text" value=""  maxlength="50" />&nbsp;吨</td>
                <td style="border-left:0px;"><div id='fhslTip'style="width:150px;border-right:0px;"></div></td>  
                <?php
			if(!isLog()) {
	        ?>	
                <td height="24" class="jy">提货结余</td>
                <td ><input name="thjy" id="thjy" readonly="true" type="text" value=""  maxlength="50" />&nbsp;吨</td>
                <?php
                        } else {
                ?>
                <td height="24" class="jy">提货结余</td>
                <td ><input name="thjy" id="thjy" readonly="true" type="text" value=""  maxlength="50" />&nbsp;吨</td>
                <?php
                        }
                ?>
		<td style="border-left:0px;">&nbsp;</td>       
	</tr>
	<?php
			if(!isLog()) {
	?>	
	<tr>
		<td width="9%" class="jy">产品单价</td>
		<td ><input name="cpdj" id="cpdj" type="text" value=""  maxlength="50" />&nbsp;元</td>
		<td style="border-left:0px;"><div id='cpdjTip'style="width:150px;border-right:0px;"></div></td>   		
		<td height="24" class="jy">应付金额</td>
		<td><input name="yfje" id="yfje" readonly="true" type="text" value=""  maxlength="50" />&nbsp;元</td>
		<td style="border-left:0px;">&nbsp;</td>       
	</tr>
	
	<tr>   
		<td width="9%" class="jy">实收金额</td>
		<td ><input name="payment" id="payment" type="text" value=""  maxlength="50" />&nbsp;元</td>
		<td style="border-left:0px;"><div id='paymentTip'style="width:150px;border-right:0px;"></div></td>    
		<td height="24" class="jy">运费价格</td>
		<td><input name="driverprice" id="driverprice" type="text" value=""  maxlength="50" />&nbsp;元</td>
		<td style="border-left:0px;"><div id='driverpriceTip'style="width:150px;border-right:0px;"></div></td>       
	</tr>
	<?php
			} else {
	?>
			<tr>   
				<td width="9%" class="jy">承运价格</td>
				<td ><input name="shipprice" id="shipprice" type="text" value=""  maxlength="50" />&nbsp;元</td>
				<td style="border-left:0px;"><div id='shippriceTip'style="width:150px;border-right:0px;"></div></td>    
				<td height="24" class="jy">发车价格</td>
				<td><input name="driverprice" id="driverprice" type="text" value=""  maxlength="50" />&nbsp;元</td>
				<td style="border-left:0px;"><div id='driverpriceTip'style="width:150px;border-right:0px;"></div></td>       
			</tr>
	<?php
			}
	?>
	<tr>   
		<td width="9%" class="jy">发货票号</td>
                <td ><input name="index" id="index" type="text" value="<?php echo get_count_num() ?>"  maxlength="50" /></td>
		<td style="border-left:0px;"><div id='fhphTip'style="width:150px;border-right:0px;"></div></td>      
		<td height="24" class="jy">开票人员</td>
                <td><input name="operator" id="operator" type="text" value="<?php echo isset($_SESSION['thisuser']) ? $_SESSION['thisuser']['username'] : "未知用户";?>"  maxlength="50" readonly="true" />&nbsp;</td>
		<td style="border-left:0px;"><div id='kpryTip'style="width:150px;border-right:0px;"></div></td>        		    	  
	</tr>
	
	<tr>
		<td width="9%" class="jy">备注信息</td>
		<td ><input name="note" id="note" type="text" value="提货出厂备注"  maxlength="50" /></td>
		<td style="border-left:0px;" colspan="4"><div id='noteTip'style="width:150px;border-right:0px;"></div></td>      
	</tr>
       
</table>
<!--
<input type="submit" value="提交"/>
-->
<div align="center"><a href="#" ><img src="images/submit.gif" onmouseover="this.src='images/submit-1.gif'"  onmouseout="this.src='images/submit.gif'" onclick="submit_form()">  </a></div>
   </form>
</fieldset>
</div>
</body>
</html>
