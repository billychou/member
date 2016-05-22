<?php
error_reporting(E_ALL);
header("Content-Type:text/html;charset=utf-8");
// line chart
$data = array("数据1"=>array('06-01'=>273,'06-02'=>421,'06-03'=>142),
              "数据2"=>array('06-01'=>780,'06-02'=>300,'06-03'=>912)
              );
function line_chart(array $data) {
    include "libchart/classes/libchart.php";
    $dataSet = new XYSeriesDataSet();
    foreach($data as $key1=>$item) {
        $serie =  new XYDataSet();
        foreach($item as $key=>$value) {
            $serie->addPoint(new Point($key, $value));
        }
        $key1 = mb_convert_encoding($key1, "html-entities","utf-8" );
        $dataSet->addSerie($key1, $serie);
    }
    $chart = new LineChart(500, 250);
	$chart->setDataSet($dataSet);
    $chart->setTitle("line chart");
    $chart->render("LineChart.jpg");
}
line_chart($data);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>line chart</title>
<style type="text/css">
.show{
	margin:50px 500px;
}
</style>
</head>
<body>
<div ><img class="show" src="LineChart.jpg" /></div>
</body>
</html>
<?php
exit;
// pie chart
include "libchart/classes/libchart.php";
$chart = new  PieChart(500, 250);
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
$chart->setTitle("pie chart");
$chart->render("PieChart.jpg");*/
