<?php
header('Content-Type: text/html; charset=utf-8');
class myphpexcel{
	//作者
	public $creator = "test";
	//最后修改者
	public $lastmodifiedby = "test";
	//表格标题
	public $title = "test";
	//主题
	public $subject = "test";
	//描述
	public $description = "test";
	//关键字
	public $keywords = "test";
	//类别
	public $category = 'test';

	public function __construct(){
		//载入PHPExcel类
		require 'PHPExcel.php';
		//创建一个excel对象实例
		$this -> objPHPExcel = new PHPExcel();
		//设置文档基本属性
		$objProps = $this -> objPHPExcel->getProperties();
		$objProps->setCreator($this -> creator);
		$objProps->setTitle($this -> title);
		$objProps->setSubject($this -> subject);
		$objProps->setDescription($this -> description);
		$objProps->setKeywords($this -> keywords);
		$objProps->setCategory($this -> category);
		$this -> objPHPExcel->setActiveSheetIndex(0);
		$objActSheet = $this -> objPHPExcel->getActiveSheet();
	}

	//导出
	public function excelOut( $arr = array() ){
		if (empty($arr)) {
			return false;
		}  
		$this -> objPHPExcel->getActiveSheet()->setCellValue('A1', '文章标题'); 
		$this -> objPHPExcel->getActiveSheet()->setCellValue('B1', '文章图片'); 
		$this -> objPHPExcel->getActiveSheet()->setCellValue('C1', '文章多图'); 
		$this -> objPHPExcel->getActiveSheet()->setCellValue('D1', '文章描述'); 
		$this -> objPHPExcel->getActiveSheet()->setCellValue('E1', '文章内容'); 
		$this -> objPHPExcel->getActiveSheet()->setCellValue('F1', '是否推荐');
		$this -> objPHPExcel->getActiveSheet()->setCellValue('G1', '是否头条');
		$this -> objPHPExcel->getActiveSheet()->setCellValue('H1', '排序');
		$i = 2;
		foreach($arr as $item){ 
			$this -> objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $item['title']); 
			$this -> objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $item['litpic']); 
			$this -> objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $item['litpics']); 
			$this -> objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $item['description']); 
			$this -> objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $item['content']); 
			$this -> objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $item['c']); 
			$this -> objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $item['h']); 
			$this -> objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $item['sort']); 
			$i++; 
		}
		$objActSheet = $this -> objPHPExcel->getActiveSheet();
		//$objActSheet->getColumnDimension('C')->setAutoSize(true);
		$objActSheet->getColumnDimension('A')->setWidth(50);
		$objActSheet->getColumnDimension('B')->setWidth(50);
		$objActSheet->getColumnDimension('C')->setWidth(60);
		$objActSheet->getColumnDimension('E')->setAutoSize(true);
		//样式美化
		$this -> objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray(
             array(
                   'font'    => array (
                         'bold'      => true
                   ),
                   'alignment' => array (
                         'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER ,
                  ),
                   'borders' => array (
                         'top'     => array (
                               'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                  ),
                   'fill' => array (
                         'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR ,
                         'rotation'   => 90,
                         'startcolor' => array (
                               'argb' => 'FFA0A0A0'
                         ),
                         'endcolor'   => array (
                               'argb' => 'FFFFFFFF'
                         )
                  )
            )
		);

		//输出文档
		$objWriter = new PHPExcel_Writer_Excel5($this -> objPHPExcel);
		$finalFileName = $this -> title.'.xls';
		$dirpath = $_SERVER['DOCUMENT_ROOT'].'/upload/phpexcel/';
		$objWriter->save($dirpath.$finalFileName);
		header('Content-Type: application/vnd.ms-excel');
		header("Content-Disposition:attachment; filename={$finalFileName}");
		header('Cache-Control: max-age=0');
		echo file_get_contents($dirpath.$finalFileName);
	}

	//导入
	public function importExcel($file,$typeid){
		global $db;
		//判断文件类型，如果不是"xls"或者"xlsx"，则退出
        if ( $file["type"] == "application/vnd.ms-excel" ){
                $inputFileType = 'Excel5';
        }
        elseif ( $file["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ){
                $inputFileType = 'Excel2007';
        }
        else {
                echo "Type: " . $file["type"] . "<br />";
                echo "Invalid file type";
                exit();
        }
        
        if ($file["error"] > 0)
        {
                echo "Error: " . $file["error"] . "<br />";
                exit();
        }

        $inputFileName = ROOTPATH . "/upload/phpexcel/" . $file["name"];
        if (file_exists($inputFileName))
        {
                //echo $file["name"] . " already exists. <br />";
                unlink($inputFileName);    //如果服务器上存在同名文件，则删除
        }
        else
        {
        }
        move_uploaded_file($file["tmp_name"],$inputFileName);
        //echo "Stored in: " . $inputFileName;
        //导入phpExcel
        include_once THINC . '/class/PHPExcel/IOFactory.php';
        
        //设置php服务器可用内存，上传较大文件时可能会用到
        ini_set('memory_limit', '1024M');
        
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        
        $WorksheetInfo = $objReader->listWorksheetInfo($inputFileName);

        //读取文件最大行数、列数，偶尔会用到。
        $maxRows = $WorksheetInfo[0]['totalRows'];
        $maxColumn = $WorksheetInfo[0]['totalColumns'];     
        //列数可用于粗略判断所上传文件是否符合模板要求
        
        //设置只读，可取消类似"3.08E-05"之类自动转换的数据格式，避免写库失败
        $objReader->setReadDataOnly(true);
        
        $objPHPExcel = $objReader->load($inputFileName);
        $sheetData = $objPHPExcel->getSheet(0)->toArray(null,true,true,true);
        //excel2003文件，可使用'$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);'
        //excel2007文件使用"getActiveSheet()"方法时会提示出错：对non-object使用了"toArray"方法。
        //才疏学浅，原因未明。。。


        //获取表头，并判断是否符合格式
        $keywords = $sheetData[1];
        $warning = '上传文件格式不正确，请修改后重新上传！<br />';
        $columns = array ( 'A','B', 'C', 'D', 'E', 'F', 'G','H' );
        $keysInFile = array ( '文章标题', '文章图片', '文章多图', '文章描述', '文章内容', '是否推荐','是否头条','排序');
        foreach( $columns as $keyIndex => $columnIndex ){
                if ( $keywords[$columnIndex] != $keysInFile[$keyIndex] ){
                        echo $warning . $columnIndex . '列应为' . $keysInFile[$keyIndex] . '，而非' . $keywords[$columnIndex];
                        exit();
                }
        }
        
        //数据库字段
        $keywords = array ( 'title', 'litpic', 'litpics', 'description', 'content', 'c','h','sort' );
        foreach ( $sheetData as $key => $words ){
                if ( $key != 1 ){
                        //忽略表头
                        $query = "insert into `th_article` (" . implode( $keywords, "," ) . ",creattime,status,typeid) values ('" . implode ( $words, "','" )."','".time()."','1',".$typeid.")";
                        if ( ! ($result = $db -> query ( $query ) ) ){
                                echo '第' . $key . '行数据导入错误' . mysql_error();
                                exit();
                        }
                }
        }
        return true;
	}
}