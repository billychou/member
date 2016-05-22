<?php 
session_start();
require_once (dirname(__FILE__)."/../php/book_fns.php");   
//require_once ("../php/admin_fns.php");
function back_db() {
	include dirname(__FILE__).'/../config/db_config.php';
	//$cfg_dbuser = "card_sc";
	//$cfg_dbpwd = "123456";
	//$cfg_dbname = "card_sc";
        //$cfg_host = "oa8106045.eicp.net";
        /*
		$cfg_dbuser = "root";
        $cfg_dbpwd = "hello123";
	$cfg_dbname = "card_sc";
        $cfg_host = "localhost";
		*/
	$cfg_dbuser = $gaSql['user'];
    $cfg_dbpwd = $gaSql['password'];
	$cfg_dbname = $gaSql['db'];
    $cfg_host = $gaSql['server'];
	$cfg_dbbak= $gaSql['db_backup'];
	//var_dump($gaSql);
	//exit;
    // 设置SQL文件保存文件名 
	$filename=gmdate('Y-m-d_H-i-s', time() + 3600 * 8)."-".$cfg_dbname.".sql"; 
	// 所保存的文件名 
	//header("Content-disposition:filename=".$filename); 
	//header("Content-type:application/octetstream"); 
	//header("Pragma:no-cache"); 
	//header("Expires:0"); 
	// 获取当前页面文件路径，SQL文件就导出到此文件夹内 
        //$tmpFile = (dirname(__FILE__))."\\".$filename; 
        //保存到服务器专门的路径下
    //$tmpFile = "F:\data_bak"."\\".$filename;
	$tmpFile = $cfg_dbbak."\\".$filename;
	//echo $tmpFile;
	$cmd = "mysqldump -h $cfg_host -u$cfg_dbuser -p$cfg_dbpwd --default-character-set=utf8 --routines $cfg_dbname > ".$tmpFile;
	// 用MySQLDump命令导出数据库 
	//echo $cmd;
	//exit;
        $result = exec($cmd); 
        //检查是否备份成功
        //检查条件：
        //1.备份文件存在
        //2.文件大小不能为0
        $result=true;
        if(!file_exists($tmpFile) || filesize($tmpFile) <= 0){
                //$result = "数据备份失败，请检查数据库!";
                //$result = false;
				return false;
        }
        //insert to backup log 
        $operator = isset($_SESSION['thisuser'])?$_SESSION['thisuser']['username']:"未知用户";
        $note = "数据备份";
        $time = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
        if(!insert_backup_log($time,$filename,$operator,$note)){
                echo "time:".$time."<br/>";
                echo "filename:".$filename."<br/>";
                echo "operator:".$operator."<br/>";
                echo "note:".$note."<br/>";
                echo "插入失败";
                $result = false;
        }
	//$file = fopen($tmpFile, "r"); // 打开文件 
	//echo fread($file,filesize($tmpFile)); 
	//fclose($file); 
	return $result; 
}

function restore_db($id){
       //get backup file name
       $bak_file = get_bak_file_by_id($id);
       //check if exist
       $tmpFile = "F:\data_bak"."\\".$bak_file['filename'];
       //$tmpFile = "c:\data_bak"."\\"."2013-06-18_00-39-35-new_db.sql";
       //echo $tmpFile;
       if(!file_exists($tmpFile) || filesize($tmpFile) <= 0){
                return false;
       }
 
       $cfg_dbuser = "root";
       $cfg_dbpwd = "hello123";
       $cfg_dbname = "card_sc";
       $cfg_host = "localhost";
       $cmd = "mysql -h $cfg_host -u$cfg_dbuser -p$cfg_dbpwd $cfg_dbname < ".$tmpFile;
       $result = exec($cmd,$output,$status);
       if(!$status){
           return false;
       } 
       return true;
}

function clear_db(){
        //$cfg_dbuser = "root";
        $cfg_dbpwd = "hello123";
	    $cfg_dbname = "card_sc";
        $cfg_host = "localhost";
        //echo "host:".$cfg_host."<br/>";
        //echo "user:".$cfg_dbuser."<br/>";
        //echo "pwd:".$cfg_dbpwd."<br/>";
        $conn = mysql_connect($cfg_host,$cfg_dbuser,$cfg_dbpwd); 
        if(!$conn) die("数据库系统连接失败！"); 
        mysql_select_db($cfg_dbname) or die("数据库连接失败！"); 
        $result = mysql_query("SHOW TABLES"); 
        while($row = mysql_fetch_array($result)) 
        { 
                //echo $row[0].""; 
                $query = "delete from ".$row[0];
                //echo $query."<br/>";
                $status = mysql_query($query);
                if(!$status){
                        //echo "清空数据库失败".$row[0];
                        $output=false;
                        break;
                }
        } 
        mysql_free_result($result);
        return true; 
}

?> 
