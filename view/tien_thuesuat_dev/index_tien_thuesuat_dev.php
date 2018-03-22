<?php
//*****************************************
//FUNCTION HEADER
//*****************************************

$function_title = "Danh Sách Số Tiền Thuế Suất";
echo $this->Template->load_function_header($function_title);

//*****************************************
//END FUNCTION HEADER
//*****************************************

//tao mang array chua du lieu table

$array_table_thuesuat_header = array(
	"num" => array("Stt", array("style" => "text-align:center")),
	"thoidiem" => array("Thời điểm", array("style" => "text-align:center")),
	"sotien_5" => array("Thuế suất 5%", array("style" => "text-align:center")),
	"sotien_10" => array("Thuế suất 10%", array("style" => "text-align:center")),
	"sotien_15" => array("Thuế suất 15%", array("style" => "text-align:center")),
	"sotien_20" => array("Thuế suất 20%", array("style" => "text-align:center")),
	"edit" => array("Sửa", array("style" => "width:10%;text-align:center")),
	"delete" => array("Xóa", array("style" => "width:10%;text-align:center")),

);

//goi ham $this->Temlate->load_table_header de tao cap the <tr><td></td></tr>

$str_table_thuesuat_header = $this->Template->load_table_header($array_table_thuesuat_header);

//lay du lieu array_thuesuat dua vao table

$str_table_thuesuat_row = "";
if ($array_thuesuat != null) {
	$stt = 0;
	foreach ($array_thuesuat as $thuesuat) {
		$stt++;
		$array_table_thuesuat_row = null;

		//chuyen date_input ve dinh dang ngay thang nam
		$date_input = date("d-m-Y", strtotime($thuesuat["thoidiem"]));

		$array_table_thuesuat_row["num"] = array($stt, array("text-align:center"));
		$array_table_thuesuat_row["thoidiem"] = array($thuesuat["thoidiem"], array("text-align:center"));
		$array_table_thuesuat_row["sotien_5"] = array($thuesuat["sotien_5"], array("text-align:center"));
		$array_table_thuesuat_row["sotien_10"] = array($thuesuat["sotien_10"], array("text-align:center"));
		$array_table_thuesuat_row["sotien_15"] = array($thuesuat["sotien_15"], array("text-align:center"));
		$array_table_thuesuat_row["sotien_20"] = array($thuesuat["sotien_20"], array("text-align:center"));
		//tạo linh sửa
		$str_link_edit = $this->Template->load_link("edit", "Sửa", "/tien_thuesuat/add/" . $thuesuat["id"] . ".html");
		$array_table_thuesuat_row["edit"] = array($str_link_edit, array("text-align:center"));

		//tạo link xóa
		$str_link_delete = $this->Template->load_link("del", "Xóa", "/tien_thuesuat/del/" . $thuesuat["id"] . ".html");
		$array_table_thuesuat_row["option"] = array($str_link_delete, array("text-align:center"));

		//su dung ham $this->Teamlate->load_table_row()
		//de tao cap the <tr><td></td></tr> tu mang

		$str_table_thuesuat_row .= $this->Template->load_table_row($array_table_thuesuat_row, array("align" => "center", "id" => "table_posts"));
	}
}

/* gọi hàm $this->Template->load_table() tạo <table>nội dung là giá trị của biến str_table_thuesuat_header</table>
và gán vào chuỗi str_table_thuesuat
 */

$str_table_thuesuat = $this->Template->load_table($str_table_thuesuat_header . $str_table_thuesuat_row, array("align" => "left", "id" => "table_posts"));
echo $str_table_thuesuat;

?>
