<?php
	//tên tiêu đề
	$function_title = "Thông tin máy";
	echo $this->Template->load_function_header($function_title);

	$str_form_machine = "";
	
	$str_machine_name = "";
	$str_machine_code = "";
	$str_machine_control = "";
	$str_machine_origin = "";
	$str_machine_status = "";
	$str_machine_day_use = "";
	$str_machine_place_use = "";
	$str_machine_asset = "";
	
	if($array_machine!=NULL)
	{
		$str_machine_status = "Đã bảo trì";
		if($array_machine[0]["status"]=="0")
		{
			$str_machine_status = "Chưa bảo trì";
		}
		
		$str_machine_name = $array_machine[0]["name"];
		$str_machine_code = $array_machine[0]["code"];
		$str_machine_control = $array_machine[0]["control"];
		$str_machine_origin = $array_machine[0]["origin"];
		$str_machine_day_use = $array_machine[0]["day_use"];
		$str_machine_place_use = $array_machine[0]["place_use"];
		$str_machine_asset = $array_machine[0]["asset"];
	}
	
	
	$str_form_machine = $this->Template->load_form_row(array("title"=>"Tên máy ","input"=>$str_machine_name));
	
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Mã máy ","input"=>$str_machine_code));	
	
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Mã kiểm soát","input"=>$str_machine_control));
	
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Xuất xứ (Nhà SX)","input"=>$str_machine_origin));
	
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Tình trạng máy","input"=>$str_machine_status));

	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Ngày đưa vào sử dụng","input"=>$str_machine_day_use));

	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Nơi sử dụng","input"=>$str_machine_place_use));

	$str_form_machine .= $this->Template->load_form_row(array("title"=>"Tài sản của","input"=>$str_machine_asset));
	
	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"submit","style"=>"width:50px;"),"In");
	$str_form_machine .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	//đưa vào form
	$str_form_machine = $this->Template->load_form(array("method" => "", "id" => "info_machine"),$str_form_machine);
	echo $str_form_machine;
	
	
	//tên tiêu đề
	$title = "Lịch Sử Bảo Trì";
	echo $this->Template->load_function_header($title);
	
	
	//load textbox 
	$str_machine_history_day = $this->Template->load_textbox(array("name" => "day" ,"id" => "day", "value"=>$day, "style" => "width:200px"));
	
	$str_machine_history_day_end = $this->Template->load_textbox(array("name" => "day_end" ,"id" => "day_end", "value"=>$day_end, "style" => "width:200px"));
	
	$str_hidden_id = $this->Template->load_hidden(array("name"=>"id", "value"=>$id));
	//nút tìm kiếm
	$str_save_button = $this->Template->load_button(array("type" => "sutmit"), "Tìm kiếm");
	
	$str_input_row = "Từ ngày: $str_machine_history_day Đến ngày: $str_machine_history_day_end $str_save_button</div>";
	
	// LOAD FORM
	$str_form_machine = $this->Template->load_form(array("method" => "GET", "id" => "form_nhap", "action" => "/machine/info"),$str_input_row . $str_hidden_id);
	echo $str_form_machine;
	
	//1: tao mang table header 	
	$array_header_machine["col1"] =  array("STT",array("style"=>"text-align:center; width:3%"));
	$array_header_machine["col2"] = array("Nội dung thay đổi",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col3"] = array("Vật tư thay thế",array("style"=>"text-align:center; width:8%;"));
	$array_header_machine["col4"] = array("Mã vật tư",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col5"] = array("Nội dung bảo trì",array("style"=>"text-align:center; width:15%"));
	$array_header_machine["col6"] = array("Loại bảo trì",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col7"] = array("Ngày thực hiện",array("style"=>"text-align:center; width:15%"));
	$array_header_machine["col8"] = array("Ngày kết thúc",array("style"=>"text-align:center; width:15%"));
	$array_header_machine["col9"] = array("Người thực hiện",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col10"] = array("Lưu",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col11"] = array("Sửa",array("style"=>"text-align:center; width:8%;"));
	$array_header_machine["col12"] = array("Xóa",array("style"=>"text-align:center; width:8%"));
							

	//2: lấy dòng tr header
	$str_header_machine = $this->Template->load_table_header($array_header_machine);
	
	$id_history = "";
	$content = "";
	$supplier = "";
	$code_supplier = "";
	$maintenance_content = "";
	$type = "";
	$day = "";
	$day_end = "";
	$performer = "";
	
	//kiểm tra thông tin sửa
	if($array_edit_history!=NULL)
	{
		$id_history = $array_edit_history[0]["id"];
		$content = $array_edit_history[0]["content"];
		$supplier = $array_edit_history[0]["supplier"];
		$code_supplier = $array_edit_history[0]["code_supplier"];
		$maintenance_content = $array_edit_history[0]["maintenance_content"];
		$type = $array_edit_history[0]["type"];
		$day = $array_edit_history[0]["day"];
		$day_end = $array_edit_history[0]["day_end"];
		$performer = $array_edit_history[0]["performer"];
		
	}
	
	//load hiiden id ẩn
	$str_hidden_id_machine = $this->Template->load_hidden(array("name"=>"data[id_machine]","value"=>$id));
	
	$str_hidden_id_history = $this->Template->load_hidden(array("name"=>"data[id]","value"=>$id_history));
	
	
	//load textbox
	$str_input_machine_content = $this->Template->load_textbox(array("name"=>"data[content]","id"=>"code","value"=>$content,"style"=>"width:100%"));
	
	$str_input_machine_supplier = $this->Template->load_textbox(array("name"=>"data[supplier]","id"=>"code","value"=>$supplier,"style"=>"width:100%"));
	
	$str_input_machine_code_supplier = $this->Template->load_textbox(array("name"=>"data[code_supplier]","id"=>"code","value"=>$code_supplier,"style"=>"width:100%"));
	
	$str_input_machine_maintenance_content = $this->Template->load_textbox(array("name"=>"data[maintenance_content]","id"=>"code","value"=>$maintenance_content,"style"=>"width:100%"));
	
	$str_input_machine_type = $this->Template->load_textbox(array("name"=>"data[type]","id"=>"code","value"=>$type,"style"=>"width:100%"));
	
	$str_input_machine_day = $this->Template->load_textbox(array("name"=>"data[day]","id"=>"day1","value"=>$day,"style"=>"width:100%"));
	
	$str_input_machine_day_end = $this->Template->load_textbox(array("name"=>"data[day_end]","id"=>"day_end1","value"=>$day_end,"style"=>"width:100%"));
	
	$str_input_machine_performer = $this->Template->load_textbox(array("name"=>"data[performer]","id"=>"code","value"=>$performer,"style"=>"width:100%"));
	
	//tạo nút lưu	
	$str_save_button =  $this->Template->load_button(array("type"=>"submit","style"=>"width:50px;"),"Lưu");
	
	$str_hidden = $str_hidden_id_machine . $str_hidden_id_history;
	
	$str_row_machine = "";
	
	//1: tao mảng load row 	
	$array_row_machine["col1"] =  array("",array("style"=>"text-align:center; width:3%"));
	$array_row_machine["col2"] = array($str_input_machine_content,array("style"=>"text-align:center; width:10%"));
	$array_row_machine["col3"] = array($str_input_machine_supplier,array("style"=>"text-align:center; width:10%;"));
	$array_row_machine["col4"] = array($str_input_machine_code_supplier,array("style"=>"text-align:center; width:10%"));
	$array_row_machine["col5"] = array($str_input_machine_maintenance_content,array("style"=>"text-align:center; width:8%"));
	$array_row_machine["col6"] = array($str_input_machine_type,array("style"=>"text-align:center; width:10%"));
	$array_row_machine["col7"] = array($str_input_machine_day,array("style"=>"text-align:center; width:10%"));
	$array_row_machine["col8"] = array($str_input_machine_day_end,array("style"=>"text-align:center; width:10%"));
	$array_row_machine["col9"] = array($str_input_machine_performer,array("style"=>"text-align:center; width:8%"));
	$array_row_machine["col10"] = array($str_save_button . $str_hidden,array("style"=>"text-align:center; width:8%"));
	$array_row_machine["col11"] = array("",array("style"=>"text-align:center; width:8%;"));
	$array_row_machine["col12"] = array("",array("style"=>"text-align:center; width:8%"));
	
	$str_row_machine .= $this->Template->load_table_row($array_row_machine);
	
	$stt = 0;
	if($array_machine_history)
	{
		foreach($array_machine_history as $history)
		{
			$stt++;
			
			$id = $history["id"]; 
			$id_machine = $history["id_machine"];
			$link_sua = "/machine/info/$id_machine/$id.html";
			$link_xoa = "/machine/del_info/$id_machine/$id.html";
			$link_sua = $this->Template->load_link("edit", "Sửa", $link_sua);
			$link_xoa = $this->Template->load_link("del", "Xóa", $link_xoa);
			
			//1: tao mảng load row 	
			$array_row_machine["col1"] =  array($stt,array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col2"] = array($history["content"],array("style"=>"text-align:center; width:16%"));
			$array_row_machine["col3"] = array($history["supplier"],array("style"=>"text-align:center; width:10%;"));
			$array_row_machine["col4"] = array($history["code_supplier"],array("style"=>"text-align:center; width:10%"));
			$array_row_machine["col5"] = array($history["maintenance_content"],array("style"=>"text-align:center; width:8%"));
			$array_row_machine["col6"] = array($history["type"],array("style"=>"text-align:center; width:10%"));
			$array_row_machine["col7"] = array($history["day"],array("style"=>"text-align:center; width:10%"));
			$array_row_machine["col8"] = array($history["day_end"],array("style"=>"text-align:center; width:10%"));
			$array_row_machine["col9"] = array($history["performer"],array("style"=>"text-align:center; width:8%"));
			$array_row_machine["col10"] = array("",array("style"=>"text-align:center; width:8%"));
			$array_row_machine["col11"] = array($link_sua,array("style"=>"text-align:center; width:8%;"));
			$array_row_machine["col12"] = array($link_xoa,array("style"=>"text-align:center; width:8%"));
			
			$str_row_machine .= $this->Template->load_table_row($array_row_machine);
		}	
	}
	
	
	//Đưa nội dung str_allowance vào thẻ table
	$str_machine =  $this->Template->load_table($str_header_machine . $str_row_machine);
	
	// LOAD FORM
	$str_form_machine = $this->Template->load_form(array("method" => "POST", "id" => "form_nhap", "action" => "/machine/info"),$str_machine);
	echo $str_form_machine;

?>

<script>
	$( "#day1" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#day_end1" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#day" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#day_end" ).datepicker({dateFormat: "dd-mm-yy"});
</script>