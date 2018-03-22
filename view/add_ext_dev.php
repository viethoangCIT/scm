<?php

	//tạo tiêu đề hàm
	$function_title = "Nhập các khoảng ngoài";
	echo $this->Template->load_function_header($function_title);
	
	
	//tạo textbox nhập tên nv
	$str_input_ext_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>$name,"style"=>"width:300px"));	
	
	//tạo dòng nhập tên nv
	$str_form_ext = "";
	$str_form_ext .= $this->Template->load_form_row(array("title"=>"Họ và tên  ","input"=>$str_input_ext_name));
	
		
	//tạo textbox mã số
	$str_input_ext_code = $this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>"","style"=>"width:300px"));	
	$str_form_ext .= $this->Template->load_form_row(array("title"=>"Mã số ","input"=>$str_input_ext_code));

	//tạo textbox nhập lương ốm
	$str_input_ext_measure = $this->Template->load_textbox(array("name"=>"data[measure]","id"=>"measure","value"=>"","style"=>"width:300px"));	
	$str_form_ext .= $this->Template->load_form_row(array("title"=>"Lương ốm đau","input"=>$str_input_ext_measure));
	
	
	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	$str_form_ext .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	//đưa vào form
	$str_form_ext = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"?debug=code"),$str_form_ext);
	echo $str_form_ext; 
?>