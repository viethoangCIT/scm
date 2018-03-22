<?php
//*****************************************
//FUNCTION HEADER
//*****************************************

$function_title = "Danh mục ca";
echo $this->Template->load_function_header($function_title);

//*****************************************
//END FUNCTION HEADER
//*****************************************


// BEGIN: LOAD HEADER
$array_header_shift = null;
$array_header_shift["col1"] = array("STT", array("style" => "text-align:center;"));
$array_header_shift["col2"] = array("Ca làm việc", array("style" => "text-align:center;"));
$array_header_shift["col3"] = array("Mã ca", array("style" => "text-align:center;"));
$array_header_shift["col4"] = array("Loại", array("style" => "text-align:center;"));
$array_header_shift["col5"] = array("Thời gian bắt đâu", array("style" => "text-align:center; "));
$array_header_shift["col6"] = array("Thời gian kết thúc", array("style" => "text-align:center; "));
$array_header_shift["col7"] = array("Thời gian đi sớm cho phép", array("style" => "text-align:center; "));
$array_header_shift["col8"] = array("Thời gian về muộn cho phép", array("style" => "text-align:center; "));
$array_header_shift["col9"] = array("Số giờ nghỉ", array("style" => "text-align:center;"));
$array_header_shift["col10"] = array("Ghi chú", array("style" => "text-align:center;"));
$array_header_shift["col11"] = array("Chức năng", array("style" => "text-align:center;"));
$str_shift = $this->Template->load_table_header($array_header_shift);
// END: LOAD HEADER

$str_table_shift_row = "";
// BEGIN: TẠO CÁC DÒNG TABLE
if ($array_data) {
	$stt = 0;
	foreach ($array_data as $data) {

		$stt++;
		$id_shift = $data["id"];
		$shift_name = $data["name"];
		$shift_code = $data["code"];
		$shift_type = $data["type"];
		$shift_start_time = $data["start_time"];
		$shift_end_time = $data["end_time"];
		$shift_start_time_allowed = $data["start_time_allowed"];
		$shift_end_time_allowed = $data["end_time_allowed"];
		$shift_num_hour = $data["num_hour"];
		$shift_desc = $data["desc"];

		$array_table_shift_row = null;
		$array_table_shift_row["col1"] = array($stt, array("text-align:center"));
		$array_table_shift_row["col2"] = array($shift_name, array("text-align:left"));
		$array_table_shift_row["col3"] = array($shift_code, array("text-align:left"));
		$array_table_shift_row["col4"] = array($shift_type, array("text-align:left"));
		$array_table_shift_row["col5"] = array($shift_start_time, array("text-align:center"));
		$array_table_shift_row["col6"] = array($shift_end_time, array("text-align:center"));
		$array_table_shift_row["col7"] = array($shift_start_time_allowed, array("text-align:center"));
		$array_table_shift_row["col8"] = array($shift_end_time_allowed, array("text-align:center"));
		$array_table_shift_row["col9"] = array($shift_num_hour, array("text-align:center"));
		$array_table_shift_row["col10"] = array($shift_desc, array("text-align:center"));

		$str_link_edit = $this->Template->load_link("edit", "Sửa", "/shift_manager/index/" . $data["id"] . "&?act=edit");

		//tạo link xóa
		$str_link_delete = $this->Template->load_link("del", "Xóa", "/shift_manager/index/" . $data["id"] . "&?act=del");
		$array_table_shift_row["col11"] = array($str_link_edit . $str_link_delete, array("text-align:center"));

		//su dung ham $this->Teamlate->load_table_row()
		//de tao cap the <tr><td></td></tr> tu mang

		$str_table_shift_row .= $this->Template->load_table_row($array_table_shift_row, array("align" => "center", "id" => "table_posts"));
	}
}
// END: TẠO CÁC DÒNG TABLE

$id = "";
$name = "";
$code = "";
$type = "";
$start_time = "";
$end_time = "";
$start_time_allowed = "";
$end_time_allowed = "";
$num_hour = "";
$desc = "";
if ($array_edit) {
	$id = $array_edit[0]["id"];
	$name = $array_edit[0]["name"];
	$code = $array_edit[0]["code"];
	$type = $array_edit[0]["type"];
	$start_time = $array_edit[0]["start_time"];
	$end_time = $array_edit[0]["end_time"];
	$start_time_allowed = $array_edit[0]["start_time_allowed"];
	$end_time_allowed = $array_edit[0]["end_time_allowed"];
	$num_hour = $array_edit[0]["num_hour"];
	$desc = $array_edit[0]["desc"];
}

//Tạo array cứng
$array_shift_type = array("lich_dong" => "Lịch động", "HCVP" => "Hành chính văn phòng", "HCSX" => "Hành chính sản xuất", "HC" => "Hành chính");
$str_select_shift_type = $this->Template->load_selectbox_basic(array("name" => "data[type]", "autocomplete" => "off"), $array_shift_type);


// BEGIN: TAO INPUT
$str_input_name = $this->Template->load_textbox(array("name" => "data[name]", "value" => $name, "style" => "width:90px"));
$str_input_code = $this->Template->load_textbox(array("name" => "data[code]", "value" => $code, "style" => "width:90px"));
$str_input_type = $this->Template->load_textbox(array("name" => "data[type]", "value" => $type, "style" => "width:90px"));
$str_input_start_time = $this->Template->load_textbox(array("name" => "data[start_time]", "style" => "width:90px", "id" => "start_time", "value" => $start_time));
$str_input_end_time = $this->Template->load_textbox(array("name" => "data[end_time]", "style" => "width:90px", "id" => "end_time", "value" => $end_time));
$str_input_start_time_allowed = $this->Template->load_textbox(array("name" => "data[start_time_allowed]", "style" => "width:90px", "value" => $start_time_allowed));
$str_input_end_time_allowed = $this->Template->load_textbox(array("name" => "data[end_time_allowed]", "style" => "width:90px", "value" => $end_time_allowed));
$str_input_num_hour = $this->Template->load_textbox(array("name" => "data[num_hour]", "value" => $num_hour, "style" => "width:90px"));
$str_input_desc = $this->Template->load_textbox(array("name" => "data[desc]", "value" => $desc, "style" => "width:100px"));
$str_input_hidden_id = $this->Template->load_hidden(array("name" => "data[id]", "style" => "width:90px", "value" => $id));

$str_save_button = $this->Template->load_button(array("value" => "Lưu", "type" => "submit"), "Lưu");
// END: TAOJ INPUT


//BEGIN: Tạo dòng nhập
$str_table_shift_row_input="";
$array_table_shift_row_input = null;
$array_table_shift_row_input["col1"] = array("", array("text-align:center"));
$array_table_shift_row_input["col2"] = array($str_input_name, array("text-align:left"));
$array_table_shift_row_input["col3"] = array($str_input_code, array("text-align:left"));
$array_table_shift_row_input["col4"] = array($str_select_shift_type, array("text-align:left"));
$array_table_shift_row_input["col5"] = array($str_input_start_time, array("text-align:center"));
$array_table_shift_row_input["col6"] = array($str_input_end_time, array("text-align:center"));
$array_table_shift_row_input["col7"] = array($str_input_start_time_allowed, array("text-align:center"));
$array_table_shift_row_input["col8"] = array($str_input_end_time_allowed, array("text-align:center"));
$array_table_shift_row_input["col9"] = array($str_input_num_hour, array("text-align:center"));
$array_table_shift_row_input["col10"] = array($str_input_desc, array("text-align:center"));
$array_table_shift_row_input["col11"] = array($str_save_button.$str_input_hidden_id, array("text-align:center"));

$str_table_shift_row_input .= $this->Template->load_table_row($array_table_shift_row_input, array("align" => "center"));
//END: Tạo dòng nhập

//LOAD TABLE
$str_table_shift = $this->Template->load_table($str_shift .$str_table_shift_row_input. $str_table_shift_row);
//echo $str_table_shift;

//LOAD FORM
$str_form_shift = $this->Template->load_form(array("method" => "POST", "action" => "/shift_manager/index"), $str_table_shift);
echo $str_form_shift;
?>