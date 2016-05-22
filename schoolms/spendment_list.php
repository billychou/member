<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>培训学校综合管理系统1</title>
<script type="text/javascript" language="javascript" src="js/list_ui.js"></script>
<script src="js/constants.js" type="text/javascript"></script>
<script src="js/ignoreBackspace.js" type="text/javascript"></script>

<style type="text/css" title="currentStyle">
fieldset {
	padding:5px;
	background:#fff; 
	width:98%; 
	border:1px solid #61a2da;
	 margin:0 auto;
	 -moz-border-radius:10px;
	-z-border-radius:10px;
	-webkit-border-radius:10px;
	border-radius:10px;
}
fieldset legend {
	color:#333;
	font-weight:bold;
	padding:3px 10px 3px 10px; 
	font-size:14px;
}


</style>

<!--
<?php
	include ('php/db_fns.php');
	include ('php/book_fns.php');
	include ('php/auth_check.php');
?>
-->

<?php
	$spendments=get_spendments();
?>

	<script type="text/javascript" charset="utf-8">
			
			$(document).ready(function() {
				var oTable = get_list_init(230,0,1);
				$("#edit_btn").click(function(){				
					var anSelected = oTable.$('tr.row_selected');
					var selectedId = "";
					if(anSelected.length == 0) {
						var pop=new Pop("操作失败","没有选中修改行，请单击选择要修改的行！");
					} else {
						selectedId = anSelected.attr('id');
						location.href = "spendment_mant.php?action=edit&id="+selectedId;
					}
				});
				
				$("#delete_btn").click(function(){				
					var anSelected = oTable.$('tr.row_selected');
					var selectedId = "";
					if(anSelected.length == 0) {
						var pop=new Pop("操作失败","没有选中删除行，请单击选择要删除的行！");
					} else {
						selectedId = anSelected.attr('id');
						//alert("有值啊"+selectedId);
						if(!confirm("确定删除该记录吗？")) {
							return false;
						}
						htmlObj = $.ajax({ 
							url: "php/activate_spendment.php", 
							type:"POST", 
							data:{"action":"delete","id":selectedId}, 
							success: function(data){
								var jsonObj = eval("("+data+")");//转换为json对象 
								if(jsonObj.code == 1) {
									var pop=new Pop("操作成功",
									jsonObj.info
									);
									
									setTimeout(function(){
										location.href = "spendment_list.php";
									},20)
								
								} else {
									alert("sb");
									var pop=new Pop("操作失败",
									jsonObj.info
									);
									return false;
								}
							}
						});						
					}
				});
			} );
			
			
		</script>
	
</head>

<body class="ex_highlight_row">
<div class="zt">
 <fieldset> 
  <legend>支出信息
	<?php
		if(canAdm()) {
	?>
	&nbsp;&nbsp;
	<a href="spendment_mant.php?action=save"><img src="images/add-.gif" title="添加信息" border="0"/></a>
	<?php
		}
		if(canAdm() && isHeadQuarter()) {
	?>
	&nbsp;&nbsp;
	<a href="javascript:void(0)"><img src="images/edit.png" title="修改信息" border="0" id="edit_btn"/></a>
	&nbsp;
	<a href="javascript:void(0)"><img src="images/del.png" title="删除信息" border="0" id="delete_btn"/></a>
	<?php
		}
	?>
</legend>
<table cellpadding="0" cellspacing="0" border="0"  id="example" width="100%">
	<thead>
		<tr>
			<th>更新时间</th>
			<th>经手人</th>
			<th>所属分校</th>
			<th>支出金额</th>
			<th>用途</th>
            <th>时间</th>
            <th>备注</th>
		</tr>
	</thead>
	<tfoot>
		<tr class="highlighted">
			<th>
				<div  style="width:200px; font-size:12px;margin-bottom:2px;">起：&nbsp;<input type="text" id="startDate" readonly="true" name="开始时间" value="开始时间"  class="Wdate" onClick="WdatePicker()" /></div>
				<div  style="width:200px; font-size:12px;">止：&nbsp;<input type="text" id="endDate" readonly="true" name="截止时间" value="截止时间"  class="Wdate" onClick="WdatePicker()" /></div>
			</th>
			<th><input type="text" name="按专业名称搜索" value="按专业名称搜索" class="search_init" /></th>
			<th><input type="text" name="按班级名称搜索" value="按班级名称搜索" class="search_init" /></th>
			<th><input type="text" name="按开班时间搜索" value="按开班时间搜索" class="search_init" /></th>
			<th><input type="text" name="按闭班时间搜索" value="按闭班时间搜索" class="search_init" /></th>
			<th><input type="text" name="按备注搜索" value="按备注搜索" class="search_init" /></th>
		</tr>
	</tfoot>
	<tbody>		
                        <?php
                        if($spendments){
				foreach ($spendments as $spendment) {
			?>
				<tr id="<?php echo $spendment['id']?>">
                    <td><?php echo $spendment['updatetime'] ?></td>
					<td><?php echo $spendment['employeename'] ?></td>
					<td><?php echo $spendment['branchname'] ?></td>
					<td><?php echo $spendment['spendnum'] ?></td>
					<td><?php echo $spendment['spenduse'] ?></td>
					<td><?php echo $spendment['spenddate'] ?></td>
					<td><?php echo $spendment['note'] ?></td>
				</tr>
			<?php	
                                }
                        }
			?>
	</tbody>
	<tfoot>
</table>
			
</fieldset>

</body>
</html>
