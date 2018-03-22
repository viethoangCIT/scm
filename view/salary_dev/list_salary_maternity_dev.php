<?php 																									
	//*****************************************
	// BEGIN TITLE
	//*****************************************

$function_title = "Danh Sách Lương Thai Sản";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END TITLE
	//*****************************************

// BEGIN BỘ LỌC

if($date_from != "") $date_from = date("m-Y",strtotime($date_from));
if($date_to != "") $date_to = date("m-Y",strtotime($date_to));

$str_input_from = $this->Template->load_textbox(array("name"=>"date_from","autocomplete"=>"off","value"=>$date_from,"id"=>"date_from", "class"=>"day","style"=>"width:90px; margin-bottom:10px"));
$str_input_to = $this->Template->load_textbox(array("name"=>"date_to","autocomplete"=>"off","value"=>$date_to,"id"=>"date_to", "class"=>"day","style"=>"width:90px;"));
// lọc theo phòng ban
array_unshift($array_department, array("id"=>"","name"=>"Phòng ban"));
$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:100px;"),$array_department,$id_department);

// lọc theo nhà máy
array_unshift($array_factory, array("id"=>"","name"=>"Nhà máy"));
$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:100px"),$array_factory,$id_factory);

// lọc theo công việc
array_unshift($array_job, array("id"=>"","name"=>"Công việc"));
$str_select_work = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job","style"=>"width:100px;"),$array_job,$id_job);

// lọc theo chức vụ
array_unshift($array_position, array("id"=>"","name"=>"Chức vụ"));
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:100px;"),$array_position,$id_position);

// lọc theo phân xưởng
array_unshift($array_manufactory, array("id"=>"","name"=>"Phân xưởng"));
$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"id_manufactory","style"=>"width:100px;"),$array_manufactory,$id_manufactory);

$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));
$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";
$str_input_attendance_day ="Từ tháng: $str_input_from Đến tháng:$str_input_to $str_select_department  $str_select_position  $str_select_work  $str_select_factory  $str_select_part $str_input_name_staff $str_btn_save";

// đưa bộ lọc vào form
$str_form_maternity1 = $this->Template->load_form(array("method"=>"GET","id"=>"form_nhap","action"=>"", "style"=>"margin-left:-30px;"),$str_input_attendance_day);
// END: BỘ LỌC
//***************************************************

// ***************************************************
// BEGIN: HEADER TABLE
$str_salary_maternity = "";

//1: tao mang table header 	
$array_header_salary_maternity =  array(
	"Stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
	"ms"=>array("Mã nhân viên",array("style"=>"text-align:center; width:8%")),
	"ht"=>array("Họ & tên",array("style"=>"text-align:center; width:15%")),
	"cmnn"=>array("Số CMNN",array("style"=>"text-align:center; width:9%")),
	"tk"=>array("Số TK",array("style"=>"text-align:center; width:4%;")),
	"thang"=>array("Tháng",array("style"=>"text-align:center; width:4%;")),
	"tien_thaisan"=>array("Tiền thai sản (BHXH  chi trả)",array("style"=>"text-align:center; width:10%;")),
	"phucap_thaisan"=>array("Phụ cấp thai sản (công ty chi trả)",array("style"=>"text-align:center; width:10%;")),
	"tongluong"=>array("Tổng Lương",array("style"=>"text-align:center; width:10%")),
	"chucnang"=>array("Chức năng",array("style"=>"text-align:center;  width:7%")),
	);

//2: lấy dòng tr header
$str_salary_maternity = $this->Template->load_table_header($array_header_salary_maternity);
// END: HEADER TABLE
//***************************************************

// ***************************************************
// BEGIN: CONTENT TABLE
$stt=0;
foreach ($array_salary_maternity as  $salary_maternity) 
{
	$id=$salary_maternity['id'];
	$link_sua="/salary/add_maternity/$id.html";
	$link_xoa="/salary/del/$id.html";
	$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
	$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
	$link_action = $link_xoa . $link_sua;

	$str_input_id = $this->Template->load_hidden(array("name"=>"data[$stt][id]","id"=>"id","value"=>$salary_maternity['id'],"style"=>"width:100px; color:black;font-weight:normal;"));	
	$str_input_id_department = $this->Template->load_hidden(array("name"=>"data[$stt][id_department]","id"=>"id_department","value"=>$salary_maternity['id_department'],"style"=>"width:100px; color:black;font-weight:normal;"));	
	$str_input_id_factory = $this->Template->load_hidden(array("name"=>"data[$stt][id_factory]","id"=>"id_factory","value"=>$salary_maternity["id_factory"],"style"=>"width:100px ; color:black;font-weight:normal;"));
	$str_input_id_job= $this->Template->load_hidden(array("name"=>"data[$stt][id_job]","id"=>"id_number","value"=>$salary_maternity["id_job"],"style"=>"width:100px ; color:black;font-weight:normal;"));
	$str_input_id_manufactory = $this->Template->load_hidden(array("name"=>"data[$stt][id_manufactory]","id"=>"id_manufactory","value"=>$salary_maternity["id_manufactory"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
	$str_input_id_position = $this->Template->load_hidden(array("name"=>"data[$stt][id_position]","id"=>"id_position","value"=>$salary_maternity["id_position"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
	$stt++;
	$tong=$salary_maternity['tien_thaisan'] + $salary_maternity['phucap_thaisan'];
	//lấy dòng nội dung table
	$thang=date("m-Y",strtotime($salary_maternity["thang"]));
	$array_salary_maternity_1 =  array(
		"Stt"=>array($stt.$str_input_id_department.$str_input_id_position,array( "style"=>"text-align:center; width:3%")),
		"maso"=>array($salary_maternity['user_code'].$str_input_id_factory ,array("style"=>"text-align:center; width:8%;")),
		"hoten"=>array($salary_maternity['full_name'].$str_input_id_department.$str_input_id_position,array( "style"=>"text-align:center; width:3%")),

		"cmnn"=>array($salary_maternity['id_number'].$str_input_id_job,array("style"=>"text-align:center; width:6%")),
		"tk"=>array($salary_maternity['bank_account'].$str_input_id_manufactory,array("style"=>"text-align:center; width:6%;")),
		"thang"=>array($thang,array("style"=>"text-align:center; width:6%;")),
		"tien_thaisan"=>array(number_format($salary_maternity['tien_thaisan']),array("style"=>"text-align:center; width:10%;")),
		"phucap_thaisan"=>array(number_format($salary_maternity['phucap_thaisan']),array("style"=>"text-align:center; width:10%;")),						
		"tongluong"=>array(number_format($tong),array("style"=>"text-align:center; width:6%;")),
		"chucnang"=>array($link_action.$str_input_id,array("style"=>" width:7%;")),
		);
	$str_salary_maternity .= $this->Template->load_table_row($array_salary_maternity_1);
}

// END: CONTENT TABLE
//***************************************************

//Đưa nội dung str_salary_maternity vào thẻ table
$str_salary_maternity =  $this->Template->load_table($str_salary_maternity);

$str_form_maternity = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/maternity"),$str_salary_maternity);
echo $str_form_maternity1.$str_form_maternity;	

?>
<script language="javascript">
	$( function() {
		$( "#date_from" ).datepicker({dateFormat: "mm-yy"});
		$( "#date_to" ).datepicker({dateFormat: "mm-yy"});
	} );

</script>
