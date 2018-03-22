<?php 																																																		
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

	$function_title = "Danh Sách Các Máy";
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	//tạo mảng chứa các phần tử tình trạng
	$array_status = array("0"=>array("id"=>'0',"title"=>"Chưa bảo trì"),
						  "1"=>array("id"=>'1',"title"=>"Đã bảo trì"));
	array_unshift($array_status, array("id" => "", "name" => "Chọn trạng thái"));
	
	//load combobox tên máy
	$str_machine_name = $this->Template->load_selectbox(array("name" => "name" ,"id" => "name", "style" => "width:200px"), $array_machine_name, $name);
	
	$str_machine_code = $this->Template->load_selectbox(array("name" => "code" ,"id" => "code", "style" => "width:200px"), $array_machine_code, $code);
	
	$str_machine_status = $this->Template->load_selectbox(array("name" => "status" ,"id" => "name", "style" => "width:200px"), $array_status, $status);
	
	$str_machine_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory" ,"id" => "name", "style" => "width:200px"), $array_machine_manufactory, $id_manufactory);
	
	$str_machine_type = $this->Template->load_selectbox(array("name" => "type" ,"id" => "type", "style" => "width:200px"), $array_machine_type, $type);
	
	$str_save_button = $this->Template->load_button(array("type" => "sutmit"), "Tìm kiếm");
	
	$str_input_row = "$str_machine_name $str_machine_code $str_machine_status $str_machine_manufactory $str_machine_type $str_save_button</div>";
	
	// LOAD FORM
	$str_form_machine = $this->Template->load_form(array("method" => "GET", "id" => "form_nhap", "action" => "/machine/index"),$str_input_row);
	echo $str_form_machine;
	
	
	//1: tao mang table header 	
	$array_header_machine["col1"] =  array("STT",array("style"=>"text-align:center; width:3%"));
	$array_header_machine["col2"] = array("Mã số kiểm soát",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col3"] = array("Tên máy ",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col4"] = array("Mã máy",array("style"=>"text-align:center; width:8%;"));
	$array_header_machine["col5"] = array("Loại máy ",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col6"] = array("Xưởng ",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col7"] = array("Trạng thái",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col8"] = array("Ngày bảo trì gần nhất ",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col9"] = array("Ngày bảo trì kế tiếp ",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col10"] = array("Thông tin máy",array("style"=>"text-align:center; width:8%;"));
	$array_header_machine["col11"] = array("Lịch bảo dưỡng ",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col12"] = array("Sửa",array("style"=>"text-align:center; width:8%"));
	$array_header_machine["col13"] = array("Xóa",array("style"=>"text-align:center; width:8%"));

							

	//2: lấy dòng tr header
	$str_header_machine = $this->Template->load_table_header($array_header_machine);


	//lấu dòng tr nội dung
	
	$str_row_machine = "";
	$stt = 0;
	
	if($array_machine)
	{
		foreach ($array_machine as $machine ) {
			$status = "Đã bảo trì";
			if($machine["status"]=="0")
			{
				$status = "Chưa bảo trì";
			}
			$stt++;
			$id_machine = $machine['id'];
			
			$link_chitiet="/machine/info/$id_machine.html";
			$link_baoduong="/machine/maintenance/$id_machine.html";
			$link_sua="/machine/add/$id_machine.html";
			$link_xoa="/machine/del/$id_machine.html";
			
			$link_chitiet  = $this->Template->load_link("edit","Chi tiết",$link_chitiet);
			$link_baoduong  = $this->Template->load_link("edit","Bảo dưỡng",$link_baoduong);
			$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
			$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
	
			$array_row_machine["col1"] =  array($stt,array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col2"] =  array($machine["control"],array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col3"] =  array($machine["name"],array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col4"] =  array($machine["code"],array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col5"] =  array($machine["type"],array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col6"] =  array($machine["manufactory"],array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col7"] =  array($status,array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col8"] =  array($machine["day_near"],array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col9"] =  array($machine["day_next"],array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col10"] =  array($link_chitiet,array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col11"] =  array($link_baoduong,array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col12"] =  array($link_sua,array("style"=>"text-align:center; width:3%"));
			$array_row_machine["col13"] =  array($link_xoa,array("style"=>"text-align:center; width:3%"));
			
			
			$str_row_machine .= $this->Template->load_table_row($array_row_machine);
		}//End: foreach ($array_machine as $machine )
	}//End: if($array_machine)
	
	//Đưa nội dung str_allowance vào thẻ table
	$str_machine =  $this->Template->load_table($str_header_machine . $str_row_machine);
	echo $str_machine;				
?>
