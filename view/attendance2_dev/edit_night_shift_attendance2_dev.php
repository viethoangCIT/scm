<?php 

//tạo tiêu đề hàm
$function_title = "Sửa chấm công theo ca";
echo $this->Template->load_function_header($function_title);
$str_form_attendance = "";
$array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
	"code"=>array("Mã nhân viên",array("style"=>"text-align:center; width:5%")),
	"name"=>array("Họ và tên",array("style"=>"text-align:center; width:12%")), 
	"gender"=>array("Giới tính",array("style"=>"text-align:center;width:2%")),
	"type"=>array("Hình thức",array("style"=>"text-align:center;width:5%")),
	"position"=>array("Phòng ban/</br>Chức vụ",array("style"=>"text-align:center;width:5%")),
	"work_type"=>array("Công việc",array("style"=>"text-align:center;width:4%")),
	"factory"=>array("Nhà máy</br>Phân xưởng/ Tổ",array("style"=>"text-align:center;width:5%")),
	"date"=>array("Ngày",array("style"=>"text-align:center;width:2%")),
	"sogio"=>array("Số giờ",array("style"=>"text-align:center;width:2%")),
	"go_work"=>array("Đi làm",array("style"=>"text-align:center;width:7%")),
	"attendance_type"=>array("Loại",array("style"=>"text-align:center;width:10%")),
);

  //2: lấy dòng tr header
$str_form_attendance = $this->Template->load_table_header($array_header_attendance);
$str_input_num_hour = $this->Template->load_textbox(array("name"=>"data[0][num_hour]","id"=>"num_hour","value"=>$array_edit_night_shitf[0]["num_hour"],"style"=>"width:70px; margin-top:10px;")); 
$array_word_type = array("1"=>"Có","0"=>"Không");
$str_select_attendance = $this->Template->load_selectbox_basic(array("name"=>"data[0][id_go_work]","autocomplete"=>"off","id"=>"id_go_work","style"=>"width:120px;"),$array_word_type,$array_edit_night_shitf[0]["id_go_work"]);

// bảng chọn loại ngày công
$array_work_attendance = array("1"=>"Ngày công hết hàng cho về","2"=> "Ngay công hết hàng không lương", "3" =>"Ngày nghỉ bảo hiểm hoặc bệnh", "6" =>"Ngày công chủ nhật", "7" =>"Ngày nghỉ có phép", "8" =>"Ngày nghỉ vô phép", "9"=>"Ngày không bấm thẻ", "10"=>"Ngày công tính tiền sữa","11"=>"Ngày công đi muộn(đủ 8h)");
$str_select_work_attendance = $this->Template->load_selectbox_basic(array("name"=>"data[0][id_date_allowance]","autocomplete"=>"off","id"=>"type_shift"),$array_work_attendance);
$str_input_id = $this->Template->load_hidden(array("name"=>"data[0][id]","id"=>"id","value"=>$array_edit_night_shitf[0]["id"],"style"=>"width:70px; margin-top:10px;")); 
$str_input_type = $this->Template->load_hidden(array("name"=>"type","id"=>"id","value"=>1,"style"=>"width:70px; margin-top:10px;"));
$str_input_shift = $this->Template->load_hidden(array("name"=>"shift_hidden","id"=>"shift_hidden","value"=>$array_edit_night_shitf[0]["shift"],"style"=>"width:70px; margin-top:10px;")); 
$str_input_date = $this->Template->load_textbox(array("name"=>"date","id"=>"date","value"=>$array_edit_night_shitf[0]["date"],"style"=>"width:100px; margin-top:10px;"));  
$array_table_row_night_shift =  array(
	"stt"=>array("1" ,array("style"=>"text-align:center; width:3%")),
	"code"=>array($array_edit_night_shitf[0]["user_code"].$str_input_type,array("style"=>"text-align:center")),
	"name"=>array($array_edit_night_shitf[0]["fullname"].$str_input_shift,array("style"=>"text-align:center")),
	"gender"=>array($array_edit_night_shitf[0]["gender"],array("style"=>"text-align:center")),
	"type"=>array($array_edit_night_shitf[0]["labor_type"],array("style"=>"text-align:center")),

	"department"=>array($array_edit_night_shitf[0]["department"]."</br>".$array_edit_night_shitf[0]["position"],array("style"=>"text-align:center")),
	"work_type"=>array($array_edit_night_shitf[0]["work"],array("style"=>"text-align:center")),
	"factory"=>array($array_edit_night_shitf[0]["factory"]."</br>".$array_edit_night_shitf[0]["manufactory"]."</br>".$$array_edit_night_shitf[0]["team"],array("style"=>"text-align:center")),
	"date"=>array($str_input_date,array("style"=>"text-align:center")),
	"num_hour"=>array($str_input_num_hour.$str_input_id,array("style"=>"text-align:center;width:5%")),
	"go_work"=>array($str_select_attendance,array("style"=>"text-align:center;width:5%")),
	"loai"=>array($str_select_work_attendance,array("style"=>"text-align:center;width:5%")),
	

);

$str_form_attendance .= $this->Template->load_table_row($array_table_row_night_shift);
$str_form_attendance =$this->Template->load_table($str_form_attendance);
$str_save_button =  $this->Template->load_button(array("type"=>"submit","id"=>"button_luu"),"Lưu");
$str_form_attendance = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/attendance2/add_night_shift?debug=code"), $str_form_attendance.$str_save_button );
echo $str_form_attendance;
?>
<script type="text/javascript">
 $( function() {
    $( "#date" ).datepicker({dateFormat: "dd-mm-yy"});
} );
 
</script>