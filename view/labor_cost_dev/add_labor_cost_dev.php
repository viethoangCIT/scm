<?php
	
	$id = "";
	$year = "";
	$price = "";
	$unit = "";
	$a = "Nhập";
	if ($array_labor_cost != null) {
		$year = $array_labor_cost[0]["year"];
		$price = $array_labor_cost[0]["price"];
		$unit = $array_labor_cost[0]["unit"];
		$id = $array_labor_cost[0]["id"];
		$a = "Cập Nhật";
	}

	// tieu de cua ham
	$function_title = "Nhập chi phí nhân công";
	echo $this->Template->load_function_header($function_title);
	


	$str_form_content = "";

	// tao textbox nam , gia , don vi , id , button save
	$str_input_year = $this->Template->load_textbox(array("name"=>"data[year]","value"=>$year));
	$str_input_price = $this->Template->load_textbox(array("name"=>"data[price]","value"=>$price));
	$str_input_unit = $this->Template->load_textbox(array("name"=>"data[unit]","value"=>$unit));
	$str_hidden_id =  $this->Template->load_hidden(array("name"=>"data[id]","value"=>$id));
	$button =  $this->Template->load_button(array("type"=>"submit"),"$a");
	
	// tao form row, dua vao bien $str_form_content 
	$str_form_content .= $this->Template->load_form_row(array("title"=>"Năm","input"=>$str_input_year));
	$str_form_content .= $this->Template->load_form_row(array("title"=>"Giá","input"=>$str_input_price));
	$str_form_content .= $this->Template->load_form_row(array("title"=>"Đơn vị","input"=>$str_input_unit));
	$str_form_content .= $this->Template->load_form_row(array("title"=>"","input"=>$button));
	$str_form_content .= $str_hidden_id;
	
	// tao the <form>$$str_form_content</form>  
	$str_form = $this->Template->load_form(array("method"=>"POST","action"=>"/labor_cost/add"),$str_form_content);
	
	echo $str_form;
?>