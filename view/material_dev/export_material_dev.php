<?php
//FUNCTION HEADER
//========================================================
$function_title = "Xuất Kho";

//tạo liên kết nhập tin
echo $this->Template->load_function_header($function_title);

//========================================================

//lấy mảng array_material_export từ view truyền qua
$id_export = "";
$id_warehouse = "";
$date = "";
$code = "";
$delivery_vans_number = "";
$id_user = "";
if ($array_material_export) {
	$id_export = $array_material_export[0]["id"];
	$id_warehouse = $array_material_export[0]["id_warehouse"];
	$date = $array_material_export[0]["day"];
	$code = $array_material_export[0]["code"];
	$delivery_vans_number = $array_material_export[0]["delivery_vans_number"];
	$id_user = $array_material_export[0]["id_user"];
}
// print_r($array_material_data);

$str_form_row_material = "";
$index = 0;
//gia lập dữ liệu selectbox
$array_warehouse = array("1" => "Kho 1", "2" => "Kho 2", "3" => "Kho 3");
$array_customer = array("1" => "Cty Cao Su", "2" => "Cty Nhựa", "3" => "Cty khác");
$array_user = array("1" => "Admin", "2" => "Nguyễn Văn Nhân", "3" => "Nguyễn Thị Mai");
//load selectbox kho
$str_selectbox_kho_material = $this->Template->load_selectbox_basic(array("name" => "MaterialExport[id_warehouse]", "style" => "width:300px"), $array_warehouse, $id_warehouse);
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Nhập kho", "input" => $str_selectbox_kho_material));

//load input date
$str_input_day_material = $this->Template->load_textbox(array("name" => "MaterialExport[day]", "value" => $date, "id" => "input_date", "style" => "width:200px"));
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Ngày", "input" => $str_input_day_material));

//tao dong chua id an
$str_input_id_material = $this->Template->load_hidden(array("name" => "MaterialExport[id]", "value" => $id_export));

//load input mã phiếu
$str_input_code_material = $this->Template->load_textbox(array("name" => "MaterialExport[code]", "value" => $code, "style" => "width:200px"));
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Mã phiếu nhập", "input" => $str_input_code_material . $str_input_id_material));

//load input số xe
$str_input_delivery_vans_number = $this->Template->load_textbox(array("name" => "MaterialExport[delivery_vans_number]", "value" => $delivery_vans_number, "style" => "width:200px"));
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Số xe", "input" => $str_input_delivery_vans_number));

//load selectbox nguoi nhap
$str_selectbox_user_material = $this->Template->load_selectbox_basic(array("name" => "MaterialExport[id_user]", "style" => "width:300px"), $array_user, $id_user);
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Người nhận", "input" => $str_selectbox_user_material));

$str_save_button = $this->Template->load_button(array("value" => "Lưu", "type" => "submit"), "Lưu");

//BEGIN: tao mang table header
$array_header_material = null;
// $array_header_material["col1"] = array("STT", array("style" => "text-align:left; width:3%"));
$array_header_material["col2"] = array("Mã nguyên liệu", array("style" => "text-align:left; width:8%"));
$array_header_material["col3"] = array("Tên nguyên liệu ", array("style" => "text-align:left; width:8%"));
$array_header_material["col4"] = array("Số lượng", array("style" => "text-align:left; width:8%"));
$array_header_material["col5"] = array("Đơn giá", array("style" => "text-align:left; width:8%"));
$array_header_material["col6"] = array("Xóa", array("style" => "text-align:left; width:8%"));
//End:Tao mang header

//BEGIN: lấy các dòng đã có
$str_export_row = "";
$stt = 0;
if ($array_material_export_detail) {
	foreach ($array_material_export_detail as $material_export_detail) {

		//BEGIN: Lấy thông tin material_export_detail
		$stt++;
		$id_material_export_detail = $material_export_detail["id"];
		$id_material = $material_export_detail["id_material"];
		$id_material_export = $material_export_detail["id_material_export"];
		$material_code = $material_export_detail["code"];
		$material_name = $material_export_detail["material_name"];
		$material_num = $material_export_detail["num"];
		$material_price = $material_export_detail["price"];
		$type = $material_export_detail["type"];
		$status = $material_export_detail["status"];
		//END: lấy thông tin material_export_detail

		//BEGIN: tạo các input và hidden
		//load hidden chua ma code
		$str_hidden_material_code = $this->Template->load_hidden(array("name" => "data[$index][code]", "value" => $material_code, "style" => "width:100px"));
		$str_hidden_id_material = $this->Template->load_hidden(array("name" => "data[$index][id_material]", "value" => $id_material, "style" => "width:100px"));

		$str_hidden_id_material_export = $this->Template->load_hidden(array("name" => "data[$index][id_material_export]", "value" => $id_material_export, "style" => "width:100px"));

		//load hidden chua ten sp
		$str_hidden_material_name = $this->Template->load_hidden(array("name" => "data[$index][material_name]", "value" => $material_name, "style" => "width:100px"));

		//load hidden chua ten sp
		$str_hidden_material_status = $this->Template->load_hidden(array("name" => "data[$index][status]", "value" => $status, "style" => "width:100px"));

		//load input nhập số lượng
		$str_input_material_num = $this->Template->load_textbox(array("name" => "data[$index][num]", "value" => $material_num, "style" => "width:100px"));

		//load input nhập đơn giá
		$str_input_material_price = $this->Template->load_textbox(array("name" => "data[$index][unit_price]", "value" => $material_price, "style" => "width:100px"));

		//tạo link xóa
		$str_link_delete = $this->Template->load_link("del", "Xóa", "/material/del_export/$id_material_export/$id_material_export_detail");

		$str_hidden = $str_hidden_material_code . $str_hidden_material_code . $str_hidden_material_status;
		$str_hidden .= $str_hidden_id_material . $str_hidden_id_material_export;
		//END: tạo các input và hidden

		//BEGIN: tạo mảng để tạo dòng cho bảng
		$array_table_material_row = null;
		// $array_table_material_row["col1"] = array($stt, array("style" => "text-align:center"));
		$array_table_material_row["col2"] = array($material_code, array("style" => "text-align:center"));
		$array_table_material_row["col3"] = array($material_name, array("style" => "text-align:center"));
		$array_table_material_row["col4"] = array($str_input_material_num . $str_hidden, array("text-align:center"));
		$array_table_material_row["col5"] = array($str_input_material_price, array("text-align:center"));
		$array_table_material_row["col6"] = array($str_link_delete, array("style" => "text-align:center"));
		//END :tạo mảng để tạo dòng cho bảng

		$str_export_row .= $this->Template->load_table_row($array_table_material_row);

		$index++;

	} //END: foreach ($array_material_export_detail as $material_export_detail)
} //END: if ($array_material_export_detail
//END: lấy các dòng đã có

// echo "Header:" . $str_export_row;

$str_material_row = "";
//BEGIN: danh sách nguyên liệu
if ($array_material) {
	$stt = 0;
	foreach ($array_material as $material) {
		$stt++;
		$id_material = $material["id"];
		$array_table_material_row = null;

		//load hidden chua ma code
		$str_hidden_code_material = $this->Template->load_hidden(array("name" => "data[$index][code]", "value" => $material["code"], "style" => "width:100px"));
		$str_hidden_id_material = $this->Template->load_hidden(array("name" => "data[$index][id_material]", "value" => $material["id"], "style" => "width:100px"));
		// $str_hidden_id_material_export = $this->Template->load_hidden(array("name" => "data[$index][id]", "value" => $material["id_export_detail"], "style" => "width:100px"));
		$str_hidden_status = $this->Template->load_hidden(array("name" => "data[$index][status]", "value" => "0", "style" => "width:100px", "id" => "status_$id_material"));
		$str_hidden_name_material = $this->Template->load_hidden(array("name" => "data[$index][name]", "value" => "", "style" => "width:100px"));
		$str_input_num_material = $this->Template->load_textbox(array("name" => "data[$index][num]", "value" => "", "style" => "width:100px"));
		$str_input_money_material = $this->Template->load_textbox(array("name" => "data[$index][price]", "value" => "", "style" => "width:100px"));

		$str_hidden = $str_hidden_code_material . $str_hidden_name_material . $str_hidden_status . $str_hidden_id_material;
		$array_table_material_row["col1"] = array($material["code"], array("style" => "text-align:center"));
		$array_table_material_row["col2"] = array($material["name"], array("style" => "text-align:center"));
		$array_table_material_row["col3"] = array($str_input_num_material . $str_hidden, array("text-align:center"));
		$array_table_material_row["col4"] = array($str_input_money_material, array("text-align:center"));
		$str_link_delete = $this->Template->load_link("del", "Xóa", "javascript:hide($id_material)");
		$array_table_material_row["col5"] = array($str_link_delete, array("style" => "text-align:center"));

		$str_material_row .= $this->Template->load_table_row($array_table_material_row, array("id" => "row_$id_material", "class" => "row_tr", "style" => "display:none"));
		$index++;
	} //END: foreach ($array_material_data as $material) {
} //END: if($array_material_rate){
//END: Danh sách nguyên liệu

//đưa phần tử trống vào đầu tiên của mang array_material
$array_material = array("" => array("id" => "", "name" => "Chọn sản phẩm", "code" => "")) + $array_material;

//tạo chuỗi selectbox có dữ liệu array_material
$str_selectbox_material = $this->Template->load_selectbox(array("id" => "id_material", "style" => "width:300px", "onchange" => "show(this.value)"), $array_material);

//tạo dòng để chọn nguyên liệu
$array_table_material_row = null;
$array_table_material_row["material_code"] = array("Chọn nguyên liệu: $str_selectbox_material", array("colspan" => "7"));
$str_last_row = $this->Template->load_table_row($array_table_material_row, array("id" => "table_posts"));

//tạo dòng header
$str_material_header = $this->Template->load_table_header($array_header_material);

$str_material = $this->Template->load_table($str_material_header . $str_export_row . $str_material_row . $str_last_row);
//load form
$str_form_material = $this->Template->load_form(array("method" => "POST", "action" => "/material/export"), $str_form_row_material . $str_material . $str_save_button);
echo $str_form_material;

?>

<script>
    $(function()
	{
		$( "#input_date" ).datepicker({dateFormat: "dd-mm-yy"})
	});

	function show(id_material)
	{
		if(id_material!="")
		{
			document.getElementById("row_"+id_material).style.display = "";
			document.getElementById("status_"+id_material).value = "1";
		}
	}
	function hide(id_material)
	{
		document.getElementById("row_"+id_material).style.display = "none";
		document.getElementById("status_"+id_material).value = "0";
	}

</script>
