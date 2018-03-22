<?php
	$id = "";
	$name = "";
	$code = "";
	$des = "";
	$value_btn = "Thêm mới";
	$title_header = "THÊM MỚI NHÓM";

	if ($array_group != null)
	{
		$id = $array_group[0]["id"];
		$name = $array_group[0]["name"];
		$code = $array_group[0]["code"];
		$des = $array_group[0]["des"];
		$value_btn = "Cập nhật";
		$title_header = "Cập Nhật Thông Tin Nhóm";
	}
	
	echo $this->Template->load_function_header($title_header);

	// tạo thẻ input
	$input_name = $this->Template->load_textbox(array("name"=>"data[name]","value"=>$name));
	$input_code = $this->Template->load_textbox(array("name"=>"data[code]","value"=>$code));
	$input_des = $this->Template->load_textbox(array("name"=>"data[des]", "value"=>$des));
	$input_id = $this->Template->load_hidden(array("name"=>"data[id]","value"=>$id));
	$button = $this->Template->load_button(array("type"=>"submit"),$value_btn);

	// tạo row 
	$str_form_content = "";
	$str_form_content .= $this->Template->load_form_row(array("title"=>"Tên nhóm", "input"=>$input_name));
	$str_form_content .= $this->Template->load_form_row(array("title"=>"Mã nhóm", "input"=>$input_code));
	$str_form_content .= $this->Template->load_form_row(array("title"=>"Mô tả", "input"=>$input_des));
	$str_form_content .= $this->Template->load_form_row(array("title"=>"","input"=>$button));
	$str_form_content .= $input_id;

	// tạo thẻ <form> $str_form_content </form>
	$str_form = $this->Template->load_form(array("method"=>"POST","action"=>"/group/add"),$str_form_content);
	echo $str_form;

?>