<?php
include ('pinyin_fns.php');
	
	/*将字符串写入本地文件	
	参数$astr：要写入的字符串
	$filename：文件的路径及名称
	$abool：新增或者追加，如果true则将原来文件覆盖掉，如果false，则在原来基础上append
	*/
	function str_to_file($astr,$filename,$abool) {
	    if ($abool){
			$fp = fopen($filename,'w+,ccs=<UTF-8>');
			
		} else {
            $fp = fopen($filename,'a+,ccs=<UTF-8>');
		}
		
		fwrite($fp,$astr);
		fclose($fp);
	}
	
	/**
	读取文件到字符串
	参数$afile：文件的路径及名称
	*/
	function file_to_str($afile){
		$fp = fopen($afile,"rb,ccs=<UTF-8>");
	    $contents = fread($fp, filesize($afile));
        fclose($fp);
		$result = mb_convert_encoding($contents, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');
		return $result;
	}
	
	/*生成suggest的单位的提示文件，二维数组组成，
		var unittype = new Array();
		unittype[0] = new Array("单位ID","单位中文名","单位拼音全拼","单位首字母");
		unittype[1] = new Array('1','联想中国','lianxiangzhongguo','lxzg');
		
		参数说明：
		$units, PHP Array{{1,联想中国}，{2,联想国际}}
				eg.  $units = Array(Array("1","联想中国"),Array("2","联想国际"));
		$unittype, 标记现在生成的是什么单位的文件，这个决定了我将来生成的js文件的名字和数组的名字
		$flag,是否覆盖源文件，如果是true则覆盖（修改记录/删除记录），如果是false，则append（往往是添加记录才用的）
	*/
	function bookSuggestArray($units, $unittype, $flag) {
		$fileName = "../js/media/".$unittype.".js";
		$str = "";
		$crIndex = 0;
		
		if(!$flag && !is_file($fileName)){
			$flag = true;
		}
		
		if($flag) {
			$str = 'var '.$unittype.' = new Array();';
		} else {
			$crfileStr = file_to_str($fileName);
			$crIndex = substr_count($crfileStr,";") - 1;
		}
		for($i=0 ; $i< count($units);$i++) {
			$pinyin = Pinyin($units[$i][1],"1");
			$pinyinSZM = Pinyin_szm($units[$i][1],"1");
			$str = $str.$unittype."[".($i+$crIndex)."] = new Array('".$units[$i][0]."','".$units[$i][1]."','".$pinyin."','".$pinyinSZM."');";
		}
		
		str_to_file($str, $fileName,$flag);
	}
?>