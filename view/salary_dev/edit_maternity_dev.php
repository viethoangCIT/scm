<?php 
// tiêu đề
$function_title = "Sửa Lương Thai Sản";
echo $this->Template->load_function_header($function_title);

$str_salary_maternity = "";

//1: tao mang table header 	
$array_header_salary_maternity =  array(
	"Stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
	"ms"=>array("Mã nhân viên",array("style"=>"text-align:center; width:9%")),
	"ht"=>array("Họ & tên",array("style"=>"text-align:center; width:14%")),
	"cmnn"=>array("Số CMNN",array("style"=>"text-align:center; width:10%")),
	"tk"=>array("Số TK",array("style"=>"text-align:center; width:4%;")),
	"tien_thaisan"=>array("Tiền thai sản(BHXH  chi trả)",array("style"=>"text-align:center; width:10%;")),
	"phucap_thaisan"=>array("Phụ Cấp Thai Sản (công ty chi trả)",array("style"=>"text-align:center; width:10%;")),
	);

//2: lấy dòng tr header
$str_salary_maternity = $this->Template->load_table_header($array_header_salary_maternity);
$stt=0;
foreach ($array_edit as $user) 	
{
	$thang=$user["thang"];
	$thang=date("m-Y",strtotime($thang));
	$str_input_from = $this->Template->load_textbox(array("name"=>"thang","autocomplete"=>"off","value"=>$thang,"id"=>"thang", "class"=>"day","style"=>"width:90px;"));
	$str_input_id = $this->Template->load_hidden(array("name"=>"data[$stt][id]","id"=>"id","value"=>$user["id"],"style"=>"width:100px"));
	$str_input_tien_thaisan = $this->Template->load_textbox(array("name"=>"data[$stt][tien_thaisan]","id"=>"tien_thaisan","value"=>$user['tien_thaisan'],"style"=>"width:100px"));
	$str_input_phucap_thaisan = $this->Template->load_textbox(array("name"=>"data[$stt][phucap_thaisan]","id"=>"phucap_thaisan","value"=>$user['phucap_thaisan'],"style"=>"width:100px"));
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

		"tien_thaisan"=>array($str_input_tien_thaisan,array("style"=>"text-align:center; width:4%;")),
		"phucap_thaisan"=>array($str_input_phucap_thaisan,array("style"=>"text-align:center; width:6%;")),						
		// "tongluong"=>array("",array("style"=>"text-align:center; width:6%;")),

		);
	$str_salary_maternity .= $this->Template->load_table_row($array_salary_maternity_1);
}
$array_salary_maternity_2 =  array(
	"tongquy"=>array("",array("style"=>"text-align:center; width:10%; ","colspan"=>"6")),
	"Stt"=>array($str_save_button,array( "style"=>"text-align:center; width:3%"))
	);

$str_salary_maternity .= $this->Template->load_table_row($array_salary_maternity_2);

$str_salary_maternity =  $this->Template->load_table($str_salary_maternity);

$str_form_maternity = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/add_maternity"),$str_salary_maternity.$str_input_ngay);

echo $str_form_maternity1.$str_form_maternity;	

?>