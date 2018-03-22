<?php
//*****************************************
//FUNCTION HEADER
//*****************************************
$function_title = "Dữ liệu chấm công";

//tạo liên kết nhập tin

echo $this->Template->load_function_header($function_title);

//*****************************************
//END FUNCTION HEADER
//*****************************************

//*****************************************
//BEGIN: FORM NHẬP BÀI THI
//*****************************************
//
//Bảng chọn lịch làm việc
$array_work_shift = array("1" => "Lịch động", "ca1_8h" => "Ca 1 8h", "ca2_8h" => "Ca 2 8h", "ca3_8h" => "Ca 3 8h", "ca1_12h" => "Ca 1 12h", "ca2_12h" => "Ca 2 12h", "ca3_12h" => "Ca 3 12h", "hanhchinh" => "Hành chính 7h-15h30", "hanhchinh_vp" => "Hành chính văn phòng", "hanhchinh_sx" => "Hành chính sản xuất");

$array_table_header_chamcong = null;
$str_table_row_chamcong = "";
$array_table_header_chamcong["col1"] = array("Mã nhân viên", array("style" => "text-align:center"));
$array_table_header_chamcong["col2"] = array("Họ và tên", array("style" => "text-align:center"));
$array_table_header_chamcong["col3"] = array("Ngày điểm danh", array("style" => "text-align:center;width:110px", "nowrap" => "nowrap"));
$array_table_header_chamcong["col4"] = array("Giờ bắt đầu", array("style" => "text-align:center;width:70px"));
$array_table_header_chamcong["col5"] = array("Giờ kết thúc", array("style" => "text-align:center;width:70px"));
$array_table_header_chamcong["col6"] = array("Số giờ", array("style" => "text-align:center;width:70px"));

//$array_table_header_chamcong["col7"] = array("Lịch làm việc", array("style" => "text-align:center;width:200px"), "nowrap" => "nowrap");
$array_table_header_chamcong["col8"] = array("Loại ngày công", array("style" => "text-align:center;width:300px"), "nowrap" => "nowrap");

//buoc 2: dung hàm load_table_header de lay template table header
$str_table_header_chamcong = $this->Template->load_table_header($array_table_header_chamcong);

$id = "";
$id_user = "";
$ma_nv = "";
$fullname = "";
$day = "";
$start_time = "";
$end_time = "";
$hour = "";
$day_type = "";

if ($array_chamcong) {
	$id = $array_chamcong[0]["id"];
	$ma_nv = $array_chamcong[0]["user_code"];
	$id_user = $array_chamcong[0]["id_user"];
	$fullname = $array_chamcong[0]["user_fullname"];
	$day = $array_chamcong[0]["day"];
	$start_time = $array_chamcong[0]["start_time"];
	$end_time = $array_chamcong[0]["end_time"];
	$hour = $array_chamcong[0]["hour"];
	$day_type = $array_chamcong[0]["day_type"];

	$str_hidden_id_user = $this->Template->load_hidden(array("name" => "data[id_user]", "value" => $id_user, "id" => "id_user"));
	$str_hidden_user_code = $this->Template->load_hidden(array("name" => "data[user_code]", "value" => $ma_nv));
	$str_hidden_id = $this->Template->load_hidden(array("name" => "data[id]", "value" => $id));

// dùng hàm load table row để lấy nội dung cho bảng
	$array_table_row_chamcong = null;

	$array_table_row_chamcong["col1"] = array($ma_nv . $str_hidden_id . $str_hidden_id_user . $str_hidden_user_code, array("style" => "text-align:center"));

	$array_table_row_chamcong["col2"] = array($fullname, array("style" => "text-align:center"));

	$str_input_day = $this->Template->load_hidden(array("name" => "data[day]", "value" => $day, "id" => "day"));
	$array_table_row_chamcong["col3"] = array(date("d-m-Y",strtotime($day)).$str_input_day, array("style" => "text-align:center"));

	$str_input_start_time = $this->Template->load_textbox(array("name" => "data[start_time]", "value" => $start_time, "id" => "start_time", "style" => "width: 70px"));
	$array_table_row_chamcong["col4"] = array($str_input_start_time, array("style" => "text-align:center"));

	$str_input_endtime = $this->Template->load_textbox(array("name" => "data[end_time]", "value" => $end_time, "id" => "end_time","onchange"=>"tinh_gio()", "style" => "width: 70px"));
	$array_table_row_chamcong["col5"] = array($str_input_endtime, array("style" => "text-align:center"));

//Tạo text box chứa số giờ
	$str_input_time = $this->Template->load_textbox(array("name" => "data[hour]", "value" => $hour, "id" => "time", "style" => "width: 70px"));
	$array_table_row_chamcong["col6"] = array($str_input_time, array("style" => "text-align:center"));
	
	$str_select_day_type = $this->Template->load_selectbox(array("name" => "data[day_type]", "autocomplete" => "on", "value" => "", "id" => "day_type"), $array_typework,$day_type);
	$array_table_row_chamcong["col7"] = array($str_select_day_type, array("style" => "text-align:center"));

	$str_table_row_chamcong .= $this->Template->load_table_row($array_table_row_chamcong);
}
$str_table_chamcong = $this->Template->load_table($str_table_header_chamcong . $str_table_row_chamcong);

$str_btn_save = $this->Template->load_button(array("type" => "submit"), "Lưu");

// dùng hàm load_form để lấy html cho form
$str_form = $this->Template->load_form(array("action" => "/attendance2/edit", "method" => "post", "id" => "form_staff"), $str_table_chamcong . $str_btn_save);
echo $str_form;
?>

<script>
    	$(function()
			{
				$( "#date_input" ).datepicker({dateFormat: "dd-mm-yy"})
			});
	var str_ngay_chamcong = document.getElementById('day').value;
	function tinh_gio()
	{
		//lấy giờ bắt đầu khi gõ vào ô textbox giờ bắt đầu
		var start_time = document.getElementById('start_time').value;
		var str_ngaygio_batdau = str_ngay_chamcong+" "+ start_time;
		
		//chuyển sang kiểu giờ
	    var bits = str_ngaygio_batdau.split(/\D/);
	    var gio_batdau = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);
		
		//Lấy giờ kết thúc khi gõ vào ô textbox giờ kết thúc
		var end_time = document.getElementById("end_time").value;
		var str_ngaygio_ketthuc = str_ngay_chamcong+" "+ end_time;

		var bits = str_ngaygio_ketthuc.split(/\D/);
	    var gio_ketthuc = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

		if(gio_ketthuc<gio_batdau)	gio_ketthuc.setDate(gio_ketthuc.getDate() + 1);
		
		//tính số giờ làm việc
		var so_milligiay_lamviec = Math.abs(gio_ketthuc - gio_batdau);

        var sophut_lamviec = so_milligiay_lamviec/1000/60;
		
		//tính số giờ giữa giờ bắt đầu và giờ kết thúc
        var sogio = Math.floor(sophut_lamviec/60);
        var so_phut =sophut_lamviec%60;
		
		//nếu số phút lớn hơn 30 thì tăng 0.5 giờ làm việc
        if(so_phut>=30) sogio += 0.5;

        document.getElementById('time').value= ""+sogio;
		
	}

</script>