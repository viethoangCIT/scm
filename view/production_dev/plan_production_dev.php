
<style type="text/css">


.tbl_r{


}
.table-responsive{
  width: 100%;
}

.parent{
  /*height: 50%;*/
  position: absolute;
  width: 100%;
  left: 0;
  overflow-y:hidden;
}
.form_save_search{
	left: 0;
    margin-left: -115px;
    width: 1400px;	
	margin-bottom:50px;
}
</style>

<?php
	$title_header = " Tạo Công Lệnh Sản Xuất";
	echo $this->Template->load_function_header($title_header);
	
	$str_selectbox_factory = $this->Template->load_selectbox(array("name"=>"id_factory","value"=>"","style"=>"width:120px"), $array_factory, $id_factory);
	
	$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "style" => "width:120px","onchange"=>"show_group()"), $array_manufactory, $id_manufactory);
	
	$str_selectbox_group = $this->Template->load_selectbox(array("name" => "id_group", "style" => "width:120px"), $array_group, $id_group);
	
	$str_selectbox_shift = $this->Template->load_selectbox(array("name" => "id_shift", "style" => "width:120px"), $array_shift, $id_shift);
	
	$str_selectbox_truongca = $this->Template->load_selectbox(array("name" => "id_user_leader", "style" => "width:120px"), $array_user, $id_user_leader);	
	
	$str_selectbox_kiemtra = $this->Template->load_selectbox(array("name" => "id_user_manager", "style" => "width:120px"), $array_user, $id_user_manager);
	
	$str_textbox_day = $this->Template->load_textbox(array("name" => "day", "id"=>"day", "style" => "width:120px", "value"=>$day));
	$str_hidden_status = $this->Template->load_hidden(array("name" => "status", "id"=>"status", "style" => "width:120px", "value"=>"0"));
	
	$str_save_button = $this->Template->load_button(array("type" => "button","onclick"=>"save_form()"), "Lưu");
	$str_search_button = $this->Template->load_button(array("type" => "button","onclick"=>"search_form()"), "Tìm kiếm");	
	$str_input_row = "Nhà máy: $str_selectbox_factory Xưởng: $str_selectbox_manufactory Tổ: $str_selectbox_group Ca: $str_selectbox_shift
				 Trưởng ca: $str_selectbox_truongca Quản đốc $str_selectbox_kiemtra Ngày: $str_textbox_day $str_save_button $str_search_button";
	$str_form_production = $this->Template->load_form(array("method" => "GET", "id" => "form_search", "action" => "/production/plan"),$str_input_row .$str_hidden_status);
		
	
	$array_header_production = NULL;		
	$array_header_production["col1"] = array("STT", array("align"=>"center","style"=>"width: 5px"));
	$array_header_production["col2"] = array("Ngày", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col3"] = array("Nhà máy", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col4"] = array("Xưởng", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col5"] = array("Tổ", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col6"] = array("Ca", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col7"] = array("Trưởng ca", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col8"] = array("Quản đốc", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col9"] = array("Chi tiết công lệnh", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col10"] = array("Phiếu in", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col11"] = array("Nhập báo cáo", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col12"] = array("Xem báo cáo", array("align"=>"center","style"=>"width: 10px"));
	$array_header_production["col13"] = array("Chức Năng", array("align"=>"center","style"=>"width: 10px"));
	

	//LOAD HEADER
	$str_header_production = $this->Template->load_table_header($array_header_production);
	//END: HEADER
	$str_row_production = "";
	$stt = 0;
	if($array_production_plan)
	{
		foreach($array_production_plan as $plan)
		{
			$stt++;
			$id_production_plan = $plan["id"];
			$link_phieuin = "/production/plan_detail/$id_production_plan.html";
			$link_chitiet = "/production/production_plan_detail/$id_production_plan.html";
			$link_nhapbaocao = "/production/add_data/$id_production_plan.html";
			$link_xembaocao = "/production/data/$id_production_plan.html";
			$link_xoa = "/production/del_plan/$id_production_plan?act=del";
			
			$link_chitiet = $this->Template->load_link("edit", "Chi tiết", $link_chitiet);
			$link_nhapbaocao = $this->Template->load_link("edit", "Nhập", $link_nhapbaocao);
			$link_xembaocao = $this->Template->load_link("edit", "Xem", $link_xembaocao);		
			$link_phieuin = $this->Template->load_link("edit", "Phiếu in", $link_phieuin);
			$link_xoa = $this->Template->load_link("del", "Xóa", $link_xoa);
			
			$array_row_production["col1"] = array($stt, array("align"=>"center","style"=>"width: 5px"));
			$array_row_production["col2"] = array($plan["day"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col3"] = array($plan["factory"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col4"] = array($plan["manufactory"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col5"] = array($plan["group"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col6"] = array($plan["shift"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col7"] = array($plan["user_leader"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col8"] = array($plan["user_manager"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col9"] = array($link_chitiet, array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col10"] = array($link_phieuin, array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col11"] = array($link_nhapbaocao, array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col12"] = array($link_xembaocao, array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col13"] = array($link_xoa, array("align"=>"center","style"=>"width: 10px"));
			
			$str_row_production .= $this->Template->load_table_row($array_row_production);
		
			
		}//End: foreach($array_production_plan as $plan)
	}//End:if($array_production_plan)
	
	$str_table_production = $this->Template->load_table($str_header_production . $str_row_production);
	
	// LOAD FORM
	//$str_form_production = $this->Template->load_form(array("method" => "GET", "id" => "form_search", "action" => "/production/plan"),$str_input_row .$str_hidden_status. $str_table_production);
	
	
	
?>
<div class="form_save_search" >
	
   <?php
		echo $str_form_production;
	?>
</div>
<div class="parent">
	
   <?php
		$title_header = "Công Lệnh Sản Xuất";
		echo $this->Template->load_function_header($title_header);
  	 	echo $str_table_production;
	?>
</div>

<script>
	$( "#day" ).datepicker({dateFormat: "dd-mm-yy"});
	function search_form()
	{
		document.getElementById("form_search").submit();
	}
	function save_form()
	{
		if(document.getElementById("day").value == "")
		{
			document.getElementById("day").focus();
		}
		else
		{
			document.getElementById("status").value = "1";
			document.getElementById("form_search").submit();

		}
	}
	function show_group()
	{
		document.getElementById("form_search").submit();
	}
</script>