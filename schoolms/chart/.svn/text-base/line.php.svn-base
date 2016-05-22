<?php   
 /* CAT:Line chart */

 /* pChart library inclusions */
 include("class/pData.class.php");
 include("class/pDraw.class.php");
 include("class/pImage.class.php");

 include("book_fns.php");
 include("db_fns.php");
 include "test.php";
 
 $total = array(0,0,0,0,0,0,0,0,0,0,0,0);
 $sale = array(0,0,0,0,0,0,0,0,0,0,0,0);
 $profit = array(0,0,0,0,0,0,0,0,0,0,0,0);
 $debt = array(0,0,0,0,0,0,0,0,0,0,0,0);
 $driver = array(0,0,0,0,0,0,0,0,0,0,0,0);
 
 $output = get_sales_stat_month_info_total();
 if($output){
        foreach($output as $thismonth){
         //format:13-06
         $year = substr($thismonth['month'],0,2);
         $month = (int)substr($thismonth['month'],3,2) -1;
         //$total[$month]=number_format((float)$thismonth['salescost']/10000, 2, '.', '');
         $sale[$month]=number_format((float)$thismonth['applypay']/10000, 2, '.', '');
         $profit[$month]=number_format((float)$thismonth['salesrevenue']/10000, 2, '.', '');
         $debt[$month]=number_format((float)$thismonth['ownpay']/10000, 2, '.', '');
         $driver[$month]=number_format((float)$thismonth['driverpay']/10000, 2, '.', '');
        }
 } else{
        $year = substr(date("Y"),2,2);
 }

 $import = get_purchase_stat_month_info_total();
 if($import)
 {
        foreach($import as $thisimport){
          //format:13-06
         $month = (int)substr($thisimport['month'],3,2) -1;
         $total[$month]=number_format((float)$thisimport['purchasevalue']/10000, 2, '.', '');
        }
 }
 /*
 echo date("Y");
 echo "<br/>";
 var_dump($output);
 echo "<br/>";
 var_dump($import);
 exit;
  */

 $MyData = new pData();  
 $MyData->addPoints($total,"进货金额");
 $MyData->addPoints($sale,"销售金额");
 $MyData->addPoints($profit,"净利润额");
 $MyData->addPoints($debt,"欠款金额");
 $MyData->addPoints($driver,"运费金额");

 $MyData->setSerieWeight("Probe 1",2);
 $MyData->setSerieTicks("Probe 2",4);
 $MyData->setAxisName(0,"金额(万元)");
 $MyData->addPoints(array("一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"),"Labels");
 $MyData->setSerieDescription("Labels","Months");
 $MyData->setAbscissa("Labels");

 /* Create the pChart object */
 $myPicture = new pImage(800,310,$MyData);

 /* Turn of Antialiasing */
 $myPicture->Antialias = FALSE;

 /* Draw the background */
 $Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
 //$Settings = array("R"=>0, "G"=>0, "B"=>0, "Dash"=>1, "DashR"=>0, "DashG"=>0, "DashB"=>0);
 //$myPicture->drawFilledRectangle(0,0,800,310,$Settings);

 /* Overlay with a gradient */
 $Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
 //$Settings = array("StartR"=>255, "StartG"=>255, "StartB"=>255, "EndR"=>1, "EndG"=>255, "EndB"=>255, "Alpha"=>255);
 //$myPicture->drawGradientArea(0,0,800,310,DIRECTION_VERTICAL,$Settings);
 $myPicture->drawGradientArea(0,0,800,30,DIRECTION_VERTICAL,array("StartR"=>177,"StartG"=>220,"StartB"=>252,"EndR"=>148,"EndG"=>205,"EndB"=>252,"Alpha"=>100));

 /* Add a border to the picture */
 $myPicture->drawRectangle(0,0,799,309,array("R"=>4,"G"=>98,"B"=>172));
 
 /* Write the picture title */ 
 $myPicture->setFontProperties(array("FontName"=>"fonts/SIMHEI.TTF","FontSize"=>8,"R"=>4,"G"=>98,"B"=>172));
 $myPicture->drawText(10,24,"营收状况(销售部+物流部)逐月走势总览",array("FontSize"=>15,"Align"=>TEXT_ALIGN_BOTTOMLEFT));

   /* Write the chart title */ 
 $myPicture->setFontProperties(array("FontName"=>"fonts/SIMHEI.TTF","FontSize"=>11,"R"=>0,"G"=>0,"B"=>0));
 $myPicture->drawText(380,65,"营收走势图("."20".$year."年度)",array("FontSize"=>14,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

 /* Set the default font */
 $myPicture->setFontProperties(array("FontName"=>"fonts/SIMHEI.TTF","FontSize"=>10,"R"=>0,"G"=>0,"B"=>0));


 /* Define the chart area */
 $myPicture->setGraphArea(60,65,750,260);

 /* Draw the scale */
 $scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
 //$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>255,"GridG"=>255,"GridB"=>255,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
 $myPicture->drawScale($scaleSettings);

 /* Turn on Antialiasing */
 $myPicture->Antialias = TRUE;

 /* Enable shadow computing */
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
 //$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>255,"G"=>255,"B"=>255,"Alpha"=>0));

 /* Draw the line chart */
 $myPicture->drawLineChart();
 $myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>1,"DisplayOffset"=>1,"Surrounding"=>-60,"BorderAlpha"=>80));

 /* Write the chart legend */
 $myPicture->drawLegend(400,290,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL,"FontR"=>0,"FontG"=>0,"FontB"=>0));

 /* Render the picture (choose the best way) */
 $myPicture->autoOutput("example.drawLineChart.plots.png");
?>
