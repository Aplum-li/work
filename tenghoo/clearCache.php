<?php
require('checklogin.php');
if($smarty -> clearCompiledTemplate()){
	echo 1;
}else{
	echo 0;
}
?>