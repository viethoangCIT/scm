<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

	$function_title = "Danh Sách Dòng Sản Phẩm";
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

	$str_input_product_cat_name = $this->Template->load_textbox(array("name"=>"tensp","autocomplete"=>"off","value"=>"$tensp","id"=>"attendance_day", "placeholder"=>"Nhập tên sản phẩm"));

	$str_input_product_cat_code = $this->Template->load_textbox(array("name"=>"masp","autocomplete"=>"off","value"=>"$masp","id"=>"attendance_day", "placeholder"=>"Nhập mã sản phẩm"));
	// mã sản phẩm
    
 	$str_btn_timkiem = "<input type='submit' class='timkiem' value='Tìm kiếm' style='font-size: 13.4px'>";
    $str_input_attendance_day ="<div id = 'search_bar'> Mã sản phẩm  $str_input_product_cat_code  &nbsp;&nbsp; Tên sản phẩm $str_input_product_cat_name &nbsp; $str_btn_timkiem </br/> </div>";

    //tạo nút thêm
    $str_btn_add = $this->Template->load_button(array('type'=>'button','onclick'=>"window.location='/product_cat/add'"),'Thêm');
	$str_pull_right = "<div style='float:right'>".$str_btn_add."</div>";

	$array_form = array("method"=>"GET","action"=>"/product_cat/index");
	$str_form_product_cat = $this->Template->load_form($array_form, $str_input_attendance_day);


	echo $str_pull_right.$str_form_product_cat;


	//1: tao mang table header 	
	$array_header_product_cat =  array("Stt"=>array("STT",array("style"=>"text-align:left; width:3%")),
		"ten"=>array("Tên dòng sản phẩm ",array("style"=>"text-align:left; width:8%")),
		"msp"=>array("Mã dòng sản phẩm ",array("style"=>"text-align:left; width:8%")),
		"time"=>array("DateTime ",array("style"=>"text-align:left; width:8%")),
		"chucnang"=>array("Chức năng",array("style"=>"text-align:left; width:8%")),
		);

		//2: lấy dòng tr header
	$str_product_cat = $this->Template->load_table_header($array_header_product_cat);

	//lấy dòng nội dung table
	$stt=0;
	foreach ($array_product_cat as $product_cat ) {
		$stt++;
		$id_product_cat = $product_cat['id'];
		$link_sua="/product_cat/add/$id_product_cat.html";
		$link_xoa="/product_cat/del/$id_product_cat.html";
		$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
		$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
		$link_action = $link_xoa . $link_sua;


	$array_product_cat =  array(
		"STT"=>array($stt,array("style"=>"text-align:left; width:3%")),
		"ten"=>array($product_cat["name"],array("style"=>"text-align:left; width:8%")),
		"msp"=>array($product_cat["code"],array("style"=>"text-align:left; width:10%")),
		"time"=>array($product_cat["created"],array("style"=>"text-align:left; width:10%")),
		"chucnang"=>array($link_action,array("style"=>"text-align:center; width:8%")),

		);
	
	$str_product_cat .= $this->Template->load_table_row($array_product_cat);
	
	}

	//Đưa nội dung str_product_cat vào thẻ table
	$str_product_cat =  $this->Template->load_table($str_product_cat);
	echo $str_product_cat;

?>