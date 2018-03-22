<?php 	

// TẠO HEADER
$function_title = "Danh Sách Lương Sản Phẩm";
echo $this->Template->load_function_header($function_title);

// TẠO GIÁ TRỊ MẶC ĐỊNH CHO SELECTBOX
if($date_from) $date_from = date("m-Y",strtotime($date_from));
if($date_to) $date_to = date("m-Y",strtotime($date_to));

// TẠO BỘ LỌC
// lọc theo phòng ban
array_unshift($array_department, array("id"=>"","name"=>"Phòng ban"));
$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:110px;"),$array_department,$id_department);

// lọc theo nhà máy
array_unshift($array_factory, array("id"=>"","name"=>"Nhà máy"));
$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:110px"),$array_factory,$id_factory);

// lọc theo công việc
array_unshift($array_job, array("id"=>"","name"=>"Công việc"));
$str_select_work = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job","style"=>"width:110px;"),$array_job,$id_job);

// lọc theo chức vụ
array_unshift($array_position, array("id"=>"","name"=>"Chức vụ"));
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:110px;"),$array_position,$id_position);

// lọc theo phân xưởng
array_unshift($array_manufactory, array("id"=>"","name"=>"Phân xưởng")); 
$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"id_manufactory","style"=>"width:110px;"),$array_manufactory,$id_manufactory);
$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"day","style"=>"width:90px;"));
$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to,"id"=>"date_to", "class"=>"day","style"=>"width:90px;"));
$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));
$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";
$str_input_attendance_day =" Từ tháng:  $str_input_from  Đến tháng: $str_input_to $str_select_department  $str_select_position $str_select_work  $str_select_factory $str_select_part $str_input_name_staff $str_btn_save ";

// BEGIN TẠO TABLE HEADER
$str_salary_product = "";
$array_header_salary_product=  array(
	"Stt"=>array("STT",array("style"=>" text-align:center; width:3%")),
	"mnv"=>array("Mã nhân viên ",array("style"=>"text-align:center; width:8%")),
	"hoten"=>array("Họ & tên",array("style"=>"text-align:center; width:12%;white-space: nowrap")),		
	"thang"=>array("Tháng",array("style"=>"text-align:center; width:8%")),
	"phongban"=>array("Phòng ban",array("style"=>"text-align:center; width:8%")),
	"tong_lnt"=>array("Tổng lương ngày thường",array("style"=>"text-align:center; width:8%")),			
	"tong_lcn"=>array("Tổng lương ngày chủ nhật",array("style"=>"text-align:center; width:8%")),
	"tongluong"=>array("Tổng lương",array("style"=>"text-align:center; width:8%")),
	
	);

// LẤY DÒNG TABLE HEADER
$str_salary_product = $this->Template->load_table_header($array_header_salary_product);
$str_btn_chitiet = "<input type='submit' class='xemchitiet'value='Xem chi tiết' style='font-size: 13.4px'>";
$stt;

// LẤY THÌ TẤT CẢ USER 
foreach ($array_user as $key => $value) 
{
	$stt++; 
	$array_salary_product=  array(
		"Stt"=>array($stt,array("style"=>"text-align:center; width:3%")),
		"maso"=>array($value["user_code"],array("style"=>"text-align:center; width:5%")),
		"hoten"=>array($value["fullname"],array("style"=>"text-align:center; width:15%;white-space: nowrap")),	
		"thang"=>array(date("m-Y",strtotime($value["thang"])),array("style"=>"text-align:center; width:8%")),
		"phongban"=>array($value["department"],array("style"=>"text-align:center; width:8%")),
		"tong_lnt"=>array(number_format($value["thanhtien"] - $value["tongso_luong_chunhat"]),array("style"=>"text-align:center; width:8%")),						
		"tong_lcn"=>array(number_format($value["tongso_luong_chunhat"]),array("style"=>"text-align:center; width:8%")),
		"tongluong"=>array(number_format($value["thanhtien"]),array("style"=>"text-align:center; width:8%")),
		
		);
	$str_salary_product .= $this->Template->load_table_row($array_salary_product);
}

// HIỂN THỊ THÔNG TIN RA BẢNG
$str_salary_product =  $this->Template->load_table($str_salary_product);
$str_form_salary = $this->Template->load_form(array("method"=>"GET","id"=>"form_nhap","action"=>""),$str_input_attendance_day.$str_salary_product);
echo $str_form_salary;	



?>
<script language="javascript">
	$( function() {
		$( "#date_from" ).datepicker({dateFormat: "mm-yy"});
		$( "#date_to" ).datepicker({dateFormat: "mm-yy"});
	} );

</script>
