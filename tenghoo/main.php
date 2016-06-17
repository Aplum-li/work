<?php 
require('checklogin.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台主窗口</title>
<style type="text/css">

	body{
		font-size:12px;
		margin-left: 0px;
		margin-top: 0px;
		margin-right: 0px;
		margin-bottom: 0px;
	}
  .container{
    width:510px;
    height:332px;
    position:absolute;
    left:50%;
    top:30%;
    margin-left:-250px;
    margin-top:-150px;
    line-height: 40px;
    font-weight: bold; 
  }
  #clock{
    font-size: 18px;
  }
</style>
<?php include 'adminstatic.html';?>
<script type="text/javascript">
if(navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion.match(/7./i)=="7.") {
  alert('您使用的浏览器较旧，请使用新版浏览器操作后台')
}
</script>
</head>

<body background="images/bg.gif" scroll="no">
  <div class="container clearfix">
    <ul style="color:red;font-size: 18px;">
      <li>使用建议</li>
      <li>
        建议使用较新的浏览器操作后台，且使用浏览器的极速模式，极速模式调整：<br>
        <img src="adminstatic/images/browse.png">
        <br>
        较新的浏览器：<br>
        <a href="http://se.360.cn/" target='_blank' style="color:blue">360安全浏览器、</a>
        <a href="http://ie.sogou.com/" target='_blank' style="color:blue">搜狗浏览器、</a>
        <a href="http://www.liebao.cn/" target='_blank' style="color:blue">猎豹浏览器</a>

      </li>
      <li></li>
      <li></li>
    </ul>
    <ul>
      <li>服务器类型：<?php echo PHP_OS?>(IP:<?php echo $_SERVER['REMOTE_ADDR']?>)</li>
      <li>脚本解释引擎：<?php echo phpversion()?></li>
      <li>站点物理路径：<?php echo dirname(dirname(__FILE__))?></li>
      <li>本地操作IP：<?php echo getip()?></li>
    </ul>
    <div id="clock"></div>
<SCRIPT LANGUAGE="JavaScript">

<!-- Begin
var dayarray=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
var montharray=new Array("January","February","March","April","May","June","July","August","September","October","November","December")
function getthedate(){
var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var hours=mydate.getHours()
var minutes=mydate.getMinutes()
var seconds=mydate.getSeconds()
var dn="AM"
if (hours>=12)
dn="PM"
if (hours>12){
hours=hours-12
}
{
 d = new Date();
 Time24H = new Date();
 Time24H.setTime(d.getTime() + (d.getTimezoneOffset()*60000) + 3600000);
 InternetTime = Math.round((Time24H.getHours()*60+Time24H.getMinutes()) / 1.44);
 if (InternetTime < 10) InternetTime = '00'+InternetTime;
 else if (InternetTime < 100) InternetTime = '0'+InternetTime;
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
//change font size here
var cdate=dayarray[day]+", "+montharray[month]+" "+daym+" "+year+" | "+hours+":"+minutes+":"+seconds+" "+dn+""
if (document.all)
document.all.clock.innerHTML=cdate
else if (document.getElementById)
document.getElementById("clock").innerHTML=cdate
else
document.write(cdate)
}
if (!document.all&&!document.getElementById)
getthedate()
function goforit(){
if (document.all||document.getElementById)
setInterval("getthedate()",1000)
}
window.onload=goforit
//  End -->
</script>
  </div>
    <!--/main-->
</div>
</body>
</html>
