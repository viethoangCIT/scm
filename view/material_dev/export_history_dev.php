<?php
//*****************************************
//FUNCTION HEADER
//*****************************************

$function_title = "Lịch Sử Xuất Kho";
echo $this->Template->load_function_header($function_title);

//*****************************************
//END FUNCTION HEADER
//*****************************************

//tao mang array chua du lieu table

$str_form_row = "";

$str_input_start_day = $this->Template->load_textbox(array("name" => "start_day", "id" => ""));
// $str_form_row .= $this->Template->load_form_row(array("title" => "Từ ngày", "input" => $str_input_start_day));

$str_input_end_day = $this->Template->load_textbox(array("name" => "start_day", "id" => ""));
// $str_form_row .= $this->Template->load_form_row(array("title" => "Từ ngày", "input" => $str_input_end_day));

$str_save_button = $this->Template->load_button(array("value" => "Lưu", "type" => "submit"), "Lưu");

$str_input_row = "Từ ngày: $str_input_start_day Đến ngày: $str_input_end_day $str_save_button </div>";

$str_form_material = $this->Template->load_form(array("method" => "POST", "action" => "/material/export_history"), $str_input_row);
echo $str_form_material;

$array_table_material_header = array(
	"num" => array("Stt", array("style" => "text-align:center")),
	"code" => array("Mã nhập kho", array("style" => "text-align:center")),
	"kho" => array("kho", array("style" => "text-align:center")),
	"day" => array("Ngày nhập", array("style" => "text-align:center")),
	"user_input" => array("Người nhập", array("style" => "text-align:center")),
	"link" => array("Chi tiết", array("style" => "width:10%;text-align:center")),

);

//goi ham $this->Temlate->load_table_header de tao cap the <tr><td></td></tr>

$str_table_material_header = $this->Template->load_table_header($array_table_material_header);

//lay du lieu array_material dua vao table

$str_table_material_row = "";
if ($array_material) {
	$stt = 0;
	foreach ($array_material as $material) {
		$stt++;
		$array_table_material_row = null;

		//chuyen date_input ve dinh dang ngay thang nam
		$date_input = date("d-m-Y", strtotime($material["day"]));

		$array_table_material_row["num"] = array($stt, array("text-align:center"));
		$array_table_material_row["code"] = array($material["code"], array("text-align:center"));
		$array_table_material_row["kho"] = array("id_warehouse", array("text-align:center"));
		$array_table_material_row["day"] = array($material["day"], array("text-align:center"));
		$array_table_material_row["name"] = array($material["id_user"], array("text-align:center"));
		//tạo linh sửa
		$str_link_edit = $this->Template->load_link("edit", "Chi tiết", "/material/export/" . $material["id"]);
		$array_table_material_row["link"] = array($str_link_edit, array("text-align:center"));
		//su dung ham $this->Teamlate->load_table_row()
		//de tao cap the <tr><td></td></tr> tu mang

		$str_table_material_row .= $this->Template->load_table_row($array_table_material_row, array("align" => "center", "id" => "table_posts"));
	}
}

/* gọi hàm $this->Template->load_table() tạo <table>nội dung là giá trị của biến str_table_material_header</table>
và gán vào chuỗi str_table_material
 */

$str_table_material = $this->Template->load_table($str_table_material_header . $str_table_material_row, array("align" => "left", "id" => "table_posts"));
echo $str_table_material;

?>
