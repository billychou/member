<?php
 /* CAT:Bar Chart */
 //header("Content-Type: text/html; charset=UTF-8");
 /* pChart library inclusions */
 include("pChart/class/pData.class.php");
 include("pChart/class/pDraw.class.php");
 include("pChart/class/pImage.class.php");
 /* Create and populate the pData object */
 $MyData = new pData();  
 $MyData->addPoints(array(-4,5,6,12,8,3),"Probe 1");
 $MyData->addPoints(array(3,12,15,8,5,-5),"Probe 2");
 $MyData->addPoints(array(2,0,5,18,19,22),"Probe 3");


 $MyData->setSerieTicks("Probe 2",4);
 $MyData->setAxisName(0,"cost");
 $MyData->addPoints(array("jinhuo","Feb","Mar","Apr","May","Jun"),"Labels");
 $MyData->setSerieDescription("Labels","Months");
 $MyData->setAbscissa("Labels");

 /* Create the pChart object */
 $myPicture = new pImage(700,230,$MyData);

 /* Draw the background */
 $Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
 $myPicture->drawFilledRectangle(0,0,900,400,$Settings);

 /* Overlay with a gradient */
 $Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
 $myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);
 $myPicture->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>80));

 /* Add a border to the picture */
 $myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));
 
 /* Write the picture title */ 
 $myPicture->setFontProperties(array("FontName"=>"pChart/fonts/Silkscreen.ttf","FontSize"=>6));
 $myPicture->drawText(10,13,"drawBarChart() - draw a bar chart",array("R"=>255,"G"=>255,"B"=>255));

 /* Write the chart title */ 
 $myPicture->setFontProperties(array("FontName"=>"pChart/fonts/Forgotte.ttf","FontSize"=>11));
 $myPicture->drawText(250,55,"Average temperature",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

 /* Draw the scale and the 1st chart */
 $myPicture->setGraphArea(60,60,450,190);
 $myPicture->drawFilledRectangle(60,60,450,190,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));
 $myPicture->drawScale(array("DrawSubTicks"=>TRUE));
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
 $myPicture->setFontProperties(array("FontName"=>"pChart/fonts/pf_arma_five.ttf","FontSize"=>6));
 $myPicture->drawBarChart(array("DisplayValues"=>TRUE,"DisplayColor"=>DISPLAY_AUTO,"Rounded"=>TRUE,"Surrounding"=>30));
 $myPicture->setShadow(FALSE);

 /* Draw the scale and the 2nd chart */
 $myPicture->setGraphArea(500,60,670,190);
 $myPicture->drawFilledRectangle(500,60,670,190,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));
 $myPicture->drawScale(array("Pos"=>SCALE_POS_TOPBOTTOM,"DrawSubTicks"=>TRUE));
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
 $myPicture->drawBarChart();
 $myPicture->setShadow(FALSE);

 /* Write the chart legend */
 $myPicture->drawLegend(510,205,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

 /* Render the picture (choose the best way) */
 $myPicture->autoOutput("pictures/example.drawBarChart.png");
?>