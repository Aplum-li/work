/**
 * 全选/反选
 * @param  {[type]} classname [string]
 * @return {[type]}           [description]
 */
function check_all_other(classname,obj){
	if($(obj).prop('checked')){
		$('.'+classname).prop('checked',true);
	}else{
		$('.'+classname).prop('checked',false);
	}
}

/**
 * 下拉选择框网址跳转
 * @param  {[type]} obj [string]
 * @return {[type]}     [description]
 */
function select_jump(obj){
	var url = $(obj).val();
	location.href=url;
}