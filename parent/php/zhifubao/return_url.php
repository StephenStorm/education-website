<?php
session_start();
/* *
 * 功能：支付宝页面跳转同步通知页面
 * 版本：2.0
 * 修改日期：2017-05-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 */
require_once("config.php");
require_once 'pagepay/service/AlipayTradeService.php';


$arr=$_GET;
$alipaySevice = new AlipayTradeService($config); 
$result = $alipaySevice->check($arr);

/* 实际验证过程建议商户添加以下校验。
1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
4、验证app_id是否为该商户本身。
*/
if($result) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代码
	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

	//商户订单号
	$out_trade_no = htmlspecialchars($_GET['out_trade_no']);

	//支付宝交易号
	$trade_no = htmlspecialchars($_GET['trade_no']);
		
	echo "<div style='display:inline-block;text-align: center;width:100%;'><label>充值成功</label><br /><label>支付宝交易号：{$trade_no}</label></div>";
	echo "<br />";


	require '../../../config/common.php';
	$db=new mysqli($mysql['hostname'],$mysql['username'],$mysql['passwd'],$mysql['database']);
	if($db->connect_errno){	
		exit();
	}
	$username=$_SESSION['username'];
	$total=0;//更改状态信息
	for($i=0;$i<count($_SESSION['select']);$i++){
		$result=$db->query('update purchase set state=1,datetime="'.date("Y-m-d G:i:s").'" where p_id="'.$username.'" and c_id="'.$_SESSION['select'][$i].'"');
	}
	//保存订单信息到数据库
	
	
	$db->close();
	unset($_SESSION['select']);
	unset($_SESSION['money']);
	header("location:../shopping_cart.php");
	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
    
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    echo "验证失败";
}
?>