function get_list_init(mheight,sort,order) {
	if(mheight == null) {
		mheight = 210;
	}
	if(sort == null) {
		sort = 0;
	}
	
	if(order == 0) {
		order = 'asc';
	} else {
		order = 'desc';
	}
	
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
	
	
	var height = $(window).height()-mheight;
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
		"iDisplayLength": 10,
		"sScrollX": "100%",
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
		"aaSorting": [[ sort, order ]],
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
	
	return oTable;
}