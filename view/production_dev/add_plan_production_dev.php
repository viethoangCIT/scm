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
	
	$title_header = " Nhập Công Lệnh Sản Xuất";
	echo $this->Template->load_function_header($title_header);
	
	$id = "";
	$id_factory = "";
	$id_shift = "";
	$id_user_leader = "";
	$id_user_manager = "";
	$id_machine = "";
	$id_product = "";
	$day = "";
	$time = "";	
	
	$str_hidden_id = $this->Template->load_hidden(array("name" => "data[id]", "value"=>$id));
	$str_selectbox_factory = $this->Template->load_selectbox(array("name"=>"data[id_factory]","value"=>"","style"=>"width:120px"), $array_factory, $id_factory);
	
	$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "data[id_manufactory]", "style" => "width:120px","onchange"=>"show_group()"), $array_manufactory, $id_manufactory);
	
	$str_selectbox_group = $this->Template->load_selectbox(array("name" => "data[id_group]", "style" => "width:120px"), $array_group, $id_group_search);
	
	$str_selectbox_shift = $this->Template->load_selectbox(array("name" => "data[id_shift]", "style" => "width:120px"), $array_shift, $id_shift);
	
	$str_selectbox_truongca = $this->Template->load_selectbox(array("name" => "data[id_user_leader]", "style" => "width:120px"), $array_user, $id_user_leader);	
	
	$str_selectbox_kiemtra = $this->Template->load_selectbox(array("name" => "data[id_user_manager]", "style" => "width:120px"), $array_user, $id_user_manager);
	
	$str_textbox_day = $this->Template->load_textbox(array("name" => "data[day]", "id"=>"day", "style" => "width:120px", "value"=>""));
	$str_hidden_status = $this->Template->load_hidden(array("name" => "data[status]", "id"=>"status", "style" => "width:120px", "value"=>"0"));
	
	$str_save_button = $this->Template->load_button(array("type" => "button","onclick"=>"show()"), "Lưu");
	
	$str_input = "Nhà máy: $str_selectbox_factory Xưởng: $str_selectbox_manufactory Tổ: $str_selectbox_group Ca: $str_selectbox_shift
				 Trưởng ca: $str_selectbox_truongca Quản đốc $str_selectbox_kiemtra Ngày: $str_textbox_day $str_save_button";	
	
	// LOAD FORM
	$str_form_production = $this->Template->load_form(array("method" => "GET", "id" => "form_seach", "action" => "/production/add_plan"),$str_input . $str_hidden_id.$str_hidden_status);
	
?>

<div class="parent">
	<?php
	echo $str_form_production;
	?>
</div>

<script>
	$( "#day" ).datepicker({dateFormat: "dd-mm-yy"});
	function show()
	{
		//document.getElementById("production_detail").style.display = "";
		document.getElementById("status").value = "1";
		document.getElementById("form_seach").submit();
	}
	
	function show_group()
	{
		document.getElementById("form_seach").submit();
	}
	function show_user()
	{
		document.getElementById("form_seach").submit();
	}
	
</script>