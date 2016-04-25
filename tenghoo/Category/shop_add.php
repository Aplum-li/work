<?php
/**
 *
 * 商品模型附加字段处理
 *
 * 这里的每个name对应附加表的字段
 */
?>
<script type="text/javascript">
  UE.getEditor('rule',{
    initialFrameHeight:400,
    enableAutoSave: true,
    saveInterval: 500,
    //更多其他参数，请参考ueditor.config.js中的配置项
    serverUrl: '/data/ueditor136/php/controller.php'
});
</script>
<li>
  <span class="span1 fl">规格参数：</span>
  <span class="fl">
    <textarea name='add[shop_rule]' style='width: 800px;height: 70px;' id="rule"><?php if(!empty($arcinfo)){echo $arcinfo['shop_rule'];}?></textarea>
  </span>
</li>
<li>
  <span class="span1 fl">外链接：</span>
  <span class="fl"><input type="text" value="<?php if(!empty($arcinfo)){echo $arcinfo['shop_three_link'];}?>" name="add[shop_three_link]" class="inputxt input400" /></span>
</li>