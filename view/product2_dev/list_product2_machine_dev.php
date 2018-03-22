<?php 
	$str_cycletime_header = "";
	//BEGIN: LOAD HEADER 	
	$array_header_cycletime =  null;
	$array_header_cycletime["col1"]=array("STT",array("style"=>"text-align:center; width:3%"));
	$array_header_cycletime["col2"]=array("Máy",array("style"=>"text-align:center; width:8%"));
	$array_header_cycletime["col3"]=array("Số tấn",array("style"=>"text-align:center; width:8%"));
	$array_header_cycletime["col4"]=array("Cycletime",array("style"=>"text-align:center; width:8%"));
	$array_header_cycletime["col5"]=array("Ghi chú",array("style"=>"text-align:center; width:8%"));
	$array_header_cycletime["col6"]=array("Chức năng",array("style"=>"text-align:center; width:8%"));
	
	$str_cycletime_header = $this->Template->load_table_header($array_header_cycletime);
	//END: LOAD HEADER
	
	//BEGIN: LOAD INPUT
	$str_hidden_id = $this->Template->load_hidden(array("name"=>"data2[id]","value"=>""));
	$str_selectbox_cycletime_machine = $this->Template->load_selectbox(array("name"=>"data2[id_machine]","style"=>"width:200px;"));
	$str_input_cycletime = $this->Template->load_textbox(array("name"=>"data2[cycletime]","value"=>"","style"=>"width:100px;"));
	$str_input_cycletime_sotan = $this->Template->load_textbox(array("name"=>"data2[sotan]","value"=>"","style"=>"width:100px;"));
	$str_input_cycletime_desc = $this->Template->load_textbox(array("name"=>"data2[desc]","value"=>"","style"=>"width:150px;"));
	$str_save_button_cycletime =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu_cycle()"),"Lưu");
	//END: LOAD INPUT
	
	//BEGIN: LOAD DONG NHAP
	$str_cycletime_row_input = "";
	$array_cycletime_input =  null;
	$array_cycletime_input["col1"]=array($str_hidden_id);
	$array_cycletime_input["col2"]=array($str_selectbox_cycletime_machine,array("style"=>"text-align:center;"));
	$array_cycletime_input["col3"]=array($str_input_cycletime_sotan,array("style"=>"text-align:center;"));
	$array_cycletime_input["col4"]=array($str_input_cycletime,array("style"=>"text-align:center;"));
	$array_cycletime_input["col5"]=array($str_input_cycletime_desc,array("style"=>"text-align:center;"));
	$array_cycletime_input["col6"]=array($str_save_button_cycletime,array("style"=>"text-align:center;"));
	
	$str_cycletime_row_input .= $this->Template->load_table_row($array_cycletime_input);
	
	//BEGIN: LOAD ROW
	$str_product_machine_row = "";
	if($array_product_machine){
		$stt=0;
		foreach ($array_product_machine as $product_machine) {
			$stt++;
			$id_product_machine = $product_machine['id'];
			$link_sua="";
			$link_xoa="";
			$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
			$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
			$link_action = $link_sua . $link_xoa;

		//BEGIN: LOAD thông tin bảng product_machine
		
		//END:LOAD thông tin bảng product_machine
		
		$array_product_machine_row =  null;
		$array_product_machine_row["col1"]=array($stt,array("style"=>"text-align:center; width:3%"));
		$array_product_machine_row["col2"]=array("",array("style"=>"text-align:center; width:8%"));
		$array_product_machine_row["col3"]=array("",array("style"=>"text-align:center; width:8%"));
		$array_product_machine_row["col4"]=array("",array("style"=>"text-align:center; width:8%"));
		$array_product_machine_row["col5"]=array("",array("style"=>"text-align:center; width:8%"));
		$array_product_machine_row["col6"]=array($link_action,array("style"=>"text-align:center;"));
		$str_product_machine_row .= $this->Template->load_table_row($array_product_machine_row);

		}//END: foreach ($array_product_rate as $product ) {
	}//END: if($array_product_rate){
	else
	{	
		$array_product_machine_row =  null;
		$array_product_machine_row["col1"]=array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"5"));
		$str_product_machine_row .= $this->Template->load_table_row($array_product_machine_row);
	}
	//END: LOAD ROW
	
	$str_table_cycletime =  $this->Template->load_table($str_cycletime_header.$str_cycletime_row_input.$str_product_machine_row);
	$str_form_cycletime = $this->Template->load_form(array("method" => "POST","id"=>"form_nhap_cycle", "action" => "?debug=code"), $str_table_cycletime);
	echo $str_form_cycletime;
?>