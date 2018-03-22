<style type="text/css">
.parent{
  height: 50%;
  position: absolute;
  width: 100%;
  left: 0;
  overflow-y:hidden;
}
div.container_table {
	padding: 5px 15px;
	width: 100%;
	margin:0px;
	z-index:101;
	position: absolute;
	height: 600px;
	left: 0;
	
}
.form-group{
	margin-top: 0px;
}
.clearfix{
	height: 30px;
}
.ft_container{
	margin-top: -20px;
}
footer{
	margin-top: 200px;
}
.chu-nhat{
	background-color: #f1c906;
}

.table-responsive{
	width:1860px;	
}
.scroll-tab-baocao{
	overflow-x:auto ;
	overflow-y:scroll;
	height:500px;
}
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
</script>
<?php

	$function_title = "Theo Dõi Nhân Sự";
	echo $this->Template->load_function_header($function_title);
	
	//BEGIN: INPUT
	$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "id"=>"id_manufactory_search" ,"style" => "width:150px","onchange"=>"show_group()"), $array_manufactory,$id_manufactory);
	$str_textbox_day = $this->Template->load_textbox(array("name" => "month" ,"id"=>"month_search","style" => "width:150px", "value"=>$month));
	$str_selectbox_group = $this->Template->load_selectbox(array("name" => "id_group", "id"=>"id_group_search" ,"style" => "width:150px"), $array_group_search,$id_group);
	$str_selectbox_shift = $this->Template->load_selectbox(array("name" => "id_shift", "id"=>"id_shift_search" ,"style" => "width:150px"), $array_shift);
	$str_save_button = $this->Template->load_button(array("type" => "sutmit"), "Xem");
	//END: INPUT
	$str_input_row = "$str_selectbox_manufactory $str_selectbox_group Chọn tháng $str_textbox_day $str_save_button";
	
	// LOAD FORM
	$str_form_production = $this->Template->load_form(array("method" => "GET", "id" => "form_seach", "action" => "/production/user_production"),$str_input_row);
	echo $str_form_production;
	
	//BEGIN: LOAD HEADER 	
	$array_header_production["col1"] = array("Line");
	$array_header_production["col2"] = array("Mục kiểm soát");
	for($i=1; $i<=$songay; $i++)
	{
		$array_header_production["col_ngay$i"] = array("$i");
	}
	$str_header_production = $this->Template->load_table_header($array_header_production);
	//END: LOAD HEADER
	$str_row_production = "";
	
	/***************************************************************************************************************************/
	/*										END: TẠO DÒNG TỔNG THEO DÕI NHÂN SỰ													*/
	/***************************************************************************************************************************/
	$str_row_tong = "";
	$array_row_tong = "";
	$array_row_tong["col1"] = array("",array("rowspan"=>""));
	$array_row_tong["col2"] = array("Nhân sự");
	
	for($i=1; $i<=$songay; $i++)
	{
		$str_month = "$i-".$month;
		$str_month = date("Y-m-d",strtotime($str_month));
		
		//begin: kiem tra ngay chu nhat
		$timestamp = strtotime($str_month);
		$weekday= date("l", $timestamp );
		$normalized_weekday = strtolower($weekday);
		
		$check = false;
		$class = "";
		if ($normalized_weekday == "sunday") {
		$check = true;
		} else {
	    $check = false;
		}
		if($check) $class="chu-nhat";
		//begin: kiem tra ngay chu nhat
		$array_row_tong["col_ngay$i"] = array("",array("id"=>"tong_ns_$str_month","class"=>"$class"));
	}
	$str_row_production .= $this->Template->load_table_row($array_row_tong);
	
	$array_row_tong["col1"] = array("Tổng");
	$array_row_tong["col2"] = array("Hiện diện");
	for($i=1; $i<=$songay; $i++)
	{
		$str_month = "$i-".$month;
		$str_month = date("Y-m-d",strtotime($str_month));
		
		//begin: kiem tra ngay chu nhat
		$timestamp = strtotime($str_month);
		$weekday= date("l", $timestamp );
		$normalized_weekday = strtolower($weekday);
		
		$check = false;
		$class = "";
		if ($normalized_weekday == "sunday") {
		$check = true;
		} else {
	    $check = false;
		}
		if($check) $class="chu-nhat";
		//begin: kiem tra ngay chu nhat
		$array_row_tong["col_ngay$i"] = array("",array("id"=>"tong_hd_$str_month","class"=>"$class"));
	}
	$str_row_production .= $this->Template->load_table_row($array_row_tong);
	$array_row_tong["col1"] = array("");
	$array_row_tong["col2"] = array("Vắng");
	for($i=1; $i<=$songay; $i++)
	{
		$str_month = "$i-".$month;
		$str_month = date("Y-m-d",strtotime($str_month));
		
		//begin: kiem tra ngay chu nhat
		$timestamp = strtotime($str_month);
		$weekday= date("l", $timestamp );
		$normalized_weekday = strtolower($weekday);
		
		$check = false;
		$class = "";
		if ($normalized_weekday == "sunday") {
		$check = true;
		} else {
	    $check = false;
		}
		if($check) $class="chu-nhat";
		//begin: kiem tra ngay chu nhat
		$array_row_tong["col_ngay$i"] = array("",array("id"=>"tong_vang_$str_month","class"=>"$class"));
	}
	$str_row_production .= $this->Template->load_table_row($array_row_tong,array("style"=>"border-bottom: solid 3px"));
	/***************************************************************************************************************************/
	/*										END: TẠO DÒNG TỔNG THEO DÕI NHÂN SỰ												  */
	/***************************************************************************************************************************/
	//1: tao mang table load dòng 	

	$array_muckiemsoat = null;
	if($array_group)
	{
		foreach($array_group as $group)
		{
			
			//BEGIN:Dòng sĩ số
			$name = $group["name"];
			$id_group = $group["id"];
			
			$array_row_production["col1"] = array($name,array());
			$array_row_production["col2"] = array("Sĩ số");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				$array_row_production["col_ngay$i"] = array("",array("id"=>"ss_".$id_group."_$str_month","class"=>"$class"));
			}
			
			$str_row_production .= $this->Template->load_table_row($array_row_production);
			//END:Dòng sĩ số
			
			//BEGIN:Dòng hiện diện
			$name = $group["name"];
			$id_group = $group["id"];
			
			$array_row_production["col1"] = array("");
			$array_row_production["col2"] = array("Hiện diện");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				
				
				$array_row_production["col_ngay$i"] = array("",array("id"=>"hd_".$id_group."_".$str_month,"class"=>"$class"));
			}
			
			$str_row_production .= $this->Template->load_table_row($array_row_production);
			//END:Dòng hiện diện	
			
			//BEGIN:Dòng leader, định lượng
			$name = $group["name"];
			$id_group = $group["id"];
			
			$array_row_production["col1"] = array("");
			$array_row_production["col2"] = array("Leader, định lượng");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				$array_row_production["col_ngay$i"] = array("",array("id"=>"dl_".$id_group."_".$str_month,"class"=>"$class"));
			}
			
			$str_row_production .= $this->Template->load_table_row($array_row_production);
			//END:Dòng leader, định lượng
			
			//BEGIN: DÒNG VẮNG
			$array_row_production["col1"] = array("");
			$array_row_production["col2"] = array("Vắng");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				$str_value = "vang_".$id_group."_".$str_month;
				$array_row_production["col_ngay$i"] = array("",array("id"=>"vang_".$id_group."_".$str_month,"class"=>"$class","onclick"=>"show_vang('$str_value')","onMouseOver"=>"highlight('$str_value')","onMouseOut"=>"highlightOut('$str_value')"));
			}
			
			$str_row_production .= $this->Template->load_table_row($array_row_production,array("style"=>"border-bottom: solid 3px"));
			
			//END: DÒNG VẮNG
					
		}//END: foreach($array_group as $group)
	}//END: if($array_group)
		
	$str_table_production =  $this->Template->load_table($str_header_production . $str_row_production,array("id"=>"fixed_table"));
	
/***************************************************************************************************************************/
/*									BEGIN: BÁO CÁO NHÂN SỰ															*/
/***************************************************************************************************************************/
?>



<?php
/****************************************************************************************************************************/
/* 									BEGIN: BÁO CÁO NĂNG SUẤT SẢN XUẤT														*/
/****************************************************************************************************************************/
$array_row_production_sx = null;
$str_row_production_sx = "";
if($array_group)
	{
		foreach($array_group as $group)
		{
			
			//BEGIN:Thời gian làm việc
			$name = $group["name"];
			$id_group = $group["id"];
			
			$array_row_production_sx["col1"] = array($name,array());
			$array_row_production_sx["col2"] = array("Thời gian làm việc");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				$array_row_production_sx["col_ngay$i"] = array("",array("id"=>"tglv_".$id_group."_$str_month","class"=>"$class"));
			}
			
			$str_row_production_sx .= $this->Template->load_table_row($array_row_production_sx);
			//END:Dòng thời gian làm việc
			
			//BEGIN:Dòng kế hoạch sản xuất
			$name = $group["name"];
			$id_group = $group["id"];
			
			$array_row_production_sx["col1"] = array("");
			$array_row_production_sx["col2"] = array("KHSX");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				
				
				$array_row_production_sx["col_ngay$i"] = array("",array("id"=>"khsx_".$id_group."_".$str_month,"class"=>"$class"));
			}
			
			$str_row_production_sx .= $this->Template->load_table_row($array_row_production_sx);
			//END:Dòng kế hoạch sản xuất
			
			//BEGIN:Dòng Thực tết làm đươc
			$name = $group["name"];
			$id_group = $group["id"];
			
			$array_row_production_sx["col1"] = array("");
			$array_row_production_sx["col2"] = array("Thực tế làm được");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				
				
				$array_row_production_sx["col_ngay$i"] = array("",array("id"=>"thucte_lam_".$id_group."_".$str_month,"class"=>"$class"));
			}
			
			$str_row_production_sx .= $this->Template->load_table_row($array_row_production_sx);
			//END:Dòng Thực tế làm được
			
			//BEGIN:Dòng leader, định lượng
			$name = $group["name"];
			$id_group = $group["id"];
			
			$array_row_production_sx["col1"] = array("");
			$array_row_production_sx["col2"] = array("Năng suất");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				$array_row_production_sx["col_ngay$i"] = array("",array("id"=>"nangsuat_".$id_group."_".$str_month,"class"=>"$class"));
			}
			
			$str_row_production_sx .= $this->Template->load_table_row($array_row_production_sx);
			//END:Dòng leader, định lượng
			
			//BEGIN: DÒNG VẮNG
			$array_row_production_sx["col1"] = array("");
			$array_row_production_sx["col2"] = array("Số lượng NG");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				$array_row_production_sx["col_ngay$i"] = array("",array("id"=>"soluong_ng_".$id_group."_".$str_month,"class"=>"$class"));
			}
			
			$str_row_production_sx .= $this->Template->load_table_row($array_row_production_sx);
			
			//END: DÒNG VẮNG
			
			//BEGIN: DÒNG VẮNG
			$array_row_production_sx["col1"] = array("");
			$array_row_production_sx["col2"] = array("% NG");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				$array_row_production_sx["col_ngay$i"] = array("",array("id"=>"phantram_ng_".$id_group."_".$str_month,"class"=>"$class"));
			}
			
			$str_row_production_sx .= $this->Template->load_table_row($array_row_production_sx,array("style"=>"border-bottom: solid 3px"));
			
			//END: DÒNG VẮNG
					
		}//END: foreach($array_group as $group)
	}//END: if($array_group)
	
	
	$str_table_production_sx =  $this->Template->load_table($str_header_production . $str_row_production_sx);
	
/****************************************************************************************************************************/
/* 									END: BÁO CÁO NĂNG SUẤT SẢN XUẤT														*/
/****************************************************************************************************************************/
?>

<?php
/****************************************************************************************************************************/
/* 									BEGIN: BÁO CÁO NĂNG SUẤT - MÁY 													*/
/****************************************************************************************************************************/
$array_row_production_machine = null;
$str_row_production_machine = "";
if($array_machine)
	{
		foreach($array_machine as $machine)
		{
			
			//BEGIN: TÊN HANG
			$control = $machine["control"];
			$id_machine = $machine["id"];
			
			$array_row_production_machine["col1"] = array($control,array());
			$array_row_production_machine["col2"] = array("Tên hàng");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				$array_row_production_machine["col_ngay$i"] = array("",array("id"=>"tenhang_".$id_machine."_$str_month","class"=>"$class"));
			}
			
			$str_row_production_machine .= $this->Template->load_table_row($array_row_production_machine);
			//END:DÒNG TÊN HANG
			
			//BEGIN:DONG MÃ HÀNG
			$control = $machine["control"];
			$id_machine = $machine["id"];
	
			$array_row_production_machine["col1"] = array("");
			$array_row_production_machine["col2"] = array("Mã hàng");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				
				
				$array_row_production_machine["col_ngay$i"] = array("",array("id"=>"mahang_".$id_machine."_".$str_month,"class"=>"$class"));
			}
			$str_row_production_machine .= $this->Template->load_table_row($array_row_production_machine);
			//END:DÒNG MÃ HÀNG
			
			//BEGIN:DÒNG KẾ HOẠCH SẢN XUÂT - MÁY
			$control = $machine["control"];
			$id_machine = $machine["id"];
			
			$array_row_production_machine["col1"] = array("");
			$array_row_production_machine["col2"] = array("KHSX");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				
				$array_row_production_machine["col_ngay$i"] = array("",array("id"=>"khsx_may_".$id_machine."_".$str_month,"class"=>"$class"));
			}
			$str_row_production_machine .= $this->Template->load_table_row($array_row_production_machine);
			//END:DÒNG KẾ HOẠCH SẢN XUẤT - MÁY
			
			//BEGIN:DÒNG THỰC TẾ SẢN XUẤT- MÁY
			$control = $machine["control"];
			$id_machine = $machine["id"];
			
			$array_row_production_machine["col1"] = array("");
			$array_row_production_machine["col2"] = array("TTSX");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				$array_row_production_machine["col_ngay$i"] = array("",array("id"=>"thucte_sx_may_".$id_machine."_".$str_month,"class"=>"$class"));
			}
			
			$str_row_production_machine .= $this->Template->load_table_row($array_row_production_machine);
			//END: DÒNG THỰC TẾ SẢN XUẤT - MÁY
			
			//BEGIN: DÒNG NĂNG SUẤT - MÁY
			$array_row_production_machine["col1"] = array("");
			$array_row_production_machine["col2"] = array("Năng suất");
			
			for($i=1; $i<=$songay; $i++)
			{
				$str_month = "$i-".$month;
				$str_month = date("Y-m-d",strtotime($str_month));
				//begin: kiem tra ngay chu nhat
				$timestamp = strtotime($str_month);
				$weekday= date("l", $timestamp );
				$normalized_weekday = strtolower($weekday);
				
				$check = false;
				$class = "";
				if ($normalized_weekday == "sunday") {
				   $check = true;
				} else {
				   $check = false;
				}
				if($check) $class="chu-nhat";
				//begin: kiem tra ngay chu nhat
				$array_row_production_machine["col_ngay$i"] = array("",array("id"=>"nangsuat_may_".$id_machine."_".$str_month,"class"=>"$class"));
			}
			
			$str_row_production_machine .= $this->Template->load_table_row($array_row_production_machine,array("style"=>"border-bottom: solid 3px"));
			//END: DÒNG NĂNG SUẤT - MÁY
					
		}//END: foreach($array_machine as $machine)
	}//END: if($array_machine)
	
	
	$str_table_production_machine =  $this->Template->load_table($str_header_production . $str_row_production_machine,array("id"=>"baocao"));
	
/****************************************************************************************************************************/
/* 									BEGIN: BÁO CÁO NĂNG SUẤT SẢN - MÁY														*/
/****************************************************************************************************************************/

?>
<div class="container_table">
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Báo Cáo Nhân Sự</a></li>
    <li><a href="#tabs-2">Báo Cáo Năng Suất Sản Xuất</a></li>
    <li><a href="#tabs-3">Báo Cáo Năng Suất Máy</a></li>
  </ul>
  <div id="tabs-1" class="scroll-tab-baocao">
  	<?php
		echo $str_table_production;
	?>
  </div>
    <div id="tabs-2" class="scroll-tab-baocao">
  	<?php
		echo $str_table_production_sx;
	?>
  </div>
  <div id="tabs-3" class="scroll-tab-baocao">
  	<?php
		echo $str_table_production_machine;
	?>
  </div>
 </div>

</div>

<script>
 $( function() {
	$( "#month_search" ).datepicker({dateFormat: 'mm-yy'});
	
	show_dulieu();
	show_nhansu();
	show_thoigian_lamviec();
	show_khsx();
	show_nangsuat_may();
 });
 
 	//Lấy liệu sĩ số, hiện diện, vắng của các tổ
 	function show_dulieu()
	{
	
		month 			= "<?php echo $month; ?>";
		$.ajax({ method: "GET", url: "/production/user_production?debug=sql", data: {request: "ajax", month: month}})
		.done(function( str_data ) {
			//alert(str_data);
			//chuyển dữ liệu từ string về kiểu json
			var array_data = $.parseJSON(str_data);
			for (var key in array_data) {
					
				//alert(array_data[key]["id_day"]);
				var id_hiendien = "hd_"+array_data[key]["id_day"];
				var id_vang = "vang_"+array_data[key]["id_day"];
				var siso = "ss_"+array_data[key]["id_day"];
				if(document.getElementById(id_hiendien)) 
				{	
					document.getElementById(id_hiendien).innerHTML = array_data[key]["hiendien"];
					document.getElementById(siso).innerHTML = array_data[key]["siso"];
				}
				if(document.getElementById(id_vang)) 
				{	
					document.getElementById(id_vang).innerHTML = array_data[key]["vang"]+"<span style='font-size:14px; color:red;'><sup>*</sup></span>";
					
					if(array_data[key]["vang"] == "0" || array_data[key]["vang"] == "") document.getElementById(id_vang).innerHTML = "";	
					
				}
			}//END: for (var key in array_data)	
		});
	}
	
	//khi rê chuột vào vào ô ngày có vắng thì sẽ đổi màu ô đó
	function highlight(value_td)
	{
		if(document.getElementById(value_td).innerHTML != "") 
		{
			document.getElementById(value_td).style.cursor = "pointer";
			document.getElementById(value_td).style.backgroundColor = "red";
		}
	}
	
	//khi rê chuột ra thì trở lại màu như bàn đầu
	function highlightOut(value_td)
	{
		document.getElementById(value_td).style.backgroundColor = "";
	}
	
	
	//Khi click vào ô vắng, nếu có công nhân vắng thì sẽ hiển thị lên danh sách công nhân vắng
	function show_vang(value_td)
	{
		//alert(value_td);
		var str_td_vang = document.getElementById(value_td).innerHTML;
		//alert("text: "+str_td_vang);
		
		//lấy chuỗi chứa id_group và ngày
		var fields = value_td.split('_');
		var id_group = fields[1];
		var day = fields[2];
		var str_value = "id_group="+id_group+"&day="+day;
		$.ajax({  method: "GET",  url: "<?php echo $this->webroot;?>production/user_production?"+str_value, data: { act: "show_vang",debug:"code" }}).done(function( data ) 
		{
			if(str_td_vang != "")
			{
				alert(data);
				return;
			}
		});
	}
	
	//Hiển thị dòng tổng nhân sự, hiện diện, vắng
	function show_nhansu()
	{
		
		month 			= "<?php echo $month; ?>";
		$.ajax({ method: "GET", url: "/production/user_production?debug=sql", data: {request: "nhansu", month: month}})
		.done(function( str_data ) {
			//alert(str_data);
			//chuyển dữ liệu từ string về kiểu json
			var array_data = $.parseJSON(str_data);
			
			for (var key in array_data) 
			{
				var id_tong_nhansu = "tong_ns_"+array_data[key]["day"];
				var id_tong_hiendien = "tong_hd_"+array_data[key]["day"];
				var id_tong_vang = "tong_vang_"+array_data[key]["day"];
				if(document.getElementById(id_tong_nhansu)) 
				{	
					document.getElementById(id_tong_nhansu).innerHTML = array_data[key]["nhansu"];
				}
				
				if(document.getElementById(id_tong_hiendien)) 
				{	
					document.getElementById(id_tong_hiendien).innerHTML = array_data[key]["tong_hiendien"];
				}
				
				if(document.getElementById(id_tong_vang)) 
				{	
					document.getElementById(id_tong_vang).innerHTML = array_data[key]["tong_vang"];
				}
			}
		});
	}
	
	
	//Hiển thị thời gian làm việc của cả tổ(báo cáo năng suất sản xuất)
	function show_thoigian_lamviec()
	{
		month 			= "<?php echo $month; ?>";
		$.ajax({ method: "GET", url: "/production/user_production?debug=sql", data: {request: "thoigian_lamviec", month: month}})
		.done(function( str_data ) {
			//alert(str_data);
			//chuyển dữ liệu từ string về kiểu json
			var array_data = $.parseJSON(str_data);
			
			for (var key in array_data) 
			{
				var id_thoigian_lamviec = "tglv_"+array_data[key]["id_day"];
				
				if(document.getElementById(id_thoigian_lamviec)) 
				{	
					document.getElementById(id_thoigian_lamviec).innerHTML = array_data[key]["thoigian_lamviec"];
				}
			}
		});
	}
	
	//Báo cáo năng suất sản xuất
	function show_khsx()
	{
		month 			= "<?php echo $month; ?>";
		$.ajax({ method: "GET", url: "/production/user_production?debug=sql", data: {request: "khsx", month: month}})
		.done(function( str_data ) {
			//alert(str_data);
			//chuyển dữ liệu từ string về kiểu json
			var array_data = $.parseJSON(str_data);
			
			for (var key in array_data) 
			{
				var id_khsx = "khsx_"+array_data[key]["id_day"];
				var id_thucte_lam = "thucte_lam_"+array_data[key]["id_day"];
				var id_soluong_ng = "soluong_ng_"+array_data[key]["id_day"];
				var id_phantram_ng = "phantram_ng_"+array_data[key]["id_day"];
				var id_nangsuat = "nangsuat_"+array_data[key]["id_day"];
				if(document.getElementById(id_khsx)) 
				{	
					document.getElementById(id_khsx).innerHTML =""+ Math.round(parseFloat(array_data[key]["tong_soluong"]));
				}
				if(document.getElementById(id_thucte_lam)) 
				{	
					document.getElementById(id_thucte_lam).innerHTML = array_data[key]["tong_numok"];
				}
				if(document.getElementById(id_soluong_ng)) 
				{	
					document.getElementById(id_soluong_ng).innerHTML = array_data[key]["tong_numng"];
				}
				
				//BEGIN: lấy phần trăm năng suất
				var str_khsx = parseInt(array_data[key]["tong_soluong"]);
				var str_thucte_lam = parseInt(array_data[key]["tong_numok"]);
				//Kiểm tra thực tết làm có lớn hơn 0
				if(str_thucte_lam>0)
				{
				
					var nangsuat = str_thucte_lam/str_khsx * 100;
					if(document.getElementById(id_nangsuat)) 
					{	
						document.getElementById(id_nangsuat).innerHTML = ""+ nangsuat.toFixed(1) +"%";
					}
				}
				//END: Lấy phần trăm năng suât
				
				//BEGIN: lấy phần trăm NG
				var str_soluong_ng = parseInt(array_data[key]["tong_numng"]);
				if(str_soluong_ng >0)
				{
					var phamtram_ng = str_soluong_ng/str_khsx * 100;
					if(document.getElementById(id_phantram_ng)) 
					{	
						document.getElementById(id_phantram_ng).innerHTML = ""+phamtram_ng.toFixed(1) + "%";
					}
				}
				//END: lấy phần trăm NG
			}
		});
	}
	
	//BÁO CÁO NĂNG SUẤT TỪNG MÁY
	function show_nangsuat_may()
	{
		month 			= "<?php echo $month; ?>";
		$.ajax({ method: "GET", url: "/production/user_production?debug=sql", data: {request: "nangsuat_may", month: month}})
		.done(function( str_data ) {
			//alert(str_data);
			var array_data = $.parseJSON(str_data);
			
			for (var key in array_data) 
			{
				//lấy id các dòng báo báo năng suất từng máy
				var id_tenhang = "tenhang_"+array_data[key]["id_day"];
				var id_mahang = "mahang_"+array_data[key]["id_day"];
				var id_khsx_may = "khsx_may_"+array_data[key]["id_day"];
				var id_thucte_sx_may = "thucte_sx_may_"+array_data[key]["id_day"];
				var nangsuat_may = "nangsuat_may_"+array_data[key]["id_day"];
				
				if(document.getElementById(id_tenhang))
				{
					document.getElementById(id_tenhang).innerHTML = array_data[key]["product"];
				}
				if(document.getElementById(id_mahang))
				{
					document.getElementById(id_mahang).innerHTML = array_data[key]["product_code"];
				}	
				if(document.getElementById(id_khsx_may))
				{
					document.getElementById(id_khsx_may).innerHTML = Math.round(parseFloat(array_data[key]["soluong_sx"]));
				}
				if(document.getElementById(id_thucte_sx_may))
				{
					document.getElementById(id_thucte_sx_may).innerHTML = array_data[key]["num_ok"];
				}
				
				//ép dữ liệu sang kiểu Int
				var thucte_may = parseInt(array_data[key]["num_ok"]);
				var khsx_may = parseInt(array_data[key]["soluong_sx"]);
				if(thucte_may >0)
				{
					//document.getElementById(nangsuat_may).innerHTML = "%";
					var str_nangsuat_may = thucte_may/khsx_may * 100;
					if(document.getElementById(nangsuat_may)) 
					{	
						document.getElementById(nangsuat_may).innerHTML = ""+str_nangsuat_may.toFixed(1) + "%";
					}
				}
			}
		});
	}
	
	function show_group()
	{
		document.getElementById("form_seach").submit();
	}
	
</script>