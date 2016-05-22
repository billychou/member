<?php
include "libchart/classes/libchart.php";
include "../php/book_fns.php";
include "../php/db_fns.php";

$output = get_sales_stat_month_info();
//print_r($output);
//exit;

$chart = new  VerticalBarChart(500, 250);
$dataSet = new XYDataSet();
$data = file('data.txt');
foreach($data as $item) {
    
    $item = trim($item, PHP_EOL);
    list($key,$value) = explode(' ', $item);
    if($key && $value) {
        $dataSet->addPoint(new Point($key, $value));
    }
}
$chart->setDataSet($dataSet);
$chart->setTitle("bar chart");
$chart->render("BarChart.jpg");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>bar chart</title>
<style type="text/css">
.show{
	margin:50px 500px;
}
</style>
</head>
<body>
<div ><img class="show" src="BarChart.jpg" /></div>
</body>
</html>
