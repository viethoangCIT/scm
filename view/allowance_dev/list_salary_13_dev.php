<style type="text/css">
	.table-responsive{
		overflow: scroll!important;

	}
	.tbl_r{
		height: 300px;
	}
	.title_page{
		color: black;
	}
	.title_page{
		color: black!important;
		text-shadow:none;
	}
</style>
<?php 																																																																																														
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

$function_title = "Nhập Lương Tháng 13";
echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

$str_salary_13 = "";

	//1: tao mang table header 
$array_salary_13_0 =  array(
	"Stt"=>array("",array("style"=>"text-align:left; width:3%","colspan"=>"12")),
	
"dat_thuongtet_1"=>array("Tháng 1",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
	"dat_thuongtet_2"=>array("Tháng 2",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_3"=>array("Tháng 3",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),

"dat_thuongtet_4"=>array("Tháng 4",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_5"=>array("Tháng 5",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),

"dat_thuongtet_6"=>array("Tháng 6",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
"dat_thuongtet_7"=>array("Tháng 7",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	"dat_thuongtet_8"=>array("Tháng 8",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	"dat_thuongtet_9"=>array("Tháng 9",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_10"=>array("Tháng 10",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_11"=>array("Tháng 11",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_12"=>array("Tháng 12",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	

	"so_thangdat"=>array("",array("style"=>"text-align:left; width:10%","colspan"=>"12")),
	// "thang_chucvu"=>array("",array("style"=>"text-align:left; width:4%;")),
	// "heso_chucvu"=>array("",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("",array("style"=>"text-align:left; width:10%;")),
			
	);


	$array_salary_13_1 =  array(
	"Stt"=>array("Tổng ngày làm trong tháng",array("style"=>"text-align:left; width:3%","colspan"=>"12")),
	// "ms"=>array("Mã nhân viên",array("style"=>"text-align:left; width:3%")),
	// "ht"=>array("",array("style"=>"text-align:left; width:20%")),
	// "chucvu"=>array("",array("style"=>"text-align:left; width:10%")),
	// "cmnn"=>array("",array("style"=>"text-align:left; width:4%;")),
	// "tk"=>array(" ",array("style"=>"text-align:left; width:10%;")),
	// "ngayvao"=>array("",array("style"=>"text-align:left; width:10%;")),
	// "thamnien"=>array("",array("style"=>"text-align:left; width:10%")),
	// "thang_thamnien"=>array("",array("style"=>"text-align:left; width:10%")),
	// "ngay_lenchuc"=>array("",array("style"=>"text-align:left; width:3%")),
	// "thang_thamnien_chuc"=>array("",array("style"=>"text-align:left; width:3%")),
	// "luong_coban"=>array("",array("style"=>"text-align:left; width:20%")),

	"dat_thuongtet_1"=>array("18",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	
	
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
    "dat_thuongtet_2"=>array("21",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),

"dat_thuongtet_3"=>array("24",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_4"=>array("25",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),

"dat_thuongtet_5"=>array("24",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),

"dat_thuongtet_6"=>array("25",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_7"=>array("24",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	"dat_thuongtet_8"=>array("25",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	"dat_thuongtet_9"=>array("24",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_10"=>array("25",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_11"=>array("24",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	"dat_thuongtet_12"=>array("27",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	"so_thangdat"=>array("",array("style"=>"text-align:left; width:10%","colspan"=>"12")),
	// "thang_chucvu"=>array("",array("style"=>"text-align:left; width:4%;")),
	// "heso_chucvu"=>array("",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("",array("style"=>"text-align:left; width:10%;")),
			
	);	

$array_salary_13_2 =  array(
	"Stt"=>array("Tổng ngày tiêu chuẩn trong tháng ",array("style"=>"text-align:left; width:3%","colspan"=>"12")),
	// "ms"=>array("Mã nhân viên",array("style"=>"text-align:left; width:3%")),
	// "ht"=>array("",array("style"=>"text-align:left; width:20%","colspan"=>"10")),
	// // "chucvu"=>array("",array("style"=>"text-align:left; width:10%")),
	// "cmnn"=>array("",array("style"=>"text-align:left; width:4%;")),
	// "tk"=>array("",array("style"=>"text-align:left; width:10%;")),
	// "ngayvao"=>array("",array("style"=>"text-align:left; width:10%;")),
	// "thamnien"=>array("",array("style"=>"text-align:left; width:10%")),
	// "thang_thamnien"=>array("",array("style"=>"text-align:left; width:10%")),
	// "ngay_lenchuc"=>array("",array("style"=>"text-align:left; width:3%")),
	// "thang_thamnien_chuc"=>array("",array("style"=>"text-align:left; width:3%")),
	// "luong_coban"=>array("",array("style"=>"text-align:left; width:20%")),

"dat_thuongtet_1"=>array("18",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
	"dat_thuongtet_2"=>array("21",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_3"=>array("24",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),

"dat_thuongtet_4"=>array("25",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_5"=>array("24",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),

"dat_thuongtet_6"=>array("25",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
"dat_thuongtet_7"=>array("24",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	"dat_thuongtet_8"=>array("25",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	"dat_thuongtet_9"=>array("24",array("style"=>"text-align:left; width:10%","colspan"=>"4")),

	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_10"=>array("25",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_11"=>array("24",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
"dat_thuongtet_12"=>array("25",array("style"=>"text-align:left; width:10%","colspan"=>"4")),
	// "dat_thuongtet"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	// "ngay_cong"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	// "nghi_cophep"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	

	"so_thangdat"=>array("",array("style"=>"text-align:left; width:10%","colspan"=>"12")),
	// "thang_chucvu"=>array("",array("style"=>"text-align:left; width:4%;")),
	// "heso_chucvu"=>array("",array("style"=>"text-align:left; width:10%;")),
	// "nghi_khongphep"=>array("",array("style"=>"text-align:left; width:10%;")),
			
	);


$array_salary_13_3 =  array(
	"Stt"=>array("STT",array("style"=>"text-align:left; width:3%")),
	"ms"=>array("Mã nhân viên",array("style"=>"text-align:left; width:3%")),
	"ht"=>array("Họ & tên",array("style"=>"text-align:left; width:20%")),
	"chucvu"=>array("Chức vụ",array("style"=>"text-align:left; width:10%")),
	"cmnn"=>array("Số CMNN",array("style"=>"text-align:left; width:4%;")),
	"tk"=>array("Số TK ",array("style"=>"text-align:left; width:10%;")),
	"ngayvao"=>array("Ngày vào công ty",array("style"=>"text-align:left; width:10%;")),
	"thamnien"=>array("Kỳ tích thâm niên",array("style"=>"text-align:left; width:10%")),
	"thang_thamnien"=>array("Tháng thâm niên",array("style"=>"text-align:left; width:10%")),
	"ngay_lenchuc"=>array("Ngày lên chức",array("style"=>"text-align:left; width:3%")),
	"thang_thamnien_chuc"=>array("Tháng thâm niên chức vụ",array("style"=>"text-align:left; width:3%")),
	"luong_coban"=>array("Lương cơ bản",array("style"=>"text-align:left; width:20%")),

	"dat_thuongtet_1"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_1"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_1"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_1"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	
	
	"dat_thuongtet_2"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_2"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_2"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_2"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	


	"dat_thuongtet_3"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_3"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_3"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_3"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),



	"dat_thuongtet_4"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_4"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_4"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_4"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	

	"dat_thuongtet_5"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_5"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_5"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_5"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),



	"dat_thuongtet_6"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_6"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_6"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_6"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),


	"dat_thuongtet_7"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_7"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_7"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_7"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	

	"dat_thuongtet_8"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_8"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_8"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_8"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	

	"dat_thuongtet_9"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_9"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_9"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_9"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	

	"dat_thuongtet_10"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_10"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_10"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_10"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	

	"dat_thuongtet_11"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_11"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_11"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_11"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	

	"dat_thuongtet_12"=>array("Đạt thưởng tết",array("style"=>"text-align:left; width:10%")),
	"ngay_cong_12"=>array("Ngày công làm được",array("style"=>"text-align:left; width:4%;")),
	"nghi_cophep_12"=>array("Nghĩ có phép",array("style"=>"text-align:left; width:10%;")),
	"nghi_khongphep_12"=>array("Nghĩ không phep",array("style"=>"text-align:left; width:10%;")),
	

	"so_thangdat"=>array("Số tháng đạt ( đã trừ 2 tháng học việc)",array("style"=>"text-align:left; width:10%")),
	"thang_chucvu_1"=>array("Tháng chức vụ ",array("style"=>"text-align:left; width:4%;")),
	"heso_chucvu_1"=>array("Hệ số chức vụ",array("style"=>"text-align:left; width:10%;")),
	"thang_chucvu_2"=>array("Tháng chức vụ ",array("style"=>"text-align:left; width:4%;")),
	"heso_chucvu_2"=>array("Hệ số chức vụ",array("style"=>"text-align:left; width:10%;")),
	"thang_chucvu_3"=>array("Tháng chức vụ ",array("style"=>"text-align:left; width:4%;")),
	"heso_chucvu_3"=>array("Hệ số chức vụ",array("style"=>"text-align:left; width:10%;")),
	"tienthuong_13"=>array("Thành tiền thưởng tháng 13",array("style"=>"text-align:left; width:10%;")),
	"ngaynghi_khongphep"=>array("Số ngày nghỉ không phép",array("style"=>"text-align:left; width:10%;")),
	"tiennghi_khongphep"=>array("Thành tiền trừ nghỉ không phép",array("style"=>"text-align:left; width:10%;")),
	"thuong_giulai"=>array("Thưởng giữ lại  ",array("style"=>"text-align:left; width:4%;")),
	"thuclanh"=>array("Thực lãnh",array("style"=>"text-align:left; width:10%;")),
	
			
	);





	//2: lấy dòng tr header
$str_salary_13 .= $this->Template->load_table_header($array_salary_13_0);
$str_salary_13 .= $this->Template->load_table_header($array_salary_13_1);
$str_salary_13 .= $this->Template->load_table_header($array_salary_13_2);
$str_salary_13 .= $this->Template->load_table_header($array_salary_13_3);



for($i=1;$i<11;$i++)
{
	
	$str_input_landi = $this->Template->load_textbox(array("name"=>"data[landi]","id"=>"landi","value"=>"","style"=>"width:100px"));
	$str_input_solit = $this->Template->load_textbox(array("name"=>"data[solit]","id"=>"solit","value"=>"","style"=>"width:100px"));
	$str_input_dongia = $this->Template->load_textbox(array("name"=>"data[dongia]","id"=>"dongia","value"=>"","style"=>"width:100px"));
	$str_input_ghichu = $this->Template->load_textbox(array("name"=>"data[ghichu]","id"=>"ghichu","value"=>"","style"=>"width:100px"));
	
	
	
	
//lấy dòng nội dung table
	$array_salary_13 =  array(
		"Stt"=>array("$i",array( "style"=>"text-align:left; width:3%")),
		"maso"=>array("maso".$i ,array("style"=>"text-align:left; width:3%;")),
		"ht"=>array("Nguyễn văn ".$i,array("style"=>"text-align:center; width:13%;white-space: nowrap")),						
		"landi"=>array($str_input_landi,array("style"=>"text-align:left; width:6%")),
		"solit"=>array($str_input_solit,array("style"=>"text-align:left; width:6%;")),
		"tong_solit"=>array("10",array("style"=>"text-align:left; width:4%;")),
		"dongia"=>array($str_input_dongia,array("style"=>"text-align:center; width:6%;")),						
		"thanhtien"=>array("50000",array("style"=>"text-align:left; width:6%;")),
		"ghichu"=>array($str_input_ghichu,array("style"=>"text-align:left; width:6%;")),
		





		);

	$str_salary_13 .= $this->Template->load_table_row($array_salary_13);

}

    

	//Đưa nội dung str_allowance vào thẻ table
$str_salary_13 =  $this->Template->load_table($str_salary_13);


 
echo $str_salary_13;	

$str_save_button =  $this->Template->load_button(array("type"=>"button","onclick"=>"luu()"),"Lưu");
	$str_salary_13 = $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));		

echo $str_salary_13;		
?>
