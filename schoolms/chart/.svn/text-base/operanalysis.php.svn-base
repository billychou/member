<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

 <script src='delayedLoading.js' type="text/javascript"></script>
 <title>pChart 2.x - Delayed loading</title>
 <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<script src='../js/jquery-1.4.4.min.js' type='text/javascript' charset='uft-8'></script>
<script src='../js/datepicker/WdatePicker.js' type='text/javascript' charset='uft-8'></script>
<script src='../js/jquery.dataTables.js' type='text/javascript' charset='uft-8'></script>
<script src="../js/ignoreBackspace.js" type="text/javascript"></script>
<link rel='stylesheet' type='text/css' href='../style/pop.css'>
<script src='../js/pop.js' type='text/javascript' charset='uft-8'></script>
<link rel='stylesheet' type='text/css' href='../style/jquery.dataTables_themeroller.css'>
<link rel='stylesheet' type='text/css' href='../style/themes/smoothness/jquery-ui-1.8.4.custom.css'>
<link rel='stylesheet' type='text/css' href='../style/list_style.css'>
 <style>
  html       { height: 100%; }	
  body       { background-color: #FFFFFF; font-family: tahoma; font-size: 12px; height: 100%;}
  td  	     { font-family: tahoma; font-size: 11px; }
  div.txt    { font-family: tahoma; font-size: 11px; width: 660px; padding: 10px; }
  a.smallLink:link    { text-decoration: none; color: #6A6A6A; }
  a.smallLink:visited { text-decoration: none; color: #6A6A6A; }
  a.smallLink:hover   { text-decoration: underline; color: #6A6A6A; }
  a.pChart { text-decoration: none; color: #6A6A6A; }
 </style>
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
	include ('db_fns.php');
	include ('book_fns.php');
	include ('../php/auth_check.php');
?>
-->

<?php
	//$logs=get_log_list();
?>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				
				requestTable("","",true);
				
				$("#period").change(function(){
					$("#example tbody").html("");
					
					var customername = "";
					if($("#customername").val() == $("#customername").attr("name")) {
						customername = "";
					}
					requestTable($(this).val(),customername,false);
				});
											
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
				
				$("#display").click(function(){
					
					if($('tr.row_selected').length == 0) {
						//alert("fff");
						var pop=new Pop("操作失败","没有选中客户姓名，请单击选择要显示的客户姓名！");
						return false;
					} 
					var anSelected = $('tr.row_selected').attr("id");
					//alert(anSelected);
                                        stChange(anSelected);
					
				});
								
			} );
			
			function stChange(id){
				var imgSrc = $("#barChart").attr("src").substring(0,14);
				//alert(imgSrc);
                                imgSrc = imgSrc + "?customerid=" + id + "&period=" + $("#period").val();
				//alert(imgSrc);
				$("#barChart").attr("src",imgSrc);
			 }
			
			function requestTable(peroid,customername,init) {
				var oTable = $('#example').dataTable();
				oTable.fnDestroy();
				htmlObj = $.ajax({ 
					url: "../php/activate_billoflading.php", 
					type:"POST", 
					data:{"action":"customerperstat","period":peroid, "customername":customername}, 
					success: function(data){
						var jsonObj = eval("("+data+")");//转换为json对象 
						var str = "";
						for(var i = 0; i < jsonObj.length; i++) {
							//alert(jsonObj[i].customername);
							str += "<tr id='" + jsonObj[i].customerid + "'>";
                                                        str += 		"<td>" + jsonObj[i].customername + "</td>";
                                                        str += 		"<td>" + jsonObj[i].lastPerMount + "</td>";
							str += 		"<td>" + jsonObj[i].thisPerMount + "</td>";
							str += 		"<td>" + jsonObj[i].delta1 + "</td>";
							str += "</tr>";	
						}
						
						//alert($("#example tbody").html());
						$("#example tbody tr").remove();
						$("#example tbody").html(str);
						displayTable(init);						
					}
				});
			}
			
			
			function displayTable(init) {
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
				
				//$("#example tbody tr").unbind("click");
				
				if(init) {
				
					$("#example tbody tr").live("click",function() {
						if ( $(this).hasClass('row_selected') ) {
							$(this).removeClass('row_selected');
						}
						else {
							oTable.$('tr.row_selected').removeClass('row_selected');
							$(this).addClass('row_selected');
						}
					});
				}
				
				$("tfoot input").live("keyup",function () {
					/* Filter on the column (the index) of this element */
					oTable.fnFilter(this.value, $("tfoot input").index(this));
				});
			
			}
		
			
		</script>

</head>
<!--<body onscroll="scrollEvent();" onLoad="loaderInit();">-->
<body class="ex_highlight_row" style="margin:0 auto;">
  <!--
 <br/>
 <div align="center">

 <a class='pChart' id="barChart" href='bar.php?Seed=2' data-pchart-alt='营收图'>Picture 2</a>
 
 <img id="barChart" src="periodline.php?seed=2" alt="营收图"/>
 </div>
<br/>-->
<table align="center"  cellpadding="0" cellspacing="0" border="0" style="margin:0 auto;">
<tr style="margin-top:5px;"><td > <img id="barChart" src="periodline.php?seed=2" alt="营收图"/>
</td></tr>
<tr><td>
 <div align="center"  style="width:804px; margin:0 auto;">
 <div class="zt">
  <fieldset style="text-align:left"> 
  <legend>环比信息
	<a href="#" id="display"><img src="../images/add-.gif" title="添加信息" border="0"/></a>
</legend>

<table cellpadding="0" cellspacing="0" border="0"  align="center" id="example" >
	<thead>
		<tr>
			<th>客户姓名</th>
			<th>前段销量(吨)</th>
			<th>本段销量(吨)</th>
			<th>销售差值(吨)</th>
		</tr>
	</thead>
	<tfoot>
		<tr class="highlighted">
			<th><input type="text" id="customername" name="按客户姓名搜索" value="按客户姓名搜索" class="search_init" /></th>
			<th style="font-size:12px;">
				时间间隔(天)：
						<select id="period">
                                <option value="1">1</option>
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="7" selected>7</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="60">60</option>
                        </select>
			</th>
            <th colspan="2">&nbsp;</th>
		</tr>
	</tfoot>
	<tbody>		
			
		
	</tbody>
	<tfoot>
</table>
			
</fieldset>  
</td>
</tr>
 <!--
 check box 

 <table style='border: 2px solid #FFFFFF;width:800px;margin-left:200px;' align="center">
  <tr><td>
  <div style='font-size: 12px;  color:#0462ac; background-color: #63B7F7; border-bottom: 3px solid #484848;'>&nbsp;查询结果将在营收图中展现</div>
  <table style=' border: 1px solid #D0D0D0; border-top: 1px solid #FFFFFF;width:800px;font-size:12px;'>
        <tr>
			<td width="168px" align="right">时间间隔(天)</td>
                        <td width='222px'>
                        
                        </td>
        </tr>
  </table>
 </td></tr>
</table>
 -->
 </div>
 </div>

</body>
</html>
