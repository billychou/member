<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>培训学校综合管理系统</title>
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
	include ('php/db_fns.php');
	include ('php/book_fns.php');
	include ('php/auth_check.php');
?>
-->


<?php
	$backups=get_backup();
?>

	<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				var height = $(window).height()-210;
				$("#example tbody tr").click( function( e ) {
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
					"iDisplayLength": 10,
					"aLengthMenu": [[10,20, 50, 100], [10,20, 50, 100]],
					"bProcessing":true,
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
					"aaSorting": [[ 0, "desc" ]],
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
				
				
				
				$("tfoot input").keyup( function () {
					/* Filter on the column (the index) of this element */
					oTable.fnFilter( this.value, $("tfoot input").index(this) );
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
				
		
                                 
					$("#save_btn").click(function(){				
				        htmlObj = $.ajax({ 
							url: "php/activate_backup.php", 
							type:"GET", 
							data:{"action":"save"}, 
							success: function(data){
								var jsonObj = eval("("+data+")");//转换为json对象 
								//alert(jsonObj);
								if(jsonObj.code == 1) {
									var pop=new Pop("操作成功",
									jsonObj.info
									);
									
									setTimeout(function(){
										location.href = "backup_list.php";
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
				});

				
				$("#edit_btn").click(function(){	
						if(!confirm("确定要恢复吗？请谨慎执行此操作")) {
							return false;
						}
				        htmlObj = $.ajax({ 
							url: "php/activate_backup.php", 
							type:"GET", 
							data:{"action":"edit"}, 
							success: function(data){
								var jsonObj = eval("("+data+")");//转换为json对象 
								//alert(jsonObj);
								if(jsonObj.code == 1) {
									var pop=new Pop("操作成功",
									jsonObj.info
									);
									
									return false;
								
								} else {
									//alert("sb");
									var pop=new Pop("操作失败",
									jsonObj.info
									);
									return false;
								}
							}
						});	
				});
				
				
			} );
			
			
		</script>
	
</head>

<body class="ex_highlight_row">
<div class="zt">
 <fieldset> 
  <legend>备份还原
	<?php
		if(canOpt()) {
	?>
        &nbsp;&nbsp;
        <!--
        <a href="php/activate_backup.php?action=save"><img src="images/backup.png" title="备份数据" border="0"/></a>
        -->
        <a href="####"><img src="images/backup.png" title="备份数据" border="0" id="save_btn"/></a>
	<?php
		}
		if(canAdm()) {
?>
	&nbsp;&nbsp;
        <a href="####"><img src="images/restore.png" title="恢复数据" border="0" id="edit_btn"/></a>
        <!--
	&nbsp;
        <a href="javascript:void(0);"><img src="images/delete.png" title="清空数据" border="0" id="delete_btn"/></a>  
        -->
	<?php
		}
	?>
	
</legend>
<table cellpadding="0" cellspacing="0" border="0"  id="example" width="100%">
	<thead>
		<tr>
			<th>备份时间</th>
			<th>文件名称</th>
			<th>操作人员</th>
			<th>备注信息</th>
		</tr>
	</thead>
	<tfoot>
		<tr class="highlighted">
			<th><input type="text" name="按备份时间搜索" value="按备份时间搜索" class="search_init" /></th>
			<th><input type="text" name="按文件名称搜索" value="按文件名称搜索" class="search_init" /></th>
			<th><input type="text" name="按操作人员搜索" value="按操作人员搜索" class="search_init" /></th>
			<th><input type="text" name="按备注信息搜索" value="按备注信息搜索" class="search_init" /></th>
		</tr>
	</tfoot>
	<tbody>		
			<?php
					
                        if($backups){
                                foreach ($backups as $thisback) {
			?>
				<tr>
					<td>
						<input type="hidden" value='<?php echo $thisback['id']?>' />
						<?php echo $thisback['updatetime'] ?>
					</td>
					<td><?php echo $thisback['filename'] ?></td>
					<td><?php echo $thisback['operator'] ?></td>
					<td><?php echo $thisback['note'] ?></td>
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
