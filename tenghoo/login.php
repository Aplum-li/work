<?php
/**
 * 登录页
 * 
 */
###############################################################################
require('../include/common.inc.php');
if ($_POST) {
	if(@isAjax()){
		$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
		$password = isset($_POST['password']) && trim($_POST['password']) != '' ? Md5($_POST['password']) : '';
		$safecode = isset($_POST['safecode']) && trim($_POST['safecode']) != '' ? strtolower($_POST['safecode']) : '';
	 	if ($safecode !== $_SESSION['safecode']) {
	 		$data['status'] = 1;
	 		echo json_encode($data);
	 		exit;
	 	}
	 	$where = array('name'=>$name);
	 	$info = @$db -> th_select('admin',$where);
	 	if ($info) {
	 		if ($info['password'] == $password) {
	 			//查询该用户所属角色
	 			$role = $db -> th_select('role_user',array('user_id'=>$info['id']));
	 			if ($role['role_id'] != 1) {
	 				$nodes = array();
	 				$node = array();
	 				$nodes = @$db -> th_selectall('access',array('role_id'=>$role['role_id']),'node_id');
	 				
	 				if($nodes){
	 					foreach ($nodes as $item){
		 					$node[] = $item['node_id'];
		 				}
	 				}
	 				$_SESSION['node'] = $node;
	 			}
	 			$_SESSION['role_id'] = $role['role_id'];
	 			$_SESSION['m_id'] = $info['id'];
		 		$_SESSION['m_name'] = $info['name'];
		 		$data['status'] = 'yes';
	 			echo json_encode($data);
		 		exit();
	 		}else{
	 			$data['status'] = '2';
	 			echo json_encode($data);
	 			exit;
	 		}
	 	}else{
	 		$data['status'] = '3';
	 		echo json_encode($data);
	 		exit;
	 	}
	} else {
		showmsg('禁止访问');
		exit();
	}
}

//接收参数，退出登录
$do = isset($_GET['do']) ? htmlspecialchars($_GET['do']) : '';
if ($do != '' && $do == 'quit') {
	unset($_SESSION['m_id']);
	unset($_SESSION['m_name']);
	unset($_SESSION['role_id']);
	unset($_SESSION['node']);
	showmsg('退出成功',ADMIN.'/login.php');
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>网站后台管理</title>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<?php include 'adminstatic.html';?>
</head>
<style>
body {
	font-family:"宋体";
	font-size:12px;
	background:#f9f9f9;
	margin:0px;
	padding:0px;
}
input{
	font-family:"宋体";
	font-size:12px;
	padding:1px 2px;
	border:#66b2e6 1px solid;
	height:18px;
	line-height:18px;
}

.layout {
	width:510px;
	height:332px;
	background:url(images/logo_bg.png) center no-repeat;
	position:absolute;
	left:50%;
	top:50%;
	margin-left:-250px;
	margin-top:-150px; 
}
#log_in {
	margin: 85px 0 0 175px;
	width: 250px;
	height: 200px;
}

#log_in ul li{
	height: 35px;
	line-height: 35px;
	position: relative;
}
#log_in ul li label{
	float: left;
}
#log_in ul li span{
	float: left;
	margin: 5px 0 0 0;
}
#log_in li input{
	padding: 2px 3px;
}
#log_in li i.fa{
	display: none;
	position: absolute;
	right: 5px;
  	top: 11px;
}
#log_in li i.fa-close{
	color: red;
}
</style>
<body>
<div class="layout">
  <div id="log_in">
    <form action="login.php" method="post" id="loginform" onSubmit="return checkloginform();">
    	<ul>
    		<li>
    			<label>用户名：</label>
          		<span>
          			<input name="name" type="text" class="username" size="25" maxlength="50">
          			<i class="fa fa-close"></i>
          		</span>
    		</li>
    		<li>
    			<label>密　码：</label>
          		<span>
          			<input name="password" type="password" class="password" size="25" maxlength="50">
          			<i class="fa fa-close"></i>
          		</span>
    		</li>
    		<li>
    			<label>验证码：</label>
    			<span>
          			<input name="safecode" type="text" class="safecode" size="8" maxlength='4' style="float:left;"><img src="<?php echo WEBPATH.'captcha.php'?>" onClick="this.src='<?php echo WEBPATH.'captcha.php'?>?t='+Math.random()" style="cursor:pointer;float:left; margin-left:5px;width:65px;">
          			<i class="fa fa-close"></i>
          		</span>
    		</li>
    		<li><input name="submit" type="image" src="images/sub_btn.gif" style="width:98px; height:33px; border:none; margin:0px; padding:0px;"/>
    		</li>
    	</ul><!-- 
      <table width="250" border="0" align="center" cellspacing="0" cellpadding='0'>
        <tr>
          <td align="right" width="40px">用户名：</td>
          <td width="164" class='che'>
          	<input name="name" type="text" class="username" size="25" maxlength="50">
          	<i class="fa fa-close"></i>
          </td>
        </tr>
        <tr hegiht="30px">
          <td align="right">密　码：</td>
          <td class='che'>
          <input name="password" type="password" class="password" size="25" maxlength="50">
          <i class="fa fa-close"></i>
          </td>
        </tr>
        <tr hegiht="30px">
          <td align="right">验证码：</td>
          <td class='che'><input name="safecode" type="text" class="safecode" size="8" maxlength='4' style="float:left;"><img src="../data/Code.php?t=Math.random()" onClick="this.src='../data/Code.php?t='+Math.random()" style="cursor:pointer;float:left; margin-left:5px;width:65px;">
          <i class="fa fa-close"></i>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
          	<input name="submit" type="image" src="images/sub_btn.gif" style="width:98px; height:33px; border:none; margin:0px; padding:0px;"/>
          </td>
        </tr>
      </table> -->
    </form>
  </div>
</div>
<script type="text/javascript">
$(function(){
	$('.username').focus();
	$('input').focus(function(){
		$(this).siblings('.fa').hide();
	})
	$('input').bind('input propertychange',
	    function() {
	    	$(this).siblings('.fa').hide();
	    }
	);
})

//判断登录
function checkloginform(){
	$('#load').show();
	var name = $('.username').val();
	var password = $('.password').val();
	var safecode = $('.safecode').val();
	$.post("login.php", {'name':name,'password':password,'safecode':safecode},
    function(data){
		$('#load').hide();
	    if(data.status == 'yes'){
	    	$('input').siblings('.fa-close').hide();
	    	$('input').siblings('.fa-check').show();
	    	location.href='index.php';
	    }else if (data.status == '1'){
	    	show_error($('.safecode'));
	    }else if (data.status == '2'){
	    	show_error($('.password'));
	    }else if (data.status == '3'){
	    	show_error($('.username'));
	    }else{
			showmsg('系统错误');
	    }
    }, "json");
    return false;
}
function show_error(obj){
	obj.siblings('.fa-close').show();
}
</script>
</body>
</html>