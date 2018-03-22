
<?php

	//BEGIN: FUNCTION HEADER

	$function_title = "Gán Máy Sản Xuất";
	echo $this->Template->load_function_header($function_title);
	
	//BEGIN: Lấy thông tin để sửa
	$id = "";
	$id_machine = "";
	$cavity = "";
	$cycletime = "";
	if($array_edit)
	{
		$id = $array_edit[0]["id"];
		$id_machine = $array_edit[0]["id_machine"];
		$cavity = $array_edit[0]["cavity"];
		$cycletime = $array_edit[0]["cycletime"];
		
	}
	//END: Lấy thông tin để sửa

	
	//BEGIN: LOAD INPUT
	
	$str_form_row = $this->Template->load_form_row(array("title"=>"Sản Phẩm","input"=>$product_name));
	$str_hidden_id = $this->Template->load_hidden(array("name"=>"data[id]","value"=>$id,"style"=>"width:300px;"));
	$str_selectbox_machine = $this->Template->load_selectbox(array("name"=>"data[id_machine]","style"=>"width:300px;"),$array_machine,$id_machine);
	$str_input_cavity = $this->Template->load_textbox(array("name"=>"data[cavity]","value"=>$cavity,"style"=>"width:300px;"));
	$str_input_cycletime = $this->Template->load_textbox(array("name"=>"data[cycletime]","value"=>$cycletime,"style"=>"width:300px;"));
	$str_save_button =  $this->Template->load_button(array("type"=>"submit"),"Lưu");
	//END: LOAD INPUT
	
	//BEGIN: LOAD ROW
	$str_form_row .= $this->Template->load_form_row(array("title"=>"Máy sản xuất","input"=>$str_selectbox_machine));
	$str_form_row .= $this->Template->load_form_row(array("title"=>"Cavity","input"=>$str_input_cavity));
	$str_form_row .= $this->Template->load_form_row(array("title"=>"Cycletime","input"=>$str_input_cycletime));
	$str_form_row .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	//END: LOAD ROW

	//BEGIN: LOAD FORM
	$str_form_post = $this->Template->load_form(array("method"=>"POST","action"=>"/product2/product_machine/$id_product"),$str_form_row.$str_hidden_id);
	echo $str_form_post;
	//END: LOAD FORM


	$function_title = "Danh Sách Máy Sản Xuất";
	echo $this->Template->load_function_header($function_title);

	$str_product_header = "";
	//BEGIN: LOAD HEADER 	
	$array_header_product =  null;
	$array_header_product["col1"]=array("STT",array("style"=>"text-align:left; width:3%"));
	$array_header_product["col2"]=array("Tên sản phẩm ",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col3"]=array("Mã sản phẩm",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col4"]=array("Máy",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col5"]=array("Cavity",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col6"]=array("Cycletime",array("style"=>"text-align:left; width:8%"));
	$array_header_product["col7"]=array("Chức năng",array("style"=>"text-align:left; width:8%"));
	
	$str_product_header = $this->Template->load_table_header($array_header_product);
	
	//END: LOAD HEADER

	//BEGIN: LOAD ROW
	$stt=0;
	$str_product_row = "";
	if($array_product_machine){
		foreach ($array_product_machine as $product_machine) {
			$stt++;
			$id_product_machine = $product_machine['id'];
			$link_sua="/product2/product_machine/$id_product/$id_product_machine.html?act=edit";
			$link_xoa="/product2/product_machine/$id_product/$id_product_machine.html?act=del";
			$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
			$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
			$link_action = $link_sua . $link_xoa;

		//BEGIN: LOAD thông tin bảng product_machine
		$product_name = $product_machine["product_name"];
		$product_code = $product_machine["product_code"];
		$machine = $product_machine["machine_name"];
		$cavity = $product_machine["cavity"];
		$cycletime = $product_machine["cycletime"];
		//END:LOAD thông tin bảng product_machine
		
		$array_product_rate =  null;
		$array_product_rate["col1"]=array($stt,array("style"=>"text-align:left; width:3%"));
		$array_product_rate["col2"]=array($product_name,array("style"=>"text-align:left; width:8%"));
		$array_product_rate["col3"]=array($product_code,array("style"=>"text-align:left; width:8%"));
		$array_product_rate["col4"]=array($machine,array("style"=>"text-align:left; width:8%"));
		$array_product_rate["col5"]=array($cavity,array("style"=>"text-align:left; width:8%"));
		$array_product_rate["col6"]=array($cycletime,array("style"=>"text-align:left; width:8%"));
		$array_product_rate["col7"]=array($link_action,array("style"=>"text-align:left; width:8%"));
		$str_product_row .= $this->Template->load_table_row($array_product_rate);

		}//END: foreach ($array_product_rate as $product ) {
	}//END: if($array_product_rate){
	else
	{	
		$array_product_rate =  null;
		$array_product_rate["col1"]=array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"11"));
		$str_product_row .= $this->Template->load_table_row($array_product_rate);
	}
	//END: LOAD ROW
	
	$str_product =  $this->Template->load_table($str_product_header.$str_product_row);
	echo $str_product;			

?>