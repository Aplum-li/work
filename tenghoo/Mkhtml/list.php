<?php
require('../checklogin.php');
//栏目表
$article_type_table = 'article_type';
$where = array('order by'=>'sort,id');
$typelist = $db -> th_selectall($article_type_table,$where,'id,pid,topid,typename');
$category = new category();
$typelist = $category->toLevel($typelist,' ┖ ');
$str = '&nbsp;&nbsp;&nbsp;';
foreach ($typelist  as $key => $value) {
    $pre = str_repeat($str, $value['level']);
    $typelist[$key]['str'] = $pre;
}

$pos = '生成列表html';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>网站信息配置</title>
<?php include '../adminstatic.html';?>
<link href="../css/base.css" rel="stylesheet" type="text/css">
<style type="text/css">
.result-content{
    text-align: center;
    height: 40px;
    border-bottom: 1px solid #ddd;
}
.coolbg{
    padding: 5px 10px;
}
td{
    padding: 5px;
}
</style>
</head>

<body>
<div class="container clearfix">
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><a href="../main.php"><i class="fa fa-home fa-fw"></i> 首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="index.php"><?php echo $pos;?></a></div>
        </div>
        <div class="result-wrap" style="height:100%;">
            <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#D6D6D6" align="center">
              <form action="mkhtml.php" target="stafrm" name="form1">
                <tr> 
                    <td width="108" valign="middle" bgcolor="#FFFFFF">选择栏目：</td>
                    <td width="377" valign="middle" bgcolor="#FFFFFF"> 
                        <select name='typeid' style='width:300px'>
                            <option value='0' selected='1'>更新所有栏目...</option>
                            <?php if($typelist){foreach ($typelist as $key => $value) { ?>
                            <option value="<?php echo $value['id'];?>" ><?php echo $value['delimiter'];?> <?php echo $value['typename'];?></option>
                            <?php }}?>
                        </select>      
                    </td>
                </tr>
                <tr>
                  <td height="20" valign="middle" bgcolor="#FFFFFF">每次最大创建页数：</td>
                  <td height="20" valign="middle" bgcolor="#FFFFFF">
                    <input name="pagesize" type="text" value="3" size="10"> 个文件 </td>
                </tr>
                <tr> 
                  <td height="30" colspan="2" bgcolor="#ffffff" align="center">
                    <input type="hidden" name="type" value="list">
                    <input type="hidden" name="startid" value="0">
                    <input name="b112" type="button" class="coolbg np" value="开始生成HTML" onClick="document.form1.submit();" style="width:100px">
                  </td>
                </tr>
              </form>
              <tr bgcolor="#F9FCEF"> 
                <td height="20" colspan="2"> <table width="100%">
                    <tr> 
                      <td width="74%">进行状态： </td>
                      <td width="26%" align="right"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr bgcolor="#FFFFFF"> 
                <td colspan="2" id="mtd">
                    <div id='mdv' style='width:100%;height:350px;'> 
                    <iframe src="mkhtml.php" name="stafrm" id="stafrm" width="100%" height="80%" frameborder="0"></iframe>
                  </div>
                  </td>
              </tr>
            </table>
            </body>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
