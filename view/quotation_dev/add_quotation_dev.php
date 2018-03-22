<?php
	//tạo tiêu đề hàm
	$function_title = "Nhập Báo Giá";
	echo $this->Template->load_function_header($function_title);
	
	//Begin: input để nhập
	$str_selectbox_customer = $this->Template->load_selectbox(array("name"=>"data[id_customer]","id"=>"customer","style"=>"width:200px"), $array_customer);	
	$str_selectbox_supplier = $this->Template->load_selectbox(array("name"=>"data[id_supplier]","id"=>"supplier","style"=>"width:200px"), $array_supplier);
	$str_textbox_num_drawing  = $this->Template->load_textbox(array("name"=>"data[drawing]","id"=>"drawing","style"=>"width:200px"));
	$str_textbox_component  = $this->Template->load_textbox(array("name"=>"data[component]","id"=>"component","style"=>"width:200px"));
	$str_selectbox_machine  = $this->Template->load_selectbox(array("name"=>"data[id_machine]","id"=>"machine","style"=>"width:200px"), $array_machine);
	$str_textbox_machine_cost  = $this->Template->load_textbox(array("name"=>"data[machine_cost]","id"=>"machine_cost","style"=>"width:200px"));
	$str_textbox_amount_used  = $this->Template->load_textbox(array("name"=>"data[amount_used]","id"=>"amount_used","style"=>"width:200px"));
	$str_textbox_num_cav  = $this->Template->load_textbox(array("name"=>"data[num_cav]","id"=>"num_cav","style"=>"width:200px"));
	$str_selectbox_material  = $this->Template->load_selectbox(array("name"=>"data[material]","id"=>"material","style"=>"width:200px"), $array_material);
	$str_textbox_cycle_time  = $this->Template->load_textbox(array("name"=>"data[cycle_time]","id"=>"cycle_time","style"=>"width:200px"));
	//End: input để nhập
	
	//Begin: tạo các dòng form row
	$str_form_quotation = $this->Template->load_form_row(array("title"=>"Khách hàng","input"=>$str_selectbox_customer));
	$str_form_quotation .= $this->Template->load_form_row(array("title"=>"Nhà cung ứng","input"=>$str_selectbox_supplier));
	$str_form_quotation .= $this->Template->load_form_row(array("title"=>"Số bản vẽ","input"=>$str_textbox_num_drawing));
	$str_form_quotation .= $this->Template->load_form_row(array("title"=>"Tên linh kiện","input"=>$str_textbox_component));
	$str_form_quotation .= $this->Template->load_form_row(array("title"=>"Máy sử dụng","input"=>$str_selectbox_machine));		
	$str_form_quotation .= $this->Template->load_form_row(array("title"=>"Chi phí máy","input"=>$str_textbox_machine_cost));	
	$str_form_quotation .= $this->Template->load_form_row(array("title"=>"Số lượng sử dụng hàng tháng(MOD)","input"=>$str_textbox_amount_used));
	$str_form_quotation .= $this->Template->load_form_row(array("title"=>"Số CAV","input"=>$str_textbox_num_cav));
	$str_form_quotation .= $this->Template->load_form_row(array("title"=>"Nguyên vật liệu","input"=>$str_selectbox_material));
	$str_form_quotation .= $this->Template->load_form_row(array("title"=>"Cycle time","input"=>$str_textbox_cycle_time));
	
	//End: tạo các dòng form row
	
	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"submit"),"Lưu");
	$str_form_quotation .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	
	//đưa vào form
	$str_form_quotation = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/quotation/add?debug=code"),$str_form_quotation);
	echo $str_form_quotation; 																																											
	
	
?>