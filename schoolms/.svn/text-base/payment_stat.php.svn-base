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
    $currentUser = $_SESSION['thisuser'];
    if(canAdm()){
        $payments=get_payments();
    }else{
        $payments=get_payments_by_branchid($currentUser['branchid']);
    }
?>
	<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				var height = $(window).height()-240;
				$("#example tbody tr").live('click',function(){
					if ( $(this).hasClass('row_selected') ) {
						$(this).removeClass('row_selected');
					}
					else {
						oTable.$('tr.row_selected').removeClass('row_selected');
						$(this).addClass('row_selected');
					}
				});
				
				var oTable = $('#example').dataTable( {
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
					"sScrollY": height,
					"iDisplayLength": 100,
					"sScrollX": "100%",
					"aLengthMenu": [[50, 100, 3000], [50, 100, 3000]],
					"bProcessing":true,
					//for server-side
					"bServerSide": true,
					"bSortClasses": false,
					//"bAutoWidth": true,
					"bDeferRender": true,
					"sAjaxSource": "php/payment_processing.php",
					//extra parameters for filtering
					"fnServerParams": function ( aoData ) {
							//aoData.push( { "name": "department", "value": "sales" } );
					},            
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
                                   
					"fnDrawCallback": function( oSettings ) {	
						//alert(oSettings._aaDate);
						var totalpayNum = oSettings._iTotalPayNum;
						var totalCounts = oSettings._iTotalCounts;

						$("#totalpayNum").html(commaSplit(totalpayNum.toFixed(2)));
						$("#totalCounts").html(commaSplit(totalCounts));
					},   
                                        
					"aaSorting": [[ 2, "desc" ]],
					"sDom": 'T<"clear"><"H"lfr>t<"F"ip>',					
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
                    },
					
					"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
						/* Append the grade to the default row class name */
						
					}
										
				} );                         
				//new FixedHeader( oTable, { "bottom": true } );
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
				
				$("#startDate").blur(function(){
					oTable.fnFilter( this.value, 0);
				});
				
				$("#endDate").blur(function(){
					oTable.fnFilter( this.value, 12);
				});	
			} );

			
	</script>
	
</head>

<body class="ex_highlight_row">
<div class="zt">
 <fieldset> 
  <legend>缴费记录
    <!--
	<?php
		if(canOpt()) {
	?>
	&nbsp;&nbsp;
	<a href="payment_mant.php?action=save"><img src="images/add-.gif" title="添加信息" border="0"/></a>
	<?php
		}
		if(canOpt()) {
	?>
	&nbsp;
	<a href="javascript:void(0)"><img src="images/del.png" title="删除信息" border="0" id="delete_btn"/></a>
	<?php
		}
	?>
    -->
</legend>
<table cellpadding="0" cellspacing="0" border="0"  id="example" width="100%">
	<thead>
		<tr>
			<th>更新时间</th>
			<th>经手人</th>
			<th>学员姓名</th>
			<th>听课证编号</th>
			<th>缴费数目</th>
            <th>分校名称</th>
            <th>专业名称</th>
            <th>班级名称</th>
            <th>备注</th>
		</tr>
	</thead>
	<tfoot>
		<tr class="highlighted">
			<th>
				<div  style="width:200px; font-size:12px;margin-bottom:2px;">起：&nbsp;<input type="text" id="startDate" readonly="true" name="开始时间" value="开始时间"  class="Wdate" onClick="WdatePicker()" /></div>
				<div  style="width:200px; font-size:12px;">止：&nbsp;<input type="text" id="endDate" readonly="true" name="截止时间" value="截止时间"  class="Wdate" onClick="WdatePicker()" /></div>
			</th>
			<th><input type="text" name="按经手人搜索" value="按经手人称搜索" class="search_init" /></th>
			
			<th><input type="text" name="按学员姓名搜索" value="按学员姓名搜索" class="search_init" /></th>
			<th><input type="text" name="按听课证编号搜索" value="按听课证编号搜索" class="search_init" /></th>
            <td align="center"><div style="width:100px">&nbsp;</div></td>
			<th><input type="text" name="按分校名称搜索" value="按分校名称搜索" class="search_init" /></th>
            <th><input type="text" name="按专业名称搜索" value="按专业名称搜索" class="search_init" /></th>
            <th><input type="text" name="按班级名称搜索" value="按班级名称搜索" class="search_init" /></th>
            <td align="center"><div style="width:100px">&nbsp;</div></td> 
		</tr>
	</tfoot>


</table>

<table  cellpadding="0" cellspacing="0" border="0" style="margin-top:10px;color:#1a6cb0; font-size:14px;line-height:25px; ">
<tr >
	<td align="left" ><div style="width:100px"><b>统计信息:</b></div></td>
    <td align="left"><div style="width:250px">收费(合计)：<span id="totalpayNum"></span>&nbsp; 元</div></td>
</tr>

</table>
			
</fieldset>

</body>
</html>
