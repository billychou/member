<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>375教育</title>
<script src='js/jquery-1.4.4.min.js' type='text/javascript' charset='uft-8'></script>
<script src="js/jquery.KinSlideshow-1.2.1.min.js" type="text/javascript"></script>
<script src="js/ignoreBackspace.js" type="text/javascript"></script>
<script>
$(function(){
	$("#KinSlideshow").KinSlideshow();
	 //滚动新闻条
	var $this = $("#notice");
	var scrollTimer;
	$this.hover(function(){
		  clearInterval(scrollTimer);
	 },function(){
	   scrollTimer = setInterval(function(){
					 scrollNews( $this );
				}, 3000 );
	}).trigger("mouseout");
	
});

function scrollNews(obj){
   var $self = obj.find("ul:first");
   var lineHeight = $self.find("li:first").height(); //获取行高 
   $self.animate({ "margin-top" : -lineHeight +"px" },600 , function(){
		 $self.css({"margin-top":"0px"}).find("li:first").appendTo($self); //appendTo能直接移动元素而不是复制，被appendto的元素位置发生变化
   })
}
</script>
<style>
.main{
	wdith:100%;
	height:100%;
	font-size:12px;
	margin:10px 10px 0px 28px;
	}
.main-top1{
	width:48%;
	height:100%;
	float:left;
	margin:0px 10px 10px 0px;
	border:1px solid #609cca;
	}
.main-title{
	width:98%;
	height:30px;
	line-height:30px;
	padding-left:10px;
	color:#036d99;
	font-weight:600;
	background:#a8d7fc;
	}

ul li{
	list-style:none;
	float:left;
	margin-right:5px;
	}
.kj{
	height:95px;
	*height:80px;
	}
.kj li:hover {
	background:url(images/an-bg.png);
	height:84px;
	width:76px;
}
.main-style	{
	padding:10px 0px 0px 15px;
	height:110px;
	}
.main-style ul{
    list-style:none; 
    margin:0;
    padding:0; 
    line-height:30px;
    }
.main-style	 ul li{
	height:110px;
	}
h1{
	font-size:12px;
	font-weight:600;
	color:#f00;
	float:left;
	}
.main-bt{
	width:100%;
	font-size:12px;
	font-weight:600;
	text-align:left;
	float:left;
}
.main-nr{
	width:100%;
	float:left;
	}
.main-style img{
	float:left;
	}

.main-center{
	font-size:12px;
	width:100%;
	height:100%;
	line-height:30px;
	color:#999;
	float:left;
	text-align:left;
}

#notice {
	overflow:hidden;
}
.date {
	float:right;
	margin-right:10px
}
</style>

</head>
<!--
<?php
	include ('php/db_fns.php');
	include ('php/book_fns.php');
	include ('php/auth_check.php');
?>
-->
<?php
    $notices = get_notice_list();
?>
<body>

<div class="main">
	<div class="main-top1">
    	<div class="main-title">
            快捷按钮
        </div>
		<ul class="kj">
        	<li><a href="member_mant.php?action=save"><img src="images/box.png" border="0"></a></li>
            <li><a href="payment_mant.php?action=save"><img src="images/hdcl.png" border="0"></a></li>

            <li><a href="member_list.php"><img src="images/thcx.png" border="0"></a></li>
            <li><a href="doc.html"><img src="images/search.png" border="0"></a></li>
        </ul>
    </div>
    
    <div class="main-top1">
    	<div class="main-title">
        系统公告
        </div>
        <div class="main-style" id="notice">
			<ul>
				<?php
					if($notices){
                        foreach ($notices as $notice) {
				?>
                    <li style="width:98%;">
						<span class="main-bt">
                            <img src="images/33.png" /> &nbsp;&nbsp;
                            <?php echo $notice["title"] ?>
                        </span>
						<span class="main-center">
                           <?php echo $notice['body']?>&nbsp;&nbsp;&nbsp;&nbsp;[<?php echo $notice['updatetime']?>]
                        </span>						
					</li>
				<?php	
							}
					}
				?>

			</ul>
        </div>
    </div>

    <div class="main-top1">
    	<div class="main-title">
            最新学员
        </div>
		<ul class="kj">
        	<li><a href="member_mant.php?action=save"><img src="images/box.png" border="0"></a></li>    
        </ul>
    </div>
    
    <div class="main-top1">
    	<div class="main-title">
            医学咨询
        </div>
		<ul class="kj">
        	<li></li>    
        </ul>
    </div>
</div>
</body>
</html>

