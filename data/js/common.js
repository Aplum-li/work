function showmsg (msg,url) {
    layer.msg(msg);
	if (url) {
		setTimeout(function(){
			location.href=url;
		},1200)
	};
}


/**
 * 中文字符串截取函数
 * @param  {[type]}  str    [description]
 * @param  {[type]}  len    [description]
 * @param  {Boolean} hasDot [description]
 * @return {[type]}         [description]
 */
function subString(str, len, hasDot) 
    { 
        var newLength = 0; 
        var newStr = ""; 
        var chineseRegex = /[^\x00-\xff]/g; 
        var singleChar = ""; 
        var strLength = str.replace(chineseRegex,"**").length; 
        for(var i = 0;i < strLength;i++) 
        { 
            singleChar = str.charAt(i).toString(); 
            if(singleChar.match(chineseRegex) != null) 
            { 
                newLength += 2; 
            }     
            else 
            { 
                newLength++; 
            } 
            if(newLength > len) 
            { 
                break; 
            } 
            newStr += singleChar; 
        } 
         
        if(hasDot && strLength > len) 
        { 
            newStr += "..."; 
        } 
        return newStr; 
    }