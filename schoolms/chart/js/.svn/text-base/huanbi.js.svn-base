
$(document).ready(function(){
	 $(".stripe_tb tr").mouseover(function(){ //如果鼠标移到class为stripe_tb的表格的tr上时，执行函数
	 $(this).addClass("over");}).mouseout(function(){ //给这行添加class值为over，并且当鼠标一出该行时执行函数
	 $(this).removeClass("over");}) //移除该行的class
	 $(".stripe_tb tr:even").addClass("alt"); //给class为stripe_tb的表格的偶数行添加class值为alt
	 
	 $( "#datepicker1").datepicker({
		  	dateFormat:'yy-mm-dd',
		  });
		 
});


function show_huanbi(id) {
	$.ajax({
        url:"hb.php?id="+id,
        type:"get",
        success: function(){
        	var t = Date.parse(new Date());
//        	document.getElementById('line_chart').setAttribute('src','LineChartHuanbi.jpg?v=t');
        	var html_str = '<img class="show" id="line_chart" src="LineChartHuanbi.jpg?v=' + t + '" />';
        	html_str +='<img class="show" id="pie_chart" src="PieChartHuanbi.jpg?v=' + t + '" />';
        	$('#picture_area').html(html_str);
//        	if($.browser.msie || $.browser.mozilla) {
//        		document.getElementById('line_chart').setAttribute('src','LineChartHuanbi.jpg?v=t');
//        	}else {
//        		$("#line_chart").attr('src','LineChartHuanbi.jpg?v=t');
//        	}
        	
        	
//        	document.getElementById('line_chart').setAttribute('src','LineChartHuanbi.jpg?v=t');
        	
//        	$("#pie_chart").attr('src','PieChartHuanbi.jpg?v=t');
        }
	});
}



