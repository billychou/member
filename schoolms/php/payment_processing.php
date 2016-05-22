<?php
        header('Content-type: text/json;charset=utf-8');
		include('db_fns.php');
		include ('auth_check.php');
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        * Easy set variables
        */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	 /* 查询结果集，跟前端展示列表中列的顺序保持一致 */
	$aColumns = array(
                'updatetime',
                'operatorname',
                'membername',  
                'cardnum', 
                'paynum',
                'branchname',
                'majorname',
                'classname',
                'note',
				);
	
	/* Indexed column (used for fast and accurate table cardinality) */
	/* 操作对应的后台表或者视图中行的ID */
	$sIndexColumn = "id";
	
	/* DB table to use */
	/* 操作对应的后台表或者视图*/
	$sTable = "paymentv";

	/* Database connection information */
        //include ('db_fns.php');
        //include('../config/db_config.php');
        /*
        $gaSql['user']       = "card_sc";
        //$gaSql['password']   = "123456";
        $gaSql['password']   = "password";
        $gaSql['db']         = "card_sc";
        //$gaSql['server']     = "oa8106045.eicp.net";
        $gaSql['server']     = "localhost";
        */
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * Local functions
	 */
	function fatal_error ( $sErrorMessage = '' )
	{
		//header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
		//die( $sErrorMessage );
	}

	
	/* 
	 * MySQL connection
	 */
	$gaSql['link'] = db_connect();
	/*
	if ( ! $gaSql['link'] = mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) )
	{
		fatal_error( 'Could not open connection to server' );
	}

	if ( ! mysql_select_db( $gaSql['db'], $gaSql['link'] ) )
	{
		fatal_error( 'Could not select database ' );
	}
        mysql_query("SET NAMES UTF8");
    */

	/* 
	 * Paging
	 */
	 /*分页代码，貌似可以通用*/
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
			intval( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	 /* 排序代码，可以通用*/
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
					($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	 /*全局搜索代码，此处将时间字段给排除掉，也有一定通用性*/
	$sWhere = "";
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
			{
				if($aColumns[$i] != 'updatetime') {
					$sWhere .= "`".$aColumns[$i]."` LIKE '%".$gaSql['link']->real_escape_string( $_GET['sSearch'] )."%' OR ";
				}
			}
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	/* 低栏查询代码，因为存在一列中有两个查询输入（开始时间和截止时间）的情况，以及日期型的比较，所以此处通用性不强 */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			if($i==1) {
				$sWhere .= "`".$aColumns[$i]."` ='".$gaSql['link']->real_escape_string($_GET['sSearch_'.$i])."' ";    //正常情况
			} else if($i==0) {
				$sWhere .= "`".$aColumns[0]."` >= '".$gaSql['link']->real_escape_string($_GET['sSearch_'.$i])." 00:00:00' "; // 处理开始时间
			} else if($i==12) {
				$sWhere .= "`".$aColumns[0]."` <= '".$gaSql['link']->real_escape_string($_GET['sSearch_'.$i])." 23:59:59' "; // 处理截止时间
			} else {
				$sWhere .= "`".$aColumns[$i]."` LIKE '%".$gaSql['link']->real_escape_string($_GET['sSearch_'.$i])."%' "; //正常情况
			}
		}
	}
	
        /*SQL queries
         * Get data for statistics
         */
        //department filter
		/* 过滤数据的条件中添加部门的过滤 */
		
		$currentUser = $_SESSION['thisuser'];
		$branchid = $currentUser['branchid'];
		if(isHeadQuarter()) {
			
		} else {
			
			if ( $sWhere == "" ) {
				$sWhere = "WHERE ";
			}
			else {
				$sWhere .= " AND ";
			} 
			$sWhere .= "branchid = '".$branchid."'";
		}

		/* 全局统计代码 */
        $sQuery = "
                SELECT SUM(paynum) as 'iTotalPayNum',
					count('id') as 'iTotalCounts'
				
		FROM   $sTable
		$sWhere
		$sOrder
		";
		//echo  $sQuery ;
		/* 全局统计结果封装 */
	    $rResult = $gaSql['link']->query($sQuery) or fatal_error( 'MySQL Error: ' . mysql_errno() );   
        $row = db_result_to_array($rResult);
        $iTotalPayNum = $row[0]['iTotalPayNum'];
        $iTotalCounts = $row[0]['iTotalCounts'];
		//echo "iTotalTakeAmount:".$iTotalTakeAmount;
		//var_dump($row);
		//exit;
	/*
	 * SQL queries
	 * Get data to display
	 */
	 
	 /*全集结果条数获取及封装，通用性*/
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS id ,`".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";
		
		//echo $sQuery;
	$rResult = $gaSql['link']->query($sQuery) or fatal_error( 'MySQL Error: ' . mysql_errno() );

	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = $gaSql['link']->query($sQuery) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	$aResultFilterTotal = db_result_to_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0]["FOUND_ROWS()"];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
		FROM   $sTable
		where 1=1 
	";
	
	if(isHeadQuarter()) {
			
	} else {
		
		$sWhere .= " and branchid = '".$branchid."'";
	}
	//echo $sQuery;
	
	$rResultTotal = $gaSql['link']->query($sQuery) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	$aResultTotal = db_result_to_array($rResultTotal);
	$iTotal = $aResultTotal[0]["COUNT(`id`)"];
	
	/*
	 * Output
	 */
	 
	/* 结果集封装 通用性不强 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"iTotalPayNum" => $iTotalPayNum,
		"iTotalCounts" => $iTotalCounts,
		"aaData" => array()
	);
	$aRows = db_result_to_array( $rResult );
	foreach ($aRows as $aRow){
	//while ( $aRow = db_result_to_array( $rResult ) )
	//{
		$row = array();
		$row['DT_RowId'] = $aRow['id'];
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
		$output['aaData'][] = $row;
	}
	//var_dump($output);
	//exit;
	echo json_encode( $output );
?>
