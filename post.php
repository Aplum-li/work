<?php
/**
 *
 * 腾虎网络科技有限公司
 *
 * TENGHOO
 * Author li
 */
require_once 'include/common.inc.php';
$type = isset($_POST['type']) ? Html2Text($_POST['type']) : '';
switch ($type) {
	case 'message':
		if (!isAjax()) {
			showmsg('禁止访问');
			exit();
		}
		$info = $_POST['info'];
		if (!get_magic_quotes_gpc()) {
	        foreach ($info as $key => $value) {
	          $info[$key] = addslashes($value);
	        }
	    }
		$info['addtime'] = time();
		if($db -> th_insert('message',th_dbhold($info))){
			$data['status'] = 'y';
			echo json_encode($data);
			exit();
		}else{
			$data['status'] = 'n';
			echo json_encode($data);
			exit();
		}
		break;
	
	default:
		
		break;
}
?>