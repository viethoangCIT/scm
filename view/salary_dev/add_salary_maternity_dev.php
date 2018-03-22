
<?php 																																																																																														
//*****************************************
//BEGIN: TITLE
//*****************************************
if ($array_edit) {
	$function_title = "Sửa Lương Thai Sản";
	echo $this->Template->load_function_header($function_title);
}
else
{
	$function_title = "Nhập Lương Thai Sản";
	echo $this->Template->load_function_header($function_title);
}


//*****************************************
//END:TITLE
//*****************************************


// ****************************************
// BEGIN: BỘ LỌC
$str_input_from = $this->Template->load_textbox(array("name"=>"thang","autocomplete"=>"off","value"=>$thang,"id"=>"thang", "class"=>"day","style"=>"width:90px;","onchange"=>"document.getElementById('ngay').value = document.getElementById('thang').value"));

//lọc theo phòng ban
array_unshift($array_department, array("id"=>"","name"=>"Chọn phòng ban"));
$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:130px;"),$array_department,$id_department);

// lọc theo nhà máy
array_unshift($array_factory, array("id"=>"","name"=>"Chọn nhà máy"));
$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:130px"),$array_factory,$id_factory);

// lọc theo công việc
array_unshift($array_job, array("id"=>"","name"=>"Chọn công việc"));
$str_select_job = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job","style"=>"width:130px;"),$array_job,$id_job);

// lọc theo chức vụ
array_unshift($array_position, array("id"=>"","name"=>"Chọn chức vụ"));
$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:130px;"),$array_position,$id_position);

// lọc theo phân xưởng
array_unshift($array_manufactory, array("id"=>"","name"=>"Chọn phân xưởng"));
$str_select_manufactory = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"id_manufactory","style"=>"width:130px;"),$array_manufactory,$id_manufactory);

$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>$name,"id"=>"name", "placeholder"=>"Nhập tên nhân viên"));
$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px'>";
$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");

$str_input_attendance_day ="Tháng:$str_input_from$str_select_department $str_select_position $str_select_job $str_select_factory $str_select_manufactory Tên: $str_input_name_staff $str_btn_save";

// đưa bộ lọc vào form
$str_form_maternity1 = $this->Template->load_form(array("method"=>"GET","id"=>"form_search","action"=>""),$str_input_attendance_day);
//END: BỘ LỌC
//*********************************************

//*********************************************
// BEGIN: HEADER TABLE
$str_salary_maternity = "";

//1: tao mang table header 
if($array_edit)
{	
	$array_header_salary_maternity =  array(
		"Stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
		"ms"=>array("Mã nhân viên",array("style"=>"text-align:center; width:9%")),
		"ht"=>array("Họ & tên",array("style"=>"text-align:center; width:14%")),
		"cmnn"=>array("Số CMNN",array("style"=>"text-align:center; width:10%")),
		"tk"=>array("Số TK",array("style"=>"text-align:center; width:4%;")),
		"thang"=>array("Tháng",array("style"=>"text-align:center; width:4%;")),
		"tien_thaisan"=>array("Tiền thai sản(BHXH  chi trả)",array("style"=>"text-align:center; width:10%;")),
		"phucap_thaisan"=>array("Phụ Cấp Thai Sản (công ty chi trả)",array("style"=>"text-align:center; width:10%;")),
		);
}
else
{
	$array_header_salary_maternity =  array(
		"Stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
		"ms"=>array("Mã nhân viên",array("style"=>"text-align:center; width:9%")),
		"ht"=>array("Họ & tên",array("style"=>"text-align:center; width:14%")),
		"cmnn"=>array("Số CMNN",array("style"=>"text-align:center; width:10%")),
		"tk"=>array("Số TK",array("style"=>"text-align:center; width:4%;")),
		"tien_thaisan"=>array("Tiền thai sản(BHXH  chi trả)",array("style"=>"text-align:center; width:10%;")),
		"phucap_thaisan"=>array("Phụ Cấp Thai Sản (công ty chi trả)",array("style"=>"text-align:center; width:10%;")),
		);
}
//2: lấy dòng tr header
$str_salary_maternity = $this->Template->load_table_header($array_header_salary_maternity);
//END: HEADER TABLE
//*********************************************

//*********************************************
// BEGIN: CONTENT CỦA TABLE

// BEGIN: NỘI DUNG SỬA USER
if($array_edit){
	$stt=0;
	foreach ($array_edit as $user) 	
	{
		$thang=$user["thang"];
		$thang=date("m-Y",strtotime($thang));
		$str_input_from = $this->Template->load_textbox(array("name"=>"thang","autocomplete"=>"off","value"=>$thang,"id"=>"thang", "class"=>"day","style"=>"width:90px;"));
		$str_input_id = $this->Template->load_hidden(array("name"=>"data[$stt][id]","id"=>"id","value"=>$user["id"],"style"=>"width:100px"));

		$str_input_tien_thaisan = $this->Template->load_textbox(array("name"=>"data[$stt][tien_thaisan]","id"=>"tien_thaisan","value"=>number_format($user['tien_thaisan']),"style"=>"width:100px"));
		$str_input_phucap_thaisan = $this->Template->load_textbox(array("name"=>"data[$stt][phucap_thaisan]","id"=>"phucap_thaisan","value"=>number_format($user['phucap_thaisan']),"style"=>"width:100px"));

		$str_input_user_code = $this->Template->load_hidden(array("name"=>"data[$stt][user_code]","id"=>"user_code","value"=>$user["user_code"],"style"=>"width:100px"));
		$str_input_id_number = $this->Template->load_hidden(array("name"=>"data[$stt][id_number]","id"=>"id_number","value"=>$user["id_number"],"style"=>"width:100px"));
		$str_input_full_name = $this->Template->load_hidden(array("name"=>"data[$stt][full_name]","id"=>"full_name","value"=>$user["full_name"],"style"=>"width:100px"));
		$str_input_bank_account = $this->Template->load_hidden(array("name"=>"data[$stt][bank_account]","id"=>"bank_account","value"=>$user["bank_account"],"style"=>"width:100px"));

		$str_input_id_user = $this->Template->load_hidden(array("name"=>"data[$stt][id_user]","id"=>"id_user","value"=>$user["id"],"style"=>"width:100px ; color:black;font-weight:normal;"));	

		$str_input_id_department = $this->Template->load_hidden(array("name"=>"data[$stt][id_department]","id"=>"id_department","value"=>$user['id_department'],"style"=>"width:100px; color:black;font-weight:normal;"));	
		$str_input_id_factory = $this->Template->load_hidden(array("name"=>"data[$stt][id_factory]","id"=>"id_factory","value"=>$user["id_factory"],"style"=>"width:100px ; color:black;font-weight:normal;"));
		$str_input_id_job= $this->Template->load_hidden(array("name"=>"data[$stt][id_job]","id"=>"id_job","value"=>$user["id_job"],"style"=>"width:100px ; color:black;font-weight:normal;"));
		$str_input_id_manufactory = $this->Template->load_hidden(array("name"=>"data[$stt][id_manufactory]","id"=>"id_manufactory","value"=>$user["id_manufactory"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
		$str_input_id_position = $this->Template->load_hidden(array("name"=>"data[$stt][id_position]","id"=>"id_position","value"=>$user["id_position"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
		$stt++;


//lấy dòng nội dung table
		$array_salary_maternity_1 =  array(
			"Stt"=>array("$stt.$str_input_id_position.$str_input_id",array( "style"=>"text-align:center; width:3%")),
			"ms"=>array($user["user_code"].$str_input_user_code.$str_input_id_department,array("style"=>"text-align:center; width:9%;")),
			"ht"=>array($user["full_name"].$str_input_full_name.$str_input_id_factory,array("style"=>"text-align:center; width:14%;")),						
			"cmnn"=>array($user["id_number"].$str_input_id_number.$str_input_id_job,array("style"=>"text-align:center; width:6%")),
			"tk"=>array($user["bank_account"].$str_input_bank_account.$str_input_id_manufactory,array("style"=>"text-align:center; width:6%;")),
			"thang"=>array($thang,array("style"=>"text-align:center; width:4%;")),
			"tien_thaisan"=>array($str_input_tien_thaisan,array("style"=>"text-align:center; width:4%;")),
			"phucap_thaisan"=>array($str_input_phucap_thaisan,array("style"=>"text-align:center; width:6%;"))
			);
		$str_salary_maternity .= $this->Template->load_table_row($array_salary_maternity_1);
	}
}
// END: NỘI DUNG CỦA USER CẦN SỬA

// BEGIN: NỘI DUNG CỦA TẤT CẢ USER
else
{

	$stt=0;
	foreach ($array_user as $user) 	
	{
		$str_input_from = $this->Template->load_textbox(array("name"=>"thang","autocomplete"=>"off","value"=>"","id"=>"thang", "class"=>"day","style"=>"width:90px;"));
		$str_input_tien_thaisan = $this->Template->load_textbox(array("name"=>"data[$stt][tien_thaisan]","id"=>"tien_thaisan","value"=>"","style"=>"width:100px","onkeyup" =>"format_number_textbox(this)"));
		$str_input_phucap_thaisan = $this->Template->load_textbox(array("name"=>"data[$stt][phucap_thaisan]","id"=>"phucap_thaisan","value"=>"","style"=>"width:100px","onkeyup" =>"format_number_textbox(this)"));
		$str_input_user_code = $this->Template->load_hidden(array("name"=>"data[$stt][user_code]","id"=>"user_code","value"=>$user["user_code"],"style"=>"width:100px"));
		$str_input_id_number = $this->Template->load_hidden(array("name"=>"data[$stt][id_number]","id"=>"id_number","value"=>$user["id_number"],"style"=>"width:100px"));
		$str_input_full_name = $this->Template->load_hidden(array("name"=>"data[$stt][full_name]","id"=>"full_name","value"=>$user["fullname"],"style"=>"width:100px"));
		$str_input_bank_account = $this->Template->load_hidden(array("name"=>"data[$stt][bank_account]","id"=>"bank_account","value"=>$user["bank_account"],"style"=>"width:100px"));
		$str_input_id_user = $this->Template->load_hidden(array("name"=>"data[$stt][id_user]","id"=>"id_user","value"=>$user["id"],"style"=>"width:100px ; color:black;font-weight:normal;"));	

		$str_input_id_department = $this->Template->load_hidden(array("name"=>"data[$stt][id_department]","id"=>"id_department","value"=>$user['id_department'],"style"=>"width:100px; color:black;font-weight:normal;"));	
		$str_input_id_factory = $this->Template->load_hidden(array("name"=>"data[$stt][id_factory]","id"=>"id_factory","value"=>$user["id_factory"],"style"=>"width:100px ; color:black;font-weight:normal;"));
		$str_input_id_job= $this->Template->load_hidden(array("name"=>"data[$stt][id_job]","id"=>"id_number","value"=>$user["id_work"],"style"=>"width:100px ; color:black;font-weight:normal;"));
		$str_input_id_manufactory = $this->Template->load_hidden(array("name"=>"data[$stt][id_manufactory]","id"=>"id_manufactory","value"=>$user["id_manufactory"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
		$str_input_id_position = $this->Template->load_hidden(array("name"=>"data[$stt][id_position]","id"=>"id_position","value"=>$user["id_position"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
		$stt++;


        //lấy dòng nội dung table
		$array_salary_maternity_1 =  array(

			"Stt"=>array("$stt.$str_input_id_position",array( "style"=>"text-align:center; width:3%")),
			"ms"=>array($user["user_code"].$str_input_user_code.$str_input_id_department,array("style"=>"text-align:center; width:9%;")),
			"ht"=>array($user["fullname"].$str_input_full_name.$str_input_id_factory,array("style"=>"text-align:center; width:14%;")),						
			"cmnn"=>array($user["id_number"].$str_input_id_number.$str_input_id_job,array("style"=>"text-align:center; width:6%")),
			"tk"=>array($user["bank_account"].$str_input_bank_account.$str_input_id_manufactory,array("style"=>"text-align:center; width:6%;")),

			"tien_thaisan"=>array($str_input_tien_thaisan,array("style"=>"text-align:center; width:4%;")),
			"phucap_thaisan"=>array($str_input_phucap_thaisan,array("style"=>"text-align:center; width:6%;")),);

		$str_salary_maternity .= $this->Template->load_table_row($array_salary_maternity_1);
	}
}	
// END: NỘI DUNG CỦA TẤT CẢ USER

// Tạo $str_input_ngay để lấy giá trị ngày ở bộ lọc 
$str_input_ngay = $this->Template->load_hidden(array("name"=>"ngay","id"=>"ngay","value"=>"","style"=>"width:100px ; color:black;font-weight:normal;"));	
//END: CONTENT TABLE
//*********************************************

// Nút lưu
if($array_edit)
{
$array_salary_maternity_2 =  array(
	"tongquy"=>array("",array("style"=>"text-align:center; width:10%; ","colspan"=>"7")),
	"Stt"=>array($str_save_button,array( "style"=>"text-align:center; width:3%"))
	);
}
else
{
	$array_salary_maternity_2 =  array(
	"tongquy"=>array("",array("style"=>"text-align:center; width:10%; ","colspan"=>"6")),
	"Stt"=>array($str_save_button,array( "style"=>"text-align:center; width:3%"))
	);
}

$str_salary_maternity .= $this->Template->load_table_row($array_salary_maternity_2);
$str_salary_maternity =  $this->Template->load_table($str_salary_maternity);
$str_form_maternity = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/add_maternity"),$str_salary_maternity.$str_input_ngay);

if ($array_edit)
{
	echo $str_form_maternity;	
}
else 
{
	echo $str_form_maternity1;
	echo $str_form_maternity;
}

?>
<script language="javascript">
	$( function() {
		$( "#thang" ).datepicker({dateFormat: "mm-yy"});
		
	} );

</script>
<script>
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