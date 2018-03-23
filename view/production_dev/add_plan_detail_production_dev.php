<style type="text/css">


.tbl_r{


}
.table-responsive{
}

.parent{
  height: 50%;
  position: absolute;
  width: 100%;
  left: 0;
  /*overflow-y:hidden;*/
}
</style>
<?php
	
	$title_header = " Nhập Chi Tiết Công Lệnh Sản Xuất ";
	echo $this->Template->load_function_header($title_header);
	
	$array_header_plan["col1"] =  array("STT",array("style"=>"text-align:center; width:3%"));
	$array_header_plan["col2"] = array("Sản phẩm",array("style"=>"text-align:center; width:8%"));
	$array_header_plan["col3"] = array("Máy",array("style"=>"text-align:center; width:8%"));
	$array_header_plan["col4"] = array("Thời gian",array("style"=>"text-align:center; width:8%"));
	$array_header_plan["col5"] = array("Lưu",array("style"=>"text-align:center; width:8%"));
	$array_header_plan["col6"] = array("Sửa",array("style"=>"text-align:center; width:8%"));
	$array_header_plan["col7"] = array("Xóa",array("style"=>"text-align:center; width:8%"));
	
	$str_header_plan = $this->Template->load_table_header($array_header_plan);
	
	//BEGIN: LOAD dữ liệu sửa
	$id = "";
	$id_machine = "";
	$id_product = "";
	$time = "";
	if($array_edit)
	{
		$id = $array_edit[0]["id"];
		$id_machine = $array_edit[0]["id_machine"];
		$id_product = $array_edit[0]["id_product"];
		$time = $array_edit[0]["time"];
	}
	if(isset($_GET["data"]["id_product"]) && $_GET["data"]["id_product"] != "") $id_product = $_GET["data"]["id_product"];
	//END: LOAD dữ liệu sửa
	
	//BEGIN: TẠO INPUT
	$str_hiddien_id = $this->Template->load_hidden(array("name"=>"data[id]", "value"=>$id, "style"=>"width:120px"));
	$str_hiddien_status = $this->Template->load_hidden(array("name"=>"data[status]", "value"=>"0","id"=>"status"));
	$str_selectbox_machine = $this->Template->load_selectbox(array("name" => "data[id_machine]", "style" => "width:300px"), $array_machine,$id_machine);
	$str_selectbox_product = $this->Template->load_selectbox(array("name" => "data[id_product]", "style" => "width:300px","onchange"=>"show_machine()"), $array_product,$id_product);
	$str_input_time_plan = $this->Template->load_textbox(array("name" => "data[time]", "style" => "width:50px", "value"=>$time));	
	$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"save_detail()"),"Lưu");
	//END: TẠO INPUT
	
	//BEGIN: LOAD HEADER
	$str_row_plan = "";
	$array_row_plan = NULL;
	$array_row_plan["col1"] =  array("",array("style"=>"text-align:center"));
	$array_row_plan["col2"] = array($str_selectbox_product,array("style"=>"text-align:center"));
	$array_row_plan["col3"] = array($str_selectbox_machine,array("style"=>"text-align:center"));
	$array_row_plan["col4"] = array($str_input_time_plan,array("style"=>"text-align:center"));
	$array_row_plan["col5"] = array($str_save_button,array("style"=>"text-align:center"));
	
	$str_row_plan .= $this->Template->load_table_row($array_row_plan, array("id"=>"production_detail"));
	//END: LOAD HEADER
	
	//BEGIN: LOAD ROW
	$stt=0;
	if($array_production_plan_detail)
	{
		foreach($array_production_plan_detail as $plan_detail)
		{
			$stt++;
			$id_plan_detail = $plan_detail["id"];
			$link_sua = "/production/production_plan_detail/$id_production_plan/$id_plan_detail?act=edit";
			$link_xoa = "/production/production_plan_detail/$id_production_plan/$id_plan_detail?act=del";
			$link_sua = $this->Template->load_link("edit", "Sửa", $link_sua);
			$link_xoa = $this->Template->load_link("del", "Xóa", $link_xoa);
			//$array_row_plan = NULL;
			$array_row_plan["col1"] =  array($stt,array("style"=>"text-align:center"));
			$array_row_plan["col2"] = array($plan_detail["product"],array("style"=>"text-align:center"));
			$array_row_plan["col3"] = array($plan_detail["machine_control"],array("style"=>"text-align:center"));
			$array_row_plan["col4"] = array($plan_detail["time"],array("style"=>"text-align:center"));
			$array_row_plan["col5"] = array("",array("style"=>"text-align:center"));
			$array_row_plan["col6"] = array($link_sua,array("style"=>"text-align:center"));
			$array_row_plan["col7"] = array($link_xoa,array("style"=>"text-align:center"));	
		
		$str_row_plan .= $this->Template->load_table_row($array_row_plan);
		}//END: foreach($array_production_plan_detail as $plan_detail)
	}//END: if($array_production_plan_detail)
	//BEGIN: LOAD ROW
	
	//Đưa nội dung str_allowance vào thẻ table
	$str_plan =  $this->Template->load_table($str_header_plan . $str_row_plan);
	
	//đưa vào form
	$str_form = $this->Template->load_form(array("method"=>"GET","id"=>"form_nhap","action"=>"/production/production_plan_detail/$id_production_plan"), $str_plan.$str_hiddien_id.$str_hiddien_status);
	
	
?>

<div class="parent">
	<?php
		echo $str_form;
	?>
</div>


<script>
	function save_detail()
	{
		document.getElementById("status").value = "1";
		document.getElementById("form_nhap").submit();
	}
	function show_machine()
	{
		document.getElementById("form_nhap").submit();
	}
	
</script>