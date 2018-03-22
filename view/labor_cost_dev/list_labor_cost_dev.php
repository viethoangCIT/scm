<?php
	$str_title = "DANH SÁCH GIÁ NHÂN CÔNG";
	echo $this->Template->load_function_header($str_title);

	//print_r($array_labor_cost);//


	$row_labor_cost = NULL;	
	$row_labor_cost["col1"]	= array("Stt",array("align"=>"center","style"=>"width: 50px"));
	$row_labor_cost["col2"] = array("Năm",array("align"=>"center","style"=>"width: 100px"));
	$row_labor_cost["col3"] = array("Giá",array("align"=>"center","style"=>"width: 100px"));			
	$row_labor_cost["col4"] = array("Đơn vị",array("align"=>"center","style"=>"width: 100px"));
	$row_labor_cost["col5"] = array("Sửa",array("align"=>"center","style"=>"width: 100px"));
	$row_labor_cost["col6"] = array("Xóa",array("align"=>"center","style"=>"width: 100px"));
		
	// dung ham load_table_header de lay chuoi <tr><td></td><td></td>...</tr>
	$str_labor_cost = $this->Template->load_table_header($row_labor_cost);
	// $str_header_labor_cost =  "<tr><td>STT</td><td>Year</td><td>Price</td><td>Edit</td><td>Delete</td></tr>";

	$stt = 0;

	// goi ham gt_flash cua doi tuong Session cua key msg gan cho bien $msg
	$msg = $this->Session->get_flash("msg");
	if ($msg=="delete_ok") echo $this->Template->load_label("Xóa thành công","","success");
	

	if ($array_labor_cost != null)
	{
		foreach($array_labor_cost as $index => $labor_cost)
		{
			$id = $labor_cost["id"];
			$year = $labor_cost["year"];
			$price = $labor_cost["price"];
			$unit = $labor_cost["unit"];
			$link_edit = "<a href='/labor_cost/add?id=$id' >Edit</a>";
			$link_delete = "<a href='/labor_cost/del?id=$id'>Delete</a>";

			$stt++;
			$row_labor_cost = NULL;	
			$row_labor_cost["col1"]	= array($stt,array("align"=>"center"));
			$row_labor_cost["col2"] = array($year,array("align"=>"center"));
			$row_labor_cost["col3"] = array($price,array("align"=>"center"));			
			$row_labor_cost["col4"] = array($unit,array("align"=>"center"));
			$row_labor_cost["col5"] = array($link_edit,array("align"=>"center"));
			$row_labor_cost["col6"] = array($link_delete,array("align"=>"center"));

			// dung ham load_table_row de lay chuoi <tr><td></td><td></td>...</tr>
			$str_labor_cost .= $this->Template->load_table_row($row_labor_cost);
	    	// $str_labor_cost = "<tr><td>$index</td><td>$year</td><td>$price</td><td>$link_edit</td><td>$link_delete</td></tr>";

		} // end : foreach($array_labor_cost as $index => $labor_cost)
	} // end: if ($array_labor_cost != null)
	else 
	{
		$row_labor_cost = NULL;	
		$row_labor_cost["col1"]	= array("Không có dữ liệu",array("align"=>"center","colspan"=>"6"));
		$str_labor_cost .= $this->Template->load_table_row($row_labor_cost);
		//$str_labor_cost .= "<tr><td colspan='6' align='center'>Không có dữ liệu</td></tr>";
	}

	// $str_table_labor_cost = "<table>$str_labor_cost</table>" 
	$str_table_labor_cost = $this->Template->load_table($str_labor_cost);
	echo $str_table_labor_cost;
?>