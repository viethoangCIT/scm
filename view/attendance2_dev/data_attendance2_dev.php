<?php
//*****************************************
//FUNCTION HEADER

//tieu de cua ham
$function_title = "Dữ liệu chấm công";
$demo = "<p id='demo'></p>";
echo $this->Template->load_function_header($function_title . $demo);

$str_form_attendance_content = "";
$str_form_attendance_find = "";

array_unshift($array_position, array("id" => "", "name" => "Chọn chức vụ"));
array_unshift($array_job, array("id" => "", "name" => "Chọn bộ phận"));
array_unshift($array_factory, array("id" => "", "name" => "Chọn nhà máy"));
array_unshift($array_manufactory, array("id" => "", "name" => "Chọn xưởng"));
array_unshift($array_group, array("id" => "", "name" => "Chọn tổ"));

//BEGIN: TÌM KIẾM

$str_input_day = $this->Template->load_textbox(array("name" => "date", "autocomplete" => "off", "value" => $str_date, "id" => "attendance_day", "style" => "width:100px; border:1px solid #ff631d!imoprtant;border-radius: 0px !important;"));

//load selecbox chọn chức vụ
$str_selectbox_position = $this->Template->load_selectbox(array("name" => "id_position", "style" => "width:140px"), $array_position, $id_position);

//load selecbox chọn bộ phận
$str_selectbox_job = $this->Template->load_selectbox(array("name" => "id_job", "style" => "width:140px"), $array_job, $id_job);

//load selecbox chọn nhà máy
$str_selectbox_factory = $this->Template->load_selectbox(array("name" => "id_factory", "style" => "width:140px"), $array_factory, $id_factory);

//load selecbox chọn xưởng
$str_selectbox_manufactory = $this->Template->load_selectbox(array("name" => "id_manufactory", "style" => "width:140px"), $array_manufactory, $id_manufactory);

//load selecbox chọn tổ
$str_selectbox_group = $this->Template->load_selectbox(array("name" => "id_group", "style" => "width:140px"), $array_group, $id_group);

$str_search_input_user = $this->Template->load_textbox(array("name" => "name", "style" => "width:140px", "placeholder" => "Nhập nhân viên"));

$str_search_button = $this->Template->load_button(array("value" => "Tìm kiếm", "type" => "submit"), "Tìm kiếm");

$str_search_input_row = "Ngày: $str_input_day $str_selectbox_factory $str_selectbox_manufactory $str_selectbox_position $str_selectbox_job $str_selectbox_group $str_search_input_user $str_search_button </div>";

$str_form_attendance_find = $this->Template->load_form(array("method" => "GET", "action" => "/attendance2/data"), $str_search_input_row);
echo $str_form_attendance_find;

//END: TÌM KIẾM

//str_form_attendance_content = <div><input name = attendance_day, value = "", id = "attendance_day">
//<button type = submit> Tìm kiếm </button> </div>

//nhãn danh sách nhân viên
// lọc theo
// phòng ban
$arrray_deparment = array("0" => "BGĐ-Ban giám đốc", "1" => "ISO-Quy trình", "3" => "PRO-Sản xuất", "4" => "HR-Nhân sự", "5" => "QC-Chất lượng", "6" => "PE-Kỹ thuật", "7" => "PUR-Mua hàng", "8" => "SALE-Kinh doanh", "9" => "WH-Kho");
$str_select_department = $this->Template->load_selectbox_basic(array("name" => "department", "autocomplete" => "off", "value" => "", "id" => "department"), $arrray_deparment);

// lọc theo nhà máy
$arrray_factory = array("0" => "SCM1", "1" => "SCM2", "2" => "SCM3");
$str_select_factory = $this->Template->load_selectbox_basic(array("name" => "factory", "autocomplete" => "off", "value" => "", "id" => "factory"), $arrray_factory);

// lọc theo công việc
$array_work = array("0" => "Giám sát", "1" => "Quản lý", "3" => "Phụ trách", "4" => "Tính lương", "5" => "Báo giá", "6" => "Khai thuế", "7" => "Lắp ráp", "8" => "Toàn kiểm", "9" => "Kiểm hàng", "10" => "Đứng máy");
$str_select_work = $this->Template->load_selectbox_basic(array("name" => "work", "autocomplete" => "off", "value" => "", "id" => "work"), $array_work);

// lọc theo chức vụ
$array_position = array("0" => "Giám đốc", "1" => "P.Giám đốc", "3" => "Trưởng phòng", "4" => "Phó phòng", "5" => "Trưởng bộ phận", "6" => "NV phụ trách", "7" => "Tổ trưởng", "8" => "Tổ phó", "9" => "Trưởng ca", "10" => "Phó ca", "11" => "Nhân viên", "12" => "Công dân");
$str_select_position = $this->Template->load_selectbox_basic(array("name" => "position", "autocomplete" => "off", "value" => "", "id" => "position"), $array_position);

// lọc theo phân xưởng
$arrray_part = array("0" => "Anten 1", "1" => "Molding 1", "3" => "Solar", "4" => "Silicon", "5" => "Electronic", "6" => "Anten 2", "7" => "Molding 2");
$str_select_part = $this->Template->load_selectbox_basic(array("name" => "part", "autocomplete" => "off", "value" => "", "id" => "part"), $arrray_part);

$str_input_attendance_day = "Phòng ban $str_select_department Chức vụ: $str_select_position Công việc: $str_select_work Nhà máy: $str_select_factory Phân xưởng: $str_select_part ";
$str_form_attendance_content .= $this->Template->load_form_row(array("title" => "Danh sách nhân viên",
	"input" => $str_input_attendance_day));

//buoc 1: tao mang table header
$array_table_header_chamcong = null;

$array_table_header_chamcong["col1"] = array("STT", array("style" => "text-align:center; width:30px"));
$array_table_header_chamcong["col2"] = array("Mã nhân viên", array("style" => "text-align:center"));
$array_table_header_chamcong["col3"] = array("Họ và tên", array("style" => "text-align:center"));
$array_table_header_chamcong["col4"] = array("Ngày điểm danh", array("style" => "text-align:center;width:110px", "nowrap" => "nowrap"));
$array_table_header_chamcong["col5"] = array("Giờ điểm danh", array("style" => "text-align:center;width:70px"));
$array_table_header_chamcong["col6"] = array("Máy", array("style" => "text-align:center;width:40px"));
$array_table_header_chamcong["col7"] = array("Giờ bắt đầu", array("style" => "text-align:center;width:70px"));
$array_table_header_chamcong["col8"] = array("Giờ kết thúc", array("style" => "text-align:center;width:70px"));
$array_table_header_chamcong["col9"] = array("Số giờ", array("style" => "text-align:center;width:70px"));
$array_table_header_chamcong["col10"] = array("Lịch làm việc", array("style" => "text-align:center;width:200px"), "nowrap" => "nowrap");
$array_table_header_chamcong["col11"] = array("Loại ngày", array("style" => "text-align:center;width:300px"), "nowrap" => "nowrap");

//buoc 2: dung hàm load_table_header de lay template table header
$str_table_header_chamcong = $this->Template->load_table_header($array_table_header_chamcong);

// điểm danh
$array_word_type = array("1" => "Có", "0" => "Không");

$str_select_attendance = $this->Template->load_selectbox_basic(array("name" => "attendance", "autocomplete" => "off", "value" => "", "id" => "attendance"), $array_word_type);

// bảng chọn loại ngày công
$array_day_type = array("1" => "Ngày công bình thường", "2" => "Ngay công hết hàng không lương", "3" => "Ngày nghỉ bảo hiểm hoặc bệnh", "4" => "Ngày công lớn hơn 8 tiếng", "5" => "Ngày công thường tính xét thưởng", "6" => "Ngày công chủ nhật", "7" => "Ngày nghỉ có phép", "8" => "Ngày nghỉ vô phép", "9" => "Ngày không bấm thẻ", "10" => "Ngày công tính tiền sữa", "11" => "Ngày công hết hàng cho về");

// //Bảng chọn lịch làm việc
// $array_work_shift = array("1" => "Lịch động", "ca1_8h" => "Ca 1 8h", "ca2_8h" => "Ca 2 8h", "ca3_8h" => "Ca 3 8h", "ca1_12h" => "Ca 1 12h", "ca2_12h" => "Ca 2 12h", "ca3_12h" => "Ca 3 12h", "hanhchinh" => "Hành chính 7h-15h30", "hanhchinh_vp" => "Hành chính văn phòng", "hanhchinh_sx" => "Hành chính sản xuất");
array_unshift($array_work_shift, array("id" => "", "name" => "lịch động"));

//"0"=>"BGĐ-Ban giám đốc", "1"=>"ISO-Quy trình", "3"=>"PRO-Sản xuất","4"=>"HR-Nhân sự", "5"=>"QC-Chất lượng"
$str_table_row_staff = "";
$saved_element = null;
$firt_usercode = "";
$saved_number = 0;
$str_table_row_chamcong = "";

$num = 0;
if ($array_data_chamcong) {
	foreach ($array_data_chamcong as $key => $chamcong) {

		//so sánh user_code hiện tại và user_code trước đó có bằng nhau hay không
		if ($firt_usercode != $chamcong['user_code']) {
			//Nếu có phần tử đã lưu

			if ($saved_element != null) {

				//Lấy giờ của tất cả phần tử đã lưu
				$str_date_time = "";
				$str_day = "";
				$str_time = "";

				$str_date_time_hidden = "";
				//Lấy user code đã lưu
				$user_code = $saved_element[0]['user_code'];
				$id_user = $saved_element[0]['id_user'];
				$user_fullname = $saved_element[0]['fullname'];

				for ($i = 0; $i <= $saved_number; $i++) {

					$str_time .= "<span id ='time_" . $user_code . "_$i'>" . date("H:i:s", strtotime($saved_element[$i]["date_time"])) . "</span><br>";
					$str_date_time_hidden .= "<span id ='time_hidden_" . $user_code . "_$i' style = 'display: none' >" . date("Y-m-d H:i:s", strtotime($saved_element[$i]["date_time"])) . "</span>";
					$str_day .= date("d-m-Y", strtotime($saved_element[$i]["date_time"])) . "<br>";
					$str_date_time .= date("d-m-Y H:i:s", strtotime($saved_element[$i]["date_time"]));
				}

				//$str_date_time_hidden = "<div style = 'display: none'></div>"
				//Tạo text box chứa giờ bắt đầu

				//Giờ bắt đầu bằng phần tử đầu tiên của mảng saved_element
				$start_time_value = strtotime($saved_element[0]["date_time"]);

				$str_start_time_value = date("H:i:s", $start_time_value);
				$str_input_startime = $this->Template->load_textbox(array("name" => "data[$num][start_time]", "value" => $str_start_time_value, "id" => "start_time_$user_code", "style" => "width: 70px", "onchange" => "thaydoi_gio('$user_code')"));

				//Tạo text box chưa giờ kết thúc
				$end_time_value = "";
				$sogio = "";
				$str_end_time_value = "";
				$sogio_lamtron = "";
				//Nếu chỉ có một dòng số liệu thì không có giờ về
				if ($saved_number > 0) {
					//Giờ đi về bằng phần tử cuối cùng của mảng
					$end_time_value = strtotime($saved_element[$saved_number]["date_time"]);
					$str_end_time_value = date("H:i:s", $end_time_value);

					$sogio = round(abs($end_time_value - $start_time_value) / 3600, 2);

					//Số giờ làm tròn
					$sogio_lamtron = floor($sogio);

					$sogio_le = $sogio - $sogio_lamtron;
					if ($sogio_le < 0.5) {
						$sogio_le = 0;
					} else {
						$sogio_le = 0.5;
					}

					$sogio_lamtron += $sogio_le;
				}

				$str_input_endtime = $this->Template->load_textbox(array("name" => "data[$num][end_time]", "value" => $str_end_time_value, "id" => "end_time_$user_code", "style" => "width: 70px", "onchange" => "thaydoi_gio('$user_code')"));

				$str_hidden_day = $this->Template->load_hidden(array("name" => "data[$num][day]", "value" => $str_date));

				$str_hidden_id_user = $this->Template->load_hidden(array("name" => "data[$num][id_user]", "value" => $id_user, "id" => "id_user"));

				$str_hidden_user_code = $this->Template->load_hidden(array("name" => "data[$num][user_code]", "value" => $user_code, "id" => "user_code"));

				$str_hidden_user_fullname = $this->Template->load_hidden(array("name" => "data[$num][user_fullname]", "value" => $user_fullname, "id" => "user_fullname"));

				//Tạo text box chứa số giờ
				$str_input_time = $this->Template->load_textbox(array("name" => "data[$num][hour]", "value" => $sogio_lamtron, "id" => "hour_$user_code", "style" => "width: 70px"));
				$str_span_giothuc = "<span id='hour_real_$user_code'>$sogio</span>";
				//Tạo select box ca
				$str_select_shift = $this->Template->load_selectbox(array("name" => "data[$num][shift]", "autocomplete" => "off", "style" => "width:150px", "value" => "", "id" => "shift", "onchange" => "xemca(this.value, '$user_code',$saved_number)"), $array_work_shift);

				$str_select_day_type = $this->Template->load_selectbox(array("name" => "data[$num][day_type]", "autocomplete" => "off", "value" => "", "id" => "day_type"), $array_day_type);

				$num++;

				//Tạo hidden chứa tất cả ngày giờ điểm danh của nhân viên
				//$str_hidden = $this->Template->load_hidden(array("id"=>"datetime_$user_code","value"=>$str_date_time.""));

				// dùng hàm load table row để lấy nội dung cho bảng
				$array_table_row_chamcong = null;
				$array_table_row_chamcong["col1"] = array("$num", array("style" => "text-align:center"));
				$array_table_row_chamcong["col2"] = array($saved_element[$saved_number]["user_code"] . $str_hidden_day . $str_hidden_id_user . $str_hidden_user_fullname, array("style" => "text-align:center"));
				$array_table_row_chamcong["col3"] = array($saved_element[$saved_number]["fullname"], array("style" => "text-align:center"));
				$array_table_row_chamcong["col4"] = array($str_day, array("style" => "text-align:center"));
				$array_table_row_chamcong["col5"] = array($str_time . $str_date_time_hidden . $str_hidden_user_code, array("style" => "text-align:center"));
				$array_table_row_chamcong["col6"] = array($saved_element[$saved_number]["id_machine"], array("style" => "text-align:center"));
				$array_table_row_chamcong["col7"] = array($str_input_startime, array("style" => "text-align:center"));
				$array_table_row_chamcong["col8"] = array($str_input_endtime, array("style" => "text-align:center"));
				$array_table_row_chamcong["col9"] = array($str_input_time . "<br>$str_span_giothuc", array("style" => "text-align:center"));
				$array_table_row_chamcong["col10"] = array($str_select_shift, array("style" => "text-align:center"));
				$array_table_row_chamcong["col11"] = array($str_select_day_type, array("style" => "text-align:center"));

				$str_table_row_chamcong .= $this->Template->load_table_row($array_table_row_chamcong);

			}

			$saved_number = 0;
			$saved_element = null;
			$saved_element[$saved_number] = $chamcong;

			$firt_usercode = $chamcong['user_code'];
		} //end: if($firt_usercode != $chamcong['user_code'])
		else {
			//nhớ lại 1 dòng
			$saved_number++;
			$saved_element[$saved_number] = $chamcong;
		} //end: else if($firt_usercode != $chamcong['user_code'])

	} //end: foreach

	//Kiểm tra nếu có phần tử saved_element != null thì vẻ ra dữ liệu
	if ($saved_element) {
		$user_code2 = $saved_element[0]['user_code'];
		$str_day = "";
		$str_time = "";
		for ($i = 0; $i <= $saved_number; $i++) {
			$str_time .= date("H:i:s", strtotime($saved_element[$i]["date_time"])) . "<br>";
			$str_day .= date("d-m-Y", strtotime($saved_element[$i]["date_time"])) . "<br>";
		}

		//Tạo text box c$numhứa giờ bắt đầu

		//Giờ bắt đầu bằng phần tử đầu tiên của mảng saved_element
		$start_time_value = strtotime($saved_element[0]["date_time"]);

		$str_start_time_value = date("H:i:s", $start_time_value);
		$str_input_startime = $this->Template->load_textbox(array("name" => "data[][start_time]", "value" => $str_start_time_value, "id" => "start_time", "style" => "width: 70px"));

		//Tạo text box chưa giờ kết thúc
		$end_time_value = "";
		$sogio = "";
		//Nếu chỉ có một dòng số liệu thì không có giờ về
		if ($saved_number > 0) {
			//Giờ đi về bằng phần tử cuối cùng của mảng
			$end_time_value = strtotime($saved_element[$saved_number]["date_time"]);
			$str_end_time_value = date("H:i:s", $end_time_value);

			$sogio = round(abs($end_time_value - $start_time_value) / 3600, 2);

			//Số giờ làm tròn
			$sogio_lamtron = floor($sogio);

			$sogio_le = $sogio - $sogio_lamtron;
			if ($sogio_le < 0.5) {
				$sogio_le = 0;
			} else {
				$sogio_le = 0.5;
			}

			$sogio_lamtron += $sogio_le;
		}

		$str_input_endtime = $this->Template->load_textbox(array("name" => "data[][end_time]", "value" => $str_end_time_value, "id" => "end_time", "style" => "width: 70px"));

		$str_hidden_user_code2 = $this->Template->load_hidden(array("name" => "data[][user_code]", "value" => $user_code2, "id" => "user_code"));

		//Tạo text box chứa số giờ
		$str_input_time = $this->Template->load_textbox(array("name" => "data[][time]", "value" => $sogio_lamtron, "id" => "time", "style" => "width: 70px"));

		// dùng hàm load table row để lấy nội dung cho bảng
		$array_table_row_chamcong = array("stt" => array("$key", array("style" => "text-align:center")),
			"code" => array($saved_element[$saved_number]["user_code"], array("style" => "text-align:center")),
			"name" => array($saved_element[$saved_number]["fullname"], array("style" => "text-align:center")),
			"day" => array($str_day, array("style" => "text-align:center")),
			"date_time" => array($str_time, array("style" => "text-align:center")),
			"id_machine" => array($saved_element[$saved_number]["id_machine"], array("style" => "text-align:center")),
			"start_time" => array($str_input_startime, array("style" => "text-align:center")),
			"end_time" => array($str_input_endtime . $str_hidden_user_code2, array("style" => "text-align:center")),
			"time" => array($str_input_time . "<br>$sogio", array("style" => "text-align:center")),
			"work_type" => array($str_select_shift, array("style" => "text-align:center")),
			"attendance_type" => array($str_select_day_type, array("style" => "text-align:center")),
		); //

		$str_table_row_chamcong .= $this->Template->load_table_row($array_table_row_chamcong);

	}
} //end: if
else {
	$array_table_row_chamcong = array("col1" => array("Không có dữ liệu", array("style" => "text-align:center;", "colspan" => "9")));
	$str_table_row_chamcong = $this->Template->load_table_row($array_table_row_chamcong);
}
//buoc 5: dung ham load_table đưa dữ liệu vào table

$str_table_chamcong = $this->Template->load_table($str_table_header_chamcong . $str_table_row_chamcong);

//tạo nút lưu
$str_btn_save = $this->Template->load_button(array("type" => "submit"), "Lưu");

// dùng hàm load_form để lấy html cho form
$str_form = $this->Template->load_form(array("action" => "/attendance2/data", "method" => "post", "id" => "form_staff"), $str_table_chamcong . $str_btn_save);

// Hiển thị ra trình duyệt
echo $str_form;
?>
<script type="text/javascript">
	$( function() {
		$( "#attendance_day" ).datepicker({dateFormat: "dd-mm-yy"});
	} );

	var array_ca =[];
	<?php
if ($array_work_shift2) {
	foreach ($array_work_shift2 as $work_shift) {
		$id_work_shift = $work_shift["id"];
		$work_shift_name = $work_shift["name"];
		$str_gio_batdau = $work_shift["start_time"];
		$str_gio_ketthuc = $work_shift["end_time"];
		$str_khunggio_batdau = $work_shift["start_time_allowe"];
		$str_khunggio_ketthuc = $work_shift["end_time_allowe"];

		?>
			array_ca['<?php echo $id_work_shift; ?>'] =
			{
				gio_batdau:"<?php echo $str_gio_batdau; ?>",
				gio_ketthuc:"<?php echo $str_gio_ketthuc; ?>",
				khung_gio_batdau:"<?php echo $str_khunggio_batdau; ?>",
				khung_gio_ketthuc:"<?php echo $str_khunggio_ketthuc; ?>"
			};
	<?php
} //END: foreach ($array_work_shift2 as $work_shift) {
} //END: if ($$array_work_shift2) {
?>

	  //Lấy ngày hiện hiện
        <?php

//lấy ngày chấm công,
$str_ngay_chamcong = date("Y-m-d");
if (isset($_GET['date'])) {
	$str_ngay_chamcong = date("Y-m-d", strtotime($_GET['date']));
}

?>

	var ngay_chamcong = "<?php echo $str_ngay_chamcong; ?>";
	function xemca(ca,user_code,sodong_diemdanh)
	{
		if(ca ==""){
			for(i = 0; i <= sodong_diemdanh; i++)
			{
				document.getElementById('time_'+user_code+"_"+i).style = "text-decoration: ''";
			}
			return;
		}


		var str_khunggio_batdau = ngay_chamcong +" "+ array_ca[ca]["khung_gio_batdau"];
            // alert(str_khunggio_batdau);
            var bits = str_khunggio_batdau.split(/\D/);
            var khunggio_batdau = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

            //Ngày kết thúc ca
            var str_khunggio_ketthuc = ngay_chamcong+" "+ array_ca[ca]["khung_gio_ketthuc"];
            var bits = str_khunggio_ketthuc.split(/\D/);
            var khunggio_ketthuc = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

			//nếu giờ đi về < giờ bắt đầu thì tăng lên một ngày
			if(khunggio_ketthuc<khunggio_batdau)	khunggio_ketthuc.setDate(khunggio_ketthuc.getDate() + 1);
			// alert(khunggio_ketthuc);

            //lấy dòng chấm công đầu tiên của user đang chọn
            var str_gio_batdau = document.getElementById('time_hidden_'+user_code+"_"+0).innerHTML ;

            //chuyển sang kiểu giờ
            var bits = str_gio_batdau.split(/\D/);
            var gio_batdau = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

            var vitri_batdau = 0;
            var daco_vitri_batdau = false;

            //duyệt tất cả các giờ điểm danh mà người dùng đã nhấn
            for(i = 0; i <= sodong_diemdanh; i++)
            {

              //lấy dòng hiện tại giờ của người chấm công
              var str_ngaygio_chamcong = document.getElementById('time_hidden_'+user_code+"_"+i).innerHTML;

              //chuyển sang kiểu giờ
              var bits = str_ngaygio_chamcong.split(/\D/);
              gio_chamcong = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);



              	//nếu giờ làm việc trong khung giờ thì đúng
              	if(gio_chamcong > khunggio_batdau && gio_chamcong <= khunggio_ketthuc)
              	{
              		document.getElementById('time_'+user_code+"_"+i).style = "text-decoration: ''";
              		if(daco_vitri_batdau == false)
              		{
              				vitri_batdau = i;
              				daco_vitri_batdau = true;
              		}
              	}
              	else
              	{
              		//nếu giờ điểm danh ngoài khung giờ làm việc thì gạch ngang
              		document.getElementById('time_'+user_code+"_"+i).style = "text-decoration: line-through";


            	}

            }//end for


            //lấy giờ bắt đầu đưa vào textbox giờ bắt đầu
            document.getElementById('start_time_'+user_code).value=  document.getElementById('time_'+user_code+'_'+vitri_batdau).innerHTML;

            //lấy ngày giờ bắt đầu
            var str_gio_batdau = document.getElementById('time_hidden_'+user_code+"_"+vitri_batdau).innerHTML ;

            bits = str_gio_batdau.split(/\D/);
            gio_batdau = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);


            //tìm giờ kết thúc
            //nếu gio_ketthuc nằm trong phạm vi khung  giờ bắt đâu và giờ kết thúc thì lấy
            var str_gio_ketthuc = "";
            var gio_ketthuc;
            var vitri_ketthuc = sodong_diemdanh;
            for(i = sodong_diemdanh; i >= 0; i--)
            {
            	str_gio_ketthuc = document.getElementById('time_hidden_'+user_code+'_'+i).innerHTML ;
	            //chuyển sang kiểu giờ
	            var bits = str_gio_ketthuc.split(/\D/);
	            gio_ketthuc = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

            	//kiểm tra nếu giờ kết trong khung giờ làm việc thì thoát
            	if(gio_ketthuc >= khunggio_batdau && gio_ketthuc <= khunggio_ketthuc)
            	{
            		vitri_ketthuc = i;
            		break;

            	}
            }


            //lấy giờ kết thúc đưa vào textbox giờ kết thúc
            document.getElementById('end_time_'+user_code).value=  document.getElementById('time_'+user_code+'_'+vitri_ketthuc).innerHTML;

            //lấy giờ kết thúc
            var str_gio_ketthuc = document.getElementById('time_hidden_'+user_code+"_"+vitri_ketthuc).innerHTML ;
            bits = str_gio_ketthuc.split(/\D/);
            gio_ketthuc = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

            // capnhat_sogio
            capnhat_sogio(user_code, gio_batdau, gio_ketthuc);

    }

    function capnhat_sogio(user_code,gio_batdau, gio_ketthuc)
    {
    	 //lấy giờ kết thúc


            var so_milligiay_lamviec = gio_ketthuc - gio_batdau;

            var sophut_lamviec = so_milligiay_lamviec/1000/60;

            //tính số giờ giữa giờ bắt đầu và giờ kết thúc
            var sogio = Math.floor(sophut_lamviec/60);
            var so_phut =sophut_lamviec%60;

            //nếu số phút lớn hơn 30 thì tăng 0.5 giờ làm việc
            if(so_phut>=30) sogio += 0.5;

            document.getElementById('hour_'+user_code).value= sogio;
            document.getElementById('hour_real_'+user_code).innerHTML= Math.round(sophut_lamviec/60*100)/100;
    }

    function thaydoi_gio(user_code)
    {
    	// lấy giờ bắt đầu làm

    	   //lấy giờ kết thúc đưa vào textbox giờ kết thúc
            var start_time = document.getElementById('start_time_'+user_code).value;

           	var str_ngaygio_batdau = ngay_chamcong +" "+ start_time;
           	//chuyển sang kiểu giờ
	        var bits = str_ngaygio_batdau.split(/\D/);
	       	gio_batdau = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

            //lấy giờ kết thúc đưa vào textbox giờ kết thúc
            var end_time = document.getElementById('end_time_'+user_code).value;

            var str_ngaygio_ketthuc = ngay_chamcong+" "+ end_time;

            // alert(str_ngaygio_ketthuc);
            //chuyển sang kiểu giờ
	        var bits = str_ngaygio_ketthuc.split(/\D/);
	       	gio_ketthuc = new Date(bits[0], --bits[1], bits[2], bits[3], bits[4]);

	       	//nếu giờ đi về < giờ bắt đầu thì tăng lên một ngày
			if(gio_ketthuc<gio_batdau)	gio_ketthuc.setDate(gio_ketthuc.getDate() + 1);

			capnhat_sogio(user_code,gio_batdau, gio_ketthuc);

    }
</script>