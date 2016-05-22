<?php    
 /* CAT:Bar Chart */ 

 /* pChart library inclusions */ 
 include("pChart/class/pData.class.php"); 
 include("pChart/class/pDraw.class.php"); 
 include("pChart/class/pImage.class.php"); 
 //include ('php/db_fns.php');
 //include ('php/book_fns.php');

 /* Create and populate the pData object */ 
 $MyData = new pData();   
 $MyData->loadPalette("palettes/light.color",TRUE); 
 $MyData->addPoints(array(1000,640,600,900,840),"总全额"); 
 $MyData->addPoints(array(150,220,300,650,420),"销售部"); 
 $MyData->addPoints(array(350,420,300,250,420),"物流部"); 
 $MyData->setAxisName(0,"数量"); 
 $MyData->addPoints(array("06-01","06-02","06-03","06-04","06-05"),"Labels");
 $MyData->setAbscissa("Labels"); 

 /* Create the pChart object */ 
 $myPicture = new pImage(700,230,$MyData); 
 $myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,array("StartR"=>240,"StartG"=>240,"StartB"=>240,"EndR"=>180,"EndG"=>180,"EndB"=>180,"Alpha"=>100)); 
 $myPicture->setFontProperties(array("FontName"=>"pChart/fonts/SIMHEI.TTF","FontSize"=>6)); 

 /* Draw the scale  */ 
 $myPicture->setGraphArea(50,30,680,200); 
 $scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
 $myPicture->drawScale(array("CycleBackground"=>TRUE,"DrawSubTicks"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"GridAlpha"=>10)); 
 $myPicture->drawScale($scaleSettings); 

 
 
 /* Turn on shadow computing */  
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 

 /* Draw the chart */ 
 $settings = array("Gradient"=>TRUE,"GradientMode"=>GRADIENT_EFFECT_CAN,"DisplayPos"=>LABEL_POS_INSIDE,"DisplayValues"=>TRUE,"DisplayR"=>255,"DisplayG"=>255,"DisplayB"=>255,"DisplayShadow"=>TRUE,"Surrounding"=>10);
 $myPicture->drawBarChart($settings); 

 /* Write the chart legend */ 
 $myPicture->drawLegend(580,12,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_VERTICAL)); 

 /* Render the picture (choose the best way) */ 
 $myPicture->autoOutput("bar.png"); 
