<style type="text/css">


.tbl_r{


}
.table-responsive{
  width: 1800px;
}

.parent{
  height: 50%;
  position: absolute;
  width: 100%;
  left: 0;
  overflow-y:scroll;
}
</style>
<?php
	
	$title_header = " Nhập Kế Hoạch Giao Hàng";
	if(isset($_GET["id_delivery"]) && $_GET["id_delivery"] != "") $title_header = "kế Hoạch Giao Hàng ";
	echo $this->Template->load_function_header($title_header);
	
	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_factory = $this->Template->load_selectbox(array("name" => "id_factory", "id"=>"id_factory_search" ,"style" => "width:150px","onchange"=>"show_manufactory()"),$array_factory, $id_factory);
	
	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "id"=>"id_manufactory_search" ,"style" => "width:150px","onchange"=>"show_cat()"),$array_manufactory, $id_manufactory);
	
	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_cat_product = $this->Template->load_selectbox(array("name" => "id_cat", "id"=>"id_cat_search" ,"style" => "width:150px","onchange"=>"show_product()"), $array_product_cat, $id_cat);
	
	//Dùng hàm load_textbox của đối tượng Template để textbox
	$str_textbox_day = $this->Template->load_textbox(array("name" => "month" ,"id"=>"month_search","style" => "width:150px", "value"=>$month));
	
	$str_save_button = $this->Template->load_button(array("type" => "sutmit"), "Xem");
	
	$str_input_row = "Chọn nhà máy $str_selectbox_factory Chọn xưởng $str_selectbox_manufactory Dòng sản phẩm $str_selectbox_cat_product Chọn tháng $str_textbox_day $str_save_button";
	
	// LOAD FORM
	$str_form_production = $this->Template->load_form(array("method" => "GET", "id" => "form_search", "action" => "/production/add_delivery2"),$str_input_row);
	echo $str_form_production;
	
	//BEGIN: HEADER
	//TẠO MẢNG HEADER
	$array_header_production = NULL;		
	$array_header_production["col1"] = array("STT", array("align"=>"center","style"=>"width:3%"));
	$array_header_production["col2"] = array("Sản phẩm", array("align"=>"center","style"=>"width: 10%"));
	//$array_header_production["col4"] = array("Khách hàng", array("align"=>"center","style"=>"width: 20px"));
	
	for($i=1; $i<=$songay; $i++)
	{
		$array_header_production["col_ngay$i"] = array("$i", array("align"=>"center","style"=>"width: 5%"));
	
	}

	$array_header_production["col17"] = array("", array("align"=>"center","style"=>"width: 20px"));
	$array_header_production["col18"] = array("", array("align"=>"center","style"=>"width: 20px"));
	

	//LOAD HEADER
	$str_header_production = $this->Template->load_table_header($array_header_production);
	//END: HEADER
	
	//sửa
	$id = "";
	$id_factory = "";
	$id_manufactory = "";
	$id_cat = "";
	$month = "";
	$id_product = "";
	//$id_customer = "";
	$day = "";
	if($array_edit_delivery!=NULL)
	{
		$id = $array_edit_delivery[0]["id"];
		$id_factory = $array_edit_delivery[0]["id_factory"];
		$id_manufactory = $array_edit_delivery[0]["id_manufactory"];
		$id_cat = $array_edit_delivery[0]["id_cat"];
		$month = $array_edit_delivery[0]["month"];
		$id_product = $array_edit_delivery[0]["id_product"];
		//$id_customer = $array_edit_delivery[0]["id_customer"];
		
	}
	//print_r($array_edit_delivery);
	
	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	$str_selectbox_code_product = $this->Template->load_selectbox(array("name" => "production[id_product]" ,"style" => "width:300px"), $array_product, $id_product);
	
	//Dùng hàm load_selectbox của đối tượng Template để selectbox
	//$str_selectbox_code_customer = $this->Template->load_selectbox(array("name" => "production[id_customer]" ,"style" => "width:300px"), $array_customer, $id_customer);
	
	//$str_hidden_id_product = $this->Template->load_hidden(array("name" => "production[id_product]", "id"=>"id_product" ,"style" => "width:100px"));

	$str_hidden_id_factory = $this->Template->load_hidden(array("name" => "production[id_factory]", "id"=>"id_factory" ,"style" => "width:100px", "value"=>$id_factory));
	
	$str_hidden_id_manufactory = $this->Template->load_hidden(array("name" => "production[id_manufactory]", "id"=>"id_manufactory" ,"style" => "width:100px", "value"=>$id_manufactory));
	
	$str_hidden_id_cat = $this->Template->load_hidden(array("name" => "production[id_cat]", "id"=>"id_cat" ,"style" => "width:100px", "value"=>$id_cat));
	
	$str_hidden_month = $this->Template->load_hidden(array("name" => "production[month]", "id"=>"month" ,"style" => "width:100px", "value"=>$month));
	
	$str_hidden_id = $this->Template->load_hidden(array("name" => "production[id]" ,"style" => "width:100px", "value"=>$id));
	
	$str_hidden_songay = $this->Template->load_hidden(array("name"=>"production[songay]", "id"=>"songay", "value"=>$songay));
	
	$str_hidden = "$str_hidden_id_factory $str_hidden_id_manufactory $str_hidden_id_cat $str_hidden_month $str_hidden_songay $str_hidden_id";

	$str_save_button = $this->Template->load_button(array("type" => "button", "onclick"=>"kiemtra()"), "Lưu");
	 
	$str_row_production = "";
	
	//BEGIN: HEADER
	//TẠO MẢNG HEADER
	$array_row_production = NULL;					
	$array_row_production["col1"] = array("", array("align"=>"center","style"=>"width: 20px"));
	$array_row_production["col2"] = array($str_selectbox_code_product, array("align"=>"center","style"=>"width: 20px"));
	//$array_row_production["col4"] = array($str_selectbox_code_customer, array("align"=>"center","style"=>"width: 20px"));
	
	for($i=1; $i<=$songay; $i++)
	{
		if($array_edit_delivery)
		{
			$day = str_replace(",", "", $array_edit_delivery[0]["day_$i"]);
		}
		//Dùng hàm load_textbox của đối tượng Template để texttbox
		$str_textbox_day = $this->Template->load_textbox(array("name" => "production[day_$i]" ,"style" => "width:100px", "onkeyup"=>"format_number_textbox(this)", "value"=>$day));
		
		$array_row_production["col_ngay$i"] = array($str_textbox_day, array("align"=>"center","style"=>"width: 20px"));	
		
	}
	$array_row_production["col17"] = array($str_save_button . $str_hidden, array("align"=>"center","style"=>"width: 20px"));
	$array_row_production["col18"] = array("", array("align"=>"center","style"=>"width: 20px"));
	//LOAD HEADER
	$str_row_production .= $this->Template->load_table_row($array_row_production);
	//END: HEADER

	$stt = 0;
	if($array_delivery)
	{
		foreach($array_delivery as $delivery)
		{
			$stt++;
			$id_delivery = $delivery["id"];
			$id_factory = $delivery["id_factory"];
			$id_manufactory = $delivery["id_manufactory"];
			$id_cat = $delivery["id_cat"];
			$id_product = $delivery["id_product"];
			//$id_customer = $delivery["id_customer"];
			$month = date("m-Y",strtotime($delivery["month"]));

			$link_xoa = "/production/add_delivery2/$id_delivery?act=del";
			$link_sua = "/production/add_delivery2/$id_delivery?id_factory=$id_factory&id_manufactory=$id_manufactory&id_cat=$id_cat&id_product=$id_product&month=$month&id_delivery=$id_delivery";
			
			$link_sua = $this->Template->load_link("edit", "Sửa", $link_sua);
			$link_xoa = $this->Template->load_link("del", "Xóa", $link_xoa);
			$array_row_production = NULL;					
			$array_row_production["col1"] = array($stt, array("align"=>"center","style"=>"width: 20px"));
			$array_row_production["col2"] = array($delivery["product_name"], array("align"=>"center","style"=>"width: 20px"));
			//$array_row_production["col4"] = array($delivery["customer_name"], array("align"=>"center","style"=>"width: 20px"));
		
		for($i=1; $i<=$songay; $i++)
		{
			//Dùng hàm load_textbox của đối tượng Template để texttbox
			//$str_textbox_day = $this->Template->load_textbox(array("name" => "production[day_$i]" ,"style" => "width:100px", "onkeyup"=>"format_number_textbox(this)"));
			
			$array_row_production["col_ngay$i"] = array(number_format($delivery["day_$i"]), array("align"=>"center","style"=>"width: 20px"));	
			
		}
			$array_row_production["col17"] = array($link_sua, array("align"=>"center","style"=>"width: 20px"));
			$array_row_production["col18"] = array($link_xoa, array("align"=>"center","style"=>"width: 20px"));
			//LOAD HEADER
			$str_row_production .= $this->Template->load_table_row($array_row_production);
		}
	}


	$str_table_production = $this->Template->load_table($str_header_production . $str_row_production);
	
	// LOAD FORM
	$str_form_production = $this->Template->load_form(array("method" => "POST", "id" => "form_nhap", "action" => "/production/add_delivery2"),$str_table_production);

?>

 <div class="parent">

   <?php
	echo $str_form_production;

?>
</div>

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
	function show_manufactory()
	{
		 document.getElementById("form_search").submit(); 
	}
	function show_cat()
	{
		 document.getElementById("form_search").submit(); 
	}
	function show_product()
	{
		 document.getElementById("form_search").submit(); 
	}
</script>