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
  overflow-y:hidden;
}
</style>

<?php
	//tạo tiêu đề hàm
	$function_title = "Theo Dõi Năng Suất";
	echo $this->Template->load_function_header($function_title);
	
	//BEGIN: LOAD INPUT FROM SEARCH
	$str_textbox_day = $this->Template->load_textbox(array("name" => "month" ,"id"=>"month_search","style" => "width:150px", "value"=>$month));
	$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "id"=>"id_manufactory" ,"style" => "width:150px"),$array_manufactory);
	$str_selectbox_group = $this->Template->load_selectbox(array("name" => "id_group", "id"=>"id_group" ,"style" => "width:150px"),$array_group);	
	$str_save_button = $this->Template->load_button(array("type" => "sutmit"), "Xem");
	//END: LOAD INPUT FORM SEARCH
	
	$str_input_row = "Chọn tháng $str_textbox_day $str_save_button $str_selectbox_manufactory $str_selectbox_group";
	
	// LOAD FORM
	$str_form_production = $this->Template->load_form(array("method" => "GET", "id" => "form_seach", "action" => "/production/productivity"),$str_input_row);
	echo $str_form_production;
	
	//1: tao mang table header 	
	$array_header_production["col1"] = array("Máy",array("style"=>"text-align:center; width:3%"));
	$array_header_production["col2"] = array("Số lượng OK",array("style"=>"text-align:center; width:3%"));
	$array_header_production["col3"] = array("Năng suất(%)",array("style"=>"text-align:center; width:3%"));
	$array_header_production["col4"] = array("Số máy hoạt động",array("style"=>"text-align:center; width:3%"));
	for($i=1; $i<=$songay; $i++)
	{
		$array_header_production["col_ngay$i"] = array("$i-$month",array("style"=>"text-align:center; width:20px"));
	}
	
	//2: lấy dòng tr header
	$str_header_production = $this->Template->load_table_header($array_header_production);
	
	//1: tao mang table load dòng 	
	$str_row_production = "";
	
	$array_row_production = NULL;
	$array_row_production["col1"] = array("Máy 1",array("style"=>"text-align:center; width:3%"));
	$array_row_production["col2"] = array("1200",array("style"=>"text-align:center; width:3%"));
	$array_row_production["col3"] = array("70%",array("style"=>"text-align:center; width:3%"));
	$array_row_production["col4"] = array("17/20",array("style"=>"text-align:center; width:3%"));
	for($i=1; $i<=$songay; $i++)
	{
		$array_row_production["col_ngay$i"] = array("",array("style"=>"text-align:center; width:20px"));
	}
	
	//2: lấy dòng tr header
	$str_row_production .= $this->Template->load_table_row($array_row_production);
	
	$str_table_production =  $this->Template->load_table($str_header_production . $str_row_production);
	
?>

<div class="parent">

   <?php
	echo $str_table_production;

?>
</div>

<script>
	$( "#month_search" ).datepicker({dateFormat: 'mm-yy'});
</script>