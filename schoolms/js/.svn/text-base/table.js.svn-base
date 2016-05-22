
$(document).ready(function(){
	 $(".stripe_tb tr").mouseover(function(){ //如果鼠标移到class为stripe_tb的表格的tr上时，执行函数
	 $(this).addClass("over");}).mouseout(function(){ //给这行添加class值为over，并且当鼠标一出该行时执行函数
	 $(this).removeClass("over");}) //移除该行的class
	 $(".stripe_tb tr:even").addClass("alt"); //给class为stripe_tb的表格的偶数行添加class值为alt
	 
	  $( "#datepicker1").datepicker({
		  	dateFormat:'yy-mm-dd',
		  });
		  $("#datepicker2").datepicker({
			  dateFormat:'yy-mm-dd',
		 })
});

function process(id) {
	$.ajax({    
        type:'post',        
        url:'update.php',    
        data:'id='+id,    
        dataType:'json',    
        success:function(data){   
        	alert(data);
        }    
    });   
}

function process_all() {
	var chk_value =[];  
	  $('input[name="check_id[]"]:checked').each(function(){  
	   chk_value.push($(this).val());  
	  });  
	  alert(chk_value.join(','));
	  alert(chk_value.length==0 ?'你还没有选择任何内容！':chk_value);  
	
}
function select_all() {
	$("input[name='check_id[]']").each(function() { 
		$(this).attr("checked", true); 
	}); 
}




