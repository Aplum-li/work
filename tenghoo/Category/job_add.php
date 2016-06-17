<?php
/**
 * 招聘模型附加字段
 */
?>
<li>
    <span class="span1">招聘单位：</span>
    <span>
    	<input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['danwei'];}?>" name="add[danwei]" class="inputxt input400"/>
    </span>
    <span class="span1">招聘职位：</span>
    <span>
    	<input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['zhiwei'];}?>" name="add[zhiwei]" class="inputxt input400"/>
    </span>
</li>
<li>
    <span class="span1">性别要求：</span>
    <span>
    	<input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['sex'];}?>" name="add[sex]" class="inputxt input400"/>
    </span>

    <span class="span1">招聘人数：</span>
    <span>
    	<input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['jobnum'];}?>" name="add[jobnum]" class="inputxt input400"/>
    </span>
</li>
<li>
    <span class="span1">工作时间：</span>
    <span>
    	<input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['worktime'];}?>" name="add[worktime]" class="inputxt input400"/>
    </span>
    <span class="span1">工作地点：</span>
    <span>
    	<input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['workaddress'];}?>" name="add[workaddress]" class="inputxt input400"/>
    </span>
</li>
<li>
    <span class="span1">面试时间：</span>
    <span>
    	<input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['mstime'];}?>" name="add[mstime]" class="inputxt input400"/>
    </span>
    <span class="span1">面试地址：</span>
    <span>
    	<input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['msaddress'];}?>" name="add[msaddress]" class="inputxt input400"/>
    </span>
</li>
<li>
    <span class="span1">工资待遇：</span>
    <span>
    	<input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['money'];}?>" name="add[money]" class="inputxt input400"/>
    </span>
    <span class="span1">咨询电话：</span>
    <span>
    	<input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['tel'];}?>" name="add[tel]" class="inputxt input400"/>
    </span>
</li>