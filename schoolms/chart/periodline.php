<?php   
 /* CAT:Line chart */

 /* pChart library inclusions */
 include("class/pData.class.php");
 include("class/pDraw.class.php");
 include("class/pImage.class.php");

 
 include("book_fns.php");
 include("db_fns.php");
 //include "test.php";
 
 $sales = array(0,0,0,0,0);
 $customerid = isset($_GET['customerid']) && $_GET['customerid'] !="" ? $_GET['customerid'] : "";
 $intervalday = isset($_GET['period']) && $_GET['period'] !="" ? $_GET['period'] : 7;
 $name="";
 if($customerid !=""){
 $thiscustomer = get_customer_info_by_id($customerid);
 $name = $thiscustomer['name'];
 //$name="测试单位";
 $output = get_bill_customer_period_list($intervalday,$name);
 if($output){
 //foreach($output as $thisperiod){
 //        if($thisperiod['customername'] == $name){
                 $sales[0] = $output['per5Mount'];
                 $sales[1] = $output['per4Mount'];
                 $sales[2] = $output['per3Mount'];
                 $sales[3] = $output['lastPerMount'];
                 $sales[4] = $output['thisPerMount'];
//         }
// }
 }
 }
 //echo "name:".$name."<br/>";
 //echo "intervalday:".$intervalday."<br/>";
 //echo "s0:".$sales[0]."<br/>";
 //var_dump($output);
 //var_dump($thiscustomer);
 //exit;
 
 //$sales = array(0,0,0,0,0);
 //$name="测试单位";
 $MyData = new pData();  
 $MyData->addPoints($sales,$name);

 $MyData->setSerieWeight("Probe 1",2);
 $MyData->setSerieTicks("Probe 2",4);
 $MyData->setAxisName(0,"单位(吨)");
 $MyData->addPoints(array("前四周期","前三周期","前二周期","前一周期","本周期"),"Labels");
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
 $myPicture->drawText(10,24,"客户周期销售业绩环比图",array("FontSize"=>12,"Align"=>TEXT_ALIGN_BOTTOMLEFT));

   /* Write the chart title */ 
 $myPicture->setFontProperties(array("FontName"=>"fonts/SIMHEI.TTF","FontSize"=>11,"R"=>0,"G"=>0,"B"=>0));
 $myPicture->drawText(380,65,"销售业绩环比图("."一周期 = ".$intervalday."天)",array("FontSize"=>14,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

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
 $myPicture->drawLegend(630,290,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL,"FontR"=>0,"FontG"=>0,"FontB"=>0));

 /* Render the picture (choose the best way) */
 $myPicture->autoOutput("example.drawLineChart.plots.png");
?>

