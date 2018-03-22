<?php
//*****************************************
//FUNCTION HEADER
//*****************************************
$function_title = "Nhập khấu trừ bản thân";

//tạo liên kết nhập tin

echo $this->Template->load_function_header($function_title);

//*****************************************
//END FUNCTION HEADER
//*****************************************

//*****************************************
//BEGIN: FORM NHẬP BÀI THI
//*****************************************
//

$id = "";
$thoidiem = "";
$sotien_5 = "";
$sotien_10 = "";
$sotien_15 = "";
$sotien_20 = "";

if ($array_thuesuat != null) {
	$thoidiem = $array_thuesuat[0]["thoidiem"];
	$id = $array_thuesuat[0]["id"];
	$sotien_5 = $array_thuesuat[0]["sotien_5"];
	$sotien_10 = $array_thuesuat[0]["sotien_10"];
	$sotien_15 = $array_thuesuat[0]["sotien_15"];
	$sotien_20 = $array_thuesuat[0]["sotien_20"];

}

//tạo tiêu đề hàm
$str_form_row_thuesuat = "";

//goi ham this->template->load_inout() de tao  string input nhap
$str_input_thoidiem_thuesuat = $this->Template->load_textbox(array("name" => "data[thoidiem]", "value" => $thoidiem, "style" => "width:200px;", "id" => "date_input"));
//tao mot dong nhap ten tai san
$str_form_row_thuesuat .= $this->Template->load_form_row(array("title" => "Thời điểm", "input" => $str_input_thoidiem_thuesuat));

//tao input nhap sotien 5%
$str_input_sotien_thuesuat = $this->Template->load_textbox(array("name" => "data[sotien_5]", "value" => $sotien_5, "style" => "width:200px;"));
//tao dong nhao ten sotien
$str_form_row_thuesuat .= $this->Template->load_form_row(array("title" => "Thuế suất 5%", "input" => $str_input_sotien_thuesuat));

//tao input nhap sotien 10%
$str_input_sotien_thuesuat = $this->Template->load_textbox(array("name" => "data[sotien_10]", "value" => $sotien_10, "style" => "width:200px;"));
//tao dong nhao ten sotien
$str_form_row_thuesuat .= $this->Template->load_form_row(array("title" => "Thuế suất 10%", "input" => $str_input_sotien_thuesuat));

//tao input nhap sotien 15%
$str_input_sotien_thuesuat = $this->Template->load_textbox(array("name" => "data[sotien_15]", "value" => $sotien_15, "style" => "width:200px;"));
//tao dong nhao ten sotien
$str_form_row_thuesuat .= $this->Template->load_form_row(array("title" => "Thuế suất 15%", "input" => $str_input_sotien_thuesuat));

//tao input nhap sotien 20%
$str_input_sotien_thuesuat = $this->Template->load_textbox(array("name" => "data[sotien_20]", "value" => $sotien_20, "style" => "width:200px;"));
//tao dong nhao ten sotien
$str_form_row_thuesuat .= $this->Template->load_form_row(array("title" => "Thuế suất 20%", "input" => $str_input_sotien_thuesuat));

//tao hidden id
$str_hidden_id_thuesuat = $this->Template->load_hidden(array("name" => "data[id]", "value" => $id));

//gọi hàm $this->Template->load_button() để tạo string input type = button, nút bấm để lưu
$str_save_button = $this->Template->load_button(array("value" => "Lưu", "type" => "submit"), "Lưu");

//gọi hàm $this->Template->load_form_row để tạo một dòng có nút lưu
$str_form_row_thuesuat .= $this->Template->load_form_row(array("title" => "", "input" => $str_save_button . $str_hidden_id_thuesuat));

//đưa vào form
$str_form_thuesuat = $this->Template->load_form(array("method" => "POST", "action" => "/tien_thuesuat/add/" . $id), $str_form_row_thuesuat);

echo $str_form_thuesuat;

?>

<script>
    	$(function()
			{
				$( "#date_input" ).datepicker({dateFormat: "dd-mm-yy"})
			});

</script>