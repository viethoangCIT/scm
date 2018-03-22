
<?php
	$title_header = " Xem Kế Hoạch Sản Xuất Theo Tháng";
	echo $this->Template->load_function_header($title_header);

	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_factory = $this->Template->load_selectbox(array("name" => "id_factory", "id"=>"id_factory_search" ,"style" => "width:150px"),$array_factory, $id_factory);
	
	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "id"=>"id_manufactory_search" ,"style" => "width:150px"),$array_manufactory, $id_manufactory);
	
	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_cat_product = $this->Template->load_selectbox(array("name" => "id_cat", "id"=>"id_cat_search" ,"style" => "width:150px"), $array_product_cat, $id_cat);
	
	//Dùng hàm load_textbox của đối tượng Template để textbox
	$str_textbox_day = $this->Template->load_textbox(array("name" => "month" ,"id"=>"month_search","style" => "width:150px", "value"=>$month));
	
	$str_save_button = $this->Template->load_button(array("type" => "sutmit"), "Xem");
	
	$str_input_row = "Chọn nhà máy $str_selectbox_factory Chọn xưởng $str_selectbox_manufactory Dòng sản phẩm $str_selectbox_cat_product Chọn tháng $str_textbox_day $str_save_button";
	
	
	
	//BEGIN: HEADER
	//TẠO MẢNG HEADER
	$array_header_production = NULL;		
	$array_header_production["col1"] = array("STT", array("align"=>"center","style"=>"width: 5px"));
	$array_header_production["col2"] = array("Nhà máy", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col4"] = array("Xưởng", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col5"] = array("Khách hàng", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col6"] = array("Dòng sản phẩm", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col7"] = array("Sản phẩm", array("align"=>"center","style"=>"width: 10px"));
	
	
	$array_header_production["col8"] = array("Tổng số", array("align"=>"center","style"=>"width: 10px"));

	$array_header_production["col17"] = array("Chi tiết", array("align"=>"center","style"=>"width: 10px"));
	

	//LOAD HEADER
	$str_header_production = $this->Template->load_table_header($array_header_production);
	//END: HEADER
	
	$str_row_production = "";
	$stt = 0;
	$tong = 0;
	if($array_delivery)
	{
		foreach($array_delivery as $delivery)
		{
			$stt++;
			$id_product = $delivery["id_product"];
			$id_factory = $delivery["id_factory"];
			$id_manufactory = $delivery["id_manufactory"];
			$id_cat = $delivery["id_cat"];
		

			$link_chitiet = "/production/add_plan_month?id_factory=$id_factory&id_manufactory=$id_manufactory&id_cat=$id_cat&month=$month";
			$link_chitiet = $this->Template->load_link("edit", "Chi tiết", $link_chitiet);
			$array_row_production = NULL;					
			$array_row_production["col1"] = array($stt, array("align"=>"center"));
			$array_row_production["col2"] = array($delivery["factory_name"], array("align"=>"center"));
			$array_row_production["col4"] = array($delivery["manufactory_name"], array("align"=>"center"));
			$array_row_production["col5"] = array($delivery["customer_name"], array("align"=>"center"));
			$array_row_production["col6"] = array($delivery["cat_name"], array("align"=>"center"));
			$array_row_production["col7"] = array($delivery["product_name"], array("align"=>"center"));
			
			$tong += $delivery["total"];
			//Dùng hàm load_textbox của đối tượng Template để texttbox
			//$str_textbox_day = $this->Template->load_textbox(array("name" => "production[day_$i]" ,"style" => "width:100px", "onkeyup"=>"format_number_textbox(this)"));
			
			$array_row_production["col8"] = array(number_format($delivery["total"]), array("align"=>"center","style"=>"width: 20px"));	

			$array_row_production["col17"] = array($link_chitiet, array("align"=>"center","style"=>"width: 20px"));
			//LOAD HEADER
			$str_row_production .= $this->Template->load_table_row($array_row_production);
		}
		
			$array_row_production = NULL;
			$array_row_production["col1"] = array("", array("align"=>"center","colspan"=>"5"));
			$array_row_production["col2"] = array("Tổng", array("align"=>"center"));
			$array_row_production["col3"] = array(number_format($tong), array("align"=>"center"));
			$str_row_production .= $this->Template->load_table_row($array_row_production);
	}


	$str_table_production = $this->Template->load_table($str_header_production . $str_row_production);
	
	// LOAD FORM
	$str_form_production = $this->Template->load_form(array("method" => "GET", "id" => "form_seach", "action" => "/production/plan_month"),$str_input_row . $str_table_production);
	
	echo $str_form_production;
?>


<script>
	$( "#month_search" ).datepicker({dateFormat: 'mm-yy'});
	function kiemtra()
	{
		//gán id_factory_search vào đối tượng id_facory
   		 document.getElementById("id_factory").value =  document.getElementById("id_factory_search").value;
		 document.getElementById("id_manufactory").value =  document.getElementById("id_manufactory_search").value;
		 document.getElementById("id_cat").value =  document.getElementById("id_cat_search").value; 
		 document.getElementById("month").value =  document.getElementById("month_search").value; 
		 document.getElementById("form_nhap").submit(); 
	}
</script>
