﻿<?php
header('Content-Type:text/html;charset=utf-8');


function db_connect() {
   //mysql connection configuration 
   include dirname(__FILE__).'/../config/db_config.php';
   $result = new mysqli($gaSql['server'], $gaSql['user'],$gaSql['password'],$gaSql['db'] );
   if (mysqli_connect_errno()) {
       echo 'Error: Could not connect to database.Please try again later.';
       exit;
   }
   if (!$result) {
      echo 'Error:Could not connect to database.Please try again later.';
      return false;
   }
   $result->autocommit(TRUE);
   $result->query("SET NAMES UTF8");
   return $result;
}

function db_result_to_array($result) {
   $res_array = array();

   for ($count=0; $row = $result->fetch_assoc(); $count++) {
     $res_array[$count] = $row;
   }
   return $res_array;
}
?>