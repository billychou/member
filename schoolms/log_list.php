<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>培训学校综合管理系统</title>
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

	<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				
				var height = $(window).height()-240;
				
				var oTable = $('#example').dataTable( {
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
					"sScrollY": height,
					"iDisplayLength": 10,
					"sScrollX": "100%",
					"aLengthMenu": [[10,20, 50, 100], [10,20, 50, 100]],
					"bProcessing":true,
					//for server-side
					"bServerSide": true,
					"bSortClasses": false,
					//"bAutoWidth": true,
					"bDeferRender": true,
					"sAjaxSource": "php/log_processing.php",
					"oLanguage": {
						"sInfo": "共 _TOTAL_ 条记录 (当前显示从 _START_ 到 _END_)",
						"sLengthMenu": "每页显示 _MENU_ 条记录",
						"sSearch": "快捷搜索: _INPUT_",
						"sProcessing":"正在处理,请稍后...",
						"sInfoFiltered": " —— 从所有 _MAX_ 条记录中筛选出得出",
						"sZeroRecords": "当前搜索条件未搜索出记录",
						"sInfoEmpty": "共0条记录",
						"oPaginate": {
				            "sFirst": "首页",
							"sLast": "末页",
							"sNext": "下一页",
							"sPrevious": "上一页"
							
						}
					},
					"aaSorting": [[ 4, "desc" ]],
					"sDom": 'T<"clear">R<"H"lfr>t<"F"ip>',					
					"oTableTools": {
						"sSwfPath": "images/copy_csv_xls_pdf.swf",
						"aButtons": [
							{
								"sExtends": "copy",
								"sButtonText": "复制"
							},
							{
								"sExtends": "xls",
								"sButtonText": "导出"
							}
						]
					}
				} );
				
				
				
				$(".search_init").keyup( function () {
					/* Filter on the column (the index) of this element */
					var index = $("table tfoot tr th").index($(this).parent());
					var cols = $("#example tfoot tr th").size();
					if(index >= cols) {
						index = index - cols;
					}
					oTable.fnFilter( this.value, index);
				} );
								
				$(".search_init").each(function(index){
					$(this).focus(function(){
						if($(this).val() == $(this).attr("name")) {
							$(this).val("");
						}
					});
					
					$(this).blur(function(){
						if($(this).val() == "") {
							$(this).val($(this).attr("name"));
						}
					});
				});
				
				$(".Wdate").each(function(index){	
					
					$(this).focus(function(){
						if($(this).val() == $(this).attr("name")) {
							$(this).val("");
						}
					});					
				});
				
				
				
				$("#example tbody tr").live('click',function(){
					if ( $(this).hasClass('row_selected') ) {
						$(this).removeClass('row_selected');
					}
					else {
						oTable.$('tr.row_selected').removeClass('row_selected');
						$(this).addClass('row_selected');
					}
				});
					
				$("#startDate").blur(function(){
					oTable.fnFilter( this.value, 4);
				});
				
				$("#endDate").blur(function(){
					oTable.fnFilter( this.value, 6);
				});
			} );
			
			
		</script>

</head>

<body class="ex_highlight_row">
<div class="zt">
 <fieldset> 
  <legend>日志信息
</legend>
<table cellpadding="0" cellspacing="0" border="0"  id="example" width="100%">
	<thead>
		<tr>
			<th>姓名</th>
			<th>登录ID</th>
			<th>系统权限</th>
			<th>分校</th>
			<th>操作时间</th>
			<th>操作类型</th>
			<th>操作IP</th>
		</tr>
	</thead>
	<tfoot>
		<tr class="highlighted">
			<th><input type="text" name="按姓名搜索" value="按姓名搜索" class="search_init" /></th>
			<th><input type="text" name="按登录ID搜索" value="按登录ID搜索" class="search_init" /></th>
			<th><input type="text" name="按系统权限搜索" value="按系统权限搜索" class="search_init" /></th>
			<th><input type="text" name="按分校搜索" value="按分校搜索" class="search_init" /></th>
			<th>
				<div  style="width:200px; font-size:12px;margin-bottom:2px;">起：&nbsp;<input type="text" id="startDate" readonly="true" name="开始时间" value="开始时间"  class="Wdate" onClick="WdatePicker()" /></div>
				<div  style="width:200px; font-size:12px;">止：&nbsp;<input type="text" id="endDate" readonly="true" name="截止时间" value="截止时间"  class="Wdate" onClick="WdatePicker()" /></div>
			</th>
			<th><input type="text" name="按操作类型搜索" value="按操作类型搜索" class="search_init" /></th>
			<th><div  style="width:200px; ">&nbsp;</div></th>
		</tr>
	</tfoot>
	<tbody>		
	</tbody>
	<tfoot>
</table>
			
</fieldset>

</body>
</html>
