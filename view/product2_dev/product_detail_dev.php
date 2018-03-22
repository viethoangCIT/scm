<?php

	//BEGIN: FUNCTION HEADER

	$function_title = "Chi tiết sản phẩm <br>".$product_name;
	echo $this->Template->load_function_header($function_title);
	
$array_header_product_detail = null;
//$array_header_product_detail["col1"] = array("Stt", array("style" => "text-align:left; width:3%"));
$array_header_product_detail["col2"] = array("Tên thuộc tính", array("style" => "text-align:left; width:15%"));
$array_header_product_detail["col3"] = array("Mã", array("style" => "text-align:left; width:8%;white-space: nowrap"));
$array_header_product_detail["col4"] = array("Giá trị", array("style" => "text-align:left; width:7%"));
$array_header_product_detail["col5"] = array("Tuỳ Chọn", array("style" => "text-align:left; width:7%"));

//2: lay html table header product_detail(dong tren cung cua table)
$str_header_product_detail = $this->Template->load_table_header($array_header_product_detail);



$str_row_product_detail = "";

if($array_product_detail)
{
	$stt=0;
	foreach ($array_product_detail as $product_detail) 
	{
		
		$stt++;
		$link_sua="";
		$link_xoa="";
		//tao 1 mang du lieu quan huyen
		$row_product_detail = NULL;
	
		//$row_product_detail["col1"] = array($stt++);
		$row_product_detail["col2"] = array($product_detail["name"]);
		$row_product_detail["col3"] = array($product_detail["code"]);
		$row_product_detail["col4"] = array($product_detail["value"]);
		$row_product_detail["col5"] = array($link_sua . " &nbsp;&nbsp;&nbsp;" . $link_xoa, array("style" => "text-align:center;"));
	
		//tao 1 dong html dua vao mang row_product_detail
		$str_row_product_detail .= $this->Template->load_table_row($row_product_detail);
		//ket thuc tao 1 dong du lieu
	}//END: foreach ($array_product_detail as $product_detail)
}//END: if($array_product_detail)

//BEGIN: HEADER NGUYÊN LIỆU
$str_header_product_rate = "";
$array_header_product_rate = null;
$array_header_product_rate["col2"] = array("Tên nguyên liệu", array("style" => "text-align:left; width:15%"));
$array_header_product_rate["col3"] = array("Mã", array("style" => "text-align:left; width:8%;white-space: nowrap"));
$array_header_product_rate["col4"] = array("Giá trị", array("style" => "text-align:left; width:7%"));
$array_header_product_rate["col5"] = array("Tuỳ Chọn", array("style" => "text-align:left; width:7%"));
$str_header_product_rate = $this->Template->load_table_header($array_header_product_rate);
//END: HEADER NGUYÊN LIỆU

//BEGIN: LOAD ROW NGUYÊN LIỆU
$str_row_product_detail1 = "";
if($array_product_rate)
{
	foreach($array_product_rate as $product_rate)
	{
		$link_sua="";
		$link_xoa="";
		$row_product_detail = NULL;
		//$row_product_detail["col1"] = array($stt++);
		$row_product_detail["col2"] = array($product_rate["material_name"]);
		$row_product_detail["col3"] = array("không có");
		$row_product_detail["col4"] = array($product_rate["num"]." ".$product_rate["unit"]);
		$row_product_detail["col5"] = array($link_sua . " &nbsp;&nbsp;&nbsp;" . $link_xoa, array("style" => "text-align:center;"));
		$str_row_product_detail1 .= $this->Template->load_table_row($row_product_detail);
	}
}
//END: LOAD ROW NGUYÊN LIỆU


//BEGIN: HEADER NHÂN SỰ
$str_header_product_user = "";
$array_header_product_user = null;
$array_header_product_user["col2"] = array("Họ tên", array("style" => "text-align:left; width:15%"));
$array_header_product_user["col3"] = array("Mã", array("style" => "text-align:left; width:8%;white-space: nowrap"));
$array_header_product_user["col4"] = array("Công việc", array("style" => "text-align:left; width:7%"));
$array_header_product_user["col5"] = array("Tuỳ Chọn", array("style" => "text-align:left; width:7%"));
$str_header_product_user = $this->Template->load_table_header($array_header_product_user);
//END: HEADER NHÂN SỰ

//BEGIN: LOAD ROW NHÂN SỰ
$str_row_product_detail2 = "";
if($array_product_user)
{
	foreach($array_product_user as $product_user)
	{
		$link_sua="";
		$link_xoa="";
		$row_product_detail = NULL;
		//$row_product_detail["col1"] = array($stt++);
		$row_product_detail["col2"] = array($product_user["user_fullname"]);
		$row_product_detail["col3"] = array($product_user["user_code"]);
		$row_product_detail["col4"] = array($product_user["work_name"]);
		$row_product_detail["col5"] = array($link_sua . " &nbsp;&nbsp;&nbsp;" . $link_xoa, array("style" => "text-align:center;"));
		$str_row_product_detail2 .= $this->Template->load_table_row($row_product_detail);
	}
}
//END: LOAD ROW NHÂN SỰ

//BEGIN: HEADER MÁY SẢN XUẤT
$str_header_product_machine = "";
$array_header_product_machine = null;
$array_header_product_machine["col2"] = array("Tên máy", array("style" => "text-align:left; width:15%"));
$array_header_product_machine["col3"] = array("Cavity", array("style" => "text-align:left; width:8%;white-space: nowrap"));
$array_header_product_machine["col4"] = array("Cycletime", array("style" => "text-align:left; width:7%"));
$array_header_product_machine["col5"] = array("Tuỳ Chọn", array("style" => "text-align:left; width:7%"));
$str_header_product_machine = $this->Template->load_table_header($array_header_product_machine);
//END: HEADER MÁY SẢN XUẤT

//BEGIN: LOAD ROW MÁY SẢN XUẤT
$str_row_product_detail3 = "";
if($array_product_machine)
{
	foreach($array_product_machine as $product_machine)
	{
		$link_sua="";
		$link_xoa="";
		$row_product_detail = NULL;
		//$row_product_detail["col1"] = array($stt++);
		$row_product_detail["col2"] = array($product_machine["machine_control"]);
		$row_product_detail["col3"] = array($product_machine["cavity"]);
		$row_product_detail["col4"] = array($product_machine["cycletime"]);
		$row_product_detail["col5"] = array($link_sua . " &nbsp;&nbsp;&nbsp;" . $link_xoa, array("style" => "text-align:center;"));
		$str_row_product_detail3 .= $this->Template->load_table_row($row_product_detail);
	}
}
//END: LOAD ROW MÁY SẢN XUẤT

$str_table = $this->Template->load_table($str_header_product_detail . $str_row_product_detail.$str_header_product_rate.$str_row_product_detail1.$str_header_product_user.$str_row_product_detail2.$str_header_product_machine.$str_row_product_detail3);
echo $str_table;
?>