<?php 




function back_db() {
	$cfg_dbuser = "card_sc";
	$cfg_dbpwd = "123456";
	$cfg_dbname = "card_sc";
	$cfg_host = "oa8106045.eicp.net";

	// 设置SQL文件保存文件名 
	$filename=gmdate('Y-m-d H:i:s', time() + 3600 * 8)."-".$cfg_dbname.".sql"; 
	// 所保存的文件名 
	//header("Content-disposition:filename=".$filename); 
	//header("Content-type:application/octetstream"); 
	//header("Pragma:no-cache"); 
	//header("Expires:0"); 
	// 获取当前页面文件径，SQL文件就导出到此文件夹内 
        //$tmpFile = (dirname(__FILE__))."\\".$filename; 
        $tmpFile = "c:"."\\".$filename;
        $cmd = "mysqldump -h $cfg_host -u$cfg_dbuser -p$cfg_dbpwd --default-character-set=utf8 $cfg_dbname > ".$tmpFile;
        //$cmd = "mysqldump -h $cfg_host -u$cfg_dbuser -p$cfg_dbpwd --default-character-set=utf8 $cfg_dbname >";
        echo $cmd;
        //exit;
	// 用MySQLDump命令导出数据库 

        //exec("mysqldump -uroot   -p123   card_sc > ");	
	$result = exec($cmd); 
	$file = fopen($tmpFile, "r"); // 打开文件 
	echo fread($file,filesize($tmpFile)); 
	fclose($file); 
	exit; 
}
?> 
