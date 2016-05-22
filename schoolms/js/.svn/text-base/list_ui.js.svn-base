/*添加修改界面引入JS库列表
*/

/*引入通用样式*/
document.write("<link rel='stylesheet' type='text/css' href='style/jquery.dataTables_themeroller.css'>");
document.write("<link rel='stylesheet' type='text/css' href='style/themes/smoothness/jquery-ui-1.8.4.custom.css'>");
document.write("<link rel='stylesheet' type='text/css' href='style/list_style.css'>");


/*引入通用js*/
document.write("<script src='js/jquery-1.4.4.min.js' type='text/javascript' charset='uft-8'></script>");

/*jquery table 组件*/
document.write("<script src='js/jquery.dataTables.js' type='text/javascript' charset='uft-8'></script>");
//document.write("<script src='js/jquery.jeditable.js' type='text/javascript' charset='uft-8'></script>");
document.write("<script src='js/ZeroClipboard.js' type='text/javascript' charset='uft-8'></script>");
document.write("<script src='js/TableTools.js' type='text/javascript' charset='uft-8'></script>");
document.write("<script src='js/ColReorder.js' type='text/javascript' charset='uft-8'></script>");
//document.write("<script src='js/ColVis.js' type='text/javascript' charset='uft-8'></script>");
document.write("<link rel='stylesheet' type='text/css' href='style/TableTools.css'>");
document.write("<link rel='stylesheet' type='text/css' href='style/ColReorder.css'>");
//document.write("<link rel='stylesheet' type='text/css' href='style/ColVis.css'>");

/*提示弹出窗口*/
document.write("<script src='js/pop.js' type='text/javascript' charset='uft-8'></script>");

/*DatePicker*/
document.write("<script src='js/datepicker/WdatePicker.js' type='text/javascript' charset='uft-8'></script>");
document.write("<script src='js/list_init.js' type='text/javascript' charset='uft-8'></script>");

function commaSplit(srcNumber) {
	var txtNumber = '' + srcNumber;
	if (isNaN(txtNumber) || txtNumber == "") {
		fieldName.select();
		fieldName.focus();
	}
	else {
		var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
		var arrNumber = txtNumber.split('.');
		arrNumber[0] += '.';
		do {
			arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
		} while (rxSplit.test(arrNumber[0]));
		if (arrNumber.length > 1) {
			return arrNumber.join('');
		} else {
			return arrNumber[0].split('.')[0];
		}
	}
}
