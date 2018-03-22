<?php 
$function_title = "Danh Sách Lương";
echo $this->Template->load_function_header($function_title);

//lọc theo phòng ban
array_unshift($array_department, array("id"=>"","name"=>"Phòng ban"));
$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","id"=>"id_department","style"=>"width:100px"),$array_department,$id_department);

// lọc theo nhà máy
array_unshift($array_factory, array("id"=>"","name"=>"Nhà máy"));
$str_select_factory =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","id"=>"id_factory","style"=>"width:100px"),$array_factory,$id_factory);

// lọc theo công việc
array_unshift($array_job, array("id"=>"","name"=>"Công việc"));
$str_select_job = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job","style"=>"width:100px"),$array_job,$id_job);

// lọc theo chức vụ
array_unshift($array_position, array("id"=>"","name"=>"Chức vụ"));
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","id"=>"id_position","style"=>"width:100px"),$array_position,$id_position);

// lọc theo phân xưởng
array_unshift($array_manufactory, array("id"=>"","name"=>"Phân xưởng"));
$str_select_manufactory = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","id"=>"id_manufactory","style"=>"width:100px"),$array_manufactory,$id_manufactory);

if($date_from) $date_from = date("m-Y",strtotime($date_from));
if($date_to) $date_to = date("m-Y",strtotime($date_to));
$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"day","style"=>"width:90px; margin-bottom:10px;"));
$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to,"id"=>"date_to", "class"=>"day","style"=>"width:90px;"));
$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";
$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name","placeholder"=>"Nhập tên nhân viên", "style"=>"border-radius: 7px;margin-top: 9px; height: 25px; border: 1px solid #aaaaaa;"));

$str_input_attendance_day ="Từ tháng: $str_input_from Đến tháng: $str_input_to  $str_select_department  $str_select_position $str_select_job  $str_select_factory  $str_select_manufactory Tên: $str_input_name_staff $str_btn_save ";

$str_form_salary1 = $this->Template->load_form(array("method"=>"GET","id"=>"form_nhap","action"=>""),$str_input_attendance_day);

// BEGIN: TABLE HEADER
echo $str_form_salary1;
$str_salary = "";

//tạo mảng table_header_1
$array_header_salary_1 =  array(
	"Stt"=>array("STT",array("style"=>"vertical-align:middle;text-align:center; width:3%","rowspan"=>"2")),
	"ms"=>array("Mã nhân viên",array("style"=>"vertical-align:middle;text-align:center; width:8%","rowspan"=>"2")),
	"ht"=>array("Họ & tên",array("style"=>"vertical-align:middle;text-align:center; width:15%","rowspan"=>"2")),
	"cmnd"=>array("Số CMNN",array("style"=>"vertical-align:middle;text-align:center; width:9%","rowspan"=>"2")),
	"tk"=>array("Số TK",array("style"=>"vertical-align:middle;text-align:center; width:9%","rowspan"=>"2")),
	"thang"=>array("Tháng",array("style"=>"vertical-align:middle;text-align:center; width:9%","rowspan"=>"2")),
	"phucap"=>array("Các khoản phụ cấp",array("style"=>"text-align:center; width:8%","colspan"=>"3")),
	"luong_cb"=>array("Lương cơ bản",array("style"=>"vertical-align:middle;text-align:center; width:8%","rowspan"=>"2")),
	"luong_dong_bh"=>array("Lương đóng bảo hiểm",array("style"=>"vertical-align:middle;text-align:center; width:15%","rowspan"=>"2")),
	"songay"=>array("Số ngày gối đầu",array("style"=>"vertical-align:middle;text-align:center; width:3%","rowspan"=>"2")),
	"chucnang"=>array("Chức năng",array("style"=>"vertical-align:middle;text-align:center; width:3%","rowspan"=>"2")),
	);

// gọi hàm load_table_header của đối tượng Temblate để lấy chuỗi <tr><td>STT</><td>Mã nhân viên</>...</tr>
$str_salary = $this->Template->load_table_header($array_header_salary_1);

//tạo mảng table_header_2
$array_header_salary_2 =  array(
	"trachnhiem"=>array("Trách nhiệm ",array("style"=>"text-align:center; width:15%")),
	"phucap"=>array("Phụ cấp lương ",array("style"=>"text-align:center; width:9%")),
	"kiemnhiem"=>array("Kiêm nhiệm ",array("style"=>"text-align:center; width:9%")),
	);

// BEGIN LẤY DÒNG TABLE HEADER
$str_salary .= $this->Template->load_table_header($array_header_salary_2);

// END LẤY DÒNG TABLE HEADER

// END: TABLE HEADER
//********************************************************************************
$stt = 0;
foreach ($array_salary as $user)
{
	$thang = date("m-Y",strtotime($user["thang"]));
	$id=$user["id"];
	$link_sua="/salary/add/$id.html";
	$link_xoa="/salary/del_salary/$id.html";
	$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
	$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
	$link_action = $link_xoa . $link_sua;
	$str_input_id = $this->Template->load_hidden(array("name"=>"id","id"=>"id","value"=>$id,"style"=>"width:100px; color:black;font-weight:normal;"));
	$stt++;
	$array_salary =  array(
		"Stt"=>array($stt,array( "style"=>"text-align:center; width:3%")),
		"maso"=>array($user["user_code"],array("style"=>"text-align:center; width:8%;")),
		"hoten"=>array($user["full_name"],array("style"=>"text-align:center; width:8%;")),
		"cmnd"=>array($user["id_number"],array("style"=>"text-align:center; width:6%")),
		"tk"=>array($user["bank_account"],array("style"=>"text-align:center; width:6%;")),
		"thang"=>array($thang,array("style"=>"text-align:center; width:6%;")),
		"trachnhiem"=>array(number_format($user["trachnhiem"]),array("style"=>"text-align:center; width:6%;")),
		"phucap_luong"=>array(number_format($user["phucap_luong"]),array("style"=>"text-align:center; width:6%;")),
		"kiemnhiem"=>array(number_format($user["kiemnhiem"]),array("style"=>"text-align:center; width:6%;")),
		"luong_cb"=>array(number_format($user["luong_coban"]),array("style"=>"text-align:center; width:10%;")),
		"luong_baohiem"=>array(number_format($user["luong_baohiem"]),array("style"=>"text-align:center; width:6%;")),
		"songay"=>array($user["songay"],array("style"=>"text-align:center; width:10%;")),	
		"chucnang"=>array($link_action,array("style"=>"text-align:center; width:10%;")),	
		);
	$str_salary .= $this->Template->load_table_row($array_salary);
}



// END: HIỂN THỊ TẤT CẢ USER

// gọi hàm load_table của đối tượng Template để tạo ra chuỗi <table>$str_salary</table>
$str_table_salary =  $this->Template->load_table($str_salary);

echo $str_table_salary;
?>
<script language="javascript">
	$( function() {
		$( "#date_from" ).datepicker({dateFormat: "mm-yy"});
		$( "#date_to" ).datepicker({dateFormat: "mm-yy"});
	} );

</script>