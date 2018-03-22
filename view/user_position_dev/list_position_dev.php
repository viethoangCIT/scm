<?php
// BEGIN: Tiêu đề
$function_title = "Thông tin nhân viên: $fullname";
echo $this->Template->load_function_header($function_title);
// END: Tiêu đề

// BEGIN: MENU
echo "<ul class='nav nav-tabs'>
    <li><a href='/users/index/$id_user.html'>Thông tin nhân viên</a></li>
    <li><a href='/users/salary/$id_user.html'>Lương</a></li>
    <li><a href='/users/position/$id_user.html'>Chức vụ</a></li>
    <li><a href='/product2/assign?id_user=$id_user'>Sản phẩm</a></li>
  </ul>";
// END: MENU

// BEGIN: Tiêu đề danh sách chức vụ
// $function_title = "Danh Sách chức vụ";
// echo $this->Template->load_function_header($function_title);
// END: Tiêu đề danh sách chức vụ

// BEGIN: Danh sách chức vụ

$str_position = "";

//1: tao mang table header
$array_header_position = array("Stt" => array("Stt", array("style" => "text-align:left; width:3%")),
	"ten" => array("Tên chức vụ ", array("style" => "text-align:left; width:8%")),

	"factor" => array("Hệ số chứ vụ", array("style" => "text-align:center; width:8%;white-space: nowrap")),
	"date" => array("Ngày chức vụ", array("style" => "text-align:left; width:8%")),

	"chucnang" => array("Chức năng", array("style" => "text-align:left; width:8%")),

);

//2: lấy dòng tr header
$str_position = $this->Template->load_table_header($array_header_position);

//lấy dòng nội dung table
$stt = 0;
if ($array_po_user) {
	foreach ($array_po_user as $user_position) {
		# code...

		$stt++;

		$id_position = $user_position['id'];
		$link_sua = "/user_position/position/$id_user/$id_position.html";
		$link_xoa = "/user_position/del/$id_user/$id_position.html";
		$link_sua = $this->Template->load_link("edit", "Sửa", $link_sua);
		$link_xoa = $this->Template->load_link("del", "Xóa", $link_xoa);
		$link_action = $link_xoa . $link_sua;

		$array_position_1 = array("Stt" => array($stt, array("style" => "text-align:left; width:3%")),
			"ten" => array($user_position['position'], array("style" => "text-align:left; width:10%")),
			"factor" => array($user_position['position_factor'], array("style" => "text-align:center; width:8%;white-space: nowrap")),
			"date" => array($user_position['date'], array("style" => "text-align:left; width:8%")),
			"chucnang" => array($link_action, array("style" => "text-align:center; width:8%")),

		);

		$str_position .= $this->Template->load_table_row($array_position_1);

	}
} else {
	$array_position1["Stt"] = array("Không có dữ liệu", array("style" => "text-align:center", "colspan" => "5"));
	$str_position .= $this->Template->load_table_row($array_position1);
}

//Đưa nội dung str_position vào thẻ table
$str_position = $this->Template->load_table($str_position);
echo $str_position;

// END: Danh sách chức vụ

//tạo tiêu đề hàm
$str_form_position = "";

// tạo tiêu đề hàm
$function_title = "Nhập chức vụ";

$id_position = "";
$id = "";
$position_factor = "";
$date = "";
if ($array_edit_po_user) {
	$id_position = $array_edit_po_user[0]["id_position"];
	$id = $array_edit_po_user[0]["id"];
	$position_factor = $array_edit_po_user[0]["position_factor"];
	$date = $array_edit_po_user[0]["date"];
}

$str_input_id_user = $this->Template->load_hidden(array("name" => "data[id_user]", "id" => "id_user", "value" => $id_user, "style" => "width:300px"));

$str_input_position = $this->Template->load_selectbox(array("name" => "data[id_position]", "id" => "id_position", "style" => "width:300px"), $array_position, $id_position);
$str_input_id = $this->Template->load_hidden(array("name" => "data[id]", "id" => "id", "value" => $id, "style" => "width:300px"));

$str_form_position .= $this->Template->load_form_row(array("title" => "Chức vụ ", "input" => $str_input_position . $str_input_id));

//tạo textbox Hệ số
$str_input_position_price = $this->Template->load_textbox(array("name" => "data[position_factor]", "id" => "position_factor", "value" => $position_factor, "style" => "width:300px"));
$str_form_position .= $this->Template->load_form_row(array("title" => "Hệ số", "input" => $str_input_position_price));

$str_input_date = $this->Template->load_textbox(array("name" => "data[date]", "id" => "date", "value" => $date, "style" => "width:300px"));
$str_form_position .= $this->Template->load_form_row(array("title" => "Ngày", "input" => $str_input_date));

//tạo nút lưu
$str_save_button = $this->Template->load_button(array("type" => "submit", "onclick" => "luu()"), "Lưu");
$str_form_position .= $this->Template->load_form_row(array("title" => "", "input" => $str_save_button));

//đưa vào form
$str_form_position = $this->Template->load_form(array("method" => "POST", "id" => "form_nhap", "action" => "/user_position/position/$id_user"), $str_form_position . $str_input_id_user);
echo $str_form_position;
//*****************************************
//FUNCTION HEADER
//*****************************************

//*****************************************
//END FUNCTION HEADER
//*****************************************

//
?>

	<script type="text/javascript">
       $( function() {
        $( "#date" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
    </script>