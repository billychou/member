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

	$companies=get_company();
?>
-->

	<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
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
					"sScrollY": "330px",
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
				
				$("#edit_btn").click(function(){				
					var anSelected = oTable.$('tr.row_selected');
					var selectedId = "";
					if(anSelected.length == 0) {
						var pop=new Pop("操作失败","没有选中修改行，请单击选择要修改的行！");
					} else {
                                                selectedId = anSelected.find(":input").eq(0).val();
                                                if(!confirm("确定修改该记录吗？")) {
							return false;
						}
						location.href = "company_mant.php?action=edit&id="+selectedId;
					}
				});
				
				$("#delete_btn").click(function(){				
					var anSelected = oTable.$('tr.row_selected');
					var selectedId = "";
					if(anSelected.length == 0) {
						var pop=new Pop("操作失败","没有选中删除行，请单击选择要删除的行！");
					} else {
						selectedId = anSelected.find(":input").eq(0).val();
						//alert("有值啊"+selectedId);
						if(!confirm("确定删除该记录吗？")) {
							return false;
						}
						htmlObj = $.ajax({ 
							url: "php/activate_company.php", 
							type:"POST", 
							data:{"action":"delete","company_id":selectedId}, 
							success: function(data){
								var jsonObj = eval("("+data+")");//转换为json对象 
								if(jsonObj.code == 1) {
									var pop=new Pop("操作成功",
									jsonObj.info
									);
									
									setTimeout(function(){
										location.href = "company_list.php";
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
  <legend>公司信息
	<?php
		if(canOpt()) {
	?>
	&nbsp;&nbsp;
	<a href="company_mant.php?action=save"><img src="images/add-.gif" title="添加信息" border="0"/></a>
	<?php
		}
		if(canAdm()) {
	?>
	&nbsp;&nbsp;
	<a href="####"><img src="images/edit.png" title="修改信息" border="0" id="edit_btn"/></a>
	&nbsp;
	<a href="####"><img src="images/del.png" title="删除信息" border="0" id="delete_btn"/></a>
	<?php
		}
	?>
	
</legend>
<table cellpadding="0" cellspacing="0" border="0"  id="example" width="100%">
	<thead>
		<tr>
			<th>公司名称</th>
			<th>备注</th>
		</tr>
	</thead>
	<tfoot>
		<tr class="highlighted">
			<th><input type="text" name="按公司名称搜索" value="按公司名称搜索" class="search_init" /></th>
			<th><input type="text" name="按备注信息搜索" value="按备注信息搜索" class="search_init" /></th>
		</tr>
	</tfoot>
	<tbody>		
                        <?php
                        if($companies){
				foreach ($companies as $thiscompany) {
			?>
				<tr>
					<td>
						<input type="hidden" value='<?php echo $thiscompany['id']?>' />
						<?php echo $thiscompany['name'] ?>
					</td>
					<td><?php echo $thiscompany['note'] ?></td>
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
