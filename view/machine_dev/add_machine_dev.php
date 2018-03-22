<?php 																																																			
	//tạo tiêu đề hàm
	$function_title = "Nhập Máy";
	echo $this->Template->load_function_header($function_title);
	
	//tạo mảng chứa các phần tử tình trạng
	$array_status = array(""=>"...","0"=>"Chưa bảo trì", "1"=>"Đã bảo trì");

	
	//Begin: Form để nhập thông tin máy
	$str_form_machine = "";
	
	$id = "";
	$code = "";
	$name = "";
	$type = "";
	$status = "";
	$id_manufactory = "";
	$parameter = "";
	$day_near = "";
	$day_next = "";
	$control = "";
	$origin = "";
	$day_use = "";
	$place_use = "";
	$asset = "";
	
	
	if($array_edit_machine != null)
	{
		$id = $array_edit_machine["0"]["id"];
		$code = $array_edit_machine["0"]["code"];
		$name = $array_edit_machine["0"]["name"];
		$type = $array_edit_machine["0"]["type"];
		$status = $array_edit_machine["0"]["status"];
		$id_manufactory = $array_edit_machine["0"]["id_manufactory"];
		$parameter = $array_edit_machine["0"]["parameter"];
		$day_near = $array_edit_machine["0"]["day_near"];
		$day_next = $array_edit_machine["0"]["day_next"];
		$control = $array_edit_machine["0"]["control"];
		$origin = $array_edit_machine["0"]["origin"];
		$day_use = $array_edit_machine["0"]["day_use"];
		$place_use = $array_edit_machine["0"]["place_use"];
		$asset = $array_edit_machine["0"]["asset"];
	}
	
	//Begin: Input để nhập 
	$str_input_hidden_id = $this->Template->load_hidden(array("name"=>"data[id]","id"=>"id","value"=>$id,"style"=>"width:200px"));
		
	$str_selectbox_machine_type = $this->Template->load_selectbox(array("name"=>"data[type]","id"=>"type","value"=>"","style"=>"width:200px"),$type);	
		
	$str_input_machine_name = $this->Template->load_textbox(array("name"=>"data[name]","id"=>"name","value"=>$name,"style"=>"width:200px"));
	
	$str_input_machine_code = $this->Template->load_textbox(array("name"=>"data[code]","id"=>"code","value"=>$code,"style"=>"width:200px"));
	
	$str_selectbox_status = $this->Template->load_selectbox_basic(array("name" => "data[status]", "style" => "width:200px"), $array_status, $status);
	
	$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "data[id_manufactory]", "style" => "width:200px"), $array_manufactory, $id_manufactory);	
	
	$str_input_machine_parameter = $this->Template->load_textbox(array("name"=>"data[parameter]","id"=>"parameter","value"=>$parameter,"style"=>"width:200px"));
	
	$str_input_machine_day_near = $this->Template->load_textbox(array("name"=>"data[day_near]","id"=>"day_near","value"=>$day_near,"style"=>"width:200px"));
	
	$str_input_machine_day_next = $this->Template->load_textbox(array("name"=>"data[day_next]","id"=>"day_next","value"=>$day_next,"style"=>"width:200px"));
	
	$str_input_machine_control = $this->Template->load_textbox(array("name"=>"data[control]","id"=>"control","value"=>$control,"style"=>"width:200px"));
	
	$str_input_machine_origin = $this->Template->load_textbox(array("name"=>"data[origin]","id"=>"origin","value"=>$origin,"style"=>"width:200px"));
	
	$str_input_machine_day_use = $this->Template->load_textbox(array("name"=>"data[day_use]","id"=>"day_use","value"=>$day_use,"style"=>"width:200px"));
	
	$str_input_machine_place_use = $this->Template->load_textbox(array("name"=>"data[place_use]","id"=>"place_use","value"=>$place_use,"style"=>"width:200px"));

	$str_input_machine_asset = $this->Template->load_textbox(array("name"=>"data[asset]","id"=>"asset","value"=>$asset,"style"=>"width:200px"));

	//End: input để nhập
	
	//Begin: Tạo các dòng form_row
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Loại máy","input"=>$str_selectbox_machine_type));
	
	$str_form_machine .= $this->Template->load_form_row(array("title" => "Mã số kiểm soát", "input" => $str_input_machine_control));
		
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Tên máy ","input"=>$str_input_machine_name.$str_input_hidden_id));
		
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Mã máy","input"=>$str_input_machine_code));
	
	$str_form_machine .= $this->Template->load_form_row(array("title" => "Trạng thái", "input" => $str_selectbox_status));
	
	$str_form_machine .= $this->Template->load_form_row(array("title" => "Xưởng", "input" => $str_selectbox_manufactory));
	
	$str_form_machine .= $this->Template->load_form_row(array("title" => "Các thông số", "input" => $str_input_machine_parameter));
	
	$str_form_machine .= $this->Template->load_form_row(array("title" => "Ngày bảo trì gần nhất", "input" => $str_input_machine_day_near));
	
	$str_form_machine .= $this->Template->load_form_row(array("title" => "Ngày bảo trì kế tiếp", "input" => $str_input_machine_day_next));
	
	$str_form_machine .= $this->Template->load_form_row(array("title" => "Xuất xứ(Nhà SX)", "input" => $str_input_machine_origin));
	
	$str_form_machine .= $this->Template->load_form_row(array("title" => "Ngày đưa vào sử dụng", "input" => $str_input_machine_day_use));
	
	$str_form_machine .= $this->Template->load_form_row(array("title" => "Nơi sử dụng", "input" => $str_input_machine_place_use));
	
	$str_form_machine .= $this->Template->load_form_row(array("title" => "Tài sản của", "input" => $str_input_machine_asset));
	
	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"submit"),"Lưu");
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	//đưa vào form
	$str_form_machine = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/machine/add?debug=code"),$str_form_machine);
	echo $str_form_machine; 																																											
	
?>

<script>
	$( "#day_near" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#day_next" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#day_use" ).datepicker({dateFormat: "dd-mm-yy"});
</script>
