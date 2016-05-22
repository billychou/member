<?php
	/* Libchart - PHP chart library
	 * Copyright (C) 2005-2011 Jean-Marc Tr meaux (jm.tremeaux at gmail.com)
	 * 
	 * This program is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation, either version 3 of the License, or
	 * (at your option) any later version.
	 * 
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License
	 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
	 * 
	 */
	
	/**
	 * Multiple horizontal bar chart demonstration.
	 *
	 */

        include "libchart/classes/libchart.php";
        include "../php/book_fns.php";
        include "../php/db_fns.php";
        
        $output = get_sales_stat_month_info();
        print_r($output);

	$chart = new VerticalBarChart();
        $chart->getPlot()->getPalette()->setBarColor(array(
		new Color(255, 0, 0),
		new Color(255,215 ,0),
		new Color(0,0,255),
	));
	$serie1 = new XYDataSet();
	$serie1->addPoint(new Point("进货金额", 30));
	$serie1->addPoint(new Point("销售金额", 50));
	$serie1->addPoint(new Point("净利润", 70));
	$serie1->addPoint(new Point("欠款", 70));
	$serie1->addPoint(new Point("运费", 70));
	$serie1->addPoint(new Point("", 0));
	
	$serie2 = new XYDataSet();
	$serie2->addPoint(new Point("06-01", 10));
	$serie2->addPoint(new Point("06-02", 20));
	$serie2->addPoint(new Point("06-03", 30));
	$serie2->addPoint(new Point("06-04", 30));
        $serie2->addPoint(new Point("06-05", 30));
        $serie2->addPoint(new Point("", 0));
	
	$serie3 = new XYDataSet();
	$serie3->addPoint(new Point("06-01", 20));
	$serie3->addPoint(new Point("06-02", 30));
	$serie3->addPoint(new Point("06-03", 40));
	$serie3->addPoint(new Point("06-04", 40));
        $serie3->addPoint(new Point("06-05", 40));
        $serie3->addPoint(new Point("", 0));


	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("总金额", $serie1);
	$dataSet->addSerie("销售部", $serie2);
        $dataSet->addSerie("物流部", $serie3);

        
        $chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.65);
        
        $chart->setTitle("营收图(2013/06/01 - 2013/06/30)");

	$chart->render("bar.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Libchart line demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="bar.png" style="border: 1px solid gray;"/>
</body>
</html>
