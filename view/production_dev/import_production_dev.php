<?php
//*****************************************
//FUNCTION HEADER
//*****************************************
$function_title = "Import Kế hoạch sản xuất ";
echo $this->Template->load_function_header($function_title);
//*****************************************
//END FUNCTION HEADER
//*****************************************

$str_form_customer = "";
//tao dong hinh dai dien
$str_textbox_day = $this->Template->load_textbox(array("name" => "month" ,"id"=>"month","style" => "width:150px"));
$str_form_customer .= $this->Template->load_form_row(array("title" => "Tháng", "input" => $str_textbox_day));

$str_selectbox_factory = $this->Template->load_selectbox(array("name" => "id_factory", "id"=>"id_factory" ,"style" => "width:150px"), $array_factory);
$str_form_customer .= $this->Template->load_form_row(array("title" => "Nhà máy", "input" => $str_selectbox_factory));

$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "id"=>"id_manufactory" ,"style" => "width:150px"),$array_manufactory);
$str_form_customer .= $this->Template->load_form_row(array("title" => "Xưởng", "input" => $str_selectbox_manufactory));

$str_selectbox_cat_product = $this->Template->load_selectbox(array("name" => "id_cat", "id"=>"id_cat" ,"style" => "width:150px"), $array_product_cat);	
$str_form_customer .= $this->Template->load_form_row(array("title" => "Dòng sản phẩm", "input" => $str_selectbox_cat_product));


$str_input_upload = $this->Template->load_textbox(array("name" => "file", "id" => "file", "value" => "", "style" => "width: 80%"));
$str_input_upload .= $this->Template->load_upload_bar("upload_button", "upload_container", "upload_hinhanh1", "list_hinhanh1", "ketqua_upload1");

$str_form_customer .= $this->Template->load_form_row(array("title" => "Upload file", "input" => $str_input_upload));

$str_form_customer .= $this->Template->load_form_row(array("title" => "", "input" => $this->Template->load_button(array("type" => "button","onclick"=>"submit_form()"), "Import")));

$str_form_customer = $this->Template->load_form(array("method" => "GET", "action" => "/production/import", "id"=>"form_import"), $str_form_customer);

echo $str_form_customer;

echo $this->Template->load_upload_js("file", "upload_button", "upload_container", "upload_hinhanh1", "list_hinhanh1", "ketqua_upload1", "uploader1");

?>
<script>
 $( function() {
	$( "#month" ).datepicker({dateFormat: 'mm-yy'});
 });
 
 function submit_form()
{
	if(document.getElementById("month").value == "")
	{
		alert("Vui lòng chọn ngày");
		document.getElementById("month").focus();
		return;
	}
	if(document.getElementById("id_factory").value == "")
	{
		alert("Vui lòng chọn nhà máy");
		document.getElementById("id_factory").focus();
		return;
	}
	if(document.getElementById("id_manufactory").value == "")
	{
		alert("Vui lòng chọn xưởng");
		document.getElementById("id_manufactory").focus();
		return;
	}
	if(document.getElementById("id_cat").value == "")
	{
		alert("Vui lòng chọn dòng sản phẩm");
		document.getElementById("id_cat").focus();
		return;
	}
	else
		document.getElementById("form_import").submit();
}
</script>
