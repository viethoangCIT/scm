<style type="text/css">


.tbl_r{


}
.table-responsive{
  width: 1800px;
}

.parent{
  height: auto;
  position: absolute;
  width: 100%;
  left: 0;
  overflow-y:hidden;
}
</style>
<?php
	$title_header = " Danh sách kế hoạch sản xuất";
	echo $this->Template->load_function_header($title_header);

	array_unshift($array_factory,array("id" => "", "name" => "Chọn nhà máy"));
	array_unshift($array_manufactory,array("id" => "", "name" => "Chọn xưởng"));
	array_unshift($array_group,array("id" => "", "name" => "Chọn tổ"));
	array_unshift($array_shift,array("id" => "", "name" => "Chọn ca"));
	array_unshift($array_machine,array("id" => "", "name" => "Chọn máy"));


	$str_textbox_product = $this->Template->load_textbox(array("name"=>"product_name","autocomplete"=>"off","value"=>$product_name,"id"=>"name", "placeholder"=>"Nhập tên sản phẩm"));

	// //load selecbox chọn bộ phận
	$str_selectbox_factory = $this->Template->load_selectbox(array("name" => "id_factory" ,"id" => "id_factory", "style" => "width:100px"), $array_factory, $id_factory);

	// //load selecbox chọn chức vụ
	$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory" ,"id" => "id_manufactory", "style" => "width:100px"), $array_manufactory, $id_manufactory);

	// //load selecbox chọn công việc
	$str_selectbox_group = $this->Template->load_selectbox(array("name" => "id_group" , "id" => "id_group", "style" => "width:100px"), $array_group, $id_group);

	// //load selecbox chọn nhà máy
	$str_selectbox_shift = $this->Template->load_selectbox(array("name" => "id_shift", "id" => "id_shift", "style" => "width:100px"), $array_shift, $id_shift);

	// //load selecbox chọn xưởng
	$str_selectbox_machine = $this->Template->load_selectbox(array("name" => "id_machine" , "id" => "id_machine", "style" => "width:100px"), $array_machine, $id_machine);

	$str_save_button = $this->Template->load_button(array("type" => "sutmit"), "Tìm kiếm");

	$str_input_row = "$str_textbox_product $str_selectbox_factory $str_selectbox_manufactory $str_selectbox_group $str_selectbox_shift $str_selectbox_machine $str_save_button</div>";

	// LOAD FORM
	$str_form_production = $this->Template->load_form(array("method" => "GET", "id" => "form_nhap", "action" => "/production/index_plan"),$str_input_row);
	echo $str_form_production;

	//BEGIN: HEADER
	//TẠO MẢNG HEADER
	$array_header_production = NULL;		
	$array_header_production["col1"] = array("STT", array("align"=>"center","style"=>"width: 20px"));
	$array_header_production["col2"] = array("Tên sản phẩm" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col3"] = array("Nhà máy" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col4"] = array("Xưởng" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col5"] = array("Tổ" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col6"] = array("Ca" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col7"] = array("Máy" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col8"] = array("Số lượng gá" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col9"] = array("Số người làm trên gá" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col10"] = array("Số lượng yêu cầu" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col11"] = array("Năng suất yêu cầu" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col12"] = array("Thời gian bắt đầu" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col13"] = array("Thời gian kết thúc" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col14"] = array("Thời gian thực tế cần thiết" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col15"] = array("Leader" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col16"] = array("Số người kiểm cuối chuyền" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col17"] = array("Số lượng gá kiếm" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col18"] = array("Năng xuất yêu cầu" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col19"] = array("Kế hoạch" , array("align"=>"center", "style"=>"width: 50px"));
	$array_header_production["col20"] = array("Chức năng" , array("align"=>"center", "style"=>"width: 50px"));

	//LOAD HEADER
	$str_header_production = $this->Template->load_table_header($array_header_production);
	//END: HEADER

	//Tạo dòng 
	$str_table_row_production = "";
	$stt = 0;

	if($array_production!=NULL)
	{
		foreach($array_production as $production)
		{
			$stt++;

			$id_production = $production["id"];
			$link_sua = "/production/add_plan/$id_production.html";
			$link_xoa = "/production/del_plan/$id_production.html";

			$link_sua = $this->Template->load_link("edit", "Sửa", $link_sua);
			$link_xoa = $this->Template->load_link("del", "Xóa", $link_xoa);
			$link_action = $link_sua . $link_xoa;

			$array_row_production["col1"] = array($stt, array("align"=>"center","style"=>"width: 20px"));
			$array_row_production["col2"] = array($production["product_name"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col3"] = array($production["factory_name"], array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col4"] = array($production["manufactory_name"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col5"] = array($production["group_name"]  , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col6"] = array($production["shift_name"]  , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col7"] = array($production["machine_name"]  , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col8"] = array($production["soluong"]  , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col9"] = array($production["songuoi"]  , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col10"] = array($production["soluongyeucau"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col11"] = array($production["nangxuatyeucau1"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col12"] = array($production["tgbatdau1"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col13"] = array($production["tgketthuc1"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col14"] = array($production["tgthucte"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col15"] = array($production["leader"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col16"] = array($production["nguoikiemcuoi"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col17"] = array($production["soluonggakiem"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col18"] = array($production["nangxuatyeucau2"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col19"] = array($production["kehoach"] , array("align"=>"center", "style"=>"width: 50px"));
			$array_row_production["col20"] = array($link_action , array("align"=>"center", "style"=>"width: 50px"));

			$str_table_row_production .= $this->Template->load_table_row($array_row_production);

		}
	}

	$str_table_production = $this->Template->load_table($str_header_production . $str_table_row_production);
?>
  <div class="parent">

   <?php
	echo $str_table_production;

?>
 </div>