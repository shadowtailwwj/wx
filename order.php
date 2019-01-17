﻿	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta http-equiv="Content-Language" content="zh-CN"/>
		<meta http-equiv="Expires" CONTENT="0">        
		<meta http-equiv="Cache-Control" CONTENT="no-cache">        
		<meta http-equiv="Pragma" CONTENT="no-cache">
		<title>通联收银宝快捷支付-商户接口范例-签约申请请求信息签名</title>
		<link href="css.css" rel="stylesheet" type="text/css">
	</head>
	<body>	
	<center> <font size=16><strong>签约申请</strong></font></center>
	<?PHP
	header("Content-type:text/html;charset=utf-8");
	require_once 'AppConfig.php';
	require_once 'AppUtil.php';
	//页面编码要与参数inputCharset一致，否则服务器收到参数值中的汉字为乱码而导致验证签名失败。
	$serverUrl=$_POST["serverUrl"];
	
	$reqip=$_POST["reqip"];
	$reqtime=$_POST["reqtime"];
	$meruserid=$_POST["meruserid"];
	$agreeid=$_POST["agreeid"];
	$orderid=$_POST["orderid"];
	$amount=$_POST["amount"];
	$currency=$_POST["currency"];
	$notifyurl=$_POST["notifyurl"];


	$cusid=AppConfig::CUSID;
	$appid=AppConfig::APPID;
	$version=AppConfig::APIVERSION;
	$randomstr="123456789";
	//报文参数有消息校验
	if(preg_match("/\d/",$pickupUrl)){
        echo "<script>alert('pickupUrl有误！！');history.back();</script>";
	}

	// 生成签名字符串。
	$params = array();
	$params["cusid"] = $cusid;
	$params["appid"] = $appid;
	$params["version"] = $version;
	$params["reqip"] = $reqip;
	$params["reqtime"] = $reqtime;
	$params["meruserid"] = $meruserid;
	$params["agreeid"] = $agreeid;
	$params["orderid"] = $orderid;
	$params["amount"] = $amount;
	$params["currency"] = $currency;
	$params["notifyurl"] = $notifyurl;
	$params["randomstr"] =$randomstr;
	
	//签名，设为signMsg字段值。
	$signMsg = AppUtil::SignArray($params,AppConfig::APPKEY);//签名
	
	
	$params['key'] = AppConfig::APPKEY;// 将key放到数组中一起进行排序和组装
	ksort($params);
	$bufSignSrc = AppUtil::ToUrlParams($params);

	$a = "agreeid=201808171443190784&amount=100&appid=00107399¤cy=CNY&cusid=55110008999CEZ6&key=125125Link¬ifyurl=http://www.ysmall.shop/notifyurl.php&orderid=12334531&randomstr=123456789&version=11";

	?>
	
	<!--
		1、订单可以通过post方式或get方式提交，建议使用post方式；
		   提交支付请求可以使用http或https方式，建议使用https方式。
		2、通联收银宝网关地址、商户号及key值，在接入测试时由通联提供；
		   通联收银宝网关地址、商户号，在接入生产时由通联提供，key值在通联收银宝商服服务平台上设置,https://vsp.allinpay.com。
	-->
	<!--================= post 方式提交支付请求 start =====================-->
	<!--================= 测试地址,生产地址请参考在线接口文档https://aipboss.allinpay.com/know/devhelp/main.php?pid=20=====================-->
	<!--=================  =====================-->
	<form name="form2" action="<?=$serverUrl ?>" method="post">
		<input type="hidden" name="cusid" id="cusid" value="<?=$cusid?>" />
		<input type="hidden" name="appid" id="appid" value="<?=$appid?>"/>
		<input type="hidden" name="version" id="version" value="<?=$version?>" />
		<input type="hidden" name="reqip" id="reqip" value="<?=$reqip?>"/>
		<input type="hidden" name="reqtime" id="reqtime" value="<?=$reqtime?>" />
		<input type="hidden" name="meruserid" id="meruserid" value="<?=$meruserid?>"/>
		<input type="hidden" name="agreeid" id="agreeid" value="<?=$agreeid?>" />
		<input type="hidden" name="orderid" id="orderid" value="<?=$orderid?>"/>
		<input type="hidden" name="amount" id="amount" value="<?=$amount?>" />
		<input type="hidden" name="currency" id="currency" value="<?=$currency ?>" />
		<input type="hidden" name="notifyurl" id="notifyurl" value="<?=$notifyurl ?>" />
		<input type="hidden" name="randomstr" id="randomstr" value="<?=$randomstr?>"/>
		
	
		
		<input type="hidden" name="sign" id="sign" value="<?=$signMsg?>" />
		<div align="center"><input type="submit" value="签约申请去啦" align=center/></div>
	<!--================= post 方式提交支付请求 end =====================-->
	</form>
	<table class="table_box" width="90%" align="center">
	<tr><td colspan="2" class="tit_bar">提交支付订单请求参数</td></tr>
	   <tr><td>1、</td><td style="width:100px">请求ip(reqip): <?=$reqip?> </td></tr>  
	   <tr><td>2、</td><td>本次请求时间(reqtime): <?=$reqtime ?></td></tr>
	   <tr><td>3、</td><td>商户用户号(meruserid): <?=$meruserid ?></td></tr>
	   <tr><td>5、</td><td>协议编号: <?=$agreeid ?></td></tr>
	   <tr><td>6、</td><td>商户订单号: <?=$orderid ?></td></tr>
		<tr><td>7、</td><td>订单金额: <?=$amount ?></td></tr>
		<tr><td>8、</td><td>币种: <?=$currency ?></td></tr>
    <tr><td>9、</td><td>回调地址: <?=$notifyurl ?></td></tr>
		
		<tr><td>组成签名原串的内容: </td><td><textarea  rows="4" cols="120"><?=$bufSignSrc?></textarea></td></tr>
		<tr><td>报文签名后内容: </td><td><?=$signMsg?></td></tr>	
		</tbody>
	</table>
	</body>
	</html>