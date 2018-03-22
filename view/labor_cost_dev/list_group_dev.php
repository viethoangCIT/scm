<?php
	$str_title = "DANNH SÁCH TỔ - NHÓM";
	echo $this->Template->load_function_header($str_title);

	//print_r($array_labor_cost);//


	$row_group = NULL;	
	$row_group["col1"]	= array("STT",array("align"=>"center","style"=>"width: 50px"));
	$row_group["col2"] = array("Tên nhóm",array("align"=>"center","style"=>"width: 100px"));
	$row_group["col3"] = array("Mã nhóm",array("align"=>"center","style"=>"width: 100px"));			
	$row_group["col4"] = array("Mô tả",array("align"=>"center","style"=>"width: 100px"));
	$row_group["col5"] = array("Ngày tạo",array("align"=>"center","style"=>"width: 100px"));
	$row_group["col6"] = array("Ngày chỉnh sửa",array("align"=>"center","style"=>"width: 100px"));
	$row_group["col7"] = array("Sửa",array("align"=>"center","style"=>"width: 100px"));
	$row_group["col8"] = array("Xóa",array("align"=>"center","style"=>"width: 100px"));
		
	// dung ham load_table_header de lay chuoi <tr><td></td><td></td>...</tr>
	$str_group = $this->Template->load_table_header($row_group);
	// $str_header_labor_cost =  "<tr><td>STT</td><td>Year</td><td>Price</td><td>Edit</td><td>Delete</td></tr>";

	$stt = 0;
	// goi ham gt_flash cua doi tuong Session cua key msg gan cho bien $msg
	$msg = $this->Session->get_flash("msg");
	if ($msg=="del_ok") echo $this->Template->load_label("Xóa thành công","","success");
	

	if ($array_group != null)
	{
		foreach($array_group as $index => $group)
		{
			$id = $group["id"];
			$name = $group["name"];
			$code = $group["code"];
			$des = $group["des"];
			$created = $group["created"];
			$modified = $group["modified"];
			$link_edit = "<a href='/group/add?id=$id'>Edit</a>";
			$link_delete = "<a href='/group/del?id=$id'>Delete</a>";

			$stt++;
			$row_labor_cost = NULL;	
			$row_group["col1"]	= array($stt,array("align"=>"center"));
			$row_group["col2"] = array($name,array("align"=>"center"));
			$row_group["col3"] = array($code,array("align"=>"center"));	
			$row_group["col4"] = array($des,array("align"=>"center"));
			$row_group["col5"] = array($created,array("align"=>"center"));
			$row_group["col6"] = array($modified,array("align"=>"center"));
			$row_group["col7"] = array($link_edit,array("align"=>"center"));
			$row_group["col8"] = array($link_delete,array("align"=>"center"));

			// dung ham load_table_row de lay chuoi <tr><td></td><td></td>...</tr>
			$str_group .= $this->Template->load_table_row($row_group);
	    	// $str_labor_cost = "<tr><td>$index</td><td>$year</td><td>$price</td><td>$link_edit</td><td>$link_delete</td></tr>";

		} // end : foreach($array_labor_cost as $index => $labor_cost)
	} // end: if ($array_labor_cost != null)
	else 
	{
		$str_group = NULL;	
		$str_group["col1"]	= array("Không có dữ liệu",array("align"=>"center","colspan"=>"6"));
		$str_group .= $this->Template->load_table_row($row_group);
		//$str_labor_cost .= "<tr><td colspan='6' align='center'>Không có dữ liệu</td></tr>";
	}

	// $str_table_labor_cost = "<table>$str_labor_cost</table>" 
	$str_table_group = $this->Template->load_table($str_group);
	echo $str_table_labor_cost;
?>