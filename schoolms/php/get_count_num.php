<?php
function get_count_num(){
        $curdate = trim(gmdate('Y-m-d'));
        $countfile="count/count.txt";  //设置保存数据的文件
        if (!file_exists($countfile)){//判断文件是否存在
                exec( "echo 0 > $countfile");
        } 
        $datefile="count/date.txt";  //设置保存数据的文件
        if (!file_exists($datefile)){//判断文件是否存在
                exec( "echo $curdate > $datefile");
                exec( "echo 0 > $countfile");
        } 
   
        //get old date
        $df = fopen($datefile,"rw"); 
        $length=filesize($datefile);
        $lastdate = trim(fgets($df,$length)); 
        //echo "curdate:".$curdate;
        //echo "<br/>";
        //echo "lastdate:".$lastdate;
        if($curdate != $lastdate){
                //echo "curdate != lastdate";
                exec( "echo 0 > $countfile");
                exec( "echo $curdate > $datefile");
        }
        fclose($df);

        $fp = fopen($countfile,"rw"); 
        $length=filesize($countfile);
        $num = fgets($fp,$length); 
        $num = $num + 1; 
        exec( "rm -rf $countfile");
        exec( "echo $num > $countfile");
        fclose($fp);

        //echo "num:".$num;
        $billwayindex = $curdate."-".$num;
        return $billwayindex;
        
}
?>
