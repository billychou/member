<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
 <script src='delayedLoading.js' type="text/javascript"></script>
 <title>pChart 2.x - Delayed loading</title>
 <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
 <style>
  html       { height: 100%; }
  body       { background-color: #FFFFFF; font-family: tahoma; font-size: 14px; height: 100%;}
  td  	     { font-family: tahoma; font-size: 11px; }
  div.txt    { font-family: tahoma; font-size: 11px; width: 660px; padding: 15px; }
  a.smallLink:link    { text-decoration: none; color: #6A6A6A; }
  a.smallLink:visited { text-decoration: none; color: #6A6A6A; }
  a.smallLink:hover   { text-decoration: underline; color: #6A6A6A; }
  a.pChart { text-decoration: none; color: #6A6A6A; }
 </style>
</head>
<body onscroll="scrollEvent();" onload="loaderInit();">
 
 <table style='border: 2px solid #FFFFFF;width:800;' align="center">
  <tr><td>
  <div style='font-size: 11px; padding: 2px; color: #FFFFFF; background-color: #63B7F7; border-bottom: 3px solid #484848;'>&nbsp;Navigation</div>
  <table style='padding: 1px; background-color: #E0E0E0; border: 1px solid #D0D0D0; border-top: 1px solid #FFFFFF;width:800'>
        <tr>
                <td width=100>开始时间</td>
                <td width=100><input type="text" id="startTime" class="Wdate" onClick="WdatePicker()" title="选择开始时间" value="选择开始时间" /></td>
                <td width=100>结束时间</td>
                <td width=100><input type="text" id="startTime" class="Wdate" onClick="WdatePicker()" title="选择结束时间" value="选择结束时间" /></td>
        </tr>
  </table>
 </td></tr>
</table>

 <br/>

 <div class=txt>
 </div>

 <div align="center">
 <a class='pChart' href='line.php?Seed=1' data-pchart-alt='营收走势图' data-pchart-width='700' data-pchart-height='230'>Picture 1</a>
 </div>

 <div class=txt>
 </div>

 <div align="center">
 <a class='pChart' href='bar.php?Seed=2' data-pchart-alt='营收图'>Picture 2</a>
 </div>
 
 <div class=txt>

 </div>
<!--
 <a class='pChart' href='draw.php?Seed=3' data-pchart-alt='Picture3'>Picture 3</a>
-->
</body>
</html>
