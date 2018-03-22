<?php 
// BEGIN: TITLE
$function_title = "Sửa Lương";
echo $this->Template->load_function_header($function_title);
// END: TITLE

// BEGIN: TABLE HEADER
$str_salary = "";


//tạo mảng table_header_1
$array_header_salary_1 =  null;
$array_header_salary_1["col1"] = array("Mã nhân viên", array("style" => "vertical-align:middle;text-align:center;" ));
$array_header_salary_1["col2"] = array("Họ & tên", array("style" => "vertical-align:middle;text-align:center;" ));
$array_header_salary_1["col3"] = array("Tháng", array("style" => "vertical-align:middle;text-align:center;" ));
$array_header_salary_1["col4"] = array("Lưởng cơ bản", array("style" => "text-align:center;"));
$array_header_salary_1["col5"] = array("Lương trách nhiệm", array("style" => "vertical-align:middle;text-align:center;" ));
$array_header_salary_1["col6"] = array("Phụ cấp lương", array("style" => "vertical-align:middle;text-align:center;" ));
$array_header_salary_1["col7"] = array("Lương kiêm nhiệm", array("style" => "vertical-align:middle;text-align:center;" ));
$array_header_salary_1["col8"] = array("Trợ cấp đi lại", array("style" => "vertical-align:middle;text-align:center;" ));
$array_header_salary_1["col9"] = array("Lương chuyên cần", array("style" => "vertical-align:middle;text-align:center;" ));
$array_header_salary_1["col10"] = array("Phụ cấp điện thoại", array("style" => "vertical-align:middle;text-align:center;" ));
$array_header_salary_1["col11"] = array("Lương đóng bảo hiểm", array("style" => "vertical-align:middle;text-align:center;" ));
$array_header_salary_1["col12"] = array("Số ngày gối đầu", array("style" => "vertical-align:middle;text-align:center;" ));
$array_header_salary_1["col13"] = array("Mức thưởng", array("style" => "vertical-align:middle;text-align:center;" ));

// gọi hàm load_table_header của đối tượng Temblate để lấy chuỗi <tr><td>STT</><td>Mã nhân viên</>...</tr>
$str_salary = $this->Template->load_table_header($array_header_salary_1);


// END LẤY DÒNG TABLE HEADER

// END: TABLE HEADER
//********************************************************************************
$stt = 0;
foreach ($array_edit as $edit)
{
    $thang = date("m-Y",strtotime($edit["thang"]));
	$str_input_id = $this->Template->load_hidden(array("name"=>"data[$stt][id]","id"=>"id","value"=>$edit["id"],"style"=>"width:100px; color:black;font-weight:normal;"));
	$str_input_luong_cb = $this->Template->load_textbox(array("name"=>"data[$stt][luong_coban]","id"=>"luong_coban","style"=>"width:100px","onkeyup" =>"format_number_textbox(this)","value"=>number_format($edit["luong_coban"])));
	$str_input_mucthuong = $this->Template->load_textbox(array("name"=>"data[$stt][mucthuong]","id"=>"mucthuong","style"=>"width:100px","value"=>$edit["mucthuong"]));
	$str_input_trachnhiem = $this->Template->load_textbox(array("name"=>"data[$stt][trachnhiem]","id"=>"trachnhiem","value"=>number_format($edit["trachnhiem"]),"style"=>"width:100px ; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));
	$str_input_phucap_luong = $this->Template->load_textbox(array("name"=>"data[$stt][phucap_luong]","id"=>"phucap_luong","value"=>number_format($edit["phucap_luong"]),"style"=>"width:100px ; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));
	$str_input_kiemnhiem = $this->Template->load_textbox(array("name"=>"data[$stt][kiemnhiem]","id"=>"kiemnhiem","value"=>number_format($edit["kiemnhiem"]),"style"=>"width:100px ; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));	
	$str_input_dilai = $this->Template->load_textbox(array("name"=>"data[$stt][phucap_dilai]","id"=>"phucap_dilai","value"=>number_format($edit["phucap_dilai"]),"style"=>"width:100px ; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));
	$str_input_chuyencan = $this->Template->load_textbox(array("name"=>"data[$stt][chuyencan]","id"=>"chuyencan","value"=>number_format($edit["chuyencan"]),"style"=>"width:100px ; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));
	$str_input_dienthoai = $this->Template->load_textbox(array("name"=>"data[$stt][phucap_dienthoai]","id"=>"phucap_dienthoai","value"=>number_format($edit["phucap_dienthoai"]),"style"=>"width:100px ; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));
	$str_input_luong_dong_bh = $this->Template->load_textbox(array("name"=>"data[$stt][luong_baohiem]","id"=>"luong_baohiem","value"=>number_format($edit["luong_baohiem"]),"style"=>"width:100px ; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));	
	$str_input_songay = $this->Template->load_textbox(array("name"=>"data[$stt][songay]","id"=>"songay","value"=>$edit["songay"],"style"=>"width:100px ; color:black;font-weight:normal;"));
	$str_input_date = $this->Template->load_textbox(array("name"=>"ngay","id"=>"date","value"=>$thang,"style"=>"width:100px ; color:black;font-weight:normal;"));	
	
	$stt++;
	$array_salary = null;
	$array_salary["co11"] = array($edit["user_code"] .$str_input_id , array("style" => "text-align:center;"));
	$array_salary["col2"] = array($edit["full_name"], array("style" => "text-align:center; "));
	$array_salary["col3"] = array($str_input_date, array("style" => "text-align:center; "));
	$array_salary["col4"] = array($str_input_luong_cb , array("style" => "text-align:center;"));
	$array_salary["col6"] = array($str_input_trachnhiem, array("style" => "text-align:center;"));
	$array_salary["col7"] = array($str_input_phucap_luong, array("style" => "text-align:center;"));
	$array_salary["col8"] = array($str_input_kiemnhiem, array("style" => "text-align:center; "));
	$array_salary["col9"] = array($str_input_dilai, array("style" => "text-align:center;"));
	$array_salary["col10"] = array($str_input_chuyencan, array("style" => "text-align:center;"));
	$array_salary["col11"] = array($str_input_dienthoai, array("style" => "text-align:center;"));
	$array_salary["col12"] = array($str_input_luong_dong_bh, array("style" => "text-align:center;"));
	$array_salary["col13"] = array($str_input_songay, array("style" => "text-align:center;"));
	$array_salary["col14"] = array($str_input_mucthuong, array("style" => "text-align:center;"));
	$str_salary .= $this->Template->load_table_row($array_salary);
}
$str_save_button =  $this->Template->load_button(array("type"=>"submit","value"=>"Lưu"),"Lưu");

// gọi hàm load_table của đối tượng Template để tạo ra chuỗi <table>$str_salary</table>
$str_table_salary =  $this->Template->load_table($str_salary);

$str_form_salary = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/add"),$str_table_salary.$str_save_button);
echo $str_form_salary;
?>
<script language="javascript">
	$( function() {
		$( "#date" ).datepicker({dateFormat: "mm-yy"});
	} );

</script>