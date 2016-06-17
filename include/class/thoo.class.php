<?php
class Thoo extends Smarty {

 	function __construct() {

 		parent::__construct(); 

		$this->left_delimiter = "{th:";   #左分界符，2.0属性，3.0沿用

		$this->right_delimiter = "}";   #右分界符，2.0属性，3.0沿用

		//设置模板目录：templates
		//设置模板编译目录：templates_c
		//设置Smarty配置文件目录，在本程序中暂时没用到
		//设置缓存目录：cache
		//设置插件目录：plugins
		$this->setTemplateDir(ROOTPATH."/templates/")
			 ->setCompileDir(ROOTPATH."/smarty/templates_c/")
			 ->setConfigDir(ROOTPATH."/smarty/configs/")
			 ->setCacheDir(ROOTPATH."/smarty/cache/")
			 ->addPluginsDir(ROOTPATH."/smarty/plugins/");
		
		//** 如果需要显示调试控制台，请去掉下行注释
		// $smarty->debugging = true;
// 		$this->caching = loadConfig('iscache');//缓存控制,为真即开启缓存
// 		$this->cache_lifetime=loadConfig('lifetime');//缓存文件的生命周期 60*60*24*7
		/* $this->caching = true;//缓存控制,为真即开启缓存
		$this->cache_lifetime=10;//缓存文件的生命周期 60*60*24*7 */
 	}

 	// public function makeHtmlFile($file_name, $content) {
 	// 	clearstatcache();
		// //目录不存在就创建
		// if (!file_exists (dirname($file_name))) {
		//   if (!@mkdir (dirname($file_name), 0777)) {
		//       die($file_name."目录创建失败！");
		//   }
		// }
		// file_put_contents($file_name, $content);
		// chmod($file_name,0666);
  // }

}