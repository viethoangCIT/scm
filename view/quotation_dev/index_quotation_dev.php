<?php
	//tạo tiêu đề hàm
	$function_title = "Danh Sách Báo Giá";
	echo $this->Template->load_function_header($function_title);
	
	//1: tao mang table header 	
	$array_header_quotation["col1"] =  array("STT",array("style"=>"text-align:center; width:3%"));
	$array_header_quotation["col2"] = array("Khách hàng",array("style"=>"text-align:center; width:8%"));
	$array_header_quotation["col3"] = array("Nhà cung ứng",array("style"=>"text-align:center; width:8%;"));
	$array_header_quotation["col4"] = array("Số bản vẽ",array("style"=>"text-align:center; width:8%"));
	$array_header_quotation["col5"] = array("Tên linh kiện",array("style"=>"text-align:center; width:8%"));
	$array_header_quotation["col6"] = array("Máy sử dụng",array("style"=>"text-align:center; width:8%"));
	$array_header_quotation["col7"] = array("Chi phí máy",array("style"=>"text-align:center; width:8%"));
	$array_header_quotation["col8"] = array("Số lượng sử dụng(MOD)",array("style"=>"text-align:center; width:8%"));
	$array_header_quotation["col9"] = array("Số CAV",array("style"=>"text-align:center; width:8%"));
	$array_header_quotation["col10"] = array("Nguyên vật liệu",array("style"=>"text-align:center; width:8%;"));
	$array_header_quotation["col11"] = array("Cycle time",array("style"=>"text-align:center; width:8%"));
	$array_header_quotation["col12"] = array("Sửa",array("style"=>"text-align:center; width:8%"));
	$array_header_quotation["col13"] = array("Xóa",array("style"=>"text-align:center; width:8%"));
	
	//2: lấy dòng tr header
	$str_header_quotation = $this->Template->load_table_header($array_header_quotation);
	
	
	$str_row_quotation = "";
	for($i=1; $i<=10; $i++)
	{
		$link_sua = $this->Template->load_link("edit", "Sửa");
		$link_xoa = $this->Template->load_link("del", "Xóa");
		//1: tao mang table row 	
		$array_row_quotation["col1"] =  array($i,array("style"=>"text-align:center; width:3%"));
		$array_row_quotation["col2"] = array("Sunluxe $i",array("style"=>"text-align:center; width:8%"));
		$array_row_quotation["col3"] = array("SCM $i",array("style"=>"text-align:center; width:8%;"));
		$array_row_quotation["col4"] = array("$i",array("style"=>"text-align:center; width:8%"));
		$array_row_quotation["col5"] = array("Linh kiện $i",array("style"=>"text-align:center; width:8%"));
		$array_row_quotation["col6"] = array("Máy $i",array("style"=>"text-align:center; width:8%"));
		$array_row_quotation["col7"] = array("5000",array("style"=>"text-align:center; width:8%"));
		$array_row_quotation["col8"] = array("$i",array("style"=>"text-align:center; width:8%"));
		$array_row_quotation["col9"] = array("$i",array("style"=>"text-align:center; width:8%"));
		$array_row_quotation["col10"] = array("Nguyên liệu $i",array("style"=>"text-align:center; width:8%;"));
		$array_row_quotation["col11"] = array("$i",array("style"=>"text-align:center; width:8%"));
		$array_row_quotation["col12"] = array($link_sua,array("style"=>"text-align:center; width:8%"));
		$array_row_quotation["col13"] = array($link_xoa,array("style"=>"text-align:center; width:8%"));
		
		$str_row_quotation .= $this->Template->load_table_row($array_row_quotation);
	}

		
	//Đưa nội dung str_allowance vào thẻ table
	$str_quotation =  $this->Template->load_table($str_header_quotation . $str_row_quotation);
	echo $str_quotation;				

?>