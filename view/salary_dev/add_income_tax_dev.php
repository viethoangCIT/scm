<style type="text/css">
	#parent {
		min-height: 200px;
		max-height: 450px;
		height: 350px;
		position: absolute;
		width: 100%;
		left: 0;
	}
</style>
<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
if ($array_edit) $function_title = "Sửa Thuế Thu Nhập Cá Nhân Tạm Tính";
else$function_title = "Nhập Thuế Thu Nhập Cá Nhân Tạm Tính";

echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************


// *********************************************
// BEGIN: FORM TÌM KIẾM
// lọc phòng ban
array_unshift($array_department, array("id"=>"","name"=>"Chọn phòng ban"));
$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:150px"),$array_department,$id_department);

// lọc theo nhà máy
array_unshift($array_factory, array("id"=>"","name"=>"Chọn nhà máy"));
$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:150px"),$array_factory,$id_factory);

// lọc theo công việc
array_unshift($array_job, array("id"=>"","name"=>"Chọn công việc"));
$str_select_work = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job","style"=>"width:150px"),$array_job,$id_job);

// lọc theo chức vụ
array_unshift($array_position, array("id"=>"","name"=>"Chọn chức vụ"));
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:150px"),$array_position,$id_position);
          
// lọc theo phân xưởng
array_unshift($array_manufactory, array("id"=>"","name"=>"Chọn phân xưởng"));
$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"id_manufactory","style"=>"width:150px"),$array_manufactory,$id_manufactory);

$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));

$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";
$str_input_attendance_day =" $str_select_department $str_select_position $str_select_work $str_select_factory  $str_select_part  Tên: $str_input_name_staff $str_btn_save";

$str_form_salary1 = $this->Template->load_form(array("method"=>"GET","id"=>"form_search","action"=>''),$str_input_attendance_day);
// ************************************************
// END: FORM TÌM KIẾM
if($array_edit == NULL) echo $str_form_salary1;


// BEGIN: TABLE KHAU TRU

$thue_5 = "";
$thue_10 = "";
$thue_15 = "";
$thue_20 = "";
// Chỉ khi sửa thì mới lấy giá trị của tháng gán cho value
if ($array_edit)
{
$thang = $array_edit[0]["thang"];
$thang=date("m-Y",strtotime($thang));
$thue_5 = $array_edit[0]["thue_5"];
$thue_10 = $array_edit[0]["thue_10"];
$thue_15 = $array_edit[0]["thue_15"];
$thue_20 = $array_edit[0]["thue_20"];
}

$str_input_from = $this->Template->load_textbox(array("name"=>"thang","autocomplete"=>"off","value"=>$thang,"id"=>"thang", "class"=>"day","style"=>"width:90px;"));
$str_input_5 = $this->Template->load_textbox(array("name"=>"5","id"=>"5","value"=>number_format($thue_5),"style"=>"width:100px ; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));
$str_input_10 = $this->Template->load_textbox(array("name"=>"10","id"=>"10","value"=>number_format($thue_10),"style"=>"width:100px ; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));
$str_input_15 = $this->Template->load_textbox(array("name"=>"15","id"=>"15","value"=>number_format($thue_15),"style"=>"width:100px ; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));	
$str_input_20 = $this->Template->load_textbox(array("name"=>"20","id"=>"20","value"=>number_format($thue_20),"style"=>"width:100px ; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));	
$str_input_pt = $this->Template->load_textbox(array("name"=>"tien","id"=>"tien","value"=>$array_edit[0]["tien"],"style"=>"width:100px; color:black;font-weight:normal;","onkeyup" =>"format_number_textbox(this)"));

$array_header_khautru=  array(
	"thang"=>array("Tháng",array("style"=>"text-align:center; width:5%","colspan"=>"1")),
	"khautru"=>array("Khấu Trừ Người Phụ Thuộc",array("style"=>"text-align:center; width:5%","colspan"=>"1")),
	"thuexuat_5"=>array("Thuế Suất 5%" ,array("style"=>"text-align:center; width:8%")),
	"thuexuat_10"=>array("Thuế Suất 10%" ,array("style"=>"text-align:center; width:8%")),
	"thuexuat_15"=>array("Thuế Suất 15%" ,array("style"=>"text-align:center; width:8%")),
	"thuexuat_20"=>array("Thuế Suất 20%" ,array("style"=>"text-align:center; width:8%")),
	);
$str_row_khautru = $this->Template->load_table_header($array_header_khautru);

$array_khautru=  array(
	"thang"=>array($str_input_from,array("style"=>"text-align:center; width:5%","colspan"=>"1")),
	"khautru"=>array($str_input_pt,array("style"=>"text-align:center; width:5%","colspan"=>"1")),
	"thuexuat_5"=>array($str_input_5 ,array("style"=>"text-align:center; width:8%")),
	"thuexuat_10"=>array( $str_input_10,array("style"=>"text-align:center; width:8%")),
	"thuexuat_15"=>array( $str_input_15,array("style"=>"text-align:center; width:8%")),
	"thuexuat_20"=>array($str_input_20 ,array("style"=>"text-align:center; width:8%")),

	);
$str_row_khautru .= $this->Template->load_table_row($array_khautru);

$str_table_khautru = $this->Template->load_table($str_row_khautru);
// END: TABLE KHAU TRU

// ************************************************
// BEGIN: TABLE
$str_income_tax = "";
$tien="";
$thue_5="";
$thue_10="";
$thue_15="";
$thue_20="";

// BEGIN: TABLE HEADER
$array_header_income_tax_1=  array(
	"Stt"=>array("STT",array("style"=>"vertical-align:middle; width:3%")),
	"mnv"=>array("Mã nhân viên",array("style"=>"vertical-align:middle; width:5%")),
	"ten"=>array("Họ & Tên",array("style"=>"vertical-align:middle; width:5%")),
	"ktbanthan"=>array("Khấu trừ bản thân",array("style"=>"vertical-align:middle; width:8%")),
	"Số nguoi"=>array("Số người",array("style"=>"vertical-align:middle;text-align:center; width:5%")),
	);
$str_income_tax = $this->Template->load_table_header($array_header_income_tax_1);
// END: TABLE HEADER
 
// BEGIN: DANH SÁCH NHÂN VIÊN CẦN SỬA

if($array_edit){
	$stt=0;
	foreach ($array_edit as $user ) { 
		
		$str_input_from = $this->Template->load_textbox(array("name"=>"thang","autocomplete"=>"off","value"=>$thang,"id"=>"thang", "class"=>"day","style"=>"width:90px;"));

	
		$str_input_id = $this->Template->load_hidden(array("name"=>"data[$stt][id]","id"=>"id","value"=>$user["id"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
		
		$str_input_ktbanthan = $this->Template->load_textbox(array("name"=>"data[$stt][kt_banthan]","id"=>"kt_banthan","value"=>$user["kt_banthan"],"style"=>"width:100px","onkeyup" =>"format_number_textbox(this)"));		
		$str_input_songuoi = $this->Template->load_textbox(array("name"=>"data[$stt][songuoi]","id"=>"songuoi","value"=>$user["songuoi"],"style"=>"width:100px"));
		
		$array_income_tax=  array(
			"stt"=>array(1,array("style"=>"text-align:left; width:3%")),
			"maso"=>array($user["user_code"].$str_input_id,array("style"=>"text-align:left; width:5%")),
			"hoten"=>array($user["full_name"],array("style"=>"text-align:center; width:15%;white-space: nowrap")),						
			"ktbanthan"=>array($str_input_ktbanthan,array("style"=>"text-align:left; width:8%")),
			"songuoi"=>array(  $str_input_songuoi,array("style"=>"text-align:left; width:5%")),
			);
		$str_income_tax .= $this->Template->load_table_row($array_income_tax);
	}
}
// END: DANH SÁCH NHÂN VIÊN CẦN SỬA

// BEGIN: DANH SÁCH USER
else{
	$stt=0;
	foreach ($array_user as $user ) { 
		
		$str_input_code = $this->Template->load_hidden(array("name"=>"data[$stt][user_code]","id"=>"user_code","value"=>$user['user_code'],"style"=>"width:100px; color:black;font-weight:normal;"));	
		$str_input_fullname = $this->Template->load_hidden(array("name"=>"data[$stt][full_name]","id"=>"full_name","value"=>$user["fullname"],"style"=>"width:100px ; color:black;font-weight:normal;"));
		$str_input_id_user = $this->Template->load_hidden(array("name"=>"data[$stt][id_user]","id"=>"id_user","value"=>$user["id"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
		$str_input_id_department = $this->Template->load_hidden(array("name"=>"data[$stt][id_department]","id"=>"id_department","value"=>$user['id_department'],"style"=>"width:100px; color:black;font-weight:normal;"));	
		$str_input_id_factory = $this->Template->load_hidden(array("name"=>"data[$stt][id_factory]","id"=>"id_factory","value"=>$user["id_factory"],"style"=>"width:100px ; color:black;font-weight:normal;"));
		$str_input_id_job= $this->Template->load_hidden(array("name"=>"data[$stt][id_job]","id"=>"id_job","value"=>$user["id_work"],"style"=>"width:100px ; color:black;font-weight:normal;"));
		$str_input_id_manufactory = $this->Template->load_hidden(array("name"=>"data[$stt][id_manufactory]","id"=>"id_manufactory","value"=>$user["id_manufactory"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
		$str_input_id_position = $this->Template->load_hidden(array("name"=>"data[$stt][id_position]","id"=>"id_position","value"=>$user["id_position"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
		$str_input_ktbanthan = $this->Template->load_textbox(array("name"=>"data[$stt][kt_banthan]","id"=>"kt_banthan","value"=>"","style"=>"width:100px","onkeyup" =>"format_number_textbox(this)"));		
		$str_input_songuoi = $this->Template->load_textbox(array("name"=>"data[$stt][songuoi]","id"=>"songuoi","value"=>"","style"=>"width:100px"));
		$stt++;
		$array_income_tax=  array(
			"stt"=>array($stt.$str_input_code.$str_input_id_job.$str_input_id_manufactory,array("style"=>"text-align:left; width:3%")),
			"maso"=>array($user["user_code"].$str_input_fullname,array("style"=>"text-align:left; width:5%")),
			"hoten"=>array($user["fullname"].$str_input_id_user.$str_input_id_position,array("style"=>"text-align:center; width:15%;white-space: nowrap")),						
			"ktbanthan"=>array($str_input_ktbanthan.$str_input_id_department,array("style"=>"text-align:left; width:8%")),
			"songuoi"=>array(  $str_input_songuoi.$str_input_id_factory ,array("style"=>"text-align:left; width:5%")),
			);
		$str_income_tax .= $this->Template->load_table_row($array_income_tax);
	}
}
// END: DANH SÁCH USER


$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
$array_income_tax1=  array(
	"stt"=>array("",array("style"=>"text-align:left; width:3%","colspan"=>"4")),
	"maso"=>array($str_save_button,array("style"=>"text-align:left; width:5%"))
	);
// *******************************************************
// END: TABLE

$str_income_tax .= $this->Template->load_table_row($array_income_tax1);
	//Đưa nội dung str_allowance vào thẻ table
$str_income_tax=  $this->Template->load_table($str_income_tax);
$str_form_salary = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/add_temp_income_tax"),$str_table_khautru.$str_income_tax);

	echo $str_form_salary;

?>
<script language="javascript">
	$( function() {
		$( "#thang" ).datepicker({dateFormat: "mm-yy"});
	} );
</script>
<script>
	function luu()
	{
		if (document.getElementById("thang").value == "") 
			{
				alert("Xin vui lòng chọn ngày");
				document.getElementById("thang").focus();
				return;
			}
			document.getElementById("form_nhap").submit();
	}
</script>
