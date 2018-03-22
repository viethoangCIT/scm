<?php

//BEGIN: TITLE
//=========================================

$function_title = "Nhập lương gốc nhân viên";
echo $this->Template->load_function_header($function_title);

//=========================================
// END: TITLE

// BEGIN: FORM TÌM KIẾM

array_unshift($array_department, array("id" => "", "name" => "Chọn bộ phận"));
array_unshift($array_position, array("id" => "", "name" => "Chọn chức vụ"));
array_unshift($array_job, array("id" => "", "name" => "Chọn công việc"));
array_unshift($array_factory, array("id" => "", "name" => "Chọn nhà máy"));
array_unshift($array_manufactory, array("id" => "", "name" => "Chọn xưởng"));

// BEGIN FORM TÌM KIẾM
$str_form_search_row = "";

//load selecbox chọn bộ phận
$str_selectbox_department = $this->Template->load_selectbox(array("name" => "id_department", "style" => "width:150px"), $array_department);

//load selecbox chọn chức vụ
$str_selectbox_position = $this->Template->load_selectbox(array("name" => "id_position", "style" => "width:150px"), $array_position);

//load selecbox chọn công việc
$str_selectbox_work = $this->Template->load_selectbox(array("name" => "id_job", "style" => "width:150px"), $array_job);

//load selecbox chọn nhà máy
$str_selectbox_factory = $this->Template->load_selectbox(array("name" => "id_factory", "style" => "width:150px"), $array_factory);

//load selecbox chọn xưởng
$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "style" => "width:150px"), $array_manufactory);

$str_input_name = $this->Template->load_textbox(array("name" => "name", "style" => "width:150px"));

$str_search_button = $this->Template->load_button(array("value" => "Tìm kiếm", "type" => "submit"), "Tìm kiếm");

$str_search_input_row = "$str_selectbox_factory $str_selectbox_manufactory $str_selectbox_position $str_selectbox_work  $str_input_name $str_search_button </div>";

$str_form_search_user_salary = $this->Template->load_form(array("method" => "GET", "action" => "/salary/user_salary"), $str_search_input_row);
echo $str_form_search_user_salary;

// END: FORM TÌM KIẾM

//BEGIN: HEADER
//TẠO MẢNG HEADER
$array_header_user_salary = null;
$array_header_user_salary["col1"] = array("STT", array("style" => "text-align:center;", "rowspan" => "2"));
$array_header_user_salary["col2"] = array("Mã nhân viên", array("style" => "text-align:center;", "rowspan" => "2"));
$array_header_user_salary["col3"] = array("Họ tên", array("style" => "text-align:center;", "rowspan" => "2"));
$array_header_user_salary["col4"] = array("Số CMND", array("style" => "text-align:center; ", "rowspan" => "2"));
$array_header_user_salary["col5"] = array("Số TK", array("style" => "text-align:center; ", "rowspan" => "2"));
$array_header_user_salary["col6"] = array("Phụ cấp", array("style" => "text-align:center;", "colspan" => "3"));
$array_header_user_salary["col7"] = array("Lương cơ bản", array("style" => "text-align:center;", "rowspan" => "2"));

//TẠO MẢNG HEADER2
$array_header_user_salary2["col6_1"] = array("Lương", array("style" => "text-align:center;"));
$array_header_user_salary2["col6_2"] = array("Điện thoại", array("style" => "text-align:center;"));
$array_header_user_salary2["col6_3"] = array("Xăng xe", array("style" => "text-align:center;"));
//END: HEADER

//LOAD HEADER
$str_user_salary = $this->Template->load_table_header($array_header_user_salary);
$str_user_salary .= $this->Template->load_table_header($array_header_user_salary2);

// BEGIN: LOAD ROW TABLE
$str_user_salary_row = "";
if ($array_user2) {
	$stt = 0;
	$index = 0;
	foreach ($array_user2 as $user) {
		$stt++;

		// BEGIN: LẤY THÔNG TIN TỪ MẢNG: array_user
		$user_id = $user["id"];
		$user_code = $user["user_code"];
		$user_fullname = $user["fullname"];
		$user_id_number = $user["id_number"];
		$user_bank_account = $user["bank_account"];
		$user_id_postion = $user["id_position"];
		$user_id_factory = $user["id_factory"];
		$user_id_department = $user["id_department"];
		$user_id_job = $user["id_job"];
		$user_id_manufactory = $user["id_manufactory"];
		$user_phucap_luong = $user["subsidies_salary"];
		$user_luong_coban = $user["salary"];
		$user_phucap_dienthoai = $user["telephone_allowance"];
		$user_phucap_dilai = $user["travel_allowance"];
		// END: ẤY THÔNG TIN TỪ MẢNG: array_user

		//BEGIN: TẠO CÁC INPUT

		//hidden chứa id
		$str_hidden_user_id = $this->Template->load_hidden(array("name" => "data[$index][id_user]", "value" => $user_id));

		// hidden chứa mã nhân viên
		$str_hidden_user_code = $this->Template->load_hidden(array("name" => "data[$index][user_code]", "value" => $user_code));

		// hidden chứa họ tên nhân viên
		$str_hidden_user_fullname = $this->Template->load_hidden(array("name" => "data[$index][user_fullname]", "value" => $user_fullname));

		// hidden chứa số CMND
		$str_hidden_user_id_number = $this->Template->load_hidden(array("name" => "data[$index][id_number]", "value" => $user_id_number));

		//hidden chứa tài khoản ngân hàng
		$str_hidden_user_bank_account = $this->Template->load_hidden(array("name" => "data[$index][bank_account]", "value" => $user_bank_account));

		//hidden chứa id chức vụ
		$str_hidden_user_id_position = $this->Template->load_hidden(array("name" => "data[$index][id_position]", "value" => $user_id_postion));

		//hidden chứa id nhà máy
		$str_hidden_user_id_factory = $this->Template->load_hidden(array("name" => "data[$index][id_factory]", "value" => $user_id_factory));

		//hidden chứa id công việc,bộ phận
		$str_hidden_user_id_department = $this->Template->load_hidden(array("name" => "data[$index][id_department]", "value" => $user_id_department));

		//hidden chứa id công việc
		$str_hidden_user_id_job = $this->Template->load_hidden(array("name" => "data[$index][id_job]", "value" => $user_id_job));

		//hidden chứa id xưởng
		$str_hidden_user_id_manufactory = $this->Template->load_hidden(array("name" => "data[$index][id_manufactory]", "value" => $user_id_manufactory));

		// textbox phụ cấp luong
		$str_input_phucap_luong = $this->Template->load_textbox(array("name" => "data[$index][phucap_luong]", "value" => number_format($user_phucap_luong), "style" => "width:100px", "onkeyup" => "format_number_textbox(this)"));

		// textbox phụ cấp điện thoại
		$str_input_phucap_dienthoai = $this->Template->load_textbox(array("name" => "data[$index][phucap_dienthoai]", "value" => number_format($user_phucap_dienthoai), "style" => "width:100px", "onkeyup" => "format_number_textbox(this)"));

		// textbox phụ cấp xăng xe
		$str_input_phucap_dilai = $this->Template->load_textbox(array("name" => "data[$index][phucap_dilai]", "value" => $user_phucap_dilai, "style" => "width:100px"));

		// textbox lương cơ bản
		$str_input_luong_coban = $this->Template->load_textbox(array("name" => "data[$index][luong_coban]", "value" => $user_luong_coban, "style" => "width:100px"));

		$str_hidden = $str_hidden_user_id . $str_hidden_user_code . $str_hidden_user_fullname;
		$str_hidden .= $str_hidden_user_id_position . $str_hidden_user_id_factory . $str_hidden_user_id_department . $str_hidden_user_id_job . $str_hidden_user_id_manufactory;
		$str_hidden .= $str_hidden_user_id_number . $str_hidden_user_bank_account;
		//END: TẠO CÁC INPUT

		// BEGIN: TẠO MẢNG CHỨA CÁC DÒNG CỦA BẢNG
		$array_table_user_salary_row = null;
		$array_table_user_salary_row["col1"] = array($stt, array("style" => "text-align:center"));
		$array_table_user_salary_row["col2"] = array($user_code . $str_hidden, array("style" => "text-align:center"));
		$array_table_user_salary_row["col3"] = array($user_fullname, array("style" => "text-align:center"));
		$array_table_user_salary_row["col4"] = array($user_id_number, array("style" => "text-align:center"));
		$array_table_user_salary_row["col5"] = array($user_bank_account, array("style" => "text-align:center"));
		$array_table_user_salary_row["col6_1"] = array($str_input_phucap_luong, array("style" => "text-align:center"));
		$array_table_user_salary_row["col6_2"] = array($str_input_phucap_dienthoai, array("style" => "text-align:center"));
		$array_table_user_salary_row["col6_3"] = array($str_input_phucap_dilai, array("style" => "text-align:center"));
		$array_table_user_salary_row["col7"] = array($str_input_luong_coban, array("style" => "text-align:center"));
		// END: TẠO MẢNG CHỨA CÁC DÒNG CỦA BẢNG

		$str_user_salary_row .= $this->Template->load_table_row($array_table_user_salary_row);

		$index++;
	}
}
// END: LOAD ROW TABLE

//LOAD TABLE
$str_table_user_salary = $this->Template->load_table($str_user_salary . $str_user_salary_row);

$str_save_button = $this->Template->load_button(array("type" => "button", "onclick" => "luu()"), "Lưu");

// LOAD FORM
$str_form_user_salary = $this->Template->load_form(array("method" => "POST", "id" => "form_nhap", "action" => "/salary/user_salary"), $str_table_user_salary . $str_save_button);
echo $str_form_user_salary;

?>

<script type="text/javascript">
	function luu()
	{
		document.getElementById('form_nhap').submit();
	}
</script>