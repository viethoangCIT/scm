<?php
//*****************************************
//FUNCTION HEADER
//*****************************************

$function_title = "Danh mục loại ngày công";
echo $this->Template->load_function_header($function_title);

//*****************************************
//END FUNCTION HEADER
//*****************************************


// BEGIN: LOAD HEADER
$array_header_workday = null;
$array_header_workday["col1"] = array("STT", array("style" => "text-align:center;"));
$array_header_workday["col2"] = array("Loại ngày công", array("style" => "text-align:center;width:300px;"));
$array_header_workday["col3"] = array("Mã", array("style" => "text-align:center;"));
$array_header_workday["col4"] = array("Ghi chú", array("style" => "text-align:center;width:300px;"));
$array_header_workday["col5"] = array("Chức năng", array("style" => "text-align:center;width:150px;"));
$str_workday = $this->Template->load_table_header($array_header_workday);
// END: LOAD HEADER

$str_table_workday_row = "";
// BEGIN: TẠO CÁC DÒNG TABLE
if ($array_workday) {
	$stt = 0;
	foreach ($array_workday as $workday) {

		//BEGIN: lấy thông tin loại ngày công
		$workday_name = $workday["name"];
		$workday_code = $workday["code"];
		$workday_desc = $workday["desc"];
		$str_link_edit = $this->Template->load_link("edit", "Sửa", "/type_workday/index/" . $workday["id"] . "&?act=edit");
		$str_link_delete = $this->Template->load_link("del", "Xóa", "/type_workday/index/" . $workday["id"] . "&?act=del");
		
		//END: lấy thông tin loại ngày công

		$array_table_workday_row = null;
		$array_table_workday_row["col1"] = array($stt, array("text-align:center"));
		$array_table_workday_row["col2"] = array($workday_name, array("text-align:left"));
		$array_table_workday_row["col3"] = array($workday_code, array("text-align:left"));
		$array_table_workday_row["col4"] = array($workday_desc, array("text-align:left"));


		$array_table_workday_row["col5"] = array($str_link_edit . $str_link_delete, array("text-align:center"));

		//su dung ham $this->Teamlate->load_table_row()
		//de tao cap the <tr><td></td></tr> tu mang

		$str_table_workday_row .= $this->Template->load_table_row($array_table_workday_row, array("align" => "center", "id" => "table_posts"));
	}
}
// END: TẠO CÁC DÒNG TABLE

//BEGIN: lấy thông tin loại ngày công theo id để sửa
$id = "";
$name = "";
$code = "";
$desc = "";
if($array_edit_workday)
{
	$id = $array_edit_workday[0]["id"];
	$name = $array_edit_workday[0]["name"];
	$code = $array_edit_workday[0]["code"];
	$desc = $array_edit_workday[0]["desc"];
}

//END: lấy thông tin loại ngày công theo id để sửa

// BEGIN: TAO INPUT
$str_hidden_id = $this->Template->load_hidden(array("name" => "data[id]", "value" => $id));
$str_input_name = $this->Template->load_textbox(array("name" => "data[name]", "value" => $name, "style" => "width:300px"));
$str_input_code = $this->Template->load_textbox(array("name" => "data[code]", "value" => $code, "style" => "width:100px"));
$str_input_desc = $this->Template->load_textbox(array("name" => "data[desc]", "value" => $desc, "style" => "width:300px"));

$str_save_button = $this->Template->load_button(array("value" => "Lưu", "type" => "submit"), "Lưu");
// END: TAOJ INPUT


//BEGIN: Tạo dòng nhập
$str_table_workday_row_input="";
$array_table_workday_row_input = null;
$array_table_workday_row_input["col1"] = array("", array("text-align:center"));
$array_table_workday_row_input["col2"] = array($str_input_name, array("text-align:left"));
$array_table_workday_row_input["col3"] = array($str_input_code, array("text-align:left"));
$array_table_workday_row_input["col4"] = array($str_input_desc, array("text-align:left"));
$array_table_workday_row_input["col5"] = array($str_save_button.$str_hidden_id, array("text-align:center"));


$str_table_workday_row_input .= $this->Template->load_table_row($array_table_workday_row_input, array("align" => "center"));
//END: Tạo dòng nhập

//LOAD TABLE
$str_table_workday = $this->Template->load_table($str_workday .$str_table_workday_row_input. $str_table_workday_row);
//echo $str_table_workday;

//LOAD FORM
$str_form_workday = $this->Template->load_form(array("method" => "POST", "action" => "/type_workday/index"), $str_table_workday);
echo $str_form_workday;
?>