<?php
header('Content-Type:text/html;charset=utf-8');

function calculate_shipping_cost() {
  // as we are shipping products all over the world
  // via teleportation, shipping is fixed
  return 20.00;
}

function get_categories() {
   // query database for a list of categories
   $conn = db_connect();
   $query = "select catid, catname from categories";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_concrete() {
   // query database for a list of concrete
   $conn = db_connect();
   //$query = "select * from concrete";
   $query = "SELECT concrete .* ,factory.name AS factoryname"
			." FROM concrete"
			." LEFT JOIN factory ON concrete.factoryid = factory.id";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_concrete_name() {
   // query database for a list of concrete
   $conn = db_connect();
   $query = " select distinct name from concrete";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_concrete_spc() {
   // query database for a list of concrete
   $conn = db_connect();
   $query = " select distinct spc from concrete";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_bill_with_amount() {
   // query database for a list of concrete
   $conn = db_connect();
   $query = "select * from importbill where amount > 0.00";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_max_id_by_table($table,$idname) {
   // query database for a list of concrete
   $conn = db_connect();
   $idname = $idname=="" ? "id" : $idname;
   $query = "select max(".$idname.") as id from ".$table." where 1=1";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
    $result = db_result_to_array($result);
   return $result[0]['id'];
}


function get_bill_with_amount_by_purunit($purunit) {
   // query database for a list of concrete
   $conn = db_connect();
   $query = "select * from importbill where amount > 0.00 and purunit ='".$purunit."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "<br/>";      
     echo "查询数据失败!";
     echo "<br/>";
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
       //echo "返回数据为空!";
       return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_bill_with_amounttofactory_by_purunit($purunit) {
   // query database for a list of concrete
   $conn = db_connect();
   $query = "select * from importbill where amounttofactory > 0.00 and purunit ='".$purunit."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "<br/>";      
     echo "查询数据失败!";
     echo "<br/>";
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
       //echo "返回数据为空!";
       return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_bill_with_more_than_1_by_purunit($purunit) {
   // query database for a list of concrete
   $conn = db_connect();
   $query = "select * from importbill where amount > 0.00 and purunit ='".$purunit."'";
   $result = @$conn->query($query);
   if (!$result) {
     echo "<br/>";      
     echo "查询数据失败!";
     echo "<br/>";
     return false;
   }
   $num_cats = @$result->num_rows;
   echo "num:".$num_cats;
   echo "<br/>";
   if ($num_cats <= 1) {
       //echo "返回数据为空!";
       return false;
   }
   $result = db_result_to_array($result);
   return $result;
}


function get_distinct_concrete_name_from_import_bill() {
   // query database for a list of concrete
   $conn = db_connect();
   $query = "select distinct concretename from importbill";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_bill_with_amount_by_num($num) {
   // query database for a list of concrete
   $conn = db_connect();
   $query = "select * from importbill where billindex='".$num."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}


function get_user_info_by_id($id){
 // query database for a list of concrete
   $conn = db_connect();
      //$query = "select * from concrete where concreteid = '".$concreteid."'";
   
   $query = "SELECT *"
			." FROM admin"
			." WHERE id ='".$id."'";
   
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}


function get_concrete_info_by_id($concreteid){
 // query database for a list of concrete
   $conn = db_connect();
      //$query = "select * from concrete where concreteid = '".$concreteid."'";
   
   $query = "SELECT concrete .* , factory.id AS factoryid, factory.name AS factoryname"
			." FROM concrete, factory"
			." WHERE concreteid ='".$concreteid."'"
			." AND concrete.factoryid = factory.id";
   
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_concrete_info_by_factoryid($factoryid){
 // query database for a list of concrete
   $conn = db_connect();
      //$query = "select * from concrete where concreteid = '".$concreteid."'";
   
   $query = "SELECT concrete .* , factory.id AS factoryid, factory.name AS factoryname"
			." FROM concrete, factory"
			." WHERE factoryid ='".$factoryid."'"
			." AND concrete.factoryid = factory.id";
   
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_card_info($card_num){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from card where cardindex = '".$card_num."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_driver(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from driver";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_driver_for_sale(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from driver where department='sale'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_driver_for_dist(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from driver where department='dist'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}


function get_driver_name(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select distinct name from driver";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_driver_info_by_name($name){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from driver where name = '".$name."'" ;
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_driver_info_by_id($driver_id){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from driver where driverId = '".$driver_id."'" ;
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_driver_by_id($driver_id){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from driver where driverId = '".$driver_id."'" ;
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   $thisdriver=$result[0];
   $output = array();
   $output['name'] = $thisdriver['name'];
   $output['frontNum']=$thisdriver['frontNum'];
   $output['backNum']=$thisdriver['backNum'];
   $output['carSize']=$thisdriver['carSize'];
   $output['phoneNum'] =$thisdriver['phoneNum'];
   return $output;
}

function get_card_info_by_customername($customername){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from card where customername = '".$customername."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_customer_info_by_name($customername){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from customer where name = '".$customername."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   //echo $num_cats;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_customer_info_by_id($customerid){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from customer where customerid = '".$customerid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   //echo $num_cats;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_customer_by_id($customerid){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from customer where customerid = '".$customerid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   //echo $num_cats;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   $thiscustomer = $result[0];
   $output = array();
   $output['name'] = $thiscustomer['name'];
   $output['phoneNum'] =$thiscustomer['phoneNum'];
   return $output;
}


function  get_card_concreteamount($card_num)
{
        $bill_info = get_card_info($card_num);
        if($bill_info != 0){
                foreach ($bill_info as $thisbill) {
                        return $thisbill['curconcreteamount'];
                }
        }
}

function get_importbill_info_by_index($importindex)
{
        $conn = db_connect();
        $query = "select * from importbill where billindex = '".$importindex."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_importlist_info_by_id($id)
{
        $conn = db_connect();
        $query = "select * from importlist where id = '".$id."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result[0];
}

function get_billoflading_info_by_id($id) {
	
	if($id == null) {
		return false;
	}
	$conn = db_connect();
	$query = "SELECT " 
		." a.*,"
		." b.spc,"
		." b.factoryvalue,"
		." b.listindex,"		
		." (b.factoryvalue - a.takeamount) as billleftamount"
		." from 	"
		." (SELECT "
		." billoflading.*,"
		." purunit.name as purunitname,"
		." traunit.name as traunitname,"
		." driver.name as drivername,"
		." driver.frontNum as frontnum,"
		." driver.backNum as backnum,"
		." driver.carsize as carsize,"
		." driver.phonenum as driverphonenum,"
		." customer.name as customername,"
		." customer.phoneNum as customerphonenum"
		." FROM billoflading"
		." left join purunit on billoflading.purunitid = purunit.id"
		." left join traunit on billoflading.traunitid = traunit.id"
		." left join driver on billoflading.driverid = driver.driverId"
		." left join customer on billoflading.customerid = customer.customerid"
		." ) as a"
		." left join ("
		." select "
		." concrete.spc,"
		." importlist.id as importlistid, "
		." importlist.factoryvalue, "
		." importlist.listindex "		
		." from importlist "
		." left join concrete on importlist.concreteid = concrete.concreteid "
		." ) as b on a.importlistid = b.importlistid"
		." where a.id = '".$id."'";

	$result = @$conn->query($query);
	if (!$result) {
		return false;
	}
	$num_cats = @$result->num_rows;
	if ($num_cats == 0) {
		return false;
	}
	$result = db_result_to_array($result);
	return $result[0];	
}


function get_concreteid_from_importlist_by_listindex($listindex)
{
        $conn = db_connect();
        $query = "select * from importlist where listindex = '".$listindex."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result[0]['concreteid'];        
}
//获取购货单位ID为$purunitid的所有进货票号数组
function get_all_listindex_of_importlist_by_purunitid($purunitid)
{
        $conn = db_connect();
        $query = "select * from importlist where purunitid = '".$purunitid."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        //建立listindex的关联数组，array("0"=>"listindex1","1"=>"listindex2"..."n"=>"listindexn");
        $listindexes = array();
        $index = 0;
        foreach ($result as $thisimportlist) {
                $listindexes[$index] = $thisimportlist['listindex'];
                $index ++;
        }
        return $listindexes;
}

function get_importlist_info_by_listindex($listindex)
{
        $conn = db_connect();
        //$query = "select * from importlist where listindex ='".$listindex."'";		
		$query = " SELECT a .* , factory.name AS factoryname"
			." FROM ("
			." SELECT importlist .* , concrete.spc, concrete.factoryid"
			." FROM importlist"
			." LEFT JOIN concrete ON importlist.concreteid = concrete.concreteid"
			." ) a"
			." LEFT JOIN factory ON a.factoryid = factory.id"
			." WHERE listindex ='".$listindex."'";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
                return false;
        }
        $result = db_result_to_array($result);
       
        return $result[0];
}

function get_importlistid_by_listindex($listindex)
{
        $conn = db_connect();
        $query = "select * from importlist where listindex ='".$listindex."'";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
                return false;
        }
        $result = db_result_to_array($result);
        return $result[0]['id'];
}

function get_importindexlist_info_by_listindex($listindex)
{
        $conn = db_connect();
        //$query = "select purunitid,concreteid from importlist where listindex ='".$listindex."'";
        
		$query = "SELECT listindex"
		." FROM importlist"
		." WHERE listindex <>'".$listindex."'"
		." AND purunitid = (" 
			."SELECT purunitid"
			." FROM importlist"
			." WHERE listindex ='".$listindex."')"
		." AND concreteid = ( "
			."SELECT concreteid"
			." FROM importlist"
			." WHERE listindex ='".$listindex."')"; 
		$result = @$conn->query($query);
        if (!$result) {
                return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
                return false;
        }
		$result = db_result_to_array($result);
        $listindexes = array();
        $index = 0;
        foreach ($result as $thisimportlist) {
                $listindexes[$index] = $thisimportlist['listindex'];
                $index ++;
        }
        return $listindexes;
}

function get_importbill_amounttofactory($importbillindex)
{
        $thisimportbill = get_importbill_info_by_index($importbillindex);
        if($thisimportbill != 0){
                foreach ($thisimportbill as $thisbill) {
                        return $thisbill['amounttofactory'];
                }
        }
}

function get_importbill_origamount($importbillindex)
{
        $thisimportbill = get_importbill_info_by_index($importbillindex);
        if($thisimportbill != 0){
                foreach ($thisimportbill as $thisbill) {
                        return $thisbill['origonamount'];
                }
        }
}

function get_importbill_info_by_arg($name,$spc,$starttime,$endtime)
{
        $conn = db_connect();
        $query = "select * from importbill 
                  where  concretename = '".$name."'
                  and concretespc ='".$spc."'
                  and UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                  and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_importbill_info_by_time($starttime,$endtime)
{
        $conn = db_connect();
        $query = "select * from importbill 
                  where  UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                  and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}


function get_importbill_info_by_concretename_spc($concretename,$concretespc)
{
        //echo $concretename;
        //echo $concretespc;
        $conn = db_connect();
        $query = "select * from importbill 
                  where  concretename = '".$concretename."'
                  and concretespc ='".$concretespc."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_importlist()
{
        $conn = db_connect();
        $query = "select * from importlist";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_importbill_info_array($array)
{
        $billindex = $array['importbillindex'];
        $purunit = $array['purunit'];
        $concretespc = $array['concretespc'];
        $starttime = $array['starttime'];
        $endtime =$array['endtime'];

        $conn = db_connect();
        $query = "select * from importbill where billindex !=''";
        
        $billindex!="" ? $query = $query."and billindex ='".$billindex."'" : $query =$query;
        $purunit!="" ? $query = $query."and purunit ='".$purunit."'" : $query =$query ;
        $concretespc !="" ? $query = $query."and concretespc = '".$concretespc."'" : $query =$query;
        $starttime !="" ? $query = $query."and UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')": $query = $query;
        //echo "query:".$query;
        //echo "<br/>";

        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_importbill_info_by_concretename($concretename)
{
        $conn = db_connect();
        $query = "select * from importbill 
                  where  concretename = '".$concretename."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_importbill_info_by_concretespc($concretespc)
{
        $conn = db_connect();
        $query = "select * from importbill 
                  where  concretespc ='".$concretespc."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_recharge_info_by_arg($name,$spc,$starttime,$endtime)
{
        $conn = db_connect();
        $query = "select * from rechargecard 
                  where  concretename = '".$name."'
                  and concretespc ='".$spc."'
                  and UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                  and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_recharge_info_by_concretename_spc($name,$spc)
{
        $conn = db_connect();
        $query = "select * from rechargecard 
                  where  concretename = '".$name."'
                  and concretespc ='".$spc."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_recharge_info_by_customername($customername)
{
        $conn = db_connect();
        $query = "select * from rechargecard 
                  where  customername = '".$customername."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_recharge_info_by_concretespc($concretespc)
{
        $conn = db_connect();
        $query = "select * from rechargecard 
                  where  concretespc = '".$concretespc."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_recharge_info_by_concretename($concretename)
{
        $conn = db_connect();
        $query = "select * from rechargecard 
                  where  concretename = '".$concretename."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_recharge_info_by_time($starttime,$endtime)
{
        $conn = db_connect();
        $query = "select * from rechargecard 
                  where UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                  and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_recharge()
{
        $conn = db_connect();
        $query = "select * from rechargecard";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_recharge_info_by_cardindex($cardindex)
{
        $conn = db_connect();
        $query = "select * from rechargecard 
                  where  cardindex = '".$cardindex."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_cardindex($cardindex)
{
        $conn = db_connect();
        $query = "select * from billway 
                  where  cardindex = '".$cardindex."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_cardindex_for_receipt($cardindex)
{
        $conn = db_connect();
        $query = "select * from billway 
                where  cardindex = '".$cardindex."'
                and realamount = '-1'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_customername($customername)
{
        $conn = db_connect();
        $query = "select * from billway 
                  where  customername = '".$customername."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
                //echo "no result";
                return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_customer_name_for_receipt($customername)
{
        $conn = db_connect();
        $query = "select * from billway 
                where  customername = '".$customername."'
                and realamount = '-1'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
                //echo "no result";
                return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_billwayindex($billwayindex)
{
        $conn = db_connect();
        $query = "select * from billway 
                  where  billwayindex = '".$billwayindex."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_billwayindex_for_receipt($billwayindex)
{
        $conn = db_connect();
        $query = "select * from billway 
                where  billwayindex = '".$billwayindex."'
                and realamount ='-1'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_importbillindex($importbillindex)
{
        $conn = db_connect();
        $query = "select * from billway 
                  where  importbillindex = '".$importbillindex."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_importbillindex_for_receipt($importbillindex)
{
        $conn = db_connect();
        $query = "select * from billway 
                where  importbillindex = '".$importbillindex."'
                and realamount = '-1'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_billway_time($billwayindex,$starttime,$endtime)
{
        $conn = db_connect();
        $query = "select * from billway
                  where  billwayindex = '".$billwayindex."'
                  and UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                  and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;        
}

function get_take_info_by_billway_time_for_receipt($billwayindex,$starttime,$endtime)
{
        $conn = db_connect();
        $query = "select * from billway
                  where  billwayindex = '".$billwayindex."'
                  and UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                  and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')
                  and realamount ='-1'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;        
}

function get_take_info_by_concretename_spc($name,$spc)
{
        $conn = db_connect();
        $query = "select * from billway 
                  where  concretename = '".$name."'
                  and concretespc ='".$spc."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_concretename($concretename)
{
        $conn = db_connect();
        $query = "select * from billway
                  where  concretename = '".$concretename."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_concretespc($concretespc)
{
        $conn = db_connect();
        $query = "select * from billway
                  where  concretespc = '".$concretespc."'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_time($starttime,$endtime)
{
        $conn = db_connect();
        $query = "select * from billway 
                  where UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                  and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_period($period)
{       //echo"period:".$period."<br/>";
        //$starttime = strtotime(date('Y-m-d H:i:s'));
        $starttime = strtotime(gmdate('Y-m-d H:i:s', time() + 3600 * 8));
        switch($period){
        case "oneday":
                $long = $starttime - (1 * 24 * 60 * 60);
                break;
        case "threeday":
                $long = $starttime - (3 * 24 * 60 * 60);
                break;
        case "fiveday":
                $long = $starttime - (5 * 24 * 60 * 60);
                break;
        case "sevenday":
                $long = $starttime - (7 * 24 * 60 * 60);
                break;
        case "fifteenday":
                $long = $starttime - (15 * 24 * 60 * 60);
                        break;
        case "onemounth":
                $long = $starttime - (30 * 24 * 60 * 60);
                break;
        case "twomounth":
                $long = $starttime - (60 * 24 * 60 * 60);
                break;
        default:
                $long = $starttime - (1 * 24 * 60 * 60);
                break;
        }
        //$start = date('Y-m-d H:i:s');
        $start = gmdate('Y-m-d H:i:s', time() + 3600 * 8);
        //echo "start:".$start."<br/>";
        $end = date('Y-m-d H:i:s', $long);
        echo "<div align=\"center\"><strong>开始时间:".$end."-"."结束时间:".$start."</strong><br/></div>";

        $conn = db_connect();
        $query = "select * from billway 
                  where UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$start."')
                  and UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$end."')";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_by_time_for_receipt($starttime,$endtime)
{
        $conn = db_connect();
        $query = "select * from billway 
                  where UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                  and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')
                  and realamount = '-1'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info()
{
        $conn = db_connect();
        $query = "select * from billway";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_receipts()
{
        $conn = db_connect();
        $query = "select * from billoflading where realamount ='-1'";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_for_receipt_array($array)
{
        $customername = $array['customername'];
        $drivername = $array['drivername'];
        $importbillindex = $array['importbillindex'];
        $starttime = $array['starttime'];
        $endtime = $array['endtime'];
        $purunit =$array['purunit'];
        $operator = $array['operator'];

        $conn = db_connect();
        //$query = "select * from billway where realamount ='-1' or receiveamount = '-1' ";
        $query = "select * from billway where realamount ='-1' or cost != realcost";
        $customername !="" ? $query = $query."and customername = '".$customername."'": $query = $query;
        $drivername !="" ? $query = $query."and drivername = '".$drivername."'": $query = $query;
        $importbillindex !="" ? $query = $query."and importbillindex = '".$importbillindex."'": $query = $query;
        $purunit !="" ? $query =$query."and purunit ='".$purunit."'" : $query=$query;
        $operator !="" ? $query = $query."and operator ='".$operator."'" : $query = $query;
        $starttime !="" ? $query = $query."and UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')": $query = $query;

        //echo "query:".$query;
        //echo "<br/>";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_for_receipt_array_for_cashier($array)
{
        $customername = $array['customername'];
        $drivername = $array['drivername'];
        $importbillindex = $array['importbillindex'];
        $starttime = $array['starttime'];
        $endtime = $array['endtime'];
        $purunit =$array['purunit'];
        $operator = $array['operator'];

        $conn = db_connect();
        //$query = "select * from billway where realamount ='-1' or receiveamount = '-1' ";
        $query = "select * from billway where (realamount ='-1' or cost != realcost)";
        $customername !="" ? $query = $query."and customername = '".$customername."'": $query = $query;
        $drivername !="" ? $query = $query."and drivername = '".$drivername."'": $query = $query;
        $importbillindex !="" ? $query = $query."and importbillindex = '".$importbillindex."'": $query = $query;
        $purunit !="" ? $query =$query."and purunit ='".$purunit."'" : $query=$query;
        //$operator !="" ? $query = $query."and operator ='".$operator."'" : $query = $query;
        $starttime !="" ? $query = $query."and UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')": $query = $query;

        //echo "query:".$query;
        //echo "<br/>";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}



function get_take_info_for_period_check($array)
{
        $customername = $array['customername'];
        $drivername = $array['drivername'];
        $importbillindex = $array['importbillindex'];
        $starttime = $array['starttime'];
        $endtime = $array['endtime'];
        $purunit =$array['purunit'];
        $spc =$array['spc'];
        $department = $array['department'];
        //echo "department:".$department;
        //echo "<br/>";
        if($department =="物流部"){
                $adminlevel = 0;
        }else{
                $adminlevel = 2;
        }

        $conn = db_connect();
        //$query = "select * from billway where realamount ='-1' or receiveamount = '-1' ";
        $query = "select * from billway, admin where billway.operator = admin.username and admin.admin = '".$adminlevel."'";
        $customername !="" ? $query = $query."and customername = '".$customername."'": $query = $query;
        $drivername !="" ? $query = $query."and drivername = '".$drivername."'": $query = $query;
        $importbillindex !="" ? $query = $query."and importbillindex = '".$importbillindex."'": $query = $query;
        $purunit !="" ? $query =$query."and purunit ='".$purunit."'" : $query=$query;
        $spc !="" ? $query = $query."and concretespc ='".$spc."'" : $query = $query;
        $starttime !="" ? $query = $query."and UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')": $query = $query;

        //echo "query:".$query;
        //echo "<br/>";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_for_receipt_array_for_dist($array)
{
        $customername = $array['customername'];
        $drivername = $array['drivername'];
        $importbillindex = $array['importbillindex'];
        $starttime = $array['starttime'];
        $endtime = $array['endtime'];
        $purunit =$array['purunit'];
        $operator = $array['operator'];

        $conn = db_connect();
        $query = "select * from billway where (realamount ='-1' or receiveamount = '-1') ";
        //$query = "select * from billway where realamount ='-1' ";
        $customername !="" ? $query = $query."and customername = '".$customername."'": $query = $query;
        $drivername !="" ? $query = $query."and drivername = '".$drivername."'": $query = $query;
        $importbillindex !="" ? $query = $query."and importbillindex = '".$importbillindex."'": $query = $query;
        $purunit !="" ? $query =$query."and purunit ='".$purunit."'" : $query=$query;
        $operator !="" ? $query = $query."and operator ='".$operator."'" : $query = $query;
        $starttime !="" ? $query = $query."and UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')": $query = $query;

        //echo "query:".$query;
        //echo "<br/>";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_take_info_for_receipt_array_for_sale($array)
{
        $customername = $array['customername'];
        $drivername = $array['drivername'];
        $importbillindex = $array['importbillindex'];
        $starttime = $array['starttime'];
        $endtime = $array['endtime'];
        $purunit =$array['purunit'];
        $operator = $array['operator'];
        $spc = $array['spc'];

        $conn = db_connect();
        //$query = "select * from billway where realamount ='-1' or receiveamount = '-1' ";
        //$query = "select * from billway where (cost != realcost or realamount = '-1') ";
        $query = "select * from billway where realamount = '-1'";
        $customername !="" ? $query = $query."and customername = '".$customername."'": $query = $query;
        $drivername !="" ? $query = $query."and drivername = '".$drivername."'": $query = $query;
        $importbillindex !="" ? $query = $query."and importbillindex = '".$importbillindex."'": $query = $query;
        $purunit !="" ? $query =$query."and purunit ='".$purunit."'" : $query=$query;
        $spc !="" ? $query =$query."and concretespc ='".$spc."'" : $query=$query;
        $operator !="" ? $query = $query."and operator ='".$operator."'" : $query = $query;
        $starttime !="" ? $query = $query."and UNIX_TIMESTAMP(date) >= UNIX_TIMESTAMP('".$starttime."')
                and UNIX_TIMESTAMP(date) <= UNIX_TIMESTAMP('".$endtime."')": $query = $query;

        //echo "query:".$query;
        //echo "<br/>";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_billwayindex()
{
        $conn = db_connect();
        $query = "select distinct billwayindex from billway";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_importbillindex()
{
        $conn = db_connect();
        $query = "select distinct importbillindex from billway";
        $result = @$conn->query($query);
        if (!$result) {
        return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
        return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_importbill_by_importbillindex($importbillindex)
{
        $conn = db_connect();
        $query = "select * from importbill where billindex ='".$importbillindex."'";
        $result = @$conn->query($query);
        if (!$result) {
                echo "读取进货价格失败!";
                return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
                echo "没有进货价格的记录!";
                return false;
        }
        $result = db_result_to_array($result);
        return $result;
}

function get_card(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from card";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_customer(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from customer order by updatetime desc";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_customer_for_dist(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from customer where department='dist'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_customer_for_sale(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from customer where department='sale'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_purunit_for_sale(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select distinct name from purunit where department='sale'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_purunit_for_dist(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select distinct name from purunit where department='dist'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_traunit_for_sale(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select distinct name from traunit where department='sale'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_traunit_for_dist(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select distinct name from traunit where department='dist'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_traunit(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from traunit";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_traunit_info(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from traunit";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_traunit_info_by_id($id){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from traunit where id='".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_purunit(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from purunit";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_factory(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from factory";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}
function get_factory_info_by_id($id){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from factory where id ='".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}
function get_company(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from company";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_users(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from admin";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_company_to_show(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from company";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_purunit_info(){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from purunit";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_purunit_info_by_id($id){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from purunit where id ='".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function get_company_info_by_id($id){
 // query database for a list of card
   $conn = db_connect();
   $query = "select * from company where id ='".$id."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result[0];
}

function is_card_reged($card_num){
         $conn = db_connect();
   $query = "select * from card where cardindex = '".$card_num."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   return true;
}

function get_category_name($catid) {
   // query database for the name for a category id
   $conn = db_connect();
   $query = "select catname from categories
             where catid = '".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $row = $result->fetch_object();
   return $row->catname;
}


function get_books($catid) {
   // query database for the books in a category
   if ((!$catid) || ($catid == '')) {
     return false;
   }

   //for order
   $catname = get_category_name($catid);
   echo " Order in $catname,catid=$catid";
  
   $conn = db_connect();

   //$query = "select * from books where catid = '".$catid."'";
   $query = "select * from $catname where catid = '".$catid."'";

   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_books = @$result->num_rows;
   if ($num_books == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_book_details($isbn) {
  // query database for all details for a particular book
  if ((!$isbn) || ($isbn=='')) {
     return false;
  }
  $name = get_category_name($isbn);
  $conn = db_connect();
  //$query = "select * from books where isbn='".$isbn."'";
  $query = "select * from $name where catid='".$isbn."'";
  $result = @$conn->query($query);
  if (!$result) {
     return false;
  }
  $result = @$result->fetch_assoc();
  return $result;
}

function calculate_price($cart) {
  // sum total price for all items in shopping cart
  $price = 0.0;
  if(is_array($cart)) {
    $conn = db_connect();
    foreach($cart as $isbn => $qty) {
      $query = "select price from books where isbn='".$isbn."'";
      $result = $conn->query($query);
      if ($result) {
        $item = $result->fetch_object();
        $item_price = $item->price;
        $price +=$item_price*$qty;
      }
    }
  }
  return $price;
}

function get_manager_name() {
   // query database for a list of concrete
   $conn = db_connect();
   $query = " select * from admin";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function calculate_items($cart) {
  // sum total items in shopping cart
  $items = 0;
  if(is_array($cart))   {
    foreach($cart as $isbn => $qty) {
      $items += $qty;
    }
  }
  return $items;
}

function get_mergelist_info_by_listindex($listindex)
{
        $conn = db_connect();
        $query = "select * from mergelist where listindex ='".$listindex."'";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
                return false;
        }
        $result = db_result_to_array($result);
        return $result[0];        
}

function get_sales_stat_month_info() {
        $conn = db_connect();
        //$query = "select * from mergelist where listindex ='".$listindex."'";
        
		$query = "select" 
				." billoflading.department,"
				." substring(billoflading.updatetime,3,5) as month,"
				." sum(takeamount) as takeamount,"
				." sum(realamount) as realamount,"
				." sum(receiveamount) as receiveamount,"
				." sum(payment) as payment,"
				." sum(realamount*concreteprice) as salesvalue,"
				." sum(realamount*importlist.purchaseprice) as salescost,"
				." sum(realamount*concreteprice-realamount*importlist.purchaseprice) as salerevenue,"
				." sum(realamount*concreteprice - payment) as ownmoney,"
				." sum(realamount*driverprice) as driverprice,"
				." sum(realamount*(shipprice-driverprice)) as shiprevenue"
				." from billoflading"
				." left join importlist on billoflading.importlistid = importlist.id"
				." group by billoflading.department,substring(billoflading.updatetime,3,5)";
		
		$result = @$conn->query($query);
        if (!$result) {
                return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
                return false;
        }
        $result = db_result_to_array($result);
        return $result;        
}

function get_sales_stat_period_info($startDate, $endDate) {
        $conn = db_connect();
        //$query = "select * from mergelist where listindex ='".$listindex."'";
        
		$query = "SELECT billoflading.department,"
					." sum(takeamount) as takeamount,"
					." sum(realamount) as realamount,"
					." sum(receiveamount) as receiveamount,"
					." sum(payment) as payment,"
					." sum(realamount*concreteprice) as salesvalue,"
					." sum(realamount*importlist.purchaseprice) as salescost,"
					." sum(realamount*concreteprice-realamount*importlist.purchaseprice) as salerevenue,"
					." sum(realamount*concreteprice - payment) as ownmoney,"
					." sum(realamount*driverprice) as driverprice,"
					." sum(realamount*(shipprice-driverprice)) as shiprevenue"
					." from billoflading"
					." left join importlist on billoflading.importlistid = importlist.id"
					." where "
					." 1=1";
		if($startDate != null) {
			$query = $query." and billoflading.updatetime >= '".$startDate." 00:00:00'";
		}		
		
		if($startDate != null) {
			$query = $query." and billoflading.updatetime <= '".$endDate." 23:59:59'";
		}	
					
					$query = $query." group by billoflading.department;";

		$result = @$conn->query($query);
        if (!$result) {
                return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
                return false;
        }
        $result = db_result_to_array($result);
        return $result;  

}

function get_user_by_accountID($accountID) {
        $conn = db_connect();
        $query = "select * from admin where account_id ='".$accountID."'";
        $result = @$conn->query($query);
        if (!$result) {
                return false;
        }
        $num_cats = @$result->num_rows;
        if ($num_cats == 0) {
                return false;
        }
        $result = db_result_to_array($result);
        return $result[0];        
}
	
?>
