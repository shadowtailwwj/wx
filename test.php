<?php
	header("Content-type:text/html;charset=utf-8");
	require_once 'AppConfig.php';
	require_once 'AppUtil.php';

echo agreesms();

?>

		<table class="table_box" width="90%" align="center">
		   <tr class="tit_bar">
		      <td colspan="2" class="tit_bar">提交的批量订单查询表单参数</td>
		   </tr>
		   <tr><td>1</td><td>接口版本号: <?=$version?></td></tr>
		   <tr><td>2</td><td>商户号: <?=$merchantId?></td></tr>
		   <tr><td>3</td><td>查询起始时间: <?=$beginDateTime ?></td></tr>
		   <tr><td>4</td><td>查询结束时间: <?=$endDateTime?></td></tr>
		   <tr><td>5</td><td>页码: <?=$pageNo?></td> </tr>
		   <tr><td>6</td><td>签名方式: <?=$signType?></td></tr>
		   <tr><td>7</td><td>签名串: <?=$signMsg?></td></tr>
		   <tr><td>签名原串：</td><td><?=$bufSignSrc?></td></tr>
		</table>

	
<?php
	//重发签约短信
	function agreesms(){
		$params = array();
		$params["cusid"] = AppConfig::CUSID;
	    $params["appid"] = AppConfig::APPID;
	    $params["version"] = AppConfig::APIVERSION;
	    $params["reqip"] = "";
	    $params["reqtime"] = "";
	    $params["randomstr"] = "1450432107647";//随机字符串
	    $params["meruserid"] = "";
	    $params["accttype"] = "00";//
	    $params["acctno"] = "";//
	    $params["idno"] = "";//
	    $params["acctname"] = "";//
	    $params["mobile"] = "";//
	    $params["validdate"] = "";//
	    $params["cvv2"] = "";// 
	    $params["thpinfo"] = "";//	   
	    $params["sign"] = AppUtil::SignArray($params,AppConfig::APPKEY);//签名
	    $paramsStr = AppUtil::ToUrlParams($params);
	    $url = AppConfig::APIURL . "/agreesms";
	    $rsp = request($url, $paramsStr);
		echo "请求返回:".$rsp;
	    echo "<br/>";
	    $rspArray = json_decode($rsp, true); 
	    if(validSign($rspArray)){
	    	echo "验签正确,进行业务处理";
	    }
	}
	
		//商户支付申请
	function payapply(){
		$params = array();
		$params["cusid"] = AppConfig::CUSID;
	    $params["appid"] = AppConfig::APPID;
	    $params["version"] = AppConfig::APIVERSION;
	    $params["reqip"] = "";
	    $params["reqtime"] = "";
	    $params["randomstr"] = "1450432107647";//随机字符串
	    $params["orderid"] = "";
	    $params["agreeid"] = "";//
	    $params["amount"] = "";//
	    $params["currency"] = "";//
	    $params["subject"] = "";//
	    $params["validtime"] = "";//
	    $params["trxreserve"] = "";//
	    $params["notifyurl"] = "";// 
	    $params["sign"] = AppUtil::SignArray($params,AppConfig::APPKEY);//签名
	    $paramsStr = AppUtil::ToUrlParams($params);
	    $url = AppConfig::APIURL . "/payapplyagree";
	    $rsp = request($url, $paramsStr);
		echo "请求返回:".$rsp;
	    echo "<br/>";
	    $rspArray = json_decode($rsp, true); 
	    if(validSign($rspArray)){
	    	echo "验签正确,进行业务处理";
	    }
	}
	
	
		//商户支付申请确认
	function payagree(){
		$params = array();
		$params["cusid"] = AppConfig::CUSID;
	    $params["appid"] = AppConfig::APPID;
	    $params["version"] = AppConfig::APIVERSION;
	    $params["reqip"] = "";
	    $params["reqtime"] = "";
	    $params["randomstr"] = "1450432107647";//随机字符串
	    $params["orderid"] = "";
	    $params["agreeid"] = "";//
	    $params["smscode"] = "";//
	    $params["thpinfo"] = "";//
	    $params["sign"] = AppUtil::SignArray($params,AppConfig::APPKEY);//签名
	    $paramsStr = AppUtil::ToUrlParams($params);
	    $url = AppConfig::APIURL . "/payagreeconfirm";
	    $rsp = request($url, $paramsStr);
		echo "请求返回:".$rsp;
	    echo "<br/>";
	    $rspArray = json_decode($rsp, true); 
	    if(validSign($rspArray)){
	    	echo "验签正确,进行业务处理";
	    }
	}
	
	
	//重新获取支付短信
	function paysms(){
		$params = array();
		$params["cusid"] = AppConfig::CUSID;
	    $params["appid"] = AppConfig::APPID;
	    $params["version"] = AppConfig::APIVERSION;
	    $params["reqip"] = "";
	    $params["reqtime"] = "";
	    $params["randomstr"] = "1450432107647";//随机字符串
	    $params["orderid"] = "";
	    $params["agreeid"] = "";//
	    $params["thpinfo"] = "";//
	    $params["sign"] = AppUtil::SignArray($params,AppConfig::APPKEY);//签名
	    $paramsStr = AppUtil::ToUrlParams($params);
	    $url = AppConfig::APIURL . "/paysmsagree";
	    $rsp = request($url, $paramsStr);
		echo "请求返回:".$rsp;
	    echo "<br/>";
	    $rspArray = json_decode($rsp, true); 
	    if(validSign($rspArray)){
	    	echo "验签正确,进行业务处理";
	    }
	}
	
	
	
	//协议查询
	function agreequery(){
		$params = array();
		$params["cusid"] = AppConfig::CUSID;
	    $params["appid"] = AppConfig::APPID;
	    $params["version"] = AppConfig::APIVERSION;
	    $params["reqip"] = "";
	    $params["reqtime"] = "";
	    $params["randomstr"] = "1450432107647";//随机字符串
	    $params["meruserid"] = "";
	    $params["sign"] = AppUtil::SignArray($params,AppConfig::APPKEY);//签名
	    $paramsStr = AppUtil::ToUrlParams($params);
	    $url = AppConfig::APIURL . "/agreequery";
	    $rsp = request($url, $paramsStr);
		echo "请求返回:".$rsp;
	    echo "<br/>";
	    $rspArray = json_decode($rsp, true); 
	    if(validSign($rspArray)){
	    	echo "验签正确,进行业务处理";
	    }
	}
	
	
		//银行卡解绑
	function unbind(){
		$params = array();
		$params["cusid"] = AppConfig::CUSID;
	    $params["appid"] = AppConfig::APPID;
	    $params["version"] = AppConfig::APIVERSION;
	    $params["reqip"] = "";
	    $params["reqtime"] = "";
	    $params["randomstr"] = "1450432107647";//随机字符串
	    $params["agreeid"] = "";
	    $params["sign"] = AppUtil::SignArray($params,AppConfig::APPKEY);//签名
	    $paramsStr = AppUtil::ToUrlParams($params);
	    $url = AppConfig::APIURL . "/unbind";
	    $rsp = request($url, $paramsStr);
		echo "请求返回:".$rsp;
	    echo "<br/>";
	    $rspArray = json_decode($rsp, true); 
	    if(validSign($rspArray)){
	    	echo "验签正确,进行业务处理";
	    }
	}
	
	
	
			//交易撤销
	function cancel(){
		$params = array();
		$params["cusid"] = AppConfig::CUSID;
	    $params["appid"] = AppConfig::APPID;
	    $params["version"] = AppConfig::APIVERSION;
	    $params["reqip"] = "";
	    $params["reqtime"] = "";
	    $params["randomstr"] = "1450432107647";//随机字符串
	    $params["orderid"] = "";
	    $params["trxamt"] = "";
	    $params["oldorderid"] = "";
	    $params["oldtrxid"] = "";
	    $params["sign"] = AppUtil::SignArray($params,AppConfig::APPKEY);//签名
	    $paramsStr = AppUtil::ToUrlParams($params);
	    $url = AppConfig::APIURL . "/cancel";
	    $rsp = request($url, $paramsStr);
		echo "请求返回:".$rsp;
	    echo "<br/>";
	    $rspArray = json_decode($rsp, true); 
	    if(validSign($rspArray)){
	    	echo "验签正确,进行业务处理";
	    }
	}
	
				//交易退款
	function refund(){
		$params = array();
		$params["cusid"] = AppConfig::CUSID;
	    $params["appid"] = AppConfig::APPID;
	    $params["version"] = AppConfig::APIVERSION;
	    $params["reqip"] = "";
	    $params["reqtime"] = "";
	    $params["randomstr"] = "1450432107647";//随机字符串
	    $params["orderid"] = "";
	    $params["trxamt"] = "";
	    $params["oldorderid"] = "";
	    $params["oldtrxid"] = "";
	    $params["sign"] = AppUtil::SignArray($params,AppConfig::APPKEY);//签名
	    $paramsStr = AppUtil::ToUrlParams($params);
	    $url = AppConfig::APIURL . "/refund";
	    $rsp = request($url, $paramsStr);
		echo "请求返回:".$rsp;
	    echo "<br/>";
	    $rspArray = json_decode($rsp, true); 
	    if(validSign($rspArray)){
	    	echo "验签正确,进行业务处理";
	    }
	}
	
	
    //交易查询
	function query(){
		$params = array();
		$params["cusid"] = AppConfig::CUSID;
	    $params["appid"] = AppConfig::APPID;
	    $params["version"] = AppConfig::APIVERSION;
	    $params["reqip"] = "";
	    $params["reqtime"] = "";
	    $params["randomstr"] = "1450432107647";//随机字符串
	    $params["orderid"] = "";
	    $params["trxid"] = "";
	    $params["sign"] = AppUtil::SignArray($params,AppConfig::APPKEY);//签名
	    $paramsStr = AppUtil::ToUrlParams($params);
	    $url = AppConfig::APIURL . "/query";
	    $rsp = request($url, $paramsStr);
		echo "请求返回:".$rsp;
	    echo "<br/>";
	    $rspArray = json_decode($rsp, true); 
	    if(validSign($rspArray)){
	    	echo "验签正确,进行业务处理";
	    }
	}
	
	//发送请求操作仅供参考,不为最佳实践
	function request($url,$params){
		$ch = curl_init();
		$this_header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
		curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		 
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//如果不加验证,就设false,商户自行处理
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		 
		$output = curl_exec($ch);
		curl_close($ch);
		return  $output;
	}
	
	//验签
	function validSign($array){
		if("SUCCESS"==$array["retcode"]){
			$signRsp = strtolower($array["sign"]);
			$array["sign"] = "";
			$sign =  strtolower(AppUtil::SignArray($array, AppConfig::APPKEY));
			if($sign==$signRsp){
				return TRUE;
			}
			else {
				echo "验签失败:".$signRsp."--".$sign;
			}
		}
		else{
			echo $array["retmsg"];
		}
		return FALSE;
	}
	
?>