<script type="text/javascript">
function kiemtra()
{
	var name = document.getElementById("name");
	var code = document.getElementById("code");
	var bar_code = document.getElementById("bar_code");
	var unit = document.getElementById("unit");
	var quota = document.getElementById("quota");
	if(name.value=="")
	{
		document.getElementById("mate_name1").innerHTML = "Xin nhập tên nguyên liệu!";
		document.getElementById("mate_name1").style.color = "red";
	}
	if(code.value=="")
	{
		document.getElementById("mate_code1").innerHTML = "Xin nhập mã nguyên liệu!";
		document.getElementById("mate_code1").style.color = "red";
	}
	if(bar_code.value=="")
	{
		document.getElementById("mate_bar_code1").innerHTML = "Xin nhập mã vạch!";
		document.getElementById("mate_bar_code1").style.color = "red";
	}
	if(unit.value=="")
	{
		document.getElementById("mate_unit1").innerHTML = "Xin nhập đơn vị tính!";
		document.getElementById("mate_unit1").style.color = "red";
	}
	if(quota.value=="")
	{
		document.getElementById("mate_quota1").innerHTML = "Xin nhập giá mua!";
		document.getElementById("mate_quota1").style.color = "red";
		return;
	}

		document.getElementById("str_form").submit();
}
</script>
<?php
$function_title = "Thêm nguyên liệu";
echo $this->Template->load_function_header($function_title);

$name = $code = $bar_code = $unit = $quota = $id = "";

if ($array_edit_material != NULL) {
	$id = $array_edit_material[0]['id'];
	$name = $array_edit_material[0]['name'];
	$code = $array_edit_material[0]['code'];
	$bar_code = $array_edit_material[0]['bar_code'];
	$unit = $array_edit_material[0]['unit'];
	$quota = $array_edit_material[0]['quota'];
}
$str_input_listmaterial_item_id = $this->Template->load_hidden(array("name" => "id", "value" => $id));
$str_input_listmaterial_item_name = $this->Template->load_textbox(array("name" => "name", "id" => "name", "value" => $name)) . "<span id='mate_name1'></span>";
$str_input_listmaterial_item_code = $this->Template->load_textbox(array("name" => "code", "id" => "code", "value" => $code)) . "<span id='mate_code1'></span>";
$str_input_listmaterial_item_bar_code = $this->Template->load_textbox(array("name" => "bar_code", "id" => "bar_code", "value" => $bar_code)) . "<span id='mate_bar_code1'></span>";
$str_input_listmaterial_item_unit = $this->Template->load_textbox(array("name" => "unit", "id" => "unit", "value" => $unit)) . "<span id='mate_unit1'></span>";
$str_input_listmaterial_item_quota = $this->Template->load_textbox(array("name" => "quota", "id" => "quota", "value" => $quota)) . "<span id='mate_quota1'></span>";
$str_button = $this->Template->load_button(array("name" => "btn", "type" => "button", "style" => "height:30px; width:60px;", "onclick " => "kiemtra()"), "Lưu");

// tạo mảng row
$str_form_listmaterial_item = $this->Template->load_form_row(array("input" => $str_input_listmaterial_item_id));
$str_form_listmaterial_item .= $this->Template->load_form_row(array("title" => "Tên nguyên liệu", "input" => $str_input_listmaterial_item_name));
$str_form_listmaterial_item .= $this->Template->load_form_row(array("title" => "Mã nguyên liệu", "input" => $str_input_listmaterial_item_code));
$str_form_listmaterial_item .= $this->Template->load_form_row(array("title" => "Mã vạch nguyên liệu", "input" => $str_input_listmaterial_item_bar_code));
$str_form_listmaterial_item .= $this->Template->load_form_row(array("title" => "Đơn vị tính", "input" => $str_input_listmaterial_item_unit));
$str_form_listmaterial_item .= $this->Template->load_form_row(array("title" => "Giá mua", "input" => $str_input_listmaterial_item_quota));
$str_form_listmaterial_item .= $this->Template->load_form_row(array("title" => "", "input" => $str_button));
//gắn thẻ form
$str_form = $this->Template->load_form(array("method" => "POST", "action" => "/material/add_material", "id" => "str_form"), $str_form_listmaterial_item);

echo $str_form;
?>


