<<<<<<< HEAD
$(function(){
	$('.navList').children('li').last().css({"background":"none"});
	$('.indexPorList').children('li').last().css({"marginRight":"0"});
	$('.varietyList').children('li').last().css({"marginRight":"0"});
	$('.mainLeft').height($('.mainRight').height()+35);
})

//左右悬浮
function suspension(obj){
	if ($(obj).attr('name') == 1) {
		$(obj).siblings('div.weichatImg').hide();
		$(obj).attr('name',2)
	} else {
		$(obj).siblings('div.weichatImg').show();
		$(obj).attr('name',1)
	}
	
=======
$(function(){
	$('.navList').children('li').last().css({"background":"none"});
	$('.indexPorList').children('li').last().css({"marginRight":"0"});
	$('.varietyList').children('li').last().css({"marginRight":"0"});
	$('.mainLeft').height($('.mainRight').height()+35);
})

//左右悬浮
function suspension(obj){
	if ($(obj).attr('name') == 1) {
		$(obj).siblings('div.weichatImg').hide();
		$(obj).attr('name',2)
	} else {
		$(obj).siblings('div.weichatImg').show();
		$(obj).attr('name',1)
	}
	
>>>>>>> e316a12f2883fdf9eead1ad03250455c1ccaf174
}