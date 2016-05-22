<?php
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$data = array("1"=>array("06-01"=>100, '06-02'=>80,'06-03'=>-20),
              "2"=>array('06-01'=>110,'06-02'=>100,'06-03'=>-10),
              "3"=>array('06-01'=>120,'06-02'=>100,'06-03'=>20)
              );
function line_chart(array $data, $id) {
    include "libchart/classes/libchart.php";
    $chart = new LineChart(500, 250);
    $dataSet = new XYDataSet();
    $temp = $data[$id];
    
    foreach($temp as $key=>$value) {
        $dataSet->addPoint(new Point($key, $value));
    }
    $title = "当前用户";
    $title = mb_convert_encoding($title, "html-entities","utf-8" );
    $chart->setDataSet($dataSet);
    $chart->setTitle($title);
    $chart->render("LineChartHuanbi.jpg");
}
line_chart($data, $id);
//echo $id;
function pie_chart() {
    include "libchart/classes/libchart.php";
    $chart = new PieChart(500, 250);
    $dataSet = new XYDataSet();
    $temp = array('张三'=>100,'李四'=>110,'王五'=>120);
    
    foreach($temp as $key=>$value) {
        $dataSet->addPoint(new Point($key, $value));
    }
    $title = "用户";
    $title = mb_convert_encoding($title, "html-entities","utf-8" );
    $chart->setDataSet($dataSet);
    $chart->setTitle($title);
    $chart->render("PieChartHuanbi.jpg");
    
}
pie_chart();