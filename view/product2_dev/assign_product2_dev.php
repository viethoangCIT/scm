<?php
//Begin: Tạo tên tiêu đề
$function_title = "Gán Sản Phẩm Cho Nhân Viên:";
//Dùng hàm load_function_header để tạo tiêu đề
echo $this->Template->load_function_header($function_title);
//End: Tạo tên tiêu đề

// BEGIN: Tạo menu
echo "<ul class='nav nav-tabs'>
    <li><a href='/users/index/$id_user.html' id='menu1'>Thông tin nhân viên</a></li>
    <li><a href='/users/salary/$id_user.html'>Lương</a></li>
    <li><a href='/users/position/$id_user.html'>Chức vụ</a></li>
    <li><a href='/product2/assign?id_user=$id_user'>Sản phẩm</a></li>
  </ul>";
// END: Tạo menu

//Tạo mảng $str_form bằng rỗng
$str_form = "";

//Tạo các biến có giá trị bằng rỗng
$id = "";
$id_product = "";
$day = "";

//kiểm tra xem mảng truy vấn theo id có khác NULL hay không nếu khác NULL thì đi vào câu lệnh if và thực hiện các câu lệnh tiếp theo
if ($array_edit_assign != NULL) {
	//Tạo mảng có phần tử thứ 0 và giá trị cần sửa
	$id = $array_edit_assign[0]["id"];
	$id_product = $array_edit_assign[0]["id_product"];
	$day = $array_edit_assign[0]["day"];
}

//Begin: Tạo form

//Begin: 1.Tạo dòng selectbox nhân viên
//1.1.Dùng hàm load_selectbox của đối tượng Template để tạo selectbox
$array_combo_username = array("name" => "data[id_user]", "style" => "width:150px", "id" => "id_user", "onchange" => "xem()");
$str_combo_username = $this->Template->load_selectbox($array_combo_username, $array_user, $id_user);

//1.2.Tạo dòng chọn selectbox có selectbox là nhân viên
$array_row_username = array("title" => "Nhân viên", "input" => $str_combo_username);
$str_form_content = $this->Template->load_form_row($array_row_username);
//End: 1.Tạo dòng selectbox nhân viên

//Begin: 2.Tạo dòng select sản phẩm
//2.1.Dùng hàm load_selectbox của đối tượng Template để tạo selectbox
$array_combo_product = array("name" => "data[id_product]", "style" => "width:150px");
$str_combo_product = $this->Template->load_selectbox($array_combo_product, $array_product, $id_product);

//2.2.Tạo dòng chọn selectbox có selectbox là sản phẩm
$array_row_product = array("title" => "Sản phẩm", "input" => $str_combo_product);
$str_form_content .= $this->Template->load_form_row($array_row_product);
//End: 2.Tạo dòng select sản phẩm

//Begin: 3.Tạo dòng nhập ngày
//3.1.Dùng hàm load_textbox của đối tượng Template để tạo ô textbox
$array_textbox_day = array("name" => "data[day]", "value" => $day, "id" => "day", "style" => "width:200px");
$str_textbox_day = $this->Template->load_textbox($array_textbox_day);

//3.2.Tạo dòng nhập textbox có textbox là ngày
$array_row_day = array("title" => "Ngày", "input" => $str_textbox_day);
$str_form_content .= $this->Template->load_form_row($array_row_day);
//End: 3.Tạo dòng nhập ngày

$array_hidden_id = array("name" => "data[id]", "value" => $id);
$str_hidden_id = $this->Template->load_hidden($array_hidden_id);

//Begin: Tạo nút lưu
//Dùng hàm load_button của đối tượng Template để tạo nut Lưu
$str_save_button = $this->Template->load_button(array("type" => "submit", "value" => "Lưu"), "Lưu");

//Tạo mảng chứa ô input nút Lưu
$array_row_save = array("title" => "", "input" => $str_save_button . $str_hidden_id);

//Dùng hàm load_form_row của đối tượng Template để tạo dòng nút Lưu
$str_form_content .= $this->Template->load_form_row($array_row_save);
//End: Tạo nút lưu

//gọi hàm load_form của đối tượng Template để lấy thẻ form
$array_form = array("method" => "POST", "action" => "/product2/assign/");

$str_form = $this->Template->load_form($array_form, $str_form_content);

echo $str_form;

//End: Tạo form

//Begin: Tạo bảng

//Begin: Tạo tiêu đề bảng
//Tạo mảng tiêu đề bảng
$array_header_assign["col1"] = array("STT", array("style" => "text-align:center; width:3%"));
$array_header_assign["col3"] = array("Ngày", array("style" => "text-align:center; width:3%"));
$array_header_assign["col4"] = array("Sản phẩm", array("style" => "text-align:center; width:3%"));

$array_header_assign["col5"] = array("Sửa", array("style" => "text-align:center; width:3%"));
$array_header_assign["col6"] = array("Xóa", array("style" => "text-align:center; width:3%"));
//Lấy dòng tr tiêu đề
$str_header_assign = $this->Template->load_table_header($array_header_assign);

//End: Tạo tiêu đề bảng

//Begin:Tạo vòng lặp lưu các giá trị tương ứng
//Khởi tạo $stt bằng 0 tức là id của bảng assign lúc này có giá trị ban đầu là 0
$stt = 0;

//Tạo mảng $str_row_assign có giá trị là rỗng
$str_row_assign = "";

//Kiểm tra mảng $array_assign có khác NULL hay không nếu khác thì đi vào dấu ngoặc và thực hiện công việc tiếp theo
if ($array_assign != NULL) {

	//Dùng vòng lặp foreach để lặp mảng $array_assign lặp số dòng theo cột trong csdl
	foreach ($array_assign as $assign) {
		//id lần lượt tăng lên sau mỗi lần lặp
		$stt++;
		$id_assign = $assign["id"];
		$link_sua = "/product2/assign/$id_assign.html?id_user=$id_user";
		$link_xoa = "/product2/del_assign/$id_assign.html?id_user=$id_user";
		//gọi hàm load_link để tạo link sua
		$link_sua = $this->Template->load_link("edit", "Sửa", $link_sua);

		//gọi hàm load_link để tạo link xóa
		$link_xoa = $this->Template->load_link("del", "Xóa", $link_xoa);

		//Tạo mảng để chứa giá trị lặp theo cột
		$array_row_assign["col1"] = array($stt, array("style" => "text-align:center; width:3%"));
		$array_row_assign["col3"] = array($assign["day"], array("style" => "text-align:center; width:3%"));
		$array_row_assign["col4"] = array($assign["product_name"], array("style" => "text-align:center; width:3%"));
		$array_row_assign["col5"] = array($link_sua, array("style" => "text-align:center; width:3%"));
		$array_row_assign["col6"] = array($link_xoa, array("style" => "text-align:center; width:3%"));

		//gọi hàm $this->Template->load_table_row để tạo cặp thẻ <tr><td></td></tr> từ mảng $array_row_assign
		$str_row_assign .= $this->Template->load_table_row($array_row_assign);
	} //foreach($array_assign as $assign)
} //if($array_assign != NULL)

//End:Tạo vòng lặp lưu các giá trị tương ứng

//Đưa nội dung $str_assign vào thẻ table
$str_table = $this->Template->load_table($str_header_assign . $str_row_assign);
echo $str_table;

//End: Tạo bảng

?>

<script>

	$( "#day" ).datepicker({dateFormat: 'dd-mm-yy'});
	function xem(){

		//Lấy giá trị của đối tượng có id bằng id_user
		var id_user = document.getElementById("id_user").value;

		//thay đổi thuộc tính của đối tượng window
		//chuyển về trang /product2/assign.html?id_user="+id_user
    	window.location.href = "/product2/assign.html?id_user="+id_user;

	}
</script>