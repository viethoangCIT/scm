<?php
$function_title = "Danh Sách Lương";
echo $this->Template->load_function_header($function_title);

//lọc theo phòng ban
array_unshift($array_department, array("id" => "", "name" => "Phòng ban"));
$str_select_department = $this->Template->load_selectbox(array("name" => "id_department", "autocomplete" => "off", "id" => "id_department", "style" => "width:90px"), $array_department, $id_department);

// lọc theo nhà máy
array_unshift($array_factory, array("id" => "", "name" => "Nhà máy"));
$str_select_factory = $this->Template->load_selectbox(array("name" => "id_factory", "autocomplete" => "off", "id" => "id_factory", "style" => "width:90px"), $array_factory, $id_factory);

// lọc theo tổ
array_unshift($array_group, array("id" => "", "name" => "Tổ"));
$str_select_group = $this->Template->load_selectbox(array("name" => "id_group", "autocomplete" => "off", "value" => "", "id" => "id_group", "style" => "width:90px"), $array_group, $id_group);

// lọc theo công việc
array_unshift($array_job, array("id" => "", "name" => "Công việc"));
$str_select_job = $this->Template->load_selectbox(array("name" => "id_job", "autocomplete" => "off", "value" => "", "id" => "id_job", "style" => "width:90px"), $array_job, $id_job);

// lọc theo chức vụ
array_unshift($array_position, array("id" => "", "name" => "Chức vụ"));
$str_select_position = $this->Template->load_selectbox(array("name" => "id_position", "autocomplete" => "off", "id" => "id_position", "style" => "width:90px"), $array_position, $id_position);

// lọc theo phân xưởng
array_unshift($array_manufactory, array("id" => "", "name" => "Phân xưởng"));
$str_select_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "autocomplete" => "off", "id" => "id_manufactory", "style" => "width:90px"), $array_manufactory, $id_manufactory);
$date_from1 = "";
$date_to1 = "";
if ($date_from != "") {
	$date_from1 = date("m-Y", strtotime($date_from));
}

if ($date_to != "") {
	$date_to1 = date("m-Y", strtotime($date_to));
}

$str_input_from = $this->Template->load_textbox(array("name" => "date_from", "autocomplete" => "off", "value" => $date_from1, "id" => "date_from", "class" => "day", "style" => "width:70px; margin-bottom:10px;"));
$str_input_to = $this->Template->load_textbox(array("name" => "date_to", "autocomplete" => "off", "value" => $date_to1, "id" => "date_to", "class" => "day", "style" => "width:70px;"));
$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";
$str_btn_print = "<input type='submit' class=''value='In phiếu lương' style='font-size: 13.4px; margin-top:10px' onclick='xem_phieuluong()'>";
$str_input_name_staff = $this->Template->load_textbox(array("name" => "name", "autocomplete" => "off", "value" => $name, "id" => "name", "placeholder" => "Nhân viên", "style" => "border-radius: 7px;margin-top: 9px; height: 25px; border: 1px solid #aaaaaa;"));
//$str_button_print = $this->Template->load_button(array("value" => "In phiếu lương", "type" => "submit"), "In phiếu lương");


$str_input_attendance_day = "Từ tháng: $str_input_from Đến tháng: $str_input_to $str_select_factory $str_select_manufactory $str_select_group $str_select_position $str_select_job Tên: $str_input_name_staff $str_btn_save $str_btn_print";

$str_form_salary1 = $this->Template->load_form(array("method" => "GET", "id" => "form_nhap", "action" => "","name"=>"form_nhap"), $str_input_attendance_day);

// BEGIN: TABLE HEADER
echo $str_form_salary1;
$str_salary = "";

//tạo mảng table_header_1
$array_header_salary_1 = null;
	$array_header_salary_1["col1"] = array("STT", array("style" => "text-align:center;" ));
	$array_header_salary_1["col2"] = array("Mã nhân viên", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col3"] = array("Họ & tên", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col4"] = array("Tháng", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col5"] = array("Lưởng cơ bản", array("style" => "text-align:center;"));
	$array_header_salary_1["col6"] = array("Lương trách nhiệm", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col7"] = array("Phụ cấp lương", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col8"] = array("Lương kiêm nhiệm", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col9"] = array("Trợ cấp đi lại", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col10"] = array("Lương chuyên cần", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col11"] = array("Phụ cấp điện thoại", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col12"] = array("Lương đóng bảo hiểm", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col13"] = array("Số ngày gối đầu", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col14"] = array("Mức thưởng", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col15"] = array("Chức năng", array("style" => "vertical-align:middle;text-align:center; width:3%"));

// gọi hàm load_table_header của đối tượng Temblate để lấy chuỗi <tr><td>STT</><td>Mã nhân viên</>...</tr>
$str_salary = $this->Template->load_table_header($array_header_salary_1);


// END LẤY DÒNG TABLE HEADER

// END: TABLE HEADER
//********************************************************************************
$str_salary_row = "";
$stt = 0;
if ($array_salary) {
	foreach ($array_salary as $user) {
		$thang = date("m-Y", strtotime($user["thang"]));
		$id = $user["id"];
		$link_sua = "/salary/add/$id.html";
		$link_xoa = "/salary/del_salary/$id.html";
		$link_sua = $this->Template->load_link("edit", "Sửa", $link_sua);
		$link_xoa = $this->Template->load_link("del", "Xóa", $link_xoa);
		$link_action = $link_xoa . $link_sua;
		$str_input_id = $this->Template->load_hidden(array("name" => "id", "id" => "id", "value" => $id, "style" => "width:100px; color:black;font-weight:normal;"));
		$stt++;
		
		$array_salary1 = null;
			$array_salary1["col1"] = array($stt, array("style" => "text-align:center; width:3%"));
			$array_salary1["col2"] = array($user["user_code"], array("style" => "text-align:center; width:8%;"));
			$array_salary1["col3"] = array($user["full_name"], array("style" => "text-align:center; width:8%;"));
			$array_salary1["col4"] = array($thang, array("style" => "text-align:center; width:6%"));
			$array_salary1["col5"] = array(number_format($user["luong_coban"]), array("style" => "text-align:center; width:6%;"));
			$array_salary1["col6"] = array(number_format($user["trachnhiem"]), array("style" => "text-align:center; width:6%;"));
			$array_salary1["col7"] = array(number_format($user["phucap_luong"]), array("style" => "text-align:center; width:6%;"));
			$array_salary1["col8"] = array(number_format($user["kiemnhiem"]), array("style" => "text-align:center; width:6%;"));
			$array_salary1["col9"] = array(number_format($user["phucap_dilai"]), array("style" => "text-align:center; width:6%;"));
			$array_salary1["col10"] = array(number_format($user["chuyencan"]), array("style" => "text-align:center; width:10%;"));
			$array_salary1["col11"] = array(number_format($user["phucap_dienthoai"]), array("style" => "text-align:center; width:10%;"));
			$array_salary1["col12"] = array(number_format($user["luong_baohiem"]), array("style" => "text-align:center; width:6%;"));
			$array_salary1["col13"] = array(number_format($user["songay"]), array("style" => "text-align:center; width:6%;"));
			$array_salary1["col14"] = array($user["mucthuong"], array("style" => "text-align:center; width:10%;"));
			$array_salary1["col15"] = array($link_action, array("style" => "text-align:center; width:10%;"));
		$str_salary_row .= $this->Template->load_table_row($array_salary1);
	}
}//END: if

// END: HIỂN THỊ TẤT CẢ USER

// gọi hàm load_table của đối tượng Template để tạo ra chuỗi <table>$str_salary</table>
$str_table_salary = $this->Template->load_table($str_salary . $str_salary_row);

echo $str_table_salary;
?>
<script language="javascript">
	$( function() {
		$( "#date_from" ).datepicker({dateFormat: "mm-yy"});
		$( "#date_to" ).datepicker({dateFormat: "mm-yy"});
	} );
	function xem_phieuluong()
	{
		document.form_nhap.action = "/salary/salary_sheet";
	}
</script>