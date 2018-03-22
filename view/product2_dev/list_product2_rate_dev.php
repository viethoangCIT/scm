<?php

	//BEGIN: FUNCTION HEADER

	$function_title = "Nhập Định Mức Nguyên Liệu";
	echo $this->Template->load_function_header($function_title);

	//END: FUNCTION HEADER
	$id = "";
	$id_material = "";
	$num = "";
	$unit = "";
	if($array_edit_product != null)
	{
		$id 	= $array_edit_product[0]['id'];
		$id_material = $array_edit_product[0]['id_material'];
		$num = $array_edit_product[0]['num'];
		$unit = $array_edit_product[0]['unit'];
	}



	//begin:1.dòng sản phẩm

	//tạo dòng chọn sản phẩm có combo sản phẩm
	$str_hidden_id_product = $this->Template->load_hidden(array("name"=>"data[id_product]","value"=>$id_product));

	$array_row_product = array("title"=>"Sản Phẩm","input"=>$str_product_name.$str_hidden_id_product);
	$str_form_content = $this->Template->load_form_row($array_row_product);


	//end: dòng sản phẩm
	
	//begin: dòng nguyên liệu
	$array_combo_material = array("name"=>"data[id_material]","style"=>"width:150px;");
	$str_combo_material = $this->Template->load_selectbox($array_combo_material,$array_material,$id_material);

	//tạo dòng chọn nguyên liệu
	$array_row_material = array("title"=>"Nguyên liệu","input"=>$str_combo_material);
	$str_form_content .= $this->Template->load_form_row($array_row_material);

	//end: dòng nguyên liệu


	//BEGIN: 1.dòng số lượng
	//1.1 dùng hàm $this->Template->load_textbox để tạo textbox
	$array_textbox_num = array("name"=>"data[num]","value"=>$num,"style"=>"width:200px;");
	$str_textbox_num = $this->Template->load_textbox($array_textbox_num);
		
	//1.2. tạo dòng nhập số lượng có textbox số lượng 
	$array_row_num = array("title"=>"Số lượng","input"=>$str_textbox_num);
	$str_form_content .= $this->Template->load_form_row($array_row_num);
	//END: dòng số lượng

	//BEGIN: 1.dòng số lượng
	//1.1 dùng hàm $this->Template->load_textbox để tạo textbox
	$array_textbox_unit = array("name"=>"data[unit]","value"=>$unit,"style"=>"width:200px;");
	$str_textbox_unit = $this->Template->load_textbox($array_textbox_unit);
		
	//1.2. tạo dòng nhập số lượng có textbox số lượng 
	$array_row_unit = array("title"=>"Đơn vị","input"=>$str_textbox_unit);
	$str_form_content .= $this->Template->load_form_row($array_row_unit);
	//END: dòng số lượng

	//***********************************
	//BEGIN: Tạo input hidden đựng giá trị id
	$array_hidden_id = array("name"=>"data[id]","value"=>$id);
	$str_hidden_id = $this->Template->load_hidden($array_hidden_id);

	//END: Tạo input hidden đựng giá trị id
	//***********************************

	//gọi hàm $this->Template->load_button() để tạo string input type = button, nút bấm để lưu
	$str_save_button = $this->Template->load_button(array("value"=>"Lưu","type"=>"submit"),"Lưu");
	$array_row_save = array("title"=>"","input"=>$str_save_button.$str_hidden_id);
	$str_form_content.= $this->Template->load_form_row($array_row_save);			
	
	//gọi hàm load_form của đối tượng Template để lấy thẻ form
	$array_form = array("method"=>"GET","action"=>"/product2/list_rate");
	$str_form_post = $this->Template->load_form($array_form,$str_form_content);
	echo $str_form_post;


	$function_title = "Danh Sách Định Mức Nguyên Liệu";
	echo $this->Template->load_function_header($function_title);


	//1: tao mang table header 	
	$array_header_product =  array("Stt"=>array("STT",array("style"=>"text-align:left; width:3%")),
		"tensp"=>array("Tên sản phẩm ",array("style"=>"text-align:left; width:8%")),
		"tennl"=>array("Tên nguyên liệu ",array("style"=>"text-align:left; width:8%")),
		"sl"=>array("Số lượng",array("style"=>"text-align:left; width:8%")),
		"dv"=>array("Đơn vị",array("style"=>"text-align:left; width:8%")),
		"chucnang"=>array("Chức năng",array("style"=>"text-align:left; width:8%")),
		);

		//2: lấy dòng tr header
	$str_product = $this->Template->load_table_header($array_header_product);

		//lấy dòng nội dung table
	$stt=0;
	if($array_product_rate){
		foreach ($array_product_rate as $product ) {
			$stt++;
			$id = $product['id'];
			$id_product = $product['id_product'];
			$link_sua="/product2/list_rate/$id_product/$id.html";
			$link_xoa="/product2/del_rate/$id_product/$id.html";
			$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
			$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
			$link_action = $link_xoa . $link_sua;

		
		$array_product_rate =  array(
			"STT"=>array($stt,array("style"=>"text-align:left; width:3%")),
			"tensp"=>array($product["product_name"],array("style"=>"text-align:left; width:8%")),
			"tennl"=>array($product["material_name"],array("style"=>"text-align:left; width:10%")),
			"sl"=>array($product["num"],array("style"=>"text-align:left; width:8%")),
			"dv"=>array($product["unit"],array("style"=>"text-align:left; width:8%")),
			"chucnang"=>array($link_action,array("style"=>"text-align:center; width:8%")),
			);
		$str_product .= $this->Template->load_table_row($array_product_rate);

		}//END: foreach ($array_product_rate as $product ) {
	}//END: if($array_product_rate){

	//Đưa nội dung str_product vào thẻ table
	$str_product =  $this->Template->load_table($str_product);
	echo $str_product;			

?>