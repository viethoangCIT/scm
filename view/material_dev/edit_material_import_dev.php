<?php
//FUNCTION HEADER
//*****************************************
$function_title = "Nhập Kho";

//tạo liên kết nhập tin
echo $this->Template->load_function_header($function_title);

$str_form_row_material = "";
$index = 0;
//gia lập dữ liệu selectbox
$array_warehouse = array("1" => "Kho 1", "2" => "Kho 2", "3" => "Kho 3");
$array_customer = array("1" => "Cty Cao Su", "2" => "Cty Nhựa", "3" => "Cty khác");
$array_user = array("1" => "Admin", "2" => "Nguyễn Văn Nhân", "3" => "Nguyễn Thị Mai");
//load selectbox kho
$str_selectbox_kho_material = $this->Template->load_selectbox_basic(array("name" => "MaterialImport[id_warehouse]", "style" => "width:300px"), $array_warehouse);
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Nhập kho", "input" => $str_selectbox_kho_material));

//load input date
$str_input_day_material = $this->Template->load_textbox(array("name" => "MaterialImport[day]", "value" => "", "id" => "input_date", "style" => "width:200px"));
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Ngày", "input" => $str_input_day_material));

//load input mã phiếu
$str_input_code_material = $this->Template->load_textbox(array("name" => "MaterialImport[form_code]", "value" => "", "style" => "width:200px"));
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Mã phiếu nhập", "input" => $str_input_code_material));

//load selectbox nhà cung cấp
$str_selectbox_supplier_material = $this->Template->load_selectbox_basic(array("name" => "MaterialImport[id_customer]", "style" => "width:300px"), $array_customer);
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Nhà cung cấp", "input" => $str_selectbox_supplier_material));

//load input người giao hàng
$str_input_delivery_man = $this->Template->load_textbox(array("name" => "MaterialImport[delivery_man]", "value" => "", "style" => "width:200px"));
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Người giao hàng", "input" => $str_input_delivery_man));

//load input số xe
$str_input_delivery_vans_number = $this->Template->load_textbox(array("name" => "MaterialImport[delivery_vans_number]", "value" => "", "style" => "width:200px"));
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Số xe", "input" => $str_input_delivery_vans_number));

//load selectbox nguoi nhap
$str_selectbox_user_material = $this->Template->load_selectbox_basic(array("name" => "MaterialImport[id_user]", "style" => "width:300px"), $array_user);
$str_form_row_material .= $this->Template->load_form_row(array("title" => "Người nhận", "input" => $str_selectbox_user_material));

$str_save_button = $this->Template->load_button(array("value" => "Lưu", "type" => "submit"), "Lưu");

//1: tao mang table header
$array_header_material = array(
	"Stt" => array("STT", array("style" => "text-align:left; width:3%")),
	"material_code" => array("Mã nguyên liệu", array("style" => "text-align:left; width:8%")),
	"tennl" => array("Tên nguyên liệu ", array("style" => "text-align:left; width:8%")),
	"num" => array("Số lượng", array("style" => "text-align:left; width:8%")),
	"money" => array("Đơn giá", array("style" => "text-align:left; width:8%")),
	"del" => array("Xóa", array("style" => "text-align:left; width:8%")),
);

$str_table_material_row = "";
//BEGIN: danh sách nguyên liệu
if ($array_material_data) {
	$stt = 0;
	foreach ($array_material_data as $material) {
		$stt++;
		$id_material = $material["id"];
		$array_table_material_row = null;

		$array_table_material_row["Stt"] = array($stt, array("style" => "text-align:center"));
		$array_table_material_row["material_code"] = array($material["code"], array("style" => "text-align:center"));
		$array_table_material_row["tennl"] = array($material["material_name"], array("style" => "text-align:center"));
		//load hidden chua ma code
		$str_hidden_code_material = $this->Template->load_hidden(array("name" => "data[$index][code]", "value" => $material["code"], "style" => "width:100px"));
		$str_hidden_id_material = $this->Template->load_hidden(array("name" => "data[$index][id_material]", "value" => $material["id"], "style" => "width:100px"));
		$str_hidden_status = $this->Template->load_hidden(array("name" => "data[$index][status]", "value" => "0", "style" => "width:100px", "id" => "status_$id_material"));

		//load hidden chua ten sp
		$str_hidden_name_material = $this->Template->load_hidden(array("name" => "data[$index][material_name]", "value" => $material["material_name"], "style" => "width:100px"));

		//load input nhập số lượng
		$str_input_num_material = $this->Template->load_textbox(array("name" => "data[$index][num]", "value" => "", "style" => "width:100px"));
		//load input nhập đơn giá
		$str_input_money_material = $this->Template->load_textbox(array("name" => "data[$index][unit_price]", "value" => "", "style" => "width:100px"));

		$array_table_material_row["num"] = array($str_input_num_material . $str_hidden_code_material . $str_hidden_name_material . $str_hidden_status . $str_hidden_id_material, array("text-align:center"));
		$array_table_material_row["money"] = array($str_input_money_material, array("text-align:center"));

		//tạo link xóa
		$str_link_delete = $this->Template->load_link("del", "Xóa", "javascript:hide($id_material)");
		$array_table_material_row["del"] = array($str_link_delete, array("style" => "text-align:center"));

		$str_table_material_row .= $this->Template->load_table_row($array_table_material_row, array("id" => "row_$id_material", "style" => ""));
		$index++;
	} //END: foreach ($array_material_data as $material) {
} //END: if($array_material_rate){
//END: Danh sách nguyên liệu

//BEGIN: tạo dòng đầu tiên
//$array_material_data = array("" => array("id" => "", "code" => "...")) + $array_material_data;
array_unshift($array_material_data, array("id" => "", "name" => "Chọn sản phẩm", "code" => ""));

$str_selectbox_material = $this->Template->load_selectbox(array("id" => "id_material", "style" => "width:300px", "onchange" => "show(this.value)"), $array_material_data);

$array_table_material_row = null;
$array_table_material_row["material_code"] = array("Chọn nguyên liệu: $str_selectbox_material", array("colspan" => "7"));
$str_first_row = $this->Template->load_table_row($array_table_material_row, array("id" => "table_posts"));
//END: tạo dòng đầu tiên

$str_material = $this->Template->load_table_header($array_header_material);

$str_material = $this->Template->load_table($str_material . $str_first_row . $str_table_material_row);
//load form
$str_form_material = $this->Template->load_form(array("method" => "POST", "action" => "/material/import"), $str_form_row_material . $str_material . $str_save_button);
echo $str_form_material;

?>

<script>
    $(function()
	{
		$( "#input_date" ).datepicker({dateFormat: "dd-mm-yy"})
	});

</script>
