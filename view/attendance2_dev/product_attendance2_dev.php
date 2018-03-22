<style type="text/css">

.table-responsive{
	 width: 100%;

}
.tbl_r{


}
.parent{


    position: absolute;
    width: 100%;
    left: 0;
    overflow:hidden;
}

</style>




<?php

$function_title = " Danh sách chi tiết lương sản phẩm ";

echo $this->Template->load_function_header($function_title);

$str_product = "";

array_unshift($array_department, array("id" => "", "name" => "Chọn phòng ban"));
array_unshift($array_factory, array("id" => "", "name" => "Chọn nhà máy"));
array_unshift($array_work, array("id" => "", "name" => "Chọn công việc"));
array_unshift($array_position, array("id" => "", "name" => "Chọn chức vụ"));
array_unshift($array_manufactory, array("id" => "", "name" => "Chọn phân xưởng"));

if ($date_from != "") {
	$date_from = date("d-m-Y", strtotime($date_from));
}

if ($date_to != "") {
	$date_to = date("d-m-Y", strtotime($date_to));
}

$str_input_from = $this->Template->load_textbox(array("name" => "date_from", "autocomplete" => "off", "value" => $date_from, "id" => "date_from", "class" => "date_from", "style" => "width:100px;"));
$str_input_to = $this->Template->load_textbox(array("name" => "date_to", "autocomplete" => "off", "value" => $date_to, "id" => "date_to", "class" => "date_to", "style" => "width:100px;"));

//--------------------------------------------------
//phong ban

$str_select_department = $this->Template->load_selectbox(array("name" => "id_department", "autocomplete" => "off", "value" => "", "id" => "id_department", "style" => "width:150px"), $array_department, $id_department);
// chức vụ

$str_select_position = $this->Template->load_selectbox(array("name" => "id_position", "autocomplete" => "off", "value" => "", "id" => "id_position", "style" => "width:150px"), $array_position, $id_position);

// lọc theo công việc

$str_select_work = $this->Template->load_selectbox(array("name" => "id_work", "autocomplete" => "off", "value" => "", "id" => "id_work", "style" => "width:150px"), $array_work, $id_work);

// lọc theo nhà máy

$str_select_factory = $this->Template->load_selectbox(array("name" => "id_factory", "autocomplete" => "off", "value" => "", "id" => "id_factory", "style" => "width:150px"), $array_factory, $id_factory);

// lọc theo phân xưởng

$str_select_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "autocomplete" => "off", "value" => "", "id" => "part", "style" => "width:150px"), $array_manufactory, $id_manufactory);

// // $str_btn_save = $this->Template->load_button(array("type"=>"submit",),"<p class = 'text_tk'>Tìm kiếm</p>");
$str_input_name_attendance = $this->Template->load_textbox(array("name" => "name", "autocomplete" => "off", "value" => $name, "id" => "name", "placeholder" => "Nhập tên nhân viên"));

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";

$str_input_attendance_day = "<form action='' method='GET'><div id = 'search_bar' style = 'width:110%;margin-left:10px;'> Từ ngày: $str_input_from Đến ngày:$str_input_to     $str_select_department  $str_select_position  $str_select_work  $str_select_factory  $str_select_manufactory $str_input_name_attendance $str_btn_save</div></form>";

//---------------------------------------------------------------------------

//1: tao mang table header
$array_header_product = array("Stt" => array("STT", array("style" => "text-align:left; width:3%")),
	"ngay" => array("Ngày ", array("style" => "text-align:left; width:5%;white-space: nowrap")),
	"manv" => array("Mã nhân viên ", array("style" => "text-align:left; width:4%;white-space: nowrap")),
	"tennv" => array("Họ & Tên", array("style" => "text-align:center; width:10%;")),
	"chucvu" => array("Chức vụ", array("style" => "text-align:left; width:5%")),
	"masp" => array("Mã sản phẩm", array("style" => "text-align:left; width:3%;white-space: nowrap")),
	"tensp" => array("Tên sản phẩm", array("style" => "text-align:left; width:7%;white-space: nowrap")),
	"dongia" => array("Đơn giá", array("style" => "text-align:left; width:5%")),
	"loai" => array("Loại", array("style" => "text-align:left; width:5%")),
	"soluonglamduoc" => array("Số lượng làm được", array("style" => "text-align:left; width:5%")),
	"nguoi_ga" => array("Người/Gá", array("style" => "text-align:left; width:5%")),
	"thanhtien" => array("Thành tiền", array("style" => "text-align:left; width:7%")),
	"action" => array("Chức năng", array("style" => "text-align:center;width:5%;")),

);

//2: lấy dòng tr header
$str_product = $this->Template->load_table_header($array_header_product);

//link sửa-xóa

$stt = 0;

$array_work_attendance = array("0" => "Ngày công thường", "1" => "Ngày công hết hàng cho về", "2" => "Ngay công hết hàng không lương", "3" => "Ngày nghỉ bảo hiểm hoặc bệnh", "6" => "Ngày công chủ nhật", "7" => "Ngày nghỉ có phép", "8" => "Ngày nghỉ vô phép", "9" => "Ngày không bấm thẻ", "10" => "Ngày công tính tiền sữa", "11" => "Ngày công đi muộn(đủ 8h)");
if ($array_attendance_product) {
	foreach ($array_attendance_product as $product) {
		$stt++;

		$id_product = $product['id'];
		$link_sua = "/attendance2/add_product/$id_product.html";
		$link_xoa = "/attendance2/del3/$id_product.html";
		$link_sua = $this->Template->load_link("edit", "Sửa", $link_sua);
		$link_xoa = $this->Template->load_link("del", "Xóa", $link_xoa);
		$link_action = $link_xoa . $link_sua;

		$str_insert_button = $this->Template->load_button(array("type" => "submit", "onclick" => "them()"), "Thêm");

		$date_product = $product['date'];
		$date_product = date("d-m-Y", strtotime($date_product));
		$thanhtien = $product["price"] * $product["number_work"] / $product["nguoi_ga"];

		//lấy dòng nội dung table
		$array_product1 = array("stt" => array($stt, array("style" => "text-align:left; width:3%")),
			"ngay" => array($date_product, array("style" => "text-align:left; width:5%;white-space: nowrap")),
			"manv" => array($product["user_code"], array("style" => "text-align:left; width:4%;white-space: nowrap")),
			"tennv" => array($product["fullname"], array("style" => "text-align:center; width:10%;")),
			"chucvu" => array($product["position"], array("style" => "text-align:left; width:5%; ")),
			"masp" => array($product["product_code"], array("style" => "text-align:left; width:3%")),
			"tensp" => array($product["product_name"], array("style" => "text-align:left; width:7%")),
			"dongia" => array(number_format($product["price"]), array("style" => "text-align:left; width:7%")),
			"loai" => array($product['type_workday'], array("style" => "text-align:left; width:7%")),
			"soluonglamduoc" => array($product["number_work"], array("style" => "text-align:left; width:4%")),
			"nguoi_ga" => array($product["nguoi_ga"], array("style" => "text-align:left; width:4%")),
			"thanhtien" => array(number_format($thanhtien), array("style" => "text-align:left; width:7%")),
			"action" => array($link_action, array("style" => "text-align:center; ")),
		);
		$str_product .= $this->Template->load_table_row($array_product1);

	}
} //END: if ($array_attendance_product) {
else {
	$array_product1["stt"] = array("Không có dữ liệu",
		array("style" => "text-align:center; width:3%", "colspan" => "13"));

	$str_product .= $this->Template->load_table_row($array_product1);
}

// echo  $str_input_attendance_day;

//Đưa nội dung str_asset vào thẻ table
$str_product = $this->Template->load_table($str_product);

$str_form_product = $this->Template->load_form(array("method" => "POST", "id" => "form_nhap", "action" => "/attendance2/product?debug=code"), $str_product);

?>
<div class="parent">

 <?php
//buoc 5: dung ham load_table đưa dữ liệu vào table
echo $str_input_attendance_day;

echo $str_product;

?>
</div>


<script type="text/javascript">
   $( function() {
    $( "#date_from" ).datepicker({dateFormat: "dd-mm-yy"});
  } );
   $( function() {
    $( "#date_to" ).datepicker({dateFormat: "dd-mm-yy"});
  } );
</script>