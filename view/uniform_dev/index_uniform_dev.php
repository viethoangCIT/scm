<?php 																																																			
	//tạo tiêu đề hàm
	$function_title = "Nhập danh mục cấp đồng phục";
	echo $this->Template->load_function_header($function_title);
	
	
	$quantity = "";
	$name = "";
	$price = "";
	$id = "";
	if($array_edit_uniform != null)
	{
		$quantity = $array_edit_uniform["0"]["quantity"];
		$name = $array_edit_uniform["0"]["name"];
		$price = $array_edit_uniform["0"]["price"];
		$id = $array_edit_uniform["0"]["id"];

	}


	$str_input_uniform_id = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id","value"=>"$id","style"=>"width:300px"));
	//tạo textbox nhập tên tài sản
	$str_input_uniform_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>"$name","style"=>"width:300px"));	
	
	//tạo dòng nhập tên đồng phục
	$str_form_uniform = "";
	$str_form_uniform .= $this->Template->load_form_row(array("title"=>"Tên phụ cấp ","input"=>$str_input_uniform_name.$str_input_uniform_id));
	
		
	//tạo textbox số lượng
	$str_input_uniform_quantity = $this->Template->load_textbox(array("name"=>"data[quantity]","id"=>"quantity","value"=>"$quantity","style"=>"width:300px"));	
	$str_form_uniform .= $this->Template->load_form_row(array("title"=>"Số lượng ","input"=>$str_input_uniform_quantity));

	//tạo textbox nhập giá tiền
	$str_input_uniform_money = $this->Template->load_textbox(array("name"=>"data[price]","id"=>"price","value"=>"$price","style"=>"width:300px"));	
	$str_form_uniform .= $this->Template->load_form_row(array("title"=>"Giá tiền ","input"=>$str_input_uniform_money));
	
	
	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"submit"),"Lưu");
	$str_form_uniform .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	//đưa vào form
	$str_form_uniform = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/uniform/index?debug=code"),$str_form_uniform);
	echo $str_form_uniform; 																																											
	
	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

	$function_title = "Danh Sách Đồng Phục";
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************


	//1: tao mang table header 	
	$array_header_uniform =  array("Stt"=>array("Stt",array("style"=>"text-align:left; width:3%")),
								"ten"=>array("Tên đồng phục ",array("style"=>"text-align:left; width:8%")),
								"soluong"=>array("Số lượng",array("style"=>"text-align:center; width:8%;white-space: nowrap")),						
								"gia"=>array("Giá tiền",array("style"=>"text-align:left; width:8%")),
								"chucnang"=>array("Chức năng",array("style"=>"text-align:left; width:8%")),
							);

	//2: lấy dòng tr header
	$str_header_uniform = $this->Template->load_table_header($array_header_uniform);


	//lấu dòng tr nội dung
	$str_row_uniform = "";
	$stt = 0;
	foreach($array_uniform as $uniform)
	{	
		
		$stt++;
		$id_uniform = $uniform['id'];
		$link_sua="/uniform/$id_uniform.html";
		$link_xoa="/uniform/del/$id_uniform.html";
		$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
		$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
		$link_action = $link_xoa . $link_sua;

		$array_row_uniform =  array("Stt"=>array($stt,array("style"=>"text-align:left; width:3%")),
									"ten"=>array($uniform["name"],array("style"=>"text-align:left; width:10%")),
									"soluong"=>array($uniform["quantity"],array("style"=>"text-align:center; width:8%;white-space: nowrap")),
									"gia"=>array($uniform["price"],array("style"=>"text-align:left; width:8%")),
									"chucnang"=>array($link_action,array("style"=>"text-align:center; width:8%")),
		
									);
		$str_row_uniform .= $this->Template->load_table_row($array_row_uniform);
	}


	//Đưa nội dung str_allowance vào thẻ table
	$str_uniform =  $this->Template->load_table($str_header_uniform.$str_row_uniform);
	echo $str_uniform;				
?>
