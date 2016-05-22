<?php
header('Content-Type:text/html;charset=utf-8');
function db_connect() {
        //$result = new mysqli('localhost', 'card_sc', 'password', 'card_sc');
   $result = new mysqli('oa8106045.eicp.net', 'root', '', 'card_sc');
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
