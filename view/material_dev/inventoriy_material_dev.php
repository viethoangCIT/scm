<?php
//*****************************************
//FUNCTION HEADER
//*****************************************

$function_title = "Danh Sách Tồn Kho";
echo $this->Template->load_function_header($function_title);

//*****************************************
//END FUNCTION HEADER
//*****************************************

//tao mang array chua du lieu table

//form tìm kiếm

$array_warehouse = array("1" => "Kho 1", "2" => "Kho 2", "3" => "Kho 3");
// $array_customer = array("1" => "Cty Cao Su", "2" => "Cty Nhựa", "3" => "Cty khác");
$array_user = array("1" => "Admin", "2" => "Nguyễn Văn Nhân", "3" => "Nguyễn Thị Mai");
//load selectbox kho

$str_selectbox_kho_data = $this->Template->load_selectbox_basic(array("name" => "data[id_warehouse]", "style" => "width:200px"), $array_warehouse, $id_warehouse);

$str_input_start_day = $this->Template->load_textbox(array("name" => "data[start_day]", "id" => "start_date", "value" => $start_day));
// $str_form_row .= $this->Template->load_form_row(array("title" => "Từ ngày", "input" => $str_input_start_day));

$str_input_end_day = $this->Template->load_textbox(array("name" => "data[end_day]", "id" => "end_date", "value" => $end_day));
// $str_form_row .= $this->Template->load_form_row(array("title" => "Từ ngày", "input" => $str_input_end_day));

$str_save_button = $this->Template->load_button(array("value" => "Tim", "type" => "submit"), "Tìm");

//tao link tai excel
$str_link_excel = $this->Template->load_link("edit", "Xuất excel", "/material/excel?id_warehouse=$id_warehouse&start_day=$start_day&end_day=$end_day");

$str_input_row = "<div style='float:left'>Từ ngày: $str_input_start_day Đến ngày: $str_input_end_day $str_save_button</div> <div style='float:left; margin-left:10px'>$str_link_excel</div> ";

$str_form_data = $this->Template->load_form(array("method" => "GET", "action" => "", "id" => "form_function"), $str_input_row);
echo $str_form_data;

$array_table_data_header = array(
	"num" => array("Stt", array("style" => "width:1%;text-align:center")),
	"name" => array("Tên Hàng", array("style" => "text-align:left")),
	"code" => array("Mã Hàng", array("style" => "text-align:left")),
	"num_import" => array("Số lượng nhập", array("style" => "text-align:left")),
	"num_export" => array("Số lượng xuất", array("style" => "text-align:left")),
	"rest" => array("Số lượng còn", array("style" => "text-align:left"))
);

//goi ham $this->Temlate->load_table_header de tao cap the <tr><td></td></tr>

$str_table_data_header = $this->Template->load_table_header($array_table_data_header);

//lay du lieu array_data dua vao table

$str_table_data_row = "";
if ($array_data != null) {
	$stt = 0;
	foreach ($array_data as $data) {
		$stt++;
		$array_table_data_row = null;
		
		$ton = $data["tong_nhap"]-  $data["tong_xuat"];
		$array_table_data_row["num"] = array($stt, array("text-align:center"));
		$array_table_data_row["name"] = array($data["name"], array("text-align:left"));
		$array_table_data_row["code"] = array($data["code"], array("text-align:left"));
		$array_table_data_row["num_import"] = array($data["tong_nhap"], array("text-align:center"));
		$array_table_data_row["num_export"] = array($data["tong_xuat"], array("text-align:center"));
		$array_table_data_row["rest"] = array(number_format($ton), array("text-align:center"));


		//su dung ham $this->Teamlate->load_table_row()
		//de tao cap the <tr><td></td></tr> tu mang

		$str_table_data_row .= $this->Template->load_table_row($array_table_data_row, array("align" => "center", "id" => "table_posts"));
	}
}

/* gọi hàm $this->Template->load_table() tạo <table>nội dung là giá trị của biến str_table_data_header</table>
và gán vào chuỗi str_table_data
 */

$str_table_data = $this->Template->load_table($str_table_data_header . $str_table_data_row, array("align" => "left", "id" => "table_posts"));
echo $str_table_data;

?>
<script type="text/javascript">
	$(function()
	{
		$( "#start_date" ).datepicker({dateFormat: "yy-mm-dd"});
		$( "#end_date" ).datepicker({dateFormat: "yy-mm-dd"});
	});
    function submit_form()
    {
        document.getElementById("form_function").submit();

    }
</script>