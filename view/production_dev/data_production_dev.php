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
	$title_header = "Xem Báo Cáo Sản Xuất";
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
	$array_header_production["col9"] = array("Xóa", array("align"=>"center","style"=>"width: 10px"));
	
	//LOAD HEADER
	$str_header_production = $this->Template->load_table_header($array_header_production);
			
	$str_row_production = "";
	
	$stt = 0; 
	if($array_production_data)
	{
		foreach($array_production_data as $production_plan_data)
		{

			$stt++;
			$link_sua = $this->Template->load_link("edit", "Sửa");
			$link_xoa = $this->Template->load_link("del", "Xóa");
			
			$array_row_production = NULL;		
			$array_row_production["col1"] = array($stt, array("align"=>"center","style"=>"width: 5px"));
			$array_row_production["col2"] = array($production_plan_data["machine"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col3"] = array($production_plan_data["product_code"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col4"] = array($production_plan_data["product"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col5"] = array($production_plan_data["time"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col6"] = array($production_plan_data["num_ok"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col7"] = array($production_plan_data["num_ng"], array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col8"] = array($link_sua, array("align"=>"center","style"=>"width: 10px"));
			$array_row_production["col9"] = array($link_xoa, array("align"=>"center","style"=>"width: 10px"));
			
			//LOAD HEADER
			$str_row_production .= $this->Template->load_table_row($array_row_production);
			
						
		}	
	}
	
	
	$str_table_production = $this->Template->load_table($str_header_production . $str_row_production);
		
	
?>

<div class="parent">

   <?php
	echo $str_table_production;

	?>
</div>