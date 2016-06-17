<?php
###############################################################################
require_once '../include/common.inc.php';
require_once '../home.common.php';
$smarty->setTemplateDir(ROOTPATH."/member/templates/");
$commonTpl = ROOTPATH.'/templates/';
$smarty -> assign('commonTplHeader',$commonTpl.'header.html');
$smarty -> assign('commonTplFooter',$commonTpl.'footer.html');