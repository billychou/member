<?php
 error_reporting(E_ALL);
 /* CAT:Bar Chart */
 //header("Content-Type: text/html; charset=UTF-8");
 /* pChart library inclusions */
 include("class/pData.class.php");
 include("class/pDraw.class.php");
 include("class/pImage.class.php");
 include("book_fns.php");
 include("db_fns.php");
 include "test.php";

  $preDate = gmdate('Y-m-d', time()- 86400 + 3600 * 8);
  $curDate = gmdate('Y-m-d', time() + 3600 * 8);
  $startDate = isset($_GET['startDate']) && $_GET['startDate'] !="" ? $_GET['startDate'] : $preDate;
  $endDate = isset($_GET['endDate']) && $_GET['endDate'] !="" ? $_GET['endDate'] : $curDate;


 //echo "startDate:".$startDate."<br/>";
 //echo "endDate:".$endDate."<br/>";
 //echo "curDate:".$curDate."<br/>";
 //exit;
 //$output = get_sales_stat_month_info();
 //$startDate = "2013-05-06";
 //$endDate = "2013-07-06";
 $total = array(0,0,0,0,0);
 $dpt1 = array(0,0,0,0,0);
 $dpt2 = array(0,0,0,0,0);
 $dptname1 = "销售部";
 $dptname2 = "物流部";

 $importvalue1 = 0;
 $importvalue2 = 0;
 $import = get_purchase_stat_period_info($startDate,$endDate); 
 if($import){
        if(count($import) == 1){
                $importvalue1 = $import[0]['purchasevalue'];
        }else if(count($import) == 2){
                $importvalue1 = $import[0]['purchasevalue'];
                $importvalue2 = $import[1]['purchasevalue'];
        }      
 }
 $output = get_sales_stat_period_info($startDate,$endDate); 
 //var_dump($output);
 //exit;
 if($output){
         //only one department
         if(count($output) == 1){
                $total = array($importvalue1,$output[0]['applypay'],$output[0]['salesrevenue'],$output[0]['ownpay'],$output[0]['driverpay']);
                $dpt1= array($import[0]['purchasevalue'],$output[0]['applypay'],$output[0]['salesrevenue'],$output[0]['ownpay'],$output[0]['driverpay']);
                $dptname1= $output[0]['department'];
         //two department
         }else if(count($output) == 2){
                $total = array($importvalue1+ $importvalue2,$output[0]['applypay']+$output[1]['applypay'],$output[0]['salesrevenue']+$output[1]['salesrevenue'],$output[0]['ownpay']+$output[1]['ownpay'],$output[0]['driverpay']+$output[1]['driverpay']);
                $dpt1= array($importvalue1,$output[0]['applypay'],$output[0]['salesrevenue'],$output[0]['ownpay'],$output[0]['driverpay']);
                $dpt2= array($importvalue2,$output[1]['applypay'],$output[1]['salesrevenue'],$output[1]['ownpay'],$output[1]['driverpay']);
                $dptname1= $output[0]['department'];
                $dptname2= $output[1]['department'];
         //more than two department,it must be something wrong
         }       
         //}else{
         //       exit;
         //}
 }
 
 $index = 0;
 foreach($total as $thiselem){
        $total[$index++] = number_format($thiselem/10000, 2, '.', '');
 }
 $index=0;
 foreach($dpt1 as $thiselem){
        $dpt1[$index++] = number_format($thiselem/10000, 2, '.', '');
 }
 $index=0;
 foreach($dpt2 as $thiselem){
        $dpt2[$index++] = number_format($thiselem/10000, 2, '.', '');
 }
 
 //$output = test();
 //var_dump($output);
 //echo "<br/>";
 //var_dump($import);
 //exit;
 //print_r($output);
 //echo $output[0]['takeamount'];
 //echo $output[0]['shiprevenue'];
 //exit;
 /* Create and populate the pData object */

 $dptname1 == "log" ? $dptname1 = "物流部" : $dptname1;
 $dptname1 == "sales" ? $dptname1 = "销售部" : $dptname1;
 $dptname2 == "log" ? $dptname2 = "物流部" : $dptname2;
 $dptname2 == "sales" ? $dptname2 = "销售部" : $dptname2;


 $MyData = new pData();  
 $MyData->addPoints($total,"总金额");
 $MyData->addPoints($dpt1,$dptname1);
 $MyData->addPoints($dpt2,$dptname2);

 /* Will replace the whole color scheme by the "light" palette */ 
 //$MyData->loadPalette("palettes/evening.color", TRUE);

 
 
 $MyData->setSerieTicks("Probe 2",4);
 $MyData->setAxisName(0,"金额(万元)");
 $MyData->addPoints(array("进货金额","销售金额","净利润额","欠款金额","运费金额"),"Labels");
 $MyData->setSerieDescription("Labels","Months");
 $MyData->setAbscissa("Labels");

 /* Create the pChart object */
 //$myPicture = new pImage(700,230,$MyData);
 $myPicture = new pImage(800,310,$MyData);

 /* Draw the background */
 $Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
 //$myPicture->drawFilledRectangle(0,0,800,310,$Settings);

 /* Overlay with a gradient */
 $Settings = array("StartR"=>252, "StartG"=>254, "StartB"=>255, "EndR"=>1, "EndG"=>255, "EndB"=>255, "Alpha"=>255);
 //$myPicture->drawGradientArea(0,0,800,310,DIRECTION_VERTICAL,$Settings);
 $myPicture->drawGradientArea(0,0,800,30,DIRECTION_VERTICAL,array("StartR"=>177,"StartG"=>220,"StartB"=>252,"EndR"=>148,"EndG"=>205,"EndB"=>252,"Alpha"=>100));

 /* Add a border to the picture */
 $myPicture->drawRectangle(0,0,799,309,array("R"=>4,"G"=>98,"B"=>172));
 
 /* Write the picture title */ 
 $myPicture->setFontProperties(array("FontName"=>"fonts/SIMHEI.TTF","FontSize"=>12));
 $myPicture->drawText(10,23,"实时|分时营收状况总览",array("FontSize"=>15,"R"=>4,"G"=>98,"B"=>172));

 /* Write the chart title */ 
 $myPicture->setFontProperties(array("FontName"=>"fonts/SIMHEI.TTF","FontSize"=>10));
 $myPicture->drawText(280,65,"营收图(".$startDate."至".$endDate.")",array("FontSize"=>14,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

 /* Draw the scale and the 1st chart */
 $myPicture->setGraphArea(60,80,530,260);
 //$myPicture->drawFilledRectangle(60,80,530,260,array("R"=>0,"G"=>0,"B"=>0,"Surrounding"=>50,"Alpha"=>20));
 $myPicture->drawScale(array("DrawSubTicks"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE));
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>5));
 $myPicture->setFontProperties(array("FontName"=>"fonts/SIMHEI.TTF","FontSize"=>10));
 //$myPicture->drawBarChart(array("DisplayValues"=>TRUE,"DisplayColor"=>DISPLAY_AUTO,"Rounded"=>TRUE,"Surrounding"=>50));
 $myPicture->drawBarChart(array("DisplayPos"=>LABEL_POS_INSIDE,"DisplayOrientation"=>ORIENTATION_VERTICAL,"DisplayValues"=>TRUE,"Rounded"=>TRUE,"Surrounding"=>50));
 $myPicture->setShadow(FALSE);

 /* Draw the scale and the 2nd chart */
 $myPicture->setGraphArea(600,80,780,260);
 //$myPicture->drawFilledRectangle(600,80,780,260,array("R"=>0,"G"=>0,"B"=>0,"Surrounding"=>-200,"Alpha"=>20));
 $myPicture->drawScale(array("Pos"=>SCALE_POS_TOPBOTTOM,"DrawSubTicks"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE));
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>5));
 $myPicture->drawBarChart();
 $myPicture->setShadow(FALSE);

 /* Write the chart legend */
 $myPicture->drawLegend(550,285,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

 /* Render the picture (choose the best way) */
 $myPicture->autoOutput("example.drawBarChart.png"); 
?>
