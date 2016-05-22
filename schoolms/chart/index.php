<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

 <script src='delayedLoading.js' type="text/javascript"></script>
 <title>pChart 2.x - Delayed loading</title>
 <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
 <script src='../js/jquery-1.4.4.min.js' type='text/javascript' charset='uft-8'></script>
<script src='../js/datepicker/WdatePicker.js' type='text/javascript' charset='uft-8'></script>
<script src="../js/ignoreBackspace.js" type="text/javascript"></script>
 
 <script>
 $(function(){
	var imgSrc = $("#barChart").attr("src").substring(0,14);
	$(".Wdate").each(function(index){					
		$(this).focus(function(){
			if($(this).val() == $(this).attr("title")) {
				$(this).val("");
			}
		});		
	});
	
	

	/*
		var _url = "line.php?seed=1&v="+ Math.random();
		var _im = $("<img>");
		_im.bind("load",function(){
			$(this).hide();
			$('#loader').removeClass('loading').append(this);
			$(this).fadeIn();
		});
		_im.attr('src', _url);
	*/
 });
 
 function stChange(){
	var imgSrc = $("#barChart").attr("src").substring(0,14);

	var startDate = $("#startTime").val();
	var endDate = $("#endTime").val();

	if(startDate == $("#startTime").attr("title")) {
		startDate = "";
	}
	
	if(endDate == $("#endTime").attr("title")) {
		endDate = "";
	}
	imgSrc = imgSrc + "&startDate=" + startDate + "&endDate=" + endDate;
	
	$("#barChart").attr("src",imgSrc);
 }
 
 </script>
 <style>
  html       { height: 100%; }	
  body       { background-color: #FFFFFF; font-family: tahoma; font-size: 14px; height: 100%;}
  td  	     { font-family: tahoma; font-size: 18px; }
  div.txt    { font-family: tahoma; font-size: 11px; width: 660px; padding: 10px; }
  a.smallLink:link    { text-decoration: none; color: #6A6A6A; }
  a.smallLink:visited { text-decoration: none; color: #6A6A6A; }
  a.smallLink:hover   { text-decoration: underline; color: #6A6A6A; }
  a.pChart { text-decoration: none; color: #6A6A6A; }
 </style>
</head>
<!--<body onscroll="scrollEvent();" onLoad="loaderInit();">-->
<body>
 
 <!--
 <table style='border: 2px solid #FFFFFF;width:800px;margin-left:20px;' align="center">
  <tr><td>
  <div style='font-size: 18px;  color:#0462ac; background-color: #63B7F7; border-bottom: 3px solid #484848;'>&nbsp;查询结果将在营收图中展现</div>
  <table style=' border: 1px solid #D0D0D0; border-top: 1px solid #FFFFFF;width:800px;font-size:12px;'>
        <tr>
			<td width="168px" align="right">开始时间</td>
			<td width='222px'><input type="text" id="startTime" class="Wdate" onChange="stChange()"  onClick="WdatePicker()" title="选择开始时间" value="选择开始时间" /></td>
			<td width='119px'  align="right">结束时间</td>
			<td width='271px'><input type="text" id="endTime" class="Wdate"  onchange="stChange()" onClick="WdatePicker()" title="选择结束时间" value="选择结束时间" /></td>
        </tr>
  </table>
 </td></tr>
</table>
-->
 <br/> 
 
 <div align="left" style="margin-left:200px" id="linechart">
 <!--<a class='pChart' id="lineChart1" href='line.php?Seed=1' data-pchart-alt='营收走势图' data-pchart-width='700' data-pchart-height='230'>Picture 1</a>-->
 
 <img id="lineChart" src="line.php?seed=1" alt="营收走势图"/>
 </div>

<br/>
 <div align="left" style="margin-left:200px" >
 <!--
 <a class='pChart' id="barChart" href='bar.php?Seed=2' data-pchart-alt='营收图'>Picture 2</a>
 -->
 <img id="barChart" src="bar.php?seed=2" alt="营收图"/>
 </div>
 <!--
 <div align="center" style='font-size: 18px;  color:#0462ac; background-color: #63B7F7; border-bottom: 3px solid #484848;width:800px;margin-left:20px;'>&nbsp;查询结果将在营收图中展现</div>
 -->
  <table style='width:800px;' align="center">
        <tr>
			<td width="168px" align="right">开始时间</td>
			<td width='222px'><input type="text" id="startTime" class="Wdate" onChange="stChange()"  onClick="WdatePicker()" title="选择开始时间" value="选择开始时间" /></td>
			<td width='119px'  align="right">结束时间</td>
			<td width='271px'><input type="text" id="endTime" class="Wdate"  onchange="stChange()" onClick="WdatePicker()" title="选择结束时间" value="选择结束时间" /></td>
        </tr>
  </table>
 <!--
 </div>
 -->
 <br/>
 <br/>
<!--
 <a class='pChart' href='draw.php?Seed=3' data-pchart-alt='Picture3'>Picture 3</a>
-->
</body>
</html>
