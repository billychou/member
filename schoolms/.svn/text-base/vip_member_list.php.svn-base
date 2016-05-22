<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>红会信息列表</title>
<script type="text/javascript" language="javascript" src="js/list_ui.js"></script>
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
	include ('php/auth_check.php');
?>
-->


	<script type="text/javascript" charset="utf-8">
			
			$(document).ready(function() {  
				var height = $(window).height()-210;
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
					"bJQueryUI": true,  //是否启用jquery UI风格
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
					"sAjaxSource": "php/vip_member_processing.php",
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
						//var totalpayNum = oSettings._iTotalPayNum;
						//var totalCounts = oSettings._iTotalCounts;

						//$("#totalpayNum").html(commaSplit(totalpayNum.toFixed(2)));
						//$("#totalCounts").html(commaSplit(totalCounts));
					},   
                                        
					"aaSorting": [[ 0, "desc" ]],
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
			
				$("#edit_btn").click(function(){				
					var anSelected = oTable.$('tr.row_selected');
					var selectedId = "";
					if(anSelected.length == 0) {
						var pop=new Pop("操作失败","没有选中修改行，请单击选择要修改的行！");
					} else {
						selectedId = anSelected.attr('id');
						if(!confirm("确定修改该记录吗？")) {
							return false;
						}
						location.href = "vip_member_mant.php?action=edit&id="+selectedId;
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
							url: "php/activate_vip_member.php", 
							type:"POST", 
							data:{"action":"delete","id":selectedId}, 
							success: function(data){
								var jsonObj = eval("("+data+")");//转换为json对象 
								if(jsonObj.code == 1) {
									var pop=new Pop("操作成功",
									jsonObj.info
									);
									
									setTimeout(function(){
										location.href = "vip_member_list.php";
									},20)
								
								} else {
									//alert("sb");
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
  <legend>红学会人员信息
  	<?php
		if(canOpt()) {
	?>
	&nbsp;&nbsp;
	<a href="vip_member_mant.php?action=save"><img src="images/add-.gif" title="添加信息" border="0"/></a>
	<?php
		}
		if(canAdm()) {
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
			<th>分校</th>
			<th>班级名称</th>
            <th>姓名</th>
            <th>性别</th>
            <th>移动电话</th>
            <th>QQ号</th>
            <th>工作单位</th>
            <th>联系地址</th>
            <th>医师职称</th>
            <th>职位</th>
        </tr>
	</thead>
	<tfoot>	
		<tr class="highlighted" style="color:#0462ac; font-weight:600;">
			<th>	
				<div  style="width:200px; font-size:12px;margin-bottom:2px;">起：&nbsp;<input type="text" id="startDate" readonly="true" name="开始时间" value="开始时间"  class="Wdate" onClick="WdatePicker()" /></div>
				<div  style="width:200px; font-size:12px;">止：&nbsp;<input type="text" id="endDate" readonly="true" name="截止时间" value="截止时间"  class="Wdate" onClick="WdatePicker()" /></div>
			</th>
			<th><input type="text" name="按分校搜索" value="按分校搜索" class="search_init" /></th>			
			<th><input type="text" name="按班级名称搜索" value="按班级名称搜索" class="search_init" /></th>
			<th><input type="text" name="按学员姓名搜索" value="按学员姓名搜索" class="search_init" /></th>
			<th><input type="text" name="按性别搜索" value="按性别搜索" class="search_init" /></th>
			<th><input type="text" name="按联系电话搜索" value="按联系电话搜索" class="search_init" /></th>
			<th><input type="text" name="按QQ号搜索" value="按QQ号搜索" class="search_init" /></th>
			<th><input type="text" name="按工作单位搜索" value="按工作单位搜索" class="search_init" /></th>
			<th><input type="text" name="按联系地址搜索" value="按联系地址搜索" class="search_init" /></th>
			<th><input type="text" name="按医师职称搜索" value="按医师职称搜索" class="search_init" /></th>
			<th><input type="text" name="按职位搜索" value="按职位搜索" class="search_init" /></th>
			</tr>
		
		
	</tfoot>
	<tbody>
	</tbody>

</table>
	
</fieldset>
</body>
</html>
