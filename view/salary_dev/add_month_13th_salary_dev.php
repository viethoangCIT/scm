
<style type="text/css">



	.parent{
		min-height: 130px;
		max-height: 280px;
		height: auto;
		position: absolute;
		width: 100%;
		left: 0;
		
	}


</style>
<?php

$function_title = "Nhập thưởng tháng 13";
echo $this->Template->load_function_header($function_title);

    // form lọc ngày

array_unshift($array_department, array("id"=>"","name"=>"Chọn phòng ban"));
array_unshift($array_factory, array("id"=>"","name"=>"Chọn nhà máy"));
array_unshift($array_job, array("id"=>"","name"=>"Chọn công việc"));
array_unshift($array_position, array("id"=>"","name"=>"Chọn chức vụ"));
array_unshift($array_manufactory, array("id"=>"","name"=>"Chọn phân xưởng"));

$str_input_ngaylam_thang13 = $this->Template->load_textbox(array("name"=>"","id"=>"","value"=>"","style"=>"width:100px"));

$str_select_department = $this->Template->load_selectbox(array("name"=>"id_department","autocomplete"=>"off","value"=>"","id"=>"id_department","style"=>"width:150px"),$array_department);

                // lọc theo nhà máy

$str_select_factory    =  $this->Template->load_selectbox(array("name"=>"id_factory","autocomplete"=>"off","value"=>"","id"=>"id_factory","style"=>"width:150px"),$array_factory);

                // lọc theo công việc

$str_select_work = $this->Template->load_selectbox(array("name"=>"id_job","autocomplete"=>"off","value"=>"","id"=>"id_job"),$array_job);

                // lọc theo chức vụ

$str_select_position = $this->Template->load_selectbox(array("name"=>"id_position","autocomplete"=>"off","value"=>"","id"=>"id_position","style"=>"width:130px"),$array_position);

            // lọc theo phân xưởng

$str_select_part = $this->Template->load_selectbox(array("name"=>"id_manufactory","autocomplete"=>"off","value"=>"","id"=>"id_manufactory"),$array_manufactory);

$str_input_from = $this->Template->load_textbox(array("name"=>"thang","autocomplete"=>"off","value"=>"","id"=>"thang", "class"=>"day","style"=>"width:100px"));



$str_btn_save = "<input type='submit' class='timkiem'value='Tìm kiếm' style='font-size: 13.4px; margin-top:10px'>";

$str_input_ngay_tieuchuan_thang = $this->Template->load_textbox(array("name"=>"data[ngay_tieuchuan_thang1]","id"=>"ngay_tieuchuan_thang1","value"=>"","style"=>"width:100px"));
    //nhập nhân viên
$str_input_name_staff = $this->Template->load_textbox(array("name"=>"name","autocomplete"=>"off","value"=>"","id"=>"name", "placeholder"=>"Nhập tên nhân viên"));

$str_input_attendance_day ="Từ ngày $str_input_from &nbsp&nbsp Tổng ngày làm trong tháng $str_input_ngaylam_thang13&nbsp&nbsp Ngày tiêu chuẩn trong tháng $str_input_ngay_tieuchuan_thang <br/> $str_select_department  $str_select_position $str_select_work  $str_select_factory  $str_select_part Tên $str_input_name_staff $str_btn_save";



$str_form_salary1 = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/add_month_13th"),$str_input_attendance_day);



    //bước 1 tạo bảng heard
$str_salary_13 = "";


	//1: tao mang table header 











$array_salary_13_3 =  array(
	"Stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
	"ms"=>array("Mã nhân viên",array("style"=>"text-align:center; width:3%")),
	"ht"=>array("Họ & tên",array("style"=>"text-align:center; width:20%")),
	"chucvu"=>array("Chức vụ",array("style"=>"text-align:center; width:10%")),
	"cmnn"=>array("Số CMNN",array("style"=>"text-align:center; width:4%;")),
	"tk"=>array("Số TK ",array("style"=>"text-align:center; width:10%;")),
	"ngaylenchuc"=>array("Ngày lên chức ",array("style"=>"text-align:center; width:10%;")),
	"thang_thamnien_chucvu"=>array("Tháng thâm niên chức vụ ",array("style"=>"text-align:center; width:10%;")),
	  
	
	"thang_chucvu_1"=>array("Tháng chức vụ ",array("style"=>"text-align:center; width:4%;vertical-align:middle;")),
	"heso_chucvu_1"=>array("Hệ số chức vụ",array("style"=>"text-align:center; width:10%;vertical-align:middle;")),
	"thang_chucvu_2"=>array("Tháng chức vụ ",array("style"=>"text-align:center; width:4%;vertical-align:middle;")),
	"heso_chucvu_2"=>array("Hệ số chức vụ",array("style"=>"text-align:center; width:10%;vertical-align:middle;")),
	"thang_chucvu_3"=>array("Tháng chức vụ ",array("style"=>"text-align:center; width:4%;vertical-align:middle;")),
	"heso_chucvu_3"=>array("Hệ số chức vụ",array("style"=>"text-align:center; width:10%;vertical-align:middle;")),
	
	
	
	"thuong_giulai"=>array("Thưởng giữ lại  ",array("style"=>"text-align:center; width:4%;vertical-align:middle;")),
	
	
	
	);





	//2: lấy dòng tr header
$str_salary_13 .= $this->Template->load_table_header($array_salary_13_3);






$stt=0;


foreach ($array_user as $user) 
	
{
	$str_input_ngaylam_thang1 = $this->Template->load_textbox(array("name"=>"data[$stt][ngaylam_thang1]","id"=>"ngaylam_thang1","value"=>"","style"=>"width:50px"));
	

	$str_input_ngaylenchuc = $this->Template->load_textbox(array("name"=>"data[$stt][ngaylenchuc]","id"=>"lenchuc","value"=>"","style"=>"width:50px"));
	$str_input_thangthamnien = $this->Template->load_textbox(array("name"=>"data[$stt][thangthamnien]","id"=>"thangthamnien","value"=>"","style"=>"width:50px"));
	$str_input_sothangdat1 = $this->Template->load_textbox(array("name"=>"data[$stt][sothang_dat]","id"=>"sothang_dat","value"=>"","style"=>"width:50px"));
	$str_input_thagchucvu1= $this->Template->load_textbox(array("name"=>"data[$stt][thang_chucvu1]","id"=>"thang_chucvu1","value"=>"","style"=>"width:50px"));
	$str_input_hesochucvu1 = $this->Template->load_textbox(array("name"=>"data[$stt][heso_chucvu1]","id"=>"heso_chucvu1","value"=>"","style"=>"width:50px"));
	$str_input_thagchucvu2= $this->Template->load_textbox(array("name"=>"data[$stt][thang_chucvu2]","id"=>"thang_chucvu2","value"=>"","style"=>"width:50px"));
	$str_input_hesochucvu2 = $this->Template->load_textbox(array("name"=>"data[$stt][heso_chucvu2]","id"=>"heso_chucvu2","value"=>"","style"=>"width:50px"));
	$str_input_thagchucvu3= $this->Template->load_textbox(array("name"=>"data[$stt][thang_chucvu3]","id"=>"thang_chucvu3","value"=>"","style"=>"width:50px"));
	$str_input_hesochucvu3 = $this->Template->load_textbox(array("name"=>"data[$stt][heso_chucvu3]","id"=>"heso_chucvu3","value"=>"","style"=>"width:50px"));
	
	
	$str_input_thuonggiulai = $this->Template->load_textbox(array("name"=>"data[$stt][thuong_giulai]","id"=>"thuong_giulai","value"=>"","style"=>"width:50px"));
	
	
	


	$str_input_code = $this->Template->load_hidden(array("name"=>"data[$stt][user_code]","id"=>"user_code","value"=>$user['user_code'],"style"=>"width:100px; color:black;font-weight:normal;"));	
	$str_input_fullname = $this->Template->load_hidden(array("name"=>"data[$stt][full_name]","id"=>"full_name","value"=>$user["fullname"],"style"=>"width:100px ; color:black;font-weight:normal;"));
	$str_input_id_number= $this->Template->load_hidden(array("name"=>"data[$stt][id_number]","id"=>"id_number","value"=>$user["id_number"],"style"=>"width:100px ; color:black;font-weight:normal;"));
	$str_input_bank_account = $this->Template->load_hidden(array("name"=>"data[$stt][bank_account]","id"=>"bank_account","value"=>$user["bank_account"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
	$str_input_id_user = $this->Template->load_hidden(array("name"=>"data[$stt][id_user]","id"=>"id_user","value"=>$user["id"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
	$str_input_id_department = $this->Template->load_hidden(array("name"=>"data[$stt][id_department]","id"=>"id_department","value"=>$user['id_department'],"style"=>"width:100px; color:black;font-weight:normal;"));	
	$str_input_id_factory = $this->Template->load_hidden(array("name"=>"data[$stt][id_factory]","id"=>"id_factory","value"=>$user["id_factory"],"style"=>"width:100px ; color:black;font-weight:normal;"));
	$str_input_id_job= $this->Template->load_hidden(array("name"=>"data[$stt][id_job]","id"=>"id_number","value"=>$user["id_work"],"style"=>"width:100px ; color:black;font-weight:normal;"));
	$str_input_id_manufactory = $this->Template->load_hidden(array("name"=>"data[$stt][id_manufactory]","id"=>"id_manufactory","value"=>$user["id_manufactory"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
	$str_input_id_position = $this->Template->load_hidden(array("name"=>"data[$stt][id_position]","id"=>"id_position","value"=>$user["id_position"],"style"=>"width:100px ; color:black;font-weight:normal;"));	
	
	$stt++;

//lấy dòng nội dung table
	$array_salary_13 =  array(
		"Stt"=>array($stt,array("style"=>"text-align:center; width:3%")),
		"maso"=>array($user["user_code"] ,array("style"=>"text-align:center; width:3%;")),
		"ht"=>array($user["fullname"],array("style"=>"text-align:center; width:13%;white-space: nowrap")),				
		"chucvu"=>array("",array("style"=>"text-align:center; width:3%;")),
		"cmnd"=>array($user["id_number"],array("style"=>"text-align:center; width:3%;")),	
		"tk"=>array($user["bank_account"],array("style"=>"text-align:center; width:3%;")),
		"ngaylenchuc"=>array($str_input_ngaylenchuc,array("style"=>"text-align:center; width:3%;")),
		"thangthamnien"=>array($str_input_thangthamnien,array("style"=>"text-align:center; width:3%;")),
		"thang_chucvu_1"=>array($str_input_thagchucvu1,array("style"=>"text-align:center; width:3%;")),
		"heso_chucvu_1"=>array($str_input_hesochucvu1 ,array("style"=>"text-align:center; width:3%;")),
		"thang_chucvu_2"=>array($str_input_thagchucvu2,array("style"=>"text-align:center; width:3%;")),
		"heso_chucvu_2"=>array($str_input_hesochucvu2 ,array("style"=>"text-align:center; width:3%;")),
		"thang_chucvu_3"=>array($str_input_thagchucvu3,array("style"=>"text-align:center; width:3%;")),
		"heso_chucvu_3"=>array($str_input_hesochucvu3 ,array("style"=>"text-align:center; width:3%;")),
		"thuong_giulai"=>array($str_input_thuonggiulai ,array("style"=>"text-align:center; width:3%;")),
		
		);
$str_save_button =  $this->Template->load_button(array("type"=>"submit"),"Lưu");
$str_salary_13 .= $this->Template->load_table_row($array_salary_13);

}

$array_salary_13_1 =  array(
	"Stt"=>array("",array("style"=>"text-align:center; width:3%","colspan"=>"13")),
	"maso"=>array($str_save_button ,array("style"=>"text-align:center; width:3%;")),
	);
$str_salary_13 .= $this->Template->load_table_row($array_salary_13_1);

	//Đưa nội dung str_allowance vào thẻ table
$str_salary_13 =  $this->Template->load_table($str_salary_13);
$str_form_salary = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/salary/add_month_13th"),$str_salary_13);

?>


<div class="parent">
	<?php
    //buoc 5: dung ham load_table đưa dữ liệu vào table

	echo $str_form_salary1.$str_form_salary;

	?>
</div>


<div class="trong" style="height: 300px;">
	
</div>


<?php 



?>
<div>
	<?php  
	
	?>	
</div>

<script type="text/javascript">
	$( function() {
		$( "#thang" ).datepicker({dateFormat: "mm-yy"});
	} );
	
</script>