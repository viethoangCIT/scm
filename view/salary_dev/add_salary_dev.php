<style>

#parent {
	min-height: 200px;
	height: 350px;
	position: absolute;
	width: 100%;
	left: 0;
}
.department{
	margin-top: 10px;
}
.search
{

}
</style>
<?php

// BEGIN: TITLE
$function_title = "Nhập lương";
echo $this->Template->load_function_header($function_title);
// END: TITLE

//****************************************************
//BEGIN: SEARCH
array_unshift($array_job, array("id" => "", "name" => "Chọn công việc"));
array_unshift($array_position, array("id" => "", "name" => "Chọn chức vụ"));
array_unshift($array_manufactory, array("id" => "", "name" => "Chọn phân xưởng"));
array_unshift($array_group, array("id" => "", "name" => "Chọn tổ"));
array_unshift($array_department, array("id" => "", "name" => "Chọn phòng ban"));
array_unshift($array_factory, array("id" => "", "name" => "Chọn nhà máy"));
// END TẠO GIÁ TRỊ MẶC ĐỊNH CHO SELECTBOX
// $thang=date("m-Y",strtotime($thang));

$str_input_from = $this->Template->load_textbox(array("name" => "thang", "autocomplete" => "on", "value" => "", "id" => "thang", "class" => "day", "style" => "width:90px; ", "onchange" => "convert()"));
$str_save_button = $this->Template->load_button(array("type" => "submit", "value" => "Lưu"), "Lưu");

$str_select_factory = $this->Template->load_selectbox(array("name" => "id_factory", "autocomplete" => "on", "value" => "", "id" => "id_factory", "style" => "width:130px"), $array_factory, $id_factory);
$str_select_group = $this->Template->load_selectbox(array("name" => "id_group", "autocomplete" => "on", "value" => "", "id" => "id_group", "style" => "width:130px"), $array_group, $id_group);
$str_select_job = $this->Template->load_selectbox(array("name" => "id_job", "autocomplete" => "on", "value" => "", "id" => "id_job", "style" => "width:130px"), $array_job, $id_job);
$str_select_position = $this->Template->load_selectbox(array("name" => "id_position", "autocomplete" => "off", "value" => "", "id" => "id_position", "style" => "width:130px"), $array_position, $id_position);
$str_select_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "autocomplete" => "on", "value" => "", "id" => "id_manufactory", "style" => "width:130px"), $array_manufactory, $id_manufactory);
$str_input_name_staff = $this->Template->load_textbox(array("name" => "name", "autocomplete" => "on", "value" => $name, "id" => "name", "placeholder" => "Nhập tên nhân viên"));
$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";
//END: SEARCH
// BEGIN ĐƯA BỘ LỌC VÀO FORM
$str_input_attendance_day = "Tháng:$str_input_from $str_select_factory $str_select_manufactory $str_select_group $str_select_position  $str_select_job   Tên $str_input_name_staff$str_btn_save </div>";
$str_form_salary1 = $this->Template->load_form(array("method" => "GET", "id" => "form_search", "action" => ''), $str_input_attendance_day);
?>
<div class="search">
	<?php echo $str_form_salary1; ?>
</div>
<?php
// BEGIN ĐƯA BỘ LỌC VÀO FORM

//END: SEARCH
//***************************************************************

//*************************************
// BEGIN: TABLE HEADER
$str_salary = "";

//tạo mảng table_header_1
$array_header_salary_1 = null;
	$array_header_salary_1["col1"] = array("STT", array("style" => "text-align:center;" ));
	$array_header_salary_1["col2"] = array("Mã nhân viên", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col3"] = array("Họ & tên", array("style" => "vertical-align:middle;text-align:center;" ));
	$array_header_salary_1["col4"] = array("Nhà máy", array("style" => "vertical-align:middle;text-align:center;" ));
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
	
// gọi hàm load_table_header của đối tượng Temblate để lấy chuỗi <tr><td>STT</><td>Mã nhân viên</>...</tr>
$str_salary .= $this->Template->load_table_header($array_header_salary_1);

// END LẤY DÒNG TABLE HEADER

// END: TABLE HEADER
//********************************************************************************
$tmp = "";
// BEGIN:HIỂN THỊ TẤT CẢ USER
$str_salary_row="";
$stt = 0;
if ($array_user) {
	foreach ($array_user as $user) {
		//Kiểm tra nếu chưa có users trong bảng lương thì hiển thị
	
		$user_luong_coban = number_format($user["salary"]);
		$user_phucap_dienthoai = number_format($user["telephone_allowance"]);
		$user_luong_trachnhiem = number_format($user["responsibility"]);
		$user_kiemnhiem = number_format($user["concurrently"]);
		$user_chuyencan = number_format($user["diligence"]);
		$user_phucap_dilai = number_format($user["travel_allowance"]);
		$user_luong_baohiem = number_format($user["insurrance"]);
		$user_luong_phucap = number_format($user["subsidies_salary"]);
		$str_phucap_dienthoai = $this->Template->load_textbox(array("name" => "data[$stt][phucap_dienthoai]", "value" => $user_phucap_dienthoai, "id" => "phucap_dienthoai", "style" => "width:80px", "onkeyup" => "format_number_textbox(this)"));
		$str_phucap_dilai = $this->Template->load_textbox(array("name" => "data[$stt][phucap_dilai]", "value" => $user_phucap_dilai, "id" => "phucap_dilai", "style" => "width:80px", "onkeyup" => "format_number_textbox(this)"));
		$str_chuyencan = $this->Template->load_textbox(array("name" => "data[$stt][chuyencan]", "value" => $user_chuyencan, "id" => "luong_chuyencan", "style" => "width:80px", "onkeyup" => "format_number_textbox(this)"));
		$str_mucthuong = $this->Template->load_textbox(array("name" => "data[$stt][mucthuong]", "id" => "mucthuong", "style" => "width:40px","onkeyup" => "format_number_textbox(this)"));
		$str_input_luong_cb = $this->Template->load_textbox(array("name" => "data[$stt][luong_coban]", "id" => "luong_coban", "value" => $user_luong_coban, "style" => "width:80px", "onkeyup" => "format_number_textbox(this)"));
		$str_input_trachnhiem = $this->Template->load_textbox(array("name" => "data[$stt][trachnhiem]", "id" => "trachnhiem", "value" => $user_luong_trachnhiem, "style" => "width:80px ; color:black;font-weight:normal;", "onkeyup" => "format_number_textbox(this)"));
		$str_input_phucap_luong = $this->Template->load_textbox(array("name" => "data[$stt][phucap_luong]", "id" => "phucap_luong", "value" => $user_luong_phucap, "style" => "width:80px ; color:black;font-weight:normal;", "onkeyup" => "format_number_textbox(this)"));
		$str_input_kiemnhiem = $this->Template->load_textbox(array("name" => "data[$stt][kiemnhiem]", "id" => "kiemnhiem", "value" => $user_kiemnhiem, "style" => "width:80px ; color:black;font-weight:normal;", "onkeyup" => "format_number_textbox(this)"));
		$str_input_luong_dong_bh = $this->Template->load_textbox(array("name" => "data[$stt][luong_baohiem]", "id" => "luong_baohiem", "value" => $user_luong_baohiem, "style" => "width:80px ; color:black;font-weight:normal;", "onkeyup" => "format_number_textbox(this)"));
		$str_input_songay = $this->Template->load_textbox(array("name" => "data[$stt][songay]", "id" => "songay", "value" => "", "style" => "width:40px ; color:black;font-weight:normal;","onkeyup" => "format_number_textbox(this)"));
		$str_input_code = $this->Template->load_hidden(array("name" => "data[$stt][user_code]", "id" => "user_code", "value" => $user['user_code'], "style" => "width:80px; color:black;font-weight:normal;"));
		$str_input_fullname = $this->Template->load_hidden(array("name" => "data[$stt][full_name]", "id" => "full_name", "value" => $user["fullname"], "style" => "width:80px ; color:black;font-weight:normal;"));
		$str_input_id_number = $this->Template->load_hidden(array("name" => "data[$stt][id_number]", "id" => "id_number", "value" => $user["id_number"], "style" => "width:80px ; color:black;font-weight:normal;"));
		$str_input_bank_account = $this->Template->load_hidden(array("name" => "data[$stt][bank_account]", "id" => "bank_account", "value" => $user["bank_account"], "style" => "width:80px ; color:black;font-weight:normal;"));
		$str_input_id_user = $this->Template->load_hidden(array("name" => "data[$stt][id_user]", "id" => "id_user", "value" => $user["id"], "style" => "width:80px ; color:black;font-weight:normal;"));
		$str_input_id_department = $this->Template->load_hidden(array("name" => "data[$stt][id_department]", "id" => "id_department", "value" => $user['id_department'], "style" => "width:80px; color:black;font-weight:normal;"));
		$str_input_id_factory = $this->Template->load_hidden(array("name" => "data[$stt][id_factory]", "id" => "id_factory", "value" => $user["id_factory"], "style" => "width:80px ; color:black;font-weight:normal;"));
		$str_input_id_job = $this->Template->load_hidden(array("name" => "data[$stt][id_job]", "id" => "id_number", "value" => $user["id_job"], "style" => "width:80px ; color:black;font-weight:normal;"));
		$str_input_id_manufactory = $this->Template->load_hidden(array("name" => "data[$stt][id_manufactory]", "id" => "id_manufactory", "value" => $user["id_manufactory"], "style" => "width:80px ; color:black;font-weight:normal;"));
		$str_input_id_position = $this->Template->load_hidden(array("name" => "data[$stt][id_position]", "id" => "id_position", "value" => $user["id_position"], "style" => "width:80px ; color:black;font-weight:normal;"));
		
		
		$stt++;
		$array_salary =  null;
			$array_salary["col1"] = array($stt . $str_input_code . $str_input_fullname, array("style" => "text-align:center;"));
			$array_salary["col2"] = array($user["user_code"] . $str_input_id_number, array("style" => "text-align:center;"));
			$array_salary["col3"] = array($user["fullname"] . $str_input_bank_account, array("style" => "text-align:center; "));
			$array_salary["col4"] = array($user["factory"]."->".$user["manufactory"] . $str_input_id_user, array("style" => "text-align:center;"));
			$array_salary["col5"] = array($str_input_luong_cb . $str_input_id_factory, array("style" => "text-align:center;"));
			$array_salary["col6"] = array($str_input_trachnhiem . $str_input_id_job, array("style" => "text-align:center;"));
			$array_salary["col7"] = array($str_input_phucap_luong . $str_input_id_manufactory, array("style" => "text-align:center;"));
			$array_salary["col8"] = array($str_input_kiemnhiem, array("style" => "text-align:center; "));
			$array_salary["col9"] = array($str_phucap_dilai, array("style" => "text-align:center;"));
			$array_salary["col10"] = array($str_chuyencan . $str_input_id_position, array("style" => "text-align:center;"));
			$array_salary["col11"] = array($str_phucap_dienthoai, array("style" => "text-align:center;"));
			$array_salary["col12"] = array($str_input_luong_dong_bh, array("style" => "text-align:center;"));
			$array_salary["col13"] = array($str_input_songay, array("style" => "text-align:center;"));
			$array_salary["col14"] = array($str_mucthuong, array("style" => "text-align:center;"));
		$str_salary_row .= $this->Template->load_table_row($array_salary);
		
	}//END:for
}//END: if

$str_input_ngay = $this->Template->load_hidden(array("name" => "ngay", "id" => "ngay", "value" => "", "style" => "width:80px ; color:black;font-weight:normal;"));

// END: HIỂN THỊ TẤT CẢ USER

$str_save_button = $this->Template->load_button(array("type" => "button", "onclick" => "luu()"), "Lưu");
// gọi hàm load_table của đối tượng Template để tạo ra chuỗi <table>$str_salary</table>
$str_table_salary = $this->Template->load_table($str_salary.$str_salary_row);

$str_form_salary = $this->Template->load_form(array("method" => "POST", "id" => "form_nhap", "action" => "/salary/add"), $str_input_ngay.$str_table_salary . $str_save_button );
echo $str_form_salary;

?>
<script language="javascript">
	$( function() {
		$( "#thang" ).datepicker({dateFormat: "mm-yy"});
	} );

</script>
<script type="text/javascript">
	function convert(){
		document.getElementById('ngay').value = document.getElementById('thang').value;
	}
	function luu()
	{
		if (document.getElementById('thang').value == "")
		{
			alert("Xin vui lòng chọn tháng");
			document.getElementById('thang').focus();
			return;
		}
		document.getElementById('form_nhap').submit();
	}
</script>