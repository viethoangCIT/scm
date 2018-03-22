<?php 

 //tạo tiêu đề hàm
$function_title = "Nhập chấm công ngày lễ";
echo $this->Template->load_function_header($function_title);

$array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
	"code"=>array("Mã nhân viên",array("style"=>"text-align:center; width:8%")),
	"name"=>array("Họ và tên",array("style"=>"text-align:center; width:13%")), 
	"gender"=>array("Giới tính",array("style"=>"text-align:center;width:8%")),
	"type"=>array("Hình thức",array("style"=>"text-align:center;width:8%")),
	"position"=>array("Chức vụ",array("style"=>"text-align:center;width:8%")),
	"department"=>array("Phòng ban",array("style"=>"text-align:center;width:10%")),
	"date"=>array("Ngày",array("style"=>"text-align:center;width:10%")),
	"holiday"=>array("Đi làm",array("style"=>"text-align:center;width:10%")),
	"sogio"=>array("Số giờ",array("style"=>"text-align:center;width:10%"))
);

  //2: lấy dòng tr header
$str_form_attendance = $this->Template->load_table_header($array_header_attendance);

$array_part =array( "1"=>"Có","2"=>"Không");
$str_select_part = $this->Template->load_selectbox_basic(array("name"=>"dilam","autocomplete"=>"off","id"=>"dilam","style"=>"width:100px"),$array_part);
foreach ($array_edit as $holiday) {
	$str_input_id = $this->Template->load_hidden(array("name"=>"data[0][id]","id"=>"id_user","value"=>$holiday["id"],"style"=>"width:100px; margin-top:10px;"));
	$num_hour = $holiday['num_hour'];

	$str_input_num_hour = $this->Template->load_textbox(array("name"=>"data[0][num_hour]","id"=>"num_hour", "value"=>"$num_hour"));
	$date = date("d-m-Y",strtotime($holiday["date"]));
	$str_input_date = $this->Template->load_textbox(array("name"=>"date","value"=>$date,"id"=>"date"));
	
     // bảng chọn loại ngày công


        // dùng hàm load table row để lấy nội dung cho bảng
	$array_table_row_day_shift =  array(
		"stt"=>array(1 ,array("style"=>"text-align:center; width:3%")),
		"code"=>array($holiday["user_code"].$str_input_id,array("style"=>"text-align:center")),
		"name"=>array($holiday["user_name"],array("style"=>"text-align:center")),
		"gender"=>array($holiday["gender"],array("style"=>"text-align:center;width:10%")),
		"type"=>array($holiday["labor_type"],array("style"=>"text-align:center;width:13%")),
		"position"=>array($holiday["position"],array("style"=>"text-align:center;width:10%")),
		"department"=>array($holiday["department"],array("style"=>"text-align:center;width:10%")),
		"date"=>array($str_input_date,array("style"=>"text-align:center;width:10%")),
		"holiday"=>array($str_select_part,array("style"=>"text-align:center;width:10%")),
		"sogio"=>array($str_input_num_hour,array("style"=>"text-align:center;width:5%")),
	);

	$str_form_attendance .= $this->Template->load_table_row($array_table_row_day_shift);

}
$str_save_button =  $this->Template->load_button(array("type"=>"submit","onclick"=>"luu()"),"Lưu");
$str_form_attendance =$this->Template->load_table($str_form_attendance);
$str_form_attendance = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/attendance2/add_holiday?debug=code"),$str_form_attendance.$str_save_button);
echo $str_form_attendance;

?>
<script type="text/javascript">
 $( function() {
  $( "#date" ).datepicker({dateFormat: "dd-mm-yy"});
} );
</script>