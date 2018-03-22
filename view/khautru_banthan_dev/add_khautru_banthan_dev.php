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
$sotien = "";

if ($array_khautru != null) {
	$thoidiem = $array_khautru[0]["thoidiem"];
	$id = $array_khautru[0]["id"];
	$sotien = $array_khautru[0]["sotien"];

}

//tạo tiêu đề hàm
$str_form_row_khautru = "";

//goi ham this->template->load_inout() de tao  string input nhap
$str_input_thoidiem_khautru = $this->Template->load_textbox(array("name" => "data[thoidiem]", "value" => $thoidiem, "style" => "width:200px;", "id" => "date_input"));
//tao mot dong nhap ten tai san
$str_form_row_khautru .= $this->Template->load_form_row(array("title" => "Thời điểm", "input" => $str_input_thoidiem_khautru));

//tao input nhap sotien
$str_input_sotien_khautru = $this->Template->load_textbox(array("name" => "data[sotien]", "value" => $sotien, "style" => "width:200px;"));
//tao dong nhao ten sotien
$str_form_row_khautru .= $this->Template->load_form_row(array("title" => "Số tiền", "input" => $str_input_sotien_khautru));

//tao hidden id
$str_hidden_id_khautru = $this->Template->load_hidden(array("name" => "data[id]", "value" => $id));

//gọi hàm $this->Template->load_button() để tạo string input type = button, nút bấm để lưu
$str_save_button = $this->Template->load_button(array("value" => "Lưu", "type" => "submit"), "Lưu");

//gọi hàm $this->Template->load_form_row để tạo một dòng có nút lưu
$str_form_row_khautru .= $this->Template->load_form_row(array("title" => "", "input" => $str_save_button . $str_hidden_id_khautru));

//đưa vào form
$str_form_khautru = $this->Template->load_form(array("method" => "POST", "action" => "/khautru_banthan/add"), $str_form_row_khautru);

echo $str_form_khautru;

?>

<script>
    	$(function()
			{
				$( "#date_input" ).datepicker({dateFormat: "dd-mm-yy"})
			});

</script>