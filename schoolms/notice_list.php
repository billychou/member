<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>公告信息列表</title>
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
	$notices=get_notice_list();
?>

	<script type="text/javascript" charset="utf-8">
			$.fn.dataTableExt.afnFiltering.push(					
				function( oSettings, aData, iDataIndex ) {
					var index = $("table tfoot tr th").index($("#startDate").parent().parent());
					var cols = $("#example tfoot tr th").size();
					if(index >= cols) {
						index = index - cols;
					}
					
					var iMin = "";
					var iMax = "";
					if($("#startDate").val() != $("#startDate").attr("name") && $("#startDate").val() != '') {
							iMin = $("#startDate").val();
							iMinArr = iMin.split('-');
							iMin = new Date(iMinArr[0],iMinArr[1],iMinArr[2]);
					}
					if($("#endDate").val() != $("#endDate").attr("name") && $("#endDate").val() != '') {
							iMax = $("#endDate").val();							
							iMaxArr = iMax.split('-');
							iMax = new Date(iMaxArr[0],iMaxArr[1],iMaxArr[2]);	
					}
					var updatetime = aData[index] == "" ? "" : aData[index];
					var dateArr = aData[index].split(' ')[0].split('-');
					updatetime = new Date(dateArr[0],dateArr[1],dateArr[2]);
					if (iMin == "" && iMax == "")
					{
						return true;
					}
					
					else if ( iMin == "" && updatetime <= iMax )
					{
						return true;
					}
					else if ( iMin <= updatetime && "" == iMax )
					{
						return true;
					}
					else if ( iMin <= updatetime && updatetime <= iMax )
					{
						return true;
					}
					return false;
				}
			);
			
			$(document).ready(function() {
				var height = $(window).height()-240;
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
					"sScrollX": "100%",
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
					"aaSorting": [[ 1, "desc" ]],
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
					$(this).blur(function(){
						oTable.fnDraw();
					});						
				});
				
				$("#edit_btn").click(function(){				
					var anSelected = oTable.$('tr.row_selected');
					//alert(anSelected);
					var selectedId = "";
					if(anSelected.length == 0) {
						var pop=new Pop("操作失败","没有选中修改行，请单击选择要修改的行！");
					} else {
                                                selectedId = anSelected.find(":input").eq(0).val();
                                                if(!confirm("确定修改该记录吗？")) {
							return false;
						}
						location.href = "notice_mant.php?action=edit&id="+selectedId;
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
							url: "php/activate_notice.php", 
							type:"POST", 
							data:{"action":"delete","id":selectedId}, 
							success: function(data){
								var jsonObj = eval("("+data+")");//转换为json对象 
								if(jsonObj.code == 1) {
									var pop=new Pop("操作成功",
									jsonObj.info
									);
									
									setTimeout(function(){
										location.href = "notice_list.php";
									},20)
								
								} else {
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
  <legend>公告信息
	<?php
		if(canOpt()) {
	?>
	&nbsp;&nbsp;
	<a href="notice_mant.php?action=save"><img src="images/add-.gif" title="添加信息" border="0"/></a>
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
			<th>标题</th>
			<th>发布时间</th>
			<th>有效期</th>
			<th>发布人</th>
			<th>正文</th>
		</tr>
	</thead>
	<tfoot>
		<tr class="highlighted">
			<th><input type="text" name="标题" value="标题" class="search_init" /></th>
			<th>
				<div  style="width:200px; font-size:12px;margin-bottom:2px;">起：&nbsp;<input type="text" id="startDate" readonly="true" name="开始时间" value="开始时间"  class="Wdate" onClick="WdatePicker()" /></div>
				<div  style="width:200px; font-size:12px;">止：&nbsp;<input type="text" id="endDate" readonly="true" name="截止时间" value="截止时间"  class="Wdate" onClick="WdatePicker()" /></div>
			</th>
			<th><input type="text" name="有效期" value="有效期" class="search_init" /></th>
			<th><input type="text" name="发布人" value="发布人" class="search_init" /></th>
			<th><div style="width:500px;"><input type="text" name="正文" value="正文" class="search_init" /></div></th>
		</tr>
	</tfoot>
	<tbody>		
                        <?php
                        if($notices){
				foreach ($notices as $notice) {
			?>
				<tr id="<?php $notice['id']?>">
					<td>
						<input type="hidden" value='<?php echo $notice['id']?>' />
						<?php echo $notice['title'] ?>
					</td>
					<td><?php echo $notice['updatetime'] ?></td>
					<td>
						<script>
							var tempStr1 = '<?php echo $notice['validays'] ?>';
							document.write(get_validays(tempStr1));
						</script>
					</td>
					<td><?php echo $notice['adminid'] ?></td>
					<td><?php echo $notice['body'] ?></td>
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
