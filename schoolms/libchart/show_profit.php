<?php
$data = array("已发金额"=>array('06-01'=>100,'06-02'=>200,'06-03'=>50),
              "销售金额"=>array('06-01'=>200,'06-02'=>400,'06-03'=>300),
              "净利润"=>array('06-01'=>800,'06-02'=>600,'06-03'=>900),
              "欠款"=>array('06-01'=>20,'06-02'=>40,'06-03'=>10),
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
    $chart->render("LineChartProfit.jpg");
}
line_chart($data);

function pie_chart() {
    include "libchart/classes/libchart.php";
    $chart = new PieChart(500, 250);
    $dataSet = new XYDataSet();
    $temp = array('A部门'=>10000,'B部门'=>13310,'C部门'=>54120);
    
    foreach($temp as $key=>$value) {
        $dataSet->addPoint(new Point($key, $value));
    }
    $title = "部门利润";
    $title = mb_convert_encoding($title, "html-entities","utf-8" );
    $chart->setDataSet($dataSet);
    $chart->setTitle($title);
    $chart->render("PieChartProfit.jpg");
    
}
pie_chart();