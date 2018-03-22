
<style type="text/css">


.parent{
	min-height: 130px;

	height:500px;
	position: absolute;
	width: 100%;
	left: 0;
	overflow:scroll;
}

</style>
<?php

$function_title = "Danh sách thưởng tháng 13";
echo $this->Template->load_function_header($function_title);

    // form lọc ngày





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

$str_form_search = $this->Template->load_form(array("method"=>"GET","id"=>"form_search","action"=>""),$str_input_attendance_day);
echo $str_form_search;	





    //bước 1 tạo bảng heard
$str_salary_13 = "";

	//1: tao mang table header 
$array_salary_13_0 =  array(
	"Stt"=>array("",array("style"=>"text-align:left; width:3%","colspan"=>"12")),
	"dat_thuongtet_1"=>array("Tháng 1",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_2"=>array("Tháng 2",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_3"=>array("Tháng 3",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_4"=>array("Tháng 4",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_5"=>array("Tháng 5",array("style"=>"text-align:center; width:10%","colspan"=>"4")),	
	"dat_thuongtet_6"=>array("Tháng 6",array("style"=>"text-align:center; width:10%","colspan"=>"4")),	
	"dat_thuongtet_7"=>array("Tháng 7",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_8"=>array("Tháng 8",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_9"=>array("Tháng 9",array("style"=>"text-align:center; width:10%","colspan"=>"4")),	
	"dat_thuongtet_10"=>array("Tháng 10",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_11"=>array("Tháng 11",array("style"=>"text-align:center; width:10%","colspan"=>"4")),	
	"dat_thuongtet_12"=>array("Tháng 12",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"so_thangdat"=>array("",array("style"=>"text-align:center; width:10%","colspan"=>"13")),
	
);


$array_salary_13_1 =  array(
	"Stt"=>array("Tổng ngày làm trong tháng",array("style"=>"text-align:left; width:3%","colspan"=>"12")),
	"dat_thuongtet_1"=>array("18",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_2"=>array("21",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_3"=>array("24",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_4"=>array("25",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_5"=>array("24",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_6"=>array("25",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_7"=>array("24",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_8"=>array("25",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_9"=>array("24",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_10"=>array("25",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_11"=>array("24",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_12"=>array("27",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"so_thangdat"=>array("",array("style"=>"text-align:center; width:10%","colspan"=>"12")),
	"so_thangdat"=>array("Số tháng đạt ( đã trừ 2 tháng học việc)",array("style"=>"text-align:center;vertical-align:middle; width:10%"," rowspan"=>"3")),
	"thang_chucvu_1"=>array("Tháng chức vụ ",array("style"=>"text-align:center; width:4%;vertical-align:middle;"," rowspan"=>"3")),
	"heso_chucvu_1"=>array("Hệ số chức vụ",array("style"=>"text-align:center; width:10%;vertical-align:middle;"," rowspan"=>"3")),
	"thang_chucvu_2"=>array("Tháng chức vụ ",array("style"=>"text-align:center; width:4%;vertical-align:middle;"," rowspan"=>"3")),
	"heso_chucvu_2"=>array("Hệ số chức vụ",array("style"=>"text-align:center; width:10%;vertical-align:middle;"," rowspan"=>"3")),
	"thang_chucvu_3"=>array("Tháng chức vụ ",array("style"=>"text-align:center; width:4%;vertical-align:middle;"," rowspan"=>"3")),
	"heso_chucvu_3"=>array("Hệ số chức vụ",array("style"=>"text-align:center; width:10%;vertical-align:middle;"," rowspan"=>"3")),
	"tienthuong_13"=>array("Thành tiền thưởng tháng 13",array("style"=>"text-align:center; width:10%;vertical-align:middle;"," rowspan"=>"3")),
	"ngaynghi_khongphep"=>array("Số ngày nghỉ không phép",array("style"=>"text-align:center; width:10%;vertical-align:middle;"," rowspan"=>"3")),
	"tiennghi_khongphep"=>array("Thành tiền trừ nghỉ không phép",array("style"=>"text-align:center; width:10%;vertical-align:middle;"," rowspan"=>"3")),
	"thuong_giulai"=>array("Thưởng giữ lại  ",array("style"=>"text-align:center; width:4%;vertical-align:middle;"," rowspan"=>"3")),
	"thuclanh"=>array("Thực lãnh",array("style"=>"text-align:center; width:10%;vertical-align:middle;"," rowspan"=>"3")),
	"action"=>array("Chức năng",array("style"=>"text-align:center;vertical-align:middle;"," rowspan"=>"3")),	
);	

$array_salary_13_2 =  array(
	"Stt"=>array("Tổng ngày tiêu chuẩn trong tháng ",array("style"=>"text-align:left; width:3%","colspan"=>"12")),
	"dat_thuongtet_1"=>array("18",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_2"=>array("21",array("style"=>"text-align:center; width:10%","colspan"=>"4")),	
	"dat_thuongtet_3"=>array("24",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_4"=>array("25",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_5"=>array("24",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_6"=>array("25",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_7"=>array("24",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_8"=>array("25",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_9"=>array("24",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_10"=>array("25",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
	"dat_thuongtet_11"=>array("24",array("style"=>"text-align:center; width:10%","colspan"=>"4")),	
	"dat_thuongtet_12"=>array("25",array("style"=>"text-align:center; width:10%","colspan"=>"4")),
);


$array_salary_13_3 =  array(
	"Stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
	"ms"=>array("Mã nhân viên",array("style"=>"text-align:center; width:3%")),
	"ht"=>array("Họ & tên",array("style"=>"text-align:center; width:20%")),
	"chucvu"=>array("Chức vụ",array("style"=>"text-align:center; width:10%")),
	"cmnn"=>array("Số CMNN",array("style"=>"text-align:center; width:4%;")),
	"tk"=>array("Số TK ",array("style"=>"text-align:center; width:10%;")),
	"ngayvao"=>array("Ngày vào công ty",array("style"=>"text-align:center; width:10%;")),
	"thamnien"=>array("Kỳ tính thâm niên",array("style"=>"text-align:center; width:10%")),
	"thang_thamnien"=>array("Tháng thâm niên",array("style"=>"text-align:center; width:10%")),
	"ngay_lenchuc"=>array("Ngày lên chức",array("style"=>"text-align:center; width:3%")),
	"thang_thamnien_chuc"=>array("Tháng thâm niên chức vụ",array("style"=>"text-align:center; width:3%")),
	"luong_coban"=>array("Lương cơ bản",array("style"=>"text-align:center; width:20%")),

	"dat_thuongtet_1"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_1"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_1"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_1"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),
	
	
	"dat_thuongtet_2"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_2"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_2"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_2"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),
	


	"dat_thuongtet_3"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_3"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_3"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_3"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),



	"dat_thuongtet_4"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_4"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_4"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_4"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),
	

	"dat_thuongtet_5"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_5"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_5"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_5"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),



	"dat_thuongtet_6"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_6"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_6"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_6"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),


	"dat_thuongtet_7"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_7"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_7"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_7"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),
	

	"dat_thuongtet_8"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_8"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_8"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_8"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),
	

	"dat_thuongtet_9"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_9"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_9"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_9"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),
	

	"dat_thuongtet_10"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_10"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_10"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_10"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),
	

	"dat_thuongtet_11"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_11"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_11"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_11"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),
	

	"dat_thuongtet_12"=>array("Đạt thưởng tết",array("style"=>"text-align:center; width:10%")),
	"ngay_cong_12"=>array("Ngày công làm được",array("style"=>"text-align:center; width:4%;")),
	"nghi_cophep_12"=>array("Nghĩ có phép",array("style"=>"text-align:center; width:10%;")),
	"nghi_khongphep_12"=>array("Nghĩ không phep",array("style"=>"text-align:center; width:10%;")),
	


);





	//2: lấy dòng tr header
$str_salary_13 .= $this->Template->load_table_header($array_salary_13_0);
$str_salary_13 .= $this->Template->load_table_header($array_salary_13_1);
$str_salary_13 .= $this->Template->load_table_header($array_salary_13_2);
$str_salary_13 .= $this->Template->load_table_header($array_salary_13_3);



$link_sua="";
$link_xoa="";
$link_sua  = $this->Template->load_link("edit","Sửa",$link_sua);
$link_xoa  = $this->Template->load_link("del","Xóa",$link_xoa);
$link_action = $link_sua. $link_xoa  ;
$stt = 0;
foreach ($array_user as  $user) 
{
	
	$stt++;	


//lấy dòng nội dung table
	$array_salary_13 =  array(
		"Stt"=>array($stt,array( "style"=>"text-align:center; width:3%")),
		"maso"=>array($user["user_code"] ,array("style"=>"text-align:center; width:3%;")),
		"ht"=>array($user["fullname"],array("style"=>"text-align:center; width:13%;white-space: nowrap")),						
		"chucvu"=>array($user["position"],array("style"=>"text-align:center; width:3%;")),
		"cmnd"=>array($user["id_number"],array("style"=>"text-align:center; width:3%;")),	
		"tk"=>array($user["bank_account"],array("style"=>"text-align:center; width:3%;")),
		"ngayvao"=>array($user["date_join"],array("style"=>"text-align:center; width:3%;")),
		"thamnien"=>array("2",array("style"=>"text-align:center; width:3%;")),
		"thang_thamnien"=>array("2",array("style"=>"text-align:center; width:3%;")),
		"ngay_lenchuc"=>array("1/1/2017",array("style"=>"text-align:center; width:3%")),
		"thang_thamnien_chuc"=>array("4",array("style"=>"text-align:center; width:3%")),
		"luong_coban"=>array($user["luong_coban"],array("style"=>"text-align:center; width:3%;")),

		"dat_thuongtet_1"=>array("Đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_1"=>array("1",array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_1"=>array($user["ngaynghi_cophep_1"],array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_1"=>array($user["ngaynghi_vophep_1"] ,array("style"=>"text-align:center; width:6%")),

		"dat_thuongtet_2"=>array("Đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_2"=>array("0",array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_2"=>array($user["ngaynghi_cophep_2"] ,array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_2"=>array($user["ngaynghi_vophep_2"],array("style"=>"text-align:center; width:6%")),

		"dat_thuongtet_3"=>array("Đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_3"=>array("2",array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_3"=>array($user["ngaynghi_cophep_3"] ,array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_3"=>array($user["ngaynghi_vophep_3"] ,array("style"=>"text-align:center; width:6%")),

		"dat_thuongtet_4"=>array("Không đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_4"=>array("0",array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_4"=>array($user["ngaynghi_cophep_4"] ,array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_4"=>array($user["ngaynghi_vophep_4"] ,array("style"=>"text-align:center; width:6%")),

		"dat_thuongtet_5"=>array("Đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_5"=>array("2",array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_5"=>array($user["ngaynghi_cophep_5"] ,array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_5"=>array($user["ngaynghi_vophep_5"],array("style"=>"text-align:center; width:6%")),


		"dat_thuongtet_6"=>array("Đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_6"=>array("0",array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_6"=>array($user["ngaynghi_cophep_6"] ,array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_6"=>array($user["ngaynghi_vophep_6"] ,array("style"=>"text-align:center; width:6%")),


		"dat_thuongtet_7"=>array("Không đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_7"=>array("8",array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_7"=>array($user["ngaynghi_cophep_7"] ,array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_7"=>array($user["ngaynghi_vophep_7"] ,array("style"=>"text-align:center; width:6%")),


		"dat_thuongtet_8"=>array("Đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_8"=>array("8",array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_8"=>array($user["ngaynghi_cophep_8"] ,array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_8"=>array($user["ngaynghi_vophep_8"] ,array("style"=>"text-align:center; width:6%")),


		"dat_thuongtet_9"=>array("Đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_9"=>array($user["ngaycong_trongthang_9"],array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_9"=>array($user["ngaynghi_cophep_9"] ,array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_9"=>array($user["ngaynghi_vophep_9"],array("style"=>"text-align:center; width:6%")),


		"dat_thuongtet_10"=>array("Đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_10"=>array($user["ngaycong_trongthang_10"],array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_10"=>array($user["ngaynghi_cophep_10"] ,array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_10"=>array($user["ngaynghi_vophep_10"] ,array("style"=>"text-align:center; width:6%")),


		"dat_thuongtet_11"=>array("Đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_11"=>array("0",array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_11"=>array($user["ngaynghi_cophep_11"] ,array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_11"=>array($user["ngaynghi_vophep_11"],array("style"=>"text-align:center; width:6%")),


		"dat_thuongtet_12"=>array("Đạt",array("style"=>"text-align:center; width:6%")),
		"ngay_cong_12"=>array("0",array("style"=>"text-align:center; width:6%")),
		"nghi_cophep_12"=>array($user["ngaynghi_cophep_12"] ,array("style"=>"text-align:center; width:6%")),
		"nghi_khongphep_12"=>array($user["ngaynghi_vophep_12"],array("style"=>"text-align:center; width:6%")),


		"so_thangdat1"=>array("10",array("style"=>"text-align:center; width:3%;")),
		"thang_chucvu_1"=>array("2",array("style"=>"text-align:center; width:3%;")),
		"heso_chucvu_1"=>array("2" ,array("style"=>"text-align:center; width:3%;")),
		"thang_chucvu_2"=>array("2",array("style"=>"text-align:center; width:3%;")),
		"heso_chucvu_2"=>array("2" ,array("style"=>"text-align:center; width:3%;")),
		"thang_chucvu_3"=>array("2",array("style"=>"text-align:center; width:3%;")),
		"heso_chucvu_3"=>array("2" ,array("style"=>"text-align:center; width:3%;")),

		"tienthuong_13"=>array("5.000.000",array("style"=>"text-align:center; width:4%;")),
		"ngaynghi_khongphep"=>array("4",array("style"=>"text-align:center; width:6%;")),						
		"tiennghi_khongphep"=>array("1.300.000",array("style"=>"text-align:center; width:6%;")),
		"thuong_giulai"=>array("500.000",array("style"=>"text-align:center; width:6%;")),
		"thuclanh"=>array("4.000.000",array("style"=>"text-align:center; width:3%;")),
		"action"=>array( $link_action  ,array("style"=>"text-align:center")),

	);

$str_salary_13 .= $this->Template->load_table_row($array_salary_13);

}



	//Đưa nội dung str_allowance vào thẻ table
$str_salary_13 =  $this->Template->load_table($str_salary_13);


?>
<div class="parent">
	<?php
    //buoc 5: dung ham load_table đưa dữ liệu vào table

	echo $str_salary_13;

	?>
</div>

<script type="text/javascript">
	$( function() {
		$( "#date_from" ).datepicker({dateFormat: "mm-yy"});
	} );
	$( function() {
		$( "#date_to" ).datepicker({dateFormat: "mm-yy"});
	} );
</script>