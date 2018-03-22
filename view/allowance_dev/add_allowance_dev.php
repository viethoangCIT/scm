<style type="text/css">
	}
	.title_page{
		color: black;
	}
</style>
<?php

	//tạo tiêu đề hàm
	$function_title = "Nhập danh mục cấp đồng phục";
	echo $this->Template->load_function_header($function_title);
	
	
	//tạo textbox nhập tên tài sản
	$str_input_allowance_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>$name,"style"=>"width:300px"));	
	
	//tạo dòng nhập tên đồng phục
	$str_form_allowance = "";
	$str_form_allowance .= $this->Template->load_form_row(array("title"=>"Tên phụ cấp ","input"=>$str_input_allowance_name));
	
		
	//tạo textbox số lượng
	$str_input_allowance_quantity = $this->Template->load_textbox(array("name"=>"data[quantity]","id"=>"quantity","value"=>"","style"=>"width:300px"));	
	$str_form_allowance .= $this->Template->load_form_row(array("title"=>"Số lượng ","input"=>$str_input_allowance_quantity));

	//tạo textbox nhập giá tiền
	$str_input_allowance_money = $this->Template->load_textbox(array("name"=>"data[money]","id"=>"money","value"=>"","style"=>"width:300px"));	
	$str_form_allowance .= $this->Template->load_form_row(array("title"=>"Giá tiền ","input"=>$str_input_allowance_money));
	
	
	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	$str_form_allowance .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	//đưa vào form
	$str_form_allowance = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"?debug=code"),$str_form_allowance);
	echo $str_form_allowance; 
?>