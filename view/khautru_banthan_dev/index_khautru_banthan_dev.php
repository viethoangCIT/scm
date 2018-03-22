<?php
//*****************************************
//FUNCTION HEADER
//*****************************************

$function_title = "Danh Sách Khấu Trừ Bản Thân";
echo $this->Template->load_function_header($function_title);

//*****************************************
//END FUNCTION HEADER
//*****************************************

//tao mang array chua du lieu table

$array_table_khautru_header = array(
	"num" => array("Stt", array("style" => "text-align:center")),
	"thoidiem" => array("Thời điểm", array("style" => "text-align:center")),
	"sotien" => array("Số tiền", array("style" => "text-align:center")),
	"edit" => array("Sửa", array("style" => "width:10%;text-align:center")),
	"delete" => array("Xóa", array("style" => "width:10%;text-align:center")),

);

//goi ham $this->Temlate->load_table_header de tao cap the <tr><td></td></tr>

$str_table_khautru_header = $this->Template->load_table_header($array_table_khautru_header);

//lay du lieu array_khautru dua vao table

$str_table_khautru_row = "";
if ($array_khautru != null) {
	$stt = 0;
	foreach ($array_khautru as $khautru) {
		$stt++;
		$array_table_khautru_row = null;

		//chuyen date_input ve dinh dang ngay thang nam
		$date_input = date("d-m-Y", strtotime($khautru["thoidiem"]));

		$array_table_khautru_row["num"] = array($stt, array("text-align:center"));
		$array_table_khautru_row["thoidiem"] = array($khautru["thoidiem"], array("text-align:center"));
		$array_table_khautru_row["sotien"] = array($khautru["sotien"], array("text-align:center"));
		//tạo linh sửa
		$str_link_edit = $this->Template->load_link("edit", "Sửa", "/khautru_banthan/add/" . $khautru["id"] . ".html");
		$array_table_khautru_row["edit"] = array($str_link_edit, array("text-align:center"));

		//tạo link xóa
		$str_link_delete = $this->Template->load_link("del", "Xóa", "/khautru_banthan/del/" . $khautru["id"] . ".html");
		$array_table_khautru_row["option"] = array($str_link_delete, array("text-align:center"));

		//su dung ham $this->Teamlate->load_table_row()
		//de tao cap the <tr><td></td></tr> tu mang

		$str_table_khautru_row .= $this->Template->load_table_row($array_table_khautru_row, array("align" => "center", "id" => "table_posts"));
	}
}

/* gọi hàm $this->Template->load_table() tạo <table>nội dung là giá trị của biến str_table_khautru_header</table>
và gán vào chuỗi str_table_khautru
 */

$str_table_khautru = $this->Template->load_table($str_table_khautru_header . $str_table_khautru_row, array("align" => "left", "id" => "table_posts"));
echo $str_table_khautru;

?>
