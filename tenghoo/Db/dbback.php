<?php
	require('../checklogin.php');
	date_default_timezone_get('PRC');
	header("Content-type:text/html;charset=utf-8");

	//配置信息
	$cfg_dbhost = DB_HOST;
	$cfg_dbname = DB_NAME;
	$cfg_dbuser = DB_USER;
	$cfg_dbpwd = DB_PWD;
	$cfg_db_language = DB_CHARTSET;
	$to_file_name = '../../dbback/'.date('Y-m-d').'_'.$cfg_dbname.".sql";
	// END 配置

	//链接数据库
	$link = mysql_connect($cfg_dbhost,$cfg_dbuser,$cfg_dbpwd);
	mysql_select_db($cfg_dbname);
	//选择编码
	mysql_query("set names ".$cfg_db_language);
	//数据库中有哪些表
	$tables = @mysql_list_tables($cfg_dbname);
	//将这些表记录到一个数组
	$tabList = array();
	while($row = mysql_fetch_row($tables)){
		$tabList[] = $row[0];
	}
	$info = "-- ----------------------------\r\n";
	$info .= "-- phpMyAdmin SQL Dump\r\n";
	$info .= "-- 日期：".date("Y-m-d H:i:s",time())."\r\n";
	$info .= "-- Power by 李关生(1096831030@qq.com)\r\n";
	$info .= "-- 用phpMyAdmin导入即可恢复数据库\r\n";
	$info .= "-- ----------------------------\r\n\r\n";
	file_put_contents($to_file_name,$info,FILE_APPEND);

	//将每个表的表结构导出到文件
	foreach($tabList as $val){
		$sql = "show create table ".$val;
		$res = mysql_query($sql,$link);
		$row = mysql_fetch_array($res);
		$info = "-- ----------------------------\r\n";
		$info .= "-- Table structure for `".$val."`\r\n";
		$info .= "-- ----------------------------\r\n";
		$info .= "DROP TABLE IF EXISTS `".$val."`;\r\n";
		$sqlStr = $info.$row[1].";\r\n\r\n";
		//追加到文件
		file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
		//释放资源
		mysql_free_result($res);
	}

	//将每个表的数据导出到文件
	foreach($tabList as $val){
		$sql = "select * from ".$val;
		$res = mysql_query($sql,$link);
		//如果表中没有数据，则继续下一张表
		if(mysql_num_rows($res)<1) continue;
		//
		$info = "-- ----------------------------\r\n";
		$info .= "-- Records for `".$val."`\r\n";
		$info .= "-- ----------------------------\r\n";
		file_put_contents($to_file_name,$info,FILE_APPEND);
		//读取数据
		while($row = mysql_fetch_row($res)){
			$sqlStr = "INSERT INTO `".$val."` VALUES (";
			foreach($row as $zd){
				$sqlStr .= "'".$zd."', ";
			}
			//去掉最后一个逗号和空格
			$sqlStr = substr($sqlStr,0,strlen($sqlStr)-2);
			$sqlStr .= ");\r\n";
			file_put_contents($to_file_name,$sqlStr,FILE_APPEND);
		}
		//释放资源
		mysql_free_result($res);
		file_put_contents($to_file_name,"\r\n",FILE_APPEND);
	}
	//文件的类型 
	header('Content-type: application/sql'); 
	//下载显示的名字
	$sql_name = $cfg_dbname.'.sql';
	header('Content-Disposition: attachment; filename="'.$sql_name.'"'); 
	readfile("$to_file_name"); 
	exit();
?>