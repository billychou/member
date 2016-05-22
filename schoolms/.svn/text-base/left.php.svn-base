<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>考得上教育管理系统</title>
<script src="js/ignoreBackspace.js" type="text/javascript"></script>
<link  href="style/conter.css"  rel="stylesheet">
<!--
<?php
	include ('php/auth_check.php');
?>
-->
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   $("#wenzhang>dd>dl>dd").hide();
   $("#wenzhang>dd>dl>dt").removeClass("open");
   $.each($("#wenzhang>dd>dl>dt"), function(){
   $(this).click(function(){
   $("#wenzhang>dd>dl>dd").not($(this).next()).slideUp();
   $(this).next().slideToggle(300);
   });
   $(this).toggle(function(){$(this).addClass("open");},function(){$(this).removeClass("open");});
   });
   
   $.each($("#wenzhang>dd>dl>dd>ul>li>a"), function(){
		$(this).click(function(){
			$(this).addClass("menuClick");
			$("#wenzhang>dd>dl>dd>ul>li>a").not($(this)).removeClass("menuClick");
			//$(this).next().slideToggle(300);
   });
   })
   
   
});
</script>

</head>
<body>
    <dl id="wenzhang">
        <dd>
        <dl>
           <dt><img src="images/xs.png">基础信息</dt>
           <dd>
             <ul>
                <li class="blank">&nbsp;</li>
                <li><a href="branch_list.php" target="mainFrame">·分校信息</a></li>
                <li><a href="major_list.php" target="mainFrame">·专业类别</a></li>
                <li><a href="class_list.php" target="mainFrame">·班级信息</a></li>
                <li class="blank">&nbsp;</li>
             </ul>
           </dd>
          
        </dl>
        </dd>

        <dd>
        <dl>
           <dt><img src="images/bb.png">人员管理</dt>
           <dd>
              <ul>
                <li class="blank">&nbsp;</li>
                <li><a href="member_list.php" target="mainFrame">·普通学员</a></li>
                <li><a href="vip_member_list.php" target="mainFrame">·红会学员</a></li>
                <li><a href="employee_list.php" target="mainFrame">·工作人员</a></li>
                <li class="blank">&nbsp;</li>
              </ul>
           </dd>
        </dl>
        </dd>
		<dd>
     
		
		
		
		<dd>
        <dl>
           <dt><img src="images/money.png">财务管理</dt>
           <dd>
              <ul>
                <li class="blank">&nbsp;</li>
                <li><a href="payment_list.php" target="mainFrame">·学员缴费</a></li>
                <li><a href="spendment_list.php" target="mainFrame">·日常支出</a></li>
                <li class="blank">&nbsp;</li>
              </ul>
           </dd>
        </dl>
        </dd>

        <dd>
        <dl>
           <dt><img src="images/fd.png">查询汇总</dt>
           <dd>
              <ul>
                <li class="blank">&nbsp;</li>
                <li><a href="member_stat.php" target="mainFrame">·学员查询</a></li>
                <li><a href="payment_stat.php" target="mainFrame">·收费统计</a></li>
                <li><a href="spendment_stat.php" target="mainFrame">·支出统计</a></li>
                
                <li class="blank">&nbsp;</li>
              </ul>
           </dd>
        </dl>
        </dd>
		
		<dd>
        <dl>
           <dt><img src="images/xt.png">后台管理</dt>
           <dd>
              <ul>
                <li class="blank">&nbsp;</li>
                <li><a href="user_list.php" target="mainFrame">·权限管理</a></li>
				<?php
					if(canAdm()&& isHeadQuarter()) {
				?>
                <li><a href="cfg_list.php" target="mainFrame">·系统参数</a></li>
				<?php
					}
				?>
                <li><a href="notice_list.php" target="mainFrame">·系统公告</a></li>
				
                <li><a href="log_list.php" target="mainFrame">·登录日志</a></li>
				
                <li><a href="password_mant.php" target="mainFrame">·修改密码</a></li>				
                <li class="blank">&nbsp;</li>
              </ul>
           </dd>
        </dl>
        </dd>
    </dl>
</body>
</html>
