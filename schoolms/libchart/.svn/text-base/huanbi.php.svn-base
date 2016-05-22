<?php 
include 'show_huanbi.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/table.css" />
<title>环比查询</title>
</head>
<body >
<div class="middle">
<div class="search_form">
<h1 >环比查询</h1>
        <form method="get" action="#">
        	<label class="label_css">客户姓名：</label>
        	<input  class="input_css" type="text" name="user" value=""/>
        	<label class="label_css">时间：</label><input id="datepicker1" class="input_css   left_mag" type="text" value=""/>
        	<label class="label_css">水泥规格：</label>
        	<input type="submit" class="submit_button" value="查询"/>
        </form>
</div>
<br/><br/>
<div id="picture_area">
	<img class="show" id="line_chart" src="LineChartHuanbi.jpg" />
<img class="show" id="pie_chart" src="PieChartHuanbi.jpg" /> 
</div>
<table class="stripe_tb"  border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
 <tr>
 <th>客户名称</th>
   <th>上一时间段</th>
   <th>本时间段</th>
   <th>合计</th>
 </tr>
 <tr>
   <td onclick="show_huanbi(1)">张三</td>
   <td>100</td>
   <td>80</td>
   <td>-20</td>
 </tr>
 <tr>
   <td onclick="show_huanbi(2)">李四</td>
   <td>110</td>
   <td>100</td>
   <td>-10</td>
 </tr>
 <tr>
   <td onclick="show_huanbi(3)">王五</td>
   <td>100</td>
   <td>120</td>
   <td>20</td>
 </tr>
</table>
</div>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="js/table.js"></script>
</body>
</html>

