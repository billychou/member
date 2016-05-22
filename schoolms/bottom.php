<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>题名教育学员管理系统</title>
<link  href="style/conter.css"  rel="stylesheet">
<script src="js/add_ui.js" type="text/javascript"></script>
<script src="js/ignoreBackspace.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function(){	
		htmlObj = $.ajax({ 
			url: "php/activate_config.php", 
			type:"POST", 
			data:{"action":"get"}, 
			success: function(data){
				var jsonObj = eval("("+data+")");//转换为json对象 
				if(jsonObj.code == 1) {
					$("#company").html(jsonObj.companyname);
				} else {
					return false;
				}
			}
		});
	});
</script>
</head>
<body>
<div class="bottom">
版权所有：题名教育科技有限公司 
<script language="javascript" type="text/javascript" src="http://js.users.51.la/17043090.js"></script>
<noscript>
<a href="http://www.51.la/?17043090" target="_blank">
<img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/17043090.asp" style="border:none" /></a>
</noscript>    
</div>
</body>
</html>
