<?php

		//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tạo tiêu đề hàm
	$function_title = "Nhập dòng sản phẩm";
	echo $this->Template->load_function_header($function_title);

	$str_form_product_cat = "";
	//tạo textbox nhập tên tài sản
	$name = "";
	$code = "";
	$id = "";
	if($array_edit_product_cat != null)
	{
		$name = $array_edit_product_cat["0"]["name"];
		$code = $array_edit_product_cat["0"]["code"];
		$id = $array_edit_product_cat["0"]["id"];

	}



	//BEGIN: Tạo input hidden đựng giá trị id
	$str_input_product_cat_id = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id_product_cat","value"=>"$id","style"=>"width:300px"));
	//END: Tạo input hidden đựng giá trị id


	//BEGIN: 2.dòng tên sản phẩm
	//2.1 dùng hàm $this->Template->load_textbox để tạo textbox
	$str_input_product_cat_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>"$name","style"=>"width:300px"))."<span id='mate_name1'></span>";

	//2.2. tạo dòng nhập tiêu đề có textbox tên sản phẩm
	$str_form_product_cat .= $this->Template->load_form_row(array("title"=>"Tên dòng sản phẩm ","input"=>$str_input_product_cat_name));
	//END: dòng tên sản phẩm

	//BEGIN: 1.dòng mã sản phẩm
	//1.1 dùng hàm $this->Template->load_textbox để tạo textbox
	$str_input_product_cat_code = $this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>"$code","style"=>"width:300px"))."<span id='mate_code1'></span>";

	//1.2. tạo dòng nhập tiêu đề có textbox mã sản phẩm
	$str_form_product_cat .= $this->Template->load_form_row(array("title"=>"Mã dòng sản phẩm ","input"=>$str_input_product_cat_code.$str_input_product_cat_id));
	//END: dòng mã sản phẩm


		//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"submit","onclick"=>"kiemtra()"),"Lưu");
	$str_form_product_cat .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));

		//đưa vào form
	$str_form_product_cat = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"
		/product_cat/index"),$str_form_product_cat);
	echo $str_form_product_cat;


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

	$array_form = array("method"=>"GET","action"=>"/product_cat/index");
	$str_form_product_cat = $this->Template->load_form($array_form, $str_input_attendance_day);


	echo $str_form_product_cat;


	//1: tao mang table header 	
	$array_header_product_cat["col1"] = array("STT",array("style"=>"text-align:left; width:3%"));
	$array_header_product_cat["col2"] = array("Tên dòng sản phẩm",array("style"=>"text-align:left; width:8%"));
	$array_header_product_cat["col3"] = array("Mã dòng sản phẩm",array("style"=>"text-align:left; width:3%"));
	$array_header_product_cat["col4"] = array("DateTime",array("style"=>"text-align:left; width:8%"));
	$array_header_product_cat["col5"] = array("Import sản phẩm",array("style"=>"text-align:center; width:8%"));
	$array_header_product_cat["col6"] = array("Chi tiết",array("style"=>"text-align:center; width:3%"));
	$array_header_product_cat["col7"] = array("Sửa",array("style"=>"text-align:center; width:3%"));
	$array_header_product_cat["col8"] = array("Xóa",array("style"=>"text-align:center; width:3%"));

		//2: lấy dòng tr header
	$str_product_cat = $this->Template->load_table_header($array_header_product_cat);

	//lấy dòng nội dung table
	$stt=0;
	if($array_product_cat)
	{
		foreach ($array_product_cat as $product_cat ) {
			$stt++;
			$id_product_cat = $product_cat['id'];
			$link_sua="/product_cat/index/$id_product_cat.html";
			$link_xoa="/product_cat/del/$id_product_cat.html";
			$link_import="/product_cat/import/$id_product_cat";
			$link_chitiet="/product_cat/detail/$id_product_cat.html";
			$link_import = $this->Template->load_link("edit","Imports", $link_import);
			$link_chitiet = $this->Template->load_link("edit","Chi tiết", $link_chitiet);
			$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
			$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
			//$link_action = $link_xoa . $link_sua;
	
	
		$array_product_cats["col1"] = array($stt,array("style"=>"text-align:left; width:3%"));
		$array_product_cats["col2"] = array($product_cat["name"],array("style"=>"text-align:left; width:8%"));
		$array_product_cats["col3"] = array($product_cat["code"],array("style"=>"text-align:left; width:3%"));
		$array_product_cats["col4"] = array($product_cat["created"],array("style"=>"text-align:left; width:8%"));
		$array_product_cats["col5"] = array($link_import);
		$array_product_cats["col6"] = array($link_chitiet);
		$array_product_cats["col7"] = array($link_sua);
		$array_product_cats["col8"] = array($link_xoa);
		
		$str_product_cat .= $this->Template->load_table_row($array_product_cats);
		
		}
	}
	//Đưa nội dung str_product_cat vào thẻ table
	$str_product_cat =  $this->Template->load_table($str_product_cat);
	echo $str_product_cat;

?>