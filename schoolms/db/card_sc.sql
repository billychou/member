create database card_sc DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; 

use card_sc;

create table customer
(
  customerid int unsigned not null auto_increment primary key,
  name char(20) not null,
  address char(80) not null,
  phoneNum char(20) not null,
  note char(60),
  department char(20) not null,
  updatetime datetime not null
)default charset=utf8;

create table driver
(
  driverId int unsigned not null auto_increment primary key,
  name char(60) not null,
  frontNum char(60) not null,
  backNum char(60) not null,
  carSize float(10,2) not null,
  phoneNum char(20) not null,
  department char(20) not null,
  updatetime datetime not null
)default charset=utf8;

create table concrete 
(
  concreteid int unsigned not null auto_increment primary key,
  spc char(60) not null,
  unit char(10) not null,
  note char(60),
  updatetime datetime not null,
  factoryid int unsigned not null
)default charset=utf8;

create table admin
(  
  id int unsigned not null auto_increment primary key,
  account_id char(20) not null,
  username char(20) not null,
  password char(40) not null,
  sys_role char(20) not null,
  biz_role char(20) not null
)default charset=utf8;

create table purunit
(
  id int unsigned not null auto_increment primary key,
  name char(200) not null,
  note char(60),
  updatetime datetime not null,
  department char(100) not null
)default charset=utf8;

create table traunit
(
  id int unsigned not null auto_increment primary key,
  name char(200) not null,
  note char(60),
  updatetime datetime not null,
  department char(100) not null
)default charset=utf8;

create table factory
(
  id int unsigned not null auto_increment primary key,
  name char(200) not null,
  note char(60),
  updatetime datetime not null
)default charset=utf8;

create table importlist
(
 id int unsigned not null auto_increment primary key,
 /*index of importlist*/
 listindex char(150) not null,
 /*id of purunit*/
 purunitid int unsigned not null,
 /* id of concreteid*/
 concreteid int unsigned not null,
 /*initial value of importlist*/
 initvalue float(10,2) not null,
 /*the current value for recharge*/
 rechargevalue float(10,2) not null,
 /*the current value stored in the factory */
 factoryvalue float(10,2) not null,
 /*purchase price*/
 purchaseprice float(10,2) not null,
 /*total cost = initvalue x purchase
 cost float(10,2) not null,
 */
 /*uint*/
 unit char(10) not null,
 updatetime datetime not null,
 department char(10) not null,
 note char(60)
)default charset=utf8;

create table mergelist
(
 id int unsigned not null auto_increment primary key,
 /*index of importlist*/
 listindex char(150) not null,
 /*id of importlist1*/
 importlistid1 int unsigned not null,
 /* id of importlist2*/
 importlistid2 int unsigned not null,
 /*initial value of importlist1*/
 factoryvalue1 float(10,2) not null,
 /*the current value for importlist2*/
 factoryvalue2 float(10,2) not null,
 /*the current value stored in the factory */
 updatetime datetime not null,
 department char(10) not null,
 note char(60)
)default charset=utf8;

create table card
(
  cardid char(30) not null primary key,
  customerid int unsigned not null,
  remainingsum float(10,2) not null,
  note char(60) 
)default charset=utf8;

create table rechargecard
(
   /*recharge id*/
   id int unsigned not null auto_increment primary key,
   cardid char(30) not null,
   remainingsum float(10,2) not null, 
   rechargemoney float(10,2) not null,
   updatetime datetime not null,
   userid int unsigned not null,
   note char(60) 
)default charset=utf8;

create table billoflading
(
  id int unsigned not null auto_increment primary key,
  billindex char(60) not null,
  cardindex char(60) not null,
  importlistid int unsigned not null,
  customerid int unsigned not null,
  driverid int unsigned not null,
  updatetime datetime not null,
  purunitid int unsigned not null,
  whereisfrom char(50) not null,
  traunitid int unsigned not null,
  wheretogo char(60) not null,
  concreteprice float(10,2) not null,
  shipprice float(10,2) not null, 
  driverprice  float(10,2) not null,
  takeamount float(10,2) not null,
  realamount float(10,2) not null,
  receiveamount float(10,2) not null,
  payment float(10,2) not null,
  operator char(60) not null,
  department char(20) not null,
  note char(60)
)default charset=utf8;

create table company
(
  id int unsigned not null auto_increment primary key,
  name char(200) not null,
  note char(60),
  updatetime datetime not null,
  department char(100) not null
)default charset=utf8;

create table backup
(
  id int unsigned not null auto_increment primary key,
  updatetime datetime not null,
  filename char(200) not null,
  operator char(100) not null,
  note char(100) not null
)default charset=utf8;

CREATE TABLE `truckfee` (
  `id` int unsigned not null auto_increment primary key,
  `updatetime` datetime NOT NULL,
  `carnum` varchar(100) NOT NULL,
  `userid` int(10) NOT NULL,
  `whereisfrom` varchar(100) NOT NULL,
  `wheretogo` varchar(100) NOT NULL,
  `todistance` float(10,2) NOT NULL,
  `backdistance` float(10,2) NOT NULL COMMENT '收车里程',
  `takeamount` float(10,2) NOT NULL COMMENT '承运吨数',
  `realoilfee` float(10,2) NOT NULL COMMENT '实际油费',
  `tobeoilfee` float(10,2) NOT NULL COMMENT '理论油耗',
  `oilprice` float(10,2) NOT NULL COMMENT '燃油单价',
  `controloilfee` float(10,2) NOT NULL COMMENT '控制油费',
  `fines` float(10,2) NOT NULL COMMENT '罚款',
  `pointfines` float(10,2) NOT NULL COMMENT '定点罚款',
  `salary` float(10,2) NOT NULL COMMENT '工资',
  `insurefee` float(10,2) NOT NULL COMMENT '保险',
  `mantainfee` float(10,2) NOT NULL COMMENT '维修',
  `wayfee` float(10,2) NOT NULL COMMENT '高速费',
  `totalcost` float(10,2) NOT NULL COMMENT '成本合计',
  `aftertaxprice` float(10,2) NOT NULL COMMENT '税后单价',
  `revenue` float(10,2) NOT NULL COMMENT '利润合计',
  `fetchvalue` float(10,2) NOT NULL COMMENT '出车支领',
  `reportvalue` float(10,2) NOT NULL COMMENT '收车报账',
  `feecost` float(10,2) NOT NULL COMMENT '费用开销',
  `drivermantainfee` float(10,2) NOT NULL COMMENT '司机维修',
  `dinnerfee` float(10,2) NOT NULL COMMENT '饭费',
  `smokefee` float(10,2) NOT NULL COMMENT '烟费',
  `extendcost` float(10,2) NOT NULL COMMENT '额外开支',
  `note` varchar(200) DEFAULT NULL COMMENT '备注'
) DEFAULT CHARSET=utf8;

delimiter $$
DROP FUNCTION IF EXISTS `get_desc_by_key`$$
CREATE FUNCTION get_desc_by_key(keystr varchar(30)) RETURNS varchar(255)
BEGIN
	DECLARE str varchar(255); 
	CASE
	WHEN keystr = 'reader' THEN
		SET str = '浏览用户';
	WHEN keystr = 'operator' THEN
		SET str = '业务用户';
	WHEN keystr = 'admin' THEN
		SET str = '管理员';
	WHEN keystr = 'sales' THEN
		SET str = '销售';
	WHEN keystr = 'log' THEN
		SET str = '物流';
	WHEN keystr = 'fisical' THEN
		SET str = '财务';
	WHEN keystr = '10' THEN
		SET str = '10天';
	WHEN keystr = '20' THEN
		SET str = '20天';
	WHEN keystr = '30' THEN
		SET str = '30天';
	WHEN keystr = '-1' THEN
		SET str = '永远';
	ELSE
		SET str = keystr;
	END CASE;
    RETURN str;                                 
END$$

drop view importlistv;
create view importlistv as (
select 
	`importlist`.`id` AS `id`,
	`importlist`.`listindex` AS `listindex`,
	`importlist`.`initvalue` AS `initvalue`,
	`importlist`.`rechargevalue` AS `rechargevalue`,
	`importlist`.`purchaseprice` AS `purchaseprice`,
	`importlist`.`factoryvalue` AS `factoryvalue`,
	`importlist`.`department` AS `department`,
	 get_desc_by_key(importlist.department) AS dept_desc,
	(`importlist`.`purchaseprice` * `importlist`.`rechargevalue`) AS `purchasevalue`,
	`importlist`.`updatetime` AS `updatetime`,
	`importlist`.`purunitid` AS `purunitid`,
	`purunit`.`name` AS `name`,
	`importlist`.`concreteid` AS `concreteid`,
	`concrete`.`spc` AS `spc`,
	`importlist`.`note` AS `note` 
	from ((`importlist` left join `purunit` on((`importlist`.`purunitid` = `purunit`.`id`))) 
	left join `concrete` on((`importlist`.`concreteid` = `concrete`.`concreteid`))));

drop view billofladingv;
create view billofladingv as (
select 
	`billoflading`.`id` AS `biloflaydingid`,
	`billoflading`.`wheretogo` AS `wheretogo`,
	`billoflading`.`whereisfrom` AS `whereisfrom`,
	`billoflading`.`updatetime` AS `updatetime`,
	`customer`.`name` AS `customername`,
	`customer`.`phoneNum` AS `customerphonenum`,
	`billoflading`.`takeamount` AS `takeamount`,
	(case when billoflading.receiveamount < 0 then '-' when billoflading.receiveamount = 0 then '~' else `billoflading`.`receiveamount` end) AS `receiveamount`,
	(case when billoflading.realamount < 0 then '-' when billoflading.realamount = 0 then '~' else `billoflading`.`realamount` end) AS `realamount`,
	(case when billoflading.realamount < 0 then '未回单' when billoflading.realamount = 0 then '已撤单' else '已回单' end) AS `billstatus`,
	`billoflading`.`concreteprice` AS `concreteprice`,
	(case when billoflading.realamount < 0 then '-' when billoflading.realamount = 0 then '~' else (`billoflading`.`realamount` * `billoflading`.`concreteprice`) end) AS `applypay`,
(case when billoflading.realamount < 0 then '-' when billoflading.realamount = 0 then '~' else (`billoflading`.`realamount` * (`billoflading`.`concreteprice` - importlistv.purchaseprice)) end) AS `salesrevenue`,
	`billoflading`.`payment` AS `payment`,
	`billoflading`.`driverprice` AS `driverprice`,
	(case when billoflading.realamount < 0 then '-' when billoflading.realamount = 0 then '~' else (`billoflading`.`driverprice` * `billoflading`.`realamount`) end) AS `driverpay`,
	(case when billoflading.realamount < 0 then '-' when billoflading.realamount = 0 then '~' else ((`billoflading`.`realamount` * `billoflading`.`concreteprice`) - `billoflading`.`payment`)end) AS `ownpay`,
	(case when billoflading.realamount < 0 then '-' when billoflading.realamount = 0 then '~' else (`billoflading`.`receiveamount` * `billoflading`.`shipprice`) end) AS `shipvalue`,
	(case when billoflading.realamount < 0 then '-' when billoflading.realamount = 0 then '~' else (`billoflading`.`receiveamount` * `billoflading`.`driverprice`) end) AS `sentvalue`,
	(case when billoflading.realamount < 0 then '-' when billoflading.realamount = 0 then '~' else (`billoflading`.`receiveamount` * (`billoflading`.shipprice-`billoflading`.`driverprice`)) end) AS `logrevenue`,
	`driver`.`name` AS `drivername`,
	`driver`.`phoneNum` AS `driverphonenum`,
	`driver`.`frontNum` AS `drivernum`,
	`purunit`.`name` AS `purunitname`,
	`billoflading`.`billindex` AS `billindex`,
	`billoflading`.`operator` AS `operator`,
	`billoflading`.`note` AS `note`,
	`billoflading`.`importlistid` AS `importlistid`,
	`billoflading`.`department` AS `department`,
	`billoflading`.`shipprice` AS `shipprice`,
	get_desc_by_key(billoflading.department) AS dept_desc,
	`importlistv`.`listindex` AS `listindex`,
	`importlistv`.`spc` AS `spc`,
        importlistv.purchaseprice as purchaseprice
	from ((((`billoflading` left join `customer` on((`billoflading`.`customerid` = `customer`.`customerid`))) left join `driver` on((`billoflading`.`driverid` = `driver`.`driverId`))) left join `purunit` on((`billoflading`.`purunitid` = `purunit`.`id`))) 
	left join `importlistv` on((`billoflading`.`importlistid` = `importlistv`.`id`)))	

);

create table dailyrevenue
(
  id int unsigned not null auto_increment primary key,
  updatetime datetime not null,
  reveType char(10) not null,
  amount float(10,2) not null,
  proName char(10) not null,
  operator char(10) not null,
  note char(30) not null,
  department char(10) not null
)default charset=utf8;

grant select, insert, update, delete
on card_sc.*
to card_sc@localhost identified by 'password';
