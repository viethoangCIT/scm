<style type="text/css">


.tbl_r{


}
.table-responsive{
  width: 1800px;
}

.parent{
  /*height: 50%;*/
  position: absolute;
  width: 100%;
  left: 0;
  overflow-y:hidden;
}
</style>

<?php
	$title_header = "Nhập Báo Cáo Sản Xuất";
	echo $this->Template->load_function_header($title_header);
	
	$array_header_production = NULL;		
	$array_header_production["col1"] = array("STT", array("align"=>"center","style"=>"width: 5px"));
	$array_header_production["col2"] = array("Máy", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col3"] = array("Mã sản phẩm", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col4"] = array("Tên sản phẩm", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col5"] = array("Thời gian thực tế", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col6"] = array("Số lượng OK", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col7"] = array("Số lượng NG", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col8"] = array("Sửa", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col12"] = array("Xóa", array("align"=>"center","style"=>"width: 10px"));	

	//LOAD HEADER
	$str_header_production = $this->Template->load_table_header($array_header_production);
			
	$str_row_production = "";
	
	$stt = 0; 
	if($array_production_plan_detail)
	{
		foreach($array_production_plan_detail as $production_plan_detail)
		{
			$id_machine = $production_plan_detail["id_machine"];
			$machine = $production_plan_detail["machine"];
			
			$id_product = $production_plan_detail["id_product"];
			$product = $production_plan_detail["product"];
			$product_code = $production_plan_detail["product_code"];
			
			
			$link_sua = $this->Template->load_link("edit", "Sửa");
			$link_xoa = $this->Template->load_link("del", "Xóa");
			
			$str_hidden_id_machine = $this->Template->load_hidden(array("name"=>"data[$stt][id_machine]", "style"=>"width:50px", "value"=>$id_machine));
			
			$str_hidden_machine = $this->Template->load_hidden(array("name"=>"data[$stt][machine]", "style"=>"width:50px", "value"=>$machine));
	
			$str_hidden_id_product = $this->Template->load_hidden(array("name"=>"data[$stt][id_product]", "style"=>"width:50px", "value"=>$id_product));

			$str_hidden_product = $this->Template->load_hidden(array("name"=>"data[$stt][product]", "style"=>"width:50px", "value"=>$product));

			$str_hidden_product_code = $this->Template->load_hidden(array("name"=>"data[$stt][product_code]", "style"=>"width:50px", "value"=>$product_code));
			
			$str_input_time = $this->Template->load_textbox(array("name" => "data[$stt][time]", "style" => "width:50px", "value"=>""));
	
			$str_input_num_ok = $this->Template->load_textbox(array("name" => "data[$stt][num_ok]", "style" => "width:50px", "value"=>""));
	
			$str_input_num_ng = $this->Template->load_textbox(array("name" => "data[$stt][num_ng]", "style" => "width:50px", "value"=>""));
			
			$str_hidden = "$str_hidden_id_machine $str_hidden_id_product"; 

			$str_hidden .= "$str_hidden_machine $str_hidden_product $str_hidden_product_code";

			$stt++;
			$array_row_production = NULL;		
			$array_row_production["col1"] = array($stt .$str_hidden, array("align"=>"center","style"=>"width: 5px"));
			$array_row_production["col2"] = array($production_plan_detail["machine"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col3"] = array($production_plan_detail["product_code"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col4"] = array($production_plan_detail["product"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col5"] = array($str_input_time, array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col6"] = array($str_input_num_ok, array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col7"] = array($str_input_num_ng, array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col8"] = array($link_sua, array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col12"] = array($link_xoa, array("align"=>"center","style"=>"width: 10px"));	
		
			//LOAD HEADER
			$str_row_production .= $this->Template->load_table_row($array_row_production);
			
						
		}	
	}
	
	
	$str_table_production = $this->Template->load_table($str_header_production . $str_row_production);
	
	$str_save_button = $this->Template->load_button(array("type" => "sutmit"), "Lưu");
	
	// LOAD FORM
	$str_form_production = $this->Template->load_form(array("method" => "POST", "id" => "form_seach", "action" => "/production/add_data/$id_production_plan"),$str_table_production . $str_save_button);
	
	
?>

<div class="parent">

   <?php
	echo $str_form_production;

	?>
</div>