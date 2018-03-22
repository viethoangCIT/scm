<?php
//1: tao mang table header position
$array_header_position = array("Stt" => array("Stt", array("style" => "text-align:left; width:3%")),
	"ten" => array("Tên chức vụ", array("style" => "text-align:left; width:15%")),
	"ma" => array("Mã", array("style" => "text-align:center; width:8%;white-space: nowrap")),
	"mota" => array("Mô tả", array("style" => "text-align:left; width:8%")),
	"order_number" => array("Thứ tự sắp xếp", array("style" => "text-align:left; width:8%")),
	"tuychon" => array("Tuỳ Chọn", array("style" => "text-align:left; width:7%")),

);

//2: lay html table header position(dong tren cung cua table)
$str_header_position = $this->Template->load_table_header($array_header_position);

//*****************************************************
//3: lay du lieu quan huyen tu Controler dua qua de xu ly
$stt = 1;
$str_row_position = "";
foreach ($array_position as $position) {

	//tao 1 mang du lieu quan huyen
	$row_position = NULL;

	$row_position["stt"] = array($stt++);
	$row_position["ten"] = array($position["name"]);
	$row_position["ma"] = array($position["code"], array("style" => "text-align:center;"));
	$row_position["mota"] = array($position["desc"]);
	$row_position["order_number"] = array($position["order_number"]);

	//lay link sua position
	$code = $position["code"];
	$name = $position["name"];
	$desc = $position["desc"];
	$order_number = $position["order_number"];
	$id = $position["id"];

	$link_sua = "javascript:void(0)\" onclick=\"xem_form('$name','$code','$desc','$order_number','$id')";
	$link_sua = $this->Template->load_link("edit", "Sửa", $link_sua);

	//lay link xoa & tao the href & dua vao cell
	//$link_xoa	= $this->Html->link(array("controller"=>"position","action"=>"xoa","params"=>array($position["id"],"index"),"ext"=>"html"));
	$link_xoa = $this->Template->load_link("del", "Xóa", "javascript:void(0)' onclick='xoa(\"$id\")");
	$row_position["tuychon"] = array($link_sua . $link_xoa, array("style" => "text-align:center;"));

	//tao 1 dong html dua vao mang row_position
	$str_row_position .= $this->Template->load_table_row($row_position);
	//ket thuc tao 1 dong du lieu
}
//4: lay html cua table
$str_position = $this->Template->load_table($str_header_position . $str_row_position);
echo $str_position;

?>
